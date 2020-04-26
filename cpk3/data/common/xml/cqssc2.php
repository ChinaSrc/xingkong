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
$url='http://www.2caipiao.com/ssc/index.jhtml';
$content=file_get_contents($url);
$start='<tr align="center" class="hong">';
$end='</tr>';
$content0=cut($start,$end,$content);
$start='<td height="25" bgcolor="#E7F2FB">';
$end='</td>';
$expect0=cut($start,$end,$content0);
$expect=getcode($expect0);
$start='showhz("';
$end='"))';
$opencode0=cut($start,$end,$content0);
$opencode=getcode($opencode0);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
?>