//指定时间运行
var tSeconds=0;
var tMinutes=0;
var tHours=0;
var timer=null; 
var objTimer;var lotTimer;var PrizeTimer;
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
	var NewValue=LastValue+br+"<font color='"+colors+"'>"+values+"</font>";
	document.getElementById("div_"+playkey).innerHTML=NewValue;
}
//重定向定时器======>
function again_get_lot(playkey){
	var gapTime=3000;
	window.setInterval("GetLot('"+playkey+"')",gapTime);
	return false;
} 
//-----------------------------------------------------------------------------------------------------------------------
//定时器#################################################################################################################
function schedule(hours,minutes,seconds,playkey){
   tHours = hours;
   tMinutes = minutes;
   tSeconds = seconds;
   runs(playkey);
}
function runs(playkey){
        var date=new Date();
		var nowtime=date.toLocaleTimeString();nowtime=nowtime.replace(":","");nowtime=(nowtime.substr(0,4));
		var lotTime=String(tHours)+String(tMinutes);
         
		if(parseInt(nowtime)-parseInt(lotTime)>0){
	        Begin_GetLot(playkey);
        }else{
			if((date.getMinutes()-tMinutes==0)&&(date.getSeconds()-tSeconds==0)&&(date.getHours()-tHours==0)){
			    Begin_GetLot(playkey);
                window.clearTimeout(timer);
            }else{
                timer = window.setTimeout("runs('"+playkey+"')",1);
            }
		}
}
//------------------------------------------------------------------------------------------------------------------------
//开始通过接口地址获取开奖数据---#########################################################################################
function Begin_GetLot(playkey){  
	 var lotlinks=document.getElementById("links_"+playkey).value;
     //var LotLink_s=lotlinks.split("|"); 
     var list_num=0;//alert(playkey)
	// Ajax_GetLot(playkey,LotLink_s,list_num);
	 window.setTimeout("Ajax_GetLot('"+playkey+"','"+lotlinks+"','"+list_num+"')",200)
}
//------------------------------------------------------------------------------------------------------------------------
//运行Ajax-----------------------------############################################################################
function Ajax_GetLot(playkey,lotlinks,list_num){
	        var LotLink_s=lotlinks.split("|");
	        now_link=LotLink_s[list_num]; //alert(LotLink_s[0])
	        if(now_link=="" &&  now_link=="undefined"){again_get_lot(playkey);return false;}
			var rerun_get="no";
	        var content="playkey="+playkey+"&links="+now_link;
			//Add_Show_infor(playkey,"正在解析数据地址:"+now_link+"",0,"<br>","");
            ajaxobj=new AJAXRequest;
            ajaxobj.method="POST";
            ajaxobj.content=content; 
            ajaxobj.url="../../adminxp/Ajax_LotNum.aspx";
            ajaxobj.callback=function(xmlobj){ 
				var response = xmlobj.responseText;
			    if(response.indexOf("file_get_contents")< 0 && response.length-5>0 && typeof(response)!="undefined"){
					ShowLot_Infor(playkey,response); 
					return false;
                }else{ 
					var new_list_num=list_num+1;
					if(new_list_num-LotLink_s.length>0){again_get_lot(playkey);return false;
					}else{Ajax_GetLot(playkey,LotLink_s,new_list_num);}
				}
			}
            ajaxobj.send() 
}
//------------------------------------------------------------------------------------------------------------------------
//解析获取到的开奖数据,并进行相关操作..############################################################################
function ShowLot_Infor(playkey,response){
	var lotNum_long=document.getElementById("lotlong_"+playkey).value; 

	if(response.indexOf("#^#")<0){
		list_s=response.split("|"); 
	}else{
		var max_list=response.split("#^#");
		list_s=max_list[0].split("|"); 
	}
	var qihaos=list_s[0];var lotnums=list_s[1];
	var lastQh=document.getElementById("qihaos_"+playkey).value;
	//Add_Show_infor(playkey,"当前期号："+qihaos+" 上次期号："+lastQh,4,"<br>",""); 
    if(lastQh==qihaos){
		again_get_lot(playkey);return false;
	}else{
		document.getElementById("qihaos_"+playkey).value=qihaos;
		Add_Show_infor(playkey,"期号："+qihaos+" 开奖号："+lotnums,4,"<br>",""); 
		//获得当前日期，
		var Dates = new Date();  
		var myYears=Dates.getFullYear();
		var mymonths=Dates.getMonth()+1;    //获取当前月份(0-11,0代表1月)
		var myDates=Dates.getDate();        //获取当前日(1-31)
		if(10-myDates>0){var newDates="0"+String(myDates);}else{var newDates=String(myDates);}
		var mydates=String(myYears)+String(mymonths)+newDates;
        G("thisdate_"+playkey).value=mydates;//上次开奖的当前日期
		var nowqihaos=qihaos.substring(qihaos.length-lotNum_long,qihaos.length); 
		thisnum=G("thisnum_"+playkey).value; 
		G("thisnum_"+playkey).value=parseInt(thisnum)+1;//时间群组序号指向下一个。  
		Lot_After(playkey,mydates,qihaos,lotNum_long,lotnums);
	} 
}
//------------------------------------------------------------------------------------------------------------------------------
//打开页面时，计算当前最新的开奖时间---#########################################################################################
function GetLot(playkey){//alert(playkey)
	var lotNum=document.getElementById("lotNum_"+playkey).value; //开奖期号 
	var lotTime=document.getElementById("lotTime_"+playkey).value; //开奖时间 
	var thisnum=document.getElementById("thisnum_"+playkey).value;//当前期数的序号
	var thisdate=document.getElementById("thisdate_"+playkey).value;//上次开奖的当前日期
 
	//1、没有时间设置则退出
	if(lotTime==""){again_get_lot(playkey);return false;}
 
	//2、获得当前日期
    var Dates = new Date();  
	var myYears=Dates.getFullYear();
	var mymonths=Dates.getMonth()+1;       //获取当前月份(0-11,0代表1月)
    var myDates=Dates.getDate();        //获取当前日(1-31)
	if(10-myDates>0){var newDates="0"+String(myDates);}else{var newDates=String(myDates);}
	var mydates=String(myYears)+String(mymonths)+newDates;
     
	//3、如果是当天，则不变，不是当天，则期号从头开始。 
	var lotTime_s=lotTime.split("|");//将系统配置的开奖时间化为群组 
    if(thisdate-mydates==0){ 
		var now_lotTime_s=lotTime_s[thisnum];  
	}else{ 
		var now_lotTime_s=lotTime_s[0]; 
		G("div_"+playkey).innerHTML="";
	}

	//4、获取到开奖时间后，进入定时器========>
	//Add_Show_infor(playkey,"下一个运行时间:"+now_lotTime_s,4,"<br>","");
    var run_timers=now_lotTime_s.split(":");
	
	schedule(run_timers[0],run_timers[1],run_timers[2],playkey);
}  
//------------------------------------------------------------------------------------------------------------------------ 
//获取开奖号码之后的相关操作---###########################################################################################
function  Lot_After(playkey,mydates,qihaos,lotNum_long,lotnums){
	var content="playkey="+playkey+"&mydates="+mydates+"&qihaos="+qihaos+"&lotNum_long="+lotNum_long+"&lotnums="+lotnums;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=content; 
    ajaxobj.url="../../adminxp/Ajax_Lot_After.aspx";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;}
	ajaxobj.send()
} 
//计算是否获状###########################################################################################################
function Prize_Lot(){
	window.clearInterval(lotTimer);
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url="../../adminxp/Ajax_Prize_Lot.aspx";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;lotTimer=window.setInterval("Prize_Lot()",60000);}
	ajaxobj.send()
	
}
//alert("dd8")
//计算中奖金额及分配返点###########################################################################################################
function fenpei_Prize(){//alert("d")
	window.clearInterval(PrizeTimer);
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url="../../adminxp/Ajax_fenpei_Prize.aspx";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;PrizeTimer=window.setInterval("fenpei_Prize()",60000);}
	ajaxobj.send() 
    
}


 