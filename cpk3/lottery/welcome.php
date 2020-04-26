<?php
include('config.php');
include_once 'admin_head.php';
require_once '../source/class/cache.php';
$cache = new Cache();
$date1 = date('Y-m-d H:i:s', time() - 24 * 3600);

$date2 = date('Y-m-d', time() - 24 * 3600) . " 00:00:00";
$date3 = date('Y-m-d', time() - 24 * 3600) . " 23:59:59";

$today = get_day_time1();

$begintime = $today[0];
$endtime   = $today[1];

$list1 = $db->fetch_all("select  `userid`, `username`  from user where higherid='0' and admin='0' and virtual='0'");

?>
<style>
    #info_con_3 tr {
        line-height: 35px;
        font-size: 16px;
        height: 35px;
    }

    .table1 {
        background-color: #ddd;
        width: 98%;
        margin: 0 auto;
    }

    .table1 td, .table1 th {
        background-color: #fff;
        margin: 0px;
        text-align: center;
        color: #222;
    }

    .table1 tr {
        line-height: 35px;
        font-size: 16px;
        height: 35px;
    }

    .info1 {
        background-color: #fff;
        border: 1px #ccc solid;
        width: 98%;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .info1 .title1 {
        text-align: left;
        line-height: 35px;
        font-size: 16px;
        font-weight: 800;
        padding-left: 10px;
    }

    .info1 .content1 {
        padding: 10px;
        border-top: 1px solid #ccc;
    }
</style>

<div id="secondary_bar">
    <div class="breadcrumbs_container">
        <article class="breadcrumbs"><a>当前位置：<strong>首页</strong></a>
            <div class="breadcrumb_divider"></div>
            <span id="position"><a class="current">统计概况</a>

                                </span></article>
    </div>

</div>

<div class='info1' style="margin-top: 40px;">
    <?php
    if (!$_GET['begintime'])
        $begin = $begintime;
    else {
        $begin = $_GET['begintime'] . ' 00:00:00';
    }
    if (!$_GET['endtime'])
        $end = $endtime;
    else {
        $end = $_GET['endtime'] . ' 23:59:59';
    }

    ?>
    
    <div class='title1' style="padding: 8px 10px">超级代理统计

        <div style="font-size: 14px;display: inline-block;padding-left: 10px;">
                &nbsp;日期：
                <input type="text" name="begintime" value="<?php echo substr($begin, 0, 10); ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
                &nbsp;至

                <input type="text" name="endtime" value="<?php echo substr($end, 0, 10); ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>&nbsp;
                <input type="submit" value="搜索" class="button" id="superAgentSubmit">

        </div>

    </div>
    <div class="content1">
    <table class='table1' style='width:100%;' cellpadding="1" cellspacing="1">

        <tr class="superAgentHeader">
            <th>账号</th>

            <th>投注额</th>
            <th>中奖额</th>
            <th>充值</th>
            <th>提现</th>
            <th>首充</th>
            <th>返点</th>

            <th>活动彩金</th>
            <th>投注人数</th>
            <th>在线人数</th>
            <th>下级余额</th>

            <th>注册人数</th>
            <th>下级人数</th>
            <th>盈利</th>
        </tr>
        <tr id="superAgentLoading">
          <td colspan="14" style="background-color: #f8f8f8; color: #000">加载中...</td>
        </tr>
        <tbody id="superAgent"></tbody>

    </table>
    </div>

</div>

<div class='info1'>
   <div class='title1' style="padding: 8px 10px">超级代理明细

        <div style="font-size: 14px;display: inline-block;padding-left: 10px;">
                &nbsp;日期：
                <input type="text" name="section_start" value="<?php echo substr($begin, 0, 10); ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
                &nbsp;至

                <input type="text" name="section_end" value="<?php echo substr($end, 0, 10); ?>" class="Wdate" type="text"
                       onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>&nbsp;
                <input type="submit" value="搜索" class="button" id="sectionSubmit">
                <input type="button" value="清空" class="button" id="sectionClear">

        </div>

    </div>
  <div class="content1" id="sectionContent" style="display: none">
  
    <!-- <table class="table1">
      <thead>
        <tr>
          <td colspan="14">2011-01-01</td>
        </tr>
      </thead>
      <tbody>
    	<tr>
            <th>账号</th>
            <th>投注额</th>
            <th>中奖额</th>
            <th>充值</th>
            <th>提现</th>
            <th>首充</th>
            <th>返点</th>
            <th>活动彩金</th>
            <th>投注人数</th>
            <th>在线人数</th>
            <th>下级余额</th>
            <th>注册人数</th>
            <th>下级人数</th>
            <th>盈利</th>
        </tr>
      </tbody>
    </table> -->
  
  </div>
</div>

<div class='info1'>

    <div class='title1 clearfix'>盈亏统计
    <input id="yktj_button" type="button" value="查看" class="button" style="margin: 5px;display: none">
    </div>

    <div class='content1' style="display:none;" id="yktj_box">


        <table class='table1' style='width:100%;' cellpadding="1" cellspacing="1">

            <tr>
                <th></th>
                <th>充值</th>
                <th>提现</th>
                <th>投注</th>
                <th>中奖</th>

                <th>返点</th>

                <th>活动</th>
                <th>盈利</th>
            </tr>
            <tr>
                <th>今日统计</th>
                <td><?php echo $yingkui1['recharge']; ?></td>
                <td><?php echo $yingkui1['mention']; ?></td>
                <td><?php echo $yingkui1['buy']; ?></td>
                <td><?php echo $yingkui1['prize']; ?></td>
                <td><?php echo $yingkui1['rebate']; ?></td>
                <td><?php echo $yingkui1['active']; ?></td>
                <td><?php echo -$yingkui1['sum']; ?></td>
            </tr>
            <?php
            //			$begin = date('Y-m-d', time() - 24 * 3600) . " 00:00:00";;
            //			$end      = date('Y-m-d', time() - 24 * 3600) . " 23:59:59";
            //			$yingkui1 = array();
            //			//			$list1=$db->fetch_all("select  `userid`  from user where higherid='0' and admin='0' and virtual='0'");
            //			foreach ($list1 as $value) {
            //			    if($nextListArr[$value['userid']]) {
            //                  $next_list = $nextListArr[$value['userid']];
            //                } else {
            //			      $next_list = get_user_nextid2($value['userid']);
            //                }
            //
            ////				$yingkui = get_yingkui($value['userid'], $begin, $end, 1, 1);
            //				$yingkui = get_yingkui_new($value['userid'], $begin, $end, 1, 1, $next_list);
            ////				$yingkui2 = get_yingkui($value['userid'], $begin, $end, 0);
            //				$yingkui2 = get_yingkui_new($value['userid'], $begin, $end, 0, 0, $next_list);
            //				foreach ($yingkui as $key1 => $value1) {
            //					$yingkui[$key1]  = $value1 - $yingkui2[$key1];
            //					$yingkui1[$key1] += $yingkui[$key1];
            //				}
            //				// print_r($yingkui2);
            //			}
            ?>
            <tr>
                <th>昨日统计</th>


                <td class="zr_recharge"><?php //echo $yingkui1['recharge']; ?></td>
                <td class="zr_mention"><?php //echo $yingkui1['mention']; ?></td>
                <td class="zr_buy"><?php //echo $yingkui1['buy']; ?></td>
                <td class="zr_prize"><?php //echo $yingkui1['prize']; ?></td>


                <td class="zr_rebate"><?php //echo $yingkui1['rebate']; ?></td>

                <td class="zr_active"><?php //echo $yingkui1['active']; ?></td>
                <td class="zr_sum"><?php //echo -$yingkui1['sum']; ?></td>
            </tr>
        </table>


        <table class='table1' style='width:100%;margin-top:10px;' cellpadding="1" cellspacing="1">

            <tr>
                <th>月份</th>
                <th>充值</th>
                <th>提现</th>
                <th>投注</th>
                <th>中奖</th>

                <th>返点</th>

                <th>活动</th>
                <th>盈利</th>
            </tr>

            <?php
            //			for ($i = 0; $i < 4; $i++) {
            //				$m = date('m');
            //
            //				if ($m - $i < 0) {
            //					$m = $m - $i + 12;
            //					$y = date('Y') - 1;
            //				} else {
            //					$m = $m - $i;
            //					$y = date('Y');
            //				}
            //
            //				if ($m < 10) $m = '0' . $m;
            //				$month     = $y . '-' . $m;
            //				$from      = $month . "-01 00:00:00";
            //				$nextmonth = date("Y-m", time() - ($i - 1) * 24 * 3600 * 30);
            //				$to        = $nextmonth . "-01 00:00:00";
            //				$from1     = strtotime($from);
            //				$to1       = strtotime($to);
            //				$yingkui1  = array();
            //				if($cache->has($from)) {
            //                  $yingkui1 = $cache->get($from);
            //                } else {
            //                  $list1=$db->fetch_all("select  `userid`  from user where higherid='0' and admin='0' and virtual='0'");
            //                  foreach ($list1 as $value) {
            //                      if($nextListArr[$value['userid']]) {
            //                          $next_list = $nextListArr[$value['userid']];
            //                      } else {
            //                          $next_list = get_user_nextid2($value['userid']);
            //                      }
            //                      $yingkui   = get_yingkui_new($value['userid'], $from, $to, 1, 1, $next_list);
            //                      $yingkui2  = get_yingkui_new($value['userid'], $from, $to, 0, 0, $next_list);
            //                      foreach ($yingkui as $key1 => $value1) {
            //                          $yingkui[$key1]  = $value1 - $yingkui2[$key1];
            //                          $yingkui1[$key1] += $yingkui[$key1];
            //                      }
            //                      // print_r($yingkui2);
            //                  }
            //                  if($i > 0) {
            //                      $cache->set($from, $yingkui1, 0);
            //                  }
            //                }
            //
            ?>

            <tbody class="yktj_box_list">
                <tr>
                    <td><?php //echo $month ?></td>
                    <td><?php //echo $yingkui1['recharge']; ?></td>
                    <td><?php //echo $yingkui1['mention']; ?></td>
                    <td><?php //echo $yingkui1['buy']; ?></td>
                    <td><?php //echo $yingkui1['prize']; ?></td>


                    <td><?php //echo $yingkui1['rebate']; ?></td>

                    <td><?php //echo $yingkui1['active']; ?></td>
                    <td><?php //echo -$yingkui1['sum']; ?></td>
                </tr>
            </tbody>

            <?php //}?>


        </table>

    </div>


</div>



<div class='info1'>

    <div class='title1'>用户统计

        [<a id="edit_amo_2636"
            onclick="winPop({title:'用户充值',width:'700',drag:'true',height:'300',url:'index.aspx?controller=user&action=pay'})">快捷充值</a>]
        &nbsp;
        <input id="yhtj_button" type="button" value="查看" class="button" style="margin: 5px;display: none">

    </div>

    <div class='content1' style="display:none;" id="yhtj_box">


        <table class='table1' cellpadding="1" cellspacing="1">

            <tr>
                <th>用户总数</th>
                <th>代理总数</th>
                <th>会员总数</th>


                <th>今日注册用户</th>
                <th>今日登陆人数</th>
                <th>当前在线</th>

            </tr>


            <tr>


                <td class="userCount">
                    <?php

                    //					$row = $db->fetch_first("select  count(*) as num from user where admin='0' ");
                    //					if (!$row[num]) $row['num'] = 0;
                    //					$sum = $row['num'];
                    //
                    //					echo $sum;
                    ?>

                </td>
                <td class="dlCount">
                    <?php
                    //					$row = $db->fetch_first("select  count(*) as num from user where admin='0' and isproxy='0'");
                    //					if (!$row[num]) $row['num'] = 0;
                    //					echo $row['num'];
                    ?>
                </td>
                <td class="hyCount">
                    <?php
                    //					echo $sum - $row['num'];
                    ?>
                </td>
                <td class="todayRs">
                    <?php
                    //					$row = $db->fetch_first("select  count(*) as num from user where admin='0'  and registertime>'{$begintime}'");
                    //					if (!$row[num]) $row['num'] = 0;
                    //					echo $row['num'];
                    ?>

                </td>


                <td class="todayLg">
                    <?php
                    //					$row = $db->fetch_first("select  count(*) as num from user where admin='0' and lastlogintime>'{$begintime}'");
                    //					if (!$row[num]) $row['num'] = 0;
                    //					echo $row['num'];
                    ?>

                </td>
                <td class="online">

                    <?php
                    //					$row = $db->fetch_first("select  count(*) as num from user_online where userid in (select userid from user where admin='0')");
                    //					if (!$row[num]) $row['num'] = 0;
                    //					echo $row['num'];
                    ?>


                </td>


        </table>


    </div>


</div>


<div class='info1'>

    <div class='title1'>
        彩种投注金额统计<span style='font-weight:500;font-size:14px;'>（彩种名称：投注金额）</span>
        <input id="cztztj_button" type="button" value="查看" class="button" style="margin: 5px;display: none">
    </div>

    <div class='content1' style="display:none;" id="cztztj_box">


        <table class='table1' cellpadding="1" cellspacing="1">

            <?php
            //			$all = $db->fetch_all("select playkey,sum(money) as money from game_buylist group by playkey");
            //
            //			$num = 0;
            //			foreach ($all as $key => $value) {
            //
            //
            //				$game = $db->fetch_first("select * from game_type where ckey='{$value['playkey']}'");
            //				if ($game) {
            //					if ($num % 4 == 0) echo "<tr>";

            ?>


            <td>
                <?php


                //						echo $game['fullname'];
                ?>

                <font color='#ea2c3a'>￥<?php //echo number_format($value['money'], 3, '.', '') ?></font>

            </td>


            <?php
            //					if (($num + 1) % 4 == 0 or $num == count($all) - 1) echo "</tr>";
            //					$allnum++;
            //				}
            //			} ?>
        </table>


    </div>

    <?php
    $end = explode(' ', microtime());
    var_dump($end[1] + $end[0] - $start[1] + $start[0]);
    ?>
</div>
<script type='text/javascript' src='<?php echo ROOT_URL; ?>/static/js/jquery-1.9.1.js'></script>
<script>
$(function() {
  // 超级代理统计
  var isSuperAgentloading = false;
  function superAgentAjax() {
    if (isSuperAgentloading) return;
    isSuperAgentloading = true;
    $('#superAgentSubmit').val('加载中');
    $('#superAgentLoading').show();
    $('#superAgent').html('');
    $.get('api.php?ac=main', {
      begintime: $('[name=begintime]').val(),
      endtime: $('[name=endtime]').val()
    }, function(data) {
      $('#superAgentSubmit').val('搜索');
      isSuperAgentloading = false;
      $('#superAgentLoading').hide();
      var html = '';
      for (var i = 0; i < data.list.length; i += 1) {
        var el = data.list[i];
        html += el.virtual == 1 ? '<tr class="virtual">' : '<tr>';
        html += '<td>'+ el.username +'</td>';
        html += '<td>'+ el.buy +'</td>';
        html += '<td>'+ el.prize +'</td>';
        html += '<td>'+ el.recharge +'</td>';
        html += '<td>'+ el.mention +'</td>';
        html += '<td>'+ el.frist_recharge +'</td>';
        html += '<td>'+ el.rebate +'</td>';
        html += '<td>'+ el.active +'</td>';
        html += '<td>'+ el.buy_num +'</td>';
        html += '<td>'+ el.online +'</td>';
        html += '<td>'+ el.money +'</td>';
        html += '<td>'+ el.reg_num +'</td>';
        html += '<td>'+ el.num +'</td>';
        html += '<td>'+ el['pri-buy'] +'</td>';
        html += '</tr>';
      }
      var total = data.total;
      html += '<tr>';
      html += '<td>合计</td>';
      html += '<td>'+ total.buy +'</td>';
      html += '<td>'+ total.prize +'</td>';
      html += '<td>'+ total.recharge +'</td>';
      html += '<td>'+ total.mention +'</td>';
      html += '<td>'+ total.frist_recharge +'</td>';
      html += '<td>'+ total.rebate +'</td>';
      html += '<td>'+ total.active +'</td>';
      html += '<td>'+ total.buy_num +'</td>';
      html += '<td>'+ total.online +'</td>';
      html += '<td>'+ total.money +'</td>';
      html += '<td>'+ total.reg_num +'</td>';
      html += '<td>'+ total.num +'</td>';
      html += '<td>'+ total['pri-buy'] +'</td>';
      html += '</tr>'
      $('#superAgent').html(html);
    }, 'JSON');
  }
  superAgentAjax();
  $('#superAgentSubmit').click(function() {
    superAgentAjax();
  });
  // 超级代理明细
  var sectiontLoading = false;
  function sectiontAjax() {
    if (sectiontLoading) return;
    sectiontLoading = true;
    $('#sectionSubmit').val('加载中');
    $('#sectionContent').html('').hide();
    $.get('api.php?ac=his', {
      start: $('[name=section_start]').val().replace(/-/ig, '' ),
      end: $('[name=section_end]').val().replace(/-/ig, '' )
    }, function(data) {
      $('#sectionSubmit').val('搜索');
      sectiontLoading = false;
      var html = '';
      for (var i = 0; i < data.length; i += 1) {
        var parent = data[i];
        var date = data[i].date;
        var newDate = date.slice(0, 4) + '-' + date.slice(4, 6)+ '-' + date.slice(6);
        var header = $('.superAgentHeader').html();
        html += '<table class="table1" style="margin-top: 10px">';
        html += '<thead>';
        html += '<tr><td colspan="14">' + (newDate) + '</td></tr>';
        html += '</thead>';
        html += '<tr>' + header + '</tr>';
        for (var j = 0; j < parent.data.list.length; j += 1) {
          var el = parent.data.list[j];
          html += el.virtual == 1 ? '<tr class="virtual">' : '<tr>';
          html += '<td>'+ el.username +'</td>';
          html += '<td>'+ el.buy +'</td>';
          html += '<td>'+ el.prize +'</td>';
          html += '<td>'+ el.recharge +'</td>';
          html += '<td>'+ el.mention +'</td>';
          html += '<td>'+ el.frist_recharge +'</td>';
          html += '<td>'+ el.rebate +'</td>';
          html += '<td>'+ el.active +'</td>';
          html += '<td>'+ el.buy_num +'</td>';
          html += '<td>'+ el.online +'</td>';
          html += '<td>'+ el.money +'</td>';
          html += '<td>'+ el.reg_num +'</td>';
          html += '<td>'+ el.num +'</td>';
          html += '<td>'+ el['pri-buy'] +'</td>';
          html += '</tr>';
        }
        var total = parent.data.total;
        html += '<tr>';
        html += '<td>合计</td>';
        html += '<td>'+ total.buy +'</td>';
        html += '<td>'+ total.prize +'</td>';
        html += '<td>'+ total.recharge +'</td>';
        html += '<td>'+ total.mention +'</td>';
        html += '<td>'+ total.frist_recharge +'</td>';
        html += '<td>'+ total.rebate +'</td>';
        html += '<td>'+ total.active +'</td>';
        html += '<td>'+ total.buy_num +'</td>';
        html += '<td>'+ total.online +'</td>';
        html += '<td>'+ total.money +'</td>';
        html += '<td>'+ total.reg_num +'</td>';
        html += '<td>'+ total.num +'</td>';
        html += '<td>'+ total['pri-buy'] +'</td>';
        html += '</tr>'
        html += '</table>';
      }
      if (html == '') {
        alert('暂无数据');
        return;
      }
      $('#sectionContent').show().html(html);
    }, 'JSON');
  }
  $('#sectionSubmit').click(function() {
    sectiontAjax();
  });
  $('#sectionClear').click(function() {
    $('#sectionContent').html('').hide();
  });
  
  $('#yktj_button,#yhtj_button,#cztztj_button').show();
  $('#yktj_button').click(function() {
      if ($('#yktj_box').is(':hidden')) {
        $(this).val('加载中')  
        $.get('api.php?ac=yktj', function(res) {
            $('#yktj_box').show();
            $('#yktj_button').val('收起')  
            var data = $.parseJSON(res);
            $.each(data.ztyk, function(key, item) {
                $('.zr_' +key).html(item);
            });
            var html = '';
            for (var i = 0; i < data.yfyk.length; i += 1) {
                html += '<tr>';
                html += '<td>'+ data.yfyk[i].month +'</td>';
                html += '<td>'+ data.yfyk[i].recharge +'</td>';
                html += '<td>'+ data.yfyk[i].mention +'</td>';
                html += '<td>'+ data.yfyk[i].buy +'</td>';
                html += '<td>'+ data.yfyk[i].prize +'</td>';
                html += '<td>'+ data.yfyk[i].rebate +'</td>';
                html += '<td>'+ data.yfyk[i].active +'</td>';
                html += '<td>'+ data.yfyk[i].sum +'</td>';
                html += '</tr>';
            }
            $('.yktj_box_list').html(html);
         });
         return;
      }
      $(this).val('查看');  
      $('#yktj_box').hide();
  });
  $('#yhtj_button').click(function() {
    if ($('#yhtj_box').is(':hidden')) {
        $(this).val('加载中')  
        $.get('api.php?ac=yhtj', function(res) {
            $('#yhtj_box').show();
            $('#yhtj_button').val('收起')  
            var data = $.parseJSON(res);
            $.each(data, function(key, item) {
                $('#yhtj_box').find('.' +key).html(item);
            });
            $('#yhtj_box .hyCount').html(data.userCount - data.dlCount);
        });
        return;
    }
    $(this).val('查看');  
    $('#yhtj_box').hide();
  })
  $('#cztztj_button').click(function() {
    if ($('#cztztj_box').is(':hidden')) {
        $(this).val('加载中')  
        $.get('api.php?ac=cztztj', function(res) {
            $('#cztztj_box').show();
            $('#cztztj_button').val('收起')  
            var html = '<tr><td>';
            var data = $.parseJSON(res);
            for (var i = 0; i < data.length; i += 1) {
                html += '<div style="float: left; width: 25%;">'+ data[i].fullname +'<font color="#ea2c3a">￥'+ Number(data[i].money).toFixed(3) +'</font></div>';
            }
            html += '</td></tr>';
            $('#cztztj_box').show().find('tbody').html(html);
        });
        return;
    }  
    $(this).val('查看');  
    $('#cztztj_box').hide();
  })
});

</script>


