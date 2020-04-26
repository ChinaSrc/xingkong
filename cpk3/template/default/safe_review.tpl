<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
   
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
  <tr class='table_b_tr_a'>
    <td width="400" align="right" style="font-weight:bold;">用户级别：</td>
    <td align=left><!--{if $cur_isproxy=="0"}-->代理<!--{else}-->用户<!--{/if}--></td>
  </tr>
  <tr class='table_b_tr_b'>
    <td align="right" style="font-weight:bold;">帐户游戏币：</td>
    <td align=left><span id='UserMoney'><!--{$cur_amount}--></span> 游戏币</td>
  </tr> 
  <tr class='table_b_tr_a'>
    <td align="right" style="font-weight:bold;">今日参与游戏：</td>
    <td align=left><span id='join_game'><!--{$max_lot_money}--></span> 游戏币</td>
  </tr>
  <tr class='table_b_tr_b'>
    <td align="right" style="font-weight:bold;">今日中奖：</td>
    <td align=left><span id='lot_game'><!--{$max_pri_money}--></span> 游戏币</td>
  </tr>
</table>

<script>
var UserMoney=G('UserMoney').innerHTML;G('UserMoney').innerHTML=moneyFormat(UserMoney)
var join_game=G('join_game').innerHTML;G('join_game').innerHTML=moneyFormat(join_game)
var lot_game=G('lot_game').innerHTML;G('lot_game').innerHTML=moneyFormat(lot_game)
</script>
	
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
