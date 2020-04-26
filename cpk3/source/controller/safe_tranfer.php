<?php

$user_bank_list	     = array();
$user_bank_list_sql  = "select b.* from ".DB_PREFIX."user_bank_list as b where b.userid='$userid' order by b.is_first desc";
$user_bank_list      = $db->getall($user_bank_list_sql);
$user_pass	   = array();
$user_pass_sql = "select u.password as upass,b.password as bpass from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid=b.userid and u.userid='$userid'";
$user_pass     = $db->fetch_first($user_pass_sql);
if($_GET['uid']){

	$touser=$db->exec("select * from user where userid='{$_GET['uid']}'");

	$tpl->assign('touser',$touser);
}

if($user_pass[upass]==$user_pass[bpass]){
$editpass="no";
}else{

$bank=	$db->fetch_first("select * from user_bank_list where userid='{$_SESSION[userid]}' and is_first='yes'");
$tpl->assign('bank',$bank);
$fromtime=date("Y-m-d")." 00:00:00";
$num=$db->fetch_first("select count(*) as num from user_funds where userid='{$_SESSION[userid]}' and creatdate>='$fromtime' and cate='platform'");
$tpl->assign('num',$num['num']);
$tpl->assign("amount",get_user_amount($_SESSION['userid']));

}
if(count($user_bank_list)-1>=0){
$is_card="yes";
}else{

	echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您还没有绑定银行卡，请先去绑定银行卡</div>";
echo "<script>setTimeout('parent.window.location=\"home_safe_bankinfo.html\";',1000)</script>";
exit();

}


$user=$db->exec("select * from user where userid='{$_SESSION['userid']}'");


if($user['modes']<$con_system['tranfer']){




	echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您的账户没有转账权限</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";
exit();

}
$bank1=$db->fetch_first("select * from user_bank where userid='{$_SESSION[userid]}'");
if($bank1[status]==1){
echo "<meta http-equiv=Content-Type content='text/html;charset=utf-8'><script>alert('您的账户被锁定，无法提现，请联系客服');</script>";
echo "<script>window.history.go(-1);</script>";

}


$tpl->assign("is_card",$is_card);
$tpl->assign("editpass",$editpass);
$tpl->assign("is_time",$is_time);
$tpl->assign("amount",get_user_amount($_SESSION[userid]));
if($active=="put"  and $_POST){
$secpwd = isset($_POST[pass]) ?$_POST[pass] : $_GET[pass];
$amount = isset($_POST[getMoney]) ?$_POST[getMoney] : $_GET[getMoney];

if($secpwd and $amount){
if(md5($secpwd)==$user_pass[bpass]){

$user_amount=getsql::moneys($userid);
if($amount-$user_amount>0){
		echo "<script>alert('您的余额不足，请更改转出金额。');window.history.go(-1); </script>";

}else{
   $to=$db->fetch_first("select * from user where username='$_POST[touser]'");
	if($to){

	add_tranfer($_SESSION['userid'],$to[userid], $amount,$_POST['type']);
if(isMobile()==1){
show_message('转账成功','home_user_list.html?mobile=1');

}else{

    echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>转账成功</div>";
    echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";
}


	}

	else{

	echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>收款用户不存在</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";
	}


}

}else{
echo "<script>alert('提现密码不正确');window.history.go(-1); </script>";

}
}else{
	echo "<script>alert('所有选项必须填写');window.history.go(-1); </script>";

}

$db->close();
exit;
}
$tpl->assign("navtitle",'转账');
?>