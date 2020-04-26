<?php
 
$perid=$_GET['perid'];
$modes=$_GET['modes'];
$comes=$_GET['comes'];
$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
if($perid==""){$uid=$userid;}else{$uid=$perid;}
$is_hig=getsql::islower($userid,$uid);
if($is_hig=="no"and $comes!='demo'){
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>该会员不是您的下级，不能查看！</div>";
echo "<script>setTimeout('history.back();',1000) </script>";
exit;
}
$per_info   = array();
$per_info_sql = "select u.username,u.nickname,u.isproxy,u.higherid,u.role,b.hig_amount from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid='$uid' and b.userid=u.userid";
$per_info     = $db->fetch_first($per_info_sql);
$sys_info=getsql::sys("MaxBonus,MinBonus");
$MaxBonus=$sys_info[MaxBonus];
$MinBonus=$sys_info[MinBonus];
$modes_arr=getsql::usermode($userid);
$sysmode_arr=getsql::sysmode();
$mode_list=array_intersect($modes_arr,$sysmode_arr);
if($modes==""){$modes=$mode_list[0];}
$lastcode="";$higherid=$per_info[higherid];
if($comes=='demo'){$dbnames=DB_PREFIX."user_rebate_demo";$uid=$userid;$higherid=$userid;}else{$dbnames=DB_PREFIX."user_rebate";}
$per_re_arr = array();
$per_re_sql = "select r.number,r.PlayKey,r.ItemKey from ".$dbnames." as r where r.userid='$uid' and r.Modes='$modes'";
$per_re_arr = $db->getall($per_re_sql);
if($uid-1>=0){
$hig_re_arr = array();
$hig_re_sql = "select r.number,r.PlayKey,r.ItemKey from ".DB_PREFIX."user_rebate as r where r.userid='$higherid' and r.Modes='$modes'";
$hig_re_arr = $db->getall($hig_re_sql);
}
function get_renum($plays,$itemkey,$arr){
for($i=0;$i<count($arr);$i++){
if($arr[$i][PlayKey]==$plays and $arr[$i][ItemKey]==$itemkey){
return $arr[$i][number];
break;
}
}
}
$u_info_s=getsql::userinfo($userid,"role");
$u_role=$u_info_s['role'];
if($active=="put"){
$is_show_a="";$is_show="";
for($i=0;$i<count($game_arr);$i++){
$playkey=$game_arr[$i][ckey];
$hi_zc_num=get_renum($playkey,"Normal",$hig_re_arr);
$this_re_num=get_renum($playkey,"Normal",$per_re_arr);
$post_item_zc="zc_".$playkey;$is_ok="yes";
$zc_input = isset($_POST[$post_item_zc]) ?$_POST[$post_item_zc] : $_GET[$post_item_zc];
if($zc_input){
$zc_input=(float)$zc_input;
if($u_role-6<0){
if($uid-$userid>0){if($this_re_num-$zc_input>0){$is_ok="no";$is_show_a="修改的返点不能低于当前返点值";}}
if($zc_input-$MaxBonus>0){$is_ok="no";$is_show_b="返点值不能超出系统最大返点范围";}
if($hi_zc_num-$MinBonus-$zc_input<0){$is_ok="no";$is_show_b="返点值不能超出最大返点范围";}
}
if($is_ok="yes"){
$zc_ys=$zc_input/$MinBonus;if(strpos($zc_ys,'.')){$is_ok="no";$is_show_a="输入的返点值不符合要求";}
}
}else{$is_ok="no";}
if($is_ok=="yes"){
$array  = array(
'userid'=>$uid,
'PlayKey'=>$playkey,
'ItemKey'=>'Normal',
'Modes'=>$modes,
'number'=>$zc_input
);
if($this_re_num){
$db->update($dbnames,$array,"userid='".$uid."' and PlayKey='".$playkey."' and ItemKey='Normal' and Modes='".$modes."'");
}else{
$db->insert($dbnames,$array);
}
$is_show="操作成功";
}
$hi_bdw_num=get_renum($playkey,"Second",$hig_re_arr);
$this_bdw_num=get_renum($playkey,"Second",$per_re_arr);
$post_item_bdw="bdw_".$playkey;$is_ok="yes";
$bdw_input = isset($_POST[$post_item_bdw]) ?$_POST[$post_item_bdw] : $_GET[$post_item_bdw];
if($bdw_input){
$bdw_input=(float)$bdw_input;
if($u_role-6<0){
if($uid-$userid>0){if($this_bdw_num-$bdw_input>0){$is_ok="no";$is_show_a="返点不能低于当前返点值";}}
if($bdw_input-$MaxBonus>0){$is_ok="no";$is_show_b="返点值不能超出系统最大返点范围";}
if($hi_bdw_num-$MinBonus-$bdw_input<0){$is_ok="no";$is_show_b="返点值不能超出最大返点范围";}
}
if($is_ok=="yes"){
$bdw_ys=$bdw_input/$MinBonus;if(strpos($bdw_ys,'.')){$is_ok="no";$is_show_a="输入的返点值不符合要求";}
}
}else{$is_ok="no";}
if($is_ok=="yes"){
$array  = array(
'userid'=>$uid,
'PlayKey'=>$playkey,
'ItemKey'=>'Second',
'Modes'=>$modes,
'number'=>$bdw_input
);
if($this_bdw_num){
$db->update($dbnames,$array,"userid='".$uid."' and PlayKey='".$playkey."' and ItemKey='Second' and Modes='".$modes."'");
}else{
$db->insert($dbnames,$array);
}
$is_show="操作成功";
}
}
if($is_show=="操作成功"){$lines="有未生效项：";}else{$lines="保存失败：";}
$re_infor=$is_show;
if($is_show_a or $is_show_b){
if($is_show_a){$t_line="，";}else{$t_line="";}
$re_infor.="<br><font color='blue'>".$lines.$is_show_a.$t_line.$is_show_b."</font>";
}
echo "<div style='text-align:center;background:#FFFFFF;font-size:12px;padding:10px 20px;line-height:20px;'>".$re_infor."</div>";
echo "<script>setTimeout('parent.window.location.reload();',2000)</script>";
echo "<script>setTimeout('parent.pop.close();',3000) </script>";
$db->close();
exit;
}
;echo ' 
 
