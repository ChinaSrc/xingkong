<?php

if($_GET['type']=='delete'){
    $id=$_GET['id'];
    $db->query("delete from active  where id='{$id}'");
    add_adminlog("删除活动领取记录");
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
                <option value="" >全部</option>
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

            统计：
            <select name="issum" onchange="document.getElementById('form1').submit();" >
                <option value='0' <?php if($_GET['issum']==0) echo "selected";?>>否</option>
                <option value='1' <?php if($_GET['issum']==1) echo "selected";?>>是</option>
            </select>
          
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

            <?php
            if($_GET['type']=='day'){
                ?>

                <th>
                    昨日打码
                </th>

                <th>
                    反水比例
                </th>
                <?php
            }
            ?>



            <?php
            if($_GET['type']=='vip'){
                ?>

                <th>
                    晋级积分
                </th>
                <th>
                    领取前等级
                </th>

                <th>
                    领取后等级
                </th>
                <?php
            }
            ?>


            <th>
               时间
            </th>


            <th>
                状态
            </th>



        </tr>
        <?php

        $sql="select * from active where 1=1";
      
        if($_GET['begintime']) {
            $time=strtotime($_GET['begintime'].' 00:00:00');
            $sql.=" and time>='{$time}' ";
        }
      	else{
      		$time1=date("Y-m-d 00:00:00", strtotime("-1 month"));
          	$time=strtotime($time1);
        	$sql.=" and time>='{$time}' ";
        }
      
        if($_GET['endtime']) {
            $time=strtotime($_GET['endtime'].' 23:59:59');
            $sql.=" and time<='{$time}' ";
        }
      	else{
          $time1=date("Y-m-d 23:59:59", time());
          $time=strtotime($time1);
          $sql.=" and time<='{$time}' ";
        }
      
        if(strlen($_GET['type'])){
			$sql.=" and type='{$_GET['type']}'";
        }
      
        if($_GET['username']){
 			$sql.=" and userid in (select userid from user where username='{$_GET['username']}')";
        }
      
        if($_GET['uid']){
            $uids=get_user_nextid($_GET['uid']);
            $sql.=" and userid in ({$uids}) ";
        }
      
        if($_GET['isproxy']==1){
			$sql.=" and userid in (select userid from user where admin=0 and   `isproxy`='1' ) ";
        }
        if($_GET['isproxy']==-1){
			$sql.=" and userid in (select userid from user where admin=0 and   `isproxy`='0' ) ";
        }
      
        if($usertype==1){
			$sql.=" and userid in (select userid from user where admin=0 and   `virtual`='0' ) ";
        }
        if($usertype==2){
			$sql.=" and userid in (select userid from user where admin=0 and   `virtual`='1' ) ";
        }
      
        if($_GET['userid']){
			$sql.=" and userid='{$_GET['userid']}'";
        }

		if($_GET['issum']==1){
          $list1=$db->fetch_all($sql);
          $sum1=0;
          if(count($list1)>0){
              foreach ($list1 as $key1=>$value1){
                  $sum1+=$value1['charge'];
              }
          }
		} else{
		}      
        $sql.=" order by id desc";
        $page=new Page($sql,20,$_GET['page']);
        $sql.=" limit {$page->from},20";
        $list=$db->fetch_all($sql);
      
		if (count($list)>0){
			$sum=0;
        	foreach ($list as $row) {
			$sum+=$row['charge'];
            $user = get_user_info($row['userid']);
		?>


            <tr <?php if($user['virtual']==1)  echo "class='virtual'";?>>

                <td>
                    <?php echo $user['userid']; ?>
                </td>
                <td>
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <?php echo $row['charge']; ?>
                </td>


                <?php
                if ($_GET['type'] == 'day') {

                    ?>

                    <td>
                        <?php
                        echo number_show($row['buy']);
                        ?>
                    </td>

                    <td>
                        <?php
                        echo $row['pre'].'%';
                        ?>
                    </td>
                    <?php
                }
                ?>



                <?php
                if ($_GET['type'] == 'vip') {


                    $g1 = $db->exec("select * from user_group where id='{$row['gid1']}'");

                    $g2 = $db->exec("select * from user_group where id='{$row['gid2']}'");
                    ?>
                    <td>
                        <?php echo $row['score']; ?>
                    </td>

                    <td>
                        <?php
                        echo $g1['title'];
                        ?>
                    </td>

                    <td>
                        <?php
                        echo $g2['title'];
                        ?>
                    </td>
                    <?php
                }
                ?>


                <td>
                    <?php

                    echo date('Y-m-d H:i:s', $row['time']);
                    ?>
                </td>

                <td>

<span style="color: #ff0000">已领取</span>
                </td>


            </tr>

            <?php
        }

        ?>
<?php 
if($_GET['issum']==1){
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
                echo $sum1;
                ?>
            </td>
            <td colspan="5"></td>
        </tr>
<?php
	} 
?>
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