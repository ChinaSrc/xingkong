<?php
if($_POST){
if($_GET['type']=='sub_add'){

$sql="insert into game_fangan(uid,gamekey,money,title,content,info) values('{$_SESSION['userid']}','{$_POST['gamekey']}','{$_POST['money']}','{$_POST['title']}','{$_POST['content']}','{$_POST['info']}')";
$db->query($sql);
if($db->affected_rows()>0){

  //  echo $sql;

    echo "<script>parent.window.wxc.xcConfirm('我的方案添加成功',parent.window.wxc.xcConfirm.typeEnum.success);</script>";
    echo "<script>parent.ajax_fanganlist();parent.Dialog.close();</script>";

}
}


    if($_GET['type']=='sub_buy'){
        $lost_money=getsql::moneys($_SESSION['userid']);


        //print_r($_POST);
        $game=$db->exec("select * from game_type where ckey='{$_POST['gamekey']}'");
        if($game['status']==1){
            echo "<script>parent.window.wxc.xcConfirm('{$game['fullname']}已经关闭',parent.window.wxc.xcConfirm.typeEnum.warning);parent.Dialog.close();</script>";
            exit();
        }



    if($_POST['money']>$lost_money){
        echo "<script>parent.window.wxc.xcConfirm('余额不足',parent.window.wxc.xcConfirm.typeEnum.warning);parent.Dialog.close();</script>";
        exit();
    }
    else{
           $notin=0;	$wei='';
        $wanfa=unserialize($game['wanfa']);
        $arrs=explode("^",$_POST['info']);
        $gamekey=Trim($arrs[0]);
        $code=Trim($arrs[1]);
        $titles=Trim($arrs[2]);
        $playid=Trim($arrs[3]);
        $modes=Trim($arrs[4]);
        $nums=Trim($arrs[5]);

        $money=Trim($arrs[6]);
        $CurMode=Trim($arrs[7]);
        $CurModeType=Trim($arrs[8]);
        $times=Trim($arrs[9]);
        $per_money=$money/$times;
        $ids=Trim($arrs[11]);
        $lines=Trim($arrs[12]);
        $wei=Trim($arrs[13]);
        foreach ($wanfa as $key=>$value){
            foreach ($value as $value1){
                if($playid==$value1){
                    $player_item=$key;
              $notin=1;break;

                }
            }
        }
        if($notin==0){

            echo "<script>parent.window.wxc.xcConfirm('玩法【{$arrs[1]}{$arrs[2]}】已经关闭',parent.window.wxc.xcConfirm.typeEnum.warning);parent.Dialog.close();</script>";
            exit();
        }
        else{

            $endtime=strtotime(get_game_period_endtime($gamekey));
            $priod=get_game_period($gamekey);
            $Taskid=getsql::addGameBuy($gamekey,$playid,$priod,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,"no","yes","0","",$endtime,'',$player_item,$wei);
            $mark=get_game_mark($Taskid);
            $bankid=getsql::banklog($money,"hig_chase","",$mark,$Taskid,$gamekey,$modes);
            echo "<script>parent.window.wxc.xcConfirm('投注成功',parent.window.wxc.xcConfirm.typeEnum.success);</script>";
            echo "<script>parent.Dialog.close();parent.Ajax_get_buy();</script>";
        }

    }


    }



    exit();
}

if($_GET['type']=='add'){

    $game=$db->exec("select * from game_type where ckey='{$_GET['gamekey']}'");
    $tpl->assign('game',$game);
    $tpl->assign('info',$_GET['info']);
    $tpl->assign('info_arr',explode('^',$_GET['info']));

}

if($_GET['type']=='buy'){
    $fangan=$db->exec("select * from game_fangan where id='{$_GET['id']}'");
    $priod=get_game_period($fangan['gamekey']);
    $tpl->assign('period',$priod);
    $game=$db->exec("select * from game_type where ckey='{$fangan['gamekey']}'");
    $tpl->assign('game',$game);
    $tpl->assign('fangan',$fangan);
    $tpl->assign('info',$fangan['info']);
    $tpl->assign('info_arr',explode('^',$fangan['info']));

}

?>