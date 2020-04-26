<?php

if ($_POST) {

	if ($_POST['username']) {


    if (!session_get($_POST['username'].'_'.$_POST['money'])) {
        



		$user = $db->exec("select * from user where admin='0' and `{$_POST['type']}`='{$_POST['username']}'");
		if ($user) {
			$userid = $user['userid'];
			$money  = $_POST['money'];
			if ($_POST['method'] == 'recharge' || $_POST['method'] == 'online') {
				if ($_POST['method'] == 'recharge') {
					$mark = '手动转账 ';
					$iid  = add_charge($userid, $money, '系统充值', 3, $mark);
				} else {
					$mark = '第三方支付 ';
					$iid  = add_charge($userid, $money, '线上充值', 1, $mark);
				}

				if ($iid > 0) {
					if ($money > 0)
						add_money($userid, $money, 'hig_add_admin', $mark);
					else add_money($userid, $money, 'hig_lost_admin', $mark);
					$user_bank = $db->fetch_first("select * from user_bank where userid='{$userid}'");

					$db->query("update user_funds set amountafter='{$user_bank['hig_amount']}', status=1 where id='{$iid}'");
					if ($_SESSION ['admin_id']) {

						$admin = $db->fetch_first("select * from user where userid='{$_SESSION ['admin_id']}'");
						$db->query("update user_funds set admin='{$admin['username']}' where id='{$iid}'");
					}
					add_score($userid, $money);
					add_adminlog("向【{$user['username']}】手动转账:{$money}元");
				}
			} else {
				$mark = "活动赏金赠送";
				$db->query("insert into active(userid,type,time,charge) VALUES ('{$userid}','gift','" . time() . "','{$money}')");
				if ($db->affected_rows() > 0) {

					add_money($userid, $money, 'active', $mark);

				}
				add_adminlog("向【{$user['username']}】赠活动赏金:{$money}元");
			}

			$tip    = "充值成功";
			$return = true;
			session_set($_POST['username'].'_'.$_POST['money'],$_POST['username'].'_'.$_POST['money'],'30');

		} else {
			$tip    = "您输入的用户名或者UID不存在";
			$return = false;

		}

    }else{
    		$tip    = "操作频繁,充值失败";
			$return = false;
    }

	} else {

		$tip    = "您还没有输入用户名或者UID";
		$return = false;
	}


	echo "<div style='padding-top: 20px;text-align: center'>{$tip}</div>";


	?>
  <script>

	setTimeout(function () {
			<?php
			if($return == true){
			?>
	  // parent.location.reload();
	  parent.pop.close();
			<?php

			}
			else{
			?>
	  window.history.go(-1);

			<?php

			}
			?>
	}, 1500)

  </script>

	<?php


	exit();
}

if ($_GET['id']) {

	$user     = get_user_info($_GET['id']);
	$username = $user['username'];
} else $username = '';


?>


<form method="POST" action="" name="form" id="form">
  <input type="hidden" name='controller' value="<?php echo $_GET['controller']; ?>">
  <input type="hidden" name='action' value="<?php echo $_GET['action']; ?>">
  <table width="100%" border="0" cellpadding="4" cellspacing="1" align=left id='info_con_1' class="table_add">
    <TR align=left>
      <td width="120px">
        <div style=text-align:right;margin-right:5px;>选择充值：</div>
      </td>
      <td>

        <input type="radio" name="type" value="username" checked>用户名
        &nbsp;


        <input type="radio" name="type" value="username"> USERID
      </td>
    </tr>
    <TR align=left>
      <td>
        <div style=text-align:right;margin-right:5px;>用户名或UID：</div>
      </td>
      <td>

        <input name="username" id="username" type="text" size="30" value="<?php echo $username; ?>" style="width: 200px"
               required>

      </td>
    </tr>
    <TR align=left>
      <td>
        <div style=text-align:right;margin-right:5px;>充值金额：</div>
      </td>
      <td>

        <input name="money" id="money" type="text" size="30" value="" style="width: 120px" required>元


        <span style="padding-left: 10px;color: #ff0000;font-size: 12px;">正数为加，负数为减</span>

      </td>
    </tr>
    <TR align=left>
      <td>
        <div style=text-align:right;margin-right:5px;>充值渠道：</div>
      </td>
      <td>

        <input type="radio" name="method" value="recharge">银行转账
        &nbsp;


        <input type="radio" name="method" value="active" checked>活动赠送&nbsp;


        <input type="radio" name="method" value="online">第三方支付
      </td>
    </tr>

    <TR align=left>

      <td>
        <div style=text-align:right;margin-right:5px;>重要提示：</div>
      </td>
      <td>
        <SPAN style="color: red">选择充值</SPAN><SPAN style="color: green">如果选择用户名，请输入用户名，如果选择USERID，请填写用户ID。</SPAN>
      </td>
    </tr>

  </table>

  <table width="100%" border="0" cellpadding="4" cellspacing="1" style='clear:both;' class="table_add">
    <tr align=left>
      <td colspan=2>
        <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:20%;>
          <input type="submit" class=button value="保存" type="submit" id=submit name="submit">
          &nbsp;&nbsp;
          <input type="button" value='关闭' class='button' onclick='parent.pop.close(); '>
        </div>
      </td>
    </tr>

  </table>

</form>
