<?php

if($_GET['type']=='fafang' and $_GET['id']){
	$value=$db->exec("select * from fenhong_log  where id='{$_GET['id']}'");
	
	if($value['status']!='2'){
		
		echo "<script>alert('不需要你发放分红');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
		
	}
	else{
		
	     $new_id=$_GET['id'];
$money=$value['money'];
	     
						$amount=get_user_amount($_SESSION['userid']) ;
						$user=get_user_info($value['uid']);
						if($amount['hig_amount']>=$money){
	add_money($_SESSION['userid'], -$money, 'tranfer_out',"手动向{$user['username']}发放契约分红");
							add_money($value['toid'], $money, 'fenhong','契约分红');
						$db->query("update fenhong_log set status='1' where id='{$new_id}'");
show_message("分红发放成功", $_SERVER['HTTP_REFERER']);
						}
						
						else{
				
									echo "<script>alert('您的余额不足，无法发放契约分红');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
						}
		
	}
	exit();
}

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$url='home_user_fenhonglog.html?1=1';
$sql="select * from fenhong_log where fromid='{$_SESSION['userid']}'";

if($_GET['username']){
	$sql.=" and toid in (select userid from user where username='{$_GET['username']}') ";
	$url.="&username=".$_GET['username'];
}


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
else $order=" id desc";


$sql.=" order by {$order} limit $start,$pagesize ";
$list=$db->fetch_all($sql);
$status_arr=array('0'=>"不需分红",'1'=>'发放完成','2'=>'尚未发放');
if(count($list)>0){
	foreach ($list as $key=> $value) {
		$temp=get_user_info($value['toid']);
		$list[$key]['toname']=$temp['username'];
		
		$list[$key]['status_name']=$status_arr[$value['status']];
	}
	
	
}
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";

$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("list",$list);
$tpl->assign("status_arr",$status_arr);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("navtitle",'分红记录');
?>