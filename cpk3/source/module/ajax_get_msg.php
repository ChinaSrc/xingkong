<?php

$gamekey = isset($_GET[play]) ?$_GET[play] : $_POST[play];
$action = isset($_GET[action]) ?$_GET[action] : $_POST[action];


if($action=='msg'){


  $username = $_GET['username'];

  if ($username) {

    $user=$db->exec("select id,mobilephone from `user` where `username`='{$username}' and admin='1' and status='0'");

    if ($user) {

        $user['mobilephone'] = $user['mobilephone'] ? $user['mobilephone'] : '13215021846';

        //发送短信
        require_once  '../source/function/Ucpass.class.php';

        //填写在开发者控制台首页上的Account Sid
        $options['accountsid']='d0039c937c98486a81d2851e1e7f11e4';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='217d018e047eebbb24f6b0a99a70f56b';

        $num = rand(1000,9999); 

        session_set('SignCode',$num,'120');
        //初始化 $options必填
        $ucpass = new Ucpaas($options);

        $appid = "d0039c937c98486a81d2851e1e7f11e4"; //应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "427374";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = $num.',2'; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = $user['mobilephone'];
        $uid = "1";


        $res = $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);



        if ($res!="没有返回数据") {
          $result['stats'] = '200';
          $result['msg'] = '发送成功';
        }else{
          
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




}






?>