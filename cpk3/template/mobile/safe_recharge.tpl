



<!--{include file="<!--{$tplpath}-->head.tpl"}-->
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<style>


    .stepBox {

        margin: 0px;

        position: relative;

    }

    .stepBox .qrcode ins:first-child{
        vertical-align: middle;

    }


    .stepBox .qrcode img{
        width:190px;

    }
    .stepBox .alipayee {
        margin-top: 20px
    }

    .stepBox .alipayee ins:nth-child(2) {
        color: #e4393c
    }

    .stepBox .bankStyle ins:first-child {
     width: 100px;
    }

    .stepBox .bankStyle span {
        font-weight: 100!important
    }

    .stepBox>em {
        font-family: defFont;
        font-size: 18px;color:#fff;
        text-align: center;
        color: #fff;
        border-radius: 50%;
        background-color: #2e4158;
      width: 22px;display: inline-block;
    }

    .stepBox>span {
        font-size: 14px;
        text-align: center
    }

    .stepBox>ul {
        display: table;
        width: 100%;
        margin-top: 13px;
        table-layout: fixed;
        margin-bottom: 13px
    }

    .stepBox>ul>li {
        display: table-row;
        line-height: 35px;



    }

    .stepBox>ul>li ins {
        text-decoration: blink;
        display: table-cell; padding: 8px 0px;
        border-bottom: 1px #ddd solid;
    }

    .stepBox>ul>li ins:nth-child(3) a {
        color: #4aa9db
    }

    .stepBox>ul>li ins span {
        font-weight: 700
    }
    .stepBox>ul>li ins .code{
        color:#e4393c;width: 180px;display: inline-block}
    .stepBox>ul h6 {
        display: table-caption;
        text-align: center
    }

    .stepBox p {
        margin-top: 0;
        margin-bottom: 0
    }

    .stepBox .erweima img {
        width: 100px;
        height: inherit;
        vertical-align: top
    }

    .stepBox .verifyRight,.stepBox .verifyWrong {
        display: block
    }

    .stepBox .verifyRight ins,.stepBox .verifyWrong ins {
        width: auto;
        display: inline
    }

    .quickPay .verifyRight,.quickPay .verifyWrong {
        display: inline-block
    }

    .bankTable {
        overflow: hidden
    }

    .bankTable+li ins {
        padding-top: 6px
    }

    .bankTable ins:first-child {
        vertical-align: middle
    }

    .selectBankCon {
        display: inline;
        position: relative
    }

    .selectBankCon i {
        position: absolute
    }

    .selectBank {
        border: 1px solid #ddd;
        display: inline-block;
        padding: 0 5px;
        padding-right: 40px;
        color: #000;
        line-height: 30px;
        cursor: pointer;
        border-radius: 2px
    }

    .selectBank i:before {
        content: "\E928";
        font-family: defFont;
        font-style: normal;
        padding-left: 10px
    }

    .selectBank ins {
        display: none;
        width: 72px;
        text-align: center
    }

    .bankList {
        position: absolute;
        background: #fff;
        border: 1px solid #ddd;
        width: 380px!important;
        padding: 10px 20px;
        margin-top: -3px;
        left: 0;
        box-shadow: 2px 2px 4px #999
    }

    .bankList li {
        border-bottom: 1px dotted #ccc;
        cursor: pointer
    }

    .bankList li:hover {
        box-shadow: 2px 2px 2px #999;
        outline: 1px solid #eee
    }

    .bankList li ins {
        line-height: 1.4
    }

    .bankList li ins,.iconBank {
        display: inline-block;
        vertical-align: middle
    }

    .bankblockList .rb {

        width: 96%;
        height: 32px;
        border: 0px solid #d3d3d3;

        cursor: pointer;
        position: relative;
text-align: center;

    }

    .bankblockList .rb span {


        height: 32px;
        display: inline-block;
        vertical-align: top;
        line-height: 32px
    }
    .bankblockList .rb img{
        height:18px;
       vertical-align: top;margin-top: 6px;
    }

    .bankblockList .rb.rb_active {
        border: 1px solid #4aa9db
    }




</style>



<div class="xcConfirm" id="msg_show" style="display: none">
    <div class="xc_layer"></div>
    <div class="popBox" style="height:200px;top:400px;width: 400px">
        <div class="ttBox" style="overflow: hidden"><a class="clsBtn" onclick="document.getElementById('msg_show').style.display='none';"></a>
            <span class="tt">付款提示</span>
        </div>
        <div style="height:70px;padding:10px;font-size:16px;font-weight: normal;text-align: center;padding-top: 30px;">
            <p>
                请在新打开的页面完成汇款
            </p>

        </div>
        <div class="btnArea">
            <div class="btnGroup"><a class="sgBtn ok" onclick="document.getElementById('msg_show').style.display='none';">继续付款</a>

                <a class="button" href="home_user_recharge.html" style='font-size:14px;'>查看付款结果</a>
            </div>
        </div>
    </div>
</div>






<!--{if $smarty.get.method}-->


<div class="wap_list" style="margin-bottom: 0px">

    <form name="DefaultForm" id='chargeform' method="post" action="home_safe_recharge.html?method=<!--{$method}-->&active=put" <!--{if $method=='online'}-->target='_blank'<!--{/if}-->>

    <!--{include file="<!--{$tplpath}-->safe_recharge_<!--{$tpl}-->.tpl"}-->
    </form>


</div>


<!--{else}-->
<!--{foreach from=$recharge_type_arr  key=key item=item}-->



<div class="wap_list" onclick="location.href='home_safe_recharge.html?method=<!--{$key}-->';" style="    display: table;table-layout: fixed;">
<div style="display: table-cell;;width:80px;height:60px;line-height: 60px;text-align: center;padding-top: 0px;">

<img src="<!--{$file_uri}-->/static/images/ico/<!--{$key}-->.png" style="height: 50px;vertical-align:middle ">

</div>
    <div style="display: table-cell;line-height: 25px;font-size: 18px;height: 50px;vertical-align: top;padding-top: 10px;">
        <!--{$item}--><br>
        <span style="color: #999;font-size: 14px">

<!--{$method_tips[$key]}-->
        </span>

    </div>
    <div style="display: table-cell;padding-right: 10px;text-align: right;width: 40px;line-height:60px">


        <i  class="icon-right-open-big" style="font-size: 24px;"></i>
    </div>


</div>

<!--{/foreach}-->

<!--{/if}-->


<script type="text/javascript" src="<!--{$file_uri}-->/template/default/2018/sy2/js/clipboard.min.js"></script>
<script>


    var clipboard = new Clipboard('i[id^="click-to-copy"]');
    clipboard.on('success', function(e) {
        alert("复制到剪贴板：" + e.text)
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        alert('Action:', e.action);
        alert('Trigger:', e.trigger);
    });
    function copy_text(id) {
        window.getSelection().removeAllRanges();//这段代码必须放在前面否则无效
        var Url2=document.getElementById(id);//要复制文字的节点
        var range = document.createRange();
        // 选中需要复制的节点
        range.selectNode(Url2);
        // 执行选中元素
        window.getSelection().addRange(range);
        // 执行 copy 操作
        var successful = document.execCommand('copy');

        // 移除选中的元素
        window.getSelection().removeAllRanges()
        alert('复制成功');
    }




</script>

        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




