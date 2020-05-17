<?php

function rebate_select($max, $min = 1800, $select = '')
{

	$str = '';
	for ($i = $max; $i >= $min; $i = $i - 2) {
		$num = number_format(($i - 1800) / 20, 1);
		if ($i == $select) $se = "selected";
		else $se = '';
		$str .= "<option value='{$num}' {$se} >返点：{$num} &nbsp; 奖金：{$i}</option>";

	}

	return $str;

}


function add_money($uid, $money, $type, $info = '', $buy_id = '', $time = '')
{
	global $db, $con_system;
	$strSql = "update user_bank set hig_amount=hig_amount+'$money' where userid='$uid'";
	$db->query($strSql);

	if ($type == 'hig_add_admin' or $type == 'hig_lost_admin' or $info == '充值卡充值') {
		$bank       = $db->exec("select * from user_bank where userid='{$uid}'");
		$charge_sum = $bank['charge_sum'];
		$pay_pre    = $con_system ['pay_pre'];

		$money2 = $money * $pay_pre / 100;

		$charge_sum = $charge_sum + $money;
		$sql        = "update user_bank set low_amount=low_amount+$money2 ,charge=charge+$money,charge_sum='{$charge_sum}' where userid='$uid'";
		$db->query($sql);
	}

	//$money1 = $money - $money2;

	if ($time == '') $time = date('Y-m-d H:i:s');
	if ($money < 0 and $type != 'active' and $type != 'hig_add_admin' and $type != 'hig_lost_admin') $money = -$money;
	getsql::banklog($money, $type, $uid, $info, $buy_id, '', '', $time, $money2);

	return true;

}

function set_chat_data($userid)
{
	global $db, $con_system;

	$userinfo = get_user_info($userid);

	$data             = array();
  	$data['uid'] = $userinfo['userid'];
	$data['username'] = $userinfo['username'];
	$data['nickname'] = $userinfo['nickname'];
	$data['rid']      = $userinfo['rid'];
	$data['groupid']  = $userinfo['groupid'];
	$data['higherid'] = $userinfo['higherid'];
	$uData = get_user_pid($userinfo['userid']);
	$uData = array_reverse($uData);
	if ($userinfo['higherid'] > 0) {
		$parent             = get_user_info($userinfo['higherid']);
		$data['parentname'] = $parent['username'];
	}
	$data['pid'] = $uData[1]['userid'];
  	//$data['adminid'] = $uData[1]['userid'];
  	//$data['regtime']  = strtotime($userinfo['registertime']);
    $data['regtime']  = $userinfo['registertime'];
	$sex              = 0;
	if ($userinfo['sex'] == '男') $sex = 1;
	if ($userinfo['sex'] == '女') $sex = 2;
	$data['sex'] = $sex;

	return $data;
}


function set_rebate($id)
{
	global $db;

	$buy = $db->exec("select * from game_buylist where id='{$id}' and status='1'");

	$game_type = $db->exec("select skey from game_type where ckey='{$buy['playkey']}'");


	$uid   = $buy['userid'];
	$money = $buy['money'];

	$user     = $db->exec("select username from user where userid='{$uid}'");
	$username = $user['username'];
	if ($uid > 0) {

		if ($buy['rebate'] > 0 and $buy['is_rebate1'] == '0') {
//		$money1=$money*$buy['rebate']/100;
//			if($money1>0.001){
//						$db->query("update game_buylist set is_rebate1='1' where id='{$buy['id']}'");
//						if($db->affected_rows()>0)
//	add_money($uid, $money1, 'hig_rebate','个人返点',$buy['id']);
//
//			}
		}

		if ($buy['is_rebate2'] == '0') {

			$db->query("update game_buylist set is_rebate2='1' where id='{$buy['id']}'");
			if ($db->affected_rows() > 0) {
				$arr = get_user_pid($uid);


				for ($i = 1; $i <= count($arr); $i++) {
					$rebate1 = unserialize($arr[$i]['rebates']);
					$rebate2 = unserialize($arr[$i - 1]['rebates']);

					if ($rebate1[$game_type['skey']] > $rebate2[$game_type['skey']]) {
						$money2 = number_show($money * ($rebate1[$game_type['skey']] - $rebate2[$game_type['skey']]) / 100, 3);
						if ($money2 > 0.001) {
							add_money($arr[$i]['userid'], $money2, 'hig_rebate', "下级[{$username}]返点", $buy['id']);
							$sql = "insert into user_fandian_log(uid,fromid,money,time,buyid,virtual) values('{$arr[$i]['userid']}','{$buy['userid']}','{$money2}','" . time() . "','{$buy[id]}','{$arr[$i]['virtual']}')";
							$db->query($sql);
							$db->query("update user set rebatesum=rebatesum+{$money2} where userid='{$arr[$i]['userid']}'");
						}
					}


				}
			}


		}

	}
}


