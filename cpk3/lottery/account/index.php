<?php
 
$begindate_get=$_GET['begindate'];
$enddate_get=$_GET['enddate'];
$playkey=$_GET['playkey'];
if($begindate_get==""){$begindate=$nowdate;}else{$begindate=$begindate_get;}
if($enddate_get==""){$enddate=$nextdate;}else{$enddate=$enddate_get;}
$t_url="?controller=account&action=index&playkey=".$playkey;
$db_s="user_bank_log";
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate.$Add_Time;
$endtime=$enddate.$Add_Time;
$search.=" and user_bank_log.creatdate between '$begintime' and '$endtime'";
$projectno=$_GET['projectno'];
if($projectno!=""){$search.=" and (user_bank_log.floatid='$projectno' or user_bank_log.accountid='$projectno')";$t_url.="&projectno=".$projectno;}
$pername=$_GET['pername'];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;$db_s="user_bank_log,user";}
;echo ' 

';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 

	  <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
      <form action="';echo $t_url;;echo '" method="GET" style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="account" style=\'display:none\'> 
          <input name="action" id="action" type="text" value="index" style=\'display:none\'> 
          <input name="playkey" id="playkey" type="text" value="';echo $playkey;;echo '" style=\'display:none\'>
          <tr>
             <td width="30%" align="right">&nbsp;单号:</td>
             <td width="70%" align="left">
               <input name="projectno" id="projectno"  class="input"  type="text" value="';echo $projectno;;echo '" size="20" maxlength="20" /></td>
          </tr>
          <tr>
             <td align="right">&nbsp;用户名:</td>
             <td align="left">
               <input name="pername" id="pername"  class="input"  type="text" value="';echo $pername;;echo '" size="20" maxlength="20" ></td>
          </tr>
          <tr> 
             <td align="right" >&nbsp;起始日期:</td>
             <td align="left"> <input type="text" name="begindate" id="begindate" value="';echo $begindate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '            至：<input type="text" name="enddate" id="enddate" value="';echo $enddate;;echo '" class="input_02" style="width:80px;"  onClick="setDay(this);"/>';echo $Add_Time;;echo '   </td>
          </tr>
	 	  <tr>
             <td colspan="2" ><hr align="left" size="1" noshade /></td>
          </tr>  
          <tr>
             <td>&nbsp;</td>
             <td align="left"><input type="submit"  class="button" name="submit" value="提交" /></td>
          </tr>
	  </form>
      </table> 
';
$listKey=array("input","withdraw","bank");
$titleKey=array("充值记录","提现记录","银行账变");
for ($i=0;$i<count($listKey);$i++){
if($listKey[$i]==$playkey){$show_title=$titleKey[$i];}
}
if($playkey==""){$show_title="充值记录";$playkey="input";}
;echo '';$body_top_title=$show_title;include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo '  

<table> <tr>
	       <td colspan="9" bgcolor="#FFFFFF" align="left">
			  <UL id=navlist >
			  ';
for ($i=0;$i<count($listKey);$i++){
if($listKey[$i]==$playkey){$cur_li="id=active";$cur_a="id=current";}else{$cur_li="";$cur_a="";}
echo "<LI ".$cur_li."><A ".$cur_a." href='".ROOT_URL."/".$AdminPath."/?controller=account&action=index&playkey=".$listKey[$i]."'>".$titleKey[$i]."</A></LI>";
}
;echo ' 
              </UL>
		   </td>
       </tr>
       <tr>
          <th width="6%" bgcolor="#FFFFFF">Id</th>
          <th width="15%" bgcolor="#FFFFFF">单号</th>   
          <th width="13%" bgcolor="#FFFFFF">类别</th>
		  <th width="11%" bgcolor="#FFFFFF">用户名 / ID</th> 
          <th width="10%" bgcolor="#FFFFFF">金额</th>   
          <th width="10%" bgcolor="#FFFFFF">操作后</th>
          <th width="16%" bgcolor="#FFFFFF">操作时间</th>
          <th width="9%" bgcolor="#FFFFFF">说明</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
$listnum=0;
if($playkey){
$listKey=array("input","withdraw","bank");
if (!$pages or $pages==0){$pages=1;}$maxnum=20;$starnum=$pages*$maxnum-$maxnum;
if($playkey=="input"){$cate_list=$Recharge_list;}
if($playkey=="withdraw"){$cate_list=$mention_list;}
if($playkey=="bank"){$cate_list=$hig_money_s;}
mysql_query("set names utf8;");
$sql3="select user_bank_log.*,user.username from user_bank_log,user where user_bank_log.cate in($cate_list) and user_bank_log.userid=user.userid $search order by creatdate desc limit $starnum,$maxnum";
$result3=mysql_query($sql3);
$result9 = mysql_query("select count(user_bank_log.creatdate) from $db_s where user_bank_log.cate in($cate_list) $search") or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;".$rows3[id]."</td>";
echo "<td>".$rows3[accountid]."</td>";
$cate_s=hig_log_code($rows3[cate]);
echo "<td>".hig_log_code($rows3[cate])."</td>";
echo "<td>".$rows3[username]."/".$rows3[userid]."</td>";
echo "<td>".$rows3[moneys]."</td>";
if(in_array($rows3[cate],$hig_add_money) === true){$secai="add";}else{$secai="lost";}
if($secai=="add"){
$last_money=$rows3[hig_amount]-$rows3[moneys];
}elseif($secai=="lost"){
$last_money=$rows3[hig_amount]+$rows3[moneys];
}else{
$last_money="";
}
echo "<td><span id='allmon_".$listnum."'>".$rows3[hig_amount]."</span></td>";
echo "<td>".$rows3[creatdate]."</td>";
echo "<td>".$rows3[remarks]."</td>";
$listnum+=1;
}
}else{
}
;echo ' 
	  </form>
	  <input id=\'listnums\' value=\'';echo $listnum;;echo '\' type=\'hidden\'>
  </table>
      <script>show_moneys(G(\'listnums\').value,"allmon");</script>
        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	
	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$rows9[0];
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;echo ' 
	    </div> 
	</div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>