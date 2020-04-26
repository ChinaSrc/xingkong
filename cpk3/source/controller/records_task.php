<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$projectno = isset($_POST[projectno]) ?$_POST[projectno] : $_GET[projectno];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$lotteryid = isset($_POST[lotteryid]) ?$_POST[lotteryid] : $_GET[lotteryid];
$includes = isset($_POST[includes]) ?$_POST[includes] : $_GET[includes];
$modes = isset($_POST[modes]) ?$_POST[modes] : $_GET[modes];
$isgetdata = isset($_POST[isgetdata]) ?$_POST[isgetdata] : $_GET[isgetdata];
$show_body="";
$isgetdata="yes";
if($isgetdata=="yes"){
$t_url=$this_url."&isgetdata=".$isgetdata;
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
$search=" where u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and is_zuih='yes'";
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
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate." ".$config[statbegin];
$endtime=$enddate." ".$config[statend];
$search.=" and b.creatdate between '$begintime' and '$endtime'";
if($projectno){
$t_url.="&projectno=".$projectno;
$search.=" and b.buyid='$projectno'";
}
if($includes){
$t_url.="&includes=".$includes;
$low_list=getsql::lower($perid,"yes");
$u_line=implode("|",$low_list);
$u_list=str_replace("|","','",$u_line);
$search.=" and b.userid in ('".$u_list."')";
}else{
$search.=" and b.userid='$perid'";
}
if($modes){
$t_url.="&modes=".$modes;
$search.=" and b.modes='$modes'";
}
if($lotteryid){
$t_url.="&lotteryid=".$lotteryid;
$search.=" and b.playkey='$lotteryid'";
}
if($_POST['period']) $search.=" and b.period='{$_POST['period']}'";
$dblist=" ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as t,".DB_PREFIX."game_ssc_list as l";
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(b.id) FROM $dblist ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();
$game_list_sql		= "SELECT b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM $dblist $search ORDER BY b.creatdate desc LIMIT $start, $pagesize";

$game_list	= $db->getall($game_list_sql);
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;
if($game_list){
for ($j=0;$j<count($game_list);$j++){
$uid=$game_list[$j][id];
$sql5 ="select count(id) from ".DB_PREFIX."game_buylist where z_number='$uid'";
$rows5=$db->fetch_row($db->query($sql5));
if($rows5[0]){$all_peroid=$rows5[0];}else{$all_peroid="0";}
$sql6 ="select sum(money) from ".DB_PREFIX."game_buylist where z_number='$uid'";
$rows6=$db->fetch_row($db->query($sql6));
if($rows6[0]){$all_money=$rows6[0];}else{$all_money="0";}$this_all_money+=$all_money;
$sql7 = "select count(id) from ".DB_PREFIX."game_buylist where z_number='$uid' and status>0 and status<4";
$rows7=$db->fetch_row($db->query($sql7));
if($rows7[0]){$over_peroid=$rows7[0];}else{$over_peroid="0";}
$sql8 = "select count(id) from ".DB_PREFIX."game_buylist where z_number='$uid' and status=9";
$rows8=$db->fetch_row($db->query($sql8));
if($rows8[0]){$back_peroid=$rows8[0];}else{$back_peroid="0";}
$sql9 = "select sum(money) from ".DB_PREFIX."game_buylist where z_number='$uid' and status>0 and status<4";
$rows9=$db->fetch_row($db->query($sql9));
if($rows9[0]){$over_money= ($rows9[0]);}else{$over_money="0";}$this_over_money+=$over_money;
$sql10 = "select sum(money) from ".DB_PREFIX."game_buylist where z_number='$uid' and status=9";
$rows10=$db->fetch_row($db->query($sql10));
if($rows10[0]){$back_money= ($rows10[0]);}else{$back_money="0";}
if($j%2==0){$trbg="class='table_b_tr_a'";}else{$trbg="class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg." height=35>";
if(strlen($game_list[$j][buyid])-5>=0){$buy_num=substr($game_list[$j][buyid],0,4)."...";}else{$buy_num=$game_list[$j][buyid];}
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$game_list[$j][id];
$this_period=$game_list[$j][period];

$show_body.= "<td title='".$game_list[$j][buyid]."'><div class='td_div'><a onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','600','500')\" target='_blank' style='cursor:pointer;'><font color=#333>".$this_period."</font></a></div></td>";
//if(strlen($game_list[$j][username])-7>=0){$this_username=CutStr($game_list[$j][username],0,6,true);}else{$this_username=$game_list[$j][username];}
//$show_body.= "<td title='".$game_list[$j][username]."'><div class='td_div'>".$this_username."</div></td>";

$game=	$db->fetch_first("select * from game_type where ckey='{$game_list[$j][playkey]}'");

if(strlen($game_list[$j][wanfa])-5>=0){$this_code=CutStr($game_list[$j][wanfa],0,4,false);}else{$this_code=$game_list[$j][wanfa];}
$show_body.= "<td title='".$game_list[$j][wancode]."-".$game_list[$j][wanfa]."'><div class='td_div'>".$game['fullname']."-".$this_code."</div></td>";

$show_body.= "<td><div class='td_div'>".$all_peroid."</td>";
$show_body.= "<td><div class='td_div'>".$over_peroid."</td>";
$show_body.= "<td><div class='td_div'>".$back_peroid."</td>";
if(strlen($game_list[$j][number])-12>0){$lot_num=substr($game_list[$j][number],0,11).".";}else{$lot_num=$game_list[$j][number];}
$show_body.= "<td title='".$game_list[$j][number]."'><div class='td_div'>".$lot_num."</div></td>";
//$show_body.= "<td><div class='td_div'>".$game_list[$j][modes]."</div></td>";
$show_body.= "<td><div class='td_div'><span id='mon_".$listnums."'>".sprintf("%.2f",$all_money)."</span></div></td>";
$show_body.= "<td><div class='td_div'>".sprintf("%.2f",$over_money)."</div></td>";
$show_body.= "<td><div class='td_div'>".sprintf("%.2f",$back_money)."</div></td>";
if($game_list[$j][is_zuih_pri_stop]=="yes"){$is_stops="是";}else{$is_stops="否";}
$show_body.= "<td><div class='td_div'>".$is_stops."</div></td>";
$show_body.= "<td title='".$game_list[$j][creatdate]."'><div class='td_div'>".substr($game_list[$j][creatdate],0,strlen($game_list[$j][creatdate]))."</div></td>";
if($game_list[$j]['status']=='0'){$status="<font color=red>进行中</font>";}else{$status="已结束";}
$show_body.= "<td><div class='td_div'>".$status."</div></td>";
$show_body.= "</tr>";
$moneys=$moneys+$game_list[$j][money];
$listnums+=1;
}
}
}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("game_list",$show_body);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
if($begindate==""){
$begindate=$thisdate;
$enddate=$nextdate;
}
$tpl->assign("game_arr",$game_arr);
$tpl->assign("config",$config);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("projectno",$projectno);
$tpl->assign("pername",$pername);
$tpl->assign("includes",$includes);
$tpl->assign("modes",$modes);
$tpl->assign("is_prize",$is_prize);
$tpl->assign("lotteryid",$lotteryid);
$tpl->assign("isgetdata",$isgetdata);
?>