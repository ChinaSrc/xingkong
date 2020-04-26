<?php
session_start();
require_once '../source/core/run.php';
require_once '../source/core/core.do.fun.php';

header("Content-type:text/html; charset=utf-8"); 

//----------------------------------------------------
//  接收数据
//  Receive the data
//----------------------------------------------------
$billno = $_GET['billno'];
$amount = $_GET['amount'];
$mydate = $_GET['date'];
$succ = $_GET['succ'];
$msg = $_GET['msg'];
$attach = $_GET['attach'];
$ipsbillno = $_GET['ipsbillno'];
$retEncodeType = $_GET['retencodetype'];
$currency_type = $_GET['Currency_type'];
$signature = $_GET['signature'];

//'----------------------------------------------------
//'   Md5摘要认证
//'   verify  md5
//'----------------------------------------------------

//RetEncodeType设置为17（MD5摘要数字签名方式）
//交易返回接口MD5摘要认证的明文信息如下：
//billno+【订单编号】+currencytype+【币种】+amount+【订单金额】+date+【订单日期】+succ+【成功标志】+ipsbillno+【IPS订单编号】+retencodetype +【交易返回签名方式】+【商户内部证书】
//例:(billno000001000123currencytypeRMBamount13.45date20031205succYipsbillnoNT2012082781196443retencodetype17GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ)

//返回参数的次序为：
//billno + mercode + amount + date + succ + msg + ipsbillno + Currecny_type + retencodetype + attach + signature + bankbillno
//注2：当RetEncodeType=17时，摘要内容已全转成小写字符，请在验证的时将您生成的Md5摘要先转成小写后再做比较
$content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;
//请在该字段中放置商户登陆merchant.ips.com.cn下载的证书
$cert = '11384695270638523352321288210859268292844619644474411098909537432137022050861164474543816938330628750644136022773406388821109362';
$signature_1ocal = md5($content . $cert);

if ($signature_1ocal == $signature)
{
	//----------------------------------------------------
	//  判断交易是否成功
	//  See the successful flag of this transaction
	//----------------------------------------------------
	if ($succ == 'Y')
	{
		/**----------------------------------------------------
		*比较返回的订单号和金额与您数据库中的金额是否相符
		*compare the billno and amount from ips with the data recorded in your datebase
		*----------------------------------------------------
		
		if(不等)
			echo "从IPS返回的数据和本地记录的不符合，失败！"
			exit
		else
			'----------------------------------------------------
			'交易成功，处理您的数据库
			'The transaction is successful. update your database.
			'----------------------------------------------------
		end if
		**/
		$nowtime=Core_Fun::nowtime();
$array  = array(
'userid'=>$_SESSION['userid'],
'money'=>$amount,
'cate'=>'recharge',
'remark'=>'平台充值',
'creatdate'=>date("y-m-d H:i:s"),
'realname'=>'',
'banknum'=>'',
'bankname'=>'环迅支付',
'status'=>'1'
);
$db->insert(DB_PREFIX."user_funds",$array);
mysql_query("update user_bank set hig_amount=hig_amount+$amount where userid='{$_SESSION['userid']}' ");	
$log_floatid="";$log_type="Recharge_to_system";$log_money=$amount;$log_remarks="平台充值";$log_uid=$_SESSION['userid'];$log_status="0";
include("../pub/Add_Bank_Log.php");
echo "<script>alert('恭喜您，充值成功');</script>";

echo "<script>window.location='../?mod=game&play=CQSSC';</script>";
	}
	else
	{
		echo "<script>alert('很抱歉，充值失败');</script>";

echo "<script>window.location='../?mod=safe&code=recharge';</script>";
		exit;
	}
}
else
{
	echo '签名不正确！';
	exit;
}
?>
