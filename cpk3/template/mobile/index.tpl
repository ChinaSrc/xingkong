 <html>
<head>

<meta http-equiv="content-type" content="text/html;charset=utf8">

<title>超凡-线路测试</title>
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
        .input{height:30px;line-height:30px;width:140px;}
.button,.button2 {
    background-color: #ff7200;
    padding: 0 15px;
    color: #fff;
    height: 30px;
    border: 0px;
    border-radius: 10px;
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
        padding: 5px;font-size:12px;
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
<body class="sigin1">
<div id="content-wrap">
        <div class="main" id="content" >
                    <!--login start-->
         <div class="row sign-panel" id="sp-login">
                <div class="row panel" style='margin-top:80px;'>

                <table class='mainbox'>
                <tr>
                <td  style='width:500px;'  valign='top'>

                <div style='line-height:20px;margin-bottom:20px;'>
                <p><strong>温馨提示：</strong>反应时间越小，网度越快的网址排在越上面。</p>
                <p><img alt="" src="static/images/lineicon1.png">您的IP地址：<!--{$ip}--></p>

                <p><img alt="" src="static/images/lineicon2.png">您的地理位置：<!--{$address}--></p>

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
"<input type=button   class='button2' value='立即访问' onclick=\"location.href=this.form.url"+i+".value+'/index_home.html';\" ></div>")
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

<input type='button' value='刷新检测' onclick="location.reload() ;" class='button2' style="width:100%;height:40px;line-height:40px;color:#fff;border:0px;margin-bottom:20px;" >
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
</body>
</html>