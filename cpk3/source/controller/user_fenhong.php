<?php

$uid=$_GET['uid'];

if($_GET['admin']==1)  $pre_max=21;
else {
    $temp=$db->exec("select * from fenhong where uid='{$_SESSION['userid']}'");

    $pre_max=$temp['pre']+1;

}
$tpl->assign("pre_max",$pre_max);
$user=$db->exec("select * from user where userid='{$uid}'");


$tpl->assign("user",$user);
$fenhong=$db->exec("select * from fenhong where uid='{$uid}'");
if($fenhong) {
	
	$rule=unserialize($fenhong['rule']);
	
	$tpl->assign('num',count($rule)+1);
	$tpl->assign("rule",$rule);
	$tpl->assign("fenhong",$fenhong);

}
else 
	$tpl->assign('num',1);

$status_arr=array('1'=>"契约确认中",'2'=>'已签订契约');
	$tpl->assign('status_arr',$status_arr);
if($_POST){
	
	$rule=serialize($_POST['rule']);
if($fenhong['id']>0){
	if($_POST['status']==1){

$sql="update  fenhong set pre='{$_POST['pre']}',rule='{$rule}',status='{$_POST['status']}' where uid='{$uid}'";		

send_msg($uid, "契约调整提醒", "上级已调整您的契约，请至个人中心-我的契约确认。" );
		
	}
	elseif($_POST['status']==2){
	$db->query("update fenhong set pre_temp=pre,rule_temp=rule where uid='{$uid}'");	
$sql="update  fenhong set pre='{$_POST['pre']}',rule='{$rule}',status='1' where uid='{$uid}'";	
	send_msg($uid, "契约调整提醒", "上级已调整您的契约，请至个人中心-我的契约确认。" );
	}
	elseif($_POST['status']==3){
		if($fenhong['status']=='2')
	$sql="update  fenhong set pre=pre_temp,rule=rule_temp,status='2' where uid='{$uid}'";	
		else 
		$sql="delete from fenhong where uid='{$uid}'";
		send_msg($uid, "契约调整提醒", "上级已取消您的日工资契约。" );
		
	}
		
}
else{
	
	
$sql="insert into fenhong(uid,pre,rule,status) values('{$uid}','{$_POST['pre']}','{$rule}','{$_POST['status']}')";

		send_msg($uid, "契约调整提醒", "上级已与您签订日工资契约，请至个人中心-我的日工资确认。" );
}	
	$db->query($sql);
    if($_GET['mobile']==1){

        echo "<script>window.location='home_user_list.html?mobile=1';</script>";
    }
    else{
        echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>修改成功</div>";
        echo "<script>setTimeout('window.location=\"".$_SERVER['HTTP_REFERER']."\"',1000)</script>";


    }

exit();
	
}


$tpl->assign("navtitle",'设置分红');
?>