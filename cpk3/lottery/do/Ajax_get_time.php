<?php

$begin_s=$_POST['begin_s'];
$end_s=$_POST['end_s'];
$now_time=date("His",time());
$fla_s="no";
if(!$begin_s or !$end_s){
$fla_s="no";
}else{
if($end_s-$begin_s>0){
if($now_time-$begin_s>=0 and $end_s-$now_time>=0){
$fla_s="yes";
}else{
$fla_s="no";
}
}else{
if($now_time-$begin_s>=0 or $end_s-$now_time>=0){
$fla_s="yes";
}else{
$fla_s="no";
}
}
}
echo $fla_s;

?>