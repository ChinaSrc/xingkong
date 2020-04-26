<?php

include(ROOT_PATH."/source/function/run.php");
$nextgo=$_GET[nextgo];
$id=$_GET[id];
$active=$_GET[active];
$keys=$_GET[keys];
$pername=$_GET[pername];
$perid=$_GET[perid];
$uid=$_GET[uid];
$money=$_GET[money];
if($active=="recharge"){$item="充值";}if($active=="platform"){$item="提现";}
if($keys=="agree"){$title="同意";}if($keys=="refuse"){$title="拒绝";}
$show_value=$title." ".$pername." 金额为 <span id='money'>".$money."</span> 的".$item."请求？";
if($active=="gifts"){
$item="领取购彩金";
$show_value=$title." ".$pername." 的".$item."请求？";
}
if($nextgo=="save"){
$show_title="处理成功!";
$bodys=$_POST[bodys];
echo "<script type='text/javascript' src='".ROOT_URL."/static/js/common.js'></script>";
mysql_query("set names utf8;");


if($keys=="refuse"){
$sql3="select user_funds.* from user_funds where id='$uid' and status='0'";
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
if($nums3){
$strSql="update user_funds set status='2',Man_remark='$bodys' where id='$uid' and status='0'";
$db->query($strSql);
if($bodys==""){$bodys="提现被取消";}
$row_funds=mysql_fetch_array($result3);
if($active=="platform"){
$strSqls="update user_bank set hig_amount=hig_amount+$money where userid='$perid'";
mysql_query($strSqls,$link) or die("插入时出错1".mysql_error());
$log_floatid="";$log_type="mention_from_back";$log_money=$money;$log_remarks=$bodys;$log_uid=$perid;$log_status="0";
include(ROOT_PATH."/source/plugin/Add_Bank_Log.php");
$content="您[".$row_funds['creatdate']."]提交的提现请求已被拒绝!";
}else{
$content="您[".$row_funds['creatdate']."]提交的充值请求已被拒绝!";
}send_msg($row_funds['userid'], "充值提醒", $content);

}else{
$show_title="未找到申请单或已处理!";
}
}



if($keys=="agree"){
$sql_funds="select * from user_funds where id='$uid' and status='0'";
$result_funds=mysql_query($sql_funds);
$num_funds=mysql_num_rows($result_funds);
if($num_funds){
$fetch_funds=mysql_fetch_array($result_funds);
if($active=="recharge"){
agree_charge($uid);
$content="您[".$fetch_funds['creatdate']."]提交的充值请求已成功处理!";
}else{
$content="您[".$fetch_funds['creatdate']."]提交的提现请求已成功处理!";
}
send_msg($fetch_funds['userid'], "提现提醒", $content);

}else{
$show_title="未找到申请单或已处理!";
}
$strSql="update user_funds set status='1',Man_remark='$bodys' where id='$uid' ";
$db->query($strSql);
}
echo "<div style='font-size:12px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>".$show_title."</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit;
}
;echo '<script language="javascript" type="text/javascript" src="';echo ROOT_URL;;echo '/js/common.js"></script>
<style>
body ,th,td{font:normal 12px 宋体;}
body{background:#FFFFFF; margin:0px; text-align:center;} 
.items{text-align:center;height:100px; line-height:30px; margin:0px; padding-top:5px;overflow:auto;border-top:1px solid #999999;}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{height:40px;line-height:40px;padding:10px;}
</style>
<script>
function close_pop(){parent.pop.close();} 
function put_pop(action,nexts){
	if(document.getElementById(\'yes_button\')){
		document.getElementById(\'yes_button\').setAttribute(\'disabled\',true); 
	}  
}
function chkForm(vthis){
	if(document.getElementById(\'yes_button\')){
		document.getElementById(\'yes_button\').setAttribute(\'disabled\',true);
	}  
}
</script> 
<form action="';echo ROOT_URL."/".$AdminPath;;echo '/?flag=yes&action=edit_rechar_plat&nextgo=save&active=';echo $active;;echo '&keys=';echo $keys;;echo '&pername=';echo $pername;;echo '&perid=';echo $perid;;echo '&uid=';echo $uid;;echo '&money=';echo $money;;echo '" method="post" name="form" id="form" onsubmit="return chkForm(this);">
   <div style=\'padding-left:5px;padding-right:0px;padding-bottom:10px;width:300px;\'> 
	  <div class=\'items\' id=\'itembody\'>
	  <table width=290>
	     <tr height=30> 
		   <td colspan=2>';echo $show_value;;echo '</td>
		 </tr> 
		 <tr>
		   <td width=15%>备注：</td>
		   <td width=85%><input type=\'text\' id=\'bodys\' name=\'bodys\' style=\'height:40px;\'></td>
		 </tr>
	  </table> 
	  </div>
	  
   <script>var n_money=G(\'money\').innerHTML;G(\'money\').innerHTML=moneyFormatB(n_money) </script>
   </div>
   <div class=\'bottom2\'><input type=\'submit\' id=\'yes_button\' value=\'确定\'>　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
   <div style=\'display:none;\'>
     <input id=\'id\' name=\'id\' value=\'';echo $items;;echo '\'>
	 <input id=\'perid\' name=\'perid\' value=\'';echo $perid;;echo '\'>
	 <input id=\'itemname\' name=\'itemname\' value=\'';echo $itemname;;echo '\'>
	 <input id=\'itemtype\' name=\'itemtype\' value=\'';echo $itemtype;;echo '\'>
	 <input id=\'dbname\' name=\'dbname\' value=\'';echo $active;;echo '\'>
   </div>
</form> '
?>