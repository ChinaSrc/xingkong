<?php

$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$uid = isset($_POST[uid]) ?$_POST[uid] : $_GET[uid];
$perid = isset($_POST[perid]) ?$_POST[perid] : $_GET[perid];
$flags="yes";
$is_write="no";
if($uid==""and $perid==""and $active==""){
$re_info="读取失败，请刷新后重试";$flags="no";
}
if($_GET['admin']==1)$userid=$_SESSION['admin_id'];

if($perid-$userid==0){$re_info="不能给自已发信！";$flags="no";}
if($flags=="yes"){
if($active=="reply"){
$msgs	= array();
$msgs_sql		= "SELECT * FROM ".DB_PREFIX."user_msg where id='$uid'";
$msgs	= $db->fetch_first($msgs_sql);
if($msgs[userid]-$perid!=0){
$re_info="发件人信息读取出错，请刷新后重试！";$flags="no";
}
if($flags=="yes"){
if($msgs[perid]-$userid!=0){
$re_info="不是你的信息，不能回复！";$flags="no";
}
}
}
}
if($flags=="yes"){
if($active=="send"){
$perid = isset($_POST[perid]) ?$_POST[perid] : $_GET[perid];
$content = isset($_POST[content]) ?$_POST[content] : $_GET[content];
if($content==""){$re_info="没有回复内容的消息不能发送！";$flags="no";}
if($flags=="yes"){
if(strlen($content)-300>0){$re_info="回复内容不能超过100个汉字！";$flags="no";}
}
if($flags=="yes"){
if($userid-1>0){
//$get_hl   = array();
//$get_hl_sql = "select userid from ".DB_PREFIX."user where (higherid='$perid' and userid='$userid') or (higherid='$userid' and userid='$perid')";echo $get_lower_sql;
//$get_hl     = $db->fetch_first($get_hl_sql);
//if(!$get_hl['userid']){$flags="no";}
//if($flags=="no"){$flags=iszjlower($userid,$perid);}
//if($flags=="no"){$re_info="只有直接上下级之间才可以发送消息！";$flags="no";}
}
}
if($flags=="yes"){
if($userid-1>0){
$nowdate=Core_Fun::nowtime('d');
$countsql	= "SELECT COUNT(b.id) FROM ".DB_PREFIX."user_msg as b where b.userid='$userid' and b.creatdate like '$nowdate%'";
$total		= $db->fetch_count($countsql);
if($total-50>=0){$re_info="超过每天发送的最大量！";$flags="no";}
}
}
if($flags=="yes"){
$nowtime=Core_Fun::nowtime();
$array  = array(
'userid'=>$userid,
'perid'=>$perid,
'replyid'=>$replyid,
'content'=>$content,
'creatdate'=>$nowtime,
'status'=>'0'
);
$db->insert(DB_PREFIX."user_msg",$array);
$re_info="发送成功！";
}
}else{
$uname=getsql::userinfo($perid,"username");
if($active=="reply"){$r_in_fo="回复 ".$uname['username']." 的信息";}else{$r_in_fo="给 ".$uname['username']." 发送信息";}
$send_url=$do_url."?mod=send&code=msg&flag=yes&active=send&uid=".$uid."&perid=".$perid;
if($_GET['admin']) $send_url.="&admin=1";

$is_write="yes";
}
}
if($is_write=="no"){
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>".$re_info."</div>";
echo "<script>setTimeout('parent.pop.close();',1000) </script>";
exit;
}
;echo '<div style=\'font-size:12px;\'>
<form method=\'POST\' action=\'';echo $send_url;;echo '\' name=\'form1\' id=\'form1\'>
<div style=\'text-align:left;padding:5px;font-weight:bold;\'>';echo $r_in_fo;;echo '(100个汉字以内)</div> 
<textarea id=\'content\' name=\'content\' style=\'height:100px;width:99%;\'></textarea>
<div style=\'padding:5px;font-size:12px;text-align:center\'><input type=\'submit\' value=\'发 送\' style=\'border:1px solid #222;height:20px;padding:0px 20px\'></div>
</form>
</div>'
?>