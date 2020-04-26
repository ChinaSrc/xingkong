//奖金倍投等设置#############################################################
function Save_Item(keys,itemkey,itemname){ 
	if(keys=="all"){ 
		G("edit_"+itemkey).style.display="none";
		G("save_"+itemkey).style.display=""; 
		var values=G("item_"+itemkey).value;
		var item=itemname+"_"+itemkey;
		if(G("input_list").value!=""){
			var input_list=G("input_list").value;
			var lists=input_list.split("|");
			for (i=0;i<lists.length;i++)
			{    
				var is_qw="no";
				if(lists[i].indexOf("qwsx")>0){is_qw="yes";}
				if(lists[i].indexOf("qwex")>0){is_qw="yes";}
				if(lists[i].indexOf("qjsx")>0){is_qw="yes";}
				if(lists[i].indexOf("qjex")>0){is_qw="yes";}// alert(is_qw)
				if(is_qw=="no"){
					G("item_"+itemkey+"_"+lists[i]).value=values
				}
			}
		}
	}else{
		G("edit_"+itemkey+"_"+keys).style.display="none";
		G("save_"+itemkey+"_"+keys).style.display="";
		var item=itemname+"_"+itemkey;var values=G("item_"+itemkey+"_"+keys).value;
	}
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName; 
	var playkey=G("playkey").value;
	var input_list=G("input_list").value;
	var dbname="game_set";
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="dbname="+dbname+"&id="+keys+"&item="+item+"&values="+values+"&playkey="+playkey+"&input_list="+input_list;
	//alert(ajaxobj.content);return false;
	ajaxobj.url=thisPathUrl+"/?action=save_game_set_ajax&flag=yes";
	ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;
	if(keys=="all"){
		if(item.indexOf('rize')>0){Dialog.alert("趣味玩法的奖金包含二等奖，请按照“一等奖金|二等奖金，如:130|60”的格式进行修改")}
		
		G("edit_"+itemkey).style.display="";
		G("save_"+itemkey).style.display="none";
	}else{
		G("edit_"+itemkey+"_"+keys).style.display="";
		G("save_"+itemkey+"_"+keys).style.display="none";
	} 
	};
	ajaxobj.send(); 
}


function Save_Item1(itemkey,itemname){ 

		G("edit_"+itemkey).style.display="none";
		G("save_"+itemkey).style.display="";
		var item=itemname;var values=G("item_"+itemkey).value;
	
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName; 
	var playkey=G("playkey").value;
	var input_list=G("input_list").value;
	var dbname="game_set";
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="dbname="+dbname+"&id="+itemkey+"&item="+item+"&values="+values+"&playkey="+playkey+"&input_list="+input_list;
	//alert(ajaxobj.content);return false;
	ajaxobj.url=thisPathUrl+"/?action=save_game_set_ajax&flag=yes";
	ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;

		G("edit_"+itemkey).style.display="";
		G("save_"+itemkey).style.display="none";
	
	};
	ajaxobj.send(); 
}
function ShowUserItem(keys,itemkey,response,item){ alert(keys,itemkey,response,item)
	if(keys=="all"){
		if(item.indexOf('rize')>0){Dialog.alert("趣味玩法的奖金包含二等奖，请按照“一等奖金|二等奖金，如:130|60”的格式进行修改")}
		
		G("edit_"+itemkey).style.display="";
		G("save_"+itemkey).style.display="none";
	}else{
		G("edit_"+itemkey+"_"+keys).style.display="";
		G("save_"+itemkey+"_"+keys).style.display="none";
	} 
}
//用户列表#####################################################################
function Edit_User(uid,itemkey,itemname){
	G("input_"+itemkey+"_"+uid).style.display="";
	G("save_"+itemkey+"_"+uid).style.display=""; 
	G("show_"+itemkey+"_"+uid).style.display="none";
	G("edit_"+itemkey+"_"+uid).style.display="none"; 
}
function Save_User(uid,itemkey,itemname){ 
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	G("input_"+itemkey+"_"+uid).style.display="none";
	G("save_"+itemkey+"_"+uid).style.display="none";
	G("ing_"+itemkey+"_"+uid).style.display="";
	var dbname="user";
	if(itemname=="amount"){dbname="user_bank";}
	if(itemname=="hig_amount"){dbname="user_bank";}
	if(itemname=="low_amount"){dbname="user_bank";}
	var values=G(itemname+"_"+uid).value;
	G("show_"+itemkey+"_"+uid).innerHTML=values; 
	if(itemkey=="isp"){if(values-1==0){var ispvalue="会员"}else if(values-1<0){var ispvalue="代理"}else if(values==2){var ispvalue="总代"}G("show_"+itemkey+"_"+uid).innerHTML=ispvalue;}
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="dbname="+dbname+"&id="+uid+"&item="+itemname+"&values="+values; 
	ajaxobj.url=thisPathUrl+"/?flag=yes&action=save_infor_ajax";
	ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;window.setTimeout("Show_User_Item('"+uid+"','"+itemkey+"')",500);};
	ajaxobj.send()
    //window.setTimeout("Show_User_Item('"+uid+"','"+itemkey+"')",500);
}
function Show_User_Item(uid,itemkey){ 
	G("show_"+itemkey+"_"+uid).style.display="";
	G("edit_"+itemkey+"_"+uid).style.display=""; 
	G("ing_"+itemkey+"_"+uid).style.display="none";
}
//返点设置#############################################################Save_Ret_Item('".$rows2[skey]."','1800','rebate')
function Save_Ret_Item(keys,itemkey,itemname){ 
	var hig_re_num=G("higid_"+itemkey+"_"+keys).value;
	var values=G("item_"+itemkey+"_"+keys).value;
	var MaxBonus=G("MaxBonus").value;//系统最大返点值
	var MinBonus=G("MinBonus").value;//级别之间系统最大返点差
	if(isNaN(values)){alert("请输入数字");return false;}
	if(parseInt(values)-parseInt(hig_re_num)>0){alert("["+keys+"]["+itemkey+"模式]超过了系统最大或该用户上一级的返点值，请重新输入");G("item_"+itemkey+"_"+keys).value="";return false;}
	if(parseFloat(hig_re_num)-parseFloat(values)-parseFloat(MinBonus)<0){alert("["+keys+"]["+itemkey+"模式]与上级返点值小于["+MinBonus+"]，请重新输入");G("item_"+itemkey+"_"+keys).value="";return false;}
	
	if(values==""){alert("您还未输入数据！");return false;}
	var olds=G("old_"+itemkey+"_"+keys).innerHTML;var active;//如果已经存在该值，则是更新数据，否则是插入数据。
	if(olds=="yes"){active="update";}else{active="insert";}
	var uid=G("uid").value; var playkey=G("playkey").value; 
 
	G("edit_"+itemkey+"_"+keys).style.display="none";
	G("save_"+itemkey+"_"+keys).style.display="";
	var item=itemname+"_"+itemkey;

	var dbname="game_rebate"; 
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="dbname="+dbname+"&id="+keys+"&item="+itemkey+"&values="+values+"&active="+active+"&uid="+uid+"&playkey="+playkey+"";
	ajaxobj.url="save_rebate_ajax.aspx"; 
	ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;window.setTimeout("ShowRetItem('"+keys+"','"+itemkey+"')",500);};
	ajaxobj.send()
}
function ShowRetItem(keys,itemkey){
		G("edit_"+itemkey+"_"+keys).style.display="";
		G("save_"+itemkey+"_"+keys).style.display="none";
		G("old_"+itemkey+"_"+keys).innerHTML="yes"; 
}	

