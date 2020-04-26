
<!DOCTYPE html>
<HTML xmlns="http://www.w3.org/1999/xhtml" xmlns:esun>
<HEAD>    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta charset="UTF-8" />
    <title><!--{$game['fullname']}-->历史号码走势 </title>
    <link rel="shortcut icon" href="<!--{$con_system['ico']}-->" type="image/x-icon" />
    <meta name="description" content="<!--{$config.description}-->" />
    <meta name="keywords" content="<!--{$config.keywords}-->" />

    <META http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"  />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META http-equiv="Pragma" content="no-cache" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/defaultright.css" rel="stylesheet" type="text/css" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/line.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/todo/images/common/base.css" />
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/bonuscode_switchbar.min.css">
    <style>
        esun\:*{behavior:url(#default#VML)}
    </style>
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/line.min.js"></script>
    <style>
        .date_links a {color:red;font-weight:bold;}
        .wdh div.span{width:18px;height:18px;}

    </style>
    <style id="J-esun">
        esun\:*{behavior:url(#default#VML)}
    </style>
</HEAD>
<body id="lan">
<div id="right_01">
    <div class="right_01_01"><SPAN class="action-span1">
<a href="game_<!--{$game['id']}-->.html?nav=<!--{$game['skey']}-->" target='_top'><!--{$game['fullname']}-->历史号码走势 </a></SPAN></div>

</div>
<script>
    $(function () {

        if ($(window).width() > 1000) {
            $("#titlemessage").css('width', '100%');
            $("#right_01").css('width', '100%');
        }

        $("#navbutton,#symbol").show();
        drawLine();

    });

    function drawLine() {
        $("canvas").remove();
        $('.IELine').remove();
        DrawLine.bind("chartsTable","has_line");

        DrawLine.color('#499495');
        DrawLine.add((parseInt(0)*10+5+1),2,10,0);
        DrawLine.color('#E4A8A8');
        DrawLine.add((parseInt(1)*10+5+1),2,10,0);
        DrawLine.color('#499495');
        DrawLine.add((parseInt(2)*10+5+1),2,10,0);
        DrawLine.color('#E4A8A8');
        DrawLine.add((parseInt(3)*10+5+1),2,10,0);
        DrawLine.color('#499495');
        DrawLine.add((parseInt(4)*10+5+1),2,10,0);

        DrawLine.draw(Chart.ini.default_has_line);
        resize();
    }

    function resize() {
        // 20170508 patch to detect mobile device and not to bind the resize event
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        //if(window.console){console.log(isMobile)};
        if (!isMobile) {
            window.onresize = func;
            //document.onmousewheel = func;
            function func() {
                setTimeout(function () {window.location.href = window.location.href}, 100);
            }
        }
    }

    //remove mousewheel event...totally, fix ie8 ..just find it and patch it...
    //remove remark after discuss the issue
    // document.onmousewheel = function(e){stopWheel(e);} /* IE7, IE8 */
    // if(document.addEventListener){ /* Chrome, Safari, Firefox */
    // 	document.addEventListener('DOMMouseScroll', stopWheel, false);
    // }

    // function stopWheel(e){
    // 	var event = e || window.event;
    // 	if (event.ctrlKey) {
    // 		if(!e){e = window.event;} /* IE7, IE8, Chrome, Safari */
    // 		if(e.preventDefault) {e.preventDefault();} /* Chrome, Safari, Firefox */
    // 		e.returnValue = false; /* IE7, IE8 */
    // 	}
    // }


    function trends(checked) {
        if (!checked) {
            $("canvas").remove();
            $('.IELine').remove();
        } else {
            drawLine();
        }
    }

    function therm(checked) {
        if (!checked) {
            $("#chartsTable .ball0").removeClass("therm00");
            $("#chartsTable .ball1").removeClass("therm01");
            $("#chartsTable .ball2").removeClass('therm02');
            $(".ball0,.ball1,.ball2").addClass('ball01');
        }
        else {
            $(".ball0,.ball1,.ball2").removeClass('ball01');
            $("#chartsTable .ball0").addClass("therm00");
            $("#chartsTable .ball1").addClass("therm01");
            $("#chartsTable .ball2").addClass('therm02');
        }
    }

    function toggleMiss() {
        $('#missedTable').toggle();
    }
    //隐藏
    var t_handle = 0;
    function toggleNav(e) {
        $('.IELine').remove();
        if (t_handle == 0) {
            $("canvas").remove();
            $("#navbutton").html('展开功能区');
            $('#nav').fadeOut('fast', function () {
                drawLine();
            });
            t_handle = 1;
            $("#symbol").removeClass('open');
            $("#symbol").addClass('close');
        }
        else {

            $("canvas").remove();

            $('#nav').fadeIn('fast', function () {
                drawLine();
            });
            $("#navbutton").html('隐藏功能区');
            $("#symbol").removeClass('close');
            $("#symbol").addClass('open');
            t_handle = 0;

        }

    }
    function colored(checked) {
        if (!checked) {
            $("#chartsTable .lostcolor").css("background-color", '#FFF');
        }else {
            $("#chartsTable .lostcolor").css("background-color", '#e9e9e9');
        }
    }

    function lostnum(checked) {
        if (!checked) {
            $("#chartsTable .lostnum").hide();
        }
        else {
            $("#chartsTable .lostnum").show();
        }
    }

    function assist(checked) {
        if (!checked) {
            $(".bottomtd").css("border-bottom", '');
        } else {
            $(".bottomtd").css("border-bottom", "1px solid #fa742B");
        }
    }

    $(function(){
        assist(true)
    })
</script>
<style>
    esun\:*{behavior:url(#default#VML)}
</style>
<div class="switch-bar" style="display:none;">
    <ul class="switch-bar-list switch-bar-type-list" >

        <!--{foreach from=$arr_game_code key=key item=item}-->

        <!--{if count($game_nav[$key])>0}-->

        <li >

            <a href="<!--{$root_url}-->index_chart.html?playkey=<!--{$game_nav[$key][0]['ckey']}-->&top=30" <!--{if $game['skey']==$key}-->class="active" <!--{/if}-->> <!--{$item}--></a>
        </li>


        <!--{/if}-->


        <!--{/foreach}-->


    </ul>
    <ul class="switch-bar-list switch-bar-lottery-list">

        <!--{foreach from=$game_nav[$game['skey']] key=key1 item=item1}-->
        <li >

            <a href="<!--{$root_url}-->index_chart.html?playkey=<!--{$item1['ckey']}-->&top=<!--{$top}-->&method=<!--{$method}-->" <!--{if $game['ckey']==$item1['ckey']}-->class="active" <!--{/if}-->   >
            <!--{$item1['fullname']}-->
            </a>
        </li>

        <!--{/foreach}-->

    </ul>
</div>
<table width="100%" id="titlemessage" border="0" cellpadding="0" cellspacing="0">
    <tr >
        <td colspan="6" style="text-align:left">

            <!--{foreach from=$method_list key=key1 item=item1}-->

            <b>
                <!--{if $method==$key1}-->

                <span >
                   <!--{$item1}-->走势图
                </span>
                <!--{else}-->
                <span class="redtext">
                    <a href="<!--{$root_url}-->index_chart.html?playkey=<!--{$game['ckey']}-->&top=<!--{$top}-->&method=<!--{$key1}-->"><!--{$item1}-->走势图</a>
                </span>

                <!--{/if}-->
            </b>

            <!--{/foreach}-->


            <b><span onclick="toggleNav(event);" style="display:none;" id='navbutton'>隐藏功能区</span></b>

        </td>
    </tr>
    <tr>
        <td  colspan="6"  style="text-align:left;vertical-align:middel;width:100%;height:30%">
            <div id='nav' >
                <div style="width:auto;float:left">
<span title="选中时（用鼠标单击控件打上勾即为选中），在表格中每5个奖期的号码栏中将会出现辅助线" style="cursor:pointer">
<input type='checkbox' onclick='assist(this.checked)' checked="checked"/>辅助线</span>
                    <span title="选中时（用鼠标单击控件打上勾即为选中），在表格中每期开奖号码的表格中显示出该号码的遗漏值。" style="cursor:pointer">
<input type='checkbox' checked="checked" onclick='lostnum(this.checked)'/>遗漏</span>
                    <span title="选中时（用鼠标单击控件打上勾即为选中），在表格中将会把遗漏期使用有色的柱图来表示。" style="cursor:pointer">
<input type='checkbox' checked="checked" onclick='colored(this.checked)'/>遗漏条</span>
                    <span title="选中时（用鼠标单击控件打上勾即为选中），将会在表格中绘制开奖号码的走势。" style="cursor:pointer">
<input type='checkbox' checked="checked" onclick='trends(this.checked)'/>走势</span>
                    <span title="选中时（用鼠标单击控件打上勾即为选中），色温分为“冷热温”三种色调" style="cursor:pointer">
<input type='checkbox' onclick='therm(this.checked)' checked="checked" />号温</span>

                    <!--{foreach from=$top_arr key=key1 item=item1}-->

                    <!--{if $top==$item1}-->
                    <span>
最近<!--{$item1}-->期&nbsp;</span>

                    <!--{else}-->
                    <span >
                  <a href="<!--{$root_url}-->index_chart.html?playkey=<!--{$game['ckey']}-->&top=<!--{$item1}-->&method=<!--{$method}-->">  最近<!--{$item1}-->期</a>
                </span>

                    <!--{/if}-->

                    <!--{/foreach}-->


                </div>

            </div>
        </td>
    </tr>

</table>
<div style="position:relative; height: 950px;" id="container">

    <script>
        function transfer(checked){
            if(!checked)
            {
                $("#chartsTable #missone").hide();
                $("#chartsTable #showone").css('color','#000');
            }
            else
            {

                $("#chartsTable #missone").show();
                $("#chartsTable #showone").css('color','#F00');
            }
        }
    </script>

    <table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" style="position:absolute; top:0; left:0; border-collapse: collapse;" class="chart-table">
        <tr id="title">
            <td rowspan="2">期号</td>
            <td rowspan="2" style="border-right:#d6d6d6 solid 1px;width:5%" colspan="5">开奖号码
                <!--{if $method!='5X'}-->
                <br>
                <input type="checkbox" onclick='transfer(this.checked)' checked/>全部
                <!--{/if}-->
            </td>
            <!--{foreach from=$wei key=key item=item}-->
            <td colspan="10" style="border-right:#d6d6d6 solid 1px;"><!--{$item}--></td>

            <!--{/foreach}-->
            <!--{if  $method=='2X1' || $method=='2X2'}-->

            <td style="border-right:#d6d6d6 solid 1px;" rowspan="2">对子</td>

            <!--{/if}-->
            <td colspan="10">号码分布</td>

            <!--{if $method=='3X' || $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
            <td rowspan="2" nowrap>大小形态</td>
            <td rowspan="2" nowrap>奇偶形态</td>
            <td rowspan="2" nowrap>质合形态</td>
            <td rowspan="2" nowrap>012形态</td>
            <td rowspan="2" nowrap>豹子</td>
            <td rowspan="2" nowrap>组三</td>
            <td rowspan="2" nowrap>组六</td>
            <td rowspan="2" nowrap>跨度</td>
            <td rowspan="2" nowrap>直选和值</td>
            <td rowspan="2" nowrap>和值尾数</td>
            <!--{/if}-->


            <!--{if  $method=='2X1' || $method=='2X2'}-->

            <td style="border-right:#d6d6d6 solid 1px;" colspan="10">跨度走势</td>
            <td rowspan="2">和值</td>

            <!--{/if}-->
        </tr>
        <tr id="head">

            <!--{foreach from=$wei key=key item=item}-->
            <!--{for $i=0 to 9}-->
            <!--{if $i<9}-->
            <td  class="wdh"><!--{$i}--></td>

            <!--{else}-->
            <td  style="border-right:#d6d6d6 solid 1px;"><!--{$i}--></td>

            <!--{/if}-->
            <!--{/for}-->
            <!--{/foreach}-->

            <td class="wdh">0</td>
            <td class="wdh">1</td>
            <td class="wdh">2</td>
            <td class="wdh">3</td>
            <td class="wdh">4</td>
            <td class="wdh">5</td>
            <td class="wdh">6</td>
            <td class="wdh">7</td>
            <td class="wdh">8</td>
            <td class="wdh">9</td>

            <!--{if  $method=='2X1' || $method=='2X2'}-->

            <td  class="wdh">0</td>
            <td  class="wdh">1</td>
            <td  class="wdh">2</td>
            <td  class="wdh">3</td>
            <td  class="wdh">4</td>
            <td  class="wdh">5</td>
            <td  class="wdh">6</td>
            <td  class="wdh">7</td>
            <td  class="wdh">8</td>
            <td  style="border-right:#d6d6d6 solid 1px;" class="wdh">9</td>


            <!--{/if}-->

        </tr>

        <!--{$baozi=0}-->
        <!--{foreach from=$list key=key item=item}-->
        <tr>
            <td id="title" class="<!--{$item['line']}-->"   ><!--{$item['period']}--></td>


            <td class="wdh <!--{$item['line']}-->" align="center"  >
                <div <!--{if $method=='3X1' || $method=='2X1'}-->id='showone' style="color:red"<!--{else}-->id='missone'<!--{/if}-->><!--{$item['number'][0]}--></div>                </td>
<td class="wdh <!--{$item['line']}-->" align="center"  >
    <div <!--{if $method=='4X'|| $method=='3X1'|| $method=='3X3' || $method=='2X1'}-->id='showone' style="color:red"<!--{else}-->id='missone'<!--{/if}-->><!--{$item['number'][1]}--></div>
</td>
<td class="wdh <!--{$item['line']}-->" align="center"   >
    <div <!--{if $method=='4X'|| $method=='3X1'|| $method=='3X2' || $method=='3X3'}-->id='showone' style="color:red"<!--{else}-->id='missone'<!--{/if}-->><!--{$item['number'][2]}--></div>
</td>
<td class="wdh <!--{$item['line']}-->" align="center"    >
    <div <!--{if $method=='4X'|| $method=='3X3'|| $method=='3X2' || $method=='2X2'}-->id='showone' style="color:red"<!--{else}-->id='missone'<!--{/if}-->><!--{$item['number'][3]}--></div>
</td>
<td class="wdh <!--{$item['line']}-->" align="center" style=" border-right:#d6d6d6 solid 1px; " >
    <div <!--{if $method=='4X'|| $method=='3X2' || $method=='2X2'}-->id='showone' style="color:red"<!--{else}-->id='missone'<!--{/if}-->'><!--{$item['number'][4]}--></div>                </td>

<!--{foreach from=$wei key=key1 item=item1}-->
<!--{for $i=0 to 9}-->
<!--{if $i==$item['number'][$key1]}-->
<!--{$lx[$key1][$i]=0}-->
<!--{$cx[$key1][$i]=$cx[$key1][$i]+1}-->



<td class="charball <!--{$item['line']}-->"  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> ">
    <div class="ball<!--{$i%3}--> therm0<!--{$i%3}-->"><!--{$i}--></div>
</td>
<!--{else}-->
<!--{$lx[$key1][$i]=$lx[$key1][$i]+1}-->
<!--{if $lx[$key1][$i]>$yl[$key1][$i]}-->
<!--{$yl[$key1][$i]=$lx[$key1][$i]}-->
<!--{/if}-->
<td align="center" class=" wdh <!--{$item['lost'][$key1][$i]}--> <!--{$item['line']}-->" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> " ><div class='lostdiv'><div class='lostnum'><!--{$lx[$key1][$i]}--></div></div></td>
<!--{/if}-->
<!--{/for}-->
<!--{/foreach}-->


<!--{if  $method=='2X1' || $method=='2X2'}-->
<td class="wdh <!--{$item['line']}-->" align="center" style="border-right:#d6d6d6 solid 1px;">
    <div class='lostdiv lostnum'>
        <!--{if $item['number1'][0]==$item['number1'][1]}-->
        <!--{$cx['pair']=$cx['pair']+1}-->
        <!--{$lx['pair']=0}-->
        <div class="pair">对</div>
        <!--{else}-->
        <!--{$lx['pair']=$lx['pair']+1}-->

        <!--{if $lx['pair']>$yl['pair']}-->
        <!--{$yl['pair']=$lx['pair']}-->
        <!--{/if}-->

        <!--{$lx['pair']}-->
        <!--{/if}-->

    </div>
</td>

<!--{/if}-->




<!--{$ball_times=array()}-->



<!--{for $i=0 to 9}-->




<!--{if in_array($i,$item['number1'])}-->
<!--{$ball_times=0}-->
<!--{foreach from=$item['number1'] key=key3 item=item3}-->
<!--{if $i==$item3}-->
<!--{$ball_times=$ball_times+1}-->
<!--{/if}-->
<!--{/foreach}-->

<!--{if $ball_times>1}-->
<!--{$ball=5}-->
<!--{else}-->
<!--{$ball=6}-->
<!--{/if}-->

<!--{$lx['result'][$i]=0}-->
<!--{$cx['result'][$i]=$cx['result'][$i]+$ball_times}-->
<td class="wdh <!--{$item['line']}-->" align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}-->">
    <div class="ball0<!--{$ball}-->"><!--{$i}--></div>
</td>

<!--{else}-->
<!--{$lx['result'][$i]=$lx['result'][$i]+1}-->
<!--{if $lx['result'][$i]>$yl['result'][$i]}-->
<!--{$yl['result'][$i]=$lx['result'][$i]}-->
<!--{/if}-->
<td class="wdh <!--{$item['line']}-->" align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}-->" >
    <div class='lostdiv'><div class='lostnum'><!--{$lx['result'][$i]}--></div></div>
</td>

<!--{/if}-->
<!--{/for}-->





<!--{if  $method=='2X1' || $method=='2X2'}-->

<!--{for $i=0 to 9}-->
<!--{if $i==$item['kd']}-->
<!--{$lx['kd'][$i]=0}-->
<!--{$cx['kd'][$i]=$cx['kd'][$i]+1}-->
<td class="wdh <!--{$item['line']}-->" align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}-->">
    <div class="span"><!--{$i}--></div>
</td>

<!--{else}-->

<!--{$lx['kd'][$i]=$lx['kd'][$i]+1}-->
<!--{if $lx['kd'][$i]>$yl['kd'][$i]}-->
<!--{$yl['kd'][$i]=$lx['kd'][$i]}-->
<!--{/if}-->
<td class="wdh <!--{$item['line']}--> <!--{$item['kuadu'][$i]}-->" align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}-->" >
    <div class='lostdiv'><div class='lostnum'><!--{$lx['kd'][$i]}--></div></div>
</td>

<!--{/if}-->
<!--{/for}-->
<td class="wdh <!--{$item['line']}-->" align="center">
    <div><!--{$item['hz']}--></div>
</td>


<!--{/if}-->



<!--{if $method=='3X' || $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
<td align="center" style="background-color:#0dcaae;" class="<!--{$item['line']}-->">
    <div><!--{foreach from=$item['number1'] key=key3 item=item3}--><!--{if $item3>=5}-->大<!--{else}-->小<!--{/if}--><!--{/foreach}--></div>
</td>
<td align="center" style="background-color:#c2e783;" class="<!--{$item['line']}-->">
    <div><!--{foreach from=$item['number1'] key=key3 item=item3}--><!--{if $item3%2==1}-->单<!--{else}-->双<!--{/if}--><!--{/foreach}--></div>
</td>
<td align="center" style="background-color:#0dcaae;" class="<!--{$item['line']}-->">
    <div><!--{foreach from=$item['number1'] key=key3 item=item3}--><!--{if $item3==1 || $item3==2 || $item3==3 || $item3==5 || $item3==7}-->和<!--{else}-->质<!--{/if}--><!--{/foreach}--></div>
</td>
<td align="center" style="background-color:#c2e783;" class="<!--{$item['line']}-->">
    <div><!--{foreach from=$item['number1'] key=key3 item=item3}--><!--{$item3%3}--><!--{/foreach}--></div>
</td>
<td align="center" style="background-color:#c2e783;" class="<!--{$item['line']}-->">
    <div><span class="lostnum" style="color:#777">
                        <!--{if $item['number1'][0]==$item['number1'][1] && $item['number1'][1]==$item['number1'][2]}-->
                        是
            <!--{$cx['baozi']=$cx['baozi']+1}-->
            <!--{$lx['baozi']=0}-->
            <!--{else}-->
            <!--{$lx['baozi']=$lx['baozi']+1}-->
            <!--{$yl['baozi']=$yl['baozi']+1}-->
            <!--{if $lx['baozi']>$yl['baozi']}-->
            <!--{$yl['baozi']=$lx['baozi']}-->
            <!--{/if}-->

            <!--{$lx['baozi']}-->
            <!--{/if}-->


                    </span></div>
</td>
<td align="center" class="<!--{$item['line']}-->" >
    <div>
        <!--{if $item['number1'][0]==$item['number1'][1] ||  $item['number1'][1]==$item['number1'][2]  || $item['number1'][0]==$item['number1'][2]}-->
        <!--{$cx['z3']=$cx['z3']+1}-->
        &#10003;
        <!--{$lx['z3']=0}-->
        <!--{else}-->

        <!--{$lx['z3']=$lx['z3']+1}-->

        <!--{if $lx['z3']>$yl['z3']}-->
        <!--{$yl['z3']=$lx['z3']}-->
        <!--{/if}-->
        <!--{/if}-->

    </div>
</td>
<td align="center" style="background-color:#0dcaae;" class="<!--{$item['line']}-->" >
    <div>         <!--{if $item['number1'][0]==$item['number1'][1] ||  $item['number1'][1]==$item['number1'][2]  || $item['number1'][0]==$item['number1'][2]}-->

        <!--{$lx['z6']=$lx['z6']+1}-->

        <!--{if $lx['z6']>$yl['z6']}-->
        <!--{$yl['z6']=$lx['z6']}-->
        <!--{/if}-->
        <!--{else}-->
        <!--{$cx['z6']=$cx['z6']+1}-->
        &#10003;
        <!--{$lx['z6']=0}-->
        <!--{/if}--></div>
</td>
<td align="center" style="background-color:#0dcaae;>" class="<!--{$item['line']}-->" >
    <div><!--{$item['kd']}--></div>
</td>
<td align="center" class="<!--{$item['line']}-->" >
    <div><!--{$item['hz']}--></div>
</td>
<td align="center" class="<!--{$item['line']}-->" >
    <div><!--{$item['hz']%10}--></div>
</td>
<!--{/if}-->









</tr>

<!--{/foreach}-->






<tfoot>
<tr>
    <td nowrap>出现总次数</td>
    <td align="center" style='border-right:#d6d6d6 solid 1px;' colspan="5">&nbsp;</td>
    <!--{foreach from=$wei key=key1 item=item1}-->
    <!--{for $i=0 to 9}-->

    <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$cx[$key1][$i]}--></td>
    <!--{/for}-->
    <!--{/foreach}-->


    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td align="center">
        <!--{$cx['pair']}-->
    </td>

    <!--{/if}-->

    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$cx['result'][$i]}-->                </td>
    <!--{/for}-->

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$cx['kd'][$i]}-->                </td>
    <!--{/for}-->
    <td align="center">
    </td>
    <!--{/if}-->

    <!--{if $method=='3X' ||  $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
        <!--{$cx['baozi']}-->                </td>
    <td align="center">
        <!--{$cx['z3']}-->                   </td>
    <td align="center">
        <!--{$cx['z6']}-->            </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <!--{/if}-->

</tr>
<tr>
    <td nowrap>平均遗漏值</td>
    <td align="center" style='border-right:#d6d6d6 solid 1px;' colspan="5">&nbsp;</td>
    <!--{foreach from=$wei key=key1 item=item1}-->
    <!--{for $i=0 to 9}-->

    <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> ">
        <!--{if $cx[$key1][$i]>0}-->

        <!--{intval(count($list)/$cx[$key1][$i])}-->

        <!--{else}-->

        <!--{count($list)+1}-->
        <!--{/if}-->

    </td>
    <!--{/for}-->
    <!--{/foreach}-->
    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td align="center">
        <!--{if $cx['pair']>0}-->
        <!--{intval(count($list)/$cx['pair'])}-->
        <!--{else}-->
        <!--{count($list)+1}-->
        <!--{/if}-->
    </td>

    <!--{/if}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{if $cx['result'][$i]>0}-->

        <!--{intval(count($list)/$cx['result'][$i])}-->

        <!--{else}-->

        <!--{count($list)+1}-->
        <!--{/if}-->           </td>
    <!--{/for}-->
    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{if $cx['kd'][$i]>0}-->

        <!--{intval(count($list)/$cx['kd'][$i])}-->

        <!--{else}-->

        <!--{count($list)+1}-->
        <!--{/if}-->                   </td>
    <!--{/for}-->
    <td align="center">
    </td>
    <!--{/if}-->

    <!--{if $method=='3X' ||  $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
        <!--{if $cx['baozi']>0}-->
        <!--{intval(count($list)/$cx['baozi'])}-->
        <!--{else}-->
        <!--{count($list)+1}-->
        <!--{/if}-->           </td>
    <td align="center">
        <!--{if $cx['z3']>0}-->
        <!--{intval(count($list)/$cx['z3'])}-->
        <!--{else}-->
        <!--{count($list)+1}-->
        <!--{/if}-->             </td>
    <td align="center">
        <!--{if $cx['z6']>0}-->
        <!--{intval(count($list)/$cx['z6'])}-->
        <!--{else}-->
        <!--{count($list)+1}-->
        <!--{/if}-->               </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <!--{/if}-->


</tr>
<tr>
    <td nowrap>最大遗漏值</td>
    <td align="center" style='border-right:#d6d6d6 solid 1px;' colspan="5">&nbsp;</td>
    <!--{foreach from=$wei key=key1 item=item1}-->
    <!--{for $i=0 to 9}-->

    <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$yl[$key1][$i]}--></td>
    <!--{/for}-->
    <!--{/foreach}-->
    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td align="center">

        <!--{$yl['pair']}-->

    </td>

    <!--{/if}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$yl['result'][$i]}-->                </td>
    <!--{/for}-->

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$yl['kd'][$i]}-->                  </td>
    <!--{/for}-->
    <td align="center">
    </td>
    <!--{/if}-->


    <!--{if $method=='3X' ||  $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
        <!--{$yl['baozi']}-->                </td>
    <td align="center">
        <!--{$yl['z3']}-->                   </td>
    <td align="center">
        <!--{$yl['z6']}-->            </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <!--{/if}-->
</tr>
<tr>
    <td nowrap>最大连出值</td>
    <td align="center" style='border-right:#d6d6d6 solid 1px;' colspan="5">&nbsp;</td>

    <!--{foreach from=$wei key=key1 item=item1}-->
    <!--{for $i=0 to 9}-->

    <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$lc[$key1][$i]}--></td>
    <!--{/for}-->
    <!--{/foreach}-->

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td align="center">

        <!--{$lc['pair']}-->

    </td>

    <!--{/if}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$lc['result'][$i]}-->                </td>
    <!--{/for}-->

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <!--{for $i=0 to 9}-->
    <td align="center">
        <!--{$lc['kd'][$i]}-->                  </td>
    <!--{/for}-->
    <td align="center">
    </td>
    <!--{/if}-->

    <!--{if  $method=='3X' || $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
        <!--{$lc['baozi']}-->                   </td>
    <td align="center">
        <!--{$yl['z6']}-->                   </td>
    <td align="center">
        <!--{$yl['z3']}-->            </td>
    <td align="center">
    </td>
    <td align="center">
    </td>
    <td align="center">
    </td>

    <!--{/if}-->
</tr>
<tr id="head">
    <td rowspan="2" >期号</td>
    <td rowspan="2" colspan="5" style='border-right:#d6d6d6 solid 1px;'>开奖号码</td>
    <!--{foreach from=$wei key=key item=item}-->
    <!--{for $i=0 to 9}-->
    <!--{if $i<9}-->
    <td  class="wdh"><!--{$i}--></td>

    <!--{else}-->
    <td  style="border-right:#d6d6d6 solid 1px;"><!--{$i}--></td>

    <!--{/if}-->
    <!--{/for}-->
    <!--{/foreach}-->

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td rowspan="2" style="border-right:#d6d6d6 solid 1px;">对子</td>
    <!--{/if}-->
    <td>0</td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>

    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td >0</td>
    <td >1</td>
    <td >2</td>
    <td >3</td>
    <td >4</td>
    <td >5</td>
    <td >6</td>
    <td >7</td>
    <td >8</td>
    <td style="border-right:#d6d6d6 solid 1px;">9</td>
    <td rowspan="2">和值</td>
    <!--{/if}-->

    <!--{if $method=='3X' ||  $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
    <td rowspan='2'></td>
    <td rowspan='2'></td>
    <td rowspan='2'></td>
    <td rowspan='2'></td>
    <td rowspan='2'>豹子</td>
    <td rowspan='2'>组三</td>
    <td rowspan='2'>组六</td>
    <td rowspan='2'></td>
    <td rowspan='2'></td>
    <td rowspan='2'></td>
    <!--{/if}-->
</tr>
<tr id="title">
    <!--{foreach from=$wei key=key item=item}-->
    <td colspan="10" style="border-right:#d6d6d6 solid 1px;"><!--{$item}--></td>

    <!--{/foreach}-->

    <td colspan="10">不定位</td>
    <!--{if  $method=='2X1' || $method=='2X2'}-->
    <td colspan="10" style="border-right:#d6d6d6 solid 1px;">跨度</td>

    <!--{/if}-->
</tr>



<!--{if  $method=='2X1' || $method=='2X2'}-->
<tr>
    <td class="desc" colspan="48" style='text-align:left'><div>
            <p>参数说明：</p>
            <p>对子 - 开奖号码的万位与千位相同，例如：开奖号码88号码<br/>分布 - 开奖号码的万位与千位的0-9出号分布情况<br/>跨度 - 开奖号码的万位与千位的正差值，例如：开奖号码83，正差值为8-3=5<br/>和值 - 开奖号码的万位与千位的和值，例如：开奖号码83，二星和值为8+3=11</p>
        </div></td>
</tr>

<!--{/if}-->
<!--{if $method=='3X' ||  $method=='3X1' || $method=='3X2' || $method=='3X3'}-->
<tr>
    <td class="desc" colspan="56" style='text-align:left'><div>
            <p>参数说明：</p>
            <p>大小形态 - 开奖号码的千位、百位、十位的大小形态，0-4为小号，5-9为大号，例如：开奖号码783，大小形态为“大大小”
                <br/>
                奇偶形态 - 开奖号码的千位、百位、十位的奇偶形态，13579为奇号，02468为偶号，例如：开奖号码783，奇偶形态为“奇偶奇”
                <br/>
                质合形态 - 开奖号码的千位、百位、十位的质合形态，12357为质数号，04689为合数号，例如：开奖号码783，质合形态为“质合质”
                <br/>
                012形态 - 开奖号码的千位、百位、十位的除3余数形态，例如：开奖号码783，012形态为“120”
                <br/>
                0路包括的数字：0、3、6、9
                <br/>
                1路包括的数字：1、4、7
                <br/>
                2路包括的数字：2、5、8
                <br/>
                豹子 - 开奖号码的千位、百位、十位相同，例如：开奖号码333
                <br/>
                组三 - 开奖号码的千、百、十位其中两位号码相同，例如：开奖号码788
                <br/>
                组六 - 开奖号码的千、百、十位各不相同，例如：开奖号码748
                <br/>
                跨度 – 最大号和最小号的正差值</p>
        </div></td>
</tr>

<!--{/if}-->

<!--{if  $method=='5X'}-->
<tr>
    <td class="desc" colspan="66" style='text-align:left'><div id='refdiv'>
            <p>参数说明：</p>
            <p>万 千 百 十 个 不定位对应的走势。</p>
        </div></td>
</tr>


<!--{/if}-->

<!--{if  $method=='54'}-->
<tr>
    <td class="desc" colspan="60" style='text-align:left'><div id='refdiv'>
            <p>参数说明：</p>
            <p>千 百 十 个 不定位对应的走势。</p>
        </div></td>
</tr>


<!--{/if}-->

</tfoot>
</table></div>
<!-- <div id="quickbuy"><a href="">购买重庆时时彩</a></div> //-->

<script>

    $(function() {
        // 修正手機瀏覽網站往下滑到底會重整 20170626 Mon 09:17:29
        var isWindowTop = false;
        var lastTouchY = 0;
        var touchStartHandler = function(e) {
            if (e.touches.length !== 1) return;
            lastTouchY = e.touches[0].clientY;
            isWindowTop = (window.pageYOffset === 0);
        };
        var touchMoveHandler = function(e) {
            var touchY = e.touches[0].clientY;
            var touchYmove = touchY - lastTouchY;
            lastTouchY = touchY;
            if (isWindowTop) {
                isWindowTop = false;
                // 阻擋移動事件
                if (touchYmove > 0) {
                    e.preventDefault();
                    return;
                }
            }
        };
        document.addEventListener('touchstart', touchStartHandler, false);
        document.addEventListener('touchmove', touchMoveHandler, false);
        drawLine();
    })
</script>