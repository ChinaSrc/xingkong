<?php
echo '
		<script type="text/javascript" src="';echo ROOT_URL;;echo '/dd/js/mln.colselect_navi.js"></script>
        <link href="';echo ROOT_URL;;echo '/dd/Style/mln-main.css" rel="stylesheet" type="text/css" charset="utf-8" />
		<link href="';echo ROOT_URL;;echo '/dd/Style/mln.colselect.css" rel="stylesheet" type="text/css">
<table width=100%>
   <tr height=105>
   <td align=center>
       <table width=1010 align=center>
          <tr  height=105>
		      <td align=center width=230 valign=top><!--logo图片------>  
		         <img src="';echo ROOT_URL;;echo '/images/logo.png"> 
		      </td>
		      <td align=left width=780 >
	   <!--用户信息------>
	   <div class=\'top_line_1_right_user\'>
	       <div class=\'top_line_1_right_infor\'>
           <font color=\'#FFFF00\'>欢迎你：</font><a href=\'';echo ROOT_URL."/".$GamePath;;echo '/do.aspx?controller=user&action=index&paras=first\' target=\'mainframe\'><font color="#00FF00">';echo $_SESSION["nickname"];;echo '</font></a>&nbsp;|&nbsp;
	       帐户余额：<span id="leftusermoney" style=\'color:#00FF00;font-weight:bold;display:inline-block;\'>';echo $_SESSION["hig_amount"];;echo '</span>&nbsp;<span style="cursor:pointer;text-decoration:underline;" onclick="GetUserMoney()" id="refreshimg"><font color="red">刷新</font></span>&nbsp;|&nbsp;<a href=\'';echo ROOT_URL;;echo '/highgame/do.aspx?controller=safe&action=safe_recharge\' target=\'mainframe\'><font color="#00FF00">充值</font></a>&nbsp;|&nbsp;<a href=\'';echo ROOT_URL;;echo '/highgame/do.aspx?controller=safe&action=safe_platform\' target=\'mainframe\'><font color="#FF0000">提现</font></a>
		   ';
if($SystemInfor[modes_gifts]=="1"){
echo "&nbsp;|&nbsp;<a href='".ROOT_URL."/highgame/do.aspx?controller=safe&action=user_gifts' target='mainframe'><font color='#FF0000'>领取购彩金</font></a>&nbsp;";
}
;echo '|&nbsp;<a href=\'';echo ROOT_URL;echo '/logout.aspx\'><font color="#FFFF00">安全退出</font></a>&nbsp;|&nbsp; 
		   ';
if($SystemInfor[ServiceUrl]!=""){
echo "<a href='".$SystemInfor[ServiceUrl]."' target='_blank'><font color='#00FF00'>联系客服</font></a>&nbsp;|&nbsp;";
}
$querys="default";$sqlclass="select";$wheres=" where status='0' and channel='0' order by creatdate desc limit 0,1";$select="*";$dbnames="bulletin";
include(ROOT_PATH.'/source/plugin/class.php');
$num_default=mysql_num_rows($result_default);
$fetch_default=mysql_fetch_array($result_default);
$bulletin_title=$fetch_default[title];
$bulletin_content=$fetch_default[content];
if($bulletin_title==""){$showInfor=$bulletin_content;}else{$showInfor=$bulletin_title;}
if(strlen($showInfor)-18>0){$showInfor=CutStr($showInfor,0,20,true);}
echo "最新公告：<a href='".ROOT_URL."/".$GamePath."/do.aspx?action=body&active=2&id=".$fetch_default[id]."' target='mainframe'><span id='top_notice'>".$showInfor."</span></a>";
;echo '           </div>
		   <div class=\'top_line_1_right_game\' style=\'display:none\'> <span id="colsel_exp"></span></div> 
		   <div class=\'clear\'></div>
		</div> 
		<!---奖金排行----------> 
		   <table height=75 width=100% border="0" cellspacing="1" cellpadding="1" bgcolor="#444444" style=\'margin:0px;\' align=left> 
		     <tr>
			    <td height=100% valign=top class=\'prize_top\' bgcolor="#444444" align=left style="overflow:hidden;"> 
				    <iframe name="prizetop" id="prizetop" frameborder="0" width="100%" height="75" scrolling="no" style="overflow:hidden;" src="';echo ROOT_URL."/".$AdminPath;;echo '/?controller=lottery&action=show_pri_top&flag=yes"></iframe> 
				</td>
			 </tr>
	       </table>
	      </td> 
	     </tr>
       </table>
   </td> 
