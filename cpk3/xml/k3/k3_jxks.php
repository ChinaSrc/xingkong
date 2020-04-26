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
$url='http://e.apiplus.net/newly.do?token=td9efe2ebc490ff1ek&code=jxk3&format=json';
$content=file_get_contents($url);
$start='expect":"';
$end='","';
$expect=cut($start,$end,$content);
//$expect = '20'.$expect;
$expect = substr($expect,0,11);
$start='opencode":"';
$end='","';
$codes=cut($start,$end,$content);

$start='opentime":"';
$end='","';
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