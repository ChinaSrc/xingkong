<?php
$palyKey = $_GET['games'];

$day=date('Ymd');
$time=date('H:i:s');
$query=mysql_query("select * from game_time where playKey='{$palyKey}' and endTime>='$time' and beginTime<='$time' order by endTime asc limit 0,1");
$row=mysql_fetch_array($query);
$lotNum=preg_replace('/^0+/','',$row['lotNum']);


$query1=mysql_query("select * from game_type where ckey='$palyKey'");
$play_type=mysql_fetch_array($query1);
$fullname=$play_type['fullname'];
$fullname=str_replace("时时彩","", $fullname);
$fullname=str_replace("时时乐","", $fullname);
$fullname=str_replace("11选5","", $fullname);
?>
<table  style='line-height:30px;width:100%;font-size:14px;'>
 
  <tr>
    <td align="center">方案编号</td>
    <td align="center">省份</td>
       <td align="center">期数</td>
          <td align="center">注数</td>
             <td align="center">方案状况</td>
              <td align="center" >选择</td>
  </tr>



<?php
$con=array();
$sql="select * from jie_kou where (sheng_fen='$palyKey' or sheng_fen='$fullname' ) and `day`='$day'  and (`start_qi`='$lotNum' or `start_qi` = '0{$lotNum}' or `start_qi` = '00{$lotNum}') order by id asc";

$query2=mysql_query($sql);
if(!mysql_num_rows($query2)){
	
	echo "<tr><td align='center' colspan='6'>暂无可选投注方案</td></tr>";
	
}
while($jie_kou=mysql_fetch_array($query2)){
$nr=explode("<br>", $jie_kou['nr']);
$count=0;
$str='';
foreach ($nr as $value) {
if(!in_array($value, $con))
	$con[]=$value;
	if(trim($value)!='')$count++;
	$v=explode(" " , $value);
	$v2='';
	foreach ($v as $v1) {
		if($v1>=10 or  strpos($v1, '0')!==false){
			$num=$v1;
		}
		else $num='0'.$v1;
		if($v2) $v2.=' '.$num;
		else $v2=$num;
	}
	if(!$str) $str=$v2;
	else $str.=";".$v2;
	
}

$query11=mysql_query("select * from game_type where `ckey`='{$jie_kou['sheng_fen']}'");


if($row=mysql_fetch_array($query11)){
	
	$sheng_fen=$row['fullname'];
}
else {
	
		$sheng_fen=$rows3['sheng_fen'];
	
}
$sheng_fen=str_replace("时时彩","", $sheng_fen);
$sheng_fen=str_replace("时时乐","", $sheng_fen);
$sheng_fen=str_replace("11选5","", $sheng_fen);
?>
<tr>
<td align="center"><?php echo $jie_kou['fn_id']?></td>
<td align="center"><?php echo $sheng_fen;?></td>
<td align="center"><?php echo $jie_kou[day].$jie_kou['start_qi']?></td>
<td align="center"><?php echo $count;?></td>
<td align="center"><?php echo $jie_kou['N_from']?></td>
<td align="center"><input type='checkbox' name='hao_values[<?php echo $jie_kou['id']?>]' value='<?php echo $str;?>' onclick='click_values(this);'></td>

</tr>

<?php 



}


?>
</table>

