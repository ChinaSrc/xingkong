<?php

header("content-type:text/html; charset=utf-8");
$active = $_GET['active'];
$playkey = $_GET['playkey'];
if ($active == "point") {
    $search = " user_bank_log.cate in ('hig_rebate','low_rebate') ";
}
if ($active == "account") {
    $search = " 1=1";
//$search=" user.userid=user_bank_log.userid";
}


$ordertype = isset($_POST[ordertype]) ? $_POST[ordertype] : $_GET[ordertype];

$begindate = $_GET['begindate'];
$enddate = $_GET['enddate'];

$t_url = "?controller=project&action=bank&active=" . $active;
$db_s = "user_bank_log";

$today = get_day_time();
if ($_GET['begintime']) {
    $begintime = $_GET['begintime'];
} else $begintime = $today[0];
if ($_GET['endtime']) {
    $endtime = $_GET['endtime'];
} else $endtime = $today[1];
$begin = substr($begintime, 0, 10);
$end = substr($endtime, 0, 10);
$search .= " and user_bank_log.creatdate between '$begintime' and '$endtime'";
if ($ordertype) {
    if (strpos($ordertype, '|')) {
        $new_order = str_replace("|", "','", $ordertype);
        $new_order = "'" . $new_order . "'";
    } else {
        $new_order = "'" . $ordertype . "'";
    }
    $search .= " and (user_bank_log.cate in($new_order))";
    $t_url .= "&ordertype=" . $ordertype;
}
$projectno = $_GET['projectno'];
if ($projectno != "") {
    $search .= " and (user_bank_log.floatid='$projectno' or user_bank_log.accountid='$projectno')";
    $t_url .= "&projectno=" . $projectno;

}
$pername = $_GET['pername'];

if ($_GET['uid']) {
    $uids = get_user_nextid($_GET['uid']);
    $search .= " and userid in ({$uids}) ";

}

if ($pername != "") {
    //$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;$db_s="user_bank_log,user";
    if ($active == "account") {
        $userSear = get_user_info_by_username($pername);
        //var_dump($userSear);
        $search .= " and userid='" . $userSear['userid'] . "'";
        $db_s = "user_bank_log";
    } else {
        $search .= " and user.username='$pername'";
        $db_s = "user_bank_log,user";
    }
    $t_url .= "&pername=" . $pername;
};
$body_top_title = "搜索记录";
include(ROOT_PATH . "/" . $AdminPath . "/body_line_top.php");
?>


    <form action="" method="GET" style="display:inline;" id="form1">
        <input name="controller" id="controller" type="text" value="project" style='display:none'>
        <input name="action" id="action" type="text" value="bank" style='display:none'>
        <input name="active" id="active" type="text" value="<?php echo $active; ?>" style='display:none'>
        <input type="hidden" name="from" value="<?php echo $_GET['from'] ?>">
        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
            <tr>
                <td align='left' style="padding-left: 10px;">

                    超级代理：
                    <select name="uid" onchange="document.getElementById('submit').click();">

                        <option value="">全部</option>
                        <?php
                        $temp11 = $db->fetch_all("select * from user where higherid='0' and admin='0' order by userid asc");
                        foreach ($temp11 as $value11) {
                            ?>


                            <option value='<?php echo $value11['userid']; ?>' <?php if ($_GET['uid'] == $value11['userid']) echo "selected"; ?>><?php echo $value11['username']; ?></option>
                            <?php
                        }
                        ?>


                    </select>
                    &nbsp;用户名:
                    <input name="pername" class="input" type="text" value="<?php echo $pername; ?>" size="20"
                           maxlength="20"/>

                    <b>时间</b>： <input type="text" name="begintime" value="<?php echo $begintime; ?>" class="Wdate"
                                      type="text"
                                      onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})"/>
                    &nbsp;至

                    <input type="text" name="endtime" value="<?php echo $endtime; ?>" class="Wdate" type="text"
                           onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})"/>&nbsp;

                    &nbsp;&nbsp;
                    <?php
                    if ($active != 'point') {
                        ?>
                        <b>类型</b>：<select name="ordertype" id="ordertype" style="width:100px;">
                            <option value="">所有类型</option>
                            <?php
                            echo money_select_list();
                            ?>
                        </select>
                        <script>selectSetItem(G('ordertype'), '<?php echo $ordertype;?>')</script>
                    <?php } ?>
                    <input type="submit" id="submit" class="button" name="submit" value="提交"/>
                </td>
            </tr>
        </table>

    </form>

<?php
include(ROOT_PATH . "/" . $AdminPath . "/body_line_top.php");
echo '<table> <tr>
	      <th  bgcolor="#FFFFFF">单号</th>
 <th bgcolor="#FFFFFF">用户名</th>

		  <th bgcolor="#FFFFFF">类型</th>

          <th  bgcolor="#FFFFFF">帐变（元）</th>
          
          <th bgcolor="#FFFFFF">账户余额</th>
                 <th  bgcolor="#FFFFFF">洗码</th>
                  <th bgcolor="#FFFFFF">洗码余额</th>
          <th  bgcolor="#FFFFFF">时间</th>

          ';
if ($active != 'point') {
    echo '<th  bgcolor="#FFFFFF">说明</th>';

}

if ($active == 'point') {
    echo '<th bgcolor="#FFFFFF">详情</th>';

}

echo '
       </tr>
     <form name="myform" id="myform" method="post" action="../';
