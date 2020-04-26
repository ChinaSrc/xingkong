

<span id='leftusermoney' style='display:none'></span>


<b  id="lt_prize_money11" class="red" style='display:none;'>0</b>

<b  id="prize_11" style='display:none;'>0.00</b>
<div style='width:100%;height:80px;clear:both;'>&nbsp;</div>

	<div class="clear"></div>
      <div class="game_add" id="lt_selbot" >


          <!--{if $game_type['skey']=='k3'}-->


          <div style='width:100%;height:40px;line-height:40px;text-align: left' class='bcp-option'  >

<div style="display: inline-block;padding-left: 10px">

             每注<input type="number" min="1" max="100" step="1" value="" id='per_money' style="text-align: center;width: 80px;" oninput="k3input(this.value);">元
</div>
              <div style="display: inline-block;padding-left: 25px;font-size: 14px">
                最高可中<b  id="lt_prize_money" class="red"  >0.00</b>元
              </div>
              <div class="mode" style="display: none" >


              <select id='select_mode' onchange="Count_Money();" style="display: none;" >
                  <option value='<!--{$modes}-->'><!--{$modes}-->-0%</option>
                  <option value='1700'>1700-<!--{$fandian}-->%</option>
              </select>



              <span class='btn11 minus' title='减少'  onclick="add_times(-1);" ></span>
              <input type="text" class="num_input" value="1" id="lt_sel_times" name="lt_sel_times" style="text-align:center;"  onkeyup="this.value=this.value.replace(/\D/g,'');IsMax_Times(this)" onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyPress="">
              <span class='btn11 plus' title='增加' onclick="add_times(1);" ></span>
              <label>倍</label>


              <ul  style='display:none;' >
                  <li class="active"  id='mode_yuan'   onclick="select_mode('yuan');">
                      元
                  </li>
                  <li id='mode_jiao' class=""  onclick="select_mode('jiao');">
                      角
                  </li>
                  <li id='mode_fen' class=""  onclick="select_mode('fen');">
                      分
                  </li>


              </ul>





              <select name="lt_project_modes" id="lt_project_modes"  onclick="Count_Money()"  style='display:none;'>
                  <option id='yuan' name='yuan' value='yuan' >元</option>
                  <!--{if $con_system.IsAngle=='yes'}-->
                  <option id='jiao' name='jiao' value='jiao'>角</option>
                  <!--{/if}-->
                  <!--{if $con_system.IsPoint=='yes'}-->
                  <option id='fen' name='fen' value='fen'>分</option>
                  <!--{/if}-->
                  <option id='li' name='li' value='li'>厘</option>
              </select>
              <script>selectSetItem(G('lt_project_modes'),'<!--{$modes}-->')</script>


              <input type="hidden" name="primode"  value='<!--{$userinfo['modes']}-->' />

              <font class='cou'>&nbsp;</font>
          </div>

      </div>


<div class='navbar-nav'  >


   <!--<div class="btn"  onclick=" select_auto(1);" id="randnumid" ><i class="navbar_random"></i>机选</div>-->
    <div class="btn"  onclick=" clear_sel();" id="clearid" style="display:none;"><i class="icon-trash" style="font-size: 24px"></i>清空</div>
    <div class="btn"  style="border-width: 0px;width: 37%;">
        共<em id="lt_sel_nums" style=" color: rgb(255, 163, 25);">0</em> 注，<em  style=" color: rgb(255, 163, 25);" id="lt_sel_money">0.00</em>    元
    </div>





    <button class='quick_button' style="display: none"  onclick="quick_buy=0;fast_buy();" >直接投注 <i class="icon-ok-2"></i></button>
    <input hidden type="button" id="lt_sel_counts" name="lt_sel_counts" onclick="Count_Money();" style='display:none'>
    <div id="lt_sel_insert" style="display: none" ><span >选号</span></div>
    <div class='betCart' onclick="k3buy();"   ><span >确认投注</span></div>
    <em id="lt_cf_count" style="display: none;color:#000;">0</em>

</div>








</div>





<!--{else}-->

