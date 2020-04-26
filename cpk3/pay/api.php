<?php
include_once '../source/function/run.php';
$action=$_GET['action'];
if($action=='check_orders'){
    $return=array('msg'=>'fail','code'=>'0');
    $funds=$db->exec("select * from user_funds where order_sn='{$_GET['order_sn']}'");

    if($funds['status']==1) {

        $return=array('msg'=>'ok','code'=>'1');
    }
    exit(json_encode($return));
}




?>