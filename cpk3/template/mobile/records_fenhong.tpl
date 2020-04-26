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
                        
                                            &nbsp;&nbsp;类型：
                                    <select name="status" id="status" >
                                        <option value="" <!--{if $smarty.get.status eq ''}-->selected='selected'<!--{/if}-->>全部</option>
                                        <option value="1" <!--{if $smarty.get.status eq '1'}-->selected='selected'<!--{/if}--> >纳入</option>
                                        <option value="2" <!--{if $smarty.get.status eq '2'}-->selected='selected'<!--{/if}--> >派送</option>
                                    </select>

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
                                        操作类型
                                    </th>                                    
                                    <th>
                                        操作金额  
                                    </th>
                                    <th>
                                        盈亏宝余额  
                                    </th>
                                    <th>
                                        处理日期
                                    </th>
                                    <th>详情</th>
                                </tr>
                                       <!--{section name=p loop=$list}-->   
        
                <tr>
          <td ><!--{$list[p]['statusname']}--></td>
          <td ><!--{$list[p]['amount']}--></td>
          <td ><!--{$list[p]['yk_amount']}--></td>
          <td ><!--{$list[p]['timestr']}--></td>


    <td>
 
    <!--{if $list[p]['status']==1}-->
    <a href="javascript:void(0);" onclick="javascript:DialogResetWindow('分红详情','index.aspx?mod=fenhong&code=info&time=<!--{$list[p]['time']}-->&uid=<!--{$list[p]['userid']}-->','800','400')">分红详情</a>
   <!--{else}-->
   -
   <!--{/if}-->
    </td>
       
        </tr>
        
        

                             		       <!--{/section}--> 
         
                                 <tr>
                                  <td>当页合计</td>
                                  <td><b><span id="ykcounts"><!--{$sum}--></span></b></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
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








