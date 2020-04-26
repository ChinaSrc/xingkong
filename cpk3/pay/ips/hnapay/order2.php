
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pay Page</title>
</head>
<body>
<form action="<?php echo $_REQUEST['URL'] ?>" method="post" name="orderForm">
	<input type="hidden" name="version"  value="<?php echo $_REQUEST['version'] ?>"> 	
	<input type="hidden" name="serialID"  value="<?php echo $_REQUEST['serialID'] ?>">
	<input type="hidden" name="submitTime"  value="<?php echo $_REQUEST['submitTime'] ?>">
	<input type="hidden" name="failureTime"  value="<?php echo $_REQUEST['failureTime'] ?>">
	<input type="hidden" name="customerIP"  value="<?php echo $_REQUEST['customerIP'] ?>">
	<input type="hidden" name="orderDetails"  value="<?php echo $_REQUEST['orderDetails'] ?>">
	<input type="hidden" name="totalAmount"  value="<?php echo $_REQUEST['totalAmount'] ?>">
	<input type="hidden" name="type"  value="<?php echo $_REQUEST['type'] ?>">
	<input type="hidden" name="buyerMarked"  value="<?php echo $_REQUEST['buyerMarked'] ?>">
	<input type="hidden" name="payType"  value="<?php echo $_REQUEST['payType'] ?>">
	<input type="hidden" name="orgCode"  value="<?php echo $_REQUEST['orgCode'] ?>">
	<input type="hidden" name="currencyCode"  value="<?php echo $_REQUEST['currencyCode'] ?>">
	<input type="hidden" name="directFlag"  value="<?php echo $_REQUEST['directFlag'] ?>">
	<input type="hidden" name="borrowingMarked"  value="<?php echo $_REQUEST['borrowingMarked'] ?>">
	<input type="hidden" name="couponFlag"  value="<?php echo $_REQUEST['couponFlag'] ?>">
	<input type="hidden" name="platformID"  value="<?php echo $_REQUEST['platformID'] ?>">
	<input type="hidden" name="returnUrl"  value="<?php echo $_REQUEST['returnUrl'] ?>">
	<input type="hidden" name="noticeUrl"  value="<?php echo $_REQUEST['noticeUrl'] ?>">
	<input type="hidden" name="partnerID"  value="<?php echo $_REQUEST['partnerID'] ?>">
	<input type="hidden" name="remark"  value="<?php echo $_REQUEST['remark'] ?>">

	<?php 
		if($_REQUEST['charset'] == 1)
			$charset = "UTF8";
	?>


	<input type="hidden" name="charset"  value="<?php echo $_REQUEST['charset'] ?>">
	
	<?php
			$signType = $_REQUEST['signType'];
			$signMsg = $_REQUEST['signMsg'];

		
			if(2 == $signType)
			{
				$pkey = "30819f300d06092a864886f70d010101050003818d0030818902818100af48db8f2aa0f029aa3fadfcf749267566544d2ce25738df295d94bb918542421f2b649e533db53553a3e9a4bd860068b759af4681d96f4732e47b4653b93339e68b7ef00e2cef3ab8ec5e9c65d4c7992f626c1f4b9a95a626d005fce59919ae1b619748194256ec4627a932d75b8f9fb51c3a78bfbc53bcc0bbb4924d59c6310203010001";

				$signMsg = $signMsg."&pkey=".$pkey;
				$signMsg =  md5($signMsg);
			}
	

	?>

	<input type="hidden" name="signType"  value="<?php echo $signType ?>">
	<input type="hidden" name="signMsg"   value="<?php echo $signMsg ?>">

</form>

<script type="text/javascript">

  document.orderForm.submit();

</script>
</body>
</html>