function Save_Ret_all(skey){
	var list_bdw=G('list_bdw').value.split("|");
	var list_other=G('list_other').value.split("|");
	var values=G('item_'+skey).value; 
	if(values==""){alert("您还未输入数据！");return false;}
	for (j=0;j<document.getElementsByName("do_xz").length;j++)
	{
		if(document.getElementsByName("do_xz")[j].checked==true){var thisselect=document.getElementsByName("do_xz")[j].value;}
	}
	if(thisselect=="bdw" && list_bdw!=""){
		for (i=0;i<list_bdw.length;i++)
		{
			G("item_"+skey+"_"+list_bdw[i]).value=values 
			window.setTimeout("Save_Ret_Item('"+list_bdw[i]+"','"+skey+"','rebate')",500)
		} 
	}
	if(thisselect=="other" && list_other!=""){
		for (i=0;i<list_other.length;i++)
		{
			G("item_"+skey+"_"+list_other[i]).value=values 
			window.setTimeout("Save_Ret_Item('"+list_other[i]+"','"+skey+"','rebate')",500)
		} 
	}
}



//######################################################################################################################################
//##########  以下获取开奖数据JS  ######################################################################################################
//###################################################################################################################################### 
var objTimer;
//奖金倍投等设置#############################################################
function GetLot(playkey){
	//获取相关配置数据
	window.clearInterval(objTimer);
	//Add_Show_infor(playkey,"开始获取配置...",4,"<br>","");
	var title=G("title_"+playkey).value;
	var gapTime=G("gap_"+playkey).value;
	var beginTime=G("begin_"+playkey).value;
	var endTime=G("end_"+playkey).value;
	var lotNum=G("lotNum_"+playkey).value;
	var lotTime=G("lotTime_"+playkey).value; 
	var lotlinks=G("links_"+playkey).value;
	//alert(mytime);return false;
	if(title.indexOf("|")=="-1"){ 
		//只有一个时间设置的，如江西时时彩
		var titles=title;
		var gaptimes=gapTime;
		var beginTimes=beginTime;
		var endTimes=endTime;
	}else{                        
		//有二个时间设置的，如重庆时时彩白天场和夜场.
		var title_s=title.split("|");
		var gapTime_s=gapTime.split("|");
		var beginTime_s=beginTime.split("|");
		var endTime_s=endTime.split("|");
        for (i=0;i<title_s.length;i++)
        {
			var new_begin=beginTime_s[i];
			var new_endTime=endTime_s[i];
			var isnows=isThisTime(new_begin,new_endTime,playkey); 
			if(isnows=="yes"){
				var titles=title_s[i]; 
				var gaptimes=gapTime_s[i]; 
				var beginTimes=new_begin;
				var endTimes=new_endTime;
			} 
        } 
	}
	if(!gaptimes){
		if(beginTimes==""){
			Add_Show_infor(playkey,"<b>未找到时间配置</b>",2,"<br>","");
		}else{
			Add_Show_infor(playkey,"未到开奖时间",3,"<br>","");
			gapTime=600000; 
			objTimer = window.setInterval("GetLot('"+playkey+"')",gapTime); 
		}
		
		return false
	}
 
	if(lotlinks.indexOf("|")!="-1"){ 
		var lotlinks_s=lotlinks.split("|");
		var now_link=lotlinks_s[0];var next_link;
		for (i=1;i<lotlinks_s.length;i++)
		{
			if(next_link==""){next_link=lotlinks_s[i];}else{next_link=next_link+"|"+lotlinks_s[i];}
		}  
	 }else{
		 var now_link=lotlinks;var next_link="";
	 }
	 window.setTimeout("Ajax_GetLot('"+playkey+"','"+now_link+"','"+next_link+"')",500);  
}
function Ajax_GetLot(playkey,now_link,next_link){
			var rerun_get="no";
	        var content="playkey="+playkey+"&links="+now_link;
			//Add_Show_infor(playkey,"正在解析数据地址:"+now_link+"",2,"<br>","");
            ajaxobj=new AJAXRequest;
            ajaxobj.method="POST";
            ajaxobj.content=content; 
            ajaxobj.url="Ajax_LotNum.aspx";
            ajaxobj.callback=function(xmlobj){
				var response = xmlobj.responseText;
			    if(response.indexOf("file_get_contents")< 0){
					ShowLot_Infor(playkey,response); 
					return false;
                }else{ 
					if(next_link!="" && typeof(next_link)!="undefined"){
						var new_now_link;var new_next_link;
						//Add_Show_infor(playkey,"未能获取...",2,"<br>","");
						if(next_link.indexOf("|")<0){
							new_now_link=next_link;new_next_link=""
						}else{
							link_s=next_link.split("|");;var new_next_link;
							for (i=1;i<next_link.length;i++)
							{
								if(new_next_link==""){new_next_link=next_link[i];}else{new_next_link=next_link+"|"+next_link[i];}
							}
							new_now_link=next_link[0];
						}
						if(new_now_link!="" && typeof(new_now_link)!="undefined"){
						//	Add_Show_infor(playkey,"将进入下一个地址"+new_now_link,2,"<br>","");
							window.setTimeout("Ajax_GetLot('"+playkey+"','"+new_now_link+"','"+new_next_link+"')",500);
						}else{
							rerun_get="yes"; 
						}
						
					}else{
						rerun_get="yes"; 
					} 
					 
				}
			}
            ajaxobj.send()
	
}
function ShowLot_Infor(playkey,response){
	if(response.indexOf("#^#")<0){
		list_s=response.split("|"); 
	}else{
		var max_list=response.split("#^#");
		list_s=max_list[0].split("|"); 
	}
	var qihaos=list_s[0];var lotnums=list_s[1];
	Add_Show_infor(playkey,"期号："+qihaos+" 开奖号："+lotnums,2,"<br>","");
	var gapTime=10; 
} 

