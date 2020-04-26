<?php

$playkey=$_GET['playkey'];
$mode=$_GET['mode'];
$perid=$_GET['perid'];
if($perid==""){$uid=$userid;
}else{
$uid=$perid;
if($perid-$userid!=0){
$is_hig=getsql::islower($userid,$perid);
if($is_hig=="no"){echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>该会员不是您的下级，不能查看！</div>";exit;}
}
}
$tpl->assign("config",$config);
$per_info   = array();
$per_info_sql = "select u.username,u.nickname,b.hig_amount from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid='$uid' and b.userid=u.userid";
$per_info     = $db->fetch_first($per_info_sql);
$user_amount		= array();
$user_amount_sql = "SELECT sum(hig_amount) as sams FROM ".DB_PREFIX."user_bank where userid in(SELECT userid FROM ".DB_PREFIX."user_level where higherid='$uid') or userid='$perid'";
$user_amount     = $db->fetch_first($user_amount_sql);
if(!$user_amount){
echo "user_level Error！";
die();
}
$tpl->assign("user_amount_team",$user_amount[sams]);
$tpl->assign("per_info",$per_info);
$tpl->assign("perid",$perid);
?>