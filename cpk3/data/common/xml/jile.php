<?php

$xmlfile = "http://121.14.142.220:81/jl.xml";
$xmls = simplexml_load_file($xmlfile);
$xml = new DOMDocument('1.0','utf-8');
$dom->formatOutput = true;
$xml->load($xmlfile);
$root = $xml->documentElement;
$nodes = $root->getElementsByTagName("row");
$lengths = $nodes->length-1;
$expect=$xmls->row[$lengths]["expect"];
$opencode=$xmls->row[$lengths]["opencode"];
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" /></xml>';
ob_end_flush();
;echo ' 

';
?>