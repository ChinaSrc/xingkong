<?php

$add_file=$thispath."_add";
$active=$_GET['active'];
$playkey=$_GET['playkey'];
$search="  user_funds.cate='platform' and user.userid=user_funds.userid";
$begindate_get=$_GET['begindate'];
$enddate_get=$_GET['enddate'];

$t_url="?controller=user&action=platform&type=" . $_GET['type'];
if ($_GET['type'] == 'green') {
    $search.="  and user_funds.bankname='绿色通道'";
} elseif ($_GET['type'] == 'card') {
    $search.="  and user_funds.bankname!='绿色通道'";
}
$db_s="user_bank_log";

$today=get_day_time();
if($_GET['begintime']){
    $begintime=$_GET['begintime']." 00:00:00" ;
}
else $begintime=$today[0];
if($_GET['endtime']){
    $endtime=$_GET['endtime']." 23:59:59";
}
else $endtime=$today[1];
$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
if($begintime and $endtime)
$search.=" and user_funds.creatdate between '$begintime' and '$endtime'";
$pername=$_GET[pername];
if($_GET['usertype']) $usertype=$_GET['usertype'];
else $usertype=1;
if($usertype==1)  $search.=" and user_funds.userid in (select userid from user where admin=0 and   `virtual`='0' ) ";
if($usertype==2)  $search.=" and user_funds.userid in (select userid from user where admin=0 and   `virtual`='1' ) ";
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;}
if(request('status')>=-1){

	$status=request('status');
	if($status==-1) $status=0;
	$search.=" and user_funds.status='{$status}' ";
	$t_url.="&status=".$status;
}
$db->query("update user_funds set notice='1' where notice='0'");
if($_GET['cate']) $search.=" and  bankname='{$_GET[cate]}' ";
if($_GET['realname']) $search.=" and  realname='{$_GET[realname]}' ";
if($_GET['order_sn']) $search.=" and order_sn='{$_GET['order_sn']}'";
if($_GET['userid']) $search.=" and user.userid='{$_GET['userid']}'";
if($_GET['uid']){
    $uids=get_user_nextid($_GET['uid']);
    $search.=" and user.userid in ({$uids}) ";

}
;echo '
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
?>




      <form name="form1" id="form1" method="GET" action="?controller=user&action=platform" >

          <input name="controller" id="controller" type="text" value="user" style='display:none'>
          <input name="action" id="action" type="text" value="platform" style='display:none'>

          <input type="hidden"  name="from" value="<?php echo $_GET['from']?>">
          <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
                                        超级代理：
                                        <select name="uid" onchange="document.getElementById('submit').click();">

                                            <option value="">全部</option>
                                            <?php
                                            $temp11=$db->fetch_all("select * from user where higherid='0' and admin='0' order by userid asc");
                                            foreach ($temp11 as $value11){
                                                ?>


                                                <option value='<?php echo $value11['userid'];?>' <?php if($_GET['uid']==$value11['userid']) echo "selected";?>><?php echo $value11['username'];?></option>
                                                <?php
                                            }
                                            ?>


                                        </select>
  <b>	用户名</b>:
      <input name="pername" type="text" value="<?php echo  $pername;?>" size="20" />
                                        <b>	开户姓名</b>:
                                        <input name="realname" type="text" value="<?php echo  $_GET['realname'];?>" size="20" />
   <b>UID</b>：  <input type="text" name="userid" id="userid" style="width:200px;" value="<?php echo $_GET['userid']?>">

&nbsp;<br>
	<b>时间</b>：     <input type="text" name="begintime"  value="<?php echo $begin;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
	至

	 <input type="text" name="endtime"  value="<?php echo $end;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />


<b>	提现状态</b>：
<select name='status'>
<option value=''>-全部-</option>
<option value='-1' <?php if (request('status')==-1) echo "selected";?>>等待汇款</option>
<option value='1' <?php if (request('status')==1) echo "selected";?>>提现成功</option>
<option value='2' <?php if (request('status')==2) echo "selected";?>>提现失败</option>

</select>
&nbsp;

          <b>提现类型</b>：
					<?php
					$bank_list = get_platfrom_type();
					?>
          <select name='type' onchange="document.getElementById('submit').click();">
						<?php foreach ($bank_list as $key => $value) { ?>

              <option value="<?php echo $key; ?>" <?php if ($key == $_GET['type']) echo "selected"; ?>><?php echo $value; ?></option>
						<?php } ?>
          </select>
                                        <b>账户类型</b>：

                                        <select  name='usertype'  onchange="document.getElementById('submit').click();" >
                                            <option value='-1' <?php if($usertype=='-1') echo "selected" ?> >-全部-</option>
                                            <option value='1' <?php if($usertype=='1') echo "selected" ?> >正式账号</option>
                                            <option value='2' <?php if($usertype=='2') echo "selected" ?> >内部账号</option>
                                        </select>

<input type="submit"  class="button" name="submit" value="提交" id="submit" />

  </td>
  </tr>
  </table>
  </form>

<script>
function del_id(id){


	location.href='index.aspx?controller=user&action=recharge&type=delete&id='+id;


}






</script>













<?php
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
echo '

