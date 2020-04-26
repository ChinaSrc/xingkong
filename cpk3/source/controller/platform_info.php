<?php

$info=$db->fetch_first("select * from user_funds where id='{$_GET['id']}'");
		$bank=$db->fetch_first("select * from user_bank_list where userid='{$info['userid']}'");
			$tpl->assign('bank',$bank);
			$tpl->assign('funds',$info);
?>