<? header("content-Type: text/html; charset=UTF-8");?>
<?php
	require_once 'fun.php';
	
	$orderid =$_REQUEST['orderId'];
	
	echo QueryOrder($orderid);
	
?>