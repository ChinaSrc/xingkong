<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />
<style>
    .ag-top {
        height: 130px;
        background: #fff;
        margin-top:5px
    }

    .ag-top .name-num {
        height:30px;
        font-size: 14px;
        padding-top: 8px;
        border-bottom: 1px solid #eee
    }

    .ag-top .name-num .lt {
        float: left;
        margin-left: 1em;
        padding-left: 1em;
        border-left: .4em solid #e23539;
        color: #222;
    }

    .ag-top .name-num .rt {
        padding: .15em 1em 0 0;
        float: right;
        color: #e2383c;
        font-size: .9em
    }

    .ag-mid {
        margin-top:10px;

        background: #fff
    }

    .ag-mid .cc1,.ag-mid .cc2,.ag-mid .cc3 {
        float: left;
        color: #fff
    }

    .ag-mid .cc1 div,.ag-mid .cc2 div,.ag-mid .cc3 div {
        text-align: center;
        border-radius: 50%;
        display: inline-block
    }

    .ag-mid .cc1,.ag-mid .cc3 {
        width: 30%
    }

    .ag-mid .cc1 div,.ag-mid .cc3 div {
        margin-top: 15px;
        width:85px;
        height: 85px;
    }

    .ag-mid .cc1 div p,.ag-mid .cc3 div p {
        font-size: 12px;
        margin: 3px 2px;
        margin-top: 28px;
    }

    .ag-mid .cc1 div span,.ag-mid .cc3 div span {
        font-size: .63em
    }

    .ag-mid .cc1 {
        text-align: right
    }

    .ag-mid .cc1 div {
        background: #287dff
    }

    .ag-mid .cc2 {
        text-align: center;
        width: 40%
    }

    .ag-mid .cc2 div {
        width:110px;
        height: 110px;
        background: #fb5136;
        margin-top: 5px
    }

    .ag-mid .cc2 div p {
        margin: 3.2em 0 .2em;
        font-size: .55em
    }

    .ag-mid .cc2 div span {
        font-size: .65em
    }

    .ag-mid .cc3 div {
        background: #fb9311
    }

    .ag-mid .method {
        font-size: 12px;
        text-align: center;
        position: relative;
        padding:5px 0px;

        color: #666;
        clear: both
    }

    .ag-mid .method i {
        font-size: 1.8em
    }

    .ag-bot {
        margin:5px  auto;
font-size: 14px;
        background: #fff;
        height:70px;
    }

    .bot-tip {
        color: #777;
        font-size: .56em;
        text-align: center;
        padding: .5em 0 .2em
    }

    .iconLoadingCon[data-v-2acd317a] {
        text-align: center
    }
    .ag-bot{
        height: 90px;}
    .bet-bonus{
        padding-top: 10px;
    }
    .bet-bonus div {
        height: auto;padding: 10px 0px;
    }
    .bet-bonus div span{margin-top:0px}

    
</style>
<div class="top">
    <div class="back" onclick="window.history.go(-1);" >
        <i  class=" icon-left-open-big"></i>

    </div>
    <ul>
        <li class=""  ><a href="home_user_yingkui.html">下级报表</a></li>
        <li class="on"  >
            <a >团队报表</a>
        </li>
    </ul>



</div>

<div  id="leftTabBox">
    <div  class="hd"><ul >


            <li class="<!--{if $begin==$time_arr[0]['begin']}--> active<!--{/if}-->" id="num_0"   onclick="set_data(0);"  >今日</li>

            <li class="<!--{if $begin==$time_arr[1]['begin']}--> active<!--{/if}-->" id="num_1"   onclick="set_data(1);"  >昨日</li>
            <li class="<!--{if $begin==$time_arr[2]['begin']}--> active<!--{/if}-->" id="num_2"   onclick="set_data(2);" >本周</li>
            <li class="<!--{if $begin==$time_arr[3]['begin']}--> active<!--{/if}-->" id="num_3"   onclick="set_data(3);" >本月</li>

        </ul></div>
