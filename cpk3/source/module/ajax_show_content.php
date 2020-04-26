<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/29
 * Time: 20:06
 */

$active=trim($_GET['active']);

if($active=='user_url'){

    $url=$db->exec("select * from user_url where id='{$_GET['id']}'");
    $rebates=unserialize($url['rebate']);
    $user=get_user_info($url['userid']);
    $user_reabate=unserialize($user['rebates']);

?>
    <link href='<?php echo FILE_URI ?>/template/default/style/main.css' rel="stylesheet" type="text/css" />
    <link href='<?php echo FILE_URI ?>/template/default/2017/css/mycenter.css' rel="stylesheet" type="text/css" />
<style>
    ul {
        list-style: none;
    }

    li, ul {
        margin: 0;
        padding: 0;
    }

</style>

    <div class="rebateList" style="width: 400px;margin: 10px auto;padding: 0px;border-width: 0px;">
        <?php

        foreach ($rebates as $key=>$value){
        ?>
        <ul class="InviteReb"><li style="width: 80px;"><?php echo $arr_game_code[$key]; ?></li>
            <li  ><input type="text" name="<?php echo $key;?>" value="<?php echo $value;?>" disabled="disabled" class="userInput mgl20">&nbsp;
                <span style="color: #999;font-size: 12px;" >（自身返点：<?php echo $user_reabate[$key]; ?>）</span></li>
        </ul>

          <?php } ?>
            </div>
<?php




}
if($active=='user_url_mark'){
    ?>
    <link href='<?php echo FILE_URI ?>/template/default/style/main.css' rel="stylesheet" type="text/css" />
    <style>
      .layui-layer-content{
            position: relative;
            padding: 40px 20px;
            line-height: 24px;
            word-break: break-all;
            overflow: hidden;
            font-size: 14px;
            overflow-x: hidden;
            overflow-y: auto;
            text-align: center
        }

        .layui-layer-prompt .layui-layer-input{
            display: block;
            width: 220px;
            height: 30px;
            margin: 0 auto;
            line-height: 30px;
            padding: 0 5px;
            border: 1px solid #ccc;
            box-shadow: inset 1px 1px 5px rgba(0,0,0,.1);
            color: #333
        }

        .layui-layer-btn{

            pointer-events: auto;
            text-align: center
        }

        .layui-layer-btn a,.layui-layer-btn input {
            height: 30px;
            min-width: 85px;
            padding: 0 15px;
            background-color: #f1f1f1;
            color: #333;
            border-radius: 3px;
            margin: .5em .4em .5em 0;
            font-weight: 400;
            line-height: 29px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            text-decoration: none
        }

        .layui-layer-btn .layui-layer-btn0 {
            color: #fff;
            border: none;
            background: #3e5779
        }

        .layui-layer-btn a,.layui-layer-dialog .layui-layer-ico.layui-layer-setwin a {
            display: inline-block;
            vertical-align: top
        }


    </style>

    <?php


if($_POST['mark']){

   $db->query("update user_url set mark='{$_POST['mark']}' where id='{$_GET['id']}'");
   echo '    <div  id="" class="layui-layer-content">设置成功</div>';
   ?>

    <script>

        setTimeout(function () {
            parent.location.reload();
            parent.Dialog.close();

        },1000)

    </script>
    <?php
exit();
}


    $url=$db->exec("select * from user_url where id='{$_GET['id']}'");
    ?>
    <form action="" method="post">
    <div  id="" class="layui-layer-content"><input  type="text" value="<?php echo $url['mark']?>" name="mark" class="layui-layer-input"></div>
    <div  class="layui-layer-btn"><input type="submit" value="确定" class="layui-layer-btn0">
        <a  class="layui-layer-btn1" onclick="<?php if($_GET['admin']==1) echo "parent.pop.close();";?>parent.Dialog.close();">取消</a></div>

    </form>
<?php
}

