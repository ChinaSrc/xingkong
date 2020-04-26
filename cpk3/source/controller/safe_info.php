<?php

if($_POST  and $_SESSION['userid']){



	foreach ($_POST as $key=>$value) {
		if($key!='field')
		$db->query("update user set `{$key}`='{$value}' where userid='{$_SESSION['userid']}'");
		
	}

    //foreach ($_POST['field'] as $key=>$value){

    //        field_add($_SESSION['userid'],$key,$value);
    //}


    echo "<script>alert('资料修改成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	
}
//print_r($userinfo);
$user_group=$db->exec("select * from user_group where id='{$userinfo['groupid']}'");

$tpl->assign('user_group',$user_group);

if($_GET['type']=='grade'){

    $group_list=$db->fetch_all("select * from user_group where sys='0' order by score asc ");

    $tpl->assign('group_list',$group_list);

}
if($user_group['sys']==0){

    $next_group=$db->exec("select * from user_group where score>'{$userinfo['score']}' and sys=0 order by score asc limit 0,1");

    $tpl->assign('next_group',$next_group);
}

$field_list=$db->fetch_all("select * from field where `show`='1' order by sortnum asc");
$tpl->assign('field_list',$field_list);

$tpl->assign('navtitle','个人信息');

?>