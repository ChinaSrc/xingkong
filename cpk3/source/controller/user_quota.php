<?php
$uid=$_GET['uid'];




$user=$db->fetch_first("select * from `user` where userid='{$uid}'");


$tpl->assign("user",$user);




if($user['higherid']){
$parent=$db->exec("select * from user where userid='{$user['higherid']}'");

}

if($_POST){

	foreach ($_POST[num] as $key=>$value) {
		if($parent){

			if($parent[$key]<$value){
if($_GET['mobile']==1)
show_message("您{$key}模式的剩余配额{$parent[$key]}",$_SERVER['HTTP_REFERER']);
else {


				echo "<div style='text-align:center;background:#FFFFFF;font-size:16px;padding:20px;'>您{$key}模式的剩余配额{$parent[$key]}</div>";
echo "<script>setTimeout('window.location=\"".$_SERVER['HTTP_REFERER']."\"',1000)</script>";
}

				exit();
			}
			else{
					$db->query("update user set `{$key}`=`{$key}`-'{$value}' where userid='{$parent['userid']}' ")	;


			}
		}

	$db->query("update user set `{$key}`=`{$key}`+'{$value}' where userid='{$uid}' ")	;
	}

		send_msg($uid, "配额调整提醒", "上级已调整您配额。" );
if($_GET['mobile']==1)
show_message("修改成功",$_SERVER['HTTP_REFERER']);
else {

	echo "<div style='text-align:center;background:#FFFFFF;font-size:16px;padding:20px;'>修改成功</div>";
echo "<script>setTimeout('window.location=\"".$_SERVER['HTTP_REFERER']."\"',1000)</script>";

}

exit();
}
$max=$user['modes'];


if($max>1958) $max=1958;
$list=array();
for($i=$max;$i>=1954;$i=$i-2){
$arr=array();
if(!$parent) $arr['num1']='-';
	else $arr['num1']=$parent[$i];
	$arr['num2']=$user[$i];

	$list[$i]=$arr;
}

$tpl->assign('list',$list);
$tpl->assign("navtitle",'配额管理');
?>