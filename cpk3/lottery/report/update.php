<?php

$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="gp";}
$thisdate=date('Y-m-d',strtotime("$d   +1   day"));
$lastdate=date('Y-m-d',strtotime("$d   -2   day"));
if($begin_get!=""){$begindate=$begin_get;}if($begin_post!=""){$begindate=$begin_post;}
if($end_get!=""){$enddate=$end_get;}if($end_post!=""){$enddate=$end_post;}
if($begindate==""){$begindate=$lastdate;}
if($enddate==""){$enddate=$thisdate;}
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
;echo '';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo '  
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
  <TBODY>
    <TR> 
      
      <TD   bgColor=#f3f3f3>
	  <table width="100%" border="0"  cellpadding="3" cellspacing="3">
	  <form name="form1" id="form1" method="post" action="?controller=report&action=update">
         <tr> 
            <td align="right" >&nbsp;起始日期:</td>
            <td> <input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '            至：<input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '       
            </td>
        </tr> 
        <tr>
            <td colspan="2" ><hr align="left" size="1" noshade /></td>
        </tr>  
        <tr>
           <td>&nbsp;</td>
            <td><input type="submit"  class="button" name="submit" value="提交" /></td>
        </tr></form>
	  
';$body_top_title="结算报表";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo '  
<table> <tr>
          <th bgcolor="#FFFFFF">时间</th>  
		  <th width="11%" bgcolor="#FFFFFF">充值</th>
          <th width="11%" bgcolor="#FFFFFF">提现</th> 
          <th width="11%" bgcolor="#FFFFFF">平台提现</th>  
          <th width="11%" bgcolor="#FFFFFF">投注</th>
          <th width="11%" bgcolor="#FFFFFF">中奖</th>
          <th width="11%" bgcolor="#FFFFFF">返点</th>
		  <th width="14%" bgcolor="#FFFFFF">结算</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save"> 
       
	   ';
