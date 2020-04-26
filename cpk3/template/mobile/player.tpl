<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<style>
    body{background-color: #fff;}
    .playerHomeHead {
        background: url(/static/images/playerHomeBg.jpg) no-repeat;
        background-size: 100%;
        text-align: center;
        height: 150px;
        position: relative
    }

    .playerHomeHead img {
        width: 100px;
        height: 100px
    }

    .playerHeadImg {
        border-radius:50%;
        width: 100px;
        height: 100px;
        border: 3px solid #fff;
        margin-top: 100px;
        position: absolute;
        bottom: -50px;
        margin-left: -50px;
        overflow: hidden;
        display: inline
    }

    .playerInfo {
        text-align: center;
        line-height: 30px;
        position: relative;
        margin-top: 50px;
    }

    .playerInfo h1 {
        font-size:18px;
        color: #333;height:30px;
    }

    .playerInfo h2 {
        font-size: 16px;
        color: #666;height:26px;
    }

    .playerInfo span {
        font-size:16px;
        background: #59adf2;
        color: #fff;
        padding: 0 6px;
        border-radius:4px;
    }

    .playerInfo p {
        font-size:14px;
        color: #333;
        margin: 6px 0;
        padding-bottom: 24px
    }

    .playerInfo p em {
        margin-right: 30px
    }

    .playerInfo ins {
        position: absolute;
        background: #da3a3f;
        color: #fff;
        right: 0;
        display: block;
        top: -2em;
        padding: .1em .8em;
        border: 1px solid #e2e2e2;
        border-right: 0;
        border-radius: 1em 0 0 1em;
        font-size: .8em
    }

    .playerInfo:before {
        content: "";
        position: absolute;
        left: 0;
        background: #d0d0d0;
        width: 100%;
        height: 1px;
        -webkit-transform: scaleY(.5);
        transform: scaleY(.5);
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        bottom: 0
    }

    .cardIcon p {
        text-align: center;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }
     .cardIconList { padding: 0 20px;     text-align: center;}
    .cardIconList a{display: inline-block;width:55px;text-align: center;margin: 10px 10px;}
    .cardIconList a img{height:55px !important;width: 55px !important;border-radius: 50%;vertical-align: middle}
    .cardIconList .hui{
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
        -o-filter: grayscale(100%);
        filter: grayscale(100%);
        filter: gray;
    }

</style>







<div  class="main" >
    <div  class="playerHomeHead">
        <div  class="playerHeadImg">
            <img  src="<!--{avatar($user['userid'])|getFileUri}-->" alt="" />
        </div>
    </div>
    <div  class="playerInfo">
        <h1 ><!--{if $user['nickname']}--><!--{$user['nickname']}--><!--{else}-->昵称未设置<!--{/if}--></h1>
        <h2 >账号:<!--{$username}--></h2>
        <span >性别:<!--{if $user['sex']}--><!--{$user['sex']}--><!--{else}-->保密<!--{/if}--></span>
        <p >头衔：<em ><!--{$group['touxian']}--></em>累计中奖：<i ><!--{number_format($user['prize'],2,'.','')}--></i></p>
        <ins >
            <!--{$group['title']}-->
        </ins>
    </div>
    <div  class="cardIcon">
        <p >Ta喜欢的彩票</p>

          <!--{$game_str}-->

    </div>
</div>







<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->