<?php

$isproxy=$_GET['isproxy'];
$role=$_GET['role']; 
$pages=$_GET['pages']; 
 
$t_url = "?mod=system&code=role";
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?>


<?php 
if($_GET['type']=='delete' and $_GET['id']){
	
	
	 $row=	$db->fetch_first("select count(*) as num from user where admin_group='{$_GET['id']}'");
	if($row['num']>0){
				echo "<script>alert('请先删除其下的管理员');window.history.go(-1); </script>";
		
	}
	else{
		 $role=	$db->fetch_first("select * from `role` where id='{$_GET['id']}'");	
		mysql_query("delete  from `role` where id='{$_GET['id']}'");
		
		if(mysql_affected_rows()>0){
			
			
			add_adminlog("删除角色：{$role['name']}");
			
				echo "<script>alert('删除角色成功');</script>";

echo "<script>window.location='?controller=system&action=role';</script>";
		}
		
	}
	exit();
}
?>
 
 
 
<table> <tr >
          <td colspan="9" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;
      	       <a href="?controller=system&action=role_add">
	       添加角色</a>	  </td>
       </tr> 
       <tr>
          <th  bgcolor="#FFFFFF">Id</th>
          <th bgcolor="#FFFFFF">角色名称</th> 
          <th  bgcolor="#FFFFFF">管理员数量</th>

  
          
		  <th  bgcolor="#FFFFFF">操作</th>
       </tr>
     
   
     
	   <?php  
		   
		   
           mysql_query("set names utf8;");

           $sqls="select * from `role` where 1 order by id asc"; 
	
           $results=mysql_query($sqls); 
		
           while($rowss=mysql_fetch_array($results)){
           	
           	
           $row=	$db->fetch_first("select count(*) as num from user where admin_group='{$rowss['id']}'");
           	?>
           	<tr bgcolor="#FFFFFF"  style='text-align:center;'>
           	<td><?php echo $rowss['id']?></td>

  	<td><?php echo $rowss['name']?></td>    
  	  	<td><?php echo $row['num'];?></td>    
  	  
  	  	  	  	<td>
  	  	  	  	
  	  	  	  	  	  	    <a href="?controller=system&action=role_add&id=<?php echo $rowss['id']?>"><font class='link_01'>编辑</font></a>
				
                       
				 <a  onclick="del_user('<?php echo $rowss[id];?>','<?php echo $row['num'];?>');"><font class='link_01'>删除</font></a>
  	  	  	  	</td>    	
           </tr>	
           	<?php 
       
	              }
		
	   ?> 
	   </table>
	
<script >

function del_user(id,num){

if(num>0){
alert('请先删除其下的管理员');

return  false;	
}

else{
if(confirm('确定要删除吗? ')){

	window.location='?controller=system&action=role&type=delete&id='+id;
	
}


	
}
}


</script>
