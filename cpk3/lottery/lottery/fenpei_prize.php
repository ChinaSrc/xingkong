<style>
div{font-size:12px;line-height:30px;text-align:center;}
</style>
<div style="display:none">
<?php
 
if($_POST){
	$id=$_POST['id'];
	
	$playkey=$_POST['playkey'];
	$period=$_POST['period'];
	include_once 'do/Ajax_Prize_Lot.php';
    include_once 'do/Ajax_fenpei_Prize.php';
	add_adminlog("手动分配奖金");
	

}


?>
</div>

<?php if($_POST){
	
	echo "<div>派奖成功！</div>";
	echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
	exit();	
	
}?>

<form action="index.aspx?controller=lottery&action=fenpei_prize" method="post" name="form1" id="form1">
<input type="hidden" name='id' value="<?php echo $_GET['id'];?>">
<input type="hidden" name='playkey' value="<?php echo $_GET['playkey'];?>">
<input type="hidden" name='period' value="<?php echo $_GET['period'];?>">
<div>确定的派奖？</div>
<div class='bottom2'><input type='submit' id='yes_button' value='确定'>　　<input type='button' value='取消' onclick="parent.pop.close();"></div>
</form>