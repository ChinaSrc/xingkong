<?php

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;

$uid = $_GET[uid];
$pername = $_GET[pername];

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}

$search=" and v.admin='0' ";
if($uid>0 ){
    $uids=get_user_nextid($uid);
//$search.=" and (v.higherid='$uid' )";
    $search.=" and v.userid in ({$uids}) ";

}
if($_GET['isproxy']==-1) $isproxy='0';
else $isproxy=$_GET['isproxy'];
if($_GET['isproxy']) $search.=" and v.isproxy='{$isproxy}'";

if($_GET['virtual']==-1) $virtual='0';
else $virtual=$_GET['virtual'];
;
if($_GET['virtual']) $search.=" and v.virtual='{$virtual}'";

if($_GET['groupid']) $search.=" and v.groupid='{$_GET['groupid']}'";
if ($_GET['highest']==1){

    $search.=" and v.higherid='0'";
}
if($_GET['qq']) $search.=" and v.qq='{$_GET['qq']}'";
if($_GET['weixin']) $search.=" and v.weixin='{$_GET['weixin']}'";
if($_GET['mobilephone']) $search.=" and v.qq='{$_GET['mobilephone']}'";
// if($_GET['ip']) $search.=" and v.userid in (select uid from userlog where ip='{$_GET['ip']}') ";

if($_GET['username']){
	if($_GET['st']==1)
	$search.=" and v.username='{$_GET['username']}'";
else{

$search.=" and v.higherid in (select userid from user where username='{$_GET['username']}')";

}
}
else{
	//$search.="and v.higherid='0'";
}

if($_GET['realname']) $search.=" and v.userid in (select userid from user_bank_list where realname='{$_GET[realname]}') ";

if($_GET['begintime']){
	$begintime=$_GET['begintime']." 00:00:00" ;
	$search.=" and v.registertime>='{$begintime}'";
}
if($_GET['endtime']){
$endtime=$_GET['endtime']." 23:59:59";
	$search.=" and v.registertime<='{$endtime}'";
}

if($_GET['orderby']) $orderby=$_GET['orderby'];
else $orderby='v.userid desc';


$user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid ".$search." ORDER BY {$orderby} ";



if($_GET['field']){


        $username_id=  $db->fetch_all("select userid from user_field where value='{$_GET['field']}'");

        if ($username_id) {

            foreach ($username_id as $k => $v) {
                $id_arr[] = $v['userid'];
            }
            $stars_id  = implode(",", $id_arr);


            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid in({$stars_id}) ORDER BY {$orderby} ";           
        }else{
            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=0 ";
        }


}





if ($_GET['realname']) {
        $username_id=  $db->fetch_all("select userid from user_bank_list where realname='{$_GET['realname']}'");
        if ($username_id) {

            foreach ($username_id as $k => $v) {
                $id_arr[] = $v['userid'];
            }
            $stars_id  = implode(",", $id_arr);


            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid in({$stars_id}) ORDER BY {$orderby} ";           
        }else{
            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid = 0 ORDER BY {$orderby} ";
        }
}


if ($_GET['username'] && ($_GET['st'] == 1 || $_GET['st']== '')) {


        $username_id = $db->fetch_first("select userid from user where username='{$_GET['username']}'");
    
        if ($username_id) {
            $stars_id = $username_id['userid'];
            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid = {$stars_id} ";           
        }else{
            $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid = 0 ORDER BY {$orderby} ";
        }
}

if ($_GET['userid']) {
    $user_list_body_sql     = "SELECT v.*,b.hig_amount,b.low_amount FROM user as v,user_bank as b where v.userid=b.userid  and v.userid = '{$_GET['userid']}' ORDER BY {$orderby} ";
    
}


$page=new Page($user_list_body_sql,$pagesize,$page);
$user_list_body_sql		.= "limit $page->from, $pagesize";
$linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
$user_list_low	= $db->getall($user_list_body_sql);
foreach ($user_list_low as $key=>$value) {
$bank=  $db->fetch_first("select realname from user_bank_list where userid='{$value[userid]}'");
$user_list_low[$key]['realname']=$bank['realname'];
	$amount=get_user_amount($value['userid']);
  $temp=  $db->exec("select count(*) as num from user where higherid='{$value['userid']}'");
    $user_list_low[$key]['next_num']=$temp['num'];

	$user_list_low[$key]['total_amount']=$amount['total_amount'];

    	   $team= get_team_info($value['userid']);



 $user_list_low[$key]['team_money']=$team['money'];
 $user_list_low[$key]['online']=$team['online'];

}

// if($_GET['username']){ 

