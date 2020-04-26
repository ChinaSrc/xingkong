<?php

$host_name="localhost";
$user="root";
$pass="584521";
$db_name="luotou";
$link=mysql_connect($host_name,$user,$pass,1,CLIENT_MULTI_RESULTS)or die("不能连接到服务器".mysql_error());
mysql_select_db($db_name,$link);

?>