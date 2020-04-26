<?php
include('config.php');
$active=$_GET['active'];

if($active=='getout'){
	
	$uid=$_GET['userid'];
	$db->query("delete  from user_online where userid='{$uid}'");
echo 'yes';	
}




if($active=='deluser'){
	
	$uid=$_GET['userid'];
	$db->query("delete  from user where userid='{$uid}'");
	$db->query("delete  from user_bank where userid='{$uid}'");
	$db->query("delete  from user_bank_list where userid='{$uid}'");
	$sys_user=$con_system['sys_user'];
	if($sys_user){
	$u=$db->fetch_first("select * from user where username='{$sys_user}'");	
	$hid=$u['userid'];
	$db->query("update user set higherid='{$hid}' where higherid='{$uid}'");		
	}

	
echo 'yes';	
}

if($active=='game_code'){
		$ckey= $_GET['ckey'];
		
			$config=getsql::sys();	 

		 if($config['game_qw']==2)  $where=" and  ( ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';
			
		$game=$db->fetch_first("select * from game_type where ckey='{$ckey}'");	
	$max_list=explode("|", $game['code']);
	$type= $_GET['skey'];
	
	
	
$sql_id="select * from game_code where status='0' and pid='0' and type='{$type}'    {$where} order by sortnum asc,  id asc";
$result_code=mysql_query($sql_id);
$no_date="请先配置游戏玩法";
$list_num=1;$brs="<br>";
while($rows_code=mysql_fetch_array($result_code)){
$this_bf=$list_num%4;
//if(($list_num-1)%4==0 or $list_num==1){echo "<tr>";}
$no_date="";


if(in_array($rows_code[ckey],$max_list)){$sl="checked";}else{$sl="";}
echo "<li  ><input type='checkbox' name='modes[]' value='".$rows_code[ckey]."' ".$sl."   onclick='set_code();'>".$rows_code[fullname]."&nbsp;&nbsp;</li>";
//if($list_num%4==0 or $list_num==4){echo "</tr>";}
$list_num+=1;
}
echo $no_date;
}



if($active=='game_code1'){
		$ckey= $_GET['ckey'];
		$game=$db->fetch_first("select * from game_type where ckey='{$ckey}'");	
	$max_list=explode("|", $game['code']);
	$type= $_GET['skey'];
	
				$config=getsql::sys();	 
		 if($config['game_qw']==2)  $where=" and  ( ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';
	
$sql_id="select * from game_code where status='0' and pid='0' and type='{$type}' {$where} order by id asc";
$result_code=mysql_query($sql_id);
$no_date="<option>请先配置游戏玩法</option>";
$list_num=1;$brs="<br>";
while($rows_code=mysql_fetch_array($result_code)){
$firstcode=explode("|",$game[firstcode]);
if($firstcode[0]==$rows_code[ckey]){$is_this_code="selected";}else{$is_this_code="";}
	echo "<option  value='".$rows_code[ckey]."' ".$is_this_code." >".$rows_code[fullname]."</option>";
	
}

}


exit();
?>