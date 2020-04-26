<?php

mysql_query("set names utf8;");
$sql_system="SELECT Modes_Rebate FROM system";
$result_system=mysql_query($sql_system);
$rows_system=mysql_fetch_array($result_system);
$Modes_Rebate=$rows_system[Modes_Rebate];
$this_uid=$re_perid;

if($re_modetype=="auto"){$set_mode="1700";$buy_mode=$re_pri_mode;}else{$set_mode=$re_pri_mode;}
$sql_19="select rebate as number from user where userid='$this_uid'";
$result19=mysql_query($sql_19);
$num19=mysql_num_rows($result19);
$rows19=mysql_fetch_array($result19);
if($re_modetype=="auto"){$last_re_num=re_rebate_auto($set_mode,$rows19[number],$buy_mode);}else{$last_re_num=$rows19[number];}
$sql_hig="SELECT higherid FROM user where userid='$this_uid'";
$result_hig=mysql_query($sql_hig);
$num_hig=mysql_num_rows($result_hig);$re_higid="";
if($num_hig){
$rows_hig=mysql_fetch_array($result_hig);
$re_higid=$rows_hig[higherid];
}

$higher_id=$re_higid;
$uids=array($this_uid,$higher_id);

foreach ($uids as $value){
	$this_uid=$value;
if($this_uid-1>=0){
$sql24="select rebate from user where userid='$this_uid'";

$result24=mysql_query($sql24);
$num24=mysql_num_rows($result24);

if($num24){

$rows24=mysql_fetch_array($result24);
$rebate=trim($rows24[rebate]);
$this_re=0;$now_re_num=0;
$this_re_num=trim($rebate);

if($re_modetype=="auto"){$this_re_num=re_rebate_auto($set_mode,$rebate,$buy_mode);}else{$this_re_num=$rebate;}
if($re_mode=="元"){$now_re_num=$this_re_num;}
if($re_mode=="角"){$now_re_num=$this_re_num-$Modes_Rebate;}
if($re_mode=="分"){$now_re_num=$this_re_num-$Modes_Rebate-$Modes_Rebate;}

if($now_re_num>0){
$this_re=$now_re_num/100;
$now_money=0;
$now_money=$re_money*$this_re;
$now_money=floor($now_money*10000)/10000;

$strSql="update user_bank set hig_amount=IFNULL(hig_amount,0)+'$now_money' where userid='$this_uid'";

$db->query($strSql);
$log_floatid=$re_floatid;
$log_type="hig_rebate";
$log_money=$now_money;
$log_remarks="";
$log_uid=$this_uid;
$log_status="0";
$filedir = dirname(__FILE__);
include($filedir."/Add_Bank_Log.php");
$last_re_num=$this_re_num;
}

}else{}
}
}
;echo '

';
?>