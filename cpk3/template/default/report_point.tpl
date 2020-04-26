<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
<table width="100%" border="0" cellspacing="1" cellpadding="4"  class='table_b'>
  <form method="POST" action="<!--{$this_url}-->" name="form1" id="form1"> 
  <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
  <tr  class='table_b_tr_b'>
      <td height=30>
	  &nbsp;&nbsp;<b>日　　期</b>：<input type="text" name="begindate" id="begindate" value="<!--{$begindate}-->" class="input_02" style="width:80px;"  onClick="SelectDate(this,'yyyy-MM-dd')"/>
          &nbsp;&nbsp;<input type="submit" value="搜　索" class="button_10_25_b">
      </td>
  </tr>  
</form> 
</table>  
<table width=100% border="0" cellspacing="1" cellpadding="1" class='table_b'> 
<tr align="center" class='table_b_th'>
    <th width='30%'>代理用户</th>
    <th width='40%'>时间段</th>
    <th width='30%'>返点总额</th>
</tr> 
<tr align="center" class='table_b_tr_b'>
    <td><!--{$cur_username}--></td>
    <td><!--{$serch_s}--></td>
    <td><span id='hig_rebate'><!--{$money_num}--></span>&nbsp;元</td>
</tr>
</table> 
 
<script>
    var hig_rebate=G('hig_rebate').innerHTML;G('hig_rebate').innerHTML=moneyFormat(hig_rebate);
</script> 
			 
	
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
