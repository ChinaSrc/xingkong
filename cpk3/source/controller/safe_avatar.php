<?php


if($_POST){
    if($_GET['type']=='upload'){

        // include_once 'source/function/Image.php';
        // $img=new Image();
        // $path="data/uploads/avatar/";
        // foreach ($_FILES as $key=>$value) {
        //     if($file=$img->up_image($_FILES[$key], $path)){
        //         $_POST[$key]=$path.$file;

        //     }
        // }


    }
   if($_POST['avatar'])
	$db->query("update user set avatar='{$_POST['avatar']}' where userid='{$_SESSION['userid']}'");

	if(isMobile())

	show_message("头像修改成功",'home_safe_info.html');
	else
echo "<script>parent.window.location.reload();</script>";
}

$userinfo=get_user_info($_SESSION['userid']);

$tpl->assign('avatar',$userinfo['avatar']);




?>