</tr> 
<tr>
  <td align=center>
	   <div class=\'top_line_3\'>
   <div class=\'top_line_3_div\'>
      <a href="javascript:window.location.reload();">首 页</a>
	  ';
if($NaviList){
for ($i=0;$i<count($NaviList);$i++){
echo "<a href=\"javascript:GotoUrl('".$NaviKey[$i]."','".$NaveFirstUrl[$i]."')\">".$NaviList[$i]."</a>";
}
}
;echo '	  
   </div>
</div> 
	   </td>
   </tr>
</table>
 
';
$game_name_list="";
$querys="gametype";$sqlclass="select";$wheres=" where status='0'";
include(ROOT_PATH.'/source/plugin/class.php');
$num_gametype=mysql_num_rows($result_gametype);
if($num_gametype){
while($fetch_game=mysql_fetch_array($result_gametype)){
$game_key=$fetch_game[ckey];
$game_name=$fetch_game[fullname];
$game_cate=$fetch_game[cate];
$game_orders=$fetch_game[orders];
if($game_name_list==""){
$game_name_list=$game_key."|".$game_name."|".$game_cate."|".$game_orders;
}else{
$game_name_list.="^".$game_key."|".$game_name."|".$game_cate."|".$game_orders;
}
}
}
echo "<div style='display:none'><input value='".$game_name_list."' id='game_name_list'><input value='' id='logintime' size=30></div>";
;echo ' <script type=\'text/javascript\'>//javascript:window.top.frames[\'mainframe\'].document.location.reload();
 
 function GotoUrl(item,urls){ 
	 //window.top.frames[\'leftframe\'].document.location.href="http://localhost:8081/yudu/?&action=LeftNavi&leftnavi="+item; 
	 //window.top.frames[\'leftframe\'].document.location.href=G(\'RootUrl\').value+"/highgame/do.aspx?action=LeftNavi&leftnavi="+item+"&flag=first"; 
	 if(item=="game"){
		 document.getElementById("ul_a_sz").click();
	 }else{
		 document.getElementById("ul_"+item).click();
	 }
	 window.top.frames[\'mainframe\'].document.location.href=G(\'RootUrl\').value+"/highgame/do.aspx?controller="+item+"&action="+urls; 
 }
 function user_login_time(){
	window.clearInterval(loginTimer);
	var rooturl=document.getElementById(\'rootURL\').value;
    var gurl=rooturl+"/?comes=highgame&controller=&action=ajax_post_save&flag=yes&active=logintime" 
	var gconnet="";
	ajax_post_date("",gurl,gconnet,"logintime","no");
}
function user_prize_top(){
	window.top.frames[\'prizetop\'].location.reload();
	//window.top.frames[\'mainframe\'].document.location.href=G(\'RootUrl\').value+"/highgame/do.aspx?controller="+item+"&action="+urls; 
	setTimeout("user_prize_top()",60000);
}
setTimeout("user_prize_top()",30000);
//var loginTimer;loginTimer=window.setInterval("user_login_time()",2000); 
 function GotoPlay(orders,item){
	 window.top.frames[\'leftframe\'].document.getElementById("ul_"+orders).click();
	 window.top.frames[\'mainframe\'].document.location.href=G(\'RootUrl\').value+"/highgame/do.aspx?controller=game&action=game&paras="+item; 

	 //var colsel_exp=G(\'colsel_exp\').innerHTML;
	 /*点击事件之后的代码_navi*/
	  
 }
	  
function changecolor(){
	  var node  = document.getElementById("top_notice");//#33FF33
	  str = node.style.color.toLowerCase();
	  node.style.color = str == "#ffffff" || str == "rgb(255, 255, 0)" ? "#CCCCCC" : "#FFFFFF";  
	  setTimeout("changecolor()",1000);
}
setTimeout("changecolor()",1000);
</script>
    

';
?>