<?php



function getCombinationToString11($arr, $len)
{
    if ($len == 1) {
        return $arr[0];
    }
    $tempArr = $arr;
    unset($tempArr[0]);
    $returnarr = array();
    $len2 = count($arr);
    $ret = getCombinationToString(array_values($tempArr), ($len - 1));
    foreach ($arr[$len2 - $len] as $alv) {
        foreach ($ret as $rv) {
            if (is_array($rv)) {
                array_unshift($rv, $alv);
                $returnarr[] = array_values($rv);
            } else {
                $returnarr[] =array($alv,$rv);
            }
        }
    }

    return $returnarr;
}







 //复式
function Prize_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$this_max=this_wanfa($list_id);
$prizenum=1;
$is_right=0;
$lot_list=array_new($list_id,$Z_lotnum);




if(count($lot_list) != count($lot_list, 1)){
	$temp=$lot_list;
}
else $temp[0]=$lot_list;

$buy_list=$Z_buynum;
foreach ($temp as $value)	{

	$lot_list=$value;

for ($i=0;$i<count($buy_list);$i++){$this_buynum="#".$buy_list[$i];if(strpos($this_buynum,$lot_list[$i])){$is_right+=1;}}


}
if($list_id=='2R_fs' or $list_id=='3R_fs' or $list_id=='4R_fs' )
{
if($is_right-$this_max>=0){
	$sum1=$sum2=1;

	for($i=$is_right;$i>$is_right-$this_max;$i--){
		$sum1=$sum1*$i;


	}
for($i=1;$i<=$this_max;$i++)$sum2=$sum2*$i;

$prizenum=$sum1/$sum2;

}


}

else
$prizenum=$is_right-$this_max;


if($is_right-$this_max>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}


//单式
function Prize_ds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$this_max=0;$list_ids="#".$list_id;$this_max=this_wanfa($list_ids);


$buynum_all="#".$Z_buynum;
if(strpos($buynum_all,',')){$buy_list=explode(",",$Z_buynum);}
elseif(strpos($buynum_all,'|')){$buy_list=explode("|",$Z_buynum);}else{$buy_list=explode(",",$Z_buynum);}
$list_lot=array_new($list_id,$Z_lotnum);

if(count($list_lot) != count($list_lot, 1)){
	$temp=$list_lot;
}
else $temp[0]=$list_lot;

foreach ($temp as $value)	{

	$list_lot=$value;
$lot_value=implode("",$list_lot);
for ($i=0;$i<count($buy_list);$i++){
$is_right=0;
$this_value=$buy_list[$i];
if($this_value-$lot_value==0){$is_right+=1;break;}
}
if($is_right-1>=0){$prizenum+=1;$statuss="is_yes";}
}
if($prizenum>0){return "is_yes|$prizenum";}else{return "is_no|0";}
}
//组合
function Prize_zh($buy_id,$list_id,$Z_buynum,$Z_lotnum){



$prizenum=0;$status="";$is_right=0;$is_a=0;$is_b=0;$is_c=0;$is_d=0;$this_max=this_wanfa($list_id);
$lot_list=array_new($list_id,$Z_lotnum);
if($this_max-5==0){$pri_a="5X";$pri_b="4X";$pri_c="3X";$pri_d="2X";$pri_e="1X";}
if($this_max-4==0){$pri_a="4X";$pri_b="3X";$pri_c="2X";$pri_d="1X";$pri_e="";}
if($this_max-3==0){$pri_a="3X";$pri_b="2X";$pri_c="1X";$pri_d="";$pri_e="";}



for ($i=0;$i<count($lot_list);$i++){
$buy_this="#".$Z_buynum[$i];
if(strpos($buy_this,$lot_list[$i])){
$is_right+=1;
if($i-1>=0){$a+=1;}if($i-2>=0){$b+=1;}if($i-3>=0){$c+=1;}if($i-4>=0){$d+=1;}
}
}
if($is_right-$this_max>=0){$prizenum+=1;$status=$pri_a;}
if($this_max-$a-1==0 and $pri_b!=""){$prizenum+=1;if($status==""){$status=$pri_b;}else{$status.="^".$pri_b;}}
if($this_max-$b-2==0 and $pri_c!=""){$prizenum+=1;if($status==""){$status=$pri_c;}else{$status.="^".$pri_c;}}
if($this_max-$c-3==0 and $pri_d!=""){$prizenum+=1;if($status==""){$status=$pri_d;}else{$status.="^".$pri_d;}}
if($this_max-$d-4==0 and $pri_e!=""){$prizenum+=1;if($status==""){$status=$pri_e;}else{$status.="^".$pri_e;}}


//	print_r($prizenum);

if($prizenum-1>=0){return "is_yes|".$prizenum."|".$status;}else{return "is_no|0";}
}


function Prize_z120($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$this_max=this_wanfa($list_id);
$lot_list=array_new($list_id,$Z_lotnum);
if(count($lot_list) != count($lot_list, 1)){
	$temp=$lot_list;
}
else $temp[0]=$lot_list;

foreach ($temp as $value)	{

	$lot_list=$value;

for ($i=0;$i<count($Z_buynum);$i++){if(in_array($Z_buynum[$i],$lot_list)===true){$is_right+=1;}}
if($is_right-$this_max>=0){$prizenum+=1;$statuss="is_yes";}
}

if($prizenum>0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}


function Prize_z60($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$yes_num;
$buy_list=explode(",",$Z_buynum);$lot_lists=explode(",",$Z_lotnum);
$lot_list=array_new($list_id,$lot_lists);
if($list_id=="4X_z12"){
$max_num=2;
}else{
$max_num=3;
}
$same_num=array_same_num($lot_list);
if($same_num-2==0){
for ($i=0;$i<strlen($buy_list[0]);$i++){
$this_value=substr($buy_list[0],$i,1);
$n_lot_list=array_drup($lot_list,$this_value,2);
if(count($n_lot_list)-$max_num==0){$is_right+=1;break;}
}
$this_max=this_wanfa($list_id)-2;
if($is_right-1>=0){
$is_right=0;
for ($j=0;$j<strlen($buy_list[1]);$j++){
$next_value=substr($buy_list[1],$j,1);
if(in_array($next_value,$n_lot_list)===true){$yes_num+=1;}
}
}
if($yes_num-$this_max>=0){return "is_yes|1";}else{return "is_no|0";}
}else{
return "is_no|0";
}
}

function Prize_z12($buy_id,$list_id,$Z_buynum,$Z_lotnum){

	$prizenum=0;$is_right=0;
	if(strpos($Z_lotnum, ',')!=false) $Z_lotnum=explode(',', $Z_lotnum);
if(strpos($Z_buynum, ',')!=false) $Z_buynum=explode(',', $Z_buynum);
$buy_list_a=$Z_buynum[0];
$buy_list_b=$Z_buynum[1];
$list_lot=array_new($list_id,$Z_lotnum);

$arr=arr_cha($list_lot);

	$statuss=$a=$b="";

$min=$arr[0];
$max=$arr[1];

if($min==0 and $max>0){

for($i=0;$i<strlen($buy_list_a);$i++){



if(arr_str_num($list_lot, $buy_list_a[$i])==2){

	$a="is_yes";
			break;
				}



		}

		$two=0;
		for($i=0;$i<strlen($buy_list_b);$i++){

		if(arr_str_num($list_lot, $buy_list_b[$i])==1){

			$two++;
				}

		}



}

if($a=='is_yes' and $two==2) return "is_yes|1";else return "is_no|0";


}


function Prize_5X_z30($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$list_d=$Z_buynum[0];$this_max=this_wanfa($list_id);
$n_lot_list=array_new($list_id,$Z_lotnum);
$arr=array_unique($n_lot_list);
if(count($arr)==3){
for ($i=0;$i<strlen($list_d);$i++){
if($yes_num-2>=0){break;}$this_value=substr($list_d,$i,1);
if($list_lot==""){$list_lot=$n_lot_list;$m_num=$this_max;}
$list_lot=array_drup_p($list_lot,$this_value,2);
if($m_num-count($list_lot)==2){$yes_num+=1;$m_num=$this_max-2;}
}
if($yes_num-2>=0){
for ($i=0;$i<strlen($Z_buynum[1]);$i++){
$this_value=substr($Z_buynum[1],$i,1);
if(in_array($this_value,$list_lot)===true){$is_right=1;break;}}
}
}
if($is_right-1>=0){return "is_yes|1";}else{return "is_no|0";}
}



function Prize_z20($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$list_d=$Z_buynum[0];$this_max=this_wanfa($list_id);
$n_lot_list=array_new($list_id,$Z_lotnum);



if(count(array_unique($Z_lotnum))!=3){return "is_no|0";}


for ($i=0;$i<count($n_lot_list);$i++){
if($last_num==""){$last_num=$n_lot_list[$i];$sames=1;}else{
if($last_num-$n_lot_list[$i]==0){$sames+=1;}
}
}
if($sames-$this_max==0){return "is_no|0";}
for ($i=0;$i<strlen($list_d);$i++){
$this_value=substr($list_d,$i,1);
if($list_lot==""){$list_lot=$n_lot_list;}
$list_lot=array_drup_p($list_lot,$this_value,3);
if($this_max-count($list_lot)==3){$yes_num+=1;break;}
}
if($yes_num-1>=0){
for ($i=0;$i<strlen($Z_buynum[1]);$i++){
$this_value=substr($Z_buynum[1],$i,1);
if(in_array($this_value,$list_lot)===true){$is_right+=1;}}
}
$list_id="#".$list_id;if(strpos($list_id,'5X')){$this_max=2;}if(strpos($list_id,'4X') or strpos($list_id,'4R')){$this_max=1;}
if($is_right-$this_max>=0){return "is_yes|1";}else{return "is_no|0";}
}




function Prize_5X_z10($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$n_lot_list=array_new($list_id,$Z_lotnum);
$prizenum=0;$statuss="0";$is_right=0;$list_d=$Z_buynum[0];
$arr=array_unique($n_lot_list);
if(count($arr)==2){
for ($i=0;$i<strlen($list_d);$i++){
$this_value=substr($list_d,$i,1);
if($list_lot==""){$list_lot=$n_lot_list;}
$list_lot=array_drup_p($list_lot,$this_value,3);
if(5-count($list_lot)==3){$yes_num+=1;break;}
}
if($yes_num-1>=0){
$list_d=$Z_buynum[1];
for ($i=0;$i<strlen($list_d);$i++){
$this_value=substr($list_d,$i,1);
$list_lot=array_drup_p($list_lot,$this_value,2);
if(count($list_lot)==1){if($list_lot==""){$is_right+=1;}}
}
}
}
if($is_right-1>=0){return "is_yes|1";}else{return "is_no|0";}
}



function Prize_5X_z5($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$list_d=$Z_buynum[0];
$n_lot_list=array_new($list_id,$Z_lotnum);
$arr=array_unique($n_lot_list);
if(count($arr)==2){

for ($i=0;$i<strlen($list_d);$i++){
$this_value=substr($list_d,$i,1);
if($list_lot==""){$list_lot=$Z_lotnum;}
$list_lot=array_drup_p($list_lot,$this_value,4);
if(5-count($list_lot)==4){$yes_num+=1;break;}
}
if($yes_num-1>=0){
$list_d=$Z_buynum[1];
$this_value=$list_lot[0];
if(strpos($list_d,$this_value)!==false){$is_right+=1;}
}
}
if($is_right-1>=0){return "is_yes|1";}else{return "is_no|0";}
}


function Prize_5x_lhh($buy_id,$list_id,$Z_buynum,$Z_lotnum){
    $is_right=0;
    $num1=$Z_lotnum[0];
    $num2=$Z_lotnum[4];
//	echo in_array('虎', $Z_buynum);
//	print_r($Z_buynum);
//	exit();
    $prize=0;



    if($num1>$num2){
        if(in_array('龙', $Z_buynum)){$is_right=1;$prize=0;}

    }
    if($num1<$num2){
        if(in_array('虎', $Z_buynum)){$is_right=1;$prize=1;}

    }

    if($num1==$num2){
        if(in_array('和', $Z_buynum)){$is_right=1;$prize=2;}


    }

    if($is_right-1>=0){return "is_yes|1|".$prize;}else{return "is_no|0";}
}


function Prize_SSC_LH($buy_id,$list_id,$Z_buynum,$Z_lotnum){
    $is_right=0;

    $arr=explode('_',$list_id);
    $num1=$Z_lotnum[substr($arr[1],0,1)];
    $num2=$Z_lotnum[substr($arr[1],1,1)];

    $prize=0;



    if($num1>$num2){
        if(in_array('龙', $Z_buynum)){$is_right=1;$prize=0;}

    }
    if($num1<$num2){
        if(in_array('虎', $Z_buynum)){$is_right=1;$prize=1;}

    }

    if($num1==$num2){
        if(in_array('和', $Z_buynum)){$is_right=1;$prize=2;}


    }

    if($is_right-1>=0){return "is_yes|1|".$prize;}else{return "is_no|0";}
}


function Prize_5x_DSDS($buy_id,$list_id,$Z_buynum,$Z_lotnum){
	$is_right=0;

$sum=arr_sum($Z_lotnum);

if($sum>22){
			if(in_array('大', $Z_buynum))$is_right++;

}
else{
	if(in_array('小', $Z_buynum))$is_right++;

}


if($sum%2==0){
			if(in_array('双', $Z_buynum))$is_right++;

}
else{
	if(in_array('单', $Z_buynum))$is_right++;

}


if($is_right-1>=0){return "is_yes|".$is_right;}else{return "is_no|0";}
}



function Prize_4X_z6($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$this_max=this_wanfa($list_id);
$n_lot_list=array_new($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];$list_lot=$n_lot_list;$m_num=$this_max;
$list_lot=array_drup_p($list_lot,$this_value,2);
if($m_num-count($list_lot)>=2){$yes_num+=1;$m_num=2;}
if($yes_num-2>=0){break;}
}
if($yes_num-2>=0){return "is_yes|1";}else{return "is_no|0";}
}



