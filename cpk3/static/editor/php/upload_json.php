<?php

require_once 'JSON.php';
$save_path = '../../editor/attached/';
$save_url = '../editor/attached/';
$ext_arr = array('gif','jpg','jpeg','png','bmp');
$max_size = 1000000;
if (empty($_FILES) === false) {
$file_name = $_FILES['imgFile']['name'];
$tmp_name = $_FILES['imgFile']['tmp_name'];
$file_size = $_FILES['imgFile']['size'];
if (!$file_name) {
alert("请选择文件。");
}
if (@is_dir($save_path) === false) {
alert("上传目录不存在。");
}
if (@is_writable($save_path) === false) {
alert("上传目录没有写权限。");
}
if (@is_uploaded_file($tmp_name) === false) {
alert("临时文件可能不是上传文件。");
}
if ($file_size >$max_size) {
alert("上传文件大小超过限制。");
}
$temp_arr = explode(".",$file_name);
$file_ext = array_pop($temp_arr);
$file_ext = trim($file_ext);
$file_ext = strtolower($file_ext);
if (in_array($file_ext,$ext_arr) === false) {
alert("上传文件扩展名是不允许的扩展名。");
}
$new_file_name = date("YmdHis") .'_'.rand(10000,99999) .'.'.$file_ext;
$file_path = $save_path .$new_file_name;
if (move_uploaded_file($tmp_name,$file_path) === false) {
alert("上传文件失败。");
}
@chmod($file_path,0644);
$file_url = $save_url .$new_file_name;
header('Content-type: text/html; charset=UTF-8');
$json = new Services_JSON();
echo $json->encode(array('error'=>0,'url'=>$file_url));
exit;
}
function alert($msg) {
header('Content-type: text/html; charset=UTF-8');
$json = new Services_JSON();
echo $json->encode(array('error'=>1,'message'=>$msg));
exit;
}

?>