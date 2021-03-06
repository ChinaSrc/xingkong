<?php
include('config.php');
require_once '../source/class/cache.php';
$cache = new Cache();
$action = $_GET['ac'];
if ($action == 'yktj') {
    $result = [];
    for ($i = 0; $i < 4; $i++) {
        $m = date('m');
        if ($m - $i < 0) {
            $m = $m - $i + 12;
            $y = date('Y') - 1;
        } else {
            $m = $m - $i;
            $y = date('Y');
        }
        if ($m < 10) $m = '0' . $m;
        $month = $y . '-' . $m;
        $from = $month . "-01 00:00:00";
        $nextmonth = date("Y-m", time() - ($i - 1) * 24 * 3600 * 30);
        $to = $nextmonth . "-01 00:00:00";
        $yingkui1 = array();
        if ($cache->has($from)) {
            $yingkui1 = $cache->get($from);
        } else {
            $list1 = $db->fetch_all("select  `userid`  from user where higherid='0' and admin='0' and virtual='0'");
            foreach ($list1 as $value) {
                if ($nextListArr[$value['userid']]) {
                    $next_list = $nextListArr[$value['userid']];
                } else {
                    $next_list = get_user_nextid2($value['userid']);
                }
                $yingkui = get_yingkui_new($value['userid'], $from, $to, 1, 1, $next_list);
                $yingkui2 = get_yingkui_new($value['userid'], $from, $to, 0, 0, $next_list);
                foreach ($yingkui as $key1 => $value1) {
                    $yingkui[$key1] = $value1 - $yingkui2[$key1];
                    $yingkui1[$key1] += $yingkui[$key1];
                }
                // print_r($yingkui2);
            }
            if ($i > 0) {
                $cache->set($from, $yingkui1, 0);
            }
        }
        $yingkui1['month'] = $month;
        $result['yfyk'][$i] = $yingkui1;
    }

    $begin = date('Y-m-d', time() - 24 * 3600) . " 00:00:00";;
    $end = date('Y-m-d', time() - 24 * 3600) . " 23:59:59";
    $yingkui1 = array();
    $list1 = $db->fetch_all("select  `userid`, `username`  from user where higherid='0' and admin='0' and virtual='0'");
    foreach ($list1 as $value) {
        if ($nextListArr[$value['userid']]) {
            $next_list = $nextListArr[$value['userid']];
        } else {
            $next_list = get_user_nextid2($value['userid']);
        }

//				$yingkui = get_yingkui($value['userid'], $begin, $end, 1, 1);
        $yingkui = get_yingkui_new($value['userid'], $begin, $end, 1, 1, $next_list);
//				$yingkui2 = get_yingkui($value['userid'], $begin, $end, 0);
        $yingkui2 = get_yingkui_new($value['userid'], $begin, $end, 0, 0, $next_list);
        foreach ($yingkui as $key1 => $value1) {
            $yingkui[$key1] = $value1 - $yingkui2[$key1];
            $yingkui1[$key1] += $yingkui[$key1];
        }
        // print_r($yingkui2);
    }
    $result['ztyk'] = $yingkui1;
    exit(json_encode($result));
}

if ($action == 'yhtj') {
    $sql = "select * from 
        (select  count(*) as `userCount` from user where admin='0') as `userCount`, 
        (select  count(*) as `dlCount` from user where admin='0' and isproxy='0') as `dlCount`,
        (select  count(*) as `todayRs` from user where admin='0'  and registertime>'{$_GET['begin_time']}') as `todayRs`,
        (select  count(*) as `todayLg` from user where admin='0' and lastlogintime>'{$_GET['begin_time']}') as `todayLg`,
        (select  count(*) as `online` from user_online where userid in (select userid from user where admin='0')) as `online`
        ";
    $row = $db->fetch_first($sql);
    exit(json_encode($row));
}

if ($action == 'cztztj') {
    $all = $db->fetch_all("select playkey,sum(money) as money from game_buylist group by playkey");
    $playkeys = implode('\',\'', array_column($all, 'playkey'));
    $names = $db->fetch_all("select ckey, fullname from game_type where ckey in ('{$playkeys}');");
    $nameArray = array_column($names, 'fullname', 'ckey');
    foreach($all as $key => $value) {
        $all[$key]['fullname'] = $nameArray[$value['playkey']];
    }
    exit(json_encode($all));
}

if ($action == 'main') {
    $today = get_day_time1();

    $begintime = $today[0];
    $endtime   = $today[1];
    exit(getMainData($db, $user, $begintime, $endtime));
}

