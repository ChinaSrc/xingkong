<?php

if($_POST){

	if($_POST['status']){
		$status=$_POST['status'];
		$id=$_GET['id'];
		if($status==1) {agree_plate($id,$_POST['remark']);}
if($status==2) {deny_plate($id,$_POST['remark']);}
	$funds=$db->fetch_first("select * from user_funds where id='{$_GET['id']}'");

	$db->query("update  game_buylist  set error='-1' where userid='{$funds['userid']}' and  error>0  ");

				echo "<div style='font-size:12px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>操作成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close(); \",1000);parent.window.location.reload();</script>";


exit();
		}




	else{
	echo "<script>alert('请选择操作类型');</script>";
	echo "<script>setTimeout(\"parent.pop.close(); \",1000);parent.window.location.reload();</script>";
		exit();
	}

}

$funds=$db->fetch_first("select * from user_funds where id='{$_GET['id']}'");

		$user=$db->fetch_first("select * from user where userid='{$funds['userid']}'");

$bank=unserialize($funds['bankinfo']);

		//$sql="select id from game_buylist where userid='{$funds['userid']}' AND error>0 order by id desc limit 0,1";

		//$buy=$db->fetch_first("select id from game_buylist where userid='{$funds['userid']}' AND error>0 order by id desc limit 0,1");
		?>


		<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>2017/Css/mycenter.css" type="text/css" rel="stylesheet">
            <script type="text/javascript" src="/template/default/2018/sy2/js/clipboard.min.js"></script>

    <style>
tr,td {font-size:16px;height:35px;line-height:35px;}
</style>
</head>
<body>

<form action="index.aspx?controller=user&action=platform_info&active=save&id=<?php echo $_GET['id'];?>" method="post">

<input type='hidden' name='backurl' value='<?php echo $_SERVER['HTTP_REFERER'];?>' />
    <table width="100%" border="0" style="background: #ffffff;text-align:center;" cellspacing="0" cellpadding="0"  style='display:none;'>
        <tbody><tr>
            <td style="padding: 5px;">



               <table style="border-bottom: 0px;  text-align:center;margin-top:20px;" class="table_add ft16" border="0" cellspacing="0" cellpadding="0" width="100%"  style='font-size:16px;'>
                    <tbody>



                         <tr>
                        <td height="27" align="right"  style='background-color:#fff;'>
                         用户名：
                        </td>
                        <td height="27" align="left">
                          <span class="red"> <?php echo $user['username'];?></span>
                    </td>
                    </tr>
                    <tr>
                      <td align="right"  style='background-color:#fff;'>提现金额：</td>
                      <td align="left"><span class="red"><?php echo $funds['money'];?> 元</span>
                       

                      </td>
                    </tr>

                    <tr>
                      <td align="right"  style='background-color:#fff;'>提现银行：</td>
                      <td align="left">
                      <b class="blue">
                          <?php echo $bank['bankname'];?>

                      </b>
                         

                      </td>
                    </tr>

                                 


                        


                         <tr>
                      <td align="right"  style='background-color:#fff;'>银行户名：</td>
                      <td align="left"><b class="blue"><?php echo $bank['realname'];?></b>

                         

                      </td>
                    </tr>

                    <tr>
                        <td align="right"  style='background-color:#fff;'>
                            银行账号：
                        </td>
                        <td align="left"><b class="blue"><?php echo $bank['banknum'];?></b>
                          

                        </td>
                    </tr>

               <tr>
                        <td align="right"  style='background-color:#fff;'>
                            提现时间：
                        </td>
                        <td align="left"><?php echo $funds['creatdate'];?></td>
                    </tr>

          <tr>
                        <td align="right"  style='background-color:#fff;'>
               提现状态：
                        </td>

                        <td align="left">

                       <span class="red">
                        <?php
                        if($funds['status']==0) $status="等待汇款";
if($funds['status']==1) $status="提现成功";
if($funds['status']==2) $status="提现失败";
echo $status;
                        ?>
          </span>
                       </td>
                    </tr>





               <?php if($funds['status']==0){?>
                 
         <tr>
                        <td align="right"  style='background-color:#fff;'>
   操作类型：
                        </td>

                        <td align="left">
                      <input type='radio' name='status' value='1' checked>审核通过
                      <input type='radio' name='status' value='2'>拒绝退回
                       </td>
                    </tr>


                             <tr>
                        <td align="right"  style='background-color:#fff;'>

                        </td>

                        <td align="left">
                    <input type="submit" value='处理提现' class='button' >


                    <input type="button" value='暂不处理' class='button' onclick='parent.pop.close();'>
                       </td>
                    </tr>



                  <?php }else{?>


                             <tr>
                        <td align="right"  style='background-color:#fff;'>

                        </td>

                        <td align="left">
                    <input type="button" value='处理提现' class='button' onclick='parent.pop.close();'>
                       </td>
                    </tr>
                  <?php }?>
                </tbody></table>

</form>
</body></html>



    <script type="text/javascript">
        var clipboard = new Clipboard('input[id^="copy"]');
        clipboard.on('success', function(e) {
            alert("复制到剪贴板：" + e.text)
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert('Action:', e.action);
            alert('Trigger:', e.trigger);
        });

    </script>




