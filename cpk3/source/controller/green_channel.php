<?php
  $userid = $_SESSION['userid'];
  if ($userinfo['istry'] == 1) {
      show_message("您现在还是试用账户，不允许走绿色通道", $_SERVER['HTTP_REFERER']);
  }
  // 账号状态判断
  $user_bank = $db->exec("select * from user_bank where userid='{$userid}'");
  if ($user_bank['status'] == 1) {
      show_message("您的账户已经被锁定，暂时无法提现", $_SERVER['HTTP_REFERER']);
  }
  // 提现密码判断
  $secpwd = isset($_POST['pass']) ? $_POST['pass'] : $_GET['pass'];
  $user_pass = array();
  $user_pass_sql = "select u.password as upass,b.password as bpass from " . DB_PREFIX . "user as u," . DB_PREFIX . "user_bank as b where u.userid=b.userid and u.userid='$userid'";
  $user_pass = $db->fetch_first($user_pass_sql);
  if (md5($secpwd) != $user_pass[bpass]) {
      show_message("提现密码不正确", $_SERVER['HTTP_REFERER'], 'warn');
      exit();
  }
  // 提现次数判断
  $fromtime = date("Y-m-d") . " 00:00:00";
  $num = $db->fetch_first("select count(*) as num from user_funds where userid='{$_SESSION[userid]}' and creatdate>='$fromtime' and cate='platform'");
  if ($num['num'] >= $config['MaxGetCash_num']) {
      show_message("您今天的提现次数已经超过" . $config['MaxGetCash_num'] . "次，请明天再来", $_SERVER['HTTP_REFERER'], 'warn');
  }
  // 提现时间判断
  $from = str_to_time($con_system['Auto_JieS_Begin']);
  $to = str_to_time($con_system['Auto_JieS_End']);
  $nowtime = str_to_time(date('H:i:s'));
  $agree = 0;
  if ($from <= $to) {
      if ($nowtime >= $from and $nowtime < $to) {
          $agree = 1;
      }
  } else {
      if ($nowtime >= $from or $nowtime < $to) {
          $agree = 1;
      }
  }
  if ($agree == 0) {
      show_message("'提现时间为{$con_system['Auto_JieS_Begin']}到{$con_system['Auto_JieS_End']}'", 'home_report_nav.html', 'warn');
      exit();
  }
  // 洗码条件判断
  $amount = get_user_amount($_SESSION['userid']);
  if ($amount['low_amount'] > 0) {
      show_message("您的洗码金额大于0，不能提现", 'home_report_nav.html', 'warn');
      exit();
  }

  $amount = isset($_POST[getMoney]) ? intval($_POST[getMoney]) : intval($_GET[getMoney]);
  if (!$secpwd || !$amount) {
      show_message('所有选项必须填写', $_SERVER['HTTP_REFERER'], 'warn');
      exit();
  }

  if ($config['MaxGreen_amount']  < $amount) {
      show_message("提现金额不能高于" . $config['MaxGreen_amount'] . "元", $_SERVER['HTTP_REFERER'], 'warn');
      exit();
  }

  if ($amount < $config['MinGetCash_amount']) {
      show_message("提现金额不能低于" . $config['MinGetCash_amount'] . "元", $_SERVER['HTTP_REFERER'], 'warn');
      exit();
  }
  $user_amount = getsql::moneys($userid);
  if ($amount - $user_amount > 0) {
      show_message('您的余额不足，请更改提现金额。', $_SERVER['HTTP_REFERER'], 'warn');
      exit();
  }
  //add_platform($_SESSION['userid'], $amount, $_POST['bank_id'], 1);

  //$db->query ( "update user_bank set hig_amount=hig_amount-$amount,frze_amount=frze_amount+$amount where userid='{$userid}'" );
