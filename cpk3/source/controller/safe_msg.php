<?php

if($_GET['type']=='del'){

	$id=$_GET['id'];
	$info=$db->exec("select * from user_msg where id='{$id}'");
		if($info['userid']==$_SESSION['userid']){
		$db->query("update user_msg set del1='1' where id='{$id}'");

	}
	else $db->query("update user_msg set del2='1' where id='{$id}'");

}

//11.14删除全部已读

if ($_GET['type']=='delall') {

	$db->query("update user_msg set del1 ='1'  where read1= 1 and userid = ".$_SESSION['userid']);

	$db->query("update user_msg set del2 ='1'  where read2= 1 and perid = ".$_SESSION['userid']);
	echo "<script>alert('删除成功！');window.location.href='home_safe_msg.html';</script>";exit;
}

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$isgetdata = isset($_POST[isgetdata]) ?$_POST[isgetdata] : $_GET[isgetdata];
if(!$begindate) $begindate=date("Y-m-d",time()-180*24*3600).' 00:00:00';
if(!$enddate) $enddate=date("Y-m-d")." 23:59:59";
$active = isset($_POST[active]) ?$_POST[active] : $_GET[active];
$show_body="";
if($active==""){$active="js";}
$isgetdata="yes";
$userid=$_SESSION['userid'];
if($isgetdata=="yes"){

$search=" where ((m.userid='$userid' and m.del1='0' )or  (m.perid='{$userid}' and m.del2='0') )";

$t_url=$this_url."&isgetdata=".$isgetdata;

$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate ;

$endtime=$enddate;
$search.=" and m.creatdate between '$begintime' and '$endtime'";

$search.=" and m.replyid='0' ";
$dblist=" ".DB_PREFIX."user_msg as m ";
$page = $_GET['page'];
if (!$page or $page==0){$page=1;};
$countsql	= "SELECT COUNT(m.id) FROM $dblist ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$msg_list	= array();
$msg_list_sql		= "SELECT m.* FROM $dblist $search ORDER BY m.read1 asc ,m.read2 asc, m.creatdate desc LIMIT $start, $pagesize";

$user=get_user_info($_SESSION['userid']);
$msg_list	= $db->getall($msg_list_sql);
$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;

if($msg_list){
	foreach ($msg_list as $key=> $value) {
	if($value['perid']==$userid) {$value['fromname']='我'; $value['css']='left';}
		else if($value['perid']=='0') $value['fromname']='管理员';
		else{
			$row=get_user_info($value['perid']);

//
				if($row['userid']==$user['higherid'])

						$value['fromname']='上级';
		else
			$value['fromname']=$row['username'];

		}

		if($value['userid']==$userid){ $value['toname']='我'; $value['css']='right';}
		else if($value['userid']=='0') $value['toname']='管理员';
		else{
			$row=get_user_info($value['userid']);
			if($row['userid']==$user['higherid'])

						$value['toname']='上级';
		else
			$value['toname']=$row['username'];



		}

       if($value['userid']==$userid){
       	if($value['read1']==0) $value['read']='<font color="#ff0000">未读</font>';
       else $value['read']='已读';

       }
		else{
			     	if($value['read2']==0) $value['read']='<font color="#ff0000">未读</font>';
       else $value['read']='已读';


		}


	$msg_list[$key]=$value;

	}


}
//$msg_list=array_unique($msg_list);
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("list",$msg_list);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
$tpl->assign("pername",$pername);
$tpl->assign("isgetdata",$isgetdata);
$tpl->assign("active",$active);
}
$arr_us=getsql::userinfo($perid,"higherid");
$tpl->assign("higherid",$arr_us['higherid']);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("navtitle",'站内信');
?>