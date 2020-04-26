

<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=123" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>

<script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>

<!--{include file="<!--{$tplpath}-->navi.tpl"}-->




                    <div class="wap_list">

    <form name="form" action="home_user_info.html?action=update&uid=<!--{$user['userid']}-->" method="post">

    <table class="table ">
        <tbody>


        <tr>



            <td    style='text-align:right;'><span >下级类型：</span>
            </td>
            <td style='text-align:left;'>
             <input type="radio" name="usertype"   value="0" style='padding:0px;height:15px;' <!--{if $user['isproxy'] neq '1'}-->checked="checked" <!--{/if}-->  />代理用户 &nbsp;
                                <input type="radio" name="usertype" value="1"style='padding:0px;height:15px;'  <!--{if $user['isproxy'] eq '1'}-->checked="checked" <!--{else}--> disabled <!--{/if}-->   />普通用户
            </td>


</tr>
        <tr>



            <td style='text-align:right;' ><span >下级账号：</span>
            </td>
            <td style='text-align:left;'>
             <!--{$user['username']}-->

             &nbsp;     &nbsp;     &nbsp;     &nbsp;

            </td>


</tr>


<tr>
            <td style='text-align:right;'><span>彩票返点：</span></td>
            <td  style='text-align:left;'>
            <select name='rebate'   >
            <!--{$select_list}-->

            </select>


            </td>
        </tr>

        <tr>

                                <td  height="40"   colspan='3' align='center'>
                                    <input name="cmdAdd" type="submit" class="button"  style='background-color:#ff0000;'value=" 确定修改  " onclick="return user_add();">

                                    &nbsp;    &nbsp;
                                    <input  type="button" onclick="window.history.go(-1); " class="button" value=" 取消  ">


                                </td>
                            </tr>
    </tbody></table>
    </form>



</div>

<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->