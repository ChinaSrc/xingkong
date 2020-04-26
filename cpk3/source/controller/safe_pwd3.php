<?php

$step=$_GET['step'];
if(!$step) $step=1;

$mibao=$db->fetch_all("select * from user_mibao where userid='{$_SESSION['userid']}' order by id asc");
if(count($mibao)){

    $tpl->assign('num_arr',array('一','二','三'));
    $tpl->assign('mibao',$mibao);
    $tpl->assign('userid',$user['userid']);

}
else{

    show_message('您还没有设置密保，无法找回密码',$_SERVER['HTTP_REFERER'],'warn');
}


if($_POST){

    if($step==1){

        $ok=0;
        foreach ($_POST['question'] as $key=>$value){
            $row= $db->exec("select * from  user_mibao where  userid='$_SESSION[userid]' and question='$value' and answer='{$_POST[answer][$key]}'");
            if($row['id']>0) $ok++;
        }
        if($ok==count($_POST['question'])){
            $step=2;

        }
        else{

            show_message('您输入的密保答案没有验证通过','home_safe_pwd3.html','warn');

        }

    }

    else if($step==2){

        $pwd=md5($_POST['ps1']);
        $user=get_user_info($_SESSION['userid']) ;
        if($pwd==$user['password']){
            show_message("登录密码不能与资金密码一致，请重新设置", 'home_safe_pwd3.html');
        }
        else{
            $db->query("update user_bank set `password`='{$pwd}' where userid='{$_SESSION['userid']}'")	;


            show_message("资金密码已经修改你成功", 'home.html');

        }

    }


}


$tpl->assign('step',$step);