function Prize_zhxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;

$lot_list=array_new($list_id,$Z_lotnum);
if(count($lot_list) != count($lot_list, 1)){
	$temp=$lot_list;
}
else $temp[0]=$lot_list;

foreach ($temp as $value)	{

	$lot_list=$value;
$sum=arr_sum($lot_list);

for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if($this_value==$sum){$prizenum++;}
}

}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}



function Prize_kd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
	$list_lot=array_new($list_id,$Z_lotnum);
	$cha=arr_cha($list_lot);
$prizenum=0;
$lot_max=$cha[1];
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if($lot_max==$this_value){$prizenum+=1;break;}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}


function Prize_z3($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$is_num=0;
$this_codes="";$t_code=play_code($list_id);

$list_lot=array_new($list_id,$Z_lotnum);

if(count($list_lot) != count($list_lot, 1)){
	$temp=$list_lot;
}
else $temp[0]=$list_lot;

foreach ($temp as $value)	{

	$list_lot=$value;
	$z3=0;
//	print_r($list_lot);
$lot_a=$list_lot[0];$lot_b=$list_lot[1];$lot_c=$list_lot[2];
if($lot_a-$lot_b==0){$z3++;$this_value=$lot_c;$have_value=$lot_a;}
if($lot_b-$lot_c==0){$z3++;$this_value=$lot_a;$have_value=$lot_b;}
if($lot_a-$lot_c==0){$z3++;$this_value=$lot_b;$have_value=$lot_c;}

if($z3==1 and ($t_code=="z3"or $t_code=="hhzx")){


if($t_code=="hhzx"){
$list_buy=array_drup_p($Z_buynum,$have_value,2);
}else{
$list_buy=array_drup_p($Z_buynum,$have_value,1);
}

if(count($Z_buynum)-count($list_buy)>0){
if(in_array($this_value,$list_buy)===true){$yes_num+=1;$prizenum=1;$this_codes="z3";}
}
}


if($z3==0 and ($t_code=="z6"or $t_code=="hhzx")){
	$is_num=0;
for ($i=0;$i<count($list_lot);$i++){
$this_value=$list_lot[$i];
if(in_array($this_value,$Z_buynum)===true){$is_num+=1;}
}
if($is_num-3>=0){$yes_num+=1;$prizenum=1;$this_codes="z6";}
}




}

if($yes_num>0){

return "is_yes|$yes_num|".$this_codes;
}else{
return "is_no|0";
}
}


function Prize_zx_infor1($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$is_right1='0';$yes_num=0;$is_num=0;
$list_lot=$Z_lotnum;




for ($j=0;$j<count($Z_buynum);$j++){
$this_value=$Z_buynum[$j];
if(arr_str_num($Z_buynum, $this_value)==arr_str_num($list_lot, $this_value)){
$yes_num+=1;
}
}


if($yes_num==3){

return "is_yes";
}
else{
return "is_no";
}

}


function Prize_zx_infor($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$is_right1='0';$yes_num=0;$is_num=0;
$list_lot=array_new($list_id,$Z_lotnum);




for ($j=0;$j<count($Z_buynum);$j++){
$this_value=$Z_buynum[$j];
if(arr_str_num($Z_buynum, $this_value)==arr_str_num($list_lot, $this_value)){
$yes_num+=1;
}
}


if($yes_num==3){

return "is_yes";
}
else{
return "is_no";
}

}



function Prize_hhzx($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$buynum_all="#".$Z_buynum;
if(strpos($buynum_all,',')){$buy_list=explode(",",$Z_buynum);}
elseif(strpos($buynum_all,'|')){$buy_list=explode("|",$Z_buynum);}
else{$buy_list=explode(" ",$Z_buynum);}
$list_lot1=array_new($list_id,$Z_lotnum);
$is_right=0;$re_lot_infor="";

if(count($list_lot1) != count($list_lot1, 1)){
	$temp=$list_lot1;

}
else $temp[0]=$list_lot1;$prize_num=0;

foreach ($temp as $value)	{
	$list_lot1=$value;

$arr=arr_cha($list_lot1);
$min=$arr[0];
$max=$arr[1];

if($max>0){
for ($i=0;$i<count($buy_list);$i++){
	$re_value="";
$new_buynum=Lot_01_Num($buy_list[$i]);

for ($j=0;$j<strlen($new_buynum);$j++){
$n_buy_list[$j]=substr($new_buynum,$j,1);
}
if(count($temp)>1)
$re_value=Prize_zx_infor1($buy_id,$list_id,$n_buy_list,$list_lot1);
else
$re_value=Prize_zx_infor($buy_id,$list_id,$n_buy_list,$Z_lotnum);
if($re_value=="is_yes"){

$prize_num++;
if(count($temp)>1 and $min==0){

	$prize_num++;;
}
}
}

}
}

if($prize_num>0){
	if($min==0) $pri='z3';else $pri='z6';
	if(count($temp)>1) $pri='z6';
	return "is_yes|{$prize_num}|{$pri}";


}

else return  "is_no|0";


}



function Prize_zxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
if(strpos($Z_buynum,',')){$buy_list=explode(",",$Z_buynum);}else{$buy_list[0]=$Z_buynum;}
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$lot_count=array_count($list_id,$Z_lotnum);
$list_lot=array_new($list_id,$Z_lotnum);
if(count($list_lot) != count($list_lot, 1)){
	$temp=$list_lot;
}
else $temp[0]=$list_lot;


foreach ($temp as $value)	{
	$list_lot=$value;

$lot_a=$list_lot[0];$lot_b=$list_lot[1];$lot_c=$list_lot[2];
if($lot_a-$lot_b==0){$is_right+=1;}
if($lot_b-$lot_c==0){$is_right+=1;}
if($lot_a-$lot_c==0){$is_right+=1;}
for ($i=0;$i<count($buy_list);$i++){
$this_value=$buy_list[$i];if($this_value-$lot_count==0){$prizenum+=1;break;}
}

}

if($prizenum-1>=0){
if($is_right==0){
return "is_yes|{$prizenum}|z6";
}else if($is_right==1){
return "is_yes|{$prizenum}|z3";
}else{
return "is_no|0";
}
}else{return "is_no|0";}
}


function  Prize_z3hz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
	$is_yes=0;
 $Z_lotnum=explode(',', $Z_lotnum);
if(strpos($Z_buynum,',')){$buy_list=explode(",",$Z_buynum);}else{$buy_list[0]=$Z_buynum;}
	$list_lot=array_new($list_id,$Z_lotnum);
if(count($list_lot) != count($list_lot, 1)){
	$temp=$list_lot;
}
else $temp[0]=$list_lot;


foreach ($temp as $value)	{
	$list_lot=$value;

$arr=arr_cha($list_lot);

$min=$arr[0];
$max=$arr[1];
if($min==0 and $max>0){
	$sum=arr_sum($list_lot);

  	if(in_array($sum, $buy_list) or $sum==$buy_list[0])  $is_yes++;

}


}
if($is_yes>0){
	return "is_yes|".$is_yes;

}
else return "is_no|0";


}

function Prize_z6hz($buy_id,$list_id,$Z_buynum,$Z_lotnum){
		$is_yes=0;
 $Z_lotnum=explode(',', $Z_lotnum);
if(strpos($Z_buynum,',')){$buy_list=explode(",",$Z_buynum);}else{$buy_list[0]=$Z_buynum;}
	$list_lot=array_new($list_id,$Z_lotnum);
if(count($list_lot) != count($list_lot, 1)){
	$temp=$list_lot;
}
else $temp[0]=$list_lot;


foreach ($temp as $value)	{
	$list_lot=$value;

		$sum=arr_sum($list_lot);

$arr=arr_cha($list_lot);

$min=$arr[0];
$max=$arr[1];

if($min>0){


  	if(in_array($sum, $buy_list) or $sum==$buy_list[0]) $is_yes++;

}


	}
	if($is_yes>0){
	return "is_yes|".$is_yes;

}
else return "is_no|0";

}



