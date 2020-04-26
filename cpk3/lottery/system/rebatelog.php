<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from user_fandian_log  where id='{$id}'");
    add_adminlog("删除返点记录");
    echo "删除成功";
    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}


include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

if($_GET['usertype']) $usertype=$_GET['usertype'];
else $usertype=1;

?>

    <div class="search_box1" style="line-height: 40px;">
        <form action="" method="get" id="form1">
            <input type="hidden" name='controller' value="<?php echo $_GET['controller'];?>">
            <input type="hidden" name='action' value="<?php echo $_GET['action'];?>">
            <input type="hidden" name='type' value="<?php echo $_GET['type'];?>">
            超级代理：
            <select name="uid" onchange="document.getElementById('form1').submit();" >

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

            类型：
            <select name="isproxy" onchange="document.getElementById('form1').submit();" >
                <option value=""  >全部</option>
                <option value='1' <?php if($_GET['isproxy']==1) echo "selected";?>>玩家</option>
                <option value='-1' <?php if($_GET['isproxy']==-1) echo "selected";?>>代理</option>
            </select>

            内部：
            <select name="usertype" onchange="document.getElementById('form1').submit();" >
                <option value='-1' <?php if($usertype=='-1') echo "selected" ?> >-全部-</option>
                <option value='1' <?php if($usertype=='1') echo "selected" ?> >正式账号</option>
                <option value='2' <?php if($usertype=='2') echo "selected" ?> >内部账号</option>
            </select>

            UID：<input type="text" name="userid" value="<?php echo $_GET['userid']?>">

            账号：<input type="text" name="username" value="<?php echo $_GET['username']?>">

            <br> 时间:<input type="text" name="begintime"  value="<?php echo $_GET['begintime'];?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
            &nbsp;至

            <input type="text" name="endtime"  value="<?php echo $_GET['endtime'];?>"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

            <input type="submit" class="button" value="搜索">
        </form>


    </div>


    <table width="100%" border="0" cellpadding="4" cellspacing="1" class="list_tbl">
        <tr>

            <th>
                UID
            </th>
            <th>
                会员名称
            </th>
            <th>
                金额(元)
            </th>

            <th>
                下级用户
            </th>
            <th>
                下注金额
            </th>




            <th>
                时间
            </th>





        </tr>
        <?php

//        $sql="select *, sum(money) as money from user_fandian_log where 1=1";
        $sql="";

      
      
      	$lastUids = $uid1 = $uid2 = $uid3 = $uid4 = $uid5 =[];
      	$haveSerch = false;
        if ($_GET['username']) {
          	$userinfo = get_user_info_by_username($_GET['username']);
            $uid1 = isset($userinfo['userid']) ? [$userinfo['userid']] : [];
          	$lastUids = $uid1;
          	$haveSerch = true;
        }

        if($_GET['uid']){
            $uid2 = explode(',', get_user_nextid($_GET['uid']));//
            $sql.=" and uid!='{$_GET['uid']}'";
          	if ($lastUids) {
            	$lastUids = array_intersect($lastUids, $uid2);
            } else {
            	$lastUids = $uid2;
            }
          	$haveSerch = true;
        }

        if($_GET['isproxy']==1) {
         	$tmp = getUserIdForProxy(1);//
            $uid3 = array_column($tmp, 'userid');
          	if ($lastUids) {
            	$lastUids = array_intersect($lastUids, $uid3);
            } else {
            	$lastUids = $uid3;
            }
          	$haveSerch = true;
        }

        if($_GET['isproxy']==-1) {
            $tmp = getUserIdForProxy(0);//
            $uid4 = array_column($tmp, 'userid');
          	if ($lastUids) {
            	$lastUids = array_intersect($lastUids, $uid4);
            } else {
            	$lastUids = $uid4;
            }
          	$haveSerch = true;
        }

        if($_GET['userid']) {
            $uid5 = [$_GET['userid']];
          	if ($lastUids) {
            	$lastUids = array_intersect($lastUids, $uid5);
            } else {
            	$lastUids = $uid5;
            }
          	$haveSerch = true;
        }
      	if ($haveSerch) {
        	if ($lastUids) {
        		$sql.=" and uid in (" . implode(',', $lastUids) . ") ";
        	} else {
            	$sql.=" and uid = null ";
            }
        }
      	
      
		


        
        //if($usertype==1)  $sql.=" and uid in (select userid from user where admin=0 and   `virtual`='0' ) ";
        //if($usertype==2)  $sql.=" and uid in (select userid from user where admin=0 and   `virtual`='1' ) ";
        if($usertype==1)  $sql.=" and   `virtual`='0' ";
        if($usertype==2)  $sql.=" and   `virtual`='1' ";
        
        if($_GET['begintime']) {
            $time=strtotime($_GET['begintime'].' 00:00:00');
            $sql.=" and time>='{$time}' ";
        }
        if($_GET['endtime']) {
            $time=strtotime($_GET['endtime'].' 23:59:59');
            $sql.=" and time<='{$time}' ";
        }


        $sum1=0;

        // 1. 计算总额
      //var_dump("select sum(money) as money, count(*) as total from user_fandian_log where 1=1 " . $sql);
        $sumSql = "select sum(money) as money, count(*) as total from user_fandian_log where 1=1 " . $sql;
      //$sumSql = "select sum(money) as money, count(*) as total from user_fandian_log where 1=1 ";
        $list1=$db->fetch_first($sumSql);
        $sum1 = $list1['money'];
        $total = $list1['total'];

//        if(count($list1)>0){
//            foreach ($list1 as $key1=>$value1){
//
//                $sum1+=$value1['money'];
//
//            }
//
//
//        }

        $sql ="select * from user_fandian_log where 1=1 " . $sql .  " order by id desc";
      //var_dump($sql);
     	//$sql ="select * from user_fandian_log where 1=1 order by id desc";
        $page=new Page($sql,20,$_GET['page'], 3, $total);

        $sql.=" limit {$page->from},20";
        $list=$db->fetch_all($sql);
        if (count($list)>0){
        $sum=0;
        foreach ($list as $row) {
            $sum+=$row['money'];
            $user = get_user_info($row['uid']);
            $formuser = get_user_info($row['fromid']);
            $game=$db->exec("select * from game_buylist where id='{$row['buyid']}'");
            ?>


            <tr <?php if($user['virtual']==1)  echo "class='virtual'";?>>

                <td>
                    <?php echo $row['uid']; ?>
                </td>
                <td>
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <?php echo number_show($row['money'],3); ?>
                </td>

                <td>
                    <?php echo $formuser['username']; ?>
                </td>


                <td>
                    <?php echo number_show($game['money'],3); ?>
                </td>
                <td>
                    <?php

                    echo date('Y-m-d H:i:s', $row['time']);
                    ?>
                </td>




            </tr>

            <?php
        }

        ?>
        <tr>
            <td>本页小计</td>
            <td></td>
            <td>
                <?php
                echo $sum;
                ?>
            </td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td>总计</td>
            <td></td>
            <td>
                <?php
                echo number_show($sum1,3);
                ?>
            </td>
            <td colspan="5"></td>
        </tr>

    </table>

    <div class="page">


        <?php
        echo $page->get_page();
        ?>
    </div>

    <?php
}else{

    ?>

    </table>

    <div class="page">

        没有找到对应的数据
    </div>


    <?php


}
?>
    <script>

<?php

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>