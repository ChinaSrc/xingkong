<?php

if(time()-$_SESSION['buytime']<=2){

    exit();

}
$_SESSION['buytime']=time();






$selArr = isset($_GET[selArr]) ?$_GET[selArr] : $_POST[selArr];



$istask = isset($_GET[istask]) ?$_GET[istask] : $_POST[istask];
$perstop = isset($_GET[perstop]) ?$_GET[perstop] : $_POST[perstop];
$taskmoneys = isset($_GET[moneys]) ?$_GET[moneys] : $_POST[moneys];
$lists = isset($_GET[lists]) ?$_GET[lists] : $_POST[lists];
$player_item = isset($_GET[player_item]) ?$_GET[player_item] : $_POST[player_item];
$lotpriod=isset($_GET['period']) ?$_GET['period'] : $_POST['period'];
$lotpriod1=$lotpriod+1;
$endtime=isset($_GET['endtime']) ?$_GET['endtime'] : $_POST['endtime'];

$endtime=strtotime(date('Y-m-d').' '.$endtime);
$num11=0;
if($istask=="yes"){
$taskListArr=explode("#",$lists);

}

$temp='';
$TaskMoney=0;

foreach ($_POST[selArr] as $key=>$value){
	$selArr=$value;

	$wei='';

$arrs=explode("|",$selArr);

$gamekey=Trim($arrs[0]);
$code=Trim($arrs[1]);
$titles=Trim($arrs[2]);
$playid=Trim($arrs[3]);
$modes=Trim($arrs[4]);
$nums=Trim($arrs[5]);

$money=Trim($arrs[6]);
$CurMode=Trim($arrs[7]);
$CurModeType=Trim($arrs[8]);
$times=Trim($arrs[9]);
	$per_money=$money/$times;

if($istask=="yes"){
if($taskmoneys-0.001<0){$istask="no";}
if($lists==""){$istask="no";}
}

if($istask=='yes'){
$z_uid='';
$from=0;
if(time()>$endtime){

	$from=1;
}

for($j=$from;$j<count($taskListArr);$j++){
	$TaskArr=explode("^",$taskListArr[$j]);
$TaskPeriod=$TaskArr[0];
$Tasktimes=$TaskArr[1];
$TaskMoney+=$per_money*$Tasktimes;

}



}
else{

	$TaskMoney+=$money;


}


}
 	$lost_money=getsql::moneys($_SESSION['userid']);
	
if($lost_money-$TaskMoney<0){
	$re_min="no";$re_max="10";$flags="no";

echo $re_min."|".$re_max."|".$num11;exit();
}
	
 
 
//$lotpriod=get_game_period($gamekey);

$row=$db->exec("select modes from user where userid='{$_SESSION['userid']}'");
$user_modes=$row['modes'];
 $mmssc_period=date('YmdHis');
 $tt=0;
