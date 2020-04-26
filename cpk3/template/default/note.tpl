
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/note.css" type="text/css" rel="stylesheet" />

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->




<div id="container" class="effect mainnav-lg mainnav-fixed navbar-fixed footer-fixed" style="width:calc(95% - 220px);padding-left:220px;
margin: 0 auto; ">
        <div id="page-content" style="padding-top: 0px;">
            <form method="post" role="form" id="notice" action="/notice/notice">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">通知公告</h3>
        </div>
        <div class="panel-body" style="padding-top:0;padding-bottom:3px;padding-left:7px;padding-right:8px;">
            <div class="tongzhi row">
                <div class="tongzhileft col-sm-3" style="width: 22%;">
                    <ul class="tongzhilist">
                    <!--{foreach from=$note_list key=key   item=item}-->

                            <li class="<!--{if $item['id'] eq $news['id']}-->tongzhilistthis<!--{/if}-->" onclick='location.href="index_note.html?id=<!--{$item['id']}-->";'>
                                <strong>
                                        <i class="fa fa-star orangestar"></i>
<!--{$item['title']}-->

                                                                            <label class="<!--{if $item['is_view'] eq '1' || $item['id'] eq $news['id']}-->yd<!--{else}-->wd<!--{/if}-->">已读</label>
                                </strong>

                                <span><i class="fa fa-clock-o"></i><!--{$item['date']}-->     </span>
                            </li>

                            <!--{/foreach}-->


                    </ul>
                </div>
                <div class="tongzhiright col-sm-9" style="height:600px;margin-bottom: 40px;padding-bottom: 20px;">
                    <div class="tongzhiview">
                            <div class="tongzhiviewtitle"><!--{$news['title']}--></div>
                            <div class="tongzhiviewinfo"><span>发布时间：<!--{date('Y-m-d H:i:s',$news['time'])}--></span></div>
                            <div class="tongzhiviewtxt">
                            <!--{$news['content']}-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>









<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
