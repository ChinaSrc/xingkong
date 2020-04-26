<?php

$uid = isset($_POST[uid]) ? $_POST[uid] : $_GET[uid];
if($uid-1>=0){
	$bull_news=getsql::bulletin("title,content,creatdate","where id='$uid'");
	$tpl->assign("bull_news",$bull_news); 
}
$bul_party=SZS_ROOT_PATH."source/config/play/bul_party.aspx";
if (file_exists($bul_party)){
	include($bul_party);
	$tpl->assign("bul_arr_party",$bul_arr_party);
}
$tpl->assign("con_game_list",$con_game_list);
?>