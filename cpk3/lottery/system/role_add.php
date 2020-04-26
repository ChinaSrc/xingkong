<?php

$isproxy=$_GET['isproxy'];
$role=$_GET['role']; 
$pages=$_GET['pages']; 
 
$t_url = "?mod=system&code=role";
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?> 
 	
	
	
<?php 


if($_GET['id']){
	
	
	$role=$db->fetch_first("select * from `role` where id='{$_GET['id']}'");

	
}
else $role=array();










if($_POST){

	if($_POST['name']){
	

	$content='';
	foreach ($_POST as  $key=>$value) {
		
		if(strpos($key, 'role_')!==false){
			
			foreach ($value as $value1){
				if($content) $content.='|'.$value1;
				else $content=$value1;
				
			}
			
			
		}
		
	}

	if($content){
		if($_POST['id']>0){
			
			
		mysql_query("update `role` set name='{$_POST[name]}',content='{$content}' where id='{$_POST[id]}'");	
		
			add_adminlog("编辑角色:".$_POST['name']);
	echo "<script>alert('修改角色成功');</script>";

echo "<script>window.location='?controller=system&action=role';</script>";
			
		}
		
		else{
		
mysql_query("insert into `role` (name,content) values('{$_POST[name]}','{$content}')");

if(mysql_affected_rows()>0){
	add_adminlog("添加新角色:".$_POST['name']);
	echo "<script>alert('添加角色成功');</script>";

echo "<script>window.location='?controller=system&action=role';</script>";
	
}
		}
	}
	
	else{
		
		echo "<script>alert('您还没选择任何角色');window.history.go(-1); </script>";


		
	}
	}
	
	else{
		
		echo "<script>alert('您还没填写角色名称');window.history.go(-1); </script>";
		
	}
	exit();
}


?>


<form  action='?controller=system&action=role_add' method='post'>
<input type="hidden" name='id' value='<?php echo $role['id']?>'>



 
<table> <tr >
          <td width="20%" bgcolor="#FFFFFF"  style='text-align:right;padding-left:5px;'>角色名称：</td>
                    <td width="80%" bgcolor="#FFFFFF"  style='padding-left:5px;text-algin:left'>
					 
					   <input name="name" id="name" type="text" size="30" value="<?php echo $role[name];?>"  >
					 
					</td>
       </tr> 



     <tr >
          <td width="20%" bgcolor="#FFFFFF"  style='text-align:right;padding-left:5px;'>权限列表：</td>
                    <td width="80%" bgcolor="#FFFFFF"  style='text-algin:left'>
				<?php 
				foreach ($arr_menu as $key=>$value) {
					if(count($arr_item[$key])>0){
					
					?>
					
					<div style='line-height:35px;border-bottom:1px #ddd solid;width:100%;padding-left:5px;'>
					<div style='font-weight:800'>
					<input type='checkbox' value='<?php echo $key;?>'  onclick='click_all("<?php echo $key?>");'  id='menu_<?php echo $key;?>' ><?php echo $value[0];?>
					
					</div>
					<div style='font-size:12px;'>	
					<?php foreach ($arr_item[$key] as $key1=> $value1) {
						
					if(strpos($role['content'], $value1[1])!==false) $check='checked';else $check='';	
						?>
						
						<input type='checkbox' <?php echo $check; ?> value='<?php echo $value1[1]?>' name='role_<?php echo $key?>[]'   onclick='click_all1("<?php echo $key?>");' ><?php echo $value1[0];?>   &nbsp; &nbsp;
						
						<?php 
					}?>
					</div>
					
					
					</div>
					
					<?php 
					}
				}
				
				?>
					</td>
       </tr> 
       
       
            <tr >
          <td width="20%" bgcolor="#FFFFFF"  style='text-align:right;padding-left:5px;'></td>
                    <td width="80%" bgcolor="#FFFFFF"  style='padding-left:5px;text-algin:left'>
					 
					  	    <input type="submit" class=button value="保存" type="submit"  id=submit name="submit">
						&nbsp;&nbsp; 
						  <input type="button" value='返回' class='button' onclick=' window.history.go(-1);  '>
					 
					</td>
       </tr> 
	   </table>
	

	
	
	</form>	
	
	<script type="text/javascript">


function click_all(id){
	var role=document.getElementsByName('role_'+id+'[]');
if(document.getElementById('menu_'+id).checked == true)
{

	

	for(var i=0;i<role.length;i++){

role[i].checked=true;
		
		}

	}

else{


	for(var i=0;i<role.length;i++){

		role[i].checked=false;
				
				}
	
}	
}


function click_all1(id){
	var role=document.getElementsByName('role_'+id+'[]');
var num=0;
	for(var i=0;i<role.length;i++){

		if(role[i].checked==true){
num++;
			}
				
				}

	if(num==role.length){

		document.getElementById('menu_'+id).checked = true;
		}
	else 
		document.getElementById('menu_'+id).checked = false
	
}

</script>
	
	
	
	
	
	
	
	
