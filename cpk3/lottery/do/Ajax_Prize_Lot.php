<?php

mysql_query("set names utf8;");
require_once('fun_Prize_Lot.php');
$this_date=date("Ymd",time());
$nowtime=date("Y-m-d H:i:s",time());
if(!$period)$period=$_GET['period'];
mysql_query("set names utf8;");
$str='';
if($id) $str .=" and  game_buylist.id='$id' ";	
if($period)  {$str .=" and game_buylist.period='$period' ";}
if($playkey) $str.=" and game_buylist.playkey='{$playkey}' ";

$sql2="select game_buylist.id,game_buylist.buyid,game_buylist.playkey,game_buylist.period,game_buylist.number as buynum,game_buylist.list_id,game_buylist.pri_mode,game_buylist.modes,game_buylist.money,game_buylist.userid,game_buylist.rebate_buy from game_buylist where game_buylist.status='0' and game_buylist.is_succeed='yes' {$str}  ";

$result2=mysql_query($sql2);
$nums2=mysql_num_rows($result2);
$list_num=0;

if($nums2){
while($rows2=mysql_fetch_array($result2)){
$list_ids.="|".$rows2[id];
$playkey=$rows2[playkey];
$this_period=$rows2[period];
if($playkey=="LJSSC"or strpos($playkey, "KL8")!==false or $playkey=="3D"or $playkey=="P5(P3)"){
$searchs=" where game_lottery.period='$this_period' and game_lottery.playKey='$rows2[playkey]'";
}else{
$SerialDate=substr($rows2[period],0,8);
$SerialID=substr($rows2[period],8,strlen($rows2[period]));
$searchs=" where game_lottery.SerialDate='$SerialDate' and game_lottery.SerialID='$SerialID' and game_lottery.playKey='$rows2[playkey]'";
}
$sql8="select game_lottery.id,game_lottery.Number as lotnum from game_lottery $searchs ";
$result8=mysql_query($sql8);
$nums8=mysql_num_rows($result8);

if($nums8){

$rows8=mysql_fetch_array($result8);



$buynum=$rows2[buynum];//投注内容

$list_id=$rows2[list_id];//玩法

$lotnum=$rows8[lotnum];//开奖号码

$buy_id=$rows2[id];//投注编号

//设置投注内容格式，用逗号分开
if(strpos($lotnum,',')){
$new_Lotnum=$lotnum;
}else{
$new_Lotnum=substr($lotnum,0,1);
for ($i=1;$i<strlen($lotnum);$i++){$new_Lotnum.=",".substr($lotnum,$i,1);}
}


if($buynum=="0"or $buynum!=""){
//	
//$list_id='SH-q5';

//$buynum='顺子';



include("fun_Prize_lot_play.php");
$flags="";
$Z_buynum=explode(",",$new_buynum);  //购买内容，数组
$Z_lotnum=explode(",",$new_Lotnum);  //开奖号码，数组

//$new_Lotnum='2,3,4,5,6';
include("fun_Prize_lot_fun.php");

if($flags!=""){
$Z_flags=explode("|",$flags);


//print_r($Z_flags);exit();
$strSql="update game_buylist set isprize='$Z_flags[0]',pri_number='$new_Lotnum',prizenum='$Z_flags[1]',pri_other='$Z_flags[2]',status='1' where id='$buy_id' and status='0'";
$db->query($strSql);
$strSql="update game_lottery set status='1' where id='$rows8[id]' and status='0'";
$db->query($strSql);
if($rows2[rebate_buy]==""){
$re_perid=$rows2[userid];$re_playkey=$rows2[playkey];$re_game=$rows2[list_id];$re_money=$rows2[money];$re_mode=$rows2[modes];$re_pri_mode=$rows2[pri_mode];$re_floatid=$rows2[buyid];$re_id=$rows2[id];
include("../source/plugin/Add_rebate.php");
}
}
}
}
$list_num+=1;
}
}
function Lot_01_Num($buynum){
if(strpos($buynum,',')){
$new_buynum=$buynum;
}else{
	
$buynum=	str_replace("*", "", $buynum);
$new_buynum=substr($buynum,0,1);

for ($i=1;$i<strlen($buynum);$i++){
$new_buynum.=",".substr($buynum,$i,1);
}
}
return $new_buynum;
}


function Lot_ds_Num($buynum){
$buy_list=explode(" ",$buynum);
for ($i=0;$i<count($buy_list);$i++){
if($buy_list[$i]!=""){
if($z_buy==""){
$z_buy=$buy_list[$i];
}else{
$z_buy.="|".$buy_list[$i];
}
}
}
return $z_buy;
}
mysql_close();

?>