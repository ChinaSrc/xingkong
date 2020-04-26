
<!DOCTYPE html>
<HTML xmlns="http://www.w3.org/1999/xhtml" xmlns:esun>

<HEAD>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="renderer" content="webkit" title="360浏览器强制开启急速模式-webkit内核" />
    <meta charset="UTF-8" />
    <title><!--{$game['fullname']}-->历史号码走势 </title>
    <link rel="shortcut icon" href="<!--{$con_system['ico']}-->" type="image/x-icon" />
    <meta name="description" content="<!--{$config.description}-->" />
    <meta name="keywords" content="<!--{$config.keywords}-->" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=false;"  />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META http-equiv="Pragma" content="no-cache" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/defaultright.css" rel="stylesheet" type="text/css" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/line.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/todo/images/common/base.css" />
    <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/blue/doubleDate.css" />
    <link rel="stylesheet" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/css/bonuscode_switchbar.min.css">

    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/jquery-1.4.2.min.js"></script>
    <!-- 工具类 非遊戲框架使用 main.min.js - 遊戲框架使用 下面三個 -->
    <!-- <script src="http://n2z1wlkyun.cntpca.com/sy2/todo/js/release/util.js"></script>
    <script src="http://n2z1wlkyun.cntpca.com/sy2/todo/js/game/phoenix.GameMessage.js"></script> -->
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/main.min.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/chosen.new.jquery.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/doubleDate2.0.min.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/line.min.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/calendar/jquery.dyndatetime.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/calendar/lang/calendar-utf8.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/moment.min.js"></script>
    <script src="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy/js/sy/common.min.js"></script>

    <link rel="stylesheet" type="text/css" media="all" href="<!--{$file_uri}-->/<!--{$skinpath}-->2018/sy2/js/calendar/css/calendar-green.css" />
</HEAD>
<body id="lan">
<div id="right_01">
    <div class="right_01_01">
        <span><a href="game_<!--{$game['id']}-->.html?nav=<!--{$game['skey']}-->" target='_top'><!--{$game['fullname']}-->历史号码走势 </a>
    </span>
    </div>
