<?php

$active=$_GET['active'];
$playkey=$_GET['playkey'];
$search="  user.userid=user_gifts.userid";
$begindate_get=$_GET['begindate'];
$enddate_get=$_GET['enddate'];
if($begindate_get==""){$begindate=$nowdate;}else{$begindate=$begindate_get;}
if($enddate_get==""){$enddate=$nextdate;}else{$enddate=$enddate_get;}
$t_url="?controller=user&action=gifts";
$db_s="user_bank_log";
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate.$Add_Time;
$endtime=$enddate.$Add_Time;
$search.=" and user_gifts.creatdate between '$begintime' and '$endtime'";
$pername=$_GET[pername];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;}
;echo ' 
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD bgColor=#f3f3f3 valign=top><table width="100%" border="0" cellpadding="0" cellspacing="1" valign=top> 
      <form name="form1" id="form1" method="GET" action="" > 
          <input name="controller" id="controller" type="text" value="user" style=\'display:none\'> 
          <input name="action" id="action" type="text" value="gifts" style=\'display:none\'>  
    <tr height=30>
      <td width="25%" align="right">&nbsp;用户名:</td>
      <td width="75%" align="left">
      <input name="pername"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" /></td>
    </tr>
     <tr> 
             <td align="right" >&nbsp;起始日期:</td>
             <td align="left"> <input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '            至：<input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '  </td>
          </tr>
   <tr>
   <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
   <tr height=35>
    <td><input id=\'playkey\' value=\'';echo $playkey;;echo '\' style=\'display:none\'></td>
    <td align="left"><input type="submit"  class="button" name="submit" value="提交" /></td>
   </tr></form>
  
';$body_top_title="申领购彩金";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD bgColor=#f3f3f3 valign=top>
	  <div style=\'margin:10px 20px;text-algin:left;line-height:20px;\'>
	     提示：系统默认领取[购彩金]数额，以及是否对会员启用该功能，请在[全局设置]中进行设置 
	  </div>
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#DDDDDD" valign=top> 
       <tr height=35> 
          <th width="8%">用户名</th>
		  <th width="10%">提交时间</th> 
		  <th width="10%">处理时间</th>  
          <th width="8%">领取类别</th> 
          <th width="10%">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" />  
	   ';
mysql_query("set names utf8;");
$sql3="select user_gifts.*,user.username from user_gifts,user where $search order by user_gifts.status,user_gifts.creatdate desc limit $starnum,$maxnum";
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
$result9 = mysql_query("select count(user_gifts.id) from user_gifts,user where  $search") or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9);
if($nums3){
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
$pername=$rows3[username];$perid=$rows3[userid];$uid=$rows3[id];$cate=$rows3[userCate];$show_more="";
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$pername."</td>";
echo "<td>&nbsp;".$rows3[creatdate]."</td>";
echo "<td>&nbsp;".$rows3[giftsDate]."</td>";
if($rows3[userCate]=="new"){$user_cate="新用户领取";}
if($rows3[userCate]=="old"){$user_cate="老用户领取";}
if($rows3[userCate]=="recharge"){$user_cate="充值500以上";}
echo "<td>".$user_cate."</td>";
if($rows3[status]=="0"){
$status= "  <a onclick=\"winPop({title:'处理信息',form:'Form1',width:'300',drag:'true',height:'160',url:'".ROOT_URL."/".$AdminPath."/?action=edit_dialog&active=gifts&doto=edit&keys=agree&pername=".$pername."&perid=".$perid."&uid=".$uid."&cate=".$cate."'})\"><font class='link_01'>处理</font></a>&nbsp;";
$status.= "  <a onclick=\"winPop({title:'拒绝信息',form:'Form1',width:'300',drag:'true',height:'160',url:'".ROOT_URL."/".$AdminPath."/?action=edit_dialog&active=gifts&doto=edit&keys=refuse&pername=".$pername."&perid=".$perid."&uid=".$uid."&cate=".$cate."'})\"><font class='link_01'>拒绝</font></a>";
}
if($rows3[status]=="1"){$status="<font style='color:green'>已处理</font>";}
if($rows3[status]=="4"){$status="<font style='color:red'>已拒绝</font>";}
echo "<td>".$show_more.$status."</td>";
$listnum+=1;
}
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=5><font color='#999999'>未找到记录</font></td></tr>";
}
$strSql="update user_pupop set status='1' where userid='1' and status='0'";
$db->query($strSql);
;echo ' 
	  </form>
	  <input id=\'listnums\' value=\'';echo $listnum;;echo '\' type=\'hidden\'>
	  
<script> show_moneys(G(\'listnums\').value,"mon") </script>
  </table>
  <div>     
        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	
	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$rows9[0];
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>