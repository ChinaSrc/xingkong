<?php


$uid=$_POST['uid'];
if(!$_POST['username']){

    $uid=$_SESSION['userid'];
}
else{


    $user=$db->exec("select userid from user where username='{$_POST['username']}'");
  	if(!is_team($user['userid'], $_SESSION['userid'])){
      //echo 11111;
      $uid=$_SESSION['userid'];
    }else{
      $uid=$user['userid'];
    }
  
    



}


$user_list=$db->fetch_all("select * from user where userid='{$uid}' or higherid='{$uid}' order by userid asc");
if($_POST['begintime']){
	$begintime=$_POST['begintime'].' 00:00:00' ;
}
else $begintime=date('Y-m-d').' 00:00:00';
if($_POST['endtime']){
$endtime=$_POST['endtime'].' 23:59:59';
}
else $endtime=date('Y-m-d',time()+24*3600).' 23:59:59';
$user=$db->exec("select `userid` from user where userid='{$uid}'");

$next_list = get_user_nextid2($user['userid']);
//var_dump($next_list);exit;
//$yingkui=get_yingkui($uid, $begintime, $endtime,1 );
//$yingkui1=get_yingkui($uid, $begintime, $endtime,0);

$yingkui=get_yingkui_new($uid, $begintime, $endtime,1, 0, $next_list);
$yingkui1=get_yingkui_new($uid, $begintime, $endtime,0, 0, $next_list);

foreach ($yingkui as $key1=>$value1){
    $yingkui[$key1]=$value1-$yingkui1[$key1];
}




//     $team=get_team_info($uid);
	$team = get_team_info2($next_list);
$tpl->assign('user',$user);
$tpl->assign('team',$team);
$tpl->assign('yingkui',$yingkui);

$tpl->assign('yingkui1',$yingkui1);
$begin=substr($begintime,0,10);
$end=substr($endtime,0,10);
$tpl->assign("begin",$begin);
$tpl->assign("end",$end);



$time_arr[0]=array('begin'=>date('Y-m-d'),'end'=>date('Y-m-d',time()));
$time_arr[1]=array('begin'=>date('Y-m-d',time()-24*3600),'end'=>date('Y-m-d',time()-24*3600));
$time_arr[2]=array('begin'=>date('Y-m-d',time()-6*24*3600),'end'=>date('Y-m-d',time()));
$time_arr[3]=array('begin'=>date('Y-m').'-01','end'=>date('Y-m-d',time()));
$tpl->assign("time_arr",$time_arr);
//  $next_list=get_user_nextid($uid);
if($next_list) {
	$row=$db->exec("select count(*) as num from user where registertime >= '{$begintime}' and registertime<='{$endtime}' and higherid in ($next_list)");
	$tpl->assign("reg_num",$row['num']);

	$row=$db->fetch_all("select DISTINCT userid from user_funds where creatdate >= '{$begintime}'  and creatdate<='{$endtime}' and cate='recharge' and  userid in ($next_list) ");
	$tpl->assign("recharge_num",count($row));

	$row=$db->fetch_all("select DISTINCT userid from user_funds where creatdate >= '{$begintime}'  and creatdate<='{$endtime}' and `first`=1 and cate='recharge' and  userid in ($next_list) ");
	$tpl->assign("frist_recharge",count($row));


	$row1 = $db->fetch_all ( "select DISTINCT  userid from game_buylist where creatdate>'{$begintime}' and creatdate<='{$endtime}'  and is_succeed='yes'   and (status='1' or status='2' or status='3') and userid in ({$next_list}) " );
	$tpl->assign("buy_num",count($row1));
} else {
	$tpl->assign("reg_num",0);
	$tpl->assign("recharge_num",0);
	$tpl->assign("frist_recharge",0);
	$tpl->assign("buy_num",0);
}




$tpl->assign("navtitle",'团队报表');

?>