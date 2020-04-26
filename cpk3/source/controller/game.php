<?php
if(!isset($_SESSION['userid']) or $_SESSION['userid']=="" or $_SESSION['userid']-1<0){
	//exit;
}


if($userinfo['isproxy']!=1 and $con_system['daili_buy']!=1){

	$game_play=0;
}
else{
	$game_play=1;

}



$percss="grid_code_lt";

$game_type=$db->exec("select * from game_type where `id`='{$_GET['id']}' ");

$play = $gamekey = $game_type['ckey'];
$wanfa=unserialize($game_type['wanfa']);
$game_code=explode("|", $game_type['code']);

$first=explode("|", $game_type['firstcode']);
$con_play_arr['firstcode']=$first[0];
	$config=getsql::sys();

$user=$db->exec("select * from user where userid='$userid'");
$temp=unserialize($user['rebates']);
$user_rebate=$temp[$game_type['skey']];
$tpl->assign('user_rebate',$user_rebate);
if($_GET['type']  and $config['game_qw']==1) {

	$gc=$db->fetch_first("select * from game_code where `ckey`='{$con_play_arr['firstcode']}' ");

	if($gc['cate']=='趣味型') $type='qw';else $type='ct';
	if($type!=$_GET['type']){
		if($_GET['type']=='qw') $typename='趣味型';else $typename="传统型";


	foreach ($game_code as $value)	{
			if($_GET['type']=='qw'){
	$nn=$db->fetch_first("select * from game_code where `ckey` =  '{$value}' and  cate='趣味型' and type!='11x5' and type!='kl8' ");
	if($nn){

	$con_play_arr['firstcode']=$nn['ckey'];
		break;
	}
			}

			else{


	$nn=$db->fetch_first("select * from game_code where `ckey` =  '{$value}' ");
	if($nn){

	$con_play_arr['firstcode']=$nn['ckey'];
		break;
	}


			}

}

	}






}



$con_play_arr['lot_date']=$game_type['lot_date'];
$con_play_arr['lot_num']=$game_type['lot_num'];

$qw=$ct=0;
foreach ($game_code as $value) {
	$row=$db->fetch_first("select * from game_code where `ckey`='{$value}' ");

$code_arr[$value]=$row;

}
$ct=1;

$firstcode=$db->fetch_first("select * from game_code where `ckey`='{$con_play_arr['firstcode']}' ");
$str_arr='';
$first_cate='ct';

foreach ($game_code as $v) {

	//if($code_arr[$v]['cate']!='趣味型' or $code_arr[$v]['type']=='11x5' or $code_arr[$v]['type']=='kl8'){
   $str_arr[]=$v;

	//}
}



if($qw==1 and $ct==1  and $config['game_qw']==1){

$big_cate="<div id='betting-type-nav' >
<ul>

<li   onclick=\"window.location='game1_{$_GET[play]}_ct.html';\"  >{$class['ct']}</li>
<li onclick=\"window.location='game1_{$_GET[play]}_qw.html';\" >{$class['qw']}</li></ul>
<li style='font-size:14px;float:right;padding-right:10px;font-weight:800;display:none;'><span id='nowtime'>".date('Y-m-d H:i:s')."</span></li></ul>
</div>";
}

else{

	$big_cate="<span id='nowtime' style='display:none;'>".date('Y-m-d H:i:s')."</span>";

}

//include(SZS_ROOT_PATH."source/config/play/codelist.php");
include(SZS_ROOT_PATH."source/config/play/code_".$gamekey.".php");
include(SZS_ROOT_PATH."source/config/play/lot_time_".$gamekey.".php");

$con_play_pri=array();

//$temp='';
//
//foreach ($con_play_arr['code'] as $key=>$value){
//    if($temp!='') $temp.=',';
//    $temp.="'".$value."'";
//
//
//}
//$game_ssc_list=$db->fetch_all("select * from game_ssc_list where ckey in ({$temp})");
$game_ssc_list=$db->fetch_all("select * from game_ssc_list where skey in (select ListKey from game_code_list where CodeKey in (select ckey from game_code where type='{$game_type['skey']}'))");
//快三玩法   根据用户组重新定义限额

