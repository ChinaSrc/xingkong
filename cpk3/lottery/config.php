<?php

session_start();
ob_start();
define('CLIENT_MULTI_RESULTS',131072);
date_default_timezone_set('PRC');
header("content-type:text/html; charset=utf-8");
$rootdir = dirname(__FILE__);

$rootdir=str_replace("\\","/",$rootdir);
$str_list=explode("/",$rootdir);

$AdminPath=$str_list[count($str_list)-1];
//$AdminPath=str_replace('/', "", $_SERVER['REQUEST_URI']);
$RootName=$str_list[count($str_list)-2];
define('ROOT_NAME',$RootName);
$root_dir=str_replace($AdminPath,"",$rootdir);
//$RootUrl="http://".$_SERVER['HTTP_HOST']."/".$RootName;
$RootUrl="http://".$_SERVER['HTTP_HOST'];
define('ROOT_URL',$RootUrl);
define('ROOT_PATH',$root_dir);
include("../source/config/db.inc.php");
include("../source/function/run.php");
require_once '../source/function/class.mysql.php';
$db = new chency_mysql;
$db->connect(DB_HOST, DB_USER, DB_PASS, DB_DATA, DB_CHARSET, DB_PCONNECT, true);

$Counts="1";
$Domain=$_SERVER['HTTP_HOST'];
$IpAddress=gethostbyname($_SERVER["SERVER_NAME"]);
$SearchTimeBegin="06:00";
$SearchTimeEnd="06:00";
$ModeType="aotu";


?>