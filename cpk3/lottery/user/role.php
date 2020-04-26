<?php

header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="0";}
include($headpaths);
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
$roles=array('系统管理员');
;echo ' 
<BODY bgColor=#FFFFFF>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>角色管理</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<table> <tr>
	       <td colspan="6" bgcolor="#FFFFFF" align=left> 
			  <UL id=navlist >
			  ';
for ($i=0;$i<count($roles);$i++){
if($playkey-$i==0){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='../".$headpath."/?controller=user&action=role&playkey=".$i."'>".$roles[$i]."</A></LI>";
}
;echo ' 
              </UL>
		   </td>
       </tr>
       <tr>
          <th width="10%" bgcolor="#FFFFFF">Id</th>
          <th width="13%" bgcolor="#FFFFFF">用户名</th>
          <th width="17%" bgcolor="#FFFFFF">登陆时间</th>   
          <th width="25%" bgcolor="#FFFFFF">注册时间</th>
          <th width="14%" bgcolor="#FFFFFF">角色</th> 
          <th width="14%" bgcolor="#FFFFFF">操作</th> 
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr align=left>
          <td colspan="6" bgcolor="#FFFFFF">&nbsp;&nbsp;
		  &nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'600\',drag:\'true\',height:\'200\',url:\'';echo $add_file;;echo '&active=new\'})" value=\'添加\' >&nbsp;
		  </td>
       </tr> 
	   ';
$result3=selects_sqls("user","*"," role='8'","","");
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;".$rows3[userid]."</td>";
echo "<td>".$rows3[username]."</td>";
echo "<td bgcolor='#FFFFFF'>&nbsp;".$rows3[logintime]."</td>";
echo "<td bgcolor='#FFFFFF'>".$rows3[registertime]."</td>";
echo "<td>&nbsp;";
for ($j=0;$j<count($roles);$j++){
echo $roles[$j];
}
echo "<td bgcolor='#FFFFFF'><input type='button' class='button' name='submit' value='删除'/></td>";
echo "</td></tr>";
}
;echo '       
       <tr align=left style=\'display:none\'>
          <td colspan="6" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  class="button" name="submit" value="修改"  onclick="return winPop({title:\'保存配置\',form:\'myform\'});"></td>
       </tr>
	  </form>
  </table>
      
        <br>
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

</body> ';
?>