<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/logreg.min.css" />



    <script language="javascript">

        function LoginNow()
        {
            var loginuser =document.getElementById("username").value;
            var typepw = document.getElementById("loginpass_source").value;

            if (loginuser == ''){
                window.wxc.xcConfirm('请输入账号',window.wxc.xcConfirm.typeEnum.warning);
                return false;
            }
            if  (typepw == '') {
                window.wxc.xcConfirm('请输入密码',window.wxc.xcConfirm.typeEnum.warning);
                return false;
            }

            document.forms['login'].submit();
        }

        function getKey111(){

            document.getElementById("vPic").src='/source/plugin/this.aspx?rand='+Math.random()*10;



        }

    </script>

</head>

<div  class="login" >
    <div id="login">

        <div id="login-area">


            <h1>用户登录 <span>User login</span></h1>
            <!--<div class="service"><a style="cursor:pointer" onClick="openKefu()">在线客服</a></div>-->
            <form id="J-login-form"  action="index_login.html" method="post" method="post">
                <input type='hidden' name='isproxy' value='0'>
                <div class="user-name "><label>用户名：</label>
                    <input type="text" value="" placeholder="请输入账号"  name="username" id="username"  class="ipt" /></div>
                <div class="password "><label>密码：</label>
                    <input type="password" value=""  placeholder="请输入密码"  name="loginpass_source" id="loginpass_source" class="ipt" /></div>

<div>
    <input id="J-form-submit" type="submit" value="立即登录" class="button" onclick="return LoginNow();">

    <a href="index_forgetpwd.html" style="margin-left: 20px;color: #ff4444;">忘记密码？</a>
    <!--{if $con_system['regUrl']}-->

    <a href="<!--{$con_system['regUrl']}-->" style="margin-left: 10px;color: #ff4444;">立即注册</a>
   


    <!--{/if}-->
   
</div>

            </form>
           <div class="login-b">
    <img alt="Scan me!" src="<!--{$con_system['qrcodeAndriod']|getFileUri}-->" >
    </div>

        </div><!-- login-area -->
    </div>


</div>


<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
</body>
</html>





















