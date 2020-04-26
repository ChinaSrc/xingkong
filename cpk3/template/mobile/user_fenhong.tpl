


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=12121" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>
<style>

</style>

<div class="wap_list" style="border-radius: 5px;">




<div class="pd20s">
                <div class="f-cb">
                    用户名：<span class="" id="UserLoginID"><!--{$user['username']}--></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    状态：<span id="ContractState"><!--{if $fenhong['status']}--><!--{$status_arr[$fenhong['status']]}--><!--{else}-->未签订<!--{/if}--></span>

                </div>
                <div class="usercon">


<form action="home_user_fenhong.html?uid=<!--{$smarty.get.uid}-->&mobile=1" class="" id="CreateContractForm" method="post" novalidate="novalidate">

		<input name='status'  id='status'  type='hidden' value='<!--{if $fenhong['id']}--><!--{$fenhong['status']}--><!--{else}-->1<!--{/if}-->'>
                  <div class="f-cb">
                            <div class="usercon">
                                <ul class="tab_sohn w100" style='display:block;'>
                                    <li class="cur2">彩票契约</li>
                                </ul>
                                <div class="formMin" style='clear:both;'>
                                    <div>
                                        <div>
                                            <span class="">保底分红</span>
                                            <input class="inpMin bbIco text-box single-line" data-val="true"  id="NewFirstDividendRate" name="NewFirstDividendRate" style="display: none;" type="text" value=""> %
                                            <select id="pre_1" class="selectMin" name='pre'>
                                              <!--{assign var=j value=0}-->
<!--{section name=total1 loop=$pre_max}-->
 
  <option value="<!--{$j}-->"  <!--{if $wage['fix']==$j}-->selected<!--{/if}-->><!--{$j}-->%</option>
<!--{assign var=j value=$j+1}--> 

<!--{/section}-->       
                                            </select>
                                            <span class="field-validation-valid ValidationMessage font-p Validform_checktip" data-valmsg-for="NewFirstDividendRate" data-valmsg-replace="true" id="NewFirstDividendRateValidate"></span>
                                        </div>

                                    </div>
                                        <!--{assign var=i value=0}-->
<!--{section name=total loop=10}-->
<!--{assign var=i value=$i+1}-->
                                    
                                    <div id="rule<!--{$i}-->" style="display:<!--{if count($rule[$i]) neq '2'}-->none<!--{/if}-->;">
                               <!--{if count($rule[$i]) eq '2'}-->
                                方案<!--{$i}-->： <span> 周期累计投注额</span>
<input name="rule[<!--{$i}-->][num]" class="rule3 inpMin  text-box single-line" id="num_<!--{$i}-->"  style="width: 75px;" type="number" min="1" max="15000" step="1" value="<!--{$rule[$i]['num']}-->" data-val="true" data-val-regex-pattern="[0-9]+" data-val-regex="请输入有效数字，不可为负数。" data-val-number="请输入有效数字，不可为负数。">
万元，可获得 <input name="rule[<!--{$i}-->][pre]" class="rule3 inpMin bbIco text-box single-line" id="pre_<!--{$i}-->" type="text" value="<!--{$rule[$i]['pre']}-->" data-val="true" data-val-regex-pattern="[0-9]+(.[0-9]{0,2})?" data-val-regex="请输入有效数字，不可为负数。" data-val-number="请输入有效数字，不可为负数。"> %分红
                                
                                <!--{/if}-->
                                    </div>
