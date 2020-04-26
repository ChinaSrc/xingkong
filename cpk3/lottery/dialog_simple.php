<?php
exit('无权限操作');
$action=$_GET[active];
$uid=$_GET[uid];
$money=$_GET[money];
$nexts=$_GET[nexts];
$pername=$_GET[pername];
if($action=="deluser"){
$title="确定删除帐户：".$pername." ？";
}
if($action=="djuser"){
$title="确定冻结会员帐号".$pername." ？";
}
if($action=="jiedong"){
$title="确定对会员帐号".$pername." 解除冻结，恢复正常？";
}
if($action=="getout"){
$title="确定强制会员".$pername." 下线？该会员将被强制退出平台！<br>如要控制用户不能登陆，请对其帐户进行冻结操作！";
}
;echo ' 
<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<script>
function close_pop(){parent.pop.close();}
function put_pop(action,nexts){
	if(document.getElementById(\'yes_button\')){
		document.getElementById(\'yes_button\').setAttribute(\'disabled\',true);
	}
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
    var uid=G(\'uid\').value;
	if(action=="deluser"){ 
		var urls=thisPathUrl+"/?&flag=yes&action=Ajax_del_user";
		var contents="uid="+uid; 
	}
	if(action=="djuser"){  
		var urls=thisPathUrl+"/?&flag=yes&action=save_infor_ajax";
		var contents="dbname=user&id="+uid+"&item=status&values=1";
	} 
	if(action=="jiedong"){  
		var urls=thisPathUrl+"/?&flag=yes&action=save_infor_ajax";
		var contents="dbname=user&id="+uid+"&item=status&values=0";
	}
	if(action=="getout"){  
		var urls="action.aspx?userid="+uid+"&active=getout";
		var contents="?userid="+uid+"&active=getout";
		
		//alert(contents);
	} 
	ajaxSend(urls,contents,nexts);
}
function ajaxSend(urls,contents,nexts){//popnexts(nexts)/*
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content=contents; 
	ajaxobj.url=urls;
	ajaxobj.callback=function(xmlobj){
	
	
	    var response = Trim(xmlobj.responseText); //alert("|"+response+"|");//alert(buy_names) 
		if(response.indexOf("yes")>=0){G(\'title\').innerHTML="操作成功！";}else{G(\'title\').innerHTML="操作失败！";}
		popnexts(nexts);
	};
	ajaxobj.send() //*/
}
function popnexts(nexts){
	if(nexts=="close"){setTimeout("parent.pop.close()",1000)}
	if(nexts=="reload"){setTimeout("window.parent.location.reload()",1000)}
	if(nexts=="back"){setTimeout("history.back()",1000)}
	if(nexts.length-6>0){setTimeout("window.parent.location.href=nexts",1000)}
	if(parent.window.document.getElementById(\'do_put_button\')){
		parent.window.document.getElementById(\'do_put_button\').setAttribute(\'disabled\',true);
	}
	GetUserMoney();
}
</script>
<style>
body ,th,td{
	font:normal 12px 宋体; 
}
body  { 
	 margin:0px; text-align:center; 
}
.title{
	text-align:left;height:50px;line-height:25px; margin-top:5px; padding-left:20px;
}
.items{
	text-align:center;height:210px;line-height:20px; margin:0px; padding:5px;overflow:auto;border-top:1px solid #999999;border-bottom:1px solid #999999;
}
.hr0{ height:1px;border:none;border-top:1px dashed #0066CC;}
.hr1{ height:1px;border:none;border-top:1px solid #999999;}
.hr2{ height:3px;border:none;border-top:3px double red;}
.hr3{ height:5px;border:none;border-top:5px ridge green;}
.hr4{ height:10px;border:none;border-top:10px groove skyblue;}
.bottom2{
	height:40px;line-height:40px;padding:10px;
}
</style>
<input type=\'hidden\' id=\'uid\' value=\'';echo $uid;;echo '\'>
<input type=\'hidden\' id=\'money\' value=\'';echo $money;;echo '\'> 
<div class=\'title\' id=\'title\'>';echo $title;;echo '</div>
<div class=\'bottom2\'><input type=\'button\' id=\'yes_button\' value=\'确定\' onclick="put_pop(\'';echo $action;;echo '\',\'';echo $nexts;;echo '\')">　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>'
?>