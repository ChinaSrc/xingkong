
<!--{include file="<!--{$tplpath}-->head.tpl"}-->










<!--{foreach from=$game_list key=key item=item}-->
		                        <div class='wap_list drawing-table' style="border-radius: 5px;"  >
		                        <table>
		                        <tr>


		                        <td  style='vertical-align:top;padding-top:0px;padding-right:0px;'  onclick='location.href="<!--{$root_url}-->lottery_<!--{$item['ckey']}-->.html?mobile=1"'>

		                        <div class='item'  style='width: 100%;'>


                         <span style='font-size:16px;color: #222;'> <!--{$item['fullname']}--></span>
									<span style='float:right;color:#666;padding-right:5px;'>第<!--{$item['period']}-->期</span>


		                        </div>
									<div style="width: 100%">
										<div class="list-inline numbers number-circle" style="float:left;width: calc(100% - 80px)">
											<!--{$item['number']}-->
										</div>
										<div style="float: right;margin-right:5px;display: inline-block;vertical-align: middle; padding: 0px 5px;background: #818699;color:#fff; border-radius: 5px;">
											开奖历史

						</div>
									</div>

		                        </td>

                                  <td style='width:50px;'>

									  <a href="game_<!--{$item['id']}-->.html?mobile=1"
										 style="margin-top:5px; height:40px;line-height:20px;padding:5px 0px;text-align:center;display:block;border-radius:5px;background-color: #ff0000;color: #fff!important;">
										  立即<br>投注
									  </a>


                                  </td>

		                        </tr>


		                        </table>


</div>


	  <!--{/foreach}-->














</div>




    </div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




</body>
</html>

