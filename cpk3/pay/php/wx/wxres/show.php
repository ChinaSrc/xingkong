<?php
define('IN_ECS', true);
require('../includes/init.php');
include_once('../includes/modules/payment/wxpay.php');

$pay_obj    = new wxpay();

$order['order_amount'] = $_POST["order_amount"];
$order['out_trade_no'] = $_POST["out_trade_no"];
$pay_obj->createQR($order);


?>