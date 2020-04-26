


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=1221" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>


<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/jsAddress.js."></script>
<script language="javascript" type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Js/Bankinput.js"></script>


<div style='background-color:#fff;'>

						<div class="home_rec">
<div class="textCenter"><span id="displayDescendantLoginID" class="topCen1 topCenb">用户名：<!--{$user['username']}--></span><span id="displayStatus" class="topCen1">状态：<span id='status_name'><!--{if $wage['status']=='1' || !$wage['id']}-->正常<!--{else}-->停止<!--{/if}--></span></span></div>

		<div class="tabNew">
		<form action="home_user_wage.html?uid=<!--{$smarty.get.uid}-->" method="post">
		<input name='type'  id='type'  type='hidden' value='<!--{if $wage['type']}--><!--{$wage['type']}--><!--{else}-->auto<!--{/if}-->'>
				<input name='status'  id='status'  type='hidden' value='<!--{if $wage['id']}--><!--{$wage['status']}--><!--{else}-->1<!--{/if}-->'>
                        <ul class="tabUl f-cb">
                            <li id="auto_title" class="tabLi <!--{if $wage['type'] neq 'fix'}-->cur<!--{/if}-->"  onclick="set_tabs('auto');">消费比例方案</li>
                            <li id="fix_title" class="tabLi <!--{if $wage['type'] eq 'fix'}-->cur<!--{/if}-->" onclick="set_tabs('fix');">固定比例方案</li>                            
                        </ul>
                        <ul>
                            <li id="auto_con" style="display: <!--{if $wage['type'] neq 'fix'}-->list-item<!--{else}-->none<!--{/if}-->;">
                                <div class="f-cb formM2" id="PrivateReturnDIV">
                               
                                           
                                           
    <!--{assign var=i value=0}-->
<!--{section name=total loop=10}-->
<!--{assign var=i value=$i+1}-->

<!--{if ($i-1)%5 eq '0'}-->

     <div class="usercon w50 fl_l">
                                        <div class="formMin">
                                        <!--{/if}-->

                                                    <div>
                                                        设计<!--{$i}-->： <span>日量</span>
                                                        <input class="inpMin text-box single-line" min="1" max="1000" step='1' data-val="true" data-val-regex-pattern="^\d+$" name="auto[<!--{$i}-->][num]" type="number" value="<!--{$auto[$i]['num']}-->">万元
                                                        私返
                                                        <select class="inpMin bbIco"  name="auto[<!--{$i}-->][pre]" style="padding-right:0px;">
  <option value="0.0"></option>                                                  
    <!--{assign var=j value=0}-->
<!--{section name=total1 loop=15}-->
<!--{assign var=j value=$j+0.1}-->  
  <option value="<!--{$j}-->"  <!--{if $auto[$i]['pre']==$j}-->selected <!--{/if}-->><!--{$j}--></option>


<!--{/section}-->                                              

</select> 


    </div>
                  <!--{if $i%5 eq '0'}-->
                    </div>
                                    </div>
                                                    
                         <!--{/if}-->                                
<!--{/section}-->
                                                

                                                
                                                
                                                
                                      
                                   
                           
                                </div>
                            
                            </li>
                            <li id="fix_con" style="display:  <!--{if $wage['type'] eq 'fix'}-->list-item<!--{else}-->none<!--{/if}-->;">
                                <div class="f-cb formM2" id="FixedValueDIV">
                                    <div class="usercon w50 fl_l">
                                        <div class="formMin">
                                            <text>
                                                <div>
                                                    <span>每一万日量</span>
                                                    <select class="inpMin bbIco" style="width:80px;padding-right:0px;" id="fix" name="fix">
                                                       <!--{assign var=j value=0}-->
<!--{section name=total1 loop=15}-->
 <!--{if $wage['fix']-$j>=0 || !$wage['fix']}-->
  <option value="<!--{$j}-->"  <!--{if $wage['fix']==$j}-->selected<!--{/if}-->><!--{$j}--></option>
<!--{/if}-->

<!--{assign var=j value=$j+10}--> 


<!--{/section}-->       
                                                    </select>
                                                    元
                                                </div>
                                            </text>
                                        </div>
                                    </div>
                                </div>
                             
                            </li>
                        </ul>
                        
                            <div class="textCenter pd20" style="padding-bottom:0;clear:both;">
                                    <input type="submit" value=" 应 用  " class="button"   onclick='click_sub();';>
                                  <input type="button" value=" <!--{if $wage['status']=='1' || !$wage['id']}-->停用<!--{else}-->启用<!--{/if}--> " id='btn11'  onclick='set_status();' class="button">
                                </div>
                        		</form>
                    </div>					
				
								   </div>
							</div>                            
					
<script type="text/javascript">

function set_tabs(type){
if(type=='auto'){

	document.getElementById('auto_title').className='tabLi cur';
	document.getElementById('fix_title').className='tabLi';
	document.getElementById('auto_con').style.display='block';
	document.getElementById('fix_con').style.display='none';
	}
else{

	document.getElementById('auto_title').className='tabLi ';
	document.getElementById('fix_title').className='tabLi cur';
	document.getElementById('auto_con').style.display='none';
	document.getElementById('fix_con').style.display='block';
}
	
document.getElementById('type').value=type;
	
}


function set_status(){
if(document.getElementById('status').value=='1'){
	document.getElementById('btn11').value=' 启 用 ';
	document.getElementById('status_name').innerHTML='停用';

	document.getElementById('status').value=0;
}
else{
	document.getElementById('btn11').value=' 停 止 ';	
	document.getElementById('status_name').innerHTML='正常';

	document.getElementById('status').value=1;
}
	
}


function click_sub(){
var temp=0;
for(var i=1;i<=10;i++){

	var num=document.getElementsByName('auto['+i+'][num]');
if(num[0].value>0) {

temp++;

}
}

if(temp>5){

	 window.wxc.xcConfirm("消费比例方案最多设置5条!",window.wxc.xcConfirm.typeEnum.warning);
}
	

	}


</script>


