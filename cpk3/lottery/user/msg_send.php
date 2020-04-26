
<?php

if($_POST){

    if($_POST['username']){
        $user= $db->exec("select * from user where admin='0' and `{$_POST['type']}`='{$_POST['username']}'");
        if($user){
            $userid=$user['userid'];
            $title=$_POST['title'];
            $contnet=$_POST['content'];

            $tip= "发送成功";
            $return=true;
  send_msg($userid,$title,$contnet,0,$_POST['replyid']);
  add_adminlog("向【{$user['username']}】发送站内信");

        }
        else{
            $tip= "您输入的用户名或者UID不存在";
            $return=false;

        }


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

if($_GET['msgid']){
$msg=$db->exec("select * from user_msg where id='{$_GET['msgid']}'");
  $user=get_user_info($msg['perid']);
    $username=$user['username'];
    if($msg['replyid']>0) $replyid=$msg['replyid'];else $replyid=$msg['id'];

    $db->query("update user_msg set read1='1' where id='{$msg['id']}'");
}
else $username='';


?>



<form method="POST" action=""  name="form" id="form">
    <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
    <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">
    <?php
    if($replyid>0){?>
        <input type="hidden" name='replyid' value="<?php echo $replyid;?>">
        <?php
    }
    else{
        ?>
        <input type="hidden" name='replyid' value="0">
    <?php
    }
    ?>
    <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_1' class="table_add" >
        <TR align=left>
            <td width="120px" ><div style=text-align:right;margin-right:5px;>选择发送：</div></td>
            <td >

                <input type="radio" name="type" value="username" checked>用户名
                &nbsp;


                <input type="radio" name="type" value="username" > USERID
            </td>
        </tr>
        <TR align=left>
            <td ><div style=text-align:right;margin-right:5px;>用户名或UID：</div></td>
            <td >

                <input name="username" id="username" type="text" size="30" value="<?php echo $username;?>"   style="width: 200px"  required >

            </td>
        </tr>
        <TR align=left>
            <td ><div style=text-align:right;margin-right:5px;>标题：</div></td>
            <td >

               <input type="text" name="title" id="title" value="<?php if($msg['title']) {if(!strpos($msg['title'],'回复'))echo '[回复]';echo $msg['title'];}?>" required>

            </td>
        </tr>
        <TR align=left>
            <td  ><div style=text-align:right;margin-right:5px;>内容：</div></td>
            <td style="padding: 5px">

               <textarea name="content" id="content" style="width: 98%;height:70px;" required></textarea>
            </td>
        </tr>


    </table>

    <table  width="100%" border="0" cellpadding="4" cellspacing="1"  style='clear:both;' class="table_add" >
        <tr  align=left>
            <td colspan=2 >
                <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:20%; >
                    <input type="submit" class=button value="确认发送" type="submit"  id=submit name="submit">
                    &nbsp;&nbsp;
                    <input type="button" value='关闭' class='button' onclick='parent.pop.close(); '>
                </div>
            </td>
        </tr>

    </table>

</form>
