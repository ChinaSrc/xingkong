<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/9
 * Time: 8:49
 */

if($_GET['type']=='list' and $_GET['playkey']  and $_GET['top']){
$return =array();
if($_GET['playkey']=="MMSSC"){
    $str=" and uid='{$_SESSION['userid']}'";
}
else $str='';
    include_once "source/config/play/lot_time_".$_GET['playkey'].".php";
    $temp=get_now_period($_GET['playkey'],$time_arr);
$sql="select * from game_lottery where playKey='{$_GET['playkey']}' and period<'{$temp['period']}' {$str} order by period desc,id desc limit 0,{$_GET['top']}";

$list=$db->fetch_all($sql);
if(count($list)>0){
$return['result']=1;
$return['returnval']='操作成功';
$return['recordcount']=count($list);
$return['table']=array();
foreach ($list as $key=>$value){

    $temp=array();
    $temp['id']=$value['id'];
    $temp['type']=$value['code'];
    $temp['title']=$value['period'];
    $temp['number']=$value['Number'];
    $num=explode(',',$value['Number']);
    $sum=0;

    foreach ($num as $value1){

        $sum+=$value1;
    }
    $temp['total']=$sum;
    $temp['ds']=0;
    $temp['dx']=0;
    $temp['opentime']=$value['LotTime'];
    $temp['flag']=0;
    $temp['flags']=0;
    $temp['isfill']=1;
$return['table'][]=$temp;

}
echo json_encode($return);
}


    exit();
}

$game=$db->exec("select * from game_type where ckey='{$_GET['playkey']}'");
$tpl->assign("game",$game);

if($_GET['top']) $top=$_GET['top'];
else $top=50;

$tpl->assign("top",$top);

include_once "source/config/play/lot_time_".$_GET['playkey'].".php";
$temp=get_now_period($_GET['playkey'],$time_arr);
$sql="select * from game_lottery where playKey='{$_GET['playkey']}' and status=1 and period<'{$temp['period']}' {$str} order by period desc,id desc limit 0,{$top}";
//var_dump($sql);exit;
$list=$db->fetch_all($sql);
if(count($list)>0){
    foreach ($list as $key=>$value) {

   ;
        $num = explode(',', $value['Number']);
        $list[$key]['num']=$num;
     $sum=0;
     foreach ($num as $k=>$v){
         $sum+=$v;
     }
        $list[$key]['sum']=$sum;

    }

}


$tpl->assign('list',$list);

?>