if($game_type['skey']=='k3'){
$user_group=$db->exec("select * from user_group where id='{$userinfo['groupid']}'");
$content=unserialize($user_group['content']);
if(count($content)){
    foreach ($game_ssc_list as $key=>$value){
       $item=$content[$value['skey']];
        if($item['buymin'] or $item['buymax']){
           if($value['skey']=='K3HZ'){
               $buymin=explode('|',$value['buymin']);
               $buymin1=explode('|',$item['buymin']);

               $buymax=explode('|',$value['buymax']);
               $buymax1=explode('|',$item['buymax']);

               foreach ($buymin1 as $k1=>$v1){
                   if($v1>0){
                       $buymin[$k1]=$v1;
                   }
               }
               foreach ($buymax1 as $k1=>$v1){
                   if($v1>0){
                       $buymax[$k1]=$v1;
                   }
               }
               $game_ssc_list[$key]['buymin']=implode('|',$buymin);
               $game_ssc_list[$key]['buymax']=implode('|',$buymax);
           }else{
         if($item['buymin']>0) $game_ssc_list[$key]['buymin']=$item['buymin'];
               if($item['buymax']>0) $game_ssc_list[$key]['buymax']=$item['buymax'];

           }

        }

    }
}


}



foreach ($game_ssc_list as $value){
    $con_play_pri[$value['skey']]=$value;
    $con_play_list[$value['skey']]=$value;
    }

$period_s= array_keys($time_arr);
$time_s= array_values($time_arr);



$con_play_arr['code'] =$str_arr;
$con_title_arr=array();


foreach ($con_play_arr['code'] as $value) {
	$sql = "select fullname,ckey,mode,cate,pid from game_code where ckey ='$value'";
$row=$db->fetch_first($sql);
	$con_title_arr[$value]['fullname']=$row['fullname'];
	if($row['mode']=='') $row['mode']='default';

	$con_title_arr[$value]['mode']=$row['mode'];
	$con_title_arr[$value]['cate']=$row['cate'];
	if($row['pid']>0){
			$sql1 = "select ckey from game_code where id ='$row[pid]'";
$row1=$db->fetch_first($sql1);
		$row['pid']=$row1['ckey'];

	}

		$con_title_arr[$value]['pid']=$row['pid'];
}

	$tpl->assign("first_cate",$first_cate);
	$tpl->assign("big_cate",$big_cate);
$tpl->assign("display",$display);


/*模式*/
$usermode=getsql::usermode($userid);
$sysmode=explode("|",$con_system['Modes']);
$FixedModes=$con_system['FixedModes'];
$AutoModes=$con_system['AutoModes'];


$u_reBonus=getsql::userinfo($userid,"reBonus");//echo $u_reBonus["reBonus"];
if($u_reBonus['reBonus']=="close"){$AutoModes="no";}
$mode_list=array_intersect($usermode,$sysmode);

$CurMode=$userinfo['modes'];
$AutoModeNum=$userinfo['modes'];


$modes=$userinfo['modes'];

/*====js_a游戏开奖期号、开始、结束时间*/
$js_a= "var arrTimes = {";
for($i=0;$i<count($time_arr);$i++){
	if(count($time_arr)-$i==1){$links="";}else{$links=",";}
	$js_a.="'".$period_s[$i]."':{period:'".$period_s[$i]."',begins:'".$time_s[$i][begin]."',ends:'".$time_s[$i][end]."',lot:'".$time_s[$i][lot]."'}".$links;
}
$js_a.="};";

$Max_lostnum=$i+1;
if($Max_lostnum>30) $tt=30;else $tt=$Max_lostnum;
for ($i=1;$i<=$tt;$i=$i+5){


	$lt_trace_qissueno.="<option value='{$i}'>{$i}期</option>";
}

$tpl->assign('lt_trace_qissueno',$lt_trace_qissueno);
/*====js_b游戏的玩法及首选玩法、非固定期号的计算超始*/
$js_b= "var arrGameSet = {'firstcode':'".$con_play_arr['firstcode']."','lot_date':'".$con_play_arr['lot_date']."','lot_num':'".$con_play_arr['lot_num']."','Limit_Betting':'".$con_system['Limit_Betting']."',Max_LotNum:'{$Max_lostnum}'};";

/*====js_c游戏的玩法类型ID,通过玩法类型ID获取所有的详细玩法*/
$js_c= "var arrGameCodes = Array(";  //
$js_d= "var arrCodes = {";
$js_e= "var arrPlays = {";
$js_g= "var arrPlayList = {";
$js_h= "var arrPlayPri = {";
$js_i= "var arrPlayTime = {";
$lss="";