function show_buystatus($buyinfo, $type = 0)
{
	if ($buyinfo[isprize] == "") {
		$status = "<font color='green'>未开奖</font>";
	}
	if ($buyinfo[isprize] == "is_yes") {
		$status = "<font color='red'>已中奖</font>";
	}

	if ($buyinfo[isprize] == "is_no") {
		$status = "<font color='blue'>未中奖</font>";
		if ($type == 1) {
			$status = "<font color='#fff'>未中奖</font>";
		}
	}
	if ($buyinfo[status] == "9") {
		$status = "<font color='green'>已撤单</font>";
	}


	return $status;
}


function is_online($userid)
{
  if(!$userid) {
    return 0;
  }
	global $con_system, $db;
//	$linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
	$linetime = date('Y-m-d H:i:s', time() - 60 * 60);
	$line     = $db->fetch_first("select * from user_online where userid='{$userid}' and uptime>'{$linetime}'");
	if ($line) return true;
	else return false;

}

function is_online2($userid) {
  if(!$userid) {
    return 0;
  }
  global $db;
  $linetime = date('Y-m-d H:i:s', time() - 60 * 60);
  $line     = $db->fetch_first("select count(*) as total from user_online where userid in ({$userid}) and uptime>'{$linetime}'");
  return $line['total'];
}

function get_team_info($userid)
{
	global $db;
	$next_list  = get_user_nextid($userid);
	$user_list  = explode(',', $next_list);
	$arr['num'] = count($user_list) - 1;
	$money      = 0;
	$online     = 0;

	foreach ($user_list as $value) {
		$value = str_replace('"', '', $value);
		$value = str_replace('\'', '', $value);
		$temp  = get_user_amount($value);
		if ($value != $userid)
			$money += $temp['total_amount'];
		if (is_online($value)) $online++;

	}


	$arr['money']  = $money;
	$arr['online'] = $online;
	$db->query("update user set team_num='{$arr['num']}',team_money='{$arr['money']}' where userid='{$userid}'");
	return $arr;
}

function get_team_info2($user_id_list)
{
	global $db;
	$user_list = explode(',', $user_id_list);
	$arr['num'] = count($user_list) - 1;  //下级人数 减掉自己
	$money      = 0;
	$online     = 0;

//	foreach ($user_list as $value) {
//		$temp=get_user_amount($value);
//		if($value!=$userid)
//			$money+=$temp['total_amount'];
//		if(is_online($value)) $online++;
//
//	}
	array_shift($user_list);
	$temp = get_user_amount($user_list);
	$money = $temp['total_amount'];
	$online = is_online2($user_id_list);


	$arr['money']  = $money;
	$arr['online'] = $online;
	$db->query("update user set team_num='{$arr['num']}',team_money='{$arr['money']}' where userid='{$userid}'");
	return $arr;
}

function show_user_type($user)
{
	if ($user['isproxy'] == 1) return '玩家';
	else {

		return "代理";

	}

}

function showgroup_title($groupid)
{
	global $db;
	$group = $db->exec("select title from user_group where id='{$groupid}'");
	return $group['title'];

}

