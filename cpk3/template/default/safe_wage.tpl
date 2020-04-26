<!--{include file="<!--{$tplpath}-->head.tpl"}--> 


    <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css?v=122" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<!--{$file_uri}-->/<!--{$skinpath}-->2017/JS/MyCenter_Menu.js" ></script>




        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">

            <div id="main" class="clearfix">


                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->

                    <div class="home_rec clearfix">




<div class="userbox pd20s">
        <div class="tabNew">
            <ul class="tabUl f-cb">
                <li class="tabLi cur">我的日工资</li>
            </ul>
            <ul>
                <li>
                    <form>                        
                        <div class="textC2" style="padding-top:10px;">状态：<b id="dailypaystatus" class="green"><!--{if $wage['status']=='1'}-->启用<!--{else}-->停止<!--{/if}--></b>
                        <span class="f-fr">上级设定日期：<!--{date('Y-m-d',$wage['time'])}--></span></div>
                        <div class="f-cb formM2" style="padding:0 50px;">
                            <div class="usercon w50 fl_l">
                            
                                <div class="formMin textC2">
                                                
                       <!--{if $wage['type']=='auto'}-->  
                
                <!--{foreach from=$auto key=key item=item}-->
                
                <!--{if $item['num'] || $item[pre]}-->
                  <div>
                                                        设计<!--{$key}-->:
                                                        <span>日量</span>
                                                        <b><!--{$item['num']}-->万</b>
                                                        私返
                                                        <b><!--{$item['pre']}--></b> %
                                                    </div>
                                                
                                 <!--{/if}-->                      
            <!--{/foreach}-->   
            
            <!--{else}-->
                              <div>
                                                       每1万量<b><!--{$wage['fix']}--></b>元
                                                   
                                                    </div>
                                 <!--{/if}-->                   
                                                    
                                                
                                </div>
                            </div>
                            <div class="usercon w50 fl_l">
                                <div class="formMin">
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
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
