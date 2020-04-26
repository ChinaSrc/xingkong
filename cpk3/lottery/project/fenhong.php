<?php
if($_GET['username']){


	$search=" fromid='0' and  toid in (select userid from user where username='{$_GET['username']}') ";


}else{
$search="  fromid='0' ";
}

if(strlen($_GET['status'])>0) $search.=" and `status`='{$_GET[status]}'";
$begindate = isset($_POST[begindate]) ?$_POST[begindate] : $_GET[begindate];
$enddate = isset($_POST[enddate]) ?$_POST[enddate] : $_GET[enddate];

//if(!$begindate) $begindate=date("Y-m-d",time()-30*24*3600);
//if(!$enddate) $enddate=date("Y-m-d");
//$begintime=strtotime($begindate." 00:00:00") ;
//
//$endtime=strtotime($enddate." 23:59:59");
//
//$search.=" and time between '$begintime' and '$endtime'";

$page = $_GET['page'];
if (!$page or $page==0){$page=1;}
$list=$db->fetch_all("select * from fenhong_log where {$search} ");


$total		= count($list);
$pagecount	= ceil($total/$pagesize);
$start		= ($page-1)*$pagesize;

$page_info="页次：".$page." / ".$pagecount." 页 ".$pagesize." 条/每页  共：".$total." 条";
$list=$db->fetch_all("select * from fenhong_log where {$search} order by id desc LIMIT $start, $pagesize");
$sum=0;
$status_arr=array('0'=>"不需分红",'1'=>'发放完成','2'=>'尚未发放');
if(count($list)>0){

foreach ($list as $key=>$value){
$temp=get_user_info($value['toid']);
		$list[$key]['toname']=$temp['username'];

		$list[$key]['status_name']=$status_arr[$value['status']];
//$list1[]=$value;
}


}

$page_list=Core_Page::volistpage($channel,$cid,$total,$pagesize,$page,"index.aspx?",10);
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
?>

 <form action="" method="get" target="_self">

                     <input name="controller" id="controller" type="text" value="project" style='display:none'>
          <input name="action" id="action" type="text" value="fenhong" style='display:none'>
                    <input name="st" type="text" value="1" style='display:none'>
                        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0"
                            cellpadding="0" class="my_tbl">
                            <tr>
                                <td align='left'>
                                                          用户名：

                                 <input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<?php echo $_GET['username']?>" size="20" />

                 类型:<select name='status'>
           <option value=''>不限</option>

           <?php
           foreach ($status_arr as $key=> $value) {

           ?>

           <option value='<?php echo $key;?>'  <?php if(strlen($_GET['status'])>0 and $_GET['status']==$key) echo "selected";  ?>><?php echo $value;?></option>

           <?php }?>
           </select>
                                                                     &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />
                                </td>
                            </tr>
                        </table>
                        </form>
                        <table style="border-bottom: 0px;  border-top: 0px; text-align:center;" border="0" cellspacing="0" cellpadding="0" width="100%">
                          <tbody>
                              <tr>

                                <th align="center">账号

                                </th>

                                <th align="center">开始日期


                                </th>

                                    <th align="center">结束日期


                                </th>
                                       <th align="center">周期投注金额


                                </th>

                                    <th align="center">盈亏


                                </th>

                                    <th align="center">分红比例


                                </th>






                                <th align="center">应发分红



                                </th>



                                <th align="center">状态


                                </th>



                                <th align="center"  >操作
                                </th>
                            </tr>
                   <?php
if($list){
                   foreach ($list as $key=>$value) {
                   ?>


                <tr>

          <td class="center">


          <?php echo $value['toname'];?>


                                </td>

                                         <td class="center">


              <?php echo date('Y-m-d',$value['begintime']);?>
                                </td>


                                         <td class="center">
                      <?php echo date('Y-m-d',$value['endtime']);?>

                                </td>

                                                                <td class="center">
                        <?php echo $value['buy'];?>

                                </td>
                                                                                       <td class="center">
                              <?php echo $value['sum']?>


                                </td>


                                                                    <td class="center">

                     <?php echo $value['pre']?>

                                </td>

                                                                    <td class="center">


<?php echo number_format($value['money'],3,'.','');?>
                                </td>
                                   <td align="center">
                                   <?php echo $value['status_name']?>

                                  </td>









                                <td  class="center">
                          <?php
                          if($value['status'] == '2' && $value['money']>0){
                          ?>

                                <a class='info_btn' onclick="if(confirm('发放分红<?php echo number_format($value['money'],3,'.','');?>元给下级<?php echo $value['toname'];?>，您确定要发放吗？'))location.href='../home_user_fenhonglog.html?type=fafang&id=<?php echo $value['id']; ?>&from=parent';">发放契约</a>

                       <?php }?>
                                   <a href="javascript:void(0);" class='info_btn'

                                   onclick=" winPop({title:'分红详情',form:'Form1',width:'800',height:'400',url:'../home_user_fenhong.html?uid=<?php echo $value['toid']?>&from=parent'});">设置契约</a>

                                 </td>




        </tr>
        <?php }
}else{
        ?>
             <tr>
                                  <td class="page" colspan="10" style="padding: 8px;">
                                      没有查询到相关记录

                                  </td>
                              </tr>


    <?php }?>

                              <tr>
                                  <td class="page" colspan="10" style="padding: 8px;">

   <table width="100%" border="0" cellspacing="1" cellpadding="4" bgcolor="">
   <tr>
       <td width=50% align=left><?php echo $page_info;?></td>
       <td width=50% align=right><?php echo $page_list;?></td>
   </tr>
</table>          </td>
                              </tr>
                          </tbody>
                      </table>