<?php

$f = fopen( 'http://ssc.vodone.com/luckynumber/newsscnumbernew.xml','r');
while( $data = fread( $f,4096 ) )
{
$parser = xml_parser_create();
xml_parse_into_struct($parser,$data,$values,$index);
xml_parser_free($parser);
print_r($values);
}

?>