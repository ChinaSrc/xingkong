<?php

if($_POST){
	$now=time();
	if(!$_POST['id']){
		
		$_POST['userid']=$_SESSION['admin_id'];
		mysql_query("insert into news (`time`) values('$now')");
		
		$id=mysql_insert_id();
		
		
		
			add_adminlog("添加内容：".$_POST['title']);
	}
	else{
		$id=$_POST['id'];
		
		add_adminlog("修改内容：".$_POST['title']);
		
	}
if($id>0){
    if(count($_FILES)>0){

        include_once '../source/function/Image.php';
        $img=new Image();
        $path="/data/uploads/system/";
        foreach ($_FILES as $key=>$value) {
            if($file=$img->up_image($_FILES[$key], "../".$path)){
                $_POST[$key]=$path.$file;

            }
        }


    }

	foreach ($_POST as $key=> $value) {
		mysql_query("update news set `{$key}`='{$value}' where id='{$id}'");
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
$rowss=$db->fetch_first("select * from news where id='{$id}'");	
	$pid=$rowss['cate'];
	
}


$cate=$db->fetch_all("select * from news_cate where pid=0 and id>0 order by `sort` asc");


?>
	<script charset="utf-8" src="../static/js/kindeditor/kindeditor.js"></script>
		<script charset="utf-8" src="../static/js/kindeditor/lang/zh_CN.js"></script>
     <script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
		
			});
		</script> 
<form method="POST" action="?controller=news&action=index_add" enctype="multipart/form-data" name="form" id="form">
 <input type="hidden" name="active" value="add">
 <input type="hidden" name="id" value="<?php echo $id;?>">

 <table width="100%" border="0" cellpadding="4" cellspacing="1" class="table_add" bgcolor="#DDDDDD" align=left   id='info_con_1' >
 		 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>所在分类</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					     <select id=pid name=cate onchange="show_item(this.value);" >

					      
					      <?php 
					      foreach ($cate as $value) {
					      	?>
					      	
					     <option value="<?php echo $value['id']?>"  <?php if($pid==$value['id']) echo "selected";?>><?php echo $value['title']?></option>   
					     <?php 
					     $query=mysql_query("select * from news_cate where pid='{$value['id']}'");
					     while ($row=mysql_fetch_array($query)){
					     ?>
					     	     <option value="<?php echo $row['id']?>"  <?php if($pid==$row['id']) echo "selected";?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['title']?></option> 
					       	<?php }?>
					      	<?php 
					      }
					      ?>
					 
					    </select>
					   </div>
					   
					</td>
				 </tr>
 
        <TR align=left>  
                    <td width="20%" bgcolor="#FFFFFF"><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>标题</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					   <input name="title" id="title" type="text" size="60" value="<?php echo $rowss['title'];?>"   >
					   </div>
					</td>
                  </tr>

		
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>排列顺序</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
				   <input name="sort" id="sort" type="text" size="30" value="<?php if($rowss['sort'])echo $rowss['sort'];else echo "50";?>"  style="width: 100px"  >
				   
				   &nbsp;&nbsp;<font color=#777777>越小越靠前。</font>
					   </div>
					   
					</td>
				 </tr>

     <tr  id="active" <?php if($rowss['cate']!=3) echo 'style="display: none"';?>>
         <td colspan="2" bgcolor="#fff">
          <table>
              <tr bgcolor="#A4B6D7" align=left>
                  <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动封面</div></td>
                  <td width="80%" bgcolor="#FFFFFF">
                      <div style=margin-left:5px;text-algin:left>
                          <input type="file" name="banner">

                          <? if($rowss['banner']){?>
                              <a href='../<?php echo $rowss['banner']?>' target='_blank'>查看</a>

                          <?php }?>
                      </div>

                  </td>
              </tr>
              <tr bgcolor="#A4B6D7" align=left>
                  <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动描述</div></td>
                  <td width="80%" bgcolor="#FFFFFF">
                      <div style=margin-left:5px;text-algin:left>
                          <input name="desc" id="desc" type="text" size="60" value="<?php echo $rowss['desc'];?>"   >
                      </div>

                  </td>
              </tr>
          </table>

         </td>

     </tr>


     <tr  id="note" style="display: none">
         <td colspan="2" bgcolor="#fff">

         </td>

     </tr>

				         <tr > 
            <td align="left" bgcolor="#FFFFFF"><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>详细内容</div></td>
            <td bgcolor="#FFFFFF">
              <textarea style="width:600px;height:260px;visibility:hidden;" id="content" name="content" rows="10"><?php echo $rowss['content'];?></textarea>

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


    <script>
        function  show_item(value) {
            document.getElementById('active').style.display='none';
            document.getElementById('note').style.display='none';
            if(value==3) document.getElementById('active').style.display='';



        }


    </script>