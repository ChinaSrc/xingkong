<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/xssc.css" type="text/css" rel="stylesheet" />
    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=122" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>



<!--{include file="<!--{$tplpath}-->navi.tpl"}-->





<form style="height:300px;" action="home_safe_fenhong.html"  method='post' >

<input type='hidden' name='status' value='2'   id='status'>
            <div class="f-cb">
            
            
            <!--{if $fenhong['status'] eq '1'}-->
                    <div class="usercon ">
                    
                    
                                <ul class="tab_sohn ">
                                    <li class="cur2"><!--{if $fenhong['pre_temp']>0}-->新<!--{/if}-->彩票契约</li>
                                </ul>
                                <div class="formMin"  style='clear:both;'>

                                    <div><span>保底分红</span><b><!--{$fenhong['pre']}--> %</b></div>
                                    <!--{foreach from=$rule key=key  item=item}-->
                                    
                                        <div><span>方案<!--{$key}-->：  </span>周期销售额<b><!--{$item['num']}--></b> 万元，可获得  <b><!--{$item['pre']}-->%</b>分紅</div>
                                        
                                        
                                        <!--{/foreach}-->
                                </div>

                    </div>
                


                    <!--{if $fenhong['pre_temp']>0}-->
                    <div class="usercon ">
                            <ul class="tab_sohn w100">
                                <li class="cur2">旧彩票契约</li>
                            </ul>
                            <div class="formMin"  style='clear:both;'>

                                <div><span>保底分红</span><b><!--{$fenhong['pre_temp']}-->  %</b></div>
                                
                                    <!--{foreach from=$rule_temp key=key  item=item}-->
                                    
                                        <div><span>方案<!--{$key}-->：  </span>周期销售额<b><!--{$item['num']}--></b> 万元，可获得  <b><!--{$item['pre']}-->%</b>分紅</div>
                                        
                                        
                                        <!--{/foreach}-->
                            </div>
                    </div>
                    <!--{/if}-->
                    
<!--{/if}-->

            <!--{if $fenhong['status'] eq '2'}-->
                    <div class="usercon ">
                    
                    
                                <ul class="tab_sohn ">
                                    <li class="cur2"><!--{if $fenhong['pre_temp']>0}-->新<!--{/if}-->彩票契约</li>
                                </ul>
                                <div class="formMin"  style='clear:both;'>

                                    <div><span>保底分红</span><b><!--{$fenhong['pre']}--> %</b></div>
                                    <!--{foreach from=$rule key=key  item=item}-->
                                    
                                        <div><span>方案<!--{$key}-->：  </span>周期销售额<b><!--{$item['num']}--></b> 万元，可获得  <b><!--{$item['pre']}-->%</b>分紅</div>
                                        
                                        
                                        <!--{/foreach}-->
                                </div>

                    </div>
                    
                    <!--{/if}-->

                    <div class="usercon w50 fl_l">

                    </div>
                </div>
                
                  <!--{if $fenhong['status'] eq '1'}-->
                <div class=" pd20" style="padding-bottom:0;clear:both;margin:20px">
                    <input type="submit" id="ConfirmContract" value="同意<!--{if $fenhong['pre_temp']>0}-->新<!--{/if}-->契约"  onclick="return confirm('确定要同意契约吗? ');" class="button">
<!--{if $fenhong['pre_temp']>0}-->
                    &nbsp;
                    <input type="submit" id="RejectContract" value="拒绝<!--{if $fenhong['pre_temp']>0}-->新<!--{/if}-->契约"  onclick="return deny();" class="button">
                    <!--{/if}-->
                </div>
<!--{/if}-->



        </form>
        <div class="text12">
            说明：
            <br>
            1. 每月<!--{$con_system['fenhong_day']}-->日<!--{$con_system['fenhong_time']}-->结算一次 <br> 2. 设置契约分红时，请遵循由低至高的规律填写 <br>3. 契约分红将发送至您下级的站内聊天系统中
        </div>


                    </div>
                    <!--详细内容iframe-end-->
                    
        
            </div>
        </div>
        
        
        
        
    <script type="text/javascript">

function deny(){

var ss= confirm('确定要拒绝契约吗? ');
if(ss==true){
	document.getElementById('status').value=1;

	return true;
	
}else return false;
	
}


    
</script>    
        
        
        
        
        
        
        
        
        
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 
