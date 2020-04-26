<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2016/Content/pc/css/share.css?v=2018" rel="stylesheet"/>
<style>
  .mbchat{
    position: absolute;
    width: 50px;
    left:70px;
    top:12px;
    font-size:16px;
    color:#fff;
   
  
  }
   a:link { text-decoration: none;color: #fff}
  a:visited { text-decoration: none;color:#fff}
</style>


<link href='<!--{$file_uri}-->/<!--{$skinpath}-->style/games.css'  rel="stylesheet" type="text/css" />
<div class="sub_head_top wap_title">

    <div class="back" id="pageback"><a href="index_home.html"><img src="<!--{$file_uri}-->/static/images/return(new).png" border="0"></a></div>
<div class="mbchat"> <a href="index_chat.html?mobile=1">聊天室</a></div>
<div class="wanfa_title" >

<span class="wf_title">玩<br>法</span>

    <span class="wf_info">
        <em id="game_item_title" onclick='show_game_codes();'></em>
<i class="icon-down-open"></i>
    </span>
</div>


    <div class="signIn" style="width:60px;float:right;   position: absolute;right: 0px;top:6px;font-size:16px;"  onclick="show_nextgame();">
        <!--{$game_shortname}-->
        <span id='arrow-down2' class="xia"></span>
    </div>
</div>

<div id="wanfabg">
</div>
<div class="navbar_header_bg" style="display: none;">

    <div id='game_codes'></div>
    <div id="lt_samll_label"></div>
    <a class="navbar-brand" id='show_game_codes'  style="display: none"></a>
    <span id="arrow_down" class="xia" style="display: none"></span>



</div>

<div class="gamepopup" id="gameToggle" style="display: none;">
<div class="gametext">

    <!--{foreach from=$game_same key=key1 item=item1}-->

    <div class="gamegroup">

        <a class="item" href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html?mobile=1"><!--{$item1['fullname']}--></a>


    </div>



    <!--{/foreach}-->


</div>
</div>
<script>

    var vedio='<!--{$userinfo['vedio']}-->';
var mobile=1;
var gamekey='<!--{$game_type['ckey']}-->';
var gamename='<!--{$game_type['fullname']}-->';
var gametype='<!--{$game_type['skey']}-->';
var game_close='<!--{$game_type['status']}-->';
var wanfa_cate='ct';

var user_rebate='<!--{$user_rebate}-->';
<!--{$selplay}-->
</script>

<link rel="stylesheet" href="<!--{$tplpath}-->images/game/main.css" type="text/css" />
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/formula.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/counts.js"></script>

<script type="text/javascript" src="<!--{$file_uri}-->/static/js/jquery.fly.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/freshTime.js?v=12"></script>

	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />

<div class="xcaik" id="messageDiv" style=" position: fixed; top:150px; left: 5%; right:5%;  display: none;">
 <div class="top"><b>友情提醒</b><a onclick="buy_close();"><img src="<!--{$file_uri}-->/data/uploads/xx.gif"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr><td style='width:70px;'><img id="messageimg" src="<!--{$file_uri}-->/static/images/ok.png"></td>
<td id="message_con1" align="left" style='padding-left:50px;'>恭喜您已投注成功！</td></tr>

<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn" href='home_user_buy.html?mobile=1' id='print_btn' style="display: none">投注记录</a>

      <a class="cance_btn" onclick="buy_close();"  id='close_timer'>关闭</a>

</td>
</tr>
</tbody>
</table>
</div></div></div></div>


<div class="xcaik" id="messageDiv1" style="position: fixed; top:150px; left: 5%; right:5%;  display: none;">
 <div class="top"><b>友情提醒</b><a onclick="show_bg('none','');"><img src="<!--{$file_uri}-->/data/uploads/xx.gif"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
<td id="message_con2"  style="text-align:center;font-size:16px;height:40px;line-height:40px;">添加成功</td></tr>
<tr>
<td   style="text-align:center;">
    <a class="buy_btn" onclick="show_bg1('none','');" id='cance_timer' >关闭（1）<a>

</td>
</tr>
</tbody>
</table>
</div></div></div></div>



<div class="xcaik" id="waiting" style="position: fixed; top:150px; left: 5%; right:5%;background-color:#f5efed; padding-top:10px;  padding-bottom:10px;    border-radius: 10px;
    border: 0px solid #d4d2cc; display: none;">


<div   style='width:100%;text-align:center;'>
<img src="<!--{$file_uri}-->/static/images/ling.gif"  style='height:80px;'/><br>
<div style='font-size:18px;color:#ee7a55;font-weight:700'>
超大文本正在压缩上传中(进度：<span id='upload_pre'>0</span>%)
</div>


</div></div>


<div class="xcaik" id="messageDiv3" style="position: fixed; top:150px; left: 5%; right:5%;  display: none;">
 <div class="top"><b>友情提醒</b><a onclick="document.getElementById('messageDiv3').style.display='none';"><img src="<!--{$file_uri}-->/data/uploads/xx.gif"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr><td style='width:70px;'><img id="messageimg" src="<!--{$file_uri}-->/template/default/zdialog/images/black/icon_alert.png"></td>
<td id="message_con3" align="left">本期投注已截止</td></tr>
<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn"  onclick="clearsels();document.getElementById('messageDiv3').style.display='none';"  >确定</a>



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


<!--{include file="<!--{$tplpath}-->game_top.tpl"}-->

	    <div class='gameright' style="margin-top: 125px;margin-bottom:20px;">
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

<div class="game_wrap"  <!--{if $game_type['show_nav2']>=1}-->style='display:none;'<!--{/if}-->>

    <div   id='playid_hidden' style='display:none;'  ></div>
        <div   id='game_cate' style='display:none;'  ><!--{$first_cate}--></div>

        <div   id='code_item' style='display:none;' ></div>
    <div class="bd"  >



       <div class='jianjiao_hide' id="jianjiao"></div>

      <!--大标签结束-->
        <!--{$big_cate}-->
      <div class="game_smalls" >
         <div class="game_eg" id="game_eg" >
	    <div id="lt_RXX_div" class="div_mask" style="display:none;cursor:pointer;"></div>
	    <div id="lt_examples_div" class="div_mask" style="width:200px;display:none;"></div>
            <div id="lt_helps_div" class="div_mask" style="width:200px;display:none;"></div>
         </div>



	 <div class='showhelp'  id='help_bg'  onclick='show_help();'>

		    <a onMouseMove="pop_show(event,'lt_helps_div','','')" onMouseOut="G('lt_helps_div').style.display='none'" id="lt_help"  style='color:#666;display:none;'> [帮助]</a>
		   <a onMouseMove="pop_show(event,'lt_examples_div','','')" onMouseOut="G('lt_examples_div').style.display='none'"  id="lt_example" style='color:#666;display:none;'>[案例]</a>
         <a  id="lt_prize">奖金模式
             <div id="lt_prizes_div" class="div_mask" style="width:120px;"></div>
         </a>


	 </div>

	    <div id="lt_desc" ></div>
	 <!--选号区 -->
	 <div class="game_pick_ball <!--{$game_type['skey']}-->" id="lt_selector">注，共</div>

      </div>



<!--{include file="<!--{$tplpath}-->game_add.tpl"}-->

<!--{include file="<!--{$tplpath}-->game_extra.tpl"}-->

    </div>

</div>


</div>



<div id='game_bottom'  class='game_hide'>
<!--{if $MMSSC neq '1'}-->
<div onclick='location.href="lottery_<!--{$game_type['ckey']}-->.html?mobile=1";'>开奖信息</div>
<!--{/if}-->
<div onclick='location.href="home_user_buy.html?mobile=1";' >投注记录</div>

<div  onclick='clearsels();game_showmore();'>清空号码</div>
<div  onclick='game_showmore();'  style='font-weight:700;'>取消</div>
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


<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/select_auto.js?v=123"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/FunComs.js?v=123"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/game/game.js?v=10" ></script>


<script>
    period_loading();
   // time_cur();
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

</script>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->

