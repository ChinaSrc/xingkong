<?php

$gamekey = isset($_GET[play]) ?$_GET[play] : $_POST[play];
$action = isset($_GET[action]) ?$_GET[action] : $_POST[action];


if($action=='zui_list'){
   echo get_zuilist();

	//echo 'gggh';


}

if($action=='openLottery'){
  set_time_limit(0);
  include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");
  
  $sec = date('i');
  for ($i = 1; $i < 20; $i++) {
    $perarrs=get_now_period($gamekey,$time_arr);
    $period=$perarrs['pre_period'];
      if ($sec != date('i')) {
          break;
      }
	  //var_dump(date('Y-m-d H:i:s'));
      $perarrs=get_now_period($gamekey,$time_arr);
      $period=$perarrs['pre_period'];
      auto_lot($gamekey);
      $game_lottery = $db->exec("SELECT * FROM `game_lottery` WHERE `playKey` = '{$gamekey}' AND `period` = '{$period}' ORDER BY `LotTime` DESC");
      if ($game_lottery['status'] != 1) {
          start_prize($gamekey, $period);
          fenpei_prize($gamekey, $period);
      }
      sleep(3);
  }
}

if($action=='lotnew'){

    include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");

    //开奖时间
    $perarrs=get_now_period($gamekey,$time_arr);

    $period=$perarrs['pre_period'];

    //$sys = $db->exec("select * from `sys` where `key`='auto_lot_{$gamekey}'"); // 有修改或添加行为， 不敢贸然添加缓存。

    //if (!$sys['value'] || $sys['value'] != $period) {
        //file_put_contents('/www/wwwroot/xingkong/cpk3/logfile.txt', 'SYS监控：' . json_encode($sys) . ' ' . $period . PHP_EOL, FILE_APPEND);
        //开奖
//        auto_lot($gamekey);
//        //判断是否中奖
//        start_prize($gamekey, $period);
//        //派奖
//        fenpei_prize($gamekey, $period);
    //}

    echo json_encode($perarrs);
    exit();

}

if($action=='lottery_list'){
    include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");
    $perlist=  lottery_list($gamekey,9);
    $body=$perlist[0][id]."^".$perlist[0][period]."^".$perlist[0][Number]."^".$perlist[0]['LotTime'];
    echo $body;
}

if($action=="lot"){
if($gamekey){
include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");
//include(SZS_ROOT_PATH."source/config/play/code_".$gamekey.".php");

$perarrs=core_fun::getperiod($gamekey,$time_arr);

if($perarrs){
    auto_lot($gamekey);
$perarrs_value_arr= array_values($perarrs);
$list_s=implode("|",$perarrs_value_arr);
echo $list_s;
}
}else{
echo "no";
}
}

if($action=='lou'){


	$gamekey=$_GET['gamekey'];
	$playid=$_GET['playid'];
	$value1= $_GET['value'];

   $list=explode('|',  $_GET['value']);
   $str='';


   	$lou=get_lou($gamekey, $playid, $list);
  //
   	   foreach ($lou as $key=>$value){
   	if($str!=='') $str.='|'.$value;
   	else $str.=$value;


   }
   echo $str;




}


if($action=="lotnum"){
	//auto_lot($gamekey);
$perlist=getsql::periods($gamekey);

$body=$perlist[0][id]."^".$perlist[0][period]."^".$perlist[0][Number];
echo $body;
}


if($action=='mmssc'){


echo MMSSC_open();

}










