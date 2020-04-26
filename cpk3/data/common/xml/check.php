<?php
echo '﻿ ';
$xml_parser = xml_parser_create();
xml_parser_set_option($xml_parser,XML_OPTION_CASE_FOLDING,true);
$xmlfile = "http://127.0.0.2/data/common/xml/xjssc.aspx";
if (!($fp = fopen($xmlfile,"r")))
{
die("无法读取XML文件$xmlfile");
}
$has_error = false;
while ($data = fread($fp,4096))
{
if (!xml_parse($xml_parser,$data,feof($fp)))
{
$has_error = true;
break;
}
}
if($has_error)
{
echo "该XML文档是错误的！<br />";
$error_line   = xml_get_current_line_number($xml_parser);
$error_row   = xml_get_current_column_number($xml_parser);
$error_string = xml_error_string(xml_get_error_code($xml_parser));
$message = sprintf("［第%d行，%d列］：%s",
$error_line,
$error_row,
$error_string);
echo $message;
}
else
{
echo "该XML文档是结构良好的。";
}
xml_parser_free($xml_parser);

?>