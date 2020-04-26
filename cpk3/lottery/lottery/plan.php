<?php


if($_GET['type']=='save'){
$playkey=$_GET['gamekey'];
    $period=$_GET['period'];
    $number=$_GET['number'];
    $number=str_replace('，',',',$number);
    $number=str_replace('，',',',$number);
    $game=$db->exec("select * from game_type where ckey='{$playkey}' ");
    if (! $db->exec ( "select id from game_lottery where playKey='{$playkey}' and period='$period'" )) {

        lottory_insert ( $playkey, $period, $number);
     $db->query ( "update game_lottery  set `admin`='{$_SESSION['admin_name']}' where playKey='{$playkey}' and period='$period'" );

        //print_r($db->exec("select * from game_lottery where playKey='{$playkey}' and period='$period'"));
        add_adminlog("预设{$game['fullname']}-第{$period}期开奖号码：{$number}");
    }
    else{
        $row=$db->exec ( "select * from game_lottery where playKey='{$playkey}' and period='$period'" );

        if(strtotime($row['LotTime'])>time() ){
            $db->query ( "update game_lottery  set `Number`='{$number}',`admin`='{$_SESSION['admin_name']}' where playKey='{$playkey}' and period='$period'" );
            add_adminlog("修改预设{$game['fullname']}-第{$period}期开奖号码：{$number}");

        }

    }

}

$game_list=$db->fetch_all("select * from game_type where self='1' and status='0' order by `sort` asc");

if($_GET['gamekey']) $gamekey=$_GET['gamekey'];else $gamekey=$game_list[0]['ckey'];

$game=$db->exec("select * from game_type where ckey='{$gamekey}' ");


include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

;
?>
 <form name="form" id="form1" method="get" action="" >
 <div   class="search_box">
<input type="hidden" name="controller" value="<?php echo $_GET['controller']?>">
     <input type="hidden" name="action" value="<?php echo $_GET['action']?>">
彩种:
            <select name="gamekey" onchange="document.getElementById('form1').submit();" >
              <option value="">所有彩种</option>
                          <?php
                          foreach ($game_list as $value){
                              ?>
                              <option value="<?php echo $value['ckey']?>"  <?php if($game['ckey']==$value['ckey']) echo "selected"?>><?php echo $value['fullname']?></option>

                              <?php
                          }

                          ?>
                      </select>

     <a href="?controller=lottery&action=GameLot&gamekey=<?php echo $game['ckey']; ?>&yushe=1">查看开奖历史</a>

 </div>
 </form>




<table>
    <tr>
     
          <th  align="center" >彩种</th>
          <th align="center" >期号</th>  
  
          <th  align="center" >开奖号码</th> 
                  <th  align="center" >预计开奖时间</th>
        <th  align="center" >操作人</th>
        <th  align="center" >操作</th>
       </tr>

    <?php
    $nowtt=date('H:i:s');

    $sql="select * from game_time where playKey='{$gamekey}' and lotTime>'{$nowtt}' order by lotTime  asc limit 0,20";
     $list=$db->fetch_all($sql);
    if(count($list)>0){
        foreach ($list as $value){
            $classname='';
            $period=date('Ymd',time()).$value['lotNum'];
            if ($lootery=$db->exec ( "select * from game_lottery where playKey='{$gamekey}' and period='$period'" )) {
               $number=$lootery['Number'];
               $classname='virtual';
            }
            else $number=set_code($gamekey);
            ?>

            <tr class="<?php echo $classname;?>">

                <td  align="center" >

                    <?php
                    echo $game['fullname'];
                    ?>

                </td>
                <td align="center" >
                    <?php

                    echo $period;
                    ?>

                </td>
                <td  align="center" >
                <?php 
                  $numberdata = explode(',', $number);
                  foreach ($numberdata as $k => $v) {
                    
          
                ?>
                  <select id="number<?php echo $k ?>_<?php echo $period?>">
                    <option <?php if($v==1) echo "selected = 'selected'"  ?>>1</option>
                    <option <?php if($v==2) echo "selected = 'selected'"  ?>>2</option>
                    <option <?php if($v==3) echo "selected = 'selected'"  ?>>3</option>
                    <option <?php if($v==4) echo "selected = 'selected'"  ?>>4</option>
                    <option <?php if($v==5) echo "selected = 'selected'"  ?>>5</option>
                    <option <?php if($v==6) echo "selected = 'selected'"  ?>>6</option>


                  </select>


                  <?php } ?>
<!-- <input type="text" id="number_<?php echo $period?>" value="<?php echo $number?>"> -->

                </td>
                <td  align="center" >



                    <?php

                    echo date('Y-m-d',time()).' '.$value['lotTime'];
                    ?>

                </td>
                <td  align="center" >

                    <?php
                    echo $lootery['admin'];
                    ?>

                </td>
                <td  align="center" >

                    <input type="button" value="保存"   onclick="click_save('<?php echo $gamekey;?>','<?php echo $period;?>')">

                </td>
            </tr>


            <?php
        }


    }
    else{
        ?>

        <tr>
            <td colspan="5">

                今日开奖已完结了


            </td>

        </tr>
        <?php
    }
    ?>



  </table> 

    </div>

<script>
    function click_save(gamekey,period) {
        if(confirm('确定要保存吗? ')){
          var number =[];
 number[0]=document.getElementById('number0_'+period).value
 number[1]=document.getElementById('number1_'+period).value
 number[2]=document.getElementById('number2_'+period).value
number.sort();
var numbers = number[0]+','+number[1]+','+number[2];
            location.href='?controller=lottery&action=plan&type=save&gamekey='+gamekey+'&period='+period+'&number='+numbers;
        }

    }
    
    
</script>


<?php
include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>