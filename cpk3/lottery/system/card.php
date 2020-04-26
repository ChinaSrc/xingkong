<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from card  where id='{$id}'");
    add_adminlog("删除充值卡");
    echo "删除充值卡成功";
    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}

function set_card_num($num){
    $str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890zxcvbnmasdfghjklqwertyuiop";

   $return='';
    for($i=0;$i<$num;$i++){
       $rand=rand(0,strlen($str)-1);
       $return.=substr($str,$rand,1);

    }


    return $return;
}




if($_GET['type']=='add'){
    if($_POST){

        if($_GET['type']=='add'){
         $len=0;
            for($i=0;$i<$_POST['num'];$i++){
               $number=set_card_num(32);
               $pwd=set_card_num(32);
               $begin=strtotime($_POST['begin'].':00');
               $end=strtotime($_POST['end'].':59');

                $sql="insert into card(`number`,pwd,money,`begin`,`end`,status) values('{$number}','{$pwd}','{$_POST['money']}','{$begin}','{$end}','0')";
                $db->query($sql);
                if($db->affected_rows()>0) $len++;
            }



                add_adminlog("成功生成{$len}张充值卡");
                echo "已成功生成{$len}张充值卡";


        }





        echo "<script>parent.location.href=parent.location.href;setTimeout(\"parent.pop.close();\",1000)</script>";
        exit();
    }

    if($_GET['id']){

        $result=$db->exec("select * from user_group  where id='{$_GET['id']}'");
    }

    ?>
    <form action="?controller=system&action=card&type=<?php echo $_GET['type'];if($_GET['id']) echo "&id=".$_GET['id'];?>" method="post">

        <table class="table_add">
            <tr>
                <td><span class="red">*</span>金额：</td>
                <td><input type="number" name="money" required min="1" max="10000000">元</td>

            </tr>
            <tr>
                <td><span class="red">*</span>数量：</td>
                <td><input type="number" name="num" required min="1" max="100"></td>

            </tr>

            <tr>
                <td><span class="red">*</span>有效期：</td>
                <td>

                    <input name="begin" class="Wdate" type="text" id="begin" value="<?php echo date('Y-m-d H:i')?>" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',alwaysUseStartDate:false})" required style="width:150px;" />
                    至 <input name="end" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',alwaysUseStartDate:false})" id="end" value="<?php echo date('Y-m-d H:i',time()+30*24*3600)?>" required  style="width:150px;"/>

                </td>

            </tr>

            <tr>
                <td></td>
                <td><input type="submit" class="button" value="提交"></td>

            </tr>





        </table>

    </form>






    <?php

    exit();
}

$status_arr=array('未使用','已使用','已过期');

