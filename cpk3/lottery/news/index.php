<?php

if($_GET['type']=='delete'){
	if($_GET['id'] && $_GET['id']!= '107'){
		$id=$_GET['id'];
    
			
			mysql_query("delete from news where id='$id' ");
			if(mysql_affected_rows()>0){
				add_adminlog("删除新闻内容");
						echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>删除成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";	
				
			}

	}
	
	
	exit();
	
}


if($_GET['type']=='note' ){


    $db->query("update news set note='{$_GET['status']}' where id='{$_GET['id']}'") ;
}
if($_GET['type']=='hot' ){


    $db->query("update news set hot='{$_GET['status']}' where id='{$_GET['id']}'") ;
}

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
$cate=$db->fetch_all("select * from news_cate where pid=0 and id>0 order by `sort` asc");
?>


<form action="" method="get" name="frm_search" id="frm_search">
                  
                  <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
                  <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">
                 
                        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='center' style="padding-center: 10px;">
                                分类： 		     <select id=pid name=cate >
					      <option value="" >不限</option>
					      
					      <?php 
					      foreach ($cate as $value) {
					      	?>
					      	
					     <option value="<?php echo $value['id']?>"  <?php if($_GET['cate']==$value['id']) echo "selected";?>><?php echo $value['title']?></option>   
					     <?php 
					     $query=mysql_query("select * from news_cate where pid='{$value['id']}'");
					     while ($row=mysql_fetch_array($query)){
					     ?>
					     	     <option value="<?php echo $row['id']?>"  <?php if($_GET['cate']==$row['id']) echo "selected";?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['title']?></option> 
					       	<?php }?>
					      	<?php 
					      }
					      ?>
					 
					    </select>
 
                                 <input style="width: 120px" class="textbox" name="title" type="text" id="title" value="<?php echo $_GET['title']?>" size="20" />
          &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />
                                    
                                            &nbsp;&nbsp;<input type="button" class="button" value="添加内容"  onclick="winPop({title:'添加内容',form:'Form1',width:'840',height:'600',url:'?controller=news&action=index_add'})" />
                                    </td>
                                </tr>
                        </table>
                               
                        </form>    


<?php 

if ($_GET['cate']){
	
	$search.=" and (cate='{$_GET['cate']}' or  cate in (select id from news_cate where pid='{$_GET['cate']}') ) ";
	
}
if ($_GET['title']){
	
	$search.=" and title like '%{$_GET['title']}%' ";
	
}

$num=20;
$sql="select * from news where id>0 {$search} order by `sort` asc,id desc ";
$page =new Page($sql,$num,$_GET['page']);
$sql.=" limit {$page->from},$num";
$list=$db->fetch_all($sql);
?>

<form action='index.aspx?controller=news&action=cate&type=sort' method='post'  id='sort'>
   <table style="border-bottom: 0px;  border-top: 0px;" class="my_tbl my"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                           
                                <th align="center">编号 
                                </th>
                                <th align="center">&nbsp;&nbsp;&nbsp;标题
                                </th>
                                <th align="center">&nbsp;&nbsp;&nbsp;所在分类
                                </th>
                                <th align="center">&nbsp;&nbsp;&nbsp;添加时间
                                </th>
               
                                <th align="center">操作
                                </th>
                            </tr>
                            <?php 
                            if($list){
                            foreach ($list as $key=>$value) {
                            	
                            	
                            $row=	$db->fetch_first("select * from news_cate where id='{$value['cate']}'");
                             $catename=$row['title'];
                             
                             if($row['pid']>0){
                             	
                             	  $row1=	$db->fetch_first("select * from news_cate where id='{$row['pid']}'");
                             $catename=$row1['title'].'-'.$catename;
                             	
                             }
                            ?>
                            
                             
                            <tr>
                          
                                
                            
                                <td  style="text-align: center">
                                  <?php echo $value['id']?> 
                                </td>
                                <td style="text-align: center">
                                  <a onclick="winPop({title:'编辑',form:'Form1',width:'800',height:'600',url:'?controller=news&action=index_add&id=<?php echo $value['id'];?>'})">
                                  	<?php echo $value['title']?>
                                  </a> 
                                </td>
                                <td style="text-align: center">
                             <?php echo $catename;?>
                                  </td>
                                <td style="text-align: center">
                             <?php echo date('Y-m-d H:i:s',$value['time']);?>
                                  </td>
                                  
                           
                                <td style="text-align: center">
                        
					
					<a onclick="winPop({title:'编辑',form:'Form1',width:'800',height:'600',url:'?controller=news&action=index_add&id=<?php echo $value['id'];?>'})">编辑</a>&nbsp;&nbsp;
				
                       
					  <a  onclick="if(confirm('确定要删除吗? '))winPop({title:'删除分类',form:'Form1',width:'300',height:'150',url:'index.aspx?controller=news&action=index&type=delete&id=<?php echo $value['id'];?>'});">删除</a>
                                    <?php
                                    if($value['note']!=1){
                                        ?>
                                    &nbsp;    <a href="index.aspx?controller=news&action=index&type=note&status=1&id=<?php echo $value['id']; ?>">通知</a>
                                    <?php
                                    }
                                    else{
                                        ?>

                                        <a href="index.aspx?controller=news&action=index&type=note&status=0&id=<?php echo $value['id']; ?>">取消通知</a>
                                        <?php
                                    }
                                    ?>


                                    <?php
                                    if($value['hot']!=1){
                                        ?>
                                        &nbsp;    <a href="index.aspx?controller=news&action=index&type=hot&status=1&id=<?php echo $value['id']; ?>">热点</a>
                                        <?php
                                    }
                                    else{
                                        ?>

                                        <a href="index.aspx?controller=news&action=index&type=hot&status=0&id=<?php echo $value['id']; ?>">取消热点</a>
                                        <?php
                                    }
                                    ?>
                                  </td>
                            </tr>
               
                            
                            
                     <?php }
                     
                            }?>

</table>
    <div class="page">

        <?php echo $page->get_page();?>
    </div>

</form>
     
                     