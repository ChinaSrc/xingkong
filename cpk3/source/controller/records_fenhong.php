<?php



$search=" userid='{$_SESSION['userid']}' ";
if($_GET['status']) $search.=" and `status`='{$_GET[status]}'";
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];

if(!$begindate) $begindate=date("Y-m-d",time()-30*24*3600);
if(!$enddate) $enddate=date("Y-m-d");
$begintime=strtotime($begindate." 00:00:00") ;

$endtime=strtotime($enddate." 23:59:59");

$search.=" and time between '$begintime' and '$endtime'";

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$list=$db->fetch_all("select * from user_fenhong where {$search} ");
$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$list=$db->fetch_all("select * from user_fenhong where {$search} order by id desc LIMIT $start, $pagesize");
$sum=0;
if(count($list)>0){

foreach ($list as $key=>$value){
if($value['status']==1) $value['statusname']='纳入';
else $value['statusname']='派送';


$value['timestr']=date("Y-m:d H:i:s",$value['time']);
$value['yk_amount']=number_format($value['yk_amount'],3,'.','');
$value['amount']=number_format($value['amount'],3,'.','');
$sum+=$value['amount'];

$list1[]=$value;
}


}

$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$this_url."&",10);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("list",$list1);
$tpl->assign("sum",$sum);