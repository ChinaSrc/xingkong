<?php

$games = isset($_POST[games]) ?$_POST[games] : $_GET[games];
$modes = isset($_POST[modes]) ?$_POST[modes] : $_GET[modes];
$widths = isset($_POST[widths]) ?$_POST[widths] : $_GET[widths];
$heights = isset($_POST[heights]) ?$_POST[heights] : $_GET[heights];
if($games==""){$games="CQSSC";}
$modes_arr=getsql::usermode($userid);
$sysmode_arr=getsql::sysmode();
$mode_list=array_intersect($modes_arr,$sysmode_arr);
if($modes==""){$modes=$modes_arr[0];}else{if (in_array($modes,$modes_arr) === false) {$modes=$modes_arr[0];}}
$perid=$_GET['perid'];
if($perid==""){$uid=$userid;
}else{
$uid=$perid;
if($perid-$userid!=0){
$is_hig=getsql::islower($userid,$uid);
if($is_hig=="no"){echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>该会员不是您的下级，不能查看！</div>";
echo "<script>setTimeout('history.back();',2000) </script>";exit;}
}
}
$per_info   = array();
$per_info_sql = "select u.username,u.nickname,u.isproxy,b.hig_amount from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid='$uid' and b.userid=u.userid";
$per_info     = $db->fetch_first($per_info_sql);
$itemname="Prize_".$modes;
$game_code	   = array();
$game_code_sql = "SELECT t.code FROM ".DB_PREFIX."game_type as t where t.ckey='$games'";
$game_code	= $db->fetch_first($game_code_sql);
$show_body="";
if($game_code and $modes!=""){
$code_list=explode("|",$game_code[code]);
$this_num=1;
for ($j=0;$j<count($code_list);$j++){
$this_code=$code_list[$j];
$dblist=" ".DB_PREFIX."game_code_list as l,".DB_PREFIX."game_code as c";
$game_code	= array();
$game_code_sql		= "SELECT l.CodeKey,l.ListKey,l.ShowTile,l.CodeTile,l.Rebate,c.fullname from $dblist where l.CodeKey='$this_code' and c.ckey='$this_code' order by l.CodeKey,l.CodeTile";
$game_code	= $db->getall($game_code_sql);
if($game_code){
$floa_num=1;$lastCodeKey="";$lastCodeTile="";$n=0;$Code_n=0;
for ($i=0;$i<count($game_code);$i++){
$CodeKey=$game_code[$i][CodeKey];
$ListKey=$game_code[$i][ListKey];
$ShowTile=$game_code[$i][ShowTile];
$CodeTile=$game_code[$i][CodeTile];
$Rebate=$game_code[$i][Rebate];
$fullname=$game_code[$i][fullname];
$show_body.= "<tr  class='table_b_tr_b'>";
if($lastCodeKey==""or $lastCodeKey!=$CodeKey){
$sql_count  = "select count(l.id) from ".DB_PREFIX."game_code_list as l where l.CodeKey='$CodeKey'";
$rows_count		= $db->fetch_count($sql_count);
$show_body.=  "<td rowspan='".$rows_count."'>".$fullname."</td>";
}
$lastCodeKey=$CodeKey;
if($CodeTile!=""){
if($lastCodeTile==""or $lastCodeTile!=$CodeTile){
$sql_count  = "select count(l.id) from ".DB_PREFIX."game_code_list as l where l.CodeKey='$CodeKey' and l.CodeTile='$CodeTile'";
$rows_count		= $db->fetch_count($sql_count);
$show_body.=  "<td rowspan='".$rows_count."'>".$CodeTile."</td>";
}
}else{
$show_body.=  "<td>".$CodeTile."</td>";
}
$lastCodeTile=$CodeTile;
$game_prize	= array();
$game_prize_sql		= "SELECT $itemname as prize from ".DB_PREFIX."game_set where ckey='$ListKey' and playKey='$games'";
$game_prize		= $db->fetch_first($game_prize_sql);
$prize=$game_prize[prize];
$game_rebate	= array();
$game_rebate_sql = "SELECT r.number from ".DB_PREFIX."user_rebate as r,(select c.Rebate from ".DB_PREFIX."game_code_list as c where c.ListKey='$ListKey') as user_re where r.userid='$uid' and r.PlayKey='$games' and r.Modes='$modes' and r.ItemKey=user_re.Rebate";
$game_rebate    = $db->fetch_first($game_rebate_sql);
if($game_rebate){$re_num=$game_rebate[number]."%";}else{$re_num="0%";}
$show_body.=  "<td >".$ShowTile." 奖金</td>";
$show_prize="<div id='div_".$ListKey."'><i id='".$ListKey."'>".$prize."</i></div><em id='em_".$ListKey."' style='display:none'>".$prize."</em>";
$show_body.=  "<td ><div>".$show_prize."</div></td>";
$show_body.=  "<td >".$re_num."</td>";
$show_body.=  "<td >使用中</td>";
$show_body.=  "</tr>";
$floa_num+=1;
$this_num+=1;
}
}
}
}
$game_arr=getsql::game();
$tpl->assign("show_body",$show_body);
$tpl->assign("games",$games);
$tpl->assign("modes",$modes);
$tpl->assign("modes_arr",$mode_list);
$tpl->assign("game_arr",$game_arr);
$tpl->assign("per_info",$per_info);
$tpl->assign("perid",$perid);
$tpl->assign("heights",$heights);
$tpl->assign("widths",$widths);
?>