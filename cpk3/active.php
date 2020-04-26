<?php
session_start();
include_once 'source/function/run.php';





	if($_GET['type']){
		if($con_system['active_'.$_GET['type'].'_open']=='0'){
				echo "Error0";exit();
		}
		$begin=$con_system['active_'.$_GET['type'].'_begin'];
		$begin=strtotime($begin);
		$end=strtotime($con_system['active_'.$_GET['type'].'_end']);

		if($begin>time() or  $end<time() ){

		//		echo 'Error00';exit();

		}



	}


if($_GET['type']=='bank'){

	$bank=$db->exec("select * from user_bank_list where userid='{$_SESSION['userid']}'");
	if($bank){
$begin=date('Y-m-d H:i:s',time()-30*24*3600);
$end=date('Y-m-d H:i:s',time());
   $yingkui=get_yingkui($_SESSION['userid'],$begin,$end);
if($yingkui['recharge']<$con_system['active_bank_min']){

		echo "error|您的充值金额目前不足{$con_system['active_bank_min']}元";

}

else{

$begin=date('Y-m-d',time()).' 00:00:00';
$end=date('Y-m-d',time()).' 23:59:59';
$row=$db->exec("select count(*) as num from active where type='charge' and userid='{$_SESSION['userid']}' and time>='".strtotime($begin)."' and time<='".strtotime($end)."'");
if($row['num']>=$con_system['active_bank_max']){

			echo "error|今天的名额已经抢光了，请明天再来";
	exit();
}


	$ip=getIP();
$row=$db->exec("select * from active where type='bank' and ip='{$ip}' ");
if($row){

	echo "error|很抱歉，您的ip已经领取过了";
exit();
}
else{

	$row=$db->exec("select * from active where type='bank' and realname='{$bank['realname']}' ");
if($row){

	echo "error|{$bank['realname']}已经领取了，不要重复领取";

}
else{

	$user=get_user_info($_SESSION['userid']);
	if($user['modes']<1940){
		
		
		echo "error|返点大于1940才能领取";exit();
		
	}
	
	
	
$row=$db->exec("select * from active where type='bank' and userid='{$_SESSION['userid']}' ");

if($row){
		echo "error|只能领取一次，请不要重复领取";

}
else{
	$db->query("insert into active(userid,type,ip,realname,time) values('{$_SESSION['userid']}','bank','{$ip}','{$bank['realname']}','".time()."') ");
   add_money($_SESSION['userid'],$con_system['active_bank_money'],'active','绑卡活动奖励');

		echo "ok|领取成功";
}
}

}

}



	}
	else {

		echo "error|您还没有绑定银行卡";

	}


}

if($_GET['type']=='charge'){


$begin=date('Y-m-d',time()).' 00:00:00';
$end=date('Y-m-d',time()).' 23:59:59';
   $yingkui=get_yingkui($_SESSION['userid'],$begin,$end);
if($yingkui['recharge']<$con_system['active_charge_min']){

		echo "error|您的今日充值金额目前不足{$con_system['active_charge_min']}元";
exit();
}

$row=$db->exec("select * from active where type='charge' and userid='{$_SESSION['userid']}' and time>='".strtotime($begin)."' and time<='".strtotime($end)."'");

if($row){
		echo "error|每天只能领取一次，请不要重复领取";
exit();
}
$begin=date('Y-m-d H',time()).':00:00';
$end=date('Y-m-d H',time()).':59:59';

$row=$db->exec("select count(*) as num from active where type='charge' and userid='{$_SESSION['userid']}' and time>='".strtotime($begin)."' and time<='".strtotime($end)."'");
if($row['num']>=$con_system['active_charge_sum']){

			echo "error|本轮已经领光了，请一小时后再来";
	exit();
}

	$ip=getIP();
$row=$db->exec("select * from active where type='charge' and ip='{$ip}' and time>='".strtotime($begin)."' and time<='".strtotime($end)."'");
if($row){

	echo "error|很抱歉，您的ip今天已经领取过了";exit();

	
}
	$now=time();
mysql_query("insert into `active` (userid,time,ip,complate,type,charge) values('{$_SESSION[userid]}','{$now}','{$ip}','0','charge','{$yingkui['recharge']}') ");
$money=$yingkui['recharge']*$con_system['active_charge_pre']/100;
   add_money($_SESSION['userid'],$money,'active','充值活动奖励');

		echo "ok|领取成功";

}


