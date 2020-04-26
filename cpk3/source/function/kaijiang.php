<?php


if($_GET['key'])
{
$str=" and playKey='{$_GET['key']}'";
	$game=$db->fetch_first("select * from game_type where ckey='{$_GET['key']}'");
	$tpl->assign("game",$game);
	$tpl->assign("navtitle",$game['fullname']);
}
else {
	echo "<script>alert('您选择的彩种不正确');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";

	exit();
}

if($_GET['date']) $date=$_GET['date'];
else $date=date("Y-m-d",time());


$begindate=$date." 00:00:00";
$enddate=$date." 23:59:59";

$datehtml='';


$arr=array('今天','昨天','前天');
$num=0;
for ($i=time();$i>time()-3*24*3600;$i=$i-24*3600){
	$v=date('Y-m-d',$i);
if($v==$date) $Ac='active'	;else $Ac='';

	$datehtml.="      <li class='AwardDiff {$Ac}'><a href='lottery_{$_GET[key]}.html?date={$v}'>{$arr[$num]}</a></li>";


	$num++;
}




$tpl->assign('datehtml',$datehtml);







if($_GET['page']) $page=$_GET['page'];
else $page=1;
$str.=" and LotTime between '{$begindate}' and '{$enddate}'";
include_once "source/config/play/lot_time_".$_GET['key'].".php";
$temp=get_now_period($_GET['key'],$time_arr);
$nowtime=date('Y-m-d H:i:s');
$sql  = "select * from game_lottery   where period!='' and period<'{$temp['period']}'  {$str} and LotTime<='{$nowtime}'  order by period desc,LotTime desc,id  desc";
$page=new Page($sql,50,$_GET['page']);
    $tpl->assign('page',$page->get_page());
$sql.=" limit {$page->from},50" ;

$lottery_list = $db->fetch_all($sql);
if($lottery_list){
	$i=1;
foreach ($lottery_list as $key =>$value){
		$lottery_list[$key]['i']=$i++;



			$number=explode(',', $value['Number']);
			$sum=0;
	$str='';

	foreach ($number as $k1=>$v1){

		$str.="<span>{$v1}</span>";
		$sum+=$v1;

	}


	$lottery_list[$key]['sum']=$sum;


	$game=$db->fetch_first("select * from game_type where ckey='{$value['playKey']}'");
	$lottery_list[$key]['code']=explode(",", $value['Number']);
	$lottery_list[$key]['game_name']=$game['fullname'];
}
}
$tpl->assign("lottery_list",$lottery_list);

$tpl->assign("kaijiang",1);

$tpl->assign('date',$date);

?>