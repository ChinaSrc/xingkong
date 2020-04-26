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
$url='http://www.xjflcp.com/ssc/';
$content=file_get_contents($url);
$start='<td width="60">¿ª½±ºÅÂë</td>';
$end='<td colspan="3" align="center"><div class="bg_trend">';
$content1=cut($start,$end,$content);
$content2=explode('<tr>',$content1);
$content3=$content2[10];
$start=');">';
$end='</a></td>';
$expect=cut($start,$end,$content3);
$start='<p>';
$end='</p>';
$opencode=cut($start,$end,$content3);
$opencode=str_replace(" ",",",$opencode);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo '
'
?>