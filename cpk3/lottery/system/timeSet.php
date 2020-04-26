<?php

$playkey=$_GET['playkey'];
$per_Get=$_GET[pername];
$per_Post=$_POST[pername];
if($per_Get!=""){$pername=$per_Get;}
if($per_Post!=""){$pername=$per_Post;}
$disableds="";
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="倍数设置策略";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 

 

<!----正文----------------->        
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
<form name="form1" id="form1" method="post" action="?controller=report&action=index"> 
 <tr bgcolor="#FFFFFF">
   <td align="right" >&nbsp;对哪些游戏及玩法生效：</td>
   <td align=left>
          <select name="ForGames" id="ForGames" style=\'width:120px\' onchange="GetPlays(this,\'ForPlays\')">
						     <option value=\'all\' selected>所有游戏</option>
					         ';
mysql_query("set names utf8;");
$sql5="select fullname,ckey from game_type where status='0'";
$result5=mysql_query($sql5);
$nums5=mysql_num_rows($result5);
if($nums5){
while($rows5=mysql_fetch_array($result5)){
echo "<option value='".$rows5[ckey]."'>".$rows5[fullname]."</option>";
}
}else{
echo "<option value=''>未找到数据,请先添加彩种</option>";
}
;echo ' 
         </select>
		 <select name="ForPlays" id="ForPlays" style=\'width:150px\'>
						     <option value=\'all\' selected>所有玩法</option> 
         </select>
   </td>
 </tr>
 <tr bgcolor="#FFFFFF">
    <td width="20%" align="right">&nbsp;对哪些会员生效：</td>
    <td width="80%" align=left>
	  <input type=radio name="ForUsers" id="ForUsers_all" value="all" onclick="G(\'show_p\').style.display=\'none\';G(\'ForRange_all\').removeAttribute(\'disabled\');" checked>所有
	  <input type=radio name="ForUsers" id="ForUsers_one" value="one" onclick="G(\'show_p\').style.display=\'\';G(\'ForRange_all\').setAttribute(\'disabled\',true);G(\'ForRange_all\').checked=false;G(\'ForRange_one\').checked=true;">单个
	  <span style=\'display:none\' id=\'show_p\'>：
        <input name="pername" id="pername"  class="input_02" type="text" size="15" maxlength="15">
		<font color="#777777">（提示：请输入一个且只能一个需要限制的会员用户名）</font>
	  </span>
	</td>
 </tr> 
 <tr bgcolor="#FFFFFF">
    <td width="20%" align="right">&nbsp;限制方式：</td>
    <td width="80%" align=left>
	  <input type=radio name="ForRange" id="ForRange_all" value="all" checked>当期最大所有会员总倍数
	  <input type=radio name="ForRange" id="ForRange_one" value="one">当期单个会员最大倍数
	  <font color="#777777">（提示：请输入一个且只能一个需要限制的会员用户名）</font>
	</td>
 </tr> 
 <tr bgcolor="#FFFFFF">
    <td width="20%" align="right">&nbsp;最大倍数：</td>
    <td width="80%" align=left> 
        <input name="number" id="number"  class="input_02" type="text" size="15" maxlength="15" onkeyup="this.value=this.value.replace(/\\D/g,\'\')" onafterpaste="this.value=this.value.replace(/\\D/g,\'\')">  
	</td>
 </tr>
 <tr bgcolor="#FFFFFF">
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td align=left><input type="button"  class="button" name="put_button" id="put_button" value="提交并生成策略" onclick="PutSet()"></td>
  </tr></form>
