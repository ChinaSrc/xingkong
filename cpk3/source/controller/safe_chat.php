<?php
$tpl->assign('navtitle','我要转换');
if($userinfo['istry']==1){


    show_message("您现在还是试用账户，不允许转换",$_SERVER['HTTP_REFERER']);


}

if($con_system['chat_open']!=1){

    echo "<script>window.location='index_chat.html';</script>";
    exit();
}

if($userinfo['virtual']==1 and $con_system['user_chat_tranfer']==2){


    show_message("您是测试账户，不允许转换",$_SERVER['HTTP_REFERER']);


}

if($_POST){
    $user_pass	   = array();
    $user_pass_sql = "select u.password as upass,b.password as bpass from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid=b.userid and u.userid='$userid'";
    $user_pass     = $db->fetch_first($user_pass_sql);
    $secpwd = isset($_POST[pass]) ?$_POST[pass] : $_GET[pass];
    $amount = isset($_POST[getMoney]) ?$_POST[getMoney] : $_GET[getMoney];
	if (!is_numeric($_POST[getMoney]) || $_POST[getMoney] <= 0) {
    	show_message('格式不对，不允许转换',$_SERVER['HTTP_REFERER'],'warn');
      	exit();
    }
    if($secpwd and $amount){
        if(md5($secpwd)==$user_pass[bpass] or sys_md5($secpwd)==$user_pass[bpass]){
         

                $user_amount=get_user_amount($_SESSION['userid']);
          
                if($amount-$user_amount['hig_amount']>0){

                    show_message('您的余额不足，请更改转换金额。',$_SERVER['HTTP_REFERER'],'warn');
                    exit();
                }else{
					
                  	$url= get_chaturl('apk/index.php')."&act=member_info&username=".$userinfo['username'];;
                    $json=file_get_contents($url);
                    $json = trim($json, "\xEF\xBB\xBF");
                    $chat_user=json_decode($json,1);
                    if(!isset($chat_user['money']))
                    {
                      show_message('请先登录聊天室，再进行充值操作！',$_SERVER['HTTP_REFERER'],'warn');
                      exit();
                    }
                    $url=get_chaturl_new('apk/index.php')."&act=tranfer&amount={$amount}&username=".$userinfo['username'];;
                    $json=file_get_contents($url);
                    $json = trim($json, "\xEF\xBB\xBF");
                    $json=json_decode($json,1);

                    if($json['result']=='ok'){
                        add_money($_SESSION['userid'], -$amount,'tranfer_out','转账到聊天室');
                        show_message('转换成功','home_safe_chat.html');
                    }
                    else{

                        show_message('转换失败，请稍后再试',$_SERVER['HTTP_REFERER'],'warn');
                    }


                }
            
        }else{

            show_message("资金密码不正确",$_SERVER['HTTP_REFERER'],'warn');
            exit();

        }
    }else{

        show_message('所有选项必须填写',$_SERVER['HTTP_REFERER'],'warn');
    }


}



$tpl->assign('amount',get_user_amount($_SESSION['userid']));
$url= get_chaturl('apk/index.php')."&act=member_info&username=".$userinfo['username'];;


$json=file_get_contents($url);
$json = trim($json, "\xEF\xBB\xBF");
$chat_user=json_decode($json,1);
if(!isset($chat_user['money'])) $chat_user['money']=0;
$tpl->assign('chat_user',$chat_user);

?>