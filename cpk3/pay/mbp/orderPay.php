<?php



 	require_once("Mobaopay.Config.php");
	$time		= time();
	$orderNo	= date("YmdHis",$time);
	$tradeDate	= date("Ymd",$time); 
	$BillNo = date('YmdHis') . mt_rand(100000,999999);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>摩宝支付商户接口范例-支付</title>
    <!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="Styles/mobaopay.css" type="text/css" rel="stylesheet" />
	-->
</head>
<body runat="server">


    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #107929;display:none;">
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
              
                    <tr>
                        <td height="30" colspan="2" bgcolor="#6BBE18">
                            <span style="color: #FFFFFF"><a href="index.aspx">感谢您使用摩宝支付平台</a></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" bgcolor="#CEE7BD">
                            摩宝支付订单支付请求接口演示：
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form method="post" action="pay.aspx" id="from1">
                            <table>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;订单号
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="orderNo" id="orderNo" 
										value='<?php echo $BillNo; ?>' />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易日期
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="tradeDate" id="tradeDate" 
										value='<?php echo $tradeDate; ?>' />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易金额
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="amt" id="amt" value="<?php echo $_GET['amount']?>" />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;银行
									</td>
									<td align="left" width="30%">
										&nbsp;&nbsp;
										<select style="WIDTH:330px" type="text"  name= "bankcode" id="bankcode">
											   <?php
											   foreach($bankcode as $key => $value ) {
											   	echo "<option>$value</option>";
											   	}
											   	?>
											</select> 
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;商户参数
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="merchParam" id="merchParam" value="<?php echo  $_SESSION['user_name'];?>" />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易摘要
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="tradeSummary" id="tradeSummary" value=""<?php echo  $_SESSION['user_name'];?>" />
									</td>
								</tr>
                                <tr>
                                    <td align="left">
                                        &nbsp;
                                    </td>
                                    <td align="left">
                                        &nbsp;&nbsp;<input type="submit" value="马上支付" />
                                    </td>
                                </tr>
                            </table>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td height="5" bgcolor="#6BBE18" colspan="2">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    
    <div style='width:100%;height:80px;line-height:80px;text-align:center;'>正在跳转到支付页面，请稍后......</div>
    
    <script>
    
    document.getElementById('from1').submit();
    </script>
    
    
</body>
</html>