</table>
<input type=\'text\' id=\'pages\' name=\'pages\' value=\'0\' style=\'display:none\'>
<input type=\'text\' id=\'maxnum\' name=\'maxnum\' value=\'50\' style=\'display:none\'>
<script>
   function PutSet(){
	   var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	   var ForUsers="";var number="";var ForGames="";var ForRange="";var ForPlays="";
	   var ShowUsers="";var ShowGames="";var ShowRange="";var ShowPlays="";
	   var titles="您要添加策略：";

	   if(G(\'ForUsers_one\').checked==true){
		   if(G(\'pername\').value==""){Dialog.alert("请输入要限制会员的用户名");G(\'pername\').focus();return false;}
		   ForUsers=G(\'pername\').value;ShowUsers=G(\'pername\').value;
	   }else{
		   ForUsers="all";ShowUsers="所有会员";ShowRange="每个会员";
	   }
	   
	   if(G(\'number\').value==""){Dialog.alert("请输入要限制的最大倍数");G(\'number\').focus();return false;}
	   number=G(\'number\').value;

	   ForGames=G(\'ForGames\').value;if(ForGames=="all"){ShowGames="所有游戏";}else{ShowGames=ForGames;} 
	   ForPlays=G(\'ForPlays\').value;if(ForPlays=="all"){ShowGames="所有玩法";}else{ShowGames=ForGames;}

	   if(G(\'ForRange_all\').checked==true){ 
		   ForRange="all";ShowRange="每期所有会员最大总倍数";
	   }else{
		   ForRange="one";ShowRange+="每期最大倍数";
	   }
       
	   titles+="针对["+ShowUsers+"]，限制["+ShowGames+"] 的 ["+ShowRange+"] 为"+number; 
	   var show_dilog= window.confirm(titles);
	   if (show_dilog){ 
			  G(\'put_button\').value="正在提交...";G(\'put_button\').setAttribute(\'disabled\',true);
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content="";
		      ajaxobj.url=thisPathUrl+"/?action=save_post&active=SetTimes&ForGames="+ForGames+"&ForPlays="+ForPlays+"&ForUsers="+ForUsers+"&ForRange="+ForRange+"&number="+number; 
			  //alert(ajaxobj.url);//G(\'put_button\').value="提交并生成策略";G(\'put_button\').removeAttribute(\'disabled\');return false;
		      ajaxobj.callback=function(xmlobj){
				  var response = "#"+(xmlobj.responseText);//Dialog.alert("|"+response+"|");//return false;
				  if(response.indexOf("yes")>=0){
					  Dialog.alert("操作成功");window.setTimeout("Show_Back_Set()",500);
				  }else{
					  Dialog.alert("请确定是否存在相同及类似策略，或者提交失败需重试！");G(\'put_button\').value="提交并生成策略";G(\'put_button\').removeAttribute(\'disabled\');
				  }				  
			  }
		      ajaxobj.send()
	   }else{
		     return false;
	   } 
   }
   function Show_Back_Set(){
	   G(\'put_button\').value="提交并生成策略";G(\'put_button\').removeAttribute(\'disabled\');
	   var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	          var pages=G(\'pages\').value;var maxnum=G(\'maxnum\').value;
			  var item_s=""; if(G(\'item_s\')){item_s=G(\'item_s\').value;}
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content="";
		      ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=GetSetTimes&pages="+pages+"&maxnum="+maxnum+"&items="+item_s;
		      ajaxobj.callback=function(xmlobj){
				  var response = Trim(xmlobj.responseText);
				  if(response.indexOf(\'|no\')-1>=0){G(\'ShowSet\').innerHTML="<div style=\'margin:10px;text-align:left;color:#666666\'>未找到数据</div>";}else{}
				  Show_Times_Set(response)
			  }
		      ajaxobj.send()
   }
   function Del_Times_Set(uid){ 
	   var show_dilog= window.confirm("确定删除这条策略？");
	   if (show_dilog){
		      var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		      if(uid==""){Dialog.alert("删除失败，请刷新后重试！");return false;}
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content="";
		      ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=ChangeSetTimes&dos=del&uid="+uid;  
		      ajaxobj.callback=function(xmlobj){
				  var response = Trim(xmlobj.responseText);
				  if(response=="yes"){Show_Back_Set();return false;}
			  }
		      ajaxobj.send()
	   }else{
		   return false;
	   }
   }
   function Status_Times_Set(uid,item){ 
	   if(item=="1"){var titles="确定停用这条策略？"}else{var titles="确定启用这条策略？"}
	   var show_dilog= window.confirm(titles);
	   if (show_dilog){
		      var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		      if(uid==""){Dialog.alert("删除失败，请刷新后重试！");return false;}
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content="";
		      ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=ChangeSetTimes&dos=change&uid="+uid+"&item="+item;  
		      ajaxobj.callback=function(xmlobj){
				  var response = Trim(xmlobj.responseText);
				  if(response=="yes"){Show_Back_Set();return false;}
			  }
		      ajaxobj.send()
	   }else{
		   return false;
	   }
   }
   function Show_Times_Set(re_body){ 
	   var re_list=re_body.split("^");var lists=new Array();var f_num=1;
	   var uid;var ForGames;var ForPlays;var ForUsers;var ForRange;var number;var creatdate;var status;var re_text;var re_user="";
	   var item_s=""; if(G(\'item_s\')){item_s=G(\'item_s\').value;}if(item_s==""){var re_back="style=\'display:none\'";}
	   var g_l="<span style=\'font-weight:normal;color:#777777\'>[&nbsp;查找：<input id=\'item_s\' value=\'"+item_s+"\' size=5>&nbsp;<span class=\'link_02\' onclick=\\"Show_Back_Set()\\">查找</span>&nbsp;<span "+re_back+" class=\'link_02\' onclick=\\"G(\'item_s\').value=\'\';Show_Back_Set()\\">返回</span>&nbsp;<font color=\'#777777\'>(可输入用户名或游戏简称如CQSSC进行过滤)</font>]</span>";

	   var innerHTML="<table width=\'96%\' border=\'0\' cellpadding=\'4\' cellspacing=\'1\' bgcolor=\'#CCCCCC\'>";
	   innerHTML+="<tr align=center height=20 bgcolor=\'#FFFFFF\'><th width=40>策略</th><th width=130>创建时间</th>";
	   innerHTML+="<th>策略描述&nbsp;"+g_l+"</th>";
	   innerHTML+="<th width=40>状态</th><th width=80>操作</th></tr>";
	   if(re_body.length-10>=0){
	   for (i=0;i<re_list.length;i++)
	   { 
		   if(re_list[i]!=""){
			   innerHTML+="<tr align=center height=20 bgcolor=\'#FFFFFF\'>";
			   lists=re_list[i].split("|");
			   uid=lists[0];ForGames=lists[1];ForPlays=lists[2];ForUsers=lists[3];ForRange=lists[4];number=lists[5];creatdate=lists[6];
			   if(lists[7]=="0"){
				   status="<font color=\'green\'>生效</font>";
				   var zt="<span class=\'link_01\' onclick=\\"Status_Times_Set(\'"+uid+"\',\'1\')\\">停用</span>";
			   }else{
				   status="<font color=\'red\'>失效</font>";
				   var zt="<span class=\'link_01\' onclick=\\"Status_Times_Set(\'"+uid+"\',\'0\')\\">启用</span>";
			   }
			   
			   innerHTML+="<td>策略"+f_num+"</td>";
			   innerHTML+="<td>"+creatdate+"</td>";
			   //titles+="针对["+ShowUsers+"]，限制["+ShowGames+"] 的 ["+ShowRange+"] 为"+number; 
			   re_text="针对 [<font color=\'green\'>";
			   if(ForUsers=="all"){re_text+="所有会员</font>] 限制 [<font color=\'green\'>";re_user="每个会员"}else{re_text+=ForUsers+"</font>] 限制 [<font color=\'green\'>";re_user="";}
			   if(ForGames=="all"){re_text+="所有游戏</font>] [<font color=\'green\'>";}else{re_text+=ForGames+"</font>] [<font color=\'green\'>";}

			   if(ForPlays=="all"){re_text+="所有玩法</font>] 的 [<font color=\'green\'>";}else{re_text+=ForPlays+"</font>] 的 [<font color=\'green\'>";}

			   if(ForRange=="all"){re_text+="每期所有会员最大总倍数</font>] 为"}else{re_text+=re_user+"每期最大倍数</font>] 为";}
			   re_text+=" [<font color=\'green\'>"+number+"</font>]";
			   //-----
			   innerHTML+="<td align=left>&nbsp;"+re_text+"</td>";
			   innerHTML+="<td>"+status+"</td>";
			   innerHTML+="<td><span class=\'link_02\' onclick=\\"Del_Times_Set(\'"+uid+"\')\\">删除</span>&nbsp;&nbsp;"+zt+"</td>";
			   innerHTML+="</tr>";f_num+=1;
		   }
		   
	   }}else{innerHTML+="<tr align=center height=20 bgcolor=\'#FFFFFF\'><td colspan=5 align=left>&nbsp;<font color=\'#666666\'>未找到数据</font></td></tr>";}
	   innerHTML+="</table>";
	   G(\'ShowSet\').innerHTML=innerHTML;
   }
   
</script>
<!----正文----------------->       
 
	      <br>
';$body_top_title="所有策略";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<div id=\'ShowSet\' style=\'line-height:40px;\'><div style=\'margin:10px;text-align:left;color:#666666\'>未找到数据..</div></div>
	  <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");;echo '<script>Show_Back_Set()</script>';
?>