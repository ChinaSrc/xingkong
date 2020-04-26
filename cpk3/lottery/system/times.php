<?php

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="CQSSC";}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="单注最大倍数设置";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 

<table> <tr>
	       <td colspan="6" bgcolor="#FFFFFF" align=left>
			  <UL id=navlist >
			  ';
$play_code="";
$sqls_C="select ckey,code from game_type where status='0'";
$result2=mysql_query($sqls_C);
while($rows2=mysql_fetch_array($result2)){
if($playkey==$rows2[ckey]){$cur_li="id=active";$cur_a="id=current";$play_code=$rows2[code];}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='".ROOT_URL."/".$AdminPath."/?controller=system&action=times&playkey=".$rows2[ckey]."'>".$rows2[ckey]."</A></LI>";
}
;echo '              </UL>
			  <div style=\'margin:5px;color:#666666\'>说明：1、设置的数字为该玩法每个会员每期下注最大倍数。2、0为不限倍。</div>
		   </td>
       </tr>
       <tr height=30>
          <th width="10%" align="center" bgcolor="#FFFFFF">玩法类别</th>
          <th width="20%" align="center" bgcolor="#FFFFFF">玩法组</th>
       
          <th width="20%" align="center" bgcolor="#FFFFFF">最大倍数(1700模式)</th>   
          <th width="20%" align="center" bgcolor="#FFFFFF">最大倍数(1800模式)</th>  
          <th width="20%" align="center" bgcolor="#FFFFFF">最大倍数(1900模式)</th>
          <th width="10%" align="center" bgcolor="#FFFFFF">状态</th>
       </tr>
	   <tr align=center bgcolor="#FFFFFF" height="30"> 
            <td colspan=2>&nbsp;</td> 
            <td >
			  <FONT color=\'red\'>统一设置：</font> <span id=\'edit_1700\'><input id=\'item_1700\' value=\'\' style=\'width:50px;\'></span>
		      <span id=\'save_1700\' style=\'display:none;width:60px;text-align:left\'>保存中...</span> 
		      <span class=\'mouse_show\' onclick="Save_Item(\'all\',\'1700\',\'Times\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
		    </td>
			</td>
            <td>
			  <FONT color=\'red\'>统一设置：</font> <span id=\'edit_1800\'><input id=\'item_1800\' value=\'\' style=\'width:60px;\'></span>
		      <span id=\'save_1800\' style=\'display:none;width:60px;text-align:left\'>保存中...</span> 
		      <span class=\'mouse_show\' onclick="Save_Item(\'all\',\'1800\',\'Times\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
			</td>
            <td>
			  <FONT color=\'red\'>统一设置：</font> <span id=\'edit_1900\'><input id=\'item_1900\' value=\'\' style=\'width:60px;\'></span>
		      <span id=\'save_1900\' style=\'display:none;width:60px;text-align:left\'>保存中...</span> 
		      <span class=\'mouse_show\' onclick="Save_Item(\'all\',\'1900\',\'Times\')" style=\'color:0000FF;text-decoration:underline;\'>保存</span> 
			</td>
            <td >&nbsp;</td>
        </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
if($playkey){
$play_code=str_replace("|","','",$play_code);
mysql_query("set names utf8;");
$sqls_C="select fullname,ckey from game_code where ckey in ('$play_code')";
$result6=mysql_query($sqls_C);
$num6=mysql_num_rows($result6);
if($num6){
while($rows6=mysql_fetch_array($result6)){
$ckeys=$rows6[ckey];
$code_name=$rows6[fullname];
echo "<tr height='25' style='background:#FFFFFF' align=center>";
$sqls_D="select game_code_list.ShowTile,game_code_list.CodeTile,game_code_list.ListKey from game_code_list where CodeKey='$ckeys'";
$result7=mysql_query($sqls_D);
$num7=mysql_num_rows($result7);$thisid=0;
echo "<tr height='25' style='background:#FFFFFF' align=center>";
echo "<td height='25' rowspan='".$num7."'>".$code_name.$t_title."</td>";
while($rows2=mysql_fetch_array($result7)){
$sqls_f="select Times_1700,Times_1800,Times_1900 from game_set where playkey='$playkey' and ckey='$rows2[ListKey]'";
$result3=mysql_query($sqls_f);
$rows3=mysql_fetch_array($result3);
echo "   <td style='background:#FFFFFF'>".$rows2[CodeTile]."-".$rows2[ShowTile]."</div></td>";
echo "   <td style='background:#FFFFFF'>1700：<span id='edit_1700_".$rows2[ListKey]."'><input id='item_1700_".$rows2[ListKey]."' value='".$rows3[Times_1700]."' style='width:60px;'></span>";
echo "   <span id='save_1700_".$rows2[ListKey]."' style='display:none;width:60px;text-align:left'>保存中...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Item('".$rows2[ListKey]."','1700','Times')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
echo "   <td style='background:#FFFFFF'>1800：<span id='edit_1800_".$rows2[ListKey]."'><input id='item_1800_".$rows2[ListKey]."' value='".$rows3[Times_1800]."' style='width:60px;'></span>";
echo "   <span id='save_1800_".$rows2[ListKey]."' style='display:none;width:60px;text-align:left'>保存中...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Item('".$rows2[ListKey]."','1800','Times')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
echo "   <td style='background:#FFFFFF'>1900：<span id='edit_1900_".$rows2[ListKey]."'><input id='item_1900_".$rows2[ListKey]."' value='".$rows3[Times_1900]."' style='width:60px;'></span>";
echo "   <span id='save_1900_".$rows2[ListKey]."' style='display:none;width:60px;text-align:left'>保存中...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Item('".$rows2[ListKey]."','1900','Times')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";
if($rows2[status]-1==-1){$status="启用";}else{$status="停用";}
echo "   <td style='background:#FFFFFF'>".$status."</td>";
echo "</tr>";
$flowid+=1;$thisid+=1;
if($id_list==""){$id_list=$rows2[ListKey];}else{$id_list=$id_list."|".$rows2[ListKey];}
}
}
}
}else{
}
;echo ' 
	   <input id=\'input_num\' value=\'';echo $flowid;;echo '\' style=\'display:none\'>
	   <input id=\'playkey\' value=\'';echo $playkey;;echo '\' style=\'display:none\'>
	   <input id=\'input_list\' value=\'';echo $id_list;;echo '\' style=\'display:none\'>
	  </form>
  </table>
      
        <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>