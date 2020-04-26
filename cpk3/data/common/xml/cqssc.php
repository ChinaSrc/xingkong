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
$url='http://ssc.starlott.com/';
$content=file_get_contents($url);
$start='<select id="issue" onchange="util.bindData(this.value);">';
$end='</select>';
$content1=cut($start,$end,$content);
$start='<option value=';
$end='</option>';
$content2=cut($start,$end,$content1);
$contents=explode('>',$content2);
$expect=trim($contents[1]);
$start='<div class="kjred" id="ssc_num">';
$end='<li class="sum">';
$content3=cut($start,$end,$content);
$content4=explode('<li>',$content3);
$opencode=getcode($content4[1]).','.getcode($content4[2]).','.getcode($content4[3]).','.getcode($content4[4]).','.getcode($content4[5]);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo '
'
?>