<!--{include file="<!--{$tplpath}-->head.tpl"}-->
<link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />
<script src="<!--{$file_uri}-->/static/js/script_area.js"></script>


<div style='width:100%;height:280px;background:#FFFFFF;padding:5px 0px;'>
  <table width="100%" height=380 border="0" cellspacing="1" cellpadding="4" class='table_b'>
	<form action="<!--{$this_url}-->&doto=put&active=<!--{$active}-->&id=<!--{$smarty.get.id}-->" method="post" name="form1" id="form1">
	<input type='hidden' name='info' id='info' value='<!--{$u_bank.mark}-->'>
		<tr  class='table_b_tr_b'>
		   <td valign=middle>姓　　名：</td>
		   <td align=left>
		   <!--{if $realname}-->
		   <!--{$realname}-->
		      <input name="realname" id="realname" type="hidden" size=30 value="<!--{$realname}-->">
		   <!--{else}-->
		   <input name="realname" id="realname" type="text" size=30 value="">
        <!--{/if}-->
        <br>
		   </td>
		</tr>
		<tr  class='table_b_tr_b'>
			<td valign=middle>选择银行：</td>
			<td align=left>
				<select id="bankid" name='bankid'>
                  <!--{foreach from=$bank_list key=key item=item}-->
                <option value="<!--{$item['id']}-->" <!--{if $item['id']==$u_bank.bankid}-->selected<!--{/if}-->><!--{$item['name']}--></option>
                 <!--{/foreach}-->
				</select>


			</td>
		</tr>

		<tr  class='table_b_tr_b'>
			<td valign=middle>所在地区：</td>
			<td align=left>
				<select id="province" name='province'></select>
				<select id="city"  name='city'></select>
				<select id="area"  name='area' ></select>
				<script type="text/javascript">
                    addressInit('province', 'city', 'area','<!--{$u_bank.province}-->','<!--{$u_bank.city}-->','<!--{$u_bank.area}-->');
				</script>

			</td>
		</tr>

		<tr  class='table_b_tr_b'>
			<td valign=middle>支行名称：</td>
			<td align=left>
<input type="text" name="bankAdress" value="<!--{$u_bank.bankAdress}-->" id="bankAdress">
			</td>
		</tr>

		<tr  class='table_b_tr_b'>
		   <td valign=middle>卡　　号：</td>
		   <td align=left><input name="banknum" id="banknum" type="text" size=30 value="<!--{$u_bank.banknum}-->"  ><br>

		   </td>
		</tr>

		<tr  class='table_b_tr_b'>
			<td valign=middle>确认卡号：</td>
			<td align=left><input  id="banknum2" type="text" size=30 value="<!--{$u_bank.banknum}-->" >

			</td>
		</tr>

		<tr  class='table_b_tr_b' style="display: none;">
		   <td valign=middle>首 选 卡：</td>
		   <td align=left valign=middle><select name="is_first" id="is_first"><option value='no'>否</option><option value='yes'>是</option></select>

		   </td>
		   <script>selectSetItem(G('is_first'),'<!--{$u_bank.is_first}-->')</script>

		</tr>

<tr  class='table_b_tr_b'>
		   <td valign=middle>提现密码：</td>
		   <td align=left valign=middle>
	<input type="password" name='pwd' id='pwd' value=''>
		   </td>


		</tr>



		<tr height=40 align="center">
		<td></td>
		   <td align='left'>
		   <input type="submit" value="确定添加" type="submit"  id='submit'  class='button'  onclick="return click_sub();">

			  &nbsp; &nbsp; <a onclick="parent.Dialog.close();">关闭</a>
		   </td>
		</tr>
		</form>
	</table>
</div>


<script type="text/javascript">
var sub=false

function is_blank(number){



	   var xmlHttp;

	   	if(window.ActiveXObject){
	   		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	   	}
	   	else if(window.XMLHttpRequest){
	   		xmlHttp = new XMLHttpRequest();
	   	}

		xmlHttp.open('GET',"do.aspx?mod=ajax&code=blank&list=ok&number="+number,true);
		xmlHttp.onreadystatechange=function(){

			if(xmlHttp.readyState==4){
			var response=xmlHttp.responseText;
			 var str=response.split("|");

			if(str[0]=='ok'){
				sub=true

			}
			else {
				sub=false;

			}
			}


		};
		xmlHttp.send(null);

}
  
    function checkChinaname(str){
      	//return str.match( /^[\u4E00-\u9FA5a-zA-Z]{2,8}$/);  //只允许中文和字母; 
      	return str.match( /^[\u4E00-\u9FA5]{2,20}$/); //只允许中文
    }
  	function checkNum(str){
      	return str.match( /^[0-9]{2,20}$/); //只允许数字
    }
  
function click_sub(){
	if(document.getElementById('realname').value==''){

        parent.window.wxc.xcConfirm('请输入姓名',window.wxc.xcConfirm.typeEnum.warning);
		return false;
		}
  	if(!checkChinaname(document.getElementById('realname').value)){
      	 parent.window.wxc.xcConfirm('请输入中文姓名',window.wxc.xcConfirm.typeEnum.warning);
		return false;
		}

		if(document.getElementById('province').value.indexOf('选择')>0){

            parent.window.wxc.xcConfirm('请选择省份',window.wxc.xcConfirm.typeEnum.warning);
            return false;

		}

    if(document.getElementById('city').value.indexOf('选择')>0){

        parent.window.wxc.xcConfirm('请选择城市',window.wxc.xcConfirm.typeEnum.warning);
        return false;

    }

    if(document.getElementById('area').value.indexOf('选择')>0){

        parent.window.wxc.xcConfirm('请选择县区',window.wxc.xcConfirm.typeEnum.warning);
        return false;

    }

    if(document.getElementById('bankAdress').value==''){

        parent.window.wxc.xcConfirm('请填写开户行',window.wxc.xcConfirm.typeEnum.warning);
        return false;

    }
  	if(!checkChinaname(document.getElementById('bankAdress').value)){
      	 parent.window.wxc.xcConfirm('开户行填写错误',window.wxc.xcConfirm.typeEnum.warning);
         return false;
    }

	if(document.getElementById('banknum').value==''){

        parent.window.wxc.xcConfirm('请输入卡号',window.wxc.xcConfirm.typeEnum.warning);
		return false;
				}
	if(!checkNum(document.getElementById('banknum').value)){
        parent.window.wxc.xcConfirm('您输入的卡号不正确',window.wxc.xcConfirm.typeEnum.warning);
        return false;
       }
    if(document.getElementById('banknum').value.length<15){

        parent.window.wxc.xcConfirm('卡号的长度不能小于15',window.wxc.xcConfirm.typeEnum.warning);
        return false;
    }
// if(sub==false){
//     parent.window.wxc.xcConfirm('您输入的卡号不正确',window.wxc.xcConfirm.typeEnum.warning);
//     return false;
//
//
// }

    if(document.getElementById('banknum2').value!=document.getElementById('banknum').value){

        parent.window.wxc.xcConfirm('两次输入卡号不一致',window.wxc.xcConfirm.typeEnum.warning);
        return false;
    }
	if(document.getElementById('pwd').value==''){

		parent.window.wxc.xcConfirm('请输入提现密码',window.wxc.xcConfirm.typeEnum.warning);
		return false;
				}



	return true;

}

</script>
