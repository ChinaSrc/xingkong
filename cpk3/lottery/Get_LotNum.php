<?php

$playkey=$_GET['playkey'];
$links=$_GET['links'];
$qihao="";
echo "<div style='font-size:12px;'>开始解析地址：".$links."</div><br>";
try{

$str = file_get_contents($links);

if(strpos($links, '360')!==false) {
	if(strpos($links, 'kl8')!==false)
	$str=from_360_kl8($str);
	else if(strpos($links, 'p3')!==false or strpos($links, 'sd')!==false)
		$str=from_360_3d($str);
	else
	$str=from_360($str);
}




$xmls = simplexml_load_string(iconv('gb2312','utf-8',$str));

if($xmls->row[0]["expect"]!=""){
$qihao="期号：".$xmls->row[0]["expect"]."#开奖号码".$xmls->row[0]["opencode"]."<br>";
 get_lotdata($playkey,$links);
}
if($qihao!=""){$flags=$qihao;}

}
catch(Exception $e)
{
$flags="获取出错";
}
echo "<div style='font-size:12px;'>".$flags."</div>";
?>