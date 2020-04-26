<?php

$playkey=$_GET['playkey'];
$id=$_GET['id'];
mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$btn="保存配置";$show_title="创建玩法配置";
if($id){
mysql_query("set names utf8;");
$sql2="select * from game_code where id='$id'";
$result2=mysql_query($sql2);
$rowsk=mysql_fetch_array($result2);
$btn="保存配置";$show_title="修改玩法配置";
if($cate==""){$cate=$rowsk[cate];}
}
$show_title=$show_title;
$code_mode=$rowsk[mode];
;echo ' 
<BODY bgColor=#FFFFFF style=\'margin:0px;\'><br> <input id=\'thisPlay\' value=\'';echo $rowsk[ckey];;echo '\' style=\'display:none\'>
<table  width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=center>
 <tr bgcolor="#FFFFFF">
	<td width=500 valign=top> 
      <table> <tr height=25 bgcolor="#DDDDDD"> 
			 <td align=left colspan=4>&nbsp;&nbsp;<b>分类信息</b></td>
	     </tr>
         <tr height=25 bgcolor="#FFFFFF">
         			 <td width=\'15%\' align=center>类别：</td>
			 <td align=left valign=middle width=\'20%\'>';echo $arr_game_code[$rowsk['type']];;echo '</td>
			 <td width=\'15%\' align=center>名称：</td>
			 <td align=left valign=middle width=\'35%\'>';echo $rowsk[fullname]."(".$rowsk[ckey].")";;echo '</td>
	
			 
		 </tr> 
		 <tr height=25 bgcolor="#FFFFFF" style="display:none;" >		     

			 <td align=center>模式：</td>
			 <td align=left valign=middle><div id=\'code_mode\'>
			 ';
$auto_mode="yes";
if($code_mode=="default"){$auto_mode="yes";}
if($code_mode=="auto"){$auto_mode="yes";}
if($code_mode=="fix"){$auto_mode="no";}
if($auto_mode=="yes"){
echo "<a class='mouse_show link_01' onclick=\"change_code_mode('".$rowsk[id]."','close')\">关闭自由模式</a>";
}else{
echo "<a class='mouse_show link_01' onclick=\"change_code_mode('".$rowsk[id]."','open')\">开启自由模式</a>";
}
;echo '</div>
			 </td>
			  
		 </tr>'; 
		$p_list= $db->fetch_all("select * from game_code where status='0' and pid='{$rowsk['id']}' order by id asc");
		 if($p_list){
		 	 echo '<tr height=25 bgcolor="#DDDDDD"> 
			 <td align=left colspan=4>&nbsp;&nbsp;<b>包含子类:</b>';
		 	foreach ($p_list as $key=> $value){
		 		
		 		if($key==0) {$rowsk['ckey']=$value['ckey'];
		 		$checked="checked";
		 		}
		 		else $checked='';
		 		echo "<input type='radio' value='{$value['ckey']}' name='pid' onclick='ShowCodeList(this.value);' {$checked}>{$value['fullname']} &nbsp;&nbsp;";
		 		
		 	}
		 	 echo '
		 	 
		 	 &nbsp;&nbsp;<font color=\'red\'>点击子类 编辑玩法</font>
		 	 </td>
	     </tr>';	
		 }
		 
		 echo '
		 <tr bgcolor="#FFFFFF" >
		     <td align=left valign=top colspan=4>
			    <div style=\'text-align:center;margin-top:5px;height:400px;OVERFLOW-y:auto;\' id=\'is_play_list\'> 
				 
			    </div>
			 </td>
		 </tr>
      </table>  
	</td> 
	
	';
$type=$rowsk['type'];

	$config=getsql::sys();	 
		 if($config['game_qw']==2 and $type!='kl8' and $type!='pk10')  $where=" and   ckey not like '%QW%'";
else $where='';


$sql3="select id,fullname,ckey,skey,code,content from game_ssc_list where ckey in (select ckey from game_code where type='{$type}'  {$where})";