function showrealname($userid)
{
	global $db;
	$bank = $db->exec("select realname from user_bank_list where userid='{$userid}'");
	return $bank['realname'];

}


function show_order($order, $url = '')
{

	global $_GET;

	$html = "";
	$str  = '';
	foreach ($_GET as $key => $value) {

		if ($key != 'orderby' and $key != 'mod' and $key != 'code') {
			if ($str == '') $str = "{$key}={$value}";
			else $str .= "&{$key}={$value}";

		}


	}
	if ($str != '') $str .= "&";
	if ($_GET['orderby'] == "{$order} desc") {

		$html = "    <i class='arrow-up1' onclick=\"location.href='{$url}?{$str}orderby={$order} asc';\"></i>";


	} else if ($_GET['orderby'] == "{$order} asc") {

		$html = "    <i class='arrow-down1' onclick=\"location.href='{$url}?{$str}orderby={$order} desc';\"></i>";


	} else {

		$html = "    <i class='arrow-up' onclick=\"location.href='{$url}?{$str}orderby={$order} desc';\"></i>";

		$html .= "    <i class='arrow-down' onclick=\"location.href='{$url}?{$str}orderby={$order} asc';\"></i>";

	}
	return $html;
}

function show_message($promptContent, $nextUrl, $type = 'ok', $displayTime = '3')
{

	if ($type == 'ok') $pos = '0px -48px';
	else if ($type == 'warn') $pos = '0 -96px ';
	else if ($type == 'error') $pos = '-48px 0px ';
	else if ($type == 'confirm') $pos = '-48px -48px ';
	else $pos = "0px 0px";
	?>
	<?php

	if (isMobile()) {
		?>
    <meta name="viewport"
          content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>


		<?php
	}
	?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <style>
    table {
      font-size: 16px;
    }

    .bigIcon {
      margin-left: 35px;
      width: 48px;
      height: 48px;
      background-image: url(/template/default/2017/images/icons.png);
      background-repeat: no-repeat;
      background-position: 0px -48px;
    }
  </style>
  <div style='height:180px;max-width:400px;width:<?php if ($_GET['mobile'] == 1) echo '95%'; else echo "400px"; ?>;margin:100px auto;padding-top: 2px; border-radius: 5px;    border:1px solid #d4d2cc;'>

    <table height="200" border="0" cellpadding="0" cellspacing="0" style="width:100%;">

      <tr>
        <td colspan="2" style="line-height:32px;font-size:18px;color:#222;font-weight:700;padding-left:13px;">温馨提示</td>
      </tr>
      <tr>

        <td align="center" valign="top"
            style="padding:20px;font-size:15px;color:#000;font-weight:400;line-height:30px;">
					<?php
					$promptBottomWaiting = '页面正在跳转中，请耐心等待........';

					echo "<div style='color:#ed4646;font-weight:600;'>$promptContent</div>";
					echo "{$promptBottomWaiting}<br>";
					echo "<a href=\"" . $nextUrl . "\" style='color:#ccc'>如果不能跳转，请点击此处</a><br>";
					?>
        </td>
      </tr>
    </table>


  </div>

	<?php
	echo "<script language=\"javascript\"> setTimeout(\"window.location.href='" . $nextUrl . "'\", $displayTime*1000) </script>";
	exit();

}


