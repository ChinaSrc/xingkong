<?php


$uid=$_GET['uid'];

$user=$db->fetch_first("select * from `user` where userid='{$uid}'");
if($_POST){
$rebate=$_POST['rebate'];
$modes=1800+20*$rebate;

	$db->query("update `user` set rebate='{$rebate}',modes='{$modes}',isproxy='$_POST[usertype]' where userid='{$uid}'");

	echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>修改成功</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";
exit();
}


if($user['higherid']){
$parent=$db->exec("select * from user where userid='{$user['higherid']}'");

$select_list=rebate_select($parent['modes'],$user['modes'],$user['modes']);
$tpl->assign("select_list",$select_list);

}
$tpl->assign("user",$user);
$tpl->assign("parent",$parent);
$pid=get_user_pid($uid);
$pname='';

foreach ($pid as $key=> $value) {
	if($key==0) $pname=$value['username'];
	else $pname.=" &gt ".$value['username'];
}

$tpl->assign("pname",$pname);
$tpl->assign("navtitle",'设置返点');
?>