<?php

if($_POST){

	if(!$_POST['password']){

			show_message("新提现密码不能为空", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}
	if(!$_POST['ps1']){

			show_message("新登录密码不能为空", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}
	if($_POST['ps1']!=$_POST['ps2']){

			show_message("两次输入登录密码不一致", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}

	if(md5($_POST['password'])!=$userinfo['password'] and sys_md5($_POST['password'])!=$userinfo['password']){

			show_message("原始登录密码输入不正确", $_SERVER['HTTP_REFERER'],'warn');

		exit();
	}
	else{

		$pwd=md5($_POST['ps1']);
	mysql_query("update user set `password`='{$pwd}' where userid='{$_SESSION['userid']}'")	;


			show_message("已成功修改密码，请重新登录", 'logout.aspx');
exit();
	}

}


$tpl->assign("navtitle",'登录密码');

?>