function  Add_Show_infor(playkey,values,type,br,isnew){
	var colors="#999999";
	if(type-1<0){colors="#999999";}
	if(type-1==0){colors="#444444";} 
	if(type-2==0){colors="red";}
	if(type-3==0){colors="blue";}
	if(type-4==0){colors="green";}
	var LastValue=G("div_"+playkey).innerHTML;
	if(isnew-1==0){LastValue="";}
	var NewValue=LastValue+br+"<font color='"+colors+"'>"+values+"</font>";
	G("div_"+playkey).innerHTML=NewValue;
}
function isThisTime(begintime,endtime,playkey){ 
	var myDate = new Date();
	if(endtime=="00:00:00"){endtime="23:59:59";} 
	var mytime=myDate.toLocaleTimeString();  
	begintime=begintime.replace(":","");begintime=parseInt(begintime.substr(0,4));
	endtime=endtime.replace(":","");endtime=parseInt(endtime.substr(0,4));
	mytime=mytime.replace(":","");mytime=parseInt(mytime.substr(0,4));
	if((mytime-begintime>=0)&&(endtime-mytime>0)){
		//alert("yes|mytime"+mytime+"begintime:"+begintime+"endtime:"+endtime+playkey);
		var flags="yes";
	}else{
		//alert("no|mytime"+mytime+"begintime:"+begintime+"endtime:"+endtime+playkey);
		var flags="no";
	}
	return flags;
}
