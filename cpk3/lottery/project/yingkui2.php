<?php

$begintime = $_GET['begintime'] ?: date('Y-m-d', strtotime('-3 day'));
$endtime = $_GET['endtime'] ?: date('Y-m-d', strtotime('-1 day'));
$username = $_GET['username'];
$userId = $_GET['userid'];

$search = "
    select 
  userid,
	username,
	realname,
	addr,
	sum( charge ) AS charge,
	sum( platform ) AS `platform`,
	sum( starAmount ) AS starAmount,
	sum( endAmount ) AS endAmount,
	sum( profit ) AS profit
from (
	SELECT
	userid,
	username,
	realname,
	addr,
	charge,
	`platform`,
	starAmount,
	endAmount,
	if (`date`='{$endtime}',profit,0) as profit,
	`date`
	
FROM
	yingkui_log 
WHERE
	`date` >= '{$begintime}' 
	AND `date` <= '{$endtime}' 
) as t WHERE 1=1 
";

if ($username) {
    $search .= " and username='{$username}' ";
}
if ($userId) {
    $search .= " and userid='{$userId}' ";
}
if ($_GET['uid'] && $_GET['uid'] != '全部') {
    $uids = get_user_nextid($_GET['uid']);
    $search .= " and userid in ({$uids}) ";
}
$search .= " group by userid";
if ($_GET['orderby']) {
    $search .= " order by {$_GET['orderby']}";
}
$page = new Page($search, 20, $_GET['page']);
$search .= " limit {$page->from},20";
//echo $search;
$result = $db->fetch_all($search);
if (!$result) {
    $result = [];
}
$begin = substr($begintime, 0, 10);
$end = substr($endtime, 0, 10);
include(ROOT_PATH . "/" . $AdminPath . "/body_line_top.php");;

?>


<form action="" method="get" target="_self" id="form1">
    <input name="controller" id="controller" type="text" value="project" style='display:none'>
    <input name="action" id="action" type="text" value="yingkui2" style='display:none'>

    <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0"
           cellpadding="0" class="my_tbl">
        <tr>
            <td align='left'>
                超级代理：
                <select name="uid" onchange="document.getElementById('form1').submit();">

                    <option>全部</option>
                    <?php
                    $temp11 = $db->fetch_all("select * from user where higherid='0' and admin='0' order by userid asc");
                    foreach ($temp11 as $value11) {
                        ?>


                        <option value='<?php echo $value11['userid']; ?>' <?php if ($_GET['uid'] == $value11['userid']) echo "selected"; ?>><?php echo $value11['username']; ?></option>
                        <?php
                    }
                    ?>


                </select>

                账号：


                <input style="width: 120px" class="textbox" name="username" type="text" id="username"
                       value="<?php echo $_GET['username'] ?>" size="20"/>


                &nbsp;Uid：


                <input style="width: 120px" class="textbox" name="userid" type="text" id="userid"
                       value="<?php echo $_GET['userid'] ?>" size="20"/>


                &nbsp;日期：
                <input type="text" name="begintime" value="<?php echo $begin; ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
                &nbsp;至

                <input type="text" name="endtime" value="<?php echo $end; ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>&nbsp;

                &nbsp;<input type="submit" class="button" onclick="" value=" 查询 "/>
            </td>
        </tr>
    </table>
</form>
<table style="border-top: 0px;text-align:center; " class="my_tbl list_tbl" border="0" cellspacing="0" cellpadding="0"
       width="100%">
    <tbody>
    <tr>
        <th>用户编号</th>
        <th>用户账号</th>
        <th>用户姓名</th>
        <th>用户地址</th>
        <th>总充值金额<?php echo show_order('charge'); ?>
        </th>
        <th>总提现金额<?php echo show_order('platform'); ?>
        </th>
        <th>起始金额<?php echo show_order('starAmount'); ?>
        </th>
        <th>终止余额<?php echo show_order('endAmount'); ?>
        </th>
        <th>用户盈亏<?php echo show_order('profit'); ?>
        </th>

    </tr>

    <?php foreach ($result as $key => $value) {


        ?>

        <tr>
            <td>
                <?php echo $value['userid']; ?>
            </td>
            <td>
                <?php echo $value['username']; ?>
            </td>
            <td><?php echo $value['realname']; ?></td>
            <td><?php echo $value['addr']; ?></td>
            <td><?php echo $value['charge']; ?></td>
            <td><?php echo $value['platform']; ?></td>
            <td><?php echo $value['starAmount']; ?></td>
            <td><?php echo $value['endAmount']; ?></td>
            <td><?php echo $value['profit']; ?></td>
        </tr>


    <?php } ?>

</table>
<div class="page">
    <?php

    echo $page->get_page();
    ?>

</div>
