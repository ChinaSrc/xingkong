<?php
 
$playkey=$_GET['playkey'];
$per_Get=$_GET[pername];
$per_Post=$_POST[pername];
if($per_Get!=""){$pername=$per_Get;}
if($per_Post!=""){$pername=$per_Post;}
$disableds="";
if($pername==""){$disableds="disabled";}else{
$sql_id="select userid,higherid,modes from user where username='$pername'";
$result1=mysql_query($sql_id);
$num1=mysql_num_rows($result1);
if($num1){
$curpername="&nbsp;当前用户：".$pername;$rows1=mysql_fetch_array($result1);
}else{
$curpername="&nbsp;未找到用户：［".$pername."］";$disableds="disabled";
}
}
$perid=$rows1[userid];
$higherid=$rows1[higherid];
$mode_long=$rows1[modes];
$list_mode=explode("|",$mode_long);
$mode=$_GET['mode'];
if($mode==""){$mode=$list_mode[0];}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
$userid=$_SESSION["userid"];
$sql60="select user.role from user where user.userid='$userid'";
$result60=mysql_query($sql60);
$rows60=mysql_fetch_array($result60);
$user_role=$rows60[role];
if($user_role==""){$user_role=0;}
;echo '<style>
/*设置游戏标签*/
.tab-front {
    color: #FFF;
    font-weight: bold;
    background-image: url(/highgame/images/new_higame/menu_01.png);
    background-repeat:repeat-x;
    background-position: 0px -59px;
}
.tab-back {
    background-image: url(/highgame/images/new_higame/menu_01.png);
    background-position: -105px -30px;
}
.title_a{
	font-weight:bold;font-size:14px;
}
</style>
<script language="javascript" src="';echo ROOT_URL;;echo '/js/rebate.js"></script>
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 

 <form name="myform" id="myform" method="post" action="';echo ROOT_URL."/".$AdminPath;;echo '/?controller=system&action=point"> 
  <tr>
    <td width="20%" align="right">&nbsp;用户名:</td>
    <td width="80%" align=left>
      <input name="pername"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" />
	  <input typ=\'text\' value=\'';echo $user_role;;echo '\' id=\'user_role\' name=\'user_role\' style=\'display:none\'></td>
 </tr> 
   <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
  <tr>
    <td>&nbsp;</td>
    <td align=left><input type="submit"  class="button" name="submit" value="提交" /></td>
  </tr>
 </form>

';$body_top_title="返点设置";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" ';echo $disableds;;echo '>
	    <tr align=left>
	       <td colspan="6" bgcolor="#FFFFFF">
			  <UL id=navlist >
			  ';
$sql_id="select MaxBonus,MinBonus,Modes from system where id='1'";
$result8=mysql_query($sql_id);
$rows8=mysql_fetch_array($result8);
$MaxBonus=$rows8[MaxBonus];
$MinBonus=$rows8[MinBonus];
echo "<input name='MaxBonus' id='MaxBonus' type='hidden' value=".$MaxBonus.">";
echo "<input name='MinBonus' id='MinBonus' type='hidden' value=".$MinBonus.">";
for ($i=0;$i<count($list_mode);$i++){
if($mode==""){$mode=$list_mode[$i];}
if($mode==$list_mode[$i]){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='".ROOT_URL."/".$AdminPath."/?controller=system&action=point&mode=".$list_mode[$i]."&pername=".$pername."'>".$list_mode[$i]."</A></LI>";
}
$show_mode_c=$mode;
;echo ' 
              </UL> 
		   </td>
       </tr>
       ';echo $curpername;;echo '	   <tr height=35 id="title_931">
          <th width="20%" align="center" bgcolor="#FFFFFF">彩种</th>
          <th width="20%" align="center" bgcolor="#FFFFFF">奖金组</th> 
          <th width="30%" align="center" bgcolor="#FFFFFF"><input id=\'all_other\' value=\'\' size=6>% <input onclick="Save_Ret_input(\'other\')" value=\'统一设置\' type=\'button\'><input onclick="Save_Ret_value(\'';echo $mode;;echo '\',\'';echo $perid;;echo '\',\'other\')" value=\'保存\' type=\'button\'></th>   
          <th width="30%" align="center" bgcolor="#FFFFFF"><input id=\'all_bdw\' value=\'\' size=6>% <input onclick="Save_Ret_input(\'bdw\')" value=\'统一设置\' type=\'button\'><input onclick="Save_Ret_value(\'';echo $mode;;echo '\',\'';echo $perid;;echo '\',\'bdw\')" value=\'保存\' type=\'button\'></th>   
      </tr>  
      <input name="flag" type="hidden" value="save" />  
      ';
mysql_query("set names utf8;");
$sql5="select fullname,ckey,orders from game_type where status='0' order by orders ";
$result5=mysql_query($sql5);
$num5=mysql_num_rows($result5);
if($playkey==""){$playkey="CQSSC";}$sz_num=0;$lt_num=0;$jl_num=0;$dp_num=0;
if($num5 and $mode!=""){
while($rows5=mysql_fetch_array($result5)){
$playkey=$rows5[ckey];$orders=$rows5[orders];$bdw_body="";$other_body="";
if($playkey_lists==""){$playkey_lists=$playkey;}else{$playkey_lists.="|".$playkey;}
if($orders=='a_sz'){
include("point_a_sz.php");$sz_num+=1;
}
if($orders=='b_lt'){
include("point_b_lt.php");$lt_num+=1;
}
if($orders=='c_jl'){
include("point_c_jl.php");$jl_num+=1 ;
}
if($orders=='d_dp'){
include("point_d_dp.php");$dp_num+=1  ;
}
$play_title="";
if($sz_num==1 and $orders=='a_sz'){
$play_title="<tr height=35 style='background:#FFFFFF' align=center><td><font class='title_a'>数字型</td><td>&nbsp;</td>";
$play_title.="<td><font class='title_a'>所有玩法返点（不定位除外）</td>";
$play_title.="<td><font class='title_a'>不定位返点</td></tr>";
}
if($lt_num==1 and $orders=='b_lt'){
$play_title="<tr height=35 style='background:#FFFFFF' align=center><td><font class='title_a'>乐透型</td><td>&nbsp;</td>";
$play_title.="<td><font class='title_a'>所有玩法返点</td>";
$play_title.="<td><font class='title_a'>&nbsp;</td></tr>";
}
if($jl_num==1 and $orders=='c_jl'){
$play_title="<tr height=35 style='background:#FFFFFF' align=center><td><font class='title_a'>基诺型</td><td>&nbsp;</td>";
$play_title.="<td><font class='title_a'>任选型玩法返点</td>";
$play_title.="<td><font class='title_a'>趣味型玩法返点 </td></tr>";
}
if($dp_num==1 and $orders=='d_dp'){
$play_title="<tr height=35 style='background:#FFFFFF' align=center><td><font class='title_a'>低频</td><td>&nbsp;</td>";
$play_title.="<td><font class='title_a'>所有玩法返点</td>";
$play_title.="<td><font class='title_a'>&nbsp;</td></tr>";
}
echo $play_title;
echo "<tr height=35 style='background:#FFFFFF' align=center>";
echo "<td >".$rows5[ckey]."</td>";
echo "<td >".$rows5[ckey]."[".$show_mode_c."]</td>";
echo "<td >".$other_body."</td>";
echo "<td >".$bdw_body."</td>";
echo "</tr>";
}
}
;echo ' 
     
    <input type=\'hidden\' id=\'playkey_lists\' value=\'';echo $playkey_lists;;echo '\'> 
	<input type=\'hidden\' id=\'flags\' value=\'\'>
	   
  
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>