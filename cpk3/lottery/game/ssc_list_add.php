<?php

$id=$_GET['id'];
mysql_query("set names utf8;");
if($_POST){
	
}


if($id!=""){
mysql_query("set names utf8;");
$sql="select * from game_ssc_list where id='$id'";
$ssc=$db->fetch_first($sql);

}


?>


<BODY bgColor=#FFFFFF> 


<TABLE cellSpacing=0 cellPadding=0 width=90% align=center border=0  class="table_add" style="margin-top:10px;">
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3>
      <form method="post" action="?action=save_post&flag=yes&active=ssc_list&iid=<?php echo $id;?>" > 

	  	  <input type="hidden" name="id" value="<?php echo $id;?>">
	  	  			 <input name="is_yes"  type="hidden" size="20" value="yes" >
      <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#fff" align=left> 
        <TR align=left>  
                    <td bgcolor="#FFFFFF">类别(code):</td>
                    <td  bgcolor="#FFFFFF">
                    
                    <?php 
                    
                                        $config=getsql::sys();	
                    		 if($config['game_qw']==2)  $where=" and  (ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';
                    ?>
                    <select  name='ckey'>
                    <?php 
   if($_GET['type']){
   	
    $code_list=$db->fetch_all("select * from game_code where  status='0' and pid='0' and type='{$_GET['type']}' {$where} order by  sortnum asc,id asc");
                   foreach ($code_list as $key=> $value) {
                   	
                   
                   ?>
          
                    <option value='<?php echo $value['ckey']?>'  <?php if($value['ckey']==$ssc['ckey']) echo  "selected";?>>&nbsp;&nbsp;&nbsp;<?php echo $value['fullname']?></option>
                    <?php 		
                     $code_list1=$db->fetch_all("select * from game_code where  pid='{$value['id']}' {$where}   order by sortnum asc,id asc");
                      foreach ($code_list1 as $key2=> $value2) {
                   	
                   
                   ?>
          
                    <option value='<?php echo $value2['ckey']?>'  <?php if($value2['ckey']==$ssc['ckey']) echo  "selected";?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value2['fullname']?></option>
                    <?php 
                   }
                    
                   }
   	
   }else{
                    foreach ($arr_game_code as $key1=>$value1){
                    
                    	?>
                    	
                    	<optgroup label="<?php echo $value1;?>"><?php echo $value1?></optgroup> 
                   <?php 
                   $code_list=$db->fetch_all("select * from game_code where  status='0' and pid='0' and type='{$key1}' {$where} order by sortnum asc, id asc");
                   foreach ($code_list as $key=> $value) {
                   	
                   
                   ?>
          
                    <option value='<?php echo $value['ckey']?>'  <?php if($value['ckey']==$ssc['ckey']) echo  "selected";?>>&nbsp;&nbsp;&nbsp;<?php echo $value['fullname']?></option>
                    <?php 		
                     $code_list1=$db->fetch_all("select * from game_code where  pid='{$value['id']}' {$where}   order by sortnum asc, id asc");
                      foreach ($code_list1 as $key2=> $value2) {
                   	
                   
                   ?>
          
                    <option value='<?php echo $value2['ckey']?>'  <?php if($value2['ckey']==$ssc['ckey']) echo  "selected";?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value2['fullname']?></option>
                    <?php 
                   }
                    
                   }
                   
                    }      
                   
                   }?>
                    </select>
                    
			
			
					</td>
					
					  <td  bgcolor="#FFFFFF">名称:</td>
                    <td  bgcolor="#FFFFFF">
					   <input name="fullname"  type="text" size="20" value="<?php echo $ssc['fullname'];?>" >
			
					</td>
                  </tr>
                  
                  
                          <TR align=left>  
           
					         <td bgcolor="#FFFFFF">类别名称（cate）:</td>
                    <td  bgcolor="#FFFFFF">
			 <input name="cate"  type="text" size="20" value="<?php echo $ssc['cate'];?>" >
			
					</td>
					  <td  bgcolor="#FFFFFF">简称（skey）:</td>
                    <td  bgcolor="#FFFFFF">
					   <input name="skey"  type="text" size="20" value="<?php echo $ssc['skey'];?>" >
			
					</td>
                  </tr>
              
                          <TR align=left>  
                   <td bgcolor="#FFFFFF">行数:</td>
                    <td  bgcolor="#FFFFFF">
			 <input name="shownum"  type="text" size="20" value="<?php echo $ssc['shownum'];?>" >
			
					</td>
					
					  <td  bgcolor="#FFFFFF">每行标题:</td>
                    <td  bgcolor="#FFFFFF">
					   <input name="title"  type="text" size="20" value="<?php echo $ssc['title'];?>" >
			
					</td>
                  </tr>
                  
                 
                          <TR align=left>  
                    <td bgcolor="#FFFFFF">起始数字:</td>
                    <td  bgcolor="#FFFFFF">
			 <input name="minnum"  type="text" size="20" value="<?php echo $ssc['minnum'];?>" >
			
					</td>
					
					  <td  bgcolor="#FFFFFF">结束数字:</td>
                    <td  bgcolor="#FFFFFF">
					   <input name="maxnum"  type="text" size="20" value="<?php echo $ssc['maxnum'];?>" >
			
					</td>
                  </tr>
                          <TR align=left>  
                    <td bgcolor="#FFFFFF">最少投注数量:</td>
                    <td  bgcolor="#FFFFFF">
			 <input name="min_select"  type="text" size="20" value="<?php echo $ssc['min_select'];?>" >
			
					</td>
					
					  <td  bgcolor="#FFFFFF">最大投注数量:</td>
                    <td  bgcolor="#FFFFFF">
					   <input name="max_select"  type="text" size="20" value="<?php echo $ssc['max_select'];?>" >
			
					</td>
                  </tr>
                  
                                <TR align=left> 
                                     <td bgcolor="#FFFFFF">键值:</td>
                    <td  bgcolor="#FFFFFF">

				   <input name="show_key"  type="text" size="20" value="<?php echo $ssc['show_key'];?>" >
					</td>
                                 
                    <td bgcolor="#FFFFFF">其他值:</td>
                    <td  bgcolor="#FFFFFF" colspan="1">
                    
                    					   <input name="show_other"  type="text" size="20" value="<?php echo $ssc['show_other'];?>" >
        
			
					</td>
				
                  </tr>
                  
      
                  
                              <TR align=left>  
               
					
					  <td  bgcolor="#FFFFFF">状态:</td>
                    <td  bgcolor="#FFFFFF" colspan="3">
                    <select name='status'>
                    <option value='0' <?php if($ssc['status']=='0') echo "selected";?> >开启</option>
                    <option value='1' <?php if($ssc['status']=='1') echo "selected";?> >关闭</option> 
                    </select>
				
			
					</td>
                  </tr>
                     
                          <TR align=left>  
            
					
					         
                    <td bgcolor="#FFFFFF">奖金:</td>
                    <td  bgcolor="#FFFFFF" colspan="3" >
			 <input name="prize"  type="text" size="80" value="<?php echo $ssc['prize'];?>" >
			
					</td>
			
                  </tr>
                  
     
                  
                                       <TR align=left>  
                    <td bgcolor="#FFFFFF">描述:</td>
                    <td  bgcolor="#FFFFFF" colspan="3">
                    	<textarea name="content"  rows="3" cols="80"><?php echo $ssc['content'];?></textarea>
                   
	
			
					</td>
				
                  </tr>
                                       <TR align=left>  
                    <td bgcolor="#FFFFFF">实例:</td>
                    <td  bgcolor="#FFFFFF" colspan="3">
                    
                    				
                    					<textarea name="example"  rows="3" cols="80"><?php echo $ssc['example'];?></textarea>
                    					
                    					
        
	
			
					</td>
				
                  </tr>
                                       <TR align=left>  
                    <td bgcolor="#FFFFFF">帮助:</td>
                    <td  bgcolor="#FFFFFF" colspan="3">
      
	<textarea name="help"  rows="3" cols="80"><?php echo $ssc['help'];?></textarea>
                    	
        
			
					</td>
				
                  </tr>
              
                  
                  
                  
				 
				 <tr bgcolor="#A4B6D7" align=left> 
				    <td colspan=4 bgcolor="#FFFFFF"><div style='height:30px;line-height:30px;text-align:center;margin:10px;'>
				    <input type="submit" class='button' value="保存配置" type="submit"  id='submit' name="submit">
						&nbsp;&nbsp; 
			    </div>
				    </td>
				 </tr> 
                   
                </table>
		
   </form> </TD>
    </TR>
  </TBODY>
</TABLE>