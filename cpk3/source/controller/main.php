<?php


//彩票种类

$nowTime=date('Y-m-d H:i:s');
$sql  = "select * from game_type  where `status`='0' and icon1='1' order by `sort` asc , id  asc  ";
$game_index = $db->fetch_all($sql);
foreach ($game_index as $key =>$value){
$lottery=$db->exec("select * from game_lottery where playKey='{$value['ckey']}' and LotTime<='{$nowTime}' order by period desc limit 0,1 ");
    $game_index[$key]['lottery']=$lottery;

}

$tpl->assign("game_index",$game_index);
$tpl->assign("index",1);


$lottery_list=$db->fetch_all("select * from game_lottery where playKey in (select ckey from game_type where status='0') and LotTime<='{$nowTime}' order by id desc limit 0,5 ");
foreach ($lottery_list as $key=>$value){

    $game=$db->exec("select * from game_type where ckey='{$value['playKey']}'");
    $lottery_list[$key]['fullname']=$game['fullname'];
    $lottery_list[$key]['gameid']=$game['id'];
    $lottery_list[$key]['number']=explode(',',$value['Number']);
}
$tpl->assign("lottery_list",$lottery_list);

if($_SESSION['loginnote']==1){
	$tpl->assign('loginnote',1);
	
	$_SESSION['loginnote']='';
}

//baanner
for($i=0;$i<$con_system['banner_num'];$i++){
	$banner[$i]['url']=$con_system['banner_url_'.$i];
	$banner[$i]['img']=$con_system['banner_img_'.$i];	
	
}

$tpl->assign('banner',$banner);



$game_index=$db->fetch_all("select * from game_type where skey='k3' and show_index='1' order by sort asc limit 0,3 ");
$tpl->assign('game_index1',$game_index);
?>