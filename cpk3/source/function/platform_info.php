<?php

$info=$db->fetch_first("select * from user_funds where id='{$_GET['id']}'");
		$bank=$db->fetch_first("select * from system_bank where bankname='{$info['bankname']}'");
			$tpl->assign('bank',$bank);
			$tpl->assign('funds',$info);
?>