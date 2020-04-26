<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/trend.css" rel="stylesheet"/>






<div id="tableAndCanvas">
    <div id="dataWrap">
        <div class="selectWay">
            <h2 style="float:left;height:30px;line-height: 30px;display: inline-block;width: 80px;"><strong class="l">基本走势图</strong> </h2>
            <div class="l ml-20">
                <span>选择彩种：
                    <select name="selectDate" id="selectlettery" class="text-muted" onchange="location.href='index_chart.html?playkey='+this.value">

                                            <!--{foreach from=$game_list key=key item=item}-->
                        <!--{if $item['skey']!='kl8'}-->
                    <option value='<!--{$item['ckey']}-->'  <!--{if $smarty.get.playkey eq  $item['ckey']}-->selected<!--{/if}-->><!--{$item['fullname']}--></option>
                        <!--{/if}-->
                        <!--{/foreach}-->

                    </select></span>
                <a href="index_chart.html?playkey=<!--{$smarty.get.playkey}-->&top=50"  <!--{if $top==50}--> style="color: #fff"<!--{/if}-->>最近50期</a>
                <a href="index_chart.html?playkey=<!--{$smarty.get.playkey}-->&top=100" <!--{if $top==100}--> style="color: #fff"<!--{/if}-->>最近100期</a>
                <a href="index_chart.html?playkey=<!--{$smarty.get.playkey}-->&top=200" <!--{if $top==200}--> style="color: #fff"<!--{/if}-->>最近200期</a>


                &nbsp; &nbsp; <a href="game_<!--{$game['id']}-->.html" target="_blank" style="color: #fff">去投注 &gt;&gt;</a>
            </div>
        </div>
        <table class="dataTable" id="chartsTable">
            <thead>
            <tr class="text-c">
                <th height="40" rowspan="2">期号</th>
                <th colspan="3" rowspan="2">开奖号码</th>
                <th colspan="6">开奖号码分布</th>
                <th colspan="4">大小单双</th>
                <th colspan="16">和值走势</th>
            </tr>
            <tr>
                <th width="28">1</th>
                <th width="28">2</th>
                <th width="28">3</th>
                <th width="28">4</th>
                <th width="28">5</th>
                <th width="28">6</th>
                <th width="28">大</th>
                <th width="28">小</th>
                <th width="28">单</th>
                <th width="28">双</th>
                <th width="28">3</th>
                <th width="28">4</th>
                <th width="28">5</th>
                <th width="28">6</th>
                <th width="28">7</th>
                <th width="28">8</th>
                <th width="28">9</th>
                <th width="28">10</th>
                <th width="28">11</th>
                <th width="28">12</th>
                <th width="28">13</th>
                <th width="28">14</th>
                <th width="28">15</th>
                <th width="28">16</th>
                <th width="28">17</th>
                <th width="28">18</th>
            </tr>
            </thead>
            <tbody id="cpdata">
            <!--{foreach from=$list key=key item=item}-->
            <!--{if $game['show_nav2']!=2}-->  
            <tr class="text-c">
                <td height="40"><!--{$item['period']}--></td>

                <!--{foreach from=$item['num'] key=k1 item=v1}-->
                <td class="c_ba2636"><b><!--{$v1}--></b></td>

                <!--{/foreach}-->
                <!--{for $i=1 to 6}-->
                <!--{$ball_times=0}-->
                <!--{if in_array($i,$item['num'])}-->
                <!--{foreach from=$item['num'] key=key3 item=item3}-->
                <!--{if $i==$item3}-->
                <!--{$ball_times=$ball_times+1}-->
                <!--{/if}-->
                <!--{/foreach}-->
                <!--{/if}-->
                <td class="<!--{if in_array($i,$item['num'])}-->ball_red<!--{else}-->f_green<!--{/if}-->">
                    <!--{if $ball_times>1}-->
                    <div class="s_ball">
                        <!--{$ball_times}-->
                    </div>
                    <!--{/if}-->
                    <i><!--{$i}--></i></td>

                <!--{/for}-->

                <td class="<!--{if $item['sum']>10}-->bg_orange js-fold<!--{else}-->f_brown<!--{/if}-->">大</td>
                <td class="<!--{if $item['sum']<=10}-->bg_orange js-fold<!--{else}-->f_brown<!--{/if}-->">小</td>
                <td class="<!--{if $item['sum']%2==0}-->bg_orange js-fold<!--{else}-->f_brown<!--{/if}-->">双</td>
                <td class="<!--{if $item['sum']%2==1}-->bg_orange js-fold<!--{else}-->f_brown<!--{/if}-->">单</td>
                <!--{for $i=3 to 18}-->
                <td class="<!--{if $i==$item['sum']}-->bg_green js-fold<!--{else}-->f_green js-omit-m<!--{/if}-->"><!--{$i}--></td>
                <!--{/for}-->

            </tr>
			<!--{/if}-->
            <!--{/foreach}-->


            </tbody>
        </table>
    </div>
</div>






<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->