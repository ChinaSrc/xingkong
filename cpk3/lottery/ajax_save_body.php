<?php

$items = $_POST['items'];
$perid = $_POST['perid'];
$values = $_POST['values'];
$bodys = $_POST['bodys'];
$dbname = $_POST['dbname'];
$codes = $_POST['codes'];
$nowtime=date("YmdHis",time());
$flags="yes";

if($_POST['username']){
	
	$user=$db->fetch_first("select * from user where username='{$_POST['username']}' and admin=0");
	$perid=$user['userid'];
	if(!$user){
		
		echo 'no1';exit();
		
		
	}
	
}
else
$user=$db->fetch_first("select * from user where userid='{$perid}'");
$username=$user['username'];

		if($bodys)$marks=$bodys;else $marks="";
if($items==1){

	if($codes=='lost'){
		
		$money=-$values;
	
		$content="管理员扣除资金:{$values}元";
	$type='hig_lost_admin';
	}
	else {
		
		
		$money=$values;

		$content="管理员转入资金:{$values}元";
		$type='hig_add_admin';
	}
if($marks=='') $marks=$content;
$iid=add_charge($perid,$money,'系统充值',2,$marks);
if($iid>0){

    add_money($perid, $money, $type,$marks);
	$db->query ( "update user_funds set status=1 where id='{$iid}'" );
    if($_SESSION ['admin_id'])
    {

        $admin = $db->fetch_first ( "select * from user where userid='{$_SESSION ['admin_id']}'" );
        $db->query ( "update user_funds set admin='{$admin['username']}' where id='{$iid}'" );
    }
add_score($perid,$money);
}
}
else{
	
		if($codes=='lost'){
		
		$money=-$values;
	$type='fenhong_lost_admin';

		$content="管理员扣除活动资金:{$values}元";

	}
	else {
		
		
		$money=$values;
		
			$type='fenhong';
		$content="管理员转入活动资金:{$values}元";
		
	}
    if($marks=='') $marks=$content;
	add_money($perid, $money, $type,$marks);
	
}
add_adminlog($content);
echo $flags;exit();



?>