



<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />

        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">

                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->


                <div class="home_rec clearfix">
       
                  <form action="?mod=user&code=add&type=clickadd" method="post" name="frmAdd" id="frmAdd" >
                        <table style="border-bottom: 0px; border-right: 0px;" class="my_tbl" border="0" cellspacing="0" cellpadding="0" width="100%">
                         
                            <tr>
                                <td align="right">会员级别：
                                </td>
                                <td align="left"  valign="middle">&nbsp;&nbsp;

                                     <input type="radio" name="usertype"  checked="checked"  value="0" style='padding:0px;height:15px;'  onclick="set_type(this.value);"/>代理用户 &nbsp;
                                <input type="radio" name="usertype" value="1"style='padding:0px;height:15px;'  onclick="set_type(this.value);" />普通用户
                                              
                                                  
                                 
                                
                                                                </td>
                            </tr>                             
                            <tr>
                                <td align="right">用户名：  
                                </td>
                                <td align="left">
                                    &nbsp;&nbsp;<input type="text" class="basic_txt" name="username" id="username" value="" maxlength="16" />
                                    <span class="red">（由 0-9、a-z、A-Z 组成的6-16个字符）</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">登录密码：
                                </td>
                                <td align="left">
                                    &nbsp;&nbsp;<input class="basic_txt" type="password" name="password" id="password" value="" maxlength="16" />
                                    <span class="red">（由字母+数字组成，为了账户安全，请勿过于简单）</span>
                                </td>
                            </tr>
                  
                            <tr>
                                <td align="right">返点比例：
                                </td>
                                <td align="left">
                                <div id='fandian_1'>
                                  &nbsp;&nbsp;
                                  <select name='rebate'  id='rebate'>
                                  <!--{$rebate_select}-->
                                  </select>
                                
                                </div>
                       
                                  
                                </td>
                            </tr>                            
                                                                         
                   
                            <tr>
                            <td></td>
                                <td colspan="1" height="40" align="left">
                                    <input name="cmdAdd" type="submit" class="button" id="cmdAdd" value=" 添加会员 "  onclick="return user_add();" />
                                </td>
                            </tr>
                        </table>
                        
                         
                        
                    </form>
                    
                
                 
                 
                    <!--详细内容iframe-end-->
                    
                </div>

            </div>
        </div>
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 


<script type="text/javascript">

function user_add(){

if(	document.getElementById('username').value.length<6){
window.wxc.xcConfirm('用户名必须大于6位',window.wxc.xcConfirm.typeEnum.warning);
return  false;
	}
if(	document.getElementById('password').value.length<6){
	window.wxc.xcConfirm('密码必须大于6位',window.wxc.xcConfirm.typeEnum.warning);
	return  false;
		}


	
}


function set_type(value){

}




function set_display(id){
if(id==1){
	document.getElementById('fandian_1').style.display='block';

	document.getElementById('fandian_0').style.display='none';
	
}
else{
	document.getElementById('fandian_0').style.display='block';

	document.getElementById('fandian_1').style.display='none';
}
	}




                                            

</script>























