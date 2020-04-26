<?php

$popup_userid=$popup_perid_log;
$popup_key=$popup_key_log;
$status_log="0";
$popup_body=$popup_body_log;
$creatdate=date("Y-m-d H:i:s",time());
mysql_query("set names utf8;");
$strSql="insert into user_pupop(userid,popup,popupKey,creatdate,status) values ('$popup_userid','$popup_body_log','$popup_key','$creatdate','0')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
;echo '

'
?>