foreach ($_POST[selArr] as $key=>$value){
	

	
	$num11++;
	$selArr=$value;
	
	$wei='';

$arrs=explode("|",$selArr);
if(!$wei and  $arrs[13]>-1) $wei=$arrs[13]; 
$gamekey=Trim($arrs[0]);
$code=Trim($arrs[1]);
$titles=Trim($arrs[2]);
$playid=Trim($arrs[3]);
$modes=Trim($arrs[4]);
$nums=Trim($arrs[5]);

$money=Trim($arrs[6]);
$CurMode=Trim($arrs[7]);
$CurModeType=Trim($arrs[8]);
$times=Trim($arrs[9]);
	$per_money=$money/$times;
if($istask=="yes" and count($taskListArr)>0 ){
$TaskArr=explode("^",$taskListArr[0]);
if($TaskArr[1]>0)
$times=$TaskArr[1];
}
//if(!$lotpriod){$lotpriod=get_game_period($gamekey);}
$ids=Trim($arrs[11]);
$lines=Trim($arrs[12]);
$wei=Trim($arrs[13]);
//if(!$wei)$wei=$key;
$flags="no";$re_min="yes";$re_max="1";
$DanBeiMoney=$money/$times;

if($userid-1>=0){$flags="yes";$lost_money=getsql::moneys($userid);}else{$re_min="no";$re_max="7";}

if($flags=="yes"){

if($flags=="yes"){if($modes!="元"and $modes!="角" and $modes!="分" and $modes!="厘"){$modes="元";}}
if($flags=="yes"){if(!$CurMode){$CurMode="1930";}}
if($flags=="yes"){
	if($_GET['prenum']) $prenum=$_GET['prenum'];
	else $prenum=2;
$n_money=$nums*$prenum*$times;
if($modes=="角"){$n_money=$n_money/10;}
if($modes=="分"){$n_money=$n_money/100;}
if($modes=="厘"){$n_money=$n_money/1000;}

if($n_money!=$money and $_GET['gametype']!='k3'){$money=$n_money;}
}
}
$CurMode1=$modes;

if($flags=="yes"){
if($lost_money-0.002<0){$re_min="no";$re_max="10";$flags="no";}
}
if($flags=="yes"){
if($money-0.002<0){$re_min="no";$re_max="8";$flags="no";}
}



if($flags=="yes"){if($lost_money-$money<0){$re_min="no";$re_max="10";$flags="no";}}
if($flags=="yes"){
if($istask=="yes"){
if($taskmoneys-0.001<0){$istask="no";}
if($lists==""){$istask="no";}
}

if($lines!=''){
if($istask=='yes'){
$z_uid='';
$from=0;
if(time()>$endtime){
	
	$from=1;
}
	for($j=$from;$j<count($taskListArr);$j++){
	
$TaskArr=explode("^",$taskListArr[$j]);
$TaskPeriod=$TaskArr[0];
$Tasktimes=$TaskArr[1];
$TaskMoney=$per_money*$Tasktimes;

if($z_uid){
	$endtime1=strtotime($TaskArr[3]);
$Taskid=getsql::addGameBuy($gamekey,$playid,$TaskPeriod,$lines,$nums,$Tasktimes,$CurMode,$CurModeType,$modes,$TaskMoney,"yes","yes",$perstop,$z_uid,$endtime1,'',$player_item,$wei);

$mark=get_game_mark($Taskid);
$bankid=getsql::banklog($TaskMoney,"hig_chase","",$mark,$Taskid,$gamekey,$modes);
}

else{

$Taskid=getsql::addGameBuy($gamekey,$playid,$TaskPeriod,$lines,$nums,$Tasktimes,$CurMode,$CurModeType,$modes,$TaskMoney,"yes","yes","","",$endtime,'',$player_item,$wei);
$mark=get_game_mark($Taskid);
$bankid=getsql::banklog($TaskMoney,"hig_chase","",$mark,$Taskid,$gamekey,$modes);	
	$z_uid=$Taskid;

	
}
}
	
}

else
{
if($gamekey!='MMSSC'){
if(time()>$endtime){
	//1$cha=time()-$endtime;
	//$lotpriod=$lotpriod1;
    //$endtime=strtotime(date('Y-m-d').' '.get_lottime($gamekey));
    echo "no|12";
    exit();
}

//$temp.=$money."<br>";
$z_uid=getsql::addGameBuy($gamekey,$playid,$lotpriod,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,"no","yes","","",$endtime,'',$player_item,$wei);
$mark=get_game_mark($z_uid);
$bankid=getsql::banklog($money,"hig_buy","",$mark,$z_uid,$gamekey,$modes);
    $tt++;

}
else{
	$lotpriod=$mmssc_period;
	
	if($_POST['qi_num']>0){
		unset($_SESSION['MMSSC']);
		for ($i=1;$i<=$_POST['qi_num'];$i++){
			if($i<10) $priod1=$mmssc_period.'0'.$i;
			else $priod1=$mmssc_period.$i;
			
	$z_uid=getsql::addGameBuy($gamekey,$playid,$priod1,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,"no","yes","","",'','',$player_item,$wei);
$mark=get_game_mark($z_uid);
$bankid=getsql::banklog($money,"hig_buy","",$mark,$z_uid,$gamekey,$modes);

$_SESSION['MMSSC'][$i]=$priod1;

		}
	}
}

}
}
}	


}



  $user= $db->exec("select playlist from user where userid='{$_SESSION["userid"]}'");
$playlist=unserialize($user['playlist']);
if(!in_array($gamekey,$playlist)){

    $playlist[]=$gamekey;
    $playlist=serialize($playlist);

    $db->query("update user set playlist='{$playlist}' where userid='{$_SESSION["userid"]}'");
}




echo $re_min."|".$re_max."|".$num11;

echo "|".$tt;



?>