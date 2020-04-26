<div class="left-aside">
    <div class="header">
        <i class="control-icon"></i>
        <span>财务中心</span>
    </div>
    <div class="content">


        <div class="row  <!--{if $smarty.get.code eq 'orders'}-->active<!--{/if}-->">
            <a href="home_user_orders.html" >
                <i class="arrow-right"></i><span>帐变记录</span>
            </a>
        </div>



        <div class="row  <!--{if  $smarty.get.code eq 'recharge'  && $smarty.get.mod eq 'user'}-->active<!--{/if}-->">
            <a href="home_user_recharge.html" >
                <i class="arrow-right"></i><span>充值记录</span>
            </a>
        </div>


        <div class="row  <!--{if $smarty.get.code eq 'platform'  && $smarty.get.mod eq 'user'}-->active<!--{/if}-->">
            <a href="home_user_platform.html" >
                <i class="arrow-right"></i><span>提现记录</span>
            </a>
        </div>



        <div class="row <!--{if $smarty.get.code eq 'yingkui'}-->active<!--{/if}-->">
            <a href="home_user_yingkui.html">
                <i class="arrow-right"></i><span>盈亏报表</span>
            </a>
        </div>

        <div class="row <!--{if $smarty.get.code eq 'recharge' && $smarty.get.mod eq 'safe'}-->active<!--{/if}-->">
            <a href="home_safe_recharge.html">
                <i class="arrow-right"></i><span>我要充值</span>
            </a>
        </div>

        <div class="row  <!--{if $smarty.get.code eq 'platform'  && $smarty.get.mod eq 'safe'}-->active<!--{/if}-->">
            <a href="home_safe_platform.html" >
                <i class="arrow-right"></i><span>我要提现</span>
            </a>
        </div>
    </div>
</div>
<div class="right-aside">



    <div  class='eject'>

        <div class="tab">
            <!--{$navtitle}-->

        </div>

    </div>


