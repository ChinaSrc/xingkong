<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$projectno = isset($_POST[projectno]) ?$_POST[projectno] : $_GET[projectno];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$includes = isset($_POST[includes]) ?$_POST[includes] : $_GET[includes];
$is_prize = isset($_POST[is_prize]) ?$_POST[is_prize] : $_GET[is_prize];
$lotteryid = isset($_POST[lotteryid]) ?$_POST[lotteryid] : $_GET[lotteryid];
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
$search=" where u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and b.is_succeed='yes'";
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
$begintime=$begindate." 00:00:00";
$endtime=$enddate." 23:59:59";
$search.=" and b.creatdate between '$begintime' and '$endtime'";
if($projectno){
$t_url.="&projectno=".$projectno;
$search.=" and b.buyid='$projectno'";
}

if($_GET['period']) $search.=" and b.period='{$_GET['period']}'";
if($includes){
$t_url.="&includes=".$includes;
$low_list=getsql::lower($perid,"yes");
$u_line=implode("|",$low_list);
$u_list=str_replace("|","','",$u_line);
$search.=" and b.userid in ('".$u_list."')";
}else{
$search.=" and b.userid='$perid'";
}
if($is_prize){
$t_url.="&is_prize=".$is_prize;
if($is_prize=="3"){$search.=" and b.isprize='is_yes'";}
if($is_prize=="2"){$search.=" and b.isprize='is_no'";}
if($is_prize=="1"){$search.=" and b.status='0'";}
if($is_prize=="9"){$search.=" and b.status='9'";}
}
if($lotteryid){
$t_url.="&lotteryid=".$lotteryid;
$search.=" and b.playkey='$lotteryid'";
}
$dblist=" ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as t,".DB_PREFIX."game_ssc_list as l";
$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(b.id) FROM $dblist ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();
$game_list_sql		= "SELECT b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM $dblist $search ORDER BY b.id desc LIMIT $start, $pagesize";
$game_list	= $db->getall($game_list_sql);
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;
if($game_list){
for ($j=0;$j<count($game_list);$j++){
	
$game=	$db->fetch_first("select * from game_type where ckey='{$game_list[$j][playkey]}'");
if($j%2==0){$trbg="class='table_b_tr_a'";}else{$trbg="class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg." >";
$show_body.= "<td ><div class='td_div'>".$game['fullname']."</div></td>";
$buy_num=$game_list[$j][period];
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$game_list[$j][id];
$show_body.= "<td title='".$game_list[$j][buyid]."'><div class='td_div'>

<a onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','600','470')\" target='_blank' style='cursor:pointer;text-decoration none;'><font color=#333>".$buy_num."</font></a></div></td>";
if(strlen($game_list[$j][username])-7>=0){$this_username=CutStr($game_list[$j][username],0,6,true);}else{$this_username=$game_list[$j][username];}
$this_code=get_game_mark($game_list[$j][id]);


$show_body.= "<td ><div class='td_div'>".str_replace($game['fullname'], '', $this_code)."</div></td>";

if(strlen($game_list[$j][number])-10>0){$lot_num="<a onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','600','470')\" target='_blank' style='cursor:pointer;'><font color='blue'>查看详情</a>";}else{$lot_num=$game_list[$j][number];}
$show_body.= "<td title='".$game_list[$j][number]."'><div class='td_div'>".$lot_num."</div></td>";

$user=	$db->fetch_first("select * from user where userid='{$game_list[$j][userid]}'");
$priz=get_prize($game_list[$j][playkey], $game_list[$j]['list_id'], $user['modes'],$game_list[$j]['wei']);




$pri_money+=$game_list[$j][pri_money];
$long_pid=$game_list[$j][period];
$lost_money= sprintf("%.3f",$game_list[$j][money]);
$show_body.= "<td><div class='td_div'><span id='mon_".$listnums."'>".$lost_money."</span></div></td>";
$show_body.= "<td><div class='td_div'>".$game_list[$j][nums]."</div></td>";
$show_body.= "<td><div class='td_div'>".$game_list[$j][times]."</div></td>";
$show_body.= "<td><div class='td_div'>".$game_list[$j][modes]."</div></td>";



if($game_list[$j][pri_money]==""){$pri_m="0.000";}else{$pri_m=$game_list[$j][pri_money];$pri_m=sprintf("%.3f",$pri_m);}
$show_body.= "<td><div class='td_div'>".$pri_m."</div></td>";
if($game_list[$j][isprize]==""){$status="<font color='green'>未开奖</font>";}
if($game_list[$j][isprize]=="is_yes"){$status="<font color='red'>已中奖</font>";}
if($game_list[$j][isprize]=="is_no"){$status="<font color='blue'>未中奖</font>";}
if($game_list[$j][status]=="9"){$status="<font color='green'>已撤单</font>";}
$show_body.= "<td><div class='td_div'>".$status."</div></td>";
$show_body.= "<td title='".$game_list[$j][creatdate]."'><div class='td_div'>".substr($game_list[$j][creatdate],0,strlen($game_list[$j][creatdate]))."</div></td>";

if($game_list[$j]['status']==0){
	$nowtime=date('Y-m-d H:i:s');
	
	$per=substr($game_list[$j]['period'], 8,strlen($game_list[$j]['period'])-8);
	
	$rr=$db->fetch_first("select * from  game_time where playKey='{$game_list[$j]['playkey']}'  and lotNum='{$per}' and endTime>'{$nowtime}'");
	
	if($rr){
	$this_url="do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&uid=".$game_list[$j][id];
	$status1="<a onclick=\"winPop({title:'撤单',width:'300',height:'100',drag:true,url:'".$this_url."'})\">撤单</a>";
	}
	else $status1="<font color='#2174ae;'>等待开奖</font>";		
	
}
elseif($game_list[$j][status]=="9"){$status1="<font color='green'>已撤单</font>";} 
else{
	$status1="<font color='red'>已结束</font>";
}
$show_body.= "<td><div class='td_div'>".$status1."</div></td>";






$show_body.= "</tr>";
$moneys=$moneys+$game_list[$j][money];
if(!$moneys)$moneys=0;
if(!$pri_money)$pri_money=0;
if(!$moneys)$moneys=0;
$listnums+=1;
}

}

$show_body.= "<tr >";
$show_body.= "<td height='37'>当页合计</td>";
$show_body.= "<td colspan='3'></td>";
$show_body.= "<td><span id='moneys' style='font-weight:800;'>".sprintf("%.2f",$moneys)."</span></td><td></td><td colspan=2'></td>";
$show_body.= "<td><span id='prizes' style='font-weight:800;'>".sprintf("%.2f",$pri_money)."</span></td>";
$show_body.= "<td colspan=5'></td>";
$show_body.= "</tr>";
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
$tpl->assign("is_prize",$is_prize);
$tpl->assign("lotteryid",$lotteryid);
$tpl->assign("isgetdata",$isgetdata);

?>