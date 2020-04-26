<?php
if($userinfo['istry']==1){


    show_message("您现在还是试用账户，不允许访问聊天室",$_SERVER['HTTP_REFERER']);


}

$tpl->assign('navtitle','聊天室');
$data=set_chat_data($_SESSION['userid']);

$tpl->assign('data',$data);
$salt=rand(100000,999999);
$code=md5($salt.md5($con_system['chat_key']));

$url=$con_system['chat_url'].'apk/index.php?act=login&code='.$code.'&salt='.$salt;
$tpl->assign('url',$url);


?>