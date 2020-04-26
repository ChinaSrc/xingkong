

<style>
    .newTab{padding-left:10px;clear: both;margin-top: 15px;}
    .newTab a{font-size:14px;background:#f8f8f8;border:1px solid #cecece;margin:0 5px;
        padding:0 15px;border-radius:4px 4px 0 0;line-height:28px;display:inline-block;margin-bottom:-1px;position:relative}
    .newTab a em{background:red;color:#fff;display:block;padding:0 5px;border-radius:2px 2px 2px 2px;
        line-height:18px;top:-14px;right:-5px;position:absolute;font-size:8px}
    .newTab .curr{border-bottom:1px solid #fff;background:#fff;color:#e4393c}
    .home_rec{
        margin-bottom:2px;

        border: 1px solid #ddd;
        background: #fff;
        clear: both;
    }

    .home_rec{

        width: calc(100% - 22px);
        padding: 10px;


    }
    .teamContent .plMore{
        table-layout: fixed;

    }

    .teamContent .plMore em{
        color: #4aa9db
    }
    .plMore {
        display: table;
        width:calc(100% - 40px);
        text-align: center;
        padding: 20px 0;
        margin: 15px;
        border: 1px solid #d5d5d5;
        border-radius: 6px;
    }
    .plMore li {
        display: table-cell;line-height: 25px;
    }

    .plMore li+li {
        border-left: 1px dotted #d9d8d8
    }

    .plMore em {
        font-size: 18px;font-style: normal;
    }

    .plMore span {
        display: block
    }

    .userTip {
        clear: both;
        border: 1px solid #f8e2b9;
        background: #fffdeb;
        color: #f46e00;
        padding: 5px 10px;
        line-height: 24px;
    }

</style>












<?php


$uid=$_GET['userid'];
if(!$_GET['username']){

    $uid=$_SESSION['userid'];
}
else{


    $user=$db->exec("select userid from user where username='{$_GET['username']}'");
    $uid=$user['userid'];



}


$user_list=$db->fetch_all("select * from user where userid='{$uid}' or higherid='{$uid}' order by userid asc");
if($_GET['begintime']){
    $begintime=$_GET['begintime'] ;
}
else $begintime=date('Y-m-d').' 00:00:00';
if($_GET['endtime']){
    $endtime=$_GET['endtime'];
}
else $endtime=date('Y-m-d',time()+24*3600).' 23:59:59';


$yingkui=get_yingkui($uid, $begintime, $endtime,1);
$yingkui1=get_yingkui($uid, $begintime, $endtime);
$user=$db->exec("select * from user where userid='{$uid}'");

$team=get_team_info($uid);

$begin=$begintime;
$end=$endtime;

$time_arr[0]=array('begin'=>date('Y-m-d').' 00:00:00','end'=>date('Y-m-d',time()).' 23:59:59');
$time_arr[1]=array('begin'=>date('Y-m-d',time()-24*3600).' 00:00:00','end'=>date('Y-m-d',time()-24*3600).' 23:59:59');
$time_arr[2]=array('begin'=>date('Y-m-d',time()-6*24*3600).' 00:00:00','end'=>date('Y-m-d',time()).' 23:59:59');
$time_arr[3]=array('begin'=>date('Y-m').'-01 00:00:00','end'=>date('Y-m-d',time()).' 23:59:59');

$next_list=get_user_nextid($uid);
$row=$db->exec("select count(*) as num from user where higherid in ($next_list) and registertime >= '{$begin}'  and registertime<='{$end}' ");
$reg_num=$row['num'];

$row=$db->fetch_all("select DISTINCT userid from user_funds where creatdate >= '{$begin}'  and creatdate<='{$end}' and cate='recharge' and  userid in ($next_list) ");
$frist_recharge=count($row);
$row1 = $db->fetch_all ( "select DISTINCT  userid from game_buylist where creatdate>'{$begin}' and creatdate<='{$end}'  and is_succeed='yes'   and (status='1' or status='2' or status='3') and userid in ({$next_list}) " );
$buy_num=count($row1);

?>
<div class="newTab">


    <a class="<?php if ($begin==$time_arr[0]['begin']) echo 'router-link-exact-active curr';?>" id="num_0"   onclick="set_data(0);"  >今日</a>

    <a class="<?php if ($begin==$time_arr[1]['begin']) echo 'router-link-exact-active curr';?>" id="num_1"   onclick="set_data(1);"  >昨日</a>
    <a class="<?php if ($begin==$time_arr[2]['begin']) echo 'router-link-exact-active curr';?>" id="num_2"   onclick="set_data(2);" >本周</a>
    <a class="<?php if ($begin==$time_arr[3]['begin']) echo 'router-link-exact-active curr';?>" id="num_3"   onclick="set_data(3);" >本月</a>
</div>




<div class="home_rec">
    <form id="frm_search" name="frm_search"  method="get" action="" style="padding-left: 15px;">

<input type="hidden" name="controller" value="<?php echo  $_GET['controller']?>">
        <input type="hidden" name="action" value="<?php echo  $_GET['action']?>">

        <span style ='display: none'>
                                日期：<input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" style="width:150px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:150px;"/>
     </span>

        <input type="hidden" name="username" value="<?php echo $_GET['username']?>" placeholder="请输入下级代理账号">

    </form>








    <div  class="teamContent">
        <ul  class="plMore">
            <li ><em ><?php echo $yingkui['buy'];?></em><span >投注金额</span></li>
            <li ><em ><?php echo $yingkui['prize'];?></em><span >中奖金额</span></li>
            <li ><em ><?php echo $yingkui['active'];?></em><span >活动礼金</span></li>
            <li ><em ><?php echo $yingkui['rebate'];?></em><span >团队返佣</span></li>
            <li ><em ><?php echo $yingkui['sum'];?></em><span >团队盈亏</span></li>
        </ul>
        <ul  class="plMore">
            <li ><em ><?php echo $buy_num;?>人</em><span >投注人数</span></li>
            <li ><em ><?php echo $frist_recharge;?>人</em><span >首充人数</span></li>
            <li ><em ><?php echo $reg_num;?>人</em><span >注册人数</span></li>
            <li ><em ><?php echo $team['num'];?>人</em><span >下级人数</span></li>
            <li ><em ><?php echo $team['money'];?></em><span >团队余额</span></li>
        </ul>
        <ul  class="plMore">
            <li ><em ><?php echo $yingkui['recharge'];?></em><span >充值金额</span></li>
            <li ><em ><?php echo $yingkui['mention'];?></em><span >提现金额</span></li>
            <li ><em ><?php echo $yingkui1['sum'];?></em><span >自身盈亏</span></li>
            <li ></li>
            <li ></li>
        </ul>
        <div  class="userTip" style="margin-top: 20px;">
            <p >温馨提示：以上是代理的团队数据（即他的所有下级的数据汇总） </p>
        </div>
    </div>

<script>
    function set_data(num){
        for(var i=0;i<=3;i++){
            if(i==num){

                document.getElementById('num_'+i).className='router-link-exact-active curr';

            }
            else{

                document.getElementById('num_'+i).className='';
            }


        }
        if(num==0){var begin='<?php echo $time_arr[0]['begin'];?>';var end='<?php echo $time_arr[0]['end'];?>';}
        if(num==1){var begin='<?php echo $time_arr[1]['begin'];?>';var end='<?php echo $time_arr[1]['end'];?>';}
        if(num==2){var begin='<?php echo $time_arr[2]['begin'];?>';var end='<?php echo $time_arr[2]['end'];?>';}
        if(num==3){var begin='<?php echo $time_arr[3]['begin'];?>';var end='<?php echo $time_arr[3]['end'];?>';}
        document.getElementById('begintime').value=begin;
        document.getElementById('endtime').value=end;
        document.getElementById('frm_search').submit();
    }



</script>