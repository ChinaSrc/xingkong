

<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->zdialog/zdrag.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->/js/diags.js"></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->/js/window.diags.js"></script>
<style>
    .creatAccountTitle {
        background: #fff;
        padding: 5px 10px;
        font-size: 7px;
        line-height: 30px;font-size: 16px;
    }

    .creatAccountTitle .tp-tip {
        color: #666;
        padding-left:12px;
        position: relative
    }


    .creatAccountDetail {
        padding: 0 .8em;
        background: #fff;
        font-size: .7em;
        margin-top: .5em
    }




    .creatAccountDetail li {
        height: 3.2em;
        line-height: 3.2em
    }



    .creatAccountDetail span {
        display: inline-block;
        width: 6em
    }

    .creatAccountDetail input {
        display: inline-block;
        width: 14em;
        width: -ms-calc(100% - 6.2em);
        width: calc(100% - 6.2em);
        border: none;
        background: #fff
    }
    .code-list {

        color: #777;
        background: #fff;
        margin-top: 8px;
        font-size: 14px
    }

    .code-list .tp {
        position: relative;
        height: 50px;
        padding: 10px 12px 0;
        border-bottom: 1px solid #eee
    }

    .code-list .tp input {
        margin-top: 10px;
        width: 80%;
        border: 1px solid #efefef;
        outline: none;
        font-size:16px;
    }

    .code-list .tp span {
        display: inline-block;
        margin-top: 6px;
        font-size:16px;
    }

    .code-list .tp em {
        position: absolute;
        right: 50px;
        font-size: 16px;
        top: 20px;
    }

    .code-list .tp i {
        font-size: 16px;
        margin-top: 5px;
    }

    .code-list .tp .del {
        font-size:24px;
        position: absolute;
        right:10px;
        top: 6px;
        height:40px;
        width: 30px;
        text-align: center;
        color: #989898;
        line-height:40px
    }

    .code-list .tp .code {
        font-size: .9em;
        -webkit-touch-callout: default;
        -webkit-user-select: all;
        -moz-user-select: all;
        -ms-user-select: all;
        user-select: all
    }

    .code-list .bot {
        padding: 5px 0px;
        height:30px;
    }

    .code-list .bot div {
        border-right: 1px solid #eee;
        text-align: center;
        float: left;
        width: calc(33.3333% - 2px);
        font-size: 16px;
        line-height:30px;
    }

    .code-list .bot div:last-child {
        border: none
    }
    .openAgent .searchType {
        text-align: left;
        color: #333;
        background: #fff;
        border: none
    }

    .openAgent .searchType li {
        line-height: 3.5;
        padding: 10px 50px;
        padding-bottom: 0
    }

    .openAgent .searchType li span {
        color: #333
    }

.button {
       width: 95%;
    display: block;
margin: 10px auto;
        height: 40px;
        line-height: 40px;
        background-color: #ff0a09;
    }
    .userSearch.active {
        border: #4aa9db 2px solid;

    }
    .userSearch {
        background: #fff;
        border: 1px solid #cecece;
        height: 28px;
        line-height: 28px;
        display: inline-block;
        padding: 0 12px;
        font-size: 12px;
        color: #666;
        margin-right: 6px;
        border-radius: 4px;
    }
    .rebateList ul{
        background-color: #fff;
    height:30px;line-height:30px;padding: 10px 5px;
        border-bottom: 1px solid #ddd;
    }
    .rebateList li{
        display: inline-block;
    }

    .rebateList li span{
        font-size:12px;
    color: #999;
    }
    .rebateList li:first-child{
        width: 50px;text-align: right;padding-right: 5px;

    }
    input[type='number']{
        width: 60px;height:25px;line-height: 25px;
        border: 1px solid #ddd;
    }
</style>

<div class="top">
    <div class="back" onclick="window.history.go(-1);" >
        <i  class=" icon-left-open-big"></i>

    </div>
    <ul>
        <li class="<!--{if $smarty.get.action eq 'add'}-->on<!--{/if}-->"  ><a href="home_user_url.html?action=add" >下级开户</a></li>
        <li class="<!--{if $smarty.get.action neq 'add'}-->on<!--{/if}-->"  >
            <a href="home_user_url.html">邀请码</a>
        </li>
    </ul>



</div>

            <!--{if $smarty.get.action eq 'add'}-->

            <div  class="openAgent">
                <p class="tp-tip" style="height: 30px;line-height: 30px;padding-left: 10px;">请为下级设置类型和返点，<a href="index_rebatetable.html" class="" style="color: rgb(220, 59, 64);">查看返点赔率表</a></p>
                <form action="?action=addurl" method="post" onsubmit="return checkPost();">

                    <input type="hidden" name="type" id="type" value="0">

                    <ul class="searchType">
                        <li><span>开户类型：</span>
                            <a class="userSearch active" onclick="set_type(0);">代理</a>
                            <!--<a class="userSearch" onclick="set_type(1);">玩家</a> -->

                        </li>
                    </ul>
                    <div class="rebateList">
                        <!--{foreach from=$arr_game_code key=key item=item}-->
                        <!--{if $key!='other'}-->
                        <ul>
                            <li><!--{$item}--></li>
                            <li>
                                <input style="width: 60px;" id="rebate" type="text" value="" name="rebate[<!--{$key}-->]" tag="<!--{$item}-->返点" placeholder="" min="<!--{if $rebates[$key]-$con_system['rebate_cha']>0}--><!--{$rebates[$key]-$con_system['rebate_cha']}--><!--{else}-->0<!--{/if}-->" step="0.01" max="<!--{$rebates[$key]}-->" class="userInput mgl20" />&nbsp;
                                <span>（自身返点<!--{$rebates[$key]}-->，可设置返点<!--{if $rebates[$key]-$con_system['rebate_cha']>0}--><!--{$rebates[$key]-$con_system['rebate_cha']}--><!--{else}-->0<!--{/if}-->-<!--{$rebates[$key]}-->）</span>
                            </li>
                        </ul>
                        <!--{/if}-->
                        <!--{/foreach}-->

                    </div>
                    <div style="clear: both;margin-top: 10px;">
                        <input type="submit" class="button" value="生成邀请码">

                    </div>
                </form>

            </div>
            <SCRIPT>

                function set_type(num) {
                    document.getElementById('type').value=num;
                    var a= document.querySelectorAll('.userSearch');
                    for(var i=0;i<a.length;i++){

                        if(i==num) a[i].className='userSearch active';
                        else a[i].className='userSearch';

                    }
                }
                function checkPost() {
                var rebate = document.getElementById('rebate');
                if (rebate.value === '') {
                  alert('请输入返点值');
                  return false;
                }
                return true;
              }


            </SCRIPT>


            <!--{else}-->
