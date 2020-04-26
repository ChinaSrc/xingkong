 <div id='buy_area' style="display:block;clear: both;">

<script>

    function setabs(num){

        var tabs=document.getElementsByName('tablist');
        var type=document.getElementsByName('zui_type');

        for(var i=0;i<tabs.length;i++){
            if(i==num){

                type[i].click();
                tabs[i].className='chase-tab-t current';
            }
            else{

                tabs[i].className='chase-tab-t';
            }

        }


    }

</script>


      <div id="lt_trace_box1"   style="display:none;margin-bottom: 20px;">

          <div class="chase-tab-title clearfix" >
              <ul >



                  <li class="chase-tab-t" onclick="setabs(0);"  name="tablist" >利润率追号</li>
                  <li class="chase-tab-t current" onclick="setabs(1);"  name="tablist" >普通追号</li>
                  <li class="chase-tab-t" onclick="setabs(2);"  name="tablist" >翻倍追号</li>
              </ul>
              <div style="float: right;width: 200px;">
                  <span id="isWinStop" class="bet-tips" style="position: relative; right: 10px; line-height: 20px; opacity: 1; font-weight: 900;">中奖即停<i></i></span>
                  <label class='pristop' style="padding-left: 2px;"><input type="checkbox" name="lt_trace_stop11" id="lt_trace_stop11" value="1" checked="checked"></label>
                  <label class='pristop'>中奖后停止追号</label>
              </div>
          </div>



          <div class="trace_cond" style="padding: 5px 10px;display: block;width: calc(100% - 20px);">
        
                <div  style='height:40px;line-height:40px;display: none;'>

                
                   <input  type="radio"  name="zui_type"  value="3"  onclick="select_zh('3');">利润率追号   &nbsp;
                       <input  type="radio"  name="zui_type"  value="2"  checked  onclick="select_zh('2');">同倍追号          &nbsp;
          <input  type="radio"  name="zui_type"  value="13"    onclick="select_zh('13');">翻倍追号
                &nbsp;&nbsp;&nbsp;

                </div>
        <div  style='height:40px;line-height:40px;'>
        
                  
                <input id='it_select_max' type='text' class="inpt" style='display:none'>
                     
              <label><b >追号期数：</b></label>
              
                <select id="lt_trace_qissueno" onChange="document.getElementById('zui_num').value=this.value;beginTimes(document.getElementById('zui_num').value,0);">
                  <option value="0">请选择</option>
            <!--{$lt_trace_qissueno}-->
                </select>        
                  <input id='all_period' class="inpt" type='hidden'>
                <label id='show_status' class="task_status"></label>

       
          
        
        
        
        </div>
        <div style='height:40px;line-height:40px;'>
        <b >追号计划：</b>
        <span  style='display:none;'>
            <label>起始期：</label>

                <select id="beginlot" onChange="get_beginlot(this.value);beginTimes(document.getElementById('zui_num').value,0);">


                </select>

        </span>


     <label>   起始倍数:</label><input type="text" id='bs_num' value='1' style='width:40px' onblur="is_number(this);beginTimes(document.getElementById('zui_num').value,0);">倍

          <span id="lt_trace_labelhtml"></span>

          <span >

      <input type="text" id='zui_num' value='1' style='width:40px;display: none;' onblur="check_zuinum();beginTimes(document.getElementById('zui_num').value,0);" >
          </span>


          <span  style='float:right;display: none;'>

              <a id='zui_sub' class='button' style='height:30px;line-height:30px;background: #D95625;border-radius: 5px;display: inline-block' onclick='zui_ok();'>
                  生成追号
                  <i class="icon-forward-3"></i>
              </a>
          </span>
        </div>




        </div>

        <div class="trace_list" id="lt_trace_issues" style=''>
	    <div id='task_html'  style='margin:8px;border-top: 1px solid #ccc;border-left: 1px solid #ccc;'>
	

	    </div>
	</div>

          <div  style="text-align: center;font-size: 16px; height:40px;line-height: 40px;">


              总期数：<span class="gamenum" id="lt_trace_count" >0</span> 期
              追号总金额：<span class="gamenum" id="lt_trace_hmoney11" >0</span> 元





          </div>
</div>


 </div>

 <div class="xcaik" id="messageDiv4" style="width: 400px;  top:30%; left: 50%; margin: 50px 0px 0px -200px; display: none;">
     <div class="top"><span class="pop_ico"></span><b>友情提醒</b><a onclick="document.getElementById('messageDiv4').style.display='none';"><img src="<!--{$file_uri}-->/data/uploads/xx.gif"></a></div>
     <div class="tips_box">
         <div class="tips_text">
             <div>
                 <table border="0" width="100%" cellpadding="0" cellspacing="0">
                     <tbody><tr><td style='width:70px;'><img id="messageimg" src="<!--{$file_uri}-->/static/images/wenhao.jpg"  style='height:65px;'></td>
                         <td id="message_con4" align="left">334343434</td></tr>
                     <tr>
                         <td colspan=2  style="text-align:center;">

                             <a class="buy_btn"  onclick="beginTimes(document.getElementById('zui_num').value,0);document.getElementById('messageDiv4').style.display='none';"  >确定</a>


                             <a class="cance_btn" onclick="document.getElementById('messageDiv4').style.display='none';"  id='cance_timer'>取消</a>

                         </td>
                     </tr>
                     </tbody>
                 </table>
             </div></div></div></div>