
<?php

$uid = isset($_GET[uid]) ?$_GET[uid] : $_POST[uid];
$active = isset($_GET[active]) ?$_GET[active] : $_POST[active];
if($active=="lot_back"){
	$con_system=getsql::sys();
$GetFee_Single=$con_system[GetFee_Single];
$GetFee_Single_Rate=$con_system[GetFee_Single_Rate];
$Limit_Betting=$con_system[Limit_Betting];
$flags="no";
$game_info	= array();
$game_info_sql = "select b.* from ".DB_PREFIX."game_buylist as b where (b.id='$uid' or b.buyid='$uid')";
$game_info	= $db->fetch_first($game_info_sql);
$pri_time=$game_info['prize_time'];
$status=$game_info['status'];
$buyid=$game_info['id'];
$buymoney=$game_info['money'];
$pri_money=$game_info['pri_money'];
$low_money=$game_info['low_money'];
$hig_money=$game_info['hig_money'];
$userid=$game_info['userid'];

if(9-$status>0){
	$flags="yes";
	if($_GET['user']=='1'){

		$lotNum=str_replace(date('Ymd'), '', $game_info['period']);

	$game_time=	$db->fetch_first("select * from game_time where playKey='{$game_info['playkey']}' and  lotNum='{$lotNum}'");
		$nowtime=Core_Fun::nowtime();
$losttime=strtotime($game_time['lotTime'])-strtotime($nowtime);
$uptimes=(int)($losttime);
if($losttime>=$Limit_Betting){
$flags="yes";
}else{
	$flags="no";
}


	}

	if($flags=='yes'){

     if($_GET['user']==1)
	game_back($uid);
     else{
    game_back($uid,'系统撤单');

     }

$info="撤单成功";

	}
	else{
$info="开奖前{$Limit_Betting}秒无法撤单";


	}



}else{
$info="已是撤单状态，无需重复操作";

}
if($_GET['mobile']==1)
echo $info;
else {

	if($_GET['user']==1){
if($_GET['from']=='gamelist'){

    //echo "<script>parent.Ajax_get_buy();</script>";
}
else {

    if($info=='撤单成功')
        echo "<script>parent.window.wxc.xcConfirm('{$info}',parent.window.wxc.xcConfirm.typeEnum.success);</script>";
    else
        echo "<script>parent.window.wxc.xcConfirm('{$info}',parent.window.wxc.xcConfirm.typeEnum.warning);</script>";
    echo "<script>parent.Dialog.close();</script>";
}


	}
else{

echo "<div style='width:100%;text-align:center;color:#ff0000;'>$info</div>";
	echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}

}





exit;
}
;echo '


<style>
div{font-size:12px;line-height:30px;text-align:center;}
</style>
<form action="';echo $do_url."?mod=back&code=game&list=info&flag=yes&active=lot_back&uid=".$uid;;echo '" method="post" name="form1" id="form1">
<div>确定撤单？</div>
<div class=\'bottom2\'><input type=\'submit\' id=\'yes_button\' ';echo $disabled;;echo ' value=\'确定\'>　　<input type=\'button\' value=\'取消\' onclick="parent.pop.close();"></div>
</form>
';
?>