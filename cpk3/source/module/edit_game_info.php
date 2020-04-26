<?php

include(SZS_ROOT_PATH."source/config/play/system.php");
$uid = isset($_GET[uid]) ?$_GET[uid] : $_POST[uid];
$active = isset($_GET[active]) ?$_GET[active] : $_POST[active];
$flags="yes";
if($uid==""){echo "未找到此投注单!;<script>setTimeout('parent.pop.close();',1000);</script>";exit;}
if($active=="edit"){
$game_info	= array();
$game_info_sql = "select b.*,u.username,g.fullname as playname,l.fullname as wanfa,l.cate as wancode,l.help from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as g,".DB_PREFIX."game_ssc_list as l where (b.id='$uid' or b.buyid='$uid') and b.list_id=l.skey and g.ckey=b.playkey and u.userid=b.userid";
$game_info	= $db->fetch_first($game_info_sql);
if($game_info[id]==""){echo "未找到此投注单!;<script>setTimeout('parent.pop.close();',1000);</script>";exit;}
}
if($active=="save"){
include(SZS_ROOT_PATH."source/function/run.php");
$game_info	= array();
$game_info_sql = "select b.*,u.username,g.fullname as playname,l.fullname as wanfa,l.cate as wancode,l.help from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as g,".DB_PREFIX."game_ssc_list as l where (b.id='$uid' or b.buyid='$uid') and b.list_id=l.skey and g.ckey=b.playkey and u.userid=b.userid";
$game_info	= $db->fetch_first($game_info_sql);
$play_path=core_fun::rePath('games');
$dates=date('Ymd',strtotime($game_info['creatdate']));
$play_path=$play_path.core_fun::hexEncode($dates);
$names=$game_info['userid']."#".$game_info['buyid'];
$myfile=$play_path."/".$names.".aspx";
if (file_exists($myfile) &&$overwrite != true){
unlink($myfile);
}
$creatdate = isset($_POST[creatdate]) ?$_POST[creatdate] : $game_info['creatdate'];
$period = isset($_POST[period]) ?$_POST[period] : $game_info['period'];
$times = isset($_POST[times]) ?$_POST[times] : $game_info['times'];
$money = isset($_POST[money]) ?$_POST[money] : $game_info['money'];
$number = isset($_POST[number]) ?$_POST[number] : $game_info['number'];
$prize_time = isset($_POST[prize_time]) ?$_POST[prize_time] : $game_info['prize_time'];
$status = isset($_POST[status]) ?$_POST[status] : $game_info['status'];
$uid=$game_info['id'];$floatid=$game_info['buyid'];$perid=$game_info['userid'];$gamekey=$game_info['playkey'];
$playid=$game_info['list_id'];$nums=$game_info['nums'];
$CurMode=$game_info['pri_mode'];$CurModeType=$game_info['ModeType'];$modes=$game_info['modes'];
$is_zuih=$game_info['is_zuih'];$z_number=$game_info['z_number'];
$flag=Core_Fun::Gamelog($uid,$floatid,$perid,$gamekey,$playid,$period,$number,$nums,$times,$CurMode,$CurModeType,$modes,$money,$is_zuih,$z_number,$prize_time,$creatdate);
if($flag=="yes"){
$strSql="update ".DB_PREFIX."game_buylist set creatdate='$creatdate',period='$period',times='$times',money='$money',number='$number',prize_time='$prize_time',status='$status' where id='$uid'";
$db->query($strSql);
echo "操作成功!;<script>setTimeout('parent.pop.close();',1000);</script>";
}else{
{echo "读取信息失败!;<script>setTimeout('parent.pop.close();',1000);</script>";exit;}
}
exit;
}
;echo '<head> 
<style type="text/css"> 
body{font-size:12px;}
div{font-size:12px;}
td{font-size:12px;height:18px;}
th{font-size:12px;height:20px;}
</style>
</head>
<script type="text/javascript" src="';echo SZS_ROOT_URL;;echo 'js/common.js"></script> 
<table height=450 width="100%" cellpadding="4" cellspacing="1" bgcolor="#999999">
<form action="';echo $do_url."?mod=edit&code=game&list=info&flag=yes&active=save&uid=".$uid;;echo '" method="post" name="form1" id="form1">
<input id=\'nowtime\' value=\'';echo $nowtime;;echo '\' style=\'display:none\'>
<input id=\'pri_time\' value=\'';echo $pri_time;;echo '\' style=\'display:none\'>
<input id=\'pri_date\' value=\'';echo $pri_date;;echo '\' style=\'display:none\'>
<input id=\'pri_mode\' value=\'';echo $rowss[pri_mode];;echo '\' style=\'display:none\'>
<tr height="30"> 
<td width="15%" align="right" bgcolor="#CCCCCC" class="narrow-label" style=\'overflow:hidden\'>注单编号:</td>
<td width="35%" align="left" bgcolor="#FFFFFF">
     <div style="word-wrap: break-word;word-break:break-all;">';echo $game_info[buyid];;echo '</div>
