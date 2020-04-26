<? 
$nowtime=date("Y-m-d H:i:s",time()); 
$perid = $_GET['perid'];
if($perid==""){$perid=$userid;}
$pername = $_GET['username'];
$password = $_GET['password']; 
$persex = $_GET['sex'];  
$isproxy = $_GET['isproxy']; 
$proxynum = $_GET['proxynum']; 
$reBonus = $_GET['reBonus']; 
$modelist = $_GET['modelist'];  
$reModes = $_GET['reModes']; 
$mobilephone = $_GET['mobilephone']; 
$active = $_GET['active']; 
$qqnum = $_GET['qqnum']; 
$flags="yes";
include(SZS_ROOT_PATH."source/config/play/system.php");
	$user_ins	  = array();
	$user_ins_sql = "select proxynum,modes from ".DB_PREFIX."user where userid='$perid'";
	$user_ins     = $db->fetch_first($user_ins_sql);
	if($user_ins){ 
		$num=$user_ins[proxynum]; 
		//$modelist=$user_ins[modes]; 
		 
	}else{
		$num="0";
	}
    $u_names	  = array();
	$u_names_sql = "select userid from ".DB_PREFIX."user where username='$pername'";
	$u_names     = $db->fetch_first($u_names_sql);
	if($u_names[userid]-1>=0){
		$flags="no";$reinfo="same";
	}

if($proxynum==""){$proxynum=1;}
 	
if($active=="joyin"){
	$proxynum=0;  
}else{
	if($con_system['AccQuo']=="yes"){
		if($num-1<0){$flags="no";$reinfo="pro";}
		if($flags=="yes"){if($num-$proxynum<0){$flags="no";$reinfo="pro";}} 
    } 
}
if(preg_match("/[\x7f-\xff]/", $pername)){
     $re_info="不能使用中文作为用户名!";
     $flags="no";
} 
$password=md5($password);
if($flags=="yes"){
	$array  = array(
		'username'=>$pername,
		'nickname'=>$pername,
		'sex'=>$persex,
		'password'=>$password,
		'mobilephone'=>$mobilephone,
		'qqnum'=>$qqnum,
		'registertime'=>$nowtime,
		'higherid'=>$perid,
		'isproxy'=>$isproxy,
		'proxynum'=>$proxynum,
		'modes'=>$modelist,
		'reModes'=>'否',
		'status'=>'0'
	); 
	$db->insert(DB_PREFIX."user",$array);
	$uid=$db->insert_id();
	$higherid=$perid;$CurUnder="yes";$Level="0";
   while($higherid-1>=0){
	    $array  = array(
		   'userid'=>$uid,
		   'higherid'=>$higherid,
		   'Level'=>$Level,
		   'CurUnder'=>$CurUnder, 
	    );
	    $db->insert(DB_PREFIX."user_level",$array); 

		$user_level	  = array();
		$user_level_sql = "select higherid from ".DB_PREFIX."user where userid='$higherid'";
		$user_level     = $db->fetch_first($user_level_sql);
		if($user_level){ 
			$higherid=$user_level[higherid];  
		}else{
			$higherid="0";
		} 
		$CurUnder="no";
   }
    
   //将用户信息增加到银行帐号表#################
   $array  = array(
		'userid'=>$uid,
		'password'=>$password,
		'status'=>'0',
		'hig_amount'=>'0'
   );
   $db->insert(DB_PREFIX."user_bank",$array);  
    
   $strSql="update ".DB_PREFIX."user set proxynum=proxynum-$proxynum where userid='$perid'"; 
   $db->query($strSql);

 
   //if($active=="joyin"){
$user_rebate	  = array();
$user_rebate_sql = "select * from ".DB_PREFIX."user_rebate_demo where userid='$perid'";
$user_rebate     = $db->getall($user_rebate_sql); 
if(count($user_rebate)>1){ 
			for ($i=0;$i<count($user_rebate);$i++){
				$PlayKey=$user_rebate[$i][PlayKey];
		   		$ItemKey=$user_rebate[$i][ItemKey];
		   		$Modes=$user_rebate[$i][Modes];
		   		$number=$user_rebate[$i][number];
				if($number-0.1>=0){
					$new_num=$number;
			   		if($con_system['MaxBonus']-0.1>=0 and $new_num-$con_system['MaxBonus']>0){$new_num=$con_system['MaxBonus'];}
					$array  = array(
							'userid'=>$uid,
							'PlayKey'=>$PlayKey,
							'ItemKey'=>$ItemKey,
							'Modes'=>$Modes,
							'number'=>$new_num
 					);
					$db->insert(DB_PREFIX."user_rebate",$array); 
				}
			}
}else{
	/*
	   $user_rebate	  = array();
	   $user_rebate_sql = "select * from ".DB_PREFIX."user_rebate where userid='$perid'";
	   $user_rebate     = $db->getall($user_rebate_sql); 
	   if(count($user_rebate)>1){ 
			for ($i=0;$i<count($user_rebate);$i++){
				$PlayKey=$user_rebate[$i][PlayKey];
		   		$ItemKey=$user_rebate[$i][ItemKey];
		   		$Modes=$user_rebate[$i][Modes];
		   		$number=$user_rebate[$i][number];
				if($number-0.5>=0){
					$new_num=$number-0.5;
			   		if($con_system['MaxBonus']-0.1>=0 and $new_num-$con_system['MaxBonus']>0){$new_num=$con_system['MaxBonus'];}
					$array  = array(
							'userid'=>$uid,
							'PlayKey'=>$PlayKey,
							'ItemKey'=>$ItemKey,
							'Modes'=>$Modes,
							'number'=>$new_num
 					);
					$db->insert(DB_PREFIX."user_rebate",$array); 
				}
			}
	   }
	   */
}  
  
   $reinfo=$uid;
}
echo "#".$flags."|".$reinfo."|".$uid;
?>