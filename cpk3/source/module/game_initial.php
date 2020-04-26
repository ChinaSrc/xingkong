<?php

$active = isset($_GET['active']) ?$_GET['active'] : "time";
$play_path=SZS_ROOT_PATH."source/config/play/";
$filebody="";
if($active=="time"){
$game_list=getsql::game();
for ($i=0;$i<count($game_list);$i++){
$this_play=Trim($game_list[$i][ckey]);
$myfile =$play_path."lot_time_".$this_play.".aspx";
if($this_play){
$game_time=getsql::gametime($this_play);
$lot_arr='<?#$con_lot_arr=array(';
$begin_arr='$begin_arr=array(';
$end_arr='$end_arr=array(';
$time_arr='<?#$time_arr=array(';
$line="";
for ($j=0;$j<count($game_time);$j++){
$time_arr.="'".$game_time[$j][lotNum]."'=>array('begin'=>'".$game_time[$j][beginTime]."','end'=>'".$game_time[$j][endTime]."','lot'=>'".$game_time[$j][lotTime]."')";
if(count($game_time)-$j>1){$line=",#";}else{$line="#";}
$time_arr.=$line;
}
$time_arr.=");#?>";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"wb+");
$body=str_replace("#","\r\n",$time_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
}
}
if($active=="game"){
$game_list=getsql::game("all");
$lastkey="";
$game_arr='<?#$con_game_arr=array(';
$game_keys='#$con_game_list=array(';
$lines="#  ";
for ($i=0;$i<count($game_list);$i++){
$fullname=Trim($game_list[$i][fullname]);
$ckey=Trim($game_list[$i][ckey]);
$skey=Trim($game_list[$i][skey]);
$game_arr.=$lines."'".$i."'=>array('ckey'=>'".$ckey."','fullname'=>'".$fullname."','skey'=>'".$skey."')";
$game_keys.=$lines."'".$ckey."'=>'".$fullname."'";
if(count($game_list)-$i>1){$lines=",#  ";}else{$lines="#  ";}
}
$game_arr.="#);#";
$game_keys.="#);#?>";
$myfile =$play_path."games.aspx";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$dates=$game_arr.$game_keys;
$body=str_replace("#","\r\n",$dates);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
if($active=="code"){
$game_list=getsql::game("all");
for ($i=0;$i<count($game_list);$i++){
$this_play=$game_list[$i][ckey];
$myfile =$play_path."code_".$this_play.".aspx";
if($this_play){
$fists=explode("|",$game_list[$i][firstcode]);
$codes=explode("|",$game_list[$i][code]);
$play_arr='<?#$con_play_arr=array(';
$strs=str_replace("|","','",$game_list[$i][code]);
$play_arr.="'code'=>array('".$strs."'),";
$play_arr.="'firstcode'=>'".$fists[0]."',";
$play_arr.="'lot_date'=>'".$game_list[$i][lot_date]."',";
$play_arr.="'lot_num'=>'".$game_list[$i][lot_num]."');";
$title_arr='#$con_title_arr=array(';
$lines="#  ";
$tile_list   = array();
$tile_list_sql = "select fullname,ckey,mode from ".DB_PREFIX."game_code where ckey in('$strs') order by id";
$tile_list     = $db->getall($tile_list_sql);
for ($j=0;$j<count($tile_list);$j++){
$fullname=$tile_list[$j][fullname];
$ckey=$tile_list[$j][ckey];
$mode=$tile_list[$j][mode];
$title_arr.=$lines."'".$ckey."'=>array('fullname'=>'".$fullname."','mode'=>'".$mode."')";
if(count($tile_list)-$j>1){$lines=",#  ";}else{$lines="#  ";}
}
$title_arr.="#);#";
$pri_arr='#$con_play_pri=array(';
$tim_arr='#$con_play_time=array(';
$pri    = array();
$pri_sql = "select s.* from ".DB_PREFIX."game_set as s where s.playKey='$this_play'";
$pri    = $db->getall($pri_sql);
$pri_lise="#";
for ($j=0;$j<count($pri);$j++){
$pri_arr.=$pri_lise."  '".$pri[$j][ckey]."'=>array('".$pri[$j][Prize_1700]."','".$pri[$j][Prize_1800]."','".$pri[$j][Prize_1900]."')";
$tim_arr.=$pri_lise."  '".$pri[$j][ckey]."'=>array('".$pri[$j][Times_1700]."','".$pri[$j][Times_1800]."','".$pri[$j][Times_1900]."')";
$pri_lise=",#";
}
$pri_arr.='#);#';
$tim_arr.='#);#';
$code_list   = array();
$code_list_sql = "select CodeKey,ListKey,ShowTile,CodeTile,Rebate from ".DB_PREFIX."game_code_list where CodeKey in('$strs') order by CodeKey,OrderS,CodeTile";
$code_list     = $db->getall($code_list_sql);
$code_arr='#$con_code_arr=array(';
$lines="#";
for ($j=0;$j<count($code_list);$j++){
$CodeKey=Trim($code_list[$j][CodeKey]);
$ListKey=Trim($code_list[$j][ListKey]);
$CodeTile=Trim($code_list[$j][CodeTile]);
$ShowTile=Trim($code_list[$j][ShowTile]);
$Rebates=Trim($code_list[$j][Rebate]);
if($last_code==$CodeKey){
$code_arr.=",#      '".$ListKey."'=>array('ListKey'=>'".$ListKey."','CodeTile'=>'".$CodeTile."','ShowTile'=>'".$ShowTile."','Rebates'=>'".$Rebates."')";
}else{
$code_arr.=$lines."  '".$CodeKey."'=>array(#      '".$ListKey."'=>array('ListKey'=>'".$ListKey."','CodeTile'=>'".$CodeTile."','ShowTile'=>'".$ShowTile."','Rebates'=>'".$Rebates."')";
$lines="#  ),#";
}
$last_code=$CodeKey;
}
$code_arr.="#  )#);";
$end_arr="#?>";
$body_arr=$play_arr.$title_arr.$code_arr.$pri_arr.$tim_arr.$end_arr;
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$body=str_replace("#","\r\n",$body_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
}
}
if($active=="codelist"){
$ssc    = array();
$ssc_sql = "select l.* from ".DB_PREFIX."game_ssc_list as l where l.status='0'";
$ssc    = $db->getall($ssc_sql);
$game_arr='<?#$con_play_list=array(';
$lines="#   ";
for ($i=0;$i<count($ssc);$i++){
$game_arr.=$lines."'".$ssc[$i][skey]."'=>array('fullname'=>'".$ssc[$i][fullname]."','ckey'=>'".$ssc[$i][ckey]."','code'=>'".$ssc[$i][code]."','cate'=>'".$ssc[$i][cate]."','content'=>'".$ssc[$i][content]."','example'=>'".$ssc[$i][example]."','help'=>'".$ssc[$i][help]."','title'=>'".$ssc[$i][title]."','shownum'=>'".$ssc[$i][shownum]."','minnum'=>'".$ssc[$i][minnum]."','maxnum'=>'".$ssc[$i][maxnum]."','show_key'=>'".$ssc[$i][show_key]."','show_other'=>'".$ssc[$i][show_other]."','max_select'=>'".$ssc[$i][max_select]."','min_select'=>'".$ssc[$i][min_select]."','is_yes'=>'".$ssc[$i][is_yes]."')";
if(count($ssc)-$i>1){$lines=",#   ";}else{$lines="#   ";}
}
$game_arr.="#);#?>";
$myfile =$play_path."codelist.aspx";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$body=str_replace("#","\r\n",$game_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
if($active=="system"){
$sys    = array();
$sys_sql = "select s.* from ".DB_PREFIX."system as s limit 1";
$sys    = $db->fetch_first($sys_sql);
$sys_arr='<?#$con_system=array(';
$lines="#   ";
foreach ($sys as $key =>$value){
$sys_arr.=$lines."'".$key."'=>'".$value."'";$lines=",#   ";
}
$sys_arr.="#);#?>";
$myfile =$play_path."system.aspx";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$body=str_replace("#","\r\n",$sys_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
$db->close();
exit;

?>