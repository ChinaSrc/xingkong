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
                <div class="my_left">
                    

<!--{include file="<!--{$tplpath}-->user_left.tpl"}-->

              
                </div>
                <div class="my_right">
               
<!--{include file="<!--{$tplpath}-->user_top.tpl"}-->












                    <div class="home_rec clearfix">
      
                       <form action="" method="get" target="_self">
                           
                  <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                  <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                        <table width="100%" border="0" style="border-bottom: 0px; border-right: 0px;" cellspacing="0"
                            cellpadding="0" class="my_tbl">
                            <tr>
                                <td align='left'>
                        
                                    &nbsp;	                                  用户名：
                                <select name="st" id="st" >
                                    <option value="1"  <!--{if $smarty.get.st eq '1'}-->selected='selected'<!--{/if}--> >会员</option>
                                    <option value="2"  <!--{if $smarty.get.st eq '2'}-->selected='selected'<!--{/if}-->>团队</option>
                                 </select>
                                 <input style="width: 120px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
                                   &nbsp;日期：
                                    <input type="text" name="begindate" id="begindate" value="<!--{$begindate}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})"/>
	&nbsp;至

	 <input type="text" name="enddate" id="enddate" value="<!--{$enddate}-->"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" />&nbsp;

                                    
                                                                     &nbsp;<input type="submit" class="button" onclick="" value=" 查询 " />
                                </td>
                            </tr>
                        </table>
                        </form>
                        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px; text-align:center;" class="my_tbl" border="0" cellspacing="0" cellpadding="0" width="100%">
                          <tbody>
                              <tr>
                                  <th>
                                      订单号
                                  </th>
                                  <th>
                                     操作类型
                                  </th>
                                                        <th>
                                用户名
                                  </th>
                                  <th>
                                      返点金额
                                  </th>
                                  <th>
                                     账户余额 
                                  </th>
                                  <th>
                                      处理日期
                                  </th>
                                  <th>详情</th>
                              </tr>
                              
                              <!--{$body_list}-->
                              <tr>
                                  <td class="page" colspan="10" style="padding: 8px;">
                                      
  <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  
                                  </td>
                              </tr>
                          </tbody>
                      </table>

                      
                        </div>
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 








