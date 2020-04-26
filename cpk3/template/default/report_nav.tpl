<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<!--头部链接开始-->
<!--主导航-->
<div id="bd">

    <div id="main" class="clearfix">


        <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->





        <div class="home_rec clearfix">
            <div class="safeHeader mgb10">
                <div class="star">
                    <i class="icon-star curr"></i>
                    <i class="icon-star curr"></i>
                    <i class="icon-star curr"></i>
                    <i class="icon-star <!--{if $star>=4}-->curr<!--{/if}-->"></i>
                    <i class="icon-star <!--{if $star>=5}-->curr<!--{/if}-->"></i>
                </div>
                <div class="text"><strong>您的账号安全级别为<i>中</i>，可以通过完善安全信息提高级别。</strong>
                    <p>上次登录： <ins><!--{date('Y-m-d H:i:s',$login['time'])}--></ins><ins><!--{$login['address']}--></ins></p>
                </div>
            </div>
            <ul class="safeList">
                <li><span class="defFont icon-key"></span>
                    <span class="text"><strong>登陆密码</strong>
                                    <p>建议您使用字母和数字的组合、混合大小写、在组合中加入下划线等符号。</p></span>
                    <span class="btn11"><a href="home_safe_pass.html" class="">修改密码</a></span></li>


                <!--{if $pwd2}-->
                <li ><span class="defFont icon-lock"></span> <span class="text"><strong>已设置提现密码</strong>
                                    <p>提现密码用于提现、绑定银行卡等操作，可保障资金安全。</p></span>
                    <span class="btn11"><a href="home_safe_pwd2.html" class="">修改提现密码</a>

                        <!--{if $mibao}-->

                               <a href="home_safe_pwd3.html" class="">忘记提现密码</a>
                        <!--{/if}-->
                                </span>


                </li>

                <!--{else}-->

                <li class="noSet"><span class="defFont icon-lock"></span> <span class="text"><strong>未设置提现密码</strong>
                                    <p>提现密码用于提现、绑定银行卡等操作，可保障资金安全。</p></span>
                    <span class="btn11"><a href="home_safe_pwd2.html" class="">设置提现密码</a></span>


                </li>

                <!--{/if}-->



                <!--{if $mibao}-->
                <li ><span class="defFont icon-lock-2"></span>
                    <span class="text"><strong>已设置密保问题</strong>
                                    <p>密保问题可以增加账户安全性，快速找回帐号密码。</p></span>
                    <span class="btn11"><a href="home_safe_mibao.html" class="">修改密保问题</a></span></li>
                <!--{else}-->

                <li class="noSet"><span class="defFont icon-lock-2"></span>
                    <span class="text"><strong>未设置密保问题</strong>
                                    <p>密保问题可以增加账户安全性，快速找回帐号密码。</p></span>
                    <span class="btn11"><a href="home_safe_mibao.html" class="">设置密保问题</a></span></li>

                <!--{/if}-->

            </ul>









        </div>
        <!--详细内容iframe-end-->


    </div>
</div>
<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