if($active=='user_url_money'){
    ?>
    <link href='<?php echo FILE_URI ?>/template/default/style/main.css' rel="stylesheet" type="text/css" />
    <style>
        .layui-layer-content{
            position: relative;
            padding: 40px 20px;
            line-height: 24px;
            word-break: break-all;
            overflow: hidden;
            font-size: 14px;
            overflow-x: hidden;
            overflow-y: auto;
            text-align: center
        }

        .layui-layer-prompt .layui-layer-input{
            display: block;
            width: 220px;
            height: 30px;
            margin: 0 auto;
            line-height: 30px;
            padding: 0 5px;
            border: 1px solid #ccc;
            box-shadow: inset 1px 1px 5px rgba(0,0,0,.1);
            color: #333
        }

        .layui-layer-btn{

            pointer-events: auto;
            text-align: center
        }

        .layui-layer-btn a,.layui-layer-btn input {
            height: 30px;
            min-width: 85px;
            padding: 0 15px;
            background-color: #f1f1f1;
            color: #333;
            border-radius: 3px;
            margin: .5em .4em .5em 0;
            font-weight: 400;
            line-height: 29px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            text-decoration: none
        }

        .layui-layer-btn .layui-layer-btn0 {
            color: #fff;
            border: none;
            background: #3e5779
        }

        .layui-layer-btn a,.layui-layer-dialog .layui-layer-ico.layui-layer-setwin a {
            display: inline-block;
            vertical-align: top
        }


    </style>

    <?php


    if($_POST['money']){

        $db->query("update user_url set money='{$_POST['money']}' where id='{$_GET['id']}'");
        echo '    <div  id="" class="layui-layer-content">设置成功</div>';
        ?>

        <script>

            setTimeout(function () {
                parent.location.reload();
                parent.Dialog.close();

            },1000)

        </script>
        <?php
        exit();
    }


    $url=$db->exec("select * from user_url where id='{$_GET['id']}'");
    ?>
    <form action="" method="post">
        <div  id="" class="layui-layer-content"><input  type="text" value="<?php echo $url['money']?>" name="money" class="layui-layer-input">元</div>
        <div  class="layui-layer-btn"><input type="submit" value="确定" class="layui-layer-btn0">
            <a  class="layui-layer-btn1" onclick="<?php if($_GET['admin']==1) echo "parent.pop.close();";?>parent.Dialog.close();">取消</a></div>

    </form>
    <?php
}
if($active=='user_rebates'){

    $user=$db->exec("select * from user where userid='{$_GET['id']}'");
    $rebates=unserialize($user['rebates']);
  	if($user['higherid'])$pids=get_user_pid($user['userid']);
  $str='';
  for($i=count($pids)-1;$i>=0;$i--){

    if($str=='')
      $str=$pids[$i]['username'];
    else  
      $str.="&gt;".$pids[$i]['username'];
    

	// var_dump($str);
  }
  if($user['higherid']){
    $parent=   get_user_info($user['higherid']);
    $parent_rebates=unserialize($parent['rebates']);
  }
    foreach ($arr_game_code as $key=>$value){

    if($user['higherid']){
      $maxrebate=$parent_rebates[$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];

    }
    else{

      $maxrebate=$con_system['rebates_'.$key];
      $minrebate=$maxrebate-$con_system['rebate_cha'];
    }
    if($minrebate<0) $minrebate=0;

  }
// var_dump($minrebate);var_dump($maxrebate);

    ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
      *{ margin:0 ;padding: 0; }
       table
        {
            border-collapse: collapse;
            border: none;
            width: 100%;
          font-size: 13px;
        }
        td
        {
            border: solid #ccc 1px;
          padding: 10px;
        }
      
      td span { color: #666; }
      
      input {
        height: 30px;
    line-height: 30px;
    padding: 0px 10px;
    font-family: "Tahoma", "宋体";
    font-size: 14px;
    border-radius: 4px;
    border: 1px solid #ccc;
      }

    </style>
  </head>
<body>
    <div class="rebateList" style="width: 100%;margin: 0 auto;padding: 0px;border-width: 0px;">
        <?php

        foreach ($rebates as $key=>$value){

            if($arr_game_code[$key]){


            ?>
      <table>
        <tr>
          <td width="80">返点比例</td>
          <td>
            <?php echo $arr_game_code[$key]; ?>：
            <input value="<?php echo $value;?>" readonly style="width: 50px;" />
            <span>(范围 <?php echo $minrebate?> - <?php echo $maxrebate ?>)</span></td>
        </tr>
<!--
        <tr>
          <td>上级代理</td>
          <td>
            <input value="<?php echo $pids[1]['username'];?>" readonly style="width: 70px;" />
            <span>(推荐关系: <?php echo $str ?>)</span>
          </td>
        </tr>
-->
      </table>

        <?php }} ?>
    </div>
  </body>
</html>
    <?php




}


if($active=='show_playuserlist'){
    $playkey=$_GET['playkey'];
    $mobile=$_GET['mobile'];
    $num=$_GET['num'];
    if($playkey) $str=" and   playkey='{$playkey}'";
    else $str="";
  $list=  $db->fetch_all("select * from game_buylist where is_succeed='yes' {$str} and pri_money>0 order by id desc  limit 0 ,{$num}");

if(count($list)>0){
    foreach ($list as  $value){
           $user=get_user_info($value['userid']);
           $group=$db->exec("select * from user_group where id='{$user['groupid']}'");
           $game=$db->exec("select * from game_type where ckey='{$value['playkey']}'")
  ?>

        <li  <?php if($mobile==1){ ?> onclick="location.href='index_player.html?id=<?php echo $value['userid'];?>';" <?php } ?> >
            <img  src="<?php echo getFileUri(avatar($value['userid']))?>" class="avatar"/>
            <p ><?php if($user['nickname']) echo  GBsub_str($user['nickname'],0,2).'*****'.GBsub_str($user['nickname'],strlen($user['nickname'])-1,1);else echo GBsub_str($user['username'],0,2).'*****'.GBsub_str($user['username'],strlen($user['username'])-1,1);?> <?php echo $game['fullname']?><br  />喜中<span >&yen;<?php echo $value['pri_money']?></span></p>

                         <?php
                         if($mobile!=1) echo show_user_info($value['userid']);
                         ?>


        </li>

<?php


    }

}
else{
    echo "<div style='height:40px;line-height:40px;text-align:center;'>该彩种暂无玩家中奖</div>";

}

}
if($active=='yestoday_buy'){
    $playkey=$_GET['playkey'];

    if($playkey) $num=10;
    else $num=3;
    if($_GET['num']) $num=$_GET['num'];
     $begin=date('Y-m-d',time()-24*3600).' 00:00:00';
    $end=date('Y-m-d',time()).' 00:00:00';
    $list=  $db->fetch_all("SELECT userid , sum(pri_money) as sum1 FROM game_buylist where  creatdate>='{$begin}' and creatdate<'{$end}'  group by userid order by sum1 desc  limit 0 ,{$num}");

    if(count($list)>0) {
        $num=0;
        ?>
        <?php
        if($playkey!=''){
         ?>
            <div class="firsttitle">
                昨日累计奖金排行榜
            </div>

            <?php
        }
        ?>


        <?php
        foreach ($list as $value) {
            if ($value['sum1'] > 0) {
                $num++;
                $user = get_user_info($value['userid']);
                $group = $db->exec("select * from user_group where id='{$user['groupid']}'");
                ?>

                <li <?php if ($mobile == 1) { ?> onclick="location.href='index_player.html?id=<?php echo $value['userid']; ?>';" <?php } ?> >
                    <div class="info1"><img src="<?php echo getFileUri(avatar($value['userid'])) ?>" class="avatar"/>
                        <p>
                            账号昵称：<?php if ($user['nickname']) echo GBsub_str($user['nickname'],0,2).'*****'.GBsub_str($user['nickname'],strlen($user['nickname'])-1,1); else echo GBsub_str($user['username'],0,2) . '*****' . GBsub_str($user['username'], strlen($user['username']) - 1, 1); ?>
                            <br/> 昨日奖金：<i>&yen;<?php echo number_format($value['sum1']); ?></i></p>
                    </div>
                    <div class="info2">
                        <ins <?php if ($num == 1) echo "style='background:#f44';";
                        if ($num == 2) echo "style='background:#eca233';";
                        if ($num == 3) echo "style='background:#38f';"; ?>>
                            <?php
                            echo $num;
                            ?>
                        </ins>
                    </div>

                    <?php
                    if ($mobile != 1) echo show_user_info($value['userid']);
                    ?>


                    </div>
                </li>
                <?php
            }
        }
    }
    else{

       ?>
        <li class="firsttitle">
           昨日无人投注
        </li>
<?php

    }

}
?>
