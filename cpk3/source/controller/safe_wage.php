<?php

$wage=$db->exec("select * from wage where uid='{$_SESSION['userid']}'");
$auto=unserialize($wage['auto']);
$tpl->assign('auto',$auto);
$tpl->assign('wage',$wage);

$tpl->assign("navtitle",'我的日工资');
?>