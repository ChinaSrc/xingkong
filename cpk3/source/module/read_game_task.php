<?php

$uid=$_GET[uid];
$nowtime=date("Y-m-d H:i:s",time());
$flag="yes";
$game_info	= array();
$game_info_sql = "select b.*,u.username,g.fullname as playname,l.fullname as wanfa,l.code as wancode,l.example from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as g,".DB_PREFIX."game_ssc_list as l where (b.id='$uid' or b.buyid='$uid') and b.list_id=l.skey and g.ckey=b.playkey and u.userid=b.userid";
$game_info	= $db->fetch_first($game_info_sql);
if($game_info[id]==""){echo "'未找到此投注单!';<script>setTimeout('parentDialog.close();',1000);</script>";exit;}
$nowtime=date("Y-m-d H:i:s",time());
$prize_time=$game_info[prize_time];
if($game_info[status]!="0"){$disabled="style='display:none'";$flag="no";}
if($prize_time==""){
$disabled="style='display:none'";$flag="no";
}else{
$T_date=date("Ymd",time());
$T_time=date("His",time());
$pri_date=date('Ymd',strtotime($prize_time));
$pri_time=date('His',strtotime($prize_time));
if($T_date-$pri_date!=0){
$disabled="style='display:none'";$flag="no";
}else{
if($T_time-$pri_time>=0){$disabled="style='display:none'";$flag="no";}
if($pri_time-$T_time<=200){$disabled="style='display:none'";$flag="no";}
}
}
if($rowss[userid]-$userid!=0){$disabled="style='display:none'";$flag="no";}
;echo ' 
<head> 
<style type="text/css"> 
body{font-size:12px;}
div{font-size:12px;}
td{font-size:12px;height:18px;}
th{font-size:12px;height:20px;}
.links{color:blue;cursor:pointer;text-decoration:underline;}
</style>
<script type="text/javascript" src="';echo SZS_ROOT_URL;;echo 'js/common.js"></script> 
</head>
';echo "<script>var ROOT_URL='".SZS_ROOT_URL."'</script>";;echo ' 
<table height=600 width="100%" cellpadding="4" cellspacing="1" bgcolor="#999999">
<tr>
<td width=20%  align="right" bgcolor="#CCCCCC" >追号编号：</td>
<td width=40% bgcolor="#FFFFFF"><font style=\'font-size:11px;overflow:hidden;\'>';echo $game_info[buyid];;echo '</font></td>
<td width=18%  align="right" bgcolor="#CCCCCC" >游戏：</td>
<td width=22% bgcolor="#FFFFFF">';echo $game_info[playname];;echo '</td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >游戏用户：</td>
<td bgcolor="#FFFFFF">';echo $game_info[username];;echo '</td>
<td  align="right" bgcolor="#CCCCCC" >玩法：</td>
<td bgcolor="#FFFFFF">';echo $game_info[wancode]."-".$game_info[wanfa];;echo '</td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >追号时间：</td>
<td bgcolor="#FFFFFF">';echo $game_info[creatdate];;echo '</td>
<td  align="right" bgcolor="#CCCCCC" >开始期号：</td>
<td bgcolor="#FFFFFF">';echo $game_info[period];;echo '</td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >追号期数：</td>
<td bgcolor="#FFFFFF"><span id=\'all_task_num\' style=\'display:none\'></span></td>
<td  align="right" bgcolor="#CCCCCC" >完成期数：</td>
<td bgcolor="#FFFFFF"><span id=\'isok_task_num\' style=\'display:none\'></span></td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >取消期数：</td>
<td bgcolor="#FFFFFF"><span id=\'back_task_num\' style=\'display:none\'></span></td>
<td  align="right" bgcolor="#CCCCCC" >追号总金额：</td>
<td bgcolor="#FFFFFF"><span id=\'all_task_money\' style=\'display:none\'></span></td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >完成金额：</td>
<td bgcolor="#FFFFFF"><span id=\'isok_task_money\' style=\'display:none\'></span></td>
<td  align="right" bgcolor="#CCCCCC" >取消金额：</td>
<td bgcolor="#FFFFFF"><span id=\'back_task_money\' style=\'display:none\'></span></td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >中奖后终止：</td>
<td bgcolor="#FFFFFF">';if($game_info[is_zuih_pri_stop]=="1"){echo "是";}else{echo "否";};echo '</td>
<td  align="right" bgcolor="#CCCCCC" >追号状态：</td>
<td bgcolor="#FFFFFF"><span id=\'task_status\' style=\'display:none\'></span></td>
</tr>
<tr>
<td  align="right" bgcolor="#CCCCCC" >模式：</td>
<td bgcolor="#FFFFFF" colspan=3>';echo $game_info[modes];;echo '</span></td>
</tr>
<tr>
<td  align="right" valign="top" bgcolor="#CCCCCC" >追号内容：</td>
<td align="left" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;" colspan="3">
<textarea rows="4" cols="50" readonly>';echo $game_info[number];;echo '</textarea>
</td>
</tr>
<tr height=30>
<td  bgcolor="#FFFFFF"></td>
<td colspan=3 bgcolor="#FFFFFF"><input type="button" class="buttonnormal" value="关闭" onclick="parentDialog.close()">
';
if($game_info[is_succeed]=="yes"){
$this_uid=$game_info['z_number'];
}else{
$this_uid=$game_info['id'];
}
if($flag=="yes"){
echo "<input type='button' class='buttonnormal' value='撤单' style='display:none' ".$disabled."  onclick=\"winPop({title:'撤单提示',form:'Form1',width:'300',height:'100',url:'dialog_simple.aspx?action=lot_back&uid=".$this_uid."&money=".$game_info[money]."&nexts=close'})\">";
}
;echo '
</td>
</tr>
<tr>
<td colspan=4  bgcolor="#FFFFFF">
<div style="line-height:20px;overflow-y:auto;overflow-x:hidden;border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC;padding:1px;">
<table width="100%" cellpadding="4" cellspacing="1" bgcolor="#999999" align=center valign=middle>
<form id="Form" action="./?controller=gameinfo&action=canceltask" method="post">  
<tr  bgcolor="#CCCCCC"><th height="43" align="center" width=15%><input type="checkbox" name="chkall" id="chkall" onclick="SelectAll(\'select_rows[]\')" />全选
&nbsp;
';
if($flag=="yes"){
echo "<input type='button' id='yes_button' value='撤单' onclick='Lot_All_Back()'>";
}
;echo '</th> 
<th align="center" class="line_03">倍数</th>
<th align="center" class="line_03">开奖时间</th>
<th align="center" class="line_03">追号状态</th>
<th align="center" class="line_03">操作</th>
</tr> 
 