function show_message1($promptContent, $con1, $type = 'ok', $displayTime = '5')
{

	if ($type == 'ok') $pos = '0px -48px';
	else if ($type == 'warn') $pos = '0 -96px ';
	else if ($type == 'error') $pos = '-48px 0px ';
	else if ($type == 'confirm') $pos = '-48px -48px ';
	else $pos = "0px 0px";
	?>

  <!DOCTYPE html>
  <html lang="zh-CN" xml:lang="zh-CN">
	<?php

	if (isMobile()) {
		?>
    <meta name="viewport"
          content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>


		<?php
	}
	?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <style>
    table {
      font-size: 16px;
    }

    .bigIcon {
      margin-left: 35px;
      width: 48px;
      height: 48px;
      background-image: url(/template/default/2017/images/icons.png);
      background-repeat: no-repeat;
      background-position: 0px -48px;
    }

    .btnArea {
      border-top: solid 1px #eef0f1;
      padding: 10px auto;
      margin-bottom: 10px;
    }

    .btnGroup {
      width: 100%;
      text-align: center;
    }

    .btnGroup .sgBtn {
      margin-top: 14px;
      margin-right: 10px;
    }

    .sgBtn {
      display: inline-block;
      cursor: pointer;
      width: 95px;
      height: 35px;
      line-height: 35px;
      text-align: center;
      color: #FFFFFF;
      border-radius: 5px;
    }

    .sgBtn.ok {
      background-color: #f37030;
      color: #FFFFFF;
    }

    .sgBtn.cancel {
      background-color: #546a79;
      color: #FFFFFF;
    }

    #BgDiv {
      background-color: #000000;
      position: absolute;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      opacity: 0.7;
      filter: alpha(opacity=40);
      -moz-opacity: 0.7;
    }
  </style>

  <div id="BgDiv"></div>


  <div style='height:200px;position:absolute;top:200px;z-index:100;background-color:#fff;<?php if ($_GET['mobile'] == 1) echo 'width:95%;left:2%;'; else echo "width:400px;left:40%;"; ?>; border-radius: 5px;  z-index:22;  border: 5px solid #d4d2cc;'>


    <table height="190" border="0" cellpadding="0" cellspacing="0" style="width:100%;">

      <tr>
        <td height="32" colspan="2"
            style="border-bottom: solid 1px #eef0f1;background-color:#f7f7f7;line-height:32px;font-size:18px;color:#222;font-weight:700;padding-left:10px;">
          温馨提示
        </td>
      </tr>
      <tr>

        <td style='width:80px;text-align:center;padding-top:30px;' valign="top">
          <div class='bigIcon' style='background-position:<?php echo $pos; ?>;'></div>

        </td>
        <td align="left" valign="middle"
            style="padding:20px;font-size:15px;color:#000;font-weight:400;line-height:30px;">


					<?php


					echo "<div style='color:#ed4646;font-weight:600;'>$promptContent</div>";

					if ($displayTime >= 0) {
						echo "{$con1}";


					}


					?>
        </td>
      </tr>

      <tr>


        <td colspan=2 valign="top" class='btnArea' style='height:50px;'>
          <div class="btnGroup"><a class="sgBtn ok" onclick='window.close();'>确定</a><a class="sgBtn cancel" id='cancel'
                                                                                       onclick='window.close();'>取消(5)</a>
          </div>
        </td>
      </tr>

    </table>


  </div>
  <script>
	var times =<?php echo $displayTime;?>;

	function note_change() {
	  times--;
	  document.getElementById('cancel').innerHTML = '取消(' + times + ')';
	  if (times == 0) window.close();
	}

	setInterval(function () {
	  note_change();
	}, 1000);


  </script>
  </html>
	<?php


	exit();
	return true;
}


function send_msg($toid, $title, $content, $fromid = '0', $replyid = '0')
{
	global $db;
	$time = date('Y-m-d H:i:s');
	$content = htmlspecialchars($content);
	$title = htmlspecialchars($title);
	$sql = "insert into user_msg(userid,perid,replyid,title,content,creatdate,status) value('{$toid}','{$fromid}','{$replyid}','{$title}','{$content}','{$time}','0')";
	$db->query($sql);

	return $db->insert_id();

}

function check_server()
{
	global $con_system;
	$server_ip    = gethostbyname($_SERVER['SERVER_NAME']);
	$install_ip   = $con_system['install_ip'];

	if (strpos($install_ip, $server_ip) === false) {

		if ($install_ip == '') $install_ip = $server_ip;
		else $install_ip .= "|" . $server_ip;
		update_sys('install_ip', $install_ip);
	}


}

