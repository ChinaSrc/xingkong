<?php

if($_GET['playkey']==""){$_GET['playkey']="CQSSC";}
$playkey=$_GET['playkey'];

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
$sql_id="select * from game_time where playkey='$playkey' order by lotNum";
$results_id=mysql_query($sql_id);
$nums4=mysql_num_rows($results_id);

;echo '  


      
      <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#fff">
	    <tr>
	       <td  bgcolor="#FFFFFF" style="text-align: left" >
	       <form action="index.aspx" method="get" id="form22">
	       <input type="hidden" name="controller" value="'.$_GET[controller].'">
	       	       <input type="hidden" name="action" value="'.$_GET[action].'">
		
			  彩票种类：
			  <select name="playkey" onchange="	document.getElementById(\'form22\').submit();">
			  ';
echo set_game_select('playkey');
echo ' </select>
             &nbsp; 全天共'.$nums4.'期
            </form>  
            </td>
            <td  bgcolor="#FFFFFF" style="text-align: left" >
            
                 <form method="POST" name="form" id="form" action="';echo ROOT_URL."/".$AdminPath;;echo '/?action=save_post&flag=yes&active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
  
         &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  class="button" name="submit" value="保存" onclick="winPop({title:\'\',width:\'400\',height:\'100\',form:\'form\'})">&nbsp;&nbsp;&nbsp;
		  &nbsp;<input type="button" class=\'button\' onclick="show_set(\'begin\');" value=\'批量设置游戏时间\'>&nbsp;
&nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'批量增减时间设置\'+title,width:\'400\',drag:\'true\',height:\'250\',url:\'index.aspx?controller=lottery&action=gametime_update&playkey='.$playkey.'\'});" value=\'批量增减时间\'>&nbsp;
	
		
  
		   </td>
       </tr>
       </table>
             <table> <tr>
          <th align="center" bgcolor="#FFFFFF">彩种</th>
             <th  align="center" bgcolor="#FFFFFF">期号</th>
          <th  align="center" bgcolor="#FFFFFF">起始时间</th>
       
          <th  align="center" bgcolor="#FFFFFF">封单时间</th>   
          <th  align="center" bgcolor="#FFFFFF">开奖时间</th>  
       
          <th align="center" bgcolor="#FFFFFF">操作</th>
       </tr>


	   ';
if($playkey){
	
	
    	$ssc=$db->fetch_first("select * from game_type where `ckey`='{$playkey}'");
	$page=$_GET['page'];
	if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
$sql_id="select * from game_time where playkey='$playkey' order by lotNum   limit $starnum,$maxnum ";
$results_id=mysql_query($sql_id);
$MaxNum=0;
while($rows3=mysql_fetch_array($results_id)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;".$ssc[fullname]."  <input name='id[]' type='hidden' value='".$rows3[id]."' /> </td>";
echo "<td><input style='padding-left:14px' id='num_".$MaxNum."' name='lotNum[]' type='text' value='".$rows3[lotNum]."'  size='7' maxlength='5' /></td>";
echo "<td><input style='padding-left:14px' id='begin_".$MaxNum."' name='begintime[]' type='text' value='".$rows3[beginTime]."' size='12' maxlength='8' /></td>";
echo "<td><input style='padding-left:14px' id='end_".$MaxNum."' name='endtime[]' type='text'  value='".$rows3[endTime]."'  size='12' maxlength='8'/></td>";
echo "<td><input style='padding-left:14px' id='lot_".$MaxNum."' name='lotTime[]' type='text' value='".$rows3[lotTime]."'  size='12' maxlength='8'/></td>";

echo "<td><div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'130',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&dbname=game_time&id=".$rows3[id]."'})\">删除</a></div></td></tr>";
$MaxNum+=1;
}
}
echo "<input id='MaxNum' name='MaxNum' value='".$MaxNum."' style='display:none'>";
;echo ' 
     

  </table>
      
       <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	';

;echo '	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$nums4;
$pageurl=$thispath;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div> 
	</div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");;echo '<script>
function show_set(item){ 
	if(item=="begin"){var title="开始时间"}
	if(item=="end"){var title="结束时间"}
	if(item=="lot"){var title="开奖时间"}
	winPop({title:\'批量设置\'+title,width:\'500\',drag:\'true\',height:\'400\',url:\'dialog_lotTime.aspx?key='.$playkey.'\'})
}
</script>
 ';
?>