<!--{/section}-->
                        
                                </div>

                                <div class="dataRow dataContract " style="padding-top:9px; font-weight:bold;">
                                    <a id="addrule" class="btn4" style="<!--{if $num eq '10'}-->display:none;<!--{/if}-->" onclick="add_tabs();">+增加方案</a>
                                    
                                    <a  id="deleterule" class="btn4" style="<!--{if $num eq '1'}-->display:none;<!--{/if}-->"onclick="delete_tabs();">-减少方案</a>
                                </div>






                            </div>
               


                        </div>
    </div>
                <div class="textCenter pd20" style="padding-bottom: 0px;clear:both;">


                    <input type="button" id="EditContract" value="修改契约" class="button" style="display: none;">
                    <!--{if $fenhong['status'] eq '1'}-->
                
                        
                    <input type="submit" id="CreateDividendContractSubmit" onclick="document.getElementById('status').value='3';"value=" 撤销契约申请 " class="button">
       
                    
                                <!--{elseif $fenhong['status'] eq '2'}-->
                       <input type="submit" id="CreateDividendContractSubmit" onclick="return check_sub(); "value=" 重新签订契约  " class="button">
                                 <!--{else}-->
                    
                       <input type="submit" id="CreateDividendContractSubmit" onclick="return check_sub(); "value=" 确认并且提交  " class="button">
                    <!--{/if}-->
                
                  
                    
                    
                 


                </div>





                <div class="text12">
                    说明：
                    <br>
                    1. 每月<!--{$con_system['fenhong_day']}-->日<!--{$con_system['fenhong_time']}-->结算一次 <br>  2. 方案契约分红时，请遵循由低至高的规律填写
                </div>
            </div>
								   </div>
							</div>                            
					
<script type="text/javascript">
var num=<!--{$num}-->;

function check_sub(){


	for(var i=2;i<=num;i++){
var j=i-1;
if(document.getElementById('num_'+i).value==''){

	document.getElementById('num_'+i).value='';
	document.getElementById('num_'+i).focus();
	 window.wxc.xcConfirm('请输入方案'+i+'的累计投注额',window.wxc.xcConfirm.typeEnum.warning);
  
     return false; 
	
	}


if(isNaN(document.getElementById('pre_'+i).value)){
	document.getElementById('pre_'+i).value='';
	document.getElementById('pre_'+i).focus();

   alert('请输入方案'+i+'的分红',window.wxc.xcConfirm.typeEnum.warning);
    
     return false; 

	}


if(i>2){
	if(document.getElementById('num_'+i).value<=document.getElementById('num_'+j).value){
		document.getElementById('num_'+i).focus();

	    window.wxc.xcConfirm('方案'+i+'的累计投注额必须大于方案'+j+'的累计投注额',window.wxc.xcConfirm.typeEnum.warning);

	    
	     return false; 

		}


	}
if(document.getElementById('pre_'+i).value<=document.getElementById('pre_'+j).value){
	document.getElementById('num_'+j).focus();
     if(i==2)   window.wxc.xcConfirm('方案2的分红必须大于保底分红',window.wxc.xcConfirm.typeEnum.warning);
     else  window.wxc.xcConfirm('方案'+i+'的分红必须大于方案'+j+'分红',window.wxc.xcConfirm.typeEnum.warning);
     return false; 

	}


		
	}


	
}


function add_tabs(){

if(num<=10){
	num++;
document.getElementById('rule'+num).style.display='block';

var html='方案'+num+'： <span> 周期累计投注额</span>'+
'<input name="rule['+num+'][num]" class="rule3 inpMin  text-box single-line" id="num_'+num+'"  style="width: 75px;" type="number" min="1" max="15000" step="1" value="" data-val="true" data-val-regex-pattern="[0-9]+" data-val-regex="请输入有效数字，不可为负数。" data-val-number="请输入有效数字，不可为负数。">'+
'万元，可获得 <input name="rule['+num+'][pre]" class="rule3 inpMin bbIco text-box single-line" id="pre_'+num+'" type="text" value="" data-val="true" data-val-regex-pattern="[0-9]+(.[0-9]{0,2})?" data-val-regex="请输入有效数字，不可为负数。" data-val-number="请输入有效数字，不可为负数。"> %分红';
document.getElementById('rule'+num).innerHTML=html;


}
if(num==10)
	document.getElementById('addrule').style.display='none';	

if(num>=2){
	document.getElementById('deleterule').style.display='';
	
}
}





function delete_tabs(){
	
	
	if(num>=2){
	document.getElementById('rule'+num).style.display='none';
	document.getElementById('rule'+num).innerHTML='';
	num--;
	}
	
if(num==1)
		document.getElementById('deleterule').style.display='none';	
	


if(num<10){
	document.getElementById('addrule').style.display='';	
	
}
	
	}

</script>


