<?php
$today=get_day_time();
if($_GET['begintime']){
    $begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
}
else $begintime=$today[0];
if($_GET['endtime']){
    $endtime=$_GET['endtime']." ".$search_time_arr['end'];
}
else $endtime=$today[1];
$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
$tpl->assign('begin',$begin);
$tpl->assign('end',$end);

$from=strtotime($begintime);
$to=strtotime($endtime);
$sql="select sum(money) as sum from user_fandian_log where uid='{$_SESSION['userid']}' and time BETWEEN '{$from}' AND '{$to}'";
$row=$db->exec($sql);
if(!$row['sum']) $row['sum']='0.00';
$tpl->assign('sum',number_format($row['sum'],2,'.',''));

$sql="select * from user_fandian_log where uid='{$_SESSION['userid']}' and time BETWEEN '{$from}' AND '{$to}'  order by id desc";

$page=new Page($sql,20,$_GET['page']);

$sql.=" limit $page->from ,20";
$list=$db->fetch_all($sql);
if(count($list)>0){
    foreach ($list as $key=>$value){


        $list[$key]['user']=get_user_info($value['fromid']);
    }


}

$tpl->assign('list',$list);
$tpl->assign('page',$page->get_page());

$tpl->assign('navtitle','返点明细');




?>