<script type="text/javascript" src="';echo SZS_ROOT_URL;;echo 'js/common.js"></script> 
<script type="text/javascript" src="';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'js/rebate.js"></script> 
<link href=';echo SZS_ROOT_URL.INDEX_TEMPLATE;;echo 'style/games.v2010.css rel="stylesheet" type="text/css" /> 
<style>body{font-size:12px;background:#ffffff;}</style>
<div ';echo $div_style;;echo '>
<table width="100%" border="0" cellspacing="1" cellpadding="4" class=\'table_b\' style="font-size:12px;display:none"> 
   <tr class=\'table_b_th\'> 
       <th colspan=4 align=left>用户信息</th>
   </tr> 
   <tr class=\'table_b_tr_b\'> 
       <td>用户名</td><td>';echo $per_info[username];;echo '</td>
	   <td>用户昵称</td><td>';echo $per_info[nickname];;echo '</td>
   </tr> 
   <tr class=\'table_b_tr_b\'> 
       <td>用户等级</td><td>';if($per_info[isproxy]==0){echo "代理";}else{echo "用户";};echo '</td>
	   <td>用户余额</td><td>';echo $per_info[hig_amount];;echo '</td>
   </tr> 
   <tr class=\'table_b_th\' style=\'display:none\'> 
       <td colspan=4 align=left>
	      <input value=\'';echo $MaxBonus;;echo '\' id=\'MaxBonus\' name=\'MaxBonus\'>
	      <input value=\'';echo $MinBonus;;echo '\' id=\'MinBonus\' name=\'MinBonus\'>
		  <input typ=\'text\' value=\'';echo $per_info[role];;echo '\' id=\'user_role\' name=\'user_role\' style=\'display:none\'>
	   </td>
   </tr>
</table> 
<table width="100%" border="0" cellspacing="1" cellpadding="4" class=\'table_b\' style="font-size:12px;"> 
<form action="';echo $do_this_url;;echo '&flag=yes&perid=';echo $perid;;echo '&modes=';echo $modes;;echo '&active=put&comes=';echo $comes;;echo '" method="post" name="form1" id="form1"> 
   <tr class=\'table_b_th\'> 
       <th colspan=4 align=left>&nbsp;&nbsp;
	   ';
if($comes=="add"){echo "注册成功，下一步：";}
;echo '	   设置 <font class=\'font_title_1 font_line_2\'>[ ';echo $per_info[username];;echo ' ]</font> 的
	   ';
$add_demos="";
if($comes=="demo"){$add_demos= "(下级返点模板)";}
;echo '	   返点';echo $add_demos;;echo '</th>
   </tr>
   <tr align=center class=\'table_b_tr_b\'> 
	  <td colspan=3>
	      <dl style="text-align:left;padding-left:10px;line-height:20px;" class="font_line_3">
		     <dd>1、上级设置了返点，其下级才能设置返点，上下级返点差为[';echo $MinBonus;;echo '];</dt>
			 <dd>2、修改下级返点时，所改的返点值不能小于已设的返点值;</dd>
			 <dd class=\'font_title_1 font_line_1\'>3、按要求正确填写好返点值后，请点击“提交”按钮;</dd>
		     
		  </dl>
	  </td> 
   </tr> 
   <tr class=\'table_b_tr_a\'> 
       <td colspan=4 align=left>
	   <div id=\'mode_div_a\'>
	      <ul id=\'mode_ul_a\'> 
	   ';
for($i=0;$i<count($mode_list);$i++){
if($mode_list[$i]==$modes){
echo "<li class='cur'>".$mode_list[$i]."</li>";
}else{
echo "<a href='".$do_url."?mod=user&code=rebate&perid=".$uid."&flag=yes&modes=".$mode_list[$i]."&comes=".$comes."'><li class='nor'>".$mode_list[$i]."</li></a>";
}
}
;echo '	   </ul>
	   <ul style=\'text-align:center\'> 
	   <input type=\'submit\' name=\'submit\' id=\'btsubmit\' value=\'提　交\' class=\'button_10_25_b\' onclick="return winPop({title:\'设置返点\',form:\'form1\',ishow:\'true\',drag:\'true\',width:\'400\',height:\'100\',iclose:\'true\',url:\'确定？\'})">&nbsp;&nbsp;
	   ';
if($comes=="add"or $comes=="demo"){
echo "<input type='button' name='resubmit' id='resubmit' value='关　闭' class='button_10_25_b' onclick=\"parentDialog.close();\">";
}else{
echo "<input type='button' name='resubmit' id='resubmit' value='返　回' class='button_10_25_b' onclick=\"window.location.href='".SZS_ROOT_URL."do.aspx?mod=user&code=list&list=body'\">";
}
;echo '	   
	   </ul>
	  </div>
	   </td>
   </tr> 
   <tr class=\'table_b_tr_b\'> 
       <td>彩种(模式)</td> 
	   <td>
	        <input class="inpt" id=\'all_other\' name=\'all_other\' value=\'\' size=3>
	        <label>%</label>
	        <input onClick="Save_Ret_input(\'other\')" value=\'统一设置\' class="defbtn" type=\'button\'>
	        <input onClick="Save_Ret_value(\'';echo $modes;;echo '\',\'';echo $perid;;echo '\',\'other\')"  class="defbtn"  value=\'保存\' type=\'button\' style=\'display:none\'>
	   </td>
	   <td>
	        <input class="inpt"  id=\'all_bdw\' value=\'\' size=3>
	        <label>%</label>
	        <input onClick="Save_Ret_input(\'bdw\')" value=\'统一设置\' class="defbtn"  type=\'button\'>
	        <input onClick="Save_Ret_value(\'';echo $modes;;echo '\',\'';echo $perid;;echo '\',\'bdw\')"  class="defbtn"  value=\'保存\' type=\'button\' style=\'display:none\'>
	   </td>
   </tr>
   <style>input{text-align:center;line-height:16px;}</style>
   ';
for($i=0;$i<count($game_arr);$i++){
$fullname=$game_arr[$i][fullname];
$playkey=$game_arr[$i][ckey];
$skey=$game_arr[$i][skey];
if($playkey_lists==""){$playkey_lists=$playkey;}else{$playkey_lists.="|".$playkey;}
$hi_re_num=get_renum($playkey,"Normal",$hig_re_arr);
$this_re_num=get_renum($playkey,"Normal",$per_re_arr);
if($hi_re_num){
$hi_re_num=$hi_re_num-$MinBonus;
$arouds="&nbsp;<font class='font_say'>(范围：0~".$hi_re_num."%)</font>";
$other_body="<input id='zc_".$playkey."' name='zc_".$playkey."' value='".$this_re_num."' size=4>&nbsp;%".$arouds;
}else{
if($u_role-6>=0){
$hi_re_num=$MaxBonus;$arouds="&nbsp;<font class='font_say'>(范围：0~".$hi_re_num."%)</font>";
$other_body="<input id='zc_".$playkey."' name='zc_".$playkey."' value='".$this_re_num."' size=4>&nbsp;%".$arouds;
}else{
$other_body="";
}
}
$bdw_re_num=get_renum($playkey,"Second",$hig_re_arr);
$this_bdw_num=get_renum($playkey,"Second",$per_re_arr);
if($bdw_re_num){
$bdw_re_num=$bdw_re_num-$MinBonus;$bdw_arouds="&nbsp;<font class='font_say'>(范围：0~".$bdw_re_num."%)</font>";
$bdw_body="<input id='bdw_".$playkey."' name='bdw_".$playkey."' value='".$this_bdw_num."' size=4>&nbsp;%".$bdw_arouds;
}else{
if($u_role-6>=0){
$bdw_re_num=$MaxBonus;$bdw_arouds="&nbsp;<font class='font_say'>(范围：0~".$bdw_re_num."%)</font>";
$bdw_body="<input id='bdw_".$playkey."' name='bdw_".$playkey."' value='".$this_bdw_num."' size=4>&nbsp;%".$bdw_arouds;
}else{
$bdw_body="";
}
}
if($lastcode==$skey){
echo"<tr align=center class='table_b_tr_b'>";
echo "<td align=center class='font_title_1 '>".$fullname."&nbsp;<font class='font_say'>[".$modes."]</font></td>";
echo "<td>".$other_body;
echo "</td>";
echo "<td>".$bdw_body;
echo "</td>";
echo "</tr>";
}else{
echo "<tr align=center class='table_b_tr_a'><td><font class='font_title_1 font_line_1'>".$game_code[$skey]."</td>";
echo "<td><font class='font_title_1 font_line_1'>所有玩法返点（不定位除外）</td>";
echo "<td><font class='font_title_1 font_line_1'>不定位类型返点</td></tr>";
echo "<tr align=center class='table_b_tr_b'>";
echo "<td align=center class='font_title_1 '>".$fullname."&nbsp;<font class='font_say'>[".$modes."]</font></td>";
echo "<td>".$other_body;
echo "</td>";
echo "<td>".$bdw_body;
echo "</td>";
echo "</tr>";
}
$lastcode=$skey;
}
;echo '   <input type=\'hidden\' id=\'playkey_lists\' name=\'playkey_lists\' value=\'';echo $playkey_lists;;echo '\'> 
   <input type=\'hidden\' id=\'flags\' value=\'\'>
   
   </form>
</table>  
</div> ';
?>