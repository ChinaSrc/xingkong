<div class="row" id="ticket-base">
    <div class="main">
        <!--ticket-base-body start-->
        <div class="tb-body">
            <!--column start-->
            <div class="tb-b-column" id="ticket-base-info">

                <!--sub start-->
                <div class="tb-sub"   style=' width: 100px; height:71px;     background-color: #edf0f4;    border-radius: 8px 0 0 8px;'>

                    <!--image start-->
                    <div class="image" id="ticket-icon" >
                        <img src='<!--{$gameinfo['ico']|getFileUri}-->'  width='70px' />

                    </div>


                </div>
                <!--sub end-->
            </div>
            <!--column start-->
            <!--column start-->
            <div class="tb-b-column" id="ticket-cutdown"  >

                <!--sub start-->
                <div class="tb-sub"  style='display:none;'>

          <ul   style='display:none;' >
              <li class="ni"><span class="i1" id='current_status'><!--{$periodarrs.status}--></span></li>

              <li class="tm"><span id='current_titles'>截止时间:</span><font id="current_endtime"><!--{$periodarrs.lotendtime}--></font></li>
	      <li class="tm"><span id="lotfloatnum" hidden value='<!--{$periodarrs.lostnums}-->'></span>
	      </li>

</ul>


                    <div class="issue tc-refer title">

                    <div  style="height:50px;line-height:50px;font-size:28px;color:#3388ff">

                              <span  style='display:none;'>第<em id="current_issue"><!--{$periodarrs.lotpriod}--></em>期</span>

                    </div>

                    </div>
                    <!--title end-->
                    <!--cutdown-clock-base start-->
                    <div class="surplus-time" id="count_down"   style='display:none;'>
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
                <div class="tb-sub"  style='width:860px;'>
          <span  style="height:60px;line-height:60px;font-size:30px;color:#3388ff;float:left;width:200px;text-align:right;">

<!--{$game_type['fullname']}-->
                    </span>

                    <div class="sub tc-refer title"  style='margin-top:12px;width:200px;text-align:right;color:#666;line-height:20px;font-size:12px;'>
                     <span>    第<i id="last_issues"  style='color:#ff0a09'><!--{$periodarrs[0].lotpriod}--></i>期</span>

                   <span >开奖号码  </span>
                    </div>
                    <!--title end-->
                    <!--viewer start-->
                    <div class="sub viewer ticker-drawing-viewer ticker-drawing-viewer-base" style="padding-left:40px;">

                        <!-- <div class="tdl-viewer-sub number tdl-vs-dice ks-tdl-loading"> 开奖中-->
                        <div id="last_code" class="tdl-viewer-sub number tdl-vs-base">
                            <ul >
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li></ul>
                        </div>
                    </div>






                    <div class="sub option">


                        <a href="index_chart.html?playkey=<!--{$game_type['ckey']}-->" class="tdl-o-chart" target="_blank">开奖走势<i>&nbsp;</i></a>
                        <a class="tdl-o-remark"   href="index_wanfa.html?type=<!--{$game_type['skey']}-->">新手指南<i>&nbsp;</i></a>

                    </div>




                </div>
                <!--sub end-->
            </div>
            <!--column start-->
        </div>
        <!--ticket-base-body end-->
    </div>

    <script type="text/javascript">
    function set_display(div){

    	if(document.getElementById(div).style.height=='35px')
    	document.getElementById(div).style.height='250px';
    	else
        	document.getElementById(div).style.height='35px';
        }

    </script>

</div>

