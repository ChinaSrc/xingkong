<?php

include('../config.php');
header("content-type:text/html; charset=utf-8");
$users=$_SESSION["userlist"];
$sys_infor=$_SESSION["sys_infor"];
$id=$_GET[id];
$active=$_GET[active];
$pop=$_GET[pop];
$url=$_GET[url];
switch($id){
case "nomoney":
$dialog="您的余额不足，请进行充值！";break;
case "highgame":
$dialog="请选择您的游戏模式：";break;
default:
$dialog="您的余额不足，请进行充值！";break;
}
$now_date_yes=date("Y-m-d",time());
$now_time_yes=date("H:i:s",time());
$now_date_no=date("Ymd",time());
$now_time_no=date("His",time());
;echo '<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<style>
body ,th,td{
	font:normal 12px 宋体; 
}
body  { 
	background:#C4D8ED; margin:0px; text-align:center; 
}
.title{
	text-align:center;height:20px;line-height:20px; margin-top:5px; padding:0px;
}
.items{
	text-align:center;height:110px;line-height:20px; margin:0px; padding:5px;overflow:auto;border-top:1px solid #999999;border-bottom:1px solid #999999;
}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{
	height:40px;background:#444444;line-height:40px;padding:10px;
}
</style>
<script>
function close_pop(){ 
	parent.window.document.getElementById("now_time_no").value=document.getElementById("now_time_no").value
	parent.window.document.getElementById("now_date_no").value=document.getElementById("now_date_no").value
	parent.window.document.getElementById("now_time_yes").value=document.getElementById("now_time_yes").value
	parent.window.document.getElementById("now_date_yes").value=document.getElementById("now_date_yes").value
	//parent.window.location.reload();
	parent.window.document.getElementById("nextperiod").onclick();
	parent.pop.close();
}
function GetNowTime(){
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST"; 
	ajaxobj.content="";
	var rooturl=parent.window.document.getElementById(\'rootURL\').value;
	//ajaxobj.url="../highgame/save_post.aspx?id=0&active=GetNowTime";
	ajaxobj.url=rooturl+"/?comes=highgame&controller=&action=save_post&id=0&flag=yes&active=GetNowTime";
	ajaxobj.callback=function(xmlobj){ 
	    var response =Trim(xmlobj.responseText);
		var times=response.split("|");
		var now_date_yes=times[0];var now_time_yes=times[1];var now_date_no=times[2];var now_time_no=times[3];
		parent.window.document.getElementById("now_time_no").value=now_time_no
		parent.window.document.getElementById("now_date_no").value=now_date_no
		parent.window.document.getElementById("now_time_yes").value=now_time_yes
		parent.window.document.getElementById("now_date_yes").value=now_date_yes
		parent.window.document.getElementById("nextperiod").onclick();
		parent.pop.close();
	}
	ajaxobj.send()
}
function submit_pop(){
	parent.window.location.reload(); 
	parent.pop.close();
} 
</script>
';
;echo '<body>
<input id=\'now_time_no\' value=\'';echo $now_time_no;;echo '\' style=\'display:none\'>
<input id=\'now_date_no\' value=\'';echo $now_date_no;;echo '\' style=\'display:none\'> 
<input id=\'now_time_yes\' value=\'';echo $now_time_yes;;echo '\' style=\'display:none\'>
<input id=\'now_date_yes\' value=\'';echo $now_date_yes;;echo '\' style=\'display:none\'> 
';
if($active==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>".$dialog."</font></div>";
}else{
if($active=="highgame"){
$modes="mode".$users->modes;
$sys_modes="sys_modes".$sys_infor->Modes;
if(strpos($modes,"1700")){$a_1700="";}else{$a_1700="display:none";}
if(strpos($modes,"1800")){$a_1800="";}else{$a_1800="display:none";}
if(strpos($modes,"1900")){$a_1900="";}else{$a_1900="display:none";}
if(strpos($sys_modes,"1700")){}else{$a_1700="display:none";}
if(strpos($sys_modes,"1800")){}else{$a_1800="display:none";}
if(strpos($sys_modes,"1900")){}else{$a_1900="display:none";}
$plays=$_GET[plays];
if($plays==""){$last_url="../highgame/?controller=game&action=game&plays=CQSSC&";}else{$last_url="../highgame/?controller=game&action=game&plays=".$plays."&";}
echo "<div style='width:100%;height:100%;background:#d0d0d0;'>";
echo "<div style='font-size:14px;text-align:left;margin:10px;'><font style='font-color:#666666;'><b>请选择您的游戏模式：<b></font></div>";
echo "<div style='margin:5px;text-algin:center;margin-left:100px;cursor: pointer;'>";
echo "  <a onclick=\"parent.window.location.href='".$last_url."sys_modes=1700'\" style='".$a_1700."'><img src='../highgame/images/botton_2.png' style='border:0px;'></a>";
echo "  <a onclick=\"parent.window.location.href='".$last_url."sys_modes=1800'\" style='".$a_1800."'><img src='../highgame/images/botton_3.png' style='border:0px;'></a>";
echo "  <a onclick=\"parent.window.location.href='".$last_url."sys_modes=1900'\" style='".$a_1900."'><img src='../highgame/images/botton_5.png' style='border:0px;'></a>";
echo "</div></div>";
}
if($active=="game_end"){
echo "<div class='title'>当前期已结束，是否刷新页面?</div>";
echo "<div class='title'>要刷新页面请点击“确定”，不刷新页面请点击“取消”</div>";
echo "<div class='bottom2'><input type='button' value='确定' onclick=\"submit_pop()\">　　<input type='button' value='取消' onclick=\"GetNowTime()\"></div>";
}
}
if($pop=="close"){echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";}
if($pop=="reload"){echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";}
if($pop=="next") {echo "<script>setTimeout(\"parent.window.location.href='".$url."'\",1000)</script>";}
;echo '</body>';
?>