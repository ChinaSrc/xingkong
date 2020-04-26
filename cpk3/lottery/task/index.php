<?php

$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="添加记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY> 

<tr>
<td height="22" colspan="2" align="center" >开奖刷新地址:  <a href="';echo ROOT_URL."/";echo '/lot_new/index.aspx" target="_blank">';echo ROOT_URL."/".$AdminPath;;echo '/lot_new/index.aspx</a> </td>
    </tr>  </form>

';$body_top_title="任务管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0 style=\'display:none\'>
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3><table> <tr>
	      <th width="5%" bgcolor="#FFFFFF">Id</th>
          <th width="23%" bgcolor="#FFFFFF">任务标题</th> 
          <th width="12%" bgcolor="#FFFFFF">游戏</th>
          <th width="12%" bgcolor="#FFFFFF">间隔时间</th>   
          <th bgcolor="#FFFFFF">起始时间</th>
          <th bgcolor="#FFFFFF">最后运行</th>
          <th width="7%" bgcolor="#FFFFFF">操作</th> 
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
$sql_id="select * from game_time_code";
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$rows3[id]."</td>";
echo "<td>".$rows3[title]."</td>";
echo "<td>".$rows3[playkey]."</td>";
echo "<td>".$rows3[gapTime]."</td>";
echo "<td>".$rows3[beginTime]."-".$rows3[endTime]."</td>";
echo "<td>".$rows3[lastRun]."</td>";
echo "<td>删除</td>";
}
;echo '	  </form>
  </table>
      
        <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>