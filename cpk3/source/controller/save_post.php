<?php

$active = $_GET['active'];
if($active=="lowuser"){
$uid           = $_GET[uid];
$re_body       = "";
$re_fg         = "";
$user_list	   = array();
$user_list_sql = "select a.userid as uid,a.username as uname,count(l.userid) as lowuser,ol.userid as online from ".DB_PREFIX."user as a LEFT JOIN ".DB_PREFIX."user_level as l ON  l.higherid=a.userid LEFT JOIN ".DB_PREFIX."user_online as ol ON ol.userid=a.userid where a.higherid='$uid' GROUP BY a.userid order by lowuser desc";
$user_list     = $db->getall($user_list_sql);
for($i=0;$i<count($user_list);$i++){
$re_body.=$re_fg.$user_list[$i][uid]."|".$user_list[$i][uname]."|".$user_list[$i][lowuser]."|".$user_list[$i][hig_amount]."|".$user_list[$i][online];
$re_fg="#";
}
echo $re_body;
}

?>