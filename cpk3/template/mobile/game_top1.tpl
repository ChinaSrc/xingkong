
<div style='padding-top:10px;background-color:#fff;padding-bottom:10px;'>
<table>
<tr>

<td style='text-align:center;padding-top:1px;display:none;'>
<div>
第<span id="current_issue"><!--{$periodarrs.lotpriod}--></span>期
</div>
      <div class="surplus-time11" id="count_down"  >
    <div class="hh">00</div><div class="mm">00</div><div class="ss">00</div>


</td>

<td>
       <div class="ticker-drawing-viewer "  >

                     <div>    第<i id="last_issues"  style='color:#ff0a09'><!--{$periodarrs[0].lotpriod}--></i>期开奖号码</div>




                        <div id="last_code" onclick='set_display("lottery11");'class="tdl-viewer-sub number tdl-vs-base"   <!--{if $game_type['skey']=='k3' || $game_type['skey']=='dp'}-->style='padding-left:50px;width:150px;'<!--{/if}-->>
                            <ul >
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li>
                            <li><span><i>?</i></span></li></ul>
                        </div>
                    </div>
</td>


</tr>


</table>


</td>
          <ul   style='display:none;' >
              <li class="ni"><span class="i1" id='current_status'><!--{$periodarrs.status}--></span></li>

              <li class="tm"><span id='current_titles'>截止时间:</span><font id="current_endtime"><!--{$periodarrs.lotendtime}--></font></li>
	      <li class="tm"><span id="lotfloatnum" hidden value='<!--{$periodarrs.lostnums}-->'></span>
	      </li>

</ul>
</div>


 <div class="cont cont-betting" id='lottery11'  style='display:none;'  onclick='set_display("lottery11");'>

        <div class="cont-body"  style='background-color:#f0f0f0;'>
            <div class="module" id="drawing-lite">



        
          
             <table>
   <tr>
                            <th  <!--{if $game_type['skey']=='pk10'}-->style='width:100px;'<!--{/if}-->>开奖期数</th>
                                <th  >开奖号码</th>


                        </tr>
                    <tbody id='historylot' >
                    
                    
                    		<!--{section name=p loop=$perlist}-->


		             <tr>
                            <td><span ><!--{$perlist[p].period}-->期</span></td>
                                <td  ><span ><!--{str_replace('</em><em>','</em>,<em>',$perlist[p].number1)}--></span></td>


                        </tr>
                <!--{/section}-->


                    </tbody>
                </table>
            </div>
            <!--module end-->




        </div>
    </div>


</div>
    <script type="text/javascript">
    function set_display(div){

    	if(document.getElementById(div).style.display=='none')
    	document.getElementById(div).style.display='block';
    	else
        	document.getElementById(div).style.display='none';
        }

    </script>
