<?php

$strSql_M="TRUNCATE TABLE `user_level`";
mysql_query($strSql_M) or die("插入时出错1".mysql_error());
echo "数据已初使完毕<br>";
$strSql_M="select * from user order by userid";
$results_M=mysql_query($strSql_M);
echo "开始处理上下级关系<br>";
while($rows_M=mysql_fetch_array($results_M)){
$higherid=$rows_M[higherid];
$this_user=$rows_M[userid];
$CurUnder="yes";$Level=0;
while($higherid-1>=0 and $this_user-$higherid>0){
if($this_user-$higherid==0){break;}
$strSql="insert into user_level(userid,higherid,Level,CurUnder) value ('$this_user','$higherid','$Level','$CurUnder')";
mysql_query($strSql,$link) or die("插入时出错2".mysql_error());
$strSql_P="select higherid from user where userid='$higherid'";
$results_P=mysql_query($strSql_P);
$nums_P=mysql_num_rows($results_P);
if($nums_P){
$rows_P=mysql_fetch_array($results_P);
$higherid=$rows_P[higherid];
$CurUnder="no";
}else{
break;
}
}
}
echo "处理结束，请关闭！<br>";

?>