<?php
include_once '../../source/function/run.php';
$partner = isset($_GET['partner']) ? $_GET['partner'] : '';
$ordernumber = isset($_GET['ordernumber']) ? $_GET['ordernumber'] : '';
$orderstatus = isset($_GET['orderstatus']) ? $_GET['orderstatus'] : '';
$paymoney = isset($_GET['paymoney']) ? $_GET['paymoney'] : '';
$sysnumber = isset($_GET['sysnumber']) ? $_GET['sysnumber'] : '';
$attach = isset($_GET['attach']) ? $_GET['attach'] : '';
$sign = isset($_GET['sign']) ? $_GET['sign'] : '';
$sign_str = 'partner=' . $partner  . '&ordernumber=' . $ordernumber . '&orderstatus=' . $orderstatus . '&paymoney='  . $paymoney  . 'aa34d9121de2ed024f13f3c899c891c0';


if (md5($sign_str) == $sign){
    $trano = $ordernumber;
    $funds=$db->exec("select * from user_funds where order_sn='{$trano}'");
    if($funds['id']>0){

        agree_online_money($funds['id']);
    }
echo 'ok';
}
else echo false;
