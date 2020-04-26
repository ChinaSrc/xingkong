<?php

if(!defined('IN_PHPOE')) {
exit('Access Denied');
}
class Arr_File{
protected static $config = array();
protected static $obj    = NULL;
protected static $var	 = NUll;
public static function GetPath($item){
$lastPath=substr(dirname(__FILE__),0,-8);
if($item=="play"){$play_path=$lastPath."config/play/";}
return $play_path;
}
public static function ArrGameTime() {
$play_path=self::GetPath("play");

$game_list=getsql::game();
for ($i=0;$i<count($game_list);$i++){
$this_play=Trim($game_list[$i][ckey]);
$myfile =$play_path."lot_time_".$this_play.".php";
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
public static function ArrGames(){
$play_path=self::GetPath("play");
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
$myfile =$play_path."games.php";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$dates=$game_arr.$game_keys;
$body=str_replace("#","\r\n",$dates);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
public static function ArrCodes(){
self::$obj = $GLOBALS['db'];
$play_path=self::GetPath("play");
$game_list=getsql::game("all");
for ($i=0;$i<count($game_list);$i++){
$this_play=$game_list[$i][ckey];
$myfile =$play_path."code_".$this_play.".php";
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
$tile_list     = self::$obj->getall($tile_list_sql);
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
$pri    = self::$obj->getall($pri_sql);
$pri_lise="#";
for ($j=0;$j<count($pri);$j++){
$pri_arr.=$pri_lise."  '".$pri[$j][ckey]."'=>array('".$pri[$j][Prize_1700]."','".$pri[$j][Prize_1800]."','".$pri[$j][Prize_1900]."','".$pri[$j][prize]."')";
$tim_arr.=$pri_lise."  '".$pri[$j][ckey]."'=>array('".$pri[$j][Times_1700]."','".$pri[$j][Times_1800]."','".$pri[$j][Times_1900]."')";
$pri_lise=",#";
}
$pri_arr.='#);#';
$tim_arr.='#);#';
$code_list   = array();
$code_list_sql = "select CodeKey,ListKey,ShowTile,CodeTile,Rebate,MaxNote from ".DB_PREFIX."game_code_list where CodeKey in('$strs') order by CodeKey,OrderS,CodeTile";
$code_list     = self::$obj->getall($code_list_sql);
$code_arr='#$con_code_arr=array(';
$lines="#";
for ($j=0;$j<count($code_list);$j++){
$CodeKey=Trim($code_list[$j][CodeKey]);
$ListKey=Trim($code_list[$j][ListKey]);
$CodeTile=Trim($code_list[$j][CodeTile]);
$ShowTile=Trim($code_list[$j][ShowTile]);
$Rebates=Trim($code_list[$j][Rebate]);
$MaxNote=Trim($code_list[$j][MaxNote]);
if($last_code==$CodeKey){
$code_arr.=",#      '".$ListKey."'=>array('ListKey'=>'".$ListKey."','CodeTile'=>'".$CodeTile."','ShowTile'=>'".$ShowTile."','Rebates'=>'".$Rebates."','MaxNote'=>'".$MaxNote."')";
}else{
$code_arr.=$lines."  '".$CodeKey."'=>array(#      '".$ListKey."'=>array('ListKey'=>'".$ListKey."','CodeTile'=>'".$CodeTile."','ShowTile'=>'".$ShowTile."','Rebates'=>'".$Rebates."','MaxNote'=>'".$MaxNote."')";
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
public static function ArrCodeList(){
self::$obj = $GLOBALS['db'];
$play_path=self::GetPath("play");
$ssc    = array();
$ssc_sql = "select l.* from ".DB_PREFIX."game_ssc_list as l where l.status='0'";
$ssc    = self::$obj->getall($ssc_sql);
$game_arr='<?#$con_play_list=array(';
$lines="#   ";
for ($i=0;$i<count($ssc);$i++){
$game_arr.=$lines."'".$ssc[$i][skey]."'=>array('fullname'=>'".$ssc[$i][fullname]."','ckey'=>'".$ssc[$i][ckey]."','code'=>'".$ssc[$i][code]."','cate'=>'".$ssc[$i][cate]."','content'=>'".$ssc[$i][content]."','example'=>'".$ssc[$i][example]."','help'=>'".$ssc[$i][help]."','title'=>'".$ssc[$i][title]."','shownum'=>'".$ssc[$i][shownum]."','minnum'=>'".$ssc[$i][minnum]."','maxnum'=>'".$ssc[$i][maxnum]."','show_key'=>'".$ssc[$i][show_key]."','show_other'=>'".$ssc[$i][show_other]."','max_select'=>'".$ssc[$i][max_select]."','min_select'=>'".$ssc[$i][min_select]."','is_yes'=>'".$ssc[$i][is_yes]."')";
if(count($ssc)-$i>1){$lines=",#   ";}else{$lines="#   ";}
}
$game_arr.="#);#?>";
$myfile =$play_path."codelist.php";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$body=str_replace("#","\r\n",$game_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
public static function ArrSystems(){
$play_path=self::GetPath("play");
self::$obj = $GLOBALS['db'];
$sys    = array();
$sys_sql = "select s.* from ".DB_PREFIX."system as s limit 1";
$sys    = self::$obj->fetch_first($sys_sql);
$sys_arr='<?#$con_system=array(';
$lines="#   ";

if(count($sys)>0 and !empty($sys)){
    foreach ($sys as $key =>$value){
        $sys_arr.=$lines."'".$key."'=>'".$value."'";$lines=",#   ";
    }

}

$sys_arr.="#);#?>";
$myfile =$play_path."system.php";
if (file_exists($myfile) &&$overwrite != true){unlink($myfile);}
$file_pointer = fopen($myfile,"a+");
$body=str_replace("#","\r\n",$sys_arr);
fwrite($file_pointer,$body);
fclose($file_pointer);
}
public static function sendmail($username,$uqqnum,$config,$finalStr,$item){
require_once dirname(__FILE__).'\smtp.php';
$siteurl=explode(" ",$config['siteurl']);
##########################################
$smtpserver = $config['smtpserver'];
$smtpserverport =25;
$smtpusermail = $config['smtpmail'];
$smtpemailto = $uqqnum."@qq.com";
$smtpuser = $config['smtpuser'];
$smtppass = $config['smtppass'];
$mailsubject = '您在['.$config['sitename'].']取回密码的邮件';
$mailbody ="<div style='font-size:12px;width:100%;height:50px;'>您使用了[".$config['sitename']."]密码找回的功能，您的登陆密码与资金密码已初使化为：".$finalStr."，请及时登陆平台更改密码.-----[<a href='http://".$siteurl[0]."' target='_blank'>".$config['sitename']."|".$siteurl[0]."]</div>";
$mailtype = "HTML";
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
$smtp->debug = flase;
$smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);
##########################################
return "yes";
}

public static function sendmail1($smtpemailto,$mailsubject,$mailbody,$config){
require_once dirname(__FILE__).'\smtp.php';
$siteurl=explode(" ",$config['siteurl']);
##########################################
$smtpserver = $config['smtpserver'];
$smtpserverport =25;
$smtpusermail = $config['smtpmail'];
$smtpuser = $config['smtpuser'];
$smtppass = $config['smtppass'];
$mailtype = "HTML";
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
$smtp->debug = flase;
$smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);
##########################################
return $smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);
}


}

?>