for($i=0;$i<count($con_play_arr[code]);$i++){
	if(count($con_play_arr[code])-$i==1){$links="";}else{$links=",";}
	$js_c.="'".$con_play_arr[code][$i]."'".$links;
	/*详细玩法*/
	$this_code=$con_play_arr[code][$i];//echo $this_code;
	$plays_key_arr= @array_keys($con_code_arr[$this_code]); //小分类
	$plays_value_arr= @array_values($con_code_arr[$this_code]);//小分类
    $code_key_arr= array_keys($con_title_arr);
    $code_value_arr= array_values($con_title_arr);
	$js_d.="'".$code_key_arr[$i]."':{title:'".$code_value_arr[$i][fullname]."',mode:'".$code_value_arr[$i][mode]."',cate:'".$code_value_arr[$i][cate]."',pid:'".$code_value_arr[$i][pid]."'}".$links;



	$js_e.="'".$this_code."':{";
   // print_r($con_play_list);
	for($j=0;$j<count($plays_key_arr);$j++){
	$prize='';
		$this_ssc=$plays_key_arr[$j];
		//echo $this_ssc."<br>";
		$list_arr= $con_play_list[$this_ssc];//详细玩法


		if(count($plays_key_arr)-$j==1){$ls="";}else{$ls=",";}
		if(strpos($con_play_pri[$this_ssc]['minrate'], '|')!==false){
		$minrate=explode("|", $con_play_pri[$this_ssc]['minrate']);
            $maxrate=explode("|", $con_play_pri[$this_ssc]['maxrate']);
		foreach ($minrate as $key=>$value) {
		$str=set_prize($minrate[$key],$maxrate[$key], $user_rebate,$game_type['skey']);
		if($prize=='') $prize=$str;
		else $prize.="|".$str;
		}

	}
	else{
		$prize=set_prize( $con_play_pri[$this_ssc]['minrate'], $con_play_pri[$this_ssc]['maxrate'], $user_rebate,$game_type['skey']);
	}
		$js_e.="'".$this_ssc."':{playid:'".$this_ssc."','CodeTile':'".$plays_value_arr[$j][CodeTile]."',ShowTile:'".$plays_value_arr[$j][ShowTile]."',Rebates:'".$plays_value_arr[$j][Rebates]."',MaxNote:'".$plays_value_arr[$j][MaxNote]."'}".$ls;
		$js_g.=$lss."'".$this_ssc."':{playid:'".$this_ssc."',content:'".$list_arr[content]."',example:'".$list_arr[example]."',help:'".$list_arr[help]."',title:'".$list_arr[title]."',shownum:'".$list_arr[shownum]."',minnum:'".$list_arr[minnum]."',maxnum:'".$list_arr[maxnum]."',show_key:'".$list_arr[show_key]."',show_other:'".$list_arr[show_other]."',max_select:'".$list_arr[max_select]."',min_select:'".$list_arr[min_select]."',is_yes:'".$list_arr[is_yes]."','prize':'".$prize."','buymin':'".$list_arr[buymin]."','buymax':'".$list_arr[buymax]."'}";
		$lss=",";
	}
	$js_e.="}".$links;
}

$pri_key_arr= array_keys($con_play_pri);
$priline="";
for($i=0;$i<count($pri_key_arr);$i++){
	$prize11='';

	$this_key=$pri_key_arr[$i];


    if(strpos($con_play_pri[$this_key]['minrate'], '|')!==false){
      //  print_r($con_play_pri[$this_ssc]);
        $minrate=explode("|", $con_play_pri[$this_key]['minrate']);
        $maxrate=explode("|", $con_play_pri[$this_key]['maxrate']);
        foreach ($minrate as $key=>$value) {
            $str=set_prize($minrate[$key],$maxrate[$key], $user_rebate,$game_type['skey']);
            if($prize11=='') $prize11=$str;
            else $prize11.="|".$str;
        }


	}
	else{
		$prize11=set_prize($con_play_pri[$this_key]['minrate'],$con_play_pri[$this_key]['maxrate'], $user_rebate,$game_type['skey']);

	}
	$js_h.=$priline."'".$this_key."':{'prize':'".$prize11."'}";
	$priline=",";
}
//print_r($con_play_pri);
$time_key_arr= array_keys($con_play_time);
$priline="";

for($i=0;$i<count($time_key_arr);$i++){
	$this_key=$time_key_arr[$i];
	$js_i.=$priline."'".$this_key."':{}";
	$priline=",";
}
$js_c.= ");";
$js_d.= "};";
$js_e.= "};";
$js_g.= "};";
$js_h.= "};";
$js_i.= "};";

