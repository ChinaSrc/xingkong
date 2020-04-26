<?php 
if($_POST){
	
	$list=$db->fetch_all("select * from  game_time where playKey='{$_GET[playkey]}'");
	if($list){
		foreach ($list as $value) {
			
			$arr=array('beginTime','endTime','lotTime');
			foreach ($arr as $value1) {
			$time=	time_to_str(str_to_time($value[$value1])+$_POST[$value1]);
				
			$db->query("update game_time set `{$value1}`='{$time}' where id='{$value['id']}'");
			}
			
			
		}
		
		
	}
		add_adminlog("批量增减开奖时间");
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit();
	
}

?>











<style>
body ,th,td{
	font:normal 12px 宋体; 
}
body  { 
	 margin:0px; text-align:center; 
}
.title{
	text-align:left;height:40px;line-height:40px;padding-left:10px;margin-top:5px;
}
.items{
	text-align:center;height:210px;line-height:20px; margin:0px; padding:5px;overflow:auto;border-top:1px solid #999999;border-bottom:1px solid #999999;
}
.expl{text-align:left;height:20px;line-height:20px;color:#777777;padding-left:10px;}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{
	height:40px;line-height:40px;padding:5px;margin-top:5px;
}
</style> 
<form method="POST" name="form" id="form" action="index.aspx?controller=lottery&action=gametime_update&playkey=<?php echo $_GET['playkey'];?>" > 

<div class='title'>起始时间：<input type='text' id='beginTime' name='beginTime' value='0' style='width:60%'>秒</div>
<div class='title'>封单时间：<input type='text' id='endTime' name='endTime'  value='0' style='width:60%'>秒</div>
<div class='title'>开奖时间：<input type='text' id='lotTime' name='lotTime'  value='0' style='width:60%'>秒</div>
<div class='expl'>提示：不变请填写0，正数表示延期，负数表示提前</div>  
<div class='bottom2'><input type='submit' id='yes_button' value='确定' onclick="put_pop()">　　<input type='button' value='关闭' onclick="close_pop()"></div>

</form>