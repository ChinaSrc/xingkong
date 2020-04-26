<?php


$sql  = "select * from game_type  where `status`='0' and ckey!='MMSSC' order by `sort` asc , id  asc  ";
$game_list2 = $db->fetch_all($sql);
foreach ($game_list2 as $key =>$value){
	$now=date("H:i:s");
$nowtime=date('Y-m-d H:i:s',time());
	$tt=$db->fetch_first("select Number,period from game_lottery where playKey='{$value['ckey']}' and lotTime<='{$nowtime}'  order by period desc limit 0,1");



	$number=explode(',', $tt['Number']);
	$str='<ul>';
	foreach ($number as $k1=>$v1){

		if($k1<10)
		$str.="<li><span>{$v1}</span></li>";


	}

	$str.="</ul>";


	$game_list2[$key]['number']=$str;
	$game_list2[$key]['period']=$tt['period'];
	$lotTime=$tt['LotTime'];

	$game_list2[$key]['lotTime']=$tt['LotTime'];

	$firstcode=$value['firstcode'];
	$firstcode=explode('|', $firstcode);
$code=	$db->exec("select * from game_code where ckey='{$firstcode[0]}'");
	$game_list2[$key]['firstcode']=$code['fullname'];


}
$tpl->assign("game_list",$game_list2);

$tpl->assign("navtitle",'游戏大厅');
?>