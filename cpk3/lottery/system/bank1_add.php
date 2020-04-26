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

        $strSql="insert into system_bank_list(name) value ('$_POST[name]')";
        mysql_query($strSql);
        $id=mysql_insert_id();

        add_adminlog("添加提现银行:{$_POST['name']}");
    }
    if($id>0){

        foreach ($_POST as $key=> $value) {
            if($key!='id')
                mysql_query("update system_bank_list set `{$key}`='{$value}' where id='{$id}'");
        }
        add_adminlog("修改提现银行信息:{$_POST['name']}");
    }


    echo "保存成功<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
    echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
    exit;
}
mysql_query("set names utf8;");
$sql2="select * from system_bank_list where id='$id'";
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
<form action="';echo ROOT_URL."/".$AdminPath."/?controller=system&action=bank1_add&nextgo=save&id=".$id."&flag=yes";;echo '" method="post" name="form"  enctype="multipart/form-data" id="form">

	  <table width=100%  align=left  border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD">
	     <tr height=30 align=center bgcolor="#FFFFFF">
		   <td colspan=2><b>';echo $show_value;;echo '</b></td>
		 </tr>

		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>银行名称：</td>
		   <td align=left><input name="name" type="text" value="';echo $rows2[name];echo '" size="20" maxlength="20" /></td>
		 </tr>
	
		 	
		 <tr height=30 bgcolor="#FFFFFF">
		   <td align=right>银行标志：</td>
		   <td align=left><input name="logo" type="file" value="" size="30" maxlength="40" />';
if($rows2['logo']) echo "<a href='/{$rows2['logo']}' target='_blank'>查看</a>";

echo '</td>
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

 
</form> '
?>