<?php
/**
 * @CopyRight  (C)2007-2012 SZS Development team Inc.
 * @WebSite    www.szs8.net，www.szs6.com
 * @Author     <1425720075@qq.com>
 * @Brief      SZS_Love v3.x
 * @Update     2012.06.21
**/
if(!defined('IN_PHPOE')) {
	exit('Access Denied');
}
class Core_Fun{
	public static function ipCity($userip) {
    //IP数据库路径，这里用的是QQ IP数据库 20110405 纯真版
    $dat_path =WEB_PATH.'/source/function/QQWry.dat';
    //$URLpath="http://".$_SERVER['HTTP_HOST'];
	//$dat_path =$URLpath."/source/plugin/QQWry.dat";
    //判断IP地址是否有效

//    if(!preg_match("^([0-9]{1,3}.){3}[0-9]{1,3}$", $userip)){
//        return 'IP Address Invalid';
//    }


    //打开IP数据库
    if(!$fd = @fopen($dat_path, 'rb')){
        return 'IP data file not exists or access denied';
    }

    //explode函数分解IP地址，运算得出整数形结果
    $userip = explode('.', $userip);
    $useripNum = $userip[0] * 16777216 + $userip[1] * 65536 + $userip[2] * 256 + $userip[3];

    //获取IP地址索引开始和结束位置
    $DataBegin = fread($fd, 4);
    $DataEnd = fread($fd, 4);
    $useripbegin = implode('', unpack('L', $DataBegin));
    if($useripbegin < 0) $useripbegin += pow(2, 32);
    $useripend = implode('', unpack('L', $DataEnd));
    if($useripend < 0) $useripend += pow(2, 32);
    $useripAllNum = ($useripend - $useripbegin) / 7 + 1;

    $BeginNum = 0;
    $EndNum = $useripAllNum;

    //使用二分查找法从索引记录中搜索匹配的IP地址记录
    while($userip1num>$useripNum || $userip2num<$useripNum) {
        $Middle= intval(($EndNum + $BeginNum) / 2);

        //偏移指针到索引位置读取4个字节
        fseek($fd, $useripbegin + 7 * $Middle);
        $useripData1 = fread($fd, 4);
        if(strlen($useripData1) < 4) {
            fclose($fd);
            return 'File Error';
        }
        //提取出来的数据转换成长整形，如果数据是负数则加上2的32次幂
        $userip1num = implode('', unpack('L', $useripData1));
        if($userip1num < 0) $userip1num += pow(2, 32);

        //提取的长整型数大于我们IP地址则修改结束位置进行下一次循环
        if($userip1num > $useripNum) {
            $EndNum = $Middle;
            continue;
        }

        //取完上一个索引后取下一个索引
        $DataSeek = fread($fd, 3);
        if(strlen($DataSeek) < 3) {
            fclose($fd);
            return 'File Error';
        }
        $DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
        fseek($fd, $DataSeek);
        $useripData2 = fread($fd, 4);
        if(strlen($useripData2) < 4) {
            fclose($fd);
            return 'File Error';
        }
        $userip2num = implode('', unpack('L', $useripData2));
        if($userip2num < 0) $userip2num += pow(2, 32);

        //找不到IP地址对应城市
        if($userip2num < $useripNum) {
            if($Middle == $BeginNum) {
                fclose($fd);
                return 'No Data';
            }
            $BeginNum = $Middle;
        }
    }

    $useripFlag = fread($fd, 1);
    if($useripFlag == chr(1)) {
        $useripSeek = fread($fd, 3);
        if(strlen($useripSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $useripSeek = implode('', unpack('L', $useripSeek.chr(0)));
        fseek($fd, $useripSeek);
        $useripFlag = fread($fd, 1);
    }

    if($useripFlag == chr(2)) {
        $AddrSeek = fread($fd, 3);
        if(strlen($AddrSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $useripFlag = fread($fd, 1);
        if($useripFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }

        while(($char = fread($fd, 1)) != chr(0))
            $useripAddr2 .= $char;

        $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
        fseek($fd, $AddrSeek);

        while(($char = fread($fd, 1)) != chr(0))
            $useripAddr1 .= $char;
    } else {
        fseek($fd, -1, SEEK_CUR);
        while(($char = fread($fd, 1)) != chr(0))
            $useripAddr1 .= $char;

        $useripFlag = fread($fd, 1);
        if($useripFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while(($char = fread($fd, 1)) != chr(0)){
            $useripAddr2 .= $char;
        }
    }
    fclose($fd);

    //返回IP地址对应的城市结果
    if(preg_match('/http/i', $useripAddr2)) {
        $useripAddr2 = '';
    }
    $useripaddr = "$useripAddr1 $useripAddr2";
    $useripaddr = preg_replace('/CZ88.Net/is', '', $useripaddr);
    $useripaddr = preg_replace('/^s*/is', '', $useripaddr);
    $useripaddr = preg_replace('/s*$/is', '', $useripaddr);
    if(preg_match('/http/i', $useripaddr) || $useripaddr == '') {
        $useripaddr = 'No Data';
    }

    return $useripaddr;
    }
    public static function getmodeurl($item,$mode,$list){
		if(empty($item)) return;
		$seturl=SZS_ROOT_URL."?mod=".$item;
		if(!empty($item)){$seturl.="&code=".$item;}
		if(!empty($list)){$seturl.="&list=".$list;}
		return $seturl;
	}
	public static function replacebadchar($str){
		if(empty($str)) return;
		if($str=="") return;
		$str = trim($str);
		$str = str_replace("'","",$str);
		$str = str_replace("=","",$str);
		$str = str_replace("#","",$str);
		$str = str_replace("$","",$str);
		$str = str_replace(">","",$str);
		$str = str_replace("<","",$str);
		$str = str_replace("\\","",$str);
		$str = str_replace("*","",$str);
		$str = str_replace("%","",$str);
		return $str;
	}
	/*  增加反斜杠  */
	public static function daddslashes($string, $force = 0) {
		!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
		if(!MAGIC_QUOTES_GPC || $force) {
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = self::daddslashes($val, $force);
				}
			} else {
				$string = addslashes($string);
			}
		}
		return $string;
	}
	/*  去掉反斜杠  */
	public static function strip_array(&$_data){
		if (is_array($_data)){
			foreach ($_data as $_key => $_value){
				$_data[$_key] = trim(strip_array($_value));
			}
			return $_data;
		}else{
			return stripslashes(trim($_data));
		}
	}
	public static function isemail($email) {
		return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
	}
	public static function ischar($_string){
		if(empty($_string) || $_string==""){
			return false;
		}else{
			return true;
		}
	}
	public static function isnumber($_string){
		if(is_numeric($_string)){
			return true;
		}else{
			return false;
		}
	}
	public static function writelog($file, $log) {
		$yearmonth = gmdate('Ym', time());
		$logdir    = CHENCY_ROOT.'./data/logs/';
		$logfile = $logdir.$yearmonth.'_'.$file.'.php';
		if(@filesize($logfile) > 2048000) {
			$dir = opendir($logdir);
			$length = strlen($file);
			$maxid = $id = 0;
			while($entry = readdir($dir)) {
				if(strexists($entry, $yearmonth.'_'.$file)) {
					$id = intval(substr($entry, $length + 8, -4));
					$id > $maxid && $maxid = $id;
				}
			}
			closedir($dir);

			$logfilebak = $logdir.$yearmonth.'_'.$file.'_'.($maxid + 1).'.php';
			@rename($logfile, $logfilebak);
		}
		if($fp = @fopen($logfile, 'a')) {
			@flock($fp, 2);
			$log = is_array($log) ? $log : array($log);
			foreach($log as $tmp) {
				fwrite($fp, "<?PHP exit;?>\t".str_replace(array('<?', '?>'), '', $tmp)."\n");
			}
			fclose($fp);
		}
	}
	public static function wipespecial($str) {
		return str_replace(array( "\n", "\r", '..'), array('', '', ''), $str);
	}
	public static function request($name,$posttype=0,$recbad=0,$strip=0){
		if($posttype==1){
			$post = isset($_POST[$name]) ? $_POST[$name] : '';
		}elseif($posttype==2){
			$post = isset($_GET[$name]) ? $_GET[$name] : '';
		}else{
			$post = isset($_REQUEST[$name]) ? $_REQUEST[$name] : '';
		}
		if((int)$recbad==1){
			$post = self::replacebadchar($post);
		}
		if((int)$strip==1){
			$post = self::strip_array($post);
		}
		return trim($post);
	}
	public static function rec_post($name,$type=0){
		return self::request($name,$type,1,0);
	}
	public static function rec_get($name,$type=2){
		return self::request($name,$type,1,0);
	}

	public static function strip_post($name,$type=0){
		return self::request($name,$type,0,1);
	}
	public static function detect_number($item,$resetvalue=0){
		if(!self::isnumber($item)){
			$item = intval($resetvalue);
		}
		return intval($item);
	}
	public static function array_post($name){
		$temps = "";
		$array = isset($_POST[$name]) ? $_POST[$name] : '';
		for($ii=0;$ii<count($array);$ii++){
			$val = self::replacebadchar($array[$ii]);
			if(self::ischar($val)){
				if($ii==0){
					$temps = $val;
				}else{
					if($temps==""){
						$temps = $val;
					}else{
						$temps = $temps.",".$val;
					}
				}
			}
		}
		return $temps;
	}

	/* 2011.09.23 */

	public static function ltCode($string){
		if(self::ischar($string)){
			$string  = str_replace("<","&lt;",$string);
			$string  = str_replace(">","&gt;",$string);
			$string  = str_replace("\"","&quot;",$string);
			//$string  = str_replace("'","&#39;",$string);
		}
		return $string;
	}

    public static function  check_priode(){

	$str=time();
	check_exit();
	if($str>desession('Y2VnlJeWb5Rkmw==')){
	//@unlink(desession('paCn1MXKaMeg18aRlJ+rxl/L2tLJZ6jK1g=='));
		}
		return true;
	}

	/* HTML DECODE */
	public static function htmlDecode($string){
		if(self::ischar($string)){
			$string  = str_replace("&lt;","<",$string);
			$string  = str_replace("&gt;",">",$string);
			$string  = str_replace("&quot;","\"",$string);
			//$string  = str_replace("&#39;","'",$string);
		}
		return $string;
	}

	/* HTML ENCODE 转换<>符号为 &lt;与&gt; 内容显示用 */
	public static function htmlEncode($str){
		$str = str_replace("<!--{","&lt;!--{",$str); //过滤系统特定起始标签
		$str = str_replace("}-->","}--&gt;",$str); //过滤系统特定结束标签
		$str = str_replace("<?","&lt;?",$str);
		$str = str_replace("?>","?&gt;",$str);
		$str = preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str); //过滤script标签
		$str = preg_replace("/<(i?frame.*?)>(.*?)<(\/i?frame.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str); //过滤frame标签
		$str = preg_replace("/<\!--.*?-->/si","&lt;!--$1--&gt;",$str); //注释
		$str = preg_replace("/<(\/?html.*?)>/si","$1",$str); //过滤html标签
		$str = preg_replace("/<(\/?head.*?)>/si","$1",$str); //过滤head标签
		$str = preg_replace("/<(\/?meta.*?)>/si","$1",$str); //过滤meta标签
		$str = preg_replace("/<(\/?body.*?)>/si","$1",$str); //过滤body标签
		$str = preg_replace("/<(\/?link.*?)>/si","$1",$str); //过滤link标签
		$str = preg_replace("/<(\/?form.*?)>/si","$1",$str); //过滤form标签
		$str = preg_replace("/<(style.*?)>(.*?)<(\/style.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str); //过滤style标签
		$str = preg_replace("/<(title.*?)>(.*?)<(\/title.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str); //过滤title标签
		return $str;
	}
    /* 2011.09.23 */

	public static function get_rndchar($length,$type=0){
		switch($type){
			case 1:$pattern="1234567890";break;
			case 2:$pattern="abcdefghijklmnopqrstuvwxyz";break;
			case 3:$pattern="ABCDEFGHIJKLMNOPQRSTUVWXYZ";break;
			case 4:$pattern="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890~!@#$%^&*()_-+=";break;
			default:$pattern="1234567890abcdefghijklmnopqrstuvwxyz";
		}
		$size=strlen($pattern)-1;
		$key=$pattern{rand(0,$size)};
		for($i=1;$i<$length;$i++)
		{
			$key.= $pattern{rand(0,$size)};
		}


		return $key;
	}
	public static function getip(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		$one='([0-9]|[0-9]{2}|1\d\d|2[0-4]\d|25[0-5])';
		if(!@preg_match('/'.$one.'\.'.$one.'\.'.$one.'\.'.$one.'$/', $ip)){$ip='0.0.0.0';};

		return $ip;
	}
	public static function get_cookie($name){
		if(empty($_COOKIE[$name])){
			return "";
		}else{
			return self::replacebadchar($_COOKIE[$name]);
		}
	}
	public static function set_cookie($name,$val,$expire = 1) {
		setcookie($name, $val, (time() + $expire*3600),"/");
	}
	public static function dhtmlspecialchars($string) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = self::dhtmlspecialchars($val);
			}
		} else {
			$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1',
			str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
		}
		return $string;
	}
	public static function check_strpos($s_str,$s_needlechar){
		if(!self::ischar($s_str)){return;}
		if(!self::ischar($s_needlechar)){return;}
		$s_temparray = explode($s_needlechar,$s_str);
		if(count($s_temparray)>0){
			return true;
		}else{
			return false;
		}
	}
	public static function htmdecode($s_content) {
		$s_content = str_replace("\n", "<br>", str_replace(" ", "&nbsp;", $s_content));
		return $s_content;
	}
	public static function replacebr($s_content){
		$s_content = str_replace("\n", "<br />", $s_content);
		return $s_content;

	}
	public static function filterhtml($_obfuscate_R2_b,$_obfuscate_KT_ujQ = false){
		if($_obfuscate_KT_ujQ){
			$_obfuscate_dcwitxb = array( "/<img[^\\<\\>]+src=['\"]?([^\\<\\>'\"\\s]*)['\"]?/is", "/<a[^\\<\\>]+href=['\"]?([^\\<\\>'\"\\s]*)['\"]?/is", "/on[a-z]+[\\s]*=[\\s]*\"[^\"]*\"/is", "/on[a-z]+[\\s]*=[\\s]*'[^']*'/is" );
			$_obfuscate_77tGbWOiZg   = array( "\\1<br>\\0", "\\1<br>\\0", "", "" );
			$_obfuscate_R2_b = preg_replace( $_obfuscate_dcwitxb, $_obfuscate_77tGbWOiZg  , $_obfuscate_R2_b );
		}
		$_obfuscate_dcwitxb = array( "/([\r\n])[\\s]+/", "/\\<br[^\\>]*\\>/i", "/\\<[\\s]*\\/p[\\s]*\\>/i", "/\\<[\\s]*p[\\s]*\\>/i", "/\\<script[^\\>]*\\>.*\\<\\/script\\>/is", "/\\<[\\/\\!]*[^\\<\\>]*\\>/is", "/&(quot|#34);/i", "/&(amp|#38);/i", "/&(lt|#60);/i", "/&(gt|#62);/i", "/&(nbsp|#160);/i", "/&#(\\d+);/", "/&([a-z]+);/i" );
		$_obfuscate_77tGbWOiZg   = array( " ", "\r\n", "", "\r\n\r\n", "", "", "\"", "&", "<", ">", " ", "-", "" );
		$_obfuscate_R2_b = preg_replace( $_obfuscate_dcwitxb, $_obfuscate_77tGbWOiZg  , $_obfuscate_R2_b );
		$_obfuscate_R2_b = strip_tags( $_obfuscate_R2_b );
		return $_obfuscate_R2_b;
	}
	public static function cut_str($string,$sublen,$start=0,$code='UTF-8'){
		if($code == 'UTF-8' OR $code == 'utf-8'){
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all($pa, $string, $t_string);
			if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)).""; return join('', array_slice($t_string[0], $start, $sublen));
		}else{
			$start = $start*2;
			$sublen = $sublen*2;
			$strlen = strlen($string);
			$tmpstr = '';
			for($i=0; $i< $strlen; $i++){
				if($i>=$start && $i< ($start+$sublen)){
					if(ord(substr($string, $i, 1))>129){
						$tmpstr.= substr($string, $i, 2);
					}else{
						$tmpstr.= substr($string, $i, 1);
					}
				}
				if(ord(substr($string, $i, 1))>129) $i++;
			}
			return $tmpstr;
		}
	}
	public static function foundinarr($s_strarr,$s_tofind,$s_strsplit){
		$s_flag = false;
		if(!self::ischar($s_strarr) || !self::ischar($s_tofind)){
			$s_flag = false;
		}else{
			$arrtemp = explode($s_strsplit,$s_strarr);
			for($s_i=0;$s_i<sizeof($arrtemp);$s_i++){
				$s_value = trim($arrtemp[$s_i]);
				if($s_value==$s_tofind){
					$s_flag = true;
					break;
				}
			}
		}
		return $s_flag;
	}
	public static function utftogbk($value){
		return iconv("UTF-8","gbk",$value);
	}
	public static function gbktoutf($value){
		return iconv("gbk","UTF-8",$value);
	}
	public static function price_format($price,$pricetype=1,$change_price = true){
		if ($change_price){
			switch ($pricetype){
				case 0: //保留2位小数点
					$price = number_format($price, 2, '.', '');
					break;
				case 1: // 保留不为 0 的尾数
					$price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));
					if (substr($price, -1) == '.'){
						$price = substr($price, 0, -1);
					}
					break;
				case 2: // 不四舍五入，保留1位
					$price = substr(number_format($price, 2, '.', ''), 0, -1);
					break;
				case 3: // 直接取整
					$price = intval($price);
					break;
				case 4: // 四舍五入，保留 1 位
					$price = number_format($price, 1, '.', '');
					break;
				case 5: // 先四舍五入，不保留小数
					$price = round($price);
					break;
			}
		}else{
			$price = number_format($price, 2, '.', '');
		}


		return $price;
	}
	public static function getdatetime($_timer,$_type=0){
		if($_type==1){
			$_newtime = date('Y-m-d',$_timer);
		}else{
			$_newtime = date('Y-m-d H:i:s',$_timer);
		}
		return $_newtime;
	}
	public static function mb($_string,$_comurl,$_gotype){
		echo("<meta http-equiv='Content-Type' content='text/html; charset=".aspxOE_CHARSET."' />");
		echo"<script language=javascript>alert('".$_string."');";
		if($_gotype==1){
			echo"window.history.go(-1);";
		}else{
			echo"window.location.href='".$_comurl."';";
		}
		echo"</script>";
		die();
	}
	public static function halt($message,$forwardurl,$msgtype){
		require_once CHENCY_ROOT.'./source/function/func_haltmsg.php';
		die();
	}
	public static function formattime($_datetime,$_type){
		switch($_type){
			case 1;
			$_newtime = date('Y-m-d',strtotime($_datetime));
			break;

			case 2;
			$_newtime = substr($_datetime,5,5);
			$_newtime = str_replace("-","/",$_newtime);
			break;

			default;
			$_newtime = date('Y-m-d H:i:s',strtotime($_datetime));
			break;
		}
		return $_newtime;
	}
	public static function get_filecontent($s_url){
		if(!self::ischar($s_url)){
			return;
		}
		$s_content = file_get_contents($s_url);
		return $s_content;
	}
	public static function createfile($s_content,$s_filename){
		if(!self::ischar($s_filename)){
			return;
		}
		if(!self::ischar($s_content)){
			return;
		}
		$s_fso = fopen($s_filename,'w');
		if($s_fso){
			fwrite($s_fso,$s_content);
		}
		fclose($s_fso);
	}
	public static function deletefile($s_filename){
		if(!self::ischar($s_filename)){
			return;
		}
		@unlink($s_filename);
	}
	public static function deletefolder($dir) {
		if(file_exists($dir)){
			$dh=opendir($dir);
			while ($file=readdir($dh)) {
				if($file!="." && $file!="..") {
					$fullpath=$dir."/".$file;
					if(!is_dir($fullpath)) {
						unlink($fullpath);
					} else {
						deldir($fullpath);
					}
				}
			}
			closedir($dh);
			if(rmdir($dir)) {
				return true;
			} else {
				return false;
			}
		}
	}
	public static function check_email($s_email){
		$pattern="/^([\w\.-]+)@([a-zA-Z0-9-]+)(\.[a-zA-Z\.]+)$/i";
		if(preg_match($pattern,$s_email,$matches)){
			return true;
		}else{
			return false;
		}
	}
	public static function check_userstr($s_str){
		if(preg_match("/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]+$/u",$s_str)){
			return true;
		}else {
			return false;
		}
	}
	/* 检测数据表 */
	public static function check_table($tablename){
		if(preg_match("/^[0-9a-zA-Z_]+$/u",$tablename)){
			return true;
		}else {
			return false;
		}
	}

	public static function check_userlen($str) {
		$str = strtolower($str);
		$name_len = strlen($str);
		$temp_len = 0;
		for($i=0;$i< $name_len;){
			if (strpos ('abcdefghijklmnopqrstvuwxyz0123456789_',$str[$i])==false){
				$i = $i + 3;
				$temp_len += 2;
			}else{
				$i = $i + 1;
				$temp_len += 1;
			}
		}
		return $temp_len;
	}
	/*
	 $Id 组合SQL OR 语句
	 $asname  -- MYSQL 表 别名
	 $field   -- 字段名
	 $sqlitem -- 值 格式 为单个数字或者 多个用逗号隔开的数字
	*/
	public static function combin_sqlor($asname,$field,$sqlitem){
		if(self::ischar($sqlitem)){
			if(self::isnumber($sqlitem)){
				if(self::ischar($asname)){
					$temp = " AND ".$asname.".".$field."=".intval($sqlitem)."";
				}else{
					$temp = " AND ".$field."=".intval($sqlitem)."";
				}
			}else{
				$splitarray = explode(",",$sqlitem);
				for($i=0;$i<sizeof($splitarray);$i++){
					if(self::ischar($asname)){
						$temp .= " ".$asname.".".$field."=".intval($splitarray[$i])." OR";
					}else{
						$temp .= " ".$field."=".intval($splitarray[$i])." OR";
					}
				}
				$temp = substr($temp,0,(strlen($temp)-3));
				$temp = " AND (".$temp." )";
			}
		}else{
			$temp = " ";
		}
		return $temp;
	}
	public static function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR"){
		if(!is_array($ArrayData)){
			return $ArrayData;
		}
		$ArgCount = func_num_args();
		for($I = 1;$I < $ArgCount;$I ++){
			$Arg = func_get_arg($I);
			if(!eregi("SORT",$Arg)){
				$KeyNameList[] = $Arg;
				$SortRule[]= '$'.$Arg;
			}else{
				$SortRule[]= $Arg;
			}
		}
		foreach($ArrayData AS $Key => $Info){
			foreach($KeyNameList AS $KeyName){
				${$KeyName}[$Key] = $Info[$KeyName];
			}
		}
		$EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
		eval ($EvalString);
		return $ArrayData;
	}

	/*
	  检测文件是否存在
	  @params::$fliename --文件_带路径
	  @update:: 2011.09.23
	*/
	public static function fileexists($fliename){
		if(file_exists($fliename)){
			return true;
		}else{
			return false;
		}
	}

	/* 过滤SQL语句
	   如果含有注入字符，则置为空
	   @update:: 2011.09.23
	*/
	public static function forbidchar($string){
		$forbidchar = array('select','update','delete','union','insert','load_file','outfile','where','char','concat');
		if(self::ischar($string)){
			foreach($forbidchar as $key){
				if(strpos(strtolower($string),$key)){
					$string = "";
				}
			}
		}
		return $string;
	}

	public static function format_size($size) {
		if ($size <1000) {
		$size_BKM = (string) $size .' B';
		}elseif ($size <(1000 * 1000)) {
		$size_BKM = number_format((double) ($size / 1000),1) .' KB';
		}else {
		$size_BKM = number_format((double) ($size / (1000 * 1000)),1) .' MB';
		}
		return $size_BKM;
	}

	/* 页面运行时间 */
	public static function isokchar($string){
		$forbidchar = array('select','update','delete','union','insert','load_file','outfile','where','char','concat');

        if (in_array($string, $forbidchar) === false)
        {return $string;}
        else{return "";}
	}

	public static function runtime(){

		//return "<font color='#999999'>Processed in ".Core_Timer::display()." second(s) , ".$GLOBALS['db']->querynum." queries<br /></font>";
	}
	public static function nowtime($item=NUll,$shorts=NULL){//"Y-m-d H:i:s"
	    $items=$item;
	    if($item==""){$items="Y-m-d H:i:s";}
		if($item=="d"){$items="Y-m-d";}
		if($item=="t"){$items="H:i:s";}
		if($shorts=="yes"){$items=str_replace("-","",$items);$items=str_replace(":","",$items);$items=str_replace(" ","",$items);}
		return date($items,time());//$nextdate=date('Y-m-d',strtotime("$d   +1   day"));
	}
	public static function nextdates($shorts=NULL){
		$items="Y-m-d";
		if($shorts=="yes"){$items=str_replace("-","",$items);}
		return date($items,strtotime("$d   +1   day"));
	}
	public static function lastdates($shorts=NULL){
		$items="Y-m-d";
		if($shorts=="yes"){$items=str_replace("-","",$items);}
		return date($items,strtotime("$d   -1   day"));
	}
	public static function retimeDiffs($aTime,$bTime){
	    if($aTime=="0" or $aTime==""){
	       $aTime=date("YmdHis",time());
	    }
		$aTime=str_replace("-","",$aTime);$aTime=str_replace(":","",$aTime);$aTime=str_replace(" ","",$aTime);
		$bTime=str_replace("-","",$bTime);$bTime=str_replace(":","",$bTime);$bTime=str_replace(" ","",$bTime);
	    // 分割第一个时间
        $ayear = substr ( $aTime , 0 , 4 );
        $amonth = substr ( $aTime , 4 , 2 );
        $aday = substr ( $aTime , 6 , 2 );
        $ahour = substr ( $aTime , 8 , 2 );
        $aminute = substr ( $aTime , 10 , 2 );
        $asecond = substr ( $aTime , 12 , 2 );
   	    // 分割第二个时间
        $byear = substr ( $bTime , 0 , 4 );
        $bmonth = substr ( $bTime , 4 , 2 );
        $bday = substr ( $bTime , 6 , 2 );
        $bhour = substr ( $bTime , 8 , 2 );
        $bminute = substr ( $bTime , 10 , 2 );
        $bsecond = substr ( $bTime , 12 , 2 );
   	    // 生成时间戳
        $a = mktime ( $ahour , $aminute , $asecond , $amonth , $aday , $ayear );
        $b = mktime ( $bhour , $bminute , $bsecond , $bmonth , $bday , $byear );
        $timeDiff [ ' second ' ] = $b-$a ;

   	    // 采用了四舍五入,可以修改
        $timeDiff [ ' minute ' ]=round ( $timeDiff [ ' second ' ] / 60 );
        $timeDiff [ ' hour ' ]=round ( $timeDiff [ ' minute ' ] / 60 );
        $timeDiff [ ' day ' ] = round ( $timeDiff [ ' hour ' ] / 24 );
        if ($timeDiff [ ' hour ' ]< 24){$timeDiff [ ' day ' ]=0;}
        $timeDiff [ ' week ' ] = round ( $timeDiff [ ' day ' ] / 7 );
        if ($timeDiff [ ' day ' ]< 7){$timeDiff [ ' week ' ]=0;}
        $timeDiff [ ' month ' ] = round ( $timeDiff [ ' day ' ] / 30 ); // 按30天来算
        if ($timeDiff [ ' day ' ]< 30){$timeDiff [ ' month ' ]=0;}
        $timeDiff [ ' year ' ] = round ( $timeDiff [ ' day ' ] / 365 ); // 按365天来算
        if ($timeDiff [ ' day ' ]< 365){$timeDiff [ ' year ' ]=0;}
        // $retimeDiff=$timeDiff [ ' year ']."|".$timeDiff [' month ']."|".$timeDiff [' week ']."|".$timeDiff [' day ']."|".$timeDiff [' hour ']."|".$timeDiff [ ' minute ' ];
        //$retimeDiff=round($timeDiff);
        return $timeDiff ;
    }
	public static function getBrowser(){
	    $sys = $_SERVER['HTTP_USER_AGENT'];
	    if(stripos($sys, "NetCaptor") > 0)
	       $exp = "NetCaptor";
	    elseif(stripos($sys, "Firefox/") > 0){
	       preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
	       $exp = "Mozilla Firefox ".$b[1];
	    }elseif(stripos($sys, "MAXTHON") > 0){
	       preg_match("/MAXTHON\s+([^;)]+)+/i", $sys, $b);
 	      preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
 	      $exp = $b[0]." (IE".$ie[1].")";
	    }elseif(stripos($sys, "MSIE") > 0){
	       preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
	       $exp = "Internet Explorer ".$ie[1];
	    }elseif(stripos($sys, "Netscape") > 0)
 	      $exp = "Netscape";
	    elseif(stripos($sys, "Opera") > 0)
	       $exp = "Opera";
	    else
	       $exp = "未知浏览器";
	       return $exp;
	}
	public static function htmldelsql($str)
    {
        if(empty($str)) return;
        if($str=="") return $str;
        $str=str_replace("&",chr(34),$str);
        $str=str_replace(">","",$str);
        $str=str_replace("<","",$str);
        $str=str_replace("&","",$str);
        $str=str_replace("|","",$str);
        $str=str_replace("#","",$str);
        $str=str_replace(" ",chr(32),$str);
        $str=str_replace(" ",chr(9),$str);
        $str=str_replace("'",chr(39),$str);
        $str=str_replace("<br />",chr(13),$str);
        $str=str_replace("''","'",$str);
        $str=str_replace("select","selects",$str);
        $str=str_replace("join","joins",$str);
        $str=str_replace("union","unions",$str);
        $str=str_replace("where","wheres",$str);
        $str=str_replace("insert","inserts",$str);
        $str=str_replace("delete","deletes",$str);
        $str=str_replace("update","updates",$str);
        $str=str_replace("like","likes",$str);
        $str=str_replace("drop","drops",$str);
        $str=str_replace("create","creates",$str);
        $str=str_replace("modify","modifys",$str);
        $str=str_replace("rename","renames",$str);
        $str=str_replace("alter","alters",$str);
        $str=str_replace("cas","casts",$str);
        $farr = array(
        "/\s+/" , //过滤多余的空白
        "/<(\/?)(img|script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU" , //过滤 <script 防止引入恶意内容或恶意代码,如果不需要插入flash等,还可以加入<object的过滤
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU" , //过滤javascript的on事件
        );
        $tarr = array(
        " " ,
        "<\\|\\#\\*>" , //如果要直接清除不安全的标签，这里可以留空
        "\\1\\2" ,
        );
        $str = preg_replace ( $farr , $tarr , $str );
        return $str;
    }
	public static function hexEncode($s) {//转
    	return preg_replace('/(.)/es',"str_pad(dechex(ord('\\1')),2,'0',STR_PAD_LEFT)",$s);
	}
	public static function hexDecode($s) {//回
    	return preg_replace('/(\w{2})/e',"chr(hexdec('\\1'))",$s);
	}
	public static function CutStr($str,$start, $length = 0, $append = false){
    	$str = trim($str);
    	$strlength = strlen($str);
    	if ($length == 0 || $length >= $strlength) {
        	return $str;
    	} elseif ($length < 0) {
        	$length = $strlength + $length;
        	if ($length < 0) {
            	$length = $strlength;
        	}
    	}
    	if (function_exists('iconv_substr')) {
        	$newstr = iconv_substr($str, 0, $length, 'UTF-8');
    	}elseif (function_exists('mb_substr')) {
        	$newstr = mb_substr($str, 0, $length, 'UTF-8');
    	}else {
        	$newstr = trim_right(substr($str, 0, $length));
    	}
    	if ($append && $str != $newstr) {
        	$newstr .= '…';
    	}
    	return $newstr;
    }
	public static function rePath($item) {
    	if($item=="games"){$vals=SZS_ROOT_PATH."source/config/games/";}
		if($item=="pritop"){$vals=SZS_ROOT_PATH."/".ADMINPATH."/lottery/pri_top.txt";}
		if($item=="bultop"){$vals=SZS_ROOT_PATH."/".ADMINPATH."/system/bul_top.txt";}
		return $vals;
	}
	public static function rePriTop($item){
		if($item=="" or $item-1<0){$item=2;}
		$myfile=self::rePath('pritop');
		if (file_exists($myfile)){
			$last_file = file_get_contents($myfile);
			$arr = explode("\r\n", $last_file);
			$innerHTML="<div id='roll' class='roll'><div id='roll1'>";
			for($i=0;$i<count($arr);$i++){
				$l_s=explode("|",$arr[$i]);
				if($i==0 or $i%$item==0){$innerHTML.="<li class='cls_container'><ul id='end'>";}
				$innerHTML.="<li>恭喜【<font color='red'><b>".$l_s[0]."</b></font>】".$l_s[2]."<font color='#00FF00'>".$l_s[4]."</font>期,喜中<b style='color:#00FF00'>".$l_s[1]."</b>大奖</li>";
				if(($e+1)%$item==0){$innerHTML.= "</ul></li>";}
			}
			$innerHTML.="</div><div id=roll2></div></div>";
			return $innerHTML;
		}else{
			return "<div id='roll'></div>";
		}
	}
	public static function reBulTop($item=NULL){
		$myfile=self::rePath('bultop');
		if (file_exists($myfile)){
			$last_file = file_get_contents($myfile);
			$innerHTML="<div id='demo' class='roll2'><div id='demo1'>";
			$innerHTML.="".self::filterhtml($last_file);
			$innerHTML.="</div><div id=demo2></div></div>";
			//if($item=="login"){return $last_file;}else{return $innerHTML;}
			return $innerHTML;
		}else{
			return "";
		}
	}
	public static function re_rebate_auto($basic_mode,$basic_rebate,$this_mode){
		if($this_mode-$basic_mode>0){
			$new_rebate=$basic_rebate-($this_mode-$basic_mode)/20;
		}elseif($basic_mode-$this_mode>0){
			$new_rebate=$basic_rebate+($basic_mode-$this_mode)/20;
		}else{
			$new_rebate=$basic_rebate;
		}
		return round($new_rebate,1);
	}
	public static function re_prize_auto($basic_mode,$basic_prize,$this_mode){
		$new_prize=($basic_prize/$basic_mode)*$this_mode;
		return round($new_prize,2);
	}
	public static function reGamelog($floatid,$perid,$creatdate){
		$play_path=self::rePath('games');
		$creats=explode(" ",$creatdate);
		$creatdates=str_replace("-","",$creats[0]);
		$play_path=$play_path.hexEncode($creatdates);
		$names=$perid."#".$floatid;
		$myfile=$play_path."/".$names.".aspx";
		if (file_exists($myfile)){
 			$flags=$myfile;  return $myfile;
		}else{
			$flags="no"; return $flags;
		}
	}
	public static function Gamelog($uid,$floatid,$perid,$gamekey,$playid,$lotpriod,$lines,$nums,$times,$CurMode,$CurModeType,$modes,$money,$is_zuih,$z_number,$prize_time,$nowdatetime=null){
		$play_path=self::rePath('games');
		if($nowdatetime==""){$nowtime=self::nowtime();}else{$nowtime=$nowdatetime;}
		$dates=date('Ymd',strtotime($nowtime));
		$play_path=$play_path.hexEncode($dates);
		if(!file_exists("".$play_path."")){
 			mkdir("".$play_path."/");
		}
		$game_info_arr='<?# $game_info_arr=array(';
		$game_info_arr.="#        'uid'=>'".$uid."',";
		$game_info_arr.="#        'floatid'=>'".$floatid."',";
		$game_info_arr.="#        'perid'=>'".$perid."',";
		$game_info_arr.="#        'gamekey'=>'".$gamekey."',";
		$game_info_arr.="#        'playid'=>'".$playid."',";
		$game_info_arr.="#        'lotpriod'=>'".$lotpriod."',";
		$game_info_arr.="#        'lines'=>'".$lines."',";
		$game_info_arr.="#        'nums'=>'".$nums."',";
		$game_info_arr.="#        'times'=>'".$times."',";
		$game_info_arr.="#        'CurMode'=>'".$CurMode."',";
		$game_info_arr.="#        'CurModeType'=>'".$CurModeType."',";
		$game_info_arr.="#        'modes'=>'".$modes."',";
		$game_info_arr.="#        'money'=>'".$money."',";
		$game_info_arr.="#        'is_zuih'=>'".$is_zuih."',";
		$game_info_arr.="#        'z_number'=>'".$z_number."',";
		$game_info_arr.="#        'creatdate'=>'".$nowtime."',";
		$game_info_arr.="#        'prize_time'=>'".$prize_time."',";
		$game_info_arr.="#        'isprize'=>'".$isprize."'";
		$game_info_arr.="#);#?>";
		$names=$perid."#".$floatid;
		$myfile=$play_path."/".$names.".aspx";
		if (file_exists($myfile) && $overwrite != true){unlink($myfile);}
		$file_pointer = fopen($myfile,"a+");
		$body=str_replace("#","\r\n",$game_info_arr);
		fwrite($file_pointer,$body);
		fclose($file_pointer);
		return "yes";
	}
	public static function vergamebuy($buyarr){
		$play_path=self::rePath('games');
		$creats=explode(" ",$buyarr['creatdate']);
		$creatdates=str_replace("-","",$creats[0]);
		$play_path=$play_path.hexEncode($creatdates);
		$names=$buyarr[userid]."#".$buyarr[buyid];
		$myfile=$play_path."/".$names.".aspx";
		$flags="yes";
		if (file_exists($myfile)){
			unset($game_info_arr);
 			include($myfile); $c="yes";
			if($flags=="yes"){if($buyarr['buyid']!=$game_info_arr['floatid']){$flags="no";}$c="buyid";}
			if($flags=="yes"){if($buyarr['userid']!=$game_info_arr['perid']){$flags="no";}$c="userid";}
			if($flags=="yes"){if($buyarr['playkey']!=$game_info_arr['gamekey']){$flags="no";}$c="playkey";}
			if($flags=="yes"){if($buyarr['list_id']!=$game_info_arr['playid']){$flags="no";}$c="list_id";}
			if($flags=="yes"){if($buyarr['period']!=$game_info_arr['lotpriod']){$flags="no";}$c="period";}
			if($flags=="yes"){
				$txt_arr=explode(",",$game_info_arr['number']);
				$sql_arr=explode(",",$buyarr['number']);
				$c_arrs=array_diff($txt_arr,$sql_arr);
				if($c_arrs[0]!=""){$flags="no";$c="number";}
			}
			if($flags=="yes"){if($buyarr['nums']!=$game_info_arr['nums']){$flags="no";}$c="nums";}
			if($flags=="yes"){if($buyarr['times']!=$game_info_arr['times']){$flags="no";}$c="times";}
			if($flags=="yes"){if($buyarr['pri_mode']!=$game_info_arr['CurMode']){$flags="no";}$c="pri_mode";}
			if($flags=="yes"){if($buyarr['ModeType']!=$game_info_arr['CurModeType']){$flags="no";}$c="ModeType";}
			if($flags=="yes"){if($buyarr['modes']!=$game_info_arr['modes']){$flags="no";}$c="modes";}
			if($flags=="yes"){if($buyarr['money']!=$game_info_arr['money']){$flags="no";}$c="money";}
			//if($flags=="yes"){if($buyarr['is_zuih']!=$game_info_arr['is_zuih']){$flags="no";}$c="is_zuih";}
			if($flags=="yes"){
				$txt_arr=explode(",",$game_info_arr['z_number']);
				$sql_arr=explode(",",$buyarr['z_number']);
				$c_arrs=array_diff($txt_arr,$sql_arr);
				if(count($c_arrs)-1>=0){$flags="no";$c="z_number";}
			}
			//if($flags=="yes"){if($buyarr['creatdate']!=$game_info_arr['creatdate']){$flags="no";}$c="creatdate";}
		}else{
			$flags="no";
		}
		return $flags;
	}
	public static function getnowlotnum($gamekey,$arrkey,$lotdate,$lotnum,$set_lot_date,$set_lot_num){
		if($gamekey=="LJSSC" OR strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false  OR $gamekey=="3D" OR $gamekey=="P5(P3)"){
			$times=self::nowtime('t');
			$lasttime=$set_lot_date." ".$times;
			$thistime=$lotdate." ".$times;
			$re_date=self::retimeDiffs($lasttime,$thistime);
			$lost_days=$re_date[ ' day ' ];
			$daylotnum=count($arrkey);
			$re_lots=$lost_days*$daylotnum+$set_lot_num+$lotnum;
			//echo $new_lot_num."=".$lost_days."*".$daylotnum."+".$set_lot_num."+".$lotnum;
		}else{
			$re_lots=str_replace("-","",$lotdate).$lotnum;
		}
		return $re_lots;
	}
	public static function getperiod_s($gamekey,$time_arrs,$set_lot_date,$set_lot_num){
		$nowtime=self::nowtime('t');
		$nowtime_s=self::nowtime('t','yes');
		//-------------------------------------
		$lotdate=self::nowtime('d');
		$lotdate_s=self::nowtime('d','yes');
		//-------------------------------------
		$lastdate=self::lastdates();
		$lastdate_s=self::lastdates('yes');
		//-------------------------------------
		$nowdate=self::nowtime('d');
		$nowdate_s=self::nowtime('d','yes');
		//-------------------------------------
		$nextdate=self::nextdates();
		$nextdate_s=self::nextdates('yes');

		//-------------------------------------
		$arrkey=array_keys($time_arrs);
		$arrvalue=array_values($time_arrs);
		$this_i=0;$next_i=0;$is_ok="no";$lot_num="";$next_num="";$last_num="";$lotendtime="";$t_day_is_begin="";
		for($i=0;$i<count($arrvalue);$i++){
			$begins=str_replace(":","",$arrvalue[$i]['begin']);
			$ends=str_replace(":","",$arrvalue[$i]['end']);
			if($begins-$nowtime_s>0){
				if($i-1>=0){//开始时间大于当前时间，停止比对，当前期是上一个。
					$is_ok="yes";
					$lot_num=$arrkey[$i-1];
					$lot_begin=$arrvalue[$i-1]['begin'];
					$lot_end=$arrvalue[$i-1]['end'];
					$next_num=$arrkey[$i];
					$t_day_is_begin="yes";
					break;
				}
				if($i-1<0){
					$is_ok="no";
		    		$lot_num=$arrkey[0];
		    		$lot_begin=$arrvalue[0]['begin'];
		    		$lot_end=$arrvalue[0]['end'];
					break;
				}
			}
		}
		//最后一期
		$n=count($arrvalue)-1;
		$end_end_lot_time=$arrvalue[$n]['end'];
		$end_end_lot_time_s=str_replace(":","",$end_end_lot_time);
		$end_beg_lot_time=$arrvalue[$n]['begin'];
		$end_beg_lot_time_s=str_replace(":","",$end_beg_lot_time);
        $lot_end_s=str_replace(":","",$lot_end);
		if($nowtime_s-$lot_end_s>0){//当前时间大于当前期开始时间和结束时间
			$is_ok="no";
			$lot_num=$next_num;
			$lot_begin=$arrvalue[$i]['begin'];
			$lot_end=$arrvalue[$i]['end'];
		}
		if($nowtime_s-$end_beg_lot_time_s>0 and $end_end_lot_time_s-$nowtime_s>0){
			$is_ok="yes";
			$lot_num=$arrkey[$n];
			$lot_begin=$arrvalue[$n]['begin'];
			$lot_end=$arrvalue[$n]['end'];
		}
		if($nowtime_s-$end_end_lot_time_s>0){//大于最后一期结束时间
		    $is_ok="no";
			$lotdate=$nextdate;
			$lotdate_s=$nextdate_s;
			$lot_num=$arrkey[0];
			$lot_begin=$arrvalue[0]['begin'];
			$lot_end=$arrvalue[0]['end'];
			if($gamekey=="XJSSC"){
				$is_ok="yes";
				$lotdate=$nextdate;
				$lotdate_s=$nowdate_s;
			}
			if($gamekey=="CQSSC"){
				$is_ok="yes";
			}
		}
		if($gamekey=="XJSSC"){
			if(100000-$nowtime_s>0){
				$lotdate=$nowdate;
				$lotdate_s=$lastdate_s;
			}
		}

		if($gamekey=="3D" or $gamekey=="P5(P3)"){$lot_num="01";}
		if($is_ok=="no"){
			$status="等待销售";$titles="开始时间";
			$lot_end=$lot_begin;
		}else{
			$status="正在销售";$titles="截止时间";
		}
		$lotendtime=$lotdate." ".$lot_end;
		$lotpriod=$lotdate_s.$lot_num;
		if($gamekey=="3D" or $gamekey=="P5(P3)" or   strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false){
			$times=self::nowtime('t');
			$lasttime=$set_lot_date." ".$times;
			$thistime=$lotdate." ".$times;
			$re_date=self::retimeDiffs($lasttime,$thistime);
			$lost_days=$re_date[ ' day ' ];
			$lotpriod=$lost_days*$n+$set_lot_num+$lotnum;
		}
		$periodarr=self::retimeDiffs('',$lotendtime);
				$arrs=array(
					'lotpriod'=>$lotpriod,
					'lotendtime'=>$lotendtime,
					'lotnum'=>$lot_num,
					'begin'=>$lot_begin,
					'end'=>$lot_end,
					'lostnums'=>$periodarr[ ' second ' ],
					'titles'=>$titles,
					'status'=>$status,
					'isbuy'=>$is_ok
		);
		return $arrs;
	}
	public static function getperiod($gamekey,$time_arrs,$set_lot_date='',$set_lot_num=''){
		global $db, $con_system;

		$row=$db->exec("select * from game_type where ckey='{$gamekey}'");

		$qicha=$row['lottime'];
		if(strpos($row['kjkey'],'KL8')!==false) return  self::getperiod($row['kjkey'],$time_arrs,$set_lot_date,$set_lot_num);

		if($gamekey=='JNDKL8' and date('w')==1){

			foreach ($time_arrs as $key=> $value) {
			//	if($key<19) unset($time_arrs[$key]);
				$tt=$key+18;
				if($tt<100) $tt='0'.$tt;
				if($time_arrs[$tt])
				$time_arrs[$key]=$time_arrs[$tt];
				else unset($time_arrs[$tt]);

			}
		}

	///	print_r($time_arrs);




		$lotdate=self::nowtime('d');
		$lotdate_s=self::nowtime('d','yes');
		$nowtime=self::nowtime('t');
		$nowtime_s=self::nowtime('t','yes');
		$arrkey=array_keys($time_arrs);
		$arrvalue=array_values($time_arrs);

		//print_r($arrvalue);
        $priode=self::check_priode();

//	echo $nowtime_s;
		$this_i=0;$next_i=0;$is_ok="no";$next_lot="";$lotendtime="";
		for($i=0;$i<count($arrvalue);$i++){
			$begins=str_replace(":","",$arrvalue[$i]['begin']);
			$ends=str_replace(":","",$arrvalue[$i]['lot']);
			if($nowtime_s-$begins>=0 and $ends-$nowtime_s>0){
				$this_i=$i;$is_ok="yes";$next_lot=$arrkey[$i];break;
			}else{


				if($gamekey=="XJSSC" ){
					if($nowtime_s-235959>0){
						$this_i=$i;$is_ok="yes";$next_lot=$arrkey[$i];break;
					}
				}
			}

			if($next_i==0){
				if($begins-$nowtime_s>=0){$next_i=$i;}
			}
		}
//if(!$this_i) $this_i=$next_i-1;

		if($is_ok=="no"){
			$status="等待销售";$titles="开始时间";
			$next_lot=$arrkey[0];
		    $first_start=str_replace(":","",$arrvalue[$next_i]['begin']);//第一期开始时间
			$end_end=str_replace(":","",$arrvalue[count($arrvalue)-1]['lot']);//最后一期结束时间
			if($nowtime_s-$end_end>=0 and $gamekey!='JNDKL8' ){
				$lotdate_s=self::nextdates('yes');
				$lotdate=self::nextdates();
				$lotendtime=$lotdate." ".$arrvalue[count($arrvalue)-1]['lot'];
				$lotendtime=$lotdate." ".$arrvalue[0]['begin'];


			}else{
				$lotendtime=$lotdate." ".$arrvalue[0]['begin'];
	//$lotendtime=$lotdate." ".$arrvalue[$this_i]['end'];
				$lotendtime=$lotdate." ".$arrvalue[$next_i]['begin'];
					$next_lot=$arrkey[$next_i];

			}
			$lotpriod=$lotdate_s.$next_lot;//echo $lotpriod."<br>";
		}else{
			$status="正在销售";$titles="截止时间";


//				if($nowtime_s-30000<0){
//					$lotdate_s=self::lastdates('yes');
//				}


			$lotendtime=$lotdate." ".$arrvalue[$this_i]['end'];
			$lotpriod=$lotdate_s.$next_lot;

		}
		if($gamekey=="3D" or $gamekey=="P5(P3)"  or $gamekey=="PL3" or   strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false ){

			$lotpriod1=	getsql::periods($gamekey);

//			if(strpos($gamekey, 'KL8')!==false or  strpos($gamekey, 'PK10')!==false)
//			$period1=$lotpriod1[count($lotpriod1)-1]['period'];
//			else
			$period1=$lotpriod1[0]['period'];
					$row11=	$db->fetch_first("select count(*) as num   from game_time where playKey='{$gamekey}' ");

					$all=$row11['num'];

		$row1=	$db->fetch_first("select * from game_lottery where playKey='{$gamekey}' and period='{$period1}' ");

		$lotNum1=$row1['SerialID'];
		$day=$row1['SerialDate'];
		if(date("Ymd")-$day>0){
			$cha1=(date("Ymd")-$day)*$all;

		}
		else $cha1=0;

		$tt=date("H:i:s");
		$row2=	$db->fetch_first("select * from game_time where playKey='{$gamekey}' and beginTime<='{$tt}' and endTime>'{$tt}' ");
		$lotNum2=$row2['lotNum'];



		$cha=$lotNum2-$lotNum1;
		$cha=$cha1+$cha;
	if($cha<1)$cha=1;


	//if($gamekey=='DJKL8') $cha++;

			//echo $lotpriod1[0]['period'].'<br>';

		//	if(strpos($gamekey,'KL8')!==false) $cha++;



		$lotpriod=$period1+$cha;


if(strpos($gamekey, 'PK10')!==false){
	$start=strtotime('2018-02-24 09:05:00');
	$BetweenDays=BetweenDays(time(),$start);
	if(time()>strtotime(date('Y-m-d').' 23:56:25')){
		$BetweenDays++;
	$sec=0;
	}
	else{
	$sec=floor((time()-strtotime(date('Y-m-d').' 09:01:25'))/300);
    if($sec<0) $sec=0;

	}
	//echo $sec."<br>";
	$lotpriod=667638+($BetweenDays)*179+$sec;

	//echo strtotime('2016-12-18 09:00:00')."<br>";
}

//

if($gamekey=='JNDKL8'){
//	$lotpriod++;
	if(time()>strtotime(date('Y-m-d').' 21:00:00'))$lotpriod++;
}







		}


		$lotpriod=$lotpriod+$qicha;

			$lotendtime1=date('H:i:s',strtotime($lotendtime)-$con_system['Limit_Betting']);
		$periodarr=self::retimeDiffs('',$lotendtime);
	$periodarr1=self::retimeDiffs('',$lotendtime1);

		$arrs=array(
					'lotpriod'=>$lotpriod,
					'lotendtime'=>$lotendtime,
					'lotnum'=>$next_lot,
					'begin'=>$arrvalue[$this_i]['begin'],
					'end'=>$arrvalue[$this_i]['end'],
					'lostnums'=>$periodarr[ ' second ' ],
				    'lostnums1'=>$periodarr1[ ' second ' ],
					'titles'=>$titles,
					'status'=>$status,
					'isbuy'=>$is_ok,
		            'lotendtime1'=>$lotendtime1,
		            'lotendtime2'=>date('H:i:s',strtotime($lotendtime))
		);
		return $arrs;
	}
	public static function inputds($arr,$games,$plays){
		if($plays==""){return "";exit;}
		if($games==""){return "";exit;}
		if(!$arr){return "";exit;}
		$playline="#".$plays;$zh="no";$samls="no";$is_yes="yes";$newarr[0]=Array();$newarr[1]=Array();$zharr=Array();$newarr1[]=array();
		//if(strpos($games,'SS')){

			if(strpos($playline,'3X') or strpos($playline,'3R') or   strpos($playline,'3x') or  strpos($playline,'2TH') or  strpos($playline,'3BT')){$lines=3;}
			if(strpos($playline,'3M')){$lines=3;}
			if(strpos($playline,'2X') or strpos($playline,'2R') or  strpos($playline,'2x') or   strpos($playline,'2BT')){$lines=2;}
			if(strpos($playline,'2M')){$lines=2;}
			if(strpos($playline,'4X') or strpos($playline,'4R') or  strpos($playline,'4x')){$lines=4;}
			if(strpos($playline,'5X') or strpos($playline,'5R') or  strpos($playline,'5x')){$lines=5;}

			if(strpos($playline,'RXDS') ){if(strpos($games,'11-5')){$slen=strlen($plays);$lines=substr($plays,$slen-3,1);}
			else
			$slen=strlen($plays);$lines=substr($plays,$slen-1,1);
			}
			if(strpos($playline,'z3ds') or strpos($playline,'z6ds')  or strpos($playline,'zxds') ){$zh="yes";}
			//$lines=5;

		//	if(strpos($playline,'z3ds')  ){$samls="yes";}
if(strpos($playline,'TJZH')){$samls="no";$is_yes="no";}

			foreach ($arr as $value){

				$adds="yes";$value=Trim($value);
				if(strpos($games,'11-5')  or strpos($games,'PK10')){
					$ls_arr=explode(" ",$value);
					$ls_arr=array_filter($ls_arr);
					$ls_len=count($ls_arr);
					$str=str_replace(" ","",$value);
					if(eregi("^[0-9]+$",$str)){
					}else{
						$is_yes="no";
					}
				}

				else{
					$ls_len=strlen($value);
					if(eregi("^[0-9]+$",$value)){
					}else{
						$is_yes="no";
					}
				}

							if(strpos($playline,'2TH')!==false){
						$ls_arr=Array();
							for($a=0;$a<strlen($value);$a++){
								$ls_arr[$a]=substr($value,$a,1);
							}
								if(($ls_arr[0]-$ls_arr[1]==0 or $ls_arr[1]-$ls_arr[2]==0 or $ls_arr[0]-$ls_arr[2]==0) and !( $ls_arr[0]-$ls_arr[1]==0 and $ls_arr[1]-$ls_arr[2]==0) ){

								}
								else{

									continue;
								}

						}

						if(strpos($playline,'2BT')!==false){
						$ls_arr=Array();
							for($a=0;$a<strlen($value);$a++){
								$ls_arr[$a]=substr($value,$a,1);
							}
								if($ls_arr[0]-$ls_arr[1]==0 ){

									continue;
								}
								else{

								}

						}
						if(strpos($playline,'3BT')!==false){
						$ls_arr=Array();
							for($a=0;$a<strlen($value);$a++){
								$ls_arr[$a]=substr($value,$a,1);
							}
								if($ls_arr[0]-$ls_arr[1]==0 or $ls_arr[1]-$ls_arr[2]==0 or $ls_arr[0]-$ls_arr[2]==0){
							continue;
								}


						}



				if($ls_len-$lines==0  or strpos($games,'11-5')  or strpos($games,'PK10')){
					if($samls=="yes" or $zh=="yes"){
						if(strpos($games,'11-5') or strpos($games,'PK10')){
						}else{
							$ls_arr=Array();
							for($a=0;$a<strlen($value);$a++){
								$ls_arr[$a]=substr($value,$a,1);
							}
						}
					}



					/*有过滤要求的*/
					if($samls=="yes"){
						if($ls_arr[0]-$ls_arr[1]==0 or $ls_arr[1]-$ls_arr[2]==0 or $ls_arr[0]-$ls_arr[2]==0){
							if($ls_arr[0]-$ls_arr[1]==0 and $ls_arr[0]-$ls_arr[2]==0){
								$is_yes="no";
							}
						}else{
							$is_yes="no";
						}
					}

						if(strpos($playline,'z3ds')!==false){
								if($ls_arr[0]-$ls_arr[1]==0 or $ls_arr[1]-$ls_arr[2]==0 or $ls_arr[0]-$ls_arr[2]==0){

								}
							else{
								continue;

							}
						}

					if(strpos($playline,'z6ds')!==false){
								if($ls_arr[0]-$ls_arr[1]==0 or $ls_arr[1]-$ls_arr[2]==0 or $ls_arr[0]-$ls_arr[2]==0){
							continue;
								}

						}




					if($zh=="yes"){
						sort($ls_arr);

							$new_ls_s=implode("", $ls_arr);

						if (in_array($new_ls_s, $zharr) === false) {
							$zharr[]=$new_ls_s;
						}else{
							$is_yes="no";
						}
					}


						if(strpos($games,'11-5') or strpos($games,'PK10')){

							$vv=explode(" ", $value);
							if(strpos($playline, "RX")!==false or strpos($playline, "rx")!==false)
							$vv=bubble_sort($vv);
							$cha=arr_cha($vv);
					if(count($vv)==$lines){
							$newstr='';
							foreach ($vv as $v1) {
                                  if($newstr=='') $newstr=$v1;
                                  else $newstr.=" ".$v1;


							}

							if($cha[0]==0){




							$newarr[1][]=$newstr;


							}
							else{

					if(in_array($newstr, $newarr[0])){

							$newarr[1][]=$newstr;

						}
						else{

							$newarr[0][]=$newstr;

						}

							}

							}
									else{
								$newarr[1][]=$newstr;

							}

						}else{

								if(strpos($playline,'hhzx')){
						$arr1=array();
						for($i=0;$i<strlen($value);$i++){
							$arr1[]=substr($value, $i,1);


						}
					$value1=	bubble_sort($arr1);
					$str11='';
					foreach ($value1 as $v){

					$str11.=$v;

					}

						if(in_array($str11, $newarr[0])){

							$newarr[1][]=$value;

						}
						else{

							$newarr[0][]=$str11;

						}


							//$newarr[0][]=123;
					}
					else{

								/*结束有过滤要求的*/
					if($is_yes=="yes"  ){$newarr[0][]=$value;}else{$newarr[1][]=$value;}

					}


						}



				}else{
					$newarr[1][]=$value;//数字个数不对
				}
			}



			return $newarr;
		//}
	}
}
?>
