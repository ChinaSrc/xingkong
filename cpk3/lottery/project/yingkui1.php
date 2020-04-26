
<?php
if($_GET['begintime']){


    $begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
}
else $begintime=date('Y-m-d',time()-9*24*3600)." ".$search_time_arr['begin'];
if($_GET['endtime']){
    $endtime=$_GET['endtime']." ".$search_time_arr['end'];
}
else $endtime=date('Y-m-d',time())." ".$search_time_arr['end'];
$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
require_once '../source/class/cache.php';
$cache = new Cache();
?>

<form action="" method="get" target="_self">
    <input name="controller" id="controller" type="text" value="project" style='display:none'>
    <input name="action" id="action" type="text" value="yingkui1" style='display:none'>
    <input type="hidden"  name="from" value="<?php echo $_GET['from']?>">

    <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0"
           cellpadding="0" class="my_tbl">
        <tr>
            <td align='left'>



                &nbsp;日期：
                <input type="text" name="begintime"  value="<?php echo $begin;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
                &nbsp;至

                <input type="text" name="endtime"  value="<?php echo $end;?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

                &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />
            </td>
        </tr>
    </table>
</form>
<table style="border-top: 0px;text-align:center; " class="my_tbl list_tbl" border="0" cellspacing="0" cellpadding="0" width="100%">
    <tbody><tr>

        <th>日期</th>





        <th>充值


        </th>
        <th>提现


        </th>
        <th>下注

        </th>
        <th>中奖

        </th>

        <th>活动

        </th>
        <th>返点



        </th>

        <th>盈亏


        </th>

    </tr>
<?php
$page=$_GET['page'];
if(!$page)  $page=1;
$num=10;
$from1=($page-1)*$num;


if($_GET['username']){

    $user=$db->exec("select userid from user where username='{$_GET['username']}' and admin='0' ");
        $uid=$user['userid'];
    }
    $key=0;

for ($i=strtotime($endtime);$i>=strtotime($begintime);$i=$i-24*3600){
    if($cache->has($i)) {
      $value = $cache->get($i);
    } else {
        $from = date('Y-m-d', $i) . ' 00:00:00';
        $to = date('Y-m-d', $i) . ' 23:59:59';
        if ($uid > 0) {
            $next_list = get_user_nextid2($uid);
//        $value = get_yingkui($uid, $from, $to, 0);
            $value = get_yingkui_new($uid, $from, $to, 0, 0 , $next_list);

        } else {

//        $value = get_yingkui(0, $from, $to, 1, 1);
            $value = get_yingkui_new(0, $from, $to, 1, 1, $next_list);
        }
        if($i < strtotime($endtime)) {
            $cache->set($i, $value, 0);
        }
    }


    foreach ($value as $k1=>$v1){
        if(!$sum1[$k1])$sum1[$k1]=0;
        $sum1[$k1]+=$v1;
    }
    if($key>=$from1 and $key<$from1+$num) {
      foreach ($value as $k1=>$v1){
          if(!$sum[$k1])$sum[$k1]=0;
          $sum[$k1]+=$v1;
      }
    ?>
    <tr>
        <td>

            <?php

            echo date('Y-m-d', $i);
            ?>

        </td>


        <td><?php echo $value['recharge']; ?></td>
        <td><?php echo $value['mention']; ?></td>
        <td><?php echo $value['buy']; ?></td>
        <td><?php echo $value['prize']; ?></td>
        <td><?php echo $value['active']; ?></td>
        <td><?php echo $value['rebate']; ?></td>
        <td><?php if($uid) echo $value['sum'];else echo -$value['sum']; ?></td>


    </tr>

    <?php
    }
    $key++;
  }
?>

       <tr>
        <td>
            本页小计
        </td>


        <td><?php echo $sum['recharge']; ?></td>
        <td><?php echo $sum['mention']; ?></td>
        <td><?php echo $sum['buy']; ?></td>
        <td><?php echo $sum['prize']; ?></td>
        <td><?php echo $sum['active']; ?></td>
        <td><?php echo $sum['rebate']; ?></td>
        <td><?php  echo -$sum['sum']; ?></td>


    </tr>
    <tr>
        <td>
            总计
        </td>


        <td><?php echo $sum1['recharge']; ?></td>
        <td><?php echo $sum1['mention']; ?></td>
        <td><?php echo $sum1['buy']; ?></td>
        <td><?php echo $sum1['prize']; ?></td>
        <td><?php echo $sum1['active']; ?></td>
        <td><?php echo $sum1['rebate']; ?></td>
        <td><?php  echo -$sum1['sum']; ?></td>


    </tr>


</tbody>
</table>

<div class="page">

    <?php
 $page=new Page1(10,$page,$key);
 echo $page->get_page();
    ?>

</div>