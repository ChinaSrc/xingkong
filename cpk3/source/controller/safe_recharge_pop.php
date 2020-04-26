<?php

if($_GET['id']){

	$row=$db->fetch_first("select * from user_funds where id='{$_GET[id]}'");
	if($row){
		if($row['userid']!=$_SESSION['userid']){
			echo "<script>alert('您无权访问此页面');window.history.go(-1);  </script>";
		exit();


		}
		else{

			$bank=$db->fetch_first("select * from system_bank where bankname='{$row['bankname']}'");
			$tpl->assign('bank',$bank);
			$tpl->assign('funds',$row);

		}


	}
	else{

		echo "<script>alert('您查看的充值信息不存在');window.history.go(-1);  </script>";
		exit();
	}
}$tpl->assign('navtitle','充值结果');
?>