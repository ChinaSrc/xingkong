<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$type = isset($_POST[type]) ?$_POST[type] : $_GET[type];
$code = isset($_POST[code]) ?$_POST[code] : $_GET[code];
$modes = isset($_POST[modes]) ?$_POST[modes] : $_GET[modes];
$ordertype = isset($_POST[ordertype]) ?$_POST[ordertype] : $_GET[ordertype];
$ranges = isset($_POST[ranges]) ?$_POST[ranges] : $_GET[ranges];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$perid = isset($_POST[perid]) ?$_POST[perid] : $_GET[perid];
if($perid-1<0){echo "<script>history.back(-1);</script>";exit;}
$u_info_s=getsql::userinfo($perid,"username");
$pername=$u_info_s[username];
$show_body="";
$this_end_time=core_fun::nowtime('t','yes');
$statbegins=str_replace(':','',$config[statbegin]);
if(strlen($statbegins)-4==0){$this_end_time=substr($this_end_time,0,2);}
if($config[statbegin]-$this_end_time>=0){
$b_date=$lastdate;
$e_date=$thisdate;
}else{
$b_date=$thisdate;
$e_date=$nextdate;
}
if($begindate==""){$begindate=$b_date;}
if($enddate==""){$enddate=$e_date;}
if($active=="put"){
$search=" where b.userid=u.userid";
$islowers=getsql::islower($userid,$perid);
if($islowers=="no"){echo "<script>history.back(-1);</script>";exit;}
$t_url=$do_this_url."&flag=yes&active=".$active."&perid=".$perid;
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate." ".$config[statbegin];
$endtime=$enddate." ".$config[statend];
$search.=" and b.creatdate between '$begintime' and '$endtime'";
if($ordertype){
if(strpos($ordertype,'|')){
$new_order=str_replace("|","','",$ordertype);
$new_order="'".$new_order."'";
}else{
$new_order="'".$ordertype."'";
}
$search.=" and (b.cate in($new_order))";
$t_url.="&ordertype=".$ordertype;
}
if($ranges){
$t_url.="&ranges=".$ranges;
if($ranges-6<0){
if($ranges-2==0){
$low_list=getsql::lower($perid,"yes");
}
if($ranges-4==0){
$low_list=getsql::lower($perid,"no");
}
if($ranges-3==0){
$lower_sql = "select userid from ".DB_PREFIX."user where higherid='$perid'";
$lower     = $db->getall($lower_sql);
for ($i=0;$i<count($lower);$i++){
$this_uid=$lower[$i][userid];$low_list[]=$this_uid;
}
}
$u_line=implode("|",$low_list);
$u_list=str_replace("|","','",$u_line);
$search.=" and b.userid in ('".$u_list."')";
}else{
$search.=" and b.userid='$perid'";
}
}
$dblist=" ".DB_PREFIX."user_bank_log as b,".DB_PREFIX."user as u";
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(b.id) FROM $dblist ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();
$game_list_sql		= "SELECT b.*,u.username as pername FROM $dblist $search ORDER BY b.creatdate desc LIMIT $start, $pagesize";
$game_list	= $db->getall($game_list_sql);
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;
}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
;echo ' 
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL;;echo 'js/common.js"></script> 
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'js/rebate.js"></script>  
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL;;echo 'js/SelectDate.js"></script>
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'js/SelectTime.js"></script>
<script type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'zdialog/zdrag.js"></script>
<script type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'js/diags.js"></script>
<script language="javascript" type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'js/window.diags.js"></script>
<link href=';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'style/games.v2010.css rel="stylesheet" type="text/css" />  
<style>body{font-size:12px;background:#ffffff;}</style>
<table width="100%" border="0" cellspacing="1" cellpadding="4" class=\'table_b\' style="font-size:12px;"> 
<form action="';echo $do_this_url;;echo '&flag=yes&perid=';echo $perid;;echo '&modes=';echo $modes;;echo '&active=put" method="post" name="form1" id="form1">
   <tr class=\'table_b_th\'> 
       <th colspan=4 align=left>搜索<font class=\'font_title_1 font_line_2\'>[ ';echo $pername;;echo ' ]</font> 的帐变信息</th>
   </tr> 
   <tr class=\'table_b_tr_a\'>
      <td align=left style="height:35px;line-height:35px;">&nbsp;
		类型：<select name="ordertype" id="ordertype" style="width:100px;">
 		   <option value="">所有类型</option> 
 		   <option value="hig_buy|hig_chase">加入游戏</option>
 		   <option value="hig_rebate|">销售返点</option>
 		   <option value="hig_prize">奖金派送</option>
 		   <option value="hig_chase_back|hig_buy_chase_back|hig_buy_back">撤单返款</option> 
 		   <option value="hig_rebate_back">撤销返点</option>
 		   <option value="hig_prize_back">撤销派奖</option>
 		   <option value="Recharge_to_higherid|Recharge_from_Lowerid|Recharge_to_system|hig_add_admin">充值</option>
 		   <option value="mention_to_higherid|mention_from_Lowerid|mention_to_system">提现</option><option value="hig_add_admin|hig_lost_admin">系统充值</option>
		</select>&nbsp;
		<script>selectSetItem(G(\'ordertype\'),\'';echo $ordertype;;echo '\')</script>
		时间：<input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02"  style="width:70px;"  onClick="SelectDate(this,\'yyyy-MM-dd\')"/>&nbsp;';echo $config[statbegin];;echo '&nbsp;
		至：<input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02"  style="width:70px;"  onClick="SelectDate(this,\'yyyy-MM-dd\')"/>&nbsp;';echo $config[statend];;echo '	  </td>
  </tr> 
  <tr class=\'table_b_tr_a\'> 
      <td align=left style="height:35px;line-height:35px;">&nbsp;
	  用户：<input type="text" name="pername" value="';echo $pername;;echo '" style="width:100px;">&nbsp; 
	  范围：<select id=\'ranges\' name=\'ranges\' style="width:100px;"><OPTION  value="2">全部</OPTION><OPTION value="6">自己</OPTION><OPTION  value="3">直接下级</OPTION><OPTION  value="4">所有下级</OPTION></select><script>selectSetItem(G(\'ranges\'),\'';echo $ranges;;echo '\')</script>  
	  <span style="padding:0px 10px"><input type="submit" name="submit" class="button_10_25_b" value="搜索" />&nbsp;&nbsp;
	   <input type=\'button\' name=\'resubmit\' id=\'resubmit\' value=\'返回\' class=\'button_10_25_b\' onclick="window.location.href=\'';echo SZS_ROOT_URL;;echo 'do.aspx?mod=user&code=list&list=body\'"></span> 
	  </td>
  </tr>   
  <tr class=\'table_b_tr_a\' style=\'display:none\'> 
      <td align=left style="height:35px;line-height:35px;">&nbsp;
	  <input type="hidden" name="lntype" id="lntype" value="">
	  <input type="submit" value="我的充值" class="button_b" onclick="document.getElementById(\'lntype\').value=\'brcz\';" />
	  <input type="submit" value="为下级充值" class="button_b" onclick="document.getElementById(\'lntype\').value=\'xjcz\';" />
	  <input type="submit" value="我的提现" class="button_b" onclick="document.getElementById(\'lntype\').value=\'brtx\';" />
	  <input type="submit" value="下级提现"  class="button_b" onclick="document.getElementById(\'lntype\').value=\'xjtx\';" /> 
	  </td>
  </tr>
</form> 
</table>
 
<table width="100%" border="0" cellspacing="1" cellpadding="4" class=\'table_b\' style="font-size:12px;"> 
    <tr class=\'table_b_th\'>
      <th align="center">帐变编号</th>
      <th align="center" class="line_03">用户名</th>
      <th align="center" class="line_03">时间</th>
      <th align="center" class="line_03">类型</th>
	  <th align="center" class="line_03">收入</th>
	  <th align="center" class="line_03">支出</th>
	  <th align="center" class="line_03">银行余额</th>
	  <th align="center" class="line_03">状态</th>
	  <th align="center" class="line_03">备注</th>
    </tr> 
    ';
if($game_list){
for ($j=0;$j<count($game_list);$j++){
if($game_list[$j][floatid]){
$floatid=$game_list[$j][floatid];
$select_s=" g.period,g.modes,g.playkey,c.CodeTile as code,c.ShowTile as fullname";
$from_s=" ".DB_PREFIX."game_buylist as g,".DB_PREFIX."game_code_list as c";
$game_buy	= array();
$game_buy_sql = "select $select_s from $from_s where g.buyid='$floatid' and c.ListKey=g.list_id";
$game_buy	= $db->fetch_first($game_buy_sql);
if($game_buy){
$list_id=$game_buy[code]."-".$game_buy[fullname];$fullname=$game_buy[fullname];
$period=$game_buy[period];
$playkey=$game_buy[playkey];
$modes=$game_buy[modes];
}
}else{
$list_id="-";$period="-";$playkey="-";$modes="-";$fullname="-";
}
$remarks="-----";$status="--";
if($game_list[$j][remarks]!=""){$remarks=$game_list[$j][remarks];}
if($listnums%2==0){$trbg=" class='table_b_tr_a'";}else{$trbg=" class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg.">";$this_link="";
if(in_array($game_list[$j][cate],$have_link_gp) === true){
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$game_list[$j][floatid];
$this_link=" onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','600','450')\"";
}
if(strlen($game_list[$j][accountid])-8>=0){$accountid=substr($game_list[$j][accountid],0,6)."..";}else{$accountid=$game_list[$j][accountid];}
$show_body.= " <td align='center' title='".$game_list[$j][accountid]."'><a ".$this_link." style='cursor:pointer;'>".$accountid."</a></td>";
$show_body.= " <td>".$game_list[$j][pername]."</td>";
$show_body.= " <td>".substr($game_list[$j][creatdate],5,strlen($game_list[$j][creatdate]))."</td>";
$show_body.= " <td>".hig_log_code($game_list[$j][cate])."</td>";
$secai="";
if(in_array($game_list[$j][cate],$hig_add_money) === true){$secai="add";}else{$secai="lost";}
if($secai=="add"){
$show_body.= "<td align='center'><span style='color:#1CB447'>+<font id='mon_".$listnums."'>".$game_list[$j][moneys]."</font></span></td><td align='center'><span style='color:red'>-<font id='lost_".$listnums."'>0</font></span></td>";
$add_money+=$game_list[$j][moneys];
}elseif($secai=="lost"){
$show_body.= "<td align='center'><span style='color:green'>+<font id='add_".$listnums."'>0</font></span></td><td align='center'><span style='color:red'>-<font id='lost_".$listnums."'>".$game_list[$j][moneys]."</font></span></td>";$lost_money+=$game_list[$j][moneys];
}
$show_body.= " <td><span id='amo_".$listnums."'>".$game_list[$j][hig_amount]."</span></td>";
$show_body.= " <td>".$status."</td>";
$show_body.= " <td>".$remarks."</td>";
$show_body.= "</tr>";
$listnums+=1;
}
$end_money=$add_money-$lost_money;
if($end_money>0){
$show_end_money="<span><b><font id='show_end_money' color='blue'>".$end_money."</font></b></span>";
$show_end_money_td="<span><b><font id='show_end_money_td' color='blue'>".$end_money."</font></b></span>";
}else{
$show_end_money="<span><b><font id='show_end_money' color='Red'>".$end_money."</font></b></span>";
$show_end_money_td="<span><b><font id='show_end_money_td' color='Red'>".$end_money."</font></b></span>";
}
$show_body.= "<input id='listnums' name='listnums' value='".$listnums."' style='display:none'>";
}else{
$show_body.= "<tr height=35 align=center>";
$show_body.= "<td colspan=12>未找到数据，请更改查询条件之后进行查询！</td>";
$show_body.= "</tr>";
}
echo $show_body;
;echo '    <tr class=\'table_b_th\'>
    	<td colspan="4" align="left">&nbsp;&nbsp;&nbsp;&nbsp;小结: 本页变动金额: <span style="font-size:14px; font-weight:bold; color:#FF0000;">';echo $end_money;;echo '</span> </td>
        <td align="center"><font color="#669900"><strong>+';echo $add_money;;echo '</strong></font></td>
        <td align="center"><font color="#FF3300"><strong>-';echo $lost_money;;echo '</strong></font></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
    </tr>
    <tr class=\'table_b_tr_a\'>
	    <td colspan="9" align="right">
	    ';echo $page_list;;echo '	    </td>
    </tr>
  </table>
 
 ';
?>