if($action=="historybuy"){
if($_SESSION["userid"]){
//MMSSC_open();
$userid=$_SESSION["userid"];
$arrs   = array();
$period_min=$_POST['current_issue']-3;

$fromdate=date('Y-m-d',time()-7*24*3600)." 00:00:00";
$fromdate2 = date ( 'Y-m-d') . " 23:59:59";
  
if($_POST['play']=='MMSSC'){

//$arrs_sql = "select b.* from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."game_ssc_list as g where b.userid='$userid'  and b.list_id=g.skey and b.playkey='{$_POST['play']}'  and  is_zuih='no' order by b.period desc,b.id desc  limit  0,50 ";
$arrs_sql = "select b.* from ".DB_PREFIX."game_buylist as b left join  ".DB_PREFIX."game_ssc_list as g on b.list_id=g.skey  where b.userid='$userid' and b.playkey='{$_POST['play']}' and  is_zuih='no' order by b.period desc,b.id desc  limit  0,50 ";

}
else{

    if($_GET['mobile']==1){
        $arrs_sql = "select b.* from ".DB_PREFIX."game_buylist as b  left join  ".DB_PREFIX."game_ssc_list as g  on b.list_id=g.skey  where b.userid='$userid'  and b.creatdate>='{$fromdate}' and b.creatdate<='{$fromdate2}'  and  b.playkey='{$_POST['play']}'  order by b.creatdate desc  limit  0,100 ";
        $arrs = limitTime($_SESSION["userid"], $arrs_sql);
    }else{
        $arrs_sql = "select b.* from ".DB_PREFIX."game_buylist as b left join  ".DB_PREFIX."game_ssc_list as g  on  b.list_id=g.skey  where b.userid='$userid' and b.creatdate>='{$fromdate}'  and b.creatdate<='{$fromdate2}' and  b.playkey='{$_POST['play']}'  and  is_zuih='no'order by b.creatdate desc  limit  0,100 ";
        $arrs    = $db->getall($arrs_sql);
    }

}
 

if($arrs){
for ($i=0;$i<count($arrs);$i++){
$fullname=get_game_mark($arrs[$i]['id'],1);
if($body==""){
$body=$arrs[$i][buyid]."^".$arrs[$i][list_id]."^".$fullname."^".$arrs[$i][period]."^".$arrs[$i][number]."^".$arrs[$i][nums]."^".$arrs[$i][times]."^".$arrs[$i][modes]."^".$arrs[$i][money]."^".$arrs[$i][creatdate]."^".$arrs[$i][is_zuih]."^".$arrs[$i][id];
}else{
$body=$body."#".$arrs[$i][buyid]."^".$arrs[$i][list_id]."^".$fullname."^".$arrs[$i][period]."^".$arrs[$i][number]."^".$arrs[$i][nums]."^".$arrs[$i][times]."^".$arrs[$i][modes]."^".$arrs[$i][money]."^".$arrs[$i][creatdate]."^".$arrs[$i][is_zuih]."^".$arrs[$i][id];
}
$body.="^".$arrs[$i]['isprize'];
$body.="^".show_buystatus($arrs[$i]);

if($arrs[$i]['status']==0 and $arrs[$i]['endtime']>time()){
    $body.="^1";
}
else   $body.="^0";
    $body.="^".$arrs[$i]['id'];
    if($arrs[$i]['status']>0  and $arrs[$i]['status']<9){
        $num=$arrs[$i]['pri_money']-$arrs[$i]['money'];
        $body.="^{$num}";
        $body.="^".$arrs[$i]['pri_money'];
    }
    else  $body.="^-^-";

    $user11=get_user_info($arrs[$i]['userid']);
    $body.="^".$user11['username'];
    $game11=$db->exec("select fullname from game_type where ckey='{$arrs[$i]['playkey']}'");
    $body.="^".$game11['fullname'];

}




echo $body;
//MMSSC_open();
}
}
}

