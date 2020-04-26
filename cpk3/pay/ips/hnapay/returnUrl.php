<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pay Page</title>
</head>
<body>
<form name="receiveNotificationForm">

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

      //商户进行必要的后续处理： 如果"验签成功"（即 $ret2的值为1），则进一步处理商户对应的业务逻辑（要注意并发控制，并避免在接收后台通知时重复处理）； 如果"验签失败"，商户检查原因，或者与新生支付支持人员联系。
      
      
	?>

	<input type="hidden" id="result"  value="<?php echo $ret2?>">	

	<script type="text/javascript">
		alert(document.getElementById("result").value == "1" ? "验签成功。" : "验签失败！");
	</script>

	<center>
			<h2>商户接收支付结果前台通知</h2>
			<table border="1" width="60%">
				<tr>
					<td width="15%" align="right">商户订单号：</td>
					<td align="left">
						<?php echo $_REQUEST['orderID'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">处理结果码：</td>
					<td align="left">
						<?php echo $_REQUEST['resultCode'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">状态码：</td>
					<td align="left">
						<?php echo $_REQUEST['stateCode'] ?>
					 </td>
				</tr>	
				<tr>
					<td width="15%" align="right">商户订单金额：</td>
					<td align="left">
						<?php echo $_REQUEST['orderAmount'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">实际支付金额：</td>
					<td align="left">
						<?php echo $_REQUEST['payAmount'] ?>
					 </td>
				</tr>				
				<tr>
					<td width="15%" align="right">收单时间：</td>
					<td align="left">
						<?php echo $_REQUEST['acquiringTime'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">处理完成时间：</td>
					<td align="left">
						<?php echo $_REQUEST['completeTime'] ?>
					 </td>
				</tr>				
				<tr>
					<td width="15%" align="right">支付流水号：</td>
					<td align="left">
						<?php echo $_REQUEST['orderNo'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">商户ID：</td>
					<td align="left">
						<?php echo $_REQUEST['partnerID'] ?>
					 </td>
				</tr>							
				<tr>
					<td width="15%" align="right">扩展字段：</td>
					<td align="left">
						<?php echo $_REQUEST['remark'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">编码方式：</td>
					<td align="left">
						<?php echo $_REQUEST['charset'] ?>
					 </td>
				</tr>						
				<tr>
					<td width="15%" align="right">签名类型：</td>
					<td align="left">
						<?php echo $_REQUEST['signType'] ?>
					 </td>
				</tr>
				<tr>
					<td width="15%" align="right">签名字符串：</td>
					<td align="left">
						<?php echo $_REQUEST['signMsg'] ?>
					 </td>
				</tr>			
				<tr>
					<td width="15%" align="right">验签结果：</td>
					<td align="left" style='color:<?php echo 1 == $ret2 ?  "blue" : "red" ?>;'>
					  <?php echo 1 == $ret2 ? "验签成功。" : "验签失败！" ?>
					</td>
				</tr>							
			</table>
	</center>		
	
</form>

</body>
</html>
