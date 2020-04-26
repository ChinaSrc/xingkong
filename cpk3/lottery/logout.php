<?php

session_start();
ob_start();
include('config.php');
mysql_query("delete  from user_online where userid='{$_SESSION['adimin_id']}'");
$_SESSION['admin_group']='';
$_SESSION['adimin_id']='';
$_SESSION['adimin_name']='';
unset($_SESSION['adimin_id']);
unset($_SESSION['admin_group']);
unset($_SESSION['admin_name']);
$userid="";
setcookie("userid","");
setcookie("romanuser","");
session_destroy();
session_unset();
header("content-type:text/html; charset=utf-8");
header("refresh:0;url=login.aspx");
echo "已退出登陆！";
ob_end_flush();
exit;


?>