$ArrFixModes="var ArrFixModes=Array(";
for ($e=0;$e<count($mode_list);$e++){
	$ArrFixModes.=$m_a_lines."'".$mode_list[$e]."'";
	$m_a_lines=",";
}
$ArrFixModes.=");";

//echo $con_system['high_rebate'];

$max_rebate=$con_system['rebates_'.$game_type['skey']];

$re_Normal=$user_rebate;

$re_Second=$user_rebate;



$plays_arr_list="var MinModeJiao='".$con_system['MinModeJiao']."';var MinModeFen='".$con_system['MinModeFen']."';var gamekey='".$gamekey."';var isAutoModes='".$AutoModes."';var isFixModes='".$FixedModes."';var isAutoForPlay='yes'; ".$ArrFixModes."var playlist={playid:'',shownum:'',minnum:'',maxnum:'',show_key:'',show_other:'',max_select:'',min_select:''};";
$plays_arr_list.="var selists=Array();var peroarr=Array();var perotimearr=Array();var seltask={istask:'no',perstop:'no',nums:'0',moneys:'0',list:''};var rearr={'Normal':'".$re_Normal."','Second':'".$re_Second."'};
";
$plays_arr_list.=$js_a.$js_b.$js_c.$js_d.$js_e.$js_g.$js_h.$js_i;

//if(!file_exists("static/js/ssc/{$gamekey}.js"))
//file_write("static/js/ssc/{$gamekey}.js", $plays_arr_list);

$perarrs=get_now_period($gamekey,$time_arr);
$selplay="var selplay={code:'',plays:'',times:'1',modes:'".$modes."',retype:'Normal',CurMode:'".$CurMode."',CurModeType:'".$CurModeType."',AutoModeNum:'".$AutoModeNum."',MinBonus:'".$con_system['MinBonus']."','isTask':'',lotpriod:'".$perarrs['period']."',pre_period:'".$perarrs['pre_period']."',stoptime:'".$perarrs['stoptime']."',lastsecond:'".$perarrs['lastsecond']."',begin:'".$perarrs['begin']."',end:'".$perarrs['end']."',lostnums:'".$perarrs['lastsecond']."',isbuy:'".$perarrs['isbuy']."',lotnum:'".$perarrs['lotnum']."',per_num:'".$perarrs['num']."',per_sum:'".$perarrs['sum']."','modes_sys':'{$con_system['modes']}'};";
//$selplay="<script>$selplay</script>";
$selplay.=$plays_arr_list;
//if($u_reBonus['reBonus']=="close"){$AutoModes="no";}
//echo $perarrs['lotnum'];
//echo $period_s[1];
/*期号列表*/
$nowdate=core_fun::nowtime('d','yes');$nextdate=core_fun::nextdates('yes');
$nowdate_s=core_fun::nowtime('d');$nextdate_s=core_fun::nextdates();
$offset=array_search($perarrs['lotnum'],$period_s);
$do_key="ss";$lotlistarrs=array();$lottimearrs=array();
if($gamekey=="3D" OR $gamekey=="P5(P3)"){$offset=0;$do_key="dp";}
if($gamekey=="LJSSC" or strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false or  $gamekey=='HGSSC' or  $gamekey=='JNDSSC' or  $gamekey=='DJSSC' or  $gamekey=='BJSSC'or  $gamekey=='TWSSC' ){$do_key="fl";}
$fl_num=0;

$this_end_time=core_fun::nowtime('t','yes');
$peri_end_time=str_replace(":","",$perarrs['end']);
$peri_end_time=str_replace("-","",$peri_end_time);
$peri_end_time=str_replace(" ","",$peri_end_time);
$is_next_date="no";

/**/




$perlist=lottery_list($gamekey,9);


$tpl->assign('zui_list',get_zuilist());



$note=$db->fetch_all("select * from news where id>0 and (cate='13' or cate in (select id from news_cate where pid='13') ) order by `sort` asc,id desc  limit 0,6");
foreach ($note as $key=>$value) {
	  $row=	$db->fetch_first("select * from news_cate where id='{$value['cate']}'");
                             $note[$key]['catename']=$row['title'];
                             $note[$key]['date']=date('Y-m-d',$value['time']);

}

$tpl->assign('note',$note);

$tpl->assign('top_list',$top_list);


$gameinfo=$db->fetch_first("select * from game_type where ckey='{$gamekey}'");



$tpl->assign('gameinfo',$gameinfo);






$time1=$db->fetch_first("select * from game_time where playKey='{$gamekey}' order by lotNum asc limit 0,1");

