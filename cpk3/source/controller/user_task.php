<?php

$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
$projectno = isset($_POST[projectno]) ?$_POST[projectno] : $_GET[projectno];
$pername = isset($_POST[pername]) ?$_POST[pername] : $_GET[pername];
$lotteryid = isset($_POST[lotteryid]) ?$_POST[lotteryid] : $_GET[lotteryid];
$includes = isset($_POST[includes]) ?$_POST[includes] : $_GET[includes];
$modes = isset($_POST[modes]) ?$_POST[modes] : $_GET[modes];
$isgetdata = isset($_POST[isgetdata]) ?$_POST[isgetdata] : $_GET[isgetdata];
$show_body="";
$isgetdata="yes";
if($isgetdata=="yes"){
$t_url=$this_url."&isgetdata=".$isgetdata;
if($pername){
$perid=getsql::userids($pername);
if($perid-$userid==0){
}else{
$islowers=getsql::islower($userid,$perid);
if($islowers=="no"){echo "<script>history.back(-1);</script>";exit;}
}
$t_url.="&pername=".$pername;
}else{
$perid=$_SESSION["userid"];
}
$search=" where u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and b.is_zuih='yes'";

    $today=get_day_time();
    if($_GET['begintime']){
        $begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
    }
    else $begintime=$today[0];
    if($_GET['endtime']){
        $endtime=$_GET['endtime']." ".$search_time_arr['end'];
    }
    else $endtime=$today[1];
    $begin=substr($begintime, 0,10);
    $end=substr($endtime, 0,10);
    $search.=" and b.creatdate>='{$begintime}' and b.creatdate<='{$endtime}' ";



$tpl->assign('begin',$begin);
$tpl->assign('end',$end);
if($projectno){
$t_url.="&projectno=".$projectno;
$search.=" and b.buyid='$projectno'";
}

    if(!$_GET['username']) $_GET['username']=$_SESSION['user_name'];
    if($_GET['username']){

        $uu=$db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");

        if(is_team($uu['userid'], $_SESSION['userid']) or $uu['userid']==$_SESSION['userid']){


            if($_GET['st']==1 || $_GET['st']==3 || !$_GET['st'])
                $search.=" and u.username='{$_GET['username']}'";
            else{
                //get_user_nextid($uu['userid']);
                $user_ids=get_user_nextid($uu['userid']);
                $user_ids=str_replace("'", "", $user_ids);
                $search.=" and (u.userid in ( {$user_ids} ))";
            }
        }
        else{
            $search.=" and u.userid='-1'";


        }

    }else{
        $search.=" and u.userid='$perid'";
    }






if($modes){
$t_url.="&modes=".$modes;
$search.=" and b.modes='$modes'";
}
if($lotteryid){
$t_url.="&lotteryid=".$lotteryid;
$search.=" and b.playkey='$lotteryid'";
}
if($_POST['period']) $search.=" and b.period='{$_POST['period']}'";

$search.=" and b.z_number!=''";
$dblist=" ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as t,".DB_PREFIX."game_ssc_list as l";

if($_GET['status']>0){
   $arr=array();
    $game_list_sql		= "SELECT  distinct b.z_number  FROM $dblist $search ORDER BY b.creatdate desc";
    $game_list1	= $db->getall($game_list_sql);
    for ($j=0;$j<count($game_list1);$j++) {

        $game_list[$j] = $db->exec("select b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM $dblist where  u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and b.is_zuih='yes'  and ( b.z_number='{$game_list1[$j]['z_number']}' or  b.id='{$game_list1[$j]['z_number']}')  order by b.period asc");

        $uid = $game_list1[$j]['z_number'];
        $sql5 = "select count(id) as num from " . DB_PREFIX . "game_buylist where (z_number='$uid' or id='{$uid}')  ";
        $rows5 = $db->exec($sql5);
        if ($rows5['num']) {
            $all_peroid = $rows5['num'];
        } else {
            $all_peroid = "0";
        }

        $sql7 = "select count(id) as num  from " . DB_PREFIX . "game_buylist where (z_number='$uid' or id='{$uid}')   and status>0 ";
        $rows7 = $db->exec($sql7);
        if ($rows7['num']) {
            $over_peroid = $rows7['num'];
        } else {
            $over_peroid = "0";
        }



        if($_GET['status']==1){

            if($over_peroid==0){

                $arr[]="'".$uid."'";
            }

        }

        if($_GET['status']==2){

            if($over_peroid>0 and $over_peroid<$all_peroid){

                $arr[]="'".$uid."'";
            }


        }

        if($_GET['status']==3){


            if($over_peroid==$all_peroid){

                $arr[]="'".$uid."'";
            }
        }



    }

    if(count($arr)>0){
        $string=implode(',',$arr);

        $search.=" and  b.z_number in ({$string})";

    }
    else $search.=" and 1=2 ";

}



$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$countsql	= "SELECT COUNT(distinct b.z_number ) FROM $dblist ".$search;
$total		= $db->fetch_count($countsql);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;
$game_list	= array();
$game_list_sql		= "SELECT  distinct b.z_number  FROM $dblist $search ORDER BY b.creatdate desc LIMIT $start, $pagesize";

$game_list1	= $db->getall($game_list_sql);


$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$url = $t_url."&";
$channel	= "case";
$listnums=0;
if($game_list1){
	
for ($j=0;$j<count($game_list1);$j++){

	$game_list[$j]=$db->exec("select b.*,u.username,t.fullname as playname,l.fullname as wanfa,l.cate as wancode FROM $dblist where  u.userid=b.userid and b.playkey=t.ckey and b.list_id=l.skey and b.is_zuih='yes'  and ( b.z_number='{$game_list1[$j]['z_number']}' or  b.id='{$game_list1[$j]['z_number']}')  order by b.period asc");
	
	
	
	$uid=	$game_list1[$j]['z_number'];
    $sql5 ="select count(id) as num, sum(money) as `sum` from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')  ";
    $rows5=$db->exec($sql5);
    if($rows5['num']){$all_peroid=$rows5['num'];}else{$all_peroid="0";}

    if($rows5['sum']){$all_money=$rows5['sum'];}else{$all_money="0";}
    $this_all_money+=$all_money;

    $sql7 = "select count(id) as num, sum(money) as `sum`  from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')   and status>0 and status!=9";
    $rows7=$db->exec($sql7);
    if($rows7['num']){$over_peroid=$rows7['num'];}else{$over_peroid="0";}
    if($rows7['sum']){$over_money= $rows7['sum'];}else{$over_money="0";}
    $this_over_money+=$over_money;

    $sql7 = "select count(id) as num, sum(money) as `sum`  from ".DB_PREFIX."game_buylist where (z_number='$uid' or id='{$uid}')    and status=9";
    $rows7=$db->exec($sql7);
    if($rows7['num']){$back_peroid=$rows7['num'];}else{$back_peroid="0";}
    if($rows7['sum']){$back_money= $rows7['sum'];}else{$back_money="0";}
if($j%2==0){$trbg="class='table_b_tr_a'";}else{$trbg="class='table_b_tr_b'";}
$show_body.= "<tr ".$trbg." height=35>";
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$game_list[$j][id];
$this_period=$game_list[$j][period];

$show_body.= "<td >".$game_list[$j]['username']."</td>";
    $game=	$db->fetch_first("select * from game_type where ckey='{$game_list[$j][playkey]}'");

    $show_body.= "<td >".$game['fullname']."</td>";
$show_body.= "<td title='".$game_list[$j][buyid]."'><div class='td_div'><a onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','800','550')\" target='_blank' style='cursor:pointer;'>".$game_list[$j][period]."</a></div></td>";



if(strlen($game_list[$j][wanfa])-5>=0){$this_code=CutStr($game_list[$j][wanfa],0,4,false);}else{$this_code=$game_list[$j][wanfa];}
$show_body.= "<td >".$this_code."</td>";


if(strlen($game_list[$j][number])-12>0){$lot_num=substr($game_list[$j][number],0,11).".";}else{$lot_num=$game_list[$j][number];}
$show_body.= "<td title='".$game_list[$j][number]."'>".$lot_num."</td>";
//$show_body.= "<td><div class='td_div'>".$game_list[$j][modes]."</div></td>";
    $over=$over_peroid+$back_peroid;

    $show_body.= "<td>".$over."/".$all_peroid."</td>";
    $over=$over_money+$back_money;

    $show_body.= "<td>".sprintf("%.2f",$over)."/".sprintf("%.2f",$all_money)."</td>";

if($over_peroid+$back_peroid==0) $status="未开始";
elseif($over_peroid+$back_peroid<$all_peroid){$status="<font color=red>进行中</font>";}else{$status="已结束";}
$show_body.= "<td>".$status."</td>";
$show_body.= "<td title='".$game_list[$j][creatdate]."'><div class='td_div'>".substr($game_list[$j][creatdate],0,strlen($game_list[$j][creatdate]))."</div></td>";

$show_body.= "<td><div class='td_div'><input type='button' onclick=\"javascript:DialogResetWindow('查看投注单','".$this_url."','800','550')\" class='button'  value='详情'></div></td>";
$show_body.= "</tr>";

$game_list[$j]['status']=$status;
$game_list[$j]['all_peroid']=$all_peroid;
$game_list[$j]['over_peroid']=$over_peroid;
$game_list[$j]['status']=$status;
$moneys=$moneys+$game_list[$j][money];
$listnums+=1;
}
}
}
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$url,10);
$tpl->assign("game_list",$show_body);
$tpl->assign("page_info",$page_info);
$tpl->assign("page_list",$page_list);
if($begindate==""){
$begindate=$thisdate;
$enddate=$nextdate;
}
$tpl->assign("game_arr",$game_arr);
$tpl->assign("config",$config);
$tpl->assign("begindate",$begindate);
$tpl->assign("enddate",$enddate);
$tpl->assign("projectno",$projectno);
$tpl->assign("pername",$pername);
$tpl->assign("includes",$includes);
$tpl->assign("modes",$modes);
$tpl->assign("is_prize",$is_prize);
$tpl->assign("lotteryid",$lotteryid);
$tpl->assign("isgetdata",$isgetdata);
$tpl->assign("list",$game_list);
$tpl->assign("navtitle",'追号记录');
$tpl->assign('time_arr',array(date('Y-m-d',time()+3600*24),date('Y-m-d',time()),date('Y-m-d',time()-3600*24),date('Y-m-d',time()-3600*24*7)));
$yingkui=get_yingkui($_SESSION['userid'], $begindate, $enddate);
$tpl->assign("yingkui",$yingkui);
?>