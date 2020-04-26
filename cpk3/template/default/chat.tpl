
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
    <title><!--{$config.sitename}-->-<!--{$config.sitetitle}--></title>
    <link rel="shortcut icon" href="<!--{$con_system['ico']}-->" type="image/x-icon" />
    <meta name="description" content="<!--{$config.description}-->" />
    <meta name="keywords" content="<!--{$config.keywords}-->" />




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

    <div style="width: 1140px;padding: 10px 20px;border-radius: 8px;border:1px solid #ddd;margin: 0px auto;min-height: 500px">
<div style="text-align: center;font-size: 36px;color: #e53333">聊天室已经关闭</div>
    <div style="text-align: center;font-size: 16px;padding-top: 20px;">

        <!--{$con_system['chat_close']}-->
    </div>
</div>

    <!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
<!--{/if}-->

<!--{/if}-->