<?php
 
$xmls = simplexml_load_file("/data/common/xml/xml.php");
echo '�ں�:'.$xmls->row[0]["expect"]."<br/>";
echo '��������:'.$xmls->row[0]["opencode"]."<br/>";
;echo ' 
'
?>