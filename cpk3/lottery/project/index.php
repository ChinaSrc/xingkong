<?php


if($_GET['type']=='gameback'){

$list=	$db->fetch_all("select * from game_buylist where playkey='{$_GET[playkey]}' and period='{$_GET[period]}'");

	if($list){
		
		foreach ($list as $value) {
			game_back($value['id'],'系统撤单');
		}
		
		
	}
	add_adminlog("系统撤单");
	echo "<script>alert('恭喜你撤单成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
exit();
	
}

$add_file=$thispath."_add";
$active=$_GET['active'];
$playkey=$_GET['playkey'];

$nowtime=date("Y-m-d H:i:s",time()-24*3600*30);
$nowdate=date("Y-m-d 00:00:00",time()-24*3600*30);
$nextdate=date("Y-m-d H:i:s",time());
$this_time=$nowdate." 00:00:00";
$db_s="game_buylist";
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
if($active=="bet"  ){
$OpenUrl="../highgame/show_game_buy.aspx?uid=";

if($_GET['type']=='total')
    $search=" user.userid=game_buylist.userid";
    else
$search="  game_buylist.is_zuih='no' and user.userid=game_buylist.userid";
    if($_GET['period'] and $_GET['playkey'])  prize_lot($_GET['playkey'],$_GET['period']);

}
if($active=="trace"){
$OpenUrl="../highgame/show_game_buy.aspx?uid=";
$search=" ( game_buylist.z_number!='') and user.userid=game_buylist.userid";
}
if($active=="prize"){
$OpenUrl="../highgame/show_game_buy.aspx?uid=";
$search=" game_buylist.isprize='is_yes' and user.userid=game_buylist.userid";
$_GET['status']=3;
}
$begindate_get=$_GET['begindate'];
$enddate_get=$_GET['enddate'];

$t_url="?controller=project&action=index&active=".$active;
$db_s="game_buylist,user";

$begintime=$begindate;
$endtime=$enddate;

if($search=='') $search=" 1 ";
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
if($_GET['time']!='no'){
$search.=" and game_buylist.creatdate between '$begintime' and '$endtime'";
}
$projectno=$_GET['projectno'];
if($projectno!=""){$search.=" and game_buylist.buyid='$projectno'";$t_url.="&projectno=".$projectno;}
$pername=$_GET['pername'];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;}
$period=$_GET['period'];
if($period!=""){$search.=" and game_buylist.period='$period'";$t_url.="&period=".$period;}


  if (!$pername) {

    if($_GET['usertype']) $usertype=$_GET['usertype'];
    else $usertype=1;
    if($usertype==1)  $search.=" and game_buylist.userid in (select userid from user where admin=0 and   `virtual`='0' ) ";
    if($usertype==2)  $search.=" and game_buylist.userid in (select userid from user where admin=0 and   `virtual`='1' ) ";

  }
if($_GET['uid']){

  if($_GET['uid'] != '全部'){

    $uids=  get_user_nextid($_GET['uid']);
    $search.=" and game_buylist.userid in ({$uids}) ";
  }

}


if($_GET['status']>0){
	$status=$_GET['status'];
	if($status==1){
		$search.=" and game_buylist.status='0'";
		
	}
	else if($status=='9'){
		
		$search.=" and game_buylist.status='9'";
		
	}
	else{
		
		$search.=" and (game_buylist.status='1' or  game_buylist.status='2' or game_buylist.status='3' )";
		if($status==2){$search.=" and game_buylist.isprize='is_no'";
			
		}
		if($status==3){$search.=" and game_buylist.isprize='is_yes'";
			
		}
		
	}
	
	
}









?>


<script type="text/javascript">
function back_gameall(){
 	var playkey=document.getElementById('playkey');
 	if(playkey.value==''){
alert('请选择彩种');
return  false;
 	 	}

	
 	var pername=document.getElementById('period');
 	if(pername.value==''){
alert('期号不能为空');
return  false;
 	 	}


 	
 	if(confirm('确定要把'+pername.value+'期撤单吗? ')){



 		location.href='index.aspx?controller=project&action=index&active=<?php echo $active;?>&type=gameback&period='+pername.value+'&playkey='+document.getElementById('playkey').value;
 		
 	 	}
    
	
}

</script>

<?php 
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