function Prize_3x_bd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$yes_num=0;$this_value=$Z_buynum;$re_code="";
$list_lot=array_new($list_id,$Z_lotnum);
if(in_array($this_value,$list_lot)===true){$yes_num+=1;$prizenum=1;}
if($yes_num-1>=0){
$lot_a=$list_lot[0];$lot_b=$list_lot[1];$lot_c=$list_lot[2];
if($lot_a-$lot_b==0){$is_right+=1;$this_value=$lot_c;$have_value=$lot_a;}
if($lot_b-$lot_c==0){$is_right+=1;$this_value=$lot_a;$have_value=$lot_b;}
if($lot_a-$lot_c==0){$is_right+=1;$this_value=$lot_b;$have_value=$lot_c;}
if($is_right==1){$re_code="z3";}if($is_right==0){$re_code="z6";}
}
if($re_code!=""){return "is_yes|1|".$re_code;}else{return "is_no|0";}
}
function Prize_3x_hzws($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$lot_count=array_count($list_id,$Z_lotnum);
$bengin_num=strlen($lot_count)-1;
$wei_count=substr($lot_count,$bengin_num,1);
for ($i=0;$i<count($Z_buynum);$i++){
if($Z_buynum[$i]-$wei_count==0){
$prizenum+=1;$is_right+=1;break;
}
}
if($is_right-1>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_3x_tshm($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$buynum_all="#".$Z_buynum;
if(strpos($buynum_all,',')){$buy_list=explode(",",$Z_buynum);}
elseif(strpos($buynum_all,'|')){$buy_list=explode("|",$Z_buynum);}else{$buy_list=explode(",",$Z_buynum);}
$list_lot=array_new($list_id,$Z_lotnum);
$lot_value=lot_type($list_lot);
if(in_array($lot_value,$buy_list)===true){$is_right+=1;$pri_key=lot_type_key($lot_value);}
if($is_right-1>=0){return "is_yes|1|".$pri_key;}else{return "is_no|0";}
}
function Prize_2X_zxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$list_lot=array_new($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if(in_array($this_value,$list_lot)===true){$is_right+=1;}
}
if($is_right-2>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_2X_zxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$list_lot=array_new($list_id,$Z_lotnum);$this_max=this_wanfa($list_id);
$buynum_all="#".$Z_buynum;
if(strpos($buynum_all,',')){$buy_list=explode(",",$Z_buynum);}
elseif(strpos($buynum_all,'|')){$buy_list=explode("|",$Z_buynum);}else{$buy_list=explode(",",$Z_buynum);}
for ($i=0;$i<count($buy_list);$i++){
$this_buy=$buy_list[$i];$yes_num=0;
$new_lot=$list_lot;
for ($j=0;$j<strlen($this_buy);$j++){
$this_value=substr($this_buy,$j,1);
if(in_array($this_value,$new_lot)===true){
$yes_num+=1;
$new_lot=array_drup_p($new_lot,$this_value,1);
if($yes_num-2>=0){$is_right+=1;}
}
}
}
if($is_right-1>=0){return "is_yes|".$is_right;}else{return "is_no|0";}
}


//二星组选和值
function Prize_2X_zxhz($buy_id,$list_id,$Z_buynum,$Z_lotnum){

$prizenum=0;

$lot_list=array_new($list_id,$Z_lotnum);
if(getmaxdim($lot_list)==2){
   foreach ($lot_list as $value)
   {
       $cha=arr_cha($value);


       if($cha[0]>0){
           $sum=arr_sum($value);
           for ($i=0;$i<count($Z_buynum);$i++){
               $this_value=$Z_buynum[$i];
               if($this_value==$sum){$prizenum++;}
           }

       }

   }


}
else {
    $cha=arr_cha($lot_list);


    if($cha[0]>0){
        $sum=arr_sum($lot_list);
        for ($i=0;$i<count($Z_buynum);$i++){
            $this_value=$Z_buynum[$i];
            if($this_value==$sum){$prizenum++;}
        }

    }

}

if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}

}



function Prize_2X_zxbd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$list_lot=array_new($list_id,$Z_lotnum);$lot_a=$list_lot[0];$lot_b=$list_lot[1];
if($lot_a-$lot_b!=0){
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum;
if(in_array($this_value,$list_lot)===true){$is_right+=1;break;}
}
}
if($is_right-1>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_1X_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;
$buynum_all="#".$Z_buynum;
if(strpos($buynum_all,',')){$buy_list=explode(",",$Z_buynum);}
elseif(strpos($buynum_all,'|')){$buy_list=explode("|",$Z_buynum);}else{$buy_list=explode(",",$Z_buynum);}
for ($i=0;$i<count($buy_list);$i++){
$this_value="#".$buy_list[$i];
if(strpos($this_value,$Z_lotnum[$i])){$is_right+=1;$prizenum+=1;}
}
if($is_right-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_BDW($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$statuss="0";$is_right=0;$f_n=0;
$list_lot=array_new_other($list_id,$Z_lotnum);
if(strpos($list_id,'ym')){$this_max=1;}if(strpos($list_id,'em')){$this_max=2;}if(strpos($list_id,'sm')){$this_max=3;}
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if(in_array($this_value,$list_lot)===true){
$is_right+=1;
}
}


if($is_right-$this_max>=0){
$prizenum=C_list($is_right,$this_max);
return "is_yes|".$prizenum;
}else{
return "is_no|0";
}
}
function Prize_DXDS($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$buynum_all="#".$Z_buynum;
if(count($Z_buynum)-2<0){$buy_list=explode(",",$Z_buynum);}else{$buy_list=$Z_buynum;}
$is_right=0;$prizenum=0;$is_next="";
if(strpos($list_id,'ed')){$this_max=2;}if(strpos($list_id,'sd')){$this_max=3;}
$lot_list=array_new_other($list_id,$Z_lotnum);
$lot_array=array_dxds($lot_list);
if($lot_array=="no"){
return "is_no|0";
}else{
for ($i=0;$i<count($lot_array);$i++){
$this_list_lot=explode("|",$lot_array[$i]);
$buy_list_s="#".$buy_list[$i];$yes_num=0;
for ($j=0;$j<count($this_list_lot);$j++){
if(strpos($buy_list_s,$this_list_lot[$j])){$yes_num+=1;}
}
if($yes_num-1>=0){
if($is_next==""){$is_next="yes";}
if($prizenum-1<0){$prizenum=$yes_num;}else{$prizenum=$prizenum*$yes_num;}
}else{$is_next="no";break;}
}
if($is_next=="yes"){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
}

function Prize_DXDS3($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$buynum_all="#".$Z_buynum;


if(count($Z_buynum)-2<0){$buy_list=explode(",",$Z_buynum);}else{$buy_list=$Z_buynum;}
$is_right=0;$prizenum=0;$is_next="";
if(strpos($list_id,'ed')){$this_max=2;}if(strpos($list_id,'sd')){$this_max=3;}
$lot_list=array_new_other_3d($list_id,$Z_lotnum);
$lot_array=array_dxds($lot_list);
if($lot_array=="no"){
return "is_no|0";
}else{
for ($i=0;$i<count($lot_array);$i++){
$this_list_lot=explode("|",$lot_array[$i]);
$buy_list_s="#".$buy_list[$i];$yes_num=0;
for ($j=0;$j<count($this_list_lot);$j++){
if(strpos($buy_list_s,$this_list_lot[$j])){$yes_num+=1;}
}
if($yes_num-1>=0){
if($is_next==""){$is_next="yes";}
if($prizenum-1<0){$prizenum=$yes_num;}else{$prizenum=$prizenum*$yes_num;}
}else{$is_next="no";break;}
}
if($is_next=="yes"){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
}

function Prize_QW_qwsx($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$lot_list=array_new_other($list_id,$Z_lotnum);$buy_list=explode(",",$Z_buynum);
if($list_id=="QW_smqwsx"){$max_num=1;$begin_num=1;}else{$max_num=2;$begin_num=2;}
for($i=$begin_num;$i<count($lot_list);$i++){
$lot_value=$lot_list[$i];$buy_value="#".$buy_list[$i];
if(strpos($buy_value,$lot_list[$i])){$yes_num+=1;}
}
if($yes_num-3>=0){
$buy_value="#".$buy_list[$i];$lot_value=$lot_list[$i];
for ($j=0;$j<$max_num;$j++){
$lot_a=$lot_list[$j];$buy_a="#".$buy_list[$j];
if($lot_a-5>=0){$lot_z_a="大";}else{$lot_z_a="小";}
if(strpos($buy_a,$lot_z_a)){$is_right+=1;}
}
if($is_right-$max_num==0){return "is_yes|1|1d";}else{return "is_yes|1|2d";}
}else{
return "is_no|0";
}
}
function Prize_QW_qwex($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$lot_list=array_new_other($list_id,$Z_lotnum);$buy_list=explode(",",$Z_buynum);
$max_num=1;$begin_num=1;
for($i=$begin_num;$i<count($lot_list);$i++){
$lot_value=$lot_list[$i];$buy_value="#".$buy_list[$i];
if(strpos($buy_value,$lot_list[$i])){$yes_num+=1;}
}
if($yes_num-2>=0){
$buy_value="#".$buy_list[$i];$lot_value=$lot_list[$i];
for ($j=0;$j<$max_num;$j++){
$lot_a=$lot_list[$j];$buy_a="#".$buy_list[$j];
if($lot_a-5>=0){$lot_z_a="大";}else{$lot_z_a="小";}
if(strpos($buy_a,$lot_z_a)){$is_right+=1;}
}
if($is_right-$max_num==0){return "is_yes|1|1d";}else{return "is_yes|1|2d";}
}else{
return "is_no|0";
}
}
function Prize_QW_qjsx($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$lot_list=array_new_other($list_id,$Z_lotnum);$buy_list=explode(",",$Z_buynum);
if($list_id=="QW_smqjsx"){$max_num=1;$begin_num=1;}else{$max_num=2;$begin_num=2;}
for($i=$begin_num;$i<count($lot_list);$i++){
$lot_value=$lot_list[$i];$buy_value="#".$buy_list[$i];
if(strpos($buy_value,$lot_list[$i])){$yes_num+=1;}
}
if($yes_num-3>=0){
for ($j=0;$j<$max_num;$j++){
$lot_a=str_type_qj($lot_list[$j]);$buy_a="#".$buy_list[$j];
if(strpos($buy_a,$lot_a)){$is_right+=1;}
}
if($is_right-$max_num==0){return "is_yes|1|1d";}else{return "is_yes|1|2d";}
}else{
return "is_no|0";
}
}
function Prize_QW_qjex($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$lot_list=array_new_other($list_id,$Z_lotnum);$buy_list=explode(",",$Z_buynum);
$max_num=1;$begin_num=1;
for($i=$begin_num;$i<count($lot_list);$i++){
$lot_value=$lot_list[$i];$buy_value="#".$buy_list[$i];
if(strpos($buy_value,$lot_list[$i])){$yes_num+=1;}
}
if($yes_num-2>=0){
for ($j=0;$j<$max_num;$j++){
$lot_a=str_type_qj($lot_list[$j]);$buy_a="#".$buy_list[$j];
if(strpos($buy_a,$lot_a)){$is_right+=1;}
}
if($is_right-$max_num==0){return "is_yes|1|1d";}else{return "is_yes|1|2d";}
}else{
return "is_no|0";
}
}
function Prize_QW_yffs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$yes_num=0;$is_right=0;$n_list_lot=$Z_lotnum;
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
if(in_array($this_value,$Z_lotnum)===true){
$prizenum+=1;
$n_list_lot=array_drup_p($n_list_lot,$this_value,1);
}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_hscs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
if($list_id=="QW_hscs"){$max_num=2;}
if($list_id=="QW_sxbx"){$max_num=3;}
if($list_id=="QW_sjfc"){$max_num=4;}
$prizenum=0;$yes_num=0;$is_right=0;
for ($i=0;$i<count($Z_buynum);$i++){
$this_value=$Z_buynum[$i];
$lot_list=array_drup_all($Z_lotnum,$this_value);
if(5-count($lot_list)-$max_num*2>=0){$prizenum+=1;}
if(5-count($lot_list)-$max_num>=0){$prizenum+=1;}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_zhxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum){


$new_lotnum=array_new($list_id,$Z_lotnum);
$prizenum=0;$yes_num=0;$is_right=0;$this_max=this_wanfa($list_id);
for ($i=0;$i<count($Z_buynum);$i++){
$buy_list=explode(" ",$Z_buynum[$i]);
for ($j=0;$j<count($buy_list);$j++){
if($new_lotnum[$i]==$buy_list[$j]){$is_right+=1;break;}
}
}

if($is_right-$this_max>=0){return "is_yes|1";}else{return "is_no|0";}
}
function Prize_pk_fs($buy_id,$list_id,$Z_buynum,$Z_lotnum){



$prizenum=0;$yes_num=0;$is_right=0;$this_max=this_wanfa($list_id);

if($this_max<1) $this_max=1;
if($this_max>1){
for ($i=0;$i<count($Z_buynum);$i++){
$buy_list=explode(" ",$Z_buynum[$i]);
for ($j=0;$j<count($buy_list);$j++){
if($Z_lotnum[$i]==$buy_list[$j]){$is_right+=1;break;}
}
}
}

else{
	for ($i=0;$i<count($Z_buynum);$i++){

	if($Z_buynum[$i]==$Z_lotnum[0])	{$is_right+=1;break;}

	}


}
if($is_right-$this_max>=0){return "is_yes|1";}else{return "is_no|0";}
}


function Prize_pk_ds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$yes_num=0;$is_right=0;$this_max=this_wanfa($list_id);

if($this_max<1) $this_max=1;
$lot='';

for($i=0;$i<$this_max;$i++){
	if(strlen($Z_lotnum[$i])<2) $str='0'.$Z_lotnum[$i];
	else $str=$Z_lotnum[$i];
	if($lot=='') $lot=$Z_lotnum[$i];
	else $lot.=" ".$Z_lotnum[$i];
}

foreach ($Z_buynum as $value) {
	if($value==$lot) $is_right++;

}

if($is_right>0){return "is_yes|".$is_right;}else{return "is_no|0";}
}

function Prize_pk_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$yes_num=0;$is_right=0;
for ($i=0;$i<count($Z_buynum);$i++){
$buy_list=explode(" ",$Z_buynum[$i]);

for ($j=0;$j<count($buy_list);$j++){

if($Z_lotnum[$i]==$buy_list[$j]){$is_right+=1;break;}
}
}


if($is_right>0){return "is_yes|".$is_right;}else{return "is_no|0";}
}


function Prize_pk_dxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
    $prizenum=0;$yes_num=0;$is_right=0;
    $arr=explode('_',$list_id);
    $num=$arr[1];
    $lot=$Z_lotnum[$num];
    if(in_array('大', $Z_buynum) and $lot>5 ){$is_right=1;}
    if(in_array('小', $Z_buynum) and $lot<=5 ){$is_right=1;}
    if(in_array('单', $Z_buynum) and $lot%2==1 ){$is_right=1;}
    if(in_array('双', $Z_buynum) and $lot%2==0 ){$is_right=1;}
    if($is_right>0){return "is_yes|".$is_right;}else{return "is_no|0";}
}


function Prize_11X5_zxfs($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$buy_list=explode(",",$Z_buynum);
$prizenum=0;$statuss="0";$is_right=0;$yes_num=0;$is_num=0;
$list_lot=array_new($list_id,$Z_lotnum);$this_max=this_wanfa($list_id);
for ($i=0;$i<count($list_lot);$i++){
$this_lot=$list_lot[$i];
if(in_array($this_lot,$buy_list)===true){$is_right+=1;}
}
if($is_right-$this_max>=0){return "is_yes|1";}else{return "is_no|0";}
}

function Prize_11X5_bdw($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$list_lot=array_new_other($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){if(in_array($Z_buynum[$i],$list_lot)===true){$prizenum+=1;}}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_dwd($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$list_lot=array_new_other($list_id,$Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){if($Z_buynum[$i]!="--"){$this_value="#".$Z_buynum[$i];if(strpos($this_value,$list_lot[$i])){$prizenum+=1;}}}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_dds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$lot_value=array_dds($Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){if($Z_buynum[$i]==$lot_value){$prizenum+=1;}}
if($prizenum-1>=0){return "is_yes|".$prizenum."|".array_dds_lot($Z_lotnum);}else{return "is_no|0";}
}
function Prize_11X5_czw($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$list_lot=array_sort($Z_lotnum);
for ($i=0;$i<count($Z_buynum);$i++){if($Z_buynum[$i]-$list_lot[2]==0){$prizenum+=1;}}
if($prizenum-1>=0){return "is_yes|".$prizenum."|".(int)$list_lot[2];}else{return "is_no|0";}
}
function Prize_11X5_fsrx($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$buy_list=explode(",",Trim($Z_buynum));$this_max=substr($list_id,strlen($list_id)-1,1);$lot_list=$Z_lotnum;
$this_list_max=substr($list_id,strlen($list_id)-3,1);
for ($i=0;$i<count($lot_list);$i++){if(in_array($lot_list[$i],$buy_list)===true){$is_right+=1;}}
if($is_right-$this_max>=0){
$c_num=count($buy_list)-$this_max;$l_num=$this_list_max-$this_max;
if($this_max-5==0){
$prizenum=C_list($c_num,$l_num);
}else{
$prizenum=C_list($is_right,$this_max);
}
return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_zhxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$list_lot=array_new($list_id,$Z_lotnum);$this_max=this_wanfa($list_id);
for ($i=0;$i<count($Z_buynum);$i++){$buy_list=explode(" ",$Z_buynum[$i]);$is_right=0;
if(count($buy_list)-$this_max==0){for ($j=0;$j<count($buy_list);$j++){if($buy_list[$j]==$list_lot[$j]){$is_right+=1;}}}
if($is_right-$this_max==0){$prizenum+=1;}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_zxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$list_lot=array_new($list_id,$Z_lotnum);$this_max=this_wanfa($list_id);
for ($i=0;$i<count($Z_buynum);$i++){
$buy_list=explode(" ",$Z_buynum[$i]);$is_right=0;$new_lot_list=$list_lot;
if(count($buy_list)-$this_max==0){
for ($j=0;$j<count($buy_list);$j++){if(in_array($buy_list[$j],$new_lot_list)===true){$is_right+=1;$new_lot_list=array_drup($new_lot_list,$buy_list[$j],1);}}
if($is_right-$this_max==0){$prizenum+=1;}
}
}
if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}
function Prize_11X5_rxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){


$prizenum=0;$is_right=0;
$t_type=play_type($list_id);
$t_code=play_code($list_id);
$this_max=substr($t_code,strlen($t_code)-1,strlen($t_code));

for ($i=0;$i<count($Z_buynum);$i++){
$buy_list=explode(" ",$Z_buynum[$i]);

$is_right=0;$new_lot_list=$Z_lotnum;
	if(count($buy_list)>=$this_max){


for ($j=0;$j<count($buy_list);$j++){
if($new_lot_list){
if(in_array(Trim($buy_list[$j]),$new_lot_list)===true){
	$is_right+=1;
$new_lot_list=array_drup($new_lot_list,$buy_list[$j],1);
}
}
}

if($is_right-$this_max>=0){$prizenum+=1;}
}
}


if($prizenum-1>=0){return "is_yes|".$prizenum;}else{return "is_no|0";}
}

function Prize_KL8_pm($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;
$t_code=play_code($list_id);
$lot_value=kl8_lot_code($Z_lotnum,$t_code);
for ($i=0;$i<count($Z_buynum);$i++){if(Trim($Z_buynum[$i])==$lot_value){$is_right+=1;break;}}
$num=0;
if($lot_value=='中' || $lot_value=='和') $num=1;
    if($lot_value=='下' || $lot_value=='偶') $num=1;
if($is_right-1>=0){return "is_yes|1|{$num}";}else{return "is_no|0";}
}




function Prize_KL8_rx($buy_id,$list_id,$Z_buynum,$Z_lotnum){

if(strpos($Z_lotnum,"#")){$lot_lists=explode("#",$Z_lotnum);$lot_list=explode(",",$lot_lists[0]);}else{$lot_list=explode(",",$Z_lotnum);}
$lot_list=k18_num($lot_list);
$prizenum=0;$is_right=0;
$this_max=substr($list_id,strlen($list_id)-1,1);
if($this_max=='0') $this_max=10;

$is_yes="no";

$Z_buynum=explode(",", $Z_buynum);


$next_max=$this_max-3;
if($next_max-2<0){$next_max=2;}
$pri[1]=array('1');
$pri[2]=array('2');
$pri[3]=array('3','2');
$pri[4]=array('4','3','2');
$pri[5]=array('5','4','3');
$pri[6]=array('6','5','4','3');
$pri[7]=array('7','6','5','4','0');
$list_num='';
foreach ($Z_buynum as $value){

	if($value>0) {
		if(!$list_num)
		$list_num=$value;
	else $list_num.=','.$value;
	}


}


$list1=arr1_plzh($list_num, $this_max);

$arr_mum=array();

foreach ($list1 as $value) {

$index_num=arr_arr_num($value, $lot_list);
if($arr_mum[$index_num]>0)$arr_mum[$index_num]++;
else $arr_mum[$index_num]=1;
}
//print_r($arr_mum);


/////

$prize_str='';
$pri_num=0;

foreach ($pri[$this_max] as $key=>$value) {

	if($arr_mum[$value]>0){
		if($prize_str=='')$prize_str="rx_{$key}_{$arr_mum[$value]}";
	else $prize_str.=",rx_{$key}_{$arr_mum[$value]}";
	$pri_num=$pri_num+$arr_mum[$value];
	}

}


if($pri_num>0){

	return "is_yes|{$pri_num}|".$prize_str;

}
else return "is_no|0";





//$ttt=0;
//for ($i=0;$i<count($Z_buynum);$i++){
//	if(trim($Z_buynum[$i])>0){
//	if(in_array(trim($Z_buynum[$i]),$lot_list)===true)
//	{$is_right+=1;}
//
//	$ttt++;
//	}
//
//}
//if($is_right-$this_max>=0){
//$prizenum=C_list($is_right,$this_max);return "is_yes|".$prizenum;$is_yes="yes";
//}
//else{
//if(in_array($is_right, $pri[$this_max])){
//	$pos=array_keys($pri[$this_max],$is_right);
//
//
//	$pei_lot="rx_".$pos[0];
//
//	$pri_num=$ttt-$is_right;
//	return "is_yes|{$pri_num}|".$pei_lot;
//	$is_yes="yes";
//
//}
//}
//if($is_yes=="no"){return "is_no|0";}
}




function Prize_KL8_5x($buy_id,$list_id,$Z_buynum,$Z_lotnum){


$lot_list=explode(",",$Z_lotnum);
$sum=arr_sum($lot_list)-$lot_list[count($lot_list)-1];
if(strpos($Z_buynum,'金')!==false and $sum>=215 and $sum<=695) return "is_yes|1";
if(strpos($Z_buynum,'木')!==false and $sum>=696 and $sum<=763) return "is_yes|1";
if(strpos($Z_buynum,'水')!==false and $sum>=764 and $sum<=855) return "is_yes|1";
if(strpos($Z_buynum,'火')!==false and $sum>=856 and $sum<=923) return "is_yes|1";
if(strpos($Z_buynum,'土')!==false and $sum>=924) return "is_yes|1";
}

function Prize_KL8_hzdxds($buy_id,$list_id,$Z_buynum,$Z_lotnum){

	$lot_list=explode(",",$Z_lotnum);
$sum=arr_sum($lot_list)-$lot_list[count($lot_list)-1];
$num=0;
if( strpos($Z_buynum,'大.单')!==false and $sum>810 and $sum%2==1){$num++;}
if( strpos($Z_buynum,'大.双')!==false   and $sum>810 and $sum%2==0){$num++;}
if( strpos($Z_buynum,'小.单')!==false and $sum<=810 and $sum%2==1){$num++;}
if( strpos($Z_buynum,'小.双')!==false and $sum<=810 and $sum%2==0){$num++;}
    if($num>0){
        return "is_yes|{$num}";
    }else{
        return "is_no|0";
    }
}

function Prize_KL8_hzdxds1($buy_id,$list_id,$Z_buynum,$Z_lotnum){

    $lot_list=explode(",",$Z_lotnum);
    $sum=arr_sum($lot_list)-$lot_list[count($lot_list)-1];
    $num=0;
    if( strpos($Z_buynum,'大')!==false and $sum>810){$num++;}
    if( strpos($Z_buynum,'小')!==false   and $sum<=810 ){$num++;}
    if( strpos($Z_buynum,'单')!==false  and $sum%2==1){$num++;}
    if( strpos($Z_buynum,'双')!==false and $sum%2==0){$num++;}
    if($num>0){
        return "is_yes|{$num}";
    }else{
        return "is_no|0";
    }
}
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
if($lot_a-$lot_c==0 and $lot_b-$lot_c==0){return "is_no|0";}
if($is_right==1 and ($t_code=="z3"or $t_code=="hhzx"or $t_code=="z3ds")){
if($t_code=="hhzx"or $t_code=="z3ds"){
$list_buy=array_drup_p($Z_buynum,$have_value,2);
}else{
$list_buy=array_drup_p($Z_buynum,$have_value,1);
}
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
function array_dds_lot($Z_lotnum){
$dan_num=0;$suan_num=0;
for ($i=0;$i<count($Z_lotnum);$i++){
if($Z_lotnum[$i]%2==0){$suan_num+=1;}else{$dan_num+=1;}
}
$re_value=$dan_num."d".$suan_num."s";
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
function array_sort($str) {
for ($i=0;$i<count($str);$i++) {
for($j=$i+1;$j<count($str);$j++) {
if($str[$i]>$str[$j]) {
$tmp = $str[$i];
$str[$i]=$str[$j];
$str[$j]=$tmp;
}
}
}
return $str;
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
$lot_arr=Array($lot_a,$lot_b,$lot_c);
$n_lot_arr=array_order($lot_arr);
if($n_lot_arr[1]-$n_lot_arr[0]==1 and $n_lot_arr[2]-$n_lot_arr[1]==1){$re_value="顺子";}
return $re_value;
}
function lot_type_key($str){
if($str=="豹子"){$re_value="0";}
if($str=="顺子"){$re_value="1";}
if($str=="对子"){$re_value="2";}
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
if($list_id=="BDW_hsym"or $list_id=="BDW_hsem" or $list_id=="BDW11_hsym" or $list_id=="BDW11_hsem"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="BDW_qsym"or $list_id=="BDW_qsem" or $list_id=="BDW11_qsym" or $list_id=="BDW11_qsem") {$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="BDW_zsym"or $list_id=="BDW_zsem" or $list_id=="BDW11_zsym" or $list_id=="BDW11_zsem"){$n_array=$lot_b."|".$lot_c."|".$lot_d;}
if($list_id=="BDW_sxym"or $list_id=="BDW_sxem" or $list_id=="BDW11_sxym" or $list_id=="BDW11_sxem"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
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
if($list_id=="BDW3_hsym"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="DXDS3_hedx"){$n_array=$lot_b."|".$lot_c;}
$new_list=explode("|",$n_array);
if($list_id=="BDW_wxem"or $list_id=="BDW_wxsm"){$new_list=$Z_lotnum;}
return $new_list;
}

function array_new_other_3d($list_id,$Z_lotnum){
$lot_a=$Z_lotnum[0];$lot_b=$Z_lotnum[1];$lot_c=$Z_lotnum[2];$lot_d=$Z_lotnum[1];$lot_e=$Z_lotnum[2];
if($list_id=="BDW_hsym"or $list_id=="BDW_hsem" or $list_id=="BDW11_hsym" or $list_id=="BDW11_hsem"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="BDW_qsym"or $list_id=="BDW_qsem" or $list_id=="BDW11_qsym" or $list_id=="BDW11_qsem") {$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($list_id=="BDW_zsym"or $list_id=="BDW_zsem" or $list_id=="BDW11_zsym" or $list_id=="BDW11_zsem"){$n_array=$lot_b."|".$lot_c."|".$lot_d;}
if($list_id=="BDW_sxym"or $list_id=="BDW_sxem" or $list_id=="BDW11_sxym" or $list_id=="BDW11_sxem"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="DXDS_hedx"){$n_array=$lot_d."|".$lot_e;}

if($list_id=="DXDS_qedx" || $list_id=="DXDS3_qedx"){$n_array=$lot_a."|".$lot_b;}
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
if($list_id=="BDW3_hsym"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($list_id=="DXDS3_hedx"){$n_array=$lot_b."|".$lot_c;}
$new_list=explode("|",$n_array);
if($list_id=="BDW_wxem"or $list_id=="BDW_wxsm"){$new_list=$Z_lotnum;}
return $new_list;
}

function array_new($list_id,$Z_lotnum){

	global $wei_values;
if(count($Z_lotnum)==3){
$lot_a=$Z_lotnum[0];
$lot_b=$Z_lotnum[1];
$lot_c=$Z_lotnum[2];
$lot_d=$Z_lotnum[1];
$lot_e=$Z_lotnum[2];
}
else{
$lot_a=$Z_lotnum[0];
$lot_b=$Z_lotnum[1];
$lot_c=$Z_lotnum[2];
$lot_d=$Z_lotnum[3];
$lot_e=$Z_lotnum[4];

}

if(strpos($list_id, '2X_2')!==false)
$plays='2X_2';
else
$plays=play_type($list_id);

if($plays=="5X"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="4X"){$n_array=$lot_b."|".$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="4X1"){$n_array=$lot_a."|".$lot_b."|".$lot_c."|".$lot_d;}
if($plays=="3X3"){$n_array=$lot_b."|".$lot_c."|".$lot_d;}
if($plays=="3X2" or  $plays=="3M2"){$n_array=$lot_c."|".$lot_d."|".$lot_e;}
if($plays=="3X1"or $plays=="3M"or $plays=="3X4" or $plays=="3X" ){$n_array=$lot_a."|".$lot_b."|".$lot_c;}
if($plays=="2X_1"or $plays=="2M"or $plays=="2X3_1"  or $plays=='2X'){$n_array=$lot_a."|".$lot_b;}
if($plays=="2X3_2"){$n_array=$lot_b."|".$lot_c;}
if($plays=="2X_2" or $plays=="2M2"){$n_array=$lot_d."|".$lot_e;}

if(!$n_array){


	if(strpos($wei_values, ',')!==false){

		$wei=explode(',', $wei_values);
		//print_r($wei);
		foreach ($wei as $key=>$value) {
			if($value==1)$new_list[]=$Z_lotnum[$key];
		}

		if(strpos($list_id, "RX")!==false)
		$arr_temp=arr1_plzh2($new_list,substr($list_id, strlen($list_id)-1,1));
		else
		$arr_temp=arr1_plzh2($new_list,substr($list_id, 0,1));
		foreach ($arr_temp as $key=>$value) {
			$arr_temp[$key]=explode(',', $value);
		}
		if(count($arr_temp)==1)
		 $new_list=$arr_temp[0];
		 else
$new_list=$arr_temp;
	//	print_r($new_list);
	}
	else
$new_list=$Z_lotnum;

}
else
$new_list=explode("|",$n_array);


//print_r($new_list);exit();
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
function array_same_num($i_array){
$max_num=0;
for ($i=0;$i<count($i_array);$i++){
$f=0;$this_value=$i_array[$i];
for ($j=0;$j<count($i_array);$j++){
$now_value=$i_array[$j];
if($this_value-$now_value==0){$f+=1;}
}
if($f-$max_num>0){$max_num=$f;}
}
return $max_num;
}
function this_wanfa($list_id){
$list_id="#".$list_id;
if(strpos($list_id,'5X') or strpos($list_id,'5x')){$this_max=5;}
if(strpos($list_id,'4X') or strpos($list_id,'4X1') or strpos($list_id,'4X2') or strpos($list_id,'4R') or strpos($list_id,'4x') or strpos($list_id,'5z4')){$this_max=4;}
if(strpos($list_id,'3X') or strpos($list_id,'3X1') or strpos($list_id,'3X2') or strpos($list_id,'3R') or strpos($list_id,'3x')){$this_max=3;}
if(strpos($list_id,'2X') or strpos($list_id,'2R') or strpos($list_id,'2x')){$this_max=2;}
if(strpos($list_id,'3M') or strpos($list_id,'3M2') or strpos($list_id,'3M1')){$this_max=3;}
if(strpos($list_id,'2M') or strpos($list_id,'2M2') or strpos($list_id,'2M1')){$this_max=2;}
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
$lot_list=k18_num($lot_list);
for ($i=0;$i<count($lot_list);$i++){if($lot_list[$i]-40>0){$xia+=1;}else{$shang+=1;}if($lot_list[$i]%2==0){$ous+=1;}else{$jis+=1;}}
if($code=="sxp"){if($xia-$shang>0){$re_value="下";}if($xia-$shang==0){$re_value="中";}if($shang-$xia>0){$re_value="上";}}
if($code=="jep"){if($ous-$jis>0){$re_value="偶";}if($ous-$jis==0){$re_value="和";}if($jis-$ous>0){$re_value="奇";}}
return $re_value;
}
function kl8_lot_count($Z_lotnum){
	$lot_list=k18_num($lot_list);
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
function in_arrary_str($array_s,$str){
for ($i=0;$i<count($array_s);$i++){
if($array_s[$i]==$str){
return $i;break;
}
}
}
function in_arrary_num($array_s,$str){
for ($i=0;$i<count($array_s);$i++){
$this_str="#".$array_s[$i];
if(strpos($this_str,$str)){return $i;break;}
}
}


function new_lot($str,$from,$num){




	$buylot=explode(",", $str);


   $newstr='';
	foreach ($buylot as $key=>$value) {

		if($key>=$from and $key<$from+$num){
			if($newstr=='') $newstr=$value;
			else $newstr.=",".$value;


		}

	}

	return $newstr;

}



function  prize_ssc_dt($buy_id,$list_id,$Z_buynum,$Z_lotnum){
$prizenum=0;$is_right=0;$t_code=play_code($list_id);
$buy_list_a=$Z_buynum[0];
$buy_list_b=$Z_buynum[1];
$list_lot=array_new($list_id,$Z_lotnum);$this_max=3;
$num1=0;

if(count(array_unique($list_lot))==3){
		$buy_list_a[0]=substr($buy_list_a, 0,1);
if (in_array($buy_list_a[0],$list_lot) === true ){
	$num1=1;
if(strlen($buy_list_a)>1)  {

	$buy_list_a[1]=substr($buy_list_a, 1,1);
if (in_array($buy_list_a[1],$list_lot) === true )  $num1=2;
else $num1=0;
}
if($num1>0){
	for($i=0;$i<strlen($buy_list_b);$i++){

	if (in_array(substr($buy_list_b, $i,1), $list_lot)!==false){ $num1++;	}

	}

}
}
}

if($num1>=3){

	return "is_yes|1";
}
else return "is_no|0";
}


function Prize_11X5_zxdt($buy_id,$list_id,$Z_buynum,$Z_lotnum){



$prizenum=0;$is_right=0;$t_code=play_code($list_id);
$buy_list_a=explode(" ", $Z_buynum[0]);
$buy_list_b=explode(" ", $Z_buynum[1]);
$list_lot=array_new($list_id,$Z_lotnum);
$this_max=this_wanfa($list_id);

$is_right=0;

foreach ($buy_list_a as $value) {

	if(in_array($value, $list_lot)) $is_right++;

}

if($is_right==count($buy_list_a)){

foreach ($buy_list_b as $value) {

	if(in_array($value, $list_lot)) $is_right++;

}

if($is_right-$this_max>=0){
	$prizenum=C_list($is_right,$this_max);

return "is_yes|".$prizenum;}
else{return "is_no|0";}



}
else{return "is_no|0";}


}
function Prize_ssc_z3bt($buy_id,$list_id,$Z_buynum,$Z_lotnum){


	$prizenum=0;$is_right=0;
if(strpos($Z_buynum, ',')!=false) $Z_buynum=explode(',', $Z_buynum);
$buy_list_a=$Z_buynum[0];
$buy_list_b=$Z_buynum[1];
$list_lot=array_new($list_id,$Z_lotnum);

$arr=arr_cha($list_lot);

	$statuss=$a=$b="";

$min=$arr[0];
$max=$arr[1];



if($min==0 and $max>0){

for($i=0;$i<strlen($buy_list_a);$i++){



if(arr_str_num($list_lot, $buy_list_a[$i])==2){

	$a="is_yes";
			break;
				}



		}

		for($i=0;$i<strlen($buy_list_b);$i++){

		if(arr_str_num($list_lot, $buy_list_b[$i])==1){

	$b="is_yes";
			break;
				}

		}



}

if($a=='is_yes' and $b=='is_yes') return "is_yes|1";else return "is_no|0";
}




function  prize_newfs($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);

//
$statuss='';

if(is_array($new_buynum)){

	foreach ($new_buynum as $value){

		if(strpos($new_Lotnum, $value)!==false){

	$statuss="is_yes";
			break;
		}

	}
}
else{

if(strpos($new_Lotnum, $new_buynum)!==false){

	$statuss="is_yes";

		}


}

if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}


function  prize_newfs1($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
if(strpos($new_Lotnum, ',')!==false)$new_Lotnum=explode(',', $new_Lotnum);


if(is_array($new_Lotnum) and count($new_Lotnum)>1){
$new_Lotnum=bubble_sort($new_Lotnum);


$newstr='';
	foreach ($new_Lotnum as $key=>$value) {


			if($newstr=='') $newstr=$value;
			else $newstr.=",".$value;

	}
	$new_Lotnum=$newstr;
}
//
$statuss='';

if(is_array($new_buynum)){

	foreach ($new_buynum as $value){

		if(strpos($new_Lotnum, $value)!==false){

	$statuss="is_yes";
			break;
		}

	}
}
else{

if(strpos($new_Lotnum, $new_buynum)!==false){

	$statuss="is_yes";

		}


}

if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}

//二同号  二不同  三连号
function  Prize_newth($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);

if(strpos($new_Lotnum, ',')) $new_Lotnum=explode(',', $new_Lotnum);


$statuss='';
$new_buynum=str_replace('*', '', $new_buynum);

for($i=0;$i<=strlen($new_buynum);$i++){
	if(substr($new_buynum, $i,1)!=='' and substr($new_buynum, $i,1)!==false)
	$buynum[$i]=substr($new_buynum, $i,1);
}

if(count($buynum)==3){

	if(in_array($buynum[0], $new_Lotnum) and in_array($buynum[1], $new_Lotnum)  and in_array($buynum[2], $new_Lotnum) ) 	$statuss="is_yes";


}

if(count($buynum)==2){
	if($buynum[0]!=$buynum[1]){

	if(in_array($buynum[0], $new_Lotnum) and in_array($buynum[1], $new_Lotnum) ) 	$statuss="is_yes";
	}
	else{

		if(arr_str_num($new_Lotnum, $buynum[0])==2) $statuss="is_yes";
	}

}


if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}




function arr_kd($arr){

	if(!is_array($arr) and strpos($arr, ',')!==false){

		$arr=explode(",", $arr);
	}
$sum=0;
$a=0;
$b=10000;

for ($i=0;$i<count($arr);$i++){

  if($arr[$i]>$a) $a=$arr[$i];
  if($arr[$i]<=$b ) $b=$arr[$i];


}
$sum=$a-$b;

return $sum;

}

//和值
function  prize_newhz($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);

$statuss='';
if(strpos($new_Lotnum, ',')!=false) $new_Lotnum=explode(',', $new_Lotnum);
$sum=arr_sum($new_Lotnum);




	if($new_buynum==$sum){

	$statuss="is_yes";

		}



if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}


//跨度
function  prize_newkd($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';

if(strpos($new_Lotnum, ',')) $new_Lotnum=explode(',', $new_Lotnum);
$arr=arr_cha($new_Lotnum);

$min=$arr[1];


	if($new_buynum=='跨大'){
		if($min>=5)$statuss="is_yes";

	}
	else if($new_buynum=='跨小'){
		if($min<5)$statuss="is_yes";

	}
else if($new_buynum=='跨单'){
		if($min%2==1)$statuss="is_yes";

	}
else if($new_buynum=='跨双'){
		if($min%2==0)$statuss="is_yes";

	}

	else if($new_buynum==$min){

	$statuss="is_yes";

		}

if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}




//不出号
function  prize_newbch($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';
if(strpos($new_Lotnum, ',')!==false)
 $new_Lotnum=explode(',', $new_Lotnum);

if(!in_array($new_buynum, $new_Lotnum)){


				$statuss="is_yes";
}


if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}






//自由双面
function  prize_newzysm($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';


$sum=arr_sum($new_Lotnum);
if($new_buynum=='合大' and $sum>=11)$statuss="is_yes";
if($new_buynum=='合小' and $sum<11)$statuss="is_yes";
if($new_buynum=='合双' and $sum%2==0)$statuss="is_yes";
if($new_buynum=='合单' and $sum%2==1)$statuss="is_yes";
if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}


function  prize_zysmq5($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';
	if(!is_array($new_Lotnum) and strpos($new_Lotnum, ',')!==false){

		$new_Lotnum=explode(",", $new_Lotnum);
	}
$sum=arr_sum($new_Lotnum);

if($new_buynum=='合大' and $sum>=23)$statuss="is_yes";
if($new_buynum=='合小' and $sum<23)$statuss="is_yes";
if($new_buynum=='合双' and $sum%2==0)$statuss="is_yes";
if($new_buynum=='合单' and $sum%2==1)$statuss="is_yes";

if($new_buynum=='万大' and $new_Lotnum[0]>=5)$statuss="is_yes";
if($new_buynum=='万小' and $new_Lotnum[0]<5)$statuss="is_yes";
if($new_buynum=='万单' and $new_Lotnum[0]%2==1)$statuss="is_yes";
if($new_buynum=='万双' and $new_Lotnum[0]%2==0)$statuss="is_yes";


if($new_buynum=='千大' and $new_Lotnum[1]>=5)$statuss="is_yes";
if($new_buynum=='千小' and $new_Lotnum[1]<5)$statuss="is_yes";
if($new_buynum=='千单' and $new_Lotnum[1]%2==1)$statuss="is_yes";
if($new_buynum=='千双' and $new_Lotnum[1]%2==0)$statuss="is_yes";


if($new_buynum=='百大' and $new_Lotnum[2]>=5)$statuss="is_yes";
if($new_buynum=='百小' and $new_Lotnum[2]<5)$statuss="is_yes";
if($new_buynum=='百单' and $new_Lotnum[2]%2==1)$statuss="is_yes";
if($new_buynum=='百双' and $new_Lotnum[2]%2==0)$statuss="is_yes";

if($new_buynum=='十大' and $new_Lotnum[3]>=5)$statuss="is_yes";
if($new_buynum=='十小' and $new_Lotnum[3]<5)$statuss="is_yes";
if($new_buynum=='十单' and $new_Lotnum[3]%2==1)$statuss="is_yes";
if($new_buynum=='十双' and $new_Lotnum[3]%2==0)$statuss="is_yes";

if($new_buynum=='个大' and $new_Lotnum[4]>=5)$statuss="is_yes";
if($new_buynum=='个小' and $new_Lotnum[4]<5)$statuss="is_yes";
if($new_buynum=='个单' and $new_Lotnum[4]%2==1)$statuss="is_yes";
if($new_buynum=='个双' and $new_Lotnum[4]%2==0)$statuss="is_yes";

if($statuss=="is_yes"){return "is_yes|1";}else{return "is_no|0";}
}

//梭哈


function  Prize_newsh($new_buynum,$new_Lotnum,$from=0,$num=5){
    global $db;
$wanfa=$db->exec("SELECT * FROM  `game_ssc_list` WHERE skey =  'SH-q5'");
$show_key=explode('|',$wanfa['show_key']);
$new_Lotnum=new_lot($new_Lotnum, $from, $num);


$new_Lotnum=explode(',', $new_Lotnum);
$arr=arr_cha($new_Lotnum);

$min=$arr[0];
$max=$arr[1];
$new_buynum=trim($new_buynum);
$wei=0;

if(strpos($new_buynum,'豹子')!==false){


	if($min==0 and $max==0) {

        $statuss='is_yes';
        $wei=in_arrary_number('豹子',$show_key);
    }


}
    if(strpos($new_buynum,'四张')!==false){


        $arr=array_unique($new_Lotnum);
        $arr=array_unq($arr);
        $a=$b=0;
        foreach ($new_Lotnum as $value) {
            if($arr[0]==$value) $a++;
            if($arr[1]==$value) $b++;

        }

        if($min==0 and $max>0  and count($arr)==2  and ($a==1 or $b==1)){
            $statuss='is_yes';
            $wei=in_arrary_number('四张',$show_key);
        }


    }
    if(strpos($new_buynum,'顺子')!==false){


        if($min==1 and $max==4)  {

            $statuss='is_yes';
            $wei=in_arrary_number('顺子',$show_key);
        }

    }

    if(strpos($new_buynum,'杂牌')!==false){

        if($min>1)   {
            $statuss='is_yes';
            $wei=in_arrary_number('杂牌',$show_key);
        }
    }
    if(strpos($new_buynum,'五离')!==false){

        if($min>1)   {

            $statuss='is_yes';
            $wei=in_arrary_number('五离',$show_key);
        }

    }

    if(strpos($new_buynum,'半顺')!==false){

        if($min==1 and $max>2) {
            $statuss='is_yes';
            $wei=in_arrary_number('半顺',$show_key);
        }
    }
    if(strpos($new_buynum,'一对')!==false){
        $arr=array_unique($new_Lotnum);
        if(count($arr)==4  and  $min==0){
            $statuss='is_yes';
            $wei=in_arrary_number('一对',$show_key);
        }
    }




if(strpos($new_buynum,'葫芦')!==false){

	$arr=array_unique($new_Lotnum);
	$arr=array_unq($arr);

  if(count($arr)==2){
		$a=$b=0;
	foreach ($new_Lotnum as $value) {
		if($arr[0]==$value) $a++;
		if($arr[1]==$value) $b++;

	}

	if($a==2 or $b==2) {$statuss='is_yes';
        $wei=in_arrary_number('葫芦',$show_key);
	}
}
}

if(strpos($new_buynum,'两对')!==false){

	$arr=array_unique($new_Lotnum);

	$arr=array_unq($arr);
  if(count($arr)==3  ){
		$a=$b=$c=0;
	foreach ($new_Lotnum as $value) {
		if($arr[0]==$value) $a++;
		if($arr[1]==$value) $b++;
		if($arr[2]==$value) $c++;
	}
	if($a<3 and $b<3 and $c<3) {$statuss='is_yes';
        $wei=in_arrary_number('两对',$show_key);
	}
}
}

if(strpos($new_buynum,'三张')!==false){

	$arr=array_unique($new_Lotnum);
	$arr=array_unq($arr);

  if(count($arr)==3  ){
		$a=$b=$c=0;
	foreach ($new_Lotnum as $value) {
		if($arr[0]==$value) $a++;
		if($arr[1]==$value) $b++;
		if($arr[2]==$value) $c++;
	}
	if($a==3 or $b==3 or $c==3) {
        $wei=in_arrary_number('三张',$show_key);
        $statuss='is_yes';
    }
}
}

if( strpos($new_buynum,'杂牌')!==false){
	$arr=array_unique($new_Lotnum);
	$arr=array_unq($arr);
  if(count($arr)==5  and $min==1  and $max>4){
$statuss='is_yes';
      $wei=in_arrary_number('杂牌',$show_key);
}
}
if(strpos($new_buynum,'一对')!==false){

	$arr=array_unique($new_Lotnum);

  if(count($arr)==4  and  $min==0){
	$statuss='is_yes';
      $wei=in_arrary_number('一对',$show_key);
}
}


if($statuss=="is_yes"){return "is_yes|1|{$wei}";}else{return "is_no|0";}
}






//龙虎和

function  prize_newlhh($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';
if($num==5) $ss=4;else $ss=2;
	$new_Lotnum=explode(',', $new_Lotnum);

if($new_buynum=='龙' and $new_Lotnum[0]>$new_Lotnum[$ss]){$statuss="is_yes";$pnum=0;}
if($new_buynum=='虎' and $new_Lotnum[0]<$new_Lotnum[$ss]){$statuss="is_yes";$pnum=1;}
if($new_buynum=='和' and $new_Lotnum[0]==$new_Lotnum[$ss]){$statuss="is_yes";$pnum=2;}

if($statuss=="is_yes"){return "is_yes|1|".$pnum;}else{return "is_no|0";}
}

function  prize_newdn($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$statuss='';
$new_Lotnum=explode(',', $new_Lotnum);
$sum=arr_sum($new_Lotnum);
$num=0;$niu=0;
for($i=2;$i<count($new_Lotnum);$i++){
for($j=1;$j<$i;$j++){
for($k=0;$k<$j;$k++){

if(($new_Lotnum[$i]+$new_Lotnum[$j]+$new_Lotnum[$k])%10==0){
	$niu=1;
	$num=($sum-($new_Lotnum[$i]+$new_Lotnum[$j]+$new_Lotnum[$k]))%10;

break;
}


}
}
}
$prize_num=0;
if($niu==1){

if(strpos($new_buynum,'牛一')!==false  and $num==1){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛二')!==false  and $num==2){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛三')!==false  and $num==3){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛四')!==false  and $num==4){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛五')!==false  and $num==5){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛六')!==false  and $num==6){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛七')!==false  and $num==7){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛八')!==false  and $num==8){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛九')!==false  and $num==9){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛牛')!==false  and $num==0){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛大')!==false  and ($num>5  or $num==0)){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛小')!==false  and $num<=5 and $num!=0){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛单')!==false  and $num%2==1 ){$statuss="is_yes";$prize_num++;}
if(strpos($new_buynum,'牛双')!==false  and $num%2==0 ){$statuss="is_yes";$prize_num++;}

}
else{

if(strpos($new_buynum,'无牛')!==false ){$statuss="is_yes";$prize_num++;}
}


if($statuss=="is_yes"){return "is_yes|{$prize_num}";}else{return "is_no|0";}
}


function prize_3gzyh($new_buynum,$new_Lotnum,$from=0,$num=5){
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $status='';
    $prize_num=0;
    $new_Lotnum=explode(',', $new_Lotnum);
    $sum1=$sum2=0;
   for($i=0;$i<3;$i++){
       $sum1+=$new_Lotnum[$i];
   }
    for($i=2;$i<5;$i++){
        $sum2+=$new_Lotnum[$i];
    }
   $sum1=$sum1%10;
   if($sum1==0)$sum1=10;
    $sum2=$sum2%10;
    if($sum2==0)$sum2=10;

    if(strpos($new_buynum,'左闲')!==false  and $sum1>$sum2){$status="is_yes";$prize_num=0;}
    if(strpos($new_buynum,'右闲')!==false  and $sum1<$sum2){$status="is_yes";$prize_num=1;}
    if(strpos($new_buynum,'和')!==false  and $sum1==$sum2){$status="is_yes";$prize_num=2;}
    if($status=="is_yes"){return "is_yes|1|{$prize_num}";}else{return "is_no|0";}

}

function prize_3gdxdszh($new_buynum,$new_Lotnum,$from=0,$num=5){
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $status='';
    $prize_num=0;
    $new_Lotnum=explode(',', $new_Lotnum);
    $sum1=$sum2=0;
    for($i=0;$i<3;$i++){
        $sum1+=$new_Lotnum[$i];
    }
    for($i=2;$i<5;$i++){
        $sum2+=$new_Lotnum[$i];
    }
    $sum1=$sum1%10;
    if($sum1==0)$sum1=10;
    $sum2=$sum2%10;
    if($sum2==0)$sum2=10;


    if(strpos($new_buynum,'左闲尾大')!==false  and $sum1>=5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'左闲尾小')!==false  and $sum1<5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'左闲尾单')!==false  and $sum1%2==1){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'左闲尾双')!==false  and $sum1%2==0){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'左闲尾质')!==false  and ($sum1==1 or $sum1==2 or $sum1==3 or $sum1==5 or $sum1==7 )){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'左闲尾合')!==false  and ($sum1==0 or $sum1==4 or $sum1==6 or $sum1==8 or $sum1==9 )){$status="is_yes";$prize_num++;}

    if(strpos($new_buynum,'右闲尾大')!==false  and $sum2>=5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'右闲尾小')!==false  and $sum2<5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'右闲尾单')!==false  and $sum2%2==1){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'右闲尾双')!==false  and $sum2%2==0){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'右闲尾质')!==false  and ($sum2==1 or $sum2==2 or $sum2==3 or $sum2==5 or $sum2==7 )){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'右闲尾合')!==false  and ($sum2==0 or $sum2==4 or $sum2==6 or $sum2==8 or $sum2==9 )){$status="is_yes";$prize_num++;}
    if($status=="is_yes"){return "is_yes|{$prize_num}";}else{return "is_no|0";}

}

