<?php

$playkey=$_POST['playkey'];
$mydates=$_POST['mydates'];
$qihaos=$_POST['qihaos'];
$lotNum_long=$_POST['lotNum_long'];
$lotnums=$_POST['lotnums'];
$starlen=strlen($qihaos)-$lotNum_long;
$qh=utf8Substr($qihaos,$starlen,$lotNum_long);
$SerialDate=utf8Substr($qihaos,0,$starlen);
if(strlen($SerialDate)-6==0){$SerialDate="20".$SerialDate;}
$this_date=date("Ymd",time());
$this_year=date("Y",time());
$nowtime=date("Y-m-d H:i:s",time());
$period_list=explode("#^#",$qihaos);
if(count($period_list)-5>0){$max_num=5;}else{$max_num=count($period_list);}
for ($i=0;$i<$max_num;$i++){
$p_list=explode("|",$period_list[$i]);
$peroid_s=$p_list[0];$lot_number=$p_list[1];
if($playkey=="3D"or $playkey=="P5(P3)"){$code="dp";}else{$code="gp";}
mysql_query("set names utf8;");
if($playkey=="LJSSC"or $playkey=="3D"or $playkey=="P5(P3)"or strpos($playkey, "KL8")!==false){
$sql_p="SELECT id from game_lottery where period='$peroid_s' and playKey='$playkey'";
if($playkey=="3D"or $playkey=="P5(P3)"){
if($playkey=="P5(P3)"){$peroid_s="20".$peroid_s;}
$p_date=substr($peroid_s,0,4);
$p_num=substr($peroid_s,4,strlen($peroid_s));
}
}else{
$begin_s=substr($peroid_s,0,4);
if($begin_s-$this_year==0){
$p_date=substr($peroid_s,0,8);
$p_num=substr($peroid_s,8,strlen($peroid_s));
}else{
$p_date="20".substr($peroid_s,0,6);
$p_num=substr($peroid_s,6,strlen($peroid_s));
}
$sql_p="SELECT id from game_lottery where SerialDate='$p_date' and SerialID='$p_num' and playKey='$playkey'";
}
$result_p=mysql_query($sql_p);
$nums4=mysql_num_rows($result_p);
if($nums4){
$falgs="已存在数据";
}else{
$strSql="insert into game_lottery(code,playKey,SerialID,SerialDate,period,Number,LotTime,status) values ('$code','$playkey','$p_num','$p_date','$peroid_s','$lot_number','$nowtime','0')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
}
}

?>