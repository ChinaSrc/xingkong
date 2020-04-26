<?php

if(!defined('ALLOWGUEST')) {
exit('Access Denied');
}
require_once SZS_ROOT_PATH.'./source/config/play/games.php';
$game_arr=$con_game_arr;
$pagesize=$con_system['user_pagenum'];
$userid=$_SESSION["userid"];
$css_left_navi=array_keys($NaviList);
$foundmode =array_key_exists($mod,$css_szs_top);
if($foundmode){
$css_szs_top[$mod]="class='active'";
$foundnave_a =array_key_exists($mod,$NaviList);
if($foundnave_a){
$foundcode =array_key_exists($code,$NaviList[$mod]);
if($foundcode){$css_left_navi[$mod][$code]="class='active'";}
}
}else{
$css_szs_top["home"]="class='active'";
}
$nextdate=date('Y-m-d',strtotime("$d   +1   day"));
$thisdate=date("Y-m-d",time());
$lastdate=date('Y-m-d',strtotime("$d   -1   day"));
$bull_infor=getsql::bulletin();
$this_url=SZS_ROOT_URL."?mod=".$mod;
$do_url=SZS_ROOT_URL."do.aspx";
$do_this_url=SZS_ROOT_URL."do.aspx?mod=".$mod;
if($con_system['IsPriTop']=="yes"){
$PriTopArr=Core_Fun::rePriTop('1');
}else{
$PriTopArr="";
}
if($code){
$this_url=SZS_ROOT_URL."?mod=".$mod."&code=".$code;
$do_this_url=SZS_ROOT_URL."do.aspx?mod=".$mod."&code=".$code;
}
if($list){
$this_url=SZS_ROOT_URL."?mod=".$mod."&code=".$code."&list=".$list;
$do_this_url=SZS_ROOT_URL."do.aspx?mod=".$mod."&code=".$code."&list=".$list;
}
$hig_amount=((int)($_SESSION["hig_amount"]*100))/100;

$amount=get_user_amount($_SESSION["userid"]);
$userinfo=get_user_info($_SESSION["userid"]);
$tpl->assign("userinfo",$userinfo);
$tpl->assign("root_url",SZS_ROOT_URL);
$tpl->assign("root_path",SZS_ROOT_PATH);
$tpl->assign("this_url",$this_url);
$tpl->assign("ADMINPATH",ADMINPATH);
$tpl->assign("do_url",$do_url);
$tpl->assign("do_this_url",$do_this_url);
$tpl->assign("userid",$userid);
$tpl->assign("pagesize",$pagesize);
$tpl->assign("css_szs_top",$css_szs_top);
$tpl->assign("css_left_navi",$css_left_navi);
$tpl->assign("cur_userid",$_SESSION["userid"]);
$tpl->assign("cur_username",$_SESSION["user_name"]);
$tpl->assign("cur_nickname",$_SESSION["user_name"]);
$tpl->assign("cur_isproxy",$_SESSION["isproxy"]);
$tpl->assign("cur_amount",$amount['hig_amount']);
$tpl->assign("low_amount",$amount['low_amount']);
$tpl->assign("yk_amount",number_format($amount['yk_amount'],2));
$tpl->assign("ps_amount",number_format(get_ps_amount(),2));
$tpl->assign("bull_infor",$bull_infor);
$tpl->assign("PriTopArr",$PriTopArr);

?>