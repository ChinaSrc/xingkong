<?php
$playkey=trim($_GET['playkey']);

$now=date("H:i:s");
$date=date('Ymd');
$query=mysql_query("select lotNum from game_time where playkey='$playkey' and lotTime<='$now' order by lotTime desc limit 0,1");
if($row=mysql_fetch_array($query)){
$query1=mysql_query("select * from game_lottery where playKey='$playkey' and Serialid='$row[lotNum]' and SerialDate='$date' ");
if($row1=mysql_fetch_array($query1)){
//已经开奖
echo $row1['SerialDate'].$row1['SerialID'].'|'.$row1['Number'].'(已获取)';

}
else{

echo '0';
}
}


