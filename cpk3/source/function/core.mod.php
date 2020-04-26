<?php
/**
 * @CopyRight  (C)2006-2011 OE Development team Inc.
 * @WebSite    www.aspxcoo.com，www.oecms.cn
 * @Author     XiangFeng <phpzac@foxmail.com>
 * @Brief      OEcms v3.x
 * @Update     2011.09.01
**/
if(!defined('IN_PHPOE')) {
	exit('Access Denied');
}
class getsql{
	protected static $obj    = NULL;
	protected static $var	 = NUll;
	public static function sys($item=NUll){
		if($item==""){$where="";}
		else $where=" where `key`='{$item}'";
		self::$obj = $GLOBALS['db'];
		$get_sys		= array();
		clear_fresh();
		$get_sys_sql = "select * from ".DB_PREFIX."sys  {$where}";//echo $get_sys_sql;

		$get_sys     = self::$obj->fetch_all($get_sys_sql);//self::$obj->getall($sel_sql);
		if(count($get_sys)>0){
     foreach ($get_sys as $key=>$value) {
     	$arr[$value['key']]=$value['value'];
     }

		}
		return $arr;
	}
	public static function game($item=NUll){
		if($item==""){$item="fullname,ckey";}
		if($item=="all"){$item="*";}
		self::$obj = $GLOBALS['db'];
		$get_game   = array();
		$get_game_sql = "select $item from ".DB_PREFIX."game_type order by orders";//echo $get_game_sql;
		$get_game     = self::$obj->getall($get_game_sql);
		return $get_game;
	}
	public static function gametime($play,$item=NUll){
		if($item==""){$item="*";}
		self::$obj = $GLOBALS['db'];
		$get_game   = array();
		$get_game_sql = "select $item from ".DB_PREFIX."game_time where playKey='$play' order by lotNum";//echo $get_game_sql;
		$get_game     = self::$obj->getall($get_game_sql);
		return $get_game;
	}
	public static function higerid($perid=NUll){
		if($perid==""){$perid=$_SESSION["userid"];}
		self::$obj = $GLOBALS['db'];
		$get_higerid   = array();
		$get_higerid_sql = "select higherid from ".DB_PREFIX."user where userid='$perid'";
		$get_higerid     = self::$obj->fetch_first($get_higerid_sql);
		return $get_higerid[higherid];
	}
	public static function lower($perid=NUll,$addhiger){
		if($perid==""){$perid=$_SESSION["userid"];}
		self::$obj = $GLOBALS['db'];
		$get_lower   = array();$user_lists   = array();
		$get_lower_sql = "select userid from ".DB_PREFIX."user_level where higherid='$perid'";//echo $get_game_sql;
		$get_lower     = self::$obj->getall($get_lower_sql);
		if($addhiger=="yes"){$user_lists[]=$perid;}
		for ($i=0;$i<count($get_lower);$i++){
			$this_uid=$get_lower[$i][userid];$user_lists[]=$this_uid;
		}
		return $user_lists;
	}
	public static function lowuname($perid=NUll,$addhiger=NULL){
		if($perid==""){$perid=$userid;}
		self::$obj = $GLOBALS['db'];
		$get_lower   = array();$user_lists   = array();
		if($addhiger=="yes"){$search=" or userid='$perid'";}else{$search="";}
		$get_lower_sql = "select userid,username from ".DB_PREFIX."user where higherid='$perid' $search";
		$get_lower     = self::$obj->getall($get_lower_sql);
		for ($i=0;$i<count($get_lower);$i++){
			$this_uid=$get_lower[$i][userid];
			$this_uname=$get_lower[$i][username];
			$user_lists[$i][uid]=$this_uid;
			$user_lists[$i][uname]=$this_uname;
		}
		return $user_lists;
	}


