<?php

$playkey=$_GET['playkey'];
$id=$_GET['id'];
mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$btn="保存配置";$show_title="创建玩法配置";
if($id){
mysql_query("set names utf8;");
$sql2="select * from game_code where id='$id'";
$result2=mysql_query($sql2);
$rowsk=mysql_fetch_array($result2);
$btn="保存配置";$show_title="修改玩法配置";
if($cate==""){$cate=$rowsk[cate];}
}
$show_title=$show_title;
?>

 
<BODY bgColor=#FFFFFF style='margin:0px;'> 
 <br>
<table width="100%" border="0" cellpadding="4" cellspacing="1"  align=center>
 <tr bgcolor="#FFFFFF">
	<td width=60%>
	    <form method="POST" action="<?php  echo ROOT_URL."/".$AdminPath;?>/?action=save_post&flag=yes&active=gameCode&id=<?php echo $id;?>"  name="form" id="form">
      <table width="100%" border="0" cellpadding="4" cellspacing="1" > 
         <tr height=30 bgcolor="#FFFFFF">
				     <td width='20%'>玩法分类：</td>
				     <td align=left valign=middle width='30%'>
					     <select name="type" id="type" style='width:80%' onchange="gbcode(this)">
					     <option value=''>请选择</option>
	<?php 
	foreach ($arr_game_code as $key=> $value) {
		?>
		
		<option value='<?php echo $key;?>'  <?php if($rowsk['type'] == $key ) echo "selected"; ?>><?php echo $value;?></option>
		
		
		<?php
	}
	
	?>
						 </select>
					
					 </td>
				     <td width='20%'>玩法名称：</td>
				     <td align=left valign=middle width='30%'>
					     <input type='text' id='fullname' name='fullname' style='width:80%' value="<?php echo $rowsk[fullname];?>">  
					 </td> 
			     </tr>
				 <tr height=30 bgcolor="#FFFFFF">
				     <td>玩法简称：</td>
					 <td align=left valign=middle>
					      <input type='text' id='ckey' name='ckey' style='width:80%' value="<?php echo $rowsk[ckey];?>"> 
					 </td> 
				     <td>是否启用：</td>
					 <td align=left valign=middle>
					      <input type='radio' name="status" id="status" value="0">启用
					      <input type='radio' name="status" id="status" value="1">关闭
					 </td> 
					 <script> 
					   //var obj=document.getElementsByName("status"); //("status") 
					   chkradio(document.getElementsByName("status"),'<?php echo $rowsk[status];?>')
					</script>
			     </tr> 
				 <tr height=30 bgcolor="#FFFFFF" >
				     <td>所在上级：</td>
					 <td align=left valign=middle >  
					  <select name='pid'>
					  <option value='0'>顶级分类</option>
					  <?php 
					  			$config=getsql::sys();	 
		 if($config['game_qw']==2)  $where=" and   ckey not like '%QW%'";
else $where='';
					  
					  $list=$db->fetch_all("select * from game_code where status='0' and pid='0' {$where} order by sortnum asc, id asc");
					  foreach ($list as $value) {
					  	?>
					  	<option  value='<?php echo $value['id'];?>' <?php if($value['id']==$rowsk['pid']) echo "selected";?>><?php echo $value['fullname']?></option>
					  	
					  	<?php
					  }
					  ?>
					
					  </select>
					 </td>
					    <td>排序：</td>
					 <td align=left valign=middle>
					      <input type='text' id='sortnum' name='sortnum' style='width:80%' value="<?php echo $rowsk[sortnum];?>"> 
					 </td> 
					 
			     </tr>  
				 <tr height=40 bgcolor="#FFFFFF"> 
					 <td align=left valign=top colspan=4> 
					 <div style='text-align:center;margin-top:5px;'>
					   <input type="submit" class='button' value="保存配置" type="submit"  id='submit' name="submit"> 
					 </div>
					 </td>
				 </tr> 
      </table> 
   </form>
	</td> 
 </tr>
</table> 
<script>
 
function show_url(thissle){
	window.location.href=G("thispath").value+'&itemkey='+thissle.value
}
selectSetItem(document.getElementById('channel'),'';echo $itemkey;;echo '')
</script>

</body> 