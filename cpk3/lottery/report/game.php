
<?php


$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];
if(!$begindate) $begindate=date("Y-m-d",time()-30*24*3600);
if(!$enddate) $enddate=date("Y-m-d");
$begintime=$begindate." 00:00:00" ;

$endtime=$enddate." 23:59:59";

$search.=" and creatdate between '$begintime' and '$endtime'";
if($_GET['playkey']) $search.=" and playkey='$_GET[playkey]' ";

if(!$_GET['sort']) $sort="num";
else $sort=$_GET['sort'];
if (!$page or $page==0){$page=1;}
$list=$db->fetch_all("select list_id,count(*) as num from game_buylist where status<=3 {$search} group by playkey");


$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";


$sql="select playkey,count(*) as num,sum(money) as money,sum(pri_money) as prize ,sum(money)-sum(pri_money) as yingkui  from game_buylist where (status='1' or status='2' or status='3') {$search} group by playkey  order by {$sort} desc  LIMIT $start, $pagesize ";

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

$list=$db->fetch_all($sql);
$this_url="?controller={$_GET['controller']}&action={$_GET['action']}";
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$this_url."&",10);
?>


    <form action="" method="GET" style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="<?php echo $_GET['controller']?>" style='display:none'> 
          <input name="action" id="action" type="text" value="<?php echo $_GET['action']?>" style='display:none'> 
  
	  <div class="search_box">
	  <?php if($_GET['time']!='no'){?>
	    &nbsp;开始时间:
      <input type="text" name="begindate" id="begindate"  value="<?php echo $begindate;?>" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
           截止时间：<input type="text" name="enddate" id="enddate" value="<?php echo $enddate;?>" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
    <?php }?>

    </select>

排序：<select  name='sort'>
<option value='num' <?php if($sort=='num') echo "selected";?>>投注数量</option>
<option value='money'<?php if($sort=='money') echo "selected";?>>投注金额</option>
<option value='prize' <?php if($sort=='prize') echo "selected";?>>中奖金额</option>
<option value='yingkui' <?php if($sort=='yingkui') echo "selected";?>>盈亏</option>
</select>
<input type="submit"  class="button" name="submit" value="提交" /></div>
</form>


      <table style=" text-align:center; " class="list_tbl" border="0" cellspacing="0" cellpadding="0"  width="100%">
	
       <tr>
          <th  bgcolor="#FFFFFF">彩种</th>
      
          <th bgcolor="#FFFFFF">投注数量</th>
           <th  bgcolor="#FFFFFF">投注金额</th> 
          <th  bgcolor="#FFFFFF">中奖金额</th>
            
       
          <th bgcolor="#FFFFFF">盈亏</th>  
     
       </tr>
       <?php 
       if($list){
       foreach ($list as  $key=> $value) {
    	$ssc=$db->fetch_first("select * from game_type where `ckey`='{$value['playkey']}'");
    	

       ?>
       <tr>
       <td><?php echo $ssc['fullname'];?></td>

       <td><?php echo $value['num']?></td>
        <td><?php echo number_format($value['money'],3);?></td>
         <td><?php if(!$value['prize']) echo '0.00';echo number_format($value['prize'],3)?></td>
          <td><?php echo number_format($value['yingkui'],3)?></td>
       </tr>
       
       
       
       <?php }?>
                   <tr>
                                <td class="page" colspan="11" style="padding: 8px;">
                                       <table width="100%" border="0" cellspacing="1" cellpadding="4" bgcolor="">
   <tr>
       <td width=50% align=left><?php echo $page_info;?></td>
       <td width=50% align=right><?php echo $page_list;?></td>
   </tr>
</table>
                                </td>
                            </tr>
<?php }else{?>

       <tr>
                                <td class="page" colspan="11" style="padding: 8px;">
没查询到投注记录

                </td>
                            </tr>

<?php }?>
  </table>
      

