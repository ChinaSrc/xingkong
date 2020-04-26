
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />




        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">


                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->


                <div class="buy_rec clearfix">
                    <form method="get" action="<!--{$this_url}-->" name="form1" id="form1">
                        <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
                        <input name="mod" value="<!--{$smarty.get.mod}-->" style='display:none'>
                        <input name="code"  value="<!--{$smarty.get.code}-->" style='display:none'>
                        <select name="st" id="st" onchange='set_username(this.value);' style="display: none;">
                            <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                            <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                            <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                        </select>
                        <input type="text" name="begindate" id="begintime" value="<!--{$begindate}-->"class="Wdate"  style="display: none"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">

                        <input type="text" name="enddate" id="endtime" value="<!--{$enddate}-->" class="Wdate" style="display: none" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">
                        <div  class="todayView" style="text-align: left;<!--{if $smarty.get.st<2 || !$smarty.get.username}-->display: none<!--{/if}-->">
                            <em >账号：</em>

                            <input style="width: 100px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20"/>



&nbsp;
                            <input type="submit" value="搜 索" class="button">
                        </div>
                        <div  class="searchType">
                            <table width="100%" border="0" cellspacing="1" cellpadding="4" >

                                <tr >
                                    <td  align="center">

                                       类型 <select  name='cate'  onchange="document.getElementById('form1').submit();">
                                            <option value=''>-全部-</option>
                                            <!--{foreach from=$bank_list key=key item=value}-->

                                            <option value="<!--{$value}-->"  <!--{if $smarty.get.cate == $value}-->selected<!--{/if}-->><!--{$value}--></option>
                                            <!--{/foreach}-->
                                        </select>

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
        <a  class="userSearch"  href="home_user_orders.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begindate}-->&endtime=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->">账户明细</a>
      <a  class="userSearch active">充值记录</a>
                     <a  class="userSearch"  href="home_user_platform.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begindate=<!--{$begindate}-->&enddate=<!--{$enddate}-->&username=<!--{$smarty.get.username}-->">提现记录</a></span>


                                    </td>
                                </tr>

 </table>
                        </div>
                    </form>
  

          <table style="border-top: 0px; border-right: 0px; border-bottom: 0px;margin-top:10px;" class="my_tbl my_tbltdm   list_tbl" border="0" cellspacing="0"
                            cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                                             <th>
                                       用户名
                                    </th>
                                    <th>
                                        订单号
                                    </th>
                                    
                                    <th>
                                        充值金额
                                    </th>
                                    <th>
                                        账户余额
                                    </th>

                                    <th>
                                        时间
                                    </th>
                                                                     
                                    <th>
                                        账户类型
                                    </th>                                    
                                    <th>
                                        状态
                                    </th>
                                    <th>
                                       备注
                                    </th>
                                </tr>
                                          <!--{if count($list)>0}-->
                  <!--{foreach from=$list key=key item=value}--> 

					
                                <tr>
                                 <td>
                                      <!--{$value['username']}-->
                                    </td>
                                    <td>
                                      <!--{$value['order_sn']}-->
                                    </td>
                                   
                                    <td>
                                        <span class="red">  <!--{$value['money']}--></span>
                                    </td>
                                    <td>
                                         <!--{$value['hig_amount']}-->
                                    </td>

                                    <td>
                                       <!--{$value['creatdate']}-->
                                    </td>
									
									<td>
                                     
                                     
                                     	<!--{if $value['online'] eq '0'}-->
                                        <a href="javascript:void(0)" onclick="DialogResetWindow('订单 <!--{$value['order_sn']}-->汇款信息','index.aspx?mod=recharge&code=info&id=<!--{$value['id']}-->','600','250');" class="blue">  <!--{$value['bankname']}--></a>
                                   <!--{else}-->
                                   
                                    <!--{$value['bankname']}-->
                                   <!--{/if}-->
                                                                         </td> 
									
									                                   
                                    <td>
                                 <!--{if $value['status']=='0'}-->审核中<!--{/if}-->
                                 <!--{if $value['status']=='1'}-->充值成功<!--{/if}-->
                                 <!--{if $value['status']=='2'}-->充值失败<!--{/if}-->                        
                                    </td>
                                    <td>
                                        <!--{if $value['Man_remark']}-->-<!--{else}-->-<!--{/if}-->

                                    </td>
                                </tr>
                                
<!--{/foreach}-->
                                

                                <tr>
                                     <td class="page" colspan="10" style="padding: 8px;">
                                        
                                   

<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  	     
                                    </td>
                                </tr>
                                
                                  <!--{else}-->
                            <tr>
                            <td colspan="10">
                            
                            

                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="<!--{'static/images/empty.png'|getFileUri}-->" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>
                
                            </td>
                            
                            </tr>
                            
                            <!--{/if}-->
                            </tbody>
                        </table>
                    <div  class="userTip mgt15" style="margin-top: 30px;"><p ><i class="icon-warning" ></i>温馨提示：充值记录最多只保留7天。
                        </p></div>
                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 














