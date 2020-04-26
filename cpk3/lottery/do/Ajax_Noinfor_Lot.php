<?php

$playkey=$_POST['playkey'];
$nowDateTime=date("Y-m-d H:i:s",time());
$nowDate=date("Y-m-d",time());
$nowTime=date("H:i:s",time());
$sql1="select SerialID from game_lottery where itemkey='$playkey' and SerialDate='$nowDate' order by SerialID desc limit 0,1";
$result2=mysql_query($sql1);
$nums2=mysql_num_rows($result2);
if($nums2){
$rows2=mysql_fetch_array($result2);
$flag=Get_Lot_Infor($playkey,$rows2[SerialID]);
}else{
$flag=Get_Lot_Infor($playkey,"");
}
function Get_Lot_Infor($playkey,$LotNum){
$sql3="select links from game_intface where playkey='$playkey' order by Level";
$result3=mysql_query($sql3);
$nums3=mysql_num_rows($result3);
if($nums3){
$kaiguan="0";
while($rows3=mysql_fetch_array($result3)){
$pizFile=$rows3[links];$kaiguan="0";
if(remote_file_exists($pizFile)){
$str = file_get_contents($pizFile);
$xmls = simplexml_load_string(iconv('gb2312','utf-8',$str));
for($i=0;$i<count($xmls);$i++){
$qihao=$xmls->row[$i]["expect"];
$kai_num=$xmls->row[$i]["opencode"];
$kai_time=$xmls->row[$i]["opentime"];
if($kaiguan-1<0){
if($LotNum-1>0){
if($qihao-$LotNum>0){
if($flags=="ok"){$kaiguan=1;}
}
}else{
if($flags=="ok"){$kaiguan=1;}
}
if($kaiguan-1==0){
mysql_query("set names utf8;");
$strSql="insert into game_lottery(itemkey,period,Number,LotTime,status) value ('$playkey','$period','$Number','$LotTime','0')";
mysql_query($strSql,$link) or die("插入时出错2".mysql_error());
}
}
}
}else{
$flags="1";
}
}
}else{
$flags="2";
}
return $flags;
}
echo $flag;
?>