function prize_bjlzxh($new_buynum,$new_Lotnum,$from=0,$num=5){
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $status='';
    $prize_num=0;
    $new_Lotnum=explode(',', $new_Lotnum);
  $arr=baijiale($new_Lotnum);
  $sum1=$arr[0];
  $sum2=$arr[1];

    if(strpos($new_buynum,'庄')!==false  and $sum1>$sum2){$status="is_yes";$prize_num=0;}
    if(strpos($new_buynum,'闲')!==false  and $sum1<$sum2){$status="is_yes";$prize_num=1;}
    if(strpos($new_buynum,'和')!==false  and $sum1==$sum2){$status="is_yes";$prize_num=2;}

    if($status=="is_yes"){return "is_yes|1|{$prize_num}";}else{return "is_no|0";}

}

function prize_bjldxdszh($new_buynum,$new_Lotnum,$from=0,$num=5){
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $status='';
    $prize_num=0;
    $new_Lotnum=explode(',', $new_Lotnum);
    $arr=baijiale($new_Lotnum);
    $sum1=$arr[0];
    $sum2=$arr[1];

    if(strpos($new_buynum,'庄大')!==false  and $sum1>=5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'庄小')!==false  and $sum1<5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'庄单')!==false  and $sum1%2==1){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'庄双')!==false  and $sum1%2==0){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'庄质')!==false  and ($sum1==1 or $sum1==2 or $sum1==3 or $sum1==5 or $sum1==7 )){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'庄合')!==false  and ($sum1==0 or $sum1==4 or $sum1==6 or $sum1==8 or $sum1==9 )){$status="is_yes";$prize_num++;}

    if(strpos($new_buynum,'闲大')!==false  and $sum2>=5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲小')!==false  and $sum2<5){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲单')!==false  and $sum2%2==1){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲双')!==false  and $sum2%2==0){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲质')!==false  and ($sum2==1 or $sum2==2 or $sum2==3 or $sum2==5 or $sum2==7 )){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲合')!==false  and ($sum2==0 or $sum2==4 or $sum2==6 or $sum2==8 or $sum2==9 )){$status="is_yes";$prize_num++;}

    if($status=="is_yes"){return "is_yes|{$prize_num}";}else{return "is_no|0";}

}
function prize_bjlzxd($new_buynum,$new_Lotnum,$from=0,$num=5){
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $status='';
    $prize_num=0;
    $new_Lotnum=explode(',', $new_Lotnum);


    if(strpos($new_buynum,'庄对')!==false  and $new_Lotnum[0]==$new_Lotnum[1]){$status="is_yes";$prize_num++;}
    if(strpos($new_buynum,'闲对')!==false  and $new_Lotnum[4]==$new_Lotnum[5]){$status="is_yes";$prize_num++;}



    if($status=="is_yes"){return "is_yes|{$prize_num}";}else{return "is_no|0";}

}