if($action=="historybuy2"){
if($_SESSION["userid"]){
$userid=$_SESSION["userid"];
$arrs   = array();
$period_min=$_POST['current_issue']-3;
$period_max=$_POST['current_issue']+1;
    $fromdate=date('Y-m-d',time()-7*24*3600)." 00:00:00";
$arrs_sql = "select distinct b.z_number from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."game_ssc_list as g where b.userid='$userid' and  b.playkey='{$_POST['play']}'  and b.list_id=g.skey and  is_zuih='yes' and b.creatdate>='{$fromdate}' and b.z_number!='' order by b.id desc  limit  0,50 ";
$arrs    = $db->getall($arrs_sql);

if($arrs){
for ($i=0;$i<count($arrs);$i++){
	
	$uid=$arrs[$i][z_number];
	
	$arrs[$i]=$db->exec("select * FROM game_buylist where (z_number='{$arrs[$i]['z_number']}' or id='{$arrs[$i]['z_number']}') and userid='$userid' and is_zuih='yes'   order by period asc ");


    $sql5 ="select count(id) as num, sum(money) as `sum` from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')  ";
    $rows5=$db->exec($sql5);
    if($rows5['num']){$all_peroid=$rows5['num'];}else{$all_peroid="0";}

    if($rows5['sum']){$all_money=$rows5['sum'];}else{$all_money="0";}
    $this_all_money+=$all_money;

    $sql7 = "select count(id) as num, sum(money) as `sum`  from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')   and status>0 and status!=9";
    $rows7=$db->exec($sql7);
    if($rows7['num']){$over_peroid=$rows7['num'];}else{$over_peroid="0";}
    if($rows7['sum']){$over_money= $rows7['sum'];}else{$over_money="0";}
    $this_over_money+=$over_money;

    $sql7 = "select count(id) as num, sum(money) as `sum`  from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')    and status=9";
    $rows7=$db->exec($sql7);
    if($rows7['num']){$back_peroid=$rows7['num'];}else{$back_peroid="0";}
    if($rows7['sum']){$back_money= $rows7['sum'];}else{$back_money="0";}


if($body==""){
$body=$arrs[$i][buyid]."^".$arrs[$i][list_id]."^".$fullname."^".$arrs[$i][period]."^".$arrs[$i][number]."^".$arrs[$i][nums]."^".$arrs[$i][times]."^".$arrs[$i][modes]."^".$arrs[$i][money]."^".$arrs[$i][creatdate]."^".$arrs[$i][is_zuih]."^".$arrs[$i][id];
}else{
$body=$body."#".$arrs[$i][buyid]."^".$arrs[$i][list_id]."^".$fullname."^".$arrs[$i][period]."^".$arrs[$i][number]."^".$arrs[$i][nums]."^".$arrs[$i][times]."^".$arrs[$i][modes]."^".$arrs[$i][money]."^".$arrs[$i][creatdate]."^".$arrs[$i][is_zuih]."^".$arrs[$i][id];
}
$body.="^".$arrs[$i]['isprize'];
if($over_peroid+$back_peroid<$all_peroid){$status="<font color=red>进行中</font>";}else{$status="已结束";}
$body.="^".$status.'^'.$all_peroid.'^'.$over_peroid;
if($arr[$i]['is_zuih_pri_stop']==1) $stop='是';else $stop='否';
    $fullname=get_game_mark($arrs[$i]['id'],1);
    $body.="^".$fullname.'^'.$stop;
    $body.="^".$all_money.'^'.$over_money.'^'.$back_money.'^'.$all_peroid.'^'.$over_peroid.'^'.$back_money;

    $user11=get_user_info($arrs[$i]['userid']);
    $body.="^".$user11['username'];
    $game11=$db->exec("select fullname from game_type where ckey='{$arrs[$i]['playkey']}'");
    $body.="^".$game11['fullname'];
}


echo $body;
}
}
}

