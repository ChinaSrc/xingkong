<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=2123" type="text/css" rel="stylesheet">
	<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>
	<style>
table{width:100%;text-align:center;}
table th{text-align:center;}
</style>
	<script type="text/javascript">


</script>
<div style='background-color:#fff;'>
    <form name="form" action="home_user_quota.html?action=update&uid=<!--{$user['userid']}-->" method="post">

    <table class="table table-hover">
        <tbody>

     
        <tr>

        
      
            <td align="left" colspan="2">下级账号： <!--{$user['username']}-->  
             
             &nbsp;     &nbsp;     &nbsp;     &nbsp;   
                      下级类型：<!--{show_user_type($user)}-->   
             &nbsp;     &nbsp;     &nbsp;     &nbsp;           
            奖金模式：<!--{$user['modes']}-->             
            </td>
    
  
</tr>

</tbody>

</table>
    <table class="my_tbl list_tbl">
        <tbody>
        
        <tr>
        <th>开户区段</th>
        <th>我的剩余配额</th>
        <th>下级剩余开户额</th>
        <th>增加(正数)、回收(负数)下级开户额</th>
        
        
        </tr>
        <!--{foreach from=$list key=key item=item}-->
        
<tr>
<td><!--{$key}--></td>

<td><!--{$item['num1']}--></td>
<td><!--{$item['num2']}--></td>

<td>

<input type="number" style='width:95%;text-align:center;'  name='num[<!--{$key}-->]' value='0' >
</td>
                            </tr>
                            
                            
                            <!--{/foreach}-->
                             
    </tbody></table>
    
    
    <div style='text-align:center;height:40px;margin-top:10px;'>
    
     <input name="cmdAdd" type="submit" class="button"  value=" 确定修改  " onclick=" check_sub223();">
                                    
                                    
                                    
                                    
                                    &nbsp;    &nbsp;
                                    <input  type="button" onclick="parent.window.location.reload();" class="button" value=" 取消  ">
                                        
    </div>
    
    </form>    
    

</div>


