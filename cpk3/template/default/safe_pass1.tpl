<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}--> 
<style>td{padding-left:5px;}</style>
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
<form method="POST" action="<!--{$do_this_url}-->&active=save&pass=nc" name="form" id="form">
    <tr height=25 class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>修改我的资料</td> 
    </tr>
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="25%" style="font-weight:bold;">输入新昵称：</td>
      <td align="left" width="75%"><input type="text" name="nickname" id="nickname" value='<!--{$cur_nickname}-->'>&nbsp;<font color=#777777>(4-16个字符)</font></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="25%" style="font-weight:bold;">QQ号码：</td>
      <td align="left" width="75%"><input type="text" name="qqnum" id="qqnum" value='<!--{$s_qq_num}-->'>&nbsp;<font color=#777777>请填写正确的QQ号，当您遗忘密码时可以通过QQ邮箱找回.</font></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="25%" style="font-weight:bold;">手机号码：</td>
      <td align="left" width="75%"><input type="text" name="mobilephone" id="mobilephone" value='<!--{$s_mobilephone}-->'>&nbsp;<font color=#777777></font></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;"></td>
      <td align="left">
      <!--{if $is_info_edit=="yes"}-->
        <input type="submit" id='put_button_pass' class="button_10_25_b" value="修改" onclick="winPop({title:'修改昵称',form:'form',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true'})"> 
        <input type="reset" value="重置" onClick="this.form.reset()"  class="button_10_25_b"/> 
      <!--{else}-->
      <div class='font_line_2'>资料已锁定，如需修改，请联系管理员解锁！</div>
      <!--{/if}--> 
      </td> 
    </tr> 
</form> 
</table>
   
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
<form method="POST" action="<!--{$do_this_url}-->&active=save&pass=dl" name="form1" id="form1">
    <tr height=25 class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>修改登陆密码</td> 
    </tr>
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="25%" style="font-weight:bold;">输入旧登陆密码：</td>
      <td align="left" width="75%"><input type="password" name="old_pass" id="old_pass" /></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">输入新登陆密码：</td>
      <td align="left" ><input type="password" name="new_pass" id="new_pass" /></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">确认新登陆密码：</td>
      <td align="left" ><input type="password" name="two_new_pass" id="two_new_pass" /></td> 
    </tr>  
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;"></td>
      <td align="left"><input type="submit" id='put_button_pass' class="button_10_25_b" value="修改" onclick="winPop({title:'修改登陆密码',form:'form1',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true'})"> 
        <input type="reset" value="重置" onClick="this.form.reset()"  class="button_10_25_b"/> </td> 
    </tr> 
</form> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
<form method="POST" action="<!--{$do_this_url}-->&active=save&pass=zj" name="form2" id="form2">
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>修改资金密码</td> 
    </tr>
    <tr height=25 class='table_b_tr_b'>
      <td align="right" width="25%" style="font-weight:bold;">输入旧资金密码：</td>
      <td align="left" width="75%"><input type="password" name="old_bank" id="old_bank" /></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">输入新资金密码：</td>
      <td align="left" ><input type="password" name="new_bank" id="new_bank" /></td> 
    </tr> 
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">确认新资金密码：</td>
      <td align="left" ><input type="password" name="two_new_bank" id="two_new_bank" /></td> 
    </tr>  
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;"></td>
      <td align="left"><input type="submit" id='put_button_pass' class="button_10_25_b" value="修改" onclick="winPop({title:'修改资金密码',form:'form2',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true'})"> 
        <input type="reset" value="重置" onClick="this.form.reset()"  class="button_10_25_b"/> </td> 
    </tr> 
</form> 
</table> 
 
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
