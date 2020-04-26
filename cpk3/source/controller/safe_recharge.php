<?php

if($userinfo['istry']==1){


    show_message("您现在还是试用账户，不允许充值",$_SERVER['HTTP_REFERER']);


}
$from=str_to_time($con_system['recharge_begin']);
$to=str_to_time($con_system['recharge_end']);

$nowtime=str_to_time(date('H:i:s'));

$agree=0;
if($from<=$to){

    if($nowtime>=$from and $nowtime < $to){

        $agree=1;

    }


}
else{



    if($nowtime>=$from or $nowtime <$to   ){

        $agree=1;

    }

}


if($agree==0){
    show_message("'充值时间为{$con_system['recharge_begin']}到{$con_system['recharge_end']}'",'home.html','warn');
    exit();

}



$recharge_type=unserialize($con_system['recharge_type']);

$method_tips=array();
foreach ($recharge_type_arr as $key=>$value){
    if(!in_array($key,$recharge_type)) unset($recharge_type_arr[$key]);
    else{
        if($key=='bank' or $key=='alipay' or $key=='weixin'){
            if($key=='bank' )
                $banklist[$key]=$db->fetch_all("select * from system_bank where `status`=1 and bankname like '%银行%' order by sortnum asc,id asc");
            if($key=='alipay')
                $banklist[$key]=$db->fetch_all("select * from system_bank where `status`=1 and bankname like '%支付宝%' order by sortnum asc,id asc");
            if($key=='weixin')
                $banklist[$key]=$db->fetch_all("select * from system_bank where `status`=1 and bankname like '%微信%' order by sortnum asc,id asc");

              $method_tips[$key]="单笔最低{$banklist[$key][0]['min']}元，最高{$banklist[$key][0]['max']}元";
        }

        if($key=='online')      $method_tips[$key]="单笔最低{$con_system['MinPutCash_amount']}元，最高{$con_system['MaxPutCash_amount']}元";
    if($key=='card')   $method_tips[$key]="直接到账，无需审核";

    }

}

if(!$_GET['method']) $tpl->assign('navtitle','选择充值方式');
else   $tpl->assign('navtitle',$recharge_type_arr[$_GET['method']]);

$tpl->assign('recharge_type_arr',$recharge_type_arr);
$tpl->assign('method_tips',$method_tips);
if($_GET['method']=='' or !in_array($_GET['method'],$recharge_type) )

    $method=$con_system['recharge_first'];
    else
    $method=$_GET['method'];

$tpl->assign('method',$method);
if($method=='bank' or $method=='alipay' or $method=='weixin'){

    $tpl->assign('hand_bank_list',$banklist[$method]);

    $tpl->assign('js_bank',json_encode($banklist[$method]));

    $tpl->assign('tpl','bank');
}
elseif ($method=='online'){
    $auto_bank=array('jymspay');


$auto_bank_list[]=array ( 'logo' =>'static/images/bank/qq.png' ,'name' =>'QQ钱包' ,'type'=>'jymspay','key' => 'QQPAY','open'=>1 );
    $auto_bank_list[]=array ( 'logo' =>'static/images/ico/alipay.png' ,'name' =>'支付宝' ,'type'=>'jymspay','key' => 'ALIPAY','open'=>1 );
    $auto_bank_list[]=array ( 'logo' =>'static/images/ico/weixin.png' ,'name' =>'微信支付' ,'type'=>'jymspay','key' => 'wxpay','open'=>0 );
    $auto_bank_list[]=array ( 'logo' =>'static/images/ico/card.png' ,'name' =>'银联支付' ,'type'=>'jymspay','key' => 'card','open'=>0 );
// $auto_bank_list1['alipay']=array ( 'logo' =>'static/images/bank/alipay.png' ,'name' =>'支付宝' ,'url' =>' http://dxsjs.szsxmhha.top/scan/alipay.php' ,'key' => 'alipay' );
// $auto_bank_list1['wxpay2']=array ( 'logo' =>'static/images/bank/wxpay.png' ,'name' =>'微信大额支付' ,'url' =>' http://dxsjs.szsxmhha.top/scan/wxpay.php' ,'key' => 'wxpay2' );
    $tpl->assign('auto_bank_list',$auto_bank_list);
    $tpl->assign('js_bank',json_encode($auto_bank_list));
    $tpl->assign('tpl','online');
}
else {

    $tpl->assign('tpl','card');
}





