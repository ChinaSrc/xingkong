<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];


$type = isset($_POST[type]) ?$_POST[type] : $_GET[type];
$code_s = isset($_POST[code_s]) ?$_POST[code_s] : $_GET[code_s];
$modes = isset($_POST[modes]) ?$_POST[modes] : $_GET[modes];
$lotteryid = isset($_POST[lotteryid]) ?$_POST[lotteryid] : $_GET[lotteryid];
$ordertype = isset($_POST[ordertype]) ?$_POST[ordertype] : $_GET[ordertype];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$isgetdata = 'yes';
$show_body="";
$this_end_time=core_fun::nowtime('t','yes');
$statbegins=str_replace(':','',$config[statbegin]);
if(strlen($statbegins)-4==0){$this_end_time=substr($this_end_time,0,2);}

if($isgetdata=="yes"){
$t_url=$this_url."&isgetdata=".$isgetdata;
$search=" where b.userid=u.userid  and  cate='hig_rebate' ";
if($pername){
$perid=getsql::userids($pername);
if($perid-$userid==0){
}else{
$islowers=getsql::islower($userid,$perid);
if($islowers=="no"){echo "<script>history.back(-1);</script>";exit;}
}
$t_url.="&pername=".$pername;
}else{
$perid=$_SESSION["userid"];
}
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
if(!$begindate) $begindate=date("Y-m-d",time()-30*24*3600);
if(!$enddate) $enddate=date("Y-m-d");
$begintime=$begindate." 00:00:00" ;

$endtime=$enddate." 23:59:59";

$search.=" and b.creatdate between '$begintime' and '$endtime'";

if($_GET['accountid']){$search.=" and b.accountid='{$_GET['accountid']}'";}

if($includes){
$t_url.="&includes=".$includes;
$low_list=getsql::lower($perid,"yes");
$u_line=implode("|",$low_list);
$u_list=str_replace("|","','",$u_line);
$search.=" and b.userid in ('".$u_list."')";
}else{
$search.=" and b.userid='$perid'";
}
$dblist=" ".DB_PREFIX."user_bank_log as b,".DB_PREFIX."user as u";
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(b.creatdate) FROM $dblist ".$search;
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

if($game_list[$j][remarks]!=""){$remarks=$game_list[$j][remarks];}
if($listnums%2==0){$trbg=" class='table_b_tr_a'";}else{$trbg=" class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg.">";$this_link="";

$this_url=$this_url="index.aspx?mod=fandian&code=info&time=".strtotime($game_list[$j][creatdate])."&uid=".$game_list[$j][userid];
$this_link="href='javascript:void(0);' onclick=\"javascript:DialogResetWindow('（{$game_list[$j]['pername']}）返点详情','".$this_url."','800','400')\"";

$num=$j+1+$start;
$accountid=$game_list[$j][accountid];
$show_body.= " <td align='center' >{$accountid}</td>";

$show_body.= " <td>".hig_log_code($game_list[$j][cate])."</td>";
$secai="";
if(in_array($game_list[$j][cate],$arr_add_money) === true){$secai="add";}else{$secai="lost";}
$t_monoey=sprintf("%.2f",$game_list[$j][moneys]);
if($secai=="add"){
$jine_s="<span style='color:#1CB447'>+<font id='mon_".$listnums."'>".$t_monoey."</font></span>";$add_money+=$t_monoey;
}elseif($secai=="lost"){
$jine_s="<span style='color:#F73E54'>-<font id='mon_".$listnums."'>".$t_monoey."</font></span>";$lost_money+=$t_monoey;
}else{
$jine_s="<span color=''><font id='mon_".$listnums."'>".$t_monoey."</font></span>";
}
$show_body.= " <td>".$jine_s."</td>";
$show_body.= " <td><span id='amo_".$listnums."'>".sprintf("%.2f",$game_list[$j][hig_amount])."</span></td>";

$show_body.= " <td>".substr($game_list[$j][creatdate],0,strlen($game_list[$j][creatdate]))."</td>";



$show_body.= " <td><a {$this_link}>返点详情</a></td>";
$show_body.= "</tr>";
$listnums+=1;
}
$end_money=$add_money-$lost_money;
if($end_money>0){
$show_end_money="<span><b><font id='show_end_money' color='green'>".sprintf("%.2f",$end_money)."</font></b></span>";
$show_end_money_td="<span><b><font id='show_end_money_td' color='green'>".$show_end_money."</font></b></span>";
}else{
$show_end_money="<span><b><font id='show_end_money' color='Red'>".sprintf("%.2f",$end_money)."</font></b></span>";
$show_end_money_td="<span><b><font id='show_end_money_td' color='Red'>".$show_end_money."</font></b></span>";
}
$show_body.= "<input id='listnums' name='listnums' value='".$listnums."' style='display:none'>";
$show_body.= "<tr >";
$show_body.= "<td colspan='4'></td>";
$show_body.= "<td height='30' colspan='2' align='right'>";
$show_body.= "小结:本页资金变动：&nbsp;".$show_end_money_td."&nbsp;&nbsp;&nbsp;&nbsp;</td>";

$show_body.= "</tr>";
}else{
$show_body.= "<tr height=35 align=center>";
$show_body.= "<td colspan=7>未找到数据，请更改查询条件之后进行查询！</td>";
$show_body.= "</tr>";
}
}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("body_list",$show_body);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
if($enddate==''){
	
	
	
}
$tpl->assign("game_arr",$game_arr);
$tpl->assign("config",$config);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("projectno",$projectno);
$tpl->assign("pername",$pername);
$tpl->assign("includes",$includes);
$tpl->assign("is_prize",$is_prize);
$tpl->assign("type",$type);
$tpl->assign("code_s",$code_s);
$tpl->assign("modes",$modes);
$tpl->assign("lotteryid",$lotteryid);
$tpl->assign("isgetdata",$isgetdata);
$tpl->assign("ordertype",$ordertype);

?>