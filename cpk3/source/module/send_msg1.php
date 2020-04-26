<?php

$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$uid = isset($_POST[uid]) ?$_POST[uid] : $_GET[uid];
$perid = isset($_POST[perid]) ?$_POST[perid] : $_GET[perid];
$flags="yes";
$is_write="no";

if($_GET['admin']==1)$userid=$_SESSION['admin_id'];


if($active=="send"){


$content = isset($_POST[content]) ?$_POST[content] : $_GET[content];
if(!$_POST['username']){
	$re_info="收件人不能为空！";$flags="no";
}
else{
	$row=$db->fetch_first("select * from user where username='{$_POST['username']}'");
	if(!$row){
	$re_info="收件人不存在！";$flags="no";	
	}
	else{
		$perid=$row['userid'];
		
	}


	
}



if($content==""){$re_info="没有回复内容的消息不能发送！";$flags="no";}
if($flags=="yes"){
if(strlen($content)-300>0){$re_info="回复内容不能超过100个汉字！";$flags="no";}


if($flags=="yes"){
$nowtime=Core_Fun::nowtime();
$array  = array(
'userid'=>$userid,
'perid'=>$perid,
'replyid'=>$replyid,
'content'=>$content,
'creatdate'=>$nowtime,
'status'=>'0'
);
$db->insert(DB_PREFIX."user_msg",$array);
$re_info="发送成功！";
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>".$re_info."</div>";
echo "<script>setTimeout('parent.pop.close();',1000) </script>";
exit;
}
}
else{
	
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>".$re_info."</div>";
echo "<script>setTimeout('parent.pop.close();',1000) </script>";
exit;
	
	
}

}

$send_url=$do_url."?mod=send&code=msg1&flag=yes&active=send&admin=1&uid=".$uid;
?>


<div style='font-size:12px;'>
<form method='POST' action='<?php echo $send_url?>' name='form1' id='form1'>
用户名：   <input type='text'  name='username' value=''  style='width:280px'>
<br>

内 &nbsp;容：
<textarea id='content' name='content' style='height:100px;width:280px'></textarea>
<div style='padding:5px;font-size:12px;text-align:left;padding-left:50px;'>
<input type='submit' value='发 送' style='border:1px solid #222;height:20px;padding:0px 15px'>
</div>
</form>
</div>



















