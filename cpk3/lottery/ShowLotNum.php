<?php

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="CQSSC";}
;echo ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>往期开奖号码</title>
<link rel="Shortcut Icon" href="ico.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META http-equiv="Pragma" content="no-cache" />

<style type="text/css">  
.link_01{
	color:#0000FF;text-decoration:underline;cursor: hand;
} 
.link_02{
	color:#ffffff;text-decoration:underline;cursor: hand;
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
';
if($headpath==""){
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
}
;echo '<link href="skins/css/main.css" rel="stylesheet" type="text/css">
<script type=\'text/javascript\' src=\'../js/common.js\'></script>
<script type=\'text/javascript\' src=\'../adminxp/js/main.js\'></script>  
<link rel="stylesheet" type="text/css" href="../';echo $headpath;;echo '/images/style.css" media="all" />
<link href="../';echo $headpath;;echo '/images/menu.css" rel="stylesheet" type="text/css" />
</head>
 <BODY bgColor=#dfdfdf>
 
<TABLE cellSpacing=0 cellPadding=0 width=96% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>开奖号码</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=96% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=6 style="border-left:1px solid  #8e8e8e;">&nbsp;</TD>
      <TD  align="center" bgColor=#f3f3f3><br> 

      <table width="96%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD"> 
	    <tr>
	       <td colspan="8" bgcolor="#FFFFFF" align="left">
			  <UL id=navlist >
			  ';
mysql_query("set names utf8;");
$sql5="select fullname,ckey from game_type where status='0'";
$result5=mysql_query($sql5);
while($rows5=mysql_fetch_array($result5)){
if($rows5[ckey]==$playkey){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='../adminxp/ShowLotNum.aspx?playkey=".$rows5[ckey]."&pages=1#toppage'>".$rows5[ckey]."</A></LI>";
}
;echo '  
              </UL> 
			  
		   </td>
       </tr>
       <tr>
          <th width="16%" align="center" bgcolor="#FFFFFF">期号</th>
          <th width="10%" align="center" bgcolor="#FFFFFF">彩种</th>
       
          <th width="20%" align="center" bgcolor="#FFFFFF">开奖时间</th>   
          <th width="30%" align="center" bgcolor="#FFFFFF">开奖号码</th>  
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
$wheres="code='gp'";
if(strlen($search)-10>=0){$search=substr($search,2,strlen($search));}
if($playkey!=""){$wheres.=" and playKey='$playkey'";$thispath.="&playkey=".$playkey;}
if ($search!=""){$wheres.=" and (period LIKE '%$search%' or Number LIKE '%$search%')";$thispath.="&search=".$search;}
$result3=selects_sqls("game_Lottery","*",$wheres," order by LotTime desc"," limit ".$starnum.",".$maxnum);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$rows3[period]."</td>";
echo "<td>".$rows3[playKey]."</td>";
echo "<td>".$rows3[LotTime]."</td>";
echo "<td>".$rows3[Number]."</td></tr>";
}
;echo ' 
	  </form>
  </table> 

	<div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	';
$result4=selects_sqls("game_Lottery","*",$wheres,"","");
$nums4=mysql_num_rows($result4);
;echo '	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$nums4;
$pageurl=$thispath;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div> 
	</div>   
 
     </TD><TD width=7 
  style="border-right:1px solid  #8e8e8e;">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=96% align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE>


</body> ';
?>