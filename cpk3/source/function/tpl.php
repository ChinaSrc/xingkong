<?php
/**
 * @CopyRight  (C)2006-2011 OE Development team Inc.
 * @WebSite    www.aspxcoo.com，www.oecms.cn
 * @Author     XiangFeng <phpzac@foxmail.com>
 * @Brief      OEcms v3.x
 * @Update     2011.09.01
**/
if(!defined('IN_PHPOE')) {
	exit('Access Denied');
}
/*
$config		= array();
$config_sql = "SELECT * FROM ".DB_PREFIX."system_config LIMIT 1";
$config     = $db->fetch_first($config_sql);
if(!$config){
	echo "Config Error！";
	die();
}
*/
$tplext = "tpl";
/*
$core_skin_sql  = "SELECT skinid,skindir,skinext FROM ".DB_PREFIX."system_skin WHERE flag=1 ORDER BY orders ASC LIMIT 1";
$core_skin      = $db->fetch_first($core_skin_sql);*/
$core_skin=$con_system['skin'];

if($core_skin){
	$index_tempdir = "tpl/".$core_skin."/";
	define('DEFAULT_TEMPLATE',$index_tempdir);
	define('INDEX_TEMPLATE',$index_tempdir);
}else{
	define('INDEX_TEMPLATE',DEFAULT_TEMPLATE);
}
$urlsuffix = "php";
if($config['htmltype']=="html" || $config['htmltype']=="rewrite"){
	$urlsuffix = "html";
}
set_sql();
$tpl->assign("config",$config);
$tpl->assign("urlsuffix",$urlsuffix);
$tpl->assign("tplext",$tplext);
$tpl->assign("urltype",$config['htmltype']);

//$tpl->assign("skinpath",PATH_URL.INDEX_TEMPLATE);
$tpl->assign("urlpath",PATH_URL);
$tpl->assign("tplpath",INDEX_TEMPLATE);

?>