<?php
session_start();
header("content-type:text/html; charset=utf-8");
include('config.php');



         
       $msg=  $db->fetch_first("select count(*) as num from user_msg where perid='{$_SESSION[admin_id]}' and status='0'");
        $num=$msg['num'];
        if($num>0){
        	$content="<div><a href='?mod=safe&code=msg' target='_blank'>您有{$num}条未读信息,点击查看</a></div>";
         echo "msg|$content";exit();   	
        	
        }	
     
       
		
	exit();	
?>
		
	
		