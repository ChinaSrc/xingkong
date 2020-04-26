<!DOCTYPE html>
<html lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"  />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <style type="text/css">
        body{font-size:14px; background-color: #46495d;color:#fff;}

        .list {
            overflow: hidden;
            padding: 4px 5px;
            clear: both;
            height:auto;
            position: relative;
            line-height: 30px;
            background: #636677;
            border-radius: 10px;
            width: calc(100% - 20px);
            margin: 8px auto;
            text-align: left;
        }
    </style>
</head>
<body>

<?php
$userid=$_SESSION["userid"];
$arrs   = array();


$fromdate=date('Y-m-d')." 00:00:00";


$arrs_sql = "select b.* from game_buylist as b,game_ssc_list as g where b.userid='$userid'  and b.list_id=g.skey and b.playkey='{$_GET['playkey']}'  and  z_number='' and b.creatdate>='{$fromdate}' order by b.creatdate desc  limit  0,100 ";
$arrs    = $db->fetch_all($arrs_sql);
if(count($arrs)>0){
    foreach ($arrs as $key=>$value){
        $game=$db->exec("select fullname from game_type where ckey='{$value['playkey']}'");
?>
<div class="list" onclick='location.href="home_user_gameinfo.html?mobile=1&from=parent&id=<?php echo $value['id'];?>";' >


            <div class="item" style="border-bottom:1px solid #d5d5d5;margin-bottom:5px;width:100%;">
                <span style="font-size:16px;">   <?php echo $game['fullname'];?></span>
                <span style="color:#d5d5d5;"> 第<?php echo $value['period'];?>期</span>
                <span style="float: right;color: #ff0000;"><?php echo $value['money'];?>元</span>


            </div>

            <div>
               <?php echo get_game_mark($value['id'],1);?>




                <span style="float:right;"><?php echo show_buystatus($value);?></span>
            </div>
            <div style="color:#d5d5d5;">
                <?php
                echo $value['creatdate']
                ?>

                <span style="float:right;color:#3388ff;"><?php if($value['is_zuih']!='no') echo "追号";?></span>
            </div>

        </div>


<?php

    }



}
else{
    ?>
    <div style="width: 100%;text-align: center">
        今日尚无投注记录

    </div>
    <?php
}

?>


</body>
</html>