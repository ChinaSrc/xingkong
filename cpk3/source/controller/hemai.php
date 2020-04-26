<?php


if($_GET['id']) {$playkey=get_game_ckey($_GET['id']);


$game=$db->exec("select * from game_type where id='{$_GET['id']}'");

$tpl->assign("game_name",$game['fullname']);
}
else $playkey='';

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$sql="select * from hemai where 1=1 ";
if($playkey) $sql.=" and playkey='{$playkey}' ";
if($_GET['status']) $status=$_GET['status'];
else $status=0;

if($status!=-2){

    $sql.=" and status='{$status}'";
}
$tpl->assign("status",$status);
$total		= count($db->fetch_all($sql));
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$sql.=" order by id desc limit $start,$pagesize";
$list=$db->fetch_all($sql);
if(count($list)>0){
	foreach ($list as $key=> $value) {

		$game=$db->exec("select * from game_type where ckey='{$value['playkey']}'");
		$list[$key]['game_name']=$game['fullname'];

		$user=$db->exec("select * from user where userid='{$value['uid']}'");
		$list[$key]['user_name']=substr($user['username'],0,2).'***'.substr($user['username'],strlen($user['username'])-2,2);

		$list[$key]['baodi']=number_format($value['baodi']*100/$value['sum'],2);
		$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$value['id']}'");
		if(!$hm['sum']) $hm['sum']=0;
		$list[$key]['mebuy']=number_format(($hm['sum'])*100/$value['sum'],2);

		$list[$key]['sum1']=$value['sum']-$hm['sum'];

		$list[$key]['premoney']=number_format($list[$key]['premoney'],3);


		$list[$key]['status_name']=$arr_hemai_status[$value['status']];
	}


}
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";


$url = "hemai.html";
if($_GET['id']) $url="hemai_{$_GET['id']}".html;
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("user_list_tree",$user_list_tree);
$tpl->assign("user_list_low",$user_list_low);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("hm_list",$list);
$tpl->assign("arr_hemai_status",$arr_hemai_status);

?>