if($_GET['type']=='lock'){

		echo "Error";exit();

}

if($_GET['type']=='fee'){

		$time=strtotime(date('Y-m-d')." 00:00:00");

	$active=$db->fetch_first("select * from `active` where  userid='{$_SESSION['userid']}' and time>='$time'  and type='fee'");
	if($active){

		echo "Error3";exit();
	}
		$time=date("Y-m-d")." 00:00:00";

$active_fee_bank="'".str_replace('|', "','", $con_system['active_fee_bank'])."'";
	$row=$db->fetch_first("select sum(money) as moneys from user_funds where userid='{$_SESSION[userid]}' and status='1' and cate='recharge' and creatdate>='{$time}'  and bankname in ({$active_fee_bank})");


	if($row['moneys']>0){
			$fee=$row['moneys']*$con_system['active_fee_pre']/100;
			if($fee>100) $fee=100;
				$ip=getIP();

		$now=time();
	mysql_query("insert into `active` (userid,time,ip,complate,type,charge) values('{$_SESSION[userid]}','{$now}','{$ip}','1','fee','{$fee}') ");
	if(mysql_affected_rows()>0){
		 mysql_query("update user_bank set hig_amount=hig_amount+$fee where userid='{$_SESSION['userid']}'");
getsql::banklog($fee, 'active',$_SESSION['userid'],'返还手续费活动奖励');
	//mysql_query("update user_bank set `fee_amount`=fee_amount+$fee where userid='{$_SESSION['userid']}'");
	echo "OK";exit();

	}
	}
	else{

		echo "Error1";exit();
	}


}



if($_GET['type']=='lot'){
			$time=date("Y-m-d")." 00:00:00";
		$row=$db->fetch_first("select sum(moneys) as moneys from user_bank_log where userid='{$_SESSION[userid]}' and cate='Recharge_to_system' and creatdate>='{$time}'");

	if(!$row['moneys'])		{echo "Error6";exit();	}
			$time=strtotime($time);
	$active=$db->fetch_first("select count(*) as num from `active` where  userid='{$_SESSION['userid']}' and time>='$time'  and type='lot'");

	$last_num=$con_system['active_lot_time']-$active['num'];

	if(!$last_num)		{echo "Error5";exit();	}
	$money=$row['moneys'];

	for($i=1;$i<$con_system['active_lot_num'];$i++){
	 		$t=$i-1;
	if($money>=$con_system['active_lot_charge_'.$t] and ($money<$con_system['active_lot_charge_'.$i] or $i==$con_system['active_lot_num']-1)){
		if($i==$con_system['active_lot_num']-1)	 $t=$i;
$min=$con_system['active_lot_min_'.$t];
$max=$con_system['active_lot_max_'.$t];
$pre=$con_system['active_lot_pre_'.$t];
		break;
	}


	}
		$ip=getIP();
	if($pre>=100)$code=1;
	else
	$code=rand(1,100/$pre);


		$now=time();

	if($code==1){
		$prize=rand($min, $max);


		if($prize>0){
	mysql_query("insert into `active` (userid,time,ip,complate,type,charge) values('{$_SESSION[userid]}','{$now}','{$ip}','1','lot','{$prize}') ");
		 mysql_query("update user_bank set hig_amount=hig_amount+$prize where userid='{$_SESSION[userid]}'");

            getsql::banklog($prize, 'active',$_SESSION[userid],'免费抽奖活动，中奖');

		}



		if($prize<10) $prize='000'.$prize;
		else if($prize<100) $prize='00'.$prize;
		else if($prize<1000) $prize='0'.$prize;


      	echo $prize;exit;

	}
	else{
			mysql_query("insert into `active` (userid,time,ip,complate,type,charge) values('{$_SESSION[userid]}','{$now}','{$ip}','1','lot','0') ");
		echo "0000";exit();

	}

}

