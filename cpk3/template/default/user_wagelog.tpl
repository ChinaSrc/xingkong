

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />




        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->




                <div class="home_rec clearfix">
        
                  <form action="home_user_wagelog.html" method="get" name="frm_search" id="frm_search">
                  
       
                        <table width="100%" border="0"  class="search_box">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
                                 用户名：
                            
                                 <input style="width: 150px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
                                     日期：<input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:150px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:150px;"/> 
                                 
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
                       
                                <th align="center">用户名
                          
                                </th>
                                
                                <th align="center">类型
                                               <!--{if $smarty.get.orderby eq 'status desc'}-->
                                <i class="arrow-up1" onclick="location.href='home_user_wagelog.html?orderby=status asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'status asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='home_user_wagelog.html?orderby=status desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='home_user_wagelog.html?orderby=status desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='home_user_wagelog.html?orderby=status asc';"></i>
                                             
                                <!--{/if}-->
                                
                                </th>
                                
                          
                                <th align="center">金额
                                                            <!--{if $smarty.get.orderby eq 'money1 desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=money1 asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'money1 asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=money1 desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=money1 desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=money1 asc';"></i>
                                             
                                <!--{/if}-->
                                
                                
                                </th>
                                  <th align="center">时间
                                               <!--{if $smarty.get.orderby eq 'time desc'}-->
                                <i class="arrow-up1" onclick="location.href='?orderby=time asc';"></i>
                                     
                                
                                <!--{else if $smarty.get.orderby eq 'time asc'}-->
                            
                                 <i class="arrow-down1" onclick="location.href='?orderby=time desc';"></i>
                                 
                                 <!--{else}-->
                                       <i class="arrow-up" onclick="location.href='?orderby=time desc';"></i>
                                
                                 <i class="arrow-down" onclick="location.href='?orderby=time asc';"></i>
                                             
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
                                   <td align="center">
                                   
                                   <!--{$list[p].status_name}-->
                                  </td>
                                
                                                                <td class="center">
                              
                     
 <!--{$list[p].money1}-->
                                </td>
                                <td class="center">
                              
                     
               <!--{date('Y-m-d',$list[p].time)}-->
                                </td>
              
                                  
             
                  
                    
                    
                                <td  class="center">
                           
                                   <a href="javascript:void(0);" class='info_btn' onclick="javascript:DialogResetWindow('彩票工资设定','home_user_wage.html?uid=<!--{$list[p].toid}-->','800','400')">工资设定</a>
                           
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
                            <div class="complete-sub image"> <span><img src="<!--{'static/images/empty.png'|getFileUri}-->" alt=""></span> </div>
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












