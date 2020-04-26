<?php


$row=$db->fetch_first("select * from game_type where ckey='{$playkey}'");

$skey=$row['skey'];

$wan_key=substr($playkey,strlen($playkey)-3,strlen($playkey));

if(strpos($playkey, "K3")) $wan_key='K3';
if(strpos($playkey, "FC")) $wan_key='FC';
if(strpos($playkey, "PK10")) $wan_key='PK10';
$from_wei=0;$num_wei=3;
if($wan_key=="SSC"  or $wan_key=="SSL" or $wan_key=="FC" or  $playkey=="3D" or $wan_key=="SSL" or $skey=='dp'){
	

switch ($list_id){
case "5X_fs":case "4X_fs":case "4X1_fs":case "4R_fs":case "3X1_fs":case "3X2_fs":case "3X3_fs":case "3X4_fs":case "3R_fs":case "2X_2_zhxfs":case "2X_1_zhxfs":case "2R_zhxfs":case "2X3_2_zhxfs":case "2X3_1_zhxfs":case "2TH-dx":case "4R_fs":case "3R_fs":case "2R_fs":
$new_buynum=Lot_01_Num($buynum);
$p_num="#".$new_buynum;
if(strpos($p_num,'-')){
$n_this_list=explode(",",$new_buynum);$list_nums=0;
for($a=0;$a<count($n_this_list);$a++){
$n_this_value="#".$n_this_list[$a];
if(strpos($n_this_value,'-')){
}else{
$array_list[$list_nums]=$n_this_list[$a];$list_nums+=1;
}
}
$new_buynum=implode(",",$array_list);
}
$Next_Go="Prize_fs";
break;
case "5X_ds":case "4X_ds":case "4X1_ds":case "4R_ds":case "3X1_ds":case "RXDS_zx5z3" :case "3X2_ds":case "3X3_ds":case "3R_ds":case "2X_1_zhxds":case "2X_2_zhxds":case "2R_zhxds":case "3X4_ds":case "2X3_2_zhxds":case "2X3_1_zhxds":case "RXDS_5z3":case "RXDS_5z4":
$new_buynum=Lot_ds_Num($buynum);
$Next_Go="Prize_ds";
break;
case "5X_zh":case "4X_zh":case "4X1_zh":case "3X1_zh": case "3X2_zh": case "3X3_zh":  case "3R_zh": case "4R_zh":
$new_buynum=Lot_01_Num($buynum);
$p_num="#".$new_buynum;
if(strpos($p_num,'-')){
$n_this_list=explode(",",$new_buynum);$list_nums=0;
for($a=0;$a<count($n_this_list);$a++){
$n_this_value="#".$n_this_list[$a];
if(strpos($n_this_value,'-')){
}else{
$array_list[$list_nums]=$n_this_list[$a];$list_nums+=1;
}
}
$new_buynum=implode(",",$array_list);
}
$Next_Go="Prize_zh";
break;
case "5X_z120":case "4X_z24":case "4X1_z24": case "4R_z24": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_z120";
break;
case "5X_z60":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_z60";
break;
case "5X_lhh": 
$new_buynum=$buynum;
$Next_Go="Prize_5x_lhh";
break;
    case "LH_01":case "LH_02":case "LH_03":case "LH_04":case "LH_12":case "LH_13":case "LH_14":case "LH_23":case "LH_24":case "LH_34":
        $new_buynum=$buynum;
        $Next_Go="Prize_SSC_LH";
  break;
case "5X_DXDS": 
$new_buynum=$buynum;

$Next_Go="Prize_5x_DSDS";
break;

case "4X_z12": case "4X1_z12": case "4R_z12": 
$new_buynum=$buynum;
$Next_Go="Prize_z12";
break;
case "5X_z30": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_5X_z30";
break;
case "5X_z20":case "4X_z4":case "4X1_z4": case "4R_z4": 
$new_buynum=Lot_01_Num($buynum);


$Next_Go="Prize_z20";
break;
case "5X_z10": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_5X_z10";
break;
case "5X_z5": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_5X_z5";
break;
case "4X_z6": case "4X1_z6": case "4R_z6": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_4X_z6";
break;

case "3X1_zhxhz":case "3X2_zhxhz":case "3X3_zhxhz":case "3X4_zhxhz":case "2X_1_2xzhxhz":case "2R_2xzhxhz":case "2X_2_2xzhxhz":case "3R_zhxhz": case "RXHZ_5z3":
$new_buynum=$buynum;
$Next_Go="Prize_zhxhz";
break;
case "3X1_kd":case "3X2_kd":case "3X3_kd":case "3X4_zhxhz":case "2X_1_2xzhxkd":case "2X_2_2xzhxkd":case "2R_2xzhxkd":case "3R_kd":
$new_buynum=Lot_ds_Num($buynum);
$Next_Go="Prize_kd";
break;


case "3X1_z3":case "3X_z3":case "3X2_z3":case "3X3_z3":case "3R_z3":case "3X4_z3": case "3X_z6":case "3X1_z6":case "3X2_z6":case "3X3_z6": case "3R_z6":case "3X4_z6": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_z3";
break;
case "3X1_hhzx":case "3X2_hhzx":case "3X3_hhzx":case "3X4_hhzx":case "3R_hhzx":
$new_buynum=$buynum;
$Next_Go="Prize_hhzx";
break;
 case "3X1_z6hz":   case "3X2_z6hz":  case "3X3_z6hz":case "3X4_zxhz":    case "3R_z6hz": 
$new_buynum=$buynum;
$Next_Go="Prize_z6hz";
break;
case "3X1_zxhz":case "3X2_zxhz":case "3X3_zxhz": case "3X4_zxhz": case "3R_zxhz": case "RXHZ_zx5z3":  

$new_buynum=$buynum;


$Next_Go="Prize_z3hz";
break;
case "3X1_bd":case "3X2_bd":case "3X3_bd": case "3X4_bd":
$new_buynum=$buynum;
$Next_Go="Prize_3x_bd";
break;
case "3X1_hzws":case "3X2_hzws":case "3X3_hzws": case "3X4_hzws": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_3x_hzws";
break;
case "3X1_tshm":case "3X2_tshm":case "3X3_tshm":case "3X4_tshm": 
$Next_Go="Prize_3x_tshm";
break;
case "2X_1_2xzxfs":case "2X_2_2xzxfs":case "2X3_2_2xzxfs":case "2X3_1_2xzxfs":case "2R_2xzxfs":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_2X_zxfs";
break;
case "2X_1_zxds":case "2X_2_zxds":case "2X3_2_zxds":case "2X3_1_zxds":case "2R_zxds":
$new_buynum=Lot_ds_Num($buynum);
$Next_Go="Prize_2X_zxds";
break;
case "2X_1_2xzxhz":case "2X_2_2xzxhz":case "2R_2xzxhz":
$new_buynum=$buynum;

$Next_Go="Prize_2X_zxhz";
break;
case "2X_1_2xzxbd":case "2X_2_2xzxbd":case "2R_2xzxbd":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_2X_zxbd";
break;
case "1X1_dwd":case "1X_dwd":
$new_buynum=$buynum;
$Next_Go="Prize_1X_dwd";
break;
case "BDW_hsym":case "BDW_hsem":case "BDW_qsym":case "BDW_qsem":case "BDW_zsym":case "BDW_zsem":case "BDW_sxym":case "BDW_sxem":case "BDW_wxem":case "BDW_wxsm":case "BDW3_hsym":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_BDW";
break;
case "DXDS_hedx":case "DXDS_hsdx":case "DXDS_qedx":case "DXDS_qsdx":case "DXDS3_hedx":case "DXDS3_hsdx":case "DXDS3_qedx":case "DXDS3_qsdx":
	if($skey=='dp')
	$Next_Go="Prize_DXDS3";
	else
$Next_Go="Prize_DXDS";

break;
case "QW_wmqwsx":case "QW_smqwsx":
$Next_Go="Prize_QW_qwsx";
break;
case "QW_hsqwex":case "QW_qsqwex":
$Next_Go="Prize_QW_qwex";
break;
case "QW_wmqjsx":case "QW_smqjsx":
$Next_Go="Prize_QW_qjsx";
break;
case "QW_hsqjex":case "QW_qsqjex":
$Next_Go="Prize_QW_qjex";
break;
case "QW_yffs":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_QW_yffs";
break;
case "QW_hscs":case "QW_sxbx":case "QW_sjfc":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_hscs";
break;
case "RXFS_fs1z1":case "RXFS_fs2z2":case "RXFS_fs3z3":case "RXFS_fs4z4":case "RXFS_fs5z5":case "RXFS_fs6z5":case "RXFS_fs7z5":case "RXFS_fs8z5":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_fsrx";
break;

case "RXFS_fs5z2":case "RXFS_fs5z3":case "RXFS_fs5z4":case "RXFS_fs2z2":case "RXFS_fs3z3":case "RXFS_fs4z4":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_fsrx";
break;

case "RXDS_1z1":case "RXDS_2z2":case "RXDS_3z3":case "RXDS_4z4":case "RXDS_5z5":case "RXDS_6z5":case "RXDS_7z5":case "RXDS_8z5":
$Next_Go="Prize_11X5_rxds";
$new_buynum=Lot_01_Num($buynum);
break;

case "DXDS_qedx":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_P5P3_qedx";
break;
case "DXDS_hedx":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_P5P3_hedx";
break;

//趣味玩法、、、、、、、、、、、
//梭哈
case "SH-q5":

$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newsh";	
break;


case "SH-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newsh";	
break;


case "SH-z3":
	$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newsh";	
break;


case "SH-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newsh";	
break;


//不出号
case "BCH-q5":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newbch";
break;

case "BCH-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newbch";
break;

case "BCH-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newbch";
break;

case "BCH-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newbch";
break;

//不定位
case "BDW-q5":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

case "BDW-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

case "BDW-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

case "BDW-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

//跨度
case "KD-q5":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newkd";
break;

case "KD-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newkd";
break;

case "KD-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newkd";
break;

case "KD-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newkd";
break;

//自由双面
case "ZYSM-q5":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_zysmq5";
break;


//定位投
case "DWT-q1":
$from_wei=0;$num_wei=1;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

case "DWT-z1":
$from_wei=2;$num_wei=1;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

case "DWT-h1":
$from_wei=4;$num_wei=1;
$new_buynum=$buynum;
$Next_Go="Prize_newfs";
break;

//和值
case "HZ-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newhz";
break;

case "HZ-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newhz";
break;

case "HZ-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newhz";
break;


//三连号 二同号  二不同

case "3LH-q3":case "2TH-q3":case "2BT-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newth";
break;

case "3LH-z3":case "2TH-z3":case "2BT-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newth";
break;

case "3LH-h3":case "2TH-h3":case "2BT-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newth";
break;

//龙虎和
case "LHH-q5":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newlhh";
break;

case "LHH-q3":
$from_wei=0;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newlhh";
break;

case "LHH-z3":
$from_wei=1;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newlhh";
break;
case "LHH-h3":
$from_wei=2;$num_wei=3;
$new_buynum=$buynum;
$Next_Go="Prize_newlhh";
break;


//斗牛

case "DN-q5":case "DN-DXDS":
$from_wei=0;$num_wei=5;
$new_buynum=$buynum;
$Next_Go="Prize_newdn";
break;

//三公

        case "ZYH":
        $from_wei=0;$num_wei=5;
        $new_buynum=$buynum;
        $Next_Go="Prize_3gzyh";
        break;


        case "DXDSZH3":
            $from_wei=0;$num_wei=5;
            $new_buynum=$buynum;
            $Next_Go="Prize_3gdxdszh";
            break;
//百家乐

        case "ZXH":
            $from_wei=0;$num_wei=5;
            $new_buynum=$buynum;
            $Next_Go="Prize_bjlzxh";
            break;


        case "ZXD":
            $from_wei=0;$num_wei=5;
            $new_buynum=$buynum;
            $Next_Go="Prize_bjlzxd";
            break;

     case "DXDSZH":
        $from_wei=0;$num_wei=5;
        $new_buynum=$buynum;
        $Next_Go="Prize_bjldxdszh";
        break;



//胆拖

 case "3X1_dt":case "3X2_dt":case "3X3_dt":case "3R_dt": case "3X1_z6dt":case "3X2_z6dt":case "3X3_z6dt":case "3R_z6dt":
 	
 	$new_buynum=$buynum;
$Next_Go="Prize_ssc_dt";
break;



//组三标准

 case "3X_zsbt": case "3X1_z3bt": case "3X2_z3bt":case "3X3_z3bt":case "3R_z3bt":

 	$new_buynum=$buynum;
$Next_Go="Prize_ssc_z3bt";
break;


default:
$Next_Go="NO";
break;
}
}
if($wan_key=="1-5"){
switch ($list_id){
case "3M_zhxfs":case "2M_zhxfs": case "3M2_zhxfs":case "2M2_zhxfs": 
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_zhxfs";
break;
case "3M_zxfs":case "2M_zxfs": case "3M2_zxfs":case "2M2_zxfs": 
$new_buynum=$buynum;
$Next_Go="Prize_11X5_zxfs";
break;
case "3M_zxdt":case "3M2_zxdt":case "3M_zhxdt":case "3M2_zhxdt":case "2M_zxdt":case "2M2_zxdt":case "2M_zhxdt":case "2M2_zhxdt":case "RXDT_2z2":case "RXDT_3z3":case "RXDT_4z4":case "RXDT_5z5":case "RXDT_6z5":case "RXDT_7z5":
$new_buynum=$buynum;
$Next_Go="Prize_11X5_dt";
break;

case "BDW11_hsym":case "BDW11_hsem":case "BDW11_qsym":case "BDW11_qsem":case "BDW11_zsym":case "BDW11_zsem":case "BDW11_sxym":case "BDW11_sxem":case "BDW11_wxem":case "BDW11_wxsm":case "BDW11_hsym":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_BDW";
break;
case "BDW2_bdw":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_bdw";
break;
case "DWD_dwd":
$new_buynum=$buynum;
$Next_Go="Prize_1X_dwd";

break;
case "QWX_dds":
$new_buynum=$buynum;
$Next_Go="Prize_11X5_dds";
break;
case "QWX_czw":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_czw";
break;
case "RXFS_fs1z1":case "RXFS_fs2z2":case "RXFS_fs3z3":case "RXFS_fs4z4":case "RXFS_fs5z5":case "RXFS_fs6z5":case "RXFS_fs7z5":case "RXFS_fs8z5":
$new_buynum=Lot_01_Num($buynum);
$Next_Go="Prize_11X5_fsrx";
break;
case "3M_zhxds":case "2M_zhxds":case "3M2_zxds":case "2M2_zxds":
$Next_Go="Prize_11X5_zhxds";
$new_buynum=Lot_01_Num($buynum);
break;
case "3M_zxds":case "2M_zxds":case "3M2_zxds":case "2M2_zxds":
$Next_Go="Prize_11X5_zxds";
$new_buynum=Lot_01_Num($buynum);
break;
case "RXDS_1z1":case "RXDS_2z2":case "RXDS_3z3":case "RXDS_4z4":case "RXDS_5z5":case "RXDS_6z5":case "RXDS_7z5":case "RXDS_8z5":
$Next_Go="Prize_11X5_rxds";
$new_buynum=$buynum;
break;
default:
$Next_Go="ZhiXuan";
break;
}
}
if($skey=="kl8"){
switch ($list_id){
case "QWX2_sxp":case "QWX2_jep":
$new_buynum=$buynum;
$Next_Go="Prize_KL8_pm";
break;
case "QWX2_hzdxds":
$new_buynum=$buynum;
$Next_Go="Prize_KL8_hzdxds";
break;
case "QWX2_hzdx":    case "QWX2_hzds":
        $new_buynum=$buynum;
        $Next_Go="Prize_KL8_hzdxds1";
 break;

case "QWX2_5x":
$new_buynum=$buynum;
$Next_Go="Prize_KL8_5x";
break;
case "RXX_rx1":case "RXX_rx2":case "RXX_rx3":case "RXX_rx4":case "RXX_rx5":case "RXX_rx6":case "RXX_rx7":case "RXX_rx8":case "RXX_rx9":case "RXX_rx10":
	$buynum=str_replace(" ", ',', trim($buynum));
$new_buynum=$buynum;

$Next_Go="Prize_KL8_rx";
break;
default:
$Next_Go="ZhiXuan";
break;
}
}



