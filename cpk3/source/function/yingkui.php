<?php
function get_yingkui1($data, $userid, $begintime, $endtime, $tx='') {
    // $stime=microtime(true);
    // $_SESSION['x']++;
    $arr = array ();
    if ($tx == 1)
        $userid = get_user_nextid1 ( $data, $userid );
    $arr ['recharge'] = get_bank_sum1 ( $data, $userid, 'Recharge_to_system,Recharge_online,hig_add_admin');
    $arr ['mention'] = get_bank_sum1 ( $data, $userid, 'mention_from_system', $begintime, $endtime );
    $arr ['rebate'] = get_bank_sum1 ( $data, $userid, 'hig_rebate');
    $arr ['active'] = get_bank_sum1 ( $data, $userid, 'active');
    $arr ['chase_back'] = get_bank_sum1 ( $data, $userid, 'hig_chase_back,hig_buy_chase_back,hig_buy_back') - get_bank_sum1 ( $data, $userid, 'hig_buy_back_fee');
    //原有逻辑---
    // $row1 = $db->fetch_first ( "select sum(money) as money from game_buylist where userid in ({$userid}) and  creatdate>'{$begintime}' and creatdate<='{$endtime}'  and is_succeed='yes'   and (status='1' or status='2' or status='3')" );
    // if (! $row1 ['money'])
    //     $row1 ['money'] = '0.00';
    // $arr ['buy'] = $row1 ['money']+ get_bank_sum1 ( $data, $userid, 'hm_buy')- get_bank_sum1 ( $data, $userid, 'hm_back');
    //end------
    // 新逻辑
    $userids = explode(',', $userid);
    $game_buylist_sum = 0;
    foreach ($userids as $uid) {
    	$uid = trim($uid, "'");
		$game_buylist_sum += $data['game_buylist'][$uid];
    }
    if (! $game_buylist_sum)
        $game_buylist_sum = '0.00';
    $arr ['buy'] = $game_buylist_sum+ get_bank_sum1 ( $data, $userid, 'hm_buy')- get_bank_sum1 ( $data, $userid, 'hm_back');
    $arr ['prize'] = get_bank_sum1 ( $data, $userid, 'hig_prize');
    $from = strtotime ( $begintime );
    $to = strtotime ( $endtime );
    //新逻辑结束
    $arr ['fenhong'] =get_bank_sum1 (  $data, $userid, 'fenhong' )+get_bank_sum1 (  $data, $userid, 'wage')-get_bank_sum1 (  $data, $userid, 'send_wage')-get_bank_sum1 (  $data, $userid, 'fenhong_lost_admin')+get_bank_sum1 (  $data, $userid, 'yongjin');
    $arr ['fenhong1'] =get_bank_sum1 (  $data, $userid, 'fenhong');
    $arr ['jiangli'] =get_bank_sum1 ( $data, $userid, 'wage')-get_bank_sum1 ( $data, $userid, 'send_wage' )+get_bank_sum1 ( $data, $userid, 'yongjin' )-get_bank_sum1 ( $data, $userid, 'fenhong_lost_admin');
    $arr ['sum'] = $arr ['rebate'] + $arr ['active'] + $arr ['prize'] + $arr ['fenhong'] - $arr ['buy'];
    foreach ( $arr as $key => $value ) {
        $arr [$key] = number_format ( $value, 3, ".", "" );
    }
    return $arr;
}
function get_bank_sum1($data, $userid, $cate) {
	$stime=microtime(true);
    $cates = explode(',', $cate);
    $userids = explode(',', $userid);
    $sum = 0;

    foreach ($userids as $userid) {
        $userid = trim($userid, "'");
        foreach ($cates as $cate) {
            if ($data[$userid][$cate]) {
                $sum += $data[$userid][$cate];
            }
        }
    }
    return $sum;
}
function get_user_nextid1($data, $userid) {
	global $db, $con_system;
	$str = "'{$userid}'";
	$uids = "'{$userid}'";
	
	for($i = 0; $i < 10000; $i ++) {
		if ($uids) {
			$usidsArr = explode(',', $uids);
			$row1 = array();
			foreach ($usidsArr as $uid1) {
				$uid1 = trim($uid1, "'");
				if ($data['user_id2lowerid'][$uid1]) {
					$row1 = array_merge($row1, $data['user_id2lowerid'][$uid1]);

				}
			}
			$uids = '';
			if ($row1) {
				foreach ( $row1 as $value ) {
					if ($uids == '')
						$uids = "'{$value}'";
					else
						$uids .= "," . "'{$value}'";
				}
			}
			if ($uids)
				$str .= "," . $uids;
		}
	}
	return $str;
}

?>