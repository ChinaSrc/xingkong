<?php

$type=$_GET['type'];
if(!$type) $type='ssc';
if($type=='pk10' or $type=='kl8')
    $sql="select * from game_code where type='{$type}'  order by  sortnum asc,id asc";
else
    $sql="select * from game_code where type='{$type}' and ckey not like '%QW%' order by  sortnum asc,id asc";

$game_code=$db->fetch_all($sql);

$tpl->assign('arr_game_code',$arr_game_code);

foreach ($game_code as $key=>$value) {
$sum=0;
    $temp = $db->fetch_all("select CodeTile as title,count(*) as num  from game_code_list where CodeKey='{$value['ckey']}' group by CodeTile order by OrderS asc   ");
if(count($temp)>0){
foreach ($temp as $key2=>$value2){
 $sum+=$value2['num']  ;
$game_code[$key]['num']   =$sum;

    $ssclist[$key][$key2]=   $db->fetch_all("select gc.ShowTile as title,gs.content,gs.example ,gs.help from game_code_list gc, game_ssc_list gs where gs.skey=gc.ListKey  and 	 gc.CodeKey='{$value['ckey']}' and gc.CodeTile='{$value2['title']}' order by gc.OrderS asc   ");


}
    $codelist[$key]=$temp;
}
else unset($game_code[$key]);
}
$cate=$db->fetch_all("select * from news_cate where  id>0 order by pid asc,`sort` asc");


foreach ($cate as $value) {
    $cate_list[$value[pid]][]=$value;
}

$tpl->assign('cate_list',$cate_list);

$tpl->assign("navtitle",'玩法介绍');
$tpl->assign('game_code',$game_code);
$tpl->assign('codelist',$codelist);
$tpl->assign('ssclist',$ssclist);
