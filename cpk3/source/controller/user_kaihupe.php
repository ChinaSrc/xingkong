<?php

$page = $_GET['page'];
$userinfor=getsql::userinfo('','proxynum');
$proxynum=$userinfor[proxynum];
if($active=="put"){
$userlist = isset($_POST[userlist]) ?$_POST[userlist] : $_GET[userlist];
$numlist = isset($_POST[numlist]) ?$_POST[numlist] : $_GET[numlist];
$u_arr=explode("|",$userlist);
$n_arr=explode("|",$numlist);
$c_num=0;
for($i=0;$i<count($n_arr);$i++){
$c_num+=$n_arr[$i];
}
if($c_num-$proxynum>0){
echo "<div style='text-align:center;background:#FFFFFF;font-size:12px;padding:20px;'>您的配额不足分配，请更改后再提交!</div>";
}else{
for($i=0;$i<count($n_arr);$i++){
$t_num=$n_arr[$i];
$t_uid=$u_arr[$i];
$proxynum=$proxynum-$t_num;
$sql="UPDATE ".DB_PREFIX."user SET proxynum=proxynum+$t_num where userid='$t_uid'";
$db->query($sql);
$db->update(DB_PREFIX."user",array('proxynum'=>$proxynum),"userid=".$userid."");
}
echo "<div style='text-align:center;background:#FFFFFF;font-size:12px;padding:20px;'>操作成功!</div>";
}
echo "<script>setTimeout('parent.window.location.reload();',1000) </script>";
echo "<script>setTimeout('parentDialog.close();',1000) </script>";
exit;
}
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(v.userid) FROM ".DB_PREFIX."user AS v where v.higherid='$userid' and v.isproxy='0'";
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$user_list_view		= array();
$user_list_view_sql = "select a.userid,a.username,a.proxynum from ".DB_PREFIX."user as a where a.higherid='$userid' and a.isproxy='0' LIMIT $start, $pagesize";
$user_list_view     = $db->getall($user_list_view_sql);
for ($i=0;$i<count($user_list_view);$i++){
$this_uid=$user_list_view[$i][userid];
if($user_list_view[$i][proxynum]-1<0){$user_list_view[$i][proxynum]="0";}
$this_count_sql = "select sum(v.proxynum+0)as cous from ".DB_PREFIX."user as v where v.higherid='$this_uid'";
$p_counts= $db->fetch_first($this_count_sql);
if($p_counts[cous]-1>=0){$this_count=$p_counts[cous];}else{$this_count="0";}
$tpl->assign("this_count_".$this_uid,$this_count);
}
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = "?mod=".$mod."&code=".$code."&";
$channel	= "case";
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("proxynum",$proxynum);
$tpl->assign("user_list_view",$user_list_view);
?>