</td>
<td width="15%" align="right" bgcolor="#CCCCCC" class="narrow-label">游戏:</td>
<td width="35%" align="left" bgcolor="#FFFFFF">';echo $game_info[playname];;echo '</td>
</tr>
<tr height="30">
<td align="right" bgcolor="#CCCCCC" class="narrow-label">游戏用户:</td>
<td align="left" bgcolor="#FFFFFF">';echo $game_info[username];;echo '</td>
<td align="right" bgcolor="#CCCCCC" class="narrow-label">玩法:</td>
<td align="left" bgcolor="#FFFFFF">';echo $game_info[wancode]."-".$game_info[wanfa];;echo '</td>
</tr>
<tr height="30">
<td align="right" bgcolor="#CCCCCC" class="narrow-label">投单时间:</td>
<td align="left" bgcolor="#FFFFFF"><input id=\'creatdate\' name=\'creatdate\' value=\'';echo $game_info[creatdate];;echo '\'></td>
<td align="right" bgcolor="#CCCCCC" class="narrow-label">开奖时间:</td>
<td align="left" bgcolor="#FFFFFF"><input id=\'prize_time\' name=\'prize_time\' value=\'';echo $game_info[prize_time];;echo '\'></td>

';
if($game_info['is_zuih']=="yes"){
$this_url=$do_url."?mod=read&code=game&list=task&flag=yes&active=lot_back&uid=".$game_info['z_number'];
echo "&nbsp;&nbsp;[<a href='".$this_url."' class='blue'>追号列表</a>]</td>";
}
;echo ' 
</td>
</tr>
<tr height="30">
<td align="right" bgcolor="#CCCCCC" class="narrow-label">倍数:</td>
<td align="left" bgcolor="#FFFFFF"><input id=\'times\' name=\'times\' value=\'';echo $game_info[times];;echo '\'></td>
<td align="right" bgcolor="#CCCCCC" class="narrow-label">期号:</td>
<td align="left" bgcolor="#FFFFFF"><input id=\'period\' name=\'period\' value=\'';echo $game_info[period];;echo '\'>
</tr>

<tr height="30">
<td align="right" bgcolor="#CCCCCC" class="narrow-label">投注总金额:</td>
<td align="left" bgcolor="#FFFFFF"><input id=\'money\' name=\'money\' value=\'';echo $game_info[money];;echo '\'></td>
<td align="right" bgcolor="#CCCCCC" class="narrow-label">状态:</td>
<td align="left" bgcolor="#FFFFFF">
<input type=checkbox name="status" id="status" value="0">改为“未开奖”
</td> 
</tr> 
<tr>
<td class="narrow-label"  align="right" valign="middle" bgcolor="#CCCCCC" class="narrow-label">投注内容:</td>
<td align="left" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;" colspan="3">
<textarea rows="10" cols="58" name="number" id="number">';echo $game_info[number];;echo '</textarea>
</td>
</tr>
<tr>
<td class="narrow-label"  align="left" valign="middle" bgcolor="#FFFFFF" class="narrow-label" colspan=4>
   <font color=\'#777777\' style=\'padding:5px;\'>提示：[改为“未开奖”]打上勾，则该投注单将重新派发返点及奖金。</font>
</td>  
</tr>
<tr height="30">
<td align="right" class="narrow-label"></td>
<td align="left" colspan="3"><input type="button" class="buttonnormal" value="关闭" onclick="parent.pop.close();">
 &nbsp;&nbsp;
<input type="submit" id="do_put_button" class="buttonnormal" value="提交">
</td>
</tr>
</form>
</table>
'
?>