

<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->style/index.css">

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/welcome.css?v=1212134225" type="text/css" rel="stylesheet" />


<div  class="hc-con-inner"  style="width:calc(100% - 40px) ;margin:0 auto;padding-bottom:50px;">
    <div  class="index">
        <div  class="index-row">
            <div  class="index-col col-3">
                <div  class="hc-block index-block index-banner">

                        <div id="banner">
                            <div class="banner-btn-bj">
                                <ul id="bannerBtn"></ul>
                            </div>
                            <div id="bannerMain<!--{if count($banner)==1}-->1<!--{/if}-->">
                                <!--{foreach from=$banner key=key item=item}-->
                                <a href="<!--{$item['url']}-->">
                                    <img src="<!--{$item['img']|getFileUri}-->" style="width:100%; height:250px;"  />
                                </a>
                                <!--{/foreach}-->


                            </div>
                        </div>



                        <script type="text/javascript">
                            $(function () {
                                var t = n = count = 0;
                                $(function () {
                                    count = $("#bannerMain a").size();
                                    for (var i = 1; i < count + 1; i++) {
                                        var newsli = "<li>" + i + "</li>"
                                        $('#bannerBtn').append(newsli);
                                    };
                                    $("#bannerBtn li").eq(0).addClass('cc');
                                    $("#bannerMain a:not(:first)").hide();
                                    $("#bannerBtn li").click(function () {
                                        $(this).addClass("cc").siblings("li").removeClass("cc");
                                        var i = $(this).text() - 1;
                                        n = i;
                                        if (i >= count) return;
                                        $("#bannerMain a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
                                    });
                                    t = setInterval("showAuto()",5000);
                                    $("#banner").hover(function () { clearInterval(t) }, function () { t = setInterval("showAuto()", 5000); });
                                })
                            });
                            function showAuto() {
                                n = n >= (count - 1) ? 0 : n + 1;
                                $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
                            }

                            function showAuto1() {
                                n = n ==0 ? (count - 1) : n -1;
                                $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
                            }
                            new slider({id:'slider'})
                        </script>





                    </div>

            </div>
            <div  class="index-col col-3">
                <div  class="hc-block index-block index-account">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-home"></i>个人中心</h2>
                        <a  href="home.html" class="block-more">进 入</a>
                    </div>
                    <div  class="block-content">
                        <div  class="i-account">
                            <div  class="i-avatar">
                                <img  src="<!--{avatar()}-->" alt="" onclick="DialogResetWindow('更换头像','home_safe_avatar.html','800','440');"style='width:80px;border-radius:50%;'/>
                            </div>
                            <div  class="username">
                                欢迎您，
                                <em ><!--{$cur_username}--></em>
                            </div>
                            <div  class="account-auth" style="display: none">
                                <a  href="home.html" class=""><i  class="icon icon-user"></i></a>
                                <a  href="home.html" class=""><i  class="icon icon-email"></i></a>
                                <a  href="home.html" class=""><i  class="icon icon-phone"></i></a>
                            </div>
                        </div>
                        <div  class="i-assets">
                            <div  class="assets-actions">
                                <a  href="home_safe_recharge.html" class="btn btn-primary">存 款</a>
                                <a  href="home_safe_platform.html" class="btn btn-primary btn-withdraw">提 款</a>
                            </div>
                            <div  class="account-balance">
                                账户余额
                                <span  class="amount"  style='border:0px; height:40px;line-height:40px;'>￥<em ><!--{$cur_amount}--></em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="index-col col-3">
                <div  class="hc-block index-block index-safety">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-safety"></i>安全中心</h2>
                        <a  href="home.html" class="block-more">提 升</a>
                    </div>
                    <div  class="block-content">
                        <div  class="safety-con">
                            <div  class="safety-state low">
                                低
                            </div>
                            <!---->
                            <!---->
                            <div  class="safety-line safety-level">
                                <span  class="k">安全等级：</span>
                                <span  class="v"><span  class="safety-text">低</span>
                                    <!---->
                                    <!----> <span  class="security-stars"><img  src="<!--{$file_uri}-->/<!--{$skinpath}-->style/img/icon_star_on.png" alt="" class="star" />
                                    <img  src="<!--{$file_uri}-->/<!--{$skinpath}-->style/img/icon_star.png" alt="" class="star" />
                                    <img  src="<!--{$file_uri}-->/<!--{$skinpath}-->style/img/icon_star.png" alt="" class="star" />
                                    <img  src="<!--{$file_uri}-->/<!--{$skinpath}-->style/img/icon_star.png" alt="" class="star" />
                                    <img  src="<!--{$file_uri}-->/<!--{$skinpath}-->style/img/icon_star.png" alt="" class="star" /></span></span>
                            </div>

                            <!--{if count($login)>1}-->
                            <div  class="safety-line">
                                <span  class="k">上次登录IP：</span>
                                <span  class="v"><!--{$login[1]['IPInfor']}--></span>
                            </div>
                            <div  class="safety-line">
                                <span  class="k">上次登录地址：</span>
                                <span  class="v"><!--{$login[1]['Adress']}--></span>
                            </div>
                            <div  class="safety-line">
                                <span  class="k">上次登录时间：</span>
                                <span  class="v"><!--{$login[1]['creatdate']}--></span>
                            </div>


                            <!--{else}-->
                            <div  class="safety-line">
                                <span  class="k">上次登录IP：</span>
                                <span  class="v">您第一次登陆</span>
                            </div>
                            <div  class="safety-line">
                                <span  class="k">上次登录地址：</span>
                                <span  class="v">您第一次登陆</span>
                            </div>
                            <div  class="safety-line">
                                <span  class="k">上次登录时间：</span>
                                <span  class="v">您第一次登陆</span>
                            </div>
                            <!--{/if}-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="index-row">
            <div  class="index-col col-2">
                <div  class="hc-block index-block index-games">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-game"></i>热门游戏</h2>
                    </div>
                    <div  class="block-content">
                        <ul  class="index-lots">
                                  		     <!--{foreach from=$game_index key=key1 item=item1}-->

 <li ><a  href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html" class="">
 <img  src="<!--{$item1['ico']|getFileUri}-->" alt="" style='height:56px;'/><!--{$item1['fullname']}--></a></li>





	  <!--{/foreach}-->




                        </ul>
                    </div>
                </div>
                <div  class="hc-block index-block index-history">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-history"></i>最近登录</h2>
                    </div>
                    <div  class="block-content">
                        <ul  class="history-login">

                            <li ><span >日期</span> <span >IP</span> <span >地址</span></li>
                            <!--{foreach from=$login key=key item=item}-->


                            <li ><span ><!--{$item['creatdate']}--></span> <span ><!--{$item['IPInfor']}--></span> <span ><!--{$item['Adress']}--> </span></li>

                            <!--{/foreach}-->



                        </ul>
                    </div>
                </div>
            </div>
            <div  class="index-col col-2">
                <div  class="hc-block index-block index-notice">
                    <div  class="block-heading">
                        <h2  class="block-title"><i  class="icon-title icon-horn"></i>网站公告</h2>
                        <a  href="index_note.html" class="block-more">更 多</a>
                    </div>
                    <div  class="block-content">
                        <ul  class="notice-list">

                          <!--{foreach from=$note key=key item=item}-->


       <li ><a  href="index_note.html?id=<!--{$item['id']}-->" class="look"><h3 ><!--{$item['title']}--></h3>
        <p  class="time1"><i  class="icon icon-time"></i><!--{date('Y-m-d H:i:s',$item['time'])}--></p>
        <span  class="dot" style="background-color: rgb(107, 142, 35);"></span>
         <i  class="icon icon-arr"></i></a>
         </li>



		      <!--{/foreach}-->

                 </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>







<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




</body>
</html>


