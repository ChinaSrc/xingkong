<?php
$begindate = isset($_POST[begindate]) ? $_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ? $_POST[enddate] : $_GET[enddate];
$type = isset($_POST[type]) ? $_POST[type] : $_GET[type];
$code_s = isset($_POST[code_s]) ? $_POST[code_s] : $_GET[code_s];
$modes = isset($_POST[modes]) ? $_POST[modes] : $_GET[modes];
$lotteryid = isset($_POST[lotteryid]) ? $_POST[lotteryid] : $_GET[lotteryid];
$ordertype = isset($_POST[ordertype]) ? $_POST[ordertype] : $_GET[ordertype];
$pername = isset($_POST[pername]) ? $_POST[pername] : $_GET[pername];
$isgetdata = 'yes';
$show_body = "";
$this_end_time = core_fun::nowtime('t', 'yes');
$statbegins = str_replace(':', '', $config[statbegin]);
if (strlen($statbegins) - 4 == 0) {
    $this_end_time = substr($this_end_time, 0, 2);
}
if ($isgetdata == "yes") {
    $t_url = $this_url . "&isgetdata=" . $isgetdata;
    $search = " where 1=1";
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
    if ($type and $code_s) {
        $t_url .= "&type=" . $type . "&code_s=" . $code_s;
        if ($type - 1 >= 0) {
            $search .= " and b.floatid='{$code_s}'";
        }
        if ($type - 2 > 0) {
            $search .= " and b.accountid='{$code_s}'";
        }
    }
    if ($modes) {
        $t_url .= "&modes=" . $modes;
        $search .= " and b.modes='{$modes}'";
    }
    if ($lotteryid) {
        $t_url .= "&lotteryid=" . $lotteryid;
        $search .= " and b.playkey='{$lotteryid}'";
    }
    if ($ordertype) {
        if (strpos($ordertype, '|')) {
            $new_order = str_replace("|", "','", $ordertype);
            $new_order = "'" . $new_order . "'";
        } else {
            $new_order = "'" . $ordertype . "'";
        }
        $search .= " and (b.cate in({$new_order}))";
        $t_url .= "&ordertype=" . $ordertype;
    }
    if ($_GET['username']) {
        $uu = $db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");
        if (is_team($uu['userid'], $_SESSION['userid']) or $uu['userid'] == $_SESSION['userid']) {
            $search .= " and b.userid='{$uu['userid']}'";
        } else {
            $search .= " and b.userid='-1'";
        }
    } else {
        if ($_GET['st'] > 1) {
            $user_ids = get_user_nextid($_SESSION['userid']);
            $user_ids = str_replace("'", "", $user_ids);
            $search .= " and b.userid in ( {$user_ids} ) and b.userid!='{$_SESSION['userid']}'";
        } else {
            $search .= " and  b.userid='{$_SESSION['userid']}'";
        }
    }
    $dblist = " " . DB_PREFIX . "user_bank_log as b";
    $page = $_GET['page'];
    if (!$page or $page == 0) {
        $page = 1;
    }
    $countsql = "SELECT COUNT(b.creatdate) FROM {$dblist} " . $search;
    $total = $db->fetch_count($countsql);
    $pagecount = ceil($total / $pagesize);
    $start = ($page - 1) * $pagesize;
    $game_list = array();
    $game_list_sql = "SELECT b.* FROM {$dblist} {$search} ORDER BY b.creatdate desc LIMIT {$start}, {$pagesize}"; // pername
    //echo $game_list_sql;
    $game_list = $db->getall($game_list_sql);

    $page_info = "页次：" . $page . " / " . $pagecount . " 页 " . $pagesize . " 条/每页  共：" . $total . " 条";
    $url = $t_url . "&";
    $channel = "case";
    $listnums = 0;
    if ($game_list) {   //user_bank_log . floatid === game_buylist . buyid     game_buylist . list_id === game_code_list === ListKey
        $userIds = array_column($game_list, 'userid');
        $userinfos = $db->fetch_all("select username,userid from `user` where userid in (" . implode(',', $userIds) . ")");

        $userNameArr = array_column($userinfos, 'username', 'userid');

        $floatids = array_filter(array_column($game_list, 'floatid'));
        $gameListsTmp = '';
        if ($floatids) {
          	$before=date("Y-m-d H:i:s", strtotime("-1 week"));
        	$gameListsTmp = $db->fetch_all("select period,modes,playkey,buyid,list_id from `game_buylist` where creatdate > '$before' and buyid in (" . implode(',', $floatids) . ")");
        }

        if ($gameListsTmp) {
            $gameLists = array_column($gameListsTmp, ['period', 'modes', 'playkey', 'buyid', 'list_id'], 'buyid');
            $listIds = array_filter(array_column($gameLists, 'list_id'));
            $gameCodesTmp = $db->fetch_all("select CodeTile as code, ShowTile as fullname , ListKey from `game_code_list` where ListKey in (" . implode(',', $listIds) . ")");
            if ($gameCodesTmp) {
                $gameCodes = array_column($gameCodesTmp, ['code', 'fullname'], 'ListKey');
            } else {
                $gameCodes = [];
            }
        } else {
            $gameLists = [];
        }

        for ($j = 0; $j < count($game_list); $j++) {

            $list_id = (isset($gameCodes[$gameLists[ $game_list[$j]['floatid'] ]['list_id']]['code']) ? : '')  . '-' . (isset($gameCodes[$gameLists[ $game_list[$j]['floatid'] ]['list_id']]['fullname']) ? : '');//$game_buy[code] . "-" . $game_buy[fullname];
            $fullname = isset($gameCodes[$gameLists[ $game_list[$j]['floatid'] ]['list_id']]['fullname']) ? : '-';
            $period = isset($gameLists[ $game_list[$j]['floatid'] ]['period']) ? : '-';
            $playkey = isset($gameLists[ $game_list[$j]['floatid'] ]['playkey']) ? : '-';
            $modes = isset($gameLists[ $game_list[$j]['floatid'] ]['modes']) ? : '-';
            $game_list[$j]['pername'] = $userNameArr[$game_list[$j]['userid']];
            $remarks = "-----";
            if ($game_list[$j]['status'] == 0) {
                $status = "正常";
            } else {
                $status = '异常';
            }
            if ($game_list[$j][remarks] != "") {
                $remarks = $game_list[$j][remarks];
            }
            if ($listnums % 2 == 0) {
                $trbg = " class='table_b_tr_a'";
            } else {
                $trbg = " class='table_b_tr_b'";
            }
            if ($game_list[$j]['floatid']) {
                if (strpos($remarks, '合买') !== false) {
                    $this_url = "index_hemai_detail.html?id=" . $game_list[$j]['floatid'];
                } else {
                    $this_url = "do.aspx?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=" . $game_list[$j]['floatid'];
                }
                $chekd = " DialogResetWindow('查看投注单','{$this_url}','800','550')";
            } else {
                $chekd = '';
            }
            $show_body .= "<tr " . $trbg . " onclick=\" {$chekd}\">";
            $this_link = "";
            if (in_array($game_list[$j][cate], $have_link_gp) === true) {
                $this_url = $do_url . "?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=" . $game_list[$j][floatid];
                $this_link = "href='#' onclick=\"javascript:DialogResetWindow('查看投注单','" . $this_url . "','600','500')\"";
            }
            $num = $j + 1 + $start;
            if (strlen($game_list[$j][accountid]) - 8 >= 0) {
                $accountid = substr($game_list[$j][accountid], 0, 6) . "..";
            } else {
                $accountid = $game_list[$j][accountid];
            }
            //$show_body.= " <td align='center' >{$num}</td>";
            if ($_GET['st'] > 1) {
                $show_body .= " <td align='center' >{$userNameArr[$game_list[$j]['userid']]}</td>";
            }
            $show_body .= " <td>" . hig_log_code($game_list[$j][cate]) . "</td>";
            $secai = "";
            if (in_array($game_list[$j][cate], $arr_add_money) === true) {
                $secai = "add";
            } else {
                $secai = "lost";
            }
            $t_monoey = sprintf("%.3f", $game_list[$j][moneys]);
            if ($secai == "add") {
                $jine_s = "<span style='color:#1CB447'>+<font id='mon_" . $listnums . "'>" . $t_monoey . "</font></span>";
                $add_money += $t_monoey;
            } elseif ($secai == "lost") {
                $jine_s = "<span style='color:#F73E54'>-<font id='mon_" . $listnums . "'>" . $t_monoey . "</font></span>";
                $lost_money += $t_monoey;
            } else {
                $jine_s = "<span color=''><font id='mon_" . $listnums . "'>" . $t_monoey . "</font></span>";
            }
            $game_list[$j]['t_money'] = $jine_s;
            $show_body .= " <td>" . $jine_s . "</td>";
            $show_body .= " <td><span>" . sprintf("%.3f", $game_list[$j][hig_amount]) . "</span></td>";
            if ($game_list[$j][amount] > 0) {
                $st1 = '+';
            } else {
                $st1 = '';
            }
            $show_body .= " <td><span >{$st1}" . sprintf("%.3f", $game_list[$j][amount]) . "</span></td>";
            $show_body .= " <td><span >" . sprintf("%.3f", $game_list[$j][low_amount]) . "</span></td>";
            //$show_body.= " <td>".$game_list[$j][pername]."</td>";
            $show_body .= " <td>" . substr($game_list[$j][creatdate], 0, strlen($game_list[$j][creatdate])) . "</td>";
            $game_list[$j]['last_money'] = sprintf("%.3f", $game_list[$j][hig_amount]);
            //$show_body.= " <td>".$status."</td>";
            $show_body .= " <td><div style='word-break:break-all;overflow:auto;'>" . $remarks . "<div></td>";
            $show_body .= "</tr>";
            $listnums += 1;
        }
        $end_money = $add_money - $lost_money;
        if ($end_money > 0) {
            $show_end_money = "<span><b><font id='show_end_money' color='green'>" . sprintf("%.2f", $end_money) . "</font></b></span>";
            $show_end_money_td = "<span><b><font id='show_end_money_td' color='green'>" . $show_end_money . "</font></b></span>";
        } else {
            $show_end_money = "<span><b><font id='show_end_money' color='Red'>" . sprintf("%.2f", $end_money) . "</font></b></span>";
            $show_end_money_td = "<span><b><font id='show_end_money_td' color='Red'>" . $show_end_money . "</font></b></span>";
        }
        $show_body .= "<input id='listnums' name='listnums' value='" . $listnums . "' style='display:none'>";
        $show_body .= "<tr >";
        $show_body .= "<td colspan='5'></td>";
        $show_body .= "<td height='30' colspan='2' align='right'>";
        $show_body .= "小结:本页资金变动：&nbsp;" . $show_end_money_td . "&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        $show_body .= "</tr>";
    } else {
        $show_body .= "<tr height=35 align=center>";
        $show_body .= '<td colspan=12> <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="static/images/empty.png" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div></td>';
        $show_body .= "</tr>";
    }
}
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$page_list = Core_Page::volistpage($channel, $cid, $total, $pagesize, $page, $url, 10);
$tpl->assign("body_list", $show_body);
$tpl->assign("page_info", $page_info);
$tpl->assign("page_list", $page_list);
$tpl->assign("game_arr", $game_arr);
$tpl->assign("config", $config);
$tpl->assign("begindate", $begin);
$tpl->assign("enddate", $end);
$tpl->assign("projectno", $projectno);
$tpl->assign("pername", $pername);
$tpl->assign("includes", $includes);
$tpl->assign("is_prize", $is_prize);
$tpl->assign("type", $type);
$tpl->assign("code_s", $code_s);
$tpl->assign("modes", $modes);
$tpl->assign("lotteryid", $lotteryid);
$tpl->assign("isgetdata", $isgetdata);
$tpl->assign("ordertype", $ordertype);
$tpl->assign("list", $game_list);
$tpl->assign("navtitle", '帐变明细');
$tpl->assign('time_arr', array(date('Y-m-d', time() + 3600 * 24), date('Y-m-d', time()), date('Y-m-d', time() - 3600 * 24), date('Y-m-d', time() - 3600 * 24 * 7)));