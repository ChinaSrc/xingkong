<?php


$buyarr=array();
$money=0;
  foreach ($_POST['selArr'] as $key=> $value) {
  	$str=array();
  	$arr=explode('|', $value);
  	$str['playkey']=$arr[0];
  	$str['list_id']=$arr[3];
  	$str['modes']=$arr[4];
  	$str['nums']=$arr[5];
  	$str['money']=$arr[6];
$str['pri_mode']=$arr[7];
$str['CurModeType']=$arr[8];
$str['times']=$arr[9];

	$str['lines']=$arr[12];
	$str['wei']=$arr[13];
$money+=$arr[6];
$buyarr[]=$str;
  }
  
  $post['playkey']=$buyarr[0]['playkey'];
 $post['period']=$_POST['period'];
//  $post['title']=$_POST['hm_title'];
$post['buyinfo']=serialize($buyarr);
$post['money']=$money;
$post['sum']=$_POST['hm_sum'];
$post['premoney']=$money/$post['sum'];
//$post['mebuy']=$_POST['hm_mebuy'];
$post['baodi']=$_POST['hm_baodi'];
$post['money1']=$post['premoney']*$post['baodi'];
$post['money2']=$post['premoney']*$_POST['hm_mebuy']['mebuy'];
$post['fee']=$_POST['hm_fee'];
$post['view']=$_POST['hm_view'];
$post['endtime']=strtotime($_POST['endtime']);
if($post['endtime']<time()){
		echo "error|本期投注已经截止";
exit()	;
	
}

$lost_money=getsql::moneys($_SESSION['userid']);
if(($post['money1']+$post['money2'])>$lost_money){
	
	echo "error|您的账户余额不足";
exit()	;
}
$now=time();
$db->query("insert into hemai (uid,addtime,status) values('{$_SESSION['userid']}','{$now}','0')");
if($db->affected_rows()>0){
	$id=$db->insert_id();
	
	foreach ($post as $key=>$value){
		
	$db->query("update hemai set `{$key}`='{$value}' where id='{$id}'");	
		
		
	}
	$amount=$post['money1']+$post['money2'];
	$db->query("update user_bank set `hig_amount`=`hig_amount`-$amount where userid='{$_SESSION['userid']}'");
	$ins_id=$db->insert_id();
	
		$game=$db->exec("select * from game_type where ckey='{$post['playkey']}'");
		$mark='发起'.$game['fullname'].'第'.$_POST['period'].'期合买';

	getsql::banklog($amount,"hm_buy",$_SESSION['userid'],$mark,$id,$post['playkey']);	
	if($_POST['hm_mebuy']>0){
	$db->query("insert into hemai_list(uid,hm_id,num,addtime) values('{$_SESSION['userid']}','{$id}','{$_POST['hm_mebuy']}','{$now}')");
	
	}
	
		echo "ok|合买成功";	exit()	;
}
else{
	
		echo "error|合买失败，请稍后再试";
exit()	;
}




?>