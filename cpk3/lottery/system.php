<?php


$config=$con_system=getsql::sys();

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?>

<style>
tr{line-height:40px;}

</style>
<?php
echo ' <table width="100%" border="0" cellpadding="4" cellspacing="1"    style="line-height:40px;">
	 <form method="POST" action="';echo ROOT_URL."/".$AdminPath."/?action=save_post&active=system&flag=yes";;echo '" enctype="multipart/form-data"  name="form" id="form">
	    <input name="cachstatus" id="cachstatus" type="hidden" size="60" value="';echo $config[cachstatus];;echo '">

<tr  align=\'left\'>
                    <td width="20%" ><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站名称</b></div></td>
                    <td width="80%" >
					   <div style=\'margin-left:5px;text-align:left\'>
					   <input name="sitename" id="sitename" type="text" size="100" value="';echo $config[sitename];;echo '">
					   </div>
					</td>
                  </tr>


				 <tr >
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网页标题</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					     <input name="sitetitle" id="sitetitle" type="text" size="100" value="';echo $config[sitetitle];;echo '">

					   </div>
					</td>
				 </tr>

				 	 <tr >
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站LOGO</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					     <input name="logo" type="file" size="80" value="" >
						 &nbsp;&nbsp;<font color=\'#777777\'>';echo $config[logo];;echo '</font>
					   </div>
					</td>
				 </tr>
				 			 	 <tr >
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>登陆注册LOGO</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					     <input name="logo1" type="file" size="80" value="" >
						 &nbsp;&nbsp;<font color=\'#777777\'>';echo $config[logo1];;echo '</font>
					   </div>
					</td>
				 </tr>


				  <tr >
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站标志</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					     <input name="ico" type="file" size="80" value="" >
						 &nbsp;&nbsp;<font color=\'#777777\'>';echo $config[ico];;echo '</font>
					   </div>
					</td>
				 </tr>

				 <tr  align=\'left\'>
                    <td width="20%" ><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站描述</b></div></td>
                    <td width="80%" >
					   <div style=\'margin-left:5px;text-align:left\'>
					   <input name="description"  type="text" size="100" value="';echo $config[description];;echo '">
					   </div>
					</td>
                  </tr>


                  <tr  align=\'left\'>
                    <td width="20%" ><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站关键字</b></div></td>
                    <td width="80%" >
					   <div style=\'margin-left:5px;text-align:left\'>

					   <textarea name="keywords"  rows="4" cols="100">';echo $config[keywords];;echo '</textarea>

					   </div>
					</td>
                  </tr>
					 <tr style="display: none">
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>网站描述</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					   	   <textarea name="contact"  rows="4" cols="100">';echo $config[contact];;echo '</textarea>


					   </div>
					</td>
				 </tr>

				 		 <tr style="display: none">
                    <td  height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'><b>服务条款</b></div></td>
                    <td >
					   <div style=\'margin-left:5px;text-align:left;\'>
					   	   <textarea name="reg_rule"  rows="5" cols="100">';echo $config[reg_rule];;echo '</textarea>

						 &nbsp;&nbsp;<font color=\'#777777\'>用户注册时显示</font>
					   </div>
					</td>
				 </tr>







       <tr ><td></td>
          <td align=left>&nbsp;
		  <input type="submit"  class="button" name="submit" value="保存配置" >
		  </td>
       </tr>
	  </form>
  </table>

';
?>