$time2=$db->fetch_first("select * from game_time where playKey='{$gamekey}' order by lotNum desc limit 0,1");

	$time_list=$db->fetch_all("select * from game_time where playKey='{$gamekey}' order by lotNum asc");
	$cha=array();
	$t_info='';
	for ($i=1; $i<=count($time_list);$i++) {

	  $temp=str_to_time($time_list[$i]['beginTime'])-str_to_time($time_list[$i-1]['beginTime']);
 if(!in_array($temp, $cha) and $temp>0) {

	  $cha[]=$temp;
	  $t_info[]=array($time_list[$i]['beginTime'],$time_list[$i]['endTime']);
 }
	}


$tpl->assign("game_time_sum",count($time_list));

$endtime=strtotime(date('Y-m-d',time()+24*3600).' 00:00:00');
$qitime="var qitime = new Array();　";
//print_r($time_arr);
foreach ($time_arr as $key=>$value) {
    if(strtotime($time_arr[$key]['end'])<$endtime){
        $item1=date('Y-m-d ').$time_arr[$key]['end'];
        if(strpos($perarrs['period'],date('Ymd'))!==false)
            $item=date('Ymd').$key;
        else{
            $item= $perarrs['period']+($key-$perarrs['lootnum']);

        }
        $qitime.="qitime[{$item}]='{$item1}';";
    }


}
$qitime.="var qinums = new Array();　";
foreach ($time_arr as $key=>$value) {
    if(strtotime($time_arr[$key]['end'])<$endtime){
        if(strpos($perarrs['period'],date('Ymd'))!==false)
            $item=date('Ymd').$key;
        else{
          $item= $perarrs['period']+($key-$perarrs['lootnum']);

        }
        $qitime.="qinums[{$key}]='{$item}';";
    }


}


$wanfa1='';
if(count($wanfa)>0 and is_array($wanfa)){
	
	foreach ($wanfa as $key=>$value) {
	if(count($value)>0){
		foreach ($value as $key1=> $value1) {
			if($wanfa1=='')$wanfa1=$value1;
			else $wanfa1.=','.$value1;
		}
		
	}
	}
	
}
$qitime.="var wanfa='".$wanfa1."';";;

$tpl->assign('qitime',$qitime);



if($game_type['ckey']=='MMSSC') $tpl->assign("MMSSC",1);
$tpl->assign("navtitle",$game_type['fullname']);
//print_r($lotlistarrs);
$tpl->assign('hm_fee',$hm_fee);
$tpl->assign('game_content',$game_content);
//$tpl->assign('game_content',array(substr($time1['beginTime'], 0,5),substr($time2['endTime'], 0,5)));
$tpl->assign("game_play",$game_play);
$tpl->assign("game_type",$game_type);
$tpl->assign("game_notice",$game_notice);
$tpl->assign("ModeList",$mode_list);
$tpl->assign("FixedModes",$FixedModes);
$tpl->assign("AutoModes",$AutoModes);
$tpl->assign("CurMode",$CurMode);
$tpl->assign("CurModeType",$CurModeType);
$tpl->assign("modes",$modes);
$tpl->assign("fandian",($modes-1700)/20);
$tpl->assign("usermode",$userinfo['modes']);
$tpl->assign("con_system",$con_system);
$tpl->assign("lotlistarrs",$lotlistarrs);
$tpl->assign("tasktimearrs",$lottimearrs);
$tpl->assign("perlist",$perlist);
$tpl->assign("periodarrs",$perarrs);
$tpl->assign("periodcss",$percss);
$tpl->assign("play",$gamekey);
$tpl->assign("gamename",$con_game_list[$gamekey]);
$tpl->assign("selplay",$selplay);
$tpl->assign("bul_arr_party",$bul_arr_party);
if(strpos($_GET['play'], 'K3')!==false or $_GET['play']=='3D' or $_GET['play']=='PL3') $tpl->assign('k3',1);

$game_same=$db->fetch_all("select * from game_type where skey='{$game_type['skey']}' and status='0' and ckey!='{$game_type['ckey']}' order by sort asc");
$tpl->assign('game_same',$game_same);
$game_shortname=str_replace($arr_game_code[$game_type['skey']],'',$game_type['fullname']);
$tpl->assign('game_shortname',$game_shortname);
if($game_type['skey']=='k3'){
    $game_same=$db->fetch_all("select * from game_type where skey='{$game_type['skey']}' and status='0' order by sort asc");
    $tpl->assign('game_same_nav',$game_same);
}

?>