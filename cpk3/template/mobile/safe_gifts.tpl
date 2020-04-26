<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
<!--{if $con_system.modes_gifts=='0'}-->
   <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#ffffff;">系统未开启该功能</div>',next:3,goTo:'<!--{$root_url}-->'});</script>
<!--{else}-->
   <!--{if $is_ok=="no"}-->
       <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#ffffff;">您的还未绑定银行卡，请先绑定后再来领取！</div>',next:3,goTo:'<!--{$root_url}-->?mod=safe&code=bankinfo'});</script>
   <!--{else}--> 
   <table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
   <form action="<!--{$this_url}-->&active=put" method="post" name="form1" id="form1"> 
     <tr class='table_b_th'>
       <td style="font-weight:bold;text-align:left;" class='font_line_4 font_title_1 pad_left_10'>请选择以下选项后提交平台客服人员处理：</td> 
     </tr>
     <!--{section name=p loop=$g_title}--> 
     <!--{if $g_key[p]=="new"}-->
     <!--{if $gift_ok=="no"}-->
         <tr class='table_b_tr_b'>
	    <td style="padding-left:20px;text-align:left;height:30"> 
	       <b><input type='radio' name='user_gifts' value='<!--{$g_key[p]}-->' id='user_gifts'><!--{$g_title[p]}--></b> 
	       <font class="font_line_3">（说明：<!--{$g_body[p]}-->）</font>
	    </td>
	 </tr> 
     <!--{/if}-->
     <!--{else}-->
      <tr class='table_b_tr_b'>
	    <td style="padding-left:20px;text-align:left;height:30"> 
	       <b><input type='radio' name='user_gifts' value='<!--{$g_key[p]}-->' id='user_gifts'><!--{$g_title[p]}--></b> 
	       <font class="font_line_3">（说明：<!--{$g_body[p]}-->）</font>
	    </td>
	 </tr> 
     <!--{/if}-->

     <!--{/section}-->


     <tr class='table_b_tr_b'> 
       <td align="left" style="padding-left:40px;height:50px;line-height:50px;"> 
           <input type='submit' name='submit' id='btsubmit' value='提交' class='button_10_25_b' onclick="return winPop({title:'领购彩金',form:'form1',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true',url:'确定？'})">
       </td>
     </tr> 
  </table>			 
  <!--{/if}--> 
<!--{/if}--> 
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
