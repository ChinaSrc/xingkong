<?php

///设置时区
date_default_timezone_set('Asia/Shanghai');
///系统安装目录
define('SZS_ROOT_NAME', '');
///首页文件
define('SZS_CUR_PAGE', 'index');
//define('SZS_ROOT_URL',"http://".$_SERVER['HTTP_HOST']."/".SZS_ROOT_NAME."/");
define('SZS_ROOT_URL', "http://" . $_SERVER['HTTP_HOST'] . "/");
///系统Cookies名
define('SZS_COOKIENAME', 'CE4TrRn5');
///系统编码
define('SZS_CHARSET', 'utf-8');
///自定义链接路径
$file_path = str_replace("\\", "/", dirname(__FILE__));
define('SZS_ROOT_PATH', substr($file_path, 0, strlen($file_path) - 13));
///前面默认模版目录


//http日志开启 0 关闭 1 开启
define('SZS_HTTP_LOG','1');
//对GET POST COOKIE 数据进行过滤 0关闭 1 开启
define('SZS_DATA_FILTERING','1');
//异常数据日志开启 0 关闭 1开启
define('SZS_DATA_FILTERING_LOG','1');

function isMobile()
{
	global $con_system, $_SESSION;
	if (strpos($_SERVER['HTTP_REFERER'], 'mobile=1') != false) return true;
	if ($con_system['mobile_open'] != 1) return false;
	if (substr($_SERVER['HTTP_HOST'], 0, 2) == 'm.') {

		return true;
	}
	if ($_GET['mobile'] == 1) return true;
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
		return true;
	}
	// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	if (isset ($_SERVER['HTTP_VIA'])) {
		// 找不到为flase,否则为true
		return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	}
	// 脑残法，判断手机发送的客户端标志,兼容性有待提高
	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array('nokia',
			'sony',
			'ericsson',
			'mot',
			'samsung',
			'htc',
			'sgh',
			'lg',
			'sharp',
			'sie-',
			'philips',
			'panasonic',
			'alcatel',
			'lenovo',
			'iphone',
			'ipod',
			'blackberry',
			'meizu',
			'android',
			'netfront',
			'symbian',
			'ucweb',
			'windowsce',
			'palm',
			'operamini',
			'operamobi',
			'openwave',
			'nexusone',
			'cldc',
			'midp',
			'wap',
			'mobile',
			'iphone',
			'ipad'
		);
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return true;
		}
	}
	// 协议法，因为有可能不准确，放到最后判断
	if (isset ($_SERVER['HTTP_ACCEPT'])) {
		// 如果只支持wml并且不支持html那一定是移动设备
		// 如果支持wml和html但是wml在html之前则是移动设备
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			return true;
		}
	}
	return false;
}


if (isMobile())
	define('DEFAULT_TEMPLATE', 'template/mobile/');
else
	define('DEFAULT_TEMPLATE', 'template/default/');
///后台默认模版目录
define('ADMIN_TEMPLATE', 'admin/szs/');

define('INDEXPAGE', 'index');
///安装标识
define('SZS_INSTALL', true);
///安装标识
define('INDEX_TEMPLATE', DEFAULT_TEMPLATE);
$core_skin = array('skinid' => "1", 'skindir' => "black", 'skinext' => "template");

$NaviShow     = array('user' => "none", 'records' => "none", 'report' => "none", 'safe' => "none", 'help' => "none");
$NaviShowLeft = array('game' => '100', 'user' => "350", 'records' => "450", 'report' => "550", 'safe' => "650", 'help' => "750");


if ($_SESSION['isproxy'] == 1) {
	$NaviTitle = array('safe' => "我的账户", 'records' => "我的投注", 'report' => "资金管理", 'user' => "会员中心");
	$NaviList  = array(
		'safe' => array('info' => "修改资料", 'pass' => "登录密码", 'pwd2' => "提现密码", 'bankinfo' => "银行卡绑定", 'msg' => '站内消息'),
		'records' => array('list' => "投注记录", 'task' => "追号记录", 'hemai' => '合买记录'),

		'report' => array('index' => "账户预览", 'list' => "个人盈亏", 'orders' => "资金流水", 'recharge' => "充值记录", 'platform' => "提现记录"),
		'user' => array('list' => "会员列表", 'add' => "添加会员", 'url' => "推荐链接"),
	);
} else {
	$NaviTitle = array('safe' => "我的账户", 'records' => "我的投注", 'report' => "资金管理", 'user' => "代理中心");
	$NaviList  = array(
		'safe' => array('info' => "修改资料", 'pass' => "登录密码", 'pwd2' => "提现密码", 'bankinfo' => "银行卡绑定", 'msg' => '站内消息'),
		'records' => array('list' => "投注记录", 'yingkui' => "盈亏记录", 'task' => "追号记录", 'hemai' => '合买记录', 'fandian' => "返点记录", 'fenhong' => "分红记录"),

		'report' => array('index' => "账户预览", 'list' => "个人盈亏", 'orders' => "资金流水", 'recharge' => "充值记录", 'platform' => "提现记录"),
		'user' => array('list' => "会员列表", 'add' => "添加会员", 'url' => "推荐链接", 'orders' => "资金流水", 'recharge' => '充值记录', 'platform' => "提现记录", 'buy' => "投注记录", 'task' => "追号记录", 'fandian' => "返点流水", 'fenhong' => "分红流水", 'yingkui' => "盈亏查询"),


	);

}

