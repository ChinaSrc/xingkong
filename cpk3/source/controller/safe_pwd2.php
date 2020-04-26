<?php
$bank=	$db->fetch_first("select * from user_bank where userid='{$_SESSION['userid']}'");
if($_POST){
	if($_POST['change']==1){
	if(!$_POST['password']){
			show_message("旧提现密码不能为空", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}

	}
	if(!$_POST['ps1']){

			show_message("新提现密码不能为空", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}
	if($_POST['ps1']!=$_POST['ps2']){
			show_message("两次输入提现密码不一致", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}

	$user=$db->exec("select * from user where userid='{$_SESSION['userid']}'");
	if(md5($_POST['ps1'])==$user['password'] ){
        show_message("提现密码不能与登录密码一致", $_SERVER['HTTP_REFERER'],'warn');

        exit();

    }

	if($_POST['change']==1 and (md5($_POST['password'])!=$bank['password'] and sys_md5($_POST['password'])!=$bank['password'] )){
			show_message("原始提现密码输入不正确", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}
	else{

		$pwd=md5($_POST['ps1']);
	$db->query("update user_bank set `password`='{$pwd}' where userid='{$_SESSION['userid']}'")	;

if($_POST['change']==1)
	show_message("提现密码修改成功", $_SERVER['HTTP_REFERER']);
else{

    show_message("提现密码设置成功，请绑定银行卡",'home_safe_bankinfo.html');

}

exit();
	}

}


$tpl->assign("bank",$bank);

$tpl->assign("userinfo",get_user_info($_SESSION['userid']));

$tpl->assign("navtitle",'资金密码');
?>