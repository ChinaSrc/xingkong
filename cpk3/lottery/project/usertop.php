<?php


$search=" admin=0 ";

if($_GET['isproxy']){
	
	if($_GET['isproxy']=='-1') $isproxy=0;
	if($_GET['isproxy']=='1') $isproxy=1;	
	$search.=" and isproxy='{$isproxy}' ";
}

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}

$list=$db->fetch_all("select * from user where {$search} ");
$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$user_list=$db->fetch_all("select * from user where {$search} order by userid asc ");
if($_GET['begintime']){
	$begintime=$_GET['begintime']." 00:00:00" ;
}
else $begintime=date('Y-m-d H:i:s',time()-30*24*3600);
if($_GET['endtime']){
$endtime=$_GET['endtime']." 23:59:59";
}
else $endtime=date('Y-m-d H:i:s');


foreach ($user_list as $key=> $value) {
		$amount=get_user_amount($value['userid']);
	      $sum['hig_amount']+=$user_list[$key]['hig_amount']=$amount['hig_amount'];

		$user_list[$key]['i']=$key+1;
    $aa=$db->fetch_first("select count(*) as num from user where higherid='{$value['userid']}'");

    	$user_list[$key]['next_num']=$aa['num'];
    	     $yingkui=get_yingkui($value['userid'], $begintime, $endtime,1);
    	     if(count($yingkui)){
    	     	
    	     	foreach ($yingkui as $k=>$v) {
    	     		if($k=='sum')
    	     		$user_list[$key][$k]=$v;
    	     		
    	     	}
    	     	
    	     }

}

if(!$_GET['sort'] or $_GET['sort']=='desc') $sort='SORT_DESC';
else $sort='SORT_ASC';

$user_list=sysSortArray($user_list,'sum',$sort);
foreach ($user_list as $key=>$value) {
	if($key>=$start and $key<$start+$pagesize){
		
		$list1[]=$value;
	}
}

$this_url="?controller={$_GET[controller]}&action={$_GET['action']}";
//print_r($list);
$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,$this_url."&",10);
$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
?>



                       <form action="" method="get" target="_self">
                       <input name="controller" id="controller" type="text" value="project" style='display:none'> 
          <input name="action" id="action" type="text" value="usertop" style='display:none'> 
         
                        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0"
                            cellpadding="0" class="my_tbl">
                            <tr>
                                <td align='left'>
            &nbsp;      用户类型:   <select name='isproxy'>
                  <option value=''>不限</option>
<option value='-1' <?php if($_GET['isproxy']=='-1') echo "selected";?>>代理</option>
<option value='1'  <?php if($_GET['isproxy']=='1') echo "selected";?>>会员</option>

</select>   
             
                                   &nbsp;日期：
                                                       <input type="text" name="begintime"  value="<?php echo $begin;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
	&nbsp;至

	 <input type="text" name="endtime"  value="<?php echo $end;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;
&nbsp;排序方式：
<select name='sort'>
<option value='desc'>从高到低</option>
<option value='asc' <?php if($_GET['sort']=='asc') echo "selected";?>>从低到高</option>

</select>

                                                                              &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />
                                </td>
                            </tr>
                        </table>
                        </form>
   <table style=" text-align:center; " class="my_tbl" border="0" cellspacing="0" cellpadding="0"  width="100%">
                    <tbody><tr>
                           <th>排名</th>
                        <th>用户名</th>
                      <th>类型</th> <th>下级数量</th>
                      
                       <th>可用余额</th>
                        <th>盈利</th>
                    </tr>
                    
                    <?php foreach ($list1 as $key=>$value) {
                    ?>
                
                    <tr>
                            <td ><?php echo $key+1+$start;?></td>
                        <td>  
                        
                   
                       
                  <?php echo $value['username'];?>
                      
                        </td>
                        
                           <td>  
                        
                        <?php echo  show_user_type($value);?>
                       
                      
                      
                        </td>
                                                            <td>  
                        
               
                       
                <a  href='?controller=project&action=yingkui&st=2&username=<?php echo $value['username'];?>&begintime=<?php echo $begin?>&endtime=<?php echo $end;?>'><?php echo $value['next_num']; ?></a>
                </td>
                        <td>  <?php echo $value['hig_amount']; ?></td>
                        <td><?php echo $value['sum']; ?></td>
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