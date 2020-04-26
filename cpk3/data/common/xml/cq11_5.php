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
$url='http://data.starlott.com/cq11x5/jb.html';
$content=file_get_contents($url);
$contents=explode('onclick=\"overClass(',$content);
$n=count($contents)-1;
$content1=$contents[$n];
$content3=explode('<\/td>',$content1);
$content31= $content3[1];
$content32= $content3[2];
$a=explode('<td height=\"24\" class=\"   btitle\">',$content31);
$expect=$a[1];
$b=explode('<td height=\"24\" class=\"   kjh\">',$content32);
$opencode=trim($b[1]);
$opencode=str_replace("&nbsp;",",",$opencode);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo '
'
?>