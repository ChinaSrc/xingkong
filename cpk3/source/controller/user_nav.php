<?php
$tpl->assign("navtitle",'代理中心');


$team=get_team_info($_SESSION['userid']);



$tpl->assign('team',$team);

$row1=get_yingkui($_SESSION['userid'],date('Y-m-d').' 00:00:00',date('Y-m-d').' 23:59:59',0);
$row2=get_yingkui($_SESSION['userid'],date('Y-m-d',time()-24*3600).' 00:00:00',date('Y-m-d',time()-24*3600).' 23:59:59',0);


$tpl->assign('rebates',array('today'=>$row1['rebate'],'yestoday'=>$row2['rebate']));