function limitTime($userId, $sql) {
    global $db, $redis;
    $data = $redis->get('LIMIT_TIME' . $userId);
    if ($data) {
        return json_decode($data, true);
    }
  	$data = $db->getall($sql);
    $redis->set('LIMIT_TIME' . $userId, json_encode($data), 2);
    return $data;
}

function get_chaturl($path)
{
	global $con_system;
	$salt = rand(100000, 999999);
	$code = md5($salt . md5($con_system['chat_key']));

	$url = $con_system['chat_url'] . $path . '?code=' . $code . '&salt=' . $salt;

	return $url;
}

function get_chaturl_new($path)
{
  	$key = 'as89wkasjhcd1iwhek';
	global $con_system;
	$salt = rand(100000, 999999);
	$code = md5($salt . md5($key));

	$url = $con_system['chat_url'] . $path . '?code=' . $code . '&salt=' . $salt;

	return $url;
}

function avatar($uid = '')
{
	global $db, $_SESSION;

	if (!$uid) $uid = $_SESSION['userid'];

	$user = get_user_info($uid);
	if (strpos($user['avatar'], '.') !== false) return $user['avatar'];
	if (!$user['avatar']) $user['avatar'] = 0;

	return 'static/images/avatar/' . $user['avatar'] . '.jpg';

}

function login_online($userid, $ip = '', $session = '')
{
	global $db, $_SESSION;
	if (!$ip) $ip = getIP();
	if (!$session) {
		if (!$_SESSION['auth']) $_SESSION['auth'] = rand(100000, 999999);
		$session = $_SESSION['auth'];
	}
	$now = date('Y-m-d H:i:s');

	$row = $db->exec("select * from user_online where userid='{$userid}' and `session`='{$session}'");

	if ($row) {
		$db->query("update user_online set uptime='{$now}' where  id='{$row['id']}' ");
		$db->query("delete from user_online where  userid='{$userid}' and `id`!='{$row['id']}'");
	} else {
		$db->query("delete from user_online where  userid='{$userid}' ");
		$db->query("insert into  user_online(userid,creatdate,uptime,ip,`session`) values('{$userid}','{$now}','{$now}','{$ip}','{$session}')");
	}
	run_setup();
}

function set_kj_task()
{

	global $db, $_SESSION;
	$row     = $db->exec("select `value` from  `sys` where `key`='kj_task' ");
	$playkey = $row['value'];

	$row     = $db->exec("select id from game_type where ckey='{$playkey}'");
	$game_id = $row['id'];

	$game_list = $db->exec("select ckey from game_type where `status`='0' and id>'{$game_id}' order by id asc limit 0,1");
	if ($game_list['ckey']) {

		$next = $game_list['ckey'];
	} else {
		$game_list = $db->exec("select ckey from game_type where `status`='0' order by id asc limit 0,1");
		$next      = $game_list['ckey'];
	}
	$db->query("update `sys` set `value`='{$next}' where  `key`='kj_task' ");

	return $playkey;
}


