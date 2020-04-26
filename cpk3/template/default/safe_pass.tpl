


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div class="userMain">



<div class="sec_box">
	<ul class="queue"><!----> <li class="now"><span>设置登录密码</span><i></i></li><li><span>完成</span><i></i></li></ul>
			<div class="sec_m">
				<form name="form1" onsubmit="return check_sub(this);" action='' method='post'>
				<ul>

					<li>
						<span class="sp348 tr">请输入旧登录密码：</span>
						<span><input class="mibaoinput" type="password" name="password" id="password" type="text"></span>
					</li>                    
					<li>
						<span class="sp348 tr">请输入新登录密码：</span>
						<span><input name="ps1" id="ps1" class="mibaoinput" type="password"></span>
					</li>
					<li>
						<span class="sp348 tr">请确认新登录密码：</span>
						<span><input name="ps2" id="ps2" class="mibaoinput" type="password"></span>
					</li>
					<li>
						<span class="sp348 tr"></span>
						<span><input type="submit" value="确认修改" class="button" /></span>
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

	   if(form.password.value=="") {
		 window.wxc.xcConfirm("请输入旧登录密码!",window.wxc.xcConfirm.typeEnum.warning);

		 form.password.focus();
		 return false;
	   }

	   if(form.ps1.value=="") {
			window.wxc.xcConfirm("请输入新登录密码!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps1.focus();
			return false;
	   }

		if(form.ps2.value=="") {
			window.wxc.xcConfirm("请确认新登录密码!",window.wxc.xcConfirm.typeEnum.warning);
			form.ps2.focus();
			return false;
		}

		if(form.ps2.value!=form.ps1.value)    	{
			window.wxc.xcConfirm("两次输入的登录密码不一致!",window.wxc.xcConfirm.typeEnum.warning);
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











