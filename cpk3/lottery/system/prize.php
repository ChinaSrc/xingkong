<?php

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="CQSSC";}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="奖金设置";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
<table> <tr>
	       <td colspan="6" bgcolor="#FFFFFF" align=left>
	       
	       <form action="index.aspx" method="get" id="form22">
	       <input type="hidden" name="controller" value="'.$_GET[controller].'">
	       	       <input type="hidden" name="action" value="'.$_GET[action].'">
			  <UL id=navlist >
			  彩票种类：
			  <select name="playkey" onchange="	document.getElementById(\'form22\').submit();">
			  ';
$sql_id="select * from game_type where status='0'";
$results_id=mysql_query($sql_id);
while($rows_id=mysql_fetch_array($results_id)){
if($playkey==$rows_id[ckey]){$cur_li="selected"; $name=$rows_id[fullname];$play_code=$rows_id[code];}else{$cur_li="";}
echo "<option ".$cur_li."  value='".$rows_id[ckey]."'>".$rows_id[fullname]."</option>";
}
;echo ' </select>
              </UL>
            </form>  

			  <div style=\'margin:5px;color:0000FF\'><b>当前是：';echo $name;;echo '</b></div>
		   </td>
       </tr>
       <tr height=30>
          <th width="10%" align="center" bgcolor="#FFFFFF">玩法类别</th>
          <th width="20%" align="center" bgcolor="#FFFFFF">玩法组</th>
       
          <th width="20%" align="center" bgcolor="#FFFFFF">奖金</th>   
   
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

$sqls_D="select game_code_list.ShowTile,game_code_list.CodeTile,game_code_list.ListKey from game_code_list where CodeKey='$ckeys'";
$result7=mysql_query($sqls_D);
$num7=mysql_num_rows($result7);$thisid=0;
if($num7){
	echo "<tr style='background:#FFFFFF' align=center  height='30px'>";
if($code_name=="趣味"){
$t_title="<div style='color:red'>趣味玩法的奖金包含二等奖的，请按照“一等奖金|二等奖金，如:130|60”的格式进行修改</div>";
}else{
$t_title="";
}
echo "<td height='25' rowspan='".$num7."'>".$code_name.$t_title."</td>";
while($rows2=mysql_fetch_array($result7)){
$this_key=$rows2[ListKey];
$sql_id="select * from game_set WHERE playkey='$playkey' and ckey='$this_key'";
$result3=mysql_query($sql_id);
$rows3=mysql_fetch_array($result3);
if($rows2[CodeTile]!=""){$show_titles=$rows2[CodeTile]."-".$rows2[ShowTile];}else{$show_titles=$rows2[ShowTile];}
echo "   <td style='background:#FFFFFF;text-align:center;'>".$show_titles." </td>";
echo "   <td style='background:#FFFFFF;text-align:center;'><span id='edit_".$rows2[ListKey]."'><input id='item_".$rows2[ListKey]."' value='".$rows3[prize]."' style='width:250px;'></span>";
echo "   <span id='save_".$rows2[ListKey]."' style='display:none;width:60px;text-align:left'>保存中...</span>";
echo "   <span class='mouse_show' onclick=\"Save_Item1('".$rows2[ListKey]."','prize')\" style='color:0000FF;text-decoration:underline;'>保存</span>";
echo "   </td>";

if($rows2[status]-1==-1){$status="启用";}else{$status="停用";}
//echo "   <td style='background:#FFFFFF;text-align:center;' >".$status."</td>";
echo "</tr>";
$flowid+=1;$thisid+=1;
if($id_list==""){$id_list=$rows2[ListKey];}else{$id_list=$id_list."|".$rows2[ListKey];}
}
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