<?php

include('config.php');
include(ROOT_PATH.'/source/plugin/function.php');
$userid=$_SESSION['userid'];
$controller=$_GET['controller'];
$action=$_GET['action'];
$threes=$_GET['threes'];
$paras=$_GET['paras'];
$items=$_GET['items'];
$flag=$_GET['flag'];
$leftnavi=$_GET['leftnavi'];
$playkey=$_GET['playkey'];
$perid=$_GET['perid'];
$mode=$_GET['mode'];
if($perid==""){$perid=$userid;}
$path_URL=ROOT_URL."/".$AdminPath;
if($controller==""or $controller=="default"){$path=ROOT_PATH."/".$AdminPath."/";}else{$path=ROOT_PATH."/".$AdminPath."/".$controller."/";}
if($threes!=""){$path.=$threes."/";}
if($action=="default"){$files="index.aspx";}else{$files=$action.".aspx";}
$filepath=$path.$files;
if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
$thisURL=ROOT_URL."/".$AdminPath."/do.aspx?controller=".$controller."&action=".$action;
if($_SESSION['userid'] and $files!="login.aspx"){
include(ROOT_PATH."/".$AdminPath."/admin_head.php");
}else{
$filepath=ROOT_PATH."/admin_login.aspx";
}
ECHO $filepath;
$body_class="";$body_bottom_div="";
echo "<BODY><div class='".$body_class."'><input value='".$thisURL."' id='thisURL' style='display:none'><input value='".ROOT_URL."' id='rootURL' style='display:none'><input value='".$AdminPath."' id='pathName' style='display:none'></div>";
include($filepath);
echo "".$body_bottom_div."</BODY>";
mysql_close();
;echo ' ';
?>