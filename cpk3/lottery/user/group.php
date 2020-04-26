<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from user_group  where id='{$id}'");
    add_adminlog("删除用户组");
    echo "删除用户组成功";
    echo "<script>location.href=location.href;</script>";
    exit();
}

if($_GET['type']=='set_content'){
if($_POST){
    $buymin='';
    $buymax=='';
foreach ($_POST['wanfa']['K3HZ'] as $value){
   if($buymin!='') $buymin.="|";
    if($buymax!='') $buymax.="|";
    $buymin.=$value['buymin'];
    $buymax.=$value['buymax'];
}
$_POST['wanfa']['K3HZ']=array('buymin'=>$buymin,'buymax'=>$buymax);

$content=serialize($_POST['wanfa']);
$db->query("update user_group set content='{$content}' where id='{$_GET['id']}'");

    echo "<script>window.location='?controller=user&action=group';</script>";
}

    $group=$db->exec("select * from user_group where id='{$_GET['id']}'");
    $content=unserialize($group['content']);
    $ssc_list=$db->fetch_all("select * from game_ssc_list where skey in (select ListKey from game_code_list where CodeKey in (select ckey from game_code where type='k3'))");

   ?>
    <form action="" method="post">



    <table class="list_tbl">
    <tr>


        <td colspan="3">
<?php
echo $group['title'].'投注限额设置';
?>
            最低投注为0则以玩法设置为准 ,   最高投注为0则不限制
        </td>
    </tr>
        <tr>
<th>

    玩法名称
</th>

            <th>

                最低投注
            </th>
            <th>

                最高投注
            </th>
        </tr>



    <?php
    foreach ($ssc_list as $value1){

        $item=$content[$value1['skey']];
        if($value1['skey']=='K3HZ'){

            $list2=explode('|',$value1['show_key']);

            $buymax=explode('|',$item['buymax']);
            $buymin=explode('|',$item['buymin']);

            foreach ($list2 as $key2=>$value2){


                ?>
                <tr bgcolor='#FFFFFF'>
                    <td  >
                        <?php echo $value2;?>
                    </td>
                    <td  >
                           <input type="text" name="wanfa[<?php echo $value1['skey'];?>][<?php echo $key2;?>][buymin]" value="<?php echo $buymin[$key2]?>" ></td>
                    <td  >
                        <input type="text" name="wanfa[<?php echo $value1['skey'];?>][<?php echo $key2;?>][buymax]" value="<?php echo $buymax[$key2]?>" ></td>

                </tr>



                <?php
            }



        }else {
     $temp=$db->exec("select * from game_code_list where ListKey='{$value1['skey']}'");



            ?>

            <tr bgcolor='#FFFFFF'>
                <td  >		<?php echo $temp['ShowTile'];?>
                </td>

                <td  >
                         <input type="text" name="wanfa[<?php echo $value1['skey'];?>][buymin]" value="<?php echo $item['buymin']?>" ></td>
                <td  >
                       <input type="text" name="wanfa[<?php echo $value1['skey'];?>][buymax]" value="<?php echo $item['buymax']?>" ></td>


            </tr>


        <?php }
    }
    ?>

        <tr>

            <td colspan="3"> <input type="submit" class="button" value="确认提交"></td>
        </tr>
    </table>



    <?php

    exit();
}


