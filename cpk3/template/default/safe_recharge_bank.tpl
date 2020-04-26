
<div  id="isShow">
    <div  class="stepBox">
       <em>1</em>
        <span ><b id="showtitle">请转账到以下账户：</b>单笔最低
     <ins id="min">

     </ins>元，最高
     <ins id="max">

     </ins>元</span>
        <div class="qrcode" style="display: none">
            <div style="width: 100%;text-align: center" class="title">扫码支付</div>
            <img src="#">

        </div>
        <ul  class="bankStyle" <!--{if count($hand_bank_list)<2}-->style='padding-top:50px;'<!--{/if}-->>



            <li  class="bankTable" <!--{if count($hand_bank_list)<2}-->style='display:none'<!--{/if}-->>
                <ins >
                    收款银行：
                </ins>
                <ins >
                    <div  class="bankblockList">
                        <!--{foreach from=$hand_bank_list key=key item=item}-->


                        <div  class="rb rb_active"  onclick="change_bank(<!--{$key}-->);" >

                            <span  checked="checked" ><img src="<!--{$item['logo']|getFileUri}-->"><!--{if $method=='bank'}--><!--{$item['bankname']}--><!--{else}--><!--{$item['bank_branch']}--><!--{/if}--></span>
                        </div>

                        <!--{/foreach}-->



                    </div>
                </ins></li>
            <li id="realname" >
                <ins  >收款户名：</ins>
                <ins >
                    <div class="code" ></div><i title="复制" data-clipboard-text="" id="click-to-copy" class="copy_btn">复制</i>
                </ins></li>
            <li id="banknum">
                <ins  class="leftIn">
                    收款账号：
                </ins>
                <ins >
                    <div class="code" ></div>
                    <a  class="copy_btn">复制</a>
                </ins></li>
            <!--{if $method=='bank'}-->
            <li id="bank_branch">
                <ins  class="leftIn">
                    开户支行：
                </ins>
                <ins >
                    <div class="code" ></div>
                    <a  class="copy_btn">复制</a>
                </ins></li>
            <!--{/if}-->
        </ul>
        <!---->
    </div>
    <div  class="stepBox">
        <em>2</em>
        <span ><b >请认真填写您的转账信息：</b>请务必转账后再提交订单,否则无法及时查到您的款项！</span>
        <!---->
        <ul >
            <li >
                <ins >
                    <span >充值金额：</span>
                    <input oninput = "value=value.replace(/[^\d]/g,'')" type="text" tag="充值金额" class="userInput" name="paymoney" id="paymoney" value="" required/>

                </ins>
                <ins >
                    <span id="paytitle"><!--{if $method=='bank'}-->转账人姓名<!--{elseif $method=='alipay'}-->支付宝姓名<!--{else}-->您的微信昵称<!--{/if}-->：</span>
                    <input  type="text" tag="银行账户名" class="userInput" name="payname" id="payname" value="" required/>
                    <!---->
                </ins></li>
        </ul>
        <ul style="text-align: center;padding-top: 20px;" >
            <input name="order" type="button" class="button" value="提交充值订单" onclick="order_sub();" />

            <a href="home_user_recharge.html" target="_blank" style="margin-left: 30px;color: #38f;">充值记录</a>
        </ul>
        <div  class="userTip">
            <p >※ 温馨提示：<br  /> </p>
            <div  id="tips">

            </div>
            <p></p>
        </div>
    </div>
</div>


<input name="paymothod" type="hidden" value="<!--{$method}-->" />
<input id="selectbank" name="selectbank" type="hidden" value="" />
<input name="banktype" type="hidden" value="<!--{$tpl}-->" />
<input id='selectpt' name="selectpt" type="hidden" value="<!--{$tpl}-->" />




<script>
    var min=0;
    var max=0;
var json_bank='<!--{$js_bank}-->';

var temp=JSON.parse(json_bank);

