<?php

header("content-type:text/html; charset=utf-8");
require_once('../source/plugin/connect.php');
$dbname=$_POST['dbname'];
$id=$_POST['id'];
$item=$_POST['item'];
$values=$_POST['values'];
$active=$_POST['active'];
$uid=$_POST['uid'];
$playkey=$_POST['playkey'];
$nowtime=date("Y-m-d H:i:s",time());
if($dbname==""or $id==""or $values==""or $item==""or $active==""or $uid==""){
$flag="no";
}else{
if($active=="insert"){
mysql_query("set names utf8;");
$strSql="insert into $dbname(userid,playkey,ckey,modes,number) values ('$uid','$playkey','$id','$item','$values')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
}
if($active=="update"){
mysql_query("set names utf8;");
$strSql="update $dbname set number='$values' where userid='$uid' and ckey='$id' and playkey='$playkey' and modes='$item'";
$db->query($strSql);
}$flag="yes";
}
echo $flag;
exit;

?>