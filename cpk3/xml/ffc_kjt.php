<?php
date_default_timezone_set('PRC');//设置为中华人民共和国
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
$url='http://api.kaijiangtong.com/lottery/?name=ffcqq&format=json&uid=898745&token=41f52f86da8f5c25a9f00aa7b23bc1216dac8b99';
$content=file_get_contents($url);
$start='{"';
$end='":';
$expect=cut($start,$end,$content);
//$expect = '20'.$expect;
$expect = substr($expect,0,8).'-'.substr($expect,8);
$start='number":"';
$end='","';
$codes=cut($start,$end,$content);

$start='dateline":"';
$end='"},';
$opentime=cut($start,$end,$content);

$opencode='';
$i = 0;
while ($i<=9){
if($i<>9) $str='';else $str='';
$opencode.=substr($codes,$i,1).$str;
$i+=1;
}
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>