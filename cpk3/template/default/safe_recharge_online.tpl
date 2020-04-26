
<div  id="isShow">
    <div  class="stepBox" style="border:0px">

        <span ><b id="showtitle">请选择以下支付方式：</b>单笔最低
     <ins id="min">
<!--{$con_system['MinPutCash_amount']}-->
     </ins>元，最高
     <ins id="max">
<!--{$con_system['MaxPutCash_amount']}-->
     </ins></span>

        <ul  class="bankStyle">



        <li  class="bankTable">
        <ins >
            支付方式：
        </ins>
        <ins >
            <div  class="bankblockList">
                <!--{foreach from=$auto_bank_list key=key item=item}-->


                <div  class="rb rb_active"  onclick="change_bank(<!--{$key}-->);" >

                    <span  checked="checked" ><img src="<!--{$item['logo']|getFileUri}-->"><!--{$item['name']}--></span>
                </div>

                <!--{/foreach}-->



            </div>
        </ins></li>
            <li >
                <ins >
                   充值金额：

                </ins>
                <ins>
                    <input oninput = "value=value.replace(/[^\d]/g,'')"  type="text" tag="充值金额" class="userInput" name="paymoney" id="paymoney" value="" required/>元


                </ins>
            </li>

            <li >
                <ins >


                </ins>
                <ins style="padding-top: 20px;">
                    <input name="order" type="button" class="button" value="提交充值订单" onclick="order_sub();" />

                    <a href="home_user_recharge.html" target="_blank" style="margin-left: 30px;color: #38f;">充值记录</a>

                </ins>
            </li>


        </ul>

        <div  class="userTip">
            <p >※ 温馨提示：<br  /> </p>
            <div  id="tips">
<!--{$con_system['charge_note0']}-->
            </div>
            <p></p>
        </div>
        <!---->
    </div>


    </div>
</div>


<input name="paymothod" type="hidden" value="<!--{$method}-->" />
<input id="selectbank" name="selectbank" type="hidden" value="" />
<input name="banktype" type="hidden" value="<!--{$tpl}-->" />
<input id='selectpt' name="selectpt" type="hidden" value="<!--{$tpl}-->" />




<script>
    var min=<!--{$con_system['MinPutCash_amount']}-->;
    var max=<!--{$con_system['MaxPutCash_amount']}-->;
    var json_bank='<!--{$js_bank}-->';

    var temp=JSON.parse(json_bank);
    function  change_bank(num) {
        var div = document.querySelector('.bankblockList').querySelectorAll('div');
        // alert(div.length);
        for (var i = 0; i < div.length; i++) {
            if (i == num) div[i].className = 'rb rb_active';
            else div[i].className = 'rb';
        }

        var bank=temp[num];
        document.getElementById('selectpt').value =bank.type;
        document.getElementById('selectbank').value =bank.key;
    }

    change_bank(0);

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


        document.getElementById('msg_show').style.display='block';
        document.getElementById('chargeform').submit();
        return true;

    }

</script>




