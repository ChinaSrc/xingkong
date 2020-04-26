<?php

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
$rowss=$info=$db->fetch_first("select * from user where userid='{$_SESSION['admin_id']}'");

?>


      <form method="post" action="?action=save_post&flag=yes&active=admin_pwd&from=admin&id=<?php echo $_SESSION['admin_id'];?>" name="form1" onsubmit="return check_sub(this);" > 
	  <input type="hidden" name="admin" value="1">
	  	  <input type="hidden" name="id" value="<?php echo $_SESSION['admin_id'];?>">
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
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>旧登陆密码</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					<input class="basic_txt" type="password" name="password" id="password" type="text">
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>新登录密码</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					<input name="ps1" id="ps1" class="basic_txt" type="password">
					   	   </div>
					   
					</td>
				 </tr>
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> 
                    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>重复输入密码</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					   					 	<input name="ps2" id="ps2" class="basic_txt" type="password">					      </div>
					</td> 
				 </tr> 
		
				 <tr bgcolor="#A4B6D7" align=left> 
				 <td bgcolor="#FFFFFF"></td>
				    <td bgcolor="#FFFFFF">
				    <input type="submit" class='button' value="保存配置" type="submit"  id='submit' name="submit">
				
				    </td>
				 </tr> 
                   
                </table>
</form>

<script type="text/javascript">
function check_sub(form){

	   if(form.password.value=="") {
		 alert("请输入旧登陆密码!");
		 form.password.focus();
		 return false;
	   }

	   if(form.ps1.value=="") {
			alert("请输入新登陆密码!");
			form.ps1.focus();
			return false;
	   }

		if(form.ps2.value=="") {
			alert("请确认新登陆密码!");
			form.ps2.focus();
			return false;
		}

		if(form.ps2.value!=form.ps1.value)    	{
			alert("两次输入的登陆密码不一致!");
			form.ps2.select();
			return false;
		}

		if(form.ps1.value.length<6||form.ps1.value.length>50)
		{
			alert("登录密码长度不符合要求!");
			form.ps1.select();
			return false;
		}

		return true;
	}


</script>
