<?php

$wage=$db->exec("select * from wage where uid='{$_SESSION['userid']}'");
$auto=unserialize($wage['auto']);
$tpl->assign('auto',$auto);
$tpl->assign('wage',$wage);
$uid=$_GET['uid'];


$user=$db->exec("select * from user where userid='{$uid}'");


$tpl->assign("user",$user);
$wage=$db->exec("select * from wage where uid='{$uid}'");
if($wage) {
	
	$auto=unserialize($wage['auto']);
	$tpl->assign("auto",$auto);
		$tpl->assign("num",count($auto)-1);
	$tpl->assign("wage",$wage);

}



if($_POST){
	
	
$now=time();
	$auto=serialize($_POST['auto']);
if($wage['id']>0){
	

$sql="update  wage set type='{$_POST['type']}',fix='{$_POST['fix']}',auto='{$auto}',status='{$_POST['status']}',time='{$now}' where uid='{$uid}'";		
}
else{
	
$sql="insert into wage(uid,type,fix,auto,status,time) values('{$uid}','{$_POST['type']}','{$_POST['fix']}','{$auto}','{$_POST['status']}','{$now}')";
}	
	$db->query($sql);
	send_msg($uid, "工资调整提醒", "上级已调整您的日工资契约，请至个人中心-我的日工资确认。" );
	if($_GET['mobile']==1){

        echo "<script>window.location='home_user_list.html?mobile=1';</script>";
    }
    else{
        echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>修改成功</div>";
        echo "<script>setTimeout('window.location=\"".$_SERVER['HTTP_REFERER']."\"',1000)</script>";


    }

    exit();
}

$tpl->assign("navtitle",'设置工资');
?>