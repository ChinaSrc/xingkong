<?php

$period= trim($_GET['period']);
if($period==""){echo "匹配期数为空";exit;}
;echo '<script language="javascript" type="text/javascript" src="';echo ROOT_URL;;echo '/js/common.js"></script>
<script type=\'text/javascript\' src=\'';echo ROOT_URL."/".$AdminPath;;echo '/js/lot.js\'></script>
<style>
body ,th,td{
	font:normal 12px 宋体; 
}
body  { 
	background:#FFFFFF; margin:0px; text-align:center; 
}
.title{
	text-align:left;height:30px;line-height:30px;padding-left:20px;
}
.items{
	text-align:left;height:30px;line-height:30px;padding-left:20px;
}
.bottom2{
	height:50px;line-height:40px;padding:10px;
}
.title_a{
	font-weight:bold;font-size:12px;
}
</style>
<script>
function close_pop(){parent.window.location.reload();parent.pop.close();}
//计算是否获状###########################################################################################################
function Prize_Lot(period){
	window.clearInterval(lotTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&action=Ajax_Prize_Lot&flag=yes&period="+period;
    ajaxobj.callback=function(xmlobj){
		var response = xmlobj.responseText;//alert(response);return false;
		G(\'Prize_Lot\').innerHTML="中奖匹配完毕"; 
		;G(\'fenpei_Prize\').innerHTML="开始分派奖金";PrizeTimer=window.setInterval("fenpei_Prize(period)",1000);}
	ajaxobj.send()
	//
}
//alert("dd8")
//计算中奖金额及分配返点###########################################################################################################
function fenpei_Prize(period){
	window.clearInterval(PrizeTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&action=Ajax_fenpei_Prize&flag=yes&period="+period;
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;G(\'fenpei_Prize\').innerHTML="分派奖金完毕"+response;G(\'fandian_Prize\').innerHTML="开始分派返点";fandianTimer=window.setInterval("fandian_Prize(period)",1000);}
	ajaxobj.send()
}
//计算中奖金额及分配返点###########################################################################################################
function fandian_Prize(period){
	window.clearInterval(fandianTimer);
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content=""; 
    ajaxobj.url=thisPathUrl+"/?controller=do&action=Ajax_fandian_Prize&flag=yes&period="+period;
    ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;G(\'fandian_Prize\').innerHTML="分派返点完毕";G(\'end_Prize\').innerHTML="本次操作完毕";}
	ajaxobj.send()
}
</script>
<div class=\'title_a title\'><font style=\'font-color:#ffffff;\'>匹配期数 ';echo $period;;echo '</font>&nbsp;&nbsp;&nbsp;&nbsp;
';
if(strlen($period)-10>=0){
$SerialDate=substr($period,0,8);
$SerialID=substr($period,8,strlen($period));
$searchs=" where game_lottery.SerialDate='$SerialDate' and game_lottery.SerialID='$SerialID'";
}else{
$searchs=" where game_lottery.period='$rows2[period]'";
}
mysql_query("set names utf8;");
$sql8="select game_lottery.Number as lotnum from game_lottery $searchs ";
$result8=mysql_query($sql8);
$nums8=mysql_num_rows($result8);
if($nums8){
echo "<font style='color:green;'>已获取到开奖号码</font></div>";
}else{
echo "<font style='color:red;'>未获取到开奖号码</font></div>";
exit;
}
;echo ' 
<div class=\'items\'><font style=\'font-color:#ffffff;\' id=\'Prize_Lot\'>正在处理,请稍候...</font></div>
<div class=\'items\'><font style=\'font-color:#ffffff;\' id=\'fenpei_Prize\'></font></div>
<div class=\'items\'><font style=\'font-color:#ffffff;\' id=\'fandian_Prize\'></font></div>
<div class=\'items\'><font style=\'color:blue;\' id=\'end_Prize\'></font></div>
<div class=\'bottom2\'><input type=\'button\' value=\'确定\' onclick="close_pop()">　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
<input id=\'period\' value=\'';echo $period;;echo '\' type=\'hidden\'>
<script>
var period=G(\'period\').value; 
  lotTimer=window.setInterval("Prize_Lot(period)",1000); 
</script>


'
?>