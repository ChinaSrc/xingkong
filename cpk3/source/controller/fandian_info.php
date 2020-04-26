<?php

$time=$_GET['time'];
$uid=$_GET['uid'];
$from=strtotime(date('Y-m-d',$time)." 00:00:00");
$to=strtotime(date('Y-m-d',$time)." 23:59:59");

$search="uid='{$uid}' and `status`='2' and time>='{$from}' and time<='{$to}'  group by nextid  ";
$list=$db->fetch_all("select nextid,sum(money) as money from user_fandian_log where {$search} order by money desc  ");
$pagesize=5;
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

$list=$db->fetch_all("select nextid,sum(money) as money from user_fandian_log where {$search} order by money desc  LIMIT $start, $pagesize");
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
if(count($list)){
	$me=	$db->fetch_first("select * from user where userid='{$uid}'");	
	foreach ($list as $key=>$value) {
	$user=	$db->fetch_first("select * from user where userid='{$value['nextid']}'");
		$value['i']=$key+1;
		$value['username']=$user['username'];
		if($user['isproxy']==1) $value['pro']='普通';else $value['pro']='代理';
		
	$rr=	$db->fetch_first("select count(*) as num from user where higherid='{$value['nextid']}'");
		if(!$rr['num']) $rr['num']=0;
		$value['next_num']=$rr['num'];
		$value['fandian']=$user['rebate'];
		$value['fandian_cha']=$me['rebate']-$user['rebate'];
		$value['money']=number_format($value['money'],3,'.','');
		$value['sum']=number_format($value['money']/($value['fandian_cha']/100),3,'.','');

		$sum['money']+=number_format($value['money'],3,'.','');
		$sum['sum']+=$value['sum'];	
		$bodylist[]=$value;
	}
	
}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$this_url."&",10);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("sum",$sum);
$tpl->assign("bodylist",$bodylist);

?>