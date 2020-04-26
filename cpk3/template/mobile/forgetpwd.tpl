


<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />
<style>
    .sec_m li{
        background-color: #fff;
        height:40px;
        line-height: 40px;
        padding: 0px 10px;

        clear: both;
    }
    .sec_m li span{
        display: inline-block;
        overflow: hidden;
        height:40px;
        line-height: 40px;
    }
    .sec_m li span:first-child{
        float: left;
        width: 80px;
        text-align: right;
    }
    .sec_m li span:last-child{
        padding-left: 5px;
        text-align: left;
    }

</style>


    <div class="wap_list">



            <!--{if $step==1}-->

        <div class="top">
            <div class="back" onclick="window.history.go(-1);" >
                <i  class=" icon-left-open-big"></i>

            </div>
            <div class="title">选择验证方式</div>

    </div>
    <div class="sec_m">
                <form name="form1"  action='index_forgetpwd.html?step=<!--{$step}-->' method='post'>


                    <ul>

                        <li >
                            <span class="sp348 tr">账号：</span>
                            <span><input class="mibaoinput" type="text" name="username" id="username" type="text"></span>
                        </li>
                        <li>
                            <span class="sp348 tr">验证码：</span>
                            <span>
                                           <input type="text" value="" placeholder="请输入验证码" name="validcode_source" id="validcode_source" style="width: 80px" />
                    <img id="vPic" onclick="getKey111();" src="<!--{$root_url}-->source/plugin/this.aspx" style="height:30px;vertical-align: middle" />

                            </span>
                        </li>

                        <li>
                            <span class="sp348 tr"></span>
                            <span><input type="submit" value="下一步" class="button" onclick=" return check_step1();" /></span>
                        </li>
                    </ul>
                </form>
            </div>


            <!--{/if}-->

            <!--{if $step==2}-->

        <div class="top">
            <div class="back" onclick="window.history.go(-1);" >
                <i  class=" icon-left-open-big"></i>

            </div>
            <div class="title">身份验证</div>

        </div>
 <div class="sec_m">
                <form name="form1"  action='index_forgetpwd.html?step=<!--{$step}-->' method='post'>

<input type="hidden" name="userid" value="<!--{$userid}-->">
                                <!--{foreach from=$num_arr key=key item=item}-->
                                <!--{if $key<2}-->
                                <li style="padding:8px;">
                                    <span class="sp348 tr">问题<!--{$item}-->：</span>
                                    <span>
                           <select name="question[]" >
                             <option value="">请选择密保问题</option>

                               <!--{foreach from=$mibao key=key1 item=item1}-->
							<option value="<!--{$item1['question']}-->" <!--{if $key1==$key}-->selected<!--{/if}-->><!--{$item1['question']}--></option>
                               <!--{/foreach}-->
                           </select>
                        </span>
                                </li>
                                <li style="padding:8px;">
                                    <span class="sp348 tr">答案<!--{$item}-->：</span>
                                    <span><input name="answer[]"  type="text" class="mibaoinput"  value=''/></span>
                                </li>
                                <!--{/if}-->
                                <!--{/foreach}-->


                                <li style="padding:8px;">
                                    <span class="sp348 tr"> </span>
                                    <span><input name="submintmb" type="submit" class="button" value="下一步" onclick="return click_step2();" />

                                    <a onclick="history.go(-1)" style="margin-left: 20px;">上一步</a>
                                    </span>

                                </li>
                            </ul>


                </form>
            </div>


            <!--{/if}-->




            <!--{if $step==3}-->

        <div class="top">
            <div class="back" onclick="window.history.go(-1);" >
                <i  class=" icon-left-open-big"></i>

            </div>
            <div class="title">修改密码</div>

        </div>
        <div class="sec_m">
                <form name="form1"  action='index_forgetpwd.html?step=<!--{$step}-->' method='post'>

                    <input type="hidden" name="userid" value="<!--{$userid}-->">
                    <li style="padding:8px;">
                        <span class="sp348 tr">请输入新登录密码：</span>
                        <span><input name="ps1" id="ps1" class="mibaoinput" type="password"></span>
                    </li>
                    <li style="padding:8px;">
                        <span class="sp348 tr">请确认新登录密码：</span>
                        <span><input name="ps2" id="ps2" class="mibaoinput" type="password"></span>
                    </li>


                    <li style="padding:8px;">
                        <span class="sp348 tr"> </span>
                        <span><input name="submintmb" type="submit" class="button" value="下一步" onclick="return check_step3();" />

                                    <a onclick="history.go(-1)" style="margin-left: 20px;">上一步</a>
                                    </span>

                    </li>
                    </ul>


                </form>
            </div>


            <!--{/if}-->

        </div>


    </div>
    <!--详细内容iframe-end-->

</div>
</div>

<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->

<script type="text/javascript">

    function check_step1()
    {
        var loginuser =document.getElementById("username").value;
        var randnum = document.getElementById("validcode_source").value;

        if (loginuser == ''){
            window.wxc.xcConfirm('请输入账号',window.wxc.xcConfirm.typeEnum.warning);
            return false;
        }

        if (randnum == '') {
            window.wxc.xcConfirm('请填写数字验证码',window.wxc.xcConfirm.typeEnum.warning);
            return false;
        }
        document.forms['login'].submit();
    }

    function click_step2() {
        var question=document.getElementsByName('question[]')  ;
        var answer=document.getElementsByName('answer[]');
        var arr_num=new Array('一','二','三');
        for(var i=0;i<question.length;i++){
            if(question[i].value==''){
                window.wxc.xcConfirm("请选择问题"+arr_num[i],window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

            if(answer[i].value==''){
                window.wxc.xcConfirm("请填写答案"+arr_num[i],window.wxc.xcConfirm.typeEnum.warning);
                return false;
            }

        }


            if(question[0].value==question[1].value){
                window.wxc.xcConfirm("您不能选择相同的密保问题",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

            if(answer[0].value==answer[1].value){
                window.wxc.xcConfirm("您不能回答相同的密保答案",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }



    }
    function check_step3()
    {
        if(document.getElementById('ps1').value=="") {
            window.wxc.xcConfirm("请输入新登录密码!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps2').value=="") {
            window.wxc.xcConfirm("请确认新登录密码!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps1').value!=document.getElementById('ps2').value)    	{
            window.wxc.xcConfirm("两次输入的登录密码不一致!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps1').value.length<6|| document.getElementById('ps1').value.length>50)
        {
            window.wxc.xcConfirm("登录密码长度不符合要求!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }
    }

    function getKey111(){

        document.getElementById("vPic").src='/source/plugin/this.aspx?rand='+Math.random()*10;



    }

</script>











