<?php

require_once('../source/plugin/connect.php');
header("content-type:text/html; charset=utf-8");
if($headpath==""){
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
}
;echo '
<html>
<head>
<title>获取开奖数据</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../';echo $headpath;;echo '/images/style.css" media="all" />
<link href="../';echo $headpath;;echo '/images/menu.css" rel="stylesheet" type="text/css" /> 
<script type=\'text/javascript\' src=\'../../js/common.js\'></script> 
<script type=\'text/javascript\' src=\'../../adminxp/js/Timer_Lot.js\'></script>
</head>
<BODY>
 <script> 
   gapTime=30000;
   //lotTimer=window.setInterval("Prize_Lot()",gapTime);
   //PrizeTimer=window.setInterval("fenpei_Prize()",gapTime);
 </script>
<table width="900" align=center border="0" cellpadding="4" cellspacing="1" bgcolor="#777777">
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
$result2=selects_sqls("game_type","ckey,fullname"," status='0'","","");
$now_id=0;$runtim=100;
while($rows2=mysql_fetch_array($result2)){
$playkey=$rows2[ckey];$tr_begin="";$tr_end="";
if($now_id%3==0 or $now_id-1<0){$tr_begin="<tr bgcolor='#FFFFFF' height=120>";}
if(($now_id+1)%3==0){$tr_end="</tr>";}
echo $tr_begin;
echo "<td width=33%>";
echo "<div style='line-height:20px;'><div style='float:left'>&nbsp;<b>".trim($rows2[fullname])."</b>&nbsp;|&nbsp;";
$result5=selects_sqls("game_intface"," links"," playkey='$playkey'"," order by Level","");
$nums5=mysql_num_rows($result5);$links="";$link_num=1;
if($nums5){
while($rows5=mysql_fetch_array($result5)){
if($links==""){$links=$rows5[links];}else{$links.="|".$rows5[links];}
echo "<a href='".$rows5[links]."' target='_blank'>数据源".$link_num."</a>&nbsp;";
$link_num+=1;
}
}
echo "<input id='links_".$playkey."' value='".$links."' style='display:none'>";
echo "<input id='thisdate_".$playkey."' value='".$this_date."' style='display:none'>";
echo "</div>";
echo " <div style='float:right'><a href='javascript:void()' onclick=\"document.frames('ifr_".$rows2[ckey]."').location.reload()\"><font color='#0000FF'>刷新</font></a></div><br>";
echo "</div>";
echo "<div style='line-height:20px;height:100px;margin:0px 3px;border:1px solid #CCCCCC;overflow:auto;'>";
echo "   <div style='height:100%;width:100%;BORDER-TOP:#c66800 1px solid;padding:3px;word-break:break-all;' id='div_".$rows2[ckey]."'>";
$result4=selects_sqls("game_time","lotNum,lotTime"," playKey='$playkey'"," order by lotTime","");
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
}
echo "<input id='lotlong_".$playkey."' value='".$lot_long."' style='display:none'>";
echo "<input id='lotNum_".$playkey."' value='".$lotNum."' style='display:none'>";
echo "<input id='lotTime_".$playkey."' value='".$lotTime."' style='display:none'>";
echo "<input id='thisnum_".$playkey."' value='".$dq_num."' style='display:none'>";
echo "<input id='runtime_".$playkey."' value='".$runtim."' style='display:none'>";
echo "     <iframe src='/".$headpath."/task/Lot.aspx?playkey=".$rows2[ckey]."' border=0 frameborder='0' width='100%' name='ifr_".$rows2[ckey]."' id='ifr_".$rows2[ckey]."' scrolling=no></iframe>";
echo "   </div>";
echo "</div>";
echo "</td>";
echo $tr_end;
$now_id+=1;
$runtim+=200;
}
;echo '  
  </TBODY>
</TABLE>

</body>';
?>