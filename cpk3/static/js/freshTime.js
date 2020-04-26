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

var cance_time=2;
var timer11 ='';
function cance_time11(){

	document.getElementById('cance_timer').innerHTML="取消("+cance_time+")";

	cance_time--;
}
function show_bg(display,content){

	//message_top1();

	if(display=='block'){
		cance_time=1;
		 //clearInterval(timer);
		timer11 =  setInterval("cance_time11()",1000);

	}
	else{
		document.getElementById('cance_timer').innerHTML="取消(2)";
		 clearInterval(timer11);
	}


//if(display=='block' || (display=='none' && document.getElementById('lt_trace_box1').style.display=='none' && document.getElementById('lt_trace_box2').style.display=='none'))
	document.getElementById('BgDiv').style.display=display;

	document.getElementById('messageDiv1').style.display=display;
	document.getElementById('message_con2').innerHTML=content;
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
var  timer_daojishi='';
var tips_time=0;
function _get_ser_time(ser_lot_time){


	if(ser_lot_time<=0){

		//if(G('end_time').value==""){alert("已过销售期");window.top.frames['mainframe'].document.location.reload();return false;}
	 if(mobile==0){
         G("count_down").innerHTML="<div class='icon-bg'>00</div><div class='icon-bg'>00</div><div class='icon-bg'>00</div>";

     }
        else{
            G("count_down").innerHTML='00:00:00';

        }
		get_new_lot();

		return false;
	}



	var myDate11=new Date();
	G("nowtime").innerHTML=showLocale11(myDate11);

if(Math.floor(tt%60) ==0){

	lost_s=parseInt(str_to_time(G("current_endtime").innerHTML)+parseInt(time_cha)-str_to_time(showLocale11(myDate11)));


}else
lost_s=parseInt(ser_lot_time)-1;
    lost_s=parseInt(ser_lot_time)-1;
   // console.log(lost_s);

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
    str="<div class='icon-bg'>"+n_h.toString().substr(0,1)+n_h.toString().substr(1,1)+"</div>";

 str+="<div class='icon-bg'>"+n_m.toString().substr(0,1)+n_m.toString().substr(1,1)+"</div>";

str+="<div class='icon-bg'>"+n_s.toString().substr(0,1)+n_s.toString().substr(1,1)+"</div>";

	//str='<div class="hh">'+n_h+'</div><div class="mm">'+n_m+'</div><div class="ss">'+n_s+'</div>';
  // console.log(str);
	// if(this_vlue.indexOf('-') == '-1' && this_vlue.indexOf(':') >-1)

//	G('confirm-countdown').innerHTML=n_h+':'+n_m+':'+n_s;
if(mobile==0){
    G("count_down").innerHTML=str;
    G('tipstime').innerHTML=n_h+':'+n_m+':'+n_s;
}
else{
    G("count_down").innerHTML=n_h+':'+n_m+':'+n_s;
    G('tipstime').innerHTML=n_h+':'+n_m+':'+n_s;
}


    selplay.lastsecond=lost_s;
    clearTimeout(timer_daojishi);
    timer_daojishi= setTimeout("_get_ser_time(lost_s)",1000) ;

    mp3_sound(lost_s);

}


function  mp3_sound(lost_s) {
	if (typeof(vedio) == 'undefined') { var vedio =''}
	if(parseInt(lost_s)<=10 && vedio==1  && selplay.isbuy==1){
        document.getElementById('mp3_timer').currentTime='0.0';

        document.getElementById('mp3_timer').play();

        setTimeout(function () {
            document.getElementById('mp3_timer').pause();
        },300) ;

	}

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
    ajaxobj.url=rootURL+"?mod=ajax&code=get&list=data&action=lotnew&flag=yes&play="+gamekey+"&randnum="+Math.random();//alert(ajaxobj.url)
    ajaxobj.callback=function(xmlobj){
		var response = Trim(xmlobj.responseText);

        try {
            var result=JSON.parse(response);
            if(result){
                clearTimeout(timer_daojishi);
                _get_ser_time(result.lastsecond);
                setlottery_status(result);
                if (mobile != 1) Ajax_get_buy();
                if(gametype!='k3' && gametype!='dp') zui_fresh();

            }
        }
        catch(err){

            setTimeout(function () {
                console.log("读取倒计时时间失败，1s后重新尝试");
                get_new_lot();
            },3000);

        }




	}
	ajaxobj.send();
}

function setlottery_status(result){


    G("current_issue").innerHTML=result.period;
    G("current_issue2").innerHTML=result.period;
    if(mobile==1){
        G("current_issue11").innerHTML=result.period;
        G("current_issue22").innerHTML=result.period;

    }
    selplay.lotpriod=result.period;
    selplay.pre_period=result.pre_period;
    selplay.isbuy=1;
    selplay.stoptime=result.stoptime;
    selplay.lastsecond=result.lastsecond;
    selplay.begin=result.begin;
    selplay.end=result.end;
    selplay.lotnum=result.lotnum;
    selplay.per_num=result.num;
    G("nav_period").innerHTML=result.period;
    if(result.isbuy==1)
    G("nav_status").innerHTML='正在接受投注';
    else  G("nav_status").innerHTML='封单中';
    document.getElementById('per_num1').innerHTML=result.num;
    document.getElementById('per_num2').innerHTML=parseInt(result.sum)-parseInt(result.num);
    setisbuy(result.isbuy);

    if(selplay.lastsecond==0 && selplay.isbuy==1 && return_now()-tips_time>10){

        tips_time=return_now();
        show_bg('block','第'+selplay.pre_period+'期已停止投注<br>当前销售:'+selplay.lotpriod+'期');
        setTimeout("show_bg('none','')",1000) ;
    }
}


function  setisbuy(isbuy) {

    //已开奖
    if(isbuy==1){
      document.getElementById('isbuy_title').style.display='block';
      document.getElementById('isstop_title').style.display='none';
      if(mobile==1){

          document.getElementById('isbuy_title1').style.display='inline-block';
          document.getElementById('isstop_title1').style.display='none';

      }

        setTimeout(function () {
            period_loading();
            Ajax_last_lotnum();
        },500);
    }
    else{
       //已封单
        document.getElementById('isbuy_title').style.display='none';
        document.getElementById('isstop_title').style.display='block';
        if(mobile==1){
            document.getElementById('isbuy_title1').style.display='none';
            document.getElementById('isstop_title1').style.display='inline-block';
        }
        period_loading();
       // console.log('已封单');
    }



}



