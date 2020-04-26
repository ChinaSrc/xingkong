
<?php

if($_POST){

    if($_POST['userid']){
        $user= $db->exec("select * from user where admin='0' and `userid`='{$_POST['userid']}'");
        if($user){
            $userid=$user['userid'];
            $money=$_POST['money'];

            $sql = "update user_bank set low_amount=low_amount+$money where userid='$userid'";
                $mark="调整洗码额度";
                $db->query($sql);
                if( $db->affected_rows()>0){

                    getsql::banklog (0,'xima', $userid, $mark,'','','','',$money);

                }
                add_adminlog("调整【{$user['username']}】洗码额度:{$money}元");
            }

            $tip= "充值成功";
            $return=true;


    }
    else{

        $tip= "您还没有输入用户名或者UID";
        $return=false;
    }


    echo "<div style='padding-top: 20px;text-align: center'>{$tip}</div>";


    ?>
    <script>

        setTimeout(function () {
            <?php
            if($return==true){
            ?>
            parent.location.reload();
            parent.pop.close();
            <?php

            }
            else{
            ?>
            window.history.go(-1);

            <?php

            }
            ?>
        },1500)

    </script>

    <?php



    exit();
}

if($_GET['id']){

  $amount=get_user_amount($_GET['id']);
  $user=get_user_info($_GET['id']);
}



?>



<form method="POST" action=""  name="form" id="form">
    <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
    <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">
    <input type="hidden" name='userid' value="<?php echo $_GET['id'];?>">
    <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_1' class="table_add" >

        <TR align=left>
            <td ><div style=text-align:right;margin-right:5px;>用户名：</div></td>
            <td >

                <?php echo $user['username'];?>

            </td>
        </tr>
        <TR align=left>
            <td ><div style=text-align:right;margin-right:5px;>洗码：</div></td>
            <td >

                <?php echo $amount['low_amount'];?>

            </td>
        </tr>
        <TR align=left>
            <td ><div style=text-align:right;margin-right:5px;>充值金额：</div></td>
            <td >

                <input name="money" id="money" type="text" size="30" value=""  style="width: 120px"  required>元


                <span style="padding-left: 10px;color: #ff0000;font-size: 12px;">正数为加，负数为减</span>

            </td>
        </tr>


    </table>

    <table  width="100%" border="0" cellpadding="4" cellspacing="1"  style='clear:both;' class="table_add" >
        <tr  align=left>
            <td colspan=2 >
                <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:20%; >
                    <input type="submit" class=button value="保存" type="submit"  id=submit name="submit" >
                    &nbsp;&nbsp;
                    <input type="button" value='关闭' class='button' onclick='parent.pop.close(); '>
                </div>
            </td>
        </tr>

    </table>

</form>
