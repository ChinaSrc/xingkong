<?php
include('config.php');


$playkey=trim($_GET['playkey']);







//echo set_prize_sum('2FC', '20150616438');

$now=date('H:i:s');
$SerialData=date("Ymd");
$query=mysql_query("select * from game_time where playkey='$playkey' and lotTime<='$now' order by lotTime desc limit 0,10");
while ($row=mysql_fetch_array($query)){
	$lotNum=$row['lotNum'];
	$period=$SerialData.$lotNum;
$query1=mysql_query("select * from game_lottery where playkey='$playkey' and period='$period'");
if($row1=mysql_fetch_array($query1)){
	
	$tt['opentime']=$row1['LotTime'];
	$tt['opencode']=$row1['Number'];
	$tt['expect']=$period;
	
	
}
else {
    $tt['opentime']=date('Y-m-d H:i:s');
	$tt['opencode']=set_code();
	$tt['expect']=$period;
	
}


$code[]=$tt;
	
}

echo '<?xml version="1.0" encoding="GBK"?>
<xml>';
foreach ($code as $value) {
echo '<row opentime="'.$value['opentime'].'" opencode="'.$value['opencode'].'" expect="'.$value['expect'].'"/>';
}


echo '</xml>'
?>



