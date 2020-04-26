<?php

$xml=new XMLReader();
$xml->open('http://ssc.vodone.com/luckynumber/newsscnumbernew.xml');
while($xml->read()){
switch($xml->nodeType){
case 3:
$data[]=trim($xml->value);
}
}
$opencode=$data[1].','.$data[2].','.$data[3].','.$data[4].','.$data[5];
echo $opencode;
print_r($data);

?>