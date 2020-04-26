<?php

$id=$_GET[id];
$active=$_GET[active];
$items=$_GET[items];
$perid=$_GET[userid];
$itemname=$_GET[itemname];
$itemtype=$_GET[itemtype];
if($active=="user_bank"){$title="输入金额：";}
;echo '<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<link rel="stylesheet" type="text/css" href="images/style.css" media="all" />
<style>
body ,th,td{
	font:normal 12px 宋体; 
}
body  { 
	 margin:0px; text-align:center; 
}
.title{
	text-align:left;height:20px;line-height:20px; margin-top:5px; padding:5px;font-weight:bold;corlor:#666666;
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
<script>
function close_pop(){parent.pop.close();} 
//POST提交投注#####################################################################################################
function change_money(){
	    document.getElementById(\'yes_button\').setAttribute(\'disabled\',true);
	    ajaxobj=new AJAXRequest; var body_s="";
		var items=G(\'items\').value;
		
		
		var perid=G(\'perid\').value;var values=G(\'values\').value;var itemname=G(\'itemname\').value;
		var itemtype=G(\'itemtype\').value;var dbname=G(\'dbname\').value;var codes=G(\'codes\').value;var bodys=G(\'bodys\').value;
		ajaxobj.method="POST";
		ajaxobj.content="items="+items+"&perid="+perid+"&values="+values+"&dbname="+dbname+"&codes="+codes+"&bodys="+bodys+"&username="+G(\'username\').value;;
		
		var rootURL=document.getElementById("rootURL").value;
		var pathName=document.getElementById("pathName").value;
		ajaxobj.url=rootURL+"/"+pathName+"/index.aspx?flag=yes&action=ajax_save_body";//alert(ajaxobj.url);return false;
		ajaxobj.callback=function(xmlobj){
			var response = Trim(xmlobj.responseText);
			//alert("|"+response+"|");
			//alert(buy_names) 
			if(response=="yes"){
				body_s="<font color=\'green\'>提交成功</font>"; 
				
				//setTimeout("window.location=\'index.aspx?action=edit_body&active=user_bank&amp;items=hig_amount&6&itemtype=innerHTML\'",1000);
//				setTimeout("parent.window.location.reload()",1000);
			window.setTimeout("   parent.location.reload();parent.pop.close()",1000);
			
				
			}else{
			if(response=="no1")	body_s="<font color=\'red\'>你输入的用户名不存在</font>";
			else
				body_s="<font color=\'red\'>提交失败</font>";
			} 
			G(\'itembody\').innerHTML="";;
			G(\'itembody\').innerHTML=Trim(body_s);
		};
		ajaxobj.send();
		//parent.pop.close();/*parent.window.location.reload();*/
}
</script> 

<form>
   <div style=\'padding-bottom:10px;\'> 
	  <div class=\'items\' id=\'itembody\'>
	  <table  style="width:100%;margin-top:20px">
	  ';
	  
if(!$_GET['userid']){
	
echo '	  	     <tr>
		   <td width=35%  align="right" style="padding-right:15px;">用户名</td>
		   <td width=65%  style="text-align: left" >
	
		<input type="text" style=\'width:200px;\' id=\'username\' name=\'username\' value=\'\'>
		   </td>
		 </tr>';	
	
	
	
	
}	  
else {
	
	
	echo '<input  style=\'width:200px;display:none;\' id=\'username\' name=\'username\' value=\'\'>';
}



echo '	  	     <tr style="display: none">
		   <td width=35%  align="right" style="padding-right:15px;">账户类型</td>
		   <td width=65%>
		   
		   <input type="radio" name=\'items1\' value=\'1\' onclick="G(\'items\').value=this.value;" checked>充值&nbsp;&nbsp;
		   <input type="radio" name=\'items1\' value=\'2\'  onclick="G(\'items\').value=this.value;"  >活动&nbsp;&nbsp;
		
		   </td>
		 </tr>
	     <tr>
		   <td width=35% align="right"  style="padding-right:15px;"><select id=\'codes\'>
		    <option value=\'add\'>增加</option>
			<option value=\'lost\'>扣减</option>
		 </select></td>
		   <td width=65% style="text-align: left" ><input type="text" style=\'width:200px;\' id=\'values\' name=\'values\' value=\'';echo $last_num;;echo '\'> </td>
		 </tr> 
		 <tr>
		   <td align="right" style="padding-right:15px;">备　　注：</td>
		   <td  style="text-align: left" ><input type=\'text\' id=\'bodys\' style=\'height:50px;width:200px;\'></td>
		 </tr>
	  </table> 
	
	  

   <div class=\'bottom2\'><input type=\'button\' id=\'yes_button\'class="button" value=\'确定\' onclick="change_money()">　　<input type=\'button\' value=\'取消\' onclick="close_pop()"></div>
      </div>  </div>
   <div style=\'display:none;\'>

	 <input id=\'items\' value=\'1\'>
	 <input id=\'perid\' name=\'perid\' value=\'';echo $perid;;echo '\'>
	 <input id=\'itemname\' name=\'itemname\' value=\'';echo $itemname;;echo '\'>
	 <input id=\'itemtype\' name=\'itemtype\' value=\'';echo $itemtype;;echo '\'>
	 <input id=\'dbname\' name=\'dbname\' value=\'';echo $active;;echo '\'>
   </div>
</form>
 ';
?>