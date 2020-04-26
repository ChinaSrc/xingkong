

<!--{include file="<!--{$tplpath}-->head.tpl"}--> 

        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/plugins.css">
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/style.css">
        <!-- BEGIN PAGE CSS-->
        <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/main.css">
            <link rel="stylesheet" type="text/css" href="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/index.css">
            
                <link href="<!--{$file_uri}-->/<!--{$skinpath}-->2017/Css/welcome.css?v=1212134225" type="text/css" rel="stylesheet" />
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                         <div class="slideshow slideshow-kc" id="slideshow">
                <div class="slideshow-content">
     
				    <div id="banner">
			            <div class="banner-btn-bj">
				            <ul id="bannerBtn"></ul>
			            </div>
			            <div id="bannerMain<!--{if count($banner)==1}-->1<!--{/if}-->">
                               <!--{foreach from=$banner key=key item=item}--> 
                            <a href="<!--{$item['url']}-->">
					            <img src="<!--{$item['img']}-->" style="width:510px; height: 230px;"  />
					        </a>
                             <!--{/foreach}--> 
               
                            
			            </div>
		            </div>	
		
			
			
	<script type="text/javascript">
    $(function () {
        var t = n = count = 0;
        $(function () {
            count = $("#bannerMain a").size();
            for (var i = 1; i < count + 1; i++) {
                var newsli = "<li>" + i + "</li>"
                $('#bannerBtn').append(newsli);
            };
            $("#bannerBtn li").eq(0).addClass('cc');
            $("#bannerMain a:not(:first)").hide();
            $("#bannerBtn li").click(function () {
                $(this).addClass("cc").siblings("li").removeClass("cc");
                var i = $(this).text() - 1;
                n = i;
                if (i >= count) return;
                $("#bannerMain a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
            });
            t = setInterval("showAuto()",5000);
            $("#banner").hover(function () { clearInterval(t) }, function () { t = setInterval("showAuto()", 5000); });
        })
    });
    function showAuto() {
        n = n >= (count - 1) ? 0 : n + 1;
        $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
    }

    function showAuto1() {
        n = n ==0 ? (count - 1) : n -1;
        $("#bannerBtn li").eq(n).trigger("click").addClass("cc").siblings("li").removeClass("cc");;
    }
        new slider({id:'slider'})
	</script>
	

			
			
			
                </div>
         
                <div class="slideshow-option so-prev"><a href="javascript:showAuto1();">上翻</a></div>
                <div class="slideshow-option so-next"><a href="javascript:showAuto();">下翻</a></div>
            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-title">
                            <i class="icon-user"></i>
                            <div class="title">个人中心</div>
                        </div>
                        <div class="panel-body">
                            <div class="personal-center">
                                <div class="avatar">
                                    <div class="img">
                                        <img data-global="avatar" src="<!--{$file_uri}-->/<!--{$skinpath}-->wanbo/0.jpg">
                                    </div>
                           
                                </div>
                                <div class="details">
                                    <div class="item">
                                        <div class="text">账户名称：</div>
                                        <div data-global="username" class="value">             <!--{$cur_username}--></div>
                                   
                                    </div>
                               
                                    <div class="item">
                                        <div class="text">账户余额：</div>
                                        <div data-global="lotteryBalance" class="value">     <!--{$cur_amount}--></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-title">
                            <i class="icon-hot"></i>
                            <div class="title">热门游戏</div>
                        </div>
                        <div class="panel-body">
                            <div class="hot-game">
                                <div class="list">
                                  		     <!--{foreach from=$game_index key=key1 item=item1}-->
		    
    
    
    <div class="item">
                                        <a href="<!--{$root_url}-->game_<!--{$item1['id']}-->.html">      <img src='<!--{$item1['ico']}-->' height='50px' ><!--{$item1['fullname']}--></a>
                                    </div>

                           
    

    
    
	  <!--{/foreach}--> 
                                
                                
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                
                
                
                    <div class="panel">
                        <div class="panel-title">
                            <i class="icon-shield"></i>
                            <div class="text">安全等级</div>
                            
                        </div>
                        <div class="panel-body">
                            <div class="security-level">
                                <div class="rate-img">
                                    <div data-field="level1" class="rate s0">无</div>
                                </div>
                                <div class="details">
                                    <div class="rate-item">
                                        <div class="text">安全星级：</div>
                                        <div data-field="level2" class="rate s0"></div>
                                    </div>
                                    <div class="text-item">上次登录的IP：<span data-field="ip"><!--{$login['IPInfor']}--></span></div>
                                    <div class="text-item">上次登录地址：<span data-field="address">[<!--{$login['Adress']}-->]</span></div>
                                    <div class="text-item">上次登录时间：<span data-field="time"><!--{$login['creatdate']}--></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title">
                            <i class="icon-star"></i>
                            <div class="text">平台介绍</div>
                        </div>
                        <div class="panel-body">
                            <div class="platform-info">
                            
                            <!--{$config.contact}-->
                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-title">
                            <i class="icon-notice"></i>
                            <div class="text">系统公告</div>
                            <a href="index_note.html" class="more">更多</a>
                        </div>
                        <div class="panel-body">
                            <div class="system-notice-wrapper">
                                <div data-init="scroll" class="system-notice ps-container ps-theme-default" data-ps-id="ec4f66a2-a69f-2e8e-02db-28e94ae76483">
                                
                                
                                
                                <div class="hometipsbox">
                        <ul>
                        
                        
                        	   <!--{foreach from=$note key=key item=item}-->
                        	   
                        	   
                                <li>
                                    <p>
                                        <img alt="" src="static/images/a1.png">
                                        <!--{$item['title']}--><em><!--{date('Y-m-d',$item['time'])}--></em>
                                    </p>
                                    <span><!--{$item['content1']}--><a href="index_note.html?id=<!--{$item['id']}-->">[查看详情]</a></span>
                                </li>
                        	   
                        	   

		
		      <!--{/foreach}-->               
                                
                        
                        </ul>
                    </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                    <div class="list">
                                    
                                    	   <!--{foreach from=$note key=key item=item}-->
<div class="item">  
                                               <div class="title"><!--{$item['title']}--><div class="time">发布时间：<!--{date('Y-m-d',$item['time'])}--></div></div>         
                                                          <div class="content">&nbsp; &nbsp; &nbsp;<!--{$item['content']}--></div>                    </div>
		
		      <!--{/foreach}-->               
                                
                                    
                                    
   <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sys-notice-alert notice-show"  id="J_CP">
    <div class="w-title">平台最新公告</div>
    <div class="w-close"   onclick="document.getElementById('J_CP').style.display='none';" >×</div>
    <div class="content-list">
        <div class="title"><!--{$note[0]['title']}--></div>
        <div class="time"  style='width:100%;;'>发布时间：<span><!--{date('Y-m-d',$note[0]['time'])}--></span></div>
        <div class="content ps-container ps-theme-default" data-ps-id="fcd64dd1-db5d-c55e-bebd-d9823655d25d"><p>    <!--{$note[0]['content']}-->&nbsp; &nbsp; &nbsp;</p><div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    </div>
</div>










<!--{include file="<!--{$tplpath}-->bottom.tpl"}-->  
   



</body>
</html>


