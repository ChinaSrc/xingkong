<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <title>返点详情</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet">
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet">

</head>
<body style="background:#fff;">
<div class="ctshouguser" style="width:100%; border: 0;">
   <div style="padding:5px;">
    <table style="width:100%; background:#ccc; border-width:1px; ">
    
        <tbody><tr>
          <td style="text-align:center;  height:35px; background-color:#ebf1fc;"><b>序号</b></td>
          <td style="text-align:center; height:35px; background-color:#ebf1fc;"><b>用户名</b></td>
          <td style="text-align:center; height:30px; background-color:#ebf1fc;"><b>会员类型</b></td>
          <td  style="text-align:center; height:30px; background-color:#ebf1fc;"><b>返点</b></td>
        <td  style="text-align:center;  height:30px; background-color:#ebf1fc;"><b>投注总额</b></td>
          <td style="text-align:center;  height:30px; background-color:#ebf1fc;"><b>返点差</b></td>
          <td  style="text-align:center; height:30px; background-color:#ebf1fc;"><b>返点金额</b></td>
        </tr>

        <!--{section name=p loop=$bodylist}-->   
        
                <tr>
          <td style="text-align:center; height:30px; background-color:#ffffff;"><!--{$bodylist[p]['i']}--></td>
          <td style="text-align:center; height:30px; background-color:#ffffff;"><!--{$bodylist[p]['username']}-->(<!--{$bodylist[p]['next_num']}-->)</td>
          <td style="text-align:center; height:30px; background-color:#ffffff;"><!--{$bodylist[p]['pro']}--></td>
          <td style="text-align:center; height:30px; background-color:#ffffff;"><!--{$bodylist[p]['fandian']}-->%</td>

          <td style="text-align:center; height:30px; background-color:#ffffff;"><span id="cttzmoney"><!--{$bodylist[p]['sum']}--></span></td>

          <td style="text-align:center; height:30px; background-color:#ffffff;"><!--{$bodylist[p]['fandian_cha']}-->%</td>

    
          <td style="text-align:center; height:30px; background-color:#ffffff;"><span id="qwratemoney"><!--{$bodylist[p]['money']}--></span></td>
        </tr>
        
        

                             		       <!--{/section}--> 
        


        <tr style="background-color:#faf6f2;">
          <td colspan='4' style="text-align:left; height:30px;padding-left:20px; background-color:#ffffff;" >本页合计</td>

 
          <td style="text-align:center; height:30px; background-color:#ffffff;"><b><span id="ctratemoneycount"><!--{$sum['sum']}--></span></b></td>
              <td style="text-align:center; height:30px; background-color:#ffffff;"></td>
          <td style="text-align:center; height:30px; background-color:#ffffff;"><b><span id="qwratemoneycount"><!--{$sum['money']}--></span></b></td>
        </tr>
        <tr style="background-color:#faf6f2;">
            <td class="page" colspan="7" style="padding: 8px;">
            
     <!--{include file="<!--{$tplpath}-->block_page.tpl"}-->  
              </td>
            </tr>
        
    </tbody></table>
    </div>   
</div>


</body></html>








