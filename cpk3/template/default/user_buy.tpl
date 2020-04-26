<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">

                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->



                <!--{if $smarty.get.st<2}-->
                <div class="newTab">
                    <a href="home_user_buy.html" class="curr router-link-exact-active curr">普通投注</a>
                   <!-- <a href="home_user_task.html" class="">追号投注</a>-->
                </div>


                <!--{/if}-->



                    <div class="buy_rec">
      
                       <form action="" method="get" target="_self" id="form1">

                           <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                           <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                           <input type="hidden" name='is_prize' value="<!--{$smarty.get.is_prize}-->">
                           <select name="st" id="st" onchange='set_username(this.value);' style="display: none" >
                               <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                               <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                               <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                           </select>
                           <input type="hidden" name="begintime" id="begintime" value="<!--{$begin}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>


                           <input type="hidden" name="endtime" id="endtime" value="<!--{$end}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />



                           <div  class="todayView" style="text-align: left;<!--{if $smarty.get.st<2}-->display: none<!--{/if}-->">
                               <em >账号：</em>

                               <input style="width: 100px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20"/>



                               &nbsp;
                               <input type="submit" value="搜索" class="button">
                           </div>

                           <ul  class="todayView mgb10" style="<!--{if $smarty.get.st>1}-->display: none<!--{/if}-->">
                               <li >今日概况</li> <li >
                                   投注金额：<span ><!--{$yingkui['buy']}-->元</span></li> <li >
                                   中奖金额：<span ><!--{$yingkui['prize']}-->元</span></li> <li >
                                   投注盈亏：<span ><!--{$yingkui['prize']-$yingkui['buy']}-->元</span></li>

                           </ul>









<div class="searchType">
    <table width="100%" border="0" cellspacing="1" cellpadding="4" >
        <tr >
            <td  align="center">

                彩种：
                <select name="lotteryid" id="lotteryid" onchange="document.getElementById('form1').submit();">
                    <option value="">-所有彩种-</option>
                    <!--{section name=p loop=$game_arr}-->
                    <option value='<!--{$game_arr[p].ckey}-->'><!--{$game_arr[p].fullname}--></option>
                    <!--{/section}-->

                </select>
                <script>selectSetItem(G('lotteryid'),'<!--{$lotteryid}-->')</script>
            </td>
            <td  align="center" >

                 <span >时间：
        <a  class="userSearch <!--{if $begin==$time_arr[1]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[1]}-->','<!--{$time_arr[0]}-->',0);">今天</a>
                     <a  class="userSearch <!--{if $begin==$time_arr[2]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[2]}-->','<!--{$time_arr[1]}-->',1);">昨天</a>
                     <a  class="userSearch <!--{if $begin==$time_arr[3]}-->active<!--{/if}-->"  name="time" onclick="change_time('<!--{$time_arr[3]}-->','<!--{$time_arr[0]}-->',2);">七天</a>
                 </span>
            </td>
            <td  align="center" style="width: 420px;" >
                 <span >类型：
        <a  class="userSearch  <!--{if $smarty.get.is_prize eq ''}-->active<!--{/if}-->" href="home_user_buy.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begin}-->&endtime=<!--{$end}-->&username=<!--{$smarty.get.username}-->&lotteryid=<!--{$lotteryid}-->">全部</a>
      <a  class="userSearch  <!--{if $smarty.get.is_prize eq '3'}-->active<!--{/if}-->" href="home_user_buy.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begin}-->&endtime=<!--{$end}-->&username=<!--{$smarty.get.username}-->&lotteryid=<!--{$lotteryid}-->&is_prize=3">已中奖</a>
      <a  class="userSearch  <!--{if $smarty.get.is_prize eq '2'}-->active<!--{/if}-->" href="home_user_buy.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begin}-->&endtime=<!--{$end}-->&username=<!--{$smarty.get.username}-->&lotteryid=<!--{$lotteryid}-->&is_prize=2">未中奖</a>
      <a  class="userSearch  <!--{if $smarty.get.is_prize eq '1'}-->active<!--{/if}-->" href="home_user_buy.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begin}-->&endtime=<!--{$end}-->&username=<!--{$smarty.get.username}-->&lotteryid=<!--{$lotteryid}-->&is_prize=1">等待开奖</a>
   <!--   <a  class="userSearch  <!--{if $smarty.get.is_prize eq '9'}-->active<!--{/if}-->" href="home_user_buy.html?isgetdata=yes&st=<!--{$smarty.get.st}-->&begintime=<!--{$begin}-->&endtime=<!--{$end}-->&username=<!--{$smarty.get.username}-->&lotteryid=<!--{$lotteryid}-->&is_prize=9">已撤单</a>-->


            </td>
        </tr>


    </table>


    <ul  class="todayView" style="<!--{if $smarty.get.st<2}-->display: none<!--{/if}-->">

        <!--{foreach from=$sumbuy key=key item=item}-->
        <li >
            <!--{$key}-->：<span ><!--{$item}-->元</span></li> <li >

            <!--{/foreach}-->

    </ul>


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
                               彩种
                                    </th>   
                                    
                                                              <th>
                                        玩法
                                    </th>                           
                                    <th >
                                        期号
                                    </th>
                                    <th style='width:140px;'>
                                        投注内容
                                    </th>
                                    <th>
                                        投注金额 <!--{'b.money'|show_order}-->
                                    </th>
                                    <th>
                                        开奖号码
                                    </th>
                                    <th>
                                        奖金
                                    </th>

                                    <th>
                                        状态
                                    </th>

                                    <th style='width:140px;'>
                                       投注时间 <!--{'b.creatdate'|show_order}-->
                                    </th>
                

 
               

                                                           <th>
                                操作
                                    </th>
                    
            
             
                                </tr>
                                
                         
  <!--{$game_list}--> 

                                
                               <tr>
                                    <td class="page" colspan="12" style="padding: 8px;">
                                   
<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                        <div  class="userTip mgt15" style="margin-top: 30px;"><p ><i class="icon-warning" ></i>温馨提示：投注记录最多只保留7天。
                            </p></div>
                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
                

                
    
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 








