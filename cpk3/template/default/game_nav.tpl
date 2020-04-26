

<div class="cont cont-betting" id='lottery11'
     style='display:block;border-radius: 8px; width: calc(100% - 10px);padding: 5px;background-color: #fff;'>
<div style="height:30px;line-height: 30px;padding:0 5px;">
     <span style="display: inline-block;border-radius: 3px;padding:2px 10px;font-weight:300;background-color: #455467;color: #fff;height: 20px;line-height: 20px;">最新开奖</span>


<SPAN style="float: right">

        <a style="color: #555"  onclick="open_url('index_wanfa.html?type=<!--{$game_type['skey']}-->&from=parent');"><i class="icon-fast-fw"></i>玩法介绍</a>
    <!--{if $game_type['skey'] neq 'kl8'}-->
   |     <a   style="color: #555"  href="index_chart.html?playkey=<!--{$game_type['ckey']}-->" target="_blank"><i class="icon-chart-line"></i>走势图</a>
<!--{/if}-->

</SPAN>
</div>
        <div  class="srcoll " id="drawing-lite">
            <table class="table text-center">
                <thead>
                <tr>
                    <th class="dl-period" <!--{if $game_type['skey']=='kl8' || $game_type['ckey']=='BJPK10'}-->style='width:60px;'<!--{/if}-->><span>期号</span></th>
                    <th class="dl-number" ><span>号码</span></th>
                    <!--{if $game_type['skey'] eq 'k3'}-->
                    <th>和值</th>
                    <th>形态</th>

                    <!--{/if}-->
                </tr>
                </thead>
                <tbody id='historylot' >
                <tr>
                    <td id="nav_period"><!--{$periodarrs.period}--></td>
                    <td   id="nav_status"  style="color:#ff4444;"  <!--{if $game_type['skey'] eq 'k3'}-->colspan='3'<!--{/if}-->><!--{if $periodarrs['isbuy']==1}-->正在接受投注<!--{else}-->封单中<!--{/if}--></td>


                </tr>
                <!--{section name=p loop=$perlist}-->


                <tr>
                    <td><!--{$perlist[p].period}--></td>
                    <td  class="numbercode"><!--{$perlist[p].Number}--></td>
                    <!--{if $game_type['skey'] eq 'k3'}-->
                    <td><!--{$perlist[p].hz}--></td>
                    <td>
                        <!--{if $perlist[p].hz>10}-->
                           <span class="color1">大</span>
                        <!--{else}-->
                        <span class="color2">小</span>
                        <!--{/if}-->

                        <!--{if $perlist[p].hz%2==1}-->
                        <span class="color1">单</span>
                        <!--{else}-->
                        <span class="color2">双</span>
                        <!--{/if}-->
                    </td>

                    <!--{/if}-->


                </tr>
                <!--{/section}-->


                </tbody>
            </table>
        </div>


    <p class="more-details" style="text-align: center;padding: 10px;">
        <a target="_blank" href="lottery_<!--{$game_type['ckey']}-->.html">查看更多奖期</a>
    </p>
</div>


<div id="J-game-plan"       style='display:block;border-radius: 8px; margin-top:10px;width: calc(100% - 10px);padding: 5px;background-color: #fff;'>
    <div class='lottery-order'>
        <div class="tab">
            <!--<div id='history_title_1' onclick="change_tabs(1,2);" class="item active">订单记录</div>-->
            <span style="display: inline-block;border-radius: 3px;padding:2px 10px;font-weight:300;background-color: #455467;color: #fff;height: 20px;line-height: 20px;">订单记录</span>
            <!--{if $game_type['skey']!='k3' && $game_type['dp']!='k3'}-->
            <div id='history_title_2' onclick="change_tabs(2,2);" class="item">追号记录</div>

            <!--{/if}-->

            <img src='<!--{$file_uri}-->/template/default/images/icons/icon_refresh.png' style='float:right;margin-top:6px;margin-right:10px;cursor:pointer; ' alt='刷新' onclick="Ajax_get_buy();">
        </div>
        <div class="content"  >
            <div id='history_content_1' class="item active" data-init="true">
                <table class="table">
                    <thead>
                    <tr>

                        <th >期号</th>

                        <th >下注金额</th>



                        <th>状态</th>

                    </tr>
                    </thead>
                    <tbody id='history_info_1'>


                    </tbody>
                </table>
                <div class="page-list">
                    <div class="easy-page"></div>
                </div>
            </div>

            <div  id='history_content_2' class="item" data-init="true">
                <table class="table table-bordered padding-small">
                    <thead>
                    <tr>


                        <th >起始期号</th>

                        <th >总金额</th>
                        <th >已追/总</th>


                        <th>状态</th>

                    </tr>
                    </thead>
                    <tbody id='history_info_2'></tbody>
                </table>
                <div class="page-list">
                    <div class="easy-page"></div>
                </div>
            </div>



        </div>
    </div>


</div>
<style>
    .winningList{height:240px;}

</style>


