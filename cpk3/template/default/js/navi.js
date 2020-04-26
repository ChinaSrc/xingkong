var navi_key=new Array();var navi_name=new Array();
var NextUrl=window.top.document.getElementById('RootUrl').value+"/highgame/do.aspx?controller="; 
nave_url=new Array("game","user_list","game_list","report_orders","set_userset","help_noticelist"); 
navi_name[0]=Array("游戏中心","用户管理","游戏记录","报表管理","账户中心","帮助中心");
navi_key[0]=Array("game","user","records","report","safe","help");
navi_name[1]= Array("用户列表","我的团队","开户配额","增加用户");
navi_key[1]= Array("user_list","user_team","user_kaihuPE","user_adduser.php");
navi_name[2]= Array("参与游戏信息","查看追号信息");
navi_key[2]= Array("game_list","game_task");
navi_name[3]= Array("账变列表","返点总额","报表查询");
navi_key[3]= Array("report_orders","report_point","report_list");
navi_name[4]= Array("频道设定","频道全览","频道转账","我要提现","修改密码","修改昵称","我要充值","我要提现","卡号绑定");
navi_key[4]= Array("set_userset","set_review","safe_transfer","safe_withdraw","safe_password","change_name","safe_recharge","safe_platform","safe_bankinfo");
navi_name[5]= Array("公告列表","频道说明","玩法介绍","常见问题","版本信息");
navi_key[5]= Array("help_noticelist","help_channels","help_playinfo","help_answer","help_version");

function get_body_file(item){
	var re_str="";alert(item+"|"+navi_key[0])
	for (i=0;i<navi_key[0];i++)
	{
		if(navi_key[0][i]==item){re_str=nave_url[i];break;}
	}
	return re_str;
}