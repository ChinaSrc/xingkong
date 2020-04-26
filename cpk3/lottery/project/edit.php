<?php
if($_GET['id']){
	$buy=$db->fetch_first("select * from game_buylist where id='$_GET[id]'");
	
	if($buy['pri_number']){
				echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>本期已经开奖，无法修改</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";

	exit();
	
		
		
	}

}


if($_POST){
	
	$id=$_POST['id'];
	
	foreach ($_POST as $key=>$value) {
		if($key!='id'){
			
				mysql_query("update game_buylist set `{$key}`='{$value}' where id='{$id}'");
			
		}
		
		
	}
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>修改成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";

	exit();
	
}




?>
 
     <form method="POST" action="?controller=project&action=edit&id=<?php echo $_GET['id']?>" name="form1" id="form1"> 

<input name='id' type="hidden"  value='<?php echo $_GET['id'];?>'>


 
     
      <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#ccc" align=center  style='line-height:35px;margin-top:10px;'> 


				 <tr  bgcolor="#FFFFFF">
				     <td>期　　号：</td>
					 <td align=left valign=middle>&nbsp;
					      <input type='text' id='period' name='period' value='<?php echo $buy['period'] ?>'  style='width:200px'>  
						   
					 </td> 
			     </tr>
			     			     		 <tr bgcolor="#FFFFFF"> 
				     <td>投注时间：</td>
				     <td align=left valign=middle >&nbsp;
					 <input type='text' id='creatdate' name='creatdate' value='<?php echo $buy['creatdate'];?>' style='width:200px'> 
					 &nbsp;
					 </td>
					 
			     </tr>
				 <tr bgcolor="#FFFFFF"> 
				     <td>投注内容：</td>
				     <td align=left valign=middle >&nbsp;
				     <textarea id='number' name='number' cols='60' rows='5'><?php echo $buy['number'];?></textarea>
				     
				
					 </td>
					 
			     </tr>
			     

	
				 <tr height=30 bgcolor="#FFFFFF">
				 <td></td>
				      <td > &nbsp;
					  <input class='button' type="submit" value="提交" type="submit"  id='submit' name="submit">
					 </td>
				 </tr>
	
  </table> 
    
  </form>

</body>