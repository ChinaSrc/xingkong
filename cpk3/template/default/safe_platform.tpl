


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
				<!--{include file="<!--{$tplpath}-->user_top.tpl"}-->




				<div class="add-wrap" style="margin-bottom: 0px">
						<div class="home_rec">



							<div class="un_box">


								<div class="selt_bank paynew">


									<script type="text/javascript">
									<!--{if $num>=$config['MaxGetCash_num']}-->
									alert('您今天的提现次数已经超过<!--{$config['MaxGetCash_num']}-->次，请明天再来');
									location.href='?mod=report&code=platform';
									<!--{/if}-->

									$(document).ready(function(){
										$("form[name='getMoneyForm']").submit(function(){


											$("#checkOrder").attr("disabled","disabled");
											var cashMin = <!--{$config['MinGetCash_amount']}-->;
											var cash = $("#getMoney").val();
											var pas = $("#pass1").val();
	                                       if (cash == "") {
												window.wxc.xcConfirm('请输入提现金额！',window.wxc.xcConfirm.typeEnum.warning);
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash == 0) {
												window.wxc.xcConfirm('提现金额不能为0！',window.wxc.xcConfirm.typeEnum.warning);
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (isNaN(cash)) {
												window.wxc.xcConfirm('提现金额必须为数字！',window.wxc.xcConfirm.typeEnum.warning);
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash < cashMin) {

												window.wxc.xcConfirm('每次最少提现'+ cashMin + '元！',window.wxc.xcConfirm.typeEnum.warning);
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
											if (cash > <!--{$config['MaxGetCash_amount']}-->) {

												window.wxc.xcConfirm('每次最多可以提现<!--{$config['MaxGetCash_amount']}-->元',window.wxc.xcConfirm.typeEnum.warning);
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (pas == "") {
												window.wxc.xcConfirm('请输入提现密码！',window.wxc.xcConfirm.typeEnum.warning);
												$("#pass").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}
										});
                                      
                                      $("form[name='greenMoneyForm']").submit(function(){


											$("#checkOrder").attr("disabled","disabled");
											var cashMin = <!--{$config['MinGetCash_amount']}-->;
											var cash = $("#greenMoney").val();
											var pas = $("#pass2").val();
	                                       if (cash == "") {
												window.wxc.xcConfirm('请输入提现金额！',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash == 0) {
												window.wxc.xcConfirm('提现金额不能为0！',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (isNaN(cash)) {
												window.wxc.xcConfirm('提现金额必须为数字！',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash < cashMin) {

												window.wxc.xcConfirm('每次最少提现'+ cashMin + '元！',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}



											if (cash > <!--{$amount['hig_amount']}-->) {

												window.wxc.xcConfirm('所提金额不能超过账户可提金额',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}
											if (cash > <!--{$config['MaxGreen_amount']}-->) {

												window.wxc.xcConfirm('每次最多可以提现<!--{$config['MaxGreen_amount']}-->元',window.wxc.xcConfirm.typeEnum.warning);
												$("#greenMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (pas == "") {
												window.wxc.xcConfirm('请输入提现密码！',window.wxc.xcConfirm.typeEnum.warning);
												$("#pass2").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}
										});
									});
									</script>
									<!--提交提现开始-->
                                  <form name="greenMoneyForm" method="post" action="/home_green_channel.html">
<div style="text-align:center"><span style="color:red;font-size:20px">绿色通道</span></div>
										<ul>
											
                                           <li >
												<span class="paytdle">可提金额：</span><span class="red">
									<!--{$amount['hig_amount']}-->元</span>
											</li>
										
											<li>
												<span class="paytdle">提现金额：</span>
												<input name="getMoney" id="greenMoney" type="text"  class="input_txt"  /> <em class="tips"> 元（每次最少提现<!--{$config['MinGetCash_amount']}-->元，最高提现<!--{$config['MaxGreen_amount']}-->元<!--{$active_bank_sum}-->）</em>
											</li>
											<li >
												<span class="paytdle">提现密码：</span>
												<input name="pass" id="pass2" type="password"  class="input_txt" />
											</li>
											<li>
												<span class="paytdle">&nbsp;</span>
												<input type="submit" class="button" value="提交申请" id="checkOrder" name="checkOrder" />
												<a href="?mod=user&code=platform" style="color:#fff">查看提现记录</a>
                                            </li>
										</ul>
									</form>
                                  <div class="userTip" style="margin-top: 20px;line-height: 30px;">
										1.该提现金额即为等额的充值金额<br>
										2.快速提现转充值，即可直接找客服领取彩金<br>
										<!--{$info}-->
									</div>
                                  
									<form name="getMoneyForm" method="post" action="?mod=safe&code=platform&active=put">

										<ul>

											<li>

											<li style="height:50px; ">
												<span class="paytdle">收款银行：</span>
												<span  style='float:left;'>
											<select name='bank_id'><!--{$blank_list}--></select>
											</span>
											</li>


											<li>

												<span class="paytdle">提现金额：</span>
												<input name="getMoney" id="getMoney" type="text"  class="input_txt"  /> <em class="tips"> 元（每次最少提现<!--{$config['MinGetCash_amount']}-->元<!--{$active_bank_sum}-->）</em>

											</li>



											<li >
												<span class="paytdle">提现密码：</span>
												<input name="pass" id="pass1" type="password"  class="input_txt" />
											</li>
											<li>
												<span class="paytdle">&nbsp;</span>
												<input type="submit" class="button" value="提交申请" id="checkOrder" name="checkOrder" />
												<a href="?mod=user&code=platform" style="color:#fff">查看提现记录</a></li>
										</ul>
									</form>
										<!--提交提现结束-->

									<div class="userTip" style="margin-top: 20px;line-height: 30px;">
										1.每天最多<b class="red">&nbsp;<!--{$config['MaxGetCash_num']}-->&nbsp;</b>次， 今日已提&nbsp;<b class="red"><!--{$num}--></b>&nbsp;次<br>
										2.提现处理时间：<span class="red">&nbsp;<!--{$config['Auto_JieS_Begin']}-->到<!--{$config['Auto_JieS_End']}--></span>
										<br>
										3.单笔可提现：最低<!--{$config['MinGetCash_amount']}-->元,最高<!--{$config['MaxGetCash_amount']}-->元</span>
										<!--{$info}-->
									</div>
                              		
                              
                              
								   </div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>


        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->









































