


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=234" type="text/css" rel="stylesheet" />

<style>

    .detail tr th,.detail tr td{

        border-bottom: 0px;

    }
    .detail tr th {

        background-color: #d3d3d3;
    }

    .detail tr td {

        background-color: #a6ffa6;

    }
.bgred{
    background-color: #ff0000;
}
    .list_tbl tr td{
        border-right: 1px #ddd solid;
    }
</style>
        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->


                <div class="newTab">

                    <a  class="<!--{if $begin==$time_arr[1]}-->router-link-exact-active curr<!--{/if}-->"  name="time" onclick="change_tabs('<!--{$time_arr[1]}-->','<!--{$time_arr[0]}-->',0);">今天</a>
                    <a  class="<!--{if $begin==$time_arr[2]}-->router-link-exact-active curr<!--{/if}-->"  name="time" onclick="change_tabs('<!--{$time_arr[2]}-->','<!--{$time_arr[2]}-->',1);">昨天</a>
                    <a  class="<!--{if $begin==$time_arr[3]}-->router-link-exact-active curr<!--{/if}-->"  name="time" onclick="change_tabs('<!--{$time_arr[3]}-->','<!--{$time_arr[0]}-->',2);">七天</a>

                </div>
                <div class="home_rec clearfix">
      
                       <form action="" method="get" target="_self" id="form1">
                           
                  <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                  <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                  <input type="hidden" name='st' value="2">
                           <input type="hidden" name='order' id="order" value="">
                          时间： <input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:100px;" />
                           - <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:100px;"/>

                        
                                                      账号：
                              
                                 <input style="width: 150px" placeholder="请输入下级账号" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
                       


                                 
                                                                     &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />

                       <input type="button"  value="最近登录" <!--{if $smarty.get.order eq 'login'}--> class="button bgred" onclick="set_item('order','');"<!--{else}-->class="button" onclick="set_item('order','login');"<!--{/if}-->>
                           <input type="button"  value="今日注册" <!--{if $smarty.get.order eq 'reg'}--> class="button bgred" onclick="set_item('order','');"<!--{else}-->class="button" onclick="set_item('order','reg');"<!--{/if}--> >
                           <input type="button" value="最多余额" <!--{if $smarty.get.order eq 'amount'}--> class="button bgred" onclick="set_item('order','');"<!--{else}-->class="button" onclick="set_item('order','amount');"<!--{/if}--> >
                           <input type="button" value="今日首充" <!--{if $smarty.get.order eq 'first'}--> class="button bgred" onclick="set_item('order','');"<!--{else}-->class="button" onclick="set_item('order','first');"<!--{/if}--> >

                       </form>
   <table style="border-bottom: 0px; border-top: 0px; border-right: 0px; text-align:center; " class="my_tbl list_tbl" border="0" cellspacing="0" cellpadding="0" width="99%">
                    <tbody>
                    <tr _POST>
                        <th _POST>序号</th>
                        <th _POST>账号</th>
                        <th _POST>类型</th>
                        <th _POST>等级</th>
                        <th _POST>手机</th>
                        <th _POST>QQ</th>
                        <th _POST>微信</th>
                        <th _POST>注册时间</th>
                        <th _POST>最近登录</th>
                        <th _POST>用户余额</th>
                        <th _POST>报表明细</th>
                    </tr>

                    <!--{foreach from=$user_list key=key item=item}--> 
                      
                    <tr>

                        <td><!--{$item.i}--></td>
                        <td>  
                       
                        
                      <a href="home_user_buy.html?st=2&username=<!--{$item.username}-->" style=' text-decoration:none;color: #3388ff;'>  <!--{$item.username}--></a>
                      </td>
                       
        <td>
       <!--{if $item['isproxy']==1}-->
            玩家
            <!--{else}-->
            代理
            <!--{/if}-->
     </td>
                        <td><!--{$item.grouptitle}--></td>
                        <td><!--{field_show($item['userid'],3)}--></td>
                        <td><!--{field_show($item['userid'],2)}--></td>
                        <td><!--{field_show($item['userid'],1)}--></td>
                        <td><!--{substr($item.registertime,0,10)}--></td>
                        <td><!--{substr($item.lastlogintime,0,10)}--></td>

                        <td><!--{number_show($item.hig_amount)}--></td>
                       <td> <a class="showtitle" onclick="show_detail11(<!--{$key}-->)">查看</a></td>
                    </tr>
<tr style="display: none" class="detail" >
    <td colspan="12">
        <table style="width: 100%;border-spacing: 0px"  >

            <tr>
                <th >时间段</th>
                <th >总充值</th>
                <th >聊天室充值</th>
                <th >提现</th>
                <th >投注金额</th>
                <th >中奖金额</th>
                <th >返点佣金</th>
                <th >活动礼金</th>
                <th >盈亏</th>

            </tr>

            <tr>
                <td>
                    <!--{date('m/d',strtotime($begin))}-->
                    至
                    <!--{date('m/d',strtotime($end))}-->
                </td>
                <td><!--{$item.recharge}--></td>
                <td><!--{$item.recharge_chat}--></td>
                <td><!--{$item.mention}--></td>
                <td><!--{$item.buy}--></td>
                <td><!--{$item.prize}--></td>


                <td><!--{$item.rebate}--></td>
                <td><!--{$item.active}--></td>

                <td>  <!--{$item.sum}--> </td>


            </tr>

        </table>



    </td>


</tr>

   
                          <!--{/foreach}--> 
                    
               
              
                            
                                             
                </tbody></table>
<div class="page">

    <!--{$page}-->
</div>

                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>

<script>
    function show_detail11(num) {
        var detail=document.querySelectorAll('.detail');
        var showtitle=document.querySelectorAll('.showtitle');
     for(var i=0;i<detail.length;i++){

         if(i==num){
             if(showtitle[i].innerHTML=='收起'){
                 detail[i].style.display='none';
                 showtitle[i].innerHTML='查看'
             }else{
                 detail[i].style.display='';
                 showtitle[i].innerHTML='收起';
             }

         }else{
             // detail[i].style.display='none';
             // showtitle[i].innerHTML='查看';
         }

     }


    }

function set_item(item,value){
    document.getElementById(item).value=value;
document.getElementById('form1').submit();
}
</script>



        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 




