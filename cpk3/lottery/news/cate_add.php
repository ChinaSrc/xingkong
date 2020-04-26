<?php

if($_POST){
	$now=time();
	if(!$_POST['id']){
		mysql_query("insert into news_cate (`time`) values('$now')");
		
		$id=mysql_insert_id();
		
		
		
			add_adminlog("添加内容栏目：".$_POST['title']);
	}
	else{
		$id=$_POST['id'];
		
		add_adminlog("修改内容栏目：".$_POST['title']);
		
	}
if($id>0){
	foreach ($_POST as $key=> $value) {
		mysql_query("update news_cate set `{$key}`='{$value}' where id='{$id}'");
	}
	
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}	
	
exit();	
	
	
}


if($_GET['pid']) $pid=$_GET['pid'];

if($_GET['id']){
	$id=$_GET['id'];
$rowss=$db->fetch_first("select * from news_cate where id='{$id}'");	
	$pid=$rowss['pid'];
	
}


$cate=$db->fetch_all("select * from news_cate where pid=0 and id>0 order by `sort` asc");


?>

      
<form method="POST" action="?controller=news&action=cate_add"  name="form" id="form"> 
 <input type="hidden" name="active" value="add">
 <input type="hidden" name="id" value="<?php echo $id;?>">

 <table width="100%" border="0" cellpadding="4" cellspacing="1" class="table_add" bgcolor="#DDDDDD" align=left   id='info_con_1' >
 		 <tr bgcolor="#A4B6D7" align=left >
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>所在分类</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					     <select id=pid name=pid>
					      <option value="0" >顶级分类</option>
					      
					      <?php 
					      foreach ($cate as $value) {
					      	?>
					      	
					     <option value="<?php echo $value['id']?>"  <?php if($pid==$value['id']) echo "selected";?>><?php echo $value['title']?></option>     	
					      	<?php 
					      }
					      ?>
					 
					    </select>
					   </div>
					   
					</td>
				 </tr>
 
        <TR align=left>  
                    <td width="20%" bgcolor="#FFFFFF"><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>分类名称</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					   <input name="title" id="title" type="text" size="30" value="<?php echo $rowss['title'];?>"   >
					   </div>
					</td>
                  </tr>

		
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>排列顺序</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
				   <input name="sort" id="sort" type="text" size="30" value="<?php echo $rowss['sort'];?>"   >
				   
				   &nbsp;&nbsp;<font color=#777777>越小越靠前。</font>
					   </div>
					   
					</td>
				 </tr>
				 
					 <tr bgcolor="#A4B6D7" align=left> 
				    <td colspan=2 bgcolor="#FFFFFF">
				    <div style=height:30px;line-height:30px;text-align:left;margin:10px;padding-left:150px; >
				    <input type="submit" class=button value="保存配置" type="submit"  id=submit name="submit">
						&nbsp;&nbsp; 
			    </div>
				    </td>
				 </tr> 
                   

                   
                </table>