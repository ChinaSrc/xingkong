<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

	$paymentResult = $_POST["paymentResult"];//获取信息
	
	//$paymentResult ="<Ips><WxPayRsp><head><RspCode>000000</RspCode><RspMsg><![CDATA[交易成功！]]></RspMsg><ReqDate>20161105161540</ReqDate><RspDate>20161105162511</RspDate><Signature>035f55865e11b1324189ad8b028ff51a</Signature></head><body><MerBillno>20161105161549</MerBillno><MerCode>183418</MerCode><Account>1834180018</Account><IpsBillno>20161105161540086165</IpsBillno><IpsBillTime>2016-11-05 08:15:48</IpsBillTime><OrdAmt>0.01</OrdAmt><Status>Y</Status><RetEncodeType>17</RetEncodeType></body></WxPayRsp></Ips>";
	$xml=simplexml_load_string($paymentResult,'SimpleXMLElement', LIBXML_NOCDATA); 
	
	//file_put_contents("log3.txt","[OrginData]".$paymentResult."\r\n",FILE_APPEND);
	
    
	$RspCodes = $xml->xpath("WxPayRsp/head/RspCode");//响应编码
	$RspCode=$RspCodes[0];
	$RspMsgs = $xml->xpath("WxPayRsp/head/RspMsg"); //响应说明
	$RspMsg=$RspMsgs[0];
	$ReqDates = $xml->xpath("WxPayRsp/head/ReqDate"); // 接受时间
	$ReqDate=$ReqDates[0];
	$RspDates = $xml->xpath("WxPayRsp/head/RspDate");// 响应时间
	$RspDate=$RspDates[0];
	$Signatures = $xml->xpath("WxPayRsp/head/Signature"); //数字签名
	$Signature=$Signatures[0];
	
	
	//print_r($xml->xpath("WxPayRsp/body"));exit;

	
	$MerBillNos = $xml->xpath("WxPayRsp/body/MerBillno"); // 商户订单号
	$MerBillNo=$MerBillNos[0];
	

	
	$MerCodes = $xml->xpath("WxPayRsp/body/MerCode"); // 商户订单号
	$MerCode=$MerCodes[0];
	
	$Accounts = $xml->xpath("WxPayRsp/body/Account"); // 商户订单号
	$Account=$Accounts[0];
	
	
	
	$IpsBillNos = $xml->xpath("WxPayRsp/body/IpsBillno"); //IPS订单号
	$IpsBillNo=$IpsBillNos[0];
	
	$IpsBillTimes = $xml->xpath("WxPayRsp/body/IpsBillTime"); //IPS处理时间
	$IpsBillTime=$IpsBillTimes[0];
	
	$OrdAmts = $xml->xpath("WxPayRsp/body/OrdAmt"); //订单金额
	$OrdAmt=$OrdAmts[0];
	
	$RetEncodeTypes = $xml->xpath("WxPayRsp/body/RetEncodeType");    //交易返回方式
	$RetEncodeType=$RetEncodeTypes[0];
	
	$Statuss = $xml->xpath("WxPayRsp/body/Status");    //交易返回方式
	$Status=$Statuss[0];
	
	 
	$pmercode='185473';	
	$arrayMer['mercert'] = 'd3MoFfWu8FT0emU8kkhuAsUoEjxgWCO8M430p8D6u33O20plffgtmXbZtbUYCXftNoXZwwqaEcKtWvsWXwfPuNT8GHGFOCn6gAvOUcWENShz0gU0BUHkme3PGXMUBPln';

			$sbReq= "<body>"
					."<MerBillno>".$MerBillNo."</MerBillno>"
					."<MerCode>".$MerCode."</MerCode>"
					."<Account>".$Account."</Account>"
					."<IpsBillno>".$IpsBillNo."</IpsBillno>"
					."<IpsBillTime>".$IpsBillTime."</IpsBillTime>"
					."<OrdAmt>".$OrdAmt."</OrdAmt>"
					."<Status>".$Status."</Status>"
					."<RetEncodeType>".$RetEncodeType."</RetEncodeType>"
					."</body>";
					
				
				//file_put_contents("log3.txt","[GetData]".$sbReq."\r\n",FILE_APPEND);
				
					
		$sign=$sbReq.$pmercode.$arrayMer['mercert'];

		$md5sign=  md5($sign);
		
		//file_put_contents("log3.txt","[Sign]".$md5sign."\r\n",FILE_APPEND);
		//判断签名
	if($Signature==$md5sign)
	{
		if($Status=='Y')
		{
			//file_put_contents("log4.txt","[SUCCESS]ipscheckok\r\n",FILE_APPEND);
            echo "ipscheckok";				
			require_once("fun.php");
			$alist = explode("_",$MerBillNo);
			Change($alist[1],$OrdAmt);
					
		}
		else{
		    echo "test";
		}
	}
	else
	{
			
		echo "Failed";
		die();
	}


?>