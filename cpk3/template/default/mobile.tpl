
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<style>
    .mobileCon {
        background: url('<!--{$con_system['mobile_bg']}-->') 50% no-repeat;
        width: 100%;
        height: 655px;
        overflow: hidden;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin-top:-20px;
        margin-bottom:-20px;
    }

    .mobile {
        position: relative;
        height: 620px;
        padding-top: 86px;
        padding-left: 162px;
        width: 820px;margin: 0 auto;display:block;

    }

    .mobileSlide {
        position: absolute;
        width: 650px;
        height: 680px;
        right: -84px;
        top: 41px
    }

    .appIcon {
        position: absolute;
        top: 135px;
        height: 85px;
        left: 480px
    }

    .mobileText {
        transition-duration: 1s;
        width: 375px;
        z-index: 2
    }

    .mobileText em,.mobileText h2,.mobileText p,.mobileText span {
        display: block
    }

    .mobileText h2 {
        font-size: 30px;
        color: #e71c1c;
        -moz-user-select: text;
        -webkit-user-select: text;
        -ms-user-select: text;
        user-select: text;
        position: absolute;
        top: 488px;
        right: -210px;
        width: 600px;
        z-index: 999
    }

    .mobileText .qrCode {
        position: absolute;
        height: 100px;
        top: 280px;
        right: 150px
    }

    .mobileText .cutFinger {
        position: absolute;
        left: 467px;
        top: 227px
    }


</style>

<div class="mobileCon" s="[object Object]">
    <div id="port" class="container mobile">
        <div class="mobileText">
            <h2 ><!--{$moblie_url}--></h2>
            <img class="appIcon" src="<!--{$con_system['ico']|getFileUri}-->">
            <div id="qrCode" class="qrCode">
                <canvas width="125" height="125" style="display: none;">

                </canvas>
                <img alt="Scan me!" src="<!--{$con_system['qrcodeAndriod']|getFileUri}-->" style="display: block;height:150px;">
            </div>
        </div>
        <div class="dontTouch"></div>
    </div>
</div>



<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->