echo $headpath;;
echo '/save_post.aspx?active=lotTime" >
       <input name="flag" type="hidden" value="save" />
       <input name="playkey" type="hidden" value="';
echo $playkey;;
echo '" />
	   ';
mysql_query("set names utf8;");

//$sql3="select user_bank_log.*,user.username from user_bank_log,user where $search order by user_bank_log.creatdate desc limit $starnum,$maxnum";
if ($active == "account") {
    $sql3 = "select user_bank_log.*, '" . $pername . "' as username from user_bank_log where $search order by user_bank_log.creatdate desc limit $starnum,$maxnum";
} else {
    $sql3 = "select user_bank_log.* from user_bank_log where $search order by user_bank_log.creatdate desc limit $starnum,$maxnum";
}
//var_dump($sql3);die;
$result3 = mysql_query($sql3);
$listnum = 0;
$nums3 = mysql_num_rows($result3);
$result9 = mysql_query("select count(user_bank_log.creatdate) from $db_s where $search") or die("未能读取，请刷新");
$rows9 = mysql_fetch_row($result9);
if ($nums3) {
    $idata = [];
    while ($rows3 = mysql_fetch_array($result3)) {
        $serchUsersId[] = $rows3['userid'];
        $idata[] = $rows3;
    }
    $serchUsers = mysql_query('select userid,username from `user` where userid in (' . implode(',', $serchUsersId) . ')');
    $usernameForUserid = [];
    while ($rows3 = mysql_fetch_array($serchUsers)) {
        $usernameForUserid[$rows3['userid']] = $rows3['username'];
    }
    $i = $starnum;
    foreach ($idata as $rows3)  {
        $i++;
        $this_url = ROOT_URL . "/do.aspx?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=" . $rows3[floatid];
        if ($rows3[floatid]) {
            $chekd = "javascript:winPop({title:'查看投注单',form:'Form1',width:'800',height:'350',url:'" . $this_url . "'});";
        }
        $user = get_user_info($rows3['userid']);
        if ($user['virtual'] == 1) $class = "class='virtual'"; else $class = '';
        echo "<tr height='25' align='center' {$class}>";
        echo "<td><div onclick=\"" . $chekd . "\" target='_blank' style='cursor:pointer;'>" . $rows3['accountid'] . "</div></td>";
        echo "<td><a    onclick=\"javascript:winPop({title:'修改用户信息',form:'Form1',width:'600',height:'500',url:'?controller=user&action=index_add&id={$rows3['userid']}'});\"  >{$usernameForUserid[$rows3[userid]]}</a></td>";


        echo "<td>" . hig_log_code($rows3[cate]) . "</td>";

        if (in_array($rows3[cate], $arr_add_money) === true) {
            $secai = "add";
        } else {
            $secai = "lost";
        }
        $t_monoey = number_show($rows3[moneys], 3);
        if ($secai == "add") {

            if ($t_monoey > 0) $st = '+'; else $st = '';
            $jine_s = "<span >{$st}<font id='mon_" . $listnums . "'>" . $t_monoey . "</font></span>";
            $add_money += $t_monoey;
        } elseif ($secai == "lost") {
            if ($t_monoey > 0) $st = '-'; else $st = '';
            $jine_s = "<span >{$st}<font id='mon_" . $listnums . "'>" . $t_monoey . "</font></span>";
            $lost_money += $t_monoey;
        } else {
            $jine_s = "<span color=''><font id='mon_" . $listnums . "'>" . number_show($t_monoey, 3) . "</font></span>";
        }
        echo "<td>{$jine_s}</td>";
        echo "<td><span id='allmon_" . $listnum . "'>" . number_show($rows3[hig_amount], 3) . "</span></td>";
        if ($rows3[amount] > 0) $st = '+'; else $st = '';

        if ($rows3[amount] != '') $amount = number_show($rows3[amount], 3);
        else $amount = 0;
        echo "<td><span id='allmon_" . $listnum . "'>$st" . $amount . "</span></td>";

        echo "<td><span id='allmon_" . $listnum . "'>" . number_show($rows3[low_amount], 3) . "</span></td>";
        echo "<td>" . $rows3[creatdate] . "</td>";
        if ($rows3['status'] == 0)
            $status = "正常";
        else  $status = '异常';

        if ($active != 'point')
            echo "<td>" . $rows3[remarks] . "</td>";
        if ($active == 'point') {
            $this_url = "../index.aspx?mod=fandian&code=info&time=" . strtotime($rows3[creatdate]) . "&uid=" . $rows3[userid];
            $this_link = "href='javascript:void(0);' onclick=\"winPop({title:'（{$rows3['username']}）返点详情',form:'Form1',width:'800',height:'500',url:'" . $this_url . "'})\"";


            echo "<td $this_link  style='cursor:pointer;'>查看详情</td>";

        }


        $listnum += 1;
    }
} else {
    echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=9><font color='#999999'>未找到记录</font></td></tr>";
};
echo '
	  </form>
	  <input id=\'listnums\' value=\'';
echo $listnum;;
echo '\' type=\'hidden\'>
	  <script> show_moneys(G(\'listnums\').value,"mon");show_moneys(G(\'listnums\').value,"allmon");</script>
  </table>

    <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>

	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum = $rows9[0];
$pageurl = $t_url;
$pagelist = $maxnum;
include("../source/plugin/pages.php");;
echo '
	    </div>
	</div>
';
include(ROOT_PATH . "/" . $AdminPath . "/body_line_bottom.php");
?>