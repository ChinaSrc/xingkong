<?php




if($_POST and $_GET['type']=='clickadd'){
$data['username']=$_POST['username'];
$passwd=$_POST['password'];
    $data['weixin']=$_POST['weixin'];
    $data['qq']=$_POST['qq'];
    $data['mobilephone']=$_POST['mobilephone'];
if(!$_POST['Verifycode'] || $_SESSION['validationcode']!=$_POST['Verifycode'])	{
	$re_info="验证码不正确";$flags="no";


}
$_SESSION['validationcode'] = null;
if(!$_POST['code']){
    if($con_system['regcode_status']==1){

        $re_info="请输入邀请码";$flags="no";
    }
else{

        $_POST['code']=$con_system['regcode'];
}

}


if(!$_POST['code']){



    $re_info="请输入邀请码";$flags="no";
}
else{

   $user_url= $db->exec("select * from user_url where url='{$_POST['code']}'");
    if($user_url['userid']>0){
        $data['isproxy']=$user_url['type'];
        $data['higherid']=$user_url['userid'];
        $parent=get_user_info($user_url['userid']);
        $data['rid']=$parent['rid'];
         $rebates=unserialize($user_url['rebate']);
         if(is_array($rebates) and count($rebates)>0){
             foreach ($arr_game_code as $key=>$value){
                 if(!$rebates[$key]) $rebates[$key]=0;

             }

         }else{
             foreach ($arr_game_code as $key=>$value){
                 if(!$rebates[$key]) $rebates[$key]=0;

             }
         }
         $rebates=serialize($rebates);
        $data['rebates']=$rebates;
        $data['istry']=$user_url['istry'];
        $data['code']=$user_url['url'];

    }
    else{
        $re_info="您输入的邀请码不正确";$flags="no";

    }

}
$data['field']=$_POST['field'];

if($data['username']==""){
$re_info="请输入用户名";$flags="no";
}
else{
//if(preg_match("/[\x7f-\xff]/",$data['username'])){
//$re_info="不能使用中文作为用户名!";
if(!preg_match("/^[a-zA-Z0-9]+$/",$data['username'])){
  $re_info="用户名错误";
  $flags="no";
}
  $usernameLen = strlen($data['username']);
if ($usernameLen <5 || $usernameLen >20) {
$re_info="用户名不能少于5个字符且不能大于20个字符!";
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

foreach ($data['field'] as $key=>$value){

  	if($key=='1')
    {    
      if($value!="")
      {
        //echo "weixin=".$value;
        if(!preg_match("/^[a-zA-Z0-9_]+$/",$value)){
  			$re_info="微信名错误";
  			$flags="no";
          	break;
		}
      }
    }
  	
  	if($key=='2')
    {   	
      if($value!="")
      {
        //echo "qq=".$value;
        if(!preg_match("/^[0-9]+$/",$value)){
  			$re_info="qq号错误";
  			$flags="no";
          	break;
		}
      }
    }
  
  	if($key=='3')
    { 
      if($value!="")
      {
        //echo "mobile=".$value;
        if(!preg_match("/^[0-9]+$/",$value)){
  			$re_info="手机号错误";
  			$flags="no";
          	break;
		}
      }
    }
}


if($flags=='no'){

echo "<script>alert('{$re_info}');</script>";
	echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";

	exit();
}

else{

	if($userid=user_add($data)){
//show_message("恭喜您注册成功",'index.aspx?mod=login');
        $user_info=$db->exec("select * from user where userid='{$userid}'");

        $_SESSION["userid"]=$user_info[userid];
        $_SESSION["user_name"]=$user_info[username];
        $_SESSION["nick_name"]=$user_info[nickname];
        $_SESSION["hig_amount"]=$user_info[hig_amount];
        $_SESSION["isproxy"]=$user_info[isproxy];


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
        show_message("恭喜您注册成功",'index_home.html');
        //echo "<script>window.location.href='index_home.html';</script>";
	exit();

	}

	else{
show_message("很抱歉，注册失败",$_SERVER['HTTP_REFERER'],'warn');

	exit();
	}
}

}


if($_GET['id']){

    $row=$db->exec("select * from user_url where url='{$_GET['id']}'");

    if($row['userid']>0){

        $tpl->assign('code',$_GET['id']);
    }

}

$field_list=$db->fetch_all("select * from field where `show`='1' and reg='1' order by sortnum asc");
$tpl->assign('field_list',$field_list);



$tpl->assign('navtitle','用户注册');
?>

