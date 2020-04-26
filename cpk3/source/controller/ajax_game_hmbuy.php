<?php



$sql="select * from hemai where id='{$_GET['hm_id']}' ";

$info=$db->exec($sql);

if($info['period']< get_game_period($info['playkey'])){

		echo "error|该合买已经停止";
exit()	;


}

	$$info['baodi']=number_format($info['baodi']*100/$info['sum'],2);
		$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$info['id']}'");
		if(!$hm['sum']) $hm['sum']=0;
		$info['mebuy']=number_format(($hm['sum'])*100/$info['sum'],2);

		$info['sum1']=$info['sum']-$hm['sum'];
		if($info['sum1']<$_GET['sum']){
			echo "error|最多可以认购{$info['sum1']}分";
		exit();

		}

		//	$info['premoney']=number_format($info['premoney'],3);
			$money=	$info['premoney']*$_GET['num'];
$lost_money=getsql::moneys($_SESSION['userid']);
if($money>$lost_money){

	echo "error|您的账户余额不足";
exit()	;
}
$now=time();
	$db->query("insert into hemai_list(uid,hm_id,num,addtime) values('{$_SESSION['userid']}','{$_GET['hm_id']}','{$_GET['num']}','{$now}')");
if($db->affected_rows()>0){
$sql="select * from hemai where id='{$_GET['hm_id']}' ";

$info=$db->exec($sql);


		$db->query("update user_bank set `hig_amount`=`hig_amount`-$money where userid='{$_SESSION['userid']}'");
	$ins_id=$db->insert_id();

		$game=$db->exec("select * from game_type where ckey='{$info['playkey']}'");
		$mark='认购'.$game['fullname'].'第'.$info['period'].'期合买';

	getsql::banklog($money,"hm_buy",$_SESSION['userid'],$mark,$_GET['id'],$info['playkey']);

			$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$info['id']}'");
		if(!$hm['sum']) $hm['sum']=0;

		$info['sum1']=$info['sum']-$hm['sum'];
		if($info['sum1']<1){
			//已满员

			hm_success($info['id']);
		}



	echo "ok|".$info['sum1'];
exit()	;
}

?>