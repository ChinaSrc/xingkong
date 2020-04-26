<?php

header("content-type:text/html; charset=utf-8");
require_once('../source/plugin/connect.php');
$pername = $_POST['username'];
if($pername){
mysql_query("set names utf8;");
$sqls="select userid from user where username='$pername'";
$results=mysql_query($sqls);
$rowss=mysql_fetch_array($results);
if($rowss){
$flag=0;
}else{
$flag=1;
}
}else{
$flag=1;
}
echo $flag;

?>