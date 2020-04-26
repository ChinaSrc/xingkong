<?php

if($_GET['type']=='delete'){
	if($_GET['id']){
		$id=$_GET['id'];

		$row=$db->fetch_first("select * from news_cate where pid='$id'");
		if($row){
			
				echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>请先删除其下面的子类</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";	
			
		}
		else{
			
			$news=$db->fetch_first("select * from news where cate='$id'");
				if($news){
			
				echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>请先删除其下面的内容</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";	
			
		}
		else{
			
			mysql_query("delete from news_cate where id='$id' or pid='{$id}'");
			if(mysql_affected_rows()>0){
				add_adminlog("删除内容分类");
						echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>删除成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";	
				
			}
			
			
		}	
		
		
		}
		
		
	}
	
	
	exit();
	
}

if($_POST and $_GET['type']=='sort'){
	
	foreach ($_POST['sort'] as $key=>$value) {
		mysql_query("update news_cate set `sort`='{$value}' where id='{$key}'");
	}
		add_adminlog("更新内容排序");
	echo "<script>alert('更新成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";

exit();
}


include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

?>
<div class='my_tbl' style='line-height:40px;height:40px;'>

&nbsp;
<input type="button"  class='button' value='添加分类'  onclick="winPop({title:'添加类别',form:'Form1',width:'450',height:'200',url:'?controller=news&action=cate_add'})">

&nbsp;&nbsp;
<input type="button"  class='button'  value='一键更新排序' onclick="document.getElementById('sort').submit();" >
</div>




<?php 
$list=$db->fetch_all("select * from news_cate where pid=0 and id>0 order by `sort` asc,id desc");
?>

<form action='index.aspx?controller=news&action=cate&type=sort' method='post'  id='sort'>
   <table style="border-bottom: 0px;  border-top: 0px;" class="my_tbl my"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              
                                <th align="center">编号 
                                </th>
                                <th align="left">&nbsp;&nbsp;&nbsp;类别名称
                                </th>
                                <th align="left">&nbsp;&nbsp;&nbsp;排序
                                </th>
               
                                <th align="center">操作
                                </th>
                            </tr>
                            <?php 
                            foreach ($list as $key=>$value) {
                          
                            ?>
                            
                             
                            <tr>
                          
                                
                            
                                <td  align="center">
                                  <?php echo $value['id']?> 
                                </td>
                                <td class="tdleft"><?php echo $value['title']?>
                                    
                                </td>
                                <td class="tdleft">
                                              <input type="text"  name='sort[<?php echo $value['id']?>]' value='<?php echo $value['sort']?>' size='8'>
                                
                                  </td>
                              
                           
                                <td align="center">
                        

					<a onclick="winPop({title:'编辑分类',form:'Form1',width:'450',height:'200',url:'?controller=news&action=cate_add&id=<?php echo $value['id'];?>'})">编辑</a>&nbsp;&nbsp;
				
                       
					  <a  onclick="if(confirm('确定要删除吗? '))winPop({title:'删除分类',form:'Form1',width:'300',height:'150',url:'index.aspx?controller=news&action=cate&type=delete&id=<?php echo $value['id'];?>'});">删除</a>
                                  
                                  </td>
                            </tr>
                            
                            <?php 
                         $list1=  $db->fetch_all("select * from news_cate where pid='{$value['id']}' order by sort asc ,id asc");
                              if($list1){
                         foreach ($list1 as $key1=>$value1) {
                          
                            ?>
                            
                             
                            <tr>
                         
                                <td  align="center">
                                  <?php echo $value1['id']?> 
                                </td>
                                <td class="tdleft">
                                
                                 &nbsp; &nbsp; |- <?php echo $value1['title']?>
                                    
                                </td>
                                <td class="tdleft">
                                              <input type="text"  name='sort[<?php echo $value1['id']?>]' value='<?php echo $value1['sort']?>' size='8'>
                                
                                  </td>
                              
                           
                                <td align="center">
                        
					<a onclick="winPop({title:'编辑分类',form:'Form1',width:'450',height:'200',url:'?controller=news&action=cate_add&id=<?php echo $value1['id'];?>'})">编辑</a>&nbsp;&nbsp;
				
                       
					  <a  onclick="if(confirm('确定要删除吗? '))winPop({title:'删除分类',form:'Form1',width:'300',height:'150',url:'index.aspx?controller=news&action=cate&type=delete&id=<?php echo $value1['id'];?>'});">删除</a>
                                   
                                  </td>
                            </tr>
                            
                         <?php }
                              }
                         ?>
                            
                            
                            
                     <?php }?>
   
                        </table>


</form>
     
                     