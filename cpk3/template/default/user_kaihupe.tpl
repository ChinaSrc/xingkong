<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
   
 <table width="100%" border="0" cellspacing="0" cellpadding="4">  
  <tr height=40>
      <td>
	 <div style='margin:10px 5px;'><b>可以分配的用户数额</b>：<span id="leftcount" style="margin-right:30px;"><!--{$proxynum}--></span></div> 
		  <div style='border-top: 1px #333 solid;margin:5px;'>
     </td>
  </tr> 
  <tr >  
     <td style='height:25px;line-height:25px;'>
	  
	  统一设定: <input type="text" name="accordcount" id="accordcount"  class="input_a"> <input id="now_acc" value='<!--{$proxynum}-->' style='display:none'>
	  <input type="button"  class="button_a" id="accordset" value="统一"  onClick="Do_peie()" />
      <input type="button" id='put_button' name='put_button' value="提交" class="button_a"  onClick="checksss()" />
       
     </td> 
  </tr> 
  <tr ><td >  
<table width="100%" border="0" cellspacing="1" cellpadding="4"  class='table_b'> 
    <tr  class="table_b_th">
      <th height="30" align="center"><input type="checkbox" name="chkall" id="chkall" onclick="SelectAll('select_rows[]')" /></th>
      <th align="center">用户名</th>
      <th align="center">新增用户数额</th>
      <th align="center">本人剩余用户数额</th>
      <th align="center">下级剩余开户数额</th>
    </tr>  
   
    <!--{section name=p loop=$user_list_view}--> 
        <!--{if $smarty.section.p.index%2==0}-->
	   <tr class="table_b_tr_a"> 
	<!--{else}-->
	   <tr class="table_b_tr_b"> 
	<!--{/if}-->  
	  <td height='30' align='center'><input type='checkbox' id='select_rows' name='select_rows[]' value='<!--{$user_list_view[p].userid}-->' /></td>
	  <td align='center'><!--{$user_list_view[p].username}-->
	     <input type='hidden' name='username_<!--{$user_list_view[p].userid}-->' id='username_<!--{$user_list_view[p].userid}-->' value='<!--{$user_list_view[p].userid}-->'>
	  </td>
	  <td align='center'><input type='text' name='addcount_<!--{$user_list_view[p].userid}-->' id='addcount_<!--{$user_list_view[p].userid}-->' value=''/></td>
	  <td align='center'><!--{$user_list_view[p].proxynum}--></td>
	  <td align='center'><!--{$this_count_<!--{$user_list_view[p].userid}-->}--></td>
	</tr>   
   <!--{/section}-->  

  </table> 
 </td> 
  </tr>
 </table> 
<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
