<?php

$dom=new DomDocument("1.0");
$root=$dom->createElement("config");
$title=$dom->createElement("title");
$chinabankkey=$dom->createElement("chinabankkey");
$chinabankmid=$dom->createElement("chinabankmid");
$titleText=$dom->createTextNode("config");
$chinabankkeyText=$dom->createTextNode("614672c484b4f9ee0280a3df728cdf09");
$chinabankmidyText=$dom->createTextNode("21169103");
$root=$dom->appendChild($root);
$title=$root->appendChild($title);
$chinabankkey=$root->appendChild($chinabankkey);
$chinabankmid=$root->appendChild($chinabankmid);
$title->appendChild($titleText);
$chinabankkey->appendChild($chinabankkeyText);
$chinabankmid->appendChild($chinabankmidyText);
$dom->save("domCreate.xml");
?>