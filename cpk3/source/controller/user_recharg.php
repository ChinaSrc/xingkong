<?php

$active=$_GET['active'];
$perid=$_GET['perid'];
if($perid==""){$uid=$userid;
}else{
$uid=$perid;
if($perid-$userid!=0){
$is_hig=getsql::islower($userid,$perid);
if($is_hig=="no"){echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>该会员不是您的下级，操作失败！</div>";exit;}
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>操作失败！</div>";exit;
}
}
$sys_infor=getsql::sys("MinPutCash_ren");
if($active=="put"){
$amount = isset($_POST[amount]) ?$_POST[amount] : $_GET[amount];
$t_flag="yes";
if($sys_infor[MinPutCash_ren]-1>0){
if($sys_infor[MinPutCash_ren]-$amount>0){$s_info="充值额不能少于".$sys_infor[MinPutCash_ren];$t_flag="no";}
}
if($t_flag=="yes"){
$user_money=getsql::moneys();
if($amount-$user_money>0){
$s_info="您的余额不足，请更改提现金额";
}else{
$nowtime=Core_Fun::nowtime();
$umoney=getsql::umoney($amount,"lost");
$higmoney=getsql::umoney($amount,"add",$perid);
if($higmoney){
getsql::banklog($amount,"Recharge_from_Lowerid");
getsql::banklog($amount,"Recharge_to_higherid",$perid);
}
$_SESSION["hig_amount"]=$umoney;
$s_info="操作成功";
echo "<script>setTimeout('history.back();',2000) </script>";
}
}
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>".$s_info."</div>";
echo "<script>setTimeout('parent.pop.close();',2000) </script>";
$db->close();
exit;
}
$per_info   = array();
$per_info_sql = "select u.username,b.hig_amount from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid='$uid' and b.userid=u.userid";
$per_info     = $db->fetch_first($per_info_sql);
$tpl->assign("MinPutCash_ren",$sys_infor[MinPutCash_ren]);
$tpl->assign("per_info",$per_info);
$tpl->assign("perid",$perid);
?>