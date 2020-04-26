<?php
/* *
 * 功能：支付回调文件
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

	// 请求数据赋值
	$data = "";
	$data['apiName'] = $_REQUEST["apiName"];
	// 通知时间
	$data['notifyTime'] = $_REQUEST["notifyTime"];
	// 支付金额(单位元，显示用)
	$data['tradeAmt'] = $_REQUEST["tradeAmt"];
	// 商户号
	$data['merchNo'] = $_REQUEST["merchNo"];
	// 商户参数，支付平台返回商户上传的参数，可以为空
	$data['merchParam'] = $_REQUEST["merchParam"];
	// 商户订单号
	$data['orderNo'] = $_REQUEST["orderNo"];
	// 商户订单日期
	$data['tradeDate'] = $_REQUEST["tradeDate"];
	// Mo宝支付订单号
	$data['accNo'] = $_REQUEST["accNo"];
	// Mo宝支付账务日期
	$data['accDate'] = $_REQUEST["accDate"];
	// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
	$data['orderStatus'] = $_REQUEST["orderStatus"];
	// 签名数据
	$data['signMsg'] = $_REQUEST["signMsg"];

	//print_r( $data);
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备准备验签数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 验证签名
	$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
	//var_dump($data);
	if ($resultVerify) 
	{
	
		// 签名验证通过
		if($_SESSION['billno']!= $_REQUEST["orderNo"]  ){
			$_SESSION['billno']= $_REQUEST["orderNo"];
			online_charge($_SESSION['userid'], 	$data['tradeAmt'], "摩宝支付",$_REQUEST["orderNo"]);


		}
echo "<script>alert('恭喜您，充值成功');</script>";

echo "<script>window.location='/index.aspx?mod=report&code=recharge';</script>";
	
	


		/*商户需要在此处判定通知中的订单状态做后续处理*/
		/*由于页面跳转同步通知和异步通知均发到当前页面，所以此处还需要判定商户自己系统中的订单状态，避免重复处理。*/
		
		return true;
	}
	else
	{
			echo "<script>alert('很抱歉，充值失败');</script>";

echo "<script>window.location='/index.aspx?mod=safe&code=recharge';</script>";
		exit;
	}

?>