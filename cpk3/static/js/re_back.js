function re_user_list_level(perid,response){
	var levels=response.split("#");var uerss=new Array();
	var uid,uname,lowuser,amount,online;var innerHTML="";var showonlines="";
	var maxu=levels.length;
	var do_this_url=G("do_this_url").value;
	for (i=0;i<maxu;i++)
	{
		uerss=levels[i].split("|");
		uid=uerss[0];
		uname=uerss[1];
		lowuser=uerss[2];
		amount=uerss[3];
		online=uerss[4];
		if(parseInt(online,10)-1>=0){showonlines="<font color=red>(在线)</font>";}else{showonlines="";}

		if (maxu-i==1)
		{
			if(parseInt(lowuser,10)-1>=0){
				innerHTML+="<li id='level_"+uid+"' class='expandable lastExpandable'><div class='hitarea expandable-hitarea lastExpandable-hitarea' onclick=\"user_list_level('"+uid+"')\"></div>";
				innerHTML+="<a href='"+do_this_url+"&list=body&uid="+uid+"' target='mainframe'><strong>"+uname+"</strong>"+showonlines+"</a>";
		        innerHTML+="<ul style='display: none;line-height:18px;background-color:#ffffff;' id='user_"+uid+"' name='user_"+uid+"'></ul></li>";
			}else{
				innerHTML+="<li class='last'><a href='"+do_this_url+"&list=body&uid="+uid+"' target='mainframe'>"+uname+showonlines+"</a></li>";
			}

		}else{
			if(parseInt(lowuser,10)-1>=0){
				innerHTML+="<li id='level_"+uid+"' class='expandable'><div class='hitarea expandable-hitarea' onclick=\"user_list_level('"+uid+"')\"></div>";
				innerHTML+="	<a href='"+do_this_url+"&list=body&uid="+uid+"' target='mainframe'><strong>"+uname+"</strong>"+showonlines+"</a>";
			    innerHTML+="  <ul style='display: none;line-height:18px;background-color:#ffffff;' id='user_"+uid+"' name='user_"+uid+"'></ul></li>";
		          
			}else{
				innerHTML+=" <li><a href='"+do_this_url+"&list=body&uid="+uid+"' target='mainframe'>"+uname+showonlines+"</a></li>"; 
			}
		} 
	} 
	if(document.getElementById("level_"+perid)){ 
        document.getElementById("user_"+perid).innerHTML=innerHTML; 
		//var this_ul=document.getElementById("level_"+perid).getElementByTagName('ul'); 
	}
}

function cancelMouse(){return false;}


function mover(o){
    o.style.backgroundPosition='0 bottom';
}

function mout(o){
    o.style.backgroundPosition='0 top';
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function subWin(swf){
  window.open(swf,"gameOpen","width=1024,height=768");
}
function subWinRule(swf){
  window.open(swf,"gameOpenRule","width=1024,height=768,scrollbars=yes");
}
 
//按鈕特效
$(function(){
	$('.gameIMG a img').hover(
		function(){
			$(this).stop().animate({'opacity': 0}, 650);
		}, function(){
		   $(this).stop().animate({'opacity': 1}, 650);
		}
	);
});