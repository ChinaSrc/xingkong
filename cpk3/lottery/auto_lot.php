<?php
echo '<META    http-equiv="refresh"    content="120 url=';echo ROOT_URL;;echo '/admin/?action=auto_lot">    
<style type="text/css"> 
html,body{width:100%;height:100%;font-size:12px;font-family:Arial,SimSun;color:#636363;}
body,td,a,div{margin:0px;padding:0px;}
.link_01{
	color:#0000FF;text-decoration:underline;cursor: hand;
}  
.input_G {
    border: solid #CD9B1D 1px solid;
    border-bottom: red 1px solid;
    border-left: red 2px solid;
    border-right: red 1px solid;
    border-top: red 2px solid;
    background-color: #EED2EE;
    cursor: hand;
	height:18px;size:30;
} 
.mouse_show{
	cursor: pointer;
}
</style>
<script type=\'text/javascript\' src=\'';echo ROOT_URL;;echo '/js/common.js\'></script>
<script type=\'text/javascript\' src=\'';echo ROOT_URL."/".$AdminPath;;echo '/js/main.js\'></script> 
<link rel="stylesheet" type="text/css" href="';echo ROOT_URL."/".$AdminPath;;echo '/images/style.css" media="all" />
<link href="';echo ROOT_URL."/".$AdminPath;;echo '/images/menu.css" rel="stylesheet" type="text/css" /> 
<script type=\'text/javascript\' src=\'';echo ROOT_URL."/".$AdminPath;;echo '/js/lot.js\'></script>
</head>
 
 <script> 
   var period="";var lotTimer;var PrizeTimer;var fandianTimer;
   lotTimer=window.setInterval("Prize_Lot(period)",10000);
   PrizeTimer=window.setInterval("fenpei_Prize()",12000);
   fandianTimer=window.setInterval("fandian_Prize()",15000);
   pritopTimer=window.setInterval("pri_top()",60000);
 </script>
';
echo "<BODY><div  style='display:none'><input value='".$thispath."' id='thisURL' style='display:none'><input value='".ROOT_URL."' id='rootURL' style='display:none'><input value='".$AdminPath."' id='pathName' style='display:none'></div>";
;echo '<table width="900" align=center border="0" cellpadding="4" cellspacing="1" bgcolor="#777777" style=\'margin-top:0px;\'>
  <TBODY>
     <tr height=30>
	    <td colspan=3 ><b><font color=#ffffff>获取开奖数据</font></b></td>
	 </tr>
	 <tr bgcolor=\'#FFFFFF\'>
	    <td colspan=3>
		  <div style=\'line-height:25px;color:red\'>注意：您只能打开一个当前页面，并且请不要关闭此页面，以便准时获取最新开奖数据...
		  </div>
		</td>
	 </tr>
     ';
mysql_query("set names utf8;");
$sql2="select fullname,ckey from game_type where status='0'";
$result2=mysql_query($sql2);
$now_id=0;$runtim=100;$play_list;
while($rows2=mysql_fetch_array($result2)){
if($play_list==""){$play_list=$rows2[ckey];}else{$play_list=$play_list."|".$rows2[ckey];}
$playkey=$rows2[ckey];$tr_begin="";$tr_end="";
if($now_id%3==0 or $now_id-1<0){$tr_begin="<tr bgcolor='#FFFFFF' height=120>";}
if(($now_id+1)%3==0){$tr_end="</tr>";}
echo $tr_begin;
$this_date=date("Ymd",time());
echo "<td width=33%>";
echo "<div style='line-height:20px;'><div style='float:left'>&nbsp;<b>".trim($rows2[fullname])."</b>&nbsp;|&nbsp;";
mysql_query("set names utf8;");
$sql5="select links from game_intface where playkey='$playkey' order by Level";
$result5=mysql_query($sql5);
$nums5=mysql_num_rows($result5);$links="";$link_num=1;
if($nums5){
while($rows5=mysql_fetch_array($result5)){
if($links==""){$links=$rows5[links];}else{$links.="^".$rows5[links];}
echo "<a href='".$rows5[links]."' target='_blank'>数据源".$link_num."</a>&nbsp;";
$link_num+=1;
}
}
echo "<input id='links_".$playkey."' value='".$links."' style='display:none'>";
echo "<input id='thisdate_".$playkey."' value='".$this_date."' style='display:none'>";
echo "</div>";
echo " <div style='float:right'><a href='javascript:void()' onclick=\"GetLot('".$rows2[ckey]."')\"><font color='#0000FF'>刷新</font></a></div>";
echo "</div><br>";
echo "<div style='line-height:20px;height:100px;margin:0px 3px;border:1px solid #CCCCCC;overflow:auto;'>";
echo "   <div style='height:100%;width:100%;BORDER-TOP:#c66800 1px solid;padding:3px;word-break:break-all;'>";
mysql_query("set names utf8;");
$sql4="select lotNum,lotTime from game_time where playKey='$playkey' order by lotTime";
$result4=mysql_query($sql4);
$nums4=mysql_num_rows($result4);$lotNum="";$lotTime="";$sy_num=0;$dq_num=0;$lasttimes=0;$lot_long=0;
if($nums4){
while($rows4=mysql_fetch_array($result4)){
if($lot_long==0){$lot_long=strlen($rows4[lotNum]);}
$thistimes=date("His",time());
$gettimes=trim(str_replace(":","",$rows4[lotTime]));
if($thistimes-$gettimes<0 and $thistimes-$lasttimes>0){$dq_num=$sy_num-1;}
if($lotNum==""){$lotNum=$rows4[lotNum];$lotTime=$rows4[lotTime];
}else{$lotNum.="|".$rows4[lotNum];$lotTime.="|".$rows4[lotTime];}
$sy_num=$sy_num+1;
$lasttimes=trim(str_replace(":","",$rows4[lotTime]));
}
}if($nums4-1==0){$dq_num=1;}
echo "<input id='qihaos_".$playkey."' value='' style='display:none'>";
echo "<input id='lotlong_".$playkey."' value='".$lot_long."' style='display:none'>";
echo "<input id='lotNum_".$playkey."' value='".$lotNum."' style='display:none'>";
echo "<input id='lotTime_".$playkey."' value='".$lotTime."' style='display:none'>";
echo "<input id='thisnum_".$playkey."' value='".$dq_num."' style='display:none'>";
echo "<input id='runtime_".$playkey."' value='".$runtim."' style='display:none'>";
echo "   <div style='height:98%;width:100%;word-break:break-all;font-size:12px;line-height:18px;' id='div_".$playkey."'>";
echo "<font color='#999999'>等待获取开奖号码...</font> ";
echo "   </div>";
echo "   </div>";
echo "</div>";
echo "</td>";
echo $tr_end;
$now_id+=1;
$runtim+=200;
}
echo "<input id='play_list' value='".$play_list."' style='display:none'>";
;echo '  </TBODY>
</TABLE>
<script>  
	writeCookie(\'sys_run_num\',1,1);
	var sys_run_num=getCookie("sys_run_num"); 
    window.setTimeout("GetLot(\'CQSSC\',\'"+sys_run_num+"\')",1000)  
 </script>
</body>';
?>