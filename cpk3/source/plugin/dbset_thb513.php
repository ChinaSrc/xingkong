<?php

$host_name="thb513.gotoftp3.com";
$user="thb513";
$pass="TUbiao_2010";
$db_name="thb513";
$link=mysql_connect($host_name,$user,$pass,1,CLIENT_MULTI_RESULTS)or die("不能连接到服务器".mysql_error());
mysql_select_db($db_name,$link);

?>