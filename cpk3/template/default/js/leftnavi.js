var NextUrl=document.getElementById('rootURL').value+"/highgame/do.aspx?controller="; 
nave_url=new Array("game","user_list","game_list","report_orders","set_userset","help_noticelist");
var navi_key=new Array();var navi_name=new Array();
navi_name[0]=Array("游戏中心","用户管理","游戏记录","报表管理","账户中心","帮助中心");
navi_key[0]=Array("game","user","records","report","safe","help");
navi_name[1]= Array("用户列表","我的团队","开户配额","增加用户");
navi_key[1]= Array("index|first","index|second","index|third","index|fourth");
navi_name[2]= Array("参与游戏信息","查看追号信息");
navi_key[2]= Array("index|tz","index|zh");
navi_name[3]= Array("账变列表","返点总额","报表查询");
navi_key[3]= Array("index|zb","index|fd","index|bb");
navi_name[4]= Array("频道设定","频道全览","修改密码","修改昵称","我要充值","我要提现","卡号绑定");
navi_key[4]= Array("set_userset","set_review","safe_password|pass","safe_password|name","safe_recharge","safe_platform","safe_bankinfo");
navi_name[5]= Array("公告列表","频道说明","玩法介绍","常见问题","版本信息");
navi_key[5]= Array("help_noticelist","help_channels","help_playinfo","help_answer","help_version");

function initMenu() {
  $('#menu ul').hide();
  //$('#menu ul:'+item).show();
  $('#menu li a').click(
    function() {
      var checkElement = $(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
} 
function re_play_s(item){ 
	var g_name=new Array("数字型","乐透型","基诺型","低频型","其他型");
	var k_name=new Array("a_sz","b_lt","c_jl","d_dp","e_qt");
	for (a=0;a<k_name.length;a++)
	{
		if(item==k_name[a]){return g_name[a];break;}
	}
} 

function showNavi(set_key,set_name){
	var innerHTML="";var ulHTML="";
	for (i=1;i<set_key.length;i++){
		if(set_key[i].length-1>=0){ 
			ulHTML="<li><a>"+set_name[0][i]+"</a><ul id='"+set_key[0][i]+"'>";
			for (j=0;j<set_key[i].length;j++){
				ulHTML+="<li><a href='"+set_key[i][j]+"' title='keys'>"+set_name[i][j]+"</a></li>";
			}
			ulHTML+="</ul></li>";
			innerHTML+=ulHTML; 
		}
	} 
	document.write(innerHTML) ;
}
function showGame(){
	   var games="";var game_list=new Array();var keys;var names;var orders;var innerHTML="";var liHTML="";var ulHTML="";
	   var g_list=new Array();var lx_name="";
	   games=window.top.document.getElementById('game_name_list').value;
	   var NextUrl=window.top.document.getElementById('RootUrl').value+"/highgame/do.aspx?controller="; 
	   game_list=games.split("^");
	   for (i=0;i<game_list.length;i++){ 
		   lists=game_list[i].split("|");
		   keys=lists[0];names=lists[1];orders=Trim(lists[3]); 
		   innerHTML=document.getElementById("menu").innerHTML;
		   if(keys!="" && names!=""){//alert(orders+"|"+names)
			   if(document.getElementById(orders)){
				   ulHTML=document.getElementById(orders).innerHTML;
				   liHTML="<li><a id='"+keys+"' href='"+NextUrl+nave_url[0]+"&action=game&paras="+keys+"' target='mainframe'>"+names+"</a></li>";
			       document.getElementById(orders).innerHTML=ulHTML+liHTML;
			   }else{
				   lx_name=re_play_s(orders);
				   ulHTML="<li><a id='ul_"+orders+"'><b>"+lx_name+"</b></a><ul id='"+orders+"'><li><a id='"+keys+"' href='"+NextUrl+nave_url[0]+"&action=game&paras="+keys+"' target='mainframe'>"+names+"</a></li></ul></li>"; 
			       document.getElementById("menu").innerHTML=innerHTML+ulHTML; 
			   } 
		   }  
	   }
}