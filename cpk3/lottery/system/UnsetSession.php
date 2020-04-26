<?php
 
include(ROOT_PATH."/source/function/run.php");
include(ROOT_PATH."/source/function/core.do.fun.php");
$mypath=ROOT_PATH."data/compile/";
if ($dir = opendir($mypath)) {
while (($file_name = readdir($dir)) !== false){
if(strlen($file_name)-10>0){
unlink($mypath.$file_name);
}
}
}
$mypath=ROOT_PATH."data/cache/";
if ($dir = opendir($mypath)) {
while (($file_name = readdir($dir)) !== false){
if(strlen($file_name)-10>0){
unlink($mypath.$file_name);
}
}
}

$ArrGameTime=Arr_File::ArrGameTime();
$ArrGames=Arr_File::ArrGames();
$ArrCodes=Arr_File::ArrCodes();
$ArrCodeList=Arr_File::ArrCodeList();
$ArrSystems=Arr_File::ArrSystems();
//update_kaijiang();
echo "<div style='width:100%;height:50px;line-height:50px;text-align:center;font-size:16px;'>缓存已清理成功，正在返回...</div>";
 echo "<script>setTimeout(\"history.back()\",1000)</script>";

?>