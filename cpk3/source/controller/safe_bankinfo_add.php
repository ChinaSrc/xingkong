<?php

$sys_infor=getsql::sys("MaxBank");
$MaxBank=$sys_infor[MaxBank];
$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$doto = isset($_POST[doto]) ?$_POST[doto] : $_GET[doto];
$uid = isset($_POST[uid]) ?$_POST[uid] : $_GET[uid];

$bank_list=$db->fetch_all("select * from system_bank_list where status='1' order by sortnum asc,id asc");
$tpl->assign('bank_list',$bank_list);

if($active=="del"and $doto=="begin"){
$sqls="delete from ".DB_PREFIX."user_bank_list where id ='$uid' and userid='$userid'";
if($db->query($sqls)){
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>操作成功!</div>";
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>操作失败，刷新后重试!</div>";
}
echo "<script>setTimeout('parent.window.location.reload();',2000)</script>";
$db->close();
exit;
}
$card_num	=$db->fetch_count("SELECT COUNT(b.id) from ".DB_PREFIX."user_bank_list as b where b.userid='$userid'");
if($card_num-$MaxBank>=0 and $active!="edit"){
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;'>您最多只能绑定".$MaxBank."张银行卡!</div>";
echo "<script>setTimeout('parent.pop.close();',2000) </script>";
$db->close();
exit;
}else{
if($doto=="put"){



$bankid = isset($_POST[id]) ?$_POST[id] : $_GET[id];
$realname = isset($_POST[realname]) ?$_POST[realname] : $_GET[realname];
    $banknum = isset($_POST['banknum']) ?$_POST[banknum] : $_GET[banknum];
$is_first = isset($_POST[is_first]) ?$_POST[is_first] : $_GET[is_first];
$flags="yes";
if($banknum==""or $realname==""){$flags="no";$re_infos="提交失败，请填写完整信息";}

  if(!preg_match("/^[\x{4E00}-\x{9FA5}a-zA-Z]{2,20}+$/u",$_POST[realname]))  {	$flags="no";$re_infos="提交失败，数据有误";}
  
   if(!preg_match("/^[\x{4E00}-\x{9FA5}a-zA-Z]{2,20}+$/u",$_POST[bankAdress]))  {	$flags="no";$re_infos="提交失败，数据有误";}
  
   if(!preg_match("/^[0-9]{2,20}+$/u",$_POST[banknum]))  {	$flags="no";$re_infos="提交失败，数据有误";}     
  
$user_pass_sql = "select u.password as upass,b.password as bpass from ".DB_PREFIX."user as u,".DB_PREFIX."user_bank as b where u.userid=b.userid and u.userid='$userid'";
$user_pass     = $db->fetch_first($user_pass_sql);
if(md5($_POST['pwd'])!=$user_pass[bpass] and sys_md5($_POST['pwd'])!=$user_pass[bpass]){
$flags="no";$re_infos="您输入的提现密码不正确";

}


// if($bankid) $sql="select * from user_bank_list where banknum='{$banknum}' and id!='{$bankid}'";
// else $sql="select * from user_bank_list where banknum='{$banknum}' ";
// $row=$db->exec($sql);
// if($row){

// 	$flags="no";$re_infos="您输入的银行卡号已经被绑定，请更换其他卡号";
// }


$sql = "SELECT Count(*) as num FROM user_bank_list WHERE realname ='{$realname}'";
$row=$db->exec($sql);
if($row['num']>2){

 $flags="no";$re_infos="绑卡异常，请联系客服";
}

if($flags=="yes"){
$data=array();
$bank=$db->exec("select * from system_bank_list where id='{$_POST['bankid']}'");

$nowtime=Core_Fun::nowtime();
    $array  = array(
        'userid'=>$userid,
        'bankid'=>$_POST['bankid'],
        'bankname'=>$bank['name'],
        'province'=>$_POST['province'],
        'city'=>$_POST['city'],
        'area'=>$_POST['area'],
        'banknum'=>$_POST['banknum'],
        'realname'=>$realname,
        'bankAdress'=>$_POST['bankAdress'],
        'is_first'=>$is_first,
        'creatdate'=>$nowtime,
        'status'=>'0'
    );


if($bankid-1>=0){

$db->update(DB_PREFIX."user_bank_list",$array,"id=".$bankid."");
    $re_infos="修改成功";
}else{

$db->insert(DB_PREFIX."user_bank_list",$array);
    $re_infos="绑定成功";


}
}


if(isMobile()){


if($flags=='no')show_message($re_infos,'home_safe_bankinfo.html');

else show_message($re_infos,'home_safe_bankinfo.html','warn');
}
else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;color: #ff0000;'>".$re_infos."</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000)</script>";

}

$db->close();
exit;
}
    if($active=='edit' and $_GET['id']){
        $user_bank=$db->exec("select * from user_bank_list where id='{$_GET['id']}'");
        $realname=$user_bank['realname'];
        if($user_bank['status']==1){

            echo "<div style='text-align:center;background:#FFFFFF;font-size:14px;padding:20px;color: #fff;'>该银行卡已经锁定，无法修改</div>";
            echo "<script>setTimeout('parent.Dialog.close();',1000)</script>";
            exit();
        }

    }

else {

	$row=$db->exec("select * from user_bank_list where userid='{$userid}'");
	if($row['realname']) $realname=$row['realname'];
}



$tpl->assign('realname',$realname);
}


$tpl->assign("u_bank",$user_bank);
$tpl->assign("uid",$uid);
$tpl->assign("active",$active);

$tpl->assign("navtitle",'绑定新银行卡');
?>