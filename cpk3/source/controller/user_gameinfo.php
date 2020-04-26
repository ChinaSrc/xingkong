<?php

$uid=$_GET['id'];
$game_info_sql = "select b.*,u.username,g.fullname as playname,g.skey,l.fullname as wanfa,l.cate as wancode,l.help from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as g,".DB_PREFIX."game_ssc_list as l where (b.id='$uid' or b.buyid='$uid') and b.list_id=l.skey and g.ckey=b.playkey and u.userid=b.userid";

$game_info	= $db->fetch_first($game_info_sql);

if($game_info['skey']=='k3' and $game_info[pri_number]!=''){

    $num=explode(',', $game_info[pri_number]);
    $sum=0;
    foreach ($num as $value){
        $sum+=$value;
    }

    if($sum>10) $dx='大';else $dx='小';
    if($sum%2==1) $ds='单';else  $ds='双';
    $game_info[pri_number].="<div id='J-lottery-info-status'><span>{$dx}</span> <span>{$ds}</span> <span>和值:{$sum}</span> </div>";
}



if($_SESSION['userid']==$game_info['userid'] and time()<$game_info['endtime'] and $game_info['status']=='0'){

	$game_info['back']=1;

}
if($game_info['id']  and $game_info['is_zuih']=='yes')$zz=$game_info['id'];
if($zz){
	$game_info['list']=$db->fetch_all("select * from game_buylist where z_number='$zz' or id='$zz' order by period asc");

	
	if(count($game_info['list'])>0){
		
		
		foreach ($game_info['list'] as $key=> $value) {
			
if($_SESSION['userid']==$value['userid'] and time()<$value['endtime'] and $value['status']=='0'){
		$this_url="do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&uid=".$value[id];
		$game_info['list'][$key]['back']="<a href='{$this_url}'>撤单</a>";
		}
		
	}
	
	}
	
	
}
	
	
$game_info['buyid']=substr($game_info['buyid'],0,25);
$tpl->assign('game_info',$game_info);

$tpl->assign('navtitle','投注详情');
?>
