<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from user_msg  where id='{$id}'");
    add_adminlog("删除站内消息");
    echo "删除成功";
    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}

if($_GET['active']=='read'){
    $id=$_GET['msgid'];
    $db->query("update user_msg set read1='1'  where id='{$id}'");

    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");


?>

    <div class="search_box1" style="line-height: 40px;">
        <form action="" method="get" id="form1">
            <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
            <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">
            <input type="hidden" name='type' value="<?php echo $_GET['type'];?>">


            <?php
            if($_GET['type']=='from'){
            ?>
                收件人UID：<input type="text" name="userid" value="<?php echo $_GET['userid']?>">

                收件人账号：<input type="text" name="toname" value="<?php echo $_GET['toname']?>">
            <?php
            }else{
                ?>
                发件人UID：<input type="text" name="perid" value="<?php echo $_GET['perid']?>">

                发件人账号：<input type="text" name="fromname" value="<?php echo $_GET['fromname']?>">
            <?php
            }
            ?>


           时间:<input type="text" name="begintime"  value="<?php echo $_GET['begintime'];?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
            &nbsp;至

            <input type="text" name="endtime"  value="<?php echo $_GET['endtime'];?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

            <input type="submit" class="button" value="搜索">


            <a class="button" onclick="winPop({title:'发送消息',width:'700',drag:'true',height:'300',url:'index.aspx?controller=user&action=msg_send'})">发送消息</a>

            <a class="button" onclick="winPop({title:'群发消息',width:'700',drag:'true',height:'270',url:'index.aspx?controller=user&action=msg_sendall'})">群发消息</a>
        </form>


    </div>


    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="list_tbl">
        <tr>

            <th>
                UID
            </th>
            <?php

            if($_GET['type']=='from'){
                ?>
                <th>
                    收件人账号
                </th>

            <?php
            }else{
                ?>
                <th>
                发件人账号
                </th>
                <?php
            }
            ?>

            <th  >
                标题
            </th>



                <th >
                    内容
                </th>

                <th>
                    状态
                </th>

            <th  >
                时间
            </th>


            <th >
                操作
            </th>



        </tr>
        <?php

        $sql="select * from user_msg where 1=1";

     if($_GET['type']=='from') $sql.=" and perid='0' ";
     else $sql.=" and userid='0' ";
        if($_GET['fromname'])  $sql.=" and perid in (select userid from user where username='{$_GET['fromname']}')";
        if($_GET['toname'])  $sql.=" and userid in (select userid from user where username='{$_GET['toname']}')";
if($_GET['perid']){
    $sql.=" and perid='{$_GET['perid']}'";
}
        if($_GET['userid']){
            $sql.=" and userid='{$_GET['userid']}'";
        }

        if($_GET['begintime']) {
            $time=$_GET['begintime'].' 00:00:00';
            $sql.=" and creatdate>='{$time}' ";
        }
        if($_GET['endtime']) {
            $time=$_GET['endtime'].' 23:59:59';
            $sql.=" and creatdate<='{$time}' ";
        }


        $sql.=" order by id desc";
        $page=new Page($sql,20,$_GET['page']);
        $sql.=" limit {$page->from},20";
        $list=$db->fetch_all($sql);
        if (count($list)>0){
        $sum=0;
        foreach ($list as $row) {

            if($_GET['type']=='from')

                $user = get_user_info($row['userid']);
                else
            $user = get_user_info($row['perid']);

            ?>


            <tr >

                <td>
                    <?php echo $user['userid']; ?>
                </td>
                <td>
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <?php echo $row['title']; ?>
                </td>

  <td style="max-width: 500px;word-wrap:break-word;word-break:break-all;">
                        <?php
                        echo $row['content'];
                        ?>
                    </td>

                 <td>
                     <?php
                     if($_GET['type']=='from'){

 $row['read']='已读';

                     }
                     else{
                         if($row['read1']==0) $row['read']='<font color="#ff0000">未读</font>';
                         else $row['read']='已读';
                     }
                 echo $row['read'];
                     ?>


                 </td>



                <td>
                    <?php

                    echo  $row['creatdate'];
                    ?>
                </td>

                <td>
                    <?php
                    if($row['perid']>0){
                        ?>

                        <a class="button" onclick="winPop({title:'发送消息',width:'700',drag:'true',height:'300',url:'index.aspx?controller=user&action=msg_send&msgid=<?php echo $row['id'] ?>'})">回复</a>
                        <?php
                        if($row['read']!='已读'){
                            ?>
                            <a class="button" style="color: #fff;" href="index.aspx?controller=user&action=msg&active=read&msgid=<?php echo $row['id'] ?>" >已阅</a>
                            <?php
                        }
                        ?>


                    <?php
                    }

                    ?>

                    <a onclick="if(confirm('确定要删除该邀请吗? ')) location.href='?controller=user&action=msg&type=delete&id=<?php echo $row['id']; ?>';" class="button">删除</a>
                </td>


            </tr>

            <?php
        }

        ?>

    </table>

    <div class="page">


        <?php
        echo $page->get_page();
        ?>
    </div>

    <?php
}else{

    ?>

    </table>

    <div class="page">

        没有找到对应的数据
    </div>


    <?php


}
?>
    <script>

<?php

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>