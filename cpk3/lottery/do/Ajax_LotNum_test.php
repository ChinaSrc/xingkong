<?php

require_once('connect_lot.php');
header("content-type:text/html; charset=utf-8");
$playkey=$_POST['playkey'];
$links=$_POST['links'];
$qihao="";
$links="http://www.cailele.com/static/11yun/newlyopenlist.xml";
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