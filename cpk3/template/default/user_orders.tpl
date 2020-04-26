
<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">

                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->




                    <div class="buy_rec">
                        <form method="get" action="<!--{$this_url}-->" name="form1" id="form1">
                            <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>

                            <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                            <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                            <select name="st" id="st" onchange='set_username(this.value);' style="display: none;">
                                <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                                <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                                <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                            </select>
                            <input type="text" name="begintime" id="begintime" value="<!--{$begindate}-->"class="Wdate"  style="display: none"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">

                            <input type="text" name="endtime" id="endtime" value="<!--{$enddate}-->" class="Wdate" style="display: none"   onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">

                            <div  class="todayView" style="text-align: left;<!--{if $smarty.get.st<2}-->display: none<!--{/if}-->">
                                <em >账号：</em>

                                <input style="width: 100px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20"/>



&nbsp;
                                <input type="submit" value="搜 索" class="button">
                            </div>


                        <div class="searchType">
                            <table width="100%" border="0" cellspacing="1" cellpadding="4" >


  <tr >
     <td  align="center">

        摘要：<select name="ordertype" id="ordertype" style="width:100px;" onchange="document.getElementById('form1').submit();">
                     <option value="">全部摘要</option>
                     <!--{money_select_list()}-->
                 </select>
                 <script>selectSetItem(G('ordertype'),'<!--{$ordertype}-->')</script>
     </td>
      <td  align="center" >

                 <span >时间：
        <a  class="userSearch <!--{if $begindate==$time_arr[1]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[1]}-->','<!--{$time_arr[0]}-->',0);">今天</a>
                     <a  class="userSearch <!--{if $begindate==$time_arr[2]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[2]}-->','<!--{$time_arr[1]}-->',1);">昨天</a>
                     <a  class="userSearch <!--{if $begindate==$time_arr[3]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[3]}-->','<!--{$time_arr[0]}-->',2);">七天</a>
                 </span>
      </td>
      <td  align="center" >
                 <span >类型：
        <a  class="userSearch  active">账户明细</a>
      <a  href="home_user_recharge.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->" class="userSearch">充值记录</a>
       <a  class="userSearch  " href="home_user_platform.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->">提现记录</a></span>


</td>
   </tr>
 </table>
                        </div>
                        </form>
        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px;" class="my_tbl my_tbltdm list_tbl"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>

                                    <!--{if $smarty.get.st>1}-->
                                    <th>
                                        用户名
                                    </th>
                                    <!--{/if}-->
                                    <th>
                                        交易类型
                                    </th>
                                    <th>
                                        操作金额
                                    </th>
                                    <th>
                                        账户余额
                                    </th>
                                    <th>
                                        洗码
                                    </th>
                                    <th>
                                        洗码余额
                                    </th>
                                    <th>
                                       时间
                                    </th>

                                    <th>
                                        摘要
                                    </th>
                                </tr>





<!--{$body_list}-->
 </tbody>
</table>

<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->
                        <div  class="userTip mgt15" style="margin-top: 30px;"><p ><i class="icon-warning" ></i>温馨提示：交易记录最多只保留7天。
                            </p></div>
                        </div>

                    </div>
                    <!--详细内容iframe-end-->

                </div>
            </div>
        </div>
                        <script>


                </script>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->