';
$get_a   = array();$user_lists   = array();
$get_a_sql = "select id,buyid,period,times,money,pri_money,prize_time,status from ".DB_PREFIX."game_buylist where z_number='$this_uid' order by period";
$get_a     = $db->getall($get_a_sql);
if($get_a){
$all_money=0;$all_num=0;$com_money=0;$com_num=0;$back_money=0;$back_num=0;$over_money=0;$over_num=0;$listnums=0;
$zuih_status="已完成";
for ($i=0;$i<count($get_a);$i++){
$status="";$do_task="";$show_task="no";
$pri_time_s=date('YmdHis',strtotime($get_a[$i][prize_time]));
$now_time_s=core_fun::nowtime('','yes');;
if($pri_time_s-$now_time_s>0){$show_task="yes";}
if($get_a[$i][status]=="0"and $show_task=="yes"){
$do_task="<input type='checkbox' id='select_rows' name='select_rows[]' value='".$get_a[$i][id]."' />";
$listnums++;
}
if($get_a[$i][status]=="0"){$com_money+=$get_a[$i][money];$com_num+=1;$status="<font style='color:#777777'>进行中</font>";}
if($get_a[$i][status]>0 and $get_a[$i][status]<4){
$over_money+=$get_a[$i][money];$over_num+=1;
if($get_a[$i][isprize]=="yes"){$status="已中奖";}else{$status="<font style='color:green'>已完成</font>";}
}
if($get_a[$i][status]=="9"){$back_money+=$get_a[$i][money];$back_num+=1;$status="<font style='color:blue'>已撤单</font>";}
echo "<tr align='center'>";
echo "  <td height='37' bgcolor='#FFFFFFF'>";
echo $do_task.$get_a[$i][period]."<input id='mon_".$get_a[$i][id]."' value='".$get_a[$i][money]."' style='display:none'>";
echo "<input id='pri_time_".$get_a[$i][id]."' value='".$get_a[$i][prize_time]."' style='display:none'>";
echo "  </td>";
echo "  <td bgcolor='#FFFFFFF'>".$get_a[$i][times]."倍</td>";
if($get_a[$i][period]==$game_info[period]){$zuih_status="进行中";}
$all_money+=$get_a[$i][money];$all_num+=1;
echo "  <td bgcolor='#FFFFFFF'>".$get_a[$i][prize_time]."</td>";
echo "  <td bgcolor='#FFFFFFF'>".$status."</td>";
echo "  <td bgcolor='#FFFFFFF'>";
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$get_a[$i][id];
echo "    <a href='".$this_url."' class='blue'>详情</a>";
$this_url=$do_url."?mod=back&code=game&list=info&flag=yes&active=lot_back&uid=".$get_a[$i][id];
if($show_task=="yes"and 9-$get_a[$i][status]>0){
if($flag=="yes"){
echo "&nbsp;&nbsp;<a  class='links' onclick=\"winPop({title:'撤单',width:'300',height:'100',drag:true,url:'".$this_url."'})\">撤单</a>";
}
}
echo "</td>";
echo "</tr>";
}
}
if($zuih_status==""){$zuih_status="进行中";}
echo "<input id='zuih_status' value='".$zuih_status."' style='display:none'>";
echo "<input id='all_money' value='".$all_money."' style='display:none'>";
echo "<input id='all_num' value='".$all_num."' style='display:none'>";
echo "<input id='com_money' value='".$com_money."' style='display:none'>";
echo "<input id='com_num' value='".$com_num."' style='display:none'>";
echo "<input id='back_money' value='".$back_money."' style='display:none'>";
echo "<input id='back_num' value='".$back_num."' style='display:none'>";
echo "<input id='over_money' value='".$over_money."' style='display:none'>";
echo "<input id='over_num' value='".$over_num."' style='display:none'>";
;echo ' 
</form> 
</table>
</div>
</td>
</tr>
</table>