function getMainData($db, $user, $begintime, $endtime) {

    if (!$_GET['begintime'])
        $begin = $begintime;
    else {
        $begin = $_GET['begintime'] . ' 00:00:00';
    }
    if (!$_GET['endtime'])
        $end = $endtime;
    else {
        $end = $_GET['endtime'] . ' 23:59:59';
    }
    $nextListArr = [];
    $list1 = $db->fetch_all("select  `userid`, `username`  from user where higherid='0' and admin='0' and virtual='0'");
    $result = [];


    foreach ($list1 as $value) {
        $next_list = get_user_nextid2($value['userid']);
        $nextListArr[$value['userid']] = $next_list;
        $virtual   = $user['virtual'];
        if ($virtual == 1) {
            $yingkui1 = get_yingkui_new($value['userid'], $begin, $end, 1, 0, $next_list);
            $str      = '';
        } else {
            $yingkui1 = get_yingkui_new($value['userid'], $begin, $end, 1, 1, $next_list);
            $str      = '';
        }
        $yingkui2 = get_yingkui_new($value['userid'], $begin, $end, 0, 0, $next_list);
        foreach ($yingkui1 as $key1 => $value1) {
            $yingkui1[$key1] = $value1 - $yingkui2[$key1];
        }
        $row            = $db->exec("select count(*) as num from user where registertime >= '{$begin}'  and registertime<='{$end}' and higherid in ($next_list) {$str}");
        $reg_num        = $row['num'];
        $row            = $db->fetch_all("select DISTINCT userid from user_funds where creatdate >= '{$begin}'  and creatdate<='{$end}' and `first`='1' and cate='recharge' and  userid in ($next_list) {$str}");
        $frist_recharge = count($row);
        $row1           = $db->fetch_all("select DISTINCT  userid from game_buylist where creatdate>'{$begin}' and creatdate<='{$end}' and  is_succeed='yes'   and (status='1' or status='2' or status='3') and userid in ({$next_list}) {$str}");
        $buy_num        = count($row1);
        $team = get_team_info2($next_list);
        if ($virtual == 0) {
            foreach ($yingkui1 as $k1 => $v1) {
                if (!$result['total'][$k1]) $result['total'][$k1] = 0;
                $result['total'][$k1] += $v1;
            }

        }
        $tmp['username'] = $value['username'];
		$tmp['virtual'] = $virtual;
        $tmp['buy'] = $yingkui1['buy'];
        $tmp['prize'] = $yingkui1['prize'];
        $tmp['recharge'] = $yingkui1['recharge'];
        $tmp['mention'] = $yingkui1['mention'];
        $tmp['frist_recharge'] = $frist_recharge;
        
        $tmp['rebate'] = $yingkui1['rebate'];
        $tmp['active'] = $yingkui1['active'];
        $tmp['buy_num'] = $buy_num;
        $tmp['online'] = $team['online'];
        $tmp['money'] = $team['money'];
        $tmp['reg_num'] = $reg_num;
        $tmp['num'] = $team['num'];
        $tmp['pri-buy'] = $yingkui1['prize'] - $yingkui1['buy'];
      	if ($virtual == 0) {
        	$result['total']['pri-buy'] = $yingkui1['prize'] - $yingkui1['buy'] + ($result['total']['pri-buy'] ? : 0);
      		$result['total']['frist_recharge'] = $frist_recharge + ($result['total']['frist_recharge'] ? : 0);
      		$result['total']['buy_num'] = $buy_num + ($result['total']['buy_num'] ? : 0);
      		$result['total']['online'] = $team['online'] + ($result['total']['online'] ? : 0);
      		$result['total']['money'] = $team['money'] + ($result['total']['money'] ? : 0);
        	$result['total']['reg_num'] = $reg_num + ($result['total']['reg_num'] ? : 0);
      		$result['total']['num'] = $team['num'] + ($result['total']['num'] ? : 0);
        }
        $result['list'][] = $tmp;
    }
    return json_encode($result);
}

if ($action == 'timer') { // 默认0点执行 其他时间执行 数据将混乱
    $start = date('Y-m-d H:i:s', strtotime('-1 day'));
    $end = date('Y-m-d H:i:s', time() - 1);
    $data = getMainData($db, $user, $start, $end);
    $result = $db->insert(DB_PREFIX . 'main_timer', ['data' => $data, 'date' => date('Ymd', strtotime('-1 day')), 'create_at' => date('Y-m-d H:i:s', time())]);
    return $result;
}

if ($action == 'his') {
    $serchDate = '';
    if (!isset($_GET['start']) || !isset($_GET['end'])) {
        exit([]);
    }

    $start = date('Ymd', strtotime($_GET['start']));
    $end = date('Ymd', strtotime($_GET['end']));
    $result = $db->fetch_all("select `data`,`date` from main_timer where `date` >= '{$start}' and `date` <= '{$end}' order by `date` desc ");
    $returnData = [];
  	if (!$result) exit(json_encode($returnData));
    foreach ($result as $res) {
        $tmp['data'] = json_decode($res['data']);
        $tmp['date'] = $res['date'];
      	$returnData[] = $tmp;
    }
    exit(json_encode($returnData));
}


