


<!--{include file="<!--{$tplpath}-->head.tpl"}-->


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=234" type="text/css" rel="stylesheet" />


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>


<div class="top">
    <div class="back" onclick="window.history.go(-1);" >
        <i  class=" icon-left-open-big"></i>

    </div>
    <ul>
        <li class="on"  ><a>下级报表</a></li>
        <li class=""  >
            <a href="home_team_info.html">团队报表</a>
        </li>
    </ul>



</div>


                       <form action="" method="get" target="_self"  style='line-height:40px;padding-left:10px;padding-top:5px;'>

                  <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                  <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                  <input type="hidden" name='st' value="2">



                                日期：<input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:120px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:120px;"/>
<br>
                                                      用户名：

                                 <input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />

                                                                     &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />

                        </form>






                    <!--{foreach from=$user_list key=key item=item}-->
                    <div class='name_title'   onclick='set_display(<!--{$item['userid']}-->);'>
<div style='float:left;padding-left:10px;' >

    <a href="?uid=<!--{$item.userid}-->" style=' text-decoration:none;color: #3388ff;'> <!--{$item.username}--></a>

</div>

<div style='float:right;padding-right:10px;font-size:16px;font-weight:700;'>

<span class='<!--{if $item['sum']>0}-->red<!--{else}-->green<!--{/if}-->'>
<!--{$item.sum}-->
</span>
<span style='float:right;margin:0 10px;'>
<img src='<!--{$file_uri}-->/static/images/mobile/icon_down.png' id='img_<!--{$item['userid']}-->'  height='25px'>
</span>
</div>
 </div>

 <div class='yingkui_list'  id='info_<!--{$item['userid']}-->' style='display:none;'>

 <div class='line11'>
 <div class='item11'>
充值
 </div>
 <div class='value11'>
<!--{$item.recharge}-->
 </div>
 </div>

 <div class='line11'>
 <div class='item11'>
提现
 </div>
 <div class='value11'>
<!--{$item.mention}-->
 </div>
 </div>

 <div class='line11'>
 <div class='item11'>
 下注
 </div>
 <div class='value11'>
<!--{$item.buy}-->
 </div>
 </div>



 <div class='line11'>
 <div class='item11'>
中奖
 </div>
 <div class='value11'>
<!--{$item.prize}-->
 </div>
 </div>

 <div class='line11'>
 <div class='item11'>
活动
 </div>
 <div class='value11'>
<!--{$item.active}-->
 </div>
 </div>



 <div class='line11'>
 <div class='item11'>
返点
 </div>
 <div class='value11'>
<!--{$item.rebate}-->
 </div>
 </div>

 <div class='line11'>
 <div class='item11'>
盈亏
 </div>
 <div class='value11'>
<span class='<!--{if $item['sum']>0}-->red<!--{else}-->green<!--{/if}-->'>
<!--{$item.sum}-->
</span>
 </div>
 </div>



 </div>



                          <!--{/foreach}-->


<script>

function set_display(id){

if(document.getElementById('info_'+id).style.display=='none'){

document.getElementById('info_'+id).style.display='';
document.getElementById('img_'+id).src='<!--{$file_uri}-->/static/images/mobile/icon_up.png';
}
else{

document.getElementById('info_'+id).style.display='none';
document.getElementById('img_'+id).src='<!--{$file_uri}-->/static/images/mobile/icon_down.png';
}


}


</script>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->




