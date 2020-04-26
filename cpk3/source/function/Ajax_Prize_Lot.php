<?php
require_once('fun_Prize_Lot.php');
$this_date=date("Ymd",time());
$nowtime=date("Y-m-d H:i:s",time());
$from=date('Y-m-d H:i:s',time()-24*3600);
if(!$playkey) $playkey=set_kj_task();

$rand=rand(0,1);
if($rand==0)  $order='asc';
else $order='asc';

$limit=rand(100,200);
$endtime=time();

$str=" and endtime<'{$endtime}' ";
$open=true;
if($playkey and $period){



      $row=$db->exec("select * from game_lottery where playKey='{$playkey}' and period='{$period}' and LotTime<='{$nowtime}' and status='0' ");
      if($row) {

          $sql2="select id,period,`number`,list_id,wei from game_buylist where status='0' and is_succeed='yes'  and playkey='{$playkey}' and period='{$period}' order by rand() ";

      }
      else{

          $row=$db->exec("select * from game_lottery where playKey='{$playkey}' and period='{$period}' and LotTime<='{$nowtime}' and status='-1' ");
          if($row['id']>0){

               $db->query("update game_lottery set `status`='0' where id='{$row['id']}'")   ;
               if($db->affected_rows()>0){

                   prize_lot($playkey,$period) ;
               }
          }
        $open=false;

      }


}


else{

    $sql2="select id,period,`number`,list_id,wei from game_buylist where status='0' and is_succeed='yes' and creatdate>'{$from}' and playkey='{$playkey}' {$str} order by rand() limit 0,5000";

}
  //echo $sql2;
if($open==true){
    $result2=$db->query($sql2);
    $list_num=0;

    while($rows2=$db->fetch_array($result2)){


        $this_period=$rows2[period];
        $tt=$db->exec("select * from game_type where ckey='{$playkey}'");

        if(is_opentime($playkey, $this_period)==true    or $playkey=='MMSSC' or strpos($playkey,'KL8')!==false or   strpos($tt['kjkey'],'KL8')!==false){



            $sql8="select game_lottery.id,game_lottery.Number as lotnum from game_lottery  where period='$this_period' and playKey='$playkey'  and LotTime<='{$nowtime}'  and (status='0' or status='-1')  ";

            $result8=$db->query($sql8);
            $nums8=$db->num_rows($result8);

            if($nums8){

                $rows8=$db->fetch_array($result8);


                $buynum=$rows2[number];//投注内容

                $list_id=$rows2[list_id];//玩法

                $buy_id=$rows2[id];//投注编号

                $lotnum=$rows8[lotnum];//开奖号码


                $Z_flags=set_is_prize($rows2['id'],$lotnum);
                if($Z_flags [0] == 'is_yes'){
                    $strSql="update game_buylist set isprize='$Z_flags[0]',pri_number='$rows8[lotnum]',prizenum='$Z_flags[1]',pri_other='$Z_flags[2]',status='1' where id='$buy_id' and status='0'";
                    $db->query($strSql);
                }
                else{

                    $strSql="update game_buylist set isprize='is_no' ,status='1',pri_number='$rows8[lotnum]' where id='$buy_id' and status='0'";
                    $db->query($strSql);

                }

                set_rebate($buy_id);



            }

            $strSql="update game_buylist set isprize='is_no' ,status='1' where id='$buy_id' and status='0'";
            $db->query($strSql);
            $list_num+=1;
        }

    }


//验证是否已经完成派奖
    if($period) $string="  and period='{$period}'  ";
    else $string='';
    $list=$db->fetch_all("select * from game_lottery where playKey='{$playkey}' {$string} and LotTime<='{$nowtime}' and (status='0' or status='-1')  order by LotTime desc limit 0,10 ");
    if(count($list)>0){
        foreach ($list as $value){

            $result=$db->exec("select count(*) as num from game_buylist where status='0' and is_succeed='yes'  and playkey='{$playkey}' and period='{$value['period']}'");
            if($result['num']<1){
                $db->query("update game_lottery set `status`='1' where  id='{$value['id']}'")   ;
            }

        }
    }



}


?>