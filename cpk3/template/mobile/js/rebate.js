function Save_Ret_input(item){
    var lis="";var input_value; 
	var all_other=G('all_other').value;
	var all_bdw=G('all_bdw').value;
	var lis="";if(item=="bdw"){lis="bdw";input_value=all_bdw;}else{lis="zc";input_value=all_other;}
	var playkey_lists=G('playkey_lists').value;
	var play_list=playkey_lists.split("|")
	var playkeys= new Array();
	for (i=0;i<play_list.length;i++)
	{
		if(G(lis+'_'+play_list[i])){
			G(lis+'_'+play_list[i]).value=input_value;
		}
	}
}
function Save_Ret_value(modes,perid,item){ 
	//系统设定的值
	var sys_max=parseFloat(G("MaxBonus").value);
	var sys_min=parseFloat(G("MinBonus").value); 
	//开始导入每一项数据
	var lis="";if(item=="bdw"){lis="bdw";}else{lis="zc";}
	var playkey_lists=G('playkey_lists').value;
	var play_list=playkey_lists.split("|");
	var user_role=parseInt(G('user_role').value,10);
	if(!user_role){user_role=0;}
	var playkeys= new Array();var hig_value;var this_value;var next_flag="yes"; 
	//将所有输入项存入数据库
	 
	for (i=0;i<play_list.length;i++)
	{ 
		next_flag="yes";hig_value=0;this_value=0;
		if(G(lis+'_'+play_list[i]) && G(lis+'_'+play_list[i]+"_hig")){
			if(G(lis+'_'+play_list[i]+"_hig").value!=""){hig_value=parseFloat(G(lis+'_'+play_list[i]+"_hig").value,10);}
			 
			//计算输入的值得到相关状态
			if(G(lis+'_'+play_list[i]).value==""){next_flag="no";}else{
				this_value=parseFloat(G(lis+'_'+play_list[i]).value,10);
				var own_value_s=G(lis+'_'+play_list[i]+"_own").value;// 
				if(own_value_s==""){var own_value=0;}else{var own_value=parseFloat(own_value_s,10);}
				//alert(this_value+"|"+own_value+"|"+user_role);return false;
				//是否大于系统最大值,next_flag="no"不存入数据库
				if(this_value-sys_max>0){next_flag="no";alert("您输入的["+play_list[i]+"]返点高于系统最大返点["+sys_max+"%]");G(lis+'_'+play_list[i]).focus();return false;}
				//与上级返点差应大于sys_min，next_flag="no"不存入数据库
				if(user_role-6<0){if(this_value-own_value<0){next_flag="no";alert("您输入的["+play_list[i]+"]返点不能小于之前的返点["+own_value+"%]");G(lis+'_'+play_list[i]).focus();return false;}}
			
				if(hig_value-this_value<0){next_flag="no";alert("您输入的["+play_list[i]+"]返点高于可设返点范围");G(lis+'_'+play_list[i]).focus();}
			}			
			if(next_flag=="yes"){
				Post_rebate(play_list[i],modes,perid,item,this_value)
			}
		}
	}
	window.setTimeout("Get_response()",500);
} 
function Post_rebate(playkey,modes,perid,items,values){ 
	if(modes!="" && perid!=""){
		var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		ajaxobj=new AJAXRequest;
		ajaxobj.method="POST";
		ajaxobj.content="playkey="+playkey+"&modes="+modes+"&perid="+perid+"&items="+items+"&values="+values;
		//alert(ajaxobj.content);return false;
		var rooturl=document.getElementById('rootURL').value;
		ajaxobj.url=rooturl+"/?comes=highgame&controller=&action=ajax_save_rebate&flag=yes";
		//ajaxobj.url="../adminxp/ajax_save_rebate.aspx";
		ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;
		    if(response.indexOf("no")>=0){
				if(G('flags').value==""){G('flags').value=playkey;}else{G('flags').value+="|"+playkey;} 
			}
		}
		ajaxobj.send()
	} 
}
function Get_response(response){
	if(G('flags').value==""){Dialog.alert("提示：保存成功!");}else{Dialog.alert("提示："+G('flags').value+" 保存失败!其它保存成功");} 
	G('flags').value=""
	return false;
}