$Linkarray     = array(
	'user' => SZS_ROOT_URL . "?mod=user&code=list",
	'userteam' => SZS_ROOT_URL . "?mod=user&code=list",
);
$css_szs_top   = array(
	'home' => "",
	'game' => "",
	'user' => "",
	'records' => "",
	'report' => "",
	'safe' => "",
	'help' => "",
);
$game_code     = array(
	'ssc' => "时时彩",
	'11x5' => "11选5",
	'jrx' => "基诺型",
	'dpx' => "低频型"
);
$play_code_arr = array('ssc' => "数字型", '11x5' => "乐透型", 'jrx' => "基诺型", 'dpx' => "低频型",);

$arr_add_money = array("bank_to_hig", "hig_rebate", "hig_prize", "hig_chase_back", "hig_buy_chase_back", "hig_buy_back", "hig_add_admin", "Recharge_to_higherid", "higerid_del_user", "mention_from_Lowerid", "Recharge_to_system", "mention_from_back", "low_add_admin", "Recharge_online", "active", 'fenhong', 'tranfer_in', 'hm_back', 'tixian2', 'wage', 'yongjin', 'recharge');

$arr_lost_money = array("hig_to_bank", "hig_buy", "hig_buy_back_fee", "hig_rebate_back", "hig_prize_back", "hig_lost_admin,'Recharge_from_Lowerid','mention_to_higherid'", "mention_from_system", "low_lost_admin", 'send_wage');

$arr_msg   = array(
	'platform' => '提现',
	'recharge' => '充值',
	'gifts' => '提现',
	'msg' => '消息',
	'lot' => '开奖',
	'reb' => '返点',
	'sys' => '系统消息'
);
$quest_arr = array('您母亲的姓名是？', '您配偶的生日是？', '您母亲的生日是？', '您高中班主任的名字是？', '您父亲的姓名是？',
	'您小学班主任的名字是？', '您父亲的生日是？', '您配偶的姓名是？', '您初中班主任的名字是？', '您最熟悉的童年好友名字是？',
	'您最熟悉的学校宿舍室友名字是？', '对您影响最大的人名字是？', '您的学号（或工号）是？');

$arr_table = array(
	'user' => '用户信息',
	'game_type' => '游戏',
	'adminlog' => '管理员日志',
	'game_buylist' => '下注信息',
	'game_code' => '玩法',
	'game_lottery' => '开奖数据',
	'game_intface' => '开奖接口',
	'game_rebate' => '返点信息',
	'game_set' => '游戏设置',
	'game_time' => '开奖时间',
	'message' => '站内信',
	'system_bank' => '银行信息',
	'user_bank_log' => '充值信息',
	'user_login_log' => '用户登录信息',
	'user_msg' => '用户站内信',
	'user_rebate' => '用户返点'
);

$arr_active = array(
	'day' => '每日加奖',
	//'buy'=>'消费佣金',
//'bank'=>'绑卡奖励',
//'charge'=>'充值奖励',
//'fee'=>'返还手续费',

//'sign'=>'签到奖励',
//'charge1'=>'每日首次充值奖励',
//'charge2'=>'累计充值奖励'\
);


$arr_admin_group = array('1' => '超级管理员', '2' => '系统管理员', '3' => '客服主管', '4' => '提现客服', '5' => '充值客服');

