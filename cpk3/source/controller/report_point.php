<?php

$perid=$_SESSION["userid"];
$t_url=$this_url."&isgetdata=".$isgetdata;
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
if($begindate==""){$begindate=$thisdate;}
$t_url=$thisURL."&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate." ".$config[statbegin];
$d=date( 'Y-m-d ',strtotime($begindate));
$enddate=date('Y-m-d',strtotime("$d   +1   day"));
$endtime=$enddate." ".$config[statend];
$search.=" b.creatdate between '$begintime' and '$endtime'";
$serch_s=$begintime." 至 ".$endtime;
$dblist=" ".DB_PREFIX."user_bank_log as b";
$game_rebate	= array();
$game_rebate_sql = "select sum(b.moneys) as mons from $dblist where b.userid='$perid' and b.cate='hig_rebate' and $search";
$game_rebate	= $db->fetch_first($game_rebate_sql);
$money_num=$game_rebate[mons];
$game_re	= array();
$game_re_sql = "select sum(b.moneys) as mons from $dblist where b.userid='$perid' and b.cate='hig_rebate_back' and $search";
$game_re	= $db->fetch_first($game_re_sql);
$back_money_num=$game_re[mons];
if($money_num==""){$money_num="0.00";}else{$money_num=$money_num-$back_money_num;$money_num=sprintf("%.2f",$money_num);}
$tpl->assign("begindate",$begindate);
$tpl->assign("serch_s",$serch_s);
$tpl->assign("money_num",$money_num);

?>