<!--{include file="<!--{$tplpath}-->head.tpl"}-->


<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<style>
    .rb-top {
        position: fixed;
        height: 120px;
        width: 100%;
        background: #e23539
    }

    .rb-top span {
        color: #fff
    }

    .rb-top .date {
        padding-top: 8px;
        text-align: center
    }

    .rb-top .date span {
        width: 6%;
        display: inline-block
    }

    .rb-top .date input {
        font-size: 14px;
        height: 30px;
        border: none;
        border-radius: 5px;
        text-align: center;
        width: 30%;
        position: relative
    }

    .rb-top .detail {
        color: #fff;
        text-align: center
    }

    .rb-top .detail p {
        font-size: .65em;
        margin: 2em 0 .8em
    }

    .rb-top .detail span {
        font-size: 1.1em
    }

    .rb-list {
        margin-top: 7.5em
    }

    .rb-list .item {
        background: #fff;
        height: 3em;
        padding: 0 2em 0 1.2em;
        line-height: 3em;
        border-bottom: 1px solid #eaeaea;
        font-size: .75em
    }

    .rb-list .item span {
        float: right;
        color: #f13a46
    }

    .tip {
        padding: .5em 0;
        font-size: .65em;
        color: #777;
        text-align: center
    }


</style>


<div  class="main" s="[object Object]">
    <div  class="rb-top">

        <div  class="date">
            <form action="home_user_fandian.html" method="get">
                <input name="begintime"  type="date" placeholder="输入开始日期" value="<!--{$begin}-->"><span > - </span><input name="endtime"  placeholder="输入开始日期" type="date" value="<!--{$end}-->">
                <input type="submit" value="确认" class="button" style="width: 60px">

            </form>


        </div>
        <div  class="detail">
            <p >日期区间返佣收益 (元)</p><span ><!--{$sum}--></span></div></div>


</div>
<div style="margin-top: 130px">
<!--{if count($list)>0}-->
    <!--{foreach from=$list key=key item=item}-->

    <div class="wap_list">
        <div style="height:30px;">
来自：<!--{$item['user']['username']}-->
<span style="float: right;color: #ff0a09">￥<!--{$item['money']}--></span>
        </div>

        <div style="color: #999;">
            <!--{date('Y-m-d H:i:s',$item['time'])}-->

        </div>

    </div>


    <!--{/foreach}-->
    <div class="page"><!--{$page}--></div>
    <!--{else}-->

    <div class="page">暂时没有返点数据</div>

    <!--{/if}-->
</div>
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->