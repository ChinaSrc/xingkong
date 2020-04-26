<?php

ob_start();
$xml=new XMLReader();
$xml->open('http://ssc.vodone.com/luckynumber/newsscnumbernew.xml');
while($xml->read()){
switch($xml->nodeType){
case 3:
$data[]=trim($xml->value);
}
}
$expect=$data[0];
$opencode=$data[1].','.$data[2].','.$data[3].','.$data[4].','.$data[5];
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
?>