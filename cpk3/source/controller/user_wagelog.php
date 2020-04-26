<?php
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$url='home_user_wagelog.html?1=1';
$sql="select * from wage_log where fromid='{$_SESSION['userid']}'";

if($_GET['username']){
	$sql.=" and toid in (select userid from user where username='{$_GET['username']}') ";
	$url.="&username=".$_GET['username'];
}

if($_GET['begintime']){
	
$begin=$_GET['begintime'];


}
else $begin=date('Y-m-d');
$time=strtotime($begin.' 00:00:00');
$sql.=" and time>='{$time}' ";

$sql1.=" and time>='{$time}' ";
$url.="&begintime=".$_GET['begintime'];
	
	

if($_GET['endtime']){
	
$end=$_GET['endtime'];

}
else $end=date('Y-m-d',time()+24*3600);
$time=strtotime($end.' 00:00:00');
$sql.=" and time<='{$time}' ";
$sql1.=" and time='{$time}' ";
	$url.="&endtime=".$_GET['endtime'];


$tpl->assign('begin',$begin);
$tpl->assign('end',$end);

if(strlen($_GET['status'])>0){
	
	$sql.=" and status='{$_GET['status']}' ";
$url.="&status=".$_GET['status'];	
	
}

$total		= count($db->fetch_all($sql));
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

if($_GET['orderby'])  $order=$_GET['orderby'];
else $order=" time desc";


$sql.=" order by {$order} limit $start,$pagesize ";
$list=$db->fetch_all($sql);
$status_arr=array('0'=>"余额不足",'1'=>'发放完成');
if(count($list)>0){
	foreach ($list as $key=> $value) {
		$temp=get_user_info($value['toid']);
		
		
	
		$list[$key]['toname']=$temp['username'];
		$tt=$db->exec("select sum(money1) as sum from wage_log where fromid='{$value['toid']}' {$sql1}");
		$list[$key]['money1']=$value['money1']-$tt['sum'];
		$list[$key]['status_name']=$status_arr[$value['status']];
	}
	
	
}
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";

$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("list",$list);
$tpl->assign("status_arr",$status_arr);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("navtitle",'工资记录');
?>