<?php

$gamekey = isset($_GET[play]) ?$_GET[play] : $_POST[play];
if($gamekey){
include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");
include(SZS_ROOT_PATH."source/config/play/code_".$gamekey.".php");
$perarrs=core_fun::getperiod($gamekey,$time_arr,$con_play_arr['lot_date'],$con_play_arr['lot_num']);
if($perarrs){
$perarrs_value_arr= array_values($perarrs);
$list_s=implode("|",$perarrs_value_arr);
echo $list_s;
}
}else{
echo "no";
}

?>