$row= $db->exec("select * from user_funds where userid='{$_SESSION['userid']}' and payname!='' order by id desc");
$tpl->assign('payname',$row['payname']);


if($_POST){

$_POST['paymoney']= $_POST['paymoney']+0;

 $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
$url .= str_ireplace('localhost', '127.0.0.1', $_SERVER['HTTP_HOST']) ;
$url = str_ireplace('orderpay', 'OrderReturn', $url);
  
  if(!preg_match("/^[\x{4E00}-\x{9FA5}a-zA-Z]{2,8}+$/u",$_POST['payname']))
      {
    	show_message("您的用户名信息有误，请重试！",$_SERVER['HTTP_REFERER'],'warn' );exit();
       }
  
    //手动充值
    if($_POST['paymothod']=='bank'){


        //存在未审核订单 无法继续充值
        if ($db->exec("select * from user_funds where userid='{$_SESSION['userid']}' and status = 0 and type = 'hand' and cate= 'recharge'")) {
          
            show_message('您的充值信息已提交受理，请耐心等待','home_user_recharge.html');exit();
        }

            $price= $_POST['paymoney'];


        $id=add_charge($_SESSION['userid'], $price, $_POST['selectbank'],0, $_POST['remark']);
        if($id>0){

            if($_POST['payname']) $db->query("update user_funds set payname='{$_POST['payname']}' where id='{$id}'");


                show_message('充值已提交，请耐心等待','home_user_recharge.html');

        }

        exit;
    }
  
      if($_POST['paymothod']=='weixin'){

        //存在未审核订单 无法继续充值
        if ($db->exec("select * from user_funds where userid='{$_SESSION['userid']}' and status = 0 and type = 'hand' and cate= 'recharge'")) {
          
            show_message('您的充值信息已提交受理，请耐心等待','home_user_recharge.html');exit();
        }

            $price= $_POST['paymoney'];


        $id=add_charge($_SESSION['userid'], $price, $_POST['selectbank'],0, $_POST['remark']);
        if($id>0){

            if($_POST['payname']) $db->query("update user_funds set payname='{$_POST['payname']}' where id='{$id}'");


                show_message('充值已提交，请耐心等待','home_user_recharge.html');

        }

        exit;
    }
  
      if($_POST['paymothod']=='alipay'){

                //存在未审核订单 无法继续充值
        if ($db->exec("select * from user_funds where userid='{$_SESSION['userid']}' and status = 0 and type = 'hand' and cate= 'recharge'")) {
          
            show_message('您的充值信息已提交受理，请耐心等待','home_user_recharge.html');exit();
        }


            $price= $_POST['paymoney'];


        $id=add_charge($_SESSION['userid'], $price, $_POST['selectbank'],0, $_POST['remark']);
        if($id>0){

            if($_POST['payname']) $db->query("update user_funds set payname='{$_POST['payname']}' where id='{$id}'");


                show_message('充值已提交，请耐心等待','home_user_recharge.html');

        }

        exit;
    }

if($_POST['paymothod']=='card'){
   $card= $db->exec("select * from card where `number`='{$_POST['card_number']}' and `pwd`='{$_POST['card_pwd']}'");

    if($card){
        if($card['status']==1){
            show_message("您输入的充值卡已被使用",$_SERVER['HTTP_REFERER'],'warn' );
        }
     else if(time()<$card['begin']) show_message("您输入的充值卡还不到使用时间",$_SERVER['HTTP_REFERER'],'warn' );
        else if(time()>$card['end'] or $card['status']==2) show_message("您输入的充值卡已经过期",$_SERVER['HTTP_REFERER'],'warn' );
        else{
            recharge_use($_SESSION['userid'],$card['id']);
            show_message("恭喜您充值成功！",'home_user_recharge.html');

        }
    }
    else{
        show_message("您输入的充值卡不存在",$_SERVER['HTTP_REFERER'],'warn' );

    }



    exit();
}



if($_POST['paymothod']=='online'){



		$value=$_POST['selectpt'];
    $price= $_POST['paymoney'];
		if($value=='jymspay'){
           foreach ($auto_bank_list as $value){
               if($_POST['selectbank']==$value['key']){

                   if($value['open']!=1){

                       $gourl="pay/error.aspx?payname=".urlencode($value['name']);
                       echo "<script>window.location='".$gourl."';</script>";
                       exit();

                       exit();
                   }else{
                     $payname=$value['name'];


                       $id=add_charge($_SESSION['userid'], $price, '',1,$payname);
                       $funds=$db->exec("select * from user_funds where id='{$id}'");
                       if($funds['order_sn']){
                           $_SESSION['order_sn']=$funds['order_sn'];

                               $gourl="pay/jysmpay/{$value['key']}.aspx?order_sn={$funds['order_sn']}";

                           echo "<script>window.location='".$gourl."';</script>";
                       }


                   }
               }


           }





            exit();
        }











		if($value=='glpay'){
            $rand=rand(1,10);
            $price= $_POST['paymoney']-$rand/100;
            if($_POST['banktype']==1) $payname='支付宝';
            else $payname='微信支付';

            $_SESSION['charge_id']=add_charge($_SESSION['userid'], $price, '',1,$payname);
            $gourl="glpay.aspx?userid={$_SESSION['user_name']}&price={$price}&type={$_POST['banktype']}&charge_id={$_SESSION['charge_id']}&bankid={$_POST['bankid']}&url=".$url;

            echo "<script>window.location='".$gourl."';</script>";


		    exit();
        }

		$_SESSION['paymoney']=$_POST['paymoney'];

		if($value=='ips')
		$url.="/index_payreturn.html?bank={$value}";
		else{

			$url.="/pay/{$value}/callback.aspx";

		}


		if($con_system['pay_'.$value."_open"]==1){

		$_SESSION['charge_id']=add_charge($_SESSION['userid'], $_POST['paymoney'], '',1,$con_system['pay_'.$value.'_name']);

		if($con_system['pay_'.$value."_url"])
		$gourl=	trim($con_system['pay_'.$value."_url"]);
	else
		$gourl="/pay/{$value}/orderpay.aspx";
			$gourl.="?userid={$_SESSION['user_name']}&amount={$_POST['paymoney']}&charge_id={$_SESSION['charge_id']}&bankid={$_POST['bankid']}&url=".$url;


		echo "<script>window.location='".$gourl."';</script>";
		}
		else{

		echo "<meta http-equiv=Content-Type content='text/html;charset=utf-8'><script>alert('".$con_system['pay_'.$value."_name"]."已经关闭,请选择其他支付方式');window.history.go(-1);</script>";exit();

		}


	exit();
	}

	if($_POST['paymothod']==2 || $_POST['paymothod']==3  || $_POST['paymothod']==4){

			$value=$_POST['selectpt'];

				$_SESSION['charge_id']=add_charge($_SESSION['userid'], $_POST['paymoney'], '',1, $auto_bank_list1[$value]['name']);
		$_SESSION['paymoney']=$_POST['paymoney'];
$url.="/index_payreturn.html?bank={$value}";
$gourl= $auto_bank_list1[$value]['url'];

if($value=='wxpay2')

$gourl="pay/php/wx/pay.aspx"; 
else 
$gourl="pay/php/scan/{$value}.aspx"; 
			$gourl.="?userid={$_SESSION['user_name']}&amount={$_POST['paymoney']}&charge_id={$_SESSION['charge_id']}&bankid={$_POST['bankid']}&url=".$url;

		echo "<script>window.location='".$gourl."';</script>";
		exit();
	}





}





$tpl->assign('arr_bank',$arr_bank);

?>