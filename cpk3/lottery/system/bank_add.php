<?php

$nextgo=$_GET[nextgo];
$id=$_GET[id];
if($id==""){$show_value="添加银行帐户信息";}else{$show_value="修改银行帐户信息";}
echo "<script type='text/javascript' src='/js/common.js'></script>";
if($nextgo=="save"){

	if(count($_FILES)>0){

	include_once '../source/function/Image.php';
	$img=new Image();
	$path="uploads/system/";
	foreach ($_FILES as $key=>$value) {
		if($file=$img->up_image($_FILES[$key], "../".$path)){
		$_POST[$key]=$ico=$path.$file;

	}
	}
	}


if($id==""){
mysql_query("set names utf8;");
$strSql="insert into system_bank(bankname) value ('$_POST[bankname]')";
mysql_query($strSql);
$id=mysql_insert_id();

add_adminlog("添加银行账户:{$_POST['bankname']}");
}
if($id>0){

	foreach ($_POST as $key=> $value) {
		if($key!='id')
		mysql_query("update system_bank set `{$key}`='{$value}' where id='{$id}'");
	}
	add_adminlog("修改银行账户信息:{$_POST['bankname']}");
}


echo "保存成功<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
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
<form action="';echo ROOT_URL."/".$AdminPath."/?controller=system&action=bank_add&nextgo=save&id=".$id."&flag=yes";;echo '" method="post" name="form"  enctype="multipart/form-data" id="form">

	  <table width=100%  align=left  border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD">
	     <tr height=30 align=center bgcolor="#FFFFFF">
		   <td colspan=2><b>';echo $show_value;;echo '</b></td>
		 </tr>
		 <tr height=30 bgcolor="#FFFFFF">
		   <td width=25% align=right>银行名称：</td>
		   <td width=75% align=left> <select name=\'bankname\' id=\'bankname\'>
           ';

foreach ($bank_arr as $value) {
	echo "<option value='".$value."'>".$value."</option>";
}


;echo '           </select><script>selectSetItem(G(\'bankname\'),\'';echo $rows2[bankname];;echo '\')</script>
		   </td>
		 </tr>
		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>支付名称：</td>
		   <td align=left><input name="bank_branch" type="text" value="';echo $rows2[bank_branch];echo '" size="20" maxlength="20" /></td>
		 </tr>
		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>银行账户名：</td>
		   <td align=left><input name="realname" type="text" value="';echo $rows2[realname];echo '" size="20" maxlength="20" /></td>
		 </tr>
		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>银行账号：</td>
		   <td align=left><input name="banknum" type="text" value="';echo $rows2[banknum];echo '" size="30" maxlength="40" /></td>
		 </tr>

	

		 		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>汇款二维码：</td>
		   <td align=left><input name="ico" type="file" value="" size="30" maxlength="40" />';
if($rows2['ico']) echo "<a href='../{$rows2['ico']}'  target='_blank'>查看</a>";

echo '</td>
		 </tr>
		 	
		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>银行标志：</td>
		   <td align=left><input name="logo" type="file" value="" size="30" maxlength="40" />';
if($rows2['logo']) echo "<a href='/{$rows2['logo']}' target='_blank'>查看</a>";

echo '</td>
		 </tr>

		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>最低金额：</td>
		   <td align=left><input name="min" type="text" value="';echo $rows2[min];echo '" size="30" maxlength="40" />元</td>
		 </tr>
		  <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>最高金额：</td>
		   <td align=left><input name="max" type="text" value="';echo $rows2[max];echo '" size="30" maxlength="40" />元</td>
		 </tr>
		 
		
	  <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>充值提示：</td>
		   <td align=left>
		   
		   <textarea name="tips" style="width: 100%;height:80px;">';echo $rows2['tips'];echo '</textarea>
</td>
		 </tr>
		 
		 		 
		 	  <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>显示顺序：</td>
		   <td align=left><input name="sortnum" type="text" value="';echo $rows2[sortnum];echo '" size="30" maxlength="40" />（越小越靠前）</td>
		 </tr>
	
		 
		 
			   	 <tr height=30 bgcolor="#FFFFFF">
		   <td width=25% align=right>状态：</td>
		   <td width=75% align=left> <select name=\'status\' id=\'status11\'>
      <option value="1">启用</option> <option value="0">关闭</option>
		   </select><script>selectSetItem(G(\'status11\'),\'';echo $rows2[status];;echo '\')</script>
		   </td>
		 </tr>
		 <tr height=30 class=\'bottom2\'  bgcolor="#FFFFFF">
		   <td align=center colspan=2>
		      <div><input type=\'submit\' id=\'yes_button\' value=\'确定\' onclick="Post_buy()">　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
		   </td>
		 </tr>
	  </table>

   <div style=\'display:none;\'>
     <input id=\'id\' name=\'id\' value=\'';echo $items;;echo '\'>
	 <input id=\'perid\' name=\'perid\' value=\'';echo $perid;;echo '\'>
	 <input id=\'itemname\' name=\'itemname\' value=\'';echo $itemname;;echo '\'>
	 <input id=\'itemtype\' name=\'itemtype\' value=\'';echo $itemtype;;echo '\'>
	 <input id=\'dbname\' name=\'dbname\' value=\'';echo $active;;echo '\'>
   </div>
</form> '
?>