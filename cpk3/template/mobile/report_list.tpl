


<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>


<div class="main" s="[object Object]">
    <div class="ag-top"><div class="earn"><p>个人盈亏 </p><span><!--{$sum.sum}--></span></div> <div class="tip"><i class="icon-warning"></i>盈亏计算公式：中奖-投注+活动+返佣</div> </div>
    <div class="ag-bot" style="margin-top: 20px;padding-top: 15px;height: 120px"><div class="bet-bonus">
            <div><span class="mred"><!--{$sum.buy}--></span><p>投注金额 </p></div>
            <div><span class="mred"><!--{$sum.prize}--></span><p>中奖金额 </p></div>
            <div><span class="mred"><!--{$sum.active}--></span><p>活动礼金 </p></div></div></div>
    <div class="ag-bot" style="border-top: 1px solid #ddd;margin-top: 0px;height: 145px">
        <div class="bet-bonus">
            <div>
            <span class="mred"><!--{$sum.recharge}--></span><p>充值金额 </p></div>
            <div>
                <span class="mred"><!--{$sum.mention}--></span><p>提现金额 </p></div>
            <div><span class="mred"><!--{$sum.rebate}--></span><p>返点佣金 </p></div></div></div></div>



</div>


<script type="text/javascript">
function set_data(num){
for(var i=0;i<=3;i++){
if(i==num){

	document.getElementById('num_'+i).className='cur';

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
}



</script>











<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




