<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />




<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<header class="top">

    <!--{if $smarty.get.st<2}-->
    <ul><li ><a href="home_user_buy.html">投注</a></li>
        <li class="on"  ><a >追号</a></li></ul>

    <!--{else}-->
    <div class="title">下级追号记录</div>
    <!--{/if}-->





</header>



<div  id="leftTabBox">
    <div  class="hd"><ul >

            <li  class="userSearch <!--{if $begin==$time_arr[1]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[1]}-->','<!--{$time_arr[0]}-->',0);">今天</li>
            <li  class="userSearch <!--{if $begin==$time_arr[2]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[2]}-->','<!--{$time_arr[1]}-->',1);">昨天</li>
            <li  class="userSearch <!--{if $begin==$time_arr[3]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[3]}-->','<!--{$time_arr[0]}-->',2);">七天</li>


        </ul></div>
</div>
                       <form action="home_user_task.html" method="get" target="_self" id="form1"  style='line-height:40px;padding-left:10px;padding-top:5px;'>

                           <input type="hidden" name='mobile' value="1">
                           <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                           <select name="st" id="st" onchange='set_username(this.value);' style="display: none" >
                               <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                               <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                               <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                           </select>
                           <input type="hidden" name="begintime" id="begintime" value="<!--{$begin}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>


                           <input type="hidden" name="endtime" id="endtime" value="<!--{$end}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />
                           <input style="width: 80px;<!--{if $smarty.get.st<2 || !$smarty.get.username}-->display: none<!--{/if}-->" class="textbox" name="username"  placeholder="请输入账号" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" <!--{if $smarty.get.st neq '2'}-->disabled <!--{/if}-->/>

                           <select name="lotteryid" id="lotteryid" onchange="document.getElementById('form1').submit();">


                               <option value="">-所有彩种-</option>
                               <!--{section name=p loop=$game_arr}-->
                               <option value='<!--{$game_arr[p].ckey}-->'><!--{$game_arr[p].fullname}--></option>
                               <!--{/section}-->

                           </select>
                           <script>selectSetItem(G('lotteryid'),'<!--{$lotteryid}-->')</script>

                           <select id='is_prize' name='is_prize' onchange="document.getElementById('form1').submit();" >
                               <option value=''>-全部-</option>
                               <option value='3'>已中奖</option>
                               <option value='2'>未中奖</option>
                               <option value='1'>未开奖</option>
                               <option value='9'>已撤单</option></select>
                           <script>selectSetItem(G('is_prize'),'<!--{$is_prize}-->')</script>
                                                                  <input type="submit" class="button" onclick="" value=" 查询 " />

                        </form>

<!--{if count($list)>0}-->

<!--{foreach from=$list key=key item=item}-->

 <div class='wap_list' onclick='location.href="home_user_gameinfo.html?mobile=1&id=<!--{$item['id']}-->";' >
     <div class='item'  style='border-bottom:1px solid #d5d5d5;margin-bottom:5px;width:100%;'>
         <span style='color:#d5d5d5;'>用户</span>
         <!--{$item['username']}-->
         <span class='red' style='float: right;'><!--{$item['over_peroid']}-->/<!--{$item['all_peroid']}--></span>


     </div>
		                        <div class='item'  style='width:100%;'>


                         <span style='font-size:16px;'> <!--{$item['playname']}--></span>   <span style='color:#d5d5d5;padding-left:10px;float:right;'> 第<!--{$item['period']}-->期起</span>


		                        </div>
		                               <div>
                                    <!--{$item['wanfa']}-->




                                    <span style='float:right;'><!--{$item['status']}--></span>
                                                </div>
                                                <div style='color:#d5d5d5;'>
<!--{$item['creatdate']}-->

  <span style='float:right;color:#f37030;'>详情&gt;</span>
                                                </div>

</div>

<!--{/foreach}-->


<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

<!--{else}-->
<div class='no_records'>当前搜索条件未发现投注记录</div>

<!--{/if}-->


<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->



















