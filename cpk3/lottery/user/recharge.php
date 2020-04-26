<?php

if ($_GET['type'] == 'del_all') {
	mysql_query("delete from  user_funds where cate='recharge' and status='0'");

	echo "<script>window.location='" . $_SERVER['HTTP_REFERER'] . "';</script>";
	exit();

}

if ($_GET['type'] == 'delete') {


	$sql = "select * from user_funds where status = 1 and  id='{$_GET['id']}' ";

	$list = $db->fetch_first($sql);

	if ($list) {
		echo "<script>alert('已审核，无法删除');window.location='" . $_SERVER['HTTP_REFERER'] . "';</script>";
		exit();
	}
    $sql = "select * from user_funds where id='{$_GET['id']}' ";

	$list = $db->fetch_first($sql);
	mysql_query("delete from  user_funds where id='{$_GET['id']}'");
	$sqlusername = "select * from `user` where userid='{$list['userid']}' ";

    $userinfo = $db->fetch_first($sqlusername);
	add_adminlog ( "删除用户名为{$userinfo['username']}的充值记录" );

	echo "<script>window.location='" . $_SERVER['HTTP_REFERER'] . "';</script>";
	exit();

}

$add_file      = $thispath . "_add";
$active        = $_GET['active'];
$playkey       = $_GET['playkey'];
$search        = "  user_funds.cate='recharge' and user.userid=user_funds.userid";
$begindate_get = $_GET['begindate'];
$enddate_get   = $_GET['enddate'];

$t_url = "?controller=user&action=recharge";
$db_s  = "user_bank_log";

$today = get_day_time();
if ($_GET['begintime']) {
	$begintime = $_GET['begintime'] . " 00:00:00";
} else $begintime = $today[0];
if ($_GET['endtime']) {
	$endtime = $_GET['endtime'] . " 23:59:59";
} else $endtime = $today[1];
$begin = substr($begintime, 0, 10);
$end   = substr($endtime, 0, 10);
if ($begintime and $endtime)
	$search .= " and user_funds.creatdate between '$begintime' and '$endtime'";

$pername = $_GET[pername];


if ($pername != "") {
	$search .= " and user.username='$pername'";
}
if ($_GET['usertype']) $usertype = $_GET['usertype'];
else $usertype = 1;
if ($usertype == 1) $search .= " and user_funds.userid in (select userid from user where admin=0 and   `virtual`='0' ) ";
if ($usertype == 2) $search .= " and user_funds.userid in (select userid from user where admin=0 and   `virtual`='1' ) ";

if (request('status') >= -1) {
	$status = request('status');
	if ($status == -1) $status = 0;
	$search .= " and ((user_funds.status='{$status}' and user_funds.type != 'online') or (user_funds.status = 1 and user_funds.type = 'online')) ";

} else {
	$search .= " and ((user_funds.status>=0 and user_funds.type != 'online') or (user_funds.status = 1 and user_funds.type = 'online'))";
}

//var_dump($search);exit;
$db->query("update user_funds set notice='1' where notice='0'");



if ($_GET['type'] == 'hand') {
	$search .= "and  user_funds.type='{$_GET['type']}' and user_funds.bankname not in('支付宝','微信支付')";
}elseif ($_GET['type'] == 'online') {
	$search .= " and (user_funds.type='{$_GET['type']}' or user_funds.bankname in('支付宝','微信支付')) ";
}elseif($_GET['type']){
	$search .= " and  user_funds.type='{$_GET['type']}' ";
}



