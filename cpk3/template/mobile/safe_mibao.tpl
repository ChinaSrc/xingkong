


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

        <div class=" sec_box">


            <!--{if !$mibao || $update==1}-->
            <!--{if $update==1}-->

            <div class="top">
                <div class="back" onclick="window.history.go(-1);" >
                    <i  class=" icon-left-open-big"></i>

                </div>
                <div class="title">绑定密保问题</div>

            </div>
            <!--{else}-->
             <div class="top">
                <div class="back" onclick="window.history.go(-1);" >
                    <i  class=" icon-left-open-big"></i>

                </div>
                <div class="title">设置新密保问题</div>

            </div>

            <!--{/if}-->
            <div class="sec_m">


                <form name="formmb"  action="?type=add" method="post">

                    <ul>
                        <!--{foreach from=$num_arr key=key item=item}-->

                        <li>
                            <span class="sp348 tr">问题<!--{$item}-->：</span>
                            <span>
                           <select name="question[]" >
                             <option value="">请选择密保问题</option>
                               <!--{section name=p loop=$quest_arr}-->
							<option value="<!--{$quest_arr[p]}-->" <!--{if $mibao[$key]['question'] == $quest_arr[p]}-->selected<!--{/if}-->><!--{$quest_arr[p]}--></option>
                               <!--{/section}-->

                           </select>
                        </span>
                        </li>
                        <li>
                            <span class="sp348 tr">答案<!--{$item}-->：</span>
                            <span><input name="answer[]"  type="text" class="mibaoinput"  value=''/></span>
                        </li>

                        <!--{/foreach}-->

                        <li>
                            <span class="sp348 tr"> </span>
                            <span><input name="submintmb" type="submit" class="button" value="确认提交" onclick="return click_sub();"/></span>
                        </li>
                    </ul>

                </form>

            </div>




            <!--{else}-->

<div class="top">
    <div class="back" onclick="window.history.go(-1);" >
        <i  class=" icon-left-open-big"></i>

    </div>
    <div class="title">验证密保问题</div>

</div>
            <div class="sec_m">



                <form name="formmb" onsubmit="return check(this);" action="?type=check_mibao" method="post">

                    <ul>

                        <!--{foreach from=$num_arr key=key item=item}-->
                        <!--{if $key<2}-->
                        <li>
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
                        <li>
                            <span class="sp348 tr">答案<!--{$item}-->：</span>
                            <span><input name="answer[]"  type="text" class="mibaoinput"  value=''/></span>
                        </li>
                        <!--{/if}-->
                        <!--{/foreach}-->


                        <li>
                            <span class="sp348 tr"> </span>
                            <span><input name="submintmb" type="submit" class="button" value="下一步" onclick="return click_sub();" /></span>
                        </li>
                    </ul>



                </form>
            </div>

            <!--{/if}-->


        </div>




<script>
    function click_sub() {
        var question=document.getElementsByName('question[]')  ;
        var answer=document.getElementsByName('answer[]');
        var arr_num=new Array('一','二','三');
        for(var i=0;i<question.length;i++){
            if(question[i].value==''){
                window.wxc.xcConfirm("请选择问题"+arr_num[i],window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

            if(answer[i].value==''){
                window.wxc.xcConfirm("请填写问题"+arr_num[i],window.wxc.xcConfirm.typeEnum.warning);
                return false;
            }

        }

        if(question.length==3){
            if(question[0].value==question[1].value || question[0].value==question[2].value || question[1].value==question[2].value){
                window.wxc.xcConfirm("您不能选择相同的密保问题",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

            if(answer[0].value==answer[1].value || answer[0].value==answer[2].value || answer[1].value==answer[2].value){
                window.wxc.xcConfirm("您不能回答相同的密保答案",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

        }
        else{
            if(question[0].value==question[1].value){
                window.wxc.xcConfirm("您不能选择相同的密保问题",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }

            if(answer[0].value==answer[1].value){
                window.wxc.xcConfirm("您不能回答相同的密保答案",window.wxc.xcConfirm.typeEnum.warning);

                return false;
            }


        }


    }


</script>


<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 



