<div class="left-aside">
    <div class="header">
        <i class="control-icon"></i>
        <span>团队中心</span>
    </div>
    <div class="content">
        <!--{if $userinfo['isproxy']==0}-->
        <div class="row  <!--{if $smarty.get.code eq 'list'}-->active<!--{/if}-->">
            <a href="home_user_list.html" >
                <i class="arrow-right"></i><span>用户管理</span>
            </a>
        </div>



        <div class="row  <!--{if $smarty.get.code eq 'add'}-->active<!--{/if}-->">
            <a href="home_user_add.html" >
                <i class="arrow-right"></i><span>新增用户</span>
            </a>
        </div>



        <div class="row  <!--{if $smarty.get.code eq 'url'}-->active<!--{/if}-->">
            <a href="home_user_url.html" >
                <i class="arrow-right"></i><span>推广链接</span>
            </a>
        </div>




        <!--{if $user_wage eq '1' || $sys_user eq '1'}-->
        <div class="row  <!--{if $smarty.get.code eq 'wagelog'}-->active<!--{/if}-->">
            <a href="home_user_wagelog.html" >
                <i class="arrow-right"></i><span>工资记录</span>
            </a>
        </div>

        <!--{/if}-->
        <!--{if $user_fenhong eq '1' || $sys_user eq '1'}-->

        <div class="row  <!--{if $smarty.get.code eq 'fenhonglog'}-->active<!--{/if}-->">
            <a href="home_user_fenhonglog.html" >
                <i class="arrow-right"></i><span>契约分红</span>
            </a>
        </div>

        <!--{/if}-->

        <!--{/if}-->





    </div>
</div>
<div class="right-aside">



    <div  class='eject'>

        <div class="tab">
            <!--{$navtitle}-->

        </div>

    </div>

