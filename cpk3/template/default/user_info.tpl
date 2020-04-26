<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>编辑用户信息</title>
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=2123" type="text/css" rel="stylesheet">
	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body style="">
    
    <form name="form" action="home_user_info.html?action=update&uid=<!--{$user['userid']}-->" method="post">

    <table class="table table-hover">
        <tbody>


        <tr>
      
        
      
            <td align="left" colspan="2" ><span style='color:#ff7200'>下级类型：</span>
             <input type="radio" name="usertype"   value="0" style='padding:0px;height:15px;' <!--{if $user['isproxy'] neq '1'}-->checked="checked" <!--{/if}-->  />代理用户 &nbsp;
                                <input type="radio" name="usertype" value="1"style='padding:0px;height:15px;'  <!--{if $user['isproxy'] eq '1'}-->checked="checked" <!--{else}--> disabled <!--{/if}-->   />普通用户   
            </td>
    

</tr>        
        <tr>

        
      
            <td align="left" colspan="2"><span style='color:#ff7200'>下级账号：</span>
             <!--{$user['username']}-->  
             
             &nbsp;     &nbsp;     &nbsp;     &nbsp;           
        <span style='color:#ff7200'>当前奖金：</span>
             <!--{$user['modes']}-->             
            </td>
    
  
</tr>

</tbody>

</table>
    <table class="table table-hover">
        <tbody>
<tr>
            <td align="right"><b>彩票返点：</b></td>
            <td colspan="2">
            <select name='rebate'   >
            <!--{$select_list}-->
            
            </select>
            
         
            </td>
        </tr>  
        
        <tr>
                       
                                <td  height="40"   colspan='3' align='center'>
                                    <input name="cmdAdd" type="submit" class="button"  style='background-color:#ff0000;'value=" 确定修改  " onclick="return user_add();">
                                    
                                    &nbsp;    &nbsp;
                                    <input  type="button" onclick="parent.window.location.reload();" class="button" value=" 取消  ">
                                                                        
                                    
                                </td>
                            </tr>
    </tbody></table>
    </form>    
    
   


</body></html>