if ($action == 'get_rebates') {
  	//----
  $id=$_GET['id'];
  $rowss=$db->exec("select * from user where userid='$id'");
  if($rowss['higherid'])$pids=get_user_pid($id);
  $str='';
  for($i=count($pids)-1;$i>=0;$i--){

    if($str=='')
      $str=$pids[$i]['username'];
    else  
      $str.="&gt;".$pids[$i]['username'];


  }
  
  
  
  if(!$rowss){
      echo json_encode([]);exit;
  }
  $rebates=unserialize($rowss['rebates']);
  if($rowss['higherid']){
    $parent=   get_user_info($rowss['higherid']);
    $parent_rebates=unserialize($parent['rebates']);
  }
  foreach ($arr_game_code as $key=>$value){

    if($rowss['higherid']){
      $maxrebate=$parent_rebates[$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];

    }
    else{

      $maxrebate=$con_system['rebates_'.$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];
    }
    if($minrebate<0) $minrebate=0;

  }
  
  //---
  
    echo json_encode(['sjdl'=>$pids[1]['username'],'bzdjsm'=>$str,'username'=>$rowss[username],'min' => $minrebate,'max' => $maxrebate, 'rebates' => $rebates]);
  	exit;
}



if ($action == 'yktimer') {
    $serData = date('Y-m-d', strtotime('-1 day'));
    $begintime = $serData . " " . $search_time_arr['begin'];
    $endtime = $serData . " " . $search_time_arr['end'];
    $sql = "SELECT
	t10.userid AS 'userid',
	t10.username AS 'username',
	t11.realname AS 'realname',
	CONCAT(
		t11.province,
		t11.city,
		t11.area 
	) AS 'addr',
	t10.charge AS 'charge',
	t10.platform AS 'platform',
	t10.starAmount AS 'starAmount',
	t10.endAmount AS 'endAmount',
	t10.profit AS 'profit' 
FROM
	(
	SELECT
		t8.userid,
		t9.username,
		sum( t8.charge ) AS charge,
		sum( t8.platform ) AS platform,
		sum( t8.starAmount ) AS starAmount,
		sum( t8.endAmount ) AS endAmount,
		sum( t8.platform ) + sum( t8.endAmount ) - sum( t8.starAmount ) - sum( t8.charge ) AS profit 
	FROM
		(
		SELECT
			t1.userid,
			sum(
			CASE
					
					WHEN t1.cate = 'recharge' THEN
					t1.money ELSE 0 
				END 
				) AS 'charge',
				sum(
				CASE
						
						WHEN t1.cate = 'platform' THEN
						t1.money ELSE 0 
					END 
					) AS 'platform',
					0 AS starAmount,
					0 AS endAmount 
				FROM
					user_funds t1 
				WHERE
					creatdate BETWEEN '{$begintime}' 
					AND '{$endtime}' 
					AND t1.`status` = 1 
				GROUP BY
					t1.userid UNION ALL
				SELECT
					t2.userid,
					0 AS charge,
					0 AS platform,
					t2.hig_amount AS starAmount,
					0 AS endAmount 
				FROM
					user_funds t2 
				WHERE
					t2.`first` = 1 
					AND t2.`status` = 1 --  (select min(t3.id) minid ,t3.userid, min(t3.creatdate)minDate from user_funds t3  where creatdate BETWEEN '2000-01-01 00:00:00' and '2021-01-01 23:59:59' and t3.status=1  and t3.first =1 group by t3.userid) t4
--  where t2.userid=t4.userid and t2.creatdate=t4.mindate and t2.id=minid
				UNION ALL
				SELECT
					t5.userid,
					0 AS charge,
					0 AS platform,
					0 AS starAmount,
					t5.amountafter AS endAmount 
				FROM
					user_funds t5,
					(
					SELECT
						max( t6.id ) maxid,
						t6.userid,
						max( t6.creatdate ) maxdate 
					FROM
						user_funds t6 
					WHERE
						creatdate BETWEEN '{$begintime}' 
						AND '{$endtime}' 
						AND t6.`status` = 1 
					GROUP BY
						t6.userid 
					) t7 
				WHERE
					t5.userid = t7.userid 
					AND t5.creatdate = t7.maxdate 
					AND t5.id = maxid 
				) t8,
				`user` t9 
			WHERE
				1 = 1 
				AND t8.userid = t9.userid 
				AND t9.virtual = 0 
			GROUP BY
				t8.userid 
			) t10,
			user_bank_list t11 
		WHERE
			t10.userid = t11.userid 
	ORDER BY
	9 DESC";
    $user_list = $db->fetch_all($sql);
    $sql = 'insert into `yingkui_log`(`userid`,`username`,`realname`,`addr`,`charge`,`platform`,`starAmount`,`endAmount`,`profit`,`date`) values';
    $addarrs = [];
    foreach ($user_list as $key => $value) {
        $addArr = [
            $value['userid'],
            '"' . $value['username'] . '"',
            '"' . $value['realname'] . '"',
            '"' . $value['addr'] . '"',
            $value['charge'],
            $value['platform'],
            $value['starAmount'],
            $value['endAmount'],
            $value['profit'],
            '"' . $serData . '"'
        ];
        $addarrs[] = '(' . implode(',', $addArr) . ')';
    }
    $sql .= implode(',', $addarrs);
    $db->exec($sql);
    return true;
}
?>
