<?php



$tpl->assign('quest_arr',$quest_arr);


if($_POST){
$now=time();
if($_GET['type']=='add'){
    $db->query("delete from user_mibao where userid='{$_SESSION[userid]}'");

    foreach ($_POST['question'] as $key=>$value){
        $db->query("insert into user_mibao (userid,question,answer,time) values('$_SESSION[userid]','$value','{$_POST[answer][$key]}','{$now}')");

    }
    show_message('恭喜您！密保设置成功','home.html');

}
if($_GET['type']=='check_mibao'){
    $ok=0;
    foreach ($_POST['question'] as $key=>$value){
       $row= $db->exec("select * from  user_mibao where  userid='$_SESSION[userid]' and question='$value' and answer='{$_POST[answer][$key]}'");
       if($row['id']>0) $ok++;
    }
    if($ok==count($_POST['question'])){

        echo "<script>window.location='home_safe_mibao.html?step=update&pwd=ok';</script>";
    }
    else{

        echo "<script>alert('您输入的密保答案没有验证通过');</script>";

        echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    }

}

exit();
}

$mibao=$db->fetch_all("select * from user_mibao where userid='{$_SESSION['userid']}' order by id asc");

$tpl->assign('mibao',$mibao);


$tpl->assign('num_arr',array('一','二','三'));

if($_GET['pwd']=='ok'){

    $tpl->assign('update',1);

}
