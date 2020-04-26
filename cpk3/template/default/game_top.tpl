<div class="row" id="ticket-base">

        <!--ticket-base-body start-->
        <div class=" tb-body">
            <!--column start-->

                <div class="tb-b-column" style='float: left; width:200px; margin-right:10px;margin-left:0px;line-height: 30px;text-align: center; color: #fff; font-weight: 600; text-align: center;'>
                    <div style="height:30px;line-height: 30px;text-align: center;color:#555;font-size:24px;"><!--{$gameinfo['fullname']}--></div>
                    <div class="image" id="ticket-icon" >
                        <img src='<!--{$gameinfo['ico']|getFileUri}-->'  height='90px' />

                    </div>





                </div>
            <ul   style='display:none;' >
                <li class="ni"><span class="i1" id='current_status'><!--{$periodarrs.status}--></span></li>

                <li class="tm"><span id='current_titles'>截止时间:</span><font id="current_endtime"><!--{$periodarrs.lotendtime}--></font></li>
                <li class="tm"><span id="lotfloatnum" hidden value='<!--{$periodarrs.lostnums}-->'></span>
                </li>

            </ul>


            <div class="tb-b-column" id="ticket-cutdown"  style='width:410px;'>

              <!--{if $game_type['show_nav2']==2}-->
             	<div style="text-align: center;line-height:100px;height: 30px;font-size: 30px;">
              		<span class="red" id="per_num1">彩种停售</span>
            	</div>  
              
               <!--{else}-->
              
 					<div class="showtitle">

    
                        <div   id="isbuy_title" <!--{if $periodarrs.isbuy neq 1}-->style='display:none;' <!--{/if}-->>距 <em id="current_issue" class="red"><!--{$periodarrs.period}--></em> 期 截止投注时间</div>
                        <div   id="isstop_title" <!--{if $periodarrs.isbuy eq 1}-->style='display:none;' <!--{/if}-->>第 <em id="current_issue2" class="red"><!--{$periodarrs.period}--></em> 期已封单</div>

                    </div>
                    <!--title end-->
                    <!--cutdown-clock-base start-->
                    <div class="surplus-time" id="count_down"  >

                    </div>
                    <div style="text-align: center;line-height:30px;height: 30px;font-size: 14px;">

                        今日已开<span class="red" id="per_num1"><!--{$periodarrs.num}--></span>期，剩余<span class="red" id="per_num2"><!--{$periodarrs.sum-$periodarrs.num}--></span>期


                    </div>
  
  		<!--{/if}-->

            </div>


            <div class="tb-b-column"  style='width:430px;margin-left:20px;position: relative;float: right;' >
              
			<!--{if $game_type['show_nav2']==2}-->
              	<div style="text-align: center;center;line-height:150px;height: 30px;font-size: 30px;">
              	<span class="red" id="per_num1"> </span>
                 </div> 
             <!--{else}-->
              	 
                <div class="showtitle">

                    <div  id="lottitle1">第 <em id="last_issues" class="red"></em> 期 开奖号码</div>
                    <div  id="lottitle2" style="display: none;">第 <em id="last_issues1" class="red"></em> 期 正在开奖</div>

                </div>
                <!--title end-->
                <!--viewer start-->
                <div class=" viewer ticker-drawing-viewer ticker-drawing-viewer-base" <!--{if $game_type['skey']!='k3'}-->style='margin-top:5px;'<!--{/if}-->>

                    <!-- <div class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading"> 开奖中-->
                    <div id="last_code" class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading <!--{if $game_type['skey']!='k3' || $game_type['skey']=='pk10' || $game_type['skey']=='kl8'}--><!--{$game_type['skey']}-->code<!--{/if}-->"  >
                    <ul >
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                    <!--{if $game_type['skey']!='k3' && $game_type['skey']!='dp'}-->
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>

                    <!--{/if}-->

                        <!--{if $game_type['skey']=='kl8'}-->
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                        <li><span><i></i></span></li>
                        <!--{/if}-->
                    </ul>
                        <!--{if $game_type['skey']=='pk10' || $game_type['skey']=='kl8'}-->
                        <ul >
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <!--{if $game_type['skey']=='kl8'}-->
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <li><span><i></i></span></li>
                            <!--{/if}-->

                        </ul>
                        <!--{/if}-->

                </div>
              </div>
            
            	
            <!--{/if}-->   
            

            <div id="J-lottery-info-status"  <!--{if $game_type['skey']=='k3'}-->style='margin-top:-2px;'<!--{/if}-->></div>

        </div>




    <!--column start-->
        <!--ticket-base-body end-->
    </div>

    <script type="text/javascript">
    function set_display(div){

    	if(document.getElementById(div).style.display=='none')
    	document.getElementById(div).style.display='block';
    	else
        	document.getElementById(div).style.display='none';
        }

    </script>

</div>

