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
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>奖金调节</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<table> <tr>
	       <td colspan="10" bgcolor="#FFFFFF">
			  <UL id=navlist >
			  ';
$result2=selects_sqls("game_type","ckey"," skey='dp'","","");
while($rows2=mysql_fetch_array($result2)){
if($playkey==$rows2[ckey]){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='/adminxp/?controller=system&action=adjust&playkey=".$rows2[ckey]."'>".$rows2[ckey]."</A></LI>";
}
;echo ' 
              </UL>
		   </td>
       </tr>
       <tr>
          <th width="6%" bgcolor="#FFFFFF">号码</th>   
	      <th width="8%" bgcolor="#FFFFFF">组三</th>  
          <th width="8%" bgcolor="#FFFFFF">组六</th>
		  <th width="12%" bgcolor="#FFFFFF">不定位一码</th>
          <th width="12%" bgcolor="#FFFFFF">不定位二码</th>
          <th width="11%" bgcolor="#FFFFFF">二码直选</th>
          <th width="11%" bgcolor="#FFFFFF">二码组选</th>
          <th width="11%" bgcolor="#FFFFFF">大小单双</th> 
		  <th width="11%" bgcolor="#FFFFFF">定位胆</th> 
          <th width="10%" bgcolor="#FFFFFF">操作</th>
      </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr>
          <td colspan="10" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  class="button" name="submit" value="修改"/>&nbsp;&nbsp;&nbsp;
		  &nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'600\',drag:\'true\',height:\'200\',url:\'';echo $add_file;;echo '&active=new\'})" value=\'添加新游戏时间\' disabled>&nbsp;
		  </td>
       </tr> 
	   ';
if($playkey){
$result3=selects_sqls("game_time","*"," playkey='".$playkey."'"," order by lotNum","");
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;".$rows3[id]."  <input name='id[]' type='hidden' value='".$rows3[id]."' /> </td>";
echo "<td><input style='padding-left:14px' name='begintime[]' type='text' value='".$rows3[beginTime]."' size='12' maxlength='8' /></td>";
echo "<td><input style='padding-left:14px' name='endtime[]' type='text'  value='".$rows3[endTime]."'  size='12' maxlength='8'/></td>";
echo "<td><input style='padding-left:14px' name='lotTime[]' type='text' value='".$rows3[lotTime]."'  size='12' maxlength='8'/></td>";
echo "<td><input style='padding-left:14px' name='lotNum[]' type='text' value='".$rows3[lotNum]."'  size='7' maxlength='3' /></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}
}else{
}
;echo '       
       <tr>
          <td colspan="10" bgcolor="#FFFFFF"><div style=\'text-align:right;mmargin:5px;\'><input type="submit"  class="button" name="submit" value="修改"  onclick="return winPop({title:\'保存配置\',form:\'myform\'});"></div></td>
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