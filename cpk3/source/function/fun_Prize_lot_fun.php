<?php
//投注编号 、玩法编号、投注内容、开奖内容
if($Next_Go){

switch ($Next_Go){
case "Prize_fs":
$flags=Prize_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_ds":
$flags=Prize_ds($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_zh":
$flags=Prize_zh($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_z120":
$flags=Prize_z120($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_z60":
$flags=Prize_z60($buy_id,$list_id,$new_buynum,$new_Lotnum);
break;

case "Prize_z12":
$flags=Prize_z12($buy_id,$list_id,$new_buynum,$new_Lotnum);
break;
case "Prize_5X_z30":
$flags=Prize_5X_z30($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_z20":
$flags=Prize_z20($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_5X_z10":
$flags=Prize_5X_z10($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_5X_z5":
$flags=Prize_5X_z5($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_5x_lhh":
$flags=Prize_5x_lhh($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;

    case "Prize_SSC_LH":
        $flags=Prize_SSC_LH($buy_id,$list_id,$Z_buynum,$Z_lotnum);
        break;

case "Prize_5x_DSDS":
	
$flags=Prize_5x_DSDS($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;


case "Prize_4X_z6":
$flags=Prize_4X_z6($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_zhxhz":
$flags=Prize_zhxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_kd":
$flags=Prize_kd($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_z3":
$flags=Prize_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_hhzx":
$flags=Prize_hhzx($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_zxhz":
$flags=Prize_zxhz($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_3x_bd":
$flags=Prize_3x_bd($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_3x_hzws":
$flags=Prize_3x_hzws($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3x_tshm":
$flags=Prize_3x_tshm($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_2X_zxfs":
$flags=Prize_2X_zxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_2X_zxds":
$flags=Prize_2X_zxds($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_2X_zxhz":
$flags=Prize_2X_zxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_2X_zxbd":
$flags=Prize_2X_zxbd($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_1X_dwd":
$flags=Prize_1X_dwd($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_BDW":
$flags=Prize_BDW($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_DXDS":
$flags=Prize_DXDS($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_DXDS3":
	
$flags=Prize_DXDS3($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_QW_qwsx":
$flags=Prize_QW_qwsx($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_QW_qwex":
$flags=Prize_QW_qwex($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_QW_qjsx":
$flags=Prize_QW_qjsx($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_QW_qjex":
$flags=Prize_QW_qjex($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_QW_yffs":
$flags=Prize_QW_yffs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_hscs":
$flags=Prize_hscs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_zhxfs":
$flags=Prize_11X5_zhxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_zxfs":
$flags=Prize_11X5_zxfs($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_11X5_dt":
$flags=Prize_11X5_zxdt($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_bdw":
$flags=Prize_11X5_bdw($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_dwd":
$flags=Prize_11X5_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_dds":
$flags=Prize_11X5_dds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_czw":
$flags=Prize_11X5_czw($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_fsrx":
$flags=Prize_11X5_fsrx($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_11X5_zhxds":
$flags=Prize_11X5_zhxds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_zxds":
$flags=Prize_11X5_zxds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_11X5_rxds":
$flags=Prize_11X5_rxds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_KL8_pm":
$flags=Prize_KL8_pm($buy_id,$list_id,$Z_buynum,$new_Lotnum);
break;
case "Prize_KL8_hzdxds":
$flags=Prize_KL8_hzdxds($buy_id,$list_id,$new_buynum,$new_Lotnum);
break;
    case "Prize_KL8_hzdxds1":
        $flags=Prize_KL8_hzdxds1($buy_id,$list_id,$new_buynum,$new_Lotnum);
        break;
case "Prize_KL8_rx":
$flags=Prize_KL8_rx($buy_id,$list_id,$new_buynum,$new_Lotnum);
break;
case "Prize_KL8_5x":
$flags=Prize_KL8_5x($buy_id,$list_id,$new_buynum,$new_Lotnum);
break;
case "Prize_3D_fs":
$flags=Prize_3D_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_zhxhz":
$flags=Prize_3D_zhxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_z3":case "Prize_3D_z6":
$flags=Prize_3D_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_hhzx":
$flags=Prize_3D_hhzx($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_zxhz":
$flags=Prize_3D_zxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_hsym":
$flags=Prize_3D_hsym($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_2mzxfs":
$flags=Prize_3D_2mzxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_hedx":
$flags=Prize_DXDS($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_3D_dwd":
$flags=Prize_3D_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_fs":
$flags=Prize_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_zhxhz":
$flags=Prize_zhxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_z3":
$flags=Prize_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_z6":
$flags=Prize_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_hhzx":
$flags=Prize_hhzx($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;
case "Prize_P5P3_zxhz":
$flags=Prize_zxhz($buy_id,$list_id,$buynum,$Z_lotnum);
break;
case "Prize_P5P3_qsym":
$flags=Prize_BDW($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_qsem":
$flags=Prize_BDW($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_zhxfs":
$flags=Prize_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_zxfs":
$flags=Prize_2X_zxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_qedx":
$flags=Prize_DXDS($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_hedx":
$flags=Prize_DXDS($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_P5P3_dwd":
$flags=Prize_1X_dwd($buy_id,$list_id,$new_buynum,$Z_lotnum);
break;

case "Prize_newfs":	
$flags=prize_newfs($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_newfs1":	
$flags=prize_newfs1($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newhz":	
$flags=prize_newhz($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newth":	
$flags=Prize_newth($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;



case "Prize_newkd":	
$flags=prize_newkd($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newbch":	
$flags=prize_newbch($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_newzysm":	
$flags=prize_newzysm($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_zysmq5":	
$flags=prize_zysmq5($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newsh":	
$flags=Prize_newsh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newlhh":	
$flags=prize_newlhh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


case "Prize_newdn":	
$flags=prize_newdn($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;


    case "Prize_3gzyh":
        $flags=prize_3gzyh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;

    case "Prize_3gdxdszh":
        $flags=prize_3gdxdszh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;

    case "Prize_bjlzxh":
        $flags=prize_bjlzxh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;

    case "Prize_bjlzxd":
        $flags=prize_bjlzxd($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;
    case "Prize_bjldxdszh":
        $flags=prize_bjldxdszh($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;


    case "Prize_ssc_z3bt":

$flags = Prize_ssc_z3bt($buy_id,$list_id,$Z_buynum,$Z_lotnum);

break;
case "Prize_ssc_dt":
$flags=prize_ssc_dt($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;

case "Prize_z3hz":

$flags=Prize_z3hz($buy_id,$list_id,$new_buynum, $new_Lotnum);
break;

case "Prize_z6hz":

$flags=Prize_z6hz($buy_id,$list_id,$new_buynum, $new_Lotnum);
break;


break;
    case "Prize_HZK3":
        $flags=Prize_HZK3($new_buynum,$new_Lotnum,$from_wei,$num_wei);
        break;

case "Prize_k3_hz":
$flags=Prize_k3_hz($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3bthz":
$flags=Prize_k3_3bthz($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_2th_ds":
$flags=Prize_k3_2th_ds($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_2bt_ds":
$flags=Prize_k3_2bt_ds($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_3bt_ds":
$flags=Prize_k3_3bt_ds($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_dx":
$flags=Prize_k3_dx($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;
case "Prize_k3_fx":
$flags=Prize_k3_fx($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_2btbz":
$flags=Prize_k3_2btbz($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;

case "Prize_k3_2btdt":
$flags=Prize_k3_2btdt($new_buynum,$new_Lotnum,$from_wei,$num_wei);
break;
case "Prize_pk_fs":
$flags=Prize_pk_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_pk_ds":
$flags=Prize_pk_ds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
case "Prize_pk_dwd":
$flags=Prize_pk_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum);
break;
    case "Prize_pk_dxds":
        $flags=Prize_pk_dxds($buy_id,$list_id,$Z_buynum,$Z_lotnum);
        break;
}
}
?>