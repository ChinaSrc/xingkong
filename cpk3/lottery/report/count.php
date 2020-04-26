<?php

header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="gp";}
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
      class=mframe-t-text><STRONG>搜索记录</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="../';echo $curpath;;echo '/images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD   bgColor=#f3f3f3><table width="100%" border="0"  cellpadding="3" cellspacing="3">
 <form name="form1" id="form1" method="post" action="">
 <tr>
    <td width="20%" align="right">&nbsp;用户名:</td>
    <td width="80%">
      <input name="username"  class="input"  type="text" value="" size="20" maxlength="20" /></td>
 </tr>      <tr> 
              <td align="right" >&nbsp;起始日期:</td>
              <td> <input  class="input"   value="2011-10-31" name="starttime" type="text" id="starttime" onClick="popUpCalendar(this, form1.starttime, \'yyyy-mm-dd\')" size="10">
                - 
                <input  class="input"   value="2011-11-01" name="endtime" type="text" id="endtime" onClick="popUpCalendar(this, form1.endtime, \'yyyy-mm-dd\')" size="10">              </td>
            </tr>
 <tr>
   <td align="right" >&nbsp;查看方式:</td>
   <td><select name="viewid">
   
<option value=0 selected>查看直接下级</option>

<OPTION value=1>查看全部下级</OPTION>
</select></td>
 </tr> 
 <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit"  class="button" name="submit" value="提交" /></td>
  </tr></form>
</table></TD>
      
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
<br> 

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>统计图表</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<table> <tr>
	       <td colspan="7" bgcolor="#FFFFFF">
			  <UL id=navlist >
			  ';
$listKey=array("gp","dp");
$titleKey=array("高频","低频");
for ($i=0;$i<count($listKey);$i++){
if($listKey[$i]==$playkey){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='/adminxp/?controller=report&action=count&playkey=".$listKey[$i]."'>".$titleKey[$i]."</A></LI>";
}
;echo ' 
              </UL>

			  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://download.macromedia.com/source/plugin/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="650" HEIGHT="400" ALIGN="middle">
          <PARAM NAME="FlashVars" value="&dataXML=<chart palette=\'2\' caption=\'Lottery Comparison\' shownames=\'1\' showvalues=\'0\' decimals=\'0\' numberPrefix=\'￥\' useRoundEdges=\'1\' legendBorderAlpha=\'0\'>
<categories>
    </categories>
<dataset seriesName=\'投注\' color=\'AFD8F8\' showValues=\'0\'>
    </dataset>
<dataset seriesName=\'中奖\' color=\'F6BD0F\' showValues=\'0\'>
   </dataset>
  </chart>">
          <PARAM NAME="movie" VALUE="count/charts/ScrollColumn2D.swf?chartWidth=750&chartHeight=400">
          <PARAM NAME="quality" VALUE="high">
          <param name="wmode" value="opaque" />
          <PARAM NAME="bgcolor" VALUE="#FFFFFF">
      <EMBED src="count/charts/ScrollColumn2D.swf?chartWidth=750&chartHeight=400" FlashVars="&dataXML=<chart palette=\'2\' caption=\'Lottery Comparison\' shownames=\'1\' showvalues=\'0\' decimals=\'0\' numberPrefix=\'￥\' useRoundEdges=\'1\' legendBorderAlpha=\'0\'>
<categories>
    </categories>
<dataset seriesName=\'投注\' color=\'AFD8F8\' showValues=\'0\'>
    </dataset>
<dataset seriesName=\'中奖\' color=\'F6BD0F\' showValues=\'0\'>
   </dataset>

  </chart>" quality="high" bgcolor="#FFFFFF" WIDTH="650" HEIGHT="400" ALIGN="middle" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" wmode="opaque"></EMBED></OBJECT>



		   </td>
       </tr> 
	   
  </table>
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