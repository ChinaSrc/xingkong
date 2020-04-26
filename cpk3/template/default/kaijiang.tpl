<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
			<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/KaiJiang/css/kj.css" type="text/css" rel="stylesheet" />


			<div id="content-wrap" style="margin-top: 0px;">

        <div id="subContainerId"><div class="main" id="content">
<!--main-body start-->
<div class="row" id="award_content">
    <div class="layout-base main-body cont drawing-cont">

        <!--cont start-->
        <div class="row" id="dc-ssc" style="min-height: 450px;">
            <div class="cont drawing-base">
                <!--head satrt-->
                <div class="drawing-head">


                                     <form action="index_kaijiang.html" method="get" target="_self"  id='search'>




                    <!--db-checker start-->
                    <div class="db-checker" style="display: inline-block;">

                                            <div class="tp-ui-item tp-ui-forminput tp-ui-select">

                                            <div class="tp-ui-sub ">
                                                                                                    <select name="key" id="lotteryid"   onchange="$('#search').submit();">


                                                           		   <!--{foreach from=$game_list key=key item=item}-->
 <option value='<!--{$item['ckey']}-->'  <!--{if $smarty.get.key eq  $item['ckey']}-->selected<!--{/if}-->><!--{$item['fullname']}--></option>

		      <!--{/foreach}-->

        </select>
                                                <!--{if $game['skey']!='kl8'}-->
                                                <a class="button" href="index_chart.html?playkey=<!--{$game['ckey']}-->" target="_blank" style="display: inline-block;">号码走势<i class="icon-chart-line" style="margin-right: 0px;"></i></a>
                                                <!--{/if}-->


                                                <a class="button" href="game_<!--{$game['id']}-->.html" target="_blank" >去投注<i class="icon-fast-fw" style="margin-right: 0px;"></i></a>


                                            </div>
                                          </div>
                    </div>
                    <!--db-checker end-->
                    <!--db-config start-->
                    <div class="db-config" style="display: inline-block;float: right">
                        <ul>
           <!--{$datehtml}-->
                            <li>
                              按日期：

                                <input type="text" name="date" id="date" value="<!--{$date}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false});"  onblur="//alert(this.value);$('#search').submit();"/>
<a class="button"  href="javascript:$('#search').submit();">	确定</a></li>
                        </ul>
                    </div>
                    <!--db-config end-->
</form>
                </div>
                <!--head end-->
                <!--table satrt-->
                <div class="drawing-table" style="padding-top: 20px;">



   <!--{if count($lottery_list)>0 && $game['show_nav2']!=2}-->

                        <!--table start-->
                        <div class="table ta-center" id="drawing_tableDetail"  >
                            <table style='width:100%;'>
                                <thead>

                                    <tr>
                                        <th class="dl-period"><span>期号</span></th>

                                        <th class="dl-number"><span>开奖号码</span></th>


                                              <th class="dl-type"><span>开奖时间</span></th>
                                    </tr>
                                </thead>
                                <tbody>

                                      		   <!--{foreach from=$lottery_list key=key item=item}-->




                            <tr>
                                            <td>第 <!--{$item['period']}--> 期</td>
                                                <td>
                                                    <div class="list-inline numbers number-circle">
                                                     <!--{$item['Number']}-->
                                                    </div>
                                                </td>

              <td><!--{$item['LotTime']}--></td>
                                        </tr>
                        		      <!--{/foreach}-->
        <tr>

                            </tr>


                                </tbody>
                            </table>

                            <div class="page">
                                <!--{$page}-->

                            </div>
                        </div>
                        <!--table end-->
                </div>
                <!--table end-->


<!--{else}-->







                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="<!--{'static/images/empty.png'|getFileUri}-->" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>






                <!--{/if}-->







            </div>

        </div>
        <!--cont end-->

    </div>
</div>
<!--main-body end-->
</div></div>

    </div>








    <div class="clear"></div>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
