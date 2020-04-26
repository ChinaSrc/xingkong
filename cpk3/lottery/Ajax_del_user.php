<?php
exit('无权限操作');
$uid=$_POST['uid'];
$sql_ama="select user.higherid,user_bank.hig_amount from user_bank,user where user.userid='$uid' and user_bank.userid=user.userid";
$result_ama=mysql_query($sql_ama);
$rows_ama=mysql_fetch_array($result_ama);
$hig_amount=$rows_ama[hig_amount];

$s11=$db->fetch_first("select userid from user where username='{$con_system['sys_user']}'");
if($con_system['sys_user_open']==1 and  $s11['userid']){
	
	$higherid=$s11['userid'];
	
}
else{
$higherid=$rows_ama[higherid];	
	
}
$flags="yes";
if($higherid==""){
	if($s11['userid']) $higherid=$s11['userid'];
	else $higherid='0';
	
	
}

$sql_uid="select userid from user where user.higherid='$uid'";
$result_uid=mysql_query($sql_uid);
$nums_P=mysql_num_rows($result_uid);
if($nums_P){
while($rows_uid=mysql_fetch_array($result_uid)){
$lowuid=$rows_uid[userid];
$sqldel = "delete from user_level where userid='$lowuid' and higherid='$higherid'";
mysql_query($sqldel) or die("插入时出错4".mysql_error());
}
}
$sql_uid="select id,userid,CurUnder from user_level where user_level.higherid='$uid'";
$result_uid=mysql_query($sql_uid);
while($rows_uid=mysql_fetch_array($result_uid)){
if($rows_uid[CurUnder]=="yes"){
$strSql="update user_level set higherid='$higherid' where id='$rows_uid[id]'";
mysql_query($strSql) or die("插入时出错3".mysql_error());
}else{
$sqldel = "delete from user_level where id='$rows_uid[id]'";
$resultdel=mysql_query($sqldel);
}
}
$sqldel = "delete from user where userid =$uid";
$resultdel=mysql_query($sqldel);
$sqldel = "delete from user_bank where userid =$uid";
$resultdel=mysql_query($sqldel);
$sqldel = "delete from user_level where userid='$uid' and higherid='$higherid'";
$resultdel=mysql_query($sqldel);
$sql_uid="select userid from user where higherid='$uid'";
$result_uid=mysql_query($sql_uid);
while($rows_uid=mysql_fetch_array($result_uid)){
$strSql="update user set higherid='$higherid' where higherid='$uid'";
mysql_query($strSql) or die("插入时出错4".mysql_error());
}
echo $flags;
;echo ' ';
?>