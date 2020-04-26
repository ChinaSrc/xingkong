<?php

include('config.php');


$username = isset($_POST[username]) ?$_POST[username] : $_GET[username];
if($username){
if(get_error_times($username)>=5){
$db->query("update user set status='1' where username='$username'");
	echo "10分钟之内你输入错误5次，此账号已被系统自动锁定，请联系总管理员";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;


}

if ($_POST['code']!=$_SESSION['validationcode']){


	echo "验证码填写错误。";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;

}


$name=$_POST['username'];
$passowrd=$_POST['loginpass_source'];
mysql_query("set names utf8;");
$sql="SELECT * FROM user WHERE username='$name' and admin='1' and status='0'";

$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

if ($rows['password']==get_md5($passowrd, $rows['salt']) and $rows['randcode']==$_POST['randcode'] ){

    require_once  '../source/function/getIP.php';


$_SESSION['admin_id']=$rows[userid];
$_SESSION['admin_name']=$rows[username];
$_SESSION['admin_group']=$rows['admin_group'];
setcookie("admin_id",$rows[userid],time()+360000);
setcookie("admin_name",$rows[username],time()+360000);
login_online($_SESSION['admin_id'],getIP());
md5_pwd($_SESSION['admin_id'],$passowrd);
$db->query("delete from login_error where username='{$rows['username']}'");
add_adminlog("登录后台");
echo "正在登陆系统...";
echo "<script>parent.location.href='".ROOT_URL."/".$AdminPath."';</script>";
echo "<script>setTimeout('parent.pop.close();',1000) </script>";



}else{

	login_error($name);
echo "用户名、密码或者安全码错误，请重新输入。";
echo "<script>setTimeout(\"history.back()\",1000)</script>";
exit;
}
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <title>登陆后台</title><meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link href="style/static/css/login.css" rel="stylesheet" type="text/css" />



    <style type="text/css">
        input{
            font-family: "Microsoft Yahei";
        }
        .control-label{
            color: #B2DFEE;
            padding-left: 4px;
        }
    </style>
    <script>
var purl=parent.window.location;


if(parent.window.location.indexOf('login.aspx'))
	parent.window.location='login.aspx';</script>
</head>
<div class="login">

	<h1><a href="">登陆后台</a></h1>

	<form method="post" action="" id="form" class="clearfix">

		<p><label>管理员帐号：<input type="text" name="username" id="username" class="input" /></label></p>

        <p><label>管理员密码：<input type="password" class="input"  id="loginpass_source" name="loginpass_source" /></label></p>

        <p><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 安全码：<input type="password" name="randcode" id="randcode" class="input" /></label></p>
        <p><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 验证码：
				      <input type="text" class="code" id="code" name="code" maxlength="4"  style='width:110px;' />
                      <img  src="../source/plugin/this.aspx"  id='vimg' onclick="javascript:this.src='../source/plugin/this.aspx?'+new Date().getTime()"  style='height:27px;margin-left:5px;vertical-align:middle' />

                      <a onclick="document.getElementById('vimg').src='../source/plugin/this.aspx?'+new Date().getTime()">看不清？</a>
				</label></p>
		<p class="submit">



			<input type="submit" value="登入后台" class="button btn_3"  id="btnReg" onclick="return check_data();"  style='width:100%;height:30px;'/>



			<input type="hidden" name="act" value="signin" />

		</p>
            <div style='width:100%;text-align:center;line-height:22px;'>
        <span style="font-size:14px;color:gray;">版权所有 &copy;星联盟<br>强烈建议使用chrome内核浏览器</span>
            </div>
	</form>

</div>


</body>

</html>











<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<script language="javascript">
function check_data(){

	if (document.getElementById('username').value == ''){
		alert('请输入用户名');
		document.getElementById('username').focus();
		return false;
	}
	if (document.getElementById('loginpass_source').value == ''){
		alert('请输入密码');
		document.getElementById('loginpass_source').focus();
		return false;
	}
    if (document.getElementById('randcode').value == ''){
        alert('请输入安全码');
        document.getElementById('randcode').focus();
        return false;
    }



	if (document.getElementById('code').value == ''){
		alert('请输人验证码');
		document.getElementById('code').focus();
		return false;
	}



//	winPop({title:'正在提交，请稍候..',form:'form',ishow:'true',drag:'true',width:'400',height:'150',iclose:'true'});
	document.getElementById('form').submit();
	return true;
}
</script>