if($skey=="dp"){}

if($skey=="k3" ){
$from_wei=0;$num_wei=3;
	switch ($list_id){

        case "K3HZ":
            $new_buynum=$buynum;
            $Next_Go="Prize_HZK3";
            break;

				case "k3_hz":
$new_buynum=$buynum;
$Next_Go="Prize_k3_hz";
break;
			case "3BT-HZ":
$new_buynum=$buynum;
$Next_Go="Prize_k3_3bthz";
break;

case "2TH-ds":
$new_buynum=$buynum;
$Next_Go="Prize_k3_2th_ds";
break;

case "2BT-ds":
$new_buynum=$buynum;
$Next_Go="Prize_k3_2bt_ds";
break;


case "3BT-ds":
$new_buynum=$buynum;
$Next_Go="Prize_k3_3bt_ds";
break;
		
				
		
		
	case "2TH-dx":
$new_buynum=$buynum;
$Next_Go="Prize_k3_dx";
break;
		
	
case "2BT-dt":
 	$new_buynum=$buynum;
$Next_Go="Prize_k3_2btdt";
break;

case "3BT-dt":
	
 	$new_buynum=$buynum;
$Next_Go="Prize_ssc_dt";
break;

case "3TH-tx":
	$buynum=str_replace(" ", ",", $buynum);
$new_buynum=Lot_k3_Num1($buynum,1);
$Next_Go="Prize_newfs";
break;

case "3TH-dx":
     $new_buynum=Lot_k3_Num1($buynum,1);
	$Next_Go="Prize_newfs";
break;
	case "2TH-fx":case "3LH-dx":case "3LH-tx":case "3TH-qw":
    $new_buynum=$buynum;
	$Next_Go="Prize_k3_fx";
break;


case "2BT-bz":
$new_buynum=$buynum;
	$Next_Go="Prize_k3_2btbz";
break;


case "3BT-dx":

$new_buynum=arr1_plzh($buynum,3);
	$Next_Go="Prize_newfs";
break;



case "SH":

$new_buynum=$buynum;
	$Next_Go="Prize_newsh";
break;


case "2TH-qw":case "2BT-qw":

$new_buynum=$buynum;
$Next_Go="Prize_newth";
break;
case "HZ-qw":

$new_buynum=$buynum;
	$Next_Go="Prize_newhz";
break;

case "KD-qx":

$new_buynum=$buynum;
	$Next_Go="Prize_newkd";
break;

case "BCH-qw":

$new_buynum=$buynum;
	$Next_Go="Prize_newbch";
break;

case "BDW-qw":

$new_buynum=$buynum;
	$Next_Go="Prize_newfs";
break;

case "ZYSM-qw":

$new_buynum=$buynum;
	$Next_Go="Prize_newzysm";
break;




default:
$Next_Go="NO";
break;
		
		
	}
	
	
	
}




if($skey=="pk10"){
	
	
switch ($list_id){
case "pk5x_fs":case "pk4x_fs":case "pk3x_fs":case "pk2x_fs":case "pk1x_fs":
$new_buynum=$buynum;
$Next_Go="Prize_pk_fs";
break;
case "pk5x_ds":case "pk2x_ds":case "pk3x_ds":case "pk2x_ds":
$new_buynum=$buynum;
$Next_Go="Prize_pk_ds";
break;
case "pk10x":
$new_buynum=$buynum;
$Next_Go="Prize_pk_dwd";
break;
    case "pkdx_0":case "pkdx_1":case "pkdx_2": case "pkds_0":case "pkds_1":case "pkds_2":
    $new_buynum=$buynum;
    $Next_Go="Prize_pk_dxds";
    break;
}
}

?>