
<!--{include file="<!--{$tplpath}-->head.tpl"}-->




<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/Help.css" type="text/css" rel="stylesheet" />



<div id='hd'  >






        <div class="sec_nav">

            <ul>

                <!--{foreach from=$arr_game_code key=key item=item}-->
<!--{if $item!='其他彩种'}-->

                <li <!--{if $smarty.get.type eq $key}-->class="cur"<!--{/if}--> >
                <a href="?type=<!--{$key}-->&from=parent"><!--{$item}--></a>
                </li>

<!--{/if}-->
                <!--{/foreach}-->



            </ul>
        </div>



    <div class="lottery-rules" style="clear: both">
        <table class="play-table">

            <thead>
            <tr>
                <th style="width: 60px">玩法类</th>
                <th  style="width: 80px">玩法组</th>
                <th  style="width: 90px">玩法</th>
                <th>玩法说明</th>
                <th>中奖举例</th>
            </tr>
            </thead>
            <tbody>

            <!--{foreach from=$game_code key=key1 item=item1}-->

            <!--{foreach from=$codelist[$key1] key=key2 item=item2}-->


                <!--{foreach from=$ssclist[$key1][$key2] key=key3 item=item3}-->
            <tr>
                <!--{if $key2==0 && $key3==0}-->
                <td rowspan="<!--{$item1['num']}-->"><!--{$item1['fullname']}--></td>
                <!--{/if}-->
                <!--{if $key3==0}-->
                <td  rowspan="<!--{$item2['num']}-->"><!--{$item2['title']}--></td>
                <!--{/if}-->

                <td><!--{$item3['title']}--></td>
                <td><!--{$item3['content']}--></td>
                <td><!--{$item3['help']}--></td>
            </tr>
            <!--{/foreach}-->


            <!--{/foreach}-->




            <!--{/foreach}-->


            </tbody>
        </table>
    </div>


</div>
</div>

