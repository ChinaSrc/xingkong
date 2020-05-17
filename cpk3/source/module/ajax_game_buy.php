<?php
if (time() - $_SESSION['buytime'] <= 5) {
    exit;
}
//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_POST);die;
$_SESSION['buytime'] = time();
$selArr = isset($_GET[selArr]) ? $_GET[selArr] : $_POST[selArr];
$lotteryKey = trim(explode('|', $selArr['0'])['0']);

include(SZS_ROOT_PATH."source/config/play/lot_time_".$lotteryKey.".php");
$issueData = get_now_period($lotteryKey, $time_arr)['period'] ?: null;
if (!$issueData) {
	echo "no|11";
    exit;  
}
$istask = isset($_GET[istask]) ? $_GET[istask] : $_POST[istask];
$perstop = isset($_GET[perstop]) ? $_GET[perstop] : $_POST[perstop];
$taskmoneys = isset($_GET[moneys]) ? $_GET[moneys] : $_POST[moneys];
$lists = isset($_GET[lists]) ? $_GET[lists] : $_POST[lists];
$player_item = isset($_GET[player_item]) ? $_GET[player_item] : $_POST[player_item];
$lotpriod = isset($_GET['period']) ? $_GET['period'] : $_POST['period'];
$lotpriod1 = $lotpriod + 1;
$endtime = isset($_GET['endtime']) ? $_GET['endtime'] : $_POST['endtime'];
$endtime = strtotime(date('Y-m-d') . ' ' . $endtime);
$num11 = 0;
if ($istask == "yes") {
    $taskListArr = explode("#", $lists);
}
$temp = '';
$TaskMoney = 0;
$buymax_arr = array();
if ($issueData != $lotpriod) {
	echo "no|11";
    exit;
}

