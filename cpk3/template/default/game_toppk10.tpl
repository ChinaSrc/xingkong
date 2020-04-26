<div class="row" id="ticket-base">
    <div class="main">
        <!--ticket-base-body start-->
        <div class="tb-body">
            <!--column start-->
            <div class="tb-b-column" id="ticket-base-info">

                <!--sub start-->
                <div class="tb-sub"    style=' width: 100px; height:71px;     background-color: #edf0f4;    border-radius: 8px 0 0 8px;'>

                    <!--image start-->
                    <div class="image" id="ticket-icon" >
                        <img src='<!--{$gameinfo['ico']|getFileUri}-->'  width='50px' />

                    </div>
                    <div style="height:25px;line-height: 25px;text-align: center;color:#222;"><!--{$gameinfo['fullname']}--></div>



                </div>
                <!--sub end-->
            </div>
            <!--column start-->
            <!--column start-->
            <div class="tb-b-column" id="ticket-cutdown"  >

                <!--sub start-->
                <div class="tb-sub" style='width:340px;'>

          <ul   style='display:none;' >
              <li class="ni"><span class="i1" id='current_status'><!--{$periodarrs.status}--></span></li>

              <li class="tm"><span id='current_titles'>截止时间:</span><font id="current_endtime"><!--{$periodarrs.lotendtime}--></font></li>
	      <li class="tm"><span id="lotfloatnum" hidden value='<!--{$periodarrs.lostnums}-->'></span>
	      </li>

</ul>


                    <div class="issue tc-refer title" style='width:100px;'>

                        <span>第<em id="current_issue"><!--{$periodarrs.lotpriod}--></em>期</span>
                        <span>距投注截止还有</span>

                    </div>
                    <!--title end-->
                    <!--cutdown-clock-base start-->
                    <div class="surplus-time" id="count_down"  >
    <div class="hh">00</div><div class="mm">00</div><div class="ss">00</div>
                    </div>
                    <!--cutdown-clock-base end-->
                    <!--voice-toggle start-->


                </div>
                <!--sub end-->
            </div>
            <!--column start-->
            <!--column start-->
            <div class="tb-b-column" id="ticket-cutdown">

                <!--sub start-->
                <div class="tb-sub"  style='width:550px;'>


                    <div class="sub tc-refer title"  style='margin-top:12px;width:85px;text-align:right;color:#666;line-height:20px;font-size:12px;'>
                     <span>    第<i id="last_issues"  style='color:#bb3838'><!--{$periodarrs[0].lotpriod}--></i>期</span>

                   <span >开奖号码  </span>
                    </div>
                    <!--title end-->
                    <!--viewer start-->
                    <div class="sub viewer ticker-drawing-viewer ticker-drawing-viewer-base" style='padding-top:7px;margin-left:10px;' >

                        <!-- <div class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading"> 开奖中-->
                        <div id="last_code" class="long_code"   <!--{if $game_type['skey']=='k3' || $game_type['skey']=='dp'}-->style='padding-left:50px;width:150px;'<!--{/if}-->>
                        <table border="0" cellspacing="0" cellpadding="0"><tbody><tr>
                        <td style="width:100%;padding-left:1px"><div  style="display:block;width:100%;clear:both;">
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span>
                        <span class="ball2">?</span></div>	</td></tr></tbody></table>
                        </div>
                    </div>
                    <!--viewer end-->
                    <!--option start-->
                    <div class="sub option">
                        <a href="index_chart.html?playkey=<!--{$game_type['ckey']}-->" class="tdl-o-chart short" target="_blank"><i>&nbsp;</i></a>
                        <a class="tdl-o-remark short"  href="index_wanfa.html?type=<!--{$game_type['skey']}-->"><i>&nbsp;</i></a>
                    </div>
                    <!--option end-->












                </div>
                <!--sub end-->
            </div>
            <!--column start-->
        </div>
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