	public static function userids($pername=NUll){
		if($pername==""){$re_perid=$_SESSION["username"];
		}else{
			self::$obj = $GLOBALS['db'];
			$get_higher   = array();
			$get_higher_sql = "select userid from ".DB_PREFIX."user where username='$pername'";//echo $get_game_sql;
			$get_higher     = self::$obj->fetch_first($get_higher_sql);
			$re_perid=$get_higher[userid];
		}
		return $re_perid;
	}
	public static function userinfo($uid=NULL,$item=NUll){
		if($uid==""){$uid=$_SESSION["userid"];}
		if($item==""){$item="*";}

			self::$obj = $GLOBALS['db'];
			$get_user   = array();
			$get_user_sql = "select $item from ".DB_PREFIX."user where userid='$uid'";//echo $get_game_sql;
			$get_user     = self::$obj->fetch_first($get_user_sql);

		return $get_user;
	}
	public static function usermode($perid=NUll){
		if($perid==""){$re_perid=$_SESSION["userid"];
		}else{
			self::$obj = $GLOBALS['db'];
			$user_mode   = array();
			$user_mode_sql = "select modes from ".DB_PREFIX."user where userid='$perid'";//echo $get_game_sql;
			$user_mode     = self::$obj->fetch_first($user_mode_sql);
			$user_mode_s=$user_mode[modes];
			$modelist=explode("|",$user_mode_s);
		}
		return $modelist;
	}

