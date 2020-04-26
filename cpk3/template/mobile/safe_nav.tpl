
          <div  class='eject'>
          
          <div class="tab">
<ul>
            <li <!--{if $smarty.get.code eq 'index'}-->class="cur"<!--{/if}-->><a href="home.html">个人中心</a></li>
            <li  <!--{if $smarty.get.code eq 'pass'}-->class="cur"<!--{/if}-->><a href="home_safe_pass.html">登陆密码</a></li>
            <li  <!--{if $smarty.get.code eq 'pwd2'}-->class="cur"<!--{/if}-->><a href="home_safe_pwd2.html">提现密码</a></li>
            <li <!--{if $smarty.get.code eq 'bankinfo'}-->class="cur"<!--{/if}-->><a href="home_safe_bankinfo.html">我的银行卡</a></li>
                <li <!--{if $smarty.get.code eq 'recharge'}-->class="cur"<!--{/if}-->><a href="home_report_recharge.html">资金管理</a></li>
                      <li <!--{if $smarty.get.code eq 'list'}-->class="cur"<!--{/if}-->><a href="home_report_list.html">个人报表</a></li>
            <!--{if $user_fenhong eq '1'}-->
            <li <!--{if $smarty.get.code eq 'fenhong'}-->class="cur"<!--{/if}-->><a href="home_safe_fenhong.html">我的契约</a></li>
            
            <!--{/if}-->
            
                <!--{if $user_wage eq '1'}-->
            <li <!--{if $smarty.get.code eq 'wage'}-->class="cur"<!--{/if}-->><a href="home_safe_wage.html">我的日工资</a></li>
            
            <!--{/if}-->
        </ul>
    </div>
          
          </div>
          