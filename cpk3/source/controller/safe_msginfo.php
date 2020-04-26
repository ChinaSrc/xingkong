<?php

$userid=$_SESSION['userid'];
$user=get_user_info($userid);

$id=$_GET['id'];
	$info=$db->exec("select * from user_msg where id='{$id}'");


	if ($info['userid'] == $userid || $info['perid'] == $userid) {
		


		if($info['userid']==$userid){
			$db->query("update user_msg set read1='1' where id='{$id}'");

		}else{
		} $db->query("update user_msg set read2='1' where id='{$id}'");
			

	}else{
		echo "<div style='text-align:center;background:#FFFFFF;font-size:16px;padding:20px;'>查询异常</div>";
		echo "<script>setTimeout('parent.window.location=\"home_safe_msg.html\"',1000)</script>";
	}

if($_POST){


	send_msg($info['perid'],'[回复]'.$info['title'], $_POST['content'],$_SESSION['userid'],$id);
	if($info['userid']==$userid){
		$db->query("update user_msg set read2='0' where id='{$id}'");
		$db->query("update user_msg set del2='0' where id='{$id}'");
	}
	else 	{$db->query("update user_msg set read2='1' where id='{$id}'");

		$db->query("update user_msg set del1='0' where id='{$id}'");
	}

}











$msg=$db->fetch_all("select * from user_msg where id='{$id}' or replyid='{$id}' order by id asc");

if(count($msg)>0){
	foreach ($msg as $key=>$value) {
	if($value['perid']==$userid) {$value['fromname']='我'; $value['css']='right';}
		else if($value['perid']=='0') $value['fromname']='管理员';
		else{
			$row=get_user_info($value['perid']);


			if($row['userid']==$user['higherid'])

						$value['fromname']='上级';
		else
			$value['fromname']=$row['username'];

		}

		if($value['userid']==$userid){ $value['toname']='我'; $value['css']='left';}
		else if($value['userid']=='0') $value['toname']='系统';
		else{
			$row=get_user_info($value['userid']);

			$value['toname']=$row['username'];



		}


		$msg[$key]=$value;
	}


}

$tpl->assign('list',$msg);
$tpl->assign('navtitle',$info['title']);
?>