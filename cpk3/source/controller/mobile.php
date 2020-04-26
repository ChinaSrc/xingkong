<?php

$urlarr=explode('.',$_SERVER['HTTP_HOST']);
$url='';
if(count($urlarr)>2){
    $from=1;
}
else $from=0;
for($i=$from;$i<count($urlarr);$i++){

    $url.='.'.$urlarr[$i];;
}


$tpl->assign('moblie_url','http://m'.$url);

?>