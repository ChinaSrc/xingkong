<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2016/Content/pc/css/share.css" rel="stylesheet"/>


<link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/todo/images/game/game-touzhu.min.css" />
<script type="text/javascript">
var mobile=0;
var gamekey='<!--{$game_type['ckey']}-->';
var gamename='<!--{$game_type['fullname']}-->';
var gametype='<!--{$game_type['skey']}-->';
var game_close='<!--{$game_type['status']}-->';
var wanfa_cate='ct';

var user_rebate='<!--{$user_rebate}-->';
<!--{$selplay}-->
</script>


<audio  id="mp3_timer" src="static/sound/timer.mp3" preload style="display: none"></audio>

<link rel="stylesheet" href="<!--{$tplpath}-->images/game/main.css?v=1" type="text/css" />
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/formula.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/counts.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/freshTime.js?v=12"></script>

	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />

<style>
    .game_titbar{height:35px;}
    .game_titbar a{height:35px;line-height:35px;}
    .game_titbar a .title{line-height:35px;}
    .game_titbar a .prize{display:none;}
</style>
<div class="countdown countdown-current" id="gametipstime" style=" display: none;">
    <a href="javascript:void(0);"></a>
    <span>本期截止时间</span>
    <strong  id="tipstime">00:00:00</strong>
</div>
<div class="xcaik" id="messageDiv" style="width: 400px;  top:35%; left: 50%; margin: 50px 0px 0px -200px; display: none;">
 <div class="top"><b>友情提醒</b><a onclick="buy_close();"><img src="<!--{$file_uri}-->/static/images/icon_popup_close.png"  title="关闭"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr>
<td id="message_con1" align="center" >恭喜您已投注成功！</td></tr>

<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn"  onclick="print_orders();"  id='print_btn' style="display: none"  >打印</a>

      <a class="cance_btn" onclick="buy_close();"  id='close_timer'>关闭(3)</a>

</td>
</tr>
</tbody>
</table>
</div></div></div></div>


<div class="xcaik" id="messageDiv1" style="width: 400px;top:35%; left: 50%; margin: 50px 0px 0px -200px; display: none;">
 <div class="top"><b>友情提醒</b><a onclick="show_bg('none','');"><img src="<!--{$file_uri}-->/static/images/icon_popup_close.png" title="关闭"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr>
<td id="message_con2" align="center">本期投注已截止,请注意期号的变化</td></tr>
<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn"  onclick="show_bg('none','');" >确定</a>


      <a class="cance_btn" onclick="show_bg('none','');" style="display: none"   id='cance_timer'>取消(2)</a>

</td>
</tr>
</tbody>
</table>
</div></div></div></div>


<div class="xcaik" id="waiting" style="width: 400px; top:25%; left: 50%; margin: 50px 0px 0px -200px;background-color:#f5efed; padding-top:10px;  padding-bottom:10px;    border-radius: 10px;
    border: 0px solid #d4d2cc;display:none;">


<div   style='width:100%;text-align:center;'>
<img src="<!--{$file_uri}-->/static/images/ling.gif"  style='height:100px;'/><br>
<div style='font-size:18px;color:#ee7a55;font-weight:700'>
超大文本正在压缩上传中(进度：<span id='upload_pre'>0</span>%)
</div>


</div></div>




<div class="xcaik" id="messageDiv3" style="width: 400px;  top:35%; left: 50%; margin: 50px 0px 0px -200px; display: none;">
 <div class="top"><b>友情提醒</b><a onclick="document.getElementById('messageDiv3').style.display='none';"><img src="<!--{$file_uri}-->/data/uploads/xx.gif"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr>
<td id="message_con3" align="center">本期投注已截止</td></tr>
<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn"  onclick="document.getElementById('messageDiv3').style.display='none';clearsels();"  >确定</a>



</td>
</tr>
</tbody>
</table>
</div></div></div></div>


<div id='re_url'></div>
<input type="hidden" name="usermode" id="usermode" value="<!--{$usermode}-->" />
    <input type="hidden" name="lotteryid" id="lotteryid" value="1" />
    <input type="hidden" name="curmid" id="curmid" value="50" />
    <input type="hidden" name="flag" id="flag" value="save" />
    <input type="hidden" name="c_n" id="c_n" value="" />
    <input type="hidden" name="c_m" id="c_m" value="" />
    <input type="hidden" value='计算' onClick="re_count(G('c_n').value,G('c_m').value)">
    <input type="hidden" name="c_p" id="c_p" value="" />
        <input type="hidden" id="base_num"  value="0" />
       <span id='last_second'  style='display:none;'></span>
<div class='gameleft' >
<!--{if $MMSSC eq '1'}-->

<!--{include file="<!--{$tplpath}-->game_top1.tpl"}-->
<!--{else}-->


<!--{include file="<!--{$tplpath}-->game_top.tpl"}-->

  <!--{/if}-->
<!--{if $game_type['skey']=='k3'}-->
    <div class="box-kuai3">
        <div class="title">
            <ul>

<!--{foreach from=$game_same_nav key=key item=item}-->
                <li onclick="location.href='game_<!--{$item['id']}-->.html';" <!--{if $smarty.get.id eq $item['id']}-->class="cur"<!--{/if}-->  ><!--{$item['fullname']}--></li>

                <!--{/foreach}-->

            </ul>



        </div>


    </div>
<!--{/if}-->
    <!--{if $game_type['show_nav2']==1}-->

    <div >
    <img src="<!--{$file_uri}-->/static/images/weihu.jpg" width="100%" style="margin-top: 10px;margin: 0 auto;">

