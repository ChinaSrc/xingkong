<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/home.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->zdialog/zdrag.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->zdialog/zdialog.js?v=123"></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->js/diags.js"></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->js/window.diags.js?v=123"></script>
<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<div class="wi-layout-wrap">
<div span="5" class="wi-layout-left">
    <div class="w-caidan">
        <ul class="manager-menulist ivu-menu ivu-menu-light ivu-menu-vertical" value="1" style="width: 200px;">
            <li class="ivu-menu-submenu">
                <div class="ivu-menu-submenu-title" >

                    <a  class="tebie"><span class="icon-user"></span>个人中心</a>

                </div>
                <ul class="ivu-menu" style="display: block">
                    <li class="ivu-menu-item" onclick="location.href='home_safe_info.html';"><a  class="<!--{if $smarty.get.mod eq 'safe' && $smarty.get.code eq 'info'}-->active<!--{/if}-->">个人信息</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_report_list.html';" ><a class="<!--{if $smarty.get.mod eq 'report' && $smarty.get.code eq 'list'}-->active<!--{/if}-->">今日盈亏</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_buy.html';"><a class="<!--{if $smarty.get.mod eq 'user' && ($smarty.get.code eq 'buy' || $smarty.get.code eq 'task')  && $smarty.get.st<2}-->active<!--{/if}-->">投注记录</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_orders.html';"><a  class="<!--{if $smarty.get.mod eq 'user' &&  ($smarty.get.code eq 'orders' || $smarty.get.code eq 'recharge' || $smarty.get.code eq 'platform')&& $smarty.get.st<2}-->active<!--{/if}-->">交易明细</a></li>

                    <li class="ivu-menu-item" onclick="location.href='home.html';"><a  class="<!--{if $smarty.get.mod eq 'report' && $smarty.get.code eq 'index'}-->active<!--{/if}-->">安全中心</a></li>

                          <li class="ivu-menu-item" onclick="location.href='home_safe_bankinfo.html';"><a  class="<!--{if $smarty.get.mod eq 'safe' && $smarty.get.code eq 'bankinfo'}-->active<!--{/if}-->">银行卡管理</a></li>





                </ul>
            </li>


            <li class="ivu-menu-submenu">
                <div class="ivu-menu-submenu-title" >

                    <a><span class="icon-users"></span>代理中心</a>

                </div>
                <ul class="ivu-menu" >
                    <li class="ivu-menu-item" onclick="location.href='home_user_update.html';"><a  class="<!--{if $smarty.get.mod eq 'user' && $smarty.get.code eq 'update'}-->active<!--{/if}-->">代理说明</a></li>

                    <li class="ivu-menu-item" onclick="location.href='home_team_info.html';"><a  class="<!--{if $smarty.get.mod eq 'team' && $smarty.get.code eq 'info'}-->active<!--{/if}-->">团队报表</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_yingkui.html';"><a  class="<!--{if $smarty.get.mod eq 'user' && $smarty.get.code eq 'yingkui'}-->active<!--{/if}-->">下级报表</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_url.html?action=add';"><a  class="<!--{if $smarty.get.mod eq 'user' && $smarty.get.code eq 'url'}-->active<!--{/if}-->">下级开户</a></li>

                    <li class="ivu-menu-item" onclick="location.href='home_user_list.html';"><a  class="<!--{if $smarty.get.mod eq 'user' && $smarty.get.code eq 'list'}-->active<!--{/if}-->">下级管理</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_buy.html?st=2';"><a class="<!--{if $smarty.get.mod eq 'user' && ($smarty.get.code eq 'buy' || $smarty.get.code eq 'task')  && $smarty.get.st>=2}-->active<!--{/if}-->">下级投注记录</a></li>
                    <li class="ivu-menu-item" onclick="location.href='home_user_orders.html?st=<!--{$smarty.session.st}-->' "><a  class="<!--{if $smarty.get.mod eq 'user' &&  ($smarty.get.code eq 'orders' || $smarty.get.code eq 'recharge' || $smarty.get.code eq 'platform')&& $smarty.get.st>=2}-->active<!--{/if}-->">下级交易明细</a></li>


                </ul>
            </li>

            <li class="ivu-menu-submenu">
                <div class="ivu-menu-submenu-title" >

                    <a><span class="icon-email"></span>消息中心</a>

                </div>
                <ul class="ivu-menu" >
                    <li class="ivu-menu-item" onclick="location.href='home_safe_msg.html';"><a  class="<!--{if $smarty.get.mod eq 'safe' && $smarty.get.code eq 'msg'}-->active<!--{/if}-->">我的消息
                            <!--{if $msg_num>0}-->
                            <span  style='color:#fff;background-color:#ff0000;font-size:12px;width: 18px;height:18px;line-height:18px;border-radius:50%;text-align: center;display: inline-block' ><!--{$msg_num}--></span>
                            <!--{/if}--></a></li>

                    <li class="ivu-menu-item" onclick="location.href='home_user_note.html';"><a  class="<!--{if $smarty.get.mod eq 'user' &&  $smarty.get.code eq 'note'}-->active<!--{/if}-->">网站公告</a></li>

                </ul>
            </li>

        </ul>
        <br />
    </div>
</div>


<script>

    function set_left_menu(num) {

    }
    var li=  document.querySelector('.w-caidan').querySelectorAll('.ivu-menu-submenu');
    for(var i=0;i<li.length;i++){
      var a=  li[i].querySelector('ul').querySelectorAll('a');
      for(var j=0;j<a.length;j++){
          if(a[j].className=='active'){

              set_left_menu(i);
              break;
          }

      }

    }

</script>
<div class="wi-layout-right" >

    <div style="margin-bottom:15px;height:40px;border:1px #ddd solid;line-height: 40px;padding-left: 15px;background-color:#fafafa;color:#253647;font-size: 16px;font-weight: 600;">

        <!--{$navtitle}-->
    </div>

