


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



            <div class="wap_list">



                <div class="un_box">


                    <div class="selt_bank paynew">


                        <script type="text/javascript">


                            $(document).ready(function(){
                                $("form[name='getMoneyForm']").submit(function(){


                                    $("#checkOrder").attr("disabled","disabled");
                                    var cashMin = 1;
                                    var cash = $("#getMoney").val();
                                    var pas = $("#pass1").val();
                                    if (cash == "") {
                                        window.wxc.xcConfirm('请输入转换金额！',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#getMoney").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }

                                    if (cash <= 0) {
                                        window.wxc.xcConfirm('转换金额不能小于0！',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#getMoney").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }

                                    if (isNaN(cash)) {
                                        window.wxc.xcConfirm('转换金额必须为数字！',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#getMoney").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }

                                    if (cash < cashMin) {

                                        window.wxc.xcConfirm('每次最少转换'+ cashMin + '元！',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#getMoney").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }



                                    if (cash > <!--{$amount['hig_amount']}-->) {

                                        window.wxc.xcConfirm('所提金额不能超过账户可提金额',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#getMoney").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }


                                    if (pas == "") {
                                        window.wxc.xcConfirm('请输入转换密码！',window.wxc.xcConfirm.typeEnum.warning);
                                        $("#pass").focus();
                                        $("#checkOrder").removeAttr("disabled");
                                        return false;
                                    }
                                });
                            });
                        </script>
                        <!--提交转换开始-->
                        <form name="getMoneyForm" method="post" action="?mod=safe&code=chat&active=put">

                            <ul>
                                <li >
                                    <span class="paytdle">平台余额：</span><span class="red">
									<!--{$amount['hig_amount']}-->元</span>
                                </li>

                                <li >
                                    <span class="paytdle">聊天室余额：</span><span class="red">
									<!--{$chat_user['money']}-->元</span>
                                </li>

                                <li>


                                <li>

                                    <span class="paytdle">转换金额：</span>
                                    <input name="getMoney" id="getMoney" type="text"  class="input_txt"  style="width: 100px;" /> <em class="tips"> 元（最少转1元）</em>

                                </li>



                                <li >
                                    <span class="paytdle">资金密码：</span>
                                    <input name="pass" id="pass1" type="password"  class="input_txt" style="height: 30px;border: 1px #ddd solid" />
                                </li>
                                <li>
                                    <span class="paytdle">&nbsp;</span>
                                    <input type="submit" class="button" value="确认并提交" id="checkOrder" name="checkOrder" />
                                 </li>
                            </ul>
                        </form>
                        <!--提交转换结束-->


                    </div>
                </div>

            </div>



<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->









































