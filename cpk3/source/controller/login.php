<?php

$ieinfor=Core_Fun::getBrowser();

$username         = Core_Fun::rec_post("username",1);
$loginpass_source = Core_Fun::rec_post("loginpass_source",1);
$validcode_source = Core_Fun::rec_post("validcode_source",1);

//print_r($_COOKIE);

if($username and $loginpass_source){
//if (trim($_POST['validcode_source'])!=trim($_SESSION['validationcode'])){
//	show_message('验证码错误',$_SERVER['HTTP_REFERER'],'warn');
//exit();
//}
$flag="yes";
$md5password = md5($loginpass_source);
$pwd1=sys_md5($loginpass_source);
$user_info		= array();
$user_info_sql = "SELECT a.userid,a.username,a.nickname,a.logintime,a.loginnum,a.isproxy,a.higherid,a.status,b.hig_amount FROM ".DB_PREFIX."user as a,".DB_PREFIX."user_bank as b  WHERE a.username='$username' and (a.password='$md5password' or a.password='$pwd1') and a.userid=b.userid  and admin='0'";
$user_info     = $db->fetch_first($user_info_sql);
if($user_info['userid']-1<0){
		show_message('用户名或密码错误',$_SERVER['HTTP_REFERER'],'warn');

exit();
}
if($user_info['status']-1>=0){
	show_message('对不起，该帐号被禁止！',$_SERVER['HTTP_REFERER'],'warn');

exit();

}else{

$_SESSION["userid"]=$user_info[userid];
$_SESSION["user_name"]=$user_info[username];
$_SESSION["nick_name"]=$user_info[nickname];
$_SESSION["hig_amount"]=$user_info[hig_amount];
$_SESSION["isproxy"]=$user_info[isproxy];
$_SESSION["higherid"]=$user_info[higherid];

$_SESSION['st'] = ($_SESSION["higherid"]?3:2);


if($_POST['rember']==1 or isMobile()){

setcookie("userid",$user_info[userid], time()+365*24*3600,'/');


}
else{

   setcookie("userid","");
}




if($con_system['loginnote']=='yes')
$_SESSION['loginnote']=1;

getsql::upitem("sessionID",$_SESSION['userid'],"".DB_PREFIX."user","userid='".$user_info[userid]."'");
if(isMobile()==1){
    $content='Wap登录';
}
else  $content='PC登录';
add_userlog($content);
$ipinfor = getIP ();
$lastlogintime=date("Y-m-d H:i:s");
$loginnum=$user_info['loginnum']+1;
$db->update(DB_PREFIX."user",array('lastlogintime'=>$lastlogintime,'logintime'=>$addtime,'lastloginip'=>$ipinfor,'loginnum'=>$loginnum),"userid=".$user_info[userid]."");
    login_online($_SESSION['userid'],$ipinfor);
echo "<script>window.location.href='index_home.html';</script>";exit;
}
}
for($i=0;$i<$con_system['banner_num'];$i++){
	$banner[$i]['url']=$con_system['banner_url_'.$i];
	$banner[$i]['img']=$con_system['banner_img_'.$i];

}

$tpl->assign('banner',$banner);

$tpl->assign('user_name',$_COOKIE['user_name']);
$tpl->assign('user_pass',$_COOKIE['user_pass']);
$tpl->assign('navtitle','用户登录');
?>