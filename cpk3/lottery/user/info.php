<?php

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
$rowss=$info=$db->fetch_first("select * from user where userid='{$_SESSION['admin_id']}'");

?>

      <form method="post" action="?action=save_post&flag=yes&active=admin&from=admin&id=<?php echo $_SESSION['admin_id'];?>" > 
	  <input type="hidden" name="admin" value="1">
	  	  <input type="hidden" name="userid" value="<?php echo $_SESSION['admin_id'];?>">
 <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left   id='info_con_1' > 
        <TR align=left>  
                    <td width="20%" bgcolor="#FFFFFF"><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>用户名</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					 <?php echo $rowss[username];?>
					   </div>
					</td>
                  </tr>

				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>管理员类型</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					  <?php echo $arr_admin_group[$rowss['admin_group']];?>
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>登陆邮箱验证</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					   
					   <?php 
					    if ($rowss['email_check']==1) echo "是";else echo "否";
					   ?>
					   	   </div>
					   
					</td>
				 </tr>
				  <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>登陆口令</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					  <?php echo $rowss['randcode'];?>
					   </div>
					   
					</td>
				 </tr>
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>邮箱</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					   					     <input type='text' id='email' name='email' size=30 onkeyup="this.value=this.value.replace(/\\D/g,'')"
					      onafterpaste="this.value=this.value.replace(/\\D/g,'')"  value='<?php echo $rowss[email];?>'>
					      </div>
					</td> 
				 </tr> 
		
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>手机号</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					     <input type=text id=mobilephone name=mobilephone size=30 onkeyup="this.value=this.value.replace(/\\D/g,)" onafterpaste="this.value=this.value.replace(/\\D/g,)"  value=<?php echo $rowss[mobilephone];?>>
					   </div>
					</td>
				 </tr>
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>QQ号</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					     <input type=text id='qq' name='qq' size=30 onkeyup="this.value=this.value.replace(/\\D/g,)" onafterpaste="this.value=this.value.replace(/\\D/g,)"  value=<?php echo $rowss['qq'];?>>
					   </div>
					</td>
				 </tr>
		 
				 <tr bgcolor="#A4B6D7" align=left> 
				 <td bgcolor="#FFFFFF"></td>
				    <td bgcolor="#FFFFFF">
				    <input type="submit" class='button' value="保存配置" type="submit"  id='' name="">
				
				    </td>
				 </tr> 
                   
                </table>
</form>