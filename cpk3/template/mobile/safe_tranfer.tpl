


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>


<style type="text/css">
	.input_txt{border:solid 1px #ccc; box-shadow:0 1px 10px rgba(0,0,0,0.1) inset;height:38px;text-indent:10px; font-size:15px; width: 200px; }
	.input_txt:focus{box-shadow:0 0 4px rgba(255,153,164,0.8);border:solid 1px #6B97B2;}
   .menu_w ul li a:hover{color:#FFFFFF;background:#006699;}


.paytdle{width:80px;display:inline-block;text-align:right;}
	</style>



						<div class="wap_list"  style='line-height:40px;'>



									<script type="text/javascript">

									$(document).ready(function(){
										$("form[name='getMoneyForm']").submit(function(){



											var cash = $("#getMoney").val();
											var pas = $("#pass1").val();
											var touser = $("#touser").val();
											if (touser == "") {
												alert('请输入收款用户！');
												$("#touser").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}


											if (cash == "") {
												alert('请输入转账金额！');
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash == 0) {
												alert('转账金额不能为0！');
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (cash <  <!--{$config['tranfer_min']}-->) {
												alert('转账金额不能低于<!--{$config['tranfer_min']}-->元！');
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

											if (isNaN(cash)) {
												alert('转账金额必须为数字！');
												$("#getMoney").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}


											if (pas == "") {
												//layer.alert('请输入转账密码！', 0, !1);
												alert('请输入转账密码！');
												$("#pass").focus();
												$("#checkOrder").removeAttr("disabled");
												return false;
											}

										});
									});
									</script>
									<!--提交转账开始-->
									<form name="getMoneyForm" method="post" action="?mod=safe&code=tranfer&active=put&mobile=1">
										<ul>
												<li>
											<span class="paytdle">可用金额：</span><span class="red">
									<!--{$amount['hig_amount']}-->元</span>
												</li>

											<li>

												<span class="paytdle">收款用户：</span>

												<!--{$touser['username']}-->
												<input name="touser" id="touser" type="hidden" value="<!--{$touser['username']}-->" />


											</li>

											<li>

												<span class="paytdle">账户类型：</span>

												<input type="radio" name="type" value='1' style='padding:0px;height:15px;'   checked >充值
												 &nbsp;
												<input type="radio" name="type" value='2' style='padding:0px;height:15px;'  >活动
											</li>

											<li style="height:50px; ">

												<span class="paytdle">转账金额：</span>
												<input name="getMoney" id="getMoney" type="text"  class="input_txt" />
												 <em class="tips"> 元</em>

											</li>
											<li style="height:50px; ">
												<span class="paytdle">转账密码：</span>
												<input name="pass" id="pass1" type="password"  class="input_txt" />
											</li>
											<li>
												<span class="paytdle" >&nbsp;</span>
												<input type="submit" class="btn_Dora_b" value="提交转账" id="checkOrder" name="checkOrder" />
</li>
										</ul>
									</form>
										<!--提交转账结束-->


								   </div>
							</div>
						</div>






<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->



































