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
    <link rel="stylesheet" href="<!--{$root_url}--><!--{$skinpath}-->2018/sy2/css/util.min.css" />
    <link rel="stylesheet" href="<!--{$root_url}--><!--{$skinpath}-->2018/sy2/css/default.min.css" />
    <link href="<!--{$root_url}--><!--{$skinpath}-->2017/Themes/Default/color.css" type="text/css" rel="stylesheet" />


        <link href="<!--{$root_url}--><!--{$skinpath}-->2016/Content/pc/css/share.css" rel="stylesheet"/>
  <style>

        .rows{height:55px;line-height:55px;}
        .input{line-height:40px;width:61%;

    background-color: #f7f7f7;
    height:40px;

    text-align: left;
    padding-left: 18px;
    box-shadow: -2px 3px 1px rgba(177, 177, 177, 0.5) inset;


    border: 1px solid #e4e1e1;
display:inline-block;

        }
            .button{
            width:19%;
            height:40px;line-height:40px;
            border: 1px solid #ffa44e;
            color: #b78c0a;
            background: #ffcd73;
            background: -moz-linear-gradient(top, #ffffff 0%, #ffcd73 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#ffcd73));
            background: -webkit-linear-gradient(top, #ffffff 0%,#ffcd73 100%);
            background: -o-linear-gradient(top, #ffffff 0%,#ffcd73 100%);
            background: -ms-linear-gradient(top, #ffffff 0%,#ffcd73 100%);
            background: linear-gradient(top, #ffffff 0%,#ffcd73 100%);
        }
.button2 {
    border: 1px solid #ffac5d;
    height:40px;line-height:40px;
    width: 20%;
    color: #565656;
    background-color: #ffb129;
    background: #ffb129;
    background: -moz-linear-gradient(top, #fee85f 0%, #ffb129 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fee85f), color-stop(100%,#ffb129));
    background: -webkit-linear-gradient(top, #fee85f 0%,#ffb129 100%);
    background: -o-linear-gradient(top, #fee85f 0%,#ffb129 100%);
    background: -ms-linear-gradient(top, #fee85f 0%,#ffb129 100%);
    background: linear-gradient(top, #fee85f 0%,#ffb129 100%);
    cursor: pointer;
}


.button2:hover,.button2:first-child {
    color: #ffffff;
    background-color: #ff2929;
    background: #ff2929;
    background: -moz-linear-gradient(top, #ff2929 0%, #fe5f5f 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff2929), color-stop(100%,#fe5f5f));
    background: -webkit-linear-gradient(top, #ff2929 0%,#fe5f5f 100%);
    background: -o-linear-gradient(top, #ff2929 0%,#fe5f5f 100%);
    background: -ms-linear-gradient(top, #ff2929 0%,#fe5f5f 100%);
    background: linear-gradient(top, #ff2929 0%,#fe5f5f 100%);

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
        color: #00c87c;
        font-weight: normal;
    }

 .inforight {line-height:30px}
      .inforight span, .inforight strong{display:block;}
      .button1{    background-image: url('<!--{'static/images/linebtnhover.png'|getFileUri}-->');background-size:cover;
    color: #fff;height:40px;width:100px;padding-left:20px;margin-left:-20px;border:0px;}
        </style>

</head>
<body class="sigin"  style="background-image: url('<!--{$config['login_bg']|getFileUri}-->')">
<div id="content-wrap">
        <div class="main" id="content" >
                    <!--login start-->
            <div class="row sign-panel" id="sp-login"  style='z-index:10000;'>

              <div style='height:100px;'>
              <div style='float:left;'>
                  <a href="<!--{$root_url}-->" title="<!--{$config.sitename}-->"><img src="<!--{$config.logo1|getFileUri}-->" height='65px'/></a>

                  </div>


           </div>
                <div class="row panel" >

                <table class='mainbox' style="padding-left: 30px;">
                <tr>
                <td  style='width:800px;'  valign='top'>

                <div style='line-height:40px;line-height40px;margin-bottom:30px;margin-top:10px;text-align: center'>
                <p>选择最快的链接进入网站</p>

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