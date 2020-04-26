<?php

$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$uid = isset($_POST[user_gifts]) ?$_POST[user_gifts] : $_GET[user_gifts];
$card_num	=$db->fetch_count("SELECT COUNT(b.id) from ".DB_PREFIX."user_bank_list as b where b.userid='$userid'");
$gift_num	=$db->fetch_count("SELECT COUNT(b.id) from ".DB_PREFIX."user_gifts as b where b.userid='$userid'");
if($active=="put"){
if($uid){
if($card_num-1>=0){
$nowdate=Core_Fun::nowtime("Y-m-d");
$sql_count  = "select count(l.id) from ".DB_PREFIX."user_gifts as l where l.userid='$userid' and l.status<2 and l.creatdate like '$nowdate%' and status!='4'";
$tx_count = $db->fetch_count($sql_count);
if($tx_count){
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您今天已经领过！</div>";
}else{
$nowtime=Core_Fun::nowtime();
$array  = array(
'userid'=>$userid,
'creatdate'=>$nowtime,
'userCate'=>$uid,
'status'=>'0'
);
$db->insert(DB_PREFIX."user_gifts",$array);
$uid=$db->insert_id();
$array  = array(
'userid'=>'1',
'popup'=>'有会员领取购彩金',
'popupKey'=>'gifts',
'creatdate'=>$nowtime,
'status'=>'0'
);
$db->insert(DB_PREFIX."user_pupop",$array);
$uid=$db->insert_id();
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>提交成功！</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";
}
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>绑定银行卡后才能获取购彩金！</div>";
}
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您还未作选择！</div>";
}
echo "<script>setTimeout('parent.pop.close();',1000) </script>";
$db->close();
exit;
}
$sys_infor=getsql::sys("modes_gifts_money");
$gift_ms=explode("|",$sys_infor[modes_gifts_money]);
$paths =SZS_ROOT_PATH."source/config/party/gifts.txt";
$myfile = file_get_contents($paths);
$arr = explode("\r\n",$myfile);
for($e=0;$e<count($arr);$e++){
$l_s=explode("|",$arr[$e]);
if($l_s[4]==0){
$g_title[]=$l_s[1];
$bodys=str_replace("{money}","<font class='font_line_1'>".$gift_ms[$e]."</font>",$l_s[2]);
$g_body[]=$bodys;
$g_key[]=$l_s[3];
}
}
if($card_num-1>=0){$is_ok="yes";}else{$is_ok="no";}
if($gift_num-1>=0){$gift_ok="yes";}else{$gift_ok="no";}
$tpl->assign("g_title",$g_title);
$tpl->assign("g_body",$g_body);
$tpl->assign("g_key",$g_key);
$tpl->assign("gift_ok",$gift_ok);

?>