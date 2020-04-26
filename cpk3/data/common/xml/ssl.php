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
$url='http://www.2caipiao.com/ssl/index.jhtml?action=historyopenlist';
$content=file_get_contents($url);
$start='<td height="25" bgcolor="#eff5f7">';
$end='</td>';
$content0=cut($start,$end,$content);
$expects=getcode($content0);
$expect=substr($expects,0,8).'-'.substr($expects,8,2);
$start='</script></td>';
$end='<script>';
$content1=cut($start,$end,$content);
$start='<td height="25" bgcolor="#eff5f7">';
$end='</td>';
$content0=cut($start,$end,$content1);
$opencode=getcode($content0);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();

?>