<?php

if(!defined('IN_PHPOE')) {
exit('Access Denied');
}
class lib_admin{
public $uc_adminname = NULL;
public $uc_password  = NULL;
public $uc_groupid   = 0;
public $uc_groupname = NULL;
public $uc_super     = 0;
public $uc_auths     = NULL;
function login($username,$password,$ajax=0){
global $db;
$username = Core_Fun::replacebadchar($username);
$password = Core_Fun::replacebadchar($password);
$md5password = md5($password);
$sql  = "SELECT a.*,g.groupname,g.auths".
" FROM ".DB_PREFIX."admin AS a".
" LEFT JOIN ".DB_PREFIX."authgroup AS g ON a.groupid=g.groupid".
" WHERE lower(a.adminname)='".strtolower($username)."' AND a.password='$md5password'";
$rows = $db->fetch_first($sql);
if($rows){
if($rows['flag']==0){
Core_Fun::halt("对不起，该帐号被禁止！","login.aspx",4);
}else{
$this->uc_adminname = $username;
$this->uc_password  = $md5password;
Core_Fun::set_cookie(PHPOE_COOKIENAME."_ADMINNAME",$username,10);
Core_Fun::set_cookie(PHPOE_COOKIENAME."_ADMINPASSWORD",$md5password,10);
$array  = array(
'logintimeline'=>time(),
'logintimes'=>'[[logintimes+1]]',
'loginip'=>Core_Fun::getip(),
);
$db->update(DB_PREFIX."admin",$array,"adminname='$username'");
Core_Command::runlog($username,"登录后台成功.",1);
if($ajax==1){
return true;
}else{
$this->loginsuccess();
}
}
}else{
Core_Command::runlog($username,"登录后台失败.",1);
if($ajax==1){
return false;
}else{
Core_Fun::halt("对不起，帐号或者密码不正确！","login.aspx",4);
}
}
}
function checklogin(){
$this->uc_adminname = Core_Fun::get_cookie(PHPOE_COOKIENAME."_ADMINNAME");
$this->uc_password  = Core_Fun::get_cookie(PHPOE_COOKIENAME."_ADMINPASSWORD");
if(!Core_Fun::check_userstr($this->uc_adminname) OR strlen($this->uc_password)!=32){
Core_Fun::halt("对不起，帐号或者密码错误！","login.aspx",4);
}
if(!Core_Fun::ischar($this->uc_adminname) ||!Core_Fun::ischar($this->uc_password)){
Core_Fun::halt("对不起，登录失败。","login.aspx",4);
}else{
global $db;
$sql  = "SELECT a.adminid,a.super,a.groupid,g.groupname,g.auths".
" FROM ".DB_PREFIX."admin AS a".
" LEFT JOIN ".DB_PREFIX."authgroup AS g ON a.groupid=g.groupid".
" WHERE lower(a.adminname)='".strtolower($this->uc_adminname)."' AND a.password='$this->uc_password'".
" AND a.flag=1";
$rows = $db->fetch_first($sql);
if($rows){
$this->uc_groupid	= $rows['groupid'];
$this->uc_groupname = $rows['groupname'];
$this->uc_super		= $rows['super'];
$this->uc_auths		= $rows['auths'];
}else{
Core_Fun::halt("对不起，帐号不存在，或登录超时！","login.aspx",4);
}
}
}
function logout(){
Core_Command::runlog(Core_Fun::get_cookie(PHPOE_COOKIENAME."_ADMINNAME"),"注销退出后台管理.",1);
Core_Fun::set_cookie(PHPOE_COOKIENAME."_ADMINNAME","",0);
Core_Fun::set_cookie(PHPOE_COOKIENAME."_ADMINPASSWORD","",0);
Core_Fun::halt("退出成功","login.aspx",0);
}
function copyright(){
echo("<div align='center'><font color='#999999'>Powered by <a href='".SZS_URL."' target=_blank>".SZS_VERSION."</a> &copy;2006-2011 <a href='".SZS_URL."' target='_blank'>www.aspxcoo.com</a></font></div>");
}
function checklience($type=1){
$domain  = $_SERVER['HTTP_HOST'];
$serveip = gethostbyname($_SERVER["SERVER_NAME"]);
$version = OECMS_VERSION;
$userip  = Core_Fun::getip();
$key     = md5($domain.aspxOE_KEY);
$softkey = $GLOBALS['config']['softkey'];
$url     = OECMS_LICENCE."?domain=".urlencode($domain)."&serveip=".urlencode($serveip)."&version=".urlencode($version)."&userip=".urlencode($userip)."&type=$type&key=".$key."&r=".time()."&softkey=$softkey";
$re = trim(Core_Fun::get_filecontent($url));
if(!Core_Fun::isnumber($re)){
$re = 0;
}else{
if(intval($re)!=1){
$re = 0;
}
}
return $re;
$GLOBALS['db']->query("UPDATE ".DB_PREFIX."config SET licestatus=$re");
}
function lience($type=2){
$domain  = $_SERVER['HTTP_HOST'];
$serveip = gethostbyname($_SERVER["SERVER_NAME"]);
$version = OECMS_VERSION;
$userip  = Core_Fun::getip();
$key     = md5($domain.aspxOE_KEY);
$softkey = $GLOBALS['config']['softkey'];
if($type==2){
$url = OECMS_LICENCE."?domain=".urlencode($domain)."&serveip=".urlencode($serveip)."&version=".urlencode($version)."&userip=".urlencode($userip)."&type=$type&key=".$key."&r=".time()."&softkey=$softkey";
}else{
$url = OECMS_LICENCE."?domain=".urlencode($domain)."&type=1";
}
return $url;
}
function loginsuccess(){
$msg  = "登录成功，正在跳转后台管理中心<script language='javascript' src=\"".$this->lience(2)."\"></script>";
Core_Fun::halt($msg,"admincp.aspx",0);
}
function checkauth($auth){
if((int)$this->uc_super==1){
}else{
if(!Core_Fun::ischar($this->uc_auths)){
Core_Fun::halt("对不起，你没有执行&nbsp;[".$GLOBALS['AuthVars'][$auth]."]&nbsp;操作权限！","",2);
die();
}else{
if(!Core_Fun::foundinarr(strtolower($this->uc_auths),strtolower($auth),",")){
Core_Fun::halt("对不起，你没有执行&nbsp;[".$GLOBALS['AuthVars'][$auth]."]&nbsp;操作权限！","",2);
die();
}
}
}
}
}

?>