<div  class="main creatAccount" style="padding-bottom: 0px;" s="[object Object]">
    <div  class="creatAccountTitle radio">
        开户类型

        <a  href="home_user_url.html" class=""><input  type="radio" value="1" name="radio" <!--{if $smarty.get.type neq '1'}-->checked<!--{/if}--> /> <label  for="radio1">代理类型</label></a>
        <a  href="home_user_url.html?type=1" class="" style="padding-left: 10px"><input  type="radio" value="0" name="radio" <!--{if $smarty.get.type eq '1'}-->checked<!--{/if}--> /> <label  for="radio2">玩家类型</label></a>
    </div>
    <div   class="_div">
        <div  id="TouchScroll" class="tabLI">
            <div  data-key="false" class="InviteTableBox">


                <!--{foreach from=$list key=key item=item}-->

                <div  class="code-list">
                    <div  class="tp" style="height: 100px;">
                        <p >邀请码：<input  type="text" id="copycode_<!--{$item['id']}-->" value="<!--{$item['url']}-->" style="width: 100px;border: 0px"></p>
                        <p> 推广链接：<input type="text" id="copyurl_<!--{$item['id']}-->" value="<!--{$url}--><!--{$item['url']}-->"  style="width: 200px;border: 0px"></p>
                        <i ><!--{date('Y-m-d',$item['time'])}--></i>
                        <em >注册(<!--{$item['num']}-->)</em>
                        <div  class="del icon-cancel-circled" onclick="DeleteRegUrl('<!--{$item['id']}-->');"></div>
                    </div>
                    <div  class="bot">
                        <div onclick="DialogResetWindow('详情','do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_url&id=<!--{$item['id']}-->','500','350');">
                            查看返点
                        </div>
                        <div onclick="copy_text('copycode_<!--{$item['id']}-->');">
                            复制邀请码
                        </div>
                        <div onclick="copy_text('copyurl_<!--{$item['id']}-->');" >
                            复制注册链接
                        </div>

                    </div>
                </div>

                <!--{/foreach}-->


                <div  class="page">
                    已显示全部内容
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<!--{$file_uri}-->/template/default/2018/sy2/js/clipboard.min.js"></script>
<script>


    var clipboard = new Clipboard('div[id^="click-to-copy"]');
    clipboard.on('success', function(e) {
        alert("复制到剪贴板：" + e.text)
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        alert('Action:', e.action);
        alert('Trigger:', e.trigger);
    });




    function copy_text(id) {

        var Url2=document.getElementById(id);//要复制文字的节点
        Url2.addEventListener('focus', inputFocus);
        Url2.focus();

    }
    function inputFocus() {

        this.setSelectionRange(0, this.value.length);
        document.execCommand('copy', true);
        alert('复制成功,复制内容为:'+this.value);
        this.removeEventListener('focus', inputFocus);
        this.blur();
    }



    // [].slice.call(document.querySelectorAll('li')).forEach(function(element, i) {
    //     element.addEventListener('click', function(e) {
    //         var input = this.querySelector('[name=bankcopy]');
    //
    //         input.addEventListener('focus', inputFocus);
    //         input.focus();
    //
    //         function inputFocus() {
    //             e.preventDefault();
    //             this.setSelectionRange(0, this.value.length);
    //             document.execCommand('copy', true);
    //             alert('复制成功,复制内容为:'+this.value);
    //             this.removeEventListener('focus', inputFocus);
    //             this.blur();
    //         }
    //     })
    // })

</script>





</div>
<!--{/if}-->





<!--底部包含文件开始-->

<script type="text/javascript">
    function DeleteRegUrl(id){
        var s=confirm('确定要删除吗? ');

        if(s==true){
            var url='home_user_url.html?type=del&id='+id;
            location.href=url;
        }
        else{

            return false;
        }


    }


    function creaturl(){

        var usertype=document.getElementsByName('usertype');
        for(var i=0;i<=usertype.length;i++){
            if(usertype[i].checked)  {
                var type=usertype[i].value;
                break;
            }

        }
        winPop({title:'生成推广链接',width:'300',drag:'true',height:'100',url:'index.aspx?mod=url&code=creat&type='+type});
        //winPop('生成推广链接','index.aspx?mod=url&code=creat&type='+type,'300','100');
    }

    var  copy=0;
    function copyToClipboard(id,txt) {



        var clip = new ZeroClipboard.Client();
        ZeroClipboard.setMoviePath("<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/ZeroClipboard.swf");
        clip.setHandCursor(true);

        clip.setText(txt);

        clip.addEventListener('complete', function () {
            alert("复制成功");
            copy=0;
        });
        if(copy==0){
            copy=1;
            copyToClipboard(id,txt);
        }

        clip.glue(""+id+"");


    }
</script>













<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->












