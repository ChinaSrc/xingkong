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
$search=" where u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and b.is_succeed='yes' and b.is_zuih='no' ";

    $today=get_day_time();
    if($_GET['begintime']){
        $begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
    }
    else $begintime=$today[0];
    if($_GET['endtime']){
        $endtime=$_GET['endtime']." ".$search_time_arr['end'];
    }
    else $endtime=$today[1];
    $begin=substr($begintime, 0,10);
    $end=substr($endtime, 0,10);
    $search.=" and b.creatdate>='{$begintime}' and b.creatdate<='{$endtime}' ";


$tpl->assign('begin',$begin);
$tpl->assign('end',$end);
if($projectno){
$t_url.="&projectno=".$projectno;
$search.=" and b.buyid='$projectno'";
}

if($_GET['period']) $search.=" and b.period='{$_GET['period']}'";

if(!$_GET['username']) $_GET['username']=$_SESSION['user_name'];
if($_GET['username']){

	$uu=$db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");

	if(is_team($uu['userid'], $_SESSION['userid']) or $uu['userid']==$_SESSION['userid']){


	if($_GET['st']==1 || $_GET['st']==3 || !$_GET['st'])
	$search.=" and u.username='{$_GET['username']}'";
else{

$user_ids=get_user_nextid($uu['userid']);
$user_ids=str_replace("'", "", $user_ids);
$search.=" and (u.userid in ( {$user_ids} ))";

}
	}
else{
	$search.=" and u.userid='-1'";


}

}else{
$search.=" and u.userid='$perid'";
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
$game_list_sql		= "SELECT b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM $dblist $search ORDER BY b.creatdate desc LIMIT $start, $pagesize";

$game_list	= $db->getall($game_list_sql);

echo $game_list_sql;
exit();
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;
if($game_list){
for ($j=0;$j<count($game_list);$j++){

$game=	$db->fetch_first("select * from game_type where ckey='{$game_list[$j][playkey]}'");
if($j%2==0){$trbg="class='table_b_tr_a'";}else{$trbg="class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg." height=35>";
$buy_num=$game_list[$j][period];
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$game_list[$j][id];
$user=	$db->fetch_first("select * from user where userid='{$game_list[$j][userid]}'");
//$show_body.= "<td >".$game_list[$j]['buyid']."</td>";
$show_body.= "<td >".$user['username']."</td>";
$show_body.= "<td >".$game['fullname']."</td>";
$this_code=get_game_mark($game_list[$j][id]);
$game_list[$j]['wanfa']=str_replace($game['fullname'], '', $this_code);

$show_body.= "<td >".str_replace($game['fullname'], '', $this_code)."</td>";
$show_body.= "<td title='".$game_list[$j][buyid]."'><a onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','800','480')\" target='_blank' style='cursor:pointer;text-decoration none;'>".$buy_num."</a></td>";

if(strlen($game_list[$j]['number'])>30) $number=substr($game_list[$j]['number'],0,30).'...';else $number=$game_list[$j]['number'];
    $show_body.= "<td >".$number."</td>";





$user=	$db->fetch_first("select * from user where userid='{$game_list[$j][userid]}'");


$pri_money+=$game_list[$j][pri_money];
$long_pid=$game_list[$j][period];
$lost_money= sprintf("%.3f",$game_list[$j][money]);
$show_body.= "<td>".$lost_money."</td>";

if($game_list[$j]['pri_number']) $pre_number=$game_list[$j]['pri_number'];else $pre_number='-';
    $show_body.= "<td>".$pre_number."</td>";

if($game_list[$j][pri_money]==""){$pri_m="0.000";}else{$pri_m=$game_list[$j][pri_money];$pri_m=sprintf("%.3f",$pri_m);}
$show_body.= "<td><div class='td_div'>".$pri_m."</div></td>";

$show_body.= "<td><div class='td_div'>".show_buystatus($game_list[$j])."</div></td>";
    $show_body.= "<td >".$game_list[$j][creatdate]."</td>";
$show_body.= "<td><div class='td_div'><input type='button' onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','800','480')\" class='button'  value='详情'></div></td>";








$show_body.= "</tr>";
$moneys=$moneys+$game_list[$j][money];
if(!$moneys)$moneys=0;
if(!$pri_money)$pri_money=0;
if(!$moneys)$moneys=0;
$listnums+=1;
}

}


}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("game_list",$show_body);

$tpl->assign("list",$game_list);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);

$tpl->assign("game_arr",$game_arr);
$tpl->assign("config",$config);

$tpl->assign("projectno",$projectno);
$tpl->assign("pername",$pername);
$tpl->assign("includes",$includes);
$tpl->assign("is_prize",$is_prize);
$tpl->assign("lotteryid",$lotteryid);
$tpl->assign("isgetdata",$isgetdata);
$tpl->assign("navtitle",'投注记录');
$tpl->assign('time_arr',array(date('Y-m-d',time()+3600*24),date('Y-m-d',time()),date('Y-m-d',time()-3600*24),date('Y-m-d',time()-3600*24*7)));
$begindate=date("Y-m-d",time()).' 00:00:00';
$enddate=date("Y-m-d",time()+24*3600).' 23:59:59';

$yingkui=get_yingkui($_SESSION['userid'], $begindate, $enddate);
$tpl->assign("yingkui",$yingkui);


?>