function get_now_period($gamekey, $time_arrs)
{
    global $db, $con_system, $redis;
    include_once "source/config/play/lot_time_" . $gamekey . ".php";
    $data = $redis->get('game_type:' . $gamekey); // 数据不大情况下 可以用键值 否则建议改hash
    if ($data) {
        $row = json_decode($data, true);
    } else {
        $row = $db->exec("select * from game_type where ckey='{$gamekey}'");
        $redis->set('game_type:' . $gamekey, json_encode($row));
    }
//	$row = $db->exec("select * from game_type where ckey='{$gamekey}'");
    if (strpos($row['kjkey'], 'KL8') !== false) return get_now_period($row['kjkey'], $time_arrs);

	//处理加拿大快乐8时间异常
	if ($gamekey == 'JNDKL8' and date('w') == 1) {
		foreach ($time_arrs as $key => $value) {
			//	if($key<19) unset($time_arrs[$key]);
			$tt = $key + 18;
			if ($tt < 100) $tt = '0' . $tt;
			if ($time_arrs[$tt])
				$time_arrs[$key] = $time_arrs[$tt];
			else unset($time_arrs[$tt]);

		}
	}
	//////
	$nowtime    = date('H:i:s');
	$isbuy      = 1;
	$num        = 0;
	$sum        = count($time_arrs);
	$period     = '';
	$lastsecond = 0;
	$stoptime   = 0;
	$lotNum     = 0;
	$return     = array();
	$row        = $db->exec("select count(*) as num from game_time where playKey='{$gamekey}' and endTime<'{$nowtime}' order by endTime asc ");
	$num        = $row['num'];

	$game_time = $db->exec("select * from game_time where playKey='{$gamekey}' and endTime>='{$nowtime}' order by endTime asc limit 0,1");
	if ($game_time['id'] > 0) {
		//今日未结束
		$period     = date('Ymd', time()) . $game_time['lotNum'];
		$lastsecond = strtotime(date('Ymd', time()) . ' ' . $game_time['endTime']) - time();

		$lotNum          = $game_time['lotNum'];
		$return['begin'] = $game_time['beginTime'];
		$return['end']   = $game_time['endTime'];
		$return['lot']   = $game_time['endTime'];


	} else {
//今日已结束


        $game_time = $db->exec("select * from game_time where playKey='{$gamekey}' order by endTime asc limit 0,1"); // 需要追溯至期号生成或者开奖号码采集
		$period          = date('Ymd', time() + 24 * 3600) . $game_time['lotNum'];
		$lastsecond      = strtotime(date('Ymd', time() + 24 * 3600) . ' ' . $game_time['endTime']) - time();
		$lotNum          = $game_time['lotNum'];
		$return['begin'] = $game_time['beginTime'];
		$return['end']   = $game_time['endTime'];
		$return['lot']   = $game_time['endTime'];

	}

	//计算上一期开奖期号
	if ($num == 0) {
		$game_time = $db->exec("select * from game_time where playKey='{$gamekey}'  order by endTime desc limit 0,1");

		$pre_period = date('Ymd', time() - 24 * 3600) . $game_time['lotNum'];


	} else if ($num == $sum) {

		$game_time  = $db->exec("select * from game_time where playKey='{$gamekey}'  order by endTime desc limit 0,1");
		$pre_period = date('Ymd', time()) . $game_time['lotNum'];
	} else {
		$pre_period = $period - 1;
	}


	if ($gamekey == 'BJK3') {
		$start       = strtotime('2019-03-01 09:01:00');
		$BetweenDays = BetweenDays(time(), $start);
		if (time() > strtotime(date('Y-m-d') . ' 23:51:00')) {
			$BetweenDays++;
			$sec = 0;
		} else {
			$sec = floor((time() - strtotime(date('Y-m-d') . ' 09:01:00')) / 1200);
			if ($sec < 0) $sec = 0;

		}
		//echo $sec."<br>";
		$period     = 133745 + ($BetweenDays) * 44 + $num;
		$pre_period = $period - 1;
		//echo strtotime('2016-12-18 09:00:00')."<br>";
	}

	//特殊开奖期号重新处理
	if ($gamekey == "3D" or $gamekey == "P5(P3)" or $gamekey == "PL3" or strpos($gamekey, 'KL8') !== false or $gamekey == "BJPK10") {
		$lotpriod1 = getsql::periods($gamekey);

//			if(strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false)
//			$period1=$lotpriod1[count($lotpriod1)-1]['period'];
//			else
		$period1 = $lotpriod1[0]['period'];
		$row11   = $db->fetch_first("select count(*) as num   from game_time where playKey='{$gamekey}' ");

		$all = $row11['num'];

		$row1 = $db->fetch_first("select * from game_lottery where playKey='{$gamekey}' and period='{$period1}' ");

		$lotNum1 = $row1['SerialID'];
		$day     = $row1['SerialDate'];
		if (date("Ymd") - $day > 0) {
			$cha1 = (date("Ymd") - $day) * $all;

		} else $cha1 = 0;

		$tt      = date("H:i:s");
		$row2    = $db->fetch_first("select * from game_time where playKey='{$gamekey}' and beginTime<='{$tt}' and endTime>'{$tt}' ");
		$lotNum2 = $row2['lotNum'];


		$cha = $lotNum2 - $lotNum1;
		$cha = $cha1 + $cha;
		if ($cha < 1) $cha = 1;


		//if($gamekey=='DJKL8') $cha++;

		//echo $lotpriod1[0]['period'].'<br>';

		//	if(strpos($gamekey,'KL8')!==false) $cha++;


		$period = $period1 + $cha;


		if ($gamekey == 'BJPK10') {
			$start       = strtotime('2018-02-24 09:05:00');
			$BetweenDays = BetweenDays(time(), $start);
			if (time() > strtotime(date('Y-m-d') . ' 23:56:25')) {
				$BetweenDays++;
				$sec = 0;
			} else {
				$sec = floor((time() - strtotime(date('Y-m-d') . ' 09:01:25')) / 300);
				if ($sec < 0) $sec = 0;

			}
			//echo $sec."<br>";
			$period = 667637 + ($BetweenDays) * 179 + $sec;

			//echo strtotime('2016-12-18 09:00:00')."<br>";
		}

		if ($gamekey == 'BJKL8') {
			$start       = strtotime('2018-07-25 09:00:00');
			$BetweenDays = BetweenDays(time(), $start);
			if (time() > strtotime(date('Y-m-d') . ' 23:50:00')) {
				$BetweenDays++;
				$sec = 0;
			} else {
				$sec = floor((time() - strtotime(date('Y-m-d') . ' 09:00:00')) / 300);
				if ($sec < 0) $sec = 0;

			}
			//echo $sec."<br>";
			$period = 900644 + ($BetweenDays) * 179 + $sec;

			//echo strtotime('2016-12-18 09:00:00')."<br>";
		}

//

		if ($gamekey == 'JNDKL8') {
//	$lotpriod++;
			if (time() > strtotime(date('Y-m-d') . ' 21:00:00')) $period++;
		}

		$pre_period = $period - 1;


	}


	$arr = array('period' => $period, 'isbuy' => $isbuy, 'lastsecond' => $lastsecond, 'stoptime' => $stoptime, 'num' => $num, 'sum' => $sum, 'pre_period' => $pre_period, 'lotnum' => $lotNum);

	return array_merge($arr, $return);

}