if($action=="historybuy3"){
if($_SESSION["userid"]){
$userid=$_SESSION["userid"];
$arrs   = array();
$period_min=$_POST['current_issue']-3;
$period_max=$_POST['current_issue']+1;
    $fromdate=time()-7*24*3600;
$arrs_sql = "select * from ".DB_PREFIX."hemai  where   (uid='$userid' or id in (select hm_id from hemai_list where uid='{$userid}' ) ) and addtime>'{$fromdate}' order by id desc  limit  0,50 ";
$list=$db->fetch_all($arrs_sql);
if(count($list)>0){
	foreach ($list as $key=> $value) {
         $list[$key]['addtime']=date('Y-m-d H:i:s',$value['addtime']);
        $game=$db->exec("select * from game_type where ckey='{$value['playkey']}'");
        $list[$key]['game_name']=$game['fullname'];

        $user=$db->exec("select * from user where userid='{$value['uid']}'");
        $list[$key]['user_name']=substr($user['username'],0,2).'***'.substr($user['username'],strlen($user['username'])-2,2);

        $list[$key]['baodi']=number_format($value['baodi']*100/$value['sum'],2);
        $hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$value['id']}'");
        if(!$hm['sum']) $hm['sum']=0;
        $list[$key]['mebuy']=number_format(($hm['sum'])*100/$value['sum'],2);

        $list[$key]['sum1']=$value['sum']-$hm['sum'];

        $list[$key]['premoney']=number_format($list[$key]['premoney'],3);
        $list[$key]['status_name']= $arr_hemai_status[$value['status']];

	}
	echo json_encode($list);

}

}
}
if($action=="autos"){
$PriTopArr=Core_Fun::rePriTop('1');
if(strpos($PriTopArr,'err')){$PriTopArr="";}
$logouts=getsql::userinfo($userid,"sessionID");
$msgs=getsql::Getmsg($userid);
echo $PriTopArr."^".$logouts['sessionID']."^".$msgs;
}
if($action=="money"){
$amount=get_user_amount($_SESSION["userid"]);
echo json_encode($amount);
}
if($action=='set_often'){

    $db->query("update user set often='{$_POST['often']}' where userid='{$_SESSION['userid']}'");

}
if($action=='set_history'){

    $db->query("update user set `history`='{$_POST['history']}' where userid='{$_SESSION['userid']}'");

}

if($action=='lastlot'){
  $row=  $db->exec("select gt.*,gl.Number,gl.period from game_lottery gl,game_type gt where gl.playKey=gt.ckey and gt.status='0' and gt.ckey!='MMSSC' order by gl.id desc limit 0,1");
   if($row['skey']=='kl8' || $row['skey']=='pk10') $class=$row['skey'];
   else $class='ssc';
   $number=explode(',',$row['Number']);
   $url="game_{$row['id']}.html";
  ?>
<div class="ico"  onclick="location.href='<?php echo $url;?>';">
<img src="<?php echo $row['ico']?>">

</div>
    <div class="info" onclick="location.href='<?php echo $url;?>';">
<div class="<?php echo $class;?>">
    <ul>
       <?php
       foreach ($number as  $key=>$value){
if($key<20)
           echo "<li>{$value}</li>";
       }

       ?>



    </ul>

</div>

        <div style="height:26px;line-height:26px;text-align: center;clear: both;">
            <span class="fullname"><?php echo $row['fullname']?></span>

            <span class="period">第<?php echo $row['period']?>期</span>
        </div>



    </div>
<?php


}

if($action=='fanganlist'){
    $fangan_list=$db->fetch_all("select * from game_fangan where uid='{$_SESSION['userid']}' order by id desc");

    if(count($fangan_list)){
        foreach ($fangan_list as $value){
            ?>

            <li>
                <p><?php echo $value['title']?> </p>
                <div class="fn-area" data-id="<?php echo $value['id']?> ">
                    <i onclick="fangan_buy(<?php echo $value['id']?> );" title="执行方案" class="icon-play-1"></i>
                    <i onclick="fangan_remove(<?php echo $value['id']?> );" title="删除方案" class="icon-cancel-3"></i>
                </div>
            </li>


            <?php
        }

    }

}

if($action=='fangan_num'){
    $row=$db->exec("select count(*) as num from game_fangan where uid='{$_SESSION['userid']}' order by id desc");
    if($row['num']>0) echo $row['num'];
    else echo 0;
    exit();


}

if($action=='fangan_remove'){
    $db->query("delete from game_fangan where id='{$_GET['id']}'");

}

if($action=='uservedio'){
    $db->query("update  user set vedio='{$_GET['vedio']}' where userid='{$_SESSION['userid']}'");

}

?>