<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet">
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet">
<style type="text/css"> 
body{font-size:12px;}
div{font-size:12px;}
td{font-size:12px;height:18px;}
th{font-size:12px;height:20px;}
</style>
</head>
<body style="background:#fff;">

<table height="450" width="100%" cellpadding="4" cellspacing="1" bgcolor="#dddddd">




<tbody>
<tr height="30"> 
<td width="20%" align="right" bgcolor="#FFFFFF" class="narrow-label" style="overflow:hidden">彩种:</td>
<td width="30%" align="left" bgcolor="#FFFFFF">
     <div style="word-wrap: break-word;word-break:break-all;"><!--{$info['game_name']}--></div>
</td>
<td width="20%" align="right" bgcolor="#FFFFFF" class="narrow-label">期号:</td>
<td width="30%" align="left" bgcolor="#FFFFFF"><!--{$info['period']}--></td>
</tr>
<tr height="30">
<td align="right" bgcolor="#FFFFFF" class="narrow-label">发起用户:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['user_name']}--></td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">发起时间:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['addtime']}--></td>
</tr>
<tr height="30">
<td align="right" bgcolor="#FFFFFF" class="narrow-label">方案金额:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['money']}-->元</td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">每份金额:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['premoney']}-->元</td>
</tr>
<tr height="30">
<td align="right" bgcolor="#FFFFFF" class="narrow-label">方案进度:</td>
<td align="left" bgcolor="#FFFFFF">
 <!--{$info['mebuy']}-->%<!--{if $info['baodi'] gt 0}-->+<!--{$info['baodi']}-->%<span class="red">(保)</span><!--{/if}-->
</td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">剩余份数:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['sum1']}-->份</td>
</tr>
<tr height="30">
<td align="right" bgcolor="#FFFFFF" class="narrow-label">合买状态:</td>
<td align="left" bgcolor="#FFFFFF">
<span class="red"><!--{$arr_hemai_status[$info['status']]}--></span>
</td>
<!--{if $info['status'] eq '0'}-->
<td align="right" bgcolor="#FFFFFF" class="narrow-label">结束时间:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['endtime']}--></td>


<!--{else}-->
<td align="right" bgcolor="#FFFFFF" class="narrow-label">中奖金额:</td>
<td align="left" bgcolor="#FFFFFF"><!--{$info['prize']}-->元</td>

<!--{/if}-->
</tr>


<tr>
<td class="narrow-label" align="right" valign="middle" bgcolor="#FFFFFF">投注内容:</td>
<td align="center" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;" valign='top' colspan="3">
<!--{if $view eq '1'}-->
<table  style='width:100%;line-height:25px;'>
<tr>
<td>玩法</td>
<td>金额</td>
<td>内容</td>

</tr>
    <!--{foreach from=$buyinfo key=key item=item}-->
    
    <tr>
    <td><!--{$item['wanfa']}--></td>
<td><!--{$item['money']}--></td>
<td><!--{$item['lines']}--></td>
    </tr>
    
    	  <!--{/foreach}-->

</table>
<!--{else if $view eq '2'}-->
认购后可见

<!--{else}-->

完全保密
<!--{/if}-->
</td>
</tr>

<tr>
<td class="narrow-label" align="right" valign="middle" bgcolor="#FFFFFF">认购记录:</td>
<td align="center" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;" valign='top' colspan="3">
<table  style='width:100%;line-height:25px;text-align:center;'>
<tr>
<td>用户</td>
<td>注数</td>
<td>时间</td>

</tr>
    <!--{foreach from=$hemai_list key=key item=item}-->
    
    <tr>
    <td><!--{$item['user_name']}--></td>
<td><!--{$item['num']}--></td>
<td><!--{$item['time']}--></td>
    </tr>
    
    	  <!--{/foreach}-->

</table>


</td>
</tr>

</tbody></table>



</body></html>








