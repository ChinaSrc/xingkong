
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<div  id="leftTabBox">
    <div  class="hd"><ul >

            <li  onclick="location.href='home_user_orders.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->';" class="userSearch">账户明细</li>
            <li  class="userSearch " onclick="location.href='home_user_recharge.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->';">充值记录</li>
            <li  class="userSearch  active" >提现记录</li>


        </ul></div>
</div>


<form method="get" action="<!--{$this_url}-->" name="form1" id="form1" style='line-height:40px;padding-left:10px;padding-top:5px;'>
    <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
    <input name="mod" value="<!--{$smarty.get.mod}-->" style='display:none'>
    <input name="code"  value="<!--{$smarty.get.code}-->" style='display:none'>

    <select name="st" id="st" style="display: none">
        <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
        <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
        <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
    </select>

    <input type="text" name="begindate" id="begindate" value="<!--{$begindate}-->"class="Wdate"  style="width:100px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">
    &nbsp;&nbsp;至
    <input type="text" name="enddate" id="enddate" value="<!--{$enddate}-->" class="Wdate" style="width:100px;"   onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">&nbsp;

    <input style="width: 80px;<!--{if $smarty.get.st<2 || !$smarty.get.username}-->display: none<!--{/if}-->" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />




    <input type="submit" value="搜 索" class="button"></td>
</form>

<!--{if count($list)>0}-->
<!--{foreach from=$list key=key item=value}-->
<div class='wap_list' >


    <div>
        <span style='color:#d5d5d5;'>用户：</span> <!--{$value['username']}-->


        <span style="float: right;">       <!--{if $value['status']=='0'}-->等待审核<!--{/if}-->
            <!--{if $value['status']=='1'}-->提现成功<!--{/if}-->
            <!--{if $value['status']=='2'}-->提现失败<!--{/if}-->     </span>

    </div>
    <div >
        <span style='color:#d5d5d5;'> 余额：</span><span>        <!--{$value['hig_amount']}--></span>

        <span style='float:right;color:#ff0000;'><!--{$value['money']}--></span>
    </div>
    <div >

        <!--{if $value['online'] eq '0'}-->
        <!--{$value['bankname']}-->
        <!--{else}-->

        <!--{$value['bankname']}-->
        <!--{/if}-->

        <span style='float:right;color:#d5d5d5;'>     <!--{$value['creatdate']}--></span>
    </div>

</div>

<!--{/foreach}-->


<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->
</td>
</tr>

<!--{else}-->


<div class="drawing-table">
    <div class="complete">
        <div class="complete-sub image"> <span><img src="<!--{$file_uri}-->/static/images/empty.png" alt=""></span> </div>
        <div class="complete-sub title">
            <h2>呃...当前查询条件没有记录!</h2>
        </div>
    </div>
</div>


<!--{/if}-->



</div>
</div>
</div>
<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 














