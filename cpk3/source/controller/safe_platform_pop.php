<?php

$coodid = isset($_POST[coodid]) ?$_POST[coodid] : $_GET[coodid];
$mlook = isset($_POST[mlook]) ?$_POST[mlook] : $_GET[mlook];
$mcate = isset($_POST[mcate]) ?$_POST[mcate] : $_GET[mcate];
$buid=hexDecode($coodid);
$amount=hexDecode($mlook);
$mcate=hexDecode($mcate);
$userbank=explode("|",$buid);
if($active=="put"){
$realname = isset($_POST[realname]) ?$_POST[realname] : $_GET[realname];
$banknum = isset($_POST[banknum]) ?$_POST[banknum] : $_GET[banknum];
$bankname = isset($_POST[bankname]) ?$_POST[bankname] : $_GET[bankname];
$money = isset($_POST[money]) ?$_POST[money] : $_GET[money];
$txtype = isset($_POST[txtype]) ?$_POST[txtype] : $_GET[txtype];
$user_amount=getsql::moneys($userid);
if($user_amount-$money>=0 and $money-1>0){
$nowtime=Core_Fun::nowtime();
$umoney=getsql::umoney($money,"lost");
if($txtype=="zx"){
if($umoney){$banklog=getsql::banklog($money,"mention_from_system");$_SESSION["hig_amount"]=$umoney;}
$array  = array(
'userid'=>$userid,
'money'=>$money,
'cate'=>'platform',
'remark'=>$remark,
'creatdate'=>$nowtime,
'realname'=>$realname,
'banknum'=>$banknum,
'bankname'=>$bankname,
'status'=>'0'
);
$db->insert(DB_PREFIX."user_funds",$array);
$uid=$db->insert_id();
}

echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>操作成功</div>";
echo "<script>setTimeout('history.back();',2000) </script>";
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您的余额不足，操作失败。</div>";
echo "<script>setTimeout('parent.pop.close();',2000) </script>";
}
$db->close();
exit;
}
if($mcate=="zx"){$cateshow="向平台提现";}
if($mcate=="hig"){$cateshow="向上级提现";}
$tpl->assign("userbank",$userbank);
$tpl->assign("amount",$amount);
$tpl->assign("mcate",$mcate);
$tpl->assign("cateshow",$cateshow);

?>