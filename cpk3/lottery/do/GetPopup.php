<?php
session_start();


$sql_popup="SELECT * from user_funds where  status='0' and type != 'online' and cate='recharge' and userid in (select userid from user where admin=0  ) order by creatdate desc";
$result_popup=mysql_query($sql_popup);
$num_popup=mysql_num_rows($result_popup);

echo $num_popup;

$sql_popup="SELECT * from user_funds where  status='0' and cate='platform'  and userid in (select userid from user where admin=0  ) order by creatdate desc";
$result_popup=mysql_query($sql_popup);
$num_popup=mysql_num_rows($result_popup);

echo '|'.$num_popup;



$sql="SELECT * from user_funds where  status='0'and type != 'online' and cate='recharge' order by creatdate desc";
$list=$db->fetch_all($sql);
if(count($list)>0){
    $num=0;

    foreach ($list as $value){

        if(!in_array($value['id'],$_SESSION['pop'])){
            $num++;
            $_SESSION['pop'][]=$value['id'] ;
        }

    }
    echo "|{$num}";

}
else{

    echo '|0';
}


$sql="SELECT * from user_funds where  status='0' and cate='platform' order by creatdate desc";
$list=$db->fetch_all($sql);
if(count($list)>0){
    $num=0;

    foreach ($list as $value){

        if(!in_array($value['id'],$_SESSION['pop'])){
            $num++;
            $_SESSION['pop'][]=$value['id'] ;
        }

    }
    echo "|{$num}";

}
else{

    echo '|0';
}

$sql="SELECT count(*) as num from user_msg where  userid='0' and read1='0'";
$row= $db->exec($sql);
$msg_num=$row['num'];
echo '|'.$msg_num;


$sql="SELECT * from user_msg where  userid='0' and read1='0' order by id desc";
$list=$db->fetch_all($sql);
if(count($list)>0){
    $num=0;

    foreach ($list as $value){

        if(!in_array($value['id'],$_SESSION['popmsg'])){
            $num++;
            $_SESSION['popmsg'][]=$value['id'] ;
        }

    }
    echo "|{$num}";

}
else{

    echo '|0';
}

?>