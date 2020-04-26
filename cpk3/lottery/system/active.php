<?php

$type=$_GET['type'];

if(!$type) $type=key($arr_active);
$active=$rowss=getsql::sys();

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?>


<script type="text/javascript">

function set_tabs(name,num){




	for(var i=1;i<=3;i++){

if(i==num){
	document.getElementById(name+"_title_"+i).className='current';
	document.getElementById(name+"_con_"+i).style.display='block';
}else{

	document.getElementById(name+"_title_"+i).className='';
	document.getElementById(name+"_con_"+i).style.display='none';


}

		}


}




</script>

<div style='margin-top:5px;'>
	 <ul id="navlist">


	 <?php

	 foreach ($arr_active as $key =>$value) {


	 ?>
	<li><a <?php if($type==$key){?>class="current" <?php }?> id='info_title_1' href="?controller=system&action=active&type=<?php echo $key?>"><?php echo $value;?></a></li>

	<?php }?>

	 	 	    </ul>
 </div>

 	 <form method="POST" action="?action=save_post&active=system&flag=yes" enctype="multipart/form-data"  name="form" id="form">
         <table width="100%" border="0" cellpadding="4" cellspacing="1"  align=left   id='info_con_3' class="table_add"  >


             <?php
             if($type=='day'){

                 ?>
                 <tr >
                     <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                     <td width="80%" >
                         <div style='margin-left:5px;text-align:left'>
                             <input type=radio name="active_day_open" id="active_day_open1" value="1">启用
                             <input type=radio name="active_day_open" id="active_day_open2" value="0">停用
                         </div>
                     </td>
                     <script>var selGif='<?echo $active[active_day_open];?>';if(selGif=='1'){G('active_day_open1').checked=true;}else{G('active_day_open2').checked=true;}
                     </script>
                 </tr>



                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_<?php echo $type; ?>_pic"  type="file" size="15" value="">
                             <? if($active['active_'.$type.'_pic']){?>
                                 <a href='../<?php echo $active['active_'.$type.'_pic']?>' target='_blank'>查看</a>

                             <?php }?>
                         </div>

                     </td>
                 </tr>
                 <TR align=left>
                     <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每日领取时间</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_day_begin"  style='width:180px;'type="text" value="<?php echo $active['active_day_begin'];?>"  >后

                         </div>
                     </td>
                 </TR>

                 <TR align=left>
                     <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每日截止时间</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input  style='width:180px;'type="text" name="active_day_end" value="<?php echo $active['active_day_end'];?>"   >前

                         </div>
                     </td>
                 </TR>



                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>最低奖励VIP等级</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                          <select name="active_day_group">
                              <?php
                              $list=$db->fetch_all("select * from user_group order by score asc ,id asc");
                              foreach ($list as $value){

                                  ?>
                              <option value="<?php echo $value['id']?>" <?php if($active['active_day_group']==$value['id']) echo 'selected';?>><?php echo $value['title']; ?></option>

                              <?php

                              }
                              ?>


                          </select>

                           （刷新后生效）

                         </div>

                     </td>
                 </tr>
                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                     <td width="80%" >
                         <div style='margin-left:5px;text-algin:left;'>
                             <table style="width: 600px;text-align: center">
                                 <tr>
                                     <td>
                                         等级\昨日投注

                                     </td>

                                     <td>
                                         100+
                                     </td>
                                     <td>
                                         10000+
                                     </td>
                                     <td>
                                         200000+
                                     </td>
                                 </tr>


                             <?php
                             $row=$db->exec("select * from user_group where id='{$active['active_day_group']}'");
                             $list=$db->fetch_all("select * from user_group where score>='{$row['score']}' order by score asc");
                             foreach ($list as $value){
                                 ?>
                                 <tr>
                                     <td>
                                         <?php
                                         echo $value['title'];
                                         ?>

                                     </td>

                                     <td>
                                         <input type="number" min="0.1" max="5" step="0.1" required  name="active_day_0_<?php echo $value[id]?>"   value="<?php echo $active["active_day_0_".$value['id']]?>" style="width:
100px">%
                                     </td>
                                     <td>
                                         <input type="number"  min="0.1" max="5" step="0.1" required  name="active_day_1_<?php echo $value[id]?>"   value="<?php echo $active["active_day_1_".$value['id']]?>" style="width:
100px">%
                                     </td>
                                     <td>
                                         <input type="number"  min="0.1" max="5" step="0.1" required name="active_day_2_<?php echo $value[id]?>"   value="<?php echo $active["active_day_2_".$value['id']]?>" style="width:
100px">%
                                     </td>

                                 </tr>

                                 <?php
                             }
                             ?>


                             </table>
                         </div>

                     </td>
                 </tr>





                 <?php

             }



             ?>










 	                            <?php
 if($type=='lot'){
 ?>

           <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_lot_open" id="active_lot_open1" value="1">启用
					     <input type=radio name="active_lot_open" id="active_lot_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_lot_open];?>';if(selGif=='1'){G('active_lot_open1').checked=true;}else{G('active_lot_open2').checked=true;}
					</script>
				 </tr>

         <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <input name="active_lot_begin" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_lot_begin'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					  -
					    <input name="active_lot_end" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_lot_end'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >

					   </div>
					</td>
                  </tr>

                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_lot_pic"  type="file" size="15" value="">
<? if($active['active_lot_pic']){?>
 <a href='../<?php echo $active['active_lot_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>
				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每天免费抽奖次数</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_lot_time"  type="text" size="15" value="<?echo $active['active_lot_time'];?>">

					   </div>

					</td>
				 </tr>

				 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_lot_num"  type="text" size="15" value="<?echo $active['active_lot_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

					   </div>

					</td>
				 </tr>
				 			 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-algin:left;'>
<table>
<?php
	for ($i=0;$i<$active['active_lot_num'];$i++){
	?>
	<tr   style='height:30px;'>
	<td>当日充值>= <input name="active_lot_charge_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_lot_charge_'.$i];?>">元</td>
	<td  style='padding-left:80px;'>奖金最小 <input name="active_lot_min_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_lot_min_'.$i];?>">元</td>
    	<td style='padding-left:80px;'>奖金最大<input name="active_lot_max_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_lot_max_'.$i];?>">元</td>
	<td style='padding-left:80px;'>中奖概率 <input name="active_lot_pre_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_lot_pre_'.$i];?>">%</td>

	</tr>


	<?php }?>

</table>


					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_lot_con'><?echo $active['active_lot_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>








 	 <?php }?>
 	  <?php
 if($type=='bank'){
 ?>

         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_bank_open" id="active_bank_open1" value="1">启用
					     <input type=radio name="active_bank_open" id="active_bank_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_bank_open];?>';if(selGif=='1'){G('active_bank_open1').checked=true;}else{G('active_bank_open2').checked=true;}
					</script>
				 </tr>


                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_pic"  type="file" size="15" value="">
<? if($active['active_bank_pic']){?>
 <a href='../<?php echo $active['active_bank_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>

				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_date"  type="text" size="40" value="<?echo $active['active_bank_date'];?>">

					   </div>

					</td>
				 </tr>



				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>赠送金额</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_money"  type="text" size="15" value="<?echo $active['active_bank_money'];?>">元

					   </div>

					</td>
				 </tr>
<tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>最低充值金额</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_min"  type="text" size="15" value="<?echo $active['active_bank_min'];?>">元  (达到此金额才可参加领取)

					   </div>

					</td>
				 </tr>



				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每天最多领取人数</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_max"  type="text" size="15" value="<?echo $active['active_bank_max'];?>">人

					   </div>

					</td>
				 </tr>


				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>未充值用户最高提现金额</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_bank_sum"  type="text" size="15" value="<?echo $active['active_bank_sum'];?>">元

					   </div>

					</td>
				 </tr>

				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>介绍</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_bank_con'><?echo $active['active_bank_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>



  <?php }?>
 <?php
 if($type=='charge'){
 ?>

         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_charge_open" id="active_charge_open1" value="1">启用
					     <input type=radio name="active_charge_open" id="active_charge_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_charge_open];?>';if(selGif=='1'){G('active_charge_open1').checked=true;}else{G('active_charge_open2').checked=true;}
					</script>
				 </tr>




                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge_pic"  type="file" size="15" value="">
<? if($active['active_charge_pic']){?>
 <a href='../<?php echo $active['active_charge_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>

				 			 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge_date"  type="text" size="40" value="<?echo $active['active_charge_date'];?>">

					   </div>

					</td>
				 </tr>

				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>充值奖励额度</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge_pre"  type="text" size="15" value="<?echo $active['active_charge_pre'];?>">%（1表示充值100奖励1元）

					   </div>

					</td>
				 </tr>

				 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每小时领取人数</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge_sum"  type="text" size="15" value="<?echo $active['active_charge_sum'];?>">人

					   </div>

					</td>
				 </tr>
	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>24小时最低充值金额</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge_min"  type="text" size="15" value="<?echo $active['active_charge_min'];?>">元  (达到此金额才可参加领取)

					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_charge_con'><?echo $active['active_charge_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>



  <?php }?>

            <?php
 if($type=='fee'){
 ?>


          <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_fee_open" id="active_fee_open1" value="1">启用
					     <input type=radio name="active_fee_open" id="active_fee_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_fee_open];?>';if(selGif=='1'){G('active_fee_open1').checked=true;}else{G('active_fee_open2').checked=true;}
					</script>
				 </tr>
        <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <input name="active_fee_begin" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_fee_begin'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					  -
					    <input name="active_fee_end" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_fee_end'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >

					   </div>
					</td>
                  </tr>

                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_fee_pic"  type="file" size="15" value="">
<? if($active['active_fee_pic']){?>
 <a href='../<?php echo $active['active_fee_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>
				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>手续费领取金额比例</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_fee_pre"  type="text" size="15" value="<?echo $active['active_fee_pre'];?>">%（5表示手动充值100可领取5元手续费）

					   </div>

					</td>
				 </tr>

				 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>手续费最多领取</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_fee_max"  type="text" size="15" value="<?echo $active['active_fee_max'];?>">元

					   </div>

					</td>
				 </tr>

				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>充值方式</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  				    <?php
			  				    $bank_list=get_bank_list();
			  				    foreach ($bank_list as $value){
			  				    if($value!='系统充值'){
			  				    	?>

      <input type="checkbox"  name='active_fee_bank[]' value='<?php echo $value; ?>' <?php if(strpos($active['active_fee_bank'], $value)!==false) echo "checked";?> /><?php echo $value; ?> &nbsp;

<?php } } ?>



					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动描述</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;' name='active_fee_con'><?echo $active['active_fee_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>




 	      <?php }?>

 	       <?php
 if($type=='buy'){
 ?>

           <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_buy_open" id="active_buy_open1" value="1">启用
					     <input type=radio name="active_buy_open" id="active_buy_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_buy_open];?>';if(selGif=='1'){G('active_buy_open1').checked=true;}else{G('active_buy_open2').checked=true;}
					</script>
				 </tr>


                  	 <tr  align=left >
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_buy_pic"  type="file" size="15" value="">
<? if($active['active_buy_pic']){?>
 <a href='../<?php echo $active['active_buy_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>

					 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_buy_date"  type="text" size="40" value="<?echo $active['active_buy_date'];?>">

					   </div>

					</td>
				 </tr>


				 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每天结算时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_buy_time"  type="text" size="15" value="<?echo $active['active_buy_time'];?>">

					   </div>

					</td>
				 </tr>

				 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_buy_num"  type="text" size="15" value="<?echo $active['active_buy_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

					   </div>

					</td>
				 </tr>
				 			 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-algin:left;'>
<table>
<?php
	for ($i=0;$i<$active['active_buy_num'];$i++){
	?>
	<tr   style='height:30px;'>
	<td>当本人消费满  <input name="active_buy_xf_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_buy_xf_'.$i];?>">元</td>
	<td  style='padding-left:80px;display:none;'>本人奖励  <input name="active_buy_jl1_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_buy_jl1_'.$i];?>">元</td>
    	<td style='padding-left:80px;'>上级奖励  <input name="active_buy_jl2_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_buy_jl2_'.$i];?>">元</td>
	<td style='padding-left:80px;'>上上级奖励  <input name="active_buy_jl3_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_buy_jl3_'.$i];?>">元</td>

	</tr>


	<?php }?>

</table>


					   </div>

					</td>
				 </tr>

				 			 <tr  align=left >
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>黑名单</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:200px;width:700px;'name='active_buy_user'><?echo $active['active_buy_user'];?></textarea>

（用‘|’分割）

					   </div>

					</td>
				 </tr>


				 	 		 <tr  >
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_buy_con'><?echo $active['active_buy_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>







 	 <?php }?>


         <?php
         if($type=='sign'){
             ?>

                 <tr >
                     <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                     <td width="80%" >
                         <div style='margin-left:5px;text-align:left'>
                             <input type=radio name="active_sign_open" id="active_sign_open1" value="1">启用
                             <input type=radio name="active_sign_open" id="active_sign_open2" value="0">停用
                         </div>
                     </td>
                     <script>var selGif='<?echo $active[active_sign_open];?>';if(selGif=='1'){G('active_sign_open1').checked=true;}else{G('active_sign_open2').checked=true;}
                     </script>
                 </tr>


                 <tr  align=left >
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_sign_pic"  type="file" size="15" value="">
                             <? if($active['active_sign_pic']){?>
                                 <a href='../<?php echo $active['active_sign_pic']?>' target='_blank'>查看</a>

                             <?php }?>
                         </div>

                     </td>
                 </tr>

                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_sign_date"  type="text" size="40" value="<?echo $active['active_sign_date'];?>">

                         </div>

                     </td>
                 </tr>

                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>每天最低投注金额</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_sign_min"  type="text" size="40" value="<?echo $active['active_sign_min'];?>">

                         </div>

                     </td>
                 </tr>

                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>
                             <input name="active_sign_num"  type="text" size="15" value="<?echo $active['active_sign_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

                         </div>

                     </td>
                 </tr>
                 <tr  align=left>
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                     <td width="80%" >
                         <div style='margin-left:5px;text-algin:left;'>
                             <table>
                                 <?php
                                 for ($i=0;$i<$active['active_sign_num'];$i++){
                                     ?>
                                     <tr   style='height:30px;'>
                                         <td>累计签到<input name="active_sign_day_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_sign_day_'.$i];?>">天</td>
                                         <td  style='padding-left:10px;'>奖励  <input name="active_sign_money_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_sign_money_'.$i];?>">元</td>

                                     </tr>


                                 <?php }?>

                             </table>


                         </div>

                     </td>
                 </tr>



                 <tr  >
                     <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                     <td width="80%" >
                         <div style=margin-left:5px;text-algin:left>

                             <textarea style='height:300px;width:700px;'name='active_sign_con'><?echo $active['active_sign_con'];?></textarea>

                             （支持HTML）

                         </div>

                     </td>
                 </tr>








         <?php }?>


 	 <?php
 if($type=='plat'){
 ?>

         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_plat_open" id="active_plat_open1" value="1">启用
					     <input type=radio name="active_plat_open" id="active_plat_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_plat_open];?>';if(selGif=='1'){G('active_plat_open1').checked=true;}else{G('active_plat_open2').checked=true;}
					</script>
				 </tr>

        <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <input name="active_plat_begin" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_plat_begin'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					  -
					    <input name="active_plat_end" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_plat_end'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >

					   </div>
					</td>
                  </tr>

                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_plat_pic"  type="file" size="15" value="">
<? if($active['active_plat_pic']){?>
 <a href='../<?php echo $active['active_plat_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>
					 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_plat_num"  type="text" size="15" value="<?echo $active['active_plat_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

					   </div>

					</td>
				 </tr>
				 			 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-algin:left;'>
<table>
<?php
	for ($i=0;$i<$active['active_plat_num'];$i++){
	?>
	<tr   style='height:30px;'>
	<td>首次提现>=  <input name="active_plat_xf_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_plat_xf_'.$i];?>">元</td>
	<td  style='padding-left:80px;'>本人奖励  <input name="active_plat_jl1_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_plat_jl1_'.$i];?>">元</td>
    	<td style='padding-left:80px;'>上级奖励  <input name="active_plat_jl2_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_plat_jl2_'.$i];?>">元</td>
	<td style='padding-left:80px;'>上上级奖励  <input name="active_plat_jl3_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_plat_jl3_'.$i];?>">元</td>

	</tr>


	<?php }?>



</table>


					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_plat_con'><?echo $active['active_plat_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>



	 		<?php }?>
 	 <?php
 if($type=='charge1'){
 ?>

         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_charge1_open" id="active_charge1_open1" value="1">启用
					     <input type=radio name="active_charge1_open" id="active_charge1_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_charge1_open];?>';if(selGif=='1'){G('active_charge1_open1').checked=true;}else{G('active_charge1_open2').checked=true;}
					</script>
				 </tr>

        <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <input name="active_charge1_begin" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_charge1_begin'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					  -
					    <input name="active_charge1_end" class="Wdate" style='width:180px;'type="text" value="<?php echo $active['active_charge1_end'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >

					   </div>
					</td>
                  </tr>

                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge1_pic"  type="file" size="15" value="">
<? if($active['active_charge1_pic']){?>
 <a href='../<?php echo $active['active_charge1_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>
					 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge1_num"  type="text" size="15" value="<?echo $active['active_charge1_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

					   </div>

					</td>
				 </tr>
				 			 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-algin:left;'>
<table>
<?php
	for ($i=0;$i<$active['active_charge1_num'];$i++){
	?>
	<tr   style='height:30px;'>
	<td>每日首次充值>=  <input name="active_charge1_xf_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge1_xf_'.$i];?>">元</td>
	<td  style='padding-left:80px;'>本人奖励  <input name="active_charge1_jl1_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge1_jl1_'.$i];?>">元</td>
    	<td style='padding-left:80px;'>上级奖励  <input name="active_charge1_jl2_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge1_jl2_'.$i];?>">元</td>
	<td style='padding-left:80px;'>上上级奖励  <input name="active_charge1_jl3_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge1_jl3_'.$i];?>">元</td>

	</tr>


	<?php }?>

</table>


					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_charge1_con'><?echo $active['active_charge1_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>



  <?php }?>

 <?php
 if($type=='charge2'){
 ?>

         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_charge2_open" id="active_charge2_open1" value="1">启用
					     <input type=radio name="active_charge2_open" id="active_charge2_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_charge2_open];?>';if(selGif=='1'){G('active_charge2_open1').checked=true;}else{G('active_charge2_open2').checked=true;}
					</script>
				 </tr>

        <TR align=left>
                    <td width="20%" ><div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>活动时间</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					   <input name="active_charge2_begin" class="Wdate" style='width:180px;' type="text" value="<?php echo $active['active_charge2_begin'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					  -
					    <input name="active_charge2_end" class="Wdate" style='width:180px;' type="text" value="<?php echo $active['active_charge2_end'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >
					(累计充值金额只在活动结束时间统计一次)
					   </div>
					</td>
                  </tr>


                  	 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>封面图片</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge2_pic"  type="file" size="15" value="">
<? if($active['active_charge2_pic']){?>
 <a href='../<?php echo $active['active_charge2_pic']?>' target='_blank'>查看</a>

 <?php }?>
					   </div>

					</td>
				 </tr>
         <tr >
                    <td width="20%"  height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否结算</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="active_charge2_sum" id="active_charge2_sum1" value="1">开启
					     <input type=radio name="active_charge2_sum" id="active_charge2_sum2" value="0">关闭


					     （当系统时间大于活动结束时间，系统将自动结算，结算完毕，结算功能自动关闭，下次结算，需手动开启）
					   </div>
					</td>
					<script>var selGif='<?echo $active[active_charge2_sum];?>';if(selGif=='1'){G('active_charge2_sum1').checked=true;}else{G('active_charge2_sum2').checked=true;}
					</script>
				 </tr>
					 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则数量</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
			  <input name="active_charge2_num"  type="text" size="15" value="<?echo $active['active_charge2_num'];?>"> （如6表示下面显示6条奖励规则，刷新后生效）

					   </div>

					</td>
				 </tr>
				 			 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>奖励规则</div></td>
                    <td width="80%" >
					   <div style='margin-left:5px;text-algin:left;'>
<table>
<?php
	for ($i=0;$i<$active['active_charge2_num'];$i++){
	?>
	<tr   style='height:30px;'>
	<td>活动期间累计充值>=  <input name="active_charge2_xf_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge2_xf_'.$i];?>">元</td>
	<td  style='padding-left:80px;'>本人奖励  <input name="active_charge2_jl1_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge2_jl1_'.$i];?>">元</td>
    	<td style='padding-left:80px;'>上级奖励  <input name="active_charge2_jl2_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge2_jl2_'.$i];?>">元</td>
	<td style='padding-left:80px;'>上上级奖励  <input name="active_charge2_jl3_<?php echo $i;?>"  type="text" size="6" value="<?echo $active['active_charge2_jl3_'.$i];?>">元</td>

	</tr>


	<?php }?>
</table>


					   </div>

					</td>
				 </tr>


				 	 		 <tr  align=left>
                    <td width="20%"  height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>注意事项</div></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>

<textarea style='height:300px;width:700px;'name='active_charge2_con'><?echo $active['active_charge2_con'];?></textarea>

（支持HTML）

					   </div>

					</td>
				 </tr>



  <?php }?>




				 <tr  align=left>
                    <td width="20%"  height="25"></td>
                    <td width="80%" >
					   <div style=margin-left:5px;text-algin:left>
					    		    <input type="submit" class=button value="保存配置" type="submit"  id=submit name="submit">

					    		     </div>

					</td>
				 </tr>


                </table>





 	 </form>