// $sql="select * from user where username='{$_GET['username']}' and admin='0'";
// $meuser=$db->exec($sql);

// if($meuser){
// 		$pid=get_user_pid($meuser['userid']);
// 	$temp_leve1='';
// 	if(count($pid)>0){
// 	for($i=count($pid)-1;$i>=0;$i--){
// 		if($temp_leve1==''){

// 			if($pid[$i]['userid']==$_SESSION['userid'] ) $temp_leve1.="<a href='?controller={$_GET['controller']}&action={$_GET['action']}&st=2&username={$pid[$i]['username']}'>{$pid[$i]['username']}</a>";

// 		}
// 		else
// 		$temp_leve1.="&nbsp;&gt;&nbsp;<a href='?controller={$_GET['controller']}&action={$_GET['action']}&st=2&username={$pid[$i]['username']}'>{$pid[$i]['username']}</a>";


// 	}

// 	}

// 	$amount=get_user_amount($meuser['userid']);

// 	$meuser['total_amount']=$amount['total_amount'];

//    $team= get_team_info($meuser['userid']);
// $meuser['next_num']=$team['num'];
// $meuser['team_money']=$team['money'];
// $meuser['online']=$team['online'];

// }
// }


?>
<script type="text/javascript">
            //默认提交状态为false
            var commitStatus = false;
            function dosubmit(){
                  if(commitStatus==false){
                //提交表单后，讲提交状态改为true
                  commitStatus = true;
                  return true;
                 }else{
                  return false;
              }
             }
      </script>


  <form action="" method="get" name="frm_search" onsubmit="return dosubmit()" id="frm_search" >

                  <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
                  <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">

                        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
                                        账号：
                                <select name="st" onchange="document.getElementById('frm_search').submit();" >
                                    <option value="1"   <?php if($_GET['st']==1) echo "selected";?> >个人</option>
                                    <option value="2"  <?php if($_GET['st']==2) echo "selected";?>>下级</option>
                                 </select>
                                 <input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<?php echo $_GET['username']?>" size="20" />

                                        超级代理：
                                        <select name="uid" onchange="document.getElementById('frm_search').submit();" >

                                            <option>全部</option>
                                            <?php
                                            $temp11=$db->fetch_all("select * from user where higherid='0' and admin='0' order by userid asc");
                                            foreach ($temp11 as $value11){
                                                ?>


                                                <option value='<?php echo $value11['userid'];?>' <?php if($_GET['uid']==$value11['userid']) echo "selected";?>><?php echo $value11['username'];?></option>
                                                <?php
                                            }
                                            ?>


                                        </select>

                                        类型：
                                        <select name="isproxy" onchange="document.getElementById('frm_search').submit();" >
                                            <option value=""  >全部</option>
                                            <option value='1' <?php if($_GET['isproxy']==1) echo "selected";?>>玩家</option>
                                            <option value='-1' <?php if($_GET['isproxy']==-1) echo "selected";?>>代理</option>
                                        </select>

                                        内部：
                                        <select name="virtual" onchange="document.getElementById('frm_search').submit();" >
                                            <option value=""  >全部</option>
                                            <option value='1' <?php if($_GET['virtual']==1) echo "selected";?>>是</option>
                                            <option value='-1' <?php if($_GET['virtual']==-1) echo "selected";?>>否</option>
                                        </select>

                                        会员组:
                                        <select name="groupid" onchange="document.getElementById('frm_search').submit();" >
                                            <option value=""  >全部</option>
                                            <?php
                                            $query=$db->query("select * from user_group order by id asc");

                                            while ($row=$db->fetch_array($query)){
                                                ?>
                                                <option value="<?php echo $row['id']?>" <?php if($row['id']==$_GET['groupid']) echo "selected";?>><?php echo $row['title'].'-'.$row['touxian'];?></option>

                                                <?php
                                            }

                                            ?>
                                        </select>

                                       姓名： <input style="width: 120px" class="textbox" name="realname" type="text" id="realname" value="<?php echo $_GET['realname']?>" size="20" />

                                        <br>

                                        注册时间：<input name="begintime" class="Wdate" type="text" id="begintime" value="<?php echo $_GET['begintime']?>" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:120px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<?php echo $_GET['endtime']?>" size="18" style="width:120px;"/>
                                       UID： <input style="width: 120px" class="textbox" name="userid" type="text" value="<?php echo $_GET['userid']?>" size="20" />
                                       微信/QQ/手机号： <input style="width: 120px" class="textbox" name="field" type="text" value="<?php echo $_GET['field']?>" size="20" />


                                 &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />


                                                        &nbsp;&nbsp;<input type="button" class="button" value="添加新用户"  onclick="winPop({title:'添加新用户',form:'Form1',width:'800',height:'620',url:'?controller=user&action=index_add'});"  />



                                   <!--  <?php
                                    if($temp_leve1) echo "<br>".$temp_leve1;
                                    ?> -->
                                    </td>
                                </tr>
                        </table>

                        </form>