</div>






                <form id="frm_search" name="frm_search"  method="post" action="" style="padding-left: 15px;">
      


                              <input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:100px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:100px;"/>
    <br>
                          
                   <input type="text" name="username" value="<!--{$smarty.post.username}-->" placeholder="请输入下级代理账号">
                                                <input type="submit" class="button" value=" 搜索 "  style='margin-top:8px;margin-left:10px;'>  

                </form>





<div >
    <div  class="ag-top">
        <div  class="name-num">
            <div  class="lt">
                我的团队报表
            </div>
            <div  class="rt">
                下级人数共<!--{$team['num']}-->人
            </div>
        </div>
        <div  class="bet-bonus">
            <div >
                <p >投注金额 (元)</p>
                <span class="mred"><!--{$yingkui['buy']}--></span>
            </div>
            <div >
                <p >中奖金额 (元)</p>
                <span  class="mred"><!--{$yingkui['prize']}--></span>
            </div>
            <div >
                <p >活动礼金 (元)</p>
                <span  class="mred"><!--{$yingkui['active']}--></span>
            </div>
        </div>
    </div>
    <div  class="ag-mid">
        <div  class="cc1">
            <div >
                <p >团队返佣 (元)</p>
                <span ><!--{$yingkui['rebate']}--></span>
            </div>
        </div>
        <div  class="cc2">
            <div >
                <p >团队盈亏 (元)</p>
                <span ><!--{$yingkui['sum']}--></span>
            </div>
        </div>
        <div  class="cc3">
            <div >
                <p >返点佣金 (元)</p>
                <span ><!--{$yingkui1['rebate']}--></span>
            </div>
        </div>
        <div  class="method">
           <i class="icon-warning"></i>团队盈亏计算公式：中奖-投注+活动+团队返佣
        </div>
    </div>
    <div  class="ag-bot">
        <div  class="bet-bonus">
            <div >
                <p >充值金额 (元)</p>
                <span  class="mred"><!--{$yingkui['recharge']}--></span>
            </div>
            <div >
                <p >提现金额 (元)</p>
                <span  class="mred"><!--{$yingkui['mention']}--></span>
            </div>
            <div >
                <p >团队余额 (元)</p>
                <span  class="mred"><!--{$team['money']}--></span>
            </div>
        </div>
    </div>
    <div  class="ag-bot">
        <div  class="bet-bonus">
            <div >
                <p >首充人数 (人)</p>
                <span ><!--{$frist_recharge}--></span>
            </div>
            <div >
                <p >注册人数 (人)</p>
                <span ><!--{$reg_num}--></span>
            </div>
            <div >
                <p >投注人数 (人)</p>
                <span ><!--{$buy_num}--></span>
            </div>
        </div>
    </div>
</div>




</div>

<script type="text/javascript">
function set_data(num){
for(var i=0;i<=3;i++){
if(i==num){

	document.getElementById('num_'+i).className='router-link-exact-active curr';
	
}
else{

	document.getElementById('num_'+i).className='';
}

	
}
if(num==0){var begin='<!--{$time_arr[0]['begin']}-->';var end='<!--{$time_arr[0]['end']}-->';}
if(num==1){var begin='<!--{$time_arr[1]['begin']}-->';var end='<!--{$time_arr[1]['end']}-->';}
if(num==2){var begin='<!--{$time_arr[2]['begin']}-->';var end='<!--{$time_arr[2]['end']}-->';}
if(num==3){var begin='<!--{$time_arr[3]['begin']}-->';var end='<!--{$time_arr[3]['end']}-->';}
document.getElementById('begintime').value=begin;
document.getElementById('endtime').value=end;
document.getElementById('frm_search').submit();
}



</script>


            <!--{include file="<!--{$tplpath}-->bottom.tpl"}-->