$game_list=$db->fetch_all("select fullname,ckey from game_type where status='0'");

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

    <form action="" method="GET"   onsubmit="return dosubmit()"  style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="project" style='display:none'> 
          <input name="action" id="action" type="text" value="index" style='display:none'> 
          <input name="active" id="active" type="text" value="<?php  echo $active;?>" style='display:none'>
                 <input name="time" id="time" type="text" value="<?php  echo $_GET['time'];?>" style='display:none'>
        <input type="hidden"  name="from" value="<?php echo $_GET['from']?>">
           <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
	  <?php if($_GET['time']!='no'){?>
	 <?php }?>
    彩种:<select name='playkey'  id='playkey' onchange="document.getElementById('submit').click();">
    <option value=''>所有彩种</option>
    <?php echo  set_game_select('playkey','get'); ?>
    </select>

      &nbsp;期号:
      <input name="period" id="period"  class="input"  type="text" value="<?php echo $period;?>" size="18" maxlength="40" />

	       &nbsp;用户名:
      <input name="pername" id="pername"  class="input"  type="text" value="<?php echo $pername;?>" size="18" maxlength="20" >
	  &nbsp;单号:
      <input name="projectno" id="projectno"  class="input"  type="text" value="<?php echo $projectno;?>" size="18" maxlength="40" />
    
     <?php if($_GET['time']!='no'){?>
       <br>
      起止时间:<input type="text" name="begintime"  value="<?php echo $begin;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
	&nbsp;至

	 <input type="text" name="endtime"  value="<?php echo $end;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

                                                                                                                                                                                                                                                                                                                                                                  超级代理：
         <select name="uid" onchange="document.getElementById('submit').click();"  >

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

         <b>账户类型</b>：

         <select  name='usertype'  onchange="document.getElementById('submit').click();" >
             <option value='-1' <?php if($usertype=='-1') echo "selected" ?> >-全部-</option>
             <option value='1' <?php if($usertype=='1') echo "selected" ?> >正式账号</option>
             <option value='2' <?php if($usertype=='2') echo "selected" ?> >内部账号</option>
         </select>

     <?php }?>
                                        <?php
                                        if($active=="bet"  ){
                                          ?>
                                            状态：<select name='status' onchange="document.getElementById('submit').click();">
                                                <option value=''>-不限-</option>
                                                <option value='1'  <?php if ($_GET['status']==1) echo "selected";?>>未开奖</option>
                                                <option value='2' <?php if ($_GET['status']==2) echo "selected";?>>未中奖</option>
                                                <option value='3' <?php if ($_GET['status']==3) echo "selected";?>>已中奖</option>
                                                <option value='9' <?php if ($_GET['status']==9) echo "selected";?>>已撤单</option>
                                            </select>



                                            <?php
                                        }
                                        ?>



                                        <input name='type' value='<?php echo $_GET['type'];?>' style='display:none'>

         
     <input id='playkey' value='<?php echo $playkey;?>' style='display:none'>
<input type="submit"  class="button" name="submit" value="提交" id="submit"/>


<input type="button"  class="button" name="submit" value="整期撤单" onclick='return back_gameall();'  style='display:none;'/>



</td>

</tr>
</table>
</form>

<?php
if($active=="bet"){$show_title="投注记录";}
if($active=="trace"){$show_title="追号记录";}
if($active=="prize"){$show_title="中奖记录";}
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

?>


      <table> <tr>
          <th  bgcolor="#FFFFFF">单号</th>
          <th  bgcolor="#FFFFFF">用户名</th>
    
           <th bgcolor="#FFFFFF">彩种</th> 
                      <th  bgcolor="#FFFFFF">玩法</th>  
          <th  bgcolor="#FFFFFF">期号</th>
          
                 <th bgcolor="#FFFFFF">投注内容</th>  
          
          <?php 
          
          if($active=="trace"){
          
          
          ?>
          <th  bgcolor="#FFFFFF">期数</th>
                    <th  bgcolor="#FFFFFF">完成数</th>
                              <th  bgcolor="#FFFFFF">取消数</th>            
       


     
                      <th  bgcolor="#FFFFFF">总金额</th>  
          <th  bgcolor="#FFFFFF">完成金额</th>
               <th  bgcolor="#FFFFFF">取消金额</th>
          <?php }else {?>
          <th  bgcolor="#FFFFFF">倍数</th>
                    <th  bgcolor="#FFFFFF">注数</th>
                              <th  bgcolor="#FFFFFF">模式</th>



              <th  bgcolor="#FFFFFF">投注前余额</th>
              <th  bgcolor="#FFFFFF">投注后余额</th>
              <th  bgcolor="#FFFFFF">投注金额</th>
          <th  bgcolor="#FFFFFF">中奖金额</th> 
          
          <?php }?>      
          <th  bgcolor="#FFFFFF">状态</th>
  
            <th  bgcolor="#FFFFFF">投注时间</th>
          <th  bgcolor="#FFFFFF">操作</th>
       </tr>
       
       
       
     <form name="myform" id="myform" method="post" action="save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" />  
