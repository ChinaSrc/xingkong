<div  class="selectType">
    <div  class="ibet on"  onclick="open_history(0);">我要投注</div>
    <div  class="ibet"  onclick="open_history(1);" >最近投注</div>
    <div  class="lft-money" >
        <i>余额:</i>
<i  id='lostmoney' name='lostmoney' style="display: none;"><!--{$cur_amount}--></i>
<i id="hide_money">****</i>
    <i class="icon-eye" onclick="show_money();"></i>
    </div>
</div>
<script>
    function show_money() {
        if(document.getElementById('lostmoney').style.display=='none'){
            document.getElementById('lostmoney').style.display='';
            document.getElementById('hide_money').style.display='none';
            document.querySelector('.icon-eye').className='icon-eye-off';
        }else{

            document.getElementById('lostmoney').style.display='none';
            document.getElementById('hide_money').style.display='';
            document.querySelector('.icon-eye-off').className='icon-eye';
        }

    }


</script>


<!--{include file="<!--{$tplpath}-->game_history.tpl"}-->

<div style='position:fixed;top:75px;left:0px;right:0px;z-index:10;height:80px; padding: 5px 0px;background: #f7f7f7; box-shadow: 0 1px 5px #dfdfdf;color:#555;'>


        <ul   style='display:none;' >
            <li class="ni"><span class="i1" id='current_status'><!--{$periodarrs.status}--></span></li>

            <li class="tm"><span id='current_titles'>截止时间:</span><font id="current_endtime"><!--{$periodarrs.lotendtime}--></font></li>
            <li class="tm"><span id="lotfloatnum" hidden value='<!--{$periodarrs.lostnums}-->'></span>
            </li>

        </ul>


    <div class="tb-b-column" id="ticket-cutdown"  style='width:49%;border-right: 1px #ccc solid;'>

     <!--{if $game_type['show_nav2']==2}-->
      	<div style="text-align: center;line-height:75px;height: 25px;font-size: 23px;">
          	<span class="red" id="per_num1">彩种停售</span>
        </div>
     <!--{else}--> 
        <div class="showtitle">

            <div   id="isbuy_title" <!--{if $periodarrs.isbuy neq 1}-->style='display:none;' <!--{/if}-->>
                <em id="current_issue" class="red"><!--{$periodarrs.period}--></em>期截止投注
      		</div>
            <div   id="isstop_title" <!--{if $periodarrs.isbuy eq 1}-->style='display:none;' <!--{/if}-->>
        		<em id="current_issue2" class="red"><!--{$periodarrs.period}--></em> 期已封单
    		</div>

    	</div>
    <!--title end-->
    <!--cutdown-clock-base start-->
    <div class="surplus-time" id="count_down"  >

    </div>
    <div style="text-align: center;line-height:25px;height: 25px;">

        已开<span class="red" id="per_num1"><!--{$periodarrs.num}--></span>/剩余<span class="red" id="per_num2"><!--{$periodarrs.sum-$periodarrs.num}--></span>期

    </div>
	<!--{/if}-->
</div>


<div class="tb-b-column"  style='width:49%;position: relative;float: right;' <!--{if $game_type['show_nav2']!=2}--> onclick="set_display('drawing-lite');"<!--{/if}-->>
	<!--{if $game_type['show_nav2']==2}-->
    	<div style="text-align: center;line-height:100px;height: 25px;font-size: 18px;">
          	<span class="red" id="per_num1"> </span>
        </div>
   <!--{else}--> 
    <div class="showtitle" >

        <div  id="lottitle1"><em id="last_issues" class="red"></em> 期开奖号码</div>
        <div  id="lottitle2" style="display: none;"><em id="last_issues1" class="red"></em> 期等待开奖</div>

    </div>
    <!--title end-->
    <!--viewer start-->
    <div class=" viewer ticker-drawing-viewer ticker-drawing-viewer-base" <!--{if $game_type['skey']!='k3'}-->style='margin-top:5px;'<!--{/if}-->>

    <!-- <div class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading"> 开奖中-->
    <div id="last_code" class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading <!--{if $game_type['skey']!='k3' || $game_type['skey']=='pk10' || $game_type['skey']=='kl8'}--><!--{$game_type['skey']}-->code<!--{/if}-->"  >
        <ul >
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <!--{if $game_type['skey']!='k3' && $game_type['skey']!='dp'}-->
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>

            <!--{/if}-->

            <!--{if $game_type['skey']=='kl8'}-->
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <!--{/if}-->
        </ul>
        <!--{if $game_type['skey']=='pk10' || $game_type['skey']=='kl8'}-->
        <ul >
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <!--{if $game_type['skey']=='kl8'}-->
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <li><span><i></i></span></li>
            <!--{/if}-->

        </ul>
        <!--{/if}-->
	<!--{/if}-->
</div>

<div id="J-lottery-info-status"  <!--{if $game_type['skey']=='k3'}-->style='margin-top:2px;'<!--{/if}-->></div>

</div>

</div>

</div>

<script type="text/javascript">
    function set_display(div){

        if(document.getElementById(div).style.display=='none')
            document.getElementById(div).style.display='block';
        else
            document.getElementById(div).style.display='none';
    }

</script>

<div  class="srcoll " id="drawing-lite" <!--{if $game_type['show_nav2']!=2}--> onclick="set_display('drawing-lite');"<!--{/if}-->  style="position:fixed;top:165px;left:0px;right:0px;z-index:11;display: none;background-color: #fff;">
    <table class="table text-center">
        <thead>
        <tr>
            <th class="dl-period" <!--{if $game_type['skey']=='kl8' || $game_type['ckey']=='BJPK10'}-->style='width:60px;'<!--{/if}-->><span>期号</span>

            <!--{if $game_type['skey'] eq 'k3'}-->


                <a href="lottery_<!--{$game_type['ckey']}-->.html" style="color: #3366cc">更多&gt;&gt;</a>





            <!--{/if}-->
            </th>
            <th class="dl-number" ><span>号码</span></th>
            <!--{if $game_type['skey'] eq 'k3'}-->
            <th style="width: 40px">和值</th>
            <th style="width: 80px">形态</th>
            <!--{else}-->
            <th style="width: 100px;">开奖时间</th>
            <!--{/if}-->
        </tr>
        </thead>
        <tbody id='historylot' >
        <tr>
            <td id="nav_period"><!--{$periodarrs.period}--></td>
            <td   id="nav_status"  style="color:#ff4444;"  <!--{if $game_type['skey'] eq 'k3'}-->colspan='3'<!--{else}-->colspan='2'<!--{/if}-->><!--{if $periodarrs['isbuy']==1}-->正在接受投注<!--{else}-->封单中<!--{/if}--></td>


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
            <!--{else}-->
<td>

<!--{substr($perlist[p]['LotTime'],10,10)}-->
</td>
            <!--{/if}-->


        </tr>
        <!--{/section}-->


        </tbody>
    </table>

    <!--{if $game_type['skey'] eq 'k3'}-->

        <div style="text-align: center;height:30px;line-height: 30px;" >

            <a href="lottery_<!--{$game_type['ckey']}-->.html" style="color: #333;">更多开奖结果</a>

        </div>




    <!--{/if}-->
</div>