</div>
<script>

    $(document).ready(function () {
        //TODO : 20170509 FIX PHP SMARTY RENDER PROBLEM
        //初始化 沒填值 給今天的日期
        var $starttime = $('#starttime').val(),
            $endtime = $('#endtime').val(),
            starttime = moment(new Date).format('YYYY-MM-DD'),
            endtime = moment(new Date).format('YYYY-MM-DD')

        // 不能寫成一行 , 會被 render 成 smarty.....
        if (window.location.search.indexOf('starttime') == -1) {
            $('#starttime').val(starttime)
        }
        if (window.location.search.indexOf('starttime') == -1) {
            $('#endtime').val(endtime)
        }

        // patch to add input validation ..use moment istead of all previous validation
        Chart.init();
        drawLine();
        $('.doubledate').kuiDate({
            className: 'doubledate',
            isDisabled: "1"  // isDisabled为可选参数，“0”表示今日之前不可选，“1”标志今日之前可选
        });

        $("#starttime, #endtime").change(function () {
            var $lstarttime = $('#starttime').val(),
                $lendtime = $('#endtime').val(),
                lstarttime = moment($lstarttime),
                lendtime = moment($lendtime)

            if (lstarttime.isValid()) {
                sAlert("日期格式不正确,正确的格式为:2009-06-10");
                return false;
            }
            if (lendtime.isValid()) {
                if (lstarttime > lendtime) {
                    sAlert("输入的时间不符合逻辑");
                    return false;
                } else {
                    if (lendtime > lstarttime.add(4, 'day')) {
                        sAlert("输入的时间跨度不能超过5天！");
                        return false;
                    }
                }
            }
        });

        $('#showissue').click(function () {
            var $lstarttime = $('#starttime').val(),
                $lendtime = $('#endtime').val(),
                lstarttime = moment($lstarttime),
                lendtime = moment($lendtime),
                lchkStartTime = moment($lstarttime).add(4, 'day'),
                lchkEndTime = moment($lendtime);

            if ( !(lstarttime.isValid()) || !(lendtime.isValid())) {
                sAlert("请输入正确的日期与格式")
                return false;
            } else if (moment($lendtime) > lchkStartTime) {
                sAlert("输入的时间跨度不能超过5天！")
                return false;
            } else if ( (moment($lstarttime).format()) > (lchkEndTime.format()) ) {
                sAlert("输入的时间不符合逻辑");
                return false;
            } else {
                $("form").submit();
            }
        });
    });

    function drawLine() {
        $("canvas").remove();
        $('.IELine').remove();
        DrawLine.bind("chartsTable","has_line");

        DrawLine.color('#499495');
        DrawLine.add((parseInt(0)*11+5+1),2,11,0);
        DrawLine.color('#E4A8A8');
        DrawLine.add((parseInt(1)*11+5+1),2,11,0);
        DrawLine.color('#499495');
        DrawLine.add((parseInt(2)*11+5+1),2,11,0);
        DrawLine.color('#E4A8A8');
        DrawLine.add((parseInt(3)*11+5+1),2,11,0);
        DrawLine.color('#499495');
        DrawLine.add((parseInt(4)*11+5+1),2,11,0);

        DrawLine.draw(Chart.ini.default_has_line);
        resize();
    }

    function resize() {
        // 20170508 patch to detect mobile device and not to bind the resize event
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
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

    function toggleMiss(toggle) {
        $('#chartsTable').toggleClass('lost-hidden', !toggle);
    }
</script>
<style>
    .lost-hidden .lost {visibility: hidden;}
    esun\:*{behavior:url(#default#VML)}
</style>
<div class="switch-bar" style="display:none;">
    <ul class="switch-bar-list switch-bar-type-list">
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
</div><table width="100%" id="titlemessage" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td style="border:0px;text-align:left;vertical-align:middel;">
            <div id='nav' >
                <div style="width:auto;float:left">
					<span title="选中时（用鼠标单击控件打上勾即为选中），在表格中每期开奖号码的表格中显示出该号码的遗漏值。" style="cursor:pointer">
					<input type="checkbox" name="checkbox" value="checkbox" checked="checked" id="no_miss" onclick="toggleMiss(this.checked);" />遗漏</span>
                    <span title="选中时（用鼠标单击控件打上勾即为选中），将会在表格中绘制开奖号码的走势。" style="cursor:pointer">
					<input type="checkbox" name="checkbox2" value="checkbox" checked="checked" id="has_line" />走势</span>

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
        <td>
            <form method="GET" action="index_chart.html">
                <input type="hidden" name="playkey" value="<!--{$smarty.get.playkey}-->">
                <input type="hidden" name="method" value="<!--{$method}-->">
                <input type="hidden" name="top" value="<!--{$top}-->">
                <!--<input type="hidden" name="action" value="bonuscode">-->
                <input type="text" value="<!--{$smarty.get.starttime}-->" name="starttime" id="starttime" class="doubledate" readonly>
                &nbsp;&nbsp;至&nbsp;&nbsp;
                <input type="text" value="<!--{$smarty.get.endtime}-->" name="endtime" id="endtime" class="doubledate" readonly>
                <input type="button" value="送出" id="showissue">
            </form>
        </td>
    </tr>
</table>
<div style="position:relative; height: 950px;" id="container">
    <!-- TODO: 20170509 smarty render HTML 的部分需要 concat 速度會"快很多" -->
    <table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" style="position:absolute; top:0; left:0; border-collapse: collapse;" class="chart-table">
        <tr id="title">
            <td  rowspan="2">期号</td>
            <td  rowspan="2" colspan="5" class="redtext">开奖号码</td>
            <td  colspan="11">万位</td>
            <td  colspan="11">千位</td>
            <td  colspan="11">百位</td>
            <td  colspan="11">十位</td>
            <td  colspan="11">个位</td>
            <td  colspan="11">号码分布</td>
        </tr>
        <tr id="head">
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
            <td  class="wdh n115">01</td>
            <td  class="wdh n115">02</td>
            <td  class="wdh n115">03</td>
            <td  class="wdh n115">04</td>
            <td  class="wdh n115">05</td>
            <td  class="wdh n115">06</td>
            <td  class="wdh n115">07</td>
            <td  class="wdh n115">08</td>
            <td  class="wdh n115">09</td>
            <td  class="wdh n115">10</td>
            <td  class="wdh n115">11</td>
        </tr>



        <!--{foreach from=$list key=key item=item}-->
        <tr class="lostcolor">
            <td id="title"  ><!--{$item['period']}--></td>
            <td class="wdh n115 " align="center"><div class="aball02">
                    <!--{$item['number'][0]}-->                                                             </div></td>
            <td class="wdh n115 " align="center"><div class="aball02">
                    <!--{$item['number'][1]}-->                                                             </div></td>
            <td class="wdh n115" align="center"><div class="aball02">
                    <!--{$item['number'][2]}-->                                                          </div></td>
            <td class="wdh n115" align="center"><div class="aball02">
                    <!--{$item['number'][3]}-->                                                              </div></td>
            <td class="wdh n115" align="center"><div class="aball02">
                    <!--{$item['number'][4]}-->                                                              </div></td>


            <!--{$line=0}-->
            <!--{foreach from=$wei key=key1 item=item1}-->
            <!--{$aball=$line%2+3}-->
            <!--{$line=$line+1}-->
            <!--{for $i=1 to 11}-->


            <!--{if $i==$item['number'][$key1]}-->
            <!--{$lx[$key1][$i]=0}-->
            <!--{$cx[$key1][$i]=$cx[$key1][$i]+1}-->
            <td class="charball n115" align="center">
                <div class="aball0<!--{if $line%2==0}-->2<!--{else}--><!--{$line%2}--> <!--{/if}-->">
                    <!--{if $i<10}-->0<!--{/if}--><!--{$i}-->
                </div>
            </td>

            <!--{else}-->
            <!--{$lx[$key1][$i]=$lx[$key1][$i]+1}-->
            <!--{if $lx[$key1][$i]>$yl[$key1][$i]}-->
            <!--{$yl[$key1][$i]=$lx[$key1][$i]}-->
            <!--{/if}-->
            <td class="wdh n115" align="center">
                <div class="aball0<!--{$aball}-->"> <span class="lost"><!--{$lx[$key1][$i]}--> </span></div>
            </td>
            <!--{/if}-->


<!--{/for}-->
            <!--{/foreach}-->







            <!--{for $i=1 to 11}-->




            <!--{if in_array($i,$item['number1'])}-->

            <!--{foreach from=$item['number1'] key=key3 item=item3}-->
            <!--{if $i==$item3}-->
            <!--{$ball_times=$ball_times+1}-->
            <!--{/if}-->
            <!--{/foreach}-->


            <!--{$lx['result'][$i]=0}-->
            <!--{$cx['result'][$i]=$cx['result'][$i]+1}-->

            <td class="wdh" align="center">
                <div class="aball02">
                    <!--{if $i<10}-->0<!--{/if}--><!--{$i}-->                            </div>
            </td>
            <!--{else}-->
            <!--{$lx['result'][$i]=$lx['result'][$i]+1}-->
            <!--{if $lx['result'][$i]>$yl['result'][$i]}-->
            <!--{$yl['result'][$i]=$lx['result'][$i]}-->
            <!--{/if}-->

            <td class="wdh" align="center">
                <div class='lost'><div id='lostnum'><!--{$lx['result'][$i]}--></div></div>
            </td>
            <!--{/if}-->
            <!--{/for}-->


        </tr>


        <!--{/foreach}-->



        <tfoot>
        <tr>
            <td nowrap>出现总次数</td>
            <td align="center" colspan="5">&nbsp;</td>

            <!--{foreach from=$wei key=key1 item=item1}-->
            <!--{for $i=1 to 11}-->

            <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$cx[$key1][$i]}--></td>
            <!--{/for}-->
            <!--{/foreach}-->




            <!--{for $i=1 to 11}-->
            <td align="center">
                <!--{$cx['result'][$i]}-->                </td>
            <!--{/for}-->

        </tr>
        <tr>
            <td nowrap>平均遗漏值</td>
            <td align="center" colspan="5">&nbsp;</td>
            <!--{foreach from=$wei key=key1 item=item1}-->
            <!--{for $i=1 to 11}-->

            <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> ">
                <!--{if $cx[$key1][$i]>0}-->

                <!--{intval(count($list)/$cx[$key1][$i])}-->

                <!--{else}-->

                <!--{count($list)+1}-->
                <!--{/if}-->

            </td>
            <!--{/for}-->
            <!--{/foreach}-->

            <!--{for $i=1 to 11}-->
            <td align="center">
                <!--{if $cx['result'][$i]>0}-->

                <!--{intval(count($list)/$cx['result'][$i])}-->

                <!--{else}-->

                <!--{count($list)+1}-->
                <!--{/if}-->           </td>
            <!--{/for}-->
        </tr>
        <tr>
            <td nowrap>最大遗漏值</td>
            <td align="center" colspan="5">&nbsp;</td>
            <!--{foreach from=$wei key=key1 item=item1}-->
            <!--{for $i=1 to 11}-->

            <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$yl[$key1][$i]}--></td>
            <!--{/for}-->
            <!--{/foreach}-->

            <!--{for $i=1 to 11}-->
            <td align="center">
                <!--{$yl['result'][$i]}-->                </td>
            <!--{/for}-->
        </tr>
        <tr>
            <td nowrap>最大连出值</td>
            <td align="center" colspan="5">&nbsp;</td>
            <!--{foreach from=$wei key=key1 item=item1}-->
            <!--{for $i=1 to 11}-->

            <td  align="center" style="<!--{if $i==9}-->border-right:#d6d6d6 solid 1px;<!--{/if}--> "> <!--{$lc[$key1][$i]}--></td>
            <!--{/for}-->
            <!--{/foreach}-->


            <!--{for $i=1 to 11}-->
            <td align="center">
                <!--{$lc['result'][$i]}-->                </td>
            <!--{/for}-->
        </tr>
        <tr id="head">
            <td rowspan="2">期号</td>
            <td rowspan="2" colspan="5">开奖号码</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
        </tr>
        <tr id="title">
            <td colspan="11">万位</td>
            <td colspan="11">千位</td>
            <td colspan="11">百位</td>
            <td colspan="11">十位</td>
            <td colspan="11">个位</td>
            <td colspan="11">号码分布</td>
        </tr>
        </tfoot>
    </table>
</div>
<!-- <div id="quickbuy"><a href="">购买一分11选5</a></div> //-->