<?php

$playkey=$_GET['playkey'];
;echo ' 
';$body_top_title="中奖匹配";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<script>
function Put_Lot_begin(){
	var values=G(\'expect\').value;
	winPop({title:\'提示信息\',form:\'Form\',width:\'400\',height:\'200\',iScroll:\'yes\',url:\'';echo ROOT_URL."/".$AdminPath;;echo '/?controller=do&action=Pri_Lot_Auto&period=\'+values});
}
</script>
<table> <tr>
	       <td colspan="7" bgcolor="#FFFFFF">
			  
			 
              <div class="form">
              <div><input type="text"  value="';echo $expect;;echo '"  size="12" id="expect" name="expect">
              <input type="submit" name="Submit" class="button" onclick="Put_Lot_begin()"  value="中奖匹配">	  
            </div>              
           </div>
          
		   </td>
       </tr>
       <tr>
          <th width="18%" bgcolor="#FFFFFF">单号</th>
          <th width="10%" bgcolor="#FFFFFF">期号</th> 
          <th width="16%" bgcolor="#FFFFFF">投注号码</th>   
          <th width="15%" bgcolor="#FFFFFF">游戏类型</th>
          <th width="10%" bgcolor="#FFFFFF">倍数</th>
          <th width="12%" bgcolor="#FFFFFF">开奖号码</th>  
          <th width="10%" bgcolor="#FFFFFF">中奖注数</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
$pages=$_GET[pages];
if (!$pages or $pages==0){
$pages=1;
}
$maxnum=20;
$starnum=$pages*$maxnum-$maxnum;
mysql_query("set names utf8;");
$sql3="select buyid,playkey,number,period,times from game_buylist where status='0' and is_succeed='yes' order by prize_time limit $starnum,$maxnum";
$result3=mysql_query($sql3);
$result2 = mysql_query("select count(buyid) from game_buylist where status='0' and is_succeed='yes'") or die("未能读取，请刷新");
$num3=mysql_num_rows($result3);
if($num3){
while($rows3=mysql_fetch_array($result3)){
if($rows3[playkey]=="3D"or $rows3[playkey]=="P5(P3)"){
$SerialDate=substr($rows3[period],0,4);
$SerialID=substr($rows3[period],4,10);
}else{
$SerialDate=substr($rows3[period],0,8);
$SerialID=substr($rows3[period],8,10);
}
$sql4="select Number from game_lottery where SerialDate='$SerialDate' and SerialID='$SerialID' and playKey='$rows3[playkey]'";
$result4=mysql_query($sql4);
$rows4=mysql_fetch_array($result4);
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$rows3[buyid]."</td>";
echo "<td>".$rows3[period]."</td>";
if(strlen($rows3[number])-20>=0){$show_num=CutStr($rows3[number],0,20,true);}else{$show_num=$rows3[number];}
echo "<td title='".$rows3[number]."'><div style='width:220px;'>".$show_num."</div></td>";
echo "<td>".$rows3[playkey]."</td>";
echo "<td>".$rows3[times]."</td>";
echo "<td>".$rows4[Number]."</td>";
echo "<td>".$rows3[prizenum]."</td></tr>";
}
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan='7'>未找到数据</td></tr>";
}
;echo ' 
	   
	  </form>
  </table>
      
        <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$rows2=mysql_fetch_row($result2);
$allnum=$rows2[0];
$pageurl=$thispath;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>