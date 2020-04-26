<?php
 
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
$pername=$_GET['username'];
$viewid=$_POST['viewid'];
if($pername==""){
$pername=$_POST['username'];
}
if($playkey==""){$playkey="gp";}
$nowtime=date("Y-m-d H:i:s",time());
$nowdate=date("Y-m-d",time());
$thisdate=date('Y-m-d',strtotime("$d   +1   day"));
$lastdate=date('Y-m-d',strtotime("$d   -3   day"));
if($begin_get!=""){$begindate=$begin_get;}if($begin_post!=""){$begindate=$begin_post;}
if($end_get!=""){$enddate=$end_get;}if($end_post!=""){$enddate=$end_post;}
if($begindate==""){$begindate=$lastdate;}
if($enddate==""){$enddate=$thisdate;}
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate.$Add_Time;
$endtime=$enddate.$Add_Time;
$search.=" and user_bank_log.creatdate between '$begintime' and '$endtime'";
$serch_s=$begintime." 至 ".$endtime;
;echo ' 
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD   bgColor=#f3f3f3><table width="100%" border="0"  cellpadding="3" cellspacing="3">
 <form name="form1" id="form1" method="post" action="?controller=report&action=index">
 <tr>
    <td width="20%" align="right">&nbsp;用户名:</td>
    <td width="80%">
      <input name="username"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" ></td>
 </tr>
 <tr> 
   <td align="right" >&nbsp;选择日期:</td>
   <td >  <input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '   至：<input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo ' 
	</td>
 </tr>
 <tr>
   <td align="right" >&nbsp;查看方式:</td>
   <td><select name="viewid">
   
<option value=0 selected>查看直接下级</option>

