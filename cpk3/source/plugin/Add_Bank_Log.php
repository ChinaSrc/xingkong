<?php

$creatdate=date("Y-m-d H:i:s",time());
$nowtime=date("Y-m-d H:i:s",time());
mysql_query("set names utf8;");
$sqls_M="select hig_amount from user_bank where userid='$log_uid'";
$results_M=mysql_query($sqls_M);
$rows_M=mysql_fetch_array($results_M);
$log_amount=$rows_M[amount];
$log_hig_amount=$rows_M[hig_amount];
$log_low_amount=$rows_M[low_amount];
$str = "ABCDEFGHIJKLMNOPQRSTUVWSYZ";
$finalStr = "";
for($a=0;$a<4;$a++){$finalStr.= substr($str,rand(0,25),1);}
$ran_num=$finalStr;
$log_playkey=$playkey;
$log_modes=$buy_modes;
if($log_modes==""){$log_modes=$modes;}
if($log_modes==""){$log_modes=$re_mode;}
$log_accountid="BANK".time().$ran_num;
mysql_query("set names utf8;");
$strSql="insert into user_bank_log(userid,accountid,floatid,playkey,modes,creatdate,cate,moneys,amount,hig_amount,low_amount,remarks,status) values ('$log_uid','$log_accountid','$log_floatid','$log_playkey','$log_modes','$creatdate','$log_type','$log_money','$log_amount','$log_hig_amount','$log_low_amount','$log_remarks','$log_status')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
;echo '

';
?>