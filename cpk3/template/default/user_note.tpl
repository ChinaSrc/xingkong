

<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$root_url}--><!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />

<style>

    .noticeList {
        margin: 0 auto;
        height: auto;
        overflow: hidden;
        padding: 5px 15px;

        background: #fff
    }

    .noticeList li {
        height: 35px;
        line-height: 35px;
        border-bottom: 1px dashed #ddd
    }

    .noticeList li span {
        width: auto;
        float: right;
        height: 35px;
        max-width: 20%;
        text-align: right;
        color: #666;
        line-height: 35px;
        overflow: hidden
    }


    .articleTitle{font-size:16px;color:#333;text-align:center}
    .articlePublishTime{font-size:12px;text-align:center;border-bottom:1px solid #ddd;padding-bottom:5px}
    .articleContent,.articleContent p,.articleContent span{font-size:14px!important;color:#333}
</style>
<!--头部链接开始-->
<!--主导航-->
<div id="bd">
    <div id="main" class="clearfix">
        <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->
        <div class="home_rec clearfix">
<!--{if $type eq 'info'}-->
            <div style="padding: 20px 10px;line-height: 30px;">
                <h2 class="articleTitle"><!--{$news['title']}--></h2>
                <div class="articlePublishTime"><!--{date('Y-m-d H;i:s',$news['time'])}--></div>
                <div class="articleContent">

                    <!--{$news['content']}-->

                </div>

            </div>




            <!--{else}-->
            <div class="noticeList">
                <ul >
                    <!--{foreach from=$list key=key item=item}-->
             <li >
                        <a href="home_user_note.html?itemid=<!--{$item['id']}-->"><!--{$item['title']}--></a>
                        <span class="CreatTime"><!--{date('Y-m-d H;i:s',$item['time'])}--></span>
                    </li>
                    <!--{/foreach}-->

                </ul>
            </div>


            <DIV class="page">
                <!--{$page}-->
            </DIV>
<!--{/if}-->

        </div>
        <!--详细内容iframe-end-->


    </div>
</div>


<!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->












