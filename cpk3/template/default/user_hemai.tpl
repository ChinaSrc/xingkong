<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">

            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->



                    <div class="home_rec clearfix">

                       <form action="home_user_hemai.html" method="get" target="_self">


                        <table width="100%" border="0" style="border-bottom: 0px; border-right: 0px;" cellspacing="0"
                            cellpadding="0" class="my_tbl">
                            <tr>
                                <td align='left'>
                                    范围：<select name="st" id="st" onchange='set_username(this.value);' >
                                        <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >个人</option>
                                        <option value="3"  <!--{if $smarty.get.st eq '3'}-->selected='selected'<!--{/if}--> >代理</option>
                                        <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}--> >团队</option>
                                    </select>
                                    用户名： <input style="width: 100px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" <!--{if $smarty.get.st neq '2'}-->disabled <!--{/if}-->/>

                                &nbsp;彩种：
                                    <select name="playkey" id="lotteryid">
                                        <option value="">-所有彩种-</option>

                                        <!--{set_game_select('playkey','get')}-->
                                    </select>

                                   &nbsp;期号:
      <input name="period" id="period"  class="input"  type="text" value="<!--{$smarty.get.period}-->" size="18" maxlength="40" />


	       &nbsp;类型:
	       <select name='type'>
	       <option value=''>不限</option>
	       <option value='1'  <!--{if $smarty.get.type eq '1'}-->selected<!--{/if}-->>发起的</option>
	      <option value='2'  <!--{if $smarty.get.type eq '2'}-->selected<!--{/if}-->>参与的</option>
	       </select>
                                                                     &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />
                                </td>
                            </tr>
                        </table>
                        </form>
                        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px;" class="my_tbl my_tbltdm"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                              <tr class="">

     <th class="th_name">发起人</th>
     <th class="text_l">彩种</th>
        <th class="text_l">期号</th>
     <th>方案进度</th>
     <th class="fa_money">方案金额</th>
     <th class="mf_money">每份金额</th>
     <th class="mf_money">剩余份数</th>
     <th>状态</th>
     <th>操作</th>
    </tr>
     <!--{section name=p loop=$hm_list}-->
    <tr class="" onmouseover="Yobj.addClass(this, 'th_on')" onmouseout="Yobj.removeClass(this, 'th_on')">



     <td class="th_name"> <!--{$hm_list[p]['user_name']}--></td>
     <td class="eng text_l new_record">   <!--{$hm_list[p]['game_name']}--></td>
          <td class="eng text_l new_record">   第<!--{$hm_list[p]['period']}-->期</td>
     <td class="eng">

       <!--{$hm_list[p]['mebuy']}-->%<!--{if $hm_list[p]['baodi'] gt 0}-->+<!--{$hm_list[p]['baodi']}-->%<span class="red">(保)</span><!--{/if}-->
   </td>
     <td class="eng fa_money"><!--{$hm_list[p]['money']}--><span class="gray">元</span></td>
     <td class="eng mf_money"><!--{$hm_list[p]['premoney']}--><span class="gray">元</span></td>
     <td class="eng mf_money"><span id='num1_<!--{$hm_list[p]['id']}-->'><!--{$hm_list[p]['sum1']}--></span><span class="gray">份</span></td>
          <td><!--{$arr_hemai_status[$hm_list[p]['status']]}--></td>

     <td>
     <a onclick="javascript:DialogResetWindow('<!--{$hm_list[p]['game_name']}-->第<!--{$hm_list[p]['period']}-->期合买详情','index_hemai_detail.html?id=<!--{$hm_list[p].id}-->','800','500')">详情</a></td>
    </tr>

    <!--{/section}-->
<script>
   //show_moneys(G('listnums').value,"mon")
   //var moneys=G("moneys").innerHTML;
   //var prizes=G("prizes").innerHTML;
   //G("moneys").innerHTML=moneyFormatB(moneys);
   //G("prizes").innerHTML=moneyFormatB(prizes);
   selectSetItem(G('gameid'),'<?echo $gameid;?>');
   selectSetItem(G('lotteryid'),'<?echo $lotteryid;?>')
</script>


                               <tr>
                                    <td class="page" colspan="15" style="padding: 8px;">

<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        </div>
                    </div>
                    <!--详细内容iframe-end-->

                </div>
            </div>
        </div>
        <!--底部包含文件开始-->

                        <script>
                function set_username(value){

if(value=='1'){
	document.getElementById('username').disabled=true;
	document.getElementById('username').value='';
}
	else document.getElementById('username').disabled=false;




                    }

                </script>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->








