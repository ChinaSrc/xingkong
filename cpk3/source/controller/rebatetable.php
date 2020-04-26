<?php

$type=$_GET['type'];
if($type=='') $type='k3';
$tpl->assign('type',$type);
    $tpl->assign('arr_game_code',$arr_game_code);


$config=getsql::sys();
if($config['game_qw']==2)  $where=" and  ( ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';
$sql="select * from game_code where type='{$type}'  {$where} order by sortnum asc, id asc";

$code_list=$db->fetch_all($sql);

foreach ($code_list  as $key=> $value) {

    $sql1 = "select s.* ,c.CodeTile,c.ShowTile from game_ssc_list s,game_code_list c where s.skey=c.ListKey and  c.CodeKey='{$value['ckey']}' order by c.OrderS	asc";

       $list=$db->fetch_all($sql1);

       foreach ($list as $key1=>$value1){
           if($value1['skey']=='K3HZ'){
               $show_other=explode('|',$value1['show_other']);
               $maxrate=explode('|',$value1['maxrate']);
               $minrate=explode('|',$value1['minrate']);
               foreach ($show_other as $key2=>$value2){
          if($value2){
              $item=array();
              $item['ShowTile']=$value2;
              $item['maxrate']=$maxrate[$key2];
              $item['minrate']=$minrate[$key2];
              $code_list[$key]['list'][]=$item;

          }

               }

           }else{

               $code_list[$key]['list'][]=$value1;
           }

       }


}



$tpl->assign('code_list',$code_list);

$user_rebates=unserialize($userinfo['rebates']);
$user_rebates=$user_rebates[$type];
$arr=explode('.',$user_rebates);
$rebate_min=$user_rebates-$con_system['rebate_cha'];
if($rebate_min<0) $rebate_min=0;
$rebate_min=floor($rebate_min);
$rebate_max=$rebate_min+$con_system['rebate_cha'];
if($rebate_max<$user_rebates) $rebate_max=$user_rebates;
$rebate_arr=array();
for($i=$rebate_max;$i>=$rebate_min;$i=$i-0.1){

    $rebate_arr[]=$i;
}
$tpl->assign('rebate_arr',$rebate_arr);
$tpl->assign('navtitle','返点赔率表');
//echo $con_system['rebate_cha'];
?>