<b  id="lt_prize_money" class="red"  style='display:none;'>0.00</b>

          <div style='width:100%;height:40px;line-height:40px;text-align: center' class='bcp-option'  >


              共<em id="lt_sel_nums" class="price">0</em> 注，<em class="price" id="lt_sel_money">0.00</em>    元


              <div class="moneyUnit"  onclick="set_mode11();"  <!--{if $game_type['skey']=='k3'}-->style='display:none;'<!--{/if}-->><a class="curr">元</a><a class="">角</a></div>

          <div class="mode" style="display: none" >


              <select id='select_mode' onchange="Count_Money();" style="display: none;" >
                  <option value='<!--{$modes}-->'><!--{$modes}-->-0%</option>
                  <option value='1700'>1700-<!--{$fandian}-->%</option>
              </select>



              <span class='btn11 minus' title='减少'  onclick="add_times(-1);" ></span>
              <input type="text" class="num_input" value="1" id="lt_sel_times" name="lt_sel_times" style="text-align:center;"  onkeyup="this.value=this.value.replace(/\D/g,'');IsMax_Times(this)" onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyPress="">
              <span class='btn11 plus' title='增加' onclick="add_times(1);" ></span>
              <label>倍</label>


              <ul  style='display:none;' >
                  <li class="active"  id='mode_yuan'   onclick="select_mode('yuan');">
                      元
                  </li>
                  <li id='mode_jiao' class=""  onclick="select_mode('jiao');">
                      角
                  </li>
                  <li id='mode_fen' class=""  onclick="select_mode('fen');">
                      分
                  </li>


              </ul>





              <select name="lt_project_modes" id="lt_project_modes"  onclick="Count_Money()"  style='display:none;'>
                  <option id='yuan' name='yuan' value='yuan' >元</option>
                  <!--{if $con_system.IsAngle=='yes'}-->
                  <option id='jiao' name='jiao' value='jiao'>角</option>
                  <!--{/if}-->
                  <!--{if $con_system.IsPoint=='yes'}-->
                  <option id='fen' name='fen' value='fen'>分</option>
                  <!--{/if}-->
                  <option id='li' name='li' value='li'>厘</option>
              </select>
              <script>selectSetItem(G('lt_project_modes'),'<!--{$modes}-->')</script>


              <input type="hidden" name="primode"  value='<!--{$userinfo['modes']}-->' />

              <font class='cou'>&nbsp;</font>
          </div>

      </div>


<div class='navbar-nav'  >


    <div class="btn"  onclick=" select_auto(1);" ><i class="navbar_random"></i>机选</div>

    <div class="btn"  id="lt_sel_insert" style="border-width: 0px;width: 37%;">
        <i class="icon-plus-circle" style="font-size: 24px;"></i><span>确认选号</span>
    </div>




    <a href="javascript:void(0)" onclick="clear_sel();" style='color:#0c38da;display:none'  >清空选号</a>

    <button class='quick_button' style="display: none"  onclick="quick_buy=0;fast_buy();" >直接投注 <i class="icon-ok-2"></i></button>
    <input hidden type="button" id="lt_sel_counts" name="lt_sel_counts" onclick="Count_Money();" style='display:none'>

    <div class='betCart'   onclick='show_shopcar();'>去投注<em id="lt_cf_count" style="display: none">0</em></div>

</div>








</div>





<!--{/if}-->













<div class="chuantong6"  id='shopcar' style="display: none;" >
				 <div class="sub_head_top wap_title" >


<div class="title">

<!--{$game_type['fullname']}-->投注
</div>
                     <div class="back"  onclick="show_shopcar();"><img src="<!--{$file_uri}-->/static/images/return(new).png" border="0"></div>

</div>

    <div class="cartTopbar">
        <span   id="isbuy_title1" <!--{if $periodarrs.isbuy neq 1}-->style='display:none;' <!--{/if}-->>
        <em id="current_issue11" ><!--{$periodarrs.period}--></em>期截止投注:
        </span>
    <span   id="isstop_title1" <!--{if $periodarrs.isbuy eq 1}-->style='display:none;' <!--{/if}-->>
           <em id="current_issue22" ><!--{$periodarrs.period}--></em> 期已封单:
       </span>
        <span id="tipstime" style="color:#dc3b40">00:00:00</span>
    </div>

<div class="someBtn">
    <a  onclick="show_shopcar();"><i class="icon-backward"></i>继续选号</a>
    <a onclick=" select_auto(1);"><i class="icon-plus"></i>机选1注</a>
    <a onclick=" select_auto(5);"><i class="icon-plus"></i>机选5注</a>
</div>





            <div class="bet_cont" id="lt_cf_content" name="lt_cf_content"></div>

				 <table  style='display:none;'>
				 <tr>
				 <td>
				 				       <div class="game_bet_area" >
        <div  class="bet_aleft">
	    <div class="tit">
	             <span class="tj">投注项：<b><font class='red'>0</font></b> &nbsp;&nbsp;
