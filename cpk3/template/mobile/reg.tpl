<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->style/daili_login.css">


<script language="javascript">


 function user_add(){


     <!--{if $con_system['regcode_status']==1}-->
     if(	document.getElementById('code').value==''){
         window.wxc.xcConfirm('请输入邀请码',window.wxc.xcConfirm.typeEnum.warning);
         return  false;
     }
     <!--{/if}-->

     if(	document.getElementById('username').value==''){
         window.wxc.xcConfirm('账号不能为空',window.wxc.xcConfirm.typeEnum.warning);
         return  false;
     }
     if(	document.getElementById('password').value.length<6){
         window.wxc.xcConfirm('密码必须大于6位',window.wxc.xcConfirm.typeEnum.warning);
         return  false;
     }

     if(	document.getElementById('password2').value !=document.getElementById('password').value){
         window.wxc.xcConfirm('两次输入的密码不一致',window.wxc.xcConfirm.typeEnum.warning);
         return  false;
     }


     <!--{foreach from=$field_list key=key item=item}-->

     <!--{if $item['must']==1}-->
     if(	document.getElementById('field_<!--{$item['id']}-->').value==''){
         window.wxc.xcConfirm('<!--{$item['title']}-->不能为空',window.wxc.xcConfirm.typeEnum.warning);
         return  false;
     }
     <!--{/if}-->

     if(isChineseChar(document.getElementById('field_<!--{$item['id']}-->').value)){
         alert('<!--{$item['title']}-->不能包含中文')

         return false;
     }

     <!--{/foreach}-->


     if(	document.getElementById('Verifycode').value == ''){
         window.wxc.xcConfirm('请输入验证码',window.wxc.xcConfirm.typeEnum.warning);
         getKey111();
         return  false;
     }


     document.getElementById('regform').submit();

    	}


 function isChineseChar(str){
     var reg = /[\u4E00-\u9FA5\uF900-\uFA2D]/;
     return reg.test(str);
 }
function getKey111(){

	document.getElementById("vPic").src='<!--{$root_url}-->source/plugin/this.aspx?rand='+Math.random()*10;



}


</script>

</head>
<body>
<div class="content"   id='content'>


    <div class="content-center">

        <div class="main-cont"'>





          <form action="index.aspx?mod=reg&type=clickadd&mobile=1" method="post" name="RegForm" id="regform">

            <ul >


                <li <!--{if $con_system['regcode_status']==3}-->style='display:none;'<!--{/if}-->>
                    <span class="title"><!--{if $con_system['regcode_status']==1}--><span class="red">*</span>  <!--{/if}-->邀请码</span>
                    <input type="text" onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" value="<!--{$code}-->" placeholder="请输入邀请码"  name="code" id="code"  tabindex="0"  required   />


                </li>
                <li>

               <span class="title"><span class="red">*</span>账号</span>

                    <input onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" name="username" id="username" type="text"  tabindex="1" placeholder="请输入账号" required/>

                </li>
                <li>
                    <span class="title"><span class="red">*</span>密码</span>
                     <input  onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" name="password" id="password" type="password" autocomplete="off"" tabindex="2" placeholder="请输入6-16位密码" required/>

                </li>


                        <li>
                            <span class="title"><span class="red">*</span>确认密码</span>
                     <input  onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')"   name="password2" id="password2" type="password" autocomplete="off"  tabindex="3" placeholder="请确认密码" required/>

                </li>


                <!--{foreach from=$field_list key=key item=item}-->
                <li>

                    <span class="title"> <!--{if $item['must']==1}--><span class="red">*</span><!--{/if}--><!--{$item['title']}--></span>

                    <input type="text" onkeyup="value=value.replace(/[^\w\.\-\_\/]/ig,'')" value="" placeholder="请输入<!--{$item['title']}-->"  name="field[<!--{$item['id']}-->]" id="field_<!--{$item['id']}-->"   tabindex="4"    <!--{if $item['must']==1}-->required<!--{/if}--> />

                </li>



                <!--{/foreach}-->




                <li>
                    <span class="title"><span class="red">*</span>验证码</span>
                        <input name="Verifycode" id="Verifycode" type="text" style='width:100px;' required tabindex="7" autocomplete="off" onfocus="this.value='';" maxlength="5" placeholder="验证码"/><img id="vPic" onclick="getKey111();" src="<!--{$file_uri}-->/source/plugin/this.aspx" alt=""  style="vertical-align: middle" height="40"  />&nbsp;<a onclick="getKey111();" style="cursor:pointer;font-size:8px">点击刷新</a>


                </li>

              </ul>

              <div class="info">
                  &nbsp;<a  onclick="window.location.href='index.aspx?mod=login';" >已有账号，直接登陆</a>

              </div>
              <button name="submit_login" type="button"class="login-vip" value="" id="Regsubmit" onclick="return user_add();"/>确定</button>

          </form>






        </div>
    </div>
</div>
     <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2016/Content/pc/css/share.css" rel="stylesheet"/>

              <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/css/xcConfirm.css"/>
        <script type="text/javascript" src="<!--{$file_uri}-->/static/js/jquery-1.9.1.js"></script>
        		<script src="<!--{$file_uri}-->/static/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
<!--
<style>
    .footer_other{
        position: fixed;bottom: 25px;left: 0px; width: 100%;
        text-align: center;
        height:30px;line-height: 30px;
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
<div style="clear: both;height:40px;width: 100%">&nbsp;</div>
<div class="footer_other">

    <a href="index_help.html?itemid=99">如何注册</a>
    <a href="index_help.html?itemid=100">如何购彩</a>
    <a href="index_help.html?itemid=101">如何充值</a>
    <a href="index_help.html?itemid=102">如何提现</a>

</div>-->



</body>
</html>




















