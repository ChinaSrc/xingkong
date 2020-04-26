<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<title>公众号支付</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/qrcode.min.js"></script>
</head>
<body>
   <div style="margin:0 auto;width:400px;margin-top:50px;border:solid 1px #efefef;padding:20px;">
    <h2>公众号支付</h2>
    <form method="post" action="mobile.php" >
	   请输入充值金额：<input type="text" name="amt">
	   <input type="hidden" name="orderid" value="<?php echo date('YmdHis',time())?>">
	   <br>
	   <br>
	   <input type="submit" style="margin-left:130px;border:none;background:#036;color:#fff;width:100px;height:30px;line-height:30px;">
	</form>
</div>
</body>