<OPTION value=1>查看全部下级</OPTION>
</select></td>
 </tr> <script>selectSetItem(G(\'viewid\'),\'';echo $viewid;;echo '\')</script>
 <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit"  class="button" name="submit" value="提交" /></td>
  </tr></form>

';$body_top_title="消费报表";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo '  
<table> <tr height=25><td colspan=7> <div style=\'text-align:left;padding-left:10px;\'>查询日期：';echo $serch_s;;echo '</div></td></tr> 
       <tr height=35>
          <th width="15%" bgcolor="#FFFFFF">用户名</th>  
		  <th width="17%" bgcolor="#FFFFFF">总代购</th>  
          <th width="16%" bgcolor="#FFFFFF">总返点</th>
          <th width="15%" bgcolor="#FFFFFF">实际总代购</th>
          <th width="14%" bgcolor="#FFFFFF">中奖金额</th>
		  <th width="13%" bgcolor="#FFFFFF">总结算</th>
		  <th width="10%" bgcolor="#FFFFFF">操作</th>
       </tr> 
        
 ';
mysql_query("set names utf8;");
if($pername!=""){
$sql_id="select userid from user where username='$pername'";
$results_id=mysql_query($sql_id);
$rows_id=mysql_fetch_array($results_id);
$perid=$rows_id[userid];
}else{
$perid=$userid;
}
if($viewid=="1"){
$perid_list="'".Get_Lowerid($perid)."'";
$search_uid=" userid in($perid_list)";
}else{
$search_uid=" userid='$perid' or higherid='$perid'";
}
$sql2="select userid,username,isproxy from user where $search_uid";
$result2=mysql_query($sql2);$listnums=0;
while($rows2=mysql_fetch_array($result2)){
$uid=$rows2[userid];
$uname=$rows2[username];
$moneys=0;$user_fandian=0;$count_buy=0;$user_prize=0;$count_lost=0;$hig_buy=0;$hig_buy_zuihao=0;$hig_buy_back=0;
$max_uid_list="'".Get_Lowerid($uid)."'";
mysql_query("set names utf8;");
$sqls_buy="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate in('hig_buy','hig_chase') $search";
$results_buy=mysql_query($sqls_buy);
$rows_buy=mysql_fetch_row($results_buy);
mysql_query("set names utf8;");
$sqls_buy_back="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate in('hig_buy_back','hig_chase_back','hig_buy_chase_back') $search";
$results_buy_back=mysql_query($sqls_buy_back);
$rows_buy_back=mysql_fetch_row($results_buy_back);
mysql_query("set names utf8;");
$sqls_re="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate='hig_rebate' $search";
$results_re=mysql_query($sqls_re);
$rows_re=mysql_fetch_row($results_re);
mysql_query("set names utf8;");
$sqls_re_back="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate='hig_rebate_back' $search";
$results_re_back=mysql_query($sqls_re_back);
$rows_re_back=mysql_fetch_row($results_re_back);
mysql_query("set names utf8;");
$sqls_pri="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate='hig_prize' $search";
$results_pri=mysql_query($sqls_pri);
$rows_pri=mysql_fetch_row($results_pri);
mysql_query("set names utf8;");
$sqls_pri_back="select sum(user_bank_log.moneys) from user_bank_log,user where user_bank_log.userid=user.userid and user_bank_log.userid in($max_uid_list) and user_bank_log.cate='hig_prize_back' $search";
$results_pri_back=mysql_query($sqls_pri_back);
$rows_pri_back=mysql_fetch_row($results_pri_back);
if($rows2[userid]-$perid==0){
$do_this="";
}else{
$do_this="<a href='".$thispath."&playkey=".$playkey."&username=".$uname."' class='blue'>查看下级</a>&nbsp;&nbsp;";
echo "<a href='?perid=".$rows2[userid]."&starttime=".$starttime."&endtime=".$endtime."&lottery=0&method=0&isgetdata=1' target='_blank' class='blue' style='display:none'>游戏明细</a>";
}
$money_re=$rows_re[0];
$money_all=$rows_buy[0];
$money_back=$rows_buy_back[0];
$money_re_back=$rows_re_back[0];
$money_pri=$rows_pri[0];
$money_pri_back=$rows_pri_back[0];
if($listnums-1<0){
$max_money_re=$rows_re[0];
$max_money_all=$rows_buy[0];
$max_money_back=$rows_buy_back[0];
$max_money_re_back=$rows_re_back[0];
$max_money_pri=$rows_pri[0];
$max_money_pri_back=$rows_pri_back[0];
}
$max_money=$money_all-$money_back;
$max_re_money=$money_re-$money_re_back;
$max_pri_money=$money_pri-$money_pri_back;
$yes_max_money=$max_money-$max_re_money;
$yes_lost_money=$yes_max_money-$max_pri_money;
$count_buy=$moneys-$user_fandian;
$count_lost=$moneys-$user_fandian-$user_prize;
if($max_money_re-$max_money>0){}
if($moneys==""){$moneys="0";}
if($user_fandian==""){$user_fandian="0";}
if($count_buy==""){$count_buy="0";}
if($user_prize==""){$user_prize="0";}
if($count_lost==""){$count_lost="0";}
echo "<tr height=35 align='center'  style='background:#FFFFFF'>";
echo "<td  align='center'>".$rows2[username]."</td>";
echo "<td  align='center'><span id='mon_".$listnums."'>".$max_money."</span></td>";
echo "<td  align='center'><span id='fandian_".$listnums."'>".$max_re_money."</span></td>";
echo "<td  align='center'><span id='buy_".$listnums."'>".$yes_max_money."</span></td>";
echo "<td  align='center'><span id='prize_".$listnums."'>".$max_pri_money."</span></td>";
echo "<td  align='center'><span id='lost_".$listnums."'>".$yes_lost_money."</span></td>";
echo "<td  align='center'>".$do_this."</td>";
echo "</tr>";
$listnums+=1;
}
$max_money_alls=$max_money_all-$max_money_back;if($max_money_alls==""){$max_money_alls=0;}
$max_money_res=$max_money_re-$max_money_re_back;if($max_money_res==""){$max_money_res=0;}
$max_money_sj=$max_money_alls-$max_money_res;if($max_money_sj==""){$max_money_sj=0;}
$max_money_pris=$max_money_pri-$max_money_pri_back;if($max_money_pris==""){$max_money_pris=0;}
$max_money_total=$max_money_alls-$max_money_res-$max_money_pris;if($max_money_total==""){$max_money_total=0;}
echo "<tr align='center' style='background:#FFFFFF'>";
echo "<td height='37' colspan='1'>合计</td>";
echo "<td align='center'><span id='all_moneys'>".$max_money_alls."</span></td>";
echo "<td align='center'><span id='all_user_fandian'>".$max_money_res."</span></td>";
echo "<td align='center'><span id='all_count_buy'>".$max_money_sj."</span></td>";
echo "<td align='center'><span id='all_user_prize'>".$max_money_pris."</span></td>";
echo "<td align='center'><span id='all_count_lost'>".$max_money_total."</span></td>";
echo "<td></td></tr>";
mysql_close();
echo "<input id='listnums' value='".$listnums."' style='display:none'>";
;echo ' 
	  </form> 
	  
  </table>
  
 <script> 
   show_moneys(G(\'listnums\').value,"mon")
   show_moneys(G(\'listnums\').value,"fandian")
   show_moneys(G(\'listnums\').value,"buy")
   show_moneys(G(\'listnums\').value,"prize")
   show_moneys(G(\'listnums\').value,"lost")
   var all_moneys=G("all_moneys").innerHTML;
   var all_user_fandian=G("all_user_fandian").innerHTML;
   var all_count_buy=G("all_count_buy").innerHTML;
   var all_user_prize=G("all_user_prize").innerHTML;
   var all_count_lost=G("all_count_lost").innerHTML;
   G("all_moneys").innerHTML=moneyFormatB(all_moneys);
   G("all_user_fandian").innerHTML=moneyFormatB(all_user_fandian); 
   G("all_count_buy").innerHTML=moneyFormatB(all_count_buy);
   G("all_user_prize").innerHTML=moneyFormatB(all_user_prize); 
   G("all_count_lost").innerHTML=moneyFormatB(all_count_lost);
</script>
     
        <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>