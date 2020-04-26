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
<script type=\'text/javascript\' src=\'../js/common.js\'></script>
<script type=\'text/javascript\' src=\'../adminxp/js/Getlot.js\'></script>
<SCRIPT language=javascript>
</Script>  
</head>
<BODY>
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
$result2=selects_sqls("game_type","ckey,fullname","","","");
$now_id=0;$runtim=500;
while($rows2=mysql_fetch_array($result2)){
$tr_begin="";$tr_end="";
if($now_id%3==0 or $now_id-1<0){$tr_begin="<tr bgcolor='#FFFFFF' height=160>";}
if(($now_id+1)%3==0){$tr_end="</tr>";}
echo $tr_begin;
echo "<td width=33%>";
echo "<div style='line-height:20px;'><div style='float:left'>&nbsp;<b>".trim($rows2[fullname])."</b>&nbsp;|&nbsp;".$rows2[ckey]."";
$result3=selects_sqls("lottery_run_time","title,gapTime,beginTime,endTime"," playkey='$rows2[ckey]'","","");
$nums3=mysql_num_rows($result3);$title="";$gapTime="";$beginTime="";$endTime="";
if($nums3){
while($rows3=mysql_fetch_array($result3)){
if($title==""){$title=$rows3[title];$gapTime=$rows3[gapTime];$beginTime=$rows3[beginTime];$endTime=$rows3[endTime];
}else{$title.="|".$rows3[title];$gapTime.="|".$rows3[gapTime];$beginTime.="|".$rows3[beginTime];$endTime.="|".$rows3[endTime];}
}
}
echo "<input id='title_".$rows2[ckey]."' value='".$title."' style='display:none'>";
echo "<input id='gap_".$rows2[ckey]."' value='".$gapTime."' style='display:none'>";
echo "<input id='begin_".$rows2[ckey]."' value='".$beginTime."' style='display:none'>";
echo "<input id='end_".$rows2[ckey]."' value='".$endTime."' style='display:none'>";
$result4=selects_sqls("game_time","lotNum,lotTime"," playKey='$rows2[ckey]'"," order by lotNum","");
$nums4=mysql_num_rows($result4);$lotNum="";$lotTime="";$sy_num=0;$dq_num=0;
if($nums4){
while($rows4=mysql_fetch_array($result4)){
$thistimes=date("His",time());
$gettimes=trim(str_replace(":","",$rows4[lotTime]));
if($thistimes-$gettimes>0){$dq_num=$sy_num;}
if($lotNum==""){$lotNum=$rows4[lotNum];$lotTime=$rows4[lotTime];
}else{$lotNum.="|".$rows4[lotNum];$lotTime.="|".$rows4[lotTime];}
$sy_num=$sy_num+1;
}
}
$this_date=date("Ymd",time());
echo "<input id='lotNum_".$rows2[ckey]."' value='".$lotNum."' style='display:none'>";
echo "<input id='lotTime_".$rows2[ckey]."' value='".$lotTime."' style='display:none'>";
echo "<input id='thisnum_".$rows2[ckey]."' value='".$dq_num."' style='display:none'>";
$result5=selects_sqls("game_intface"," links"," playkey='$rows2[ckey]'"," order by Level","");
$nums5=mysql_num_rows($result5);$links="";
if($nums5){
while($rows5=mysql_fetch_array($result5)){if($links==""){$links=$rows5[links];}else{$links.="|".$rows5[links];}}
}
echo "<input id='links_".$rows2[ckey]."' value='".$links."' style='display:none'>";
echo "<input id='SerID_".$rows2[ckey]."' value='' style='display:none'>";
echo "<input id='Number_".$rows2[ckey]."' value='' style='display:none'>";
echo "<input id='thisdate_".$rows2[ckey]."' value='".$this_date."' style='display:none'>";
echo "</div><div style='float:right'><a href='javascript:void()' onclick=\"GetLot('".$rows2[ckey]."')\"><font color='#0000FF'>刷新</font></a></div><br>";
echo "</div>";
echo "<div style='line-height:20px;height:140px;margin:0px 3px;border:1px solid #CCCCCC;overflow:auto;'>";
echo "   <div style='height:100%;width:100%;BORDER-TOP:#c66800 1px solid;padding:3px;word-break:break-all;' id='div_".$rows2[ckey]."'>";
echo "   </div>";
echo "</div>";
$runtim+=400;
echo "<script>window.setTimeout(\"GetLot('".$rows2[ckey]."')\",".$runtim.")</script>";
echo "</td>";
echo $tr_end;
$now_id+=1;
}
;echo '  
  </TBODY>
</TABLE>
</body>'
?>