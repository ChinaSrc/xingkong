

<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->
                    <div class="home_rec clearfix">

                  <form action="" method="get" name="frm_search" id="frm_search">

                  <input type="hidden" name='mod' value="<!--{$smarty.get.mod}-->">
                  <input type="hidden" name='code' value="<!--{$smarty.get.code}-->">
                    <input type="hidden" name='st' value="1">

                                 账号：

                                 <input style="width: 150px" class="textbox" name="username" type="text" id="username" value="<!--{$smarty.get.username}-->" size="20" />
       &nbsp;&nbsp;<input type="submit" class="button" value=" 查找 " />


                        </form>
                        <table style="border-bottom: 0px; border-right: 0px; border-top: 0px;" class="my_tbl my list_tbl"
                            border="0" cellspacing="0" cellpadding="0" width="100%">
                                    <tr>

                                <th align="center">账号

                                </th>

                                <th align="center">类型

                                </th>


                             <th align="center">下级人数

                                </th>
                                        <th align="center">余额

                                        </th>
                                <th align="center" >最近登录

                                </th>
                                <th align="center" >上级账号

                                      </th>

                                <th align="center"  >操作
                                </th>
                            </tr>

                                 <!--{foreach from=$user_list key=key  item=item}-->
                            <tr>

                                <td class="center">
                                    <!--{$item.username}-->
                                </td>
                                   <td align="center">

                                       <!--{$item.pre}-->级<!--{show_user_type($item)}-->
                                  </td>

                                <td class="center">
                                    <!--{if $item.next_num>0}-->
                                    <a href='home_user_list.html?st=2&username=<!--{$item.username}-->' style="    color: #d8292c;" ><!--{$item.next_num}--></a>

                                    <!--{else}-->

                                    <!--{$item.next_num}-->

                                    <!--{/if}-->
                                </td>
                                <td class="center">


               <!--{$item['amount'].total_amount}-->
                                </td>
          <td class="center">


               <!--{if $item.lastlogintime}--><!--{$item.lastlogintime}--><!--{else}-->-<!--{/if}-->
                                </td>
                              <td class="center">
                                <!--{$item['higherUser']}-->
                              </td>


                                <td  class="center">

                                    <a href="home_user_buy.html?st=3&username=<!--{$item.username}-->"><i class="icon-search" style="color:#3388ff;"></i></a>
                                    &nbsp;
                                    <a href="home_user_orders.html?st=3&username=<!--{$item.username}-->"><i class="icon-money" style="color:#3388ff;"></i></a>
                                    &nbsp;
                                    <a  href="javascript:DialogResetWindow('（<!--{$item.username}-->）返点','do.aspx?mod=ajax&code=show&list=content&flag=yes&active=user_rebates&id=<!--{$item['userid']}-->','420','330')"><i class="icon-edit" style="color:#3388ff;"></i></a>
                                 </td>
                            </tr>
                             		       <!--{/foreach}-->
                      

                        </table>


<DIV class="page">
<!--{$page}-->
</DIV>


                    </div>
                    <!--详细内容iframe-end-->


            </div>
        </div>


        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->












