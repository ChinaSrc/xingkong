



<!--{include file="<!--{$tplpath}-->head.tpl"}-->
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<style>


    .stepBox {
        border: 1px solid #ddd;
        margin: 0 10px 10px;
        padding: 16px 20px;
        position: relative;

    }

    .stepBox:first-child{
        min-height: 180px;

    }
    .stepBox .qrcode{
        position: absolute;
        left:700px;top:20px;
        height:120px;width: 170px;
        text-align: center;

    }
    <!--{if count($hand_bank_list)>1}-->

    .stepBox .qrcode.left{
        left:160px;top:100px;
    }
<!--{else}-->
    .stepBox .qrcode.left{
        left:20px;top:50px;
    }

    <!--{/if}-->

    .stepBox .qrcode.left .title{
        display:none;}
    .stepBox .qrcode img{
        height:160px;

    }
    .stepBox .alipayee {
        margin-top: 20px
    }

    .stepBox .alipayee ins:nth-child(2) {
        color: #e4393c
    }

    .stepBox .bankStyle ins:first-child {
        width: 7%;padding-left:3%;
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
        line-height: 26px
    }

    .stepBox>ul>li ins {
        text-decoration: blink;
        display: table-cell
    }

    .stepBox>ul>li ins:first-child,.stepBox>ul>li ins:nth-child(2) {
        width: 33.33333%
    }

    .stepBox>ul>li ins:nth-child(3) a {
        color: #4aa9db
    }

    .stepBox>ul>li ins span {
        font-weight: 700
    }
    .stepBox>ul>li ins .code{
        color:#e4393c;width: 200px;display: inline-block}
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
    .bankblockList .rb i {
        width: 30px;
        background-size: 14px;
        display: inline-block;
        margin-right: 4px;
        float: left;
        height: 32px;
        line-height: 32px;
        text-align: center
    }

    .bankblockList .rb i:before {
        content: "\E927";
        font-family: defFont;
        color: #d3d3d3;
        font-size: 14px
    }

    .bankblockList .rb {
        float: left;
        width: 130px;
        height: 32px;
        border: 1px solid #d3d3d3;
        margin: 5px;
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

        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">


                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->


                <div class="newTab">

<!--{foreach from=$recharge_type_arr  key=key item=item}-->
                    <a class="<!--{if $method==$key}-->curr<!--{/if}-->" href="home_safe_recharge.html?method=<!--{$key}-->"><!--{$item}--></a>

                    <!--{/foreach}-->


                </div>

                <div class="home_rec" style="margin-bottom: 0px">

       <form name="DefaultForm" id='chargeform' method="post" action="home_safe_recharge.html?method=<!--{$method}-->&active=put" <!--{if $method=='online'}-->target='_blank'<!--{/if}-->>

           <!--{include file="<!--{$tplpath}-->safe_recharge_<!--{$tpl}-->.tpl"}-->
		</form>


                    </div>
                </div>
            </div>




        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




