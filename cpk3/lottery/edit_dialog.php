<?php
 
$nextgo=$_GET[nextgo];
$id=$_GET[id];
$active=$_GET[active];
$doto=$_GET[doto];
$cate=$_GET[cate];
$keys=$_GET[keys];
$pername=$_GET[pername];
$perid=$_GET[perid];
$uid=$_GET[uid];
$money=$_GET[money];
$nowtime=date("Y-m-d H:i:s",time());
include(ROOT_PATH."/source/function/run.php");
if($doto=="edit"){
if($keys=="agree"){$title="同意";$is_edit="";}if($keys=="refuse"){$title="拒绝";$is_edit="disabled";}
if($active=="gifts"){
$sql_system="SELECT modes_gifts_money FROM system";
$result_system=mysql_query($sql_system);
$rows_system=mysql_fetch_array($result_system);
$modes_gifts_money=$rows_system[modes_gifts_money];
$user_gifts=explode("|",$modes_gifts_money);
$user_gifts_new=$user_gifts[0];
$user_gifts_old=$user_gifts[1];
$user_gifts_rec=$user_gifts[2];
if($user_gifts_old==""){$user_gifts_old=$user_gifts_new;}
if($user_gifts_rec==""){$user_gifts_rec=$user_gifts_new;}
if($cate=="new"){$gifts_money=$user_gifts_new;}
if($cate=="old"){$gifts_money=$user_gifts_old;}
if($cate=="recharge"){$gifts_money=$user_gifts_rec;}
$show_value=$title." ".$pername." 的领取购彩金请求？";
$item_title="购彩金：";
$item_body="<tr ".$is_edit." bgcolor='#FFFFFF' height=22><td width=35% align=right>&nbsp;购彩金额：</td><td width=65%>&nbsp;<input type='text' id='itemvalue' name='itemvalue' size=5 value='".$gifts_money."'>&nbsp;元</td></tr>";
}
}
if($nextgo=="save"){
$itemvalue=$_POST[itemvalue];echo $bodys;
echo "<script type='text/javascript' src='".ROOT_URL."/js/common.js'></script>";
mysql_query("set names utf8;");
$sql_funds="select * from user_gifts where id='$uid' and status='0'";
$result_funds=mysql_query($sql_funds);
$num_funds=mysql_num_rows($result_funds);
if($keys=="refuse"){
if($num_funds){
$row_funds=mysql_fetch_array($result_funds);
$content="您[".$row_funds['creatdate']."]提交的申领购彩金已被拒绝!";
$re_title="已拒绝成功";
$strSql="update user_gifts set status='4',giftsDate='$nowtime' where id='$uid' and status='0'";
$db->query($strSql);
$bankid=getsql::Addmsg($row_funds['userid'],$content);
}else{
$re_title="未找到或已处理过";
}
}
if($keys=="agree"){
if($active=="gifts"){
$sql_funds="select * from user_gifts where id='$uid' and status='0'";
$result_funds=mysql_query($sql_funds);
$num_funds=mysql_num_rows($result_funds);
if($num_funds){
$strSqls="update user_bank set hig_amount=IFNULL(hig_amount,0)+'$itemvalue' where userid='$perid'";
mysql_query($strSqls,$link) or die("插入时出错1".mysql_error());
if($itemvalue==""){$itemvalue="平台充值";}
$bankid=getsql::banklog($itemvalue,"Recharge_to_system",$perid,"",$floatid,$gamekey,$modes);
$re_title="已处理成功";
$row_funds=mysql_fetch_array($result_funds);
$content="您[".$row_funds['creatdate']."]提交的申领购彩金已处理!";
$addmsgs=getsql::Addmsg($row_funds['userid'],$content);
}else{
$re_title="未找到或已处理过";
}
}
$strSql="update user_gifts set status='1',giftsDate='$nowtime' where id='$uid' and status='0'";
$db->query($strSql);
}
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>".$re_title."</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit;
}
;echo '<script language="javascript" type="text/javascript" src="../js/common.js"></script>
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
</script> 
<form action="';echo ROOT_URL."/".$AdminPath;;echo '/?controller=&action=edit_dialog&nextgo=save&active=';echo $active;;echo '&keys=';echo $keys;;echo '&pername=';echo $pername;;echo '&perid=';echo $perid;;echo '&uid=';echo $uid;;echo '&money=';echo $money;;echo '" method="post" name="form" id="form">
   <div style=\'padding-left:0px;padding-right:0px;padding-bottom:10px;width:300px;\'> 
	  <div class=\'items\' id=\'itembody\'>
	  <table width=290 border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD">
	     <tr height=25 bgcolor=\'#FFFFFF\'> 
		   <td colspan=2 align=center>&nbsp;<b>';echo $show_value;;echo '</b></td>
		 </tr> 
		 ';echo $item_body;;echo ' 
	  </table> 
	  </div>
	  
   <script>var n_money=G(\'money\').innerHTML;G(\'money\').innerHTML=moneyFormatB(n_money) </script>
   </div>
   <div class=\'bottom2\'><input type=\'submit\' id=\'yes_button\' value=\'确定\' onclick="Post_buy()" ';echo $yes_button;;echo '>　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
   <div style=\'display:none;\'>
     <input id=\'id\' name=\'id\' value=\'';echo $items;;echo '\'>
	 <input id=\'perid\' name=\'perid\' value=\'';echo $perid;;echo '\'>
	 <input id=\'itemname\' name=\'itemname\' value=\'';echo $itemname;;echo '\'>
	 <input id=\'itemtype\' name=\'itemtype\' value=\'';echo $itemtype;;echo '\'>
	 <input id=\'dbname\' name=\'dbname\' value=\'';echo $active;;echo '\'>
   </div>
</form> ';
?>