function Prize_k3_hz($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);

	$buy=explode(',', $new_buynum);
	$sum=arr_sum($new_Lotnum);
	$ok=0;
foreach ($buy as $value) {
	if($value==$sum) $ok++;

}
	if($ok>0){return "is_yes|1";}else{return "is_no|0";}

}


function Prize_HZK3($new_buynum,$new_Lotnum,$from=0,$num=3){
    global $db;
    $new_Lotnum=new_lot($new_Lotnum, $from, $num);
    $num1=$num2=0;
    $new_Lotnum=explode(',', $new_Lotnum);
    $sum=arr_sum($new_Lotnum);
    $buy=explode(',', $new_buynum);

    $ok=0;
    $wanfa=$db->exec("select show_key from game_ssc_list where skey='K3HZ'");
    $show_key=explode('|',$wanfa['show_key']);
    $pos=0;
    foreach ($show_key as  $k1=>$v1){
     if($v1==$sum) $pos=$k1;

    }

    $arr=array();
    foreach ($buy as $value) {
        if($value==$sum) {
            $ok++;
            $arr[]=$pos;
        }
        if($value=='大' and $sum>10) {$arr[]=16;$ok++;}
        if($value=='小' and $sum<=10) {$arr[]=17;$ok++;}
        if($value=='单' and $sum%2==1) {$arr[]=18;$ok++;}
        if($value=='双' and $sum%2==0) {$arr[]=19;$ok++;}


    }


    if($ok>0){return "is_yes|1|".implode(',',$arr);}else{return "is_no|0";}

}





