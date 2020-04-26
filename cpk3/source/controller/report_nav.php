<?php



$tpl->assign("navtitle",'我的彩票');


$group=$db->exec("select * from user_group where id='{$userinfo['groupid']}'");

$tpl->assign('group',$group);
?>