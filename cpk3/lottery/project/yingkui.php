<?php
if(!$_GET['st']) $_GET['st']=2;
if($_GET['st']==1) $fw=0;
else $fw=1;
if($_GET['begintime']){


	$begintime=$_GET['begintime']." ".$search_time_arr['begin'] ;
}
else $begintime=date('Y-m-d',time())." ".$search_time_arr['begin'];
if($_GET['endtime']){
$endtime=$_GET['endtime']." ".$search_time_arr['end'];
}
else $endtime=date('Y-m-d H:i:s',time()+24*3600);

if($_GET['username']){


if($_GET['st']==3)
    $search.=" ( higherid in (select userid from user where username='{$_GET['username']}') or username='{$_GET['username']}' ) and admin='0' ";
 else
$search.=" username='{$_GET['username']}' and admin='0'";



}else{

$search.="  admin='0'";
}

if($_GET['uid']&&$_GET['uid']!='全部'){
    $uids=get_user_nextid($_GET['uid']);
    $search.=" and userid in ({$uids}) ";

}

$sql="select * from user where {$search} order by higherid asc,userid asc ";
$page=new Page($sql,20,$_GET['page']);
$sql.=" limit {$page->from},20";

$user_list=$db->fetch_all($sql);



foreach ($user_list as $key=> $value) {
    $amount=get_user_amount($value['userid']);
    $nextList = get_user_nextid2($value['userid']);
     $yingkui=get_yingkui_new($value['userid'], $begintime, $endtime,$fw,0, $nextList);
     if(count($yingkui)){

        foreach ($yingkui as $k=>$v) {
            $user_list[$key][$k]=number_format($v,3,'.','');
                  $sum[$k]+= $v;
        }

     }
     if($_GET['st']!=1){

//          $team=get_team_info($value['userid']);
          $team=get_team_info2($nextList);
         $user_list[$key]['team_num']=$team['num'];
     }

      $yingkui1=get_yingkui_new($value['userid'], $begintime, $endtime, '', 0 ,$nextList);
   $user_list[$key]['sum1']=number_format($yingkui1['sum'],3,'.','');
}



if($_GET['orderby']){

	$order=explode(" ", $_GET['orderby']);
	if($order[1]=='asc') $sort='SORT_ASC';
	else $sort='SORT_DESC';

$user_list=sysSortArray($user_list,$order[0],$sort);
}


$begin=substr($begintime, 0,10);
$end=substr($endtime, 0,10);
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;

?>



                       <form action="" method="get" target="_self" id="form1">
                       <input name="controller" id="controller" type="text" value="project" style='display:none'>
          <input name="action" id="action" type="text" value="yingkui" style='display:none'>
                           <input type="hidden"  name="from" value="<?php echo $_GET['from']?>">

                        <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0"
                            cellpadding="0" class="my_tbl">
                            <tr>
                                <td align='left'>
                                    超级代理：
                                    <select name="uid" onchange="document.getElementById('form1').submit();" >

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

                                                      账号：
                                    <?php

                                    if($_GET['st']==1 or !$_GET['username']){
                                        ?>
                                        <input type="hidden"  name="st" value="<?php echo $_GET['st']?>">
                                        <?php
                                    }else{

                                        ?>
                                        <select name="st">
                                            <option value="2" <?php if($_GET['st']==2) echo 'selected';?>>团队</option>
                                            <option value="3" <?php if($_GET['st']==3) echo 'selected';?>>下级</option>
                                        </select>
                                        <?php
                                    }
                                    ?>

<input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<?php echo $_GET['username']?>" size="20" />


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

                        <th>账号</th>


                        <?php

                        if($_GET['st']!=1){
                         ?>
                            <th>团队人数</th>
                            <th>团队盈亏


                            </th>

                        <?php
                        }
                        ?>


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

            <th>自身盈亏


            </th>

                    </tr>

                    <?php foreach ($user_list as $key=>$value) {


                    ?>

                    <tr <?php if($value['virtual']==1)  echo "class='virtual'";?>>

                        <td>
<?php echo $value['username'];?>
                </td>


                        <?php

                        if($_GET['st']!=1){
                            ?>
                            <td>
                                <a href='?controller=project&action=yingkui&st=3&username=<?php echo $value['username'];?>&begintime=<?php echo $begin?>&endtime=<?php echo $end;?>'>
                                <?php echo $value['team_num']; ?>
                                </a>
                            </td>
                            <td><?php echo $value['sum']; ?></td>

                            <?php
                        }
                        ?>

                        <td><?php echo $value['recharge']; ?></td>
                        <td><?php echo $value['mention']; ?></td>
                      <td><?php echo $value['buy']; ?></td>
                           <td><?php echo $value['prize']; ?></td>
                        <td><?php echo $value['active']; ?></td>
                          <td><?php echo $value['rebate']; ?></td>
                        <td><?php echo $value['sum1']; ?></td>
                    </tr>


                    <?php }?>

</table>
<div class="page">
    <?php

    echo $page->get_page();
    ?>

</div>