<?php

ob_start();
function request_url($url,$method='POST') {
$url = parse_url($url);
if (!$url) return "couldn't parse url";
if (!isset($url['port'])) {$url['port'] = "";}
if (!isset($url['query'])) {$url['query'] = "";}
$fp = fsockopen($url['host'],$url['port'] ?$url['port'] : 80);
if (!$fp) return "不能连接".$url['host']."服务器";
fputs($fp,sprintf("$method %s%s%s HTTP/1.0\n",$url['path'],$url['query'] ?"?": "",$url['query']));
fputs($fp,"Host: $url[host]\n");
fputs($fp,"Content-type: application/x-www-form-urlencoded\n");
fputs($fp,"Connection: close\n\n");
$line = fgets($fp,1024);
if (!eregi("^HTTP/1\.. 200",$line)) return;
$results = "";
while(!feof($fp)) {
$line = fgets($fp,1024);
$results .= $line;
}
fclose($fp);
return $results;
}
function cut($start,$end,$file){
$content=explode($start,$file);
$content=explode($end,$content[1]);
return  $content[0];
}
$url='http://www.okooo.com/caipiaokaijiang/';
$content=request_url($url);
$content=strtolower($content);
$start='/fastlottery/ssc';
$end='<div class="lottime">10分钟一期，大奖11.6万';
$content=cut($start,$end,$content);
$start='>第';
$end='期开奖号码';
$expect=cut($start,$end,$content);
$start='</a>';
$end='</div>';
$content=cut($start,$end,$content);
$opencode=trim(eregi_replace("[^0-9]","",$content));
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect ".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo '
';
?>