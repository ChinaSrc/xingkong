<?php

include('config.php');
$dbname=$_POST['dbname'];
$id=$_POST['id'];
$item=$_POST['item'];
$values=$_POST['values'];
$nowtime=date("Y-m-d H:i:s",time());
if($dbname==""or $id==""or $values==""or $item==""){
$flag="no";
}else{
if($dbname=="user"or $dbname=="user_bank"){$cid="userid";}else{$cid="id";}
if($id=="all"){
mysql_query("set names utf8;");
$strSql="update $dbname set $item='$values'";
$db->query($strSql);
}
if($id-1>=0){
$flag="yes";
mysql_query("set names utf8;");
$strSql="update $dbname set $item='$values' where $cid='$id'";
$db->query($strSql);
}
}
echo $flag;
exit;

?>