if($_GET['type']=='add' || $_GET['type']=='edit'){
    if($_POST){

if($_GET['type']=='add'){
    $sql="insert into user_group(title,touxian,score,prize,sys) values('{$_POST['title']}','{$_POST['touxian']}','{$_POST['score']}','{$_POST['prize']}','{$_POST['sys']}')";

    $db->query($sql);

    if($db->affected_rows()>0){
        add_adminlog("添加用户组【{$_POST['title']}】");
        echo "添加成功";
    }
    else{

        echo "添加分组失败";
    }

}

        if($_GET['type']=='edit'){

         $id=$_GET['id'];
               foreach ($_POST as $key=>$value){
                   if($key!='id'){

                       $db->query("update user_group set `{$key}`='{$value}' where id='{$id}'");
                   }

               }

                add_adminlog("编辑用户组【{$_POST['title']}】");
                echo "编辑成功";


        }





        echo "<script>parent.location.href=parent.location.href;setTimeout(\"parent.pop.close();\",1000)</script>";
        exit();
    }

if($_GET['id']){

        $result=$db->exec("select * from user_group  where id='{$_GET['id']}'");
}

?>
    <form action="?controller=user&action=group&type=<?php echo $_GET['type'];if($_GET['id']) echo "&id=".$_GET['id'];?>" method="post">

        <table class="table_add">
       <tr>
           <td><span class="red">*</span>用户组名称：</td>
           <td><input type="text" name="title" required value="<?php echo $result['title'];?>"></td>

       </tr>
            <tr>
                <td><span class="red">*</span>头衔：</td>
                <td><input type="text" name="touxian" required value="<?php echo $result['touxian'];?>"></td>

            </tr>


            <tr>
                <td><span class="red">*</span>晋级积分：</td>
                <td><input type="text" name="score" required value="<?php echo $result['score'];?>"><br>

                </td>

            </tr>
            <tr>
                <td><span class="red">*</span>晋级奖励：</td>
                <td><input type="text" name="prize" required value="<?php echo $result['prize'];?>"><br>

                </td>

            </tr>

            <tr>
                <td><span class="red">*</span>系统组：</td>
                <td>


                    <INPUT type="radio" value="1"  name="sys"   <?php if($result['sys']==1) echo "checked"; ?> > 是

                    <INPUT type="radio" value="0" name="sys" <?php if($result['sys']!=1) echo "checked"; ?>  > 否
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

<div class="search_box1">
    <input type="button" class="button" value="添加用户组" onclick="winPop({title:'添加用户组',form:'Form1',width:'600',height:'300',url:'?controller=user&action=group&type=add'});">
<input  type="button" class="button" value="同步更新到聊天室" onclick="if(confirm('确定要更新到聊天室吗? ')) location.href='<?php echo get_chaturl('apk/update.php').'&act=group_tongbu'?>';" >
</div>


<table class="list_tbl" width="100%" border="0" cellpadding="4" cellspacing="1">
     <tr>

         <th>
             ID
         </th>
         <th>
             组名称
         </th>
         <th>
             头衔
         </th>
         <th>
             晋级积分
         </th>
         <th>
             晋级奖励
         </th>
         <th>
             限额设置
         </th>
         <th>
             系统组
         </th>
         <th>
             操作
         </th>



     </tr>
    <?php

    $sql="select * from user_group order by score asc";

    $query=$db->query($sql);
   while ($row=$db->fetch_array($query)){


       ?>


       <tr>

           <td>
               <?php echo $row['id'];?>
           </td>
           <td>
               <?php echo $row['title'];?>
           </td>
           <td>
               <?php echo $row['touxian'];?>
           </td>
           <td>
               <?php echo $row['score'];?>
           </td>
           <td>
              <?php echo $row['prize'];?>元
           </td>
           <td>
               <a href="?controller=user&action=group&type=set_content&id=<?php echo $row['id'] ; ?>">
                   投注限额设置
               </a>
           </td>
           <td>
               <?php if($row['sys']==1) echo "是";else echo  "否";;?>
           </td>


           <td>
               <a onclick="winPop({title:'编辑用户组',form:'Form1',width:'600',height:'300',url:'?controller=user&action=group&type=edit&id=<?php echo $row['id'] ; ?>'});">编辑</a>

              <a onclick="if(confirm('确定要删除该分组吗? ')) location.href='?controller=user&action=group&type=delete&id=<?php echo $row['id'] ; ?>';">  删除</a>
           </td>



       </tr>

       <?php
   }

    ?>




</table>
	<?php

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>