<?php


$tpl->assign("navtitle",'全部游戏');
$nowTime=date('Y-m-d H:i:s');
$game_nav1=$game_index=array();
$sql  = "select * from game_type  where `status`='0'  order by `sort` asc , id  asc  ";
$game_all = $db->fetch_all($sql);

foreach ($game_all as $key =>$value){
    $lottery=$db->exec("select * from game_lottery where playKey='{$value['ckey']}' and LotTime<='{$nowTime}' order by period desc limit 0,1 ");
    $game_all[$key]['lottery']=$lottery;
  if($value['icon1']) $game_index[]=  $game_all[$key];
  $game_nav1[$value['skey']][]= $game_all[$key];
}



$tpl->assign("game_all",$game_all);

$tpl->assign("game_index",$game_index);

$tpl->assign("game_nav1",$game_nav1);

for($i=0;$i<$con_system['banner_hall_num'];$i++){
    $banner[$i]['url']=$con_system['banner_hall_url_'.$i];
    $banner[$i]['img']=$con_system['banner_hall_img_'.$i];

}

$tpl->assign('banner',$banner);

?>