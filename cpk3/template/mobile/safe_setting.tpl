<!--{include file="<!--{$tplpath}-->head.tpl"}-->

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>



<!--{include file="<!--{$tplpath}-->navi.tpl"}-->


<div class='wap_list'>
<table style='line-height:40px;'>
<tr  onclick='location.href="home_safe_pass.html?mobile=1";'>
<td  style='width:45px;text-align:center;'>
<img src="<!--{$file_uri}-->/static/images/mobile/icon_pwd.png" height="25px">
</td>
<td >修改登陆密码</td>
<td style='width:30px;text-align:center;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>


<tr onclick='location.href="home_safe_pwd2.html?mobile=1";'>
<td  style='text-align:center;'>
<img src="<!--{$file_uri}-->/static/images/mobile/icon_pwd2.png" height="25px">
</td>
<td>修改资金密码</td>
<td style='text-align:center;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>



<tr onclick='location.href="home_safe_bankinfo.html?mobile=1";'>
<td  style='text-align:center;'>
<img src="<!--{$file_uri}-->/static/images/mobile/icon_bank.png" height="25px">
</td>
<td>银行卡管理</td>
<td style='text-align:center;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>


</table>
</div>



<div class='wap_list'>
<table style='line-height:40px;'>
<tr onclick='location.href="index_note.html?mobile=1";'>
<td  style='text-align:center;width:45px;'>
<img src="<!--{$file_uri}-->/static/images/mobile/icon_note.png" height="25px">
</td>
<td>系统通知</td>
<td style='text-align:center;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>


</table>
</div>


<div class='wap_list' onclick='alert("当前版本是免费版本");' >
<table style='line-height:40px;'>
<tr >
<td  style='text-align:center;width:45px;'>
<img src="<!--{$file_uri}-->/static/images/mobile/icon_fee.png" height="25px">
</td>
<td>免费声明</td>
<td style='text-align:center;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>


</table>
</div>


<div class='wap_list'>
<table style='line-height:40px;' onclick='location.href="home_safe_msg.html?mobile=1";'>
<tr >
<td  style='text-align:center;width:45px;'>
<img src="<!--{$file_uri}-->/static/images/email.png" height="25px">
</td>
<td>消息
    <!--{if $msg_num>0}-->
    <span class="badge"  style='background-color:#ff0000;margin-left:-10px;margin-top:-22px;' ><!--{$msg_num}--></span>
    <!--{/if}-->
</td>
<td style='text-align:left;width:25px;'><img src="<!--{$file_uri}-->/static/images/mobile/next.png" height="20px"> </td>
</tr>


</table>
</div>


<input type='button'  onclick='location.href="logout.aspx?mobile=1";' style='display:block;width:96%;margin:0 auto;background-color:#Ed4646;height:50px;line-height:50px;font-size:16px;text-align:center;color:#fff;' value='退出登陆'>




            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->
