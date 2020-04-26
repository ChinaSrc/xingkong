<?php
include('config.php');
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$key=$_GET['key'];

if($_POST){

    $begin=str_to_time($_POST['begintime']);
     $end=str_to_time($_POST['endtime']);

$playKey=$_POST['key'];

//$sum=($end-$begin)/60/$_POST['bytime'];

if($playKey){
$wei=$_POST['wei'];

if($_POST['del']==1)		
$db->query("delete from game_time where playKey='{$playKey}'");

	if(!$_POST['cha'])$_POST['cha']=0;
	$num=$_POST['from'];	

	for ($i=$begin;$i<=$end;$i=$i+$_POST['bytime']){
		if($num<10) $lotNum='0'.$num;else $lotNum=$num;
		$ss='';
		if($wei>0){
		for ($j=0;$j<$wei-strlen($lotNum);$j++){
			
			$ss.="0";
			
		}
		}
		$lotNum=$ss.$lotNum;
		
		$beginTime=time_to_str($i);
		$endTime=time_to_str($i+$_POST['bytime']-$_POST['cha']);
		$lotTime=time_to_str($i+$_POST['bytime']);
	$sql="insert into game_time(playKey,lotNum,beginTime,endTime,lotTime) values('{$playKey}','{$lotNum}','{$beginTime}','{$endTime}','{$lotTime}')";
        $db->query($sql);
		//echo $sql."<br>";
		$num++;
	}
}
//exit();
	add_adminlog("更新开奖时间");
	echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>保存成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";
exit();
}



?>
<link rel="stylesheet" type="text/css" href="images/style.css" media="all" />


<script>
function close_pop(){parent.pop.close();} 
</script>
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
.expl{text-align:left;height:30px;line-height:30px;color:#777777;padding-left:10px;}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{
	height:40px;line-height:40px;padding:5px;margin-top:5px;
}

    input[type='text'],select{height:30px;line-height: 30px;padding:0 5px;width: 150px;border-radius: 3px;border: 1px #ddd solid;}
    .tips{color:#999;padding-left: 10px}
</style>
<?php
$timearr=array(1,2,5,10)
?>
<form action="?action=set_time" method="post" id="form1">
    <div class='title'>起始时间：<input type='text' id='begintime'  name="begintime" ><span class="tips">(格式：00:00:00)</span></div>

<div class='title'>结束时间：<input type='text' id='endtime' name='endtime'   value=''><span class="tips">(格式：00:00:00)</span></div>

<div class='title'>每期间隔：<input type='text' id='bytime'  name="bytime"  >秒</div>
<div class='title'>封单时间：<input type='text' id='cha'  name="cha" value='10'  >秒 <span class='tips'>开奖前？？秒开始封单</span></div>
<div class='title'>每期位数：<input type='text' id='wei'  name="wei"  ><span class='tips'>如：输入3(001期)，输入4(0001期)</span></div>

<div class='title'>开始期号：<input type='text' id='from'  name="from" value='1'  ><span class="tips">输入003，本次从003期开始批量添加</span></div>



<div class='title'>删除历史期数：<input type='checkbox' id='del'  name="del" value='1'></div>


<div class='bottom2'><input type='button' id='yes_button' value='确定' onclick="put_pop()" class="button">　　
    <a onclick="close_pop();">关闭</a>
   </div>


<input id='item' name='key' value='<?php echo $key;?>' style='display:none'>

</form>
<script>

function put_pop(){
	if(document.getElementById('begintime').value==""){alert("请输入起始时间");return false;}
	if(document.getElementById('endtime').value==""){alert("请输入结束时间");return false;}
	if(document.getElementById('bytime').value==""){alert("请输入相隔时间");return false;}

	document.getElementById('form1').submit();

}
</script>