<?php
if($playkey!=""){$search.=" and game_buylist.playkey='$playkey'";$t_url.="&playkey=".$playkey;}
mysql_query("set names utf8;");

if($active=="trace"){
	$search.=" and game_buylist.z_number!=''";
$sql3="select  distinct game_buylist.z_number from game_buylist,user where $search order by game_buylist.id desc limit $starnum,$maxnum";
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
$result9 = mysql_query("select count( distinct game_buylist.z_number) from game_buylist,user  where $search") or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9);

$allnum= $rows9[0];
}
else {


  if ($_GET['pername']) {

    $userinfo = $db->fetch_first("select userid from user where username='{$_GET['pername']}'");

      if ($userinfo) {

      $where="userid = '{$userinfo['userid']}' and  game_buylist.creatdate between '$begintime' and '$endtime'";
      if ($playkey) {
          $where .= "and playkey='$playkey'";
      }

    }else{
      $where = "userid = -1 ";
    }


     $sql2 = "select sum(money) as money ,sum(pri_money) as pri from game_buylist where $where";
     $sql3 = "select * from game_buylist  where $where order by game_buylist.id desc limit $starnum,$maxnum";
     $sql_count = "select count(*) from game_buylist where $where";
  }


    if (!$sql2) {

      $sql2="select sum(money) as money ,sum(pri_money) as pri from game_buylist,user where $search and game_buylist.status<9";
    }
    // echo $sql2;
    $row=$db->exec($sql2);
    $sum_money=$row['money'];
    $sum_pri=$row['pri'];

    // exit('11');
if (!$sql3) {

$sql3="select game_buylist.*,user.username from game_buylist,user where $search order by game_buylist.id desc limit $starnum,$maxnum";

}
if (!$sql_count) {
$sql_count =  "select count(*) from $db_s where $search";
}

$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
$result9 = mysql_query($sql_count) or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9); 
  
	
}

$money_sum=0;
$prize_sum=0;

