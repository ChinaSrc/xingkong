<?php

set_time_limit(0);
error_reporting(E_ALL & ~ E_NOTICE);
header("content-type:text/html; charset=utf-8");
//error_reporting(E_ERROR);

 if(strpos($_SERVER['REQUEST_URI'], '.php')!==false  || strpos($_SERVER['REQUEST_URI'], 'com/?')!==false){
 echo file_get_contents('http://'.$_SERVER["HTTP_HOST"].'/404.html');

//echo "<script>window.location='/404.html';</script>";

 exit();
 }


if(PHP_VERSION<"5.3"){
    set_magic_quotes_runtime(0);
}





$chency_mic_time  = explode(' ', microtime());
$chency_starttime = $chency_mic_time[1] + $chency_mic_time[0];
define('SYS_DEBUG', FALSE);
define('IN_PHPOE', TRUE);
define('CHENCY_ROOT', substr(dirname(__FILE__), 0, -15));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
define('PHPOE_KEY','P1H2P3O4E5C6O7O8TM');

if(PHP_VERSION < '4.1.0') {
	$_GET     = &$HTTP_GET_VARS;
	$_POST    = &$HTTP_POST_VARS;
	$_COOKIE  = &$HTTP_COOKIE_VARS;
	$_SERVER  = &$HTTP_SERVER_VARS;
	$_ENV     = &$HTTP_ENV_VARS;
	$_FILES   = &$HTTP_POST_FILES;
}
require_once CHENCY_ROOT.'./source/function/class.timer.php';
Core_Timer::start(); // echo Core_Timer::start();
require_once CHENCY_ROOT.'./source/config/db.inc.php';


require_once 'core.func.php';
require_once 'page.php';



if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])){
	exit('Request tainting attempted.');
}
foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		//$_key{0} != '_' && $$_key = stripslashes($_value);
	}
}
require_once 'class.mysql.php';
$db = new chency_mysql;
$db->connect(DB_HOST, DB_USER, DB_PASS, DB_DATA, DB_CHARSET, DB_PCONNECT, true);

require_once 'core_multi.php';
require_once 'core.mod.php';
require_once 'active.php';
require_once 'function.php';
$config=$con_system=getsql::sys();
require_once CHENCY_ROOT.'./source/config/config.inc.php';
require_once 'tpl.config.php';
require_once 'tpl.php';

//$now=date('Y-m-d H:i:s');
//$ip=getIP();
//$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//$db->query("insert into vister(time,url,ip) values('{$now}','{$url}','{$ip}')");

	if($_SESSION['userid']  ){


	    $linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
		$online=$db->fetch_first("select * from user_online where userid='{$_SESSION['userid']}' and uptime>'{$linetime}' and `session`='{$_SESSION['auth']}' ");
		if($online){
            login_online($_SESSION['userid']);

		}else{
			$mod="login";
			$_SESSION['userid']='';
			//$db->query("delete  from user_online where userid='{$_SESSION['userid']}'  and `session`='{$_SESSION['auth']}'");
		}


		if($db->exec("select * from wage where uid='{$_SESSION['userid']}'")) $tpl->assign('user_wage',1);
		if($db->exec("select * from fenhong where uid='{$_SESSION['userid']}'")) $tpl->assign('user_fenhong',1);
		if($_SESSION['user_name']==$con_system['sys_user']){

			$tpl->assign('sys_user',1);

}
$user11=$db->exec("select isproxy from user where userid='{$_SESSION[userid]}'");

	$tpl->assign('isproxy',$user11['isproxy']);

	}




if($config['sysopen']==2 and $mod!='read'){


	$mod="close";


}

if($config['ip_open']==1){
$ip_arr=explode('|',$config['ip_access']);
//print_r($ip_arr);
$ip= getIP();
$aceess=0;
if(count($ip_arr)>0){
    foreach ($ip_arr as $value){
        if($ip==$value){

            $aceess=1;
            break;
        }
    }

}

if($aceess!=1){
    exit("Forbidden You don't have permission to access / on this server.");

}

}

$ip_arr=explode('|',$config['ip_deny']);
$ip= getIP();
$aceess=1;
if(count($ip_arr)>0){
    foreach ($ip_arr as $value){
        if($ip==$value){

            $aceess=0;
            break;
        }
    }

}

if($aceess==0){
    exit("Forbidden You don't have permission to access / on this server.");

}


if($mod=='') {
if($config['sys_welcome']==2)

$mod='home';
else
$mod='welcome';
}
url_check();

