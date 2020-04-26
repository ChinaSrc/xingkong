<?php

header("content-type:text/html; charset=utf-8");
$active=$_GET['active'];
$playkey=$_GET['playkey'];

$search=" user_bank_log.cate in ('tranfer_out','tranfer_in') and user.userid=user_bank_log.userid";

$ordertype = isset($_POST[ordertype]) ?$_POST[ordertype] : $_GET[ordertype];

$begindate=$_GET['begindate'];
$enddate=$_GET['enddate'];

$t_url="?controller=project&action=bank&active=".$active;
$db_s="user_bank_log,user";

$today=get_day_time();
if($_GET['begintime']){
	$begintime=$_GET['begintime']." 03:00:00" ;
}
else $begintime=$today[0];
if($_GET['endtime']){
$endtime=$_GET['endtime']." 03:00:00";
}
else $endtime=$today[1];
$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
$search.=" and user_bank_log.creatdate between '$begintime' and '$endtime'";
if($ordertype){
if(strpos($ordertype,'|')){
$new_order=str_replace("|","','",$ordertype);
$new_order="'".$new_order."'";
}else{
$new_order="'".$ordertype."'";
}
$search.=" and (user_bank_log.cate in($new_order))";
$t_url.="&ordertype=".$ordertype;
}
$projectno=$_GET['projectno'];
if($projectno!=""){$search.=" and (user_bank_log.floatid='$projectno' or user_bank_log.accountid='$projectno')";$t_url.="&projectno=".$projectno;}
$pername=$_GET['pername'];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;$db_s="user_bank_log,user";}

;echo '<input id=\'tpl_url\' name=\'tpl_url\' value=\'';echo ROOT_URL."/".DEFAULT_TEMPLATE;;echo '\' style=\'display:none\'>
<script type="text/javascript" src="';echo ROOT_URL."/".DEFAULT_TEMPLATE;;echo '/zdialog/zdrag.js"></script>
<script type="text/javascript" src="';echo ROOT_URL."/".DEFAULT_TEMPLATE;;echo 'zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="';echo ROOT_URL."/".DEFAULT_TEMPLATE;;echo 'js/diags.js"></script>
<script language="javascript" type="text/javascript" src="';echo ROOT_URL."/".DEFAULT_TEMPLATE;;echo 'js/window.diags.js"></script>
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
?>



 <form action="" method="GET" style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="user" style='display:none'> 
          <input name="action" id="action" type="text" value="tranfer" style='display:none'> 
      <div class="search_box">
    &nbsp;用户名:
      <input name="pername"  class="input"  type="text" value="<?php echo $pername;?>" size="20" maxlength="20" />
  
  &nbsp;
    <b>时间</b>：
                                                       <input type="text" name="begintime"  value="<?php echo $begin;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
	&nbsp;至

	 <input type="text" name="endtime"  value="<?php echo $end;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

 &nbsp;&nbsp;
 <b>类型</b>：<select name="ordertype" id="ordertype" style="width:100px;">
 		  <option value="">不限</option> 
 			   <option value="tranfer_in"  <>转入</option> 
			   <option value="tranfer_out">转出</option>

		  </select>
	  <script>selectSetItem(G('ordertype'),'<?php echo $ordertype;?>')</script>
      <input type="submit"  class="button" name="submit" value="提交" />
  </div></form>

<?php 
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
echo '<table> <tr>
	    	    
 <th width="6%" bgcolor="#FFFFFF">用户名</th> 

         
		  <th width="8%" bgcolor="#FFFFFF">操作类型</th>
		 
          <th width="6%" bgcolor="#FFFFFF">操作金额（元）</th> 
          <th width="10%" bgcolor="#FFFFFF">账户余额（元）</th>  
          <th width="12%" bgcolor="#FFFFFF">操作时间</th>
          <th width="10%" bgcolor="#FFFFFF">说明</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /> 
	   ';
mysql_query("set names utf8;");
$sql3="select user_bank_log.*,user.username from user_bank_log,user where $search order by user_bank_log.creatdate desc limit $starnum,$maxnum";
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
$result9 = mysql_query("select count(user_bank_log.creatdate) from $db_s where $search") or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9);
if($nums3){
while($rows3=mysql_fetch_array($result3)){
$this_url=ROOT_URL."/do.aspx?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$rows3[floatid];
if($rows3[floatid]){
$chekd="javascript:DialogResetWindow('查看投注单','".$this_url."','600','470')";
}
echo "<tr height='25' align='center' style='background:#FFFFFF;'>";

echo "<td>{$rows3[username]}</td>";


echo "<td>".hig_log_code($rows3[cate])."</td>";

if(hig_log_code($rows3[cate])=='转入') $money='+'.$rows3['moneys'];
else  $money='-'.$rows3['moneys'];

echo "<td><span id='mon_".$listnum."'>".$money."</span></td>";
echo "<td><span id='allmon_".$listnum."'>".$rows3[hig_amount]."</span></td>";
echo "<td>".$rows3[creatdate]."</td>";
echo "<td>".$rows3[remarks]."</td>";
$listnum+=1;
}
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=9><font color='#999999'>未找到记录</font></td></tr>";
}
;echo ' 
	  </form>
	  <input id=\'listnums\' value=\'';echo $listnum;;echo '\' type=\'hidden\'>
	  <script> show_moneys(G(\'listnums\').value,"mon");show_moneys(G(\'listnums\').value,"allmon");</script>
  </table>
      
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