function start_prize($gamekey, $period)
{
	global $db;
	$nowtime = date("Y-m-d H:i:s", time());
	$sql     = "update game_lottery set `status`='0' where playKey='{$gamekey}' and period='{$period}' and LotTime<='{$nowtime}' and status='-1' ";
	$db->query($sql);
	//  echo $sql;

	if ($db->affected_rows() > 0) {
		prize_lot($gamekey, $period);
		fenpei_prize($gamekey, $period);
	}


}


function lottery_list($gamekey, $num = 10)
{
	global $db, $time_arr, $redis;
	$period = get_now_period($gamekey, $time_arr);

    // start_prize($gamekey,$period['period']);
//    $game = $db->exec("select * from game_type where ckey='{$gamekey}'"); // 未知用途  冗余代码？
    $nowtime = date('Y-m-d H:i:s', time());

	//$sql = "select * from game_lottery where playKey='{$gamekey}' and period<'{$period['period']}' and LotTime<='{$nowtime}' order by period desc limit 0,{$num}";
	$key = 'game_lottery:' . $gamekey . $period['period'] . $nowtime;
    $data = $redis->get($key);
    if ($data) {
        $get_per = json_decode($data, true);
    } else {
        $sql = "select * from game_lottery where playKey='{$gamekey}' and period<'{$period['period']}' and LotTime<='{$nowtime}' order by period desc limit 0,{$num}";
 //    file_put_contents('/www/wwwroot/xingkong/cpk3/game_lottery.txt', 'game_lottery监控：' . $sql . PHP_EOL, FILE_APPEND);
 
		$get_per = $db->fetch_all($sql);

        $redis->set($key, json_encode($get_per), 2);
    }

	//$get_per = $db->fetch_all($sql);

	if (count($get_per)) {

		foreach ($get_per as $key => $value) {
			$nu = explode(',', $value['Number']);


			$sum = 0;
			if (strpos($gamekey, 'KL8') !== false or strpos($gamekey, 'BJPK10') !== false) {

				$sum = arr_sum(k18_num($nu));

			} else {

				for ($i = 0; $i < count($nu); $i++) {

					$sum += $nu[$i];
				}


			}

			$vv = '';
			foreach ($nu as $v1) {
				$vv .= "<em>{$v1}</em>";
			}

			$get_per[$key]['number1'] = $vv;

			$get_per[$key]['hz'] = $sum;
			if ($sum % 2 == 0) $get_per[$key]['ds'] = '双';
			else    $get_per[$key]['ds'] = '单';

			$get_per[$key]['period1'] = str_replace(date('Y'), '', $value['period']);


		}

	}

	return $get_per;
}


