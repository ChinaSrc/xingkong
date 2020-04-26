<?php

$xml=xml_parser_create('UTF-8');
xml_set_element_handler($xml,'start_tag','end_tag');
xml_set_character_data_handler($xml,'content');
xml_parse($xml,file_get_contents('http://trade.500wan.com/static/public/ssc/xml/newlyopenlist.xml'));
function start_tag($xml,$tag,$attributes){
echo "$tag<br>";
foreach($attributes as $key=>$value){
echo "$key='$value'";
}
}
function end_tag($xml,$tag){
echo "/$tag<br>";
}
function content($xml,$data){
if (strlen(trim($data))>0) {
foreach (split("\n",$data) as $line){
echo "[".$line."]";
}
echo "<br>";
}
}

?>