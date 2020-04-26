<?php

require_once('../source/plugin/connect.php');
header("content-type:text/html; charset=utf-8");
$userid=$_SESSION['userid'];
$users=$_SESSION["userlist"];
$nextgo=$_GET[nextgo];
$id=$_GET[id];
if($id==""){$show_value="添加银行帐户信息";}else{$show_value="修改银行帐户信息";}
echo "<script type='text/javascript' src='/js/common.js'></script>";
if($nextgo=="save"){
$bankid=$_POST[bankid];
$bank_branch=$_POST[bank_branch];
$realname=$_POST[realname];
$banknum=$_POST[banknum];
if($bankid!=""){
mysql_query("set names utf8;");
$sql_bname="select bankName from system_bank_list where uid='$bankid'";
$result_bname=mysql_query($sql_bname);
$rows_bname=mysql_fetch_array($result_bname);
$bankname=$rows_bname[bankName];
}
if($id==""){
mysql_query("set names utf8;");
$strSql="insert into system_bank(bankid,bank_branch,realname,bankname,banknum) value ('$bankid','$bank_branch','$realname','$bankname','$banknum')";
mysql_query($strSql,$link) or die("插入时出错2".mysql_error());
}else{
mysql_query("set names utf8;");
$strSql="update system_bank set bankid='$bankid',bank_branch='$bank_branch',realname='$realname',bankname='$bankname',banknum='$banknum' where id='$id'";
$db->query($strSql);
}
echo "<script>alert('保存成功');setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit;
}
mysql_query("set names utf8;");
$sql2="select * from system_bank where id='$id'";
$result2=mysql_query($sql2);
$rows2=mysql_fetch_array($result2);
;echo '
<style>
body ,th,td{font:normal 12px 宋体;}
body{background:#FFFFFF; margin:0px; text-align:center;} 
.items{text-align:center;line-height:30px; margin:0px; padding-top:5px;overflow:auto;}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{height:40px;background:#444444;line-height:40px;padding:10px;}
</style>
<script>
function close_pop(){parent.pop.close();} 
function put_pop(action,nexts){
	if(document.getElementById(\'yes_button\')){
		document.getElementById(\'yes_button\').setAttribute(\'disabled\',true);
	}  
}
</script> 
<form action="bank_add.aspx?nextgo=save&id=';echo $id;;echo '" method="post" name="form" id="form">
   <div style=\'padding-bottom:10px;width:100%;\'> 
	  <div class=\'items\' id=\'itembody\'>
	  <table width=98% align=center  border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD">
	     <tr height=30 align=center bgcolor="#FFFFFF"> 
		   <td colspan=2><b>';echo $show_value;;echo '</b></td>
		 </tr>
		 <tr height=30 bgcolor="#FFFFFF"> 
		   <td width=25% align=right>银行名称：</td>
		   <td width=75%> <select name=\'bankid\' id=\'bankid\'>
           ';
mysql_query("set names utf8;");
$sql_ys="select bankname from system_bank where id!='$id'";
$result_ys=mysql_query($sql_ys);
while($rows_ys=mysql_fetch_array($result_ys)){
$is_have_bank.="#".$rows_ys[bankname];
}
mysql_query("set names utf8;");
$sql_bn="select uid,bankname from system_bank_list order by SortNum";
$result_bn=mysql_query($sql_bn);
while($rows_bn=mysql_fetch_array($result_bn)){
if(!strpos($is_have_bank,$rows_bn[bankname])){
echo "<option value='".$rows_bn[uid]."'>".$rows_bn[bankname]."</option>";
}
}
;echo '           </select><script>selectSetItem(G(\'bankid\'),\'';echo $rows2[bankid];;echo '\')</script>
		   </td>
		 </tr> 
		 <tr height=30 bgcolor="#FFFFFF"> 
		   <td align=right>开户支行：</td>
		   <td><input name="bank_branch" type="text" value="';echo $rows2[bank_branch];echo '" size="20" maxlength="20" /></td>
		 </tr> 
		 <tr height=30 bgcolor="#FFFFFF"> 
		   <td align=right>银行账户名：</td>
		   <td><input name="realname" type="text" value="';echo $rows2[realname];echo '" size="20" maxlength="20" /></td>
		 </tr>  
		 <tr height=30 bgcolor="#FFFFFF"> 
		   <td align=right>银行账号：</td>
		   <td><input name="banknum" type="text" value="';echo $rows2[banknum];echo '" size="30" maxlength="30" /></td>
		 </tr>
	  </table> 
	  </div>
   </div>
   <div class=\'bottom2\'><input type=\'submit\' id=\'yes_button\' value=\'确定\' onclick="Post_buy()">　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
   <div style=\'display:none;\'>
     <input id=\'id\' name=\'id\' value=\'';echo $items;;echo '\'>
	 <input id=\'perid\' name=\'perid\' value=\'';echo $perid;;echo '\'>
	 <input id=\'itemname\' name=\'itemname\' value=\'';echo $itemname;;echo '\'>
	 <input id=\'itemtype\' name=\'itemtype\' value=\'';echo $itemtype;;echo '\'>
	 <input id=\'dbname\' name=\'dbname\' value=\'';echo $active;;echo '\'>
   </div>
</form> '
?>