if ($_GET['payname']) $search .= " and  payname='{$_GET['payname']}' ";
if ($_GET['order_sn']) $search .= " and order_sn='{$_GET['order_sn']}'";
if ($_GET['userid']) $search .= " and user.userid='{$_GET['userid']}'";
if ($_GET['first'] == 1) $search .= " and first='1'";
if ($_GET['first'] == 2) $search .= " and first='0'";
if ($_GET['uid']) {
	$uids   = get_user_nextid($_GET['uid']);
	$search .= " and user.userid in ({$uids}) ";

}
include(ROOT_PATH . "/" . $AdminPath . "/body_line_top.php");
?>


  <script language="javascript" type="text/javascript"
          src="<?php echo ROOT_URL; ?>/static/js/My97DatePicker/WdatePicker.js"></script>


  <form name="form1" id="form12" method="GET" action="?controller=user&action=recharge">

    <input name="controller" id="controller" type="text" value="user" style='display:none'>
    <input name="action" id="action" type="text" value="recharge" style='display:none'>
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

          &nbsp;

          <b>充值类型</b>：
					<?php
					$bank_list = get_bank_list();
					?>
          <select name='type' onchange="document.getElementById('submit').click();">
            <option value=''>-全部-</option>
						<?php foreach ($bank_list as $key => $value) { ?>

              <option value="<?php echo $key; ?>" <?php if ($key == $_GET['type']) echo "selected"; ?>><?php echo $value; ?></option>
						<?php } ?>
          </select>
          <b>充值状态</b>：
          <select name='status' onchange="document.getElementById('submit').click();">
            <option value=''>-全部-</option>
            <option value='-1' <?php if ($_GET['status'] == -1) echo "selected"; ?>>等待付款</option>
            <option value='1' <?php if ($_GET['status'] == 1) echo "selected"; ?>>充值成功</option>
            <option value='2' <?php if ($_GET['status'] == 2) echo "selected"; ?>>充值失败</option>

          </select>
          <b>账户类型</b>：

          <select name='usertype' onchange="document.getElementById('submit').click();">
            <option value='-1' <?php if ($usertype == '-1') echo "selected" ?> >-全部-</option>
            <option value='1' <?php if ($usertype == '1') echo "selected" ?> >正式账号</option>
            <option value='2' <?php if ($usertype == '2') echo "selected" ?> >内部账号</option>
          </select>
          <b>首充</b>：

          <select name='first' onchange="document.getElementById('submit').click();">
            <option value='-1' <?php if ($_GET['first'] == '-1') echo "selected" ?> >-不限-</option>
            <option value='1' <?php if ($_GET['first'] == '1') echo "selected" ?> >是</option>
            <option value='2' <?php if ($_GET['first'] == '2') echo "selected" ?> >否</option>
          </select>

          <br>
          <b>UID</b>：<input type="text" name="userid" id="userid" style="width:150px;"
                            value="<?php echo $_GET['userid'] ?>">
          &nbsp;
          <b>用户名</b>:
          <input name="pername" style="width:150px;" type="text" value="<?php echo $pername; ?>" size="20"
                 maxlength="20"/>
          <b>转账姓名</b>:
          <input name="payname" style="width:150px;" type="text" value="<?php echo $_GET['payname']; ?>" size="20"
                 maxlength="20"/>

          <b>时间</b>: <input type="text" name="begintime" value="<?php echo $begin; ?>" class="Wdate" type="text"
                            onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
          &nbsp;至

          <input type="text" name="endtime" value="<?php echo $end; ?>" class="Wdate" type="text"
                 onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>&nbsp;
          <input type="submit" class="button" name="submit" id="submit" value="提交"/>

        </td>
      </tr>
    </table>

    <script type="text/javascript">

	  function del_all() {


		var aa = confirm('确定要删除吗? ');
		if (aa == true) {

		  location.href = 'index.aspx?controller=user&action=recharge&type=del_all';

		}

	  }

	  function del_id(id) {


		location.href = 'index.aspx?controller=user&action=recharge&type=delete&id=' + id;


	  }

    </script>
  </form>
  <br>
<?php

echo '

<table> <tr>
         <th  bgcolor="#FFFFFF">UID</th>
          <th  bgcolor="#FFFFFF">用户名</th>
             <th  bgcolor="#FFFFFF">转账姓名</th>
          <th  bgcolor="#FFFFFF">操作金额(元)</th>
           <th  bgcolor="#FFFFFF">充值前余额</th>
            <th  bgcolor="#FFFFFF">充值后余额</th>
          <th  bgcolor="#FFFFFF">充值银行</th>

 
               <th  bgcolor="#FFFFFF">首充</th>
                   <th  bgcolor="#FFFFFF">备注</th>
                     <th  bgcolor="#FFFFFF">操作人</th>
          <th  bgcolor="#FFFFFF">时间</th>
         <th  bgcolor="#FFFFFF">充值状态</th>
          <th  bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';
echo $headpath;;
echo '/save_post.aspx?active=lotTime" >
       <input name="flag" type="hidden" value="save" />
       
	   ';

