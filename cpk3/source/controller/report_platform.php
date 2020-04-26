<?php
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$search=" userid='{$_SESSION['userid']}' and cate='platform'  ";

if($_POST['order_sn']) $search.=" and order_sn='{$_POST['order_sn']}'";
if(!$begindate) $begindate=date("Y-m-d",time());
if(!$enddate) $enddate=date("Y-m-d",time()+24*3600);
$begintime=$begindate." 00:00:00" ;

$endtime=$enddate." 23:59:59";

$search.=" and creatdate between '$begintime' and '$endtime'";
if($_POST['cate']) $search.=" and  bankname='{$_POST[cate]}' ";
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(creatdate) FROM user_funds where {$search}";
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $this_url."&";
$list=$db->fetch_all("select * from user_funds where {$search}  order by id desc");
if($list){
foreach ($list as $key=>$value){

	$list[$key]['money']=number_format($value['money'],3,'.','');

	$sum+=$list[$key]['money'];
}
}
$sql	= "SELECT sum(money) FROM user_funds where {$search}";
$sum1=$db->fetch_count($sql);
$tpl->assign('sum',$sum);
$tpl->assign('sum1',$sum1);
$tpl->assign('list',$list);
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);

$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);

$bank_list=get_bank_list();
$tpl->assign("bank_list",$bank_list);
$tpl->assign("navtitle",'提现记录');
?>