$result3=mysql_query($sql3);
$total=mysql_num_rows($result3);
		 
		 echo '
	<td width=500 valign=top>
	<div id="mess_box1" style="">
	    <table> <tr height=25 bgcolor="#DDDDDD"> 
			    <td align=center colspan=4>&nbsp;&nbsp;<b>所有玩法表</b></td>
	        </tr>
			<tr height=30 bgcolor="#FFFFFF"> 
			    <td align=center colspan=4>
			    	   <span style="float:left;">玩法类型:'.$arr_game_code[$type].'&nbsp;&nbsp;共有：<font color="#ff0000">'.$total.'</font>种玩法</span>	
				   <span style="display:none;"> <b>分类名称：</b><input type=\'text\' id=\'titles\' name=\'titles\' style=\'width:30%\' value=""> </span>
				   <span>&nbsp;<input type="button" class=\'button\' value="添加玩法" id=\'button\' name="submit" onclick="AddPlay(\'';echo $rowsk[ckey];;echo '\')"></span> 
				</td>
	        </tr>
			<tr height=20 bgcolor="#DDDDDD"> 
			    <td align=center width=\'8%\'>选择</td>
				<td align=center width=\'20%\'>类别-名称</td>
				<td align=center width=\'15%\'>简称</td>
				<td align=center width=\'20%\'>说明</td>
	        </tr>
		</table>
	</div> 
	<div id="mess_box" style=" height:430px;OVERFLOW-y:auto;">
	    <table> ';

while($rows3=mysql_fetch_array($result3)){
echo "<tr height=16 bgcolor='#FFFFFF' >";
echo "  <td align=center width='8%'><input type='checkbox' id='select_rows' name='select_rows[]' value='".$rows3[id]."' /></td>";
$title_s=$rows3[code]."-".$rows3[fullname];
echo "  <td width='20%' align=center title='".$rows3[code]."-".$rows3[fullname]."'>".CutStr($title_s,0,9,false)."</td>";
echo "  <td width='15%' align=center>".$rows3[skey]."<input id='name_".$rows3[id]."' value='".$rows3[fullname]."' style='display:none'><input id='key_".$rows3[id]."' value='".$rows3[skey]."' style='display:none'></td>";
echo "  <td width='20%' align=center title='".$rows3[content]."'>".CutStr($rows3[content],0,8,false)."</td>";
echo "  </tr>";
}
;echo ' 
		</table>
	</div> 
	</td> 
 </tr>