<table> <tr>
<th bgcolor="#FFFFFF">UID</th>
          <th  bgcolor="#FFFFFF">用户名</th>
           
     <th  bgcolor="#FFFFFF">开户姓名</th>

          <th  bgcolor="#FFFFFF">提现金额</th>
           <th  bgcolor="#FFFFFF">变更前余额</th>
     <th  bgcolor="#FFFFFF">变更后余额</th>
          <th  bgcolor="#FFFFFF">银行类型</th>
  

          <th  bgcolor="#FFFFFF">银行账号</th>
            
                             <th bgcolor="#FFFFFF">操作人</th>
        <th bgcolor="#FFFFFF">时间</th>      <th bgcolor="#FFFFFF">状态</th>
          <th bgcolor="#FFFFFF">操作</th>
          
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" >
       <input name="flag" type="hidden" value="save" />
	   ';

$sql3="select user_funds.*,user.username from user_funds,user where $search order by user_funds.creatdate desc ";
$listAll=$db->fetch_all($sql3);
$sum1=0;
if(count($listAll)>0){
    foreach ($listAll as $value){

        $sum1+=$value['money'];
    }

}


$page=new Page($sql3,20,$_GET['page']);
$sql3.=" limit {$page->from},20";
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
if($nums3){
	$i=0;
	$sum=0;
while($rows3=mysql_fetch_array($result3)){
	$i++;
	$num=$i+$starnum;
    $sum+=$rows3['money'];
    $user=get_user_info($rows3['userid']);


    if ($rows3['status']==0 && $user['virtual'] != 1) {
      // $ip_abnormal = $db->fetch_all("SELECT * FROM userlog WHERE uid = ".$rows3['userid']." ORDER BY id DESC LIMIT 4");
      // // $ip_abnormal = $db->fetch_all("SELECT * FROM userlog WHERE uid = ".$rows3['userid']." and time >"strtotime("-3 day"));

      // if (count($ip_abnormal)>1) {

      //   foreach ($ip_abnormal as $key => $value) {
      //     $ipdata[$key] = $value['ip'];
      //     $contentdata[$key] = $value['content'];
      //     $systemdata[$key] = $value['system'];
      //     $iedata[$key] = $value['ie'];
      //     $adderssdata[$key] = $value['adderss'];
      //   }

      //   if (count(array_unique($ipdata))>1) {
      //       if (count(array_unique($contentdata))==1 && count(array_unique($systemdata))==1 && count(array_unique($iedata))==1 ) {
      //       $ip_state = 1;
      //       }else{
              
      //         $ip_state = 0;
      //       }
      //   }else{
      //     $ip_state = 1;
      //   }


      // }

      if ($db->fetch_all("SELECT id FROM  user_funds  WHERE userid = ".$rows3['userid']." and cate='platform' and bankname != '绿色通道' and id !=".$rows3['id'])) {
        
          if ($db->fetch_all("SELECT id FROM  user_funds  WHERE userid = ".$rows3['userid']." and cate='platform' and realname ='".$rows3['realname']."' and banknum ='".$rows3['banknum']."' and id !=".$rows3['id'] )) {
            $ip_state = 1;
          }else{
            $ip_state = 0;
          }

      }else{
            $ip_state = 1;

      }

    }else{
      $ip_state = 1;

    }



    if($user['virtual']==1)  $class ="class='virtual'";else $class='';
    if ($ip_state == 0) {
      $class = "class='ipabnormal'";
    }
echo "<tr height='25' align='center' {$class}>";
    echo "<td>".$rows3[userid]."</td>";
echo "<td>{$rows3[username]}</td>";

    echo "<td>".$rows3['realname']."</td>";


echo "<td style='font-weight: bold'>".number_show($rows3[money])."</td>";
echo "<td>".number_show($rows3[hig_amount])."</td>";
    if(!$rows3['amountafter']) $after='-';
    else  $after=number_show($rows3[amountafter]);

    echo "<td><span >".$after."</span></td>";


echo "<td>".$rows3[bankname]."</td>";

echo "<td>".$rows3[banknum]."</td>";


    echo "<td>".$rows3[admin]."</td>";
echo "<td>".$rows3[creatdate]."</td>";
    if($rows3['status']==0) $status="<font color='red'>等待汇款</font>";
    if($rows3['status']==1) $status="提现成功";
    if($rows3['status']==2) $status="提现失败";
    echo "<td>".$status."</td>";

$this_url="index.aspx?controller=user&action=platform_info&id=".$rows3['id'];
if($rows3[status]=="0"){
    $status="<a onclick=\"winPop({title:'处理信息',form:'Form1',width:'550',drag:'true',height:'386',url:'{$this_url}'})\"  class='button'>审核</a>";
}
else{
    $status="<a onclick=\"winPop({title:'处理信息',form:'Form1',width:'550',drag:'true',height:'386',url:'{$this_url}'})\"  style='cursor:pointer;'>查看</a>";

}
if($rows3['status']==2) $status.="<a onclick='del_id({$rows3['id']});' style='cursor:pointer;'>删除</a>";


echo "<td>".$status."</td>";
echo "</tr>";


$listnum+=1;
}
    echo "<tr><td style='text-align: center' >本页合计</td>
<td colspan='2'></td>
<td style='text-align: center' >￥{$sum}</td>
<td colspan='9'></td>
</tr>";

    echo "<tr><td style='text-align: center' >所有合计</td>
<td colspan='2'></td>
<td style='text-align: center' >￥{$sum1}</td>
<td colspan='9'></td>
</tr>";
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=12><font color='#999999'>未找到记录</font></td></tr>";
}
;echo '
	  </form>

  </table>

        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>

	   
	    <div class="page">
					';
echo $page->get_page();
;echo '
	    </div>
	</div>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php")
?>