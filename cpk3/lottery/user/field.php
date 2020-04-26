<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from user_group  where id='{$id}'");
    add_adminlog("删除用户组");
    echo "删除用户组成功";
    echo "<script>location.href=location.href;</script>";
    exit();
}




if($_GET['type']=='add' || $_GET['type']=='edit'){
    if($_POST){

        if($_GET['type']=='add'){
            $sql="insert into field(title,reg,must,search,sortnum,`show`) values('{$_POST['title']}','{$_POST['reg']}','{$_POST['must']}','{$_POST['search']}','{$_POST['sortnum']}','{$_POST['show']}')";

            $db->query($sql);

            if($db->affected_rows()>0){
                add_adminlog("添加字段【{$_POST['title']}】");
                echo "添加成功";
            }
            else{

                echo "添加失败";
            }

        }

        if($_GET['type']=='edit'){

            $id=$_GET['id'];
            foreach ($_POST as $key=>$value){
                if($key!='id'){

                    $db->query("update field set `{$key}`='{$value}' where id='{$id}'");
                }

            }

            add_adminlog("编辑字段【{$_POST['title']}】");
            echo "编辑成功";


        }





        echo "<script>parent.location.href=parent.location.href;setTimeout(\"parent.pop.close();\",1000)</script>";
        exit();
    }

    if($_GET['id']){

        $result=$db->exec("select * from field  where id='{$_GET['id']}'");
    }

    ?>
    <form action="?controller=user&action=field&type=<?php echo $_GET['type'];if($_GET['id']) echo "&id=".$_GET['id'];?>" method="post">

        <table class="table_add">
            <tr>
                <td><span class="red">*</span>字段名称：</td>
                <td><input type="text" name="title" required value="<?php echo $result['title'];?>"></td>

            </tr>
            <tr>
                <td><span class="red">*</span>注册显示：</td>
                <td>


                    <INPUT type="radio" value="1"  name="reg"   <?php if($result['reg']==1) echo "checked"; ?> > 是

                    <INPUT type="radio" value="0" name="reg" <?php if($result['reg']!=1) echo "checked"; ?>  > 否
                </td>

            </tr>
            <tr>
                <td><span class="red">*</span>注册必填：</td>
                <td>


                    <INPUT type="radio" value="1"  name="must"   <?php if($result['must']==1) echo "checked"; ?> > 是

                    <INPUT type="radio" value="0" name="must" <?php if($result['must']!=1) echo "checked"; ?>  > 否
                </td>

            </tr>

            <tr>
                <td><span class="red">*</span>搜索：</td>
                <td>


                    <INPUT type="radio" value="1"  name="search"   <?php if($result['search']==1) echo "checked"; ?> > 是

                    <INPUT type="radio" value="0" name="search" <?php if($result['search']!=1) echo "checked"; ?>  > 否
                </td>

            </tr>

            <tr>
                <td><span class="red">*</span>显示：</td>
                <td>


                    <INPUT type="radio" value="1"  name="show"   <?php if($result['show']==1) echo "checked"; ?> > 是

                    <INPUT type="radio" value="0" name="show" <?php if($result['show']!=1) echo "checked"; ?>  > 否
                </td>

            </tr>

            <tr>
                <td><span class="red">*</span>排序：</td>
                <td><input type="text" name="sortnum" required value="<?php echo $result['sortnum'];?>"></td>

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

if($_POST['field'] and $_GET['act']=='update'){

foreach ($_POST['field'] as $id=>$value){
    $db->query("update field set `reg`='0',`must`='0',`show`='0' ,`search`='0'  where id='{$id}'");
    foreach ($value as $k=>$v){
        $db->query("update field set `{$k}`='{$v}' where id='{$id}'");

    }

}

add_adminlog("更新用户字段");
}
?>
<form action="?controller=user&action=field&act=update&type=<?php echo $_GET['type'];?>" method="post">
    <div class="search_box1">
        <input type="submit" class="button" value="确认更新">

        <input type="button" class="button" value="添加新字段"  style="display: none" onclick="winPop({title:'添加新字段',form:'Form1',width:'600',height:'320',url:'?controller=user&action=field&type=add'});">
    </div>


    <table class="list_tbl" width="100%" border="0" cellpadding="4" cellspacing="1">
        <tr>

            <th>
                排序
            </th>
            <th>
                字段名称
            </th>
            <th>
                注册显示
            </th>
            <th>
                注册必填
            </th>
            <th>
                搜索
            </th>
            <th>
                显示
            </th>



        </tr>
        <?php

        $sql="select * from field order by sortnum asc";

        $query=$db->query($sql);
        while ($row=$db->fetch_array($query)){


            ?>


            <tr>

                <td>
                    <input name="field[<?php echo $row['id'];?>][sortnum]" value="<?php echo $row['sortnum'];?>" style="width: 100px">

                </td>
                <td>
                    <?php echo $row['title'];?>
                </td>
                <td>
                 <input type="checkbox"  name="field[<?php echo $row['id'];?>][reg]" value="1" <?php if($row['reg']==1) echo "checked"; ?>>
                </td>
                <td>
                    <input type="checkbox"  name="field[<?php echo $row['id'];?>][must]" value="1" <?php if($row['must']==1) echo "checked"; ?>>
                </td>
                <td>
                    <input type="checkbox"  name="field[<?php echo $row['id'];?>][search]" value="1" <?php if($row['search']==1) echo "checked"; ?>>
                </td>
                <td>
                    <input type="checkbox"  name="field[<?php echo $row['id'];?>][show]" value="1" <?php if($row['show']==1) echo "checked"; ?>>
                </td>


            </tr>

            <?php
        }

        ?>




    </table>
<?php

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>