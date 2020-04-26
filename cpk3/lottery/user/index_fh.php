<?php

header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$isproxy=$_GET['isproxy'];
$role=$_GET['role'];
include($headpaths);
if($isproxy==""){$isproxy="3";}
$t_url="?controller=user&action=index";
$pername=$_GET['pername'];
if($pername!=""){
$t_url.="&pername=".$pername;$isproxy="3";
$sql_default="select userid from user where username='$pername'";
$result_default=mysql_query($sql_default);
$num_default=mysql_num_rows($result_default);
if($num_default){
$rows_default=mysql_fetch_array($result_default);
$this_uid=$rows_default[userid];
}
}
if($isproxy-2<0){$search=" user.isproxy='".$isproxy."'";$t_url.="&isproxy=".$isproxy;}
if($isproxy-2==0){$search=" user.role>5";}
if($isproxy-3==0){$search=" user.isproxy>=0";$t_url.="&isproxy=".$isproxy;}
$begindate=$_GET['begindate'];
$enddate=$_GET['enddate'];
if($begindate!=""){$b_time=$begindate." 00:00:00";$time=" and user.registertime>='$b_time'";$t_url.="&begindate=".$begindate;}
if($enddate!=""){$e_time=$enddate." 23:59:59";$time=" and user.registertime=<'$e_time'";$t_url.="&enddate=".$enddate;}
if($begindate!=""and $enddate!=""){$time=" and user.registertime between '$b_time' and '$e_time'";}
if($time!=""){$search.=$time;}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo '  
<BODY bgColor=#FFFFFF>
 
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="../';echo $curpath;;echo '/images/table_top_r1_c1.gif" width=14></TD>
      <TD background=../';echo $curpath;;echo '/images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>搜索记录</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="../';echo $curpath;;echo '/images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=6 background=../';echo $curpath;;echo '/images/table_center_r1_c1.gif>&nbsp;</TD>
      <TD  align="center" bgColor=#f3f3f3><table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
 <form name="form1" id="form1" method="get" action="./?controller=user&action=index">
  <input name="controller" type="hidden" value="user" />
  <input name="action" type="hidden" value="index" />
  <tr>
    <td align="right">&nbsp;用户名:</td>
    <td align="left">
      <input name="pername" id="pername"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" /></td>
 </tr>
 <tr> 
    <td align="right" >&nbsp;注册日期:</td>
    <td align="left"> <input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/> 
                - 
		 <input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/> 
	</td>
 </tr> 

 <tr>
   <td width="73" align="right">&nbsp;</td>
   <td height="40" align="left"><input type="submit"  class="button" name="submit" value="提交" /></td>
 </tr>
 </form>
</table></TD><TD width=7 
  background=../';echo $curpath;;echo '/images/table_center_r1_c3.gif>&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="../';echo $headpath;;echo '/images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE> 
<br> 

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>会员管理</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<table> <tr>
	       <td colspan="9" bgcolor="#FFFFFF" align=left>
			  <UL id=navlist >
			  ';
$arr=array(0=>"代理",1=>"会员",2=>"管理员",3=>"所有会员");$href="../".$curpath."/?controller=user&action=index".$is_add."&isproxy=";
for ($i=0;$i<count($arr);$i++){
if($isproxy-$i==0){$this_a="id=current";}else{$this_a="";}
echo "<LI id='li_".$i."'><A ".$this_a." href='".$href.$i."'>".$arr[$i]."</A></LI>";
}
;echo '  
              </UL>
			  ';
if($pername==""){$title="［".$arr[$isproxy]."］列表";$linkss="";}else{$title="［".$pername."］的全部下级会员";$linkss="<A href='/".$curpath."/?controller=user&action=index&isproxy=0' class='link_01'>返回</A>";}
echo "以下是：".$title."&nbsp;&nbsp;".$linkss;
;echo '		   </td>
       </tr>
       <tr>
          <th width="5%" bgcolor="#FFFFFF">Id</th>
          <th width="10%" bgcolor="#FFFFFF">用户名</th> 
          <th width="10%" bgcolor="#FFFFFF">用户组</th>
		  <th width="7%" bgcolor="#FFFFFF">上级代理</th>   
          <th width="10%" bgcolor="#FFFFFF">帐户余额</th> 
          <th width="10%" bgcolor="#FFFFFF">开户额</th>
          <th width="10%" bgcolor="#FFFFFF">注册时间</th>  
          <th width="10%" bgcolor="#FFFFFF">状态</th>
		  <th width="30%" bgcolor="#FFFFFF">操作</th>
       </tr>
     
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr style=\'display:none\'>
          <td colspan="8" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'600\',drag:\'true\',height:\'200\',url:\'';echo $add_file;;echo '&active=new\'})" value=\'添加新会员\'>&nbsp; 
		  </td>
       </tr> 
	   ';
