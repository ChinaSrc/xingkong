<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />



<!--头部链接开始-->
<!--主导航-->
<div id="bd">
    <div id="main" class="clearfix">

        <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->




        <div class="newTab">


            <a class="<!--{if $begin==$time_arr[0]['begin']}--> router-link-exact-active curr<!--{/if}-->" id="num_0"   onclick="set_data(0);"  >今日</a>
            <a class="<!--{if $begin==$time_arr[1]['begin'] && $end!=$time_arr[3]['end']}--> router-link-exact-active curr<!--{/if}-->" id="num_1"   onclick="set_data(1);"  >昨日</a>
            <a class="<!--{if $begin==$time_arr[2]['begin']}--> router-link-exact-active curr<!--{/if}-->" id="num_2"   onclick="set_data(2);" >本周</a>
            <a class="<!--{if $begin==$time_arr[3]['begin'] && $end==$time_arr[3]['end']}--> router-link-exact-active curr<!--{/if}-->" id="num_3"   onclick="set_data(3);" >本月</a>
        </div>






        <div class="home_rec">
                <form id="frm_search" name="frm_search"  method="post" action="" style="padding-left: 15px;">
      


                                日期：<input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:100px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:100px;"/>

                          
                   <input type="text" name="username" value="<!--{$smarty.post.username}-->" placeholder="请输入下级代理账号">
                                                <input type="submit" class="button" value=" 搜索 "  style='margin-top:8px;margin-left:10px;'>  

                </form>








            <div  class="teamContent">
                <ul  class="plMore">
                    <li ><em ><!--{$yingkui['buy']}--></em><span >投注金额</span></li>
                    <li ><em ><!--{$yingkui['prize']}--></em><span >中奖金额</span></li>
                    <li ><em ><!--{$yingkui['active']}--></em><span >活动礼金</span></li>
                    <li ><em ><!--{$yingkui['rebate']}--></em><span >团队返佣</span></li>
                    <li ><em ><!--{$yingkui['sum']}--></em><span >团队盈亏</span></li>
                </ul>
                <ul  class="plMore">
                    <li ><em ><!--{$buy_num}-->人</em><span >投注人数</span></li>
                    <li ><em ><!--{$recharge_num}-->人</em><span >充值人数</span></li>
                    <li ><em ><!--{$frist_recharge}-->人</em><span >首充人数</span></li>
                    <li ><em ><!--{$reg_num}-->人</em><span >注册人数</span></li>
                    <li ><em ><!--{$team['num']}-->人</em><span >下级人数</span></li>

                </ul>
                <ul  class="plMore">
                    <li ><em ><!--{$team['money']}--></em><span >团队余额</span></li>
                    <li ><em ><!--{$yingkui['recharge']}--></em><span >充值金额</span></li>
                    <li ><em ><!--{$yingkui['mention']}--></em><span >提现金额</span></li>
                    <li ><em ><!--{$yingkui1['rebate']}--></em><span >自身返点</span></li>
                    <li ></li>
                   
                </ul>
                <div  class="userTip">
                    <p ><i class="icon-warning"></i>温馨提示：以上是代理的团队数据（即他的所有下级的数据汇总，不含代理本身） </p>
                </div>
            </div>

























        </div>
    </div>
</div>

<script type="text/javascript">
function set_data(num){
for(var i=0;i<=3;i++){
if(i==num){

	document.getElementById('num_'+i).className='router-link-exact-active curr';
	
}
else{

	document.getElementById('num_'+i).className='';
}

	
}
if(num==0){var begin='<!--{$time_arr[0]['begin']}-->';var end='<!--{$time_arr[0]['end']}-->';}
if(num==1){var begin='<!--{$time_arr[1]['begin']}-->';var end='<!--{$time_arr[1]['end']}-->';}
if(num==2){var begin='<!--{$time_arr[2]['begin']}-->';var end='<!--{$time_arr[2]['end']}-->';}
if(num==3){var begin='<!--{$time_arr[3]['begin']}-->';var end='<!--{$time_arr[3]['end']}-->';}
document.getElementById('begintime').value=begin;
document.getElementById('endtime').value=end;
document.getElementById('frm_search').submit();
}



</script>


            <!--{include file="<!--{$tplpath}-->bottom.tpl"}-->


