<?php

$xml=new XMLReader();
$xml->open('http://trade.500wan.com/static/public/ssc/xml/newlyopenlist.xml');
while($xml->read()){
switch($xml->nodeType){
case 3:
$data[]=trim($xml->value);
}
}
$opencode=$data[1].','.$data[2].','.$data[3].','.$data[4].','.$data[5];
$array=array('expect'=>$data[0],'opencode'=>$opencode);
header('Content_Type:application/xml;charset=gbk');
$xml=records_to_xml($array,"xml");
echo $xml;
function records_to_xml($array,$xmlname){
$xml.='<?xml version="1.0" encoding="gbk"?>'."\n";
$xml.="<$xmlname>"."\n";
foreach($array as $key=>$value){
if($key=='expect'){
$xml.="<row $key= \"$value\"";
}else{
$xml.= " $key= \"$value\"";
}
}
$xml.= " /></$xmlname>"."\n";
return $xml;
}

?>