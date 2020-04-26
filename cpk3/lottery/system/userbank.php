<?php

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="提现方式设置";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3><table> <tr>
          <th width="5%" align="center" bgcolor="#FFFFFF">Id</th>
          <th width="10%" align="center" bgcolor="#FFFFFF">提现方式</th> 
          <th width="10%" align="center" bgcolor="#FFFFFF">是否开通</th>  
          <th width="30%" align="center" bgcolor="#FFFFFF">网银地址</th>
          <th width="30%" align="center" bgcolor="#FFFFFF">图标</th>
          <th width="5%" align="center" bgcolor="#FFFFFF">排序</th>  
       </tr>
     <form method="post" name="form" id="form" action="';echo ROOT_URL."/".$AdminPath."/?action=save_post&active=system_bank_list&flag=yes";;echo '" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
$sql_id="select * from system_bank_list";
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$rows3[id]."<input name='id[]' type='hidden' value='".$rows3[id]."'></td>";
echo "<td>".$rows3[bankName]."</td>";
$yescheck="";$nocheck="";
if($rows3[status]-1<0){$yescheck="selected";$nocheck="";}else{$yescheck="";$nocheck="selected";}
echo "<td><select name='status[]'><option value=1 ".$nocheck.">否<OPTION value=0 ".$yescheck.">是</OPTION></select></td>";
echo "<td><input name='bankurl[]' type='text' value='".$rows3[bankurl]."' size='50'></td>";
echo "<td><input name='images[]' type='text' value='".$rows3[images]."' size='50'></td>";
echo "<td><input name='SortNum[]' type='text' value='".$rows3[SortNum]."' size='3' maxlength='3' style='text-align:center'></td>";
}
;echo '	   <tr bgcolor="#FFFFFF"><td>&nbsp;</td>
       <td colspan=\'6\'><input type="submit"  class="button" name="submit" value="提交" onclick="winPop({title:\'\',width:\'400\',drag:\'true\',height:\'100\',form:\'form\'})">
	   &nbsp;&nbsp;
	   </td>
	   </tr>
        
	  </form>
  </table>
      
        <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>