if(!$_SESSION['userid']  and $_COOKIE['userid']){
    session_start();
    $_SESSION['userid']=$_COOKIE['userid'];

    $user_info=$db->fetch_first("select * from `user` where userid='{$_SESSION['userid']}'");

    $_SESSION["user_name"]=$user_info[username];
    $_SESSION["nick_name"]=$user_info[nickname];
    $_SESSION["hig_amount"]=$user_info[hig_amount];
    $_SESSION["isproxy"]=$user_info[isproxy];

    $_SESSION['loginnote']=1;

  getsql::upitem("sessionID",$_SESSION['userid'],"".DB_PREFIX."user","userid='".$user_info[userid]."'");
    if(isMobile()==1){
        $content='Wap登录';
    }
    else  $content='PC登录';
    add_userlog($content);
    $ipinfor = getIP ();
    $lastlogintime=date("Y-m-d H:i:s");
    $loginnum=$user_info['loginnum']+1;
 $db->update(DB_PREFIX."user",array('lastlogintime'=>$lastlogintime,'logintime'=>$lastlogintime,'lastloginip'=>$ipinfor,'loginnum'=>$loginnum),"userid=".$user_info[userid]."");
    login_online($_SESSION['userid'],$ipinfor);


}


if(!$mod)$mod='index';
$modd = $mod;
$code = isset($_GET['code']) ? $_GET['code'] : "";
if(!empty($code)){
    $modd .= "_".$code;
}
$list = isset($_GET['list']) ? $_GET['list'] : "";
if(!empty($list)){
    $modd .= "_".$list;
}


if(!$_SESSION['userid'] ){
if($mod=='safe' or $mod=='user' or $mod=='game' or $mod=='report' or $mod=='records'  or $mod=='chat'){

    echo "<script>window.location='login.html';</script>";

    exit();
}




}else{



$userinfo=$db->fetch_first("select * from `user` where userid='{$_SESSION['userid']}'");

$tpl->assign("userinfo",$userinfo);
}


	$ServiceUrl=$con_system['ServiceUrl'];

$tpl->assign("con_system",$con_system);
$tpl->assign("ServiceUrl",$ServiceUrl);

if($path_type=='index' and $con_system['autoopen1']==2) $no_task=1;
if($path_type=='admin' and $con_system['autoopen2']==2) $no_task=1;

if($path_type=='index'){
$sql  = "select * from game_type  order by `sort` asc ,id  asc  ";
$game_list = $db->fetch_all($sql);

foreach ($game_list as $key =>$value){
	$now=date("H:i:s");

	$tt=$db->fetch_first("select * from game_time where playKey='{$value['ckey']}' and endTime>'$now' order by endTime limit 0,1");
	$game_list[$key]['lasttime']=strtotime($tt['endTime'])-strtotime($now);
	if(date("H",$game_list[$key]['lasttime']-8*3600)>0) $h=date("H:",$game_list[$key]['lasttime']-8*3600);else $h='';
	$game_list[$key]['lasttime1']=$h.date("i:s",$game_list[$key]['lasttime']-8*3600);
	$game_list[$key]['lasttime1']=$h.date("i:s",$game_list[$key]['lasttime']-8*3600);
	$game_list[$key]['lotnum']=date("Ymd").$tt['lotNum'];
if($value['skey']=='kl8') $value['skey']='pk10';

   $game_nav[$value['skey']][]=$value;

}

$tpl->assign("arr_game_code",$arr_game_code);
$tpl->assign("game_nav",$game_nav);

$tpl->assign("game_list",$game_list);
$tpl->assign("game_num",count($game_list));




if($NaviList[$_GET['mod']]){
foreach ($NaviList[$_GET['mod']] as $key=>$value) {
	if($key==$_GET['code']) {$tpl->assign('show_nav',1);break;}
}
}

if($con_system['tranfer']==1){
	$tranfer=1;

}
else{
	$tranfer_user=explode("|", $con_system['tranfer_user']);

	if(in_array($userinfo[username], $tranfer_user)) $tranfer=1;
	else 	$tranfer=0;


}
    $row=$db->fetch_all("select * from user_msg where ((userid='{$_SESSION['userid']}' and del1='0' and read1='0') or (perid='{$_SESSION['userid']}' and del2='0' and read2='0') ) and replyid='0' ");

    $tpl->assign('msg_num',count($row));
$tpl->assign('tranfer',$tranfer);
}








?>