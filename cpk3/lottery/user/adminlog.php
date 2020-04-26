<?php

$t_url="?controller=user&action=adminlog";
$pername=$_GET['pername'];
if($pername!=""){$search.=" and name='$pername'";$t_url.="&pername=".$pername;}
$begindate=strtotime($_GET['begindate']);
$enddate=strtotime($_GET['enddate']);
$IPInfor=$_GET['IPInfor'];
if($IPInfor){
if(strpos($IPInfor,',')){
$str=str_replace(",","','",$IPInfor);
$search.=" and ip in '$str'";
}else{
$search.=" and ip='$IPInfor'";
}
$t_url.="&ip=".$IPInfor;
}
if($begindate!=""){$time=" time>'$begindate'";$t_url.="&begindate=".$_GET['begindate'];}
if($enddate!=""){$time=" time<'$enddate'";$t_url.="&enddate=".$_GET['enddate'];}
if($begindate!=""and $enddate!=""){$time="and user_login_log.creatdate between '$begindate' and '$enddate'";}
if($time!=""){$search.=$time;}
mysql_query("set names utf8;");
;echo '
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

if(!$_GET['userid']){
echo '
<form name="form1" id="form1" method="get" action="./?controller=user&action=adminlog">
  <input name="controller" type="hidden" value="user" />
  <input name="action" type="hidden" value="adminlog" />
 <div class="search_box">&nbsp;账号:&nbsp;<input name="pername" id="pername" class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" /></td>
&nbsp;IP地址:&nbsp;<input name="IPInfor" id="IPInfor" class="input"  type="text" value="';echo $IPInfor;;echo '" size="20" maxlength="80" />



<input type="submit"  class="button" name="submit" value="提交" />
 </div>
 </form>

';

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");}

else $search.=" and uid='{$_GET['userid']}'";
echo '

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0  style="margin-top:5px;">
  <TBODY>
    <TR>

      <TD  align="center" bgColor=#f3f3f3><table> <tr>

          <th bgcolor="#FFFFFF">用户名</th>
          <th bgcolor="#FFFFFF">地址</th>
          <th bgcolor="#FFFFFF">IP</th>
      
		  <th bgcolor="#FFFFFF">内容</th>
		      	  <th bgcolor="#FFFFFF">操作系统</th>
                      <th bgcolor="#FFFFFF">浏览器</th>
                      		  <th bgcolor="#FFFFFF">时间</th>
          <!--<th bgcolor="#FFFFFF">操作</th>-->
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" >
       <input name="flag" type="hidden" value="save" />
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />

	   ';
$sql_p="SELECT * FROM adminlog where 1 $search order by id desc limit $starnum,$maxnum";
$result3=mysql_query($sql_p);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";

echo "<td>".$rows3[name]."</td>";
echo "<td>".$rows3[address]."</td>";
echo "<td>".$rows3[ip]."</td>";
    echo "<td>".$rows3['content']."</td>";
    echo "<td>".$rows3['system']."</td>";
    echo "<td>".$rows3['ie']."</td>";
    echo "<td>".date('Y-m-d H:i:s',$rows3['time'])."</td>";
    //echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=adminlog&id=".$rows3[id]."'})\">删除</a></div></td>";
}
;echo '
	  </form>
  </table>
   <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	';
$sql_m="SELECT * FROM adminlog where 1 $search";
$result_m=mysql_query($sql_m);
$nums4=mysql_num_rows($result_m);
;echo '	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$nums4;
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo '
	    </div>
	</div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>