//投注剩下时间

var ser_lot_time;var lost_s;
var n_h;var n_m;var n_s;
function showLocale11(objD)
{

    var yy = objD.getFullYear();
        if(yy<1900) yy = yy+1900;
    var MM = objD.getMonth()+1;
        if(MM<10) MM = '0' + MM;
    var dd = objD.getDate();
        if(dd<10) dd = '0' + dd;
    var hh = objD.getHours();
        if(hh<10) hh = '0' + hh;
    var mm = objD.getMinutes();
        if(mm<10) mm = '0' + mm;
    var ss = objD.getSeconds();
        if(ss<10) ss = '0' + ss;

            str =  yy + "-" + MM + "-" + dd + " " + hh + ":" + mm + ":" + ss ;
        return(str);
}

var cance_time=1;
var timer11 ='';
function cance_time11(){

	document.getElementById('cance_timer').innerHTML="关闭("+cance_time+")";

	cance_time--;
}


function close_time22(){
	cance_time--;
	document.getElementById('close_timer').innerHTML="关闭("+cance_time+")";

	
	if(cance_time<1)show_bg('none','');
}

function show_bg(display,content){
	

	if(display=='block'){
		cance_time=5;
		 //clearInterval(timer);
		timer11 =  setInterval("close_time22()",1000);

	}
	else{
		document.getElementById('close_timer').innerHTML="关闭(3)";
		
		clearInterval(timer11);
	}

	message_top1();



	//document.getElementById('BgDiv').style.display=display;

	//document.getElementById('messageDiv1').style.display=display;
//	document.getElementById('message_con').innerHTML=content;
}

function show_bg1(display,content){
	if(display=='block'){
		cance_time=1;
		 //clearInterval(timer);
		timer11 =  setInterval("cance_time11()",1000);

	}
	else{
		document.getElementById('cance_timer').innerHTML="关闭(1)";
		 clearInterval(timer11);
	}

	message_top1();



if(display=='block' || (display=='none' &&  document.getElementById('lt_trace_box2').style.display=='none'))
	document.getElementById('BgDiv').style.display=display;

	document.getElementById('messageDiv3').style.display=display;
	document.getElementById('message_con3').innerHTML=content;
}

var time11=0;

function str_to_time(str){
var year=parseInt(str.substr(0,4));
var month=parseInt(str.substr(5,2));
var day=parseInt(str.substr(8,2));
var hour=parseInt(str.substr(11,2));
var min=parseInt(str.substr(14,2));
var sec=parseInt(str.substr(17,2));

if(month=='01' || month=='03' ||  month=='05' || month=='07' ||  month=='08' ||  month=='10' ||  month=='12' ){

	var dd=31;

}
else if(month=='02' ){

	var dd=28;

}
else{

	dd=30;
}

var time=sec+min*60+hour*60*60+day*60*60*24+month*60*60*24*dd+year*60*60*24*30*12
return parseInt(time);
}

var time_cha=0;
var msg_tt=0;
var msg_tt1=0;
function time_cur(){

	var nowtime=document.getElementById('nowtime').innerHTML;
	var myDate22=new Date();

	time_cha=parseInt(str_to_time(showLocale11(myDate22))-str_to_time(nowtime));
	//time_cha=2;
	return time_cha;
}

function return_now(){
	var nowtime=document.getElementById('nowtime').innerHTML;
	var myDate22=new Date();

	return parseInt(str_to_time(showLocale11(myDate22)));


}
var tt=0;

function _get_ser_time(ser_lot_time){
	if(gamekey == 'MMSSC'){

		G("count_down").innerHTML=' --:--:--';

		return true;
	}



	if(ser_lot_time<=0){
		var oSel=G('list_lot_num');
		oSel.options.length=0;
		//if(G('end_time').value==""){alert("已过销售期");window.top.frames['mainframe'].document.location.reload();return false;}
		G("count_down").innerHTML=' 00:00:00';
	//	G("current_issue").innerHTML="";
//	time_cur();

		get_new_lot();
	    if(return_now()-msg_tt>20){
	    	msg_tt=return_now();

		 show_bg1('block','第<span style="color:#ff0000;">'+G("current_issue").innerHTML+'</span>期已截止<br>投注时请注意期号');
			setTimeout("show_bg1('none','')",1000) ;
	    }
		return false;
	}



	var myDate11=new Date();
	G("nowtime").innerHTML=showLocale11(myDate11);

if(Math.floor(tt%60) ==0){

	lost_s=parseInt(str_to_time(G("current_endtime").innerHTML)+parseInt(time_cha)-str_to_time(showLocale11(myDate11)));


}else
lost_s=parseInt(ser_lot_time)-1;


    var l_s=Math.floor(lost_s%60);
	var next_s=Math.floor(lost_s/60);
	var l_m=Math.floor(next_s%60);
	var next_m=Math.floor(next_s/60);
    var l_h=Math.floor(next_m%60);

    var str='';

	if(l_h-10<0){n_h="0"+(l_h);}else{n_h=(l_h);}
	if(l_m-10<0){n_m="0"+(l_m);}else{n_m=(l_m);}
	if(l_s-10<0){n_s="0"+(l_s);}else{n_s=(l_s);}

	if(n_h!='00') var hh = n_h+":";
	else hh='';
	var this_vlue=hh+n_m+":"+n_s;

	G("last_second").innerHTML=lost_s;
	str=n_h+':'+n_m+':'+n_s+'';
	// if(this_vlue.indexOf('-') == '-1' && this_vlue.indexOf(':') >-1)
	G("count_down").innerHTML=str;
   setTimeout("_get_ser_time(lost_s)",1000) ;
}


function set_clock(num){
	   var str='';
	if(num<10)   str+='<li class="cb-0"><span>0</span></li> <li class="cb-'+num+'"><span>'+num+'</span></li>';
	else{

		num=num.toString();
		var num1=num.substr(0, 1);
		var num2=num.substr(1, 1);
		str+='<li class="cb-'+num1+'"><span>'+num1+'</span></li> <li class="cb-'+num2+'"><span>'+num2+'</span></li>';

	}
	return str;

}
function get_new_lot(){
	var rootURL=G("do_url").value;

	//http://localhost:8081/hero/do.aspx?mod=retime&flag=yes&play=CQSSC
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content="";
    ajaxobj.url=rootURL+"?mod=ajax&code=get&list=data&action=lot&flag=yes&play="+gamekey+"";//alert(ajaxobj.url)
    ajaxobj.callback=function(xmlobj){
		var response = Trim(xmlobj.responseText);
		if(response.length-10>0){
			var periods=response.split("|");
			selplay.lotpriod=periods[0];
			selplay.lotendtime=periods[1];
			selplay.lotnum=periods[2];
			selplay.begin=periods[3];
			selplay.end=periods[4];
			selplay.lostnums=periods[5];
			selplay.titles=periods[6];
			selplay.status=periods[7];
			selplay.isbuy=periods[8];
			var nowdate=periods[9];
			var nextdate=periods[10];
			var lastdate=periods[11];
			var nowtime=periods[12];
			//alert(selplay.lotendtime);

			   // if(G("current_issue").innerHTML != selplay.lotpriod && selplay.lotpriod!='')
		     	G("current_issue").innerHTML= selplay.lotpriod;

				G("current_endtime").innerHTML=selplay.lotendtime;
			tt=0;
			//	setTimeout("_get_ser_time('"+selplay.lostnums+"')",1000);

            _get_ser_time(selplay.lostnums);
				//Ajax_get_buy();


		}
	}
	ajaxobj.send();
}



