<?php
include_once 'source/function/run.php';
$action=$_GET['action'];
if($_GET['code']!=md5($_GET['salt'].md5($con_system['chat_key']))) exit();

if($action=='userinfo'){
    $username=$_GET['username'];
    $user=$db->exec("select * from user where username='{$username}'");

 $data=   set_chat_data($user['userid']);

    exit(json_encode($data));
}



if($action=='tranfer'){

    $username=$_GET['username'];
    $user=$db->exec("select * from user where username='{$username}'");
  	if (!$user) {
    	$data=array('result'=>'fail','msg'=> '找不到用户');
      	exit(json_encode($data));
    }
    $money=$_GET['amount'];
    $id=add_charge($user['userid'],$money,'chat',2,'聊天室转入');
    $data=array('result'=>'ok','id'=>$id);
    exit(json_encode($data));
}

if($action=='grouplist'){
    $list=$db->fetch_all("select id,title,touxian from user_group order by score asc");
    exit(json_encode($list));


}


?>