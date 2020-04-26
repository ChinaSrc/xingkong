<?php
 
$users=($_SESSION['userlist']);
$id=$_GET['id'];
$dbname=$_GET['dbname'];
$nowtime=date("Y-m-d H:i:s",time());
$confirm=$_GET['confirm'];
$dialog=$_GET['dialog'];



mysql_query("set names utf8;");
$strSql="delete from $dbname where id in($_GET[id])";
mysql_query($strSql);
if(mysql_affected_rows()>0){
	echo "<script>alert('删除成功');</script>";

	
}
else{
	
	
	echo "<script>alert('删除失败');</script>";


}
echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
?>
