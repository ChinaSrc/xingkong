<?php

$userid=$_SESSION["userid"];
mysql_query("set names utf8;");
if($select==""){$select="*";}
if($sqlclass=="select"){
if($querys=="default"){
$sql_default="select $select from $dbnames $wheres";
$result_default=mysql_query($sql_default);
}
if($querys=="default_count"){
$sql_default_count="select $select from $dbnames $wheres";
$result_default_count=mysql_query($sql_default_count);
}
if($querys=="system"){
$sql_system="SELECT $select FROM system";
$result_system=mysql_query($sql_system);
}
if($querys=="gametype"){
$sql_gametype="SELECT $select FROM game_type $wheres order by id";
$result_gametype=mysql_query($sql_gametype);
}
if($querys=="login"){
$sql_login="SELECT user.userid,user.username,user.nickname,user.userid,user.status,user_bank.hig_amount FROM user,user_bank WHERE user.username='$name' and user.password=md5('$passowrd') and user.userid=user_bank.userid";
$result_login=mysql_query($sql_login);
}
if($querys=="user_infor_amount"){
$sql_user_infor_amount="SELECT user.*,user_bank.hig_amount FROM user,user_bank WHERE user.userid='$perid' and user.userid=user_bank.userid";
$result_user_infor_amount=mysql_query($sql_user_infor_amount);
}
if($querys=="game_time"){
$sql_game_time="select $select from game_time $wheres order by lotTime";
$result_game_time=mysql_query($sql_game_time);
}
if($querys=="game_code"){
$sql_game_code="select ckey,fullname,mode from game_code $wheres order by id";
$result_game_code=mysql_query($sql_game_code);
}
if($querys=="user"){
$sql_user="select $select from user $wheres";
$result_user=mysql_query($sql_user);
}
if($querys=="bulletin"){
$sql_bulletin="select id,title,creatdate from bulletin $wheres order by creatdate desc limit $starnum,$maxnum";
$result_bulletin=mysql_query($sql_bulletin);
$result_count_bulletin = mysql_query("select count(id) from bulletin $wheres") or die("未能读取，请刷新");
$rows_count_bulletin=mysql_fetch_row($result_count_bulletin);
}
if($querys=="system_bank_cz"){
$sql_bank_cz="select system_bank_list.*,system_bank.bankid from system_bank_list,system_bank where system_bank_list.status='0' and system_bank_list.uid=system_bank.bankid order by SortNum";
$result_bank_cz=mysql_query($sql_bank_cz);
}
if($querys=="bank_pass"){
$sql_bank_pass="select user_bank.password as bpass,user.password as upass from user,user_bank where user_bank.userid='$userid' and user.userid='$userid'";
$result_bank_pass=mysql_query($sql_bank_pass);
}
if($querys=="system_bank_card"){
$sql_bank_card="select * from user_bank_list where userid='$userid'";
$result_bank_card=mysql_query($sql_bank_card);
}
if($querys=="cz_last"){
$sql_cz_last="select * from user_funds where userid='$userid' and cate='recharge' order by creatdate desc limit 0,30";
$result_cz_last=mysql_query($sql_cz_last);
}
if($querys=="tx_last"){
$sql_tx_last="select * from user_funds where userid='$userid' and cate='platform' order by creatdate desc limit 0,30";
$result_tx_last=mysql_query($sql_tx_last);
}
if($querys=="tx_count"){
$sql_tx_count="select count(id) from user_funds where userid='$userid' and cate='platform' and creatdate like '$nowdate%' and status!='4'";
$result_tx_count=mysql_query($sql_tx_count);
}
if($querys=="user_bank"){
$sql_user_bank="select * from user_bank_list where userid='$userid' order by is_first desc";
$result_user_bank=mysql_query($sql_user_bank);
}
if($querys=="user_bank_pass"){
$sql_user_bank_pass="select amount from user_bank where userid='$userid' and password=md5('$bank_pass')";
$result_user_bank_pass=mysql_query($sql_user_bank_pass);
}
if($querys=="system_bank"){
$sql_system_bank="select system_bank.bankname,system_bank.bankid,system_bank.realname,system_bank.banknum,system_bank_list.bankurl from system_bank,system_bank_list where system_bank.bankid='$bank_uid' and system_bank_list.uid=system_bank.bankid";
$result_system_bank=mysql_query($sql_system_bank);
}
if($querys=="system_bank_list"){
$sql_system_bank_list="select * from system_bank_list where status='0'";
$result_system_bank_list=mysql_query($sql_system_bank_list);
}
if($querys=="user_gifts_today"){
$sql_user_gifts_today="select id from user_gifts where userid='$userid' and creatdate like '$nowdate%' and (status='0' or status='1')";
$result_user_gifts_today=mysql_query($sql_user_gifts_today);
}
if($querys=="user_gifts_last"){
$sql_user_gifts_last="select * from user_gifts where userid='$userid' and (status='0' or status='1') order by creatdate desc limit 0,1";
$result_user_gifts_last=mysql_query($sql_user_gifts_last);
}
if($querys=="user_gifts_list"){
$sql_user_gifts_list="select * from user_gifts where userid='$userid' order by creatdate desc limit 0,50";
$result_user_gifts_list=mysql_query($sql_user_gifts_list);
}
if($querys=="user_Lowerid"){
$sql_user_Lowerid="select userid,Lowerid from user $wheres";
$result_user_Lowerid=mysql_query($sql_user_Lowerid);
}
if($querys=="game_infor"){
$sql_game_infor="select $select from game_ssc_list $wheres";
$result_game_infor=mysql_query($sql_game_infor);
}
}
if($sqlclass=="update"){
if($querys=="user_bank"){
$sql_user_bank_edit="update user_bank_list set bankid='$bankid',bankname='$rows_sl[bankName]',banknum='$banknum',realname='$realname',bankAdress='$bankAdress',is_first='$is_first',status='0' where id='$uid'";
mysql_query($sql_user_bank_edit,$link) or die("插入时出错".mysql_error());
}
if($querys=="user_pupop"){
$sql_user_pupop="update user_pupop set status='1' where userid='$userid' and status='0'";
mysql_query($sql_user_pupop,$link) or die("插入时出错".mysql_error());
}
}
if($sqlclass=="insert"){
if($querys=="user_bank"){
$sql_user_bank_add="insert into user_bank_list(userid,bankid,bankname,banknum,realname,bankAdress,is_first,creatdate,status) value ('$userid','$bankid','$rows_sl[bankName]','$banknum','$realname','$bankAdress','$is_first','$nowtime','0')";
mysql_query($sql_user_bank_add,$link) or die("插入时出错".mysql_error());
}
}
if($sqlclass=="delete"){
if($querys=="user_bank"){
$sql_user_bank = "delete from user_bank_list where id ='$uid' and userid='$userid'";
mysql_query($sql_user_bank,$link);
}
}
;echo ' '
?>