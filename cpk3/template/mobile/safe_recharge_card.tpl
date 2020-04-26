
<div  id="isShow">
    <div  class="stepBox" style="border:0px">

        <ul  class="bankStyle">



            <li  class="bankTable">
                <ins style="width: 70px;">
                    卡号：
                </ins>
                <ins >
                    <input onKeyUp="value=value.replace(/[\W]/g,'')" type="text" name="card_number"   id="card_number" value="" style="width:90%" placeholder="请输入充值卡卡号" required>
                </ins></li>
            <li >
                <ins >
                    卡密：

                </ins>
                <ins>
                    <input onKeyUp="value=value.replace(/[\W]/g,'')" type="text" name="card_pwd"   id="card_pwd" value=""  style="width: 90%" placeholder="请输入充值卡卡密" required>

                </ins>
            </li>
            <li style="width:200px">
              <a href="<!--{$config['rechargecard']}-->" target="_blank" style="margin-left: 0px;color: #38f;">购卡链接</a>
            </li>



        </ul>
        <input name="order" type="button" class="button" value="确认并提交" onclick="order_sub();" style="width: 100%;height:40px;line-height: 40px;margin: 10px auto;" />


        <div  class="userTip" style="margin-top: 20px">
            <p >※ 温馨提示：<br  /> </p>
            <div  id="tips">
                <!--{$con_system['charge_note1']}-->
            </div>
            <p></p>
        </div>

    </div>


</div>







                                                <input name="paymothod" type="hidden" value="<!--{$method}-->" />
                                                <input name="selectbank" type="hidden" value="充值卡支付" />
                                                <input name="banktype" type="hidden" value="<!--{$tpl}-->" />
                                                <input id='selectpt' name="selectpt" type="hidden" value="<!--{$tpl}-->" />








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