if($nums3){
while($rows3=mysql_fetch_array($result3)){
		$uid=$game_list[$j][z_number];

	
	$open=$db->fetch_first("select * from game_lottery where period='{$rows3[period]}' and playKey='{$rows3[playkey]}'");
	
	$ssc=$db->fetch_first("select * from game_ssc_list where `skey`='{$rows3['list_id']}'");
$this_url=ROOT_URL."/do.aspx?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$rows3['id'];

$game=$db->fetch_first("select fullname from game_type where ckey='{$rows3[playkey]}'");

    $user=get_user_info($rows3['userid']);
    if($user['virtual']==1)  $class ="class='virtual'";else $class='';
echo "<tr height='25' align='center' {$class}>";
echo "<td><a onclick=\"javascript:winPop({title:'查看投注单',form:'Form1',width:'800',height:'550',url:'".$this_url."'});\"  style='cursor:pointer;color:#0000ff;'>".substr($rows3[buyid],0,15)."</a></td>";

echo "<td><a   onclick=\"javascript:winPop({title:'修改用户信息',form:'Form1',width:'600',height:'550',url:'?controller=user&action=index_add&id={$rows3['userid']}'});\" >{$user[username]}</a></td>";

echo "<td>".$game['fullname']."</td>";
echo "<td>".get_game_mark($rows3['id'],1)."</td>";
echo "<td>".$rows3[period]."</td>";

echo "<td>".substr($rows3['number'], 0,30)."</td>";
if($active!="trace"){
echo "<td>".$rows3[times]."</td>";
echo "<td>".$rows3[nums]."</td>";
echo "<td>".$rows3[modes]."</td>";
    echo "<td>".number_show($rows3['amount_before'],3)."</td>";
    echo "<td>".number_show($rows3['amount_after'],3)."</td>";
if($rows3[status]<9)$money_sum+=number_format($rows3['money'],3,'.','');
echo "<td><span >".number_format($rows3['money'],3,'.','')."</span></td>";
if(!$rows3['pri_money'])$rows3['pri_money']='0.000';
if($rows3[status]<9)$prize_sum+=$rows3['pri_money'];
echo "<td>".number_format($rows3['pri_money'],3,'.','')."</td>";

$str_pj='';
if($rows3[status]-1>=0){
if($rows3[isprize]=="is_yes")
{
$status="<font color='red'>已中奖</font>";
}
else{$status="<font color='green'>未中奖</font>";}
$Do_back="";
}else{
	if($open){
$status="<font color='#999999'>未派奖</font>";


	}
else{
    $status="<font color='#999999'>未开奖</font>";
    if($rows3['endtime']+60<time())
    $str_pj="<a class='button' onclick=\"winPop({title:'手动开奖',width:'600',drag:'true',height:'250',url:'?controller=lottery&action=lottery_add&active=new&playKey={$rows3['playkey']}&period={$rows3['period']}'});\">手动开奖</a>";
}
}
$this_url=ROOT_URL."/do.aspx?mod=back&code=game&list=info&flag=yes&uid=".$rows3[id];
$Do_back="<a class='button'title='撤单后，未开奖的单子，退还本金，取消返点，已开奖的单子还将取消中奖奖金' onclick=\"winPop({title:'撤单提示',width:'300',height:'100',url:'".$this_url."'})\">撤单</a>";
$this_url=ROOT_URL."/do.aspx?mod=edit&code=game&list=info&flag=yes&active=edit&uid=".$rows3[id];
$Do_back.="&nbsp;";


if($rows3[status]-9>=0){$status="<font color='#999999'>已撤单</font>";$Do_back="<font color='green'>已撤单</font>";}

if($rows3[status]<=0){
	
//$Do_back.="<input type='button' id='do_put_button' class='buttonnormal'  value='修改' onclick=\"winPop({title:'修改投注信息',width:'500',height:'200',url:'?controller=project&action=edit&id={$rows3['id']}'})\">";
	
	
}

}
else{
	
echo "<td>".$all_peroid."</td>";
echo "<td>".$over_peroid."</td>";
echo "<td>".$back_peroid."</td>";

echo "<td>".number_format($all_money,3,'.','')."</td>";
echo "<td>".number_format($over_money,3,'.','')."</td>";
echo "<td>".number_format($back_money,3,'.','')."</td>";
	
	
if($over_peroid+$back_peroid<$all_peroid){$status="<font color=red>进行中</font>";}else{$status="已结束";}


$str_pj="<a onclick=\"javascript:winPop({title:'查看投注单',form:'Form1',width:'800',height:'550',url:'".$this_url."'});\"  style='cursor:pointer;color:#0000ff;'>详情</a>";

}

echo "<td>".$status."</td>";
echo "<td>".$rows3[creatdate]."</td>";
echo "<td>".$Do_back.$str_pj."</td>";
$listnum+=1;
}
if($active!=='trace'){

    echo "<tr><td style='text-align: center' >本页小计</td>
<td colspan='10'></td>
<td style='text-align: center' >￥{$money_sum}</td>
<td style='text-align: center' >￥{$prize_sum}</td>
<td colspan='5'></td>
</tr>
<tr><td style='text-align: center' >总计</td>
<td colspan='10'></td>
<td style='text-align: center' >￥".number_show($sum_money,3)."</td>
<td style='text-align: center' >￥".number_show($sum_pri,3)."</td>
<td colspan='5'></td>
</tr>";
}

}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=15><font color='#999999'>未找到记录</font></td></tr>";
}
;echo ' 
	  </form>
	  <input id=\'listnums\' value=\'';echo $listnum;;echo '\' type=\'hidden\'>
	  
<script>show_moneys(G(\'listnums\').value,"mon")</script>
  </table>
      
        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	
	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
				';
if(!$allnum)	$allnum=$rows9[0];;
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;
echo ' 
	    </div> 
	</div>   
 
';
?>