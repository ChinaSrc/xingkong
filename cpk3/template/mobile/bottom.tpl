
<!--{if $smarty.get.mod!='game'  && $smarty.get.from!='parent'}-->
<div style='width:100%;height:70px;clear:both;'>&nbsp;</div>

	<div class="clear"></div>


<footer class="fixed_bottom">
    <ul class="navbar_group">
        <li class="navbar_item <!--{if $nav_index eq '1'}-->active<!--{/if}-->">
            <a href="index_home.html?mobile=1"><i class="icon-home"></i>首页</a></li>

        <li class="navbar_item <!--{if $smarty.get.mod eq 'active'}-->active<!--{/if}-->"><a href="index_active.html?mobile=1"><i class="icon-gift"></i><!-- react-text: 1585 -->活动<!-- /react-text --></a></li>
        <li class="navbar_item">
        <a   href="<!--{$ServiceUrl}-->">
            <i class="icon-menu-4" ></i>
客服
        </a>
        </li>
        <li class="navbar_item <!--{if $smarty.get.mod eq 'lottery_list' ||  $smarty.get.mod eq 'player'}-->active<!--{/if}-->" style="display: none;"><a href="index_lottery_list.html?mobile=1"><i class="icon-compass"></i><!-- react-text: 1585 -->发现<!-- /react-text --></a></li>

        <li class="navbar_item  <!--{if $smarty.get.mod eq 'chat'}-->active<!--{/if}-->"><a href="index_chat.html?mobile=1"><i class="icon-chat"></i><!-- react-text: 1589 -->聊天<!-- /react-text --></a></li>
        <li class="navbar_item <!--{if ($smarty.get.mod eq 'user' || $smarty.get.mod eq 'safe' || $smarty.get.mod eq 'report') && $smarty.get.code neq 'buy'}-->active<!--{/if}-->">
            <a href="home_report_nav.html?mobile=1"><i class="icon-player"></i><!-- react-text: 1593 -->我的<!-- /react-text --></a></li>
    </ul></footer>



<!--{/if}-->

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


  //  var autotimer=setInterval("auto()",10000);
    <!--{/if}-->

    //setTimeout(function(){alert('请刷新页面');location.reload();},3600000);

</script>
</body>
</html>