$strSqls = "update user_pupop set status='1' where status='0' and popupKey='recharge'";
$db->query($strSqls);

$sql3 = "select user_funds.*,user.username from user_funds,user where $search order by user_funds.creatdate desc ";

$listAll = $db->fetch_all($sql3);
$sum1    = 0;
if (count($listAll) > 0) {
	foreach ($listAll as $value) {

		$sum1 += $value['money'];
	}

}

$page    = new Page($sql3, 20, $_GET['page']);
$sql3    .= " limit {$page->from},20";
$result3 = mysql_query($sql3);
$listnum = 0;
$nums3   = mysql_num_rows($result3);
if ($nums3) {
	$i   = 0;
	$sum = 0;
	while ($rows3 = mysql_fetch_array($result3)) {
		$i++;
		$num  = $i + $starnum;
		$sum  += $rows3['money'];
		$user = get_user_info($rows3['userid']);
		if ($user['virtual'] == 1) $class = "class='virtual'"; else $class = '';
		echo "<tr height='25' align='center' {$class} >";
		echo "<td>" . $rows3[userid] . "</td>";
		echo "<td>{$rows3[username]}</td>";
		
        if ($rows3[bankname] == '绿色通道')
          echo "<td>{$rows3[realname]}</td>";
        else
          echo "<td>{$rows3[payname]}</td>";
      
		echo "<td><span style='font-weight: 700'>" . number_show($rows3['money']) . "</span></td>";
		echo "<td><span >" . number_show($rows3[hig_amount]) . "</span></td>";
		if (!$rows3['amountafter']) $after = '-';
		else  $after = number_show($rows3[amountafter]);

		echo "<td><span >" . $after . "</span></td>";

		$str11 = '';
		if ($rows3['online'] == 0) {
			if ($rows3['realname']) $str11 = "(" . $rows3['realname'] . ")";

		} else $str11 = '';
		echo "<td>" . $rows3[bankname] . "</td>";

		if ($rows3['first'] == 1) $first = '<span style="color: #ff0000;">是</span>';
		else $first = '否';
		echo "<td>" . $first . "</td>";
		echo "<td>" . $rows3[Man_remark] . "</td>";
		echo "<td>" . $rows3[admin] . "</td>";
		echo "<td>" . $rows3[creatdate] . "</td>";

		if ($rows3['status'] == 0) $status = "<font color='red'>等待付款</font>";
		if ($rows3['status'] == 1) $status = "充值成功";
		if ($rows3['status'] == 2) $status = "充值失败";
		echo "<td>" . $status . "</td>";
		$this_url = "index.aspx?controller=user&action=recharge_info&id=" . $rows3['id'];
		$status   = '';
		if ($rows3['status'] == 0) {

			$status = "<a onclick=\"javascript:winPop({title:'审核',form:'Form1',width:'500',height:'350',url:'{$this_url}'});\"  class='button'>审核</a>   ";
		}

		if ($rows3['status'] == 1)
			$status = "<span style='color: #ff0a09'>已审核</span>";
		if ($rows3['status'] != 1) {
			$status .= " <a onclick='del_id({$rows3['id']});' style='cursor:pointer;'>删除</a>";

		}

		echo "<td>" . $status . "</td>";
		echo "</tr>";
		$listnum += 1;
	}

	echo "<tr><td style='text-align: center' >本页合计</td>
<td colspan='2'></td>
<td style='text-align: center' >￥{$sum}</td>
<td colspan='9'></td>
</tr>";
	echo "<tr><td style='text-align: center' >所有合计</td>
<td colspan='2'></td>
<td style='text-align: center' >￥{$sum1}</td>
<td colspan='9'></td>
</tr>";
} else {
	echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=17><font color='#999999'>未找到记录</font></td></tr>";
};
echo '
	  </form>
	  <input id=\'listnums\' value=\'';
echo $listnum;;
echo '\' type=\'hidden\'>

<script> show_moneys(G(\'listnums\').value,"mon") </script>
  </table>

        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>

	    <link href="../static/css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="page">
					';
echo $page->get_page();;
echo '
	    </div>
	</div>
';
include(ROOT_PATH . "/" . $AdminPath . "/body_line_bottom.php")
?>