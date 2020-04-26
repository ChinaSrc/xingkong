<?php

		$pVersion = 'v1.0.0';//版本号
		$pMerCode = '183337';//商户号
		$pMerName = '';//商户名
		$pMerCert = 'AAUAlZToAxmDg4QTNUUrJVNYGUZDYWBH92ysh3Wwb2g04V2yj9CQhX8aSefqOgKYk7G67eTJj7dXoPyGpj7HHFMyRlgRETbh3nfGMZJSAA9NUR9Juj8vn6VAB9Km3DgH';//商户证书
		$pAccount  = '1833370016';//账户号
		$pMsgId = "msg".rand(1000,9999);;//消息编号
		$pReqDate = date("Ymdhis");//商户请求时间

		
		$pMerBillNo = date("Ymdhis").rand(1000,9999);//商户订单号
		$pGoodsName = "recharge";//商品名称
		$pGoodsCount = "";
		$pOrdAmt = 1;//订单金额 
		$pOrdTime =date("Y-m-d H:i:s");
	
		$pMerchantUrl='http://'.$_SERVER['HTTP_HOST'].'/result.php';
		$pServerUrl='http://'.$_SERVER['HTTP_HOST'].'/result.php';
		$pBillEXP="";
		$pReachBy="";
		$pReachAddress="";
		$pCurrencyType="156";
		$pAttach="";
		$pRetEncodeType="17";
		

	    
		$strbodyxml= "<body>"
					."<MerBillno>".$pMerBillNo."</MerBillno>"
					."<GoodsInfo>"
					."<GoodsName>".$pGoodsName."</GoodsName>"
					."<GoodsCount >".$pGoodsCount."</GoodsCount>"
					."</GoodsInfo>"
					."<OrdAmt>".$pOrdAmt."</OrdAmt>"
					."<OrdTime>".$pOrdTime."</OrdTime>"
					."<MerchantUrl>".$pMerchantUrl."</MerchantUrl>"
					."<ServerUrl>".$pServerUrl."</ServerUrl>"
					."<BillEXP>".$pBillEXP."</BillEXP>"
					."<ReachBy>".$pReachBy."</ReachBy>"
					."<ReachAddress>".$pReachAddress."</ReachAddress>"
					."<CurrencyType>".$pCurrencyType."</CurrencyType>"
					."<Attach>".$pAttach."</Attach>"
					."<RetEncodeType>".$pRetEncodeType."</RetEncodeType>"
					."</body>";

	   
		  
		  $Sign=$strbodyxml.$pMerCode.$pMerCert;//签名明文
		  //file_put_contents(PATH_LOG_FILE,date('y-m-d h:i:s').'签名明文:'.$Sign."\r\n",FILE_APPEND);
		  
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
					  ."<WxPayReq>"
					  .$strheaderxml
					  .$strbodyxml
				  ."</WxPayReq>"
				  ."</Ips>";
					
	

		//提交给网关明文
		 //file_put_contents(PATH_LOG_FILE,date('y-m-d h:i:s').'提交给网关明文:'.$strsubmitxml."\r\n",FILE_APPEND);
		 
		$payLinks = '<form style="text-align:center;" action="https://thumbpay.e-years.com/psfp-webscan/onlinePay.do" target="_self" style="margin:0px;padding:0px" method="post" name="ips" >';

        $payLinks  .= "<input type='hidden' name='wxPayReq' value='$strsubmitxml' />";
       
		$payLinks .= "<input type='submit'></form><script>document.ips2.submit();</script>";
       
		echo $payLinks;



?>