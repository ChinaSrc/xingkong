<?php

session_start();
$no_task=1;
header("content-type:text/html; charset=utf-8");
$mod = isset($_GET['mod']) ?$_GET['mod'] : "index";
if(empty($mod)){
$mod = "index";
}
$modd = $mod;
$code = isset($_GET['code']) ?$_GET['code'] : "";
if(!empty($code)){
$modd .= "_".$code;
}
$list = isset($_GET['list']) ?$_GET['list'] : "";
if(!empty($list)){
$modd .= "_".$list;
}
$flag = isset($_GET['flag']) ?$_GET['flag'] : "";
if($flag=="yes"){$f_path="module";}else{$f_path="controller";}
define('ALLOWGUEST',true);

require_once 'source/function/run.php';

$widgetfile = "./source/".$f_path."/".$modd.".php";
if(!Core_Fun::fileexists($widgetfile)){
}
foreach ($_GET as $key=>$value){
$new_value=Core_Fun::isokchar($value);
$_GET[$key]=$new_value;
}
foreach ($_POST as $key=>$value){
$new_value=Core_Fun::isokchar($value);
$_GET[$key]=$new_value;
}
$db = new chency_mysql;
$db->connect(DB_HOST,DB_USER,DB_PASS,DB_DATA,DB_CHARSET,DB_PCONNECT,true);


$redis = new Redis();
$redis->connect(REDIS_HOST, REDIS_PORT);

require_once './source/function/function.php';
require_once './source/module/app.php';
require_once './source/'.$f_path.'/'.$modd.'.php';
$db->close();
$redis->close();
;echo ' ';
?>