if($_GET['type']=='sign'){
    $user=get_user_info($_SESSION['userid']);
    if($user['sign_time']>strtotime(date('Y-m-d',time()).' 00:00:00')){

        echo "error|今日已签到，请不要重复签到";exit();

    }else{
        $today=get_day_time1();
        $begintime=$today[0];
        $endtime=$today[1];
        $yingkui=get_yingkui($_SESSION['userid'],$begintime,$endtime);

        if($yingkui['buy']>=$con_system['active_sign_min']){
            $from=strtotime(date('Y-m-d',time()-24*3600).' 00:00:00');
            if($user['sign_time']>=$from) $sign_num=$user['sign']+1;
            else $sign_num=1;
            $money=0;
            for($i=0;$i<$con_system['active_sign_num'];$i++) {
                $day = $con_system["active_sign_day_{$i}"];

                if($sign_num==$day){
                    $money = $con_system["active_sign_money_{$i}"];
                    break;
                }
            }
            $now=time();
            $sql="insert into sign_log(`uid`,`time`,`day`,`money`) values('{$_SESSION['userid']}','{$now}','{$sign_num}','{$money}')";
            $db->query($sql);
            if($db->affected_rows()>0){
                $db->query("update user set sign='{$sign_num}',sign_time='{$now}' where userid='{$_SESSION['userid']}'");
               if($money>0){
                   add_money($_SESSION['userid'],$money,'active','签到奖励');

               }
            }

            echo "ok|签到成功";exit();


        }
        else{

            echo "error|您今日的投注金额还未达到{$con_system['active_sign_min']}元";exit();
        }


    }



exit();
}


if($_GET['type']=='vip_update'){
	    if($_SESSION['userid']){

            fafang_group_prize($_SESSION['userid']);
            show_message('恭喜您，VIP晋级奖励领取成功','index_active.html');
        }
        else{
            show_message('请先登录','login.html');

        }

exit();
}

if($_GET['type']=='day_prize'){
    if($_SESSION['userid']){




      if($con_system['active_day_open']==1){



          if(date('H:i:s')>$con_system['active_day_begin'] and date('H:i:s')<$con_system['active_day_end']){
              $from=strtotime(date('Y-m-d',time()).' 00:00:00');
              $row=$db->exec("select * from active where userid='{$_SESSION['userid']}' and  type='day' and time>'{$from}'");
              if($row){

                  show_message('每日加奖今日已领取完毕','index_active.html');
              }else{
                  $yingkui=get_yingkui($_SESSION['userid'],date('Y-m-d',time()-24*3600).' 00:00:00',date('Y-m-d',time()-24*3600).' 23:59:58');
                  $userinfo=$db->exec("select * from user where userid='{$_SESSION['userid']}'");
                  $min_group=$db->exec("select * from user_group where id='{$con_system['active_day_group']}'");

                  $pre=0;
                  if($userinfo['groupid']>=$min_group['id']){
                      if($yingkui['buy']>=100) {

                          $pre=$con_system['active_day_0_'.$userinfo['groupid']];
                      }
                      if($yingkui['buy']>=10000) {

                          $pre=$con_system['active_day_1_'.$userinfo['groupid']];
                      }
                      if($yingkui['buy']>=200000) {

                          $pre=$con_system['active_day_2_'.$userinfo['groupid']];
                      }
                  }

                  $prize=$yingkui['buy']*$pre/100;
                  $db->query("insert into active(userid,type,time,charge,buy,pre) VALUES ('{$_SESSION['userid']}','day','".time()."','{$prize}','{$yingkui['buy']}','{$pre}')");
                  if($prize>0 and $db->affected_rows()>0){
                      $strSqls = "update user_bank set hig_amount=hig_amount+$prize,low_amount=low_amount+$prize where userid='{$_SESSION['userid']}'";
                      $db->query ( $strSqls );
                      getsql::banklog ( $prize, 'active', $_SESSION['userid'], "领取每日加奖活动奖励" );
                  }



                  show_message('恭喜您，每日加奖领取成功','index_active.html');
              }

          }else{
              show_message('未在领取时间返回','index_active.html');

          }
      }else{



          show_message('恭喜您，每日加奖已经关闭','index_active.html');

      }


    }
    else{
        show_message('请先登录','login.html');

    }

    exit();
}


?>