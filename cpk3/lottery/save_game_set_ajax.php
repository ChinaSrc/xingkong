<?php

$dbname=$_POST['dbname'];
$id=$_POST['id'];
$playkey=$_POST['playkey'];
$input_list=$_POST['input_list'];
$item=$_POST['item'];
$values=$_POST['values'];
$nowtime=date("Y-m-d H:i:s",time());
if($dbname==""or $id==""or $values==""or $item==""){
$flag="no";
}else{
if($id=="all"){
$list_ckey=explode("|",$input_list);
for ($i=0;$i<count($list_ckey);$i++){
$is_qw="no";$list_n=$list_ckey[$i];
if(strpos($item,'rize')){
if(strpos($list_n,'qwsx')){$is_qw="yes";}
if(strpos($list_n,'qwex')){$is_qw="yes";}
if(strpos($list_n,'qjsx')){$is_qw="yes";}
if(strpos($list_n,'qjex')){$is_qw="yes";}
}
if($is_qw=="no"){
mysql_query("set names utf8;");
$sql="SELECT id FROM $dbname WHERE ckey='$list_n' and playkey='$playkey'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num){
$strSql="update $dbname set $item='$values' WHERE ckey='$list_n' and playkey='$playkey'";
$db->query($strSql);
}else{
$strSql="insert into $dbname(playKey,ckey,$item) values ('$playkey','$list_n','$values')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
}
}
}
}else{
mysql_query("set names utf8;");
$sql="SELECT id FROM $dbname WHERE ckey='$id' and playkey='$playkey'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num){
$strSql="update $dbname set $item='$values' WHERE ckey='$id' and playkey='$playkey'";
$db->query($strSql);
}else{
$strSql="insert into $dbname(playKey,ckey,$item) values ('$playkey','$id','$values')";
mysql_query($strSql,$link) or die("插入时出错".mysql_error());
}
}
}
echo $flag;
exit;

?>