//3不同和值
function Prize_k3_3bthz($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);
		$ok=0;

if($new_Lotnum[0]!=$new_Lotnum[1] and $new_Lotnum[1]!=$new_Lotnum[2] and $new_Lotnum[0]!=$new_Lotnum[2] ){
	$buy=explode(',', $new_buynum);
	$sum=arr_sum($new_Lotnum);

foreach ($buy as $value) {
	if($value==$sum) $ok++;

}
}
	if($ok>0){return "is_yes|1";}else{return "is_no|0";}

}

function Prize_k3_2th_ds($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);
		$ok=0;

if(($new_Lotnum[0]==$new_Lotnum[1] or $new_Lotnum[1]==$new_Lotnum[2] or $new_Lotnum[0]==$new_Lotnum[2]) and !($new_Lotnum[0]==$new_Lotnum[1] and $new_Lotnum[1]==$new_Lotnum[2]) ){
	$buy=explode(',', $new_buynum);

	foreach ($buy as $value) {
	if(in_array(substr($value, 0,1), $new_Lotnum) and in_array(substr($value,1,1), $new_Lotnum) and in_array(substr($value,2,1), $new_Lotnum)) $ok++;
	}


}
	if($ok>0){return "is_yes|".$ok;}else{return "is_no|0";}

}


