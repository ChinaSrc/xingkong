<?php

$reg_hours=$con_system['reg_hours'];
$tt=date('Y-m-d H:i:s',time()-$reg_hours*3600);



$bank1=$db->fetch_first("select * from user where userid='{$_SESSION[userid]}' and registertime>'{$tt}'  and isproxy='1' ");



$tpl->assign("user",get_user_info($_SESSION['userid']));
if($bank1){
		show_message("注册{$reg_hours}后才能添加会员", $_SERVER['HTTP_REFERER'],'warn');

		exit();

}
$bank1=$db->fetch_first("select * from user where userid='{$_SESSION[userid]}' ");

$max=20*$bank1['rebate']+1800;
//if($max>1958) $max='1958';



$tpl->assign("rebate_select",rebate_select($max));

$tpl->assign('user_mode',$bank1['modes']);

if($_POST and $_GET['type']=='clickadd'){
	$mode=1800+20*$_POST['rebate'];

//	if($mode>1952){
//
//		$me=get_user_info($_SESSION['userid']);
//		if($me[$mode]<1){
//
//
//$re_info="您在{$mode}模式已经没有配额";$flags="no";
//		}
//
//	}

$data['username']=$_POST['username'];
$passwd=$_POST['password'];


if($data['username']==""){
$re_info="请输入用户名";$flags="no";
}else{
if(preg_match("/[\x7f-\xff]/",$data['username'])){
$re_info="不能使用中文作为用户名!";
$flags="no";
}

$user_s_sql = "select userid from user where username='{$data['username']}'";
$user_s     = $db->fetch_first($user_s_sql);
if($user_s[userid]-1>=0){
$re_info="该用户名已存在";$flags="no";
}
}

if($passwd ==""){
$re_info="请输入登陆密码！";$flags="no";
}
else $data['password']=md5($passwd);



if($flags=='no'){
	show_message($re_info, $_SERVER['HTTP_REFERER'],'warn');

	exit();
}

else{

	if($_POST['usertype']==2){

	$data['isproxy']=0;

	$data['rebate']=12.9;
	}
	else{
	$data['isproxy']=$_POST['usertype'];

	$data['rebate']=$_POST['rebate'];
	}



	$data['higherid']=$_SESSION['userid'];
	if(user_add($data)){
	show_message('恭喜您！添加成功','index.aspx?mod=user&code=list');


	exit();

	}

	else{
	show_message('很抱歉，添加失败', $_SERVER['HTTP_REFERER'],'warn');


	exit();
	}
}

}
$tpl->assign("navtitle",'新增用户');



?>