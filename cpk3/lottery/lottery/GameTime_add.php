<?php

$playkey=$_GET['playkey'];
;echo ' 
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
	text-align:left;height:20px;line-height:20px;padding-left:10px;margin-top:5px;
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
<link rel="stylesheet" type="text/css" href="images/style.css" media="all" />


<form method="POST" name="form" id="form" action="';echo ROOT_URL."/".$AdminPath."/?action=save_post&active=AddGameTime";;echo '" > 
<div class=\'title\'>期　　数：<input type=\'text\' id=\'lotNum\' name=\'lotNum\'  style=\'width:60%\'></div>
<div class=\'title\'>开始时间：<input type=\'text\' id=\'beginTime\' name=\'beginTime\' style=\'width:60%\'></div>
<div class=\'title\'>结束时间：<input type=\'text\' id=\'endTime\' name=\'endTime\' style=\'width:60%\'></div>
<div class=\'title\'>开奖时间：<input type=\'text\' id=\'lotTime\' name=\'lotTime\'  style=\'width:60%\'></div>
<div class=\'expl\'>提示：除期数外，需严格按时间格式填写每项。</div>  
<div class=\'bottom2\'><input type=\'submit\' id=\'yes_button\' value=\'确定\' onclick="put_pop()">　　<input type=\'button\' value=\'关闭\' onclick="close_pop()"></div>
<input id=\'playkey\' name=\'playkey\' value=\'';echo $playkey;;echo '\' style=\'display:none\'>
</form>';
?>