</div>

    <!--{/if}-->

	<!--{if $game_type['show_nav2']==2}-->

    <div >
    <img src="<!--{$file_uri}-->/static/images/tingyun.jpg" width="100%" style="margin-top: 10px;margin: 0 auto;">

</div>

    <!--{/if}-->

<div class="game_wrap" <!--{if $game_type['show_nav2'] >= 1}--> style='display:none;'<!--{/if}-->>

    <div   id='playid_hidden' style='display:none;'  ></div>
        <div   id='game_cate' style='display:none;'  ><!--{$first_cate}--></div>

        <div   id='code_item' style='display:none;' ></div>
    <div class="bd">

      <!--大标签 -->
      <!--{$big_cate}-->

      <div class="game_titbar" id='game_codes' style='display:none;'></div>
      <!--大标签结束-->

      <div  id='game_loading'
      style='display:block;width:100%;clear:both;padding-top:20px;height:180px;line-height:40px;text-align:center;font-size:18px;font-weight:600;color:#EC6300;'>
<img src="static/images/loading.gif"  style='height:130px;'><br>

玩法正在加载中，请稍后......

</div>

      <div class="game_smalls" id='big_smalls'  style='display:none;'>
      <div class="game_smalls_list mbackbg" id="lt_samll_label"></div>
         <div class="game_eg" id="game_eg" >
	    <div id="lt_RXX_div" class="div_mask" style="display:none;cursor:pointer;"></div>


         </div>
	 <div class='showhelp'>
<i class="icon-warning" style="color: #fcba79;"></i>

         <span id="lt_desc"></span>
         <a  id="lt_help" >帮助
             <div id="lt_helps_div" class="div_mask" style="width:400px;"></div>
         </a>
 <a  id="lt_example">中奖示例
         <div id="lt_examples_div" class="div_mask" style="width:200px;"></div>
         </a>

         <a  id="lt_prize" style="display: none">奖金模式
         <div id="lt_prizes_div" class="div_mask" style="width:120px;"></div>
         </a>

	 </div>
	 <!--选号区 -->
	 <div class="game_pick_ball <!--{$game_type['skey']}-->" id="lt_selector">



     </div>

      </div>



<!--{include file="<!--{$tplpath}-->game_add.tpl"}-->


    </div>


    <!--{include file="<!--{$tplpath}-->game_add1.tpl"}-->
    <!--{include file="<!--{$tplpath}-->game_history.tpl"}-->
</div>


    <div style="float: right;width: 260px; <!--{if $game_type['show_nav2']>=1}-->display:none;<!--{/if}-->">



        <!--{include file="<!--{$tplpath}-->game_nav.tpl"}-->
    </div>


</div>






  <div style='clear:both;width:100%;display:both;'></div>

        <div class="row"  style='display:none;'>
        <div class="layout-base cont cont-full" id="betting-history">
            <div class="cont-head">
                <div class="title">
                    <h2><a href="<!--{$root_url}-->?mod=records&code=list"><span>投注记录</span><em>&nbsp;</em></a></h2>
                </div>
                <div class="bh-refresh" id="refreshBettingHistory"> <a href="javascript:Ajax_get_buy();"><i>&nbsp;</i>刷新</a> </div>
                <div class="more"><a href="<!--{$root_url}-->?mod=records&code=list" title="查看更多"><em>更多</em></a></div>
            </div>



            <div class="cont-body">

                <!--table start-->
                <div class="module">
                    <div class="table ta-center">
                     <div class="game_his_area" id="get_project_list"></div>

                    </div>
                </div>
                <!--table end-->

            </div>
        </div>
    </div>




<!--startprint-->
<div id='print_orders'></div>
<!--endprint-->








<style>


			.current1{color:#ff0000;font-weight:700;}

			</style>
		     	<script type="text/javascript">
		     	function set_tabs(id){
                    if(id==1){
                    	document.getElementById('top_con_1').style.display='block';
                    	document.getElementById('top_con_2').style.display='none';
                    	document.getElementById('top_tit_1').className='current1';
                    	document.getElementById('top_tit_2').className='';
                        }
                    else{
                       	document.getElementById('top_con_2').style.display='block';
                    	document.getElementById('top_con_1').style.display='none';
                    	document.getElementById('top_tit_2').className='current1';
                    	document.getElementById('top_tit_1').className='';

                        }

			     	}

		     	<!--{$qitime}-->
		     	//alert(qitime[20161219078]);




		     	</script>
<!--{if $config.safe eq '1'}-->
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/select_auto.js"></script>

<!--{else}-->
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/select_auto1.js"></script>

<!--{/if}-->
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/FunComs.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/game.js?v=10" ></script>

<script>
    period_loading();
    time_cur();
    <!--{if $periodarrs.lastsecond>0}-->
    _get_ser_time(<!--{$periodarrs.lastsecond}-->);

    <!--{else}-->
    _get_ser_time(0);
    <!--{/if}-->
   // Ajax_last_lotnum();
</script>
<script language="javascript">
var game_cate='<!--{$game_type['skey']}-->';
var game_name='<!--{$game_type['fullname']}-->';
function add_times(tt){

if(tt=='1'){
	document.getElementById('lt_sel_times').value=parseInt(document.getElementById('lt_sel_times').value)+1;


}
else{
	if(document.getElementById('lt_sel_times').value==1){

return  false;
		}
	else{

		document.getElementById('lt_sel_times').value=parseInt(document.getElementById('lt_sel_times').value)-1;
		}



}


IsMax_Times(document.getElementById('lt_sel_times'));

	       }
	       	       document.getElementById('game_codes').style.display='';
	       document.getElementById('big_smalls').style.display='block';
document.getElementById('game_loading').style.display='none';
</script>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->

