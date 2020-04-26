<?php
 
function dodir($dir) {
$dh=opendir($dir);
while ($file=readdir($dh)) {
if($file!="."&&$file!="..") {
$fullpath=$dir."/".$file;
if(!is_dir($fullpath)) {
unlink($fullpath);
}else {
dodir($fullpath);
}
}
}
closedir($dh);
if(rmdir($dir)) {
return true;
}else {
return false;
}
}
$id=$_GET["mod"];
$real_dir='abc/';
dodir($real_dir) 
?>