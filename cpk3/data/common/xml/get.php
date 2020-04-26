<?php
 
$xmls = simplexml_load_file("/data/common/xml/xml.php");
echo 'ÆÚºÅ:'.$xmls->row[0]["expect"]."<br/>";
echo '¿ª½±ºÅÂë:'.$xmls->row[0]["opencode"]."<br/>";
;echo ' 
'
?>