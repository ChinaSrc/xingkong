
<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<style>
    #J-lottery-info-status{display: inline-block;padding-left: 10px;}
    #J-lottery-info-status span {
        display: inline-block;
        font-size: 12px;
        padding:0px  5px;
        height:20px;line-height: 20px;
        margin:0px 3px;
        border-radius: 3px;
        background-color: #ff9726;
        color:#fff;
    }

    #J-lottery-info-status span:first-child{background-color: #00c77a}
    #J-lottery-info-status span:last-child{background-color: #3388ff}

</style>

<div class='wap_list'>

<div class="info_list">

        <span class="title11">游戏账户：</span>
       <span class="info11"><!--{$game_info['username']}--></span>
        </div>
        <div class="info_list">
     <span class="title11">彩种：</span>
       <span class="info11"><!--{$game_info['playname']}--></span>
        </div>

<div class="info_list">
     <span class="title11">玩法：</span>
       <span class="info11"><!--{get_game_mark($game_info['id'],1)}--></span>
        </div>

<div class="info_list">
     <span class="title11">注单编号：</span>
       <span class="info11"><!--{$game_info['buyid']}--></span>
        </div>

<div class="info_list">
     <span class="title11">投注时间：</span>
       <span class="info11"><!--{$game_info['creatdate']}--></span>
        </div>

<div class="info_list">
     <span class="title11">投注期号：</span>
       <span class="info11"><!--{$game_info['period']}--></span>
        </div>
<!--{if $game_info['skey']!='k3'}-->

<div class="info_list">
     <span class="title11">模式/倍数：</span>
       <span class="info11"><!--{$game_info['modes']}-->/<!--{$game_info['times']}-->倍</span>
        </div>
<!--{/if}-->
<div class="info_list">
     <span class="title11">注数：</span>
       <span class="info11"><!--{$game_info['nums']}--></span>
        </div>


<div class="info_list">
     <span class="title11">返点：</span>
       <span class="info11"><!--{$game_info['pri_mode']}-->%</span>
        </div>


<div class="info_list">
     <span class="title11">投注类型：</span>
       <span class="info11"><!--{if $game_info['is_zuih'] eq 'yes'}-->追号<!--{else}-->正常投注<!--{/if}--></span>
        </div>


<!--{if $game_info['is_zuih']=='yes'}-->


     <div class="info_list"  style='height:150px;line-height:30px;overflow-y:scroll;'>
     <span class="title11">追号列表：</span><br>
<!--{foreach from=$game_info['list']  key=key item=value}-->
<!--{$value['period']}-->[<!--{$value['times']}-->倍]<!--{if $value['pri_money']}-->开奖号码[<!--{$value['pri_number']}-->]奖金[<!--{$value['pri_money']}-->]<!--{/if}-->
		 <!--{show_buystatus($value)}--><!--{$value['back']}-->


<br>
<!--{/foreach}-->
        </div>



<!--{else}-->

<div class="info_list">
     <span class="title11">投注总额：</span>
       <span class="info11"><!--{$game_info['money']}-->元</span>
        </div>


       <div class="info_list">
     <span class="title11">中奖金额：</span>
       <span class="info11"><!--{if $game_info['status']>0 && $game_info['status']<9}-->     <!--{$game_info['pri_money']}-->元<!--{else}-->---<!--{/if}-->
</span>
        </div>
    <div class="info_list">
        <span class="title11">盈亏：</span>
        <span class="info11"> <!--{if $game_info['status']>0 && $game_info['status']<9}--><!--{$game_info['pri_money']-$game_info['money']}-->元<!--{else}-->---<!--{/if}--></span>
    </div>


      <!--{if $game_info['pri_number']}-->
       <div class="info_list">
     <span class="title11">开奖号码：</span>
       <span class="info11"><!--{$game_info['pri_number']}--></span>
        </div>

       <!--{/if}-->
<div class="info_list">
     <span class="title11">状态：</span>
       <span class="info11"><!--{show_buystatus($game_info)}--></span>
        </div>

            <div class="info_list"  style='height:95px;line-height:30px;'>
     <span class="title11">投注内容：</span><br>
<textarea rows="4" style='width:99%;' readonly><!--{$game_info['number']}--></textarea>
        </div>
              <!--{if $game_info['back'] eq '1'}-->
            <!--<input  type='button' class="big_btn" id='cance_btn' style='margin-top:10px;' onclick='backgame("do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&mobile=1&uid=<!--{$game_info['id']}-->");'value='我要撤单'>-->

       <!--{/if}-->
       
       <!--{/if}-->
</div>



<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->


<script>
function  backgame(url){

 $.post(url, function (data) {

if(data.indexOf('成功')>0){
window.wxc.xcConfirm(data,window.wxc.xcConfirm.typeEnum.success);
document.getElementById('cance_btn').style.display='none';
}
else{
window.wxc.xcConfirm(data,window.wxc.xcConfirm.typeEnum.warning);
document.getElementById('cance_btn').style.display='none';
}
		}

 );
}
</script>

</body>
</html>
