<?php
if ($userinfo['istry'] == 1) {


	show_message("您现在还是试用账户，不允许提现", $_SERVER['HTTP_REFERER']);

}
$user_bank = $db->exec("select * from user_bank where userid='{$_SESSION['userid']}'");
if ($user_bank['status'] == 1) {
	show_message("您的账户已经被锁定，暂时无法提现", $_SERVER['HTTP_REFERER']);

}
$user_bank_list     = array();
$user_bank_list_sql = "select b.* from " . DB_PREFIX . "user_bank_list as b where b.userid='$userid' order by b.status desc";
$user_bank_list     = $db->getall($user_bank_list_sql);
$user_pass          = array();
$user_pass_sql      = "select u.password as upass,b.password as bpass from " . DB_PREFIX . "user as u," . DB_PREFIX . "user_bank as b where u.userid=b.userid and u.userid='$userid'";
$user_pass          = $db->fetch_first($user_pass_sql);


$bank = $db->fetch_first("select * from user_bank_list where userid='{$_SESSION[userid]}' and is_first='yes'");
$tpl->assign('bank', $bank);
$fromtime = date("Y-m-d") . " 00:00:00";
$num      = $db->fetch_first("select count(*) as num from user_funds where userid='{$_SESSION[userid]}' and creatdate>='$fromtime' and cate='platform'");
$tpl->assign('num', $num['num']);


$from = str_to_time($con_system['Auto_JieS_Begin']);
$to   = str_to_time($con_system['Auto_JieS_End']);

$nowtime = str_to_time(date('H:i:s'));

$agree = 0;
if ($from <= $to) {

	if ($nowtime >= $from and $nowtime < $to) {

		$agree = 1;

	}

} else {


	if ($nowtime >= $from or $nowtime < $to) {

		$agree = 1;

	}

}


if ($agree == 0) {
	show_message("'提现时间为{$con_system['Auto_JieS_Begin']}到{$con_system['Auto_JieS_End']}'", 'home_report_nav.html', 'warn');
	exit();

}
$amount = get_user_amount($_SESSION['userid']);

$tpl->assign("amount", $amount);

if ($amount['low_amount'] > 0) {
	show_message("您的洗码金额大于0，不能提现", 'home_report_nav.html', 'warn');
	exit();

}


//echo   $con_system['recharge_num'];
if ($con_system['recharge_num'] > 0)

	$tt = $db->exec("select * from user_funds where userid='{$_SESSION['userid']}' and cate='recharge'  and status='1'  order by creatdate desc limit 0,1");
if ($tt['creatdate']) {


	$from = $tt['creatdate'];
} else {

	$tt   = $db->exec("select * from user where userid='{$_SESSION['userid']}' ");
	$from = $tt['registertime'];
}


$tpl->assign('info', $info1);

if (count($user_bank_list) - 1 >= 0) {
	$is_card    = "yes";
	$blank_list = '';
	foreach ($user_bank_list as $value) {

		$str = "[{$value['bankname']}][{$value['realname']}]-尾号" . substr($value['banknum'], strlen($value['banknum']) - 4, 4);
		if ($value['is_first'] == 'yes') $select = "selected"; else $select = '';

		$blank_list .= "<option value='{$value['id']}' {$select}>{$str}</option>";


	}

	$tpl->assign("blank_list", $blank_list);
} else {

	show_message("您还没有绑定银行卡，请先去绑定银行卡", 'home_safe_bankinfo.html', 'warn');
	exit();
}

if ($_GET['active'] == 'tixian' and $_POST[pass]) {

	$secpwd = isset($_POST[pass]) ? $_POST[pass] : $_GET[pass];

	if (md5($secpwd) == $user_pass[bpass] or sys_md5($secpwd) == $user_pass[bpass]) {


		$tpl->assign("need_pwd", 0);

	} else {


		show_message("提现密码不正确", $_SERVER['HTTP_REFERER'], 'warn');
		exit();

	}

} else
	$tpl->assign("need_pwd", 1);

$tpl->assign("need_pwd", 0);

$tpl->assign("is_card", $is_card);
$tpl->assign("editpass", $editpass);
$tpl->assign("is_time", $is_time);
$userinfo = get_user_info($_SESSION['userid']);
$row      = $db->exec("select * from active where type='bank' and userid='{$_SESSION['userid']}' ");

if ($row) {
	$recharge = get_bank_sum($_SESSION['userid'], 'Recharge_to_system,Recharge_online,hig_add_admin', $userinfo['registertime'], date('Y-m-d H:i:s'));
	if ($recharge == 0) {

		$tpl->assign('active_bank_sum', ",您未参加过充值最多可提现{$con_system['active_bank_sum']}元");


	}
}

if ($_GET['active'] == "put" and $_POST) {
	$secpwd = isset($_POST[pass]) ? $_POST[pass] : $_GET[pass];
	$amount = isset($_POST[getMoney]) ? intval($_POST[getMoney]) : intval($_GET[getMoney]);
	if ($secpwd and $amount) {
		if (md5($secpwd) == $user_pass[bpass]) {
			if ($num['num'] >= $config['MaxGetCash_num']) {
				show_message("您今天的提现次数已经超过" . $config['MaxGetCash_num'] . "次，请明天再来", $_SERVER['HTTP_REFERER'], 'warn');
			}
			if ($config['MinGetCash_amount'] - $amount > 0) {
				show_message("提现金额不能低于" . $config['MinGetCash_amount'] . "元", $_SERVER['HTTP_REFERER'], 'warn');
				exit();
			} else {
				$user_amount = getsql::moneys($userid);
				if ($amount - $user_amount > 0) {

					show_message('您的余额不足，请更改提现金额。', $_SERVER['HTTP_REFERER'], 'warn');
					exit();
				} else {

					add_platform($_SESSION['userid'], $amount, $_POST['bank_id']);

					show_message('提现成功，请等待管理员审核', 'home_report_nav.html');

				}
			}
		} else {

			show_message("提现密码不正确", $_SERVER['HTTP_REFERER'], 'warn');
			exit();

		}
	} else {

		show_message('所有选项必须填写', $_SERVER['HTTP_REFERER'], 'warn');
	}

	$db->close();
	exit;
}
$tpl->assign('navtitle', '提现');
?>