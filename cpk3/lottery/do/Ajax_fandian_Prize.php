<?php

//$this_date=date("Ymd",time());
//$nowtime=date("Y-m-d H:i:s",time());
//$period=$_GET['period'];
//mysql_query("set names utf8;");
//
//if($period==""){
//$sql_p="SELECT id,buyid,userid,playkey,list_id,money,pri_mode,ModeType,modes,money FROM game_buylist where ((status='2' and isprize='is_yes') or (status='1' and isprize='is_no')) limit 0,30";
//$result_p=mysql_query($sql_p);
//}else{
//$sql_p="SELECT id,buyid,userid,playkey,list_id,money,pri_mode,ModeType,modes,money FROM game_buylist where period='$period' and ((status='2' and isprize='is_yes') or (status='1' and isprize='is_no')) limit 0,30";
//$result_p=mysql_query($sql_p);
//}
//
////echo $sql_p;
//
//$nums1=mysql_num_rows($result_p);
//
//if($nums1){
//while($rows1=mysql_fetch_array($result_p)){
//$money=$rows1[money];
//
//$userid=$rows1[userid];
//$pid=get_user_pid($userid);
//
//for($i=1;$i<count($pid);$i++){
//	if($pid[$i]['rebate']>$pid[$i-1]['rebate'] and $pid[$i]['isproxy']==0){
//		
//		$now_money=$money*($pid[$i]['rebate']-$pid[$i-1]['rebate'])/100;
//
//		$this_uid=$pid[$i]['userid'];
//$strSql="update user_bank set hig_amount=hig_amount+'$now_money' where userid='$this_uid'";
//
//mysql_query($strSql);
//$log_floatid=$rows1['buyid'];
//
//getsql::banklog($now_money,"hig_rebate",$this_uid,"系统返点",$log_floatid,$rows1['playkey'],$rows1['modes']);
//
//	}
//	else{
//		
//		break;
//	}
//	
//}
//exit();
//	$strSql="update game_buylist set `status`='3' where buyid='$rows1[buyid]'";
//mysql_query($strSql);
//}
//}
//mysql_close();

?>