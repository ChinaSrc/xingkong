<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/logreg.min.css" />



    <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/css/xcConfirm.css"/>

</head>


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
        if(!document.getElementById('rule').checked){
            window.wxc.xcConfirm('未满18周岁不能注册',window.wxc.xcConfirm.typeEnum.warning);
            return  false;
        }


        document.getElementById('regform').submit();

    }

    function isChineseChar(str){
        var reg = /[\u4E00-\u9FA5\uF900-\uFA2D]/;
        return reg.test(str);
    }
    function  show_rule(){

        if(document.getElementById('clause').style.display=='block'){

            document.getElementById('li_11').style.height='45px';
            document.getElementById('regform').style.height='370px';
            document.getElementById('clause').style.display='none';
        }
        else{
            document.getElementById('li_11').style.height='250px';
            document.getElementById('regform').style.height='550px';
            document.getElementById('clause').style.display='block';


        }

    }
    function getKey111(){

        document.getElementById("vPic").src='/source/plugin/this.aspx?rand='+Math.random()*10;



    }
</script>

<div  class="login" >
    <div id="login">

        <div id="login-area">



            <h1>用户注册 <span>Register</span>
                <div style="color: #333;font-size: 14px;font-weight: normal;padding-top: 8px;">
                    温馨提示：注册成功后系统将随机分配一张个性头像。
                </div>
            </h1>

            <!--<div class="service"><a style="cursor:pointer" onClick="openKefu()">在线客服</a></div>-->
            <form id="J-login-form"  action="index.aspx?mod=reg&type=clickadd" method="post" method="post">
                <div class="user-name "  <!--{if $con_system['regcode_status']==3}-->style='display:none;'<!--{/if}-->><label>  <!--{if $con_system['regcode_status']==1}--><span class="red">*</span>  <!--{/if}-->邀请码：</label>
                    <input onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" type="text" value="<!--{$code}-->" placeholder="请输入邀请码"  name="code" id="code"  required  tabindex="1"   class="ipt" />
                </div>


                <div class="user-name "><label><span class="red">*</span>账号：</label>
                    <input onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" type="text" value="" placeholder="请输入账号"  name="username" id="username"  tabindex="1"   class="ipt" required />
                </div>
                <div class="password "><label><span class="red">*</span>密码：</label>
                    <input  onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" type="password" value=""  placeholder="请输入密码"  name="password" id="password" type="password" required autocomplete="off"" tabindex="2"  class="ipt" />
                </div>


                <div class="password "><label><span class="red">*</span>确认密码：</label>
                    <input onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" name="password2" id="password2" type="password" autocomplete="off"  tabindex="3" placeholder="请确认密码" required  class="ipt" />
                </div>

        <!--{foreach from=$field_list key=key item=item}-->
        <div class="user-name "><label>  <!--{if $item['must']==1}--><span class="red">*</span><!--{/if}--><!--{$item['title']}-->：</label>
            <input type="text" onkeyup="value=value.replace(/[^\w\.\-\_\/]/ig,'')" value="" placeholder="请输入<!--{$item['title']}-->"  name="field[<!--{$item['id']}-->]" id="field_<!--{$item['id']}-->"    <!--{if $item['must']==1}-->required<!--{/if}-->  class="ipt" />
        </div>


        <!--{/foreach}-->



                <div class="pin "><label><span class="red">*</span>验证码：</label>
                    <input type="text" onkeyup="this.value=this.value.replace(/^\s+|\s+$/g,'')" value="" placeholder="请输入验证码" name="Verifycode" id="Verifycode" class="ipt" required />
                    <img id="vPic" onclick="getKey111();" src="<!--{$root_url}-->source/plugin/this.aspx" alt="" class="code-pic" style="height:36px;" />&nbsp;<a onclick="getKey111();" style="cursor:pointer;font-size:8px">点击刷新</a>

                    </div>


                    <div class="pin "  style="height:20px;line-height: 20px;"><label> </label>

                    <input type="checkbox" id="rule" value="1" checked>我已年满18周岁
                    </div>
              <div >
                  <input id="J-form-submit" class="button" type="submit" value="注册" onclick="return user_add();">


                  <a href="login.html"  style="margin-left: 30px;color: #ff4444;">已有账号？直接登录</a>



              </div>
            </form>
            <div style="text-align: center;clear: both;padding-top:10px;height:30px;line-height: 30px;">


            </div>
        </div><!-- login-area -->
    </div>


</div>


<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
</body>
</html>






















