<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

<!--{if $perid==""}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
<!--{/if}-->
   
	  <table width="100%" border="0" cellspacing="1" cellpadding="4"  class='table_b'> 
 	       
	       <tr class='table_b_tr_b'>
 	          <td align="center" width=20%>用户名称：</td>
		  <td align="left" width=80%><em><!--{$per_info.username}--></em> </td>
  	       </tr> 
 	       <tr class='table_b_tr_b'>
 	          <td align="center">用户昵称：</td>
		  <td align="left"><em><!--{$per_info.nickname}--></em></td>
  	       </tr> 
 	       <tr class='table_b_tr_b'>
 	          <td align="center">频道余额：</td>
		  <td align="left"><em id='user_amount'><!--{$per_info.hig_amount}--></em> </td>
  	       </tr> 
 	       <tr class='table_b_tr_b'>
 	          <td align="center">团队余额：</td>
		  <td align="left"><em id='team_amount'><!--{$user_amount_team}--></em> </td>
  	       </tr>   	 
	   </table>      
       
 
<script>
    var user_amount=G('user_amount').innerHTML;
    var team_amount=G('team_amount').innerHTML;
    G('user_amount').innerHTML=moneyFormat(user_amount);
    G('team_amount').innerHTML=moneyFormat(team_amount);
</script> 
<!--{if $perid==""}-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
<!--{/if}-->   
