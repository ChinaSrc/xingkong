<?php
$result=$db->exec("select * from game_ssc_list where id='{$_GET['id']}'");
if($_POST){
    $key=$_GET['type'];
    $value=$_POST[$key];
    $db->query("update game_ssc_list set `{$key}`='{$value}' where id='{$_GET['id']}'");

    echo "<script>  parent.add_tips('修改成功',1);parent.pop.close();</script>";

    exit();
}


?>
<form action="?controller=game&action=ssc_list_update&type=<?php echo $_GET['type']?>&id=<?php echo $_GET['id'];?>" method="post">
    <textarea style="width: 100%;margin-top: 10px;height:190px;" name="<?php echo $_GET['type']?>"><?php echo $result[$_GET['type']]?></textarea>

    <br>

    <div style="padding-top: 10px;text-align: center">

        <input type="submit" value="确认" class="button" >
        &nbsp;
        &nbsp;
        <a onclick="parent.pop.close();" style="color: #3388ff;">取消</a>
    </div>



</form>



