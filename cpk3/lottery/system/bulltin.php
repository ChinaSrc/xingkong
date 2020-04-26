<?php

$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="0";}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
$clists=array('公告列表','银行大厅','低频游戏','低频代理','高频游戏');
;echo ' 
';$body_top_title="公告管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
  
      
      <TD  align="center" bgColor=#f3f3f3><table> <tr align=left>
	 <td colspan="6" bgcolor="#FFFFFF"> 
			  <UL id=navlist >
			  ';
for ($i=0;$i<count($clists);$i++){
if($playkey-$i==0){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='".ROOT_URL."/".$AdminPath."/?controller=system&action=bulltin&playkey=".$i."'>".$clists[$i]."</A></LI>";
}
;echo ' 
              </UL>
		   </td>
       </tr>
      <TR> 
       <tr>
          <th width="6%" align="center" bgcolor="#FFFFFF">Id</th>
          <th width="35%" align="center" bgcolor="#FFFFFF">标题</th> 
          <th width="10%" align="center" bgcolor="#FFFFFF">频道</th>   
          <th width="20%" align="center" bgcolor="#FFFFFF">发布时间</th>  
          <th width="10%" align="center" bgcolor="#FFFFFF">操作</th> 
          <th width="10%" align="center" bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=bulltin" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr align=left>
          <td colspan="6" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;
		  &nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'700\',drag:\'true\',height:\'500\',url:\'';echo ROOT_URL."/".$AdminPath;;echo '/?controller=system&action=bulltin_add&;?>&active=new\'})" value=\'添加新公告\'>&nbsp;
		  </td>
       </tr> 
	   ';
if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
if($playkey-1>=0){$wheres=" channel='".$playkey."'";}else{$wheres="";}
$sql_id="select * from bulletin order by creatdate desc limit $starnum,$maxnum";
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;".$rows3[id]."</td>";
echo "<td>".$rows3[title]."</td>";
if($rows3[channel]-1<0){$channel="所有";}
if($rows3[channel]-1==0){$channel="银行";}
if($rows3[channel]-2==0){$channel="高频";}
if($rows3[channel]-3==0){$channel="低频";}
if($rows3[channel]-4==0){$channel="代理";}
echo "<td>".$channel."</td>";
echo "<td>".$rows3[creatdate]."</td>";
echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'',width:'700',drag:'true',height:'500',url:'".$add_file."&id=".$rows3[id]."'})\">修改</a></td>";
echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=bulletin&id=".$rows3[id]."'})\">删除</a></div></td>";
}
;echo ' 
	  </form>
  </table>
      
  <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	';
$sql_id="select * from bulletin";
$result4=mysql_query($sql_id);
$nums4=mysql_num_rows($result4);
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
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>