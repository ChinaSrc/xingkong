<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet">
 
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/Jquery-1.5.1.js"></script>

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/common.min.js"></script>
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/Utility.min.js"></script>
    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/overlib_mini.js"></script>
    <script language="javascript" type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>
    <table width="100%" border="0" style="background: #ffffff;text-align:center;" cellspacing="0" cellpadding="0">       
        <tbody><tr>
            <td style="padding: 8px 8px 0 8px;">
                <table style="border-bottom: 0px; border-right: 0px; text-align:center;" class="my_tbl ft14" border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
         
                    <tr>
                        <td height="27" align="right">
                            订单号码：
                        </td>
                        <td height="27" align="left">
                          &nbsp;&nbsp; <!--{$funds['order_sn']}-->
                        </td>
                    </tr>                    
                    <tr>
                      <td align="right">提现金额：</td>
                      <td align="left">&nbsp;&nbsp;<span class="red"><!--{$funds['money']}--> 元</span></td>
                    </tr>
                    
                    <tr>
                      <td align="right">提现银行：</td>
                      <td align="left">&nbsp;&nbsp;
                   <!--{$funds['bankname']}-->

                      </td>
                    </tr>

                    <tr>
                      <td align="right">银行户名：</td>
                      <td align="left">&nbsp;&nbsp;<!--{$funds['realname']}--></td>
                    </tr>
                    <tr>
                        <td align="right">
                            银行账号：
                        </td>
                        <td align="left">&nbsp;&nbsp;<b class="blue"><!--{$funds['banknum']}--></b></td>
                    </tr>

                  <!--{if  $smarty.get.admin =='1'  && $funds['Man_remark']}-->
         <tr>
                        <td align="right">
                       备注：
                        </td>
                        
                        <td align="left">&nbsp;&nbsp;<!--{$funds['Man_remark']}-->
          
                       </td>
                    </tr>
                    <!--{/if}-->
                </tbody></table>        
        </td> </tr>
    </tbody></table>


</body></html>