//二不同单式
function Prize_k3_2bt_ds($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);
		$ok=0;

if($new_Lotnum[0]!=$new_Lotnum[1] or $new_Lotnum[1]!=$new_Lotnum[2] or $new_Lotnum[0]!=$new_Lotnum[2] ){
	$buy=explode(',', $new_buynum);

	foreach ($buy as $value) {
	if(in_array(substr($value, 0,1), $new_Lotnum) and in_array(substr($value,1,1), $new_Lotnum)) $ok++;
	}


}
	if($ok>0){return "is_yes|".$ok;}else{return "is_no|0";}

}


//三不同单式
function Prize_k3_3bt_ds($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);
		$ok=0;

if($new_Lotnum[0]!=$new_Lotnum[1] and $new_Lotnum[1]!=$new_Lotnum[2] and $new_Lotnum[0]!=$new_Lotnum[2] ){
	$buy=explode(',', $new_buynum);

foreach ($buy as $value) {
	if(substr($value, 0,1)==$new_Lotnum[0] and substr($value, 1,1)==$new_Lotnum[1] and substr($value, 2,1)==$new_Lotnum[2]) $ok++;
	}

}
	if($ok>0){return "is_yes|".$ok;}else{return "is_no|0";}

}




//二同号单选
function Prize_k3_dx($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);
$num1=$num2=0;
$new_Lotnum=explode(',', $new_Lotnum);

	$buy=explode(',', $new_buynum);

	for($i=0;$i<strlen($buy[0]);$i=$i+2){

		$buy1[]=substr($buy[0], $i,1);

	}

	for($i=0;$i<strlen($buy[1]);$i++){

		$buy2[]=substr($buy[1], $i,1);

	}
	foreach ($buy1 as $value){
	if(arr_str_num($new_Lotnum, $value)==2) {

		$num1=2;
		break;

	}

	}

		foreach ($buy2 as $value){
	if(arr_str_num($new_Lotnum, $value)==1) {

		$num2=1;
		break;

	}
	}

	if($num1==2 and $num2==1){return "is_yes|1";}else{return "is_no|0";}

}

