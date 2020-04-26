<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{if $perid==""}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
<!--{else}--> 
<div style="width:560px;height:400px;overflow:scroll;overflow-y:scroll;">
<!--{/if}--> 
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="15%" style="font-weight:bold;">用户名称：</td>
      <td align="left" width="35%"><!--{$per_info.username}--></td>
      <td align="right" width="15%" style="font-weight:bold;">用户昵称：</td>
      <td align="left" width="35%"><!--{$per_info.nickname}--></td>
    </tr>
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">用户等级：</td>
      <td align="left"><!--{if $per_info.isproxy=="0"}-->代理<!--{else}-->用户<!--{/if}--> 
      </td>
      <td align="right" style="font-weight:bold;">可用余额：</td>
      <td align="left"><!--{$per_info.hig_amount}--></td>
    </tr>
</table>


<div id='game_div'>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class='table_b'>
   <tr class='table_b_tr_a'>
      <td colspan='6'> 
      <div id='game_div_a'> 
      <ul id='game_ul_a'>
      <!--{section name=p loop=$game_arr}-->
          <!--{if $game_arr[p].ckey==<!--{$games}-->}-->
	       <li class='cur'><!--{$game_arr[p].ckey}--></li>
          <!--{else}-->
	       <a href='<!--{$this_url}-->&games=<!--{$game_arr[p].ckey}-->&modes=<!--{$modes}-->&perid=<!--{$perid}-->'><li class='nor'><!--{$game_arr[p].ckey}--></li></a>
	  <!--{/if}--> 
      <!--{/section}-->
      </ul> 
      </div> 
      </td>
   </tr>
   <tr class='table_b_tr_a'>
      <td colspan='6' valign=middle height=40> 
          <div id='mode_div_a'>
	      <ul id='mode_ul_a'>  
	       <!--{foreach from=$modes_arr key=arrkey item=arrtitle}--> 
		  <!--{if $arrtitle==<!--{$modes}-->}-->
		      <li class='cur'><!--{$arrtitle}--></li> 
		  <!--{else}-->
		      <a href='<!--{$this_url}-->&games=<!--{$games}-->&modes=<!--{$arrtitle}-->&perid=<!--{$perid}-->'><li class='nor'><!--{$arrtitle}--></li></a> 
		  <!--{/if}--> 
	       <!--{/foreach}-->
	      <ul>
	  </div>
      </td>
   </tr>
   <tr class='table_b_th'>	
     <th>玩法群</th> 
     <th>玩法组</th> 
     <th>奖级</th> 
     <th>奖金</th> 
     <th id='point_title'>返点</th> 
     <th>状态</th> 
   </tr>
   <!--{$show_body}-->
</table>
</div>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$tplpath}-->js/user_set.js"></script> 
<!--{if $perid==""}-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
<!--{else}--> 
</div>
<!--{/if}--> 