$arr_game_code = array('k3' => '快三');
//$arr_game_code=array('k3'=>'快三','ssc'=>'时时彩','11x5'=>'11选5','kl8'=>'快乐8','pk10'=>'PK10','dp'=>'3D/P3');
$bank_arr         = array("微信支付", "支付宝", "财付通", "工商银行", "农业银行", "建设银行", "中国银行", "邮储银行", "交通银行", "民生银行", "光大银行", "兴业银行", "招商银行",
	"广发银行", "平安银行", "华夏银行", "上海银行", "浦发银行");
$arr_hemai_status = array('-1' => '合买失败', '0' => '认购中', '1' => '已满员', '2' => '已结束');
$arr_menu[0]      = array('系统设置', 'image/icons/item58.gif');
$arr_menu[2]      = array('统计报表', 'image/icons/item40.gif');
$arr_menu[1]      = array('用户管理', 'image/icons/item40.gif');

$arr_menu[11] = array('资金管理', 'image/icons/item22.gif');
$arr_menu[12] = array('投注管理', 'image/icons/item22.gif');
$arr_menu[3]  = array('彩票管理', 'image/icons/item50.gif');
$arr_menu[4]  = array('活动管理', 'image/icons/item50.gif');
$arr_menu[5]  = array('站内消息', 'image/icons/item50.gif');
//$arr_menu[31]=array('玩法管理','image/icons/item50.gif');
//$arr_menu[4]=array('文章管理','image/icons/item58.gif');

$arr_menu[7] = array('管理员管理', 'image/icons/item60.gif');


$arr_menu[100] = array('个人信息', 'image/icons/item43.gif');


$arr_item[0][] = array("站点信息", "controller=default&action=system", '1');
$arr_item[0][] = array("基本参数", "controller=system&action=config&type=basic", '1');

$arr_item[0][] = array("页面设置", "controller=system&action=config&type=pc", '1');
//$arr_item[0][] =array("奖金返点","controller=system&action=config&type=rebate",'1');
$arr_item[0][] = array("充值提现", "controller=system&action=config&type=recharge", '1');

//$arr_item[0][] =array("虚拟排行","controller=system&action=config&type=tranfer",'1');


//$arr_item[0][] =array("合买设置","controller=system&action=config&type=hm",'1');
//	$arr_item[0][] =array("公告管理","controller=system&action=bulltin");


$arr_item[0][] = array("汇款账户", "controller=system&action=bank", '1');
$arr_item[0][] = array("提现银行", "controller=system&action=bank1", '1');
$arr_item[0][] = array("充值卡管理", "controller=system&action=card", '1');
//$arr_item[0][] =array("第三方支付","controller=system&action=pay",'1');

$arr_item[0][] = array("网址设置", "controller=system&action=config&type=url", '1');
$arr_item[0][] = array("首页banner设置", "controller=system&action=config&type=banner", '1');
$arr_item[0][] = array("购彩大厅banner", "controller=system&action=config&type=banner_hall", '1');
$arr_item[0][] = array("聊天室设置", "controller=system&action=config&type=chat", '1');


$arr_item[0][] = array("文章管理", "controller=news&action=index", '1,2');
$arr_item[1][] = array("用户列表", "controller=user&action=index", '1');
$arr_item[1][] = array("用户组", "controller=user&action=group", '1');
$arr_item[1][] = array("邀请码", "controller=user&action=url", '1');
$arr_item[1][] = array("登陆日志", "controller=user&action=loginlist", '1');
// $arr_item[1][] = array("同IP登录检测", "controller=user&action=loginip", '1');
$arr_item[1][] = array("银行卡号", "controller=user&action=banklist", '1');
$arr_item[1][] = array("用户字段", "controller=user&action=field", '1');

$arr_item[2][] = array("统计概况", "welcome.aspx", '1');
$arr_item[2][] = array("盈亏统计", "controller=project&action=yingkui1&st=1", '1');
$arr_item[2][] = array("用户统计", "controller=project&action=yingkui&st=1", '1');
$arr_item[2][] = array("团队统计", "controller=project&action=yingkui", '1');
$arr_item[2][] = array("彩种统计", "controller=report&action=game", '1,2');
$arr_item[2][] = array("玩法统计", "controller=report&action=play", '1,2');
//$arr_item[1][] =array("盈亏排行","controller=project&action=usertop",'1');
//$arr_item[1][] =array("代理等级设置","controller=system&action=config&type=update",'1');


$arr_item[11][] = array("帐变记录", "controller=project&action=bank&active=account", '1');
// $arr_item[11][] =array("返点记录","controller=project&action=bank&active=point",'1');
//$arr_item[11][] =array("工资记录","controller=project&action=wage",'1');
// $arr_item[11][] =array("契约分红","controller=project&action=fenhong",'1');

