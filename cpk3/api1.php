<?php
include_once 'source/function/run.php';

if($_GET['pwdstr']==md5(md5('zgqsoft').$_GET['salt'])){

    $ok=1;
}
else{
    $ok=0;exit();
}

$arr['status']='false';

if($ok==1){

    if($_GET['type']=='lottery_add'){
        if($_GET['playkey']){

            $nowtime=date("H:i:s");

            lottory_insert($_GET['playkey'] ,$_GET['period'] ,$_GET['number']);
            $arr['status']='true';


            $row=$db->fetch_first("select lotNum  from game_time where playKey='{$_GET['playkey']}' and lotTime<='{$nowtime}' order by lotTime desc limit 0,1");

            $row1=$db->fetch_first("select id from game_lottery where playKey='{$_GET['playkey']}' and SerialDate='".date('Ymd')."' and SerialID='{$row['lotNum']}'");

            if($row1){
                $row=$db->fetch_first("select * from game_time where playKey='{$_GET['playkey']}' and lotTime>='{$nowtime}' order by lotTime asc limit 0,1");
                $time=date("Y-m-d")." ".$row['endTime'];
                //echo "true|{$time}";

                $arr['time']=strtotime($time)-time();
            }
            else {
                if($_GET['playkey']=='3D' || $_GET['playkey']=='PL3' )
                    $arr['time']=600;
                else

                    $arr['time']=5;
            }
            $now=date('Y-m-d H:i:s');
//$db->query("insert into vister(time,url) values('{$now}','{$_SERVER['REQUEST_URI']}')");
            $sys=$db->exec("select * from `sys` where `key`='tasktime'");


            if(time()-$sys['value']>=2){
                $db->query("update `sys` set `value`='".time()."' where  `key`='tasktime'");

                if($db->affected_rows()>0){

                    init_task();
                }
            }
        }
        else $arr['status']='false';
    }
    else $arr['status']='false';
}
else $arr['status']='false';

echo $arr['status'].'|'.$arr['time'];
?>