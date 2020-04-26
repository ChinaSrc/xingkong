

<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<style>

    body{
        background-image: url("/static/images/appBg.jpg") ;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .btnapp{
        width: 90%;
        max-width: 300px;
        height:45px;
        line-height: 45px;
        color: #fff;
        text-align: center;
        font-size: 16px;
border: 1px solid #fff;
        border-radius: 8px;
        margin: 25px auto;
    }
.btnapp i{
    font-size: 20px;
}
</style>

<div style="text-align: center;color: #fff;padding-top: 60px">
<div style="font-size: 30px;font-weight: 600"><!--{$config.sitename}--></div>
    <div style="font-size: 16px;line-height: 30px;">下载APP再也无需输入网址</div>

<div style="padding-top: 20px;">
    <div class="btnapp" onclick="location.href='<!--{$config['downios']}-->';">

        <i class="icon-apple"></i>

        点击下载IOS版
    </div>



    <div class="btnapp" onclick="location.href='<!--{$config['downAndroid']}-->';">

<i class="icon-android"></i>

        点击下载安卓版
    </div>

</div>

</div>



















    <!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




    </body>
    </html>


