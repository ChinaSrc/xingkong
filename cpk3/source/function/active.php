<?php
//充值活动解锁

  function active_unlock(){
  		global $db,$_SESSION,$con_system;

  		$list=$db->fetch_all("select * from `active` where  `type`='charge' and complate='0'  and charge>0 ");

  		//print_r($list);
  		if($list){

  			foreach ($list as $active) {
  			  		$lock=0;

         	$uid=$active['userid'];
         	$bank=get_user_amount($uid);
         	if($bank['total_amout']=='0.000'){

         		$lock=1;

         	}
        else{
        $begintime=date("Y-m-d H:i:s",$active['time']);
        $endtime=date('Y-m-d H:i:s');
        $money=	$active['charge']*$con_system['active_charge_jd'];

              $yingkui=  get_yingkui($uid, $begintime, $endtime);
       // print_r($yingkui);
              if($yingkui['buy']>=$money)  $lock=1;
        }

       if($lock==1){
       	$db->query("update `active` set complate='1' where id='{$active[id]}'");
   	$db->query("update `user_bank` set status='0' where userid='{$uid}'");
      }


  			}

  		}

  }

//消费佣金

  function   active_buy(){
  		global $db,$_SESSION,$con_system;
  		if( $con_system['active_buy_open']==1){
  	$time=$con_system['active_buy_time'];
  	$from= str_to_time($time);
  	$now=str_to_time(date("H:i:s"));


  	if($now>$from){
$begin=strtotime(date('Y-m-d')." 00:00:00")	;
  		$row=$db->fetch_first("select * from sys_task where time>'{$begin}'");
$task=get_task('active');
$run=$task['run'];


  		if($run==1){

  		$hm_arr=explode('|', $con_system['active_buy_user']);

  $begin=date('Y-m-d',time()-24*3600).' 00:00:00';
  $end=date('Y-m-d',time()-24*3600).' 23:59:59';
  $log=$db->fetch_all("select userid,username from user where higherid>0  and admin='0' and status='0' order by higherid asc");

  	if($log){
  foreach ($log as $value){
 $yingkui= get_yingkui($value['userid'], $begin, $end);

  	$money=$yingkui['buy'];


  	$m1=$m2=$m3=0;
  	for($i=1;$i<$con_system['active_buy_num'];$i++){
  		$t=$i-1;
	if(($money>=$con_system['active_buy_xf_'.$t] and $money<$con_system['active_buy_xf_'.$i]  and $i<$con_system['active_buy_num']-1)  or ($i==$con_system['active_buy_num']-1 and $money>=$con_system['active_buy_xf_'.$i])){
if($i==$con_system['active_buy_num']-1) $t=$i;
		$m1=$con_system['active_buy_jl1_'.$t];
$m2=$con_system['active_buy_jl2_'.$t];
$m3=$con_system['active_buy_jl3_'.$t];
		break;
	}

	}
	$userid=$value[userid];

	$username=$value['username'];
	$pids=get_user_pid($userid);
	if($m1>0){

		$creattime=date('Y-m-d')." ".$con_system['active_buy_time'];

// mysql_query("update user_bank set hig_amount=hig_amount+$m1 where userid='$userid'");
//getsql::banklog($m1, 'active',$userid,$username.'参加累计消费活动奖励','','','',$creattime);


if($pids[1]['userid'] and !in_array($pids[1]['username'], $hm_arr) and $m2){
 mysql_query("update user_bank set hig_amount=hig_amount+$m2 where userid='{$pids[1]['userid']}'");
getsql::banklog($m2, 'yongjin',$pids[1]['userid'],"下级{$username}当日累计消费{$money}元佣金",'','','',$creattime);

}

	if($pids[2]['userid'] and !in_array($pids[2]['username'], $hm_arr) and $m3){
 mysql_query("update user_bank set hig_amount=hig_amount+$m3 where userid='{$pids[2]['userid']}'");
getsql::banklog($m3, 'yongjin',$pids[2]['userid'],"下下级{$username}当日累计消费{$money}元佣金",'','','',$creattime);

}

	}
  }

  }


  	}
  	}
  		}
  }


//累计充值结算
function active_chage_sum(){
	  		global $db,$_SESSION,$con_system;
	  		//	$active_begin=strtotime($con_system['active_charge2_ben']);
	$active_end=strtotime($con_system['active_charge2_end']);
	check_exit();
	if(time()>=$active_end  and $con_system['active_charge2_sum']==1  and $con_system['active_charge2_open']==1){
  mysql_query("update `sys` set `value`='0' where `key`='active_charge2_sum'");

  if(mysql_affected_rows()>0){
	$log=$db->fetch_all("select userid,sum(moneys) as money from user_bank_log where (cate='Recharge_to_system' or cate='Recharge_online')  and creatdate>='{$con_system['active_charge2_begin']}' and creatdate<='{$con_system['active_charge2_end']}' group by userid");

  	if($log){
  		//print_r($log);
  foreach ($log as $value){
  	$money=$value['money'];
  	$m1=$m2=$m3=0;
  	for($i=1;$i<$con_system['active_charge2_num'];$i++){
  		$t=$i-1;
	if(($money>=$con_system['active_charge2_xf_'.$t] and $money<$con_system['active_charge2_xf_'.$i])  or ($i==$con_system['active_charge2_num']-1 and $money>=$con_system['active_charge2_xf_'.$i])){
if($i==$con_system['active_charge2_num']-1) $t=$i;

		$m1=$con_system['active_charge2_jl1_'.$t];
$m2=$con_system['active_charge2_jl2_'.$t];
$m3=$con_system['active_charge2_jl3_'.$t];
		break;
	}

	}
		$userid=$value[userid];
	$user=$db->fetch_first("select username from user where userid='{$userid}'");
	$username=$user['username'];
	$pids=get_user_pid($userid);
	if($m1>0){

 mysql_query("update user_bank set hig_amount=hig_amount+$m1 where userid='$userid'");
getsql::banklog($m1, 'active',$userid,'参加累计充值活动奖励','','','',$con_system['active_charge2_end']);


if($pids[1]['userid']  and $m2){
 mysql_query("update user_bank set hig_amount=hig_amount+$m2 where userid='{$pids[1]['userid']}'");
getsql::banklog($m2, 'active',$pids[1]['userid'],"下级{$username}参加累计充值活动奖励",'','','',$con_system['active_charge2_end']);

}

	if($pids[2]['userid'] and $m3){
 mysql_query("update user_bank set hig_amount=hig_amount+$m3 where userid='{$pids[2]['userid']}'");
getsql::banklog($m3, 'active',$pids[2]['userid'],"下下级{$username}参加累计充值活动奖励",'','','',$con_system['active_charge2_end']);

}

	}
  }

  }

	}

	}


}



