<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



<div  class="main" s="[object Object]">
    <div  class="ag-sum">
        <p  class="p1">我的下级 (人)</p>
        <p  class="p2"><!--{$team['num']}--></p>
        <p  class="p3">累计返佣 (元) &nbsp;<!--{number_show($userinfo['rebatesum'])}--></p>
        <em onclick="location.href='home_user_fandian.html';" >返佣明细</em>
    </div>
    <div  class="rb-ty">
        <div >
            <p >昨日返佣 (元)</p>
            <span ><!--{$rebates['yestoday']}--></span>
        </div>
        <div >
            <p >今日返佣 (元)</p>
            <span ><!--{$rebates['today']}--></span>
        </div>
    </div>
    <div  class="ag-bot" style="height: 300px">
        <div >
            <a  href="home_user_update.html" class="ag-part ml"> <i class="icon-bookmark" style="color:green;"></i><p >代理说明</p></a>
            <a  href="home_user_url.html" class="ag-part mr">  <i class="icon-user-add" style="color:#b01622;"></i><p >下级开户</p></a>
        </div>
        <div >
            <a  href="home_team_info.html?mobile=1" class="ag-part ml"> <i class="icon-database" style="color: #f55;"></i><p >代理报表</p></a>
            <a  href="home_user_list.html" class="ag-part mr">  <i class="icon-users-1" style="color: #31b8e9;"></i><p >下级管理</p></a>
        </div>
        <div >
            <a  href="home_user_buy.html?st=2" class="ag-part ml"><i class="icon-slot" style="color: #31b8e9;"></i><p >下级投注明细</p></a>
            <a  href="home_user_orders.html?st=2" class="ag-part mr"><i class="icon-money-1" style="color:#f44;"></i><p >下级交易明细</p></a>
        </div>
    </div>
    <div  class="bot-tip">
        简单做代理，轻松赢收益
    </div>
</div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
