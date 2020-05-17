<?php

$group_list=$db->fetch_all("select * from user_group where sys=0 order by score asc ");

$tpl->assign('group_list',$group_list);
$min_group=$db->exec("select * from user_group where id='{$con_system['active_day_group']}'");
$tpl->assign('min_group',$min_group);

$day_group=$db->fetch_all("select * from user_group where score>='{$min_group['score']}' and sys='0' order by score asc ");
$tpl->assign('day_group',$day_group);
if($_SESSION['userid']){

    $user_group=$db->exec("select * from user_group where id='{$userinfo['groupid']}' and sys='0'");

    $tpl->assign('user_group',$user_group);


    $user_group1=$db->exec("select * from user_group where id='{$userinfo['groupid1']}'");
    $row=$db->exec("select sum(prize) as  sum from user_group where score<={$userinfo['score']} and score>=$user_group1[score] ");

    $prize=$row['sum']-$user_group1['prize'];
    if($prize<0) $prize=0;
    $tpl->assign('group_prize',$prize);

    $yingkui=get_yingkui($_SESSION['userid'],date('Y-m-d',time()-24*3600).' 00:00:00',date('Y-m-d',time()-24*3600).' 23:59:58');
    $tpl->assign('yestday_buy',$yingkui['buy']);



    $pre=0;
    if($user_group['id']>=$min_group['id']){
        if($yingkui['buy']>=100) {

            $pre=$con_system['active_day_0_'.$user_group['id']];
        }
        if($yingkui['buy']>=10000) {

            $pre=$con_system['active_day_1_'.$user_group['id']];
        }
        if($yingkui['buy']>=200000) {

            $pre=$con_system['active_day_2_'.$user_group['id']];
        }
    }
    $tpl->assign('day_pre',$pre);
    $tpl->assign('day_prize',$yingkui['buy']*$pre/100);
    $from=strtotime(date('Y-m-d',time()).' 00:00:00');
    $row=$db->exec("select * from active where userid='{$_SESSION['userid']}' and time>'{$from}' and  type='day'");
    if($row){

        $tpl->assign('day_isget',1);
    }

}

else{



}

$cate=3;


$list=$db->fetch_all("select * from news where cate='{$cate}' order by sort asc, id asc ");


$tpl->assign('list',$list);

$tpl->assign('navtitle','活动');

?>