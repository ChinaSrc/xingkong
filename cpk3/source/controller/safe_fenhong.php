<?php


if($_POST){
	
	if($_POST['status']==2){
		
		$db->query("update fenhong set status='2',pre_temp='',rule_temp='' where uid='{$_SESSION['userid']}'");
		
	}
	else{
		
		$db->query("update fenhong set pre=pre_temp,rule=rule_temp where uid='{$_SESSION['userid']}'");
	$db->query("update fenhong set status='2',pre_temp='',rule_temp='' where uid='{$_SESSION['userid']}'");	
	}
	
	//echo "<script>alert('添加成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	
	exit();
	
}

$fenhong=$db->exec("select * from fenhong where uid='{$_SESSION['userid']}'");
$rule=unserialize($fenhong['rule']);

if($fenhong['rule_temp']) $rule_temp=unserialize($fenhong['rule_temp']);

$tpl->assign('rule',$rule);
$tpl->assign('rule_temp',$rule_temp);
$tpl->assign('fenhong',$fenhong);

$tpl->assign("navtitle",'契约分红');
?>