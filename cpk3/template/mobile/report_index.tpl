<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<style>

    .home_rec li{
        background-color: #fff;
        height:40px;
        line-height: 40px;
        padding: 0px 10px;
        border-bottom: 1px solid #ddd;
        clear: both;
    }
    .home_rec li span{
        display: inline-block;
        overflow: hidden;
        height:40px;
        line-height: 40px;
    }
    .home_rec li span:first-child{
        float: left;
        width: 120px;
        text-align: right;
    }
    .home_rec li span:last-child{
        padding-right: 5px;
        text-align: right;
        float: right;

    }

</style>
        <div class="home_rec clearfix">
            <div class="safeHeader mgb10">
                <div class="star">
                    <i class="icon-star curr"></i>
                    <i class="icon-star curr"></i>
                    <i class="icon-star curr"></i>
                    <i class="icon-star <!--{if $star>=4}-->curr<!--{/if}-->"></i>
                    <i class="icon-star <!--{if $star>=5}-->curr<!--{/if}-->"></i>
                </div>
                <div class="text"><strong>您的账号安全级别为<i>中</i>。</strong>
                    <p>上次登录： <ins><!--{date('Y-m-d H:i:s',$login['time'])}--></ins><br><ins><!--{$login['address']}--></ins></p>
                </div>
            </div>
            <ul >
                <li>
                    <span class="text"><strong>登陆密码</strong>
                                   </span>
                    <span class="btn11"><a href="home_safe_pass.html" class="">修改</a></span></li>


                <!--{if $pwd2}-->
                <li > <span class="text"><strong>已设置提现密码</strong>
                                 </span>
                    <span class="btn11"><a href="home_safe_pwd2.html" class="">修改</a>


                                </span>


                </li>

                <!--{else}-->

                <li class="noSet"><span class="text"><strong>未设置提现密码</strong>
                                  </span>
                    <span class="btn11"><a href="home_safe_pwd2.html" class="">设置</a></span>


                </li>

                <!--{/if}-->



                <!--{if $mibao}-->
                <li >
                    <span class="text"><strong>已设置密保问题</strong>
                            </span>
                    <span class="btn11"><a href="home_safe_mibao.html" class="">修改</a></span></li>
                <!--{else}-->

                <li class="noSet"><span class="defFont icon-lock-2"></span>
                    <span class="text"><strong>未设置密保问题</strong>
                                    <p>密保问题可以增加账户安全性，快速找回帐号密码。</p></span>
                    <span class="btn11"><a href="home_safe_mibao.html" class="">设置密保问题</a></span></li>

                <!--{/if}-->

            </ul>









        </div>
        <!--详细内容iframe-end-->

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