if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
$d=date( 'Y-m-d ',strtotime($begindate));$listnums=0;
for ($i=0;$i<60;$i++){
$num=$i+1;
$new_date=date('Y-m-d',strtotime("$d   +$i   day"));
$next_date=date('Y-m-d',strtotime("$d   +$num   day"));
if(strtotime($enddate) -strtotime($new_date)>0){
echo "<tr bgcolor='#FFFFFF'><td>".$new_date."</td>";
$begintime=$new_date.$Add_Time;
$endtime=$next_date.$Add_Time;
$search=" and creatdate between '$begintime' and '$endtime'";
mysql_query("set names utf8;");
$sqls_cz="select sum(moneys) from user_bank_log where cate in('Recharge_to_higherid','Recharge_to_system','Recharge_online') $search";
$results_cz=mysql_query($sqls_cz);
$rows_cz=mysql_fetch_row($results_cz);
$cz=$rows_cz[0];
echo "<td><span id='cz_".$i."'>".$cz."</span></td>";
mysql_query("set names utf8;");
$sqls_tx="select sum(moneys) from user_bank_log where cate in('mention_to_higherid','mention_from_system') $search";
$results_tx=mysql_query($sqls_tx);
$rows_tx=mysql_fetch_row($results_tx);
$tx=$rows_tx[0];
echo "<td><span id='tx_".$i."'>".$tx."</span></td>";
mysql_query("set names utf8;");
$sqls_pttx="select sum(moneys) from user_bank_log where cate='mention_from_system' $search";
$results_pttx=mysql_query($sqls_pttx);
$rows_pttx=mysql_fetch_row($results_pttx);
$pttx=$rows_pttx[0];
echo "<td><span id='pttx_".$i."'>".$pttx."</span></td>";
mysql_query("set names utf8;");
$sqls_tz="select sum(moneys) from user_bank_log where cate in('hig_buy','hig_chase') $search";
$results_tz=mysql_query($sqls_tz);
$rows_tz=mysql_fetch_row($results_tz);
$tz=$rows_tz[0];
mysql_query("set names utf8;");
$sqls_qxtz="select sum(moneys) from user_bank_log where cate in('hig_buy_back','hig_buy_chase_back','hig_chase_back') $search";
$results_qxtz=mysql_query($sqls_qxtz);
$rows_qxtz=mysql_fetch_row($results_qxtz);
$qxtz=$rows_qxtz[0];
$buys=$tz-$qxtz;
echo "<td><span id='tz_".$i."'>".$buys."</span></td>";
mysql_query("set names utf8;");
$sqls_zj="select sum(moneys) from user_bank_log where cate in('hig_prize') $search";
$results_zj=mysql_query($sqls_zj);
$rows_zj=mysql_fetch_row($results_zj);
$zj=$rows_zj[0];
mysql_query("set names utf8;");
$sqls_qxzj="select sum(moneys) from user_bank_log where cate in('hig_prize_back') $search";
$results_qxzj=mysql_query($sqls_qxzj);
$rows_qxzj=mysql_fetch_row($results_qxzj);
$qxzj=$rows_qxzj[0];
$pri=$zj-$qxzj;
echo "<td><span id='zj_".$i."'>".$pri."</span></td>";
mysql_query("set names utf8;");
$sqls_fd="select sum(moneys) from user_bank_log where cate in('hig_rebate') $search";
$results_fd=mysql_query($sqls_fd);
$rows_fd=mysql_fetch_row($results_fd);
$fd=$rows_fd[0];
mysql_query("set names utf8;");
$sqls_qxfd="select sum(moneys) from user_bank_log where cate in('hig_rebate_back') $search";
$results_qxfd=mysql_query($sqls_qxfd);
$rows_qxfd=mysql_fetch_row($results_qxfd);
$qxfd=$rows_qxfd[0];
$rebate=$fd-$qxfd;
echo "<td><span id='fd_".$i."'>".$rebate."</span></td>";
$last_money=$buys-$pri-$rebate;
echo "<td><span id='end_".$i."'>".$last_money."</span></td></tr>";
$max_cz+=$cz;
$max_tx+=$tx;
$max_pttx+=$pttx;
$max_buys+=$buys;
$max_pri+=$pri;
$max_rebate+=$rebate;
$max_last_money+=$last_money;
$listnums+=1;
}
}
echo "<tr bgcolor='#999999'><td>合计</td>";
echo "<td><span id='max_cz'>".$max_cz."</span></td>";
echo "<td><span id='max_tx'>".$max_tx."</span></td>";
echo "<td><span id='max_pttx'>".$max_pttx."</span></td>";
echo "<td><span id='max_buys'>".$max_buys."</span></td>";
echo "<td><span id='max_pri'>".$max_pri."</span></td>";
echo "<td><span id='max_rebate'>".$max_rebate."</span></td>";
echo "<td><span id='max_last_money'>".$max_last_money."</span></td></tr>";
mysql_close();
echo "<input id='listnums' value='".$listnums."' style='display:none'>";
;echo '  
	  </form>
  </table>
    <script>
	show_moneys(G(\'listnums\').value,"cz")
	show_moneys(G(\'listnums\').value,"tx")
	show_moneys(G(\'listnums\').value,"pttx")
	show_moneys(G(\'listnums\').value,"tz")
	show_moneys(G(\'listnums\').value,"zj")
	show_moneys(G(\'listnums\').value,"fd")
	var max_cz=G("max_cz").innerHTML;
	var max_tx=G("max_tx").innerHTML;
	var max_pttx=G("max_pttx").innerHTML;
	var max_buys=G("max_buys").innerHTML;
	var max_pri=G("max_pri").innerHTML;
	var max_rebate=G("max_rebate").innerHTML;
	var max_last_money=G("max_last_money").innerHTML;
	G("max_cz").innerHTML=moneyFormatB(max_cz);
	G("max_tx").innerHTML=moneyFormatB(max_tx); 
	G("max_pttx").innerHTML=moneyFormatB(max_pttx); 
	G("max_buys").innerHTML=moneyFormatB(max_buys);
	G("max_pri").innerHTML=moneyFormatB(max_pri); 
	G("max_rebate").innerHTML=moneyFormatB(max_rebate);
	G("max_last_money").innerHTML=moneyFormatB(max_last_money);
	</script>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>