//二同号复选

function  Prize_k3_fx($new_buynum,$new_Lotnum,$from=0,$num=3){

$new_Lotnum=new_lot($new_Lotnum, $from, $num);

if(strpos($new_Lotnum, ',')) $new_Lotnum=explode(',', $new_Lotnum);


$statuss='';
$new_buynum=str_replace(" ", ',', $new_buynum);
$new_buynum=explode(',', $new_buynum);
$num11=0;

foreach ($new_buynum as $value) {


	$value=str_replace('*', '', $value);
	if(strlen($value)==3){

		//三连号
		$buy='';
		for($i=0;$i<strlen($value);$i++){
		$buy[$i]=substr($value, $i,1);

	}
		if(in_array($buy[0], $new_Lotnum) and in_array($buy[1], $new_Lotnum) and in_array($buy[2], $new_Lotnum)) 	{$statuss="is_yes";	$num11++;}
	}

	else if(strlen($value)==2  and count(array_unique($new_Lotnum))==2){
		//二同号复选
	$value=substr($value, 0,1);

	if(arr_str_num($new_Lotnum, $value)>=2){$statuss= "is_yes";$num11++;}
	}

}

if($statuss=="is_yes"){return "is_yes|{$num11}";}else{return "is_no|0";}
}


//二不同标准
function  Prize_k3_2btbz($new_buynum,$new_Lotnum,$from=0,$num=3){
	$new_Lotnum=new_lot($new_Lotnum, $from, $num);

if(strpos($new_Lotnum, ',')) $new_Lotnum=explode(',', $new_Lotnum);
	//$new_buynum=str_replace(" ", ',', $new_buynum);
//$new_buynum=explode(',', $new_buynum);

$statuss='';
$new_buynum=arr1_plzh($new_buynum,2);

$num11=0;
foreach ($new_buynum as $value) {
$value1=explode(',', $value);

if(in_array($value1[0], $new_Lotnum) and in_array($value1[1], $new_Lotnum)) {$num11++;$statuss= "is_yes";}


}


if($statuss=="is_yes"){return "is_yes|{$num11}";}else{return "is_no|0";}
}



function Prize_k3_2btdt($new_buynum,$new_Lotnum,$from_wei,$num_wei){
		$new_Lotnum=new_lot($new_Lotnum,$from=0,$num=3);

if(strpos($new_Lotnum, ',')) $new_Lotnum=explode(',', $new_Lotnum);
	//$new_buynum=str_replace(" ", ',', $new_buynum);
//$new_buynum=explode(',', $new_buynum);

$statuss='';
$new_buynum=explode(',', $new_buynum);
$num11=0;

if(in_array($new_buynum[0], $new_Lotnum)){
	for($i=0;$i<=strlen($new_buynum[1]);$i++){
		if(in_array(substr($new_buynum[1], $i,1), $new_Lotnum)){

		 $num11++;$statuss= "is_yes";

		}


	}



}

if($statuss=="is_yes"){return "is_yes|{$num11}";}else{return "is_no|0";}

}

?>