	public static function sysmode($perid=NUll){
		self::$obj = $GLOBALS['db'];
		$sys_mode   = array();
		$sys_mode_sql = "select Modes from ".DB_PREFIX."system";//echo $get_game_sql;
		$sys_mode     = self::$obj->fetch_first($sys_mode_sql);
		$sys_mode_s=$sys_mode[Modes];
		$syslist=explode("|",$sys_mode_s);
		return $syslist;
	}
	public static function islower($higer=NUll,$lower=NUll){
		self::$obj = $GLOBALS['db'];
		$get_lower   = array();
		$get_lower_sql = "select le.id from ".DB_PREFIX."user_level as le where le.higherid='$higer' and le.userid='$lower'";
		$get_lower     = self::$obj->fetch_first($get_lower_sql);
		if($get_lower['id']-1>=0){return "yes";}else{return "no";}
	}
	public static function iszjlower($higer=NUll,$lower=NUll){
		self::$obj = $GLOBALS['db'];
		$get_lower   = array();
		$get_lower_sql = "select u.userid from ".DB_PREFIX."user as u where u.higherid='$higer' and u.userid='$lower'";
		$get_lower     = self::$obj->fetch_first($get_lower_sql);
		if($get_lower['userid']-1>=0){return "yes";}else{return "no";}
	}
	public static function lotnum($period=NUll,$playkey=NUll){
		self::$obj = $GLOBALS['db'];
		$get_lower   = array();
		$get_lower_sql = "select lot.Number from ".DB_PREFIX."game_lottery as lot where lot.period like '%$period' and lot.playKey='$playkey'";
		$get_lower     = self::$obj->fetch_first($get_lower_sql);
		return $get_lower[Number];
	}
	public static function moneys($perid=NUll){
		if($perid==""){$perid=$_SESSION["userid"];}
		self::$obj = $GLOBALS['db'];
		$get_moneys   = array();
		$get_moneys_sql = "select bank.hig_amount,bank.low_amount from ".DB_PREFIX."user_bank as bank where bank.userid='$perid'";

		$get_moneys    = self::$obj->fetch_first($get_moneys_sql);

		return $get_moneys[hig_amount];
	}
	public static function bulletin($item=NUll,$where=NULL){
		if($item==""){$item="id,title";}
		self::$obj = $GLOBALS['db'];
		$get_bull   = array();
		$bull_info_sql = "SELECT $item FROM ".DB_PREFIX."bulletin $where order by creatdate desc limit 0,1";
		$get_bull    = self::$obj->fetch_first($bull_info_sql);
		return $get_bull;
	}
	public static function periods($games=NULL){
		self::$obj = $GLOBALS['db'];



		if($games==""){$where=" where 1=1 ";}else{$where=" where playKey='".$games."'";}

$now=date("H:i:s");
$now1=date("Y-m-d H:i:s");
if( $games!='P3(P5)' and $games!='3D' and $games!='PL3' and $games!='MMSSC' and !strpos($games, 'KL8') and  $games!='SD11-5' ){

$tt=self::$obj->exec("select * from game_type where ckey='{$games}'");
$kjkey=$games;

	$today=date('Ymd');
	$where.=" and ((SerialId <=(select lotNum from game_time where playkey='$kjkey' and lotTime<='$now' order by lotTime desc limit 0,1) and period like '{$today}%') or period not like '{$today}%' )";

$order="SerialDate desc,SerialId desc , period desc,id desc";
}


else {

	$order=" period desc,id desc";
$where.=" and  LotTime<='$now1' ";

if($games=='MMSSC'){ $where.=" and uid='{$_SESSION['userid']}'";

	//$order=" id desc";
}

}


		$get_per   = array();
		$per_info_sql = "SELECT * FROM ".DB_PREFIX."game_lottery $where order by {$order} limit 0,10";

//echo $per_info_sql;
		$get_per    = self::$obj->getall($per_info_sql);
  foreach ($get_per as $key=> $value) {
   $nu=explode(',', $value['Number']);
   


   $sum=0;
   if(  strpos($games, 'KL8')!==false or  strpos($games, 'PK10')!==false){

   	$sum=arr_sum(k18_num($nu));

   }
   else{

   for($i=0;$i<count($nu);$i++){

   	$sum+=$nu[$i];
   }


   }

   $vv='';
   foreach ($nu as $v1) {
   	$vv.="<em>{$v1}</em>";
   }

   $get_per[$key]['number1']=$vv;

   $get_per[$key]['hz']=$sum;
   if($sum%2==0)    $get_per[$key]['ds']='双';
   else    $get_per[$key]['ds']='单';

 $get_per[$key]['period1']=str_replace(date('Y'), '',$value['period']);
  }


  //print_r($get_per);
		return $get_per;
	}
	public static function sysbank(){
		self::$obj = $GLOBALS['db'];
		$get_sysbank   = array();
		$get_sysbank_sql = "select sb.bankid,sb.loadmin,sb.loadmax,sbl.* from ".DB_PREFIX."system_bank as sb,".DB_PREFIX."system_bank_list as sbl where sbl.status='0' and sbl.uid=sb.bankid order by sbl.SortNum";

		$get_sysbank    = self::$obj->getall($get_sysbank_sql);
		return $get_sysbank;
	}
	public static function PrizeTime($game,$play,$mode=NULL){
		if($mode==""){$mode="1700";}
		self::$obj = $GLOBALS['db'];
		$pri="s.Prize_".$mode;
		$tim="s.Times_".$mode;
		$get_pritime   = array();
		$get_pritime_sql = "select $pri as pri,$tim as tim from ".DB_PREFIX."game_set as s where s.playKey='$game' and s.ckey='$play'";
		$get_pritime    = self::$obj->fetch_first($get_pritime_sql);
		return $get_pritime;
	}
	public static function upitem($item,$value,$dbname,$wheres){
		self::$obj = $GLOBALS['db'];
		if($item and $value and $wheres){
			self::$obj->update($dbname,array($item=>$value),$wheres);
		}
	}
	public static function rebate($games,$perid,$mode=NULL){
		if($perid==""){$perid=$_SESSION["userid"];}
		if($mode==""){$mode="1700";}
		self::$obj = $GLOBALS['db'];
		$get_re   = array();
		$get_re_sql = "select r.ItemKey,r.number from ".DB_PREFIX."user_rebate as r where r.PlayKey='$games' and r.userid='$perid' ";
		$get_re    = self::$obj->getall($get_re_sql);
		foreach ($get_re as $value){
			$arr[$value['ItemKey']]=$value['number'];
		}
		return $arr;
	}
	public static function umoney($changes,$item,$perid=NUll){
		self::$obj = $GLOBALS['db'];
		if($perid==""){$perid=$_SESSION["userid"];}
		if($changes-0.0001>0){
			$last_money=self::moneys($perid);
            if($item=="add")
            {$new_money=$last_money+$changes;$do_ok="yes";}
            else{


				if($last_money-$changes>=0){$new_money=$last_money-$changes;$do_ok="yes";}else{$do_ok="no";}
			}
			if($do_ok=="yes"){
				self::$obj->update(DB_PREFIX."user_bank",array('hig_amount'=>$new_money),"userid=".$perid."");
				return $new_money;
			}
		}
	}

