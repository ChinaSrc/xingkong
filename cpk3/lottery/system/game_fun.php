<?php
 
function str_type_dx($str){
if($str-4>0){$re_value="大";}
if($str-5<0){$re_value="小";}
return $re_value;
}
function array_dds($Z_lotnum){
$dan_num=0;$suan_num=0;
for ($i=0;$i<count($Z_lotnum);$i++){
if($Z_lotnum[$i]%2==0){$suan_num+=1;}else{$dan_num+=1;}
}
$re_value=$dan_num."单".$suan_num."双";
return $re_value;
}
function array_order($Z_lotnum){
for ($i=0;$i<count($Z_lotnum);$i++){
if($this_value==""){
$this_value=$Z_lotnum[$i];$last_value=$Z_lotnum[$i];
}else{
if($last_value-$Z_lotnum[$i]>=0){
$this_value=$Z_lotnum[$i]."|".$this_value;
}else{
$this_value=$this_value."|".$Z_lotnum[$i];
}
}
}
$re_value=explode("|",$this_value);
return $re_value;
}
function array_ds_buy($Z_buynum){
$str_arrary=array(".",","," ");
for ($i=0;$i<count($str_arrary);$i++){
if(strpos($Z_buynum,$str_arrary[$i])){
$buy_list=explode($str_arrary[$i],$Z_buynum);
}
}
return $buy_list;
}
function str_type_qj($str){
if($str-1<=0 ){$re_value="一";}
if($str-2>=0 and $str-3<=0){$re_value="二";}
if($str-4>=0 and $str-5<=0){$re_value="三";}
if($str-6>=0 and $str-7<=0){$re_value="四";}
if($str-8>=0){$re_value="五";}
return $re_value;
}
function play_type($list_id){
$id_list=explode("_",$list_id);
if(count($id_list)>2){$plays=$id_list[0]."_".$id_list[1];}else{$plays=$id_list[0];}
return $plays;
}
function play_code($list_id){
$id_list=explode("_",$list_id);
$id_num=count($id_list)-1;
return $id_list[$id_num];
}
function lot_type($i_array){
$lot_a=$i_array[0];$lot_b=$i_array[1];$lot_c=$i_array[2];
if($lot_b-$lot_a==0 or $lot_c-$lot_b==0 or $lot_c-$lot_a==0){$re_value="对子";}
if($lot_a-$lot_b==0 and $lot_b-$lot_c==0){$re_value="豹子";}
if($lot_b-$lot_a==1 and $lot_c-$lot_b==1){$re_value="顺子";}
return $re_value;
}
function lot_type_key($str){
if($str=="豹子"){$re_value="bz";}
if($str=="顺子"){$re_value="sz";}
if($str=="对子"){$re_value="dz";}
return $re_value;
}
function array_dxds($lot_list){
$max_num=count($lot_list);$re_list="";
for ($i=0;$i<$max_num;$i++){
$re_value="";$lot_value=$lot_list[$i];
if($lot_value-5>=0){if($re_value==""){$re_value="大";}else{$re_value.="|大";}}
if($lot_value-5<0){if($re_value==""){$re_value="小";}else{$re_value.="|小";}}
if(($lot_value+1)%2==0){if($re_value==""){$re_value="单";}else{$re_value.="|单";}}
if(($lot_value+2)%2==0){if($re_value==""){$re_value="双";}else{$re_value.="|双";}}
if($re_list==""){$re_list=$re_value;}else{$re_list.="#".$re_value;}
}
if($re_list!=""){$re_value_new=explode("#",$re_list);return $re_value_new;}else{return "no";}
}
function array_new_other($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[3];$lot_e=$Z_lotnum[4];
if($list_id=="BDW_hsym"or $list_id=="BDW_hsem"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="BDW_qsym"or $list_id=="BDW_qsem"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="BDW_sxym"or $list_id=="BDW_sxem"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="DXDS_hedx"){$n_array=$lot_d."|".$lot_e;}
if($list_id=="DXDS_qedx"){$n_array=$lot_a."|".$lot_b;}
if($list_id=="DXDS_hsdx"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="DXDS_qsdx"or $list_id=="BDW2_bdw"or $list_id=="DWD_dwd"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="QW_wmqwsx"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_smqwsx"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_hsqwex"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_qsqwex"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="QW_wmqjsx"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_smqjsx"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_hsqjex"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_qsqjex"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="QW_wmqwsx"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_wmqwsx"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="QW_wmqwsx"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="BDW3_hsym"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="DXDS3_hedx"){$n_array=$lot_b."|".$lot_c;}
$new_list=explode("|",$n_array);
if($list_id=="BDW_wxem"or $list_id=="BDW_wxsm"){$new_list=$Z_lotnum;}
return $new_list;
}
function array_new($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[3];$lot_e=$Z_lotnum[4];
$plays=play_type($list_id);
if($plays=="5X"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="4X"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="3X3"){$n_array=$lot_b."|".$lot_c."|".$lot_d;}
if($plays=="3X2"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="3X1"or $plays=="3M"or $plays=="3X4"){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($plays=="2X_1"or $plays=="2M"or $plays=="2X3_1"){$n_array=$lot_a."|".$lot_b;}
if($plays=="2X3_2"){$n_array=$lot_b."|".$lot_c;}
if($plays=="2X_2"){$n_array=$lot_d."|".$lot_e;}
$new_list=explode("|",$n_array);
return $new_list;
}
function array_drup($i_array,$str,$num){
$is_ok=0;$f=0;
for ($i=0;$i<count($i_array);$i++){
if($is_ok-$num>=0){$n_array[$f]=$i_array[$i];$f+=1;}else{if($i_array[$i]-$str==0){$is_ok+=1;}else{$n_array[$f]=$i_array[$i];$f+=1;}}
}
return $n_array;
}
function array_drup_p($i_array,$str,$num){
$is_ok=0;$f=0;
$last_len=count($i_array);
for ($i=0;$i<count($i_array);$i++){
if($is_ok-$num>=0){
$n_array[$f]=$i_array[$i];$f+=1;
}else{
if($i_array[$i]-$str==0){
$is_ok+=1;
}else{
$n_array[$f]=$i_array[$i];$f+=1;
}
}
}
if($n_array!=""){$this_len=count($n_array);}else{$this_len=0;}
if($last_len-$this_len==$num){if($n_array){return $n_array;}else{return "";}}else{return $i_array;}
}
function array_drup_all($i_array,$str){
$is_ok=0;$f=0;
$last_len=count($i_array);
for ($i=0;$i<count($i_array);$i++){
if($i_array[$i]-$str!=0){
$n_array[$f]=$i_array[$i];$f+=1;
}
}
return $n_array;
}
function array_drup_filter($i_array){
$filter_num="#";$f=0;
$last_len=count($i_array);
for ($i=0;$i<count($i_array);$i++){
if(!strpos($filter_num,$i_array[$i])){
$filter_num.=$i_array[$i];
$n_array[$f]=$i_array[$i];$f+=1;
}
}
return $n_array;
}
function this_wanfa($list_id){
$list_id="#".$list_id;
if(strpos($list_id,'5X')){$this_max=5;}
if(strpos($list_id,'4X')){$this_max=4;}
if(strpos($list_id,'3X')){$this_max=3;}
if(strpos($list_id,'2X')){$this_max=2;}
if(strpos($list_id,'3M')){$this_max=3;}
if(strpos($list_id,'2M')){$this_max=2;}
return $this_max;
}
function Add_for_five($list_id,$sele_list){
if($list_id=="5X_ds"){$new_list=$sele_list;}
if($list_id=="4X_ds"){$new_list="-".$sele_list;}
if($list_id=="3X3_ds"){$new_list="-".$sele_list."-";}
if($list_id=="3X2_ds"){$new_list="--".$sele_list;}
if($list_id=="3X1_ds"){$new_list=$sele_list."--";}
if($list_id=="2X_1_zhxds"){$new_list=$sele_list."---";}
if($list_id=="2X_2_zhxds"){$new_list="---".$sele_list;}
return $new_list;
}
function array_count($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[3];$lot_e=$Z_lotnum[4];
$plays=play_type($list_id);
if($plays=="3X1"){$count_num=$lot_a+$lot_b+$lot_c;}
if($plays=="3X2"){$count_num=$lot_c+$lot_d+$lot_e;}
if($plays=="3X3"){$count_num=$lot_b+$lot_c+$lot_d;}
if($plays=="3X4"){$count_num=$lot_a+$lot_b+$lot_c;}
if($plays=="2X_1"){$count_num=$lot_a+$lot_b;}
if($plays=="2X_2"){$count_num=$lot_d+$lot_e;}
return $count_num;
}
function number_max($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[3];$lot_e=$Z_lotnum[4];
if($list_id=="3X1_kd"){$max_num=max($lot_a,$lot_b);$count_num=max($max_num,$lot_c);}
if($list_id=="3X2_kd"){$max_num=max($lot_c,$lot_d);$count_num=max($max_num,$lot_e);}
if($list_id=="3X3_kd"){$max_num=max($lot_b,$lot_c);$count_num=max($max_num,$lot_d);}
if($list_id=="2X_1_2xzhxkd"){$count_num=max($lot_a,$lot_b);}
if($list_id=="2X_2_2xzhxkd"){$count_num=max($lot_d,$lot_e);}
return $count_num;
}
function number_min($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[3];$lot_e=$Z_lotnum[4];
if($list_id=="3X1_kd"){$max_num=min($lot_a,$lot_b);$count_num=min($max_num,$lot_c);}
if($list_id=="3X2_kd"){$max_num=min($lot_c,$lot_d);$count_num=min($max_num,$lot_e);}
if($list_id=="3X3_kd"){$max_num=min($lot_b,$lot_c);$count_num=min($max_num,$lot_d);}
if($list_id=="2X_1_2xzhxkd"){$count_num=min($lot_a,$lot_b);}
if($list_id=="2X_2_2xzhxkd"){$count_num=min($lot_d,$lot_e);}
return $count_num;
}
function array_coincide($n_array,$this_max){
$is_yes=0;$max_num=count($n_array);
if($this_max-3==0){$max_a=$max_num-1;$max_b=$max_num-2;}
if($this_max-2==0){$max_a=count($n_array);$max_b=$max_num-1;}
if($this_max-1==0){$max_b=count($n_array);}
for ($i=0;$i<$max_b;$i++){
if($this_max-1==0){
$is_yes_a+=1;
}else{
for ($j=$i+1;$j<$max_a;$j++){
if($this_max-2==0){$is_yes_a+=1;}else{
for ($k=$j+1;$k<$max_num;$k++){
if($this_max-3==0){$is_yes_a+=1;}
}
}
}
}
}
return $is_yes_a;
}
function kl8_lot_code($Z_lotnum,$code){
if(strpos($Z_lotnum,"#")){$lot_lists=explode("#",$Z_lotnum);$lot_list=explode(",",$lot_lists[0]);}else{$lot_list=explode(",",$Z_lotnum);}
$shang=0;$xia=0;$jis=0;$ous=0;
for ($i=0;$i<count($lot_list);$i++){if($lot_list[$i]-40>0){$xia+=1;}else{$shang+=1;}if($lot_list[$i]%2==0){$ous+=$lot_list[$i];}else{$jis+=$lot_list[$i];}}
if($code=="sxp"){if($xia-$shang>0){$re_value="下";}if($xia-$shang==0){$re_value="中";}if($shang-$xia>0){$re_value="上";}}
if($code=="jep"){if($ous-$jis>0){$re_value="偶";}if($ous-$jis==0){$re_value="和";}if($jis-$ous>0){$re_value="奇";}}
return $re_value;
}
function kl8_lot_count($Z_lotnum){
if(strpos($Z_lotnum,"#")){$lot_lists=explode("#",$Z_lotnum);$lot_list=explode(",",$lot_lists[0]);}else{$lot_list=explode(",",$Z_lotnum);}
for ($i=0;$i<count($lot_list);$i++){$couns+=$lot_list[$i];}if($couns-810>0){$dx="大";}else{$dx="小";}if($couns%2==0){$ds="双";}else{$ds="单";}
return $dx.".".$ds;
}
function C_list($numbers,$lens){
$up_count=1;$down_count_a=1;$down_count_b=1;
for ($i=1;$i<=$numbers;$i++){$up_count=$up_count*$i;}
$lost_num=$numbers-$lens;
for ($j=1;$j<=$lost_num;$j++){$down_count_a=$down_count_a*$j;}
for ($a=1;$a<=$lens;$a++){$down_count_b=$down_count_b*$a;}
$down_count=$down_count_a*$down_count_b;
$re_num=(int)($up_count/$down_count);
return $re_num;
}
?>