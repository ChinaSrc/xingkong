


<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->




<div class="wap_list">
			<div class="s_level">


				<p class="ie6">
					<b class="e_mark"></b>


					建议使用字母数字组合、混合大小写等提高密码强度，保护账户安全。

				</p>
			</div>
			<div class="sec_m">
				<form name="form1" onsubmit="return check_sub(this);" action='' method='post'>

					<!--{if $bank['password'] != $userinfo['password']}-->

					<input type="hidden" name='change' value='1'>
					 <!--{/if}-->
				<ul>

					<!--{if $bank['password'] != $userinfo['password']}-->

					<li>
						<span class="sp338 tr">旧<!--{if $bank['password'] == $userinfo['password']}-->登陆<!--{else}-->提现<!--{/if}-->密码：</span>
						<span><input class="basic_txt" type="password" name="password" id="password" type="text"></span>
					</li>
					            <!--{/if}-->
					<li>
						<span class="sp338 tr">新提现密码：</span>
						<span><input name="ps1" id="ps1" class="basic_txt" type="password"></span>
					</li>
					<li>
						<span class="sp338 tr">新提现密码：</span>
						<span><input name="ps2" id="ps2" class="basic_txt" type="password"></span>
					</li>
					<li>

					<input type="submit" value="保 存" class="big_btn" />
					</li>
				</ul>
				</form>
			</div>
		</div>


                    </div>
                    <!--详细内容iframe-end-->

                </div>
            </div>

        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->

<script type="text/javascript">
function check_sub(form){
	var txt=  "提示文字，提示文字，提示文字，提示文字，提示文字，提示文字";
//	window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.info);



	<!--{if $bank['password'] != $userinfo['password']}-->
	   if(form.password.value=="") {
		 window.wxc.xcConfirm("请设置旧提现密码!",window.wxc.xcConfirm.typeEnum.warning);
		 form.password.focus();
		 return false;
	   }
	   <!--{/if}-->
	   if(form.ps1.value=="") {
			window.wxc.xcConfirm("请设置新提现密码!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps1.focus();
			return false;
	   }

		if(form.ps2.value=="") {
			window.wxc.xcConfirm("请确认新提现密码!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps2.focus();
			return false;
		}

		if(form.ps2.value!=form.ps1.value)    	{
			window.wxc.xcConfirm("两次设置的提现密码不一致!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps2.select();
			return false;
		}

		if(form.ps1.value.length<6||form.ps1.value.length>50)
		{
			window.wxc.xcConfirm("登录密码长度不符合要求!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps1.select();
			return false;
		}

		return true;
	}


</script>











