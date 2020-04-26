<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pay Page</title>
</head>
<body>
<form name="noticeUrlHdlForm">

	<?php 
	
			$orderID = $_REQUEST["orderID"];
			$resultCode = $_REQUEST["resultCode"];
			$stateCode = $_REQUEST["stateCode"];
			$orderAmount = $_REQUEST["orderAmount"];
			$payAmount = $_REQUEST["payAmount"];
			$acquiringTime = $_REQUEST["acquiringTime"];
			$completeTime = $_REQUEST["completeTime"];
			$orderNo = $_REQUEST["orderNo"];
			$partnerID = $_REQUEST["partnerID"];
			$remark = $_REQUEST["remark"];
			$charset = $_REQUEST["charset"];
			$signType = $_REQUEST["signType"];
			$signMsg = $_REQUEST["signMsg"];
			$src = "orderID=".$orderID."&resultCode=".$resultCode."&stateCode=".$stateCode."&orderAmount=".$orderAmount."&payAmount=".$payAmount."&acquiringTime=".$acquiringTime."&completeTime=".$completeTime."&orderNo=".$orderNo."&partnerID=".$partnerID."&remark=".$remark."&charset=".$charset."&signType=".$signType;

			if($_REQUEST["charset"] == 1)
				$charset = "UTF8";

			if(2 == $signType) //md5验签
			{
				$pkey = "30819f300d06092a864886f70d010101050003818d0030818902818100af48db8f2aa0f029aa3fadfcf749267566544d2ce25738df295d94bb918542421f2b649e533db53553a3e9a4bd860068b759af4681d96f4732e47b4653b93339e68b7ef00e2cef3ab8ec5e9c65d4c7992f626c1f4b9a95a626d005fce59919ae1b619748194256ec4627a932d75b8f9fb51c3a78bfbc53bcc0bbb4924d59c6310203010001";
				$src = $src."&pkey=".$pkey;
				$ret2 = ($signMsg == md5($src));
			}

			//记录接收到的参数到服务器本地文件
	    @$fp = fopen("noticeLog.txt","w");
	    
	    if(!$fp){
	        echo "system error";
	        exit();
	    }else {
	        $fileData = "orderID：".$_REQUEST['orderID']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "resultCode：".$_REQUEST['resultCode']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "stateCode：".$_REQUEST['stateCode']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "orderAmount：".$_REQUEST['orderAmount']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "payAmount：".$_REQUEST['payAmount']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "acquiringTime：".$_REQUEST['acquiringTime']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "completeTime：".$_REQUEST['completeTime']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "orderNo：".$_REQUEST['orderNo']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "partnerID：".$_REQUEST['partnerID']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "remark：".$_REQUEST['remark']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "charset：".$_REQUEST['charset']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "signType：".$_REQUEST['signType']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "signMsg：".$_REQUEST['signMsg']."\r\n";
	        fwrite($fp,$fileData);
	        $fileData = "验签结果：".(1 == $ret2 ? "验签成功。" : "验签失败！");
	        fwrite($fp,$fileData);	        
	        fclose($fp);
	    }
	    
	    //商户进行必要的后续处理： 如果"验签成功"（即 $ret2的值为1），则进一步处理商户对应的业务逻辑（要注意并发控制，并避免在接收前台通知时重复处理）； 如果"验签失败"，商户检查原因，或者与新生支付支持人员联系。

			
	?>
	
</form>

</body>
</html>
