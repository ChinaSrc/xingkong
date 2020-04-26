<div class="left-aside">
    <div class="header">
        <i class="control-icon"></i>
        <span>游戏记录</span>
    </div>
    <div class="content">

        <div class="row  <!--{if $smarty.get.code eq 'buy'}-->active<!--{/if}-->">
            <a href="home_user_buy.html" >
                <i class="arrow-right"></i><span>投注记录</span>
            </a>
        </div>
        <div class="row  <!--{if $smarty.get.code eq 'task'}-->active<!--{/if}-->">
            <a href="home_user_task.html" >
                <i class="arrow-right"></i><span>追号记录</span>
            </a>
        </div>
        <!--{if $con_system['hm_open']=='1'}-->
        <div class="row  <!--{if $smarty.get.code eq 'hemai'}-->active<!--{/if}-->">
            <a href="home_user_hemai.html" >
                <i class="arrow-right"></i><span>合买记录</span>
            </a>
        </div>

    <!--{/if}-->


    </div>
</div>
<div class="right-aside">



    <div  class='eject'>

        <div class="tab">
            <!--{$navtitle}-->

        </div>

    </div>


