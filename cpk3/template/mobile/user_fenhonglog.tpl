<!--{include file="<!--{$tplpath}-->head.tpl"}-->

<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<!--{include file="<!--{$tplpath}-->navi.tpl"}-->



<form action="home_user_fenhonglog.html" method="get" name="frm_search" id="frm_search"   style='line-height:40px;padding-left:10px;padding-top:5px;'>

                      <select name='status'>
                          <option value=''>不限</option>
                          <!--{foreach from=$status_arr key=k item=value}-->

                          <option value='<!--{$k}-->'  <!--{if strlen($smarty.get.status)>0 && $smarty.get.status eq $k}-->selected<!--{/if}-->><!--{$value}--></option>
                          <!--{/foreach}-->
                      </select>

                      <input style="width: 100px" placeholder="请输入用户名" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
          

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

    <div class='item'  style='border-bottom:1px solid #d5d5d5;margin-bottom:5px;width:100%;padding-left:2%;padding-right:2%;margin-left:-2%;line-height:35px;height:70px;'>
        <div> 投注金额： <!--{$list[p].buy}-->

            <span style='float:right;'> 应发分红：<span class='red'>  <!--{number_format($list[p].money,3,'.','')}-->元</span></span>
        </div>


        <div>
            分红比例： <!--{$list[p].pre}-->

            <span style='float:right;'> 盈亏：<span class='green'>  <!--{$list[p].sum}--></span></span>
        </div>


    </div>
    <div>



    </div>
    <div>
       起始日期：       <!--{date('Y-m-d',$list[p].begintime)}-->-   <!--{date('Y-m-d',$list[p].endtime)}-->


    </div>
    <div style='height:30px;line-height:30px;;width:100%;text-align:center;'>

        <!--{if $list[p].status eq '2' && $list[p].money>0}-->

        <a class='info_btn' onclick="if(confirm('确定要发放契约吗? '))location.href='home_user_fenhonglog.html?type=fafang&id=<!--{$list[p].id}-->';">发放契约</a>

        <!--{/if}-->
        <a href="javascript:void(0);" class='info_btn' onclick="javascript:DialogResetWindow('设置契约','home_user_fenhong.html?uid=<!--{$list[p].toid}-->','800','400')">设置契约</a>

    </div>
</div>

<!--{/section}-->
                            <!--{else}-->

                <div class="drawing-table">
                        <div class="complete">
                            <div class="complete-sub image"> <span><img src="<!--{$file_uri}-->/static/images/empty.png" alt=""></span> </div>
                            <div class="complete-sub title">
                                <h2>呃...当前查询条件没有记录!</h2>
                            </div>
                        </div>
                </div>
                

                            <!--{/if}-->
                            

                 
                 

	
                     

<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 