$arr_item[11][] = array("充值记录", "controller=user&action=recharge", '1');
$arr_item[11][] = array("提现记录", "controller=user&action=platform", '1,2,4,5');
//$arr_item[11][] =array("转账记录","controller=user&action=tranfer",'1,2,4,5');

$arr_item[12][] = array("投注记录", "controller=project&action=index&active=bet", '1');
$arr_item[12][] = array("盈亏记录", "controller=project&action=yingkui2", '1');
$arr_item[12][] = array("追号记录", "controller=project&action=index&active=trace", '1');
$arr_item[12][] = array("中奖记录", "controller=project&action=index&active=prize", '1');
//$arr_item[12][] =array("合买记录","controller=project&action=hemai",'1');
$arr_item[12][] = array("异常订单", "controller=lottery&action=erros", '1,2');


$arr_item[3][] = array("彩票列表", "controller=game&action=game", '1,2');
$arr_item[3][] = array("开奖数据", "controller=lottery&action=GameLot", '1,2');
$arr_item[3][] = array("系统彩预设开奖", "controller=lottery&action=plan", '1,2');

$arr_item[3][] = array("开奖时间", "controller=lottery&action=GameTime", '1');
$arr_item[3][] = array("奖金设置", "controller=game&action=ssc_list", '1');
//	$arr_item[3][] =array("开奖接口","controller=lottery&action=xml",'1');

//$arr_item[3][] =array("奖金设置","controller=system&action=prize",'1,2');


//	$arr_item[3][] =array("手动开奖","controller=lottery&action=GameLot1",'1,2');
//$arr_item[31][] =array("玩法类型","controller=game&action=game_code",'1');


//$arr_item[0][]=array("文章栏目","controller=news&action=cate",'1,2');


//	$arr_item[7][] =array("开奖设置","controller=task&action=index",'1');


$arr_item[4][] = array("活动设置", "controller=system&action=active", '1');
$arr_item[4][] = array("每日加奖", "controller=system&action=activelog&type=day", '1');
$arr_item[4][] = array("晋级奖励", "controller=system&action=activelog&type=vip", '1');
$arr_item[4][] = array("活动赠送", "controller=system&action=activelog&type=gift", '1');
$arr_item[4][] = array("会员返点", "controller=system&action=rebatelog", '1');

$arr_item[5][]   = array("收件箱", "controller=user&action=msg&type=to", '1');
$arr_item[5][]   = array("发件箱", "controller=user&action=msg&type=from", '1');
$arr_item[7][]   = array("管理员列表", "controller=user&action=admin_list", '1');
$arr_item[7][]   = array("管理员日志", "controller=user&action=adminlog", '1');
$arr_item[7][]   = array("角色管理", "controller=system&action=role", '1');
$arr_item[7][]   = array("添加角色", "controller=system&action=role_add", '1');
$arr_item[7][]   = array("数据管理", "controller=system&action=clear", '1');
$arr_item[7][]   = array("访问权限", "controller=system&action=config&type=permissions", '1');
$arr_item[100][] = array("编辑个人信息", "controller=user&action=info", '1');
$arr_item[100][] = array("修改密码", "controller=user&action=pwd", '1');


// $arr_item[0][]  =array("网站基本信息","welcome.aspx",'1');


$search_time_arr = array('begin' => '00:00:00', 'end' => '23:59:59');
$arr_bank        = array('1100' => '工商银行', '1101' => '农业银行', '1102' => '招商银行', '1103' => '兴业银行', '1104' => '中信银行', '1106' => '中国建设银行', '1107' => '中国银行', '1108' => '交通银行', '1109' => '浦发银行', '1110' => '民生银行', '1111' => '华夏银行'
, '1112' => '光大银行', '1113' => '北京银行', '1114' => '广发银行', '1115' => '南京银行', '1116' => '上海银行', '1117' => '杭州银行'
, '1118' => '宁波银行', '1119' => '邮储银行', '1120' => '浙商银行', '1121' => '平安银行', '1122' => '东亚银行', '1123' => '渤海银行'
, '1124' => '北京农商行', '1127' => '浙江泰隆商业银行'
);

$recharge_type_arr = array('bank' => '银行转账', 'alipay' => '支付宝', 'weixin' => '微信支付', 'card' => "充值卡支付", 'online' => '在线支付');

$recharge_type_arr1 = array('hand' => '银行转账', 'online' => '第三方支付', 'chat' => '聊天室', 'card' => "充值卡支付", 'green' => "绿色通道");
?>