if($pername!=""){
$sql_uid="select user_level.userid as uid from user_level where user_level.higherid='$this_uid'";
$result_uid=mysql_query($sql_uid);
while($rows_uid=mysql_fetch_array($result_uid)){
$perlist.="|".$rows_uid[uid];
}
$perlist=$this_uid.str_replace("|","','",$perlist);
$search=" user.userid in('$perlist')";
}
mysql_query("set names utf8;");
$sqls="select user.*,user_bank.amount,user_bank.hig_amount,user_bank.low_amount from user,user_bank where $search and user.userid=user_bank.userid order by user.registertime desc limit $starnum,$maxnum";
$results=mysql_query($sqls);
$result2 = mysql_query("select count(user.userid) from user where $search") or die("未能读取，请刷新");
$rows2=mysql_fetch_row($result2);$listnum=0;
while($rowss=mysql_fetch_array($results)){
if($rowss[amount]==""){$amount="0";}else{$amount=$rowss[amount];}
if($rowss[hig_amount]==""){$hig_amount="0";}else{$hig_amount=$rowss[hig_amount];}
if($rowss[low_amount]==""){$low_amount="0";}else{$low_amount=$rowss[low_amount];}
$addjiah="";
if($rowss[Lowerid]!=""and strlen($rowss[Lowerid])-1>0){
$addjiah="&nbsp;&nbsp;<a title='查看他及他的全部下级会员' href='/".$curpath."/?controller=user&action=index&isproxy=".$isproxy."&pername=".$rowss[username]."'>+</a>";
}
echo "<tr bgcolor='#FFFFFF' align=center height=18>";
echo "<td>".$rowss[userid]."</td>";
echo "<td>".$rowss[username].$addjiah."</td>";
echo "<td>";
if($rowss[isproxy]-1<0){$isproxyer="代理";$this_cur="dail";}else{$isproxyer="用户";$this_cur="user";}
echo "<span id='input_isp_".$rowss[userid]."' style='display:none;'><select id='isproxy_".$rowss[userid]."'><option value='0'>代理</option><option value='1'>会员</option></select></span>";
echo " <span id='show_isp_".$rowss[userid]."'>".$isproxyer."</span>";
echo " <span id='ing_isp_".$rowss[userid]."' style='display:none;'>保存中...</span>";
echo " <span id='edit_isp_".$rowss[userid]."' onclick=\"Edit_User('".$rowss[userid]."','isp','isproxy')\" class='link_01'>改</span>";
echo " <span id='save_isp_".$rowss[userid]."' onclick=\"Save_User('".$rowss[userid]."','isp','isproxy')\" class='link_01' style='display:none;'>存</span>";
echo "</td><script>Show_Money_Div('show_amo_".$rowss[userid]."')</script>";
$sqls_s="select username from user where userid='$rowss[higherid]'";
$result_s=mysql_query($sqls_s);
$rows_s=mysql_fetch_array($result_s);
echo "<td>".$rows_s[username]."</td>";
echo "<td>";
echo "<span id='show_hig_".$rowss[userid]."'>".$hig_amount."</span>";
echo "<span style='display:none' id='show_hig_".$rowss[userid]."_num'>".$hig_amount."</span>";
echo " <span id='edit_amo_".$rowss[userid]."' onclick=\"winPop({title:'输入金额',width:'300',drag:'true',height:'160',url:'edit_body.aspx?active=user_bank&items=hig_amount&userid=".$rowss[userid]."&itemname=show_hig_".$rowss[userid]."&itemtype=innerHTML'})\" class='link_01'>改</span>";
echo " <script>Show_Money_Div('show_hig_".$rowss[userid]."')</script>";
echo "</td>";
echo "<td>";
echo "<span id='show_pro_".$rowss[userid]."'>".$rowss[proxynum]."</span>";
echo "<span id='input_pro_".$rowss[userid]."' style='display:none;'><input id='proxynum_".$rowss[userid]."' value='".$rowss[proxynum]."' style='width:30px;' ></span>";
echo " <span id='ing_pro_".$rowss[userid]."' style='display:none;'>保存中...</span>";
echo " <span id='edit_pro_".$rowss[userid]."' onclick=\"Edit_User('".$rowss[userid]."','pro','proxynum')\" class='link_01'>改</span>";
echo " <span id='save_pro_".$rowss[userid]."' onclick=\"Save_User('".$rowss[userid]."','pro','proxynum')\" class='link_01' style='display:none;'>存</span>";
echo "</td>";
echo "<td>".date( 'Y-m-d',strtotime($rowss[registertime]))."</td>";
if($rowss[status]=="0"){
$status="正常";
$status.= "[<a onclick=\"put_dongjie_user('".$rowss[userid]."','".$rowss[username]."')\"><font class='link_01'>冻结帐号</font></a>]";
}
if($rowss[status]=="1"){
$status="锁定";
$status.= "[<a onclick=\"put_jiedong_user('".$rowss[userid]."','".$rowss[username]."')\"><font class='link_02'>帐号解冻</font></a>]";
}
echo "<td>".$status."</td>";
echo "<td>";
if($username=="admin"and $rowss[username]!="admin"){
if($rowss[role]=="6"){
echo "  <span id='set_manager_span_".$listnum."'><a title='取消管理员' onclick=\"set_user_manager('".$rowss[userid]."','".$rowss[username]."','del','".$listnum."')\"><font class='link_02'>取消管理员</font></a></span>&nbsp;|";
}else{
echo "  <span id='set_manager_span_".$listnum."'><a title='设置管理员' onclick=\"set_user_manager('".$rowss[userid]."','".$rowss[username]."','add','".$listnum."')\"><font class='link_01'>设置管理员</font></a></span>&nbsp;|";
}
echo "  <a  onclick=\"put_get_out('".$rowss[userid]."','".$rowss[username]."')\"><font class='link_01'>强制下线</font></a>&nbsp;|";
}
if($rowss[role]-6>=0){$this_cur="manager";}
echo "  <a onclick=\"winPop({title:'会员信息',form:'Form1',width:'800',height:'500',url:'?controller=user&action=index_add&id=".$rowss[userid]."'})\"><font class='link_01'>编辑</font></a>&nbsp;|";
echo "  <a onclick=\"winPop({title:'会员信息',form:'Form1',width:'800',height:'1100',url:'?controller=system&action=point&pername=".$rowss[username]."'})\"><font class='link_01'>返点</font></a>&nbsp;|";
echo "  <a  onclick=\"put_del_user('".$rowss[userid]."','".$rowss[username]."')\"><font class='link_01'>删除</font></a>";
echo "</td>";
echo "</tr>";
$listnum+=1;
}
if($pername!=""){echo "<input id='search_name_isproxy_role' value='".$this_cur."' style='display:none'>";}
echo "<input id='urls' value='".$href."' style='display:none'>";
;echo ' 
	   
	  <script>
	   
	  function put_del_user(perid,pername){
		  return winPop({title:\'删除会员帐号\',form:\'Form\',width:\'300\',height:\'100\',url:\'dialog_simple.aspx?action=deluser&uid=\'+perid+\'&pername=\'+pername+\'&nexts=reload\'})
	  }
	  function put_dongjie_user(perid,pername){
		  return winPop({title:\'冻结会员帐号\',form:\'Form\',width:\'300\',height:\'100\',url:\'dialog_simple.aspx?action=djuser&uid=\'+perid+\'&pername=\'+pername+\'&nexts=reload\'})
	  } 
	  function put_get_out(perid,pername){
		  return winPop({title:\'强制会员下线\',form:\'Form\',width:\'300\',height:\'150\',url:\'dialog_simple.aspx?action=getout&uid=\'+perid+\'&pername=\'+pername+\'&nexts=reload\'})
	  } 
	  function put_jiedong_user(perid,pername){
		  return winPop({title:\'会员帐号解冻\',form:\'Form\',width:\'300\',height:\'100\',url:\'dialog_simple.aspx?action=jiedong&uid=\'+perid+\'&pername=\'+pername+\'&nexts=reload\'})
	  } 
	  function set_user_manager(perid,pername,keys,listnum){
		  if(keys=="add"){
			  var titles="确定将"+pername+"设置为管理员？";
		  }else{
			  var titles="确定取消"+pername+"的管理员权限？";
		  }
		  var show_dilog= window.confirm(titles);
		  if (show_dilog) {//选了确定
		      G("set_manager_span_"+listnum).innerHTML="正在提交..";
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content=""; //active=="set_manager"
		      ajaxobj.url="save_post.aspx?active=SetManager&perid="+perid+"&keys="+keys; 
		      ajaxobj.callback=function(xmlobj){
				  //var response = xmlobj.responseText;
				  var response = Trim(xmlobj.responseText);
				  window.setTimeout("Show_back_manager(\'"+perid+"\',\'"+pername+"\',\'"+keys+"\',\'"+listnum+"\',\'"+response+"\')",500);
			  }
		      ajaxobj.send()
		  }else{
			  return false;
		  } 
	  }
	  function Show_back_manager(perid,pername,keys,listnum,response){
		  if(response=="yes"){
			  if(keys=="add"){
				  G("set_manager_span_"+listnum).innerHTML="<a title=\'取消管理员\' onclick=\\"set_user_manager(\'"+perid+"\',\'"+pername+"\',\'del\',\'"+listnum+"\')\\"><font class=\'link_02\'>取消管理员</font></a>"
			  }else{
				  G("set_manager_span_"+listnum).innerHTML="<a title=\'设置管理员\' onclick=\\"set_user_manager(\'"+perid+"\',\'"+pername+"\',\'add\',\'"+listnum+"\')\\"><font class=\'link_01\'>设置管理员</font></a>"
			  }
			  
		  }else{
			  G("set_manager_span"+listnum).innerHTML="<a title=\'设置管理员\' onclick=\\"set_user_manager(\'"+perid+"\',\'"+pername+"\',\'add\',\'"+listnum+"\')\\"><font class=\'link_01\'>设置管理员</font></a>"
		  }
	  }
      </script>
  </table>
  <div style=\'margin-left:10px;height:50px;line-height:50px;text-align:left\'>
	';
$result4=selects_sqls("game_Lottery","*",$wheres,"","");
$nums4=mysql_num_rows($result4);
;echo '	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$rows2[0];
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div> 
	</div>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE>

</body> '
?>