<?php
 
session_start();

$type = 'gif';
$width= 60;
$height= 20;
header("Content-type: image/".$type);
srand((double)microtime()*1000000);
$randval = randStr(4,"");
if($type!='gif'&&function_exists('imagecreatetruecolor')){
$im = @imagecreatetruecolor($width,$height);
}else{
$im = @imagecreate($width,$height);
}
$r = Array(225,211,255,223);
$g = Array(225,236,237,215);
$b = Array(225,236,166,125);
$key = rand(0,3);
$backColor = ImageColorAllocate($im,$r[$key],$g[$key],$b[$key]);
$borderColor = ImageColorAllocate($im,0,0,0);
$pointColor = ImageColorAllocate($im,255,170,255);
@imagefilledrectangle($im,0,0,$width -1,$height -1,$backColor);
@imagerectangle($im,0,0,$width-1,$height-1,"");
$stringColor = ImageColorAllocate($im,555,51,153);
for($i=0;$i<=100;$i++){
$pointX = rand(2,$width-2);
$pointY = rand(2,$height-2);
@imagesetpixel($im,$pointX,$pointY,$pointColor);
}
@imagestring($im,10,10,2,$randval,$stringColor);
$ImageFun='Image'.$type;
$ImageFun($im);
@ImageDestroy($im);
$_SESSION['validationcode'] = $randval;
function randStr($len=6,$format='NUMBER') {
switch($format) {
case 'ALL':
$chars='0123456789';break;
case 'CHAR':
$chars='';break;
case 'NUMBER':
$chars='0123456789';break;
default :
$chars='0123456789';
break;
}
$string="";
while(strlen($string)<$len)
$string.=substr($chars,(mt_rand()%strlen($chars)),1);
return $string;
}
;echo ' ';
?>