<?php
session_start();
header("content-type:text/html; charset=utf-8");
$mod = isset($_GET['mod']) ? $_GET['mod'] : "";
$path_type='index';
require_once 'source/function/run.php';
$redis = new Redis();
$redis->connect(REDIS_HOST, REDIS_PORT);
foreach ($_GET as $key=>$value){
     $new_value=Core_Fun::isokchar($value);
	 $_GET[$key]=$new_value;
}
foreach ($_POST as $key=>$value){
     $new_value=Core_Fun::isokchar($value);
	 $_GET[$key]=$new_value;
}
/* 指定允许访问的模块 */
/*$allowmod = array('list','detail');
if(!in_array($modd,$allowmod)) {
	Core_Fun::halt("对不起，不存在“mod=".$modd."”模块，请检查！","",1);
}*/
/* 判断是否存在文件 */


define('ALLOWGUEST',true);
//if($_SESSION['userid']){
	
	$loginarr = array('login_buy','login_yingkui','login_index','login_info','login_url');
	if (in_array($modd, $loginarr)) {
		$modd = 'login';
	}

	$tplfile = INDEX_TEMPLATE.$modd.".".$tplext;
	$widgetfile = "./source/controller/".$modd.".php";
//}
if(!Core_Fun::fileexists($tplfile)){
	Core_Fun::halt("对不起，模板文件“".$tplfile."”不存在，请检查！","",4);
}
if(!Core_Fun::fileexists($widgetfile)){
	Core_Fun::halt("对不起，部件文件“".$widgetfile."”不存在，请检查！","",0);
}
//echo INDEX_TEMPLATE;
/* 缓存,模板处理 */
if($config['cachstatus']==1){
	$cache_seconds = $config['cachtime']*1;
	$tpl->setCaching(true);
	$tpl->setCacheLifetime($cache_seconds);
}
$cacheid = md5($_SERVER["REQUEST_URI"]);
if(!$tpl->isCached($tplfile,$cacheid)){
	require_once './source/function/function.php';
	require_once './source/module/app.php';
	require_once './source/controller/navi.php';
	require_once './source/controller/'.$modd.'.php';
}
$bul_party=SZS_ROOT_PATH."source/config/play/bul_party.aspx";
if (file_exists($bul_party)){
	include($bul_party);
	$tpl->assign("bul_arr_party",$bul_arr_party);
}
$tpl->assign("skinpath",INDEX_TEMPLATE);
$tpl->assign("mod",$mod);
$tpl->assign('file_uri', FILE_URI);
$tpl->assign("runtime",Core_Fun::runtime());
$tpl->display($tplfile,$cacheid);
$redis->close();
$db->close();
?>
