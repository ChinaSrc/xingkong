<?php

require_once '../source/function/run.php';
require_once '../source/function/Ucpaas.class.php';
$gamekey = isset($_GET[play]) ?$_GET[play] : $_POST[play];
$action = isset($_GET[action]) ?$_GET[action] : $_POST[action];
session_start();




if ($action=='msg1') {

        // exit();
        //填写在开发者控制台首页上的Account Sid
        $options['accountsid']='7fb0d0da4978e617e9fbd62eedc6d332';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='66b730ab0dd0a872d2d37fd50bcdae4d';
        $ucpass = new Ucpaas($options);

        $appid = "353f287447ee4e5f8ff934cb8c75cab0"; //应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "427302";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = '1312'.','.'123'; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = "008613215021846";
        $uid = "";


        $res1 = $ucpass->SendSms1($appid,$templateid,$param,$mobile,$uid);

        $res = json_decode($res1,true);

        var_dump($res);exit();
        if ($res['code']=="000000") {
          $result['stats'] = '200';
          $result['msg'] = '发送成功';
        }else{
          
          exception_log('短信发送失败|'.$res1);
          $result['stats'] = '400';
          $result['msg'] = '发送失败,请联系管理员';
        }


}


if($action=='msg'){


  $username = $_GET['username'];

  if ($username) {

    $user=$db->fetch_first("select userid,mobilephone from `user` where `username`='{$username}' and admin='1' and status='0'");

    if ($user) {

        $user['mobilephone'] = $user['mobilephone'] ? $user['mobilephone'] : '8613215021846';
        // $user['mobilephone'] = '13043092107';

        //发送短信
        

        //填写在开发者控制台首页上的Account Sid
        $options['accountsid']='7fb0d0da4978e617e9fbd62eedc6d332';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='66b730ab0dd0a872d2d37fd50bcdae4d';

        $num = rand(1000,9999); 

        
        if (session_get('SignCode')) {
            echo "已发送,如没收到请2分钟后再尝试";exit();
        }
        session_set('SignCode',$num,'120');
        //初始化 $options必填
        $ucpass = new Ucpaas($options);

        $appid = "353f287447ee4e5f8ff934cb8c75cab0"; //应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "427302";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = $username.','.$num; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = '00'.$user['mobilephone'];
        $uid = "";


        $res = $ucpass->SendSms1($appid,$templateid,$param,$mobile,$uid);

        // $res = json_decode($res1,true);
        if (strstr($res,"000000")) {
          $result['stats'] = '200';
          $result['msg'] = '发送成功';
        }else{
          session_clear('SignCode');
          exception_log('短信发送失败|'.$res1);
          $result['stats'] = '400';
          $result['msg'] = '发送失败,请联系管理员';
        }

    }else{



      $result['stats'] = '400';
      $result['msg'] = '用户信息有误';

    }

  }else{
    
    $result['stats'] = '400';
    $result['msg'] = '用户名不能为空';
  }

// echo json_encode($result,JSON_UNESCAPED_UNICODE);

  echo $result['msg'];


}




//判断是否在ip库里
if($action=='username'){


        if (session_get('SignCode')) {
            echo "2";exit();
        }


  $username = $_GET['username'];

  if ($username) {

    $user_ip=$db->fetch_first("select value from `sys` where `key`='admin_ip_{$username}'");

    if ($user_ip) {

        @$arrip = explode("|",$user_ip['value']);


        $ip = getIP();

        if (in_array($ip, $arrip)) {
          $result['stats'] = '0';
        }else{
          $result['stats'] = '1';
        }

    }else{



      $result['stats'] = '1';

    }

  }else{
    
    $result['stats'] = '1';
  }

ob_clean();
if ($result['stats'] == '1') {
    echo "1";exit();
}else{
     echo "0"; exit();
}

}




?>