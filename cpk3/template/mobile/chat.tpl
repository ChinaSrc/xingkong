
<!--{if $smarty.get.type=='ifream'}-->


<form action="<!--{$url}-->" method="post"  id="login_form" style="display: none">
    <!--{foreach from=$data  key=key item=item}-->

    <input type="text" name="info[<!--{$key}-->]" value="<!--{$item}-->">

    <!--{/foreach}-->

</form>
<script>
    document.getElementById('login_form').submit();

</script>


<!--{else}-->

<!--{if $con_system['chat_open']==1}-->
<!DOCTYPE html>
<html lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta charset="UTF-8" />
    <title><!--{if $navtitle}--><!--{$navtitle}--><!--{else}--><!--{$config.sitename}--><!--{/if}--></title>
    <link rel="shortcut icon" href="<!--{$con_system['ico']}-->" type="image/x-icon" />
    <meta name="description" content="<!--{$config.description}-->" />
    <meta name="keywords" content="<!--{$config.keywords}-->" />
   
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="email=no" />
    <meta name="renderer" content="webkit" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="screen-orientation" content="portrait" />
    <meta name="x5-orientation" content="portrait" />
    <meta name="full-screen" content="yes" />
    <meta name="x5-fullscreen" content="true" />
    <meta name="browsermode" content="application" />
    <meta name="x5-page-mode" content="app" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="mobile-web-app-capable" content="yes" />

    <link href='<!--{$file_uri}-->/<!--{$skinpath}-->style/main.css' rel="stylesheet" type="text/css" />
</head>
<body>
<style>
    iframe{
        display: block;
        border: 0px;
        position: fixed;
        top:0px;
        bottom: 0px;
        left:0px;
        width: 100%;
        height:100%;

    }

</style>
<iframe src="index_chat.html?type=ifream" ></iframe>

</body>

</html>
<!--{else}-->
<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<div class="wap_list">
    <div style="text-align: center;font-size: 36px;color: #e53333">聊天室已经关闭</div>
    <div style="text-align: center;font-size: 16px;padding-top: 20px;">

        <!--{$con_system['chat_close']}-->
    </div>
</div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
<!--{/if}-->

<!--{/if}-->