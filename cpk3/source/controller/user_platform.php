<?php
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];

$search=' 1 ';
if(!$_GET['username']) $_GET['username']=$_SESSION['user_name'];
if($_GET['username']){

    $uu=$db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");

    if(is_team($uu['userid'], $_SESSION['userid']) or $uu['userid']==$_SESSION['userid']){


        if($_GET['st']==1 || $_GET['st']==3 || !$_GET['st']){
            $temp= $db->exec("select userid from user where username='{$_GET['username']}'");
            $search.=" and userid='{$temp['userid']}'";
        }

        else{

            $user_ids=get_user_nextid($uu['userid']);
            $user_ids=str_replace("'", "", $user_ids);
            $search.=" and (userid in ( {$user_ids} ))";

        }
    }
    else{
        $search.=" and userid='-1'";


    }

}else{
    $search.=" and userid='$perid'";
}

$search.=" and cate='platform'  ";

if($_GET['order_sn']) $search.=" and order_sn='{$_GET['order_sn']}'";
if(!$begindate) $begindate=date("Y-m-d",time());
if(!$enddate) $enddate=date("Y-m-d",time()+24*3600);
$begintime=$begindate." 00:00:00" ;

$endtime=$enddate." 23:59:59";

$search.=" and creatdate between '$begintime' and '$endtime'";
if($_GET['cate']) $search.=" and  bankname='{$_GET[cate]}' ";

if(strlen($_GET['status'])) $search.=" and  status='{$_GET[status]}' ";
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(creatdate) FROM user_funds where {$search}";
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $this_url."&";
$list=$db->fetch_all("select * from user_funds where {$search}  order by id desc");
if($list){
foreach ($list as $key=>$value){
		$uu=$db->fetch_first("select * from user where userid='{$value[userid]}'");
			$list[$key]['hig_amount']=number_format($value['hig_amount'],3,'.','');
	$list[$key]['low_amount']=number_format($value['low_amount'],3,'.','');
		$list[$key]['username']=$uu['username'];
	$sum+=$value['money'];
}
}
$sql	= "SELECT sum(money) FROM user_funds where {$search}";
$sum1=$db->fetch_count($sql);
$tpl->assign('sum',$sum);
$tpl->assign('sum1',$sum1);
$tpl->assign('list',$list);
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);

$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);

$bank_list=get_bank_list();
$tpl->assign("bank_list",$bank_list);
$tpl->assign("navtitle",'提现记录');
$tpl->assign('time_arr',array(date('Y-m-d',time()+3600*24),date('Y-m-d',time()),date('Y-m-d',time()-3600*24),date('Y-m-d',time()-3600*24*7)));
?>