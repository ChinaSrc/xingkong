<?php

mysql_query("set names utf8;");
$CFG_IS_Service=$_COOKIE['CFG_IS_Service'];
$CFG_IS_enableKey_path=$_COOKIE['CFG_IS_enableKey_path'];
$connect=$_COOKIE['connect'];
$post_string=substr($connect,1,strlen($connect));
$post_string=str_replace("|","&",$post_string);
$post_data =$post_string;
$url=$CFG_IS_Service.$CFG_IS_enableKey_path."?".$post_string;
$ch = curl_init();
$curl_url = $url;
curl_setopt($ch,CURLOPT_URL,$curl_url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$curl_result = curl_exec($ch);
$_SESSION["userLogs"]=$userLogs;
Add_Log_Status($curl_result);
curl_close($ch);
?>