
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>域名测试系统</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/speed/base.css" />
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/speed/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/speed/test-speed.js"></script>
</head>
<style>

</style>
<body>
<div id="J-loading-area" class="test-area">
    <div class="container">
        <div class="loading"></div>
        <h4 class="titles">欢迎使用 "<span class="platform-name"><!--{$config.sitename}--></span>" 线路测速系统</h4>
        <a id="J-do-test" href="javascript:void(0);" class="do-test">点击测试</a>
        <ul id="J-host-list" class="host-list">
            <li>
                <p class="routh-name">线路名称：<a href="#"></a></p>
                <p class="process">
                    <span class="process-count"></span>
                </p>
            </li>
            <li>
                <p class="routh-name">线路名称：<a href="#"></a></p>
                <p class="process">
                    <span class="process-count"></span>
                </p>
            </li>
        </ul>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        var targetName = 'spinner',
            $loadParentArea = $('#J-loading-area'),
            $loadArea = $('#J-do-test'),
            $listDom = $('#J-host-list'),
            speed = window.speed;

        //域名数据
        var hostData = [
            <!--{for $i=0 to $con_system['url_num']-1}-->
            <!--{$urlname="url_$i"}-->

            <!--{$url=str_replace('http://','',$con_system[$urlname])}-->
            {
                'name' : '<!--{$url}-->',
                'host' : '<!--{$url}-->'
            },

            <!--{/for}-->

        ];

        $loadArea.click(function(){
            $loadParentArea.addClass(targetName);

            //开始测速
            speed.test(hostData, function(){
                $loadParentArea.removeClass(targetName);
            });
        });

        //渲染个节点
        speed.render(hostData);
    });



</script>
</html>
