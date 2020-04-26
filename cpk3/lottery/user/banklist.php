<?php

$add_file=$thispath."_add";
$t_url="?controller=user&action=banklist";
$banknum=$_GET['banknum'];
$pername=$_GET['pername'];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;}
if($banknum!=""){$search.=" and user_bank_list.banknum='$banknum'";$t_url.="&banknum=".$banknum;}
;echo ' 
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 

 <form name="form1" id="form1" method="get" action="./?controller=user&action=banklist">
  <input name="controller" type="hidden" value="user" />
  <input name="action" type="hidden" value="banklist" />
 <tr align=left>
    <td width="20%" align="right">&nbsp;用户名:</td>
    <td width="80%" height="18">
      <input name="pername"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" />&nbsp;</td>
 </tr>
 <tr align=left>
   <td align="right">卡号:</td>
   <td height="19"><input name="banknum" type="text" class="input" id="banknum" value="';echo $banknum;;echo '" size="30" maxlength="30" /></td>
 </tr>
 <tr align=left>
   <td  align="right">&nbsp;</td>
   <td height="40"><input type="submit"  class="button" name="submit" value="搜索" /></td>
 </tr></form>

';$body_top_title="卡号管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<table width="100%" border="0" cellpadding="4" cellspacing="1"> 
       <tr height=30>
           
          <th width="6%" bgcolor="#FFFFFF">用户名</th>
          <th width="10%" bgcolor="#FFFFFF">户名</th>
  
		  <th width="12%" bgcolor="#FFFFFF">银行</th>  
          <th width="20%" bgcolor="#FFFFFF">卡号</th>
         <th bgcolor="#FFFFFF">状态</th>
          <th width="16%" bgcolor="#FFFFFF">时间</th>
          <th width="12%" bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" />  
       <input name="ThisId" id="ThisId" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr align=left style=\'display:none\'>
          <td colspan="8" bgcolor="#FFFFFF"> 
		  &nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'600\',drag:\'true\',height:\'200\',url:\'';echo $add_file;;echo '&active=new\'})" value=\'添加记录\' disabled>&nbsp;
		  </td>
       </tr> 
	   ';
mysql_query("set names utf8;");
$sql_p="SELECT user_bank_list.*,user.username FROM user_bank_list,user where user_bank_list.userid=user.userid $search limit $starnum,$maxnum";
$result_p=mysql_query($sql_p);
while($rows3=mysql_fetch_array($result_p)){
    $user=get_user_info($rows3['userid']);
    if($user['virtual']==1)  $class ="class='virtual'";else $class='';
echo "<tr id='' height='20' align='center' {$class}>";
echo "<td >".$rows3[username]."</td>";
echo "<td >".$rows3[realname]."</td>";

echo "<td >".$rows3[bankname]."</td>";
echo "<td >".$rows3[banknum]."</td>";
    if($rows3[status]=="1"){
        $do_s="movelock";
        echo "<td style='color:red'>锁定</td>";
    }else{
        $do_s="lock";
        echo "<td >正常</td>";
    }
echo "<td >".$rows3[creatdate]."</td>";
echo "<td ><span id='Do_status_".$rows3[id]."'>";

echo "</span><span style='display:none'><input id='LastStatus_".$rows3[id]."' value='".$do_s."'></span>";
echo "		<a  class='mouse_show link_01' onclick=\"winPop({title:'修改银行卡',form:'Form1',width:'600',height:'400',url:'?controller=user&action=bank_edit&id={$rows3['id']}'});\">编辑</a>&nbsp;";
echo "&nbsp;&nbsp;<a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=user_bank_list&id=".$rows3[id]."'})\">删除</a>";
echo "</td></tr>";
}
;echo ' 

	  </form>
  </table>
  <script>
  function Lock(item,uid){ 
	  G("Do_status_"+uid).innerHTML="保存中"
	  G("ThisId").value=uid;
	  var values="0";
	  if(item=="lock"){values="0"} if(item=="movelock"){values="1"}
	  SaveItemValue("user_bank_list",uid,"status",values,"SucFun()","FailFun()")
  }
  function SucFun(){
	  var uid=G("ThisId").value;
	  G("Do_status_"+uid).innerHTML="保存成功"
	  var LastStatus=G("LastStatus_"+uid).value
	  var ThisId=G("ThisId").value
	  if(LastStatus=="movelock"){
		  G("Do_status_"+uid).innerHTML="<span type=\'Button\' onclick=\\"Lock(\'movelock\',\'"+ThisId+"\')\\" class=\'link_01\'>解锁</span>"
		  G("LastStatus_"+uid).value="lock"
	  }else{
		  G("Do_status_"+uid).innerHTML="<span type=\'Button\' onclick=\\"Lock(\'lock\',\'"+ThisId+"\')\\" style=\'color:red\' class=\'link_01\'>锁定</span>"
		  G("LastStatus_"+uid).value="movelock"
	  } 
  }
  function FailFun(){
	  var uid=G("ThisId").value;
	  G("Do_status_"+uid).innerHTML="保存失败"
  }
  
  </script>
   <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	';
$sql_m="SELECT user_bank_list.*,user.username FROM user_bank_list,user where user_bank_list.userid=user.userid $search";
$result_m=mysql_query($sql_m);
$nums4=mysql_num_rows($result_m);
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