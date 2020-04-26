


<!--{include file="<!--{$tplpath}-->head.tpl"}--> 
  <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/mycenter.css" type="text/css" rel="stylesheet" />


        <!--头部链接开始-->
        <!--主导航-->
        <div id="bd">
            <div id="main" class="clearfix">
                <!--{include file="<!--{$tplpath}-->user_top.tpl"}-->



                <div class="home_rec">

                            <div class="un_box">


                                    <!--{if strpos($bank['bankname'],'银行')===false}-->
                                <div class="selt_bank paynew" style="text-align: center">
                                    <div style="font-size:40px;font-weight: 600;height:50px;line-height: 50px;margin-bottom: 10px;">

                                        ￥<!--{$funds['money']}-->
                                    </div>
                                    <!--{if $bank['ico']}-->

                                    <img src="<!--{$bank['ico']|getFileUri}-->" alt="扫描二维码直接付款" style='width: 300px;'/>
                                    <!--{/if}-->
<div style="font-size: 16px;height:auto;line-height: 30px;">

    <!--{$config['charge_note2']}-->
</div>


                                    <div style="height:30px;line-height: 30px;margin-top:10px;">
<input type="button" class="button" value="我已支付" style="width: 200px;" onclick="location.href='home.html';">
                                    </div>

                                <!--手动充值第二步开始-->

<!--{else}-->
                                    <div class="selt_bank paynew" >

                                <div class="czhihk" >
                                
                                     <div class="czhihk1"  style='height:100px;'>
                                    <div style='float:left;'>
                                                                 <b>您的充值订单已提交,请及时汇款...</b><br />
                                        请在    <!--{$config['long_pay']}-->小时之内将现金汇到下面银行账户<br />
                                        <!--{if $bank['url']}-->
                                        <a href="<!--{$bank['url']}-->" target="_blank" class="qukan21">立即汇款</a>
                                        <!--{/if}-->
                                        <a href="index.aspx?mod=user&code=recharge" class="qukan1">查看充值记录</a>
                                        <a href="index.aspx?mod=report&code=index" class="qukan1">返回用户中心</a>
                                        </div>
                                        <div style='float:right;padding:5px;'>

                                           </div>
                                        </div>
                              
                                    <div class="czk"  style='height:250px;'>
                                            <div style='float:left;'>                                     
                                                <p>充值账号：<span class="org"><!--{$userinfo['username']}--></span></p>

                                                <p> 充值金额： <span class="org"><b><!--{$funds['money']}--></b></span> 元</p>
                                        <p>汇款银行：
                                          <a href="<!--{$bank['url']}-->" target="_blank" >
                                        <!--{if $bank['logo']}-->
                                        <img src="<!--{$bank['logo']|getFileUri}-->" alt="<!--{$bank['bankname']}-->" width='150px'  onload="if(this.height>40) this.height=40;"/>
                                        <!--{else}-->
                                        <!--{$bank['bankname']}-->
                                        <!--{/if}-->
                                        </a>
                                            <!--{if $bank['bank_branch']}-->
                                         （<!--{$bank['bank_branch']}-->）
                                        <!--{/if}-->
                                        </p>
                                        <p>汇款账号：<b><!--{$funds['banknum']}--></b>
                                            <input id="btncopycardnum" name="btncopycardnum" type="button" onclick="copyToClipboard('btncopycardnum','<!--{$funds['banknum']}-->');" value="复制内容" /></p>
                                        <p>汇款户名：<!--{$funds['realname']}-->
                                            <input id="btncopycardname" name="btncopycardname" type="button" onclick="copyToClipboard('btncopycardname','<!--{$funds['realname']}-->');" value="复制内容" /></p>
                               </div>
                                        <div style='float:right;padding:5px;text-align:center;'>
                                           <!--{if $bank['ico']}-->
                                           二维码支付<br>
                                           <img src="<!--{$bank['ico']|getFileUri}-->" alt="扫描二维码直接付款" width='190px'/>
                                             <!--{/if}-->
                                           </div>
                                        </div>
                                    </div>
                                </div>
								
								   <!--{if $bank['example']}-->
                                      
                                       <div class="czhihk">
                                    <div class="czhihk2">
                                        <p class="tt1">汇款图示</p>
                                        <div class="webpay">
                                            <img src="<!--{$bank['example']|getFileUri}-->" alt="" />
                                           
                                        </div>
                                    </div>
                                </div>
		
                                  
                                        <!--{/if}-->
								
                           
		
		
						</div>

                    </div>
                    <!--详细内容iframe-end-->
                    <!--{/if}-->
                </div>
            </div>
  
        <!--底部包含文件开始-->
<!--{include file="<!--{$tplpath}-->bottom.tpl"}--> 



    <script type="text/javascript">
        function copyToClipboard(id,txt) {

            var clip = new ZeroClipboard.Client();  
            ZeroClipboard.setMoviePath("<!--{$root_url}--><!--{$skinpath}-->2017/JS/ZeroClipboard.swf");
            clip.setHandCursor(true);   
            clip.setText(txt);  
            clip.addEventListener('complete', function () {  
                alert("复制成功");
            });  
            clip.glue(""+id+""); 
        }
    </script>



















