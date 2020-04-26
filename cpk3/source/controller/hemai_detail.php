<?php


$sql="select * from hemai where id='{$_GET['id']}' ";

$info=$db->exec($sql);

		$game=$db->exec("select * from game_type where ckey='{$info['playkey']}'");
		$info['game_name']=$game['fullname'];

		$user=$db->exec("select * from user where userid='{$info['uid']}'");

		$info['user_name']=substr($user['username'],0,2).'***'.substr($user['username'],strlen($user['username'])-2,2);
		$$info['baodi']=number_format($info['baodi']*100/$info['sum'],2);
		$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$info['id']}'");
		if(!$hm['sum']) $hm['sum']=0;
		$info['mebuy']=number_format(($hm['sum'])*100/$info['sum'],2);

		$info['sum1']=$info['sum']-$hm['sum'];

		$info['addtime']=date('Y-m-d H:i:s',$info['addtime']);
	$info['endtime']=date('Y-m-d H:i:s',$info['endtime']);
		$info['premoney']=number_format($info['premoney'],3);



		$buyinfo=unserialize($info['buyinfo']);
		foreach ($buyinfo as $key=> $value){


		$buyinfo[$key]['wanfa']=	get_wanfa($value['list_id'],$value['wei']);
			if(strlen($buyinfo[$key]['lines'])>100) $buyinfo[$key]['lines']=substr($buyinfo[$key]['lines'], 0,100).'...';

		}

		$hemai_list=$db->fetch_all("select * from hemai_list where hm_id='{$_GET['id']}' order by id asc");
		if(count($hemai_list)>0){

			foreach ($hemai_list as $key=> $value) {

		$user=$db->exec("select * from user where userid='{$value['uid']}'");
		$hemai_list[$key]['user_name']=substr($user['username'],0,2).'***'.substr($user['username'],strlen($user['username'])-2,2);
		$hemai_list[$key]['time']=date('Y-m-d H:i:s',$value['addtime']);
			}

		}

		if($info['uid']==$_SESSION['userid']){

			$view=1;

		}
		else{
        $view=$info['view'];
        if($view==2)

		$row=$db->exec("select * from hemai_list where hm_id='{$_GET['id']}' and uid='{$_SERVER['uid']}'");
			if($row) $view=1;
		}
$tpl->assign("arr_hemai_status",$arr_hemai_status);

$tpl->assign("view",$view);
$tpl->assign("hemai_list",$hemai_list);

$tpl->assign("buyinfo",$buyinfo);
$tpl->assign("info",$info);
?>