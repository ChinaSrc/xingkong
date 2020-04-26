<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>微信支付</title>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<meta name="viewport" content="minimal-ui=yes,width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta name="viewport" content="minimal-ui=yes,width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<style type="text/css">

body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #ededed;
	margin: 0;
	padding: 0;
	color: #000;
}
/* ~~ 元素/标签选择器 ~~ */
ul, ol, dl { /* 由于浏览器之间的差异，最佳做法是在列表中将填充和边距都设置为零。为了保持一致，您可以在此处指定所需的数值，也可以在列表包含的列表项（LI、DT 和 DD）中指定所需的数值。请记住，除非编写一个更具体的选择器，否则，在此处进行的设置将层叠到 .nav 列表。 */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* 删除上边距可以解决边距会超出其包含的块的问题。剩余的下边距可以使块与后面的任何元素保持一定距离。 */
	padding-right: 15px;
	padding-left: 15px; /* 向块内的元素侧边（而不是块元素自身）添加填充可避免使用任何方框模型数学。此外，也可将具有侧边填充的嵌套块用作替代方法。 */
}
a img { /* 此选择器将删除某些浏览器中显示在图像周围的默认蓝色边框（当该图像包含在链接中时） */
	border: none;
}
</style>
</head>

    <style type="text/css">
	input {-webkit-appearance:none; /*去除input默认样式*/}
input[type="submit"],

input[type="reset"],

input[type="button"],

input{-webkit-appearance:none;}
a{color:#333;text-decoration:none;}

	 .container{font-family:微软雅黑; }
	 .order{height:30px;line-height:30px;}
	 .price{height:40px;line-height:40px;font-size:2.5em;margin:20px;}
	 .price span{margin-left:20px;font-weight:bolder;}
	 .shop{border-top:solid 1px #dedede;border-bottom:solid 1px #dedede;width:100%;padding:10px 0;background:#fff;font-size:12px;
	 }
	 .btn{
		 width:95%; height:45px; border-radius: 5px;background-color:#25ab28; border:0px #FE6714 solid; cursor: pointer; font-weight:bold;color:white;  font-size:16px;margin-top:20px;
		 }
	</style>
<body>

<div class="container">



		<?php

		$pVersion = 'v1.0.0';//版本号
		$pMerCode = '191811';//商户号
		$pMerName = '深圳市羲美合数码科技有限公司';//商户名
		$pMerCert = 'v7tvXWEnjh35PVcjhxY9RAH8S1oaSYTaW4A7TRSQRRYHWudSHAe7AHcExTLCECXZhexTXKfvTAWJW5jf2ff4WG3QxpMjK8VubfhVXsWsFQcmzdvYrdZ8R1DQeCWOjzEY';//商户证书
		$pAccount  = '1918110014';//账户号
		$pMsgId = "msg".rand(1000,9999);;//消息编号
		$pReqDate = date("Ymdhis");//商户请求时间


		$pMerBillNo = $_GET['charge_id'];//商户订单号
		$pGoodsName = "在线充值";//商品名称
		$pGoodsCount = "";
		$pOrdAmt =$_GET['amount'];//订单金额
		$pOrdTime =date("Y-m-d H:i:s");

		$pMerchantUrl=$_GET['url'];
		$pServerUrl=$_GET['url'];
		$pBillEXP="";
		$pReachBy="";
		$pReachAddress="";
		$pCurrencyType="156";
		$pAttach=$_REQUEST['orderid'];
		$pRetEncodeType="17";
		?>


		<div align="center" style="margin-top:50px;">
        <div class="order">订单号：<?php echo $pMerBillNo;?></div>
        <div class="price">¥<span><?php echo $pOrdAmt;?></span></div>
        <div class="shop">
         <table align="center" width="95%">
          <tr><td style="color:#888">收款方</td><td align="right">微信支付</td></tr>
         </table>
        </div>

		<?php

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

		$payLinks= '<form style="text-align:center;" action="https://thumbpay.e-years.com/psfp-webscan/onlinePay.do" target="_self" style="margin:0px;padding:0px" method="post" name="ips" >';

        $payLinks  .= "<input type='hidden' name='wxPayReq' value='$strsubmitxml' />";

		$payLinks .= "<input class='btn' type='submit' value='确认支付'></form><script>document.ips2.submit();</script>";

		echo $payLinks;



?>

	</div>

</div>

</body>
</html>
