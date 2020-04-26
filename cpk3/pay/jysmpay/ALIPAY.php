<?php
include_once '../../source/function/run.php';
function get_code($order,$type,$typetext){
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
    $url .= str_ireplace('localhost', '127.0.0.1', $_SERVER['HTTP_HOST']) ;
    $url = str_ireplace('orderpay', 'OrderReturn', $url);

    include_once('lib/pay.php');
    $data['p1_mchtid'] = 30743;
    $skey = 'aa34d9121de2ed024f13f3c899c891c0';
    $data['p2_paytype'] = $type;
    $data['p3_paymoney'] = $order['money'];
    $data['p4_orderno'] = $order['order_sn'];
    $data['p5_callbackurl'] = $url.'/pay/jysmpay/payback.aspx';	//异步地址;
    $data['p6_notifyurl'] =''; //$host.'/account.dealrecord2.do';	//前台地址;
    $data['p7_version'] = 'v2.8';
    $data['p8_signtype'] = 1;
    $data['p9_attach'] = '帐户充值';
    $data['p10_appname'] = '';
    $data['p11_isshow'] = 0;
    $data['p12_orderip'] = getIP();
    $sign = pay::sign($data, $skey);
    $data['sign'] = $sign;
    $payUrl = 'http://pay.095pay.com/zfapi/order/pay';
    $respon = pay::curlPost($data, $payUrl, 2, 60);

    if (!isset($respon['data']['r6_qrcode'])) {
        return $typetext.$respon['rspMsg'];
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

$order=$db->exec("select * from user_funds where order_sn='{$_GET['order_sn']}'");


$returnjump = get_code($order,'ALIPAY','支付宝');

echo $returnjump;

?>


<script src="/static/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/static/js/common.js"></script>
<script>
    function auto(){

        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";

        ajaxobj.content="";
        ajaxobj.url="../api.aspx?action=check_orders&order_sn=<?php echo $_GET['order_sn']?>";
        ajaxobj.callback=function(xmlobj){
            var response = Trim(xmlobj.responseText);
            response=JSON.parse(response);
            if(response.msg=='ok'){

                location.href='/payreturn.aspx';
            }
///console.log(response);;
        }
        ajaxobj.send();
    }


    var autotimer=setInterval("auto()",5000);

</script>