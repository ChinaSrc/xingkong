<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<header class="top" style="display: none">

    <!--{if $smarty.get.st<2}-->
    <ul><li class="on"  ><a>投注</a></li>
        <li class=""  ><a href="home_user_task.html">追号</a></li></ul>

    <!--{else}-->
     <div class="title">下级投注记录</div>
    <!--{/if}-->





</header>
<div  id="leftTabBox">
    <div  class="hd"><ul >

            <li  class="userSearch <!--{if $begin==$time_arr[1]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[1]}-->','<!--{$time_arr[0]}-->',0);">今天</li>
            <li  class="userSearch <!--{if $begin==$time_arr[2]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[2]}-->','<!--{$time_arr[1]}-->',1);">昨天</li>
            <li  class="userSearch <!--{if $begin==$time_arr[3]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[3]}-->','<!--{$time_arr[0]}-->',2);">七天</li>


        </ul></div>
  </div>

                       <form action="home_user_buy.html" method="get" target="_self" id="form1"
                             style='line-height:40px;padding-left:10px;padding-top:5px;'>

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

 <select id='status' name='status' onchange="document.getElementById('form1').submit();" >
                               <option value=''>-全部-</option>
                               <option value='0'>未开始</option>
                               <option value='1'>进行中</option>
                               <option value='2'>已结束</option>
                            </select>
                           <script>selectSetItem(G('status'),'<!--{$smarty.get.status}-->')</script>

                                                                  <input type="submit" class="button" onclick="" value=" 查询 " />

                        </form>

<!--{if count($list)>0}-->

<!--{foreach from=$list key=key item=item}-->

 <div class='wap_list' onclick='location.href="home_user_gameinfo.html?mobile=1&id=<!--{$item['id']}-->";' style="line-height: 30px;font-size: 16px;" >

    <div>
        <!--{$item['playname']}-->(第<!--{$item['period']}-->期)
        <span style='float:right;'><!--{show_buystatus($item)}--></span>

    </div>
<div>
    玩法： <!--{$item['wanfa']}-->（<span style="display: inline-block"><!--{$item['number']}--></span>）

</div>
<div>
单号：<!--{$item['buyid']}-->

</div>
     <div>
         金额：<!--{$item['money']}-->
         注数：<!--{$item['nums']}-->
中奖金：<!--{$item['pri_money']}-->
         中奖数：<!--{$item['prizenum']}-->
     </div>




</div>

<!--{/foreach}-->


<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

<!--{else}-->
<div class='no_records'>当前搜索条件未发现投注记录</div>

<!--{/if}-->

        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->








