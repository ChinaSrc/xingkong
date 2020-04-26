<?php
$user=get_user_info($_SESSION['userid']);
if($_POST){

	if($_POST['type']==1){

		$toid=$user['higherid'];
		if(!$toid) $toid=0;
		send_msg($toid, $_POST['title'], $_POST['content'],$_SESSION['userid']);

	}
	else{
		if(count($_POST['users'])>0){
			foreach ($_POST['users'] as $value) {


					send_msg($value, $_POST['title'], $_POST['content'],$_SESSION['userid']);

			}


		}


	}

		echo "<div style='text-align:center;background:#FFFFFF;font-size:16px;padding:20px;'>发送成功</div>";
echo "<script>setTimeout('parent.window.location=\"home_safe_msg.html\"',1000)</script>";
	exit();
}




$next=$db->fetch_all("select * from user where higherid='{$_SESSION['userid']}'");

$tpl->assign('next',$next);
$tpl->assign("navtitle",'发消息');
?>