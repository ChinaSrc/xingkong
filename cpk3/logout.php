<?php
require_once 'source/function/run.php';
session_start();
ob_start();
unset($_SESSION['userid']);
unset($_SESSION['romsex']);
unset($_SESSION['nickname']);
$_SESSION['notice'] ='';
$_SESSION['msg_session'] ='';
$userid="";
setcookie("userid","");
setcookie("romanuser","");
setcookie("UserMoney","");
setcookie("hig_amount","");
setcookie("low_amount","");
$_SESSION["userlist"]="";
setcookie("romanuser","");
setcookie("username","");
$_SESSION["sys_infor"]="";

@session_destroy();
@session_unset();
show_message('您已经成功退出','index_home.html')
?>