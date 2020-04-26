<?php

$user_pass	   = array();
$bank=	$db->fetch_first("select * from user_bank where userid='{$_SESSION['userid']}'");
$user_pass_sql = "select * from user where userid='$userid'";
$user     = $db->fetch_first($user_pass_sql);
if($user['password']==$bank['password']){
show_message("请先设置提现密码",'home_safe_pwd2.html','warn');


	exit();

}

if($_GET['type']=='set_first'){
$db->query("update user_bank_list set is_first='no' where userid='$userid' ");
	$db->query("update user_bank_list set is_first='yes' where id='{$_GET['id']}'");
	echo "<script>alert('设置成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
exit();
}




$do_yes="yes";

$user_bank_list	     = array();
$user_bank_list_sql  = "select b.* from ".DB_PREFIX."user_bank_list as b where b.userid='$userid' order by b.is_first desc";
$user_bank_list      = $db->getall($user_bank_list_sql);
if(count($user_bank_list)>0){

	foreach ($user_bank_list as $key=> $value) {
		$temp='*********'.substr($value['banknum'], strlen($value['banknum'])-4,4);

		$user_bank_list[$key]['number']=$temp;

        $user_bank_list[$key]['mark']=explode('-',$value['mark']);

        if($value['bankid']){
            $row=$db->exec("select * from system_bank_list where id='{$value['bankid']}'");
            $user_bank_list[$key]['bankico']=$row['logo'];

        }

	}


}

$sys_infor=getsql::sys("MaxBank");
$card_num=count($user_bank_list);
$sys_infor=getsql::sys("MaxBank");
$MaxBank=$sys_infor[MaxBank];
$tpl->assign("is_pass",$do_yes);
$tpl->assign("MaxBank",$MaxBank);
$tpl->assign("u_banks",$user_bank_list);
$tpl->assign("card_num",$card_num);
$tpl->assign("navtitle",'银行卡管理');
?>