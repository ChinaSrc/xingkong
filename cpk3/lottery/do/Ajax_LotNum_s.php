<?php

$playkey=$_POST['playkey'];
$links=$_POST['links'];
$qihao="";
$str = file_get_contents($links);
$xmls = simplexml_load_string(iconv('gb2312','utf-8',$str));
for($i=0;$i<count($xmls);$i++){
if($xmls->row[$i]["expect"]!=""){
if($qihao==""){
$qihao=$xmls->row[$i]["expect"]."|".$xmls->row[$i]["opencode"];
}else{
$qihao=$qihao."#^#".$xmls->row[$i]["expect"]."|".$xmls->row[$i]["opencode"];
}
}
}
if($qihao!=""){$flags=$qihao;}else{$flags="1";}
echo	$flags;
ob_end_flush();

?>