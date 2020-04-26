<?php

require_once('connect.php');
header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
include($headpaths);
$itemkey=$_GET['itemkey'];$orders=$_GET['orders'];$search=$_GET['search'];$pages=$_GET[pages];
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
if($active==""){$title="返点设置";$btn_title="确定";}else{$title="会员信息修改－返点设置";$btn_title="设置";}
if($pername==""){
$user_infor_css="style='display:none'";
}else{
mysql_query("set names utf8;");
$sqlm="select userid,username,nickname from user where username='$pername'";
$resultm=mysql_query($sqlm);
$rowsm=mysql_fetch_array($resultm);
if($rowsm){$user_infor_css="style='display:'";}
}
mysql_query("set names utf8;");
$sql2="select * from game_ssc_list order by code";
$result2=mysql_query($sql2);
;echo ' 
<BODY bgColor=#FFFFFF> 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><b>';echo $title;;echo '</b></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE> 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR align=left> 
      
      <TD  align="center" bgColor=#f3f3f3> 
      <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" style=\'margin-top:10px;margin-bottom:0px;\'> 
         <tr bgcolor="#f3f3f3";>
            <td width="15%" height="30"> <div align="center"><b>玩法群</b></div></td>
            <td width="15%"> <div align="center"><b>玩法组</b></div></td> 
            <td width="20%"> <div align="center"><b>返点(1700模式)</b></div></td>
            <td width="20%"> <div align="center"><b>返点(1800模式)</b></div></td>
            <td width="20%"> <div align="center"><b>返点(1900模式)</b></div></td> 
         </tr> 
	  </table>
	  <div style="height:500px;overflow:auto;width:100%;BORDER-TOP:#c66800 1px solid;">
	  <input type=\'hidden\' id=\'uid\' value=\'';echo $rowsm[userid];;echo '\'>
	  <input type=\'hidden\' id=\'playkey\' value=\'';echo $playkey;;echo '\'>
	  <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" style=\'margin-bottom:10px;\'> 
		 ';
