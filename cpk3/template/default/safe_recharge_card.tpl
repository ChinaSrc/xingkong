


<div class="recharge_box"  >



<div style="padding-left: 120px;line-height: 50px">
<div>
    卡号：<input onKeyUp="value=value.replace(/[\W]/g,'')" type="text" name="card_number"   id="card_number" value="" style="width: 300px" placeholder="请输入充值卡卡号" required>
</div>
    <div>
        卡密：  <input onKeyUp="value=value.replace(/[\W]/g,'')" type="text" name="card_pwd"   id="card_pwd" value=""  style="width: 300px" placeholder="请输入充值卡卡密" required>
    </div>

    <div style="padding-left: 40px;">
        <input name="order" type="button" class="button" value="确认充值" onclick="order_sub();" />

        <a href="home_user_recharge.html" target="_blank" style="margin-left: 30px;color: #38f;">充值记录</a>
        <a href="<!--{$config['rechargecard']}-->" target="_blank" style="margin-left: 50px;color: #38f;">购卡链接</a>
    </div>




</div>


    <div  class="userTip" style="margin-top: 30px">
        <p >※ 温馨提示：<br  /> </p>
        <div  id="tips">
            <!--{$con_system['charge_note1']}-->
        </div>
        <p></p>
    </div>


                                                <input name="paymothod" type="hidden" value="<!--{$method}-->" />
                                                <input name="selectbank" type="hidden" value="充值卡支付" />
                                                <input name="banktype" type="hidden" value="<!--{$tpl}-->" />
                                                <input id='selectpt' name="selectpt" type="hidden" value="<!--{$tpl}-->" />





</div>
</div>







<script type="text/javascript">


    function order_sub(){


            if(document.getElementById('card_number').value==''){

                window.wxc.xcConfirm('请输入充值卡号！',window.wxc.xcConfirm.typeEnum.warning);

                return false;


            }
            if(document.getElementById('card_pwd').value==''){

                window.wxc.xcConfirm('请输入充值卡密！',window.wxc.xcConfirm.typeEnum.warning);

                return false;


            }



            document.getElementById('chargeform').submit();
            return true;



        // show_bg('block','请在新打开的页面完成充值');
        document.getElementById('chargeform').submit();

    }

</script>

