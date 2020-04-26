<?php

define('IN_ECS', true);

error_reporting(E_ALL); 
ini_set('display_errors', '1'); 
require('../includes/init.php');
include_once('../includes/lib_clips.php');
include_once('../includes/lib_payment.php');
include_once('../includes/modules/payment/wxpay.php');

$pay_obj    = new wxpay();

$out_trade_no = $_POST["out_trade_no"];

$obj  = $pay_obj->query($out_trade_no);


?>