
<?php

if($_POST){


            $userid=$user['userid'];
            $title=$_POST['title'];
            $contnet=$_POST['content'];

            $sql="select * from user where admin=0 ";
            if($_POST['type']!='all') $sql.=" and isproxy='{$_POST['type']}'";
            $sql.=" order by userid asc";;
          $list=  $db->fetch_all($sql);
          if(count($list)>0){


              foreach ($list as $value){
                     send_msg($value['userid'],$title,$contnet);

            }


          }

            $tip= "群发成功";
            $return=true;

            add_adminlog("群发站内信");




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


?>



<form method="POST" action=""  name="form" id="form">
    <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
    <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">

    <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_1' class="table_add" >
        <TR align=left>
            <td width="120px" ><div style=text-align:right;margin-right:5px;>选择发送：</div></td>
            <td >

                <input type="radio" name="type" value="all" checked>所有
                &nbsp;


                <input type="radio" name="type" value="0" >代理
                <input type="radio" name="type" value="1" >玩家
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