function show_user_info($userid)
{
	global $db;
	$user     = get_user_info($userid);
	$username = GBsub_str($user['username'], 0, 2) . '*****' . GBsub_str($user['username'], strlen($user['username']) - 1, 1);
	$group    = $db->exec("select * from user_group where id='{$user['groupid']}'");

	if (!$user['prize']) $user['prize'] = '0.00';
	$str = ' <div class="userinfo">
                     <div  class="card">
                        <div  class="cardLeft">
                            <img  src="' .FILE_URI .'/'.  avatar($user['userid']) . '" alt="" width="80" height="80">
                            <h6 >';
	if ($user['nickname']) $str .= GBsub_str($user['nickname'], 0, 2) . '*****' . GBsub_str($user['nickname'], strlen($user['nickname']) - 1, 1); else $str .= "未设置昵称";


	$str .= '</h6>
                        </div>
                        <div  class="cardInfo">
                            <div >性别：';
	if ($user['sex']) $str .= $user['sex']; else $str .= "保密";
	$str .= '</div>
                                <div >账号：' . $username . '</div>
                                <div >等级：' . $group['title'] . '</div>
                                <div >头衔：' . $group['touxian'] . '</div>
                                <div >累计中奖：' . number_format($user['prize'], 2, '.', '') . '</div>

                        </div>
                        <ul  class="cardIcon">';

	$playlist = unserialize($user['playlist']);
	$gamelist = $db->fetch_all("select * from game_type where status='0' order by icon1 desc ,`sort` asc limit 0,8");
	foreach ($gamelist as $value1) {

		$str .= ' <a href="game_' . $value1['id'] . '.html" title="' . $value1['fullname'] . '">
                                    <img src="' .FILE_URI .'/'.   $value1['ico'] . '"';

		if (!$playlist || !in_array($value1['ckey'], $playlist)) $str .= 'class="hui" ';
		$str .= ' > </a>';

	}

	$str .= ' </ul></div></div>';

	return $str;
}


function number_show($str, $num = 2)
{

	if (!$str) return 0;
	if (strpos($str, '.')) {


		$temp = number_format($str, $num, '.', '');
		return floatval($temp);

	} else return $str;


}

function GBsubstr($string, $start, $length)
{
	if (strlen($string) > $length) {
		$str = null;
		$len = $start + $length;
		for ($i = $start; $i < $len; $i++) {
			if (ord(substr($string, $i, 1)) > 0xa0) {
				$str .= substr($string, $i, 2);
				$i++;
			} else {
				$str .= substr($string, $i, 1);
			}
		}
		return $str;
	} else {
		return $string;
	}
}

?>
