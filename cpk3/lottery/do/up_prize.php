<?php

$sou=$_GET['sou'];
$up=$_GET['up'];
echo "根据 ".$sou." 的奖金设置更新".$up." 的奖金<br>";
echo "开始导入奖金-----><br>";
$num=0;
$sql_game="select code from game_type where ckey='$up'";
$result_game=mysql_query($sql_game);
$fetch_game=mysql_fetch_array($result_game);
echo $fetch_game[code]."<br>";
$code_list=explode("|",$fetch_game[code]);
for ($i=0;$i<count($code_list);$i++){
$this_code=$code_list[$i];
$sql_code="select ListKey from game_code_list where CodeKey='$this_code'";
$result_code=mysql_query($sql_code);
$num_code=mysql_num_rows($result_code);
if($num_code){
while($fetch_code=mysql_fetch_array($result_code)){
$this_key=$fetch_code[ListKey];echo $this_key."======";
$sql_pri="select * from game_set where playKey='$sou' and ckey='$this_key'";
$result_pri=mysql_query($sql_pri);
$num_pri=mysql_num_rows($result_pri);
if($num_pri){
$fetch_pri=mysql_fetch_array($result_pri);
$time_1700=$fetch_pri[Times_1700];
$time_1800=$fetch_pri[Times_1800];
$time_1900=$fetch_pri[Times_1900];
$pri_1700=$fetch_pri[Prize_1700];
$pri_1800=$fetch_pri[Prize_1800];
$pri_1900=$fetch_pri[Prize_1900];
$pri_2000=$fetch_pri[Prize_2000];
$sql_set="select id from game_set where playKey='$up' and ckey='$this_key'";
$result_set=mysql_query($sql_set);
$num_set=mysql_num_rows($result_set);
if($num_set){
$sql_user_pupop="update game_set set Prize_1700='$pri_1700',Prize_1800='$pri_1800',Prize_1900='$pri_1900' where playKey='$up' and ckey='$this_key'";
mysql_query($sql_user_pupop,$link) or die("插入时出错".mysql_error());
echo "update<br>";
}else{
$sql_user_bank_add="insert into game_set(playKey,ckey,Times_1700,Times_1800,Times_1900,Prize_1700,Prize_1800,Prize_1900,Prize_2000) value ('$up','$this_key','$time_1700','$time_1800','$time_1900','$pri_1700','$pri_1800','$pri_1900','$pri_2000')";
mysql_query($sql_user_bank_add,$link) or die("插入时出错".mysql_error());
echo "insert<br>";
}
$num+=1;
}
}
}
}
echo "结束，共更新".$num."条记录---->";

?>