$db->query ( "update user_bank set hig_amount=hig_amount-$amount where userid='{$userid}'" );

  if (! $user_bank ['low_amount'])
      $user_bank ['low_amount'] = '0.00';
  $order_sn = 'PLAT-' . time () . rand ( 10000, 99999 );

  //$amountafter=$user_bank['hig_amount'];
  //$hig_amount=$amountafter+$amount;
  $hig_amount=$user_bank['hig_amount'];
  $amountafter=$hig_amount-$amount; 

  $bank_list = $db->fetch_first("select * from user_bank_list where userid='{$userid}'");

  $nowtime = date ( "Y-m-d H:i:s" );
  $array = [
      'userid' => $userid,
      'money' => $amount,
      'cate' => 'platform',
      'creatdate' => $nowtime,
      'realname' => $bank_list['realname'],
      'banknum' => '',
      'bankname' => '绿色通道',
      'bankinfo' =>'',
      'status' => 1,
      'hig_amount' => $hig_amount,
      'amountafter' => $amountafter,
      'low_amount' => $user_bank['low_amount'],
      'order_sn' => $order_sn
  ];

  $db->insert ( "user_funds", $array );
  $id = $db->insert_id ();

  //---------------------------------------充值
  $price = $amount;
  //$id = add_charge($_SESSION['userid'], $price, $_POST['selectbank'], 0, $_POST['remark']);
  $order_sn = time() . rand(1000, 9999);
  $charge_sum = $user_bank['charge_sum'];
  if ($charge_sum == 0) $first = 1;
  else $first = 0;
  $nowtime = date("Y-m-d H:i:s");
  $array = [
      'userid' => $userid,
      'money' => $amount,
      'cate' => 'recharge',
      'Man_remark' => '绿色通道',
      'creatdate' => $nowtime,
      'realname' =>  $bank_list['realname'],
      'banknum' => '',
      'bankname' => '绿色通道',
      'status' => 1,
      'hig_amount' => $user_bank ['hig_amount'],
      'amountafter' => $user_bank ['hig_amount'],
      'low_amount' => $user_bank ['low_amount'],
      'online' => 0,
      'order_sn' => $order_sn,
      'payname' => $bank_list['realname'],
      'first' => $first,
      'type' => 'green'
  ];

  $db->insert("user_funds", $array);
  //-------
  $perid = $array ['userid'];
  $money = $array ['money'];
  $db->query("update user_funds set `first`='{$first}' where id='{$id}'");
  if ($con_system ['active_charge1_begin'] <= $array['creatdate'] and $con_system ['active_charge1_end'] >= $array['creatdate'])
      active_charge1($perid, $money);
  $pay_pre = $con_system ['pay_pre'];

  $money2 = $money * $pay_pre / 100;
  $charge_sum = $charge_sum + $money;
  //$money1 = $money - $money2;
  $strSqls = "update user_bank set hig_amount=hig_amount+$money,low_amount=low_amount+$money2 ,charge=charge+$money,charge_sum='{$charge_sum}' where userid='$perid'";

  $db->query($strSqls);

  $bank = $db->fetch_first("select * from user_bank where userid='{$perid}'");
  $db->query("update user_funds set amountafter='{$bank['hig_amount']}',low_amount='{$bank['low_amount']}',Man_remark='{$remark}' where id='{$id}'");
  $user = $db->fetch_first("select * from user where userid='{$perid}'");

  //------------
    cumulativeRecharge($perid, $bank_list['realname'], $money);
//$zeroTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
//$isDayFirst = $db->fetch_first ( "select count(*) as `count` from user_funds where cate='recharge' and (userid='{$perid}' or payname='{$bank_list['realname']}') and creatdate>='{$zeroTime}' and status=1 and `type` in ('green', 'hand')" );
//if ($isDayFirst['count'] <= 1) {
//    $firstRechargeMoney = 0;
//    if ($money >= 500 and $money < 1000) {
//        $firstRechargeMoney = 18;
//    } elseif ($money >= 1000 and $money < 5000) {
//        $firstRechargeMoney = 28;
//    }elseif ($money >= 5000 and $money < 10000) {
//        $firstRechargeMoney = 68;
//    }elseif ($money >= 10000 and $money < 30000) {
//        $firstRechargeMoney = 118;
//    }elseif ($money >= 30000 and $money < 50000) {
//        $firstRechargeMoney = 388;
//    }elseif ($money >= 50000 and $money < 100000) {
//        $firstRechargeMoney = 688;
//    }elseif ($money >= 100000 and $money < 200000) {
//        $firstRechargeMoney = 1888;
//    }elseif ($money >= 200000 and $money < 300000) {
//        $firstRechargeMoney = 3888;
//    }elseif ($money >= 300000) {
//        $firstRechargeMoney = 6888;
//    }
//    if ($firstRechargeMoney > 0) {
//        $strSqls = "update user_bank set hig_amount=hig_amount+$firstRechargeMoney,charge=charge+$firstRechargeMoney where userid='$perid'";
//        $db->query ( $strSqls );
//        $insSql = "insert into active (userid, time, type, charge) values ('{$perid}','".time()."','gift','{$firstRechargeMoney}')";
//        $db->query ( $insSql );
//	getsql::banklog ( $firstRechargeMoney, 'active', $perid, '首次充值赠送' );
//    }
//}



    //------------------



  if ($con_system ['active_charge_begin'] <= $array['creatdate'] and $con_system ['active_charge_end'] >= $array['creatdate'])
      active_charge($perid, $money);

  add_score($perid,$money);

  show_message('绿色通道操作完成', '/home_report_nav.html', 'ok');
  exit();

?>
