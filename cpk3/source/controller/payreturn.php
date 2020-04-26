<?php
header("Content-type:text/html; charset=utf-8");

if($_GET['type']=='getshow' and $_GET['id']){


$row=$db->exec("select * from user_funds where id='{$_GET['id']}'");

echo $row['status'];
	exit();
}

if($_GET['return']=='success'){
	if(isMobile() ){
		
		
		
		$_GET['mobile']=1;
	show_message1('充值成功','home_user_orders.html?mobile=1');	
		
	}
	else  
	show_message1('充值成功','请刷新余额，如未到账请联系客服');
	exit();

}



	$paymentResult = $_POST["paymentResult"];//获取信息

	$xml=simplexml_load_string($paymentResult,'SimpleXMLElement', LIBXML_NOCDATA);
	$ReferenceIDs = $xml->xpath("GateWayRsp/head/ReferenceID");//关联号
	$ReferenceID = $ReferenceIDs[0];//关联号
	$RspCodes = $xml->xpath("GateWayRsp/head/RspCode");//响应编码
	$RspCode=$RspCodes[0];
	$RspMsgs = $xml->xpath("GateWayRsp/head/RspMsg"); //响应说明
	$RspMsg=$RspMsgs[0];
	$ReqDates = $xml->xpath("GateWayRsp/head/ReqDate"); // 接受时间
	$ReqDate=$ReqDates[0];
	$RspDates = $xml->xpath("GateWayRsp/head/RspDate");// 响应时间
	$RspDate=$RspDates[0];
	$Signatures = $xml->xpath("GateWayRsp/head/Signature"); //数字签名
	$Signature=$Signatures[0];
	$MerBillNos = $xml->xpath("GateWayRsp/body/MerBillNo"); // 商户订单号
	$MerBillNo=$MerBillNos[0];
	$CurrencyTypes = $xml->xpath("GateWayRsp/body/CurrencyType");//币种
	$CurrencyType=$CurrencyTypes[0];
	$Amounts = $xml->xpath("GateWayRsp/body/Amount"); //订单金额
	$Amount=$Amounts[0];
	$Dates = $xml->xpath("GateWayRsp/body/Date");    //订单日期
	$Date=$Dates[0];
	$Statuss = $xml->xpath("GateWayRsp/body/Status");  //交易状态
	$Status=$Statuss[0];
	$Msgs = $xml->xpath("GateWayRsp/body/Msg");    //发卡行返回信息
	$Msg=$Msgs[0];
	$Attachs = $xml->xpath("GateWayRsp/body/Attach");    //数据包
	$Attach=$Attachs[0];
	$IpsBillNos = $xml->xpath("GateWayRsp/body/IpsBillNo"); //IPS订单号
	$IpsBillNo=$IpsBillNos[0];
	$IpsTradeNos = $xml->xpath("GateWayRsp/body/IpsTradeNo"); //IPS交易流水号
	$IpsTradeNo=$IpsTradeNos[0];
	$RetEncodeTypes = $xml->xpath("GateWayRsp/body/RetEncodeType");    //交易返回方式
	$RetEncodeType=$RetEncodeTypes[0];
	$BankBillNos = $xml->xpath("GateWayRsp/body/BankBillNo"); //银行订单号
	$BankBillNo=$BankBillNos[0];
	$ResultTypes = $xml->xpath("GateWayRsp/body/ResultType"); //支付返回方式
	$ResultType=$ResultTypes[0];
	$IpsBillTimes = $xml->xpath("GateWayRsp/body/IpsBillTime"); //IPS处理时间
	$IpsBillTime=$IpsBillTimes[0];

	if($RspMsg=='交易成功！') {

	$db->query ( "update user_funds  set status=1 where id='{$MerBillNo}'" );

	$funds=$db->exec("select * from user_funds where  id='{$MerBillNo}'");
if($db->affected_rows()>0)
		online_charge($funds['userid'], $Amount, $funds['remark'],$MerBillNo);

		exit();
	}
	
		

	$pmercode='191811';
	$arrayMer['mercert'] = 'v7tvXWEnjh35PVcjhxY9RAH8S1oaSYTaW4A7TRSQRRYHWudSHAe7AHcExTLCECXZhexTXKfvTAWJW5jf2ff4WG3QxpMjK8VubfhVXsWsFQcmzdvYrdZ8R1DQeCWOjzEY';
	$sbReq = "<body>"
			  . "<MerBillNo>" . $MerBillNo . "</MerBillNo>"
			  . "<CurrencyType>" . $CurrencyType . "</CurrencyType>"
			  . "<Amount>" . $Amount . "</Amount>"
			  . "<Date>" . $Date . "</Date>"
			  . "<Status>" . $Status . "</Status>"
			  . "<Msg><![CDATA[" . $Msg . "]]></Msg>"
			  . "<Attach><![CDATA[" . $Attach . "]]></Attach>"
			  . "<IpsBillNo>" . $IpsBillNo . "</IpsBillNo>"
			  . "<IpsTradeNo>" . $IpsTradeNo . "</IpsTradeNo>"
			  . "<RetEncodeType>" . $RetEncodeType . "</RetEncodeType>"
			  . "<BankBillNo>" . $BankBillNo . "</BankBillNo>"
			  . "<ResultType>" . $ResultType . "</ResultType>"
			  . "<IpsBillTime>" . $IpsBillTime . "</IpsBillTime>"
	          . "</body>";
		$sign=$sbReq.$pmercode.$arrayMer['mercert'];
		$md5sign=  md5($sign);

				//判断签名
	if($RspMsg=='交易成功！' and $MerBillNo==$_SESSION['charge_id'])
	{

		if($_SESSION['billno']!=$MerBillNo  ){
			$_SESSION['billno']=$MerBillNo;
			online_charge($_SESSION['userid'], $Amount, "环讯支付",$MerBillNo);


		}

show_message1('充值成功','请刷新余额，如未到账请联系客服');
exit();


	}
	else
	{
show_message1('充值失败','请重新充值');
exit();
	}












exit();
//
//
//if ($signature_1ocal == $signature)
//{
//
//
//	//----------------------------------------------------
//	//  判断交易是否成功
//	//  See the successful flag of this transaction
//	//----------------------------------------------------
//	if ($succ == 'Y'  and $_SESSION['paymoney']==$amount)
//	{
//		/**----------------------------------------------------
//		*比较返回的订单号和金额与您数据库中的金额是否相符
//		*compare the billno and amount from ips with the data recorded in your datebase
//		*----------------------------------------------------
//
//		if(不等)
//			echo "从IPS返回的数据和本地记录的不符合，失败！"
//			exit
//		else
//			'----------------------------------------------------
//			'交易成功，处理您的数据库
//			'The transaction is successful. update your database.
//			'----------------------------------------------------
//		end if
//		**/
//
//
////echo "<script>alert('恭喜您，充值成功');</script>";
//
//echo "<script>window.location='index.aspx?mod=report&code=recharge';</script>";
//	}
//	else
//	{
//		echo "<script>alert('很抱歉，充值失败');</script>";
//
//echo "<script>window.location='index.aspx?mod=safe&code=recharge';</script>";
//		exit;
//	}
//}
//else
//{
//	echo '签名不正确！';
//	exit;
//}
?>
