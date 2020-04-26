<?php
$step=$_GET['step'];
if(!$step) $step=1;

if($_POST){
	 
  	show_message('您还没有设置密保，无法找回密码',$_SERVER['HTTP_REFERER'],'warn');
    exit();
  
    if($step==1){
        if (trim($_POST['validcode_source'])!=trim($_SESSION['validationcode'])){

            show_message('验证码错误',$_SERVER['HTTP_REFERER'],'warn');

            exit();
        }
        $user=$db->exec("select * from user where username='{$_POST['username']}'");
        if(!$user){
            show_message('您输入的用户不存在',$_SERVER['HTTP_REFERER'],'warn');

            exit();

        }
        else{
            if($user['status']==1){

                show_message('您输入的用户已经被封，请联系客服',$_SERVER['HTTP_REFERER'],'warn');
            }
            else{

                $step=2;
                $mibao=$db->fetch_all("select * from user_mibao where userid='{$user['userid']}' order by id asc");
                if(count($mibao)){

                    $tpl->assign('num_arr',array('一','二','三'));
                    $tpl->assign('mibao',$mibao);
                    $tpl->assign('userid',$user['userid']);

                }
                else{

                    show_message('您还没有设置密保，无法找回密码',$_SERVER['HTTP_REFERER'],'warn');
                }
            }

        }

    }

    else if($step==2){
        $ok=0;
        foreach ($_POST['question'] as $key=>$value){
            $row= $db->exec("select * from  user_mibao where  userid='$_POST[userid]' and question='$value' and answer='{$_POST[answer][$key]}'");
            if($row['id']>0) $ok++;
        }
        if($ok==count($_POST['question'])){
            $step=3;
            $tpl->assign('userid',$_POST['userid']);
        }
        else{

            show_message('您输入的密保答案没有验证通过','index_forgetpwd.html','warn');

        }

}

    else if($step==3){

        $pwd=md5($_POST['ps1']);
        $user=$db->exec("select * from user_bank where userid='{$_POST['userid']}'");
         if($pwd==$user['password']){
             show_message("登录密码不能与资金密码一致，请重新设置", 'index_forgetpwd.html');


         }
else{
    $db->query("update user set `password`='{$pwd}' where userid='{$_POST['userid']}'")	;


    show_message("已成功修改密码，请重新登录", 'login.html');

}


    }


}

$tpl->assign('step',$step);
?>