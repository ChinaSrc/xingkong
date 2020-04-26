 <html>
<head>

<meta http-equiv="content-type" content="text/html;charset=utf8">

<title><!--{$config.sitename}-->-线路测试</title>
  <link rel="shortcut icon" href="<!--{$config['ico']}-->" type="image/x-icon" />
<meta name="description" content="<!--{$config.metadescription}-->" />
<meta name="keywords" content="<!--{$config.metakeyword}-->" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"  />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Themes/Default/color.css" type="text/css" rel="stylesheet" />


        <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2016/Content/pc/css/share.css" rel="stylesheet"/>
  <style>

        .rows{height:50px;line-height:50px;}
        .input{height:30px;line-height:30px;width:270px;}
.button,.button2 {
    background-color: #00c87c;
    padding: 0 20px;
    color: #fff;
    height: 30px;
    border: 0px;
    border-radius: 5px;
}


.button2:hover {
    background-color: #ed4646;

}

.mainbox {

    position: relative;
    display: table;

    box-sizing: border-box;
}

    .mainbox > div {
        display: table-cell;
        width: 50%;
        padding-left: 40px;
        padding-right: 40px;
        vertical-align: top;
        padding-top: 110px;
        color: #d6d7d9;
    }

    .mainbox div p {
        padding: 5px;
    }

        .mainbox  p img {
            vertical-align: middle;
            margin-right: 5px;
            margin-top: -3px;
        }

    .mainbox  strong {
        color: #fa7045;
        font-weight: normal;
    }

 .inforight {line-height:30px}
      .inforight span, .inforight strong{display:block;}
      .button1{    background-image: url('static/images/linebtnhover.png');background-size:cover;
    color: #fff;height:40px;width:100px;padding-left:20px;margin-left:-20px;border:0px;}
        </style>

</head>
<body class="sigin">
<div id="content-wrap">
        <div class="main" id="content" >
                    <!--login start-->
            <div class="row sign-panel" id="sp-login"  style='z-index:10000;'>

              <div style='height:100px;'>
              <div style='float:left;'>
                  <a href="<!--{$root_url}-->" title="<!--{$config.sitename}-->"><img src="<!--{$file_uri}-->/<!--{$config.logo1}-->" height='65px'/></a>

                  </div>

                  <div style='float:right;'>

<div class="ctt_down">

<ul>
<li class="phone"><a onclick='downapp();'><p><img src="<!--{'static/images/icon1.png'|getFileUri}-->" style='vertical-align:middle;'>手机端下载</p></a></li>
<li class="pc"><a onclick='downapp();'><i class="icon icon2"></i><p><img src="<!--{'static/images/icon2.png'|getFileUri}-->" style='vertical-align:middle;'>PC端下载</p></a></li>


</ul>
</div>
                  </div>
           </div>
                <div class="row panel" style='filter:alpha(opacity=70);-moz-opacity:0.7;opacity:0.7;'>

                <table class='mainbox'>
                <tr>
                <td  style='width:500px;'  valign='top'>

                <div style='line-height:20px;margin-bottom:20px;'>
                <p><strong>温馨提示：</strong>反应时间越小，网站速度越快的网址排在越上面。</p>
                <p><img alt="" src='<!--{"static/images/lineicon1.png"|getFileUri}-->'>您的IP地址：<!--{$ip}--></p>

                <p><img alt="" src='<!--{"static/images/lineicon2.png"|getFileUri}-->'>您的地理位置：<!--{$address}--></p>

                </div>
<script language="javascript">
tim=1
setInterval("tim++",100)
b=1
var autourl=new Array()
<!--{$url}-->
function butt(){
document.write("<form name=autof>")

for(var i=1;i<autourl.length;i++)
document.write("<div class='rows'><input type=button  name=txt"+i+" class='button' style='width:80px' value='测速中'>"+
"<input type=text name=url"+i+" size=40  class='input'>"+
"<input type=button   class='button2' value='立即访问' onclick=window.open(this.form.url"+i+".value+'/index_home.html')></div>")
document.write("</form>")
}
butt()
function auto(url){
document.forms[0]["url"+b].value=url
if(tim>10)
{document.forms[0]["txt"+b].value="超时"}
else
{document.forms[0]["txt"+b].value=tim*10+"ms"}
b++
}
function run(){for(var i=1;i<autourl.length;i++)document.write("<img src="+autourl[i]+"/"+Math.random()+" width=0 height=0  style='display:none;' onerror=auto('"+autourl[i]+"')>")}
run()
</script>

<input type='button' value='刷新检测' onclick="location.reload() ;" class='button2' style="width:92%;height:40px;line-height:40px;color:#fff;border:0px;" >
                </td>

             <td  class='inforight'>

                    <p>如果我们的检测中心对您有帮助，请按 Ctrl+D收藏：</p>
                    <p>
                        <div>如果检测后不能登录请按以下方式操作：</div>
                        <strong>A.打开IE浏览器:</strong>
                        <span>打开IE浏览器，选择：工具-&gt; Internet选项-&gt; 再选择 (删除历史浏览记录)-&gt; 删除-&gt; 重启IE</span>
                        <strong>B.如果您体验过程中出现卡顿：</strong>
                        <span>请在您打开本界面选择其它线路看看。</span>
                    </p>
                    <p>如果您在访问我们域名时被跳转到其它网站，那是您当地电信运营商dns被劫持，您可以通过修改电脑本地dns来解决。</p>
                    <p style="padding-top:10px!important; background-image:none;border-bottom:0;">
                        为了保证最佳使用体验，请保证您的屏幕分辨率在 1280 及以上<br>
                        若使用IE浏览器，请使用 IE9 及以上版本<br>
                        推荐您使用以下浏览器：
                    </p>
                        <div >
        <p   style=''>

          <a href="http://rj.baidu.com/soft/detail/14744.html" title="快速、简单且安全的浏览器" target="_blank"><img src="<!--{'static/images/chrome.png'|getFileUri}-->" height='50px' style='    border-radius:50%;'></a>
            <a href="http://rj.baidu.com/soft/detail/11843.html" title="屡获大奖的开源浏览器" target="_blank"><img src="<!--{'static/images/firefox.jpg'|getFileUri}-->" height='50px' style='border-radius:50%;'></a>
        <a href="http://rj.baidu.com/soft/detail/17458.html" title="提供极致愉悦的网络体验方式" target="_blank"><img src="<!--{'static/images/360.jpg'|getFileUri}-->" height='50px' style='    border-radius:50%;'></a>
            <a href="http://rj.baidu.com/soft/detail/14754.html" title="全面升级的浏览器" target="_blank"><img src="<!--{'static/images/sougou.png'|getFileUri}-->" height='50px' style='    border-radius:50%;'></a>
</p>

    </div>


                </td>

               </tr>
                </table>


                    <div class="clear"></div>
                </div>
                <!--panel end-->

            </div>
            <!--login end-->

        </div>
    </div>


<!--{include file="<!--{$tplpath}-->down1.tpl"}-->
</body>
</html>