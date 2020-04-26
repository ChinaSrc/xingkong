<div class="bd" id='choose_box' >
    <div class="chuantong6">

        <div class="game_bet_area" >


            <div  class="bet_aleft">

                <div class="bet_cont" id="lt_cf_content" name="lt_cf_content"></div>
            </div>

        </div>


        <div class="game_task" id="lt_game_task"   style='font-size: 16px;line-height: 60px;text-align: center'>
            <span >
                方案注数：<b class="gamenum" id="lt_cf_nums">0</b>注&nbsp;，&nbsp;
           金额 <span class="gamenum" ><b  id="lt_cf_money">0</b></span>元
                <font id="lt_cf_count" style="display: none" >0</font>&nbsp;&nbsp;
            </span>

            <span style="padding-left: 10px;<!--{if $game_type['skey']=='k3' || $game_type['skey']=='dp'}-->display: none  <!--{/if}-->">



            <input  type="radio" id='lt_trace_stop' name="lt_trace_if"  value="1" checked="checked" onclick="addgametask(false,this);select_zh('1');">正常投注
                &nbsp;&nbsp;
                    <input  type="radio"  name="lt_trace_if" id="zuihao_btn" value="2"   onclick="addgametask(true,this);select_zh('2');">我要追号


            </span>


            <select id="list_lot_num" style='display:none;'>

            </select>
            <span id='CurMode' style='display:none;'></span>

            <span id="lt_issues" style="display:none"></span>
            <span id="it_lot_num" style="display:none"></span>


        </div>

        <!--{include file="<!--{$tplpath}-->game_extra.tpl"}-->

        <div style="clear: both;text-align: center;">

            <input type="button" class='game_button'  id='lt_sendok'         <!--{if $game_play=='1'}-->onclick="gamebuy();" <!--{else}-->onclick="alert('您是代理，请添加会员号再进行投注！');"<!--{/if}--> value='立即投注' >







            <span id="confirm-countdown"   style="display: none" class="confirm-countdown">00:00:00</span>

        </div>

    </div>


</div>