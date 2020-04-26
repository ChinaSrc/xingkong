<?php


$playkey=$_GET['playkey'];
$itemkey=$_GET['itemkey'];$orders=$_GET['orders'];$search=$_GET['search'];$pages=$_GET[pages];
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
$code=$_GET['code'];if($code==""){$code="dp";}
$id=$_GET['id'];


mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$disc="";
if($id!=""){
mysql_query("set names utf8;");
$sql1="select * from user where userid='$id'";
$result1=mysql_query($sql1);
$numl=mysql_num_rows($result1);
if($numl-1>=0){$rowss=mysql_fetch_array($result1);}
$ctitle="修改管理员信息";
$disabled='disabled';
}
else {
	$ctitle="添加管理员";
$disabled='';
$rowss[isproxy]=$_GET['isproxy'];
if($_GET['isproxy']==3){$admin='1';$ctitle="添加管理员";}
}
$show_title=$ctitle;
;?>


<BODY bgColor=#FFFFFF> 


<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0  style="margin-top:10px;">
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3>
      <form method="post" action="?action=save_post&flag=yes&active=admin&id=<?php echo $id;?>" > 
	  <input type="hidden" name="admin" value="1">

      <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left> 
        <TR align=left>  
                    <td width="35%" bgcolor="#FFFFFF"><div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>用户名</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					   
					   <input name="username" id="username" type="text" size="30" value="<?php echo $rowss[username];?>" <?php echo $disabled;?> >&nbsp;&nbsp;
					   <font color='#777777'>用户名不允许修改</font>
					   </div>
					</td>
                  </tr>
	
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>密码</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <input name="password" id="password" type="password" size="18" value="">&nbsp;&nbsp;<font color='#777777'>不改密码时无需填写，保持为空即可。</font>
					   </div>
					</td> 
				 </tr>

          <tr bgcolor="#A4B6D7" align=left>
              <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>登录安全码</div></td>
              <td width="65%" bgcolor="#FFFFFF">
                  <div style='margin-left:5px;text-algin:left'>
                      <input name="randcode" id="randcode" type="text" size="18" value="<?php echo $rowss[randcode];?>">&nbsp;
                  </div>
              </td>
          </tr>


          <tr bgcolor="#A4B6D7" align=left>
                    <td width="35%" bgcolor="#FFFFFF" height="25"><div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>性别</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <select id='sex'  name='sex'>
					     <option value="男"   <?php if ($rowss['sex']=='男') echo "selected";?> >男</option>
					     <option value="女"  <?php if ($rowss['sex']=='女') echo "selected";?> >女</option></select>
					   </div>
					</td>
				 </tr>
			
				  	 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"><div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>账号状态</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <select  name='status'>
					     <option value="0"   <?php if (!$rowss['status']) echo "selected";?> >正常</option>
					     <option value="1"  <?php if ($rowss['status']) echo "selected";?> >锁定</option></select>
					   </div>
					</td>
				 </tr>
				 
				 
				 			 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>所属组</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					   
					   
					     <select id='admin_group' name='admin_group'>
					     <?php 
					     
					     $role_list=$db->fetch_all("select * from `role` order by id asc" );
					     foreach ($role_list as $key=>$value) {
					     	?>
					     	<option value="<?php echo $value['id'];?>" <?php if($value['id']==$rowss['admin_group']) echo "selected";?>><?php echo $value['name'];?></option>
					     	
					     	<?php 
					     }
					     ?>
					   
					     </select>
					   </div>
					   
					</td>
				 </tr>
				 	 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>邮箱</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <input type='text' id='email' name='email' size=30 onkeyup="this.value=this.value.replace(/\\D/g,'')"
					      onafterpaste="this.value=this.value.replace(/\\D/g,'')"  value='<?php echo $rowss[email];?>'>
					   </div>
					</td>
				 </tr>

				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>手机号</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <input type='text' id='mobilephone' name='mobilephone' size=30 onkeyup="this.value=this.value.replace(/\\D/g,'')"
					      onafterpaste="this.value=this.value.replace(/\\D/g,'')"  value='<?php echo $rowss[mobilephone];?>'>
					   </div>
					</td>
				 </tr>
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>QQ号</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-algin:left'>
					     <input type='text' id='qq' name='qq' size=30 onkeyup="this.value=this.value.replace(/\\D/g,'')"
					     onafterpaste="this.value=this.value.replace(/\\D/g,'')"  value='<?php echo $rowss[qq];?>'>
					   </div>
					</td>
				 </tr>
				
				 
				 <tr bgcolor="#A4B6D7" align=left> 
				    <td colspan=2 bgcolor="#FFFFFF"><div style='height:30px;line-height:30px;text-align:center;margin:10px;'>
				    <input type="submit" class='button' value="保存配置" type="submit"  id='submit'>
						&nbsp;&nbsp; 
			    </div>
				    </td>
				 </tr> 
                   
                </table>
		
   </form>

