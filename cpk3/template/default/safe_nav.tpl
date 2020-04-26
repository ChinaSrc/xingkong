<div class="left-aside">
    <div class="header">
        <i class="control-icon"></i>
        <span>帐户中心</span>
    </div>
    <div class="content">
        <div class="row <!--{if $smarty.get.code eq 'index'}-->active<!--{/if}-->">
            <a href="home.html">
                <i class="arrow-right"></i><span>帐户中心</span>
            </a>
        </div>
        <div class="row  <!--{if $smarty.get.code eq 'list'}-->active<!--{/if}-->">
            <a href="home_report_list.html" >
                <i class="arrow-right"></i><span>个人报表</span>
            </a>
        </div>
        <div class="row  <!--{if $smarty.get.code eq 'pass'}-->active<!--{/if}-->">
            <a href="home_safe_pass.html" >
                <i class="arrow-right"></i><span>登录密码</span>
            </a>
        </div>


<div class="row  <!--{if $smarty.get.code eq 'pwd2'}-->active<!--{/if}-->">
<a href="home_safe_pwd2.html" >
    <i class="arrow-right"></i><span>提现密码</span>
</a>
</div>



<div class="row  <!--{if $smarty.get.code eq 'bankinfo'}-->active<!--{/if}-->">
<a href="home_safe_bankinfo.html" >
    <i class="arrow-right"></i><span>我的银行卡</span>
</a>
</div>

        <div class="row  <!--{if $smarty.get.code eq 'msg'}-->active<!--{/if}-->">
            <a href="home_safe_msg.html" >
                <i class="arrow-right"></i><span>消息管理
                    <!--{if $msg_num>0}-->
                    <span  style='color:#fff;background-color:#ff0000;font-size:12px;width: 18px;height:18px;line-height:18px;border-radius:50%;text-align: center;' ><!--{$msg_num}--></span>
<!--{/if}-->
                </span>




            </a>
        </div>


<!--{if $user_fenhong eq '1'}-->
<div class="row  <!--{if $smarty.get.code eq 'fenhong'}-->active<!--{/if}-->">
<a href="home_safe_fenhong.html" >
    <i class="arrow-right"></i><span>我的契约</span>
</a>
</div>
<!--{/if}-->

<!--{if $user_wage eq '1'}-->
<div class="row  <!--{if $smarty.get.code eq 'wage'}-->active<!--{/if}-->">
<a href="home_safe_wage.html" >
    <i class="arrow-right"></i><span>我的工资</span>
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
