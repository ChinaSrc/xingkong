<?php
 
$users=($_SESSION['userlist']);
$id=$_GET['id'];
$dbname=$_GET['dbname'];
$nowtime=date("Y-m-d H:i:s",time());
$confirm=$_GET['confirm'];
$dialog=$_GET['dialog'];
if($dialog=="no"){

$strSql="delete from $dbname where id='$id'";
$db->query($strSql);
}
if($confirm==""){
require_once('admin_head.php');
echo "<div  style='font-size:14px;text-align:center;background:#FFFFFF;margin:10px;'>";
echo "   <div style='height:60px;line-height:40px;text-align:left;margin-left:20px;'>确定删除？</div>";
echo "   <div style='height:50px;font-size:12px;'>";
echo "   <span class='input_G' style='height:20px;line-height:20px;width:80px;padding:5px 10px;'><a class='mouse_show' href='".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&confirm=yes&dbname=".$dbname."&id=".$id."'>确定</a></span>";
echo "   <span class='input_G' style='height:20px;line-height:20px;width:80px;padding:5px 10px;'><a class='mouse_show' href='#' onclick='parent.pop.close()'>取消</a></span>";
echo "   </div>";
echo "   <div style='float:right'></div>";
echo "</div>";
}else{
mysql_query("set names utf8;");


$strSql="delete from $dbname where id='$id'";
$db->query($strSql);
if($arr_table[$dbname]){
	add_adminlog( "删除".$arr_table[$dbname]);
	
	
}
echo "<script type='text/javascript' src='/js/common.js'></script>";
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>已删除成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}

?>