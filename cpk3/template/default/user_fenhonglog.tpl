

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />

        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->



                <div class="home_rec clearfix">
        
                  <form action="home_user_fenhonglog.html" method="get" name="frm_search" id="frm_search">
                  
       
                        <table width="100%" border="0"  class="search_box">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
                                 用户名：
                            
                                 <input style="width: 150px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
          
           类型:<select name='status'>
           <option value=''>不限</option>
           <!--{foreach from=$status_arr key=k item=value}-->
           
           <option value='<!--{$k}-->'  <!--{if strlen($smarty.get.status)>0 && $smarty.get.status eq $k}-->selected<!--{/if}-->><!--{$value}--></option>
           <!--{/foreach}-->
           </select>                      
       &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />

       
                                    </td>
                                </tr>
                        </table>
                        </form>                        
                        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px;" class="my_tbl my list_tbl"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                       
                                <th align="center"  >账号
                          
                                </th>
                                
                                <th align="center">开始日期
                                               <!--{if $smarty.get.orderby eq 'begintime desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=begintime asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'begintime asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=begintime desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=begintime desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=begintime asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                                   
                                    <th align="center">结束日期
                                               <!--{if $smarty.get.orderby eq 'endtime desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=endtime asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'endtime asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=endtime desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=endtime desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=endtime asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                                       <th align="center">周期投注金额
                                               <!--{if $smarty.get.orderby eq 'buy desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=buy asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'buy asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=buy desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=buy desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=buy asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                                   
                                    <th align="center">盈亏
                                    
                                    
                                                     <!--{if $smarty.get.orderby eq 'sum desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=sum asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'sum asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=sum desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=sum desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=sum asc';"></i>
                                             
                                <!--{/if}-->
                                </th>
                                   
                                    <th align="center">分红比例
                                               <!--{if $smarty.get.orderby eq 'pre desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=pre asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'begintime asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=pre desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=pre desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=pre asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                                   
                                
                                
                        
                                
                          
                                <th align="center">应发分红
                                                            <!--{if $smarty.get.orderby eq 'money desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=money asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'money asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=money desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=money desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=money asc';"></i>
                                             
                                <!--{/if}-->
                                
                                
                                </th>
                                
                                    
                                
                                <th align="center">状态
                                               <!--{if $smarty.get.orderby eq 'status desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=status asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'status asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=status desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=status desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=status asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                          
                               
                              
                                <th align="center"  >操作
                                </th>
                            </tr>
                            
                            <!--{if count($list)>0}-->
                                 <!--{section name=p loop=$list}-->   
                            <tr>
                             
                                <td class="center">
                                    <!--{$list[p].toname}-->
                              
                               
                                </td>
                                
                                         <td class="center">
                              
                     
               <!--{date('Y-m-d',$list[p].begintime)}-->
                                </td>
                                
                                
                                         <td class="center">
                              
                     
               <!--{date('Y-m-d',$list[p].endtime)}-->
                                </td>
                                
                                                                <td class="center">
                              
                     
 <!--{$list[p].buy}-->
                                </td>    
                                                                                       <td class="center">
                              
                     
 <!--{$list[p].sum}-->
                                </td>    
                                
                                
                                                                    <td class="center">
                              
                     
 <!--{$list[p].pre}-->
                                </td>
                                
                                                                    <td class="center">
                              
                     
 <!--{number_format($list[p].money,3,'.','')}-->
                                </td>
                                   <td align="center">
                                   
                                   <!--{$list[p].status_name}-->
                                  </td>
                                
                            
                          
              
                                  
             
                  
                    
                    
                                <td  class="center">
                           <!--{if $list[p].status eq '2' && $list[p].money>0}-->
                           
                                <a class='info_btn'
                                
                                
                                 onclick="window.wxc.xcConfirm('发放分红<font color=red> <!--{number_format($list[p].money,3,'.','')}--></font>元给下级 <!--{$list[p].toname}-->，您确定要发放吗？',window.wxc.xcConfirm.typeEnum.confirm,{
            		
            						onOk: function(){
            						location.href='home_user_fenhonglog.html?type=fafang&id=<!--{$list[p].id}-->';
            						}
            					});">发放契约</a>
                           
                           <!--{/if}-->
                                   <a href="javascript:void(0);" class='info_btn' onclick="javascript:DialogResetWindow('设置契约','home_user_fenhong.html?uid=<!--{$list[p].toid}-->','800','400')">设置契约</a>
                           
                                 </td>
                            </tr>
                             		       <!--{/section}--> 
                            <tr>
                                <td class="page" colspan="10" style="padding: 8px;">
                                    
                                  		    <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  
                                </td>
                            </tr>
                            <!--{else}-->
                            <tr>
                            <td colspan="10">
                            
                            

                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="<!--{$file_uri}-->/static/images/empty.png" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>
                
                            </td>
                            
                            </tr>
                            
                            <!--{/if}-->
                            
                        </table>
                 
                 

	
                     
                    </div>
                    <!--详细内容iframe-end-->
                    
                
            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 












