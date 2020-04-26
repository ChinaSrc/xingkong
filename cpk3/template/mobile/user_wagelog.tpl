

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->



                  <form action="home_user_wagelog.html" method="get" name="frm_search" id="frm_search"
                        style='line-height:40px;padding-left:10px;padding-top:5px;'
                  >
                  


                            
                            <input name="begintime" class="Wdate" type="text" id="begintime" value="<!--{$begin}-->" size="18" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" style="width:150px;" />
                                    至 <input name="endtime" class="Wdate" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false})" id="endtime" value="<!--{$end}-->" size="18" style="width:150px;"/>
                   <br>  <input style="width: 100px"  placeholder="请输入用户名" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />

                      <select name='status'>
           <option value=''>不限</option>
           <!--{foreach from=$status_arr key=k item=value}-->
           
           <option value='<!--{$k}-->'  <!--{if strlen($smarty.get.status)>0 && $smarty.get.status eq $k}-->selected<!--{/if}-->><!--{$value}--></option>
           <!--{/foreach}-->
           </select>                      
       &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />

                        </form>                        

                            
                            <!--{if count($list)>0}-->
                                 <!--{section name=p loop=$list}-->






<div class='wap_list'  >

    <div class='item'  style='border-bottom:1px solid #d5d5d5;margin-bottom:5px;width:100%;'>


        <span style='font-size:16px;'><!--{$list[p].toname}--></span>

        <span style='color:#ff0000;padding-left:10px;'>
               <!--{$list[p].status_name}-->
           </span>


    </div>

   <div>  <!--{$list[p].money1}-->

            <span style='float:right;'> <span class='red'>  <!--{$list[p].money1}-->元</span></span>
        </div>



</div>









                             		       <!--{/section}--> 

                                  		    <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  

                            <!--{else}-->

                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="static/images/empty.png" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>
                

                            <!--{/if}-->

                 
                 

	
                     
                    </div>
                    <!--详细内容iframe-end-->
                    
                
            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 












