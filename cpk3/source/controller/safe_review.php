<?php

$nowtime=date("Y-m-d H:i:s",time());
$nowdate=date("Y-m-d",time());
$db_list      =" ".DB_PREFIX."user_bank_log as b,".DB_PREFIX."user as u";
$game_all	  = array();
$game_all_sql = "SELECT sum(b.moneys) as mones from $db_list where b.userid=u.userid and b.userid in(select userid from ".DB_PREFIX."user where user.userid='$perid') and b.creatdate like('$nowdate%') and b.cate in('hig_buy','hig_chase')";
$game_all	  = $db->fetch_first($game_all_sql);
$lot_money=$game_all[mones];
$game_back	  = array();
$game_back_sql = "SELECT sum(b.moneys) as mones from $db_list where b.userid=u.userid and b.userid in(select userid from ".DB_PREFIX."user where user.userid='$perid') and b.creatdate like('$nowdate%') and b.cate in('hig_buy_back','hig_chase_back','hig_buy_chase_back')";
$game_back	  = $db->fetch_first($game_back_sql);
$lot_money_back=$game_back[mones];
$game_pri	  = array();
$game_pri_sql = "SELECT sum(b.moneys) as mones from $db_list where b.userid=u.userid and b.userid in(select userid from ".DB_PREFIX."user where user.userid='$perid') and b.creatdate like('$nowdate%') and b.cate in('hig_prize')";
$game_pri	  = $db->fetch_first($game_pri_sql);
$pri_money=$game_pri[mones];
$game_npri	  = array();
$game_npri_sql = "SELECT sum(b.moneys) as mones from $db_list where b.userid=u.userid and b.userid in(select userid from ".DB_PREFIX."user where user.userid='$perid') and b.creatdate like('$nowdate%') and b.cate in('hig_prize_back')";
$game_npri	  = $db->fetch_first($game_npri_sql);
$pri_money_back=$game_pri[mones];
$max_lot_money=$lot_money-$lot_money_back;
$max_pri_money=$pri_money-$pri_money_back;
$tpl->assign("max_lot_money",$max_lot_money);
$tpl->assign("max_pri_money",$max_pri_money);

?>