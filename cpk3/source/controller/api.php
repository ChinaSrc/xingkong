<?php

$action = $_GET['action'];
if (!in_array($action, ['getTotal', 'receive']) or !$_SESSION['userid']) {
    echo json_encode(['message' => '!ok']);exit;
}
//?action=getTotal
if ($action == 'getTotal') {
    $selectData = $db->exec("select * from `cumulative_recharge` where user_id={$_SESSION['userid']}");
    if ($selectData) {
        if ($selectData['num'] < 7) {
            $type = 1;
            $type2 = 7;
        } elseif ($selectData['num'] >=7 and $selectData['num'] < 15) {
            $type = 7;
            $type2 = 15;
        } elseif ($selectData['num'] >=15 and $selectData['num'] < 30) {
            $type = 15;
            $type2 = 30;
        } elseif ($selectData['num'] >=30) {
            $type = 30;
            $type2 = 30;
        }
        $money = calc($type, $selectData['max_money']);
        $txt = '您已连续充值' . $selectData['max_money'] . '元' . $selectData['num'] . '天，可领取' . $money . '元。继续充值' . ($type2 - $selectData['num'] >= 0 ? $type2 - $selectData['num'] : 0) . '天，即可领取' . calc($type2, $selectData['max_money']) . '元。';
      if ($selectData['num'] >= 7) {
        	echo json_encode(['total' => $selectData['num'], 'message' => 'ok', 'txt' => $txt]);exit;
        } else {
        	echo json_encode(['total' => $selectData['num'], 'message' => 'ok', 'txt' => $txt, 'cz_money' => $selectData['money'] ?:0, 'kl_money' => calc($type, $selectData['money'])]);exit;
        }
    }
    $txt = '您已连续充值0天，充值满500元，即可领取18元。';
    echo json_encode(['total' => 0, 'message' => 'ok', 'txt' => $txt]);exit;
}
//?action=receive&type=30
if ($action == 'receive') {
    if (!in_array($_GET['type'], [1, 7, 15, 30])) {
        echo json_encode(['message' => '领取失败!', 'status' => 'fail']);exit;
    }
    $selectData = $db->exec("select * from `cumulative_recharge` where user_id={$_SESSION['userid']}");
    if (!$selectData) {
        echo json_encode(['message' => '领取失败!', 'status' => 'fail']);exit;
    }
  	if ($_GET['type'] > $selectData['num']) {
    	echo json_encode(['message' => '领取失败!', 'status' => 'fail']);exit;
    }
    receive($_GET['type'], $selectData['num'], $selectData['max_money'], $selectData['money'], $_SESSION['userid']);
    echo json_encode(['message' => '恭喜您，领取成功！', 'status' => 'success']);exit;
}
?>
