<div class="separator"></div>
      <div class="game_add" id="lt_selbot" >


				 <div class="chuantong4" >


<div class="game_addline">

   您选择了 <b  id="lt_sel_nums" class="gamenum">0</b> 注,

    &nbsp;<span <!--{if $game_type['skey']=='k3'}-->style='display:none;'<!--{/if}-->>


         <span class='btn11 minus' title='减少'  onclick="add_times(-1);"  ></span><input type="text" class="num_input" value="1"  onclick="show_choose();" id="lt_sel_times" name="lt_sel_times" style="text-align:center;"  onkeyup="this.value=this.value.replace(/\D/g,'');IsMax_Times(this)" onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyPress=""><span class='btn11 plus' title='增加' onclick="add_times(1);"  ></span>
倍
    <div class="choose-list" style="display: none;">

        <!--{$bei_arr=array(1,5,10,20,50,100,200,500,1000,1500,2000,5000)}-->

        <!--{foreach from=$bei_arr key=key item=item}-->

        <a onclick="set_choose_value(<!--{$item}-->);"><!--{$item}--></a>

        <!--{/foreach}-->
    </div>

    <span class="mode" >







<select name="lt_project_modes" id="lt_project_modes"  onclick="select_mode11(this.value)" style="margin-left: 10px;">
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
   </span>




<select id='select_mode' onchange="Count_Money();" style="display: none">
        <option value='<!--{$modes}-->'><!--{$modes}-->-0%</option>
        <option value='1800'>1800-<!--{$fandian}-->%</option>
    </select>


    <span id='leftusermoney' style='display:none'></span>

    共<b  id="lt_sel_money" class="gamenum">0.00</b>元
    <b  id="lt_prize_money11" class="red" style='display:none;'>0</b>
    <b  id="lt_prize_money" class="red"  style='display:none;'>0.00</b>
    <b  id="prize_11" style='display:none;'>0.00</b>

    </span>


</div>



                     <div style="height:50px;line-height: 50px;clear: both;width: 100%;text-align: center;margin-top:10px">


                         <a id="lt_sel_insert" class="game_button1"  >加入购彩蓝</a>



                         <a href="javascript:void(0)" onclick="clear_sel();" style='color:#0c38da;display:none'  >清空选号</a>




                         <input hidden type="button" id="lt_sel_counts" name="lt_sel_counts" onclick="Count_Money();" style='display:none'>


                     </div>


				 </div>







      </div>