<script> 
function Lot_All_Back(){
	 
	if(document.getElementById(\'yes_button\')){
		document.getElementById(\'yes_button\').setAttribute(\'disabled\',true);
	}
	var max_list=0;var is_ok=0;
	var e=document.getElementsByName(\'select_rows[]\');  
	for (i=0;i<e.length;i++)
	{    
		 if(e[i].checked==true){ 
			 is_ok+=1; 
			 ajaxobj=new AJAXRequest;
			 ajaxobj.method="POST";
			 ajaxobj.content=""; 
			 ajaxobj.url=ROOT_URL+"/do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&uid="+e[i].value;
			 ajaxobj.callback=function(xmlobj){
					  var response = Trim(xmlobj.responseText); 
			 }
			 ajaxobj.send()  
		 }
	}
	if(is_ok-1<0){alert("请选择要撤销的投注单");G("yes_button").removeAttribute(\'disabled\');
	}else{
		alert("恭喜，您已成功撤单 "+is_ok+" 注！");
		setTimeout("parentDialog.close();",100);
	}
}
 
var zuih_status=G(\'zuih_status\').value;
G(\'task_status\').innerHTML=zuih_status;
G(\'task_status\').style.display="";

var all_money=parseFloat(G(\'all_money\').value);
var back_money=parseFloat(G(\'back_money\').value);
var com_money=parseFloat(G(\'com_money\').value);
var over_money=parseFloat(G(\'over_money\').value);
var all_num=parseFloat(G(\'all_num\').value);
var back_num=parseFloat(G(\'back_num\').value);
var com_num=parseFloat(G(\'com_num\').value);
var over_num=parseFloat(G(\'over_num\').value);

if(all_num>0){G(\'all_task_num\').innerHTML=all_num+"期";G(\'all_task_num\').style.display="";}
if(com_num>0){G(\'isok_task_num\').innerHTML=over_num+"期";G(\'isok_task_num\').style.display="";}
if(back_num>0){G(\'back_task_num\').innerHTML=back_num+"期";G(\'back_task_num\').style.display="";}
if(all_money>0){G(\'all_task_money\').innerHTML=moneyFormat(all_money);G(\'all_task_money\').style.display="";}
if(com_money>0){G(\'isok_task_money\').innerHTML=moneyFormat(over_money);G(\'isok_task_money\').style.display="";}
if(back_money>0){G(\'back_task_money\').innerHTML=moneyFormat(back_money); G(\'back_task_money\').style.display="";}
 
</script>
 

 
 
';
?>