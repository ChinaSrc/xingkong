<?php

if($_POST){

	if($_POST['status']){
		$status=$_POST['status'];
		$id=$_GET['id'];
		if($status==1) {agree_charge($id,$_POST['remark']);}
if($status==2) {deny_charge($id,$_POST['remark']);}


				echo "<div style='font-size:12px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>操作成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close(); \",1000);parent.window.location.reload();</script>";


exit();
		}




	else{
	echo "<script>alert('请选择操作类型'); </script>";
	echo "<script>setTimeout(\"parent.pop.close(); \",1000);parent.window.location.reload();</script>";
		exit();
	}

}

$funds=$db->fetch_first("select * from user_funds where id='{$_GET['id']}'");
		$bank=$db->fetch_first("select * from user_bank_list where userid='{$funds['userid']}'");
				$user=$db->fetch_first("select * from user where userid='{$funds['userid']}'");

		?>


		<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>2017/Css/mycenter.css" type="text/css" rel="stylesheet">


</head>
<body>


<style>
tr,td {font-size:16px;height:35px;line-height:35px;}
</style>
<form action="index.aspx?controller=user&action=recharge_info&active=save&id=<?php echo $_GET['id'];?>" method="post">
<input type='hidden' name='backurl' value='<?php echo $_SERVER['HTTP_REFERER'];?>' />




                <table style="border-bottom: 0px;  text-align:center;" class="table_add" border="0" cellspacing="0" cellpadding="0" width="100%"  style='font-size:16px;'>
                    <tbody>


                                         <tr>
                        <td height="27" align="right"  style='background-color:#fff;min-width: 120px'>
                            用户名：
                        </td>
                        <td height="27" align="left">
                        <span class="red"><?php echo $user['username'];?></span>

                        </td>
                    </tr>
                                  <?php
                    if($funds['payname']){
                    ?>
                                 <tr>
                      <td align="right"  style='background-color:#fff;'>汇款账户名：</td>
                      <td align="left">
                   <?php echo $funds['payname'];?>

                      </td>
                    </tr>
                     <?php }?>


                    <tr>
                      <td align="right"  style='background-color:#fff;'>充值金额：</td>
                      <td align="left"><span class="red"><?php echo $funds['money'];?> 元</span>
                       </td>
                    </tr>
                                         <?php
                                         if(strpos($funds['bankname'],'银行')!==false){
                                             ?>
                                             <tr>
                                                 <td align="right"  style='background-color:#fff;'>充值银行：</td>
                                                 <td align="left">
                                                     <?php echo $funds['bankname'];?>
                                                 </td>
                                             </tr>

                                             <?php if($funds['banknum']){ ?>
                                                 <tr>
                                                     <td align="right"  style='background-color:#fff;'>
                                                         银行账号：
                                                     </td>
                                                     <td align="left"><b class="blue"><?php echo $funds['banknum'];?></b>

                                                     </td>
                                                 </tr>


                                             <?php }?>


                                         <?php
                                         }
                                         ?>







               <?php if($funds['status']==0  ){?>

         <tr>
                        <td align="right"  style='background-color:#fff;'>
   操作类型：
                        </td>

                        <td align="left">
                      <input type='radio' name='status' value='1' checked>同意充值  &nbsp;
                      <input type='radio' name='status' value='2'>拒绝充值
                       </td>
                    </tr>
                                             <tr>
                        <td align="right"  style='background-color:#fff;'>
                       备注：
                        </td>

                        <td align="left">
                         <textarea rows="2" cols="50" name='remark' style="height:30px;width: 220px"><?php echo $funds['Man_remark'];?></textarea>

                       </td>
                    </tr>

                             <tr>
                        <td align="right"  style='background-color:#fff;'>

                        </td>

                        <td align="left">
                    <input type="submit" value='确认处理' class='button'  >
                                                            &nbsp;&nbsp;
                    <input type="button" value='暂不处理' class='button' onclick='parent.pop.close();'>
                       </td>
                    </tr>



                  <?php }else{?>


                             <tr>
                        <td align="right"  style='background-color:#fff;'>

                        </td>

                        <td align="left">&nbsp;&nbsp;
                    <input type="button" value='返回' class='button' onclick='parent.pop.close(); '>

                       </td>
                    </tr>
                  <?php }?>
                </tbody></table>

</form>
</body></html>



    <script type="text/javascript">
        function copyToClipboard(id,txt) {

            var clip = new ZeroClipboard.Client();
            ZeroClipboard.setMoviePath("<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>2017/JS/ZeroClipboard.swf");
            clip.setHandCursor(true);
            clip.setText(txt);
            clip.addEventListener('complete', function () {
                alert("复制成功");
            });
            clip.glue(""+id+"");
        }
    </script>




