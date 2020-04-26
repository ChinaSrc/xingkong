<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>微信收银台</title>
<link id="linkWebCss" href="images/pay/wxpay/css/Web.min.css" rel="stylesheet">
<link id="linkWeixinCss" href="images/pay/wxpay/css/Weixin.css" rel="stylesheet">
<link id="linkPaymentDialogCss" href="images/pay/wxpay/css/PaymentDialog.css" rel="stylesheet">
</head>
<?php
		header('Content-Type: text/html; charset=UTF-8');
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
		$pVersion = 'v1.0.0';//版本号
			$pMerCode = '191811';//商户号
		$pMerName = '深圳市羲美合数码科技有限公司';//商户名
		$pMerCert = 'v7tvXWEnjh35PVcjhxY9RAH8S1oaSYTaW4A7TRSQRRYHWudSHAe7AHcExTLCECXZhexTXKfvTAWJW5jf2ff4WG3QxpMjK8VubfhVXsWsFQcmzdvYrdZ8R1DQeCWOjzEY';//商户证书
		$pAccount  = '1918110014';//账户号
		$pMsgId = "msg".rand(1000,9999);;//消息编号
		$pReqDate = date("Ymdhis");//商户请求时间

		$pMerBillNo		 =		$_GET['charge_id'];//商户订单号
		$pGatewayType	 =	'10';//10微信  11支付宝
		$pDate			 =	date("Ymd");//订单日期
		$pCurrencyType	 =	'156';
		$pAmount		 =	$_GET['amount'];//订单金额
		$pLang			 =	'GB';
		$pAttach		 =	'';//商户数据包
		$pRetEncodeType	 =	'17';
		$pServerUrl		 =	$_GET['url'];;
		$pBillEXP		 =	'2';
		$pGoodsName		 =	'在线充值';//商品名称
		$pRemark		 =	'';

		$strbodyxml= "<body>"
					 ."<MerBillNo>".$pMerBillNo."</MerBillNo>"
					 ."<GatewayType>".$pGatewayType."</GatewayType>"
					 ."<Date>".$pDate."</Date>"
					 ."<CurrencyType>".$pCurrencyType."</CurrencyType>"
					 ."<Amount>".$pAmount."</Amount>"
					 ."<Lang>".$pLang."</Lang>"
					 ."<Attach>".$pAttach."</Attach>"
					 ."<RetEncodeType>".$pRetEncodeType."</RetEncodeType>"
					 ."<ServerUrl>".$pServerUrl."</ServerUrl>"
					 ."<BillEXP>".$pBillEXP."</BillEXP>"
					 ."<GoodsName>".$pGoodsName."</GoodsName>"
				  ."</body>";

		  $Sign=$strbodyxml.$pMerCode.$pMerCert;


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
		//echo $strsubmitxml;exit;
		$client = new SoapClient("https://thumbpay.e-years.com/psfp-webscan/services/scan?wsdl");
		$return = $client->scanPay($strsubmitxml);
		//echo $return;exit;
		$xml=simplexml_load_string($return,'SimpleXMLElement', LIBXML_NOCDATA);

		$QrCodes = $xml->xpath("GateWayRsp/body/QrCode"); // 商户订单号
		if(!$QrCodes)
		{
			die("<span style='font-size:16px;'>系统异常，请稍后支付！</span>");
		}
		$QrCode=$QrCodes[0];
		if(!$QrCode)
		{
			die("<span style='font-size:16px;'>系统异常2，请稍后支付！</span>");
		}

?>
<body>
<form id="form1" name="form1" method="post" action="">
            <div id="divTitle" class="Header">
                <div class="Wrap1000">
                    <div class="Logo">
                        &nbsp;微信收银台
                    </div>
                </div>
            </div>
            <div id="divLine" style="border-bottom: 3px solid #A2AABB; margin-top: 10px;">
            </div>
            <div id="div1000" class="Wrap1000">
                <div>
                    <div id="IsShowBillInfo" class="divShow">
                        <div>
                            <span class="Hint">
                                请您尽快扫支付码，以便订单及时处理！
                            </span>
                            <span class="Contant">
                                应付金额：
                                <span>
                                    <?php echo $pAmount;?>
                                </span>
                                元
                            </span>
                            <br>
                            <span class="Sum">
                                请您在提交订单后
                                <span style="color: #f60; font-weight: bold;">
                                    5分钟
                                </span>
                                内完成支付，否则订单会自动取消。
                            </span>
                        </div>
                        <br>
                        <ul class="billInfo">
                            <li>
                                订单号:：<?php
echo $pMerBillNo;
?>                         </li>
                            <li>
                                充值用户:<?php echo $_GET["userid"];?>
                            </li>
                            <li>
                                订单时间：<?php
echo " " . date("Y-m-d H:i:s");
?>                         </li>
                            <li>
                                商品名称:充值
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="width: 100%;">
                    <div id="divQRCode" class="divQRCode">
                        <div style="width: 215px;height: 215px;margin: 48px auto 10px;">
						<img src="http://pan.baidu.com/share/qrcode?w=150&h=150&url=<?=$QrCode ?>"  width='215' height="215">
                        </div>
                        <div style="text-align:center;font-weight: bold;font-size:16px;color:Red;">
                            如有疑问，请联系客服
                        </div>
                    </div>
                    <div id="imgQRCode" class="codeImg">
                        请使用微信扫一扫，扫描二维码支付
                    </div>
                    <br>
                    <div id="divHasPay" class="divHasPay" style="">
                    </div>
                    <div id="line" class="divLine">
                    </div>
                    <img src="images/pay/wxpay/images/wx_smsyt.jpg" id="imgExample" alt="微信扫码示意图" style="margin-right: 95px;">
                </div>
            </div>
        <div class="dlgMask">
        </div>
        <div class="pay-dialog">
            <div class="dlg-head">
            </div>
            <div class="dlg-body">
                <div>
                </div>
                <div>
                </div>
            </div>
            <div class="dlg-foot">
            </div>
        </div>
    </body>
    </form>

    		 <script>

function  get_next(){
	if(window.ActiveXObject){
		var xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		var xmlHttp = new XMLHttpRequest();
	}

	xmlHttp.open('GET',"/index_payreturn.html<?php echo "?type=getshow&id=".$pMerBillNo;?>&rand="+Math.random(),true);
	xmlHttp.onreadystatechange=function(){


		var msg=xmlHttp.responseText;

if(msg==1) {


	location.href='/index_payreturn.html?return=success';
}


	};
	xmlHttp.send(null);

}
get_next();
		setInterval(function(){get_next();} , 5000);

		</script>

</html>