&nbsp;

				 <a href="javascript:void(0)"  onclick="clearsels();" class='tbn_clear'></a>
	    </div>
	  </div>

        </div>

				 </td>





				 </tr>
				 <tr>
				 <td colspan="3">

				          <div class="game_task" id="lt_game_task"   style='display:none;'>
    <div style='float:left;'>

           &nbsp;

           <!--{if $MMSSC neq '1'}-->
                          购买方式：<input  type="radio" id='lt_trace_stop' name="lt_trace_if"  value="1" checked="checked" onclick="addgametask(false,this);select_zh('1');">正常投注



	  <!--{else}-->
<input  type="radio" style='display:none;'id='lt_trace_stop' name="lt_trace_if"  value="1" checked="checked" onclick="addgametask(false,this);select_zh('1');">

&nbsp;<span style='font-size:16px;color:#3388ff;'>连续购买：</span><select  id='qi_num'>
<option value='1'>1期</option>
<option value='5'>5期</option>
<option value='10'>10期</option>
<option value='20'>20期</option>
<option value='50'>50期</option>

</select>

	  <!--{/if}-->
				         <select id="list_lot_num" style='display:none;'>
	       <!--{foreach from=$lotlistarrs key=arrkey item=arrtitle}-->
	           <option value='<!--{$arrtitle}-->'><!--{$arrtitle}--><!--{if $arrkey==0}-->(当前期)<!--{/if}--></option>
	       <!--{/foreach}-->
              </select>
              <span id='CurMode' style='display:none;'></span>

            <span id="lt_issues" style="display:none"></span>
            <span id="it_lot_num" style="display:none"></span>

    </div>


      </div>

				 </td>
				 </tr>
				 </table>


<div style='position:fixed;bottom:0px;left:0px;right:0px;height:90px;'>


<div style="background-color:#fff; height:90px;border-top:1px #ddd solid;">
    <div style="height:40px;line-height:40px;padding:0px 10px;text-align: center">
<div style="display: inline-block;width: 30%;text-align: center" >
    投 <input type="number" min="1" max="100" step="1" value="1" id='bs_num' style="text-align: center" oninput="is_number(this);check_beinum(this.value);"">倍


</div>

        <div style="display: inline-block;width: 38%;text-align: center" >

            投 <input type="number" min="1" max="100" step="1" value="1" id='zui_num' style="text-align: center" oninput="is_number(this);check_zuinum(this.value);">期


        </div>


        <div style="display: inline-block;width: 30%;float: right;" >
            <input type="checkbox" name="lt_trace_stop11" id="lt_trace_stop11" value="1" checked="checked"  style="height:20px;line-height: 20px;width:20px;">中奖即停


        </div>


        <span style="display: none" >

        追
        <select id="lt_trace_qissueno" onChange="document.getElementById('zui_num').value=this.value;beginTimes(document.getElementById('zui_num').value,0);">
            <option value="0">请选择</option>
            <!--{$lt_trace_qissueno}-->
        </select>


        <input type="checkbox"   style="display: none"  id="click_zhuihao"  onclick="addgametask(true,this);select_zh('2');" >
            余额：   <b id='newmoney' class="price"><!--{$cur_amount}--></b>元</span>


    </div>



    <div class='navbar-nav'  >


        <div class="btn" onclick="clearsels();"><i class="icon-trash" style="font-size: 24px"></i>清空</div>




        <div class='btn'  style="display: none"  onclick='document.getElementById("click_zhuihao").click();'><i class="icon-forward-3"></i>追号</div>


        <div style="display: inline-block;text-align: center;line-height: 20px;width: 38%;font-size: 14px;">
            <div style="height:20px;padding-top: 5px;line-height: 20px;color: #ffa319" >
                <span id="lt_cf_money" >0</span><span id="lt_trace_hmoney11" style="display: none" >0</span>元

               </div>
            <div style="height:20px;line-height: 20px;color: #fff;">

                <span id="lt_cf_nums" >0</span> 注
                <span id="lt_trace_count" >1</span>期
                <span id="lt_beinum">1</span>倍

            </div>




        </div>


        <div class='betCart' id='lt_sendok'	<!--{if $game_play=='1'}-->onclick="gamebuy();" <!--{else}-->onclick="alert('您是代理，请添加会员号再进行投注！');"<!--{/if}-->  ><!--{if $MMSSC neq '1'}-->确认投注<!--{else}-->立即购买<!--{/if}--> <i class="icon-ok-2"></i></button>



    </div>





</div>

    </div>

