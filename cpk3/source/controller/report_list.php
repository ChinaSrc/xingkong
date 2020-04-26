<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
if(!$begindate) $begindate=date("Y-m-d",time()).' 00:00:00';
if(!$enddate) $enddate=date("Y-m-d",time()+24*3600).' 23:59:59';

$sum=get_yingkui($_SESSION['userid'], $begindate, $enddate);


$tpl->assign("sum",$sum);

$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("begin",$begin);
$tpl->assign("end",$end);

$time_arr[0]=array('begin'=>date('Y-m-d').' 00:00:00','end'=>date('Y-m-d',time()+24*3600).' 23:59:59');
$time_arr[1]=array('begin'=>date('Y-m-d',time()-24*3600).' 00:00:00','end'=>date('Y-m-d').' 23:59:59');
$time_arr[2]=array('begin'=>date('Y-m-d',time()-6*24*3600).' 00:00:00','end'=>date('Y-m-d',time()+24*3600).' 23:59:59');
$time_arr[3]=array('begin'=>date('Y-m').'-01 00:00:00','end'=>date('Y-m-d',time()+24*3600).' 23:59:59');

$tpl->assign("time_arr",$time_arr);
$tpl->assign("navtitle",'今日盈亏');

?>