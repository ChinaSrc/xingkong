<?php
 
$game_list=$db->fetch_all("select fullname,ckey from game_type where status='0'");


if($_GET['id']){
	$lottery=$db->fetch_first("select * from game_lottery where id='$_GET[id]'");
	$_GET['playKey']=$lottery['playKey'];
	$_GET['period']=$lottery['period'];	
}
?>
 
     <form method="POST" action="<?php echo ROOT_URL."/".$AdminPath;?>/?action=save_post&flag=yes&active=lottery_add" name="form1" id="form1"> 

<input name='id' type="hidden"  value='<?php echo $_GET['id'];?>'>


 
     
      <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#ccc" align=center  style='line-height:35px;margin-top:10px;'> 

        <tr bgcolor="#FFFFFF">
				
				     <td width='20%'>彩　　种：</td>
				     <td align=left valign=middle >
					     <select name="playKey" id="playKey" onchange="Get_period(this)" style='width:200px'  <?php if($lottery) echo "disabled";?>  >
						     <option value=''>-请选择-</option>
<?php 
echo set_game_select('playKey','get');
?>             </select>
	
					 </td> 
			     </tr>
				 <tr  bgcolor="#FFFFFF">
				     <td>期　　号：</td>
					 <td align=left valign=middle>
					      <input type='text' id='period' name='period' value='<?php echo $_GET['period'] ?>' <?php if($lottery) echo "disabled";?>  style='width:200px'>  
						   
					 </td> 
			     </tr>
				 <tr bgcolor="#FFFFFF"> 
				     <td>开奖号码：</td>
				     <td align=left valign=middle >
					 <input type='text' id='number' name='number' value='<?php echo $lottery['Number'];?>' style='width:200px'>  （开奖号码请用逗号“,”隔开）
					 &nbsp;
					 </td>
					 
			     </tr>
			     <?php if($_GET['id']){?>
			    
			      <tr bgcolor="#FFFFFF"> 
				     <td>重新派奖：</td>
				     <td align=left valign=middle >
				     
					 <input type='checkbox' id='prize_back' name='prize_back' value='1' >  （选中之后，原奖金将全部收回，系统将按照新开奖号码重新派奖，请谨慎操作）
					
					 </td>
					 
			     </tr>
			     
			     <?php }?>
				 <tr height=30 bgcolor="#FFFFFF">
				 <td></td>
				      <td > &nbsp;
					  <input class='button' type="submit" value="提交" type="submit"  id='submit' name="submit">
					 </td>
				 </tr>
	
  </table> 
    
  </form>

</body>