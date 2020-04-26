<?php

ob_start();
function cut($start,$end,$file){
$content=explode($start,$file);
$content=explode($end,$content[1]);
return  $content[0];
}
function getcode($str){
$str=trim(eregi_replace("[^0-9]","",$str));
return $str;
}
$url='http://goucai.diyicai.com/lottery/hisnumber.action?lotteryId=006';
$content=file_get_contents($url);
$start='lotteryExpect';
$end='ernieDate';
$content0=cut($start,$end,$content);
$expect="10000000"+getcode($content0);
$start='lotteryNumber';
$end='luckynumberstatus';
$content1=cut($start,$end,$content);
$codes=getcode($content1);
$opencode='';
$i = 0;
while ($i<=8){
if($i<>8) $str=',';else $str='';
$opencode.=substr($codes,$i+1,1).$str;
$i+=2;
}
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo '
';
?>