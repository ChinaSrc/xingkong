<?php

header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}
include($headpaths);
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
<BODY bgColor=#FFFFFF>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="../';echo $curpath;;echo '/images/table_top_r1_c1.gif" width=14></TD>
      <TD background=../';echo $curpath;;echo '/images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>数据库操作</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="../';echo $curpath;;echo '/images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>
<form name="form1" method="post" action="">
		<input name="flag" type="hidden" value="do" />
		<table width="98%" border="0">
		
		        <tr>
          <td align="right">执行目标:</td>
          <td width="91%" align="left">&nbsp;<select name="tableid">
<OPTION value=0>请选择数据表</OPTION>
<OPTION value=1>奖金表</OPTION>
<OPTION value=2>返点表</OPTION>
<OPTION value=3>投注记录表</OPTION>
<OPTION value=4>账变记录表</OPTION>
<OPTION value=5>银行记录表</OPTION>
<OPTION value=6>玩法表</OPTION>
</select></td>
        </tr>
        <tr>
          <td width="9%" align="right">执行语句:</td>
          <td width="91%" align="left">&nbsp;<textarea name="textfield" cols="80" rows="5"></textarea>          </td>
        </tr>

        <tr>
          <td width="9%" align="right">执行密码:</td>
          <td align="left"> &nbsp;<input name="password" type="password" value="" size="20" maxlength="20"></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td height="40" align="left">&nbsp;<input type="submit"  class="button" name="submit" value="执行" /></td>
        </tr>
		  
   <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>
      </table> 
        </form>            
      <br></TD>
      
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE> 

</body> ';
?>