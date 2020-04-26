<style>
div{font-size:12px;line-height:30px;text-align:center;}
</style>
<div >


<?php
 
if($_POST){

	$type=$_POST['type'];
	$userid=$_SESSION['userid'];
	
	$row=$db->fetch_first("select * from user_url where userid='{$userid}' and `type`='{$type}'");
	if($row){
		echo "<div>您已经生成过了！</div>";
	//echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
	exit();		
		
		
	}
	else{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWSYZ";
$thisstr = "";
$nextstr = "";
for($j=0;$j<10;$j++){$thisstr.= substr($str,rand(0,25),1);}
for($j=0;$j<5;$j++){$nextstr.= substr($str,rand(0,25),1);}
$url=SZS_ROOT_URL."index.aspx?mod=reg&id=joyin_".$thisstr."_".hexEncode($userid."_".$type);

//$url=bdUrlAPI(1, $url);
		$now=time();
		$db->query("insert into user_url(userid,url,type,time) values('{$userid}','{$url}','{$type}','{$now}')");
		if($db->affected_rows()>0){
			
				echo "<div>推广链接生成成功！</div>";
	echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
	exit();		
			
		}
		
		else{
							echo "<div>推广链接生成失败！</div>";
	//echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
	exit();
			
			
		}
		
	}
	
	

}


?>


<?php if($_POST){
	

	
}?>

</div>
