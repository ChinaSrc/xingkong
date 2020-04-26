<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<div class="top">
<div style="display: inline-block;padding-left:20px;height: 50px;line-height: 50px;color: #fff;font-size: 18px;">
    <!--{$navtitle}-->
</div>


    <div style="display: inline-block;float:right;padding-right:15px;height: 50px;line-height: 50px;color: #fff;font-size: 20px;">

        <a href="home_safe_msg.html" style="color: #fff;position: relative;"><i class="icon-email"></i>
            <!--{if $msg_num>0}-->
            <span  style='position:absolute;right:-8px;top:-5px;display:block;background-color:#f9ac0c;color:#fff;font-size:12px;width: 16px;height:16px;line-height:16px;border-radius:50%;text-align: center;' ><!--{$msg_num}--></span>

            <!--{/if}-->
        </a>
        &nbsp;
        <a href="<!--{$ServiceUrl}-->" target="_blank"  style="color: #fff;"> <i class="icon-menu-4"></i></a>
    </div>

</div>
<div style="position: fixed;top:50px;left:0px;right:0px;background-color: #fff;">

    <div  class="topInfo">
        <a href="home_safe_info.html"><img  src="<!--{avatar($userinfo['userid'])}-->"></a>
        <p >欢迎您，<ins  id="UserName" style="font-weight: bold;"><!--{$cur_username}--></ins></p>
        <span >余额：<ins  id="UserBalance" style="color: rgb(220, 59, 64);"><!--{$cur_amount}--></ins></span>

        <span > &nbsp; 洗码：<ins  id="UserBalance" style="color: rgb(220, 59, 64);"><!--{$low_amount}--></ins></span>
 <a ><em ><!--{$group['title']}--></em></a>
    </div>
    

</div>

<div  class="topMoney" style="margin-top: 95px;margin-bottom: 10px;height: 40px;line-height: 40px;">
    <a  href="home_safe_recharge.html?mobile=1" class="active"><i  class="m0 icon-coins-money-stack"></i><span >充值</span></a>
    <a  href="home_safe_platform.html?mobile=1" class="active" ><i class="m1 icon-ok"></i> <span >提现</span></a>
    <a  href="home_safe_chat.html?mobile=1" class="active" ><i class="m2 icon-squares"></i> <span >聊天室充值</span></a>
</div>

<div  class="options">
    <a  href="home_user_buy.html?mobile=1" class="active"><i class="icon-slot" style="color: #31b8e9;"></i><span >投注记录</span> <i  class=" fr icon-right-open-big"></i></a>
    <a  href="home_user_orders.html?mobile=1" class="active"><i class="icon-money-1" style="color:#f44;"></i><span >交易记录</span> <i  class=" fr icon-right-open-big"></i></a>
    <a  href="home_report_list.html" class="active"><i class="m3 icon-slot"></i><span >今日盈亏</span> <i  class=" fr icon-right-open-big"></i></a>
    <!--{if $userinfo['isproxy']==0}-->
    <a  href="home_user_nav.html" class="active" style="position: relative;"><i class="icon-users-1" style="color: #31b8e9;"></i><span >代理中心</span>
        <span  class="agentMark">零投资，躺着也能赚钱</span>  <i  class=" fr icon-right-open-big"></i></a>
<!--{/if}-->
</div>



<div  class="options" style="margin-top: 15px;">
    <a  href="home.html?mobile=1" class="active"><i class="icon-lock" style="color: #b01622;"></i><span >安全中心</span> <i  class=" fr icon-right-open-big"></i></a>
    <a  href="home_safe_bankinfo.html" class="active"><i class="icon-credit-card" style="color:#f44;"></i><span >银行卡管理</span> <i  class=" fr icon-right-open-big"></i></a>
    <a  href="logout.aspx" class="active"><i class="m3 icon-logout"></i><span >安全退出</span> <i  class=" fr icon-right-open-big"></i></a>

</div>











</div>
</div>
<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
