<?php

if(!defined('IN_PHPOE')) {
exit('Access Denied');
}
class Core_Image{
protected static $config = array();
public static function makethumb($srcfile,$channel="",$thumbwidth=0,$thumbheight=0) {
self::$config = $GLOBALS['config'];
if (!file_exists($srcfile)) {
return '';
}
$dstfile = $srcfile.'.thumb.jpg';
if((int)$thumbwidth>0 &&(int)$thumbheight>0){
$tow = intval($thumbwidth);
$toh = intval($thumbheight);
}else{
switch($channel){
case "product";
$tow = intval(self::$config['productthumbwidth']);
$toh = intval(self::$config['productthumbheight']);
break;
case "case";
$tow = intval(self::$config['casethumbwidth']);
$toh = intval(self::$config['casethumbheight']);
break;
case "solution";
$tow = intval(self::$config['solutionthumbwidth']);
$toh = intval(self::$config['solutionthumbheight']);
break;
default;
$tow = intval(self::$config['thumbwidth']);
$toh = intval(self::$config['thumbheight']);
break;
}
}
if($tow <60) $tow = 60;
if($toh <60) $toh = 60;
$make_max = 0;
$maxtow = intval(self::$config['maxthumbwidth']);
$maxtoh = intval(self::$config['maxthumbheight']);
if($maxtow >= 300 &&$maxtoh >= 300) {
$make_max = 1;
}
$im = '';
if($data = getimagesize($srcfile)) {
if($data[2] == 1) {
$make_max = 0;
if(function_exists("imagecreatefromgif")) {
$im = imagecreatefromgif($srcfile);
}
}elseif($data[2] == 2) {
if(function_exists("imagecreatefromjpeg")) {
$im = imagecreatefromjpeg($srcfile);
}
}elseif($data[2] == 3) {
if(function_exists("imagecreatefrompng")) {
$im = imagecreatefrompng($srcfile);
}
}
}
if(!$im) return '';
$srcw = imagesx($im);
$srch = imagesy($im);
$towh = $tow/$toh;
$srcwh = $srcw/$srch;
if($towh <= $srcwh){
$ftow = $tow;
$ftoh = $ftow*($srch/$srcw);
$fmaxtow = $maxtow;
$fmaxtoh = $fmaxtow*($srch/$srcw);
}else {
$ftoh = $toh;
$ftow = $ftoh*($srcw/$srch);
$fmaxtoh = $maxtoh;
$fmaxtow = $fmaxtoh*($srcw/$srch);
}
if($srcw <= $maxtow &&$srch <= $maxtoh) {
$make_max = 0;
}
if($srcw >$tow ||$srch >$toh) {
if(function_exists("imagecreatetruecolor") &&function_exists("imagecopyresampled") &&@$ni = imagecreatetruecolor($ftow,$ftoh)) {
imagecopyresampled($ni,$im,0,0,0,0,$ftow,$ftoh,$srcw,$srch);
if($make_max &&@$maxni = imagecreatetruecolor($fmaxtow,$fmaxtoh)) {
imagecopyresampled($maxni,$im,0,0,0,0,$fmaxtow,$fmaxtoh,$srcw,$srch);
}
}elseif(function_exists("imagecreate") &&function_exists("imagecopyresized") &&@$ni = imagecreate($ftow,$ftoh)) {
imagecopyresized($ni,$im,0,0,0,0,$ftow,$ftoh,$srcw,$srch);
if($make_max &&@$maxni = imagecreate($fmaxtow,$fmaxtoh)) {
imagecopyresized($maxni,$im,0,0,0,0,$fmaxtow,$fmaxtoh,$srcw,$srch);
}
}else {
return '';
}
if(function_exists('imagejpeg')) {
imagejpeg($ni,$dstfile);
if($make_max) {
imagejpeg($maxni,$srcfile);
}
}elseif(function_exists('imagepng')) {
imagepng($ni,$dstfile);
if($make_max) {
imagepng($maxni,$srcfile);
}
}
imagedestroy($ni);
if($make_max) {
imagedestroy($maxni);
}
}
imagedestroy($im);
if(!file_exists($dstfile)) {
return '';
}else {
return $dstfile;
}
}
public static function makewatermark($srcfile) {
self::$config = $GLOBALS['config'];
$watermarkfile = empty(self::$config['watermarkfile'])?CHENCY_ROOT.'./tpl/static/images/watermark.png':CHENCY_ROOT."./".self::$config['watermarkfile'];
if(!file_exists($watermarkfile) ||!$water_info = getimagesize($watermarkfile)) {
return '';
}
$water_w = $water_info[0];
$water_h = $water_info[1];
$water_im = '';
switch($water_info[2]) {
case 1:@$water_im = imagecreatefromgif($watermarkfile);break;
case 2:@$water_im = imagecreatefromjpeg($watermarkfile);break;
case 3:@$water_im = imagecreatefrompng($watermarkfile);break;
default:break;
}
if(empty($water_im)) {
return '';
}
if(!file_exists($srcfile) ||!$src_info = getimagesize($srcfile)) {
return '';
}
$src_w = $src_info[0];
$src_h = $src_info[1];
$src_im = '';
switch($src_info[2]) {
case 1:
$fp = fopen($srcfile,'rb');
$filecontent = fread($fp,filesize($srcfile));
fclose($fp);
if(strpos($filecontent,'NETSCAPE2.0') === FALSE) {
@$src_im = imagecreatefromgif($srcfile);
}
break;
case 2:@$src_im = imagecreatefromjpeg($srcfile);break;
case 3:@$src_im = imagecreatefrompng($srcfile);break;
default:break;
}
if(empty($src_im)) {
return '';
}
if(($src_w <$water_w +150) ||($src_h <$water_h +150)) {
return '';
}
switch(self::$config['watermarkpos']) {
case 1:
$posx = 0;
$posy = 0;
break;
case 2:
$posx = $src_w -$water_w;
$posy = 0;
break;
case 3:
$posx = 0;
$posy = $src_h -$water_h;
break;
case 4:
$posx = $src_w -$water_w;
$posy = $src_h -$water_h;
break;
default:
$posx = mt_rand(0,($src_w -$water_w));
$posy = mt_rand(0,($src_h -$water_h));
break;
}
@imagealphablending($src_im,true);
@imagecopy($src_im,$water_im,$posx,$posy,0,0,$water_w,$water_h);
switch($src_info[2]) {
case 1:@imagegif($src_im,$srcfile);break;
case 2:@imagejpeg($src_im,$srcfile);break;
case 3:@imagepng($src_im,$srcfile);break;
default:return '';
}
@imagedestroy($water_im);
@imagedestroy($src_im);
}
}

?>