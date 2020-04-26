<?php
// if($_GET['no_task']) $no_task=$_GET['no_task'];
$path_type='admin';
include('config.php');
$controller=$_GET['controller'];
$action=$_GET['action'];
$threes=$_GET['threes'];
$paras=$_GET['paras'];
$items=$_GET['items'];
$flag=$_GET['flag'];
$pages=$_GET['pages'];
$leftnavi=$_GET['leftnavi'];
$path_URL=ROOT_URL."/".$AdminPath;
//define('CACHE_PATH', ROOT_PATH .'cache');
//echo CACHE_PATH;
$sys=getsql::sys();

if($sys['admin_url']) {
    $urls=explode('|',$sys['admin_url']);

    if(!in_array($_SERVER['HTTP_HOST'],$urls)){
        exit();

    }
}


if (!$pages or $pages==0){$pages=1;}
$pagesize=$maxnum=$con_system['admin_pagenum'];
$starnum=$pages*$maxnum-$maxnum;


if($flag=="yes"){
if($controller=="do"and $action!="GetPopup"){
}
if($controller==""){$path=ROOT_PATH."/".$AdminPath."/";}else{$path=ROOT_PATH."/".$AdminPath."/".$controller."/";}
if($action==""){$files="save.php";}else{$files=$action.".php";}
$filepath=$path.$files;

include($filepath);
exit;
}else{
echo "<script> var ROOT_URL='".ROOT_URL."';var ROOT_PATH='".ROOT_PATH."';var AdminPath='".$AdminPath."';var RootName='".$RootName."'; </script>";
if($controller==""or $controller=="default"){
$path=ROOT_PATH."/".$AdminPath."/";
}else{
$path=ROOT_PATH."/".$AdminPath."/".$controller."/";
}
if($threes!=""){$path.=$threes."/";}
if($action==""){
$files="main.aspx";
}else{
if($action=="default"){$files="index.aspx";}else{$files=$action.".aspx";}
}
$filepath=$path.$files;
if($_SESSION['admin_id']>0){

    $online=$db->exec("select * from user_online where userid='{$_SESSION['admin_id']}'  and `session`='{$_SESSION['auth']}'");
    if($online){
        login_online($_SESSION['admin_id']);

    }
    //echo "select * from user_online where userid='{$_SESSION['admin_id']}'  and `session`='{$_SESSION['auth']}'";
//print_r($online);
}
    $system=getsql::sys();

if ($_SESSION['admin_group']<1  || !$online){
echo "<div style='font-size:14px;text-align:center;height:100px;'><font style='font-color:#777777;'>您还没有登录</font></div>";
	echo "<script>top.location.href='login.aspx';</script>";	

	echo "<script>parent.window.location='login.aspx';</script>";	
echo "<script>window.location.href='./login.aspx'</script>";exit;
}else{
if($files=="main.aspx"){
include('main.php');exit;
}else{
include(ROOT_PATH."/".$AdminPath."/admin_head.php");
}
}
}
$thispath=ROOT_URL."/".$AdminPath."/?controller=".$controller."&action=".$action;
if ($controller=="default"and $action=="login"){
echo "<div style='font-size:14px;text-align:center;height:100px;'><font style='font-color:#777777;'>您还没有登录</font></div>";
echo "<script>window.location.href='".ROOT_URL."/".$AdminPath."login.aspx'</script>";
}
echo "<BODY><div  style='display:none'><input value='".$thispath."' id='thisURL' style='display:none'><input value='".ROOT_URL."' id='rootURL' style='display:none'><input value='".$AdminPath."' id='pathName' style='display:none'></div>";


include(str_replace('.aspx', '.php', $filepath));
;echo '<script type="text/javascript"> 
function Dialog_Return_s(){ 
	parentDialog.innerFrame.contentWindow.document.getElementById(\'showdiv\').innerHTML="操作成功"; 
	var controller=parentDialog.innerFrame.contentWindow.document.getElementById(\'controller\').value;
	var action=parentDialog.innerFrame.contentWindow.document.getElementById(\'action\').value;
	var paras=parentDialog.innerFrame.contentWindow.document.getElementById(\'paras\').value;
	var lastUrl=parent.window.top.frames[\'mainframe\'].document.getElementById(\'rootURL\').value+\'/highgame/do.aspx?controller=\'+controller+\'&action=\'+action+\'&paras=\'+paras;
	 
	setTimeout("DialogBackUrl(\'"+lastUrl+"\')",600);  
}
function DialogBackUrl(gotoUrl){
	parent.window.top.frames[\'mainframe\'].document.location.href=gotoUrl;
	parentDialog.close(); 
}
</script> '
?>