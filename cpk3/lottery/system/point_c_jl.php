<?php

$sql13="select number as hig_num from user_rebate where PlayKey='$rows5[ckey]' and Modes='$mode' and userid='$higherid' and ItemKey='Normal'";
$result13=mysql_query($sql13);
$rows13=mysql_fetch_array($result13);
$sql14="select number as hig_bdw from user_rebate where PlayKey='$rows5[ckey]' and Modes='$mode' and userid='$higherid' and ItemKey='Second'";
$result14=mysql_query($sql14);
$rows14=mysql_fetch_array($result14);
$sql15="select number as pernum from user_rebate where PlayKey='$rows5[ckey]' and Modes='$mode' and userid='$perid' and ItemKey='Normal'";
$result15=mysql_query($sql15);
$rows15=mysql_fetch_array($result15);
$sql16="select number as per_bdw from user_rebate where PlayKey='$rows5[ckey]' and Modes='$mode' and userid='$perid' and ItemKey='Second'";
$result16=mysql_query($sql16);
$rows16=mysql_fetch_array($result16);
$hi_re_num=$rows13[hig_num];$this_re_num=$rows15[pernum];
if($hi_re_num){
$hi_re_num=$hi_re_num-$MinBonus;$arouds="(范围：0~".$hi_re_num."%)<input id='zc_".$playkey."_hig' value='".$hi_re_num."' type='hidden'><input id='zc_".$playkey."_own' value='".$this_re_num."' type='hidden'>";
$other_body="<input id='zc_".$playkey."' value='".$this_re_num."' size=6>% ".$arouds;
}else{
if($higherid==""or $higherid=="0"){
$hi_re_num=$MaxBonus;$arouds="(范围：0~".$hi_re_num."%)<input id='zc_".$playkey."_hig' value='".$hi_re_num."' type='hidden'><input id='zc_".$playkey."_own' value='".$this_re_num."' type='hidden'>";
$other_body="<input id='zc_".$playkey."' value='".$this_re_num."' size=6>% ".$arouds;
}else{
$other_body="";
}
}
$bdw_re_num=$rows14[hig_bdw];$this_bdw_num=$rows16[per_bdw];
if($bdw_re_num){
$bdw_re_num=$bdw_re_num-$MinBonus;$bdw_arouds="(范围：0~".$bdw_re_num."%)<input id='bdw_".$playkey."_hig' value='".$bdw_re_num."' type='hidden'><input id='bdw_".$playkey."_own' value='".$this_bdw_num."' type='hidden'>";
$bdw_body="<input id='bdw_".$playkey."' value='".$this_bdw_num."' size=6>% ".$bdw_arouds;
}else{
if($higherid==""or $higherid=="0"){
$bdw_re_num=$MaxBonus;$bdw_arouds="(范围：0~".$bdw_re_num."%)<input id='bdw_".$playkey."_hig' value='".$bdw_re_num."' type='hidden'><input id='bdw_".$playkey."_own' value='".$this_bdw_num."' type='hidden'>";
$bdw_body="<input id='bdw_".$playkey."' value='".$this_bdw_num."' size=6>% ".$bdw_arouds;
}else{
$bdw_body="";
}
}
if($other_body!=""){$other_body.="<input id='play_jl_".$jl_num."' value='".$playkey."' type='hidden'>";}

?>