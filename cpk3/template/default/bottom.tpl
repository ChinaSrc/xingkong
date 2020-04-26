<div class="clear"></div>
 </div>

 </div>

 </div>


<div class="clear" style="height:20px;"></div>



<link href='<!--{$file_uri}-->/<!--{$skinpath}-->style/footer.css' rel="stylesheet" type="text/css" />
<footer class="footer" style="clear:both;padding-top: 0px;background-color:#fff;">
    <div class="footer_main">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 footer_left padding_0">
                    <div class="footer_common_title">
                        <h2>技术支持 <span>Technical support</span></h2>
                    </div>
                    <div class="clearfix footer_l_content">
                        <a href="">
                            <div class="pull-left">
                                <img src="<!--{$con_system['ico']|getFileUri}-->" alt="">
                            </div>
                            <p class="pull-left" style="color: #666; font-size: 14px!important;">
                              <span style="line-height: 26px;">  <!--{$config.sitename}-->投注系统</span>
                              <span style="line-height: 26px;">  专业彩票系统平台</span>
                            </p>
                        </a>
                    </div>
                    <i></i>
                </div>
                <div class="col-xs-4 footer_middle">
                    <div class="footer_common_title">
                        <h2>服务体验 <span>Service experience</span></h2>
                        <div class="footer_m_content">
                            <div class="clearfix enter">
                                <span class="pull-left">昨日充值平均时间</span>
                                <p class="bar pull-left margin_0">
                                    <span class="bar_red"></span>
                                </p>
                                <span class="miao pull-left"><em>00'53</em> 秒</span>
                            </div>
                            <div class="clearfix enter">
                                <span class="pull-left">昨日提现平均时间</span>
                                <p class="bar pull-left margin_0">
                                    <span class="bar_blue"></span>
                                </p>
                                <span class="miao pull-left"><em>17'40</em> 秒</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 footer_right">
                    <div class="footer_common_title">
                        <h2>充值展示 <span>Recharge method</span></h2>
                    </div>
                    <div class="chongzhi_img_box">
                        <span class="chongzhi_img1"></span>
                        <span class="chongzhi_img2"></span>
                        <span class="chongzhi_img3"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_other">
        <div class="container">
            <p class="footer_link">
                <a href="index_help.html?itemid=99">如何注册</a>
                <a href="index_help.html?itemid=100">如何购彩</a>
                <a href="index_help.html?itemid=101">如何充值</a>
                <a href="index_help.html?itemid=102">如何提现</a>
                <a href="index_help.html?itemid=108">账户安全</a>
            </p>
            <p class="footer_copyright">
                Copyright ©  <!--{$config.sitename}-->   Reserved | 18+
            </p>
        </div>
    </div>
</footer>


<div id="toolbar">
    <div class="index"><a href="/"></a><span>返回首页</span></div>

    <div class="service"><a href="<!--{$ServiceUrl}-->" target="_blank" ></a><span>联系客服</span></div>

    <div class="faq"><a href="/index_help.html"></a><span>帮助中心</span></div>
  <!-- download -->
    <div class="screen"><a href="#"></a>
        <div id="J-side-bar" class="side-bar" style="min-height: 319px;">
            <div class="hide-ctrl"><i class="icon-double-angle-right"></i></div>
            <div>
                <p style="color: #fff;">点击域名设为首页</p>
            </div>
            <ul class="feature">

                <!--{for $i=0 to $con_system['url_num']-1}-->
                <!--{$urlname="url_$i"}-->
                <!--{if $i==0}-->
                <li><p>特别推荐线路</p></li>
                <!--{/if}-->
                <!--{if $i==2}-->
                <li><p>一般推荐线路</p></li>
                <!--{/if}-->
                <!--{if $i==4}-->
                <li><p>普通推荐线路</p></li>
                <!--{/if}-->
                <li class="f-top">
                    <i title="收藏" onclick="AddFavorite('<!--{$con_system[$urlname]}-->');" data-url="<!--{$con_system[$urlname]}-->" data-title="线路一">收藏</i>
                    <i title="复制" data-clipboard-text="<!--{$con_system[$urlname]}-->" id="click-to-copy<!--{$con_system[$i]}-->">复制</i>
                    <span style="cursor: pointer;" onclick="SetHome(this, '<!--{$con_system[$urlname]}-->')"><!--{$con_system[$urlname]}--></span>
                </li>
                <!--{/for}-->
            </ul>

        </div>
        <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/clipboard.min.js"></script>
        <script>


            var clipboard = new Clipboard('i[id^="click-to-copy"]');
            clipboard.on('success', function(e) {
                alert("复制到剪贴板：" + e.text)
                e.clearSelection();
            });

            clipboard.on('error', function(e) {
                alert('Action:', e.action);
                alert('Trigger:', e.trigger);
            });
            function AddFavorite(sURL){

            var sTitle = document.title;
                try
                {
                    window.external.addFavorite(sURL, sTitle);
                }
                catch (e)
                {
                    try
                    {
                        window.sidebar.addPanel(sTitle, sURL, "");
                    }
                    catch (e)
                    {
                        alert("加入收藏失败，请使用Ctrl+D进行添加");
                    }
                }
            }
            function SetHome(obj,vrl){
                try{
                    obj.style.behavior='url(#default#homepage)';

                    alert('抱歉，您所使用的浏览器无法完成此操作。 您需要手动将【'+vrl+'】设置为首页。');
                }
                catch(e){
                    if(window.netscape) {
                        try {
                            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        }
                        catch (e) {
                            alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage',vrl);
                    }
                }
            }

            function url_show(){
                if(document.getElementById('url_show').className=='client_popup url display'){
                    document.getElementById('url_show').className='client_popup url'

                }
                else{

                    document.getElementById('url_show').className='client_popup url display'
                }

            }

        </script>


    </div><!-- screen -->
</div>



     <script type="text/javascript">

         <!--{if $mod=='game' or $mod=='bul'}-->
var hh=window.screen.height-550;

if(document.getElementById('page-container').offsetHeight<hh )
     document.getElementById('page-container').style.height=hh+'px' ;
//
//
else      document.getElementById('page-container').style.minHeight=window.screen.height+'px' ;

<!--{/if}-->
</script>







<script type="text/javascript">

<!--{if $userinfo['userid']>0 && $userinfo['sharelogin']!=1 && $smarty.get.mod neq 'login' && $smarty.get.mod neq 'reg'}-->
var userid='<!--{$userinfo['userid']}-->';
function auto(){

    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    if(userid)
        ajaxobj.content="userid="+userid;
        else
    ajaxobj.content="";
    ajaxobj.url="auto.aspx";
    ajaxobj.callback=function(xmlobj){
         var response = Trim(xmlobj.responseText);

         if(userid){
             response=JSON.parse(response);
             if(response['ok']==0){
                 clearInterval(autotimer);
                 window.wxc.xcConfirm(response['msg'],window.wxc.xcConfirm.typeEnum.confirm,{
                     onOk: function(){
                         location.href='login.html';
                     }
                 });
             }

         }

    }
    ajaxobj.send();
}


//var autotimer=setInterval("auto()",5000);
<!--{/if}-->

	//setTimeout(function(){alert('请刷新页面');location.reload();},3600000);

</script>


</body>
</html>
