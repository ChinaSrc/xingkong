<?php
 
if($id){
mysql_query("set names utf8;");
$sqls="select * from game_intface where id='$id'";
$results=mysql_query($sqls);
$rowss=mysql_fetch_array($results);
$btn="保存配置";$btn_title="修改配置";
}else{
$add_css="style='display:none'";
$btn="创建配置";$btn_title="新建配置";
}
;echo '  
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=6 background=../';echo $curpath;;echo '/images/table_center_r1_c1.gif>&nbsp;</TD>
      <TD  align="center" bgColor=#f3f3f3>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3"> 
	   <form method="POST" action="';echo ROOT_URL."/".$AdminPath;;echo '/?action=save_post&flag=yes&active=game_IntFace&id=';echo $rowss[id];;echo '"  name="form" id="form">   
	   <input name="flag" type="hidden" value="save" />
	    <tr>
  
 	     <td width="30%" align="right">&nbsp;游戏:</td>
 	     <td width="70%"> 
	     <SELECT name="playkey" size=1 id="playkey"  align=left>
	      <option  value=\'\'>请选择游戏</option>
		      ';
$_POST['playkey']=$playkey;
echo set_game_select('playkey','post');
echo '  
	     </select>
		 <script>selectSetItem(document.getElementById(\'playkey\'),\'';echo $rowss[playkey];;echo '\') </script>
		 </td>
	    </tr><tr>
	      <td align="right">地址:</td>
	      <td align=left>
 	       <input name="links" id="links" class="input"   type="text" value="';echo $rowss[links];;echo '" size="50" /></td>
 	  </tr>
 	  <tr>
 	     <td align="right">优先级:</td>
 	     <td align=left>
 	       <input name="Level" id="Level" class="input"   type="text" value="';echo $rowss[level];;echo '" size="5" maxlength="2" /></td>
 	  </tr> 
 	  <tr>
 	     <td align="right">是否启用:</td>
 	     <td align=left>
		 <select name="status" size=1 id="status" align=left>
		     <option value=\'0\'>启用</option>
		     <option value=\'1\'>停用</option>
		 </select>
		 <script>selectSetItem(document.getElementById(\'status\'),\'';echo $rowss[status];;echo '\') </script>
 	     </td>
 	  </tr> 
  
 	   <tr>
  	    <td>&nbsp;</td>
   	   <td align=left><input type="submit"  class="button" name="submit" value="提交" onclick="return winPop({title:\'保存配置\',form:\'form\'});"></td>
 	   </tr></form>
</table></TD><TD width=7 
  background=../';echo $curpath;;echo '/images/table_center_r1_c3.gif>&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
 ';
?>