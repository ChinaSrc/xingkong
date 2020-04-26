<?php


if($_GET['type1']=='update_sort'){

	if(count($_POST['sort'])>0){
		foreach ($_POST['sort'] as $key=>$value) {
			
			$db->query("update game_type set `sort`='{$value}' where id='{$key}'");
			
			
		}
	}
	$db->query("update game_type set `show_index`='0',icon1='0' ");

    foreach ($_POST['show_index'] as $key=>$value) {

        $db->query("update game_type set `show_index`='1' where id='{$key}'");


    }

    foreach ($_POST['icon1'] as $key=>$value) {

        $db->query("update game_type set `icon1`='1' where id='{$key}'");


    }
	echo "<script>alert('更新成功');</script>";
//	echo "排序已更新成功.......";
	echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	exit();
	
}

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;


?>
 <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#fff">
	    <tr>
	       <td  bgcolor="#FFFFFF" align=left style="text-align: left">

          
 
    <form action="" method="GET" style="line-height:50px;height:50px;"  id='form22'> 
          <input name="controller" id="controller" type="text" value="game" style='display:none'> 
          <input name="action" id="action" type="text" value="game" style='display:none'> 

&nbsp;    类型:<select name='type'  id='playkey'  onchange="	document.getElementById('form22').submit();";>
<option value=''>不限</option>
    <?php foreach ($arr_game_code as $key=>$value) {
    	?>
    	
    	<option  value='<?php echo $key;?>' <?php if($key==$_GET['type']) echo "selected";?>><?php echo $value;?></option>
    	<?php 
    }?>
    </select>
 &nbsp; &nbsp; 

<?php 
echo '<input type="button" class=\'button\' onclick="winPop({title:\'添加新游戏\',width:\'700\',drag:\'true\',height:\'450\',url:\'';echo ROOT_URL."/".$AdminPath;;echo '/?controller=game&action=game_add&active=new\'})" value=\'添加新游戏\'>';
?>
   &nbsp; &nbsp;
<input type="button" class='button' value='确认更新'  onclick="document.getElementById('myform').submit();">
</form>
         
       </tr>
       </table>


     <form name="myform" id="myform" method="post" action="index.aspx?controller=<?php echo $_GET['controller'];?>&action=<?php echo $_GET['action'];?>&type1=update_sort" >  
<table> <tr>
          <th width="100px" align="center" bgcolor="#FFFFFF">排序</th>
            <th  align="center" bgcolor="#FFFFFF">图标</th> 
          <th  align="center" bgcolor="#FFFFFF">彩票名称</th>
        <th  align="center" bgcolor="#FFFFFF">推荐</th>
        <th  align="center" bgcolor="#FFFFFF">首页</th>
        <th  align="center" bgcolor="#FFFFFF">彩票简称</th>
                <th align="center" bgcolor="#FFFFFF">彩票类型</th>  
          <th align="center" bgcolor="#FFFFFF">状态</th>
                <th align="center" bgcolor="#FFFFFF">自营</th>
        <th align="center" bgcolor="#FFFFFF">每天期数</th>
          <th align="center" bgcolor="#FFFFFF">操作</th>
         
       </tr>



       
	 

       <?php

if($_GET['type'])
$str=" where skey='{$_GET['type']}'";
else $str='';
$sql_id="select * from game_type {$str} order by status asc ,`sort` asc ,id asc";
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
$inid=$rows3[id];
?>
<tr height='25' align='center' style="background-color:#fff;" >
<td><input name='sort[<?php echo $inid;?>]' type='text' value='<?php echo $rows3['sort'];?>' style='width:80px;'/> </td>
<td>
<?php if($rows3['ico']) echo "<img src='../{$rows3['ico']}' height='35px' />";else echo "-"; ?>

</td>
<td><?php echo $rows3[fullname];?>

</td>

    <td>
        <input type="checkbox" name="icon1[<?php echo $rows3['id'];?>]" <?php if($rows3['icon1']==1) echo "checked";?>>

    </td>
    <td>
        <input type="checkbox" name="show_index[<?php echo $rows3['id'];?>]" <?php if($rows3['show_index']==1) echo "checked";?>>

    </td>

<td><?php echo $rows3[ckey];?></td>
<td><?php echo $arr_game_code[$rows3['skey']];?></td>

<td><?php  if($rows3[status]=="0"){if($rows3['show_nav2']==1) $status='维护中';else if($rows3['show_nav2']==2) $status='停售中';else $status="启用";}else{$status="关闭";} echo $status;?></td>

<td><?php if($rows3['self']==1) {echo "自营/";   if($rows3['give_pre']==1) echo "必赢";else echo "随机";}else echo '-';?></td>

    <td>
        <?php
        $temp=$db->exec("select count(*) as num from game_time where playKey='{$rows3['ckey']}' ");
        ?>
        <a href="?controller=lottery&action=GameTime&playkey=<?php echo $rows3['ckey'];?>"><?php echo $temp['num'];?></a>

    </td>
  <td> 
<a class='mouse_show link_01' onclick="winPop({title:'修改<?php echo $rows3[fullname];?>',width:'700',drag:'true',height:'550',url:'?controller=game&action=game_add&id=<?php echo $rows3[id];?>'})">修改</a>

&nbsp; <a class='mouse_show link_01'  onclick="location.href='?controller=lottery&action=GameTime&playkey=<?php echo $rows3['ckey'];?>'">开奖时间</a>
&nbsp; <a class='mouse_show link_01'  onclick="winPop({title:'设置<?php echo $rows3[fullname];?>玩法',width:'800',drag:'true',height:'550',url:'?controller=game&action=wanfa&id=<?php echo $rows3[id];?>'})">玩法</a>
      &nbsp; <a class='mouse_show link_01' onclick="winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'?action=dele_post&flag=yes&dbname=game_type&id=<?php echo $rows3[id];?>'})">删除</a>


  </td>

<?php 
}
?>

  </table>
      

	  </form>
<?php
include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>