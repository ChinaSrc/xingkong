//指定时间运行
var tSeconds=0;
var tMinutes=0;
var tHours=0;
var timer=null; 
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
	var NewValue=LastValue+br+"<font color='"+colors+"'>"+values+"</font>";
	document.getElementById("div_"+playkey).innerHTML=NewValue;
}
//重定向定时器======>
function again_get_lot(playkey,this_run_num){
	    //alert(playkey)
	    var play_list=document.getElementById("play_list").value;  
		var play_list=play_list.split("|");
		var max_play_num=play_list.length;var play_this_num;var play_next_num;

		//var sys_run_num=getCookie("sys_run_num");
		//if(sys_run_num-this_run_num>0){return false;}

		for(i=0;i<max_play_num;i++){
			if(playkey==play_list[i]){
				play_this_num=i;play_next_num=i+1;
			}
		}
		if(max_play_num-1-play_this_num==0){
			//###########################################################################
			Add_Show_infor(playkey,"最后一个了,max_play_num:"+max_play_num+"play_this_num:"+play_this_num,0,"<br>","");//#####
	       //###########################################################################
			window.setTimeout("Lot('"+this_run_num+"')",30000);
		}else{
			//###########################################################################
			Add_Show_infor(playkey,"转到下一个游戏"+play_list[play_next_num]+"#this_run_num:"+this_run_num,0,"<br>","");//#####
	        //###########################################################################
			GetLot(play_list[play_next_num],this_run_num);
		}
} 
//------------------------------------------------------------------------------------------------------------------------
//当前游戏20秒未获得数据，则继续下一个---#########################################################################################
function lost_time_fun(playkey,last_div,this_run_num){
	//window.clearInterval(lost_Timer);
	
	var new_run_num=parseInt(this_run_num)+1;
	writeCookie('sys_run_num',new_run_num,1);
	var this_div=document.getElementById("div_"+playkey).innerHTML;

	var lon_run_num=getCookie("sys_run_num"); 
	 //###########################################################################
			Add_Show_infor(playkey,"超时"+lon_run_num,0,"<br>","");//#####
	 //###########################################################################
	 //alert(playkey+"|"+new_run_num)
	 again_get_lot(playkey,new_run_num); 
}

