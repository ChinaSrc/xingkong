<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->style/daili_login.css">



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
<style>
.headImg{
  width: 96px;
  height: 96px;
  margin: 10px auto;
}
.headImg img{
  border-radius:50%;
  
  border:3px solid #e2e0e0;
  vertical-align: middle;
  width: 100%;
  height: 100%;
}
  </style>
</head>
<body>
<div class="content"   id='content'>
<div class="headImg">
  <img src="<!--{$file_uri}-->/template/mobile/images/defaultHead.png" width="100%" height="100%">
</div>

    <div class="content-center">

        <div class="main-cont"  >
<form action="index_login.html?mobile=1" method="post">

   <input type='hidden' name='isproxy' value='0'>

            <ul>
                <li>
                   <span class="title">账号</span>
                    <input type="text" placeholder="请输入账号"  name="username" id="username"  />
                </li>
                <li>
                    <span class="title">密码</span>
                    <input type="password" placeholder="请输密码"  name="loginpass_source" id="loginpass_source" />
                </li>
            </ul>
    <div class="info">

       <a href="index_forgetpwd.html">找回密码</a>
    </div>

                <button class="login-vip" onclick="return LoginNow();">登录</button>
                <!--{if $con_system['regUrl']}-->

                &nbsp;<a  onclick="window.location.href='<!--{$con_system['regUrl']}-->';"  class="reg_btn">没有账号，去注册</a>

                <!--{/if}-->

            </form>
        </div>
    </div>
<style>
    .footer_other{
        /*position: fixed;*/
        bottom: 25px;left: 0px; width: 100%;
        text-align: center;
        height:30px;
        line-height: 110px;
    }
.footer_other a{
    margin: 0px 3px;
    font-size:15px;
    font-weight:700;
    display: inline-block;
    border-radius: 3px;
    padding:2px 8px;
    font-weight:300;
    background-color: #455467;
    color: #fff;
    height: 20px;
    line-height: 20px;

}

</style>

<div class="footer_other">

            <a href="index_help.html?itemid=99">如何注册</a>
            <a href="index_help.html?itemid=100">如何购彩</a>
            <a href="index_help.html?itemid=101">如何充值</a>
            <a href="index_help.html?itemid=102">如何提现</a>

</div>

</div>

</body>
</html>











