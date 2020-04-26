<?php

$array=array(array('web'=>'pany'),array('net'=>array('abc'=>'domain')));
header('Content_Type:application/xml;charset=gbk');
$xml=records_to_xml($array,"agang");
echo $xml;
function records_to_xml($array,$xmlname){
$xml.='<?xml version="1.0" encoding="gbk"?>'."\n";
$xml.="<$xmlname>"."\n";
foreach($array as $key=>$value){
if(is_array($value)){
foreach($value as $k=>$v){
if(is_array($v)){
foreach($v as $kk=>$vv){
$xml.="<$k>\n<$kk>$vv</$kk>\n</$k>\n";
}
}else{
$xml.="<$k>$v</$k>\n";
}
}
}else{
$xml.="<$key>$value</$key>\n";
}
}
$xml.="</$xmlname>"."\n";
return $xml;
}

?>