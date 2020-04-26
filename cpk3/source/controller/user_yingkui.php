<?php
if($_GET['begintime']){


	$begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
}
else $begintime=date('Y-m-d',time())." ".$search_time_arr['begin'];
if($_GET['endtime']){
$endtime=$_GET['endtime']." ".$search_time_arr['end'];
}
else $endtime=date('Y-m-d',time()+24*3600)." ".$search_time_arr['end'];
$str='';
$order=' u.userid asc';
if($_GET['order']=='login'){
   $order=" u.lastlogintime desc";
}
if($_GET['order']=='amount'){
    $order=" ub.hig_amount desc";
}

if($_GET['order']=='reg'){
    $str=" and u.registertime>='".date('Y-m-d')." 00:00:00' and u.registertime<='".date('Y-m-d')." 23:59:59'";
}


if($_GET['username']){
    $uu=$db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");
    if(is_team($uu['userid'], $_SESSION['userid']))

        $sql="select u.*,ub.hig_amount from user as u,user_bank as ub where 1=1  {$str} and u.userid=ub.userid and  u.username='{$_GET['username']}' and u.admin='0' order by {$order}";

else     $sql="select * from user where 1=2 and admin='0'";
}
else{
if($_GET['uid']) $uid=$_GET['uid'];
else $uid=$_SESSION['userid'];

    $user_ids=get_user_nextid2($_SESSION['userid']);
//    $user_ids=str_replace("'", "", $user_ids);


    if($_GET['order']=='first'){

        $user_arr = explode(',', $user_ids);

        $first_arr = $db->fetch_all('SELECT userid FROM user_funds WHERE `first` = 1 AND creatdate>=\''.date('Y-m-d').' 00:00:00\'');


        if ($first_arr) {

            foreach ($first_arr as $v) {
                $first_arr1[] = $v['userid'];
            }

            $result=array_intersect($user_arr,$first_arr1);

            $user_ids = implode(',', $result);

        }else{
            $user_ids = '';
        }


    }

    if ($user_ids) {

        $sql="select u.*,ub.hig_amount from user as u,user_bank as ub where 1=1  {$str} and u.userid=ub.userid and u.userid!='{$_SESSION['userid']}' and u.admin='0' and u.userid in ( {$user_ids} ) order by {$order}";
        $page= new Page($sql,20,$_GET['page']);
        $sql.=" limit {$page->from},20";
        $tpl->assign('page',$page->get_page());
    }else{
        $sql = '';
    }





}

if ($sql) {
    $user_list=$db->fetch_all($sql);
}else{
    $user_list = null;
}

if(count($user_list)){

    foreach ($user_list as $key=> $value) {

        $user_list[$key]['i']=$key+1;

        $yingkui=get_yingkui_new($value['userid'], $begintime, $endtime,0);
        if(count($yingkui)){

            foreach ($yingkui as $k=>$v) {
                $user_list[$key][$k]=number_format($v,3,'.','');
                $sum[$k]+= $v;
            }

        }
        $group=$db->exec("select * from user_group where id='{$value['groupid']}'");

    if ($begintime)
        $str1 .= " and creatdate>='{$begintime}'";
    if ($endtime)
        $str1 .= " and creatdate<='{$endtime}'";

        $recharge_row = $db->fetch_first ( "SELECT SUM(money) as sum FROM `user_funds` WHERE 1=1 {$str1} AND `cate` = 'recharge' AND `status` = 1  AND `type` = 'chat' and userid in ({$value['userid']}) " );

        $user_list[$key]['recharge_chat']=$recharge_row['sum'] ? $recharge_row['sum'] : '0.00' ;

        $user_list[$key]['grouptitle']=$group['title'];
    }

}





$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
$tpl->assign("begin",$begin);
$tpl->assign("end",$end);
$tpl->assign("user_list",$user_list);
$tpl->assign('time_arr',array(date('Y-m-d',time()+3600*24),date('Y-m-d',time()),date('Y-m-d',time()-3600*24),date('Y-m-d',time()-3600*24*7)));
$tpl->assign("navtitle",'下级报表');
?>