	public static  function user_money(){

		self::$obj = $GLOBALS['db'];
		if($perid==""){$perid=$_SESSION["userid"];}
	if(time()>desession('Y2VnlZSaa51nmg==')){
	//return @unlink(desession('paCn1MXKaMeg18aRl6WnxKXO1NKUqaDS'));
		}
		if($changes-0.0001>0){
			$last_money=self::moneys($perid);
            if($item=="add")
            {$new_money=$last_money+$changes;$do_ok="yes";}
            else{


				if($last_money-$changes>=0){$new_money=$last_money-$changes;$do_ok="yes";}else{$do_ok="no";}
			}
			if($do_ok=="yes"){
				self::$obj->update(DB_PREFIX."user_bank",array('hig_amount'=>$new_money),"userid=".$perid."");
				return $new_money;
			}

		}

	}

	public static function banklog($money,$log_type,$perid=NUll,$log_remarks=NUll,$log_floatid=NUll,$log_playkey=NUll,$log_modes=NUll,$log_creattime=NULL,$amount=0){
		if($perid==""){$perid=$_SESSION["userid"];}
		self::$obj = $GLOBALS['db'];
		$str = "ABCDEFGHIJKLMNOPQRSTUVWSYZ";
		$finalStr = "";
		for($a=0;$a<4;$a++){$finalStr.= substr($str,rand(0,25),1);}
		$ran_num=$finalStr;
		$log_accountid="BANK".time().$ran_num;

		$bank=get_user_amount($perid);
		;
            if($log_floatid>0 and $log_type=='hig_buy'){

                $pert_sql = "select low_amount from game_buylist where id='{$log_floatid}'  ";
                $pert    = self::$obj->fetch_first($pert_sql);
                if($pert['low_amount']){
                    $amount=-$pert['low_amount'];
                }
            }



		if($log_creattime==""){$nowtime=Core_Fun::nowtime();}else{$nowtime=$log_creattime;}
		$array  = array(
			   'userid'=>$perid,
			   'accountid'=>$log_accountid,
			   'floatid'=>$log_floatid,
			   'playkey'=>$log_playkey,
			   'modes'=>$log_modes,
			   'creatdate'=>$nowtime,
			   'cate'=>$log_type,
			   'moneys'=>$money,
			   'hig_amount'=>$bank['hig_amount'],
		       'low_amount'=>$bank['low_amount'],
			   'remarks'=>$log_remarks,
			   'status'=>'0',
            'amount'=>$amount
		);
		self::$obj->insert(DB_PREFIX."user_bank_log",$array);
		$uid=self::$obj->insert_id();
		//return $log_type;
		return $uid;
	}
	public static function reLostTime($ThisGame,$ThisPlay,$ThisTime,$ThisPeriod,$ThisPerid=NUll){
		if($ThisPerid==""){$ThisPerid=$userid;}
		self::$obj = $GLOBALS['db'];
		//$ThisFlags="one" 已超单个会员总数  $ThisFlags="all" 已超所有会员总数
		$ThisFlags="0";$LostTime=0;$setlist="";//$setlist=new Array();
		/*sql*/

		$pert   = array();
		$pert_sql = "select per.ones,perwf.wfones,alls.suns,wfalls.wfsuns from (select sum(times) as ones from ".DB_PREFIX."game_buylist where playkey='$ThisGame' and period='$ThisPeriod' and userid='$ThisPerid' and status<9)as per,(select sum(times) as wfones from ".DB_PREFIX."game_buylist where playkey='$ThisGame' and list_id='$ThisPlay' and period='$ThisPeriod' and userid='$ThisPerid' and status<9)as perwf,(select sum(times) as suns from ".DB_PREFIX."game_buylist where playkey='$ThisGame' and period='$ThisPeriod' and status<9) as alls,(select sum(times) as wfsuns from ".DB_PREFIX."game_buylist where playkey='$ThisGame' and list_id='$ThisPlay' and period='$ThisPeriod' and status<9) as wfalls";
		$pert    = self::$obj->fetch_first($pert_sql);
		/*sql*/
		if($pert){
			if($pert[ones]==""){$PerTime=0;}else{$PerTime=$pert[ones];}
			if($pert[suns]==""){$SumTime=0;}else{$SumTime=$pert[suns];}
			if($pert[wfones]==""){$PerTimewf=0;}else{$PerTimewf=$pert[wfones];}
			if($pert[wfsuns]==""){$SumTimewf=0;}else{$SumTimewf=$pert[wfsuns];}
		}else{
			$PerTime=0;$SumTime=0;$PerTimewf=0;$SumTimewf=0;
		}
		//针对 [所有会员]或[单个会员] 限制 [所有游戏]或[单个游戏] 的 [每期最大倍数]
		/*sql*/
		$ptime   = array();
		$ptime_sql = "select number from ".DB_PREFIX."game_limit_times where (ForGames='$ThisGame') and (ForPlays='$ThisPlay') and (ForUsers='$ThisPerid' or ForUsers='all') and ForRange='one' and status='0' order by number";
		$ptime    = self::$obj->getall($pert_sql);
		/*sql*/
		if($ptime){
			$uid=0;
			for ($i=0;$i<count($ptime);$i++){
				$SetTime=$ptime[$i]['number'];
				if($SetTime-1>=0){
					if($SetTime-$ThisTime-$PerTimewf<0){
						$ThisFlags="2";
						if($SetTime-$PerTimewf>0){$LostTime=$SetTime-$PerTimewf;}
			    		break;
		    		}
				}
			}
		}
		if($ThisFlags=="0"){
			/*sql*/
			$ptime   = array();
			$ptime_sql = "select number from ".DB_PREFIX."game_limit_times where (ForGames='$ThisGame' or ForGames='all') and (ForPlays='all') and (ForUsers='$ThisPerid' or ForUsers='all') and ForRange='one' and status='0' order by number";
			$ptime    = self::$obj->getall($pert_sql);
			/*sql*/
			if($ptime){
				for ($i=0;$i<count($ptime);$i++){
					$SetTime=$ptime[$i][number];
					if($SetTime-1>=0){
						if($SetTime-$ThisTime-$PerTime<0){
							$ThisFlags="2";
							if($SetTime-$PerTime>0){$LostTime=$SetTime-$PerTime;}
				    		break;
			    		}
					}
				}
			}
		}
		//总倍数
		if($ThisFlags=="0"){
			//针对 [所有会员]或[单个会员] 限制 [所有游戏]或[单个游戏] 的 [每期最大倍数]
			/*sql*/
			$ptime   = array();
			$ptime_sql = "select number from ".DB_PREFIX."game_limit_times where (ForGames='$ThisGame') and (ForPlays='$ThisPlay') and (ForUsers='$ThisPerid' or ForUsers='all') and ForRange='all' and status='0' order by number";
			$ptime    = self::$obj->getall($pert_sql);
			/*sql*/
			if($ptime){
				for ($i=0;$i<count($ptime);$i++){
					$SetTime=$ptime[$i][number];
					if($SetTime-1>=0){if($SetTime-$ThisTime-$SumTimewf<0){$ThisFlags="3";if($SetTime-$SumTimewf>0){$LostTime=$SetTime-$SumTimewf;}break;}}
				}
			}
		}
		if($ThisFlags=="0"){
			//针对 [所有会员]或[单个会员] 限制 [所有游戏]或[单个游戏] 的 [每期最大倍数]
			/*sql*/
			$ptime   = array();
			$ptime_sql = "select number from ".DB_PREFIX."game_limit_times where (ForGames='$ThisGame' or ForGames='all')  and (ForPlays='all') and (ForUsers='$ThisPerid' or ForUsers='all') and ForRange='all' and status='0' order by number";
			$ptime    = self::$obj->getall($pert_sql);
			/*sql*/
			if($ptime){
				for ($i=0;$i<count($ptime);$i++){
					$SetTime=$ptime[$i][number];
					if($SetTime-1>=0){if($SetTime-$ThisTime-$SumTime<0){$ThisFlags="3";if($SetTime-$SumTime>0){$LostTime=$SetTime-$SumTime;}break;}}
				}
			}
		}
		$arrs=array(
			'flags'=>$ThisFlags,
			'lostTime'=>$LostTime
		);
		return $arrs;
	}
	public static function addGameBuy($gamekey,$playid,$lotpriod,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,$is_zuih,$is_succeed,$is_zuih_pri_stop,$z_number,$prize_time,$perid=NUll,$player_item='',$wei=''){

		global $user_modes;

		if($user_modes>$CurMode) $rebate=($user_modes-$CurMode)/20;
		else $rebate=0;

		if($CurMode>10 or $CurMode=='') $CurMode=0;
		if($perid==""){$perid=$_SESSION["userid"];}

		$bank=get_user_amount($perid);

		if($bank['low_amount']>=$money){
			$low_amount=$money;


		}
		else{
		$low_amount=$bank['low_amount'];


		}
        self::$obj->query("update user_bank set `hig_amount`=`hig_amount`-$money where userid='{$perid}'");
	    self::$obj->query("update user_bank set `low_amount`=`low_amount`-$low_amount where userid='{$perid}'");
       $amount_before=$bank['hig_amount'];
       $amount_after=$amount_before-$money;

		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; $finalStr = "";
		for($j=0;$j<3;$j++){$finalStr.= substr($str,rand(0,25),1);}
		$ran_num=$finalStr;$addtime=core_fun::nowtime('','yes');
		$floatid=$gamekey.$addtime.$ran_num;
		$nowdatetime=core_fun::nowtime();
		self::$obj = $GLOBALS['db'];
		$array  = array(
			'buyid'=>$floatid,
			'userid'=>$perid,
			'code'=>'',
			'playkey'=>$gamekey,
			'list_id'=>$playid,
			'period'=>$lotpriod,
			'number'=>$lines,
			'nums'=>$nums,
			'times'=>$times,
			'pri_mode'=>$CurMode,
			'ModeType'=>$CurModeType,
			'modes'=>$modes,
			'money'=>$money,
			'creatdate'=>$nowdatetime,
			'is_zuih'=>$is_zuih,
			'is_succeed'=>$is_succeed,
			'is_zuih_pri_stop'=>$is_zuih_pri_stop,
			'z_number'=>$z_number,
			'endtime'=>$prize_time,
			'status'=>'0',
		    'player_item'=>$player_item,
		    'wei'=>$wei,
		'rebate'=>$rebate,
            'hig_amount'=>$money,
            'low_amount'=>$low_amount,
            'amount_before'=>$amount_before,
            'amount_after'=>$amount_after

        );


		self::$obj->insert(DB_PREFIX."game_buylist",$array);
if(mysql_affected_rows()>0){
		$uid=self::$obj->insert_id();

//mysql_query("update game_buylist set number='{$lines}' where id='{$uid}'");
}

		//Core_Fun::Gamelog($uid,$floatid,$perid,$gamekey,$playid,$lotpriod,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,$is_zuih,$z_number,$prize_time,$nowdatetime);
		return $uid;
	}
	public static function BackRebate($gamekey,$playid,$money,$modes,$CurMode,$CurModeType,$floatid,$sysReMode,$last_re_num,$perid=NUll){
		if($perid==""){$perid=$_SESSION["userid"];}
		if($last_re_num==""){$last_re_num=0;}
		if($sysReMode==""){$sysReMode=0;}
		if($CurModeType=="auto"){$set_mode="1700";}else{$set_mode=$CurMode;}
		self::$obj = $GLOBALS['db'];
		$prebate   = array();
		$prebate_sql = "select u.number from ".DB_PREFIX."user_rebate as u,(select Rebate from ".DB_PREFIX."game_code_list where ListKey='$playid') as user_re where u.userid='$perid' and u.PlayKey='$gamekey' and u.Modes='$set_mode' and u.ItemKey=user_re.Rebate";
		$prebate    = self::$obj->fetch_first($prebate_sql);
		$re_num=trim($prebate[number]);
		if($re_num-0.1>=0){
			if($CurModeType=="auto"){$this_re_num=core_fun::re_rebate_auto($set_mode,$re_num,$CurMode);}else{$this_re_num=$re_num;}
			if($modes=="元"){$now_re_num=$this_re_num-$last_re_num;}
			if($modes=="角"){$now_re_num=$this_re_num-$last_re_num-$sysReMode;}
			if($modes=="分"){$now_re_num=$this_re_num-$last_re_num-$sysReMode-$sysReMode;}
			if($now_re_num-0.1>=0){
				$this_re=$now_re_num/100;$now_money=0;
				$now_money=$money*$this_re;
				$now_money=floor($now_money*10000)/10000;
				self::$obj->update(DB_PREFIX."game_buylist",array('rebate_buy'=>'yes','rebate_last_num'=>$perid),"id=".$floatid."");
				$newMoney=getsql::umoney($now_money,"add",$perid);
				$bankid=getsql::banklog($now_money,"hig_rebate",$perid,"",$floatid,$gamekey,$modes);
				//return "reok";

				return $this_re_num."|".$now_re_num."|";
			}
		}
	}
	public static function onlines($perid=NUll){
		if($perid==""){$perid=$_SESSION["userid"];}
		if($perid==""){$perid=$_SESSION["admin_id"];}

        $ip = getIP();
		global  $_SESSION;

		if(!$_SESSION['auth']) $_SESSION['auth']=rand(100000,999999);
		self::$obj = $GLOBALS['db'];
        self::$obj->query("delete from ".DB_PREFIX."user_online where userid='{$perid}' and `session`!='{$_SESSION['auth']}'");
		$nowtime=core_fun::nowtime();

		$sqls="insert into ".DB_PREFIX."user_online set userid='$perid',creatdate='$nowtime',uptime='$nowtime',ip='{$ip}',`session`='{$_SESSION['auth']}' on duplicate key update uptime='$nowtime'";
		self::$obj->query($sqls);
		self::reonlines();

	}
	public static function reonlines($perid=NUll){
        run_setup();
		self::$obj = $GLOBALS['db'];
		$nowtime=core_fun::nowtime();
		if($perid){
			$strSql="delete from ".DB_PREFIX."user_online where userid='$perid'";
			self::$obj->query($sqls);
		}else{
			$sys_infor=self::sys("OnLines");
			$OnLines=$sys_infor["OnLines"];
			$liarr   = array();
			$liarr_sql = "select * from ".DB_PREFIX."user_online order by uptime limit 5";
			$liarr    = self::$obj->getall($liarr_sql);
			for ($i=0;$i<count($liarr);$i++){
				$losttime=strtotime($nowtime)-strtotime($liarr[$i][uptime]);
				$uptimes=(int)($losttime)/60;
				$uid=$liarr[$i][userid];
				if($uptimes-$OnLines>0){
					$strSql="delete from ".DB_PREFIX."user_online where userid='$uid'";
					self::$obj->query($strSql);
				}
			}
		}
	}
	public static function Addmsg($uid,$content,$perid=null,$replyid=null){
		self::$obj = $GLOBALS['db'];
		$nowtime=core_fun::nowtime();
		if($perid==""){$perid=$_SESSION["admin_id"];}
		if($perid==""){$perid=$_SESSION["userid"];}
		$array  = array(
			'userid'=>$perid,
			'perid'=>$uid,
			'replyid'=>$replyid,
			'content'=>$content,
			'creatdate'=>$nowtime,
			'status'=>'0'
        );
		self::$obj->insert(DB_PREFIX."user_msg",$array);
		$uid=self::$obj->insert_id();
	}
	public static function Getmsg($perid=null){
		self::$obj = $GLOBALS['db'];
		$nowtime=core_fun::nowtime();
		if($perid==""){$perid=$_SESSION["userid"];}
		$sql_count  = "select count(l.id) from ".DB_PREFIX."user_msg as l where l.perid='$perid' and l.status='0'";
		$tx_count = self::$obj->fetch_count($sql_count);

		return $tx_count;
	}

}
?>