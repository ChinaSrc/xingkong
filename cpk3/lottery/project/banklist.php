<?php

function Prize_3D_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$this_max=this_wanfa($list_id);
$prizenum=1;$is_right=0;
$lot_list=array_new($list_id,$Z_lotnum);
$buy_list=$Z_buynum;
for ($i=0;$i<count($buy_list);$i++){$this_buynum="#".$buy_list[$i];if(strpos($this_buynum,$lot_list[$i])){$is_right+=1;}}
if($is_right-$this_max>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_3D_zhxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];
$prizenum=0;$lot_count=$lot_a+$lot_b+$lot_c;
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if($this_value-$lot_count==0){$prizenum+=1;}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_3D_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$is_num=0;
$list_lot=$Z_lotnum;$this_codes="";$t_code=play_code($list_id);
$lot_a=$list_lot[0];$lot_b=$list_lot[1];$lot_c=$list_lot[2];
if($lot_a-$lot_b==0){$is_right+=1;$this_value=$lot_c;$have_value=$lot_a;}
if($lot_b-$lot_c==0){$is_right+=1;$this_value=$lot_a;$have_value=$lot_b;}
if($lot_a-$lot_c==0){$is_right+=1;$this_value=$lot_b;$have_value=$lot_c;}
if($lot_a-$lot_c==0 and $lot_b-$lot_c==0){return "is_no|0";exit;}
if($is_right==1 and ($t_code=="z3"or $t_code=="hhzx"or $t_code=="z3ds")){
$list_buy=array_drup_p($Z_buynum,$have_value,1);
if(count($Z_buynum)-count($list_buy)>0){
if(in_array($this_value,$list_buy)===true){$yes_num+=1;$prizenum=1;$this_codes="z3";}
}
}
if($is_right==0 and ($t_code=="z6"or $t_code=="hhzx"or $t_code=="z6ds")){
for ($i=0;$i<count($list_lot);$i++){
$this_value=$list_lot[$i];
if(in_array($this_value,$Z_buynum)===true){
$list_buy=array_drup_p($Z_buynum,$this_value,1);
$is_num+=1;
}
}
if($is_num-3>=0){$yes_num=1;$prizenum=1;$this_codes="z6";}
}
if($yes_num-1==0){
return "is_yes|1|".$this_codes;
}else{
return "is_no|0";
}
}
function Prize_3D_hhzx($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$is_right=0;$re_lot_infor="";$buy_list=$Z_buynum;
for ($i=0;$i<count($buy_list);$i++){$re_value="";
$new_buynum=Lot_01_Num($buy_list[$i]);$n_buy_list=explode(",",$new_buynum);
$re_value=Prize_3D_z3($buy_id,$list_id,$n_buy_list,$Z_lotnum);
if($re_value!="is_no|0"){
$is_right+=1;
$re_lot_infor=$re_value;
break;
}
}
if($re_lot_infor==""){return "is_no|0";}else{return $re_lot_infor;}
}
function Prize_3D_zxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$lot_count=array_count($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];if($this_value-$lot_count==0){$prizenum+=1;break;}
}
if($prizenum-1>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_3D_hsym($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$f_n=0;
$list_lot_last=$Z_lotnum;
$list_lot=array_drup_filter($list_lot_last);
if(strpos($list_id,'ym')){$this_max=1;}if(strpos($list_id,'em')){$this_max=2;}if(strpos($list_id,'sm')){$this_max=3;}
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];if(in_array($this_value,$list_lot)===true){
$n_array[$is_right]=$this_value;
$is_right+=1;
}
}
if($is_right-$this_max>=0){
$prizenum=array_coincide($n_array,$this_max);
return "is_yes|".$prizenum;
}else{
return "is_no|0";
}
}
include($this_infor_logs."/task/lot_add_bk.php");
function Prize_3D_2mzxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$list_lot=array_new($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if(in_array($this_value,$list_lot)===true){$is_right+=1;}
}
if($is_right-2>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_3D_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
for ($i=0;$i<count($Z_buynum);$i++){if(strpos($this_value,$Z_lotnum[$i])){$is_right+=1;$prizenum+=1;}}
if($is_right-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}

?>