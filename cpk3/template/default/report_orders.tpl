
<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->

<script type="text/javascript">
  function jiangjin(a) {
    var jin="jiangjin" + a; 
    $("#jiangjin a").each(function(){
      var id = $(this).attr("id");
      if (id==jin) {
        $(this).css("color","red");
      }
      else {
        $(this).css("color","");
      }
    });
  }

</script>


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
<!--{include file="<!--{$tplpath}-->report_nav.tpl"}-->




                    <div class="home_rec clearfix">

                        <div>
                            <table width="100%" border="0" cellspacing="1" cellpadding="4" >
  <form method="POST" action="home_report_orders.html" name="form1" id="form1"> 
  <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
  <tr height=25 align="left">
     <td width=100% align="left" style='padding-left:5px;'>



	 <script>selectSetItem(G('lotteryid'),'<!--{$lotteryid}-->')</script>&nbsp;&nbsp;&nbsp;
	<b>时间</b>：<input type="text" name="begintime" id="begintime" value="<!--{$begindate}-->"class="Wdate"  style="width:100px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">
&nbsp;&nbsp;至
	 <input type="text" name="endtime" id="endtime" value="<!--{$enddate}-->" class="Wdate" style="width:100px;"   onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})">&nbsp;

 &nbsp;&nbsp;

	 <b>类型</b>：<select name="ordertype" id="ordertype" style="width:100px;">
 		  <option value="">所有类型</option> 
 		    <option value="Recharge_to_higherid|Recharge_from_Lowerid|Recharge_to_system|hig_add_admin|Recharge_online">充值</option>
 		     <option value="mention_to_higherid|mention_from_Lowerid|mention_to_system|mention_from_system">提现</option>

 		     <option value="hig_buy|hig_chase">投注</option>
 		     <option value="hig_rebate|">返点</option>
  		    <option value="hig_prize">奖金</option>
  		        <option value="active">活动</option> 
  		           <option value="fenhong">红利</option> 
  		    <option value="hig_chase_back|hig_buy_chase_back|hig_buy_back">撤单</option>
  		  
   		    <option value="tranfer_out">转出</option>	
   		        <option value="tranfer_in">转入</option>	   
   		   
		  </select>
		  <script>selectSetItem(G('ordertype'),'<!--{$ordertype}-->')</script>

&nbsp;&nbsp;
    <input type="submit" value="搜 索" class="button"></td>
   </tr>
 </table>
  
<style>.td_div{overflow:hidden;height:30px;}</style>  
        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px;" class="my_tbl my_tbltdm"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <th>
                                        序号
                                    </th>
                                    <th>
                                        交易类型
                                    </th>
                                    <th>
                                        操作金额
                                    </th>
                                    <th>
                                        账户余额
                                    </th>
                                    <th>
                                        处理时间
                                    </th>
                   
                                    <th>
                                        交易说明
                                    </th>
                                </tr>


                                

<!--{$body_list}--> 
 </tbody>
</table> 

<!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  	
                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 














