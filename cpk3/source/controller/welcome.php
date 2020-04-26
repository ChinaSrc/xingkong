<?php
require_once './source/function/getIP.php';


$ipinfor = getIP();
$text_infor=Core_Fun::ipCity($ipinfor);
$Adress=iconv("GB2312","UTF-8",$text_infor);

$tpl->assign('ip',$ipinfor);
$tpl->assign('address',$Adress);

$sys_info=$rowss=getsql::sys();
$num=0;
for($i=0;$i<100;$i++){
if($sys_info['url_'.$i]){
	$num++;


$str.="autourl[{$num}]=\"{$sys_info['url_'.$i]}\"\n" .
		"";


}


}

$tpl->assign('url',$str);
?>