</table> 
<script> 
function change_code_mode(uid,item){
	if(item=="open"){var code_mode="<a class=\'mouse_show link_01\' onclick=\\"change_code_mode(\'"+uid+"\',\'close\')\\">关闭自由模式</a>";}
	if(item=="close"){var code_mode="<a class=\'mouse_show link_01\' onclick=\\"change_code_mode(\'"+uid+"\',\'open\')\\">开启自由模式</a>"}
	if(item==""){alert("操作失败，请刷新后重试！");return false;}
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST"; 
	ajaxobj.content="uid="+uid+"&item="+item;
	ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&uid="+uid+"&item="+item+"&active=codemode"; 
	ajaxobj.callback=function(xmlobj){ 
	    var response =Trim(xmlobj.responseText);//alert(response)
	    if(response=="yes"){
			G("code_mode").innerHTML=code_mode;
			alert("操作成功！");return false;
		}else{
			alert("操作失败，请刷新后重试！");return false;
		}
	}
	ajaxobj.send()
}
function saveCodeList(uid){
	var CodeTile=G("CodeTile_"+uid).value
	var ShowTile=G("ShowTile_"+uid).value
	var OrderS=G("OrderS_"+uid).value
	var Rebate=G("Rebate_"+uid).value
	var MaxNote=G("MaxNote_"+uid).value
	if(OrderS==""){OrderS="0";}
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST"; 
	ajaxobj.content="CodeTile="+CodeTile+"&ShowTile="+ShowTile+"&OrderS="+OrderS+"&Rebate="+Rebate+"&MaxNote="+MaxNote+"&uid="+uid;
	ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&id="+uid+"&active=SaveCodeList";
	ajaxobj.callback=function(xmlobj){
	    G("save_"+uid).innerHTML="提交中..";
	    var response =Trim(xmlobj.responseText);//alert(response)
	    if(response=="yes"){
			setTimeout("ReCodeSave(\'"+uid+"\')",1000)
		}else{
			alert("提交失败");G("save_"+uid).innerHTML="<a class=\'mouse_show link_01\' onclick=\\"saveCodeList(\'"+uid+"\')\\">保存</a>";
		}
	}
	ajaxobj.send()
}
function ReCodeSave(uid){
	G("save_"+uid).innerHTML="提交成功";
	setTimeout("ButtomCodeSave(\'"+uid+"\')",1000) 
}
function ButtomCodeSave(uid){G("save_"+uid).innerHTML="<a class=\'mouse_show link_01\' onclick=\\"saveCodeList(\'"+uid+"\')\\">保存</a>";}
function DelCodeList(uid){ 
	var mes=confirm("确定从该分类中去除此玩法？");
	var thisPlay=G(\'thisPlay\').value
	if(mes==true){
		    var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		    ajaxobj=new AJAXRequest;
		    ajaxobj.method="POST"; 
			//ajaxobj.content="codekey="+codekey+"&list_id="+list_id+"&listname="+list_name_s+"&titles="+G("titles").value;
		    ajaxobj.url=thisPathUrl+"/?action=dele_post&flag=yes&dbname=game_code_list&dialog=no&id="+uid;
		    ajaxobj.callback=function(xmlobj){
				alert("操作成功!");ShowCodeList(thisPlay);
		    }
		   ajaxobj.send()
	 }else{return false;}
}
function AddPlay(codekey){ 
	//if(G("titles").value==""){alert("请填写分类名称");return false;}
	var e=document.getElementsByName(\'select_rows[]\');
	var selectNum=0;var this_name="";var list_id="";var list_name="";var list_name_s="";var this_key
	for (var i=0;i<e.length;i++){
		if (e[i].checked==true){
			selectNum+=1;
			this_name=G(\'name_\'+e[i].value).value;this_key=G(\'key_\'+e[i].value).value;
			if(list_id==""){list_id=this_key;}else{list_id+="|"+this_key}
			if(list_name_s==""){list_name_s=this_name;}else{list_name_s+="|"+this_name;}
			if(list_name==""){list_name=this_name;}else{list_name+=" "+this_name;}			
			e[i].checked = false;//添加后，将打勾改为不打勾
		}
	}
	if(selectNum-1>=0){ 
		var mes=confirm("确定添加玩法："+list_name+"？");
	    if(mes==true){ 
			var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		    ajaxobj=new AJAXRequest;
		    ajaxobj.method="POST"; 
			ajaxobj.content="codekey="+codekey+"&list_id="+list_id+"&listname="+list_name_s+"&titles="+G("titles").value;
		    ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&id="+codekey+"&active=CodeList";
		    ajaxobj.callback=function(xmlobj){
				//G("is_play_list").innerHTML="<div style=\'margin:20px;text-algin:center\'>正在提交数据...</div>"
				G("button").value="正在提交";G("button").setAttribute(\'disabled\',true);
				var response =Trim(xmlobj.responseText);//alert(response)
				if(response=="yes"){setTimeout("ShowCodeList(\'"+codekey+"\')",2000)}else{alert("提交失败");G("button").value="添加玩法";G("button").removeAttribute(\'disabled\');return false;}
		    }
		   ajaxobj.send()
	    }else{return false;}
	}else{
		alert("请选择玩法");return false;
	}
}
function ShowCodeList(codekey){
	G("button").value="添加玩法";G("button").removeAttribute(\'disabled\');
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST"; 
	ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=CodeListShow&codekey="+codekey;
	ajaxobj.callback=function(xmlobj){ 
		var response = (xmlobj.responseText);
		G("is_play_list").innerHTML=response
	}
	ajaxobj.send()
}
ShowCodeList(\'';echo $rowsk[ckey];;echo '\')
</script>

</body> '
?>