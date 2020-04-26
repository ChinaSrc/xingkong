<?php

$str = file_get_contents('http://www.500wan.com/static/public/ssc/xml/newlyopen.xml');
$xmls = simplexml_load_string(iconv('gb2312','utf-8',$str));
echo '期号:'.$xmls->row[0]["expect"]."<br/>";
echo '开奖号码:'.$xmls->row[0]["opencode"]."<br/>";
echo '时间:'.$xmls->row[0]["opentime"]."<br/>";
;echo ' 
'
?>