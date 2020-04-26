<?php

		$pVersion = 'v1.0.0';//版本号
		$pMerCode = '191811';//商户号
		$pMerName = $_GET['userid'];//商户名
		$pMerCert = 'v7tvXWEnjh35PVcjhxY9RAH8S1oaSYTaW4A7TRSQRRYHWudSHAe7AHcExTLCECXZhexTXKfvTAWJW5jf2ff4WG3QxpMjK8VubfhVXsWsFQcmzdvYrdZ8R1DQeCWOjzEY';//商户证书
		$pAccount  = '1918110014';//账户号
		$pMsgId = "msg".rand(1000,9999);;//消息编号
		$pReqDate = date("Ymdhis");//商户请求时间

		$pMerBillNo = $_GET['charge_id'];//商户订单号
		//$pAmount = $_POST['p3_Amt'];//订单金额
		$pAmount =$_GET['amount'];
		$pDate = date("Ymd");//订单日期
		$pCurrencyType = 'GB';//币种
		$pGatewayType = '01';//支付方式
		$pLang = '156';//语言
		$pMerchanturl = $_GET['url'];//支付结果成功返回的商户URL
		$pFailUrl = "";//支付结果失败返回的商户URL
		$pAttach = $_POST['p2_Order'];//商户数据包
		$pOrderEncodeTyp = '5';//订单支付接口加密方式 默认为5#md5
		$pRetEncodeType = '17';//交易返回接口加密方式
		$pRetType = '1';//返回方式
		$pServerUrl =$_GET['url'];//Server to Server返回页面
		$pBillEXP = 1;//订单有效期(过期时间设置为1小时)
		$pGoodsName ='在线充值';//商品名称
		$pIsCredit = 1;//直连选项
		$pBankCode = $_GET['bankid'];//银行号
		$pProductType= '1';//产品类型
		 if($pIsCredit==0)
		 {
			 $pBankCode="";
			 $pProductType='';
		 }

		 //请求报文的消息体
		  $strbodyxml= "<body>"
					 ."<MerBillNo>".$pMerBillNo."</MerBillNo>"
					 ."<Amount>".$pAmount."</Amount>"
					 ."<Date>".$pDate."</Date>"
					 ."<CurrencyType>".$pCurrencyType."</CurrencyType>"
					 ."<GatewayType>".$pGatewayType."</GatewayType>"
						 ."<Lang>".$pLang."</Lang>"
					 ."<Merchanturl>".$pMerchanturl."</Merchanturl>"
					 ."<FailUrl>".$pFailUrl."</FailUrl>"
						 ."<Attach>".$pAttach."</Attach>"
						 ."<OrderEncodeType>".$pOrderEncodeTyp."</OrderEncodeType>"
						 ."<RetEncodeType>".$pRetEncodeType."</RetEncodeType>"
						 ."<RetType>".$pRetType."</RetType>"
						 ."<ServerUrl>".$pServerUrl."</ServerUrl>"
						 ."<BillEXP>".$pBillEXP."</BillEXP>"
						 ."<GoodsName>".$pGoodsName."</GoodsName>"
						 ."<IsCredit>".$pIsCredit."</IsCredit>"
						 ."<BankCode>".$pBankCode."</BankCode>"
						 ."<ProductType>".$pProductType."</ProductType>"
				  ."</body>";

		  $Sign=$strbodyxml.$pMerCode.$pMerCert;//签名明文
		 // file_put_contents(PATH_LOG_FILE,date('y-m-d h:i:s').'签名明文:'.$Sign."\r\n",FILE_APPEND);

		  $pSignature = md5($strbodyxml.$pMerCode.$pMerCert);//数字签名
		  //请求报文的消息头
		  $strheaderxml= "<head>"
						   ."<Version>".$pVersion."</Version>"
						   ."<MerCode>".$pMerCode."</MerCode>"
						   ."<MerName>".$pMerName."</MerName>"
						   ."<Account>".$pAccount."</Account>"
						   ."<MsgId>".$pMsgId."</MsgId>"
						   ."<ReqDate>".$pReqDate."</ReqDate>"
						   ."<Signature>".$pSignature."</Signature>"
					  ."</head>";

		//提交给网关的报文
		$strsubmitxml =  "<Ips>"
					  ."<GateWayReq>"
					  .$strheaderxml
					  .$strbodyxml
				  ."</GateWayReq>"
					."</Ips>";

		//提交给网关明文
		 //file_put_contents(PATH_LOG_FILE,date('y-m-d h:i:s').'提交给网关明文:'.$strsubmitxml."\r\n",FILE_APPEND);

		$payLinks = '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form style="text-align:center;" action="http://newpay.ips.com.cn/psfp-entry/gateway/payment.html" target="_self" style="margin:0px;padding:0px" method="post" name="ips" >';

        $payLinks  .= "<input type='hidden' name='pGateWayReq' value='$strsubmitxml' />";

		$payLinks .= "</form><script>document.ips.submit();</script>";

		echo $payLinks;



?>