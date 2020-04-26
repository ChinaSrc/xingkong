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
    <script type="text/javascript" src="<!--{$file_uri}-->/static/js/func.js"></script>

<script type="text/javascript" src="<!--{$file_uri}-->/static/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<!--{$file_uri}-->/static/js/common.js"></script>


<link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xcConfirm.css?v=2018"/>

		<script src="<!--{$file_uri}-->/static/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/mobile.css?v=123" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="<!--{$file_uri}-->/static/js/mobile.js"></script>

    <link rel="stylesheet" type="text/css" href="<!--{$root_url}--><!--{$skinpath}-->style/fontello.css"/>
</head>

<body id="bg-base">
<style>
#BgDiv{background-color:#000000; position:fixed; z-index:7777; left:0; top:0; bottom:0px;display:none; width:100%; height:100%;opacity:0.4;filter: alpha(opacity=40);-moz-opacity: 0.4;}
</style>



<div id="BgDiv" ></div>


<!--{if $smarty.get.mod=='game'}-->


<!--{else}-->
<div class="sub_head_top wap_title" >



<div class="title"><!--{if $navtitle}--><!--{$navtitle}--><!--{else}--><!--{$config.sitename}--><!--{/if}-->


</div>


    <div class="signIn" style="display:none;width:30px;text-align: right; position: absolute;right: 10px;top:5px;">

        <a   href="<!--{$ServiceUrl}-->">
            <i class="icon-menu-4" style="color: #fff;font-size: 22px;"></i>

        </a>

    </div>




    <!--{if $nav_index neq '1'}-->
    <div class="back" id="pageback" onclick="window.history.go(-1);" >

        <img src="<!--{$file_uri}-->/static/images/return(new).png" border="0">
</div>

    <!--{else}-->
    <div class="signIn" onclick="location.href='index_mobile.html';" style="width:60px;text-align: right; position: absolute;right: 6px;top:5px;color: #fff;" >

        APP<i class="icon-download-cloud"></i>
    </div>

    <!--{/if}-->
</div>
<!--{/if}-->