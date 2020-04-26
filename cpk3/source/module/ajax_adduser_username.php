<?php

$uid = $_GET[uid];
$pername = $_GET[username];
if($pername){
$user_s		= array();
$user_s_sql = "select a.userid as uid from ".DB_PREFIX."user as a where a.username='$pername'";
$user_s     = $db->fetch_first($user_s_sql);
if($user_s){
$flag=0;
}else{
$flag=1;
}
}else{
$flag=1;
}
echo $flag;
?>