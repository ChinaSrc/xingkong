<?php

if(!defined('IN_PHPOE')) {
	exit('Access Denied');
}
if (!file_exists(CHENCY_ROOT . 'data/cache')){
	@mkdir(CHENCY_ROOT . 'data/cache', 0777);
	@chmod(CHENCY_ROOT . 'data/cache', 0777);
}
if (!file_exists(CHENCY_ROOT . 'data/compile')){
	@mkdir(CHENCY_ROOT . 'data/compile', 0777);
	@chmod(CHENCY_ROOT . 'data/compile', 0777);
}
clearstatcache();
require_once CHENCY_ROOT.'./source/function/tpl.class.php';
$tpl = new Smarty;
$tpl->setTemplateDir(CHENCY_ROOT);
$tpl->setCacheDir(CHENCY_ROOT . 'data/cache');
$tpl->setCompileDir(CHENCY_ROOT . 'data/compile');
$tpl->left_delimiter = "<!--{";
$tpl->right_delimiter = "}-->";
$tpl->setCaching(false); 
//$tpl->setCacheLifetime(120); 
$tpl->allow_php_tag = true;
$tpl->allow_php_templates = true;
$tpl->compile_check = true;
$tpl->force_compile = false;
$tpl->debugging = false;
?>