<?php

$dom=new DomDocument("1.0");
$dom->load("http://www.500wan.com/static/public/ssc/xml/newlyopen.xml");
echo $dom->documentElement->tagName."<br>";
echo "<hr>";
getNodes();
function getNodes(){
global $dom;
foreach ($dom->documentElement->childNodes as $node) {
$nodeName=$node->nodeName;
if($nodeName!="#text"){
echo $nodeName."<br>";
if($node->hasChildNodes()){
getChildren($node);
}
echo "/".$nodeName."<br>";
echo "<hr>";
}
}
}
function getChildren($node){
foreach ($node->childNodes as $children) {
if($children->nodeName!="#text"){
echo $children->nodeName."<br>";
getChildren($children);
echo "/".$children->nodeName."<br>";
}else{
if(strlen(trim($children->nodeValue))>0){
echo "[".trim($children->nodeValue)."]<br>";
}
}
}
}
echo "/".$dom->documentElement->tagName;

?>