<!-- <form action="?controller=<?php echo $_GET['controller'];?>&action=inportant" method="post" enctype="multipart/form-data">


    <input type="file"  value=""   name="csv" />

    &nbsp;&nbsp;<input type="submit" class="button" value=" 导入用户 " />
</form>
 --><style>

    .list_tbl tr td{min-width: 60px;font-size: 14px}
    .list_tbl tr td a{text-decoration:underline}

</style>
                        <table style="border-bottom: 0px;  border-top: 0px;" class="my_tbl my list_tbl"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <th height="23" align="center">UID   <?php echo show_order('v.userid');?>
                                </th>

                                <th align="center">会员组
                                    <?php echo show_order('v.groupid');?>

                                </th>

                                   <th align="center">用户名

                                        <?php echo show_order('v.username');?>

                                </th>

                                <th align="center">姓名

                                </th>

                                <th align="center">上级

                                </th>

                                <th align="center">类型
                                               <?php echo show_order('v.isproxy');?>

                                </th>




                                <th align="center">账户余额

                                 <?php echo show_order('b.hig_amount');?>


                                </th>
                                <th align="center">积分
                                    <?php echo show_order('v.score');?>

                                </th>

                                <th align="center">返点


                                </th>





                                <th align="center">洗码
                                    <?php echo show_order('b.low_amount');?>


                                </th>

                             <th align="center">下级人数



                                </th>
                                <th align="center">总充值
                                </th>

                                <th align="center">总提现
                                </th>

                                <th align="center">总盈亏
                                </th>

                                <th align="center">状态
                                </th>
                                <th align="center">彩金分组
                                </th>

                                <th align="center" >最近登录时间
                                 <?php echo show_order('v.lastlogintime');?>




                                </th>




                                <th align="center"  >操作
                                </th>
                            </tr>




                            <?php
                            foreach ($user_list_low as $key=>$value) {

                            ?>


                            <tr <?php if($value['virtual']==1)  echo "class='virtual'";?>>
                                <td align="center"><?php echo $value['userid'];?></td>

                                <td>

<?php
echo showgroup_title($value['groupid']);
?>
                                </td>

                                <td align="center">


                                    <a   onclick="winPop({title:'编辑用户（<?php echo $value['username'];?>)',form:'Form1',width:'800',height:'620',url:'?controller=user&action=index_add&id=<?php echo $value['userid'];?>'});">


                                    <?
                                   echo $value['username'];


                                   ?>
                                    </a>


                                </td>
                                                             <td>

                                                                 <a href="?controller=user&action=banklist&pername=<?php echo $value['username'];?>">  <?php echo showrealname($value['userid']); ?></a>
                                </td>

                                <td>

                                    <?php
                                    if($value['higherid']){
                                     $parent=   get_user_info($value['higherid']);
                                       echo $parent['username'] ;
                                    }
                                    else echo '-';
                                    ?>
                                </td>


                                <td align="center">
                                <?php echo show_user_type($value);?>

                                </td>



                                <td align="center">
                                    <a  onclick="winPop({title:'充值-<?php echo $value['username'];?>',width:'700',drag:'true',height:'300',url:'index.aspx?controller=user&action=pay&id=<?php echo $value[userid];?>'})" >
                                        <?php echo number_show($value['total_amount']);?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    echo $value['score'];
                                    ?>
                                </td>
                                <td>

                                     <a  onclick="winPop({title:'返点-<?php echo $value['username'];?>',width:'700',drag:'true',height:'250',url:'index.aspx?controller=user&action=rebates_edit&id=<?php echo $value[userid];?>'})" >
                                      <?php
                                        $rebates=unserialize($value['rebates']);
                                        echo $rebates['k3'];
                                        ?>
                                     </a>
                                </td>



                                <td align="center">

                                    <a  onclick="winPop({title:'洗码-<?php echo $value['username'];?>',width:'700',drag:'true',height:'220',url:'index.aspx?controller=user&action=pay1&id=<?php echo $value[userid];?>'})" >
                                        <?php echo number_show($value['low_amount'])?>
                                    </a>
                                </td>


                                            <td align="center">
                               <?php
                               if($value['next_num']>0){
                               ?>

              <a href='?controller=<?php echo $_GET['controller']?>&action=<?php echo  $_GET['action']?>&st=2&username=<?php echo $value['username'];?>'  style="color:#38f;font-weight: 600;"  ><?php echo $value['next_num']?></a>

                               <?php }else
echo $value['next_num'];
                                ?>

                                </td>


                                <td align="center">
                                    <a onclick="winPop({title:'总充值-<?php echo $value['username'];?>',form:'Form1',width:'1100',height:'600',url:'?controller=user&action=recharge&st=1&from=parent&pername=<?php echo $value['username'];?>'});">
                                    总充值</a>

                                </td>

                                <td align="center">
                                    <a onclick="winPop({title:'总提现-<?php echo $value['username'];?>',form:'Form1',width:'1100',height:'600',url:'?controller=user&action=platform&st=1&from=parent&pername=<?php echo $value['username'];?>'});">
                                        总提现</a>

                                </td>

                                <td align="center">

                                    <a onclick="winPop({title:'总盈亏-<?php echo $value['username'];?>',form:'Form1',width:'1000',height:'600',url:'?controller=project&action=yingkui&st=1&from=parent&username=<?php echo $value['username'];?>'});">
                                        总盈亏</a>


                                </td>


                                   <td align="center">
                                    <?php
                                    if(is_online($value['userid'])) {
                                    	?>
                                    	  <span style="color:#ff0000;">在线</span>&nbsp;[<span onclick="put_get_out('<?php echo $value[userid]; ?>','<?php echo $value[username]; ?>');">踢<span>]
                                    	<?

                                    }
                                    else echo "离线";
                                    ?>

                                </td>
                                <td align="center">
                                    <?php
                                    switch ($value['user_tab']) {
                                        case 0:echo '重名不送彩金';break;
                                        case 1:echo '重名可送彩金';break;
                                        case 2:echo '不送用户彩金';break;
                                    }
                                    ?></td>
                                   <td align="center">
                              <?php echo $value['lastlogintime']?></td>

                                <td align="center">
    <a onclick="winPop({title:'团队报表-<?php echo $value['username'];?>',form:'Form1',width:'800',height:'500',url:'?controller=user&action=team&active=account&from=parent&username=<?php echo $value['username'];?>'});">报表</a>&nbsp;


			<a onclick="winPop({title:'账变-<?php echo $value['username'];?>',form:'Form1',width:'1000',height:'600',url:'?controller=project&action=bank&active=account&from=parent&pername=<?php echo $value['username'];?>'});">帐变</a>
			<a onclick="winPop({title:'投注-<?php echo $value['username'];?>',form:'Form1',width:'1000',height:'600',url:'?controller=project&action=index&active=bet&from=parent&pername=<?php echo $value['username'];?>'});">投注</a>

		

                                    <?php

                                    if($value['status']==1){
                                        ?>
                                       <a style="color: #0a7c24" onclick="info_jiedong(<?php echo $value['userid'];?>,'<?php echo $value['username'];?>',<?php echo $value['status'];?>)">解锁</a>
                                    <?php }else{?>
                                      <a onclick="info_jiedong(<?php echo $value['userid'];?>,'<?php echo $value['username'];?>',<?php echo $value['status'];?>)">锁定</a>

                                    <?php }?>


                                  </td>
                            </tr>


                     <?php }?>

                        </table>
<div class="page">
    <?php
    echo $page->get_page();

    ?>


</div>





	  <script>

	  function put_del_user(perid,pername){
		  var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		  return winPop({title:'删除会员帐号',form:'Form',width:'300',height:'120',url:thisPathUrl+'/?action=dialog_simple&active=deluser&uid='+perid+'&pername='+pername+'&nexts=reload'})
	  }

	  function put_get_out(perid,pername){
		  var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		  return winPop({title:'强制会员（'+pername+'）下线',form:'Form',width:'400',height:'150',url:thisPathUrl+'/?action=dialog_simple&active=getout&uid='+perid+'&pername='+pername+'&nexts=reload'})
	  }
	  function info_jiedong(perid,pername,keys){
		  var values="no";
		  if(keys==1){
		      var value=0;
			  var titles="确定对"+pername+"的资料进行解锁操作？";
		  }else{
			  var titles="确定对"+pername+"的资料进行锁定操作？";
			  value=1;
		  }
		  var show_dilog= window.confirm(titles);
		  if(show_dilog){
var url="?controller=user&action=action&active=update&key=status&value="+value+"&userid="+perid

              location.href=url;

          }

	  }
	 function FailFun(){
		 window.location.reload();

     }

      </script>
  </table>
