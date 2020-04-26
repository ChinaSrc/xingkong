<?php
/**
 * ---------------------参数生成页-------------------------------
 * 在您自己的服务器上生成新订单，并把计算好的订单信息传给您的前端网页。
 * 注意：
 * 1.key一定要在服务端计算，不要在网页中计算。
 * 2.token只能存放在服务端，不可以以任何形式存放在网页代码中（可逆加密也不行），也不可以通过url参数方式传入网页。
 * 3.接口跑通后，如果发现收款二维码是我们官方的，请检查APP是否正在运行。为保障您收款功能正常，如果您的收款手机APP掉线超过一分钟，就会触发代收款机制，详情请看网站帮助。
 * --------------------------------------------------------------
 */

//从网页传入price:支付价格， istype:支付渠道：1-支付宝；2-微信支付
$price =$_GET['price'];
$istype = $_GET['type'];
$orderuid = $_GETT['username'];       //此处传入您网站用户的用户名，方便在平台后台查看是谁付的款，强烈建议加上。可忽略。

//校验传入的表单，确保价格为正常价格（整数，1位小数，2位小数都可以），支付渠道只能是1或者2，orderuid长度不要超过33个中英文字。

//此处就在您服务器生成新订单，并把创建的订单号传入到下面的orderid中。
if($istype==1) $payname='支付宝';
else $payname='微信支付';
$goodsname =  $_GETT['username']."使用{$payname}在线充值{$price}元";
$orderid = $_GET['charge_id'];    //每次有任何参数变化，订单号就变一个吧。
$uid = "10055";//"此处填写平台的uid";
$token = "cfe3328eeba69743c3c5daf2384a39d8";//"此处填写平台的Token";
$return_url = $_GET['url'].'/payreturn.aspx';
$notify_url =  $_GET['url'].'/paynotify.aspx';
$key = md5($goodsname. $istype . $notify_url . $orderid . $orderuid . $price . $return_url . $token . $uid);
//经常遇到有研发问为啥key值返回错误，大多数原因：1.参数的排列顺序不对；2.上面的参数少传了，但是这里的key值又带进去计算了，导致服务端key算出来和你的不一样。

$returndata['goodsname'] = $goodsname;
$returndata['istype'] = $istype;
$returndata['key'] = $key;
$returndata['notify_url'] = $notify_url;
$returndata['orderid'] = $orderid;
$returndata['orderuid'] =$orderuid;
$returndata['price'] = $price;
$returndata['return_url'] = $return_url;
$returndata['uid'] = $uid;
//echo jsonSuccess("OK",$returndata,"");


//返回错误
function jsonError($message = '',$url=null)
{
    $return['msg'] = $message;
    $return['data'] = '';
    $return['code'] = -1;
    $return['url'] = $url;
    return json_encode($return);
}

//返回正确
function jsonSuccess($message = '',$data = '',$url=null)
{
    $return['msg']  = $message;
    $return['data'] = $data;
    $return['code'] = 1;
    $return['url'] = $url;
    return json_encode($return);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>正在跳转中</title>
</head>
<body>

<form  id='formpay' name='formpay' method='post' action='https://www.glpay.com/pay' style="display: none;">
    <input name='goodsname' id='goodsname' type='text' value='<?php echo $goodsname;?>' />
    <input name='istype' id='istype' type='text' value='<?php echo $istype?>' />
    <input name='key' id='key' type='text' value='<?php echo $key;?>'/>

    <input name='orderid' id='orderid' type='text' value='<?php echo $orderid;?>'/>
    <input name='orderuid' id='orderuid' type='text' value='<?php echo $orderuid;?>'/>
    <input name='notify_url' id='notify_url' type='text' value='<?php echo $notify_url;?>'/>
    <input name='return_url' id='return_url' type='text' value='<?php echo $return_url?>'/>
    <input name='uid' id='uid' type='text' value='<?php echo $uid;?>'/>
    <input name='token'  type='text' value='<?php echo $token;?>'/>
    <p><input id="inputprice" type="text" value="<?php echo $price;?>" name="price" class="form-control" placeholder="请输入金额" required></p>


    <button type="submit" id="demoBtn1">确认购买</button>
</form>

<script type="">

    document.getElementById('formpay').submit();


</script>