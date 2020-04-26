<?
if(!defined('IN_PHPOE')) {
	exit('Access Denied');
}
class Core_Game_Fun{
	public static function IsPlay($gameid,$playid,$bnum){
		if(strpos($gameid,'SSC') or strpos($gameid,'FC')){
			
			switch ($playid){  
			case "5X_fs":case "4X_fs":case "4X1_fs":case "3X1_fs":case "3X2_fs":case "3X3_fs":case "3X4_fs":case "2X_2_zhxfs":case "2X_1_zhxfs":case "2X3_2_zhxfs":case "2X3_1_zhxfs":
				$next_go="ssc_fs";break; 
			case "5X_ds":case "4X_ds":case "4X1_ds":case "3X1_ds":case "3X2_ds":case "3X3_ds":case "2X_1_zhxds":case "2X_2_zhxds":case "3X4_ds":case "2X3_2_zhxds":case "2X3_1_zhxds":case "RXDS_5z2":case "RXDS_5z3":case "RXDS_5z4":case "RXDS_zx5z2":case "RXDS_zx5z3":case "RXDS_zx5z4":
				$next_go="ssc_ds";break; 
			case "5X_zh":case "4X_zh":case "4X1_zh":case "3X1_zh": case "3X2_zh": case "3X3_zh": 
				$next_go="ssc_zh";break; 
			case "5X_z120":case "4X_z24":case "4X_z6":
  	 			$next_go="ssc_z120";break; 
			case "5X_z60":case "5X_z30":case "5X_z20":case "5X_z10":case "5X_z5": case "4X_z12": case "4X_z4":
  	 			$next_go="ssc_z60";break;  
			case "3X1_zhxhz":case "3X2_zhxhz":case "3X3_zhxhz":case "RXHZ_5z2":case "RXHZ_5z4":case "RXHZ_5z3":case "RXHZ_zx5z2":case "RXHZ_zx5z4":case "RXHZ_zx5z3":
				$next_go="ssc_zhxhz";break; 
			case "3X1_kd":case "3X2_kd":case "3X3_kd":
				$next_go="ssc_kd";break; 
			case "3X1_z3":case "3X2_z3":case "3X3_z3":
  	 			$next_go="ssc_z3";break;  
			case "3X1_z6":case "3X2_z6":case "3X3_z6": 
  	 			$next_go="ssc_z6";break;  
			case "3X1_hhzx":case "3X2_hhzx":case "3X3_hhzx":case "3X4_hhzx":
  	 			$next_go="ssc_ds";break;    
			case "3X1_zxhz":case "3X2_zxhz":case "3X3_zxhz": 
  	 			$next_go="ssc_zxhz";break;      
			case "3X1_bd":case "3X2_bd":case "3X3_bd": 
  	 			$next_go="ssc_bd";break;       
			case "3X1_hzws":case "3X2_hzws":case "3X3_hzws": 
  	 			$next_go="ssc_ds";break;       
			case "3X1_tshm":case "3X2_tshm":case "3X3_tshm":
  	 			$next_go="ssc_ds";break;
			case "2X_1_2xzhxhz":case "2X_2_2xzhxhz":
				$next_go="ssc_2xzhxhz";break;
			case "2X_1_2xzhxkd":case "2X_2_2xzhxkd":
				$next_go="ssc_2xzhxkd";break;
			case "2X_1_2xzxfs":case "2X_2_2xzxfs":case "2X3_2_2xzxfs":case "2X3_1_2xzxfs":
				$next_go="ssc_2xzxfs";break;           
			case "2X_1_zxds":case "2X_2_zxds":case "2X3_2_zxds":case "2X3_1_zxds":
				$next_go="ssc_ds";break;            
			case "2X_1_2xzxhz":case "2X_2_2xzxhz":
				$next_go="ssc_2xzxhz";break;            
			case "2X_1_2xzxbd":case "2X_2_2xzxbd":
				$next_go="ssc_2xzxbd";break;   
			case "1X1_dwd":case "1X_dwd":
				$next_go="ssc_1xdwd";break;  	             
			case "BDW_hsym":case "BDW_hsem":case "BDW_qsym":case "BDW_qsem":case "BDW_sxym":case "BDW_sxem":case "BDW_wxem":case "BDW_wxsm":case "BDW3_hsym":
				$next_go="ssc_bdw";break;  			          
			case "DXDS_hedx":case "DXDS_hsdx":case "DXDS_qedx":case "DXDS_qsdx":
  	 			$next_go="ssc_dxds";break;  			          
			case "QW_wmqwsx":case "QW_smqwsx":case "QW_hsqwex":case "QW_qsqwex":
  	 			$next_go="ssc_qwesx";break; 		          
			case "QW_wmqjsx":case "QW_smqjsx":case "QW_hsqjex":case "QW_qsqjex":
  	 			$next_go="ssc_qjesx";break;   				          
			case "QW_yffs":case "QW_hscs":case "QW_sxbx":case "QW_sjfc":
				$next_go="ssc_ds";break;
            case "RXFS_fs1z1":case "RXFS_fs2z2":case "RXFS_fs5z2":case "RXFS_fs3z3":case "RXFS_fs5z4":case "RXFS_fs5z5":case "RXFS_fs6z5":case "RXFS_fs7z5":case "RXFS_fs8z5":
				$next_go="lt_rxfs";break;      
		    default:
				$counts=0;break;
			}
		}
		if(strpos($gameid,'11-5')){
			switch ($playid){  
			case "3M_zhxfs":case "2M_zhxfs": 
				$next_go="lt_fs";break;  		          
			case "3M_zxfs":case "2M_zxfs": 
				$next_go="lt_zxfs";break;       				          
			case "3M_zxdt":case "2M_zxdt":case "RXDT_2z2":case "RXDT_3z3":case "RXDT_4z4":case "RXDT_5z5":case "RXDT_6z5":case "RXDT_7z5": case "RXDT_8z5": 
				$next_go="lt_zxdt";break;  				          
			case "BDW2_bdw":
				$next_go="lt_ds";break;      				          
			case "DWD_dwd":
				$next_go="lt_dwd";break;       				          
			case "QWX_czw":case "QWX_dds":
				$next_go="lt_ds";break;  				          
			case "RXFS_fs1z1":case "RXFS_fs2z2":case "RXFS_fs5z2":case "RXFS_fs3z3":case "RXFS_fs4z4":case "RXFS_fs5z5":case "RXFS_fs6z5":case "RXFS_fs7z5":case "RXFS_fs8z5":
				$next_go="lt_rxfs";break;       				          
			case "3M_zhxds":case "2M_zhxds":case "3M_zxds":case "2M_zxds":  
  	 			$next_go="lt_ds";break;          				          
			case "RXDS_1z1":case "RXDS_2z2":case "RXDS_3z3":case "RXDS_4z4":case "RXDS_5z5":case "RXDS_6z5":case "RXDS_7z5":case "RXDS_8z5":
  	 			$next_go="lt_ds";break;  
			default:
				$counts=0;break;
			}
		}
		if( strpos($gameid, 'KL8')!==false){
			switch ($playid){
			case "QWX2_sxp":case "QWX2_jep":case "QWX2_hzdxds":
				$next_go="jr_QWX";break;            
			case "RXX_rx1":case "RXX_rx2":case "RXX_rx3":case "RXX_rx4":case "RXX_rx5":case "RXX_rx6":case "RXX_rx7":
				$next_go="jr_rx";break;  
			default:
				$counts=0;break;
			}
		}
		if($gameid=="3D" or strpos($gameid,'SSL')){
			switch ($playid){
			case "3X4_fs":case "2X3_2_zhxfs":case "2X3_1_zhxfs":
				$next_go="ssc_fs";break;  
			case "3X4_ds":case "3X4_hhzx":case "3X4_z3ds":case "3X4_z6ds":
				$next_go="ssc_ds";break;  
			case "3X4_zhxhz":
				$next_go="ssc_zhxhz";break;               				          
			case "3X4_z3":
				$next_go="ssc_z3";break;
			case "3X4_z6":
				$next_go="ssc_z6";break;                				          
			case "3X4_zxhz":
				$next_go="ssc_zxhz";break;                  				          
			case "BDW3_hsym":case "BDW2_qsem":
				$next_go="ssc_bdw";break;          				          
			case "2X3_2_2xzxfs":case "2X3_1_2xzxfs":
				$next_go="ssc_2xzxfs";break;                    				          
			case "DXDS3_hedx":
				$next_go="ssc_dxds";break;                   				          
			case "1X1_dwd":
				$next_go="ssc_1xdwd";break;   
			default:
				$counts=0;break;
			}
		}
		if($gameid=="P5(P3)"){
			switch ($playid){
			case "3X1_fs":case "2X_1_zhxfs":case "2X_2_zhxfs":
				$next_go="ssc_fs";break; 
			case "3X1_ds":case "3X1_hhzx":
				$next_go="ssc_ds";break;  
			case "3X1_zhxhz":
				$next_go="ssc_zhxhz";break;  
			case "3X1_z3":
				$next_go="ssc_z3";break; 
			case "3X1_z6":
				$next_go="ssc_z6";break;   
			case "3X1_zxhz":
				$next_go="ssc_zxhz";break;   
			case "BDW_qsym":case "BDW_qsem":
				$next_go="ssc_bdw";break;  
			case "2X_1_2xzxfs":case "2X_2_2xzxfs":
				$next_go="ssc_2xzxfs";break;  
			case "DXDS_qedx":case "DXDS_hedx":
				$next_go="ssc_dxds";break;   
			case "1X_dwd":
				$next_go="ssc_1xdwd";break; 
			default:
				$counts=0;break;
			}
		}
		if($next_go){$counts=self::CouPlay($gameid,$playid,$next_go,$bnum);}else{$counts=0;}
		return $counts;
	}
	public static function CouPlay($gameid,$playid,$keys,$bnum){
		$b_arrs=explode(",",$bnum);
		$counts=0;
		switch ($keys){ 
			case "ssc_fs":case "ssc_zh":
				$counts=1;
				for($i=0;$i<count($b_arrs);$i++){$counts=$counts*strlen($b_arrs[$i]);}
				if($keys=="ssc_zh"){$i=substr($playid,0,1);$counts=$counts*$i;}
			    break; 
			case "ssc_ds":
				$counts=count($b_arrs);break; 
			case "ssc_z120":
				$nus=count($b_arrs);
			    if($playid=="5X_z120"){$c_num=5;}
				if($playid=="4X_z24"){$c_num=4;}
				if($playid=="4X_z6"){$c_num=2;}
				$counts=self::C_list($nus,$c_num); 
			    break;
			case "ssc_z60":
				$n_0=strlen($b_arrs[0]);
				$n_1=strlen($b_arrs[1]);
				for($i=0;$i<strlen($b_arrs[0]);$i++){
					$a_ar[]=substr($b_arrs[0],$i,1);
				}
				for($i=0;$i<strlen($b_arrs[1]);$i++){
					$b_ar[]=substr($b_arrs[1],$i,1); 
				} 
			    if($playid=="5X_z60"){ 
					$sele_count= Array('0','0','0','1','4','10','20','35','56','84');$anum=0;
					$a=count($a_ar);$b=count($b_ar);$num=count(array_intersect($a_ar,$b_ar));if($b-1>=0){$c=$b-1;}else{$c=0;};
					if($num-1>=0){if($a-$num==0){$anum=$sele_count[$c]*$a;}if($a-$num>0){$anum=$sele_count[$b]*($a-$num)+$sele_count[$c]*$num;}}else{$anum=$sele_count[$b]*$a;} 
					$counts=$anum;
				}
			    if($playid=="5X_z30" or $playid=="5X_z20"){
					if ($playid=="5X_z30"){$alist=$a_ar;$blist=$b_ar;}
					if ($playid=="5X_z20"){$alist=$b_ar;$blist=$a_ar;}
					$a=count($alist);$b=count($blist);$bnum=0;
					for ($i=0;$i<$a-1;$i++){$d=$i+1;for ($j=$d;$j<$a;$j++){for ($c=0;$c<$b;$c++){if($alist[$i]-$blist[$c]!=0 && $alist[$j]-$blist[$c]!=0){$bnum=$bnum+1;}}}}
					$counts=$bnum;
				} 
			    if($playid=="5X_z10" or $playid=="5X_z10"){
					$alist=$a_ar;$blist=$b_ar;$a=count($alist);$b=count($blist);$bnum=0;
					for ($i=0;$i<$a;$i++){for ($j=0;$j<$b;$j++){if($alist[$i]-$blist[$j]!=0){$bnum=$bnum+1;}}}
					$counts=$bnum;
				}
				if($playid=="4X_z12"){ 
					$sele_count=Array('0','1','3','6','10','15','21','28','36');  
    				$a=count($a_ar);$b=count($b_ar);
    				$anum=0;$bnum=0; 
					$num=count(array_intersect($a_ar,$b_ar)); 
    				if($b-1>=0){$c=$b-1;}else{$c=0;}
					if($b-2>=0){$d=$b-2;}else{$d=0;}
					if($num-1>=0){
		 				if($a-$num==0){$c=$b-2;$anum=$sele_count[$c]*$a;}
		 				if($a-$num>0){$c=$b-2;$anum=$sele_count[$c]*$num;$anum=$anum+$sele_count[$b-1]*($a-$num);}
					}else{if($b-1>=0){$c=$b-1;}else{$c=0;};$anum=$sele_count[$c]*$a;}
					$counts=$anum;
				}
				if($playid=="4X_z4"){
					$sele_count=Array('0','1','2','3','4','5','6','7','8','9');
    				$a=count($a_ar);$b=count($b_ar);
    				$anum=0;$bnum=0;
					for($e=0;$e<$a;$e++){
						$this_num=$a_ar[$e];
						$d_arr=self::drop_array_lines($b_ar,$this_num);  
						$endnum+=count($d_arr);
					}
					$counts=$endnum;
				}
			    break;
			case "ssc_zhxhz":
				$n_arr=Array('1','3','6','10','15','21','28','36','45','55','63','69','73','75','75','73','69','63','55','45','36','28','21','15','10','6','3','1');
			    for ($i=0;$i<count($b_arrs);$i++){$counts+=$n_arr[$b_arrs[$i]];}
				break;
			case "ssc_kd":
				$n_arr=Array('10','54','96','126','144','150','144','126','96','54');
				for ($i=0;$i<count($b_arrs);$i++){$counts+=$n_arr[$b_arrs[$i]];}
				break;
			case "ssc_z3":
				$n_s=count($b_arrs);$counts=$n_s*($n_s-1);break;
			case "ssc_z6":
				$n_s=count($b_arrs);$counts=self::C_list($n_s,3);break;
			case "ssc_zxhz":
				$n_arr=Array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
				for ($i=0;$i<count($b_arrs);$i++){$counts+=$n_arr[$b_arrs[$i]-1];}
				break;
			case "ssc_bd": 
				$counts=54;break;
		    case "ssc_tshm":
				$counts=54;break;
			case "ssc_2xzhxhz":
				$bnum=0;
				for ($i=0;$i<count($b_arrs);$i++){for ($j=0;$j<10;$j++){for ($c=0;$c<10;$c++){if($j+$c-$b_arrs[$i]==0){$bnum+=1;}}}}
				$counts=$bnum;break;
			case "ssc_2xzhxkd":
				$bnum=0;
				for ($i=0;$i<count($b_arrs);$i++){for ($j=0;$j<10;$j++){for ($c=0;$c<10;$c++){$b=0;if($j-$c<0){$b=$c-$j;}else{$b=$j-$c;}if($b-$b_arrs[$i]==0){$bnum+=1;}}}}
				$counts=$bnum;break;
			case "ssc_2xzxfs":
				$n_s=count($b_arrs);$counts=self::C_list($n_s,2);break;
			case "ssc_2xzxhz":
				$bnum=0;
				for ($i=0;$i<count($b_arrs);$i++){$b=$b_arrs[$i];for ($j=0;$j<10;$j++){for ($c=$j;$c<10;$c++){if($j-$c!=0){if($b-$j-$c==0){$bnum+=1;}}}}}
				$counts=$bnum;break;
			case "ssc_2xzxbd":
				$counts=9;break;
			case "ssc_1xdwd":
				$bnum=0;for ($i=0;$i<count($b_arrs);$i++){$bnum+=strlen($b_arrs[$i]);}
				$counts=$bnum;break;
			case "ssc_bdw":
				if(strpos($playid,'hsym')){$c_num=1;}
				if(strpos($playid,'hsem')){$c_num=2;}
				if(strpos($playid,'qsym')){$c_num=1;} 
				if(strpos($playid,'qsem')){$c_num=2;}
				if(strpos($playid,'sxym')){$c_num=1;}
				if(strpos($playid,'sxem')){$c_num=2;}
				if(strpos($playid,'wxem')){$c_num=2;}
				if(strpos($playid,'wxsm')){$c_num=3;} 
				$n_s=count($b_arrs);$counts=self::C_list($n_s,$c_num);break;
			case "ssc_dxds":
				$bnum=1;for ($i=0;$i<count($b_arrs);$i++){$bnum=strlen($b_arrs[$i])/3*$bnum;}
				$counts=$bnum;break;
			case "ssc_qwesx";
				$bnum=1;
				for ($i=0;$i<count($b_arrs);$i++){if(preg_match("/[\x7f-\xff]/", $b_arrs[$i])){$bnum=strlen($b_arrs[$i])/3*$bnum;}else{$bnum=strlen($b_arrs[$i])*$bnum;}}
				$counts=$bnum;break;
			case "ssc_qjesx":
				$bnum=1;
				for ($i=0;$i<count($b_arrs);$i++){if(preg_match("/[\x7f-\xff]/", $b_arrs[$i])){$bnum=strlen($b_arrs[$i])/6*$bnum;}else{$bnum=strlen($b_arrs[$i])*$bnum;}}
				$counts=$bnum;break;
			case "lt_fs":
				$bnum=0; 
				if($playid=="3M_zhxfs"){
					$a_ar=explode(" ",Trim($b_arrs[0]));$b_ar=explode(" ",Trim($b_arrs[1]));$c_ar=explode(" ",Trim($b_arrs[2]));
					for ($i=0;$i<count($a_ar);$i++){
						$i_value=$a_ar[$i];for ($j=0;$j<count($b_ar);$j++){$j_value=$b_ar[$j];for ($c=0;$c<count($c_ar);$c++){$c_value=$c_ar[$c];if($i_value-$j_value!=0 and $j_value-$c_value!=0 and $i_value-$c_value!=0){$bnum+=1;}}}
					}
			    }
				if($playid=="2M_zhxfs"){
					$a_ar=explode(" ",Trim($b_arrs[0]));$b_ar=explode(" ",Trim($b_arrs[1]));
					for ($i=0;$i<count($a_ar);$i++){$i_value=$a_ar[$i];for ($j=0;$j<count($b_ar);$j++){$j_value=$b_ar[$j];if($i_value-$j_value!=0){$bnum+=1;}}}
			    }			    
				$counts=$bnum;break;
			case "lt_zxfs":
				if($playid=="3M_zxfs"){$c_num=3;}if($playid=="2M_zxfs"){$c_num=2;}
				$n_s=count($b_arrs);$counts=self::C_list($n_s,$c_num);break;
			case "lt_ds":
				$counts=count($b_arrs);break;
			case "lt_zxdt":
				$a_ar=explode(" ",Trim($b_arrs[0]));$b_ar=explode(" ",Trim($b_arrs[1]));
				if($playid=="3M_zxdt"){$num=3-count($a_ar);}
				if($playid=="2M_zxdt"){$num=2-count($a_ar);}
				if($playid=="RXDT_2z2"){$num=2-count($a_ar);}
				if($playid=="RXDT_3z3"){$num=3-count($a_ar);}
				if($playid=="RXDT_4z4"){$num=4-count($a_ar);}
				if($playid=="RXDT_5z5"){$num=5-count($a_ar);}
				if($playid=="RXDT_6z5"){$num=6-count($a_ar);}
				if($playid=="RXDT_7z5"){$num=7-count($a_ar);}
				if($playid=="RXDT_8z5"){$num=8-count($a_ar);} 
				$counts=self::C_list(count($b_ar),$num);break;
			case "lt_dwd":
				$a_ar=explode(" ",Trim($b_arrs[0]));$b_ar=explode(" ",Trim($b_arrs[1]));$c_ar=explode(" ",Trim($b_arrs[2]));
			    $counts=count($a_ar)+count($b_ar)+count($c_ar);break;
			case "lt_rxfs": 
				if($playid=="RXFS_fs1z1"){$num=1;}
				if($playid=="RXFS_fs2z2"){$num=2;}
				if($playid=="RXFS_fs3z3"){$num=3;}
				if($playid=="RXFS_fs4z4"){$num=4;}
				if($playid=="RXFS_fs5z5"){$num=5;}
				if($playid=="RXFS_fs6z5"){$num=6;}
				if($playid=="RXFS_fs7z5"){$num=7;}
				if($playid=="RXFS_fs8z5"){$num=8;}
				$counts=self::C_list(count($b_arrs),$num);break;
			case "jr_QWX":
				$counts=count($b_arrs);break;
			case "jr_rx":
				$num=substr($playid,strlen($playid)-1,1); 
				$counts=self::C_list(count($b_arrs),$num);break;
			default:
				$counts=0;break;
		}
		return $counts;
	}
	public static function C_list($numbers,$lens){
    	//11!/(11-4)! * 4!
		$up_count=1;$down_count_a=1;$down_count_b=1;
		for ($i=1;$i<=$numbers;$i++){$up_count=$up_count*$i;}
		$lost_num=$numbers-$lens;
		for ($j=1;$j<=$lost_num;$j++){$down_count_a=$down_count_a*$j;}
		for ($a=1;$a<=$lens;$a++){$down_count_b=$down_count_b*$a;}
		$down_count=$down_count_a*$down_count_b; 
		$re_num=(int)($up_count/$down_count);
		return $re_num;
	}
	public static function drop_array_lines($arr,$num){
		$drop_arr=Array();
		for($o=0;$o<count($arr);$o++){
			if($arr[$o]-$num==0){  
			}else{
				$drop_arr[]=$arr[$o]; 
			}
		}
		return $drop_arr;
	}
} 
?>