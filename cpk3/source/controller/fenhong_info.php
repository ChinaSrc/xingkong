<?php

$time=$_GET['time'];
$uid=$_GET['uid'];
$from=strtotime(date('Y-m-d',$time)." 00:00:00");
$to=strtotime(date('Y-m-d',$time+24*3600)." 00:00:00");

$search="uid='{$uid}'  and time>='{$from}' and time<='{$to}'   ";
$list=$db->fetch_all("select * from user_fenhong_log where {$search} order by money desc  ");
$pagesize=5;
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
	$begintime=date('Y-m-d H:i:s',$from);
	$endtime=date('Y-m-d H:i:s',$to);
$list=$db->fetch_all("select * from user_fenhong_log where {$search} order by money desc  LIMIT $start, $pagesize");
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


		//$value['money']=$rr['money'];

	///$value['sum']=number_format($yingkui['sum'],3,'.','');
			//	$value['money']=number_format($value['sum']*$value['fenhong_cha']/100,3,'.','');
//	$value['money']=-$value['sum']*($value['fenhong_cha']/100);

		foreach ($value as $k1=>$v1) {
             if(in_array($k1, array('buy','prize','rebate','fenhong','active','money','sum')))
			$value[$k1]=number_format($v1,2,'.','');
		}
		
		$sum['money']+=$value['money'];
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