//-----------------------------------------------------------------------------------------------------------------------
//定时器#################################################################################################################
function schedule(hours,minutes,seconds,playkey,this_run_num){
   tHours = hours;
   tMinutes = minutes;
   tSeconds = seconds;
   //runs(playkey,this_run_num);
   Begin_GetLot(playkey,this_run_num);
}
function runs(playkey,this_run_num){
        var date=new Date();
		var now_hours=date.getHours();  
        var now_Minutes=date.getMinutes();
		if(now_hours-1<0){now_hours=24;}
		if(now_Minutes-10<0){var nowtime=String(now_hours)+"0"+String(now_Minutes);}else{var nowtime=String(now_hours)+String(now_Minutes);} 
		var lotTime=String(tHours)+String(tMinutes);
        /// alert(lotTime+"|"+nowtime)
		if(parseInt(nowtime)-parseInt(lotTime)>=0){
	        Begin_GetLot(playkey,this_run_num);
			window.clearTimeout(timer);
        }else{
			if((date.getMinutes()-tMinutes==0)&&(date.getSeconds()-tSeconds==0)&&(date.getHours()-tHours==0)){ 
			    Begin_GetLot(playkey,this_run_num);
                window.clearTimeout(timer);
            }else{
                 timer = window.setTimeout("runs('"+playkey+"','"+this_run_num+"')",1);
            }
		}
}
//------------------------------------------------------------------------------------------------------------------------
//开始通过接口地址获取开奖数据---#########################################################################################
function Begin_GetLot(playkey,this_run_num){   
     //var LotLink_s=lotlinks.split("|"); 
     var list_num=0;//alert(playkey)
	// Ajax_GetLot(playkey,LotLink_s,list_num);
	 window.setTimeout("Ajax_GetLot('"+playkey+"',"+list_num+",'"+this_run_num+"')",200)
}
//------------------------------------------------------------------------------------------------------------------------
//运行Ajax-----------------------------############################################################################
function Ajax_GetLot(playkey,list_num,this_run_num){
	        var lotlinks=document.getElementById("links_"+playkey).value; 
	        if(typeof(list_num)!="int"){var list_num=parseInt(list_num);}
            var max_link_num;//alert(lotlinks)
			if(lotlinks.indexOf("^")>0){//alert("########^")
				var LotLink_s=lotlinks.split("^")
				max_link_num=LotLink_s.length;
				if(LotLink_s-list_num-1<0){list_num=max_link_num-1;}
	            now_link=LotLink_s[list_num]; //alert(LotLink_s[0])
			}else{ 
				max_link_num=1;
				now_link=lotlinks;
			} 
	        if(now_link=="" &&  now_link=="undefined"){again_get_lot(playkey);return false;}
			var rerun_get="no";
	        var content="playkey="+playkey+"&links="+now_link;
		 //###########################################################################
			//Add_Show_infor(playkey,"正在解析数据地址:"+now_link+"",0,"<br>","");//#####
		 //###########################################################################
		    var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
            ajaxobj=new AJAXRequest;
            ajaxobj.method="POST";
            ajaxobj.content=content; 
            ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_LotNum";
			var last_div_html=document.getElementById("div_"+playkey).innerHTML; 
            //window.setTimeout("lost_time_fun('"+playkey+"','"+last_div_html+"','"+this_run_num+"')",40000);

            ajaxobj.callback=function(xmlobj){ 
				var response = xmlobj.responseText;
			    if(response.indexOf("file_get_contents")< 0 && response.length-5>0 && typeof(response)!="undefined"){
					ShowLot_Infor(playkey,response,this_run_num); 
                }else{ 
					var new_list_num=list_num+1;
					if(max_link_num-new_list_num-1<=0){again_get_lot(playkey,this_run_num);
					}else{Ajax_GetLot(playkey,LotLink_s,new_list_num,this_run_num);}
				}
			}
            ajaxobj.send() 
}
//------------------------------------------------------------------------------------------------------------------------
//解析获取到的开奖数据,并进行相关操作..############################################################################
function ShowLot_Infor(playkey,response,this_run_num){
	var lotNum_long=document.getElementById("lotlong_"+playkey).value;
	var Qh=document.getElementById("qihaos_"+playkey).value; 

	if(response.indexOf("#^#")<0){
		list_s=response.split("|"); 
	}else{
		var max_list=response.split("#^#");
		list_s=max_list[0].split("|"); 
	}
	var qihaos=list_s[0];var lotnums=list_s[1];
	 
	//Add_Show_infor(playkey,"当前期号："+qihaos+" 上次期号："+lastQh,4,"<br>",""); 
    //if(parseInt(Qh)-parseInt(qihaos)==0){
	//}else{
		document.getElementById("qihaos_"+playkey).value= qihaos;
		Add_Show_infor(playkey,"期号："+qihaos+" 开奖号："+lotnums,4,"",1); 
		//获得当前日期，
		var Dates = new Date();  
		var myYears=Dates.getFullYear();
		var mymonths=Dates.getMonth()+1;    //获取当前月份(0-11,0代表1月)
		var myDates=Dates.getDate();        //获取当前日(1-31)
		if(10-mymonths>0){var newmonths="0"+mymonths;}else{var newmonths=mymonths;}
		if(10-myDates>0){var newDates="0"+String(myDates);}else{var newDates=String(myDates);}
		var mydates=String(myYears)+String(newmonths)+newDates;
        G("thisdate_"+playkey).value=mydates;//上次开奖的当前日期		 
		thisnum=document.getElementById("thisnum_"+playkey).value;
		
		//document.getElementById("thisnum_"+playkey).value=parseInt(thisnum)+1;//时间群组序号指向下一个。  
		//Lot_After(playkey,mydates,qihaos,lotNum_long,lotnums);  
		Lot_After(playkey,mydates,response,lotNum_long,lotnums);
	//}
        var now_run_num=getCookie("sys_run_num"); //alert(now_run_num+"|"+this_run_num);
		if(parseInt(now_run_num)-parseInt(this_run_num)>0){//alert(now_run_num+"|"+this_run_num+"#end");
		//###########################################################################
			Add_Show_infor(playkey,"now_run_num:"+now_run_num+"this_run_num:"+this_run_num+"end",0,"<br>","");//#####
		 //###########################################################################
		   return false;} 
	    again_get_lot(playkey,this_run_num)
}
//------------------------------------------------------------------------------------------------------------------------------
//打开页面时，计算当前最新的开奖时间---#########################################################################################
function Lot(this_run_num){
	//window.clearInterval(lotTimer);// alert("new")
	GetLot("CQSSC",this_run_num);
}
function GetLot(playkey,this_run_num){
	var lotNum=document.getElementById("lotNum_"+playkey).value; //开奖期号 
	var lotTime=document.getElementById("lotTime_"+playkey).value; //开奖时间 
	var thisnum=document.getElementById("thisnum_"+playkey).value;//当前期数的序号
	var thisdate=document.getElementById("thisdate_"+playkey).value;//上次开奖的当前日期
    if(thisnum-1<0){again_get_lot(playkey);return false}
	//1、没有时间设置则退出
	if(lotTime==""){again_get_lot(playkey);return false;}
    Add_Show_infor(playkey,"开始获取...",4,"<br>","");
	//2、获得当前日期
    var Dates = new Date();  
	var myYears=Dates.getFullYear();
	var mymonths=Dates.getMonth()+1;       //获取当前月份(0-11,0代表1月)
    var myDates=Dates.getDate();        //获取当前日(1-31)
	if(10-myDates>0){var newDates="0"+String(myDates);}else{var newDates=String(myDates);}
	var mydates=String(myYears)+String(mymonths)+newDates;
     
	//3、如果是当天，则不变，不是当天，则期号从头开始。
	if(lotTime.indexOf("|")>0){
		 var lotTime_s=lotTime.split("|");//将系统配置的开奖时间化为群组 
		if(thisdate-mydates==0){ 
		   var now_lotTime_s=lotTime_s[thisnum];  
		}else{ 
		   var now_lotTime_s=lotTime_s[0]; 
		   G("div_"+playkey).innerHTML="";
		} 
	}else{
		var now_lotTime_s=lotTime
	}
    
	//4、获取到开奖时间后，进入定时器========>
	Add_Show_infor(playkey,"最新开奖时间:"+now_lotTime_s,4,"",1);
    var run_timers=now_lotTime_s.split(":");
	schedule(run_timers[0],run_timers[1],run_timers[2],playkey,this_run_num);
}  
//------------------------------------------------------------------------------------------------------------------------ 
//获取开奖号码之后的相关操作---###########################################################################################
function  Lot_After(playkey,mydates,qihaos,lotNum_long,lotnums){
	var content="playkey="+playkey+"&mydates="+mydates+"&qihaos="+qihaos+"&lotNum_long="+lotNum_long+"&lotnums="+lotnums;
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=content; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_Lot_After";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;}
	ajaxobj.send()
} 


//计算是否获状###########################################################################################################
function Prize_Lot(period){
	window.clearInterval(lotTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_Prize_Lot&period="+period;
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;lotTimer=window.setInterval("Prize_Lot(period)",30000);}
	ajaxobj.send()
	//
}
//alert("dd8")
//计算中奖金额及分配返点###########################################################################################################
function fenpei_Prize(){
	window.clearInterval(PrizeTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_fenpei_Prize";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;PrizeTimer=window.setInterval("fenpei_Prize()",30000);}
	ajaxobj.send()
}
//计算中奖金额及分配返点###########################################################################################################
function fandian_Prize(){
	window.clearInterval(fandianTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=Ajax_fandian_Prize";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;fandianTimer=window.setInterval("fandian_Prize()",30000);}
	ajaxobj.send()
}
//计算中奖中奖排行###########################################################################################################
function pri_top(){
	window.clearInterval(pritopTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&flag=yes&action=ajax_pri_top";
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;pritopTimer=window.setInterval("pri_top()",60000);}
	ajaxobj.send()
}

 