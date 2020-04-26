<?php

$id=$_GET['id'];
$playkey=$_GET['playkey'];
$show_title="发布新公告";
mysql_query("set names utf8;");
if($id){
mysql_query("set names utf8;");
$sql2="select * from bulletin where id='$id'";
$result2=mysql_query($sql2);
$rows2=mysql_fetch_array($result2);
$btn="保存";$show_title="修改公告";
$nowtime=$rows2[creatdate];
}
$show_title=$show_title;
if($nowtime==""){$nowtime=date("Y-m-d H:i:s",time());}
;echo ' 
<!--富文本编辑器--------------------------------------------------------------------->
    <style>
			form {
				margin: 0;
			}
			textarea {
				display: block;
			}
	</style>
    <script charset="utf-8" src="../editor/kindeditor.js"></script>
	<script>
		KE.show({
			id : \'content\',
			allowFileManager : true
		});
</script> 
<!--富文本编辑器--------------------------------------------------------------------->
<BODY bgColor=#FFFFFF> 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><b>';echo $show_title;;echo '</b></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<form method="POST" action="';echo ROOT_URL."/".$AdminPath;;echo '/?action=save_post&active=bulletin&id=';echo $id;;echo '"  name="form" id="form">
      <table> <tr bgcolor="#A4B6D7"> 
                    <td width="15%" height="25"> <div align="center">标&nbsp;&nbsp;题</div></td>
                    <td bgcolor="#FFFFFF" colspan=3> <input name="title" type="text" size="100" maxlength="100" value="';echo $rows2[title];;echo '"></td>
                  </tr>
				  <tr bgcolor="#A4B6D7">
				    <td width="15%" height="25"> <div align="center">发布时间</div></td>
                    <td width="35%" bgcolor="#FFFFFF"> <input name="creatdate" type="text" size="25" value="';echo $nowtime;;echo '"  onClick="setTime(this);"></td>
                    <td width="15%"><div align="center">频&nbsp;&nbsp;道：</div></td>
                    <td width="35%" bgcolor="#FFFFFF"><select name="channel" id="channel">
                        <option value="0">平台公告</option>
                        <option value="1">活动公告</option> 
                      </select></td>
				  </tr>
				  <script>selectSetItem(document.getElementById(\'channel\'),\'';echo $rows2[channel];;echo '\') </script>
                  <tr bgcolor="#A4B6D7"> 
                    <td height="22"> <div align="center">内&nbsp;&nbsp;容</div></td>
                    <td colspan="3" bgcolor="#FFFFFF"> <textarea rows="22" name="Content" id="Content" cols="110">';echo $rows2[content];;echo '</textarea> 
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="45" colspan="4"> 
					    <div align="center"> 
                        <input type="submit"  class=\'button\' value="提交公告" id=\'submit\' name="submit"> 
						&nbsp;&nbsp; 
						</div>
                    </td>
                  </tr>
      </table>
	   
   </form>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE>

 
</body> '
?>