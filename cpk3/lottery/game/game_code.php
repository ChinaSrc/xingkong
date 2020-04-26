<?php

if($_POST){
	
	
foreach ($_POST['sort'] as $key=> $value) {
//	echo "update game_code set sortnum='{$value}' where id='{$key}' <br>";
	mysql_query("update game_code set sortnum='{$value}' where id='{$key}' ");
	
}
	//exit();
}



 ?>
 
 
    <form action="" method="GET" style="line-height:50px;height:50px;"  id='form22'> 
          <input name="controller" id="controller" type="text" value="game" style='display:none'> 
          <input name="action" id="action" type="text" value="game_code" style='display:none'> 

&nbsp;   玩法类型:<select name='type'  id='playkey'  onchange="	document.getElementById('form22').submit();"";>

    <?php foreach ($arr_game_code as $key=>$value) {
    	?>
    	
    	<option  value='<?php echo $key;?>' <?php if($key==$_GET['type']) echo "selected";?>><?php echo $value;?></option>
    	<?php 
    }?>
    </select>
   &nbsp; &nbsp; &nbsp; &nbsp; 

<input type="button" class='button' onclick="winPop({title:'添加新玩法',width:'600',drag:'true',height:'220',
url:'?controller=game&action=code_edit&active=new'})" value='添加新玩法'>&nbsp;

<input type="button" class='button' value="更新排序"  onclick="document.getElementById('sub').click();" >
</form>

   <form action="?controller=game&action=game_code&type=<?php echo $_GET['type']?>" method="POST"  id='form22'> 
<table> <tr>
          <th width="6%" align="center" bgcolor="#FFFFFF">排序</th>
                    <th width="15%" align="center" bgcolor="#FFFFFF">彩种类型</th> 
          <th width="25%" align="left" bgcolor="#FFFFFF"  style="padding-left:20px;">分类名称</th> 


          <th width="15%" align="center" bgcolor="#FFFFFF">状态</th>
          <th width="10%" align="center" bgcolor="#FFFFFF">操作</th> 
       </tr>

   
	<?php 
	$page=$_GET['page'];
	if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
if(!$_GET['type']) $type='ssc';
else $type=$_GET['type'];

		 if($config['game_qw']==2)  $where=" and  ( ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';

$sql_id="select * from game_code where pid=0  and type='{$type}'  {$where} ";
$result3=mysql_query($sql_id);
$nums4=mysql_num_rows($result3);
$sql_id="select * from game_code where pid=0  and type='{$type}' {$where} order by sortnum asc,id asc limit $starnum,$maxnum ";

$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){

$inid=$rows3[id];	
	
	?>

<tr height='25' align='center' style='background:#fff;'>
<td>
<input type="text" style='width:80px;' name='sort[<?php echo $inid;?>]' value="<?php echo $rows3['sortnum'];?>">
</td>
<td><?php echo $arr_game_code[$rows3['type']];?></td>
<td  align='left'  style='padding-left:20px;' ><?php echo $rows3[fullname];?>(<?php echo $rows3['ckey'];?>)</td>


<td><?php  if($rows3[status]=="0"){$status="启用";}else{$status="关闭";} echo $status;?></td>
  <td> 
   <a class='mouse_show link_01' onclick="winPop({title:'修改分类',width:'600',drag:'true',height:'220',url:'?controller=game&action=code_edit&id=<?php echo $rows3[id];?>'})">修改</a>
&nbsp;&nbsp;<a class='mouse_show link_01' onclick="winPop({title:'查看分类',width:'900',drag:'true',height:'600',url:'?controller=game&action=game_code_show&id=<?php echo $rows3[id];?>'})">查看</a>
&nbsp;&nbsp;<a class='mouse_show link_01' onclick="winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'?action=dele_post&flag=yes&dbname=game_code&id=<?php echo $rows3[id];?>'})">删除</a></td>
</tr>
<?php 
$sec_list=$db->fetch_all("select * from game_code where pid='{$rows3['id']}' order by sortnum asc,id asc");
if($sec_list){
	
	foreach ($sec_list as $value){

?>

	<tr height='25' align='center' style='background:#fff;'>
<td><input type="text" style='width:65px;margin-left:15px;' name='sort[<?php echo $value['id'];?>]' value="<?php echo $value['sortnum'];?>"></td>
<td><?php echo $arr_game_code[$rows3['type']];?></td>
<td align='left' style='padding-left:20px;' >&nbsp;&nbsp;|--<?php echo $value[fullname];?>(<?php echo $value['ckey'];?>)</td>



<td><?php  if($value[status]=="0"){$status="启用";}else{$status="关闭";} echo $status;?></td>
 <td> 
   <a class='mouse_show link_01' onclick="winPop({title:'修改分类',width:'600',drag:'true',height:'220',url:'?controller=game&action=code_edit&id=<?php echo $value[id];?>'})">修改</a>
&nbsp;&nbsp;<a class='mouse_show link_01' onclick="winPop({title:'查看分类',width:'900',drag:'true',height:'600',url:'?controller=game&action=game_code_show&id=<?php echo $value[id];?>'})">查看</a>
&nbsp;&nbsp;<a class='mouse_show link_01' onclick="winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'?action=dele_post&flag=yes&dbname=game_code&id=<?php echo $value[id];?>'})">删除</a></td>

</tr>
		
	
	<?php 
		}
	
	
}


}	
	
	?>	

	
  </table>
      
        <br>
<input type="submit" class='button' value="更新排序"  id='sub'  >
  </form>
       <div style='margin-left:10px;height:30px;line-height:30px;text-align:left'>
	<?php 
$sql_id="select * from game_code";
$results_id=mysql_query($sql_id);
	
	?>
 <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					<?php 
					$allnum=$nums4;
$pageurl=$thispath;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

					?>



	    </div> 
<?php include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>