$flowid=1;$last_code="";$code_num=0;
while($rows2=mysql_fetch_array($result2)){
$bgcolor="#FFFFFF";
echo "<tr height='20' align=center style='background:".$bgcolor.";' align=left>";
if($last_code==""){
$last_code=$rows2[code];$show_td="yes";
}else{
if($last_code==$rows2[code]){
$code_num=$code_num+1;
$show_td="no";
}else{
$last_code=$rows2[code];$code_num=1;$show_td="yes";
}
}
if($show_td=="yes"){
$result6 = mysql_query("select count(id) from game_ssc_list where code='$rows2[code]'") or die("未能读取，请刷新");
$rows6=mysql_fetch_row($result6);
$Maxnum=$rows6[0];
echo "<td width='15%' height='25' rowspan='".$Maxnum."' >".$rows2[code]."</td>";
}
$now_mode='1700';
mysql_query("set names utf8;");
$sqls="select number from game_rebate where userid='$rowsm[userid]' and ckey='$rows2[skey]' and modes='$now_mode'";
$results=mysql_query($sqls);
$nums=mysql_num_rows($results);
$rebate_num="";
if($nums){$rowss=mysql_fetch_array($results);$rebate_num=$rowss[number];$isvalue="yes";}
echo "   <td width='15%'>".$rows2[fullname]."<span style='display:none' id='old_".$rows2[skey]."'>".$isvalue."</span></td>";
echo "   <td width='20%'><span id='edit_1700_".$rows2[skey]."'><font color='#777777'>1700模式：</font> <input id='item_1700_".$rows2[skey]."' value='".$rebate_num."' style='width:60px;'></span>";
echo "   <span id='save_1700_".$rows2[skey]."' style='display:none;width:80px;'>正在保存...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Ret_Item('".$rows2[skey]."','1700','rebate')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
$now_mode='1800';
mysql_query("set names utf8;");
$sqls="select number from game_rebate where userid='$rowsm[userid]' and ckey='$rows2[skey]' and modes='$now_mode'";
$results=mysql_query($sqls);
$nums=mysql_num_rows($results);
$rebate_num="";
if($nums){$rowss=mysql_fetch_array($results);$rebate_num=$rowss[number];$isvalue="yes";}
echo "   <td width='20%'><span id='edit_1800_".$rows2[skey]."'><font color='#777777'>1800模式：</font> <input id='item_1800_".$rows2[skey]."' value='".$rebate_num."' style='width:60px;'></span>";
echo "   <span id='save_1800_".$rows2[skey]."' style='display:none;width:80px;'>正在保存...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Ret_Item('".$rows2[skey]."','1800','rebate')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
$now_mode='1900';
mysql_query("set names utf8;");
$sqls="select number from game_rebate where userid='$rowsm[userid]' and ckey='$rows2[skey]' and modes='$now_mode'";
$results=mysql_query($sqls);
$nums=mysql_num_rows($results);
$rebate_num="";
if($nums){$rowss=mysql_fetch_array($results);$rebate_num=$rowss[number];$isvalue="yes";}
echo "   <td width='20%'><span id='edit_1900_".$rows2[skey]."'><font color='#777777'>1900模式：</font> <input id='item_1900_".$rows2[skey]."' value='".$rebate_num."' style='width:60px;'></span>";
echo "   <span id='save_1900_".$rows2[skey]."' style='display:none;width:80px;'>正在保存...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Ret_Item('".$rows2[skey]."','1900','rebate')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
echo "</tr>";
$flowid+=1;
$str="#".$rows2[skey];
if(strpos($str,'BDW')){
if($list_bdw==""){$list_bdw=$rows2[skey];}else{$list_bdw=$list_bdw."|".$rows2[skey];}
}else{
if($list_other==""){$list_other=$rows2[skey];}else{$list_other=$list_other."|".$rows2[skey];}
}
}
;echo '	 
     </table> 
	 </div>
	 <table> <tr bgcolor="#FFFFFF" align=center height=3 style="color:red;"> 
            <td width="15%" height="25">
			   <b>统一设置：</b>
			 </td>
			<td width="15%" height="25"> 
			   <input type=\'hidden\' id=\'list_bdw\' value=\'';echo $list_bdw;echo '\'>
			   <input type=\'hidden\' id=\'list_other\' value=\'';echo $list_other;echo '\'>
			   <input type=radio name="do_bdw" id="do_bdw" value="bdw">不定位
			   <input type=radio name="do_bdw" id="do_other" value="other" checked>其他
			</td> 
            <td width="20%"">
			   1700模式： <span id=\'edit_1700\'><input id=\'item_1700\' value=\'\' style=\'width:60px;\'></span>
		      <span id=\'save_1700\' style=\'display:none;width:80px;text-align:left\'>正在保存...</span> 
		      <span class=\'mouse_show\' onclick="Save_Ret_all(\'1700\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
		    </td>
			</td>
            <td width="20%">
			    1800模式： <span id=\'edit_1800\'><input id=\'item_1800\' value=\'\' style=\'width:60px;\'></span>
		      <span id=\'save_1800\' style=\'display:none;width:80px;text-align:left\'>正在保存...</span> 
		      <span class=\'mouse_show\' onclick="Save_Ret_all(\'1800\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
			</td>
            <td width="20%">
			    1900模式： <span id=\'edit_1900\'><input id=\'item_1900\' value=\'\' style=\'width:60px;\'></span>
		      <span id=\'save_1900\' style=\'display:none;width:80px;text-align:left\'>正在保存...</span> 
		      <span class=\'mouse_show\' onclick="Save_Ret_all(\'1900\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
			</td> 
        </tr>
     
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

<script>
 
selectSetItem(document.getElementById(\'channel\'),\'';echo $itemkey;;echo '\')
</script>

</body> ';
?>