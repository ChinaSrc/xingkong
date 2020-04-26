<?php

$type=$_GET['type'];

if(!$type) $type='mbp';
$pay=$rowss=getsql::sys();

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
	<li><a <?php if($type=='mbp'){?>class="current" <?php }?> id='info_title_1' href="?controller=system&action=pay&type=mbp">摩宝支付</a></li>
    	<li><a <?php if($type=='ips'){?>class="current" <?php }?> id='info_title_1' href="?controller=system&action=pay&type=ips">环讯支付</a></li>
	 	 	    </ul>
 </div>

 	 <form method="POST" action="<?echo ROOT_URL."/".$AdminPath."/?action=save_post&active=system&flag=yes";?>" enctype="multipart/form-data"   name="form" id="form"> 
 
 	 
 	 
 	 
 	 
 	 <?php 
 if($type=='mbp'){
 ?>	
 <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left   id='info_con_1' > 
 	 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>支付名称</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_mbp_name"  type="text" size="40" value="<?echo $pay['pay_mbp_name'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
         <tr > 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="pay_mbp_open" id="pay_mbp_open1" value="1">启用
					     <input type=radio name="pay_mbp_open" id="pay_mbp_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $pay[pay_mbp_open];?>';if(selGif=='1'){G('pay_mbp_open1').checked=true;}else{G('pay_mbp_open2').checked=true;} 
					</script>
				 </tr>
 	 	 <tr > 
                    <td bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'><b>LOGO</b></div></td>
                    <td bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-align:left;'>
					     <input name="pay_mbp_logo" type="file" size="80" value="" > 
						 &nbsp;&nbsp;<font color='#777777'><?php echo $pay['pay_mbp_logo']?></font>
					   </div> 
					</td> 
				 </tr>  


				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>跳转URL</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_mbp_url"  type="text" size="40" value="<?echo $pay['pay_mbp_url'];?>">
					    （不填写默认网站内部跳转）
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>平台号</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_mbp_id"  type="text" size="40" value="<?echo $pay['pay_mbp_id'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
				 		 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>商户号</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_mbp_id"  type="text" size="40" value="<?echo $pay['pay_mbp_id'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>商户密钥</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_mbp_key"  type="text" size="40" value="<?echo $pay['pay_mbp_key'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 
</table>

  <?php }?>              
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 <?php 
 if($type=='ips'){
 ?>	
 <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left   id='info_con_1' > 
 	 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>支付名称</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_ips_name"  type="text" size="40" value="<?echo $pay['pay_ips_name'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
         <tr > 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'>是否启用</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-align:left'>
					     <input type=radio name="pay_ips_open" id="pay_ips_open1" value="1">启用
					     <input type=radio name="pay_ips_open" id="pay_ips_open2" value="0">停用
					   </div>
					</td>
					<script>var selGif='<?echo $pay[pay_ips_open];?>';if(selGif=='1'){G('pay_ips_open1').checked=true;}else{G('pay_ips_open2').checked=true;} 
					</script>
				 </tr>
 	 	 <tr > 
                    <td bgcolor="#FFFFFF" height="25"> <div style='height:20px;line-height:20px;text-align:right;margin-right:5px;'><b>LOGO</b></div></td>
                    <td bgcolor="#FFFFFF">
					   <div style='margin-left:5px;text-align:left;'>
					     <input name="pay_ips_logo" type="file" size="80" value="" > 
						 &nbsp;&nbsp;<font color='#777777'><?php echo $pay['pay_ips_logo']?></font>
					   </div> 
					</td> 
				 </tr>  


				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>跳转URL</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_ips_url"  type="text" size="40" value="<?echo $pay['pay_ips_url'];?>">
					  （不填写默认网站内部跳转）
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>商户编号</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_ips_sid"  type="text" size="40" value="<?echo $pay['pay_ips_sid'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>商户证书</div></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
			  <input name="pay_ips_skey"  type="text" size="40" value="<?echo $pay['pay_ips_skey'];?>">
					  
					   </div>
					   
					</td>
				 </tr>
				 
				 
				 
</table>

  <?php }?>              
           

 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 	 
 <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align=left   style='clear:both;'> 				 
				 <tr bgcolor="#A4B6D7" align=left> 
                    <td width="20%" bgcolor="#FFFFFF" height="25"></td>
                    <td width="80%" bgcolor="#FFFFFF">
					   <div style=margin-left:5px;text-algin:left>
					    		    <input type="submit" class=button value="保存配置" type="submit"  id=submit name="submit">
					    		    
					    		     </div>
					   
					</td>
				 </tr>

                   
                </table>
                
                
 	 
 	 
 	 
 	 </form>