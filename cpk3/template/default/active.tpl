<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->style/active.css" type="text/css" rel="stylesheet" />

<script>
    function show_detail(num) {

     var floor=   document.querySelector('.activity').querySelectorAll('.floor');
     for(var i=0;i<floor.length;i++){

         var a=floor[i].querySelector('.floorRright').querySelector('a');
         if(i==num){

             if(floor[i].querySelector('.floorDetail').style.display=='block'){
                 floor[i].querySelector('.floorDetail').style.display='none';
                 a.className='';
             }

                 else{
                 floor[i].querySelector('.floorDetail').style.display='block';
                 a.className='show';
             }

         }
         else{

             floor[i].querySelector('.floorDetail').style.display='none';
             a.className='';
         }

     }

    }


</script>
<style>
  .recharge_box .recharge_btn { padding: 15px 0;}
  .recharge_box .recharge_msg { margin-bottom: 10px; color: #ed6a0c; background-color: #fffbe8; padding: 0 10px; }
  </style>
<body>



        <div id="subContainerId" >

            <div class="main" id="content"  >
                
                <div class="activity" >



                    <div class="floor fix" <!--{if $con_system['active_day_open'] neq '1'}--> style='display:none;' <!--{/if}-->>
                        <div class="actTitle fix" onclick="show_detail(0);">
                            <img src="<!--{$con_system['active_day_pic']|getFileUri}-->" alt="" class="ImgLI floorTitleImg defaultImg" />
                            <div class="floorRright">
                                <h2>每日加奖</h2>
                                <p>每日加奖是根据会员昨日投注金额进行加奖，奖金无上限。</p>
                                <a >查看详情<i></i></a>
                            </div>
                        </div>
                        <div class="floorDetail" style="display: none;">
                            <div class="inHtml">
                                <h3>每日加奖<i></i></h3> <em>昨日投注：<i><!--{$yestday_buy}--></i></em>
                                <em>当前等级：<i><!--{$user_group['title']}--></i></em>
                                <em>加奖比例：<i><!--{$day_pre}-->%</i></em> <em>可得加奖：<i><!--{$day_prize}--></i></em>
                                <!--{if $day_prize>0  && date('H:i:s')>=$con_system['active_day_begin']}-->
                                <!--{if $day_isget==1}-->
                                <a href="javascript:;" class="disable">今日已领取</a>
                                <!--{else}-->

                                <a onclick="if(confirm('确认要领取吗? ')) location.href='active.aspx?type=day_prize';" >立即领取</a>
                                <!--{/if}-->


                                <!--{else}-->
                                <a href="javascript:;" class="disable">不可领取</a>

                                <!--{/if}-->

                                <h3>加奖比例<i></i></h3>
                                <table width="60%">
                                    <tbody>
                                    <tr><th class="tbplus"><i>等级</i><ins></ins><em>昨日投注</em></th>
                                        <th>100+</th><th>10000+</th><th>200000+</th></tr>

                                    <!--{foreach from=$day_group key=key item=item}-->
                                    <tr ><td ><!--{$item['title']}--></td>
                                        <td >
                                            <!--{$id=$item['id']}-->


                                            <!--{$con_system["active_day_0_$id"]}-->%</td>
                                        <td ><!--{$con_system["active_day_1_$id"]}-->%</td>
                                        <td ><!--{$con_system["active_day_2_$id"]}-->%</td>
                                    </tr>
                                    <!--{/foreach}-->
                                 </tr>
                                    </tbody>
                                </table>
                                <h3>活动说明<i></i></h3></div> <!----> <!----> <div class="activityCon">
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    1、每日加奖在<span style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">次日</span>凌晨<!--{$con_system['active_day_begin']}-->后开放领取；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    2、加奖比例是根据会员等级以及昨日累计投注金额进行一定比例的加奖；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    3、需<!--{$min_group['title']}-->以上且昨日投注额大于或等于100才能获得加奖；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    4、<span style="font-family:&quot;color:#666666; background-color:#FFFFFF; font-size:14px !important;">撤单和</span>其他无效投注将不计算在内；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    5、活动奖金次日未领取，视为自动放弃活动资格<span style="font-family:&quot;color:#666666; background-color:#FFFFFF; font-size:14px !important;"><span style="font-family:&quot;color:#666666; background-color:#FFFFFF; font-size:14px !important;">。</span></span>
                                </p>

                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    6、每日活动截止时间<!--{$con_system['active_day_end']}-->

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="actLine"></div>
                    
                    
                    <div class="floor fix">
                        <div class="actTitle fix" onclick="show_detail(1);">
                            <img src="<!--{$con_system['active_vip_pic']|getFileUri}-->" alt="" class="ImgLI floorTitleImg defaultImg" />
                            <div class="floorRright">
                                <h2>晋级奖励</h2>
                                <p>会员每晋升一个等级，都能获得奖励，最高可达38888元。</p>
                                <a >查看详情<i></i></a>
                            </div>
                        </div>
                        <div  class="floorDetail" style="display: none;">
                            <div class="inHtml"><h3>晋级奖励<i></i></h3>
                                <em>当前等级：<i><!--{$user_group['title']}--></i></em> <em>晋级奖励：<i><!--{$group_prize}--></i></em>
                                <!--{if $group_prize>0}-->
                                <a onclick="if(confirm('确认要领取吗? ')) location.href='active.aspx?type=vip_update';" >立即领取</a>
                                <!--{else}-->
                                <a href="javascript:;" class="disable">不可领取</a>

                                <!--{/if}-->
                                <h3>晋级机制<i></i></h3>
                                <table width="60%" style="table-layout: fixed;">
                                    <tbody><tr><th>等级</th> <th>头衔</th> <th>成长积分</th> <th>晋级奖励(元)</th></tr>

                                    <!--{foreach from=$group_list key=key item=item}-->
                                    <tr ><td ><!--{$item['title']}--></td><td ><!--{$item['touxian']}--></td><td ><!--{$item['score']}--></td><td ><!--{$item['prize']}--></td></tr>
                                    <!--{/foreach}-->
                                </tbody></table>
                                <h3>活动说明<i></i></h3></div> <!---->
                            <div class="activityCon"><p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    <span style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                        1、充值1元可获得<!--{$con_system['score_pre']/100}-->成长积分；</span>
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    2、会员每晋升一个等级，都能获得对应奖励；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    3<span style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">、</span>若会员跳级晋升，可获得晋升的各级奖励之和；
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    <br>
                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    如<!--{$group_list[0]['title']}-->直接晋升到<!--{$group_list[4]['title']}-->，
                                    可获得奖励为：<!--{$group_list[1]['prize']}-->+<!--{$group_list[2]['prize']}-->+<!--{$group_list[3]['prize']}-->+<!--{$group_list[4]['prize']}-->=<!--{$group_list[1]['prize']+$group_list[2]['prize']+$group_list[3]['prize']+$group_list[4]['prize']}-->元。

                                </p>
                                <p style="font-family:'color:#666666; background-color:#FFFFFF; font-size:14px !important;">
                                    <br>
                                </p></div></div>
                    </div>
                <div class="actLine"></div>
                <!--{foreach from=$list key=key item=item}-->

                    <div class="floor fix">
                        <div class="actTitle fix" onclick="show_detail(<!--{$key+2}-->);">
                            <img src="<!--{$item['banner']|getFileUri}-->" alt="" class="ImgLI floorTitleImg defaultImg" />
                            <div class="floorRright">
                                <h2><!--{$item['title']}--></h2>
                                <p><!--{$item['desc']}--></p>
                                <a >查看详情<i></i></a>
                            </div>
                        </div>
                        <div  class="floorDetail" style="display: none;">
                        <div class="activityCon" >
                            <!--{$item['content']}-->
                        </div>
                        </div>
                    </div>
                <div class="actLine"></div>
                <!--{/foreach}-->

                </div>

        </div>





















<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
<script>
var recharge = null;
var deposit = null;
var rechargeArr = [
  { day: 7, status: 'disable' },
  { day: 15, status: 'disable' },
  { day: 30, status: 'disable' }
];
var depositData = {
  cz_money: 0,
  kl_money: 0,
  status: 'disable'
};
var flag = false;
$('h2').each(function() {
  if ($(this).text() == '连续充值送大礼') {
    recharge = $(this).parents('.floor');
  }
  if ($(this).text() == '存款送现金') {
    deposit = $(this).parents('.floor');
  }
});

function eachDay(index) {
  $.each(rechargeArr, function(i, item) {
    item.status = i == index ? '' : 'disable';
  });
}

function success(day) {
  var ischeck = confirm('确定领取?');
  if (!ischeck) return false;
  flag = true;
  $.get('index_api.html?action=receive&type='+ day, function(res) {
    flag = false;
    if (res.status == 'success') {
      eachDay(-1);
      $('.recharge_btn a, .deposit_box a').addClass('disable');
    }
    alert(res.message);
  }, 'JSON');
}

function rechargeSuccess(response) {
  if (!recharge) return false;
  var activityCon = recharge.find('.activityCon');
  var html = '';
  for (i = 0; i < rechargeArr.length; i++) {
    html += '<a href="javascript:;" style="margin-right: 10px;" class="'+ rechargeArr[i].status +'">领取'+ rechargeArr[i].day +'天奖励</a> ';
  }
  activityCon.prepend('<div class="recharge_box"><div class="recharge_btn">' + html + '</div><div class="recharge_msg">' + response.txt + '</div></div>');
  $('.recharge_btn').on('click', 'a', function() {
    var index = $('.recharge_btn a').index(this);
    if (rechargeArr[index].status == 'disable' || flag == true) {
      return false;
    }
    success(rechargeArr[index].day);
  });
}

function depositSuccess(response) {
  if (!deposit) return false;
  var activityCon = deposit.find('.activityCon');
  if (response.total >= 1 && response.total <= 6) {
    depositData.status = '';
    depositData.cz_money = response.cz_money;
    depositData.kl_money = response.kl_money;
  }
  activityCon.prepend('<div class="deposit_box"><h3>每日首充</h3><em>首充金额：<i>'+depositData.cz_money+'</i> </em><em>首充加奖：<i>'+depositData.kl_money+'</i></em> <a href="javascript:;" class="'+depositData.status+'">领取奖励</a></div>');
  $('.deposit_box').on('click', 'a', function() {
    if (depositData.status == 'disable' || flag == true) {
      return false;
    }
    success(1);
  });
}

$.get('index_api.html?action=getTotal', function(response) {
  if (response.total == undefined) return false;
  var total = response.total;
  if (total >= 7 && total <= 14) {
    eachDay(0);
  } else if (total >= 15 && total <= 29) {
    eachDay(1);
  } else if (total >= 30){
    eachDay(2);
  }
  rechargeSuccess(response);
  depositSuccess(response);
}, 'JSON');
</script>

