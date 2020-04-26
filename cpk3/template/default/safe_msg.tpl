

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
        <!--{if $con_system.IsSendMsg=='no'}-->
    <script>winPop({title:'温馨提示',type:'2',width:'400',iclose:'true',drag:'true',height:'90',url:'<div style="padding:20px;color:#ffffff;">该功能已关闭！</div>',next:3,goTo:'<!--{$root_url}-->'});</script>
<!--{/if}-->
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->
                    <div class="home_rec clearfix">



                 <div>
   <form method="POST" action="<!--{$this_url}-->&active=js" name="form1" id="form1"> 
  <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
  
  <table width="100%" border="0" cellspacing="1" cellpadding="4"  height=40px;>
  <form method="POST" action="<!--{$this_url}-->&active=js" name="form1" id="form1"> 
  <input name="isgetdata" id="isgetdata" value="yes" style='display:none'>
  <tr height=25 align="left">
     <td align="left" style='padding-left:5px;'>  
	<b>时间</b>：<input type="text" name="begindate" id="begindate" value="<!--{$begindate}-->" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
&nbsp;&nbsp;至
	 <input type="text" name="enddate" id="enddate" value="<!--{$enddate}-->" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd  HH:mm:ss',alwaysUseStartDate:false})" >&nbsp;
	 &nbsp;&nbsp;
	

	   
    <input type="submit" value="搜 索" class="button">

       &nbsp;&nbsp;
     <input type="button" value="发送消息" class="button" onclick="javascript:DialogResetWindow('发送消息','home_safe_msgsend.html?from=parent','800','410')">
<a href="home_safe_msg.html?type=delall" >

    <input type="Button" value="删除全部已读" class="button">
    
            </a>
   
     </td>
   </tr>
 </table>
  
                        </form>                        
                       <table width=100% border="0" cellspacing="1" cellpadding="1" class="my_tbl my list_tbl" style='margin:10px 0px;' align=center> 
  <tr class="table_b_th">
    <th > 消息标题</th>
    <th >发送人</th>
    <th>接收人</th>
        <th >时间</th>
    <th >状态</th> 
    <th >操作</th> 
</tr>
 <!--{if count($list)>0}-->
                                 <!--{foreach from=$list key=key item=item}-->   
                            <tr>
                             
                                <td class="center">
                           <a  onclick="javascript:DialogResetWindow('<!--{$item['title']}-->','home_safe_msginfo.html?id=<!--{$item.id}-->&from=parent','800','500')"><!--{$item['title']}--></a>
                              
                               
                                </td>
                                                                                                <td class="center">
                              
                     
 <!--{$item.fromname}-->
                                </td>
                                   <td align="center">
                                   
                                   <!--{$item.toname}-->
                                  </td>
                                

                                <td class="center">
                              
                     
               <!--{$item.creatdate}-->
                                </td>
              
                                  
             
                  
                         <td class="center">
                              
                     
               <!--{$item.read}-->
                                </td>
                    
                                <td  class="center">
                           
                             
                                   <a href="javascript:void(0);" class='info_btn'  onclick="javascript:DialogResetWindow('<!--{$item['title']}-->','home_safe_msginfo.html?id=<!--{$item.id}-->&from=parent','800','500')">阅读</a>
                                 <a href="home_safe_msg.html?type=del&id=<!--{$item['id']}-->" class='info_btn' >删除</a>
                                   
                                 </td>
                            </tr>
                             		       <!--{/foreach}--> 
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
                    </div>
                    <!--详细内容iframe-end-->
                    
                </div>
            </div>
        </div>
        
        
        
        
      <script type="text/javascript">

function del_msg(id){

	location.href='home_safe_msg.html?type=del&id='+id;
	
}


      
</script>  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 






