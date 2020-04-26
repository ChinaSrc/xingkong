<?php
 
if($_POST){
	
	
	$list=	$db->fetch_all("select * from game_buylist where playkey='{$_POST[playkey]}' and period='{$_POST[period]}'");

	if($list){
		
		foreach ($list as $value) {
			game_back($value['id']);
		}
		
		
	}
	add_adminlog("手动撤单");
	$next_url="index.aspx?controller=project&action=index&active=bet&time=no&playkey={$_POST['playkey']}&period={$_POST['period']}";
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>手动撤单成功</font></div>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";	
echo "<script>parent.location.href='{$next_url}'</script>";
exit();
}

?>
<style>
div{font-size:12px;line-height:30px;text-align:center;}
</style>
 
     <form method="POST" action="<?php echo ROOT_URL."/".$AdminPath;?>/?controller=lottery&action=lottery_back" name="form1" id="form1"> 

<input name='playkey' type="hidden"  value='<?php echo $_GET['playkey'];?>'>
<input name='period' type="hidden"  value='<?php echo $_GET['period'];?>'>

 <div>确定第<?php echo $_GET['period'];?>期撤单？</div>
<div class='bottom2'><input type='submit' id='yes_button'  value='确定'>　　
<input type='button' value='取消' onclick="parent.pop.close();"></div>
 
   
    
  </form>

</body>