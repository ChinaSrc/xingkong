<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from user_url  where id='{$id}'");
    add_adminlog("删除邀请码");
    echo "删除成功";
    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}

if($_GET['active']=='update'){

    $id=$_GET['id'];
    $db->query("update user_url set `{$_GET['col']}`='{$_GET['value']}' where id='{$id}'");


    add_adminlog("修改邀请码");

    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}


include(ROOT_PATH."/".$AdminPath."/body_line_top.php");


?>

    <div class="search_box1">
<form action="" method="get" id="form1">
    <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
    <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">


账户类型：<select name="istry"  onchange="document.getElementById('form1').submit();">
        <option value="0" <?php if ($_GET['istry']!=1) echo "selected";?>>正式账户</option>
        <option value="1" <?php if ($_GET['istry']==1) echo "selected";?>>试用账户</option>
    </select>

    用户类型：<select name="type"  onchange="document.getElementById('form1').submit();">
        <option value="">不限</option>
        <option value="0" <?php if ($_GET['type']==0 and strlen($_GET['type'])==1) echo "selected";?>>代理</option>
        <option value="1" <?php if ($_GET['type']==1) echo "selected";?>>玩家</option>
    </select>
    账号：<input type="text" name="username" value="<?php echo $_GET['username']?>">

    <input type="submit" class="button" value="搜索">
</form>


    </div>


    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="list_tbl">
        <tr>

            <th>
                账号
            </th>
            <th>
                邀请码
            </th>
            <th>
                用户类型
            </th>
            <th>
                账户类型
            </th>

            <?php
            if($_GET['istry']==1){
                ?>

                <th>
                    试玩金额
                </th>
            <?php
            }
            ?>
            <th>
                备注
            </th>
            <th>
                状态
            </th>

            <th>
                创建时间
            </th>


            <th>
                操作
            </th>



        </tr>
        <?php

        $sql="select * from user_url ";
        if(!$_GET['istry']) $istry=0;else $istry=$_GET['istry'];
        $sql.=" where istry='{$istry}'";
        if(strlen($_GET['type']))      $sql.=" and type='{$_GET['type']}'";
        if($_GET['username'])  $sql.=" and userid in (select userid from user where username='{$_GET['username']}')";


        $sql.=" order by id desc";
          $page=new Page($sql,20,$_GET['page']);
          $sql.=" limit {$page->from},20";
        $query=$db->query($sql);
        while ($row=$db->fetch_array($query)){

                 $user=get_user_info($row['userid']);
            ?>


            <tr>

                <td>
                    <?php echo $user['username'];?>
                </td>
                <td>
                    <?php echo $row['url'];?>
                </td>
                <td>
                    <a  class="btn<?php echo $row['type']?>" onclick="set_type(<?php echo $row['id']?>,<?php echo $row['type']?>);">
                    <?php if($row['type']==1) echo '玩家';else  echo '代理';?>
                    </a>
                </td>
                <td>
                   <a  class="btn<?php echo $row['istry']?>" onclick="set_istry(<?php echo $row['id']?>,<?php echo $row['istry']?>);">
                       <?php if($row['istry']==1) echo '试用账户';else  echo '正式账户';?>

                   </a>
                </td>
                <?php
                if($_GET['istry']==1){
                    ?>

                    <td>
                        <a style="color:#3388ff;text-decoration: underline" onclick="winPop({title:'邀请码（<?php echo $row['url'];?>）试玩金额',form:'Form1',width:'380',height:'180',url:'/do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url_money&id=<?php echo $row['id'] ; ?>&admin=1'});">

                            <?php echo $row['money'];?>元

                        </a>
                    </td>
                    <?php
                }
                ?>
                <td>
                    <a onclick="winPop({title:'邀请码（<?php echo $row['url'];?>）备注',form:'Form1',width:'380',height:'180',url:'/do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url_mark&id=<?php echo $row['id'] ; ?>&admin=1'});">

                        <?php if($row['mark']) echo $row['mark'];else  echo '-';?>

                    </a>

                </td>
                <td>
                   注册（<?php echo $row['num']; ?>）
                </td>

                <td>
                    <?php

                    echo date('Y-m-d H:i:s',$row['time']);
                    ?>
                </td>

                <td>

                    <a onclick="winPop({title:'邀请码（<?php echo $row['url'];?>）详情',form:'Form1',width:'500',height:'350',url:'/do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url&id=<?php echo $row['id'] ; ?>'});">详情</a>

                    <a onclick="if(confirm('确定要删除该邀请吗? ')) location.href='?controller=user&action=url&type=delete&id=<?php echo $row['id'] ; ?>';">  删除</a>
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


<script>

    function set_istry(id,num) {
        if(num==0) {
            var name="试用";
            var value=1;

        }
        else{
            var name='正式';
            var value=0;

        }

        if(confirm('确定要设为'+name+'账户吗? ')==true){

            location.href="?controller=user&action=url&active=update&id="+id+"&col=istry&value="+value;


        }
    }



    function set_type(id,num) {
        if(num==0) {
            var name="玩家";
            var value=1;

        }
        else{
            var name='代理';
            var value=0;

        }

        if(confirm('确定要设为'+name+'吗? ')==true){

            location.href="?controller=user&action=url&active=update&id="+id+"&col=type&value="+value;


        }
    }

</script>
<?php

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>