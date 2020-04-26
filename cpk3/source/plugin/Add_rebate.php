<?php

$querys="system";$sqlclass="select";$select="Modes_Rebate";
include(ROOT_PATH.'/source/plugin/class.php');
$sys_infor=mysql_fetch_array($result_system);
$Modes_Rebate=$sys_infor[Modes_Rebate];
if($re_modetype=="auto"){$set_mode="1700";$buy_mode=$re_pri_mode;}else{$set_mode=$re_pri_mode;}
$sql="SELECT userid FROM game_buylist where buyid='$re_floatid' ";
$query=mysql_query($sql);
$row1=mysql_fetch_array($query);

$sql="SELECT higherid FROM user where userid='$row1[userid]' ";
$query=mysql_query($sql);
$row2=mysql_fetch_array($query);

$re_perid=$row2['higherid'];
$this_uid=$re_perid;
$last_re_num=0;
mysql_query("set names utf8;");
$sql24="select rebate from user where userid='$this_uid'";
$resultRE=mysql_query($sqlRE);
$numRE=mysql_num_rows($resultRE);
if($numRE){
mysql_query("set names utf8;");
$rowsRE=mysql_fetch_array($resultRE);
$rowsRE[number]=$rowsRE[rebate];
$this_re=0;$now_re_num=0;
$this_re_num=trim($rowsRE[number]);
if($re_modetype=="auto"){$this_re_num=re_rebate_auto($set_mode,$rowsRE[number],$re_pri_mode);}else{$this_re_num=$rowsRE[number];}
if($re_mode=="元"){$now_re_num=$this_re_num-$last_re_num;}
if($re_mode=="角"){$now_re_num=$this_re_num-$last_re_num-$Modes_Rebate;}
if($re_mode=="分"){$now_re_num=$this_re_num-$last_re_num-$Modes_Rebate-$Modes_Rebate;}
if($now_re_num>0){
$this_re=$now_re_num/100;$now_money=0;
$now_money=$re_money*$this_re;
$now_money=floor($now_money*10000)/10000;
$strSql="update game_buylist set rebate_buy='yes' where buyid='$re_floatid' and is_succeed='yes'";
$db->query($strSql);
$strSql="update user_bank set hig_amount=IFNULL(hig_amount,0)+'$now_money' where userid='$this_uid'";
$db->query($strSql);echo $strSql;
$log_floatid=$re_floatid;$log_type="hig_rebate";$log_money=$now_money;$log_remarks="";$log_uid=$this_uid;$log_status="0";
$filedir = dirname(__FILE__);
include($filedir."/Add_Bank_Log.php");
$last_re_num=$this_re_num;
}
}
;echo '

';
?>