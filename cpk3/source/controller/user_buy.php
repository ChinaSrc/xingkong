<?php
$begindate = isset($_POST[begindate]) ? $_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ? $_POST[enddate] : $_GET[enddate];
$projectno = isset($_POST[projectno]) ? $_POST[projectno] : $_GET[projectno];
$pername = isset($_POST[pername]) ? $_POST[pername] : $_GET[pername];
$includes = isset($_POST[includes]) ? $_POST[includes] : $_GET[includes];
$is_prize = isset($_POST[is_prize]) ? $_POST[is_prize] : $_GET[is_prize];
$lotteryid = isset($_POST[lotteryid]) ? $_POST[lotteryid] : $_GET[lotteryid];
$isgetdata = isset($_POST[isgetdata]) ? $_POST[isgetdata] : $_GET[isgetdata];
$orderBy = isset($_POST['orderby']) ? $_POST['orderby'] : $_GET['orderby'];
$show_body = "";
$isgetdata = "yes";
if ($isgetdata == "yes") {
    $t_url = $this_url . "&isgetdata=" . $isgetdata;
    if ($pername) {
        $perid = getsql::userids($pername);
        if ($perid - $userid == 0) {
        } else {
            $islowers = getsql::islower($userid, $perid);
            if ($islowers == "no") {
                echo "<script>history.back(-1);</script>";
                exit;
            }
        }
        $t_url .= "&pername=" . $pername;
    } else {
        $perid = $_SESSION["userid"];
    }
  
$search = " where 1=1 ";
  if ($_GET['username']) {
        $uu = $db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");
        if (is_team($uu['userid'], $_SESSION['userid']) or $uu['userid'] == $_SESSION['userid']) {
            //if($_GET['st']==1 || $_GET['st']==3 || !$_GET['st'])
            $search .= " and b.userid='{$uu['userid']}'";
            //else{
            //
            //$user_ids=get_user_nextid($uu['userid']);
            //$user_ids=str_replace("'", "", $user_ids);
            //$search.=" and (u.userid in ( {$user_ids} ))";
            //
            //}
        } else {
            $search .= " and b.userid='-1'";
        }
    } else {
        if ($_GET['st'] > 1) {
            $user_ids = child_node($_SESSION['userid']);
            $user_ids =substr($user_ids, 0, -1);


            // $sql = "SELECT userid FROM game_buylist WHERE creatdate>='{$begintime}'  GROUP BY userid ";
            // $buylist = $db->getall($sql);
            // foreach ($buylist as $v) {
            //     $buylist1[]=$v['userid'];
            // }


            // $buylist2 = explode(",", $user_ids);

            // $buylist = array_intersect($buylist2,$buylist1);
            // foreach ($buylist as $v) {
            //     $user_ids1.= $v.',';
            // }
            // $user_ids =substr($user_ids1, 0, -1);

            if ($user_ids) {
                $search .= " and b.userid in ( {$user_ids} ) and b.userid!='{$_SESSION['userid']}'";
            }else{
                //没有符合的数据
                $search .= " and b.userid ='-1'";
            }
        } else {
            $search .= " and  b.userid='{$_SESSION['userid']}'";
        }
    }
    $today = get_day_time();
    if ($_GET['begintime']) {
        $begintime = $_GET['begintime'] . " " . $search_time_arr['begin'];
    } else {
        $begintime = $today[0];
    }
    if ($_GET['endtime']) {
        $endtime = $_GET['endtime'] . " " . $search_time_arr['end'];
    } else {
        $endtime = $today[1];
    }
    $begin = substr($begintime, 0, 10);
    $end = substr($endtime, 0, 10);
    $search .= " and b.creatdate>='{$begintime}' and b.creatdate<='{$endtime}' ";
    $tpl->assign('begin', $begin);
    $tpl->assign('end', $end);
  
$search .= " and b.is_succeed='yes' and b.is_zuih='no' ";
  
    if ($projectno) {
        $t_url .= "&projectno=" . $projectno;
        $search .= " and b.buyid='{$projectno}'";
    }
    if ($_GET['period']) {
        $search .= " and b.period='{$_GET['period']}'";
    }
    //if(!$_GET['username']) $_GET['username']=$_SESSION['user_name'];

    if ($is_prize) {
        $t_url .= "&is_prize=" . $is_prize;
        if ($is_prize == "3") {
            $search .= " and b.isprize='is_yes'";
        }
        if ($is_prize == "2") {
            $search .= " and b.isprize='is_no'";
        }
        if ($is_prize == "1") {
            $search .= " and b.status='0'";
        }
        if ($is_prize == "9") {
            $search .= " and b.status='9'";
        }
    }
    if ($lotteryid) {
        $t_url .= "&lotteryid=" . $lotteryid;
        $search .= " and b.playkey='{$lotteryid}'";
    }
    $dblist = " " . DB_PREFIX . "game_buylist as b";
    // " . DB_PREFIX . "user as u," . DB_PREFIX . "game_type as t," . DB_PREFIX . "game_ssc_list as l";

    // u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey
    $page = $_GET['page'];
    if (!$page or $page == 0) {
        $page = 1;
    }
    $countsql = "SELECT COUNT(b.id) FROM {$dblist} " . $search;
    $total = $db->fetch_count($countsql);
    $pagecount = ceil($total / $pagesize);
    $start = ($page - 1) * $pagesize;
    $game_list = array();
    $oBy = $orderBy == '' ? ' ORDER BY b.creatdate desc' : ' ORDER BY ' . $orderBy;
    $game_list_sql = "SELECT b.* FROM {$dblist} {$search}{$oBy} LIMIT {$start}, {$pagesize}";
    // ,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode

    //$game_list_sql = "SELECT b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM {$dblist} {$search} ORDER BY b.money desc LIMIT {$start}, {$pagesize}";

    $game_list = $db->getall($game_list_sql);
    $page_info = "页次：" . $page . " / " . $pagecount . " 页 " . $pagesize . " 条/每页  共：" . $total . " 条";
    $url = $t_url . "&";
    $channel = "case";
    $listnums = 0;

    if ($game_list) {
        if ($_GET['st'] > 1) {
            $userIds = implode(',', array_column($game_list, 'userid'));
            $userIdArr = [];
            $userIdArr = $db->getall('select userid,username from user where userid in (' . $userIds . ')');
            if ($userIdArr) {
                $userIdArr = array_column($userIdArr, 'username', 'userid');
            }
        }

        // $game = $db->fetch_first("select * from game_type where ckey='{$game_list[$j][playkey]}'");
        $game_type_1 = $db->getall("select * from game_type");
        
        foreach ($game_type_1 as $v) {
            $game_type[$v['ckey']] = $v;
        }

        for ($j = 0; $j < count($game_list); $j++) {

            $game = $game_type[$game_list[$j][playkey]];
			$game_list[$j]['playname'] = $game['fullname'];
            if ($j % 2 == 0) {
                $trbg = "class='table_b_tr_a'";
            } else {
                $trbg = "class='table_b_tr_b'";
            }
            $show_body .= "<tr " . $trbg . " height=35>";
            $buy_num = $game_list[$j][period];
            $this_url = $do_url . "?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=" . $game_list[$j][id];
            // $user = $db->fetch_first("select * from user where userid='{$game_list[$j][userid]}'");
            //$show_body.= "<td >".$game_list[$j]['buyid']."</td>";
            if ($_GET['st'] > 1) {
                $show_body .= "<td >" . ($userIdArr[$game_list[$j]['userid']] ?: '') . "</td>";
            }
            $show_body .= "<td >" . $game['fullname'] . "</td>";



            if ($game_list[$j]['list_id'] == 'K3HZ') {
                $game_list[$j]['wanfa'] = '和值';
            }else{
                $this_code = get_game_mark($game_list[$j][id]);
                $game_list[$j]['wanfa'] = str_replace($game['fullname'], '', $this_code);
            }


            $show_body .= "<td >" . $game_list[$j]['wanfa'] . "</td>";



            $show_body .= "<td title='" . $game_list[$j][buyid] . "'>" . $buy_num . "</a></td>";
            if (strlen($game_list[$j]['number']) > 30) {
                $number = substr($game_list[$j]['number'], 0, 30) . '...';
            } else {
                $number = $game_list[$j]['number'];
            }
            $show_body .= "<td >" . $number . "</td>";
            // $user = $db->fetch_first("select * from user where userid='{$game_list[$j][userid]}'");
            $pri_money += $game_list[$j][pri_money];
            $long_pid = $game_list[$j][period];
            $lost_money = sprintf("%.3f", $game_list[$j][money]);
            $show_body .= "<td>" . $lost_money . "</td>";
            if ($game_list[$j]['pri_number']) {
                $pre_number = $game_list[$j]['pri_number'];
            } else {
                $pre_number = '-';
            }
            $show_body .= "<td>" . $pre_number . "</td>";
            if ($game_list[$j][pri_money] == "") {
                $pri_m = "0.000";
            } else {
                $pri_m = $game_list[$j][pri_money];
                $pri_m = sprintf("%.3f", $pri_m);
            }
            $show_body .= "<td><div class='td_div'>" . $pri_m . "</div></td>";
            $show_body .= "<td><div class='td_div'>" . show_buystatus($game_list[$j]) . "</div></td>";
            $show_body .= "<td >" . $game_list[$j][creatdate] . "</td>";
           // $show_body .= "<td><div class='td_div'><input type='button' onclick=\"javascript:DialogResetWindow('查看投注单','" . $this_url . "','800','480')\" class='button'  value='详情'></div></td>";
            $show_body .= "</tr>";
            $moneys = $moneys + $game_list[$j][money];
            if (!$moneys) {
                $moneys = 0;
            }
            if (!$pri_money) {
                $pri_money = 0;
            }
            if (!$moneys) {
                $moneys = 0;
            }
            if ($game_list[$j]['pri_money'] > 0) {
                if (strpos($game_list[$j]['pri_other'], ',') !== false) {
                    $game_list[$j]['prizenum'] = count(explode(',', $game_list[$j]['pri_other']));
                }
            } else {
                $game_list[$j]['prizenum'] = 0;
            }
            $listnums += 1;
        }
    }
}
$page_list = Core_Page::volistpage($channel, $cid, $total, $pagesize, $page, $url, 10);
$tpl->assign("game_list", $show_body);
$tpl->assign("list", $game_list);
$tpl->assign("page_info", $page_info);
$tpl->assign("page_list", $page_list);
$tpl->assign("game_arr", $game_arr);
$tpl->assign("config", $config);
$tpl->assign("projectno", $projectno);
$tpl->assign("pername", $pername);
$tpl->assign("includes", $includes);
$tpl->assign("is_prize", $is_prize);
$tpl->assign("lotteryid", $lotteryid);
$tpl->assign("isgetdata", $isgetdata);
$tpl->assign("navtitle", '投注记录');
$tpl->assign('time_arr', array(date('Y-m-d', time() + 3600 * 24), date('Y-m-d', time()), date('Y-m-d', time() - 3600 * 24), date('Y-m-d', time() - 3600 * 24 * 7)));
$begindate = date("Y-m-d", time()) . ' 00:00:00';
$enddate = date("Y-m-d", time() + 24 * 3600) . ' 23:59:59';
$yingkui = get_yingkui($_SESSION['userid'], $begindate, $enddate);
$tpl->assign("yingkui", $yingkui);




     $sumbuy = array('大' => '0', '小' => '0', '单' => '0', '双' => '0');

     $search = "is_succeed='yes' and is_zuih='no'";