//file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', 'gelArr：' . var_export($_POST[selArr], true) . PHP_EOL, FILE_APPEND);
//file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', 'gelArr：' . var_export($_POST[selArr], true).' period='.$lotpriod . PHP_EOL, FILE_APPEND);
foreach ($_POST[selArr] as $key => $value) {
    $selArr = $value;
    $wei = '';
    $arrs = explode("|", $selArr);
  	$issue = Trim($arrs[10]);
  	if ($issue != $issueData) {
      //var_dump($issue);
      //var_dump($issueData);
    	echo "no|11";
    	exit; 
    }
    $gamekey = Trim($arrs[0]);
    $code = Trim($arrs[1]);
    $titles = Trim($arrs[2]);
    $playid = Trim($arrs[3]);
    $modes = Trim($arrs[4]);
    $nums = Trim($arrs[5]);
    $money = Trim($arrs[6]);
    $CurMode = Trim($arrs[7]);
    $CurModeType = Trim($arrs[8]);
    $times = Trim($arrs[9]);
  	$period = Trim($arrs[10]);
    $lines = Trim($arrs[12]);
    $per_money = $money / $times;
    if ($istask == "yes") {
        if ($taskmoneys - 0.001 < 0) {
            $istask = "no";
        }
        if ($lists == "") {
            $istask = "no";
        }
    }
    if ($istask == 'yes') {
        $z_uid = '';
        $from = 0;
        if (time() > $endtime) {
            $from = 1;
        }
        for ($j = $from; $j < count($taskListArr); $j++) {
            $TaskArr = explode("^", $taskListArr[$j]);
            $TaskPeriod = $TaskArr[0];
            $Tasktimes = $TaskArr[1];
            $TaskMoney += $per_money * $Tasktimes;
        }
    } else {
        $TaskMoney += $money;
    }
    
   //异常处理
    if ($period != $lotpriod) {
        exception_log("game_buy_error");
        echo "no|11";
        exit;  
    }
  
	//file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$period='.$period . PHP_EOL, FILE_APPEND);
    //判断投注数量和内容是否正常
    $exception = 1;
  	if (in_array($playid, array('K3HZ','2TH-fx','3TH-dx','3TH-tx','3LH-tx','3LH-dx','2TH-dx','2BT-bz','3BT-dx'))) {
         $exception = 0;
    } 
 
    $temp = explode(',', $lines);
    
  	if ($playid == 'K3HZ') {
      if (count($temp) != $nums ) {
           $exception = 1;
        }
    }
	//二同号复选
  	if ($playid == '2TH-fx') {
      if (count($temp) != $nums ) {
      	$exception = 1;
      }else{
        foreach ($temp as $key => $value){
        //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$key='.$key.' $value=' . $value . PHP_EOL, FILE_APPEND);
        	if(!in_array($value,array('11*','22*','33*','44*','55*','66*'),true)){
          		$exception = 1;
          		break;
          	}  
        }   
      }
    }
  	//二同号单选 
	if ($playid == '2TH-dx') {
      if (strlen($temp[0])/2*strlen($temp[1]) != $nums ) {
      	  $exception = 1;
      }else{        
          $str1 = str_split($temp[0],2);
          $str2 = str_split($temp[1],1);
          //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$str1='.var_export($str1,true) . PHP_EOL, FILE_APPEND); 
          //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$str2='.var_export($str2,true) . PHP_EOL, FILE_APPEND); 
          foreach ($str1 as $key => $value){
              $val1 = $value;
              if(!in_array($val1,array('11','22','33','44','55','66'),true)){
                  $exception = 1;
                  break;
              } 
				//限制11,1
              if($val1 == '11'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('2','3','4','5','6'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            	//限制22,2
              if($val1 == '22'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('1','3','4','5','6'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            
				//限制33,3
              if($val1 == '33'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('1','2','4','5','6'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            
            	//限制44,4
              if($val1 == '44'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('1','2','3','5','6'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            
            	//限制55,5
              if($val1 == '55'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('1','2','3','4','6'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            
            //限制66,6
              if($val1 == '66'){
                foreach ($str2 as $key => $value){
                    $val2 = $value;
                    if(!in_array($val2,array('1','2','3','4','5'),true)){
                      $exception = 1;
                      break;
                    } 
                }    
              }
            
              if($exception == 1)
                 break;

           }//foreach ($str1 as $key => $value)
        }
    }//$playid == '2TH-fx'
  
  	if ($playid == '3TH-dx') {
      if(count($temp) != $nums ) {
           $exception = 1;
      }else{
        foreach ($temp as $key => $value){
        	if(!in_array($value,array('111','222','333','444','555','666'),true)){
          		$exception = 1;
          		break;
          	}  
        }
      }
    }
  
  	if ($playid == '3TH-tx') {
      if (count($temp) != $nums ) {
           $exception = 1;
      }else{
        //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$temp='.count($temp).' $lines=' . $lines . PHP_EOL, FILE_APPEND);
        if($lines != '111 222 333 444 555 666')
        {
          $exception = 1;
        }
      }
    }
  
  	if ($playid == '3LH-tx') {
      if (count($temp) != $nums ) {
           $exception = 1;
      }else{
        //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$temp='.count($temp).' $lines=' . $lines . PHP_EOL, FILE_APPEND);
        if($lines != '123 234 345 456')
        {
          $exception = 1;
        }
      }
    }
  
  	if ($playid == '3LH-dx') {
      if (count($temp) != $nums ) {
           $exception = 1;
      }else{
        //file_put_contents('/www/wwwroot/xingkong/cpk3/source/module/game.txt', '$temp='.count($temp).' $lines=' . $lines . PHP_EOL, FILE_APPEND);
        if(!in_array($lines,array('123','234','345','456'),true))
        {
          $exception = 1;
        }
      }
    }
    //二不同标准,未限制完善？
    if ($playid == '2BT-bz') {
      $series = array(0,0,1,3,6,10,15);
      if ($series[count($temp)] != $nums ) {        
           $exception = 1;
      }else{
        foreach ($temp as $key => $value){
        	if(!in_array($value,array('1','2','3','4','5','6'),true)){
          		$exception = 1;
          		break;
          	}  
        }
        if($exception == 0){
          $sameval=array_count_values($temp);
          rsort($sameval);
          if($sameval[0]>1) //过滤重复值
            $exception = 1;
        }
          
      }
    }
  	//三不同单选,未限制完善？
    if ($playid == '3BT-dx') {
      $series = array(0,0,0,1,4,10,20);
      if ($series[count($temp)] != $nums ) {        
           $exception = 1;
      }else{
        foreach ($temp as $key => $value){
        	if(!in_array($value,array('1','2','3','4','5','6'),true)){
          		$exception = 1;
          		break;
          	}  
        }
        if($exception == 0){
          $sameval=array_count_values($temp);
          rsort($sameval);
          if($sameval[0]>1) //过滤重复值
            $exception = 1;
        }
      } 
    }
  	
  	//判断投注金额
  	if(!is_numeric($money))
    {
      $exception = 1;
    }else{
      if($money < 10)
        $exception = 1;
    }
    //异常处理
    if ($exception) {

        exception_log("game_buy_error");
        echo "no|11";
        exit;  
    }

  

    $wanfa = $db->exec("select * from game_ssc_list where skey='{$playid}'");
    if ($playid == 'K3HZ') {

        foreach ($temp as $v) {
            if (!$buymax_arr[$playid][$v]) {
                $buymax_arr[$playid][$v] = 0;
            }
            $buymax_arr[$playid][$v] += $money;
        }
    } else {
        if (!$buymax_arr[$playid]) {
            $buymax_arr[$playid] = 0;
        }
        $buymax_arr[$playid] += $money;
    }
}
//11.13下单前判断用户组的最高限额 wu
$user_groupid = $db->exec("select groupid from user where userid='{$_SESSION['userid']}'");
$user_group = $db->exec("select * from user_group where id='{$user_groupid['groupid']}'");
$content = unserialize($user_group['content']);
if (count($buymax_arr) > 0) {
    foreach ($buymax_arr as $key => $value) {
        $wanfa = $db->exec("select * from game_ssc_list where skey='{$key}'");
        if ($key == 'K3HZ') {
            $groupmax = explode('|', $content[$key]['buymax']);
            if (count($value) > 0) {
                $buymax = explode('|', $wanfa['buymax']);
                $showkey = explode('|', $wanfa['show_key']);
                foreach ($value as $k => $v) {
                    $max1 = 0;
                    foreach ($showkey as $k1 => $v1) {
                        if ($k == $v1) {
                            //11.13 用户组最高限额跟彩种下单限额 取大 wu
                            $max1 = $buymax[$k1] > $groupmax[$k1] ? $buymax[$k1] : $groupmax[$k1];
                        }
                    }
                    $row = $db->exec("select  sum(money/nums) as `sum` from game_buylist where period='{$lotpriod}' and playkey='{$gamekey}' and list_id='{$key}' and userid='{$_SESSION['userid']}' and `number` like '%{$k}%'");
                    if ($row['sum'] + $v > $max1) {
                        exit("no|100|{$wanfa['fullname']}{$k}玩法单期最大投注额为{$max1}元");
                    }
                }
            }
        } else {
            $row = $db->exec("select  sum(money) as `sum` from game_buylist where period='{$lotpriod}' and playkey='{$gamekey}' and list_id='{$key}' and userid='{$_SESSION['userid']}'");
            if ($row['sum'] + $money > $wanfa['buymax']) {
                exit("no|100|{$wanfa['fullname']}玩法单期最大投注额为{$row['sum']}元");
            }
        }
    }
}
$lost_money = getsql::moneys($_SESSION['userid']);
if ($lost_money - $TaskMoney < 0) {
    $re_min = "no";
    $re_max = "10";
    $flags = "no";
    echo '';
    exit;
}
//$lotpriod=get_game_period($gamekey);
$row = $db->exec("select modes from user where userid='{$_SESSION['userid']}'");
$user_modes = $row['modes'];
$mmssc_period = date('YmdHis');
$tt = 0;
foreach ($_POST[selArr] as $key => $value) {
    $num11++;
    $selArr = $value;
    $wei = '';
    $arrs = explode("|", $selArr);
    if (!$wei and $arrs[13] > -1) {
        $wei = $arrs[13];
    }
    $gamekey = Trim($arrs[0]);
    $code = Trim($arrs[1]);
    $titles = Trim($arrs[2]);
    $playid = Trim($arrs[3]);
    $modes = Trim($arrs[4]);
    $nums = Trim($arrs[5]);
    $money = Trim($arrs[6]);
    $CurMode = Trim($arrs[7]);
    $CurModeType = Trim($arrs[8]);
    $times = Trim($arrs[9]);
    $per_money = $money / $times;
    if ($istask == "yes" and count($taskListArr) > 0) {
        $TaskArr = explode("^", $taskListArr[0]);
        if ($TaskArr[1] > 0) {
            $times = $TaskArr[1];
        }
    }
    //if(!$lotpriod){$lotpriod=get_game_period($gamekey);}
    $ids = Trim($arrs[11]);
    $lines = Trim($arrs[12]);
    $wei = Trim($arrs[13]);
    //if(!$wei)$wei=$key;
    $flags = "no";
    $re_min = "yes";
    $re_max = "1";
    $DanBeiMoney = $money / $times;
    if ($userid - 1 >= 0) {
        $flags = "yes";
        $lost_money = getsql::moneys($userid);
    } else {
        $re_min = "no";
        $re_max = "7";
    }
    if ($flags == "yes") {
        if ($flags == "yes") {
            if ($modes != "元" and $modes != "角" and $modes != "分" and $modes != "厘") {
                $modes = "元";
            }
        }
        if ($flags == "yes") {
            if (!$CurMode) {
                $CurMode = "1930";
            }
        }
        if ($flags == "yes") {
            if ($_GET['prenum']) {
                $prenum = $_GET['prenum'];
            } else {
                $prenum = 2;
            }
            $n_money = $nums * $prenum * $times;
            if ($modes == "角") {
                $n_money = $n_money / 10;
            }
            if ($modes == "分") {
                $n_money = $n_money / 100;
            }
            if ($modes == "厘") {
                $n_money = $n_money / 1000;
            }
            if ($n_money != $money and $_GET['gametype'] != 'k3') {
                $money = $n_money;
            }
        }
    }
    $CurMode1 = $modes;
    if ($flags == "yes") {
        if ($lost_money - 0.002 < 0) {
            $re_min = "no";
            $re_max = "10";
            $flags = "no";
        }
    }
    if ($flags == "yes") {
        if ($money - 0.002 < 0) {
            $re_min = "no";
            $re_max = "8";
            $flags = "no";
        }
    }
    if ($flags == "yes") {
        if ($lost_money - $money < 0) {
            $re_min = "no";
            $re_max = "10";
            $flags = "no";
        }
    }
    if ($flags == "yes") {
        if ($istask == "yes") {
            if ($taskmoneys - 0.001 < 0) {
                $istask = "no";
            }
            if ($lists == "") {
                $istask = "no";
            }
        }
        if ($lines != '') {
            if ($istask == 'yes') {
                $z_uid = '';
                $from = 0;
                if (time() > $endtime) {
                    $from = 1;
                }
                for ($j = $from; $j < count($taskListArr); $j++) {
                    $TaskArr = explode("^", $taskListArr[$j]);
                    $TaskPeriod = $TaskArr[0];
                    $Tasktimes = $TaskArr[1];
                    $TaskMoney = $per_money * $Tasktimes;
                    if ($z_uid) {
                        $endtime1 = strtotime($TaskArr[3]);
                        $Taskid = getsql::addGameBuy($gamekey, $playid, $TaskPeriod, $lines, $nums, $Tasktimes, $CurMode, $CurModeType, $modes, $TaskMoney, "yes", "yes", $perstop, $z_uid, $endtime1, '', $player_item, $wei);
                        $mark = get_game_mark($Taskid);
                        $bankid = getsql::banklog($TaskMoney, "hig_chase", "", $mark, $Taskid, $gamekey, $modes);
                    } else {
                        $Taskid = getsql::addGameBuy($gamekey, $playid, $TaskPeriod, $lines, $nums, $Tasktimes, $CurMode, $CurModeType, $modes, $TaskMoney, "yes", "yes", "", "", $endtime, '', $player_item, $wei);
                        $mark = get_game_mark($Taskid);
                        $bankid = getsql::banklog($TaskMoney, "hig_chase", "", $mark, $Taskid, $gamekey, $modes);
                        $z_uid = $Taskid;
                        $tt++;
                    }
                }
            } else {
                if ($gamekey != 'MMSSC') {


                  
              

                    if (time() > $endtime) {
                        if (substr($lotpriod,-3) != '001') {
                            echo "no|12";
                            exit;
                        }else{
                            $endtime2 = $db->exec("select endTime from game_time WHERE playKey = '{$gamekey}' order by lotTime desc limit 0,1");
                            if (time() < strtotime(date('Y-m-d').' '.$endtime2['endTime'])) {
                                echo "no|11";
                                exit;
                            }
                        }
                    }
                    





                    //$temp.=$money."<br>";
                    $z_uid = getsql::addGameBuy($gamekey, $playid, $lotpriod, $lines, $nums, $times, $CurMode, $CurModeType, $modes, $money, "no", "yes", "", "", $endtime, '', $player_item, $wei);
                    $mark = get_game_mark($z_uid);
                    $bankid = getsql::banklog($money, "hig_buy", "", $mark, $z_uid, $gamekey, $modes);
                } else {
                    $lotpriod = $mmssc_period;
                    if ($_POST['qi_num'] > 0) {
                        unset($_SESSION['MMSSC']);
                        for ($i = 1; $i <= $_POST['qi_num']; $i++) {
                            if ($i < 10) {
                                $priod1 = $mmssc_period . '0' . $i;
                            } else {
                                $priod1 = $mmssc_period . $i;
                            }
                            $z_uid = getsql::addGameBuy($gamekey, $playid, $priod1, $lines, $nums, $times, $CurMode, $CurModeType, $modes, $money, "no", "yes", "", "", '', '', $player_item, $wei);
                            $mark = get_game_mark($z_uid);
                            $bankid = getsql::banklog($money, "hig_buy", "", $mark, $z_uid, $gamekey, $modes);
                            $_SESSION['MMSSC'][$i] = $priod1;
                        }
                    }
                }
            }
        }
    }
}
$user = $db->exec("select playlist from user where userid='{$_SESSION["userid"]}'");
$playlist = unserialize($user['playlist']);
if (!in_array($gamekey, $playlist)) {
    $playlist[] = $gamekey;
    $playlist = serialize($playlist);
    $db->query("update user set playlist='{$playlist}' where userid='{$_SESSION["userid"]}'");
}
echo $re_min . "|" . $re_max . "|" . $num11;