//充值活动

function active_charge1($userid,$amount){
	  		global $db,$_SESSION,$con_system;




if(time()>=strtotime($con_system['active_charge1_begin']) and time()<strtotime($con_system['active_charge1_end']) and $con_system['active_charge1_open']==1){
	 //今日首次充值
$time=date('Y-m-d')." 00:00:00";

	$row=$db->fetch_first("select sum(moneys) as moneys from user_bank_log where userid='{$userid}' and cate='Recharge_to_system' and creatdate>='{$time}'");
       if(!$row['moneys']){


  	$money=$amount;
  	$m1=$m2=$m3=0;
  	for($i=1;$i<$con_system['active_charge1_num'];$i++){
  		$t=$i-1;
	if(($money>=$con_system['active_charge1_xf_'.$t] and $money<$con_system['active_charge1_xf_'.$i])  or ($i==$con_system['active_charge1_num']-1 and $money>=$con_system['active_charge1_xf_'.$i]) ){
if($i==$con_system['active_charge1_num']-1) $t=$i;

		$m1=$con_system['active_charge1_jl1_'.$t];
$m2=$con_system['active_charge1_jl2_'.$t];
$m3=$con_system['active_charge1_jl3_'.$t];
		break;
	}

	}


	$user=$db->fetch_first("select username from user where userid='{$userid}'");
	$username=$user['username'];
	$pids=get_user_pid($userid);
	if($m1>0  and $userid){

 mysql_query("update user_bank set hig_amount=hig_amount+$m1 where userid='$userid'");
getsql::banklog($m1, 'active',$userid,'当日首次充值金活动奖励');


if($pids[1]['userid'] and $m2){
 mysql_query("update user_bank set hig_amount=hig_amount+$m2 where userid='{$pids[1]['userid']}'");
getsql::banklog($m2, 'active',$pids[1]['userid'],'下级'.$username.'当日首次充值活动奖励');

}

	if($pids[2]['userid']  and $m3){
 mysql_query("update user_bank set hig_amount=hig_amount+$m3 where userid='{$pids[2]['userid']}'");
getsql::banklog($m3, 'active',$pids[2]['userid'],'下下级'.$username.'当日首次充值活动奖励');

}

	}
       }


}

return true;
}



//提现活动

function ative_plat($userid,$amount){

	global $db,$_SESSION,$con_system;
	if(time()>=strtotime($con_system['active_plat_begin']) and time()<strtotime($con_system['active_plat_end']) and $con_system['active_plat_open']==1){
$bank=	$db->fetch_first("select * from user_bank where userid='{$userid}'");
	if(!$bank['plat']){



  	$money=$amount;
  	$m1=$m2=$m3=0;
  	for($i=1;$i<$con_system['active_plat_num'];$i++){
  		$t=$i-1;
	if(($money>=$con_system['active_plat_xf_'.$t] and $money<$con_system['active_plat_xf_'.$i])  or ($i==$con_system['active_plat_num']-1 and $money>=$con_system['active_plat_xf_'.$i]) ){
if($i==$con_system['active_plat_num']-1) $t=$i;

		$m1=$con_system['active_plat_jl1_'.$t];
$m2=$con_system['active_plat_jl2_'.$t];
$m3=$con_system['active_plat_jl3_'.$t];
		break;
	}

	}
		$user=$db->fetch_first("select username from user where userid='{$userid}'");
	$username=$user['username'];
	$pids=get_user_pid($userid);
	if($m1>0){

 mysql_query("update user_bank set hig_amount=hig_amount+$m1 where userid='$userid'");
getsql::banklog($m1, 'active',$userid,'首次提现活动奖励');


if($pids[1]['userid'] and $m2){
 mysql_query("update user_bank set hig_amount=hig_amount+$m2 where userid='{$pids[1]['userid']}'");
getsql::banklog($m2, 'active',$pids[1]['userid'],'下级'.$username.'首次提现活动奖励');

}

	if($pids[2]['userid']  and $m3){
 mysql_query("update user_bank set hig_amount=hig_amount+$m3 where userid='{$pids[2]['userid']}'");
getsql::banklog($m3, 'active',$pids[2]['userid'],'下下级'.$username.'首次提现活动奖励');

}

	}


	}

	}
}

?>