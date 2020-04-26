<?php



$tpl->assign("navtitle",'安全中心');
$login=$db->exec("select * from userlog where uid='{$_SESSION['userid']}' order  by id desc limit 0,1");
$tpl->assign("login",$login);
$star=3;

$bank=$db->exec("select * from user_bank where userid='{$_SESSION['userid']}'");
if($bank['password']  and $bank['password']!=$userinfo['password']){
    $tpl->assign('pwd2',1);
    $star++;
}

$mibao=$db->exec("select * from user_mibao where userid='{$_SESSION['userid']}' order by id asc");
if($mibao) $star++;
$tpl->assign('mibao',$mibao);
$tpl->assign('star',$star);
?>