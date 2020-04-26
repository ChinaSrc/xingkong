 <div id='buy_area' style="display:block;">




      <div id="lt_trace_box1"  style='display: none;'>
				 <div class="sub_head_top wap_title" >



<div class="title">

追号
</div>

                     <div class="signIn" style="width:40px;float:right;   position: absolute;right: 0px;top:7px;font-size:16px;font-weight:700;" onclick="zh_close1();">
                         返回
                     </div>

</div>


        <div class="trace_list" id="lt_trace_issues" >
	    <div id='task_html'  style="background-color:#fff;" >


	    </div>
	</div>
	<div style='position:fixed;bottom:45px;left:0px;right:0px;'>
        <div style="text-align: center;margin-bottom: 3px;">
            <div  class='zui_money'>


                <input id='it_select_max' type='text' class="inpt" style='display:none'>
                <input id='all_period' class="inpt" type='hidden'>
                <label id='show_status' class="task_status"></label>

            </div>

        </div>

	   <div class="trace_cond"  >

                <div  style='height:35px;line-height:35px;    background: #fafafa;border-bottom: 1px solid #ff4444;'>

                 <ul>
               <li onclick="select_zh('3');set_zuitabs(1);"  id='zui_tabs_1'>
               利润率追号
               </li>

                     <li onclick="select_zh('2');set_zuitabs(2);" id='zui_tabs_2' class='active'>
        同倍追号
               </li>
                     <li onclick="select_zh('13');set_zuitabs(3);" id='zui_tabs_3'>
              翻倍追号
               </li>

          </ul>

                </div>


        <div style='background-color:#fff;font-size:16px;color:#333;'>
        <div style='height:35px;line-height:35px;text-align:center;'>

        <span  style='display:none;'>
            <label>起始期：</label>

                <select id="beginlot" onChange="get_beginlot(this.value)">


                </select>

        </span>





        </div>
  <div style='height:40px;line-height:40px;text-align:center;display:none;' id="lt_trace_labelhtml"></div>

  <div style='height:35px;line-height:35px;text-align:center;'>

  </div>

  </div>

        </div>

	</div>



          <div style='position:fixed;bottom:0px;left:0px;right:0px;height:50px;background-color:#eee;'>



              <div class='navbar-nav'  >


                  <div class="btn"  onclick="zh_close1();" ><i class="icon-cancel-3"></i>取消</div>

                  <a class="btn" id="button2" style="display:none;">投注中....</a>



                  <div class='btn'   id="zui_sub"  onclick="zui_ok();"><i class="icon-forward-3"></i>生成</div>







                  <button class='quick_button' id='lt_sendok'	<!--{if $game_play=='1'}-->onclick="gamebuy();" <!--{else}-->onclick="alert('您是代理，请添加会员号再进行投注！');"<!--{/if}-->  >确认追号<i class="icon-ok-2"></i></button>



              </div>





</div>



      </div>


      	<div class="xcaik" id="messageDiv4" style="width:90%; position: fixed; top:180px; left: 5%; display: none;">
 <div class="top"><b>友情提醒</b><a onclick="document.getElementById('messageDiv4').style.display='none';"><img src="data/uploads/xx.gif"></a></div>
<div class="tips_box">
<div class="tips_text">
<div>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tbody><tr><td style='width:50px;'><img id="messageimg" src="/static/images/wenhao.jpg"  style='height:50px;'></td>
<td id="message_con4" align="left"></td></tr>
<tr>
<td colspan=2  style="text-align:center;">

      <a class="buy_btn"  onclick="beginTimes(document.getElementById('zui_num').value,0);document.getElementById('messageDiv4').style.display='none';"  >确定<i class="icon-ok-2"></i></a>


      <a class="cance_btn" onclick="document.getElementById('messageDiv4').style.display='none';"  id='cance_timer'>取消<i class="icon-cancel-3"></i></a>

</td>
</tr>
</tbody>
</table>
</div></div></div></div>

