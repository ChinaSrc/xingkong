//增加的一行#####################################################################################################
function insertrow(){
   if(G("username").value==""){G("username").className="input_G";G("user_ame").focus();return false;}else{G("username").className="none";}
   if(G("username").value.length-6<0){open9("用户名长度为6-12个字符！");return false;}
   if(G("username").value.length-12>0){open9("用户名长度为6-12个字符！");return false;}
   if(check_chinese_char(G("username").value)){open9("用户名只能用数字与英文！");return false;}
   if(G("password").value==""){G("password").className="input_G";G("password").focus();return false;}else{G("password").className="none";} 
   var sex=G("sex").value;
   var isproxy=G("isproxy").value;
   if(isproxy=="1"){
   }else{
	   if(G("proxynum")){if(G("proxynum").value==""){G("proxynum").className="input_G";G("proxynum").focus();return false;}else{G("proxynum").className="none";}}
   }
  
   //if(G("reBonus").value==""){G("reBonus").className="input_G";G("reBonus").focus();return false;}else{G("reBonus").className="none";}
   var chnum=0;var modelist="";for (i=0;i<document.getElementsByName('modes').length;i++){
	   if(document.getElementsByName('modes')[i].checked==true){chnum++;
	      if(modelist==""){modelist=document.getElementsByName('modes')[i].value;}else{modelist=modelist+"|"+document.getElementsByName('modes')[i].value;}
	   }}
   if(chnum-1<0){for(i=0;i<document.getElementsByName('modes').length;i++){document.getElementsByName('modes')[i].className="input_G";}G("modes").focus();return false;}else{
	   for(i=0;i<document.getElementsByName('modes').length;i++){document.getElementsByName('modes')[i].className="none";};}
   if(G("modes").value==""){G("modes").className="input_G";G("modes").focus();return false;}else{G("modes").className="none";}
   var reModes=G("reModes").value;
    
   var username=G("username").value;
   var password=G("password").value;
   if(G("proxynum")){var proxynum=G("proxynum").value;}else{var proxynum="0";}
   var mobilephone="11";
   var qqnum="11";var active=G("active").value;//"joyin";
    var rebate=G('rebate').value;
   add_new_user("",username,password,sex,isproxy,proxynum,modelist,reModes,mobilephone,qqnum,active,rebate);
    
}
//注册新用户#####################################################################################################
function add_new_user(perid,username,password,sex,isproxy,proxynum,modelist,reModes,mobilephone,qqnum,active,rebate){
	//open9("正在提交，请稍候...");
	//G("put_new_user").setAttribute('disabled',true);
	 
		var putstr="&perid="+perid+"&username="+username+"&password="+password+"&sex="+sex+"&isproxy="+isproxy+"&proxynum="+proxynum+"&modelist="+modelist+"&reModes="+reModes+"&mobilephone="+mobilephone+"&qqnum="+qqnum+"&active="+active+"&rebate="+rebate;
	
		ajaxobj=new AJAXRequest;ajaxobj.method="POST";
		ajaxobj.content=putstr;
		var do_url=G("do_url").value;
		ajaxobj.url=do_url+"?mod=ajax&code=add&list=user&flag=yes"+putstr; 
		//openReturn("注册会员",ajaxobj.url);
		ajaxobj.callback=function(xmlobj){ 
			var response = xmlobj.responseText; //alert(response)
			if(response.indexOf("yes")>0){
				var arrs=response.split("|");
				G("username").value="";G("mobilephone").value="";G("qqnum").value="";
						alert('注册成功');
			var root_url="?mod=user&code=list"
			window.location.href=root_url
			//	open3('注册成功',do_url+"?mod=user&code=list",700,400)
				
			}else if(response.indexOf("same")>0){
				Dialog.alert("注册失败，已用户名已存！")
			}else if(response.indexOf("pro")>0){
				Dialog.alert("注册失败，开户配额不足或没有输入配额！")
			}else{
				Dialog.alert("注册失败，请重试！")
			}
		};
		ajaxobj.send()	
}
//注册新用户#####################################################################################################
function add_new_user_joyin(perid,username,password,sex,isproxy,proxynum,modelist,reModes,mobilephone,qqnum,active){
	 
		var putstr="perid="+perid+"&username="+username+"&password="+password+"&sex="+sex+"&isproxy="+isproxy+"&proxynum="+proxynum+"&modelist="+modelist+"&reModes="+reModes+"&mobilephone="+mobilephone+"&qqnum="+qqnum+"&active="+active;
		 
		var do_url=G("do_url").value
		 
		ajaxobj=new AJAXRequest;ajaxobj.method="POST";
		ajaxobj.content=putstr;
		ajaxobj.url=do_url+"?mod=ajax&code=add&list=user&flag=yes&"+putstr; 
		//openReturn("注册会员",ajaxobj.url);
		//return false;
		ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText; 
		if(response.indexOf("script")>0){
			alert('注册成功');
			var root_url=G("root_url").value
			window.location.href=root_url
		}else{
			alert("注册失败，请重试")
		}
		};
		ajaxobj.send()	

}
function put_isok(skey){
	Dialog.close(); 
	var titles="恭喜，注册成功!";
	if(skey=="no"){titles="注册失败!";}
	open9(titles)
	setTimeout("window.location.reload()",300)
	G("put_new_user").removeAttribute('disabled');
}
//删除的一行#####################################################################################################
function delrow(){
   var oElement=event.srcElement;
   while(oElement.tagName!="TR")
   {
      oElement=oElement.parentElement;
   }
   var oTBody=oElement.parentElement;
   oTBody.removeChild(oElement)
   var lostnum=parseInt(G("lost_num").innerHTML);
   G("lost_num").innerHTML=lostnum+1;
}
//注册代理时，无需填写开户配额
function isproxy(){
	 //alert(G("isproxy").value)
	if(G("isproxy").value=="用户"){
		G("proxynum").value="0";G("reBonus").value="0";
		G("proxynum").setAttribute('disabled',true);G("reBonus").setAttribute('disabled',true);
		//G("tr_isproxy").style.display="none";
	}else{
		G("proxynum").value="";G("reBonus").value="";
		G("proxynum").removeAttribute('disabled');G("reBonus").removeAttribute('disabled');
	}
}
//获取注册的用户名是否有相同的#############################################3333
function Get_username(thisinput,rooturl){ 
	
	
	if(thisinput.value!=""){ 
		if(thisinput.value.length-6<0){G("username_txt").innerHTML="<font color='red'>必须为6-12个字符</font>";return false;}
		if(thisinput.value.length-12>0){G("username_txt").innerHTML="<font color='red'>必须为6-12个字符</font>";return false;}
		G("username_txt").innerHTML="<font color='#777777'>正在查找是否有重名...</font>";
		ajaxobj=new AJAXRequest;ajaxobj.method="POST";
		ajaxobj.content="username="+thisinput.value;
		rooturl=G("do_url").value;
		ajaxobj.url=rooturl+"?mod=ajax&code=adduser&list=username&flag=yes&username="+thisinput.value; 
		ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText; alert(response);
		if(response-1==0){
			G("username_txt").innerHTML="<font color='green'>可用</font>";
			G("put_new_user").removeAttribute('disabled');
		}else{
			G("username_txt").innerHTML="<font color='red'>有重名</font>";
			G("username").className="input_G";G("put_new_user").setAttribute('disabled',true);
		}
		};
		ajaxobj.send()	
	} 
}
//获取注册的用户名是否有相同的#############################################3333
function Get_username_Joyin(thisinput,rooturl){
	if(thisinput.value!=""){ 
		if(thisinput.value.length-4<0){G("username_txt").innerHTML="<font color='red'>必须为6-12个字符</font>";return false;}
		if(thisinput.value.length-12>0){G("username_txt").innerHTML="<font color='red'>必须为6-12个字符</font>";return false;}
		G("username_txt").innerHTML="<font color='#777777'>正在查找是否有重名...</font>";
		var rooturl=G("rootURL").value;
		ajaxobj=new AJAXRequest;ajaxobj.method="POST";
		ajaxobj.content="username="+thisinput.value;
		ajaxobj.url=rooturl+"/ajax_adduser_username.aspx"; 
		ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText; 
		if(response-1==0){
			G("username_txt").innerHTML="<font color='green'>可用</font>";
			G("put_new_user").removeAttribute('disabled');
		}else{
			G("username_txt").innerHTML="<font color='red'>有重名</font>";
			G("username").className="input_G";G("put_new_user").setAttribute('disabled',true);
		}
		};
		ajaxobj.send()	
	} 
}
function copyinfor(id){
	try{
       var clipBoardContent=document.getElementById(id).innerHTML;
       window.clipboardData.setData("Text",clipBoardContent);
       var title = document.getElementById(id + "_title").innerHTML;
       alert( "【" + title + "】复制成功!" );
	}catch(e){
       alert('您的firefox安全限制限制您进行剪贴板操作，请打开’about:config’将signed.applets.codebase_principal_support’设置为true’之后重试！');
	}
}
 

