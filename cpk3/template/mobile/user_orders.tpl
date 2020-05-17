
<!--{include file="<!--{$tplpath}-->head.tpl"}-->
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<div  id="leftTabBox">
    <div  class="hd"><ul >

            <li  class="userSearch  active">账户明细</li>
            <li  onclick="location.href='home_user_recharge.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->';" class="userSearch">充值记录</a>
            <li  class="userSearch  " onclick="location.href='home_user_platform.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->';">提现记录</li></span>


        </ul></div>
</div>
                       <form action="home_user_orders.html" method="get" target="_self" id="form1"  style='line-height:40px;padding-left:10px;padding-top:5px;'>

                  <input type="hidden" name='mobile' value="1">
                  <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                           <select name="st" id="st"  onchange='set_username(this.value);' style="display: none" >
                               <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                               <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                               <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                           </select>

<input type="text" name="begintime" id="begintime" value="<!--{$begindate}-->"class="Wdate"  style="width:90px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">
至
	 <input type="text" name="endtime" id="endtime" value="<!--{$enddate}-->" class="Wdate" style="width:90px;"   onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">
                           <select name="ordertype" id="ordertype"  onchange="document.getElementById('form1').submit();">
                               <option value="">全部摘要</option>
                               <!--{money_select_list()}-->
                           </select>
                           <script>selectSetItem(G('ordertype'),'<!--{$ordertype}-->')</script>


                           <input style="width: 80px;<!--{if $smarty.get.st<2 || !$smarty.get.username}-->display: none<!--{/if}-->" class="textbox" name="username"  placeholder="用户名" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" <!--{if $smarty.get.st neq '2'}-->disabled <!--{/if}-->/>



                           <input type="submit" class="button" onclick="" value=" 查询 " />

                        </form>






<!--{if count($list)>0}-->

<!--{foreach from=$list key=key item=item}-->

 <div class='wap_list' <!--{if $item['floatid']}--> <!--{/if}--> >
<div>
    <span style='color:#d5d5d5;'> 用户：</span><!--{$item['pername']}-->




    <span style='float:right;'><!--{$item['t_money']}--></span>
</div>

		                               <div style="clear: both;">
                                  <span style='color:#d5d5d5;'> 类型：</span><!--{hig_log_code($item['cate'])}-->


                                  <span style='float:right;color:#d5d5d5'> 余额：<!--{$item['last_money']}--></span>

                                                </div>
                                                <div >

 <span style='color:#d5d5d5;'>备注：</span><!--{$item['remarks']}-->
  <span style='float:right;color:#d5d5d5;'><!--{$item['creatdate']}--></span>
                                                </div>

</div>

<!--{/foreach}-->


<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->

<!--{else}-->
<div class='no_records'>当前搜索条件未发现帐变记录</div>

<!--{/if}-->






        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->