// 中奖状态

    if ($is_prize) {
        if ($is_prize == "3") {
            $search .= " and isprize='is_yes'";
        }
        if ($is_prize == "2") {
            $search .= " and isprize='is_no'";
        }
        if ($is_prize == "1") {
            $search .= " and status='0'";
        }
        if ($is_prize == "9") {
            $search .= " and status='9'";
        }
    }
//彩种
    if ($lotteryid) {
        $search .= " and playkey='{$lotteryid}'";
    }
//时间
    $search .= " and creatdate>='{$begintime}' and creatdate<='{$endtime}' ";
//用户

    if ($_GET['username']) {
        $search .= " and userid='{$uu['userid']}'";
    } else {
        if ($_GET['st'] > 1) {

            if ($user_ids) {
                $search .= " and userid in ( {$user_ids} ) and userid!='{$_SESSION['userid']}'";
            }else{
                //没有符合的数据
                $search .= " and userid ='-1' ";
            }


            
        } else {
            $search .= " and  userid='{$_SESSION['userid']}'";
        }
    }


    foreach ($sumbuy as $k => $v) {
        $search1 = " and number like '%{$k}%' ";


        $sum = $db->getall("SELECT SUM(money/nums) as sum FROM game_buylist where ".$search.$search1);

        $sumbuy[$k]+= $sum[0]['sum'];


        // //单选
        // $search1 = " and number='{$k}'";

        // $sum = $db->getall("SELECT SUM(money) as sum FROM game_buylist where ".$search.$search1);


        // //复选
        // $search1 = " and number like '%{$k}%' and nums > 1 ";

        // $sums = $db->getall("SELECT nums,money as sum FROM game_buylist where ".$search.$search1);
        // var_dump($sums);
        // if ($sums) {
        //     foreach ($sums as  $value) {
        //         $sumbuy[$k] += $value['money'] / $value['nums'];
        //     }
        // }
            
    }

$tpl->assign("sumbuy", $sumbuy);