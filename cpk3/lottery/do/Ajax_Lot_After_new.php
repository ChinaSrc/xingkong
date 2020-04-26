<?php

mysql_query("set names utf8;");
$playkey=$_POST['playkey'];
$response=$_POST['response'];
$period_list=explode("#^#",$response);
if(count($period_list)-3>0){$max_num=3;}else{$max_num=count($period_list);}
$flags= "#no";
for ($i=0;$i<$max_num;$i++){
$p_list=explode("|",$period_list[$i]);$code="gp";
$peroid_s=$p_list[0];$lot_number=$p_list[1];
if(!strpos($lot_number, "获取")){
lottery_add($playkey, $peroid_s, $lot_number);
$flags= "#yes";
}
}
echo  $flags;
mysql_close();

?>