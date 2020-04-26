<?php
 
$uid = $_GET[uid];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
include(SZS_ROOT_PATH."source/config/play/system.php");
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$search="v.userid=k.userid";
$dbname=" ".DB_PREFIX."user as v,".DB_PREFIX."user_bank as k";
if($pername){
if($pername){
$uid=getsql::userids($pername);
if($uid-$userid==0){
}else{
$islowers=getsql::islower($userid,$uid);
if($islowers=="no"){echo "<script>history.back(-1);</script>";exit;}
}
}else{
$uid=$_SESSION["userid"];
}
}
if($uid){
$t_url.="&uid=".$uid;
}else{
$uid=$userid;
}
$search.=" and (v.higherid='$uid' or v.userid='$uid')";
$minmoney = isset($_POST[minmoney]) ?$_POST[minmoney] : $_GET[minmoney];
if($minmoney){
$search.=" and k.hig_amount>$minmoney";$t_url.="&minmoney=".$minmoney;
}
$maxmoney = isset($_POST[maxmoney]) ?$_POST[maxmoney] : $_GET[maxmoney];
if($maxmoney){
$search.=" and k.hig_amount<$maxmoney";$t_url.="&maxmoney=".$maxmoney;
}
$orders = isset($_POST[orders]) ?$_POST[orders] : $_GET[orders];
if($orders){
if($orders=="moneys"){$orderbys=" order by k.hig_amount+0";}
if($orders=="pername"){$orderbys=" order by v.username";}
if($orders=="regedits"){$orderbys=" order by v.registertime";}
}else{
$orderbys=" order by v.username";
}
$t_url.="&orders=".$orders;
$descs = isset($_POST[descs]) ?$_POST[descs] : $_GET[descs];
if($orders and $descs=="1"){
$orderbys.=" desc ";$t_url.="&descs=".$descs;
}
$isproxys = isset($_POST[isproxys]) ?$_POST[isproxys] : $_GET[isproxys];
if($isproxys){
if($isproxys=="dl"){$search.=" and v.isproxy='0'";$t_url.="&isproxys=".$isproxys;}
if($isproxys=="hy"){$search.=" and v.isproxy='1'";$t_url.="&isproxys=".$isproxys;}
}
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
if($begindate and $enddate){
$search.=" and v.registertime between '$begindate' and '$enddate'";$t_url.="&begindate=".$begindate."&enddate=".$enddate;
}
$countsql	= "SELECT COUNT(v.userid) FROM $dbname where ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$user_list_low		= array();
$user_list_body_sql		= "SELECT v.userid,v.username,v.isproxy,v.registertime,v.reBonus,v.lowuser,k.hig_amount FROM $dbname where  ".$search.$orderbys." LIMIT $start, $pagesize";
$user_list_low	= $db->getall($user_list_body_sql);
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $do_this_url.$t_url;
if($pername){
$url   .= "&pername=$pername&";
}else{
$url   .= "&uid=$uid&";
}
$channel	= "case";
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
include(dirname(__FILE__)."/head.php");
;echo '<body style="background-color:#ffffff">
  <form method="POST" action="';echo $do_url."?mod=".$mod."&code=".$code."&list=".$list;;echo '" name="form1" id="form1">
             <table width="100%" border="0" cellspacing="1" cellpadding="1"  style=\'margin-bottom:5px;\'> 
			     <tr height=25 align="left">
				      <td width=25% align="left">
					     用户名称:&nbsp;<input id=\'pername\' name=\'pername\' value=\'';echo $pername;;echo '\' size=10>
					  </td>
					  <td width=39% align="left">
					     帐户余额:&nbsp;<input id=\'minmoney\' name=\'minmoney\' value=\'';echo $minmoney;;echo '\' size=7>&nbsp;至&nbsp;
					       <input id=\'maxmoney\' name=\'maxmoney\' value=\'';echo $maxmoney;;echo '\' size=7></td>
					  <td width=31% align="left">
					     排序:&nbsp;<select id=\'orders\' name=\'orders\'>
						      <option value=\'pername\'>默认排序</option>
						      <option value=\'pername\'>用户名</option>
							  <option value=\'moneys\'>帐户余额</option>
							  <option value=\'regedits\'>注册时间</option>
						    </select>
							<script>selectSetItem(G(\'orders\'),\'';echo $orders;;echo '\')</script>
							<input type=\'checkbox\' name=\'descs\' id=\'descs\' value=\'1\'>大到小
							<script>chkcheckboxNew(\'descs\',\'';echo $descs;;echo '\')</script>
					  </td>
				 </tr>
				 <tr height=25 align="left">
				      <td width=25% align="left">
					     用户级别:&nbsp;
						  <select id=\'isproxys\' name=\'isproxys\'>
							  <option value=\'\'>所有</option>
						      <option value=\'1\'>代理</option>
						      <option value=\'pername\'>会员</option> 
						  </select>
						  <script>selectSetItem(G(\'isproxys\'),\'';echo $isproxys;;echo '\')</script>
					  </td>
					  <td width=40% align="left">
					     注册时间:&nbsp;<input id=\'begindate\' name=\'begindate\' value=\'';echo $begindate;;echo '\' size=7 onClick="SelectDate(this,\'yyyy-MM-dd\')">&nbsp;至&nbsp;
					       <input id=\'enddate\' name=\'enddate\' value=\'';echo $enddate;;echo '\' size=7 onClick="SelectDate(this,\'yyyy-MM-dd\')"></td>
					  <td width=30% align="left">&nbsp;<input type=\'submit\' id=\'put_button\' name=\'put_button\' value=\'搜索\' class=\'button_a\' ></td>
				 </tr>
			 </table>
             <table width="100%" border="0" cellspacing="1" cellpadding="1"  class=\'table_b\'> 
 	               <tr height="35"  bgcolor="#D87D1B">
 	                 <td align="center" width=15%><b>用户名</b></td>
 	                 <td align="center" widtd=8%><b>所属组</b></td>
  	                 <td align="center" widtd=15%><b>频道余额</b></td>
  	                 <td align="center" widtd=25%><b>注册时间</b></td>
   	                 <td align="center" widtd=37%><b>操作</b></td>
  	               </tr> 
				   ';
for($i=0;$i<count($user_list_low);$i++){
if($i%2==0){
$top_tr="<tr class='table_b_tr_a'>";
$td_bg="";
}else{
$top_tr="<tr class='table_b_tr_b'>";
$td_bg="";
}
$uname=$user_list_low[$i][username];
echo $top_tr."<td ".$td_bg." align='center'>".$uname."</td>";
if($user_list_low[$i][isproxy]=="0"){$this_isproxy="代理";}else{$this_isproxy="会员";}
echo "<td ".$td_bg." align='center'>".$this_isproxy."</td>";
if($user_list_low[$i][hig_amount]){$this_amount=$user_list_low[$i][hig_amount];}else{$this_amount="0";}
echo "<td ".$td_bg." align='center'>".$this_amount."</td>";
echo "<td ".$td_bg." align='center'>".$user_list_low[$i][registertime]."</td>";
echo "<td ".$td_bg." align='center'>";
$is_open_auto="";
if($con_system['AutoModes']=="yes"){
if($user_list_low[$i][reBonus]=="close"){
$is_open_auto="<a onclick=\"winPop({title:'开启[".$uname."]自由模式',ishow:'true',drag:'true',width:'400',height:'120',iclose:'true',url:'".$do_url."?mod=ajax&code=auto&list=do&flag=yes&action=open&perid=".$user_list_low[$i][userid]."'})\" style='cursor: pointer' title='开启会员的自由模式'><font color='red' title='自由模式已关闭，点击可以开启'>自由</font></a>";
}else{
$is_open_auto="<a onclick=\"winPop({title:'关闭".$uname."自由模式',ishow:'true',drag:'true',width:'400',height:'120',iclose:'true',url:'".$do_url."?mod=ajax&code=auto&list=do&flag=yes&action=close&perid=".$user_list_low[$i][userid]."'})\" style='cursor: pointer' title='关闭会员的自由模式'><font color='green' title='自由模式已开启，点击可以关闭'>自由</font></a>";
}
}
if($user_list_low[$i][userid]-$userid>0){
if($con_system['IsChargeForHig']!="no"){
echo "<a href='".SZS_ROOT_URL."?mod=user&code=recharg&perid=".$user_list_low[$i][userid]."' style='cursor: pointer'><font color='#eeb10e'>充值</font></a>&nbsp;";
}
echo "<a onclick=\"winPop({title:'".$uname." 的频道设定',ishow:'true',drag:'true',width:'560',height:'420',iclose:'true',url:'".SZS_ROOT_URL."?mod=safe&code=userset&perid=".$user_list_low[$i][userid]."&widths=560&heights=400'})\" style='cursor: pointer' target='_blank'><font color='#FFFFFF'>详情</font></a>&nbsp;".
"<a  onclick=\"winPop({title:'".$uname." 的团队余额',ishow:'true',drag:'true',width:'420',height:'150',iclose:'true',url:'".SZS_ROOT_URL."?mod=user&code=team&perid=".$user_list_low[$i][userid]."&widths=560&heights=400'})\"  style='cursor: pointer'><font color='#eeb10e'>团队</font></a>&nbsp;".
"<a href='".$do_url."?mod=user&code=rebate&perid=".$user_list_low[$i][userid]."&flag=yes' style='cursor: pointer'><font color='#eeb10e'>返点</font></a>&nbsp;".
$is_open_auto."&nbsp;".
"<a href='".$do_url."?mod=user&code=zb&perid=".$user_list_low[$i][userid]."&flag=yes' style='cursor: pointer'><font color='#eeb10e'>帐变</font></a></span>";
}
echo "</td></tr>";
}
;echo ' 
		    </table>
			<table width="100%" border="0" cellspacing="0" cellpadding="4" bgcolor=\'#111111\' style="border-top:1px dotted #111111;">
 			  <tr height=30>
			       <td width=50% align=left>&nbsp;';echo $page_info;;echo '</td>
			       <td width=50% align=right>';echo $page_list;;echo '&nbsp;</td>
			   </tr>
			</table> 
</form>
</body>
';include(dirname(__FILE__)."/bottom.aspx")
?>