<?php
if($userinfo['istry']==1){


    show_message("您现在还是试用账户，不允许访问聊天室",$_SERVER['HTTP_REFERER']);


}

$tpl->assign('navtitle','聊天室');

if($_GET['type']=='ifream'){
    $data=set_chat_data($_SESSION['userid']);
    $data['cpurl']=SZS_ROOT_URL;
    $tpl->assign('data',$data);
    $salt=rand(100000,999999);
    $code=md5($salt.md5($con_system['chat_key']));

    //$url=$con_system['chat_url'].'apk/index.php?act=login&code='.$code.'&salt='.$salt;
    $tpl->assign('url',$url);
    //uid=12345&username=aka&nickname=1234&rid=1&groupid=5&sex=1&parentname=k3admin&higherid=1&regtime=2019-08-14%2022:00:00
    //$url=getChatUrl('api/auth/chat/login').http_build_query($data);
    $url=getChatUrl('api/auth/chat/login') . '&' . http_build_query($data);

    echo $url; //die;
    $res = file_get_contents($url);
    $result = json_decode($res, true);
 
    if (isset($result['data'])) {
       // header('Location: ' . $result['resultMsg']);
      var_dump($result['data']['url']);sleep(5);
      	$tpl->assign('url',$result['data']['url']);
    } else {
    	print_r($res);
    }
 	die;


}



?>
