<?php

    function get_code($order,$type,$typetext){


        include_once('lib/pay.php');
        $data['p1_mchtid'] = 30743;
        $skey = 'aa34d9121de2ed024f13f3c899c891c0';
        $data['p2_paytype'] = $type;
        $data['p3_paymoney'] = $order['amount'];
        $data['p4_orderno'] = $order['trano'];
        $data['p5_callbackurl'] = 'http://tjc.2018.local.com/auto.php?id=223232';	//异步地址;
        $data['p6_notifyurl'] =''; //$host.'/account.dealrecord2.do';	//前台地址;
        $data['p7_version'] = 'v2.8';
        $data['p8_signtype'] = 1;
        $data['p9_attach'] = '帐户充值';
        $data['p10_appname'] = '';
        $data['p11_isshow'] = 0;
        $data['p12_orderip'] = '127.0.0.1';
        $sign = pay::sign($data, $skey);
        $data['sign'] = $sign;
        $payUrl = 'http://pay.095pay.com/zfapi/order/pay';
        $respon = pay::curlPost($data, $payUrl, 2, 60); 
        if (!isset($respon['data']['r6_qrcode'])) {
            return $typetext.'二维码获取失败';
            die;
        }else{
                $qrcode = $respon['data']['r6_qrcode'];

                $html = '';
                $html .= "<center>请使用".$typetext."扫描下面的二维支付码</center><br>";
                //$returnhtml = "<p style='color:red'>平台官方微信支付暂未开通，下面为测试二维码，请勿扫描支付</p><br>";
                $html .= "<center><img style='width:200px' src='".ltrim($qrcode,'.')."'></center>";
                return $html;

	}
  }




$returnjump = get_code(array('amount'=>10,'trano'=>time()),'QQPAY','QQ钱包');

echo $returnjump;

?>


