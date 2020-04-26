<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

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
			 
			 
	$pmercode='185473';	
	$arrayMer['mercert'] = 'd3MoFfWu8FT0emU8kkhuAsUoEjxgWCO8M430p8D6u33O20plffgtmXbZtbUYCXftNoXZwwqaEcKtWvsWXwfPuNT8GHGFOCn6gAvOUcWENShz0gU0BUHkme3PGXMUBPln';
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
	if($Signature==$md5sign)
	{
		if($RspCode=='000000')
		{
			
			require_once 'fun.php';
			Change($Attach,$Amount);
			echo "Success";

            $msg = "<br>充值成功<br>充值金额:".$Amount."<br>订单号:".$Attach;
	
			echo $msg;
					
		}			
	}
	else
	{
			
		echo "Failed";
		die();
	}


?>