function  change_bank(num) {
   var div= document.querySelector('.bankblockList').querySelectorAll('div');
  // alert(div.length);
for(var i=0;i<div.length;i++){
    if(i==num) div[i].className='rb rb_active';
    else  div[i].className='rb';
}

var bank=temp[num];
    document.getElementById('selectbank').value=bank.id;
document.getElementById('min').innerHTML=bank.min;
    document.getElementById('max').innerHTML=bank.max;
    min=bank.min;
    max=bank.max;
    if(bank.tips){

        document.querySelector('.userTip').style.display='block';
        document.getElementById('tips').innerHTML=bank.tips;
    }
    else{
        document.querySelector('.userTip').style.display='none';
    }

    if(bank.realname){

        document.querySelector('#realname').style.display='';
        document.querySelector('#realname').innerHTML=' <ins  >收款户名：</ins>\n' +
            '                <ins >\n' +
            '                    <div class="code" >'+bank.realname+'</div><i title="复制" data-clipboard-text="'+bank.realname+'" id="click-to-copy" class="copy_btn">复制</i>\n' +
            '                </ins>';

    }
    else{
        document.querySelector('#realname').style.display='none';
    }
    if(bank.banknum){

        document.querySelector('#banknum').style.display='';
        document.querySelector('#banknum').innerHTML=' <ins  >收款账号：</ins>\n' +
            '                <ins >\n' +
            '                    <div class="code" >'+bank.banknum+'</div><i title="复制" data-clipboard-text="'+bank.banknum+'" id="click-to-copy" class="copy_btn">复制</i>\n' +
            '                </ins>';
    }
    else{
        document.querySelector('#banknum').style.display='none';
    }
    <!--{if $method=='bank'}-->
    if(bank.bank_branch){

        document.querySelector('#bank_branch').style.display='';
        document.querySelector('#bank_branch').innerHTML=' <ins  >开户支行：</ins>\n' +
            '                <ins >\n' +
            '                    <div class="code" >'+bank.bank_branch+'</div><i title="复制" data-clipboard-text="'+bank.bank_branch+'" id="click-to-copy" class="copy_btn">复制</i>\n' +
            '                </ins>';
    }
    else{
        document.querySelector('#bank_branch').style.display='none';
    }

    <!--{/if}-->
    if(bank.ico){

        document.querySelector('.qrcode').style.display='block';
        document.querySelector('.qrcode').querySelector('img').src=bank.ico;
        if(bank.realname=='' && bank.banknum==''){


            document.querySelector('.qrcode').className='qrcode left';
            document.getElementById('showtitle').innerHTML='请扫码支付';
            <!--{if count($hand_bank_list)>1}-->

            document.querySelectorAll('.stepBox')[0].style.height='250px';

            <!--{/if}-->


        }
        else{

            document.querySelector('.qrcode').className='qrcode';
            document.querySelectorAll('.stepBox')[0].style.height='180px';

        }


    }
    else{
        document.querySelector('.qrcode').style.display='none';
    }
}

change_bank(0);
  
  /**
     * [hasIllegalChar 判断是否含有script非法字符]
     * @param  {[type]}  str [要判断的字符串]
     * @return {Boolean}     [true：含有，验证不通过；false:不含有，验证通过]
     */
    function hasIllegalChar(str) {
        return new RegExp(".*?script[^>]*?.*?(<\/.*?script.*?>)*", "ig").test(str);
    }

	function checkUser(str){
      	return str.match( /^[\u4E00-\u9FA5a-zA-Z]{2,8}$/);  //只允许中文和字母; 
      	//return str.match( /^[\u4E00-\u9FA5]{2,8}$/); //只允许中文
    }
  
    function order_sub(){

  var paymoney=parseFloat(document.getElementById('paymoney').value);


        if(document.getElementById('paymoney').value==''){

            window.wxc.xcConfirm('请输入充值金额！',window.wxc.xcConfirm.typeEnum.warning);

            return false;


        }
        if(paymoney<parseFloat(min)){

            window.wxc.xcConfirm('单次充值金额不能低于'+min+'元！',window.wxc.xcConfirm.typeEnum.warning);

            return false;


        }
        if(paymoney>parseFloat(max)){

            window.wxc.xcConfirm('单次充值金额不能高于'+max+'元！',window.wxc.xcConfirm.typeEnum.warning);

            return false;


        }

        if(document.getElementById('payname').value==''){
            window.wxc.xcConfirm(document.getElementById('paytitle').innerHTML+'不能为空',window.wxc.xcConfirm.typeEnum.warning);
            return false;

        }
		
      	if(!checkUser(document.getElementById('payname').value))
        {
          	window.wxc.xcConfirm(document.getElementById('paytitle').innerHTML+'非法字符！',window.wxc.xcConfirm.typeEnum.warning);
            return false;
        }
      
       // if(hasIllegalChar(document.getElementById('payname').value)
       //{
      //    	window.wxc.xcConfirm(document.getElementById('paytitle').innerHTML+'非法字符！',window.wxc.xcConfirm.typeEnum.warning);
       //     return false;
      // }




        document.getElementById('chargeform').submit();
        return true;

    }

</script>




