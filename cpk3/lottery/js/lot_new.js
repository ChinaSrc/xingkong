//指定时间运行
var tSeconds=0;
var tMinutes=0;
var tHours=0;
var timer=null;
var atimer;var btimer;var ctimer;
var objTimer;var lotTimer;var PrizeTimer;var lost_Timer;var fandianTimer;
//页面打印LOG提示信息---############################################################################
function  Add_Show_infor(playkey,values,type,br,isnew){
	var colors="#999999";
	if(type-1<0){colors="#999999";}
	if(type-1==0){colors="#444444";} 
	if(type-2==0){colors="red";}
	if(type-3==0){colors="blue";}
	if(type-4==0){colors="green";} 
	var LastValue=document.getElementById("div_"+playkey).innerHTML;
	if(isnew-1==0){LastValue="";}
	if(values!='开始获取...'){
		var NewValue=LastValue+br+"<font color='"+colors+"'>"+values+"</font>";
		document.getElementById("div_"+playkey).innerHTML=NewValue;		
		
		
	}

}
//重定向定时器======>
function again_get_lot(playkey){ 
	window.clearInterval(atimer);
	    var play_list=document.getElementById("play_list").value;  
		var play_list=play_list.split("|");
		var max_play_num=play_list.length;var play_this_num;var play_next_num;
 
		for(i=0;i<max_play_num;i++){
			if(playkey==play_list[i]){
				play_this_num=i;play_next_num=i+1;				
				if(max_play_num-play_next_num==0){play_next_num=0;}
			}
		}
		if(play_next_num-1<0){
			//window.setTimeout("GetLot('"+play_list[play_next_num]+"')",10000); 
			btimer=window.setInterval("GetLot('"+play_list[play_next_num]+"')",10000);
		}else{
			//window.setTimeout("GetLot('"+play_list[play_next_num]+"')",500);
			btimer=window.setInterval("GetLot('"+play_list[play_next_num]+"')",500);
		}
		//GetLot(play_list[play_next_num]);
} 
function GetLot(playkey){  


	window.clearInterval(btimer);
    Add_Show_infor(playkey,"开始获取...",1,"",1);
	var begin_s=document.getElementById("begin_"+playkey).value;
	var end_s=document.getElementById("end_"+playkey).value;
	go_get_time(playkey,begin_s,end_s);	  

}


function go_get_time(playkey,begin_s,end_s){
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="begin_s="+begin_s+"&end_s="+end_s; 
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_get_time"; 
	ajaxobj.callback=function(xmlobj){ 
		var response = Trim(xmlobj.responseText);//alert(response)
		if(response.indexOf("es")>0){ 
			Ajax_GetLot(playkey);
		}else{
			var show_infor="未到时间("+document.getElementById("begin_s_"+playkey).value+"-"+document.getElementById("end_s_"+playkey).value+")"
			Add_Show_infor(playkey,show_infor,1,"",1);//return false;
			//atimer=window.setTimeout("again_get_lot('"+playkey+"')",2000); 
			atimer=window.setInterval("again_get_lot('"+playkey+"')",2000);
		}
	}
    ajaxobj.send();
}
//运行Ajax-----------------------------############################################################################
function Ajax_GetLot(playkey){

	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=''; 
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
    
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_get_lottime&playkey="+playkey;
    ajaxobj.callback=function(xmlobj){
    	var response1 = xmlobj.responseText;

if(response1.length>3){
	

	
	ShowLot_Infor(playkey,response1); 
	
	
}
else{
	
	
	
    var lotlinks=document.getElementById("links_"+playkey).value;
	var LotLink_s=lotlinks.split("^");
	for(i=0;i<LotLink_s.length;i++){
		now_link=LotLink_s[i];
		if(now_link=="" &&  now_link=="undefined"){again_get_lot(playkey);return false;}
		var content="playkey="+playkey+"&links="+now_link;
		var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content=content; 
	ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_LotNum";
		var last_div_html=document.getElementById("div_"+playkey).innerHTML; 
	ajaxobj.callback=function(xmlobj){ 
			var response = xmlobj.responseText;
		    if(response.indexOf("file_get_contents")< 0 && response.length-5>0 && typeof(response)!="undefined"){
				ShowLot_Infor(playkey,response); 
	    }
		}
	ajaxobj.send();
	}	
	
	

	
}
    	

     

	}
 	
    ajaxobj.send();	

	



			//window.setTimeout("again_get_lot('"+playkey+"')",4000); 
			atimer=window.setInterval("again_get_lot('"+playkey+"')",4000);
}
//解析获取到的开奖数据,并进行相关操作..############################################################################
function ShowLot_Infor(playkey,response){ 
	if(response.indexOf("#^#")<0){
		list_s=response.split("|"); 
	}else{
		var max_list=response.split("#^#");
		list_s=max_list[0].split("|"); 
	}
	var qihaos=list_s[0];var lotnums=list_s[1]; 
	Add_Show_infor(playkey,"期号："+qihaos+" 开奖号："+lotnums,4,"",1); 
	Lot_After(playkey,response); //alert(response)
} 
//------------------------------------------------------------------------------------------------------------------------ 
//获取开奖号码之后的相关操作---###########################################################################################
function  Lot_After(playkey,response){
	if(response.indexOf("</script>")>0){var arrs=response.split("</script>");var lotlist=arrs[1];}else{var lotlist=response;} 
	var content="playkey="+playkey+"&response="+lotlist;
	var thisPathUrl=ROOT_URL+"/"+AdminPath;  
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=content; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_Lot_After_new";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;}
	ajaxobj.send()
} 

//计算是否获状###########################################################################################################
function Prize_Lot(period){
	window.clearInterval(lotTimer);
	var thisPathUrl=ROOT_URL+"/"+AdminPath;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_Prize_Lot&period="+period;
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;lotTimer=window.setInterval("Prize_Lot(period)",30000);}
	ajaxobj.send()
	//
}
//计算中奖金额及分配奖金###########################################################################################################
function fenpei_Prize(){
	window.clearInterval(PrizeTimer);
	var thisPathUrl=ROOT_URL+"/"+AdminPath;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_fenpei_Prize";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;PrizeTimer=window.setInterval("fenpei_Prize()",30000);}
	ajaxobj.send();
}
//计算返点金额及分配返点###########################################################################################################
function fandian_Prize(){
//	window.clearInterval(fandianTimer);
//	var thisPathUrl=ROOT_URL+"/"+AdminPath;
//ajaxobj=new AJAXRequest;
//  ajaxobj.method="POST";
//   ajaxobj.content=""; 
//  ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_fandian_Prize";
//   ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;fandianTimer=window.setInterval("fandian_Prize()",30000);}
//ajaxobj.send();
}
//计算中奖中奖排行###########################################################################################################
function pri_top(){
//	window.clearInterval(pritopTimer);
//	var thisPathUrl=ROOT_URL+"/"+AdminPath;
//	ajaxobj=new AJAXRequest;
//   ajaxobj.method="POST";
//      ajaxobj.content=""; 
//    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=ajax_pri_top";
//    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;pritopTimer=window.setInterval("pri_top()",60000);}
//	ajaxobj.send()
}

 