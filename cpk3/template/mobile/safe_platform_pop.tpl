<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->  
<!--{include file="<!--{$tplpath}-->block_navi.tpl"}-->  
<!--{if $editpass=="yes"}-->
   <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#ffffff;">您的登陆密码与资金密码相同，请先进行更改！</div>',next:3,goTo:'<!--{$root_url}-->?mod=safe&code=pass'});</script>
<!--{else}--> 
   <table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
   <form action="<!--{$this_url}-->&active=put" method="post" name="form1" id="form1">
     <div style='display:none'>
         <input type="text" id="money" name="money" size="20" value="<!--{$amount}-->" style="display:none">
         <input type="text" id="perid" name="perid" size="20" value="<!--{$userid}-->" style="display:none">
         <input type="text" id="cateshow" name="cateshow" size="20" value="<!--{$cateshow}-->" style="display:none">
         <input type="text" id="txtype" name="txtype" size="20" value="<!--{$mcate}-->" style="display:none">
         <input type="text" id="realname" name="realname" size="20" value="<!--{$userbank[0]}-->" style="display:none">
         <input type="text" id="bankname" name="bankname" size="20" value="<!--{$userbank[1]}-->" style="display:none">
         <input type="text" id="banknum" name="banknum" size="20" value="<!--{$userbank[2]}-->" style="display:none"> 
     </div>
     <tr class='table_b_th'>
       <td colspan=2 style="font-weight:bold;text-align:center;color:yellow;">提示：请确认以下信息是否正确,否则提现请求可能被拒绝！</td> 
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1" width="20%">您的开户行：</td>
       <td align="left"> 
           <span id="acc_name" style="font-size:14px;"><!--{$userbank[1]}--></span></td>
     </tr> 
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1">您的银行帐户名：</td>
       <td align="left"><span id="email" style="font-size:14px;"><!--{$userbank[0]}--></span></td>
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1">您的银行帐号：</td>
       <td align="left"><!--{$userbank[2]}--></td>
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1">您的余额：</td>
       <td align="left"><span id="amount" style="font-size:14px;"><!--{$cur_amount}--></span></td>
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1">提现金额：</td>
       <td align="left"><span id="amount" style="font-size:14px;"><!--{$amount}--></span>　<span class='font_line_1'>[<!--{$cateshow}-->]</span> </td>
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" class="font_title_1">提现金额(大写)：</td>
       <td align="left"><span id="amount" style="font-size:14px;"><!--{$amount}--></span></td>
     </tr>
     <tr class='table_b_tr_b'>
       <td align="right" style="font-weight:bold;"></td>
       <td align="left">
       <!--{if $mcate=="zx"}-->
          <input type='submit' name='submit' id='btsubmit' value='确认提交' class='button_10_25_b' onclick="return winPop({title:'我要提现',form:'form1',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true'})">
	  &nbsp;&nbsp;<font color='yellow'>平台客服核实您的充值款后，会在最快的时间内将款打入您的平台帐号。</font>
       <!--{else}-->
         <input type='submit' name='submit' id='btsubmit' value='确认提交' class='button_10_25_b' onclick="return winPop({title:'我要提现',form:'form1',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true'})">
	  &nbsp;&nbsp;<font color='yellow'>确认后，平台将提现金额转入您的上级，请及时联系上级。</font>
       <!--{/if}-->
       </td>
     </tr> 

     </form>
   </table> 
<!--{/if}--> 
<script>
function copyinfor(id){
	try{
       var clipBoardContent=document.getElementById(id).innerHTML;
       window.clipboardData.setData("Text",clipBoardContent);
       var title = document.getElementById(id+ "_title").innerHTML;
       alert( "【" + title + "】复制成功!" );
	}catch(e){
       alert('您的firefox安全限制限制您进行剪贴板操作，请打开’about:config’将signed.applets.codebase_principal_support’设置为true’之后重试！');
	}
}
function show_demo(width,height_s){ 
	var demo_infor=G("demo_infor").innerHTML;
	var diag = new Dialog();
	diag.Width = parseInt(width);
	diag.Height =parseInt(height_s);
	  
	diag.Title = "提现提示";
	diag.InvokeElementId="demo_infor"
	diag.OKEvent = function(){diag.close();};//点击确定后调用的方法
	diag.show();

}
</script>
	
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   
