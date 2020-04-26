


<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<!--头部链接开始-->
<!--主导航-->
<div id="bd">
    <div class="userMain">



        <div class="sec_box">
            <!--{if $step==1}-->

            <ul class="queue"><li class="now"><span>身份验证</span><i></i></li> <li><span>修改密码</span><i></i></li> <li><span>完成</span><i></i></li></ul>
            <div class="sec_m">
                <form name="form1"  action='home_safe_pwd3.html?step=<!--{$step}-->' method='post'>

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
                        <span><input name="submintmb" type="submit" class="button" value="下一步" onclick="return click_step1();" />


                                    </span>

                    </li>
                    </ul>


                </form>
            </div>


            <!--{/if}-->




            <!--{if $step==2}-->
            <ul class="queue"><li ><span>身份验证</span><i></i></li> <li class="now"><span>修改密码</span><i></i></li> <li><span>完成</span><i></i></li></ul>
            <div class="sec_m">
                <form name="form1"  action='home_safe_pwd3.html?step=<!--{$step}-->' method='post'>

                    <input type="hidden" name="userid" value="<!--{$userid}-->">
                    <li style="padding:8px;">
                        <span class="sp348 tr">请输入新资金密码：</span>
                        <span><input name="ps1" id="ps1" class="mibaoinput" type="password"></span>
                    </li>
                    <li style="padding:8px;">
                        <span class="sp348 tr">请确认新资金密码：</span>
                        <span><input name="ps2" id="ps2" class="mibaoinput" type="password"></span>
                    </li>


                    <li style="padding:8px;">
                        <span class="sp348 tr"> </span>
                        <span><input name="submintmb" type="submit" class="button" value="下一步" onclick="return check_step2();" />

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

   
    function click_step1() {
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
    function check_step2()
    {
        if(document.getElementById('ps1').value=="") {
            window.wxc.xcConfirm("请输入新资金密码!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps2').value=="") {
            window.wxc.xcConfirm("请确认新资金密码!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps1').value!=document.getElementById('ps2').value)    	{
            window.wxc.xcConfirm("两次输入的资金密码不一致!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }

        if(document.getElementById('ps1').value.length<6|| document.getElementById('ps1').value.length>50)
        {
            window.wxc.xcConfirm("资金密码长度不符合要求!",window.wxc.xcConfirm.typeEnum.warning);

            return false;
        }
    }


</script>











