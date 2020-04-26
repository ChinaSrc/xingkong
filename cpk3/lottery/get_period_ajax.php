<?php

$list_id = $_POST['list_id'];
$SerialDate = $_POST['SerialDate'];
$nowtime=date("Ymd",time());
mysql_query("set names utf8;");
$sql1="select id,lotNum from game_time where playKey='$list_id'";
$result1=mysql_query($sql1);
$numu=mysql_num_rows($result1);
$sql2="select SerialID from game_lottery where playKey='$list_id' and SerialDate='$SerialDate'";
$result2=mysql_query($sql2);
$numu2=mysql_num_rows($result2);
if($numu2){
$olds="#";
while($rows2=mysql_fetch_array($result2)){
$olds.="#".$rows2[SerialID];
}
}
if($numu){
while($rows1=mysql_fetch_array($result1)){
$max_list=$olds;
$is_sl=strpos($max_list,$rows1[lotNum]);
if($is_sl-1>=0){}else{
if($body==""){
if($list_id=="LJSSC"or  strpos($list_id, 'KL8')!==false or  strpos($list_id, 'PK10')!==false or $list_id=="3D"or $list_id=="P5(P3)"){
$body="0|0#".$rows1[lotNum]."|".$rows1[lotNum];
}else{
$body=$rows1[lotNum]."|".$rows1[lotNum];
}
}else{
$body.="#".$rows1[lotNum]."|".$rows1[lotNum];
}
}
}
echo $body;
}else{
echo "0|0";
}
mysql_close();

?>