if($_GET['type']=='edit'){
    $id=$_GET['id'];
if($_POST){
    $_POST['begin']=strtotime($_POST['begin'].':00');
    $_POST['end']=strtotime($_POST['end'].':59');
    foreach ($_POST as $key=>$value){
        if($key!='id'){

            $db->query("update card set `{$key}`='{$value}' where id='{$id}'");
        }

    }

    add_adminlog("编辑充值卡");
    echo "编辑成功";
    echo "<script>parent.location.href=parent.location.href;setTimeout(\"parent.pop.close();\",1000)</script>";
    exit();

}

$card=$db->exec("select * from card where id='{$_GET['id']}'");
?>

    <form action="?controller=system&action=card&type=<?php echo $_GET['type'];if($_GET['id']) echo "&id=".$_GET['id'];?>" method="post">

        <table class="table_add">
            <tr>
                <td><span class="red">*</span>卡号：</td>
                <td><input type="text" name="number" value="<?php echo $card['number'];?>" required ></td>

            </tr>
            <tr>
                <td><span class="red">*</span>数量：</td>
                <td><input type="text" name="pwd" value="<?php echo $card['pwd'];?>" required ></td>

            </tr>

            <tr>
                <td><span class="red">*</span>有效期：</td>
                <td>

                    <input name="begin" class="Wdate" type="text" id="begin" value="<?php echo date('Y-m-d H:i',$card['begin'])?>" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',alwaysUseStartDate:false})" required style="width:150px;" />
                    至 <input name="end" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',alwaysUseStartDate:false})" id="end" value="<?php echo date('Y-m-d H:i',$card['end'])?>" required  style="width:150px;"/>

                </td>

            </tr>

            <tr>
                <td><span class="red">*</span>状态：</td>
                <td>
                    <select name="status"  >
                        <?php
                        foreach ($status_arr as $key=>$value){
                            ?>
                            <option value="<?php echo $key; ?>" <?php if( $card['status']==$key) echo "selected"; ?>><?php echo $value;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>

            </tr>

            <tr>
                <td></td>
                <td><input type="submit" class="button" value="提交"></td>

            </tr>





        </table>

    </form>



<?php

exit();

}




include(ROOT_PATH."/".$AdminPath."/body_line_top.php");









?>


    <form action="" method="get" name="frm_search" id="frm_search" >

        <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
        <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">

        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
            <tr>
                <td align='left' style="padding-left: 10px;">
                    账号：

                    <input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<?php echo $_GET['username']?>" size="20" />


                    类型：
                    <select name="status" onchange="document.getElementById('frm_search').submit();" >
                        <option value=""  >全部</option>
                        <?php
                        foreach ($status_arr as $key=>$value){
                            ?>
                            <option value="<?php echo $key; ?>" <?php if(strlen($_GET['status'])==1 and $_GET['status']==$key) echo "selected"; ?>><?php echo $value;?></option>
                            <?php
                        }
                        ?>
                    </select>



                    &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />


                    <input type="button" class="button" value="添加充值卡"
                           onclick="winPop({title:'添加充值卡',form:'Form1',width:'600',height:'300',url:'?controller=system&action=card&type=add'});">
                </td>
            </tr>
        </table>

    </form>
    <div class="search_box1">


    </div>


    <table class="list_tbl" width="100%" border="0" cellpadding="4" cellspacing="1">
        <tr>

            <th>
                ID
            </th>
            <th>
               卡号
            </th>
            <th>
                卡密
            </th>
            <th>
                金额
            </th>
            <th>
                有效期
            </th>
            <th>
                状态
            </th>
            <th>
                使用者
            </th>

            <th>
                使用时间
            </th>
            <th>
                操作
            </th>



        </tr>
        <?php

        $sql="select * from card where 1=1";
        if(strlen($_GET['status'])==1) $sql.=" and status='{$_GET['status']}'";
        if($_GET['username']){
            $sql.=" and userid in (select userid from user where username='{$_GET['username']}')";
        }
        $sql.=" order by id desc";
        $page=new Page($sql,20,$_GET['page']);
        $sql.=" limit {$page->from},20";
        $query=$db->query($sql);
        while ($row=$db->fetch_array($query)){

              if($row['end']<=time()) $db->query("update card set status='2' where id='{$row['id']}'");
            ?>


            <tr>

                <td>
                    <?php echo $row['id'];?>
                </td>
                <td>
                    <?php echo $row['number'];?>
                </td>
                <td>
                    <?php echo $row['pwd'];?>
                </td>
                <td>
                    <?php echo $row['money'];?>
                </td>
                <td>
                    <?php echo date('Y-m-d H:i',$row['begin']);?> 至
                    <?php echo date('Y-m-d H:i',$row['end']);?>
                </td>
                <td>
                    <?php echo $status_arr[$row['status']];?>
                </td>


                <td>
                    <?php

                    if($row['userid']) {
                        $user=get_user_info($row['userid']);
                        echo $user['username'];

                    }
                    else{
                        echo '-';
                    }
                    ?>
                </td>

                <td>
                    <?php

                    if($row['usetime']) {
                    echo date('Y-m-d H:i:s',$row['usetime']);

                    }
                    else{
                        echo '-';
                    }
                    ?>
                </td>

                <td>
                    <a onclick="winPop({title:'编辑充值卡',form:'Form1',width:'600',height:'300',url:'?controller=system&action=card&type=edit&id=<?php echo $row['id'] ; ?>'});">编辑</a>

                    <a onclick="if(confirm('确定要删除该分组吗? ')) location.href='?controller=system&action=card&type=delete&id=<?php echo $row['id'] ; ?>';">  删除</a>
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

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>