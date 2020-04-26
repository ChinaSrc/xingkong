<?php

if($_POST['userid']){
    include_once 'source/function/run.php';
    init_task($_GET['playkey'],$_GET['period']);
$return=array('ok'=>'1','msg'=>'登录状态ok');

    $linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
    $auth=$_SESSION['auth'];
    $line=$db->exec("select * from user_online where userid='{$_POST['userid']}' and `session`='{$auth}'");

    if($line){
        if($line['uptime']<=$linetime){
            $return['ok']=0;
            $return['msg']="您登录已经超时，请重新登录！";

        }


    }
   /* else{

         $return['ok']=0;
        $row= $db->exec("select * from userlog where uid='{$_POST['userid']}' order by id desc");
        $return['msg']="您的账号于【".date('Y-m-d H:i:s',$row['time'])."】在其他设备登录，请重新登录！";
    }*/

    exit(json_encode($return));
}
else{

    $return=array('ok'=>'-1','msg'=>'未登录');

}



?>