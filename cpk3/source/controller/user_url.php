<?php
if($userinfo['istry']==1){


    show_message("您现在还是试用账户，不允许充值",$_SERVER['HTTP_REFERER']);


}



$reg_hours=$con_system['reg_hours'];
$tt=date('Y-m-d H:i:s',time()-$reg_hours*3600);


$bank1=$db->fetch_first("select * from user where userid='{$_SESSION[userid]}' and registertime>'{$tt}'  and isproxy='1' ");
if($bank1){

		show_message("注册{$reg_hours}后才能添加会员", $_SERVER['HTTP_REFERER'],'warn');

		exit();
}

if($_POST){

    if($_GET['action']=='addurl'){

        $now=time();
$thisstr=create_code($con_system['code_num']);
foreach ($_POST['rebate'] as $key=>$value){
    if(!$value) $_POST[$key]['rebate']=0;
}
        $rebate=serialize($_POST['rebate']);
      	if (!is_numeric($_POST['rebate']['k3'])) {
        	show_message("值只能是数字，当前的值：" . $_POST['rebate']['k3'], $_SERVER['HTTP_REFERER'], 'warn');
          	exit();
        }
		$maxRebate = unserialize($userinfo['rebates'])['k3']; // 写死快三
        $minRebate = $maxRebate >= $con_system['rebate_cha'] ? $maxRebate - $con_system['rebate_cha'] : 0;
        if ($_POST['rebate']['k3'] < $minRebate || $_POST['rebate']['k3'] > $maxRebate) {
            show_message("值只能介于{$minRebate}~{$maxRebate}之间", $_SERVER['HTTP_REFERER'], 'warn');
          	exit();
        }

        $db->query("insert into user_url(userid,url,rebate,mark,time,type,virtual) values('{$_SESSION['userid']}','{$thisstr}','{$rebate}','{$_POST['mark']}','{$now}','{$_POST['type']}','{$userinfo['virtual']}')");



        show_message("添加成功", 'home_user_url.html');

        exit();
    }





}



if($_GET['type']=='del'){

	$db->query("delete from user_url where id='{$_GET['id']}'");
	show_message("删除成功", $_SERVER['HTTP_REFERER'],'warn');

		exit();
}

if(!$_GET['type']) $str=" and  type='0' ";
else  $str=" and  type='1' ";

$list=$db->fetch_all("select * from user_url where userid='{$_SESSION['userid']}' {$str} order by id desc");


$tpl->assign("list",$list);

$tpl->assign("navtitle",'下级开户');

$tpl->assign("url",SZS_ROOT_URL.'reg.html?id=');

$tpl->assign('rebates',unserialize($userinfo['rebates']));

?>


