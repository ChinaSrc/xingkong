<?php
 need_admin(2);
$isproxy=$_GET['isproxy'];
$role=$_GET['role']; 
$pages=$_GET['pages']; 
 
$t_url = "?mod=user&code=admin_list";
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?> 
 
 
<table> <tr>
        
          <th bgcolor="#FFFFFF">用户名</th> 
          <th  bgcolor="#FFFFFF">管理组</th>



<th  bgcolor="#FFFFFF">账号状态</th>
          <th  bgcolor="#FFFFFF">添加时间</th>  
          
		  <th  bgcolor="#FFFFFF">操作</th>
       </tr>
     
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="<?echo $playkey;?>" />
       <tr >
          <td colspan="9" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;
      	       <a href="#" onclick="winPop({title:'添加管理员',form:'Form1',width:'800',height:'500',url:'?controller=user&action=admin_add'})">
	       添加管理员</a>	  </td>
       </tr> 
	   <?php  
		   
		   
           mysql_query("set names utf8;");

           $sqls="select * from user where admin=1 {$search} order by registertime desc limit $starnum,$maxnum"; 
	
           $results=mysql_query($sqls); 
		   $result2 = mysql_query("select count(*) from user where admin=1 {$search}") or die("未能读取，请刷新");  
		   $rows2=mysql_fetch_row($result2);$listnum=0; 
           while($rowss=mysql_fetch_array($results)){
           	$role=$db->exec("select * from `role` where id='{$rowss[admin_group]}'");
           	
           	?>
           	<tr bgcolor="#FFFFFF"  style='text-align:center;'>
           

  	<td><?php echo $rowss['username']?></td>    
  	  	<td><?php echo $role['name'];?></td>    
  
  	  	  	 
  	  	  		
  	  	  				<td><?php if ($rowss['status']==0) echo "正常";else echo "锁定";?></td>    
  	  	  	  	<td><?php echo date( 'Y-m-d H:i:s',strtotime($rowss[registertime]));?></td>   
  	  	  	  	<td>
  	  	  	  	
  	  	  	  	<a onclick="winPop({title:'<?php echo $rowss['username']?>日志',form:'Form1',width:'800',height:'500',url:'?controller=user&action=adminlog&userid=<?php echo $rowss[userid];?>'})"><font class='link_01'>查看日志</font></a>
  	  	  	  	   <a onclick="winPop({title:'编辑管理员信息',form:'Form1',width:'800',height:'500',url:'?controller=user&action=admin_add&id=<?php echo $rowss[userid];?>'})"><font class='link_01'>编辑</font></a>
				
                       
				 <a  onclick="put_del_user('<?php echo $rowss[userid];?>','<?php echo $rowss[username]; ?>');"><font class='link_01'>删除</font></a>
  	  	  	  	</td>    	
           </tr>	
           	<?php 
       
	              }
				  if($pername!=""){echo "<input id='search_name_isproxy_role' value='".$this_cur."' style='display:none'>";}
				  echo "<input id='urls' value='".$href."' style='display:none'>";
	   ?> 
	   </table>
	
  <div style='margin-left:10px;height:50px;line-height:50px;text-align:left'>
	 
	    <link href="<?echo ROOT_URL;?>/css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					<?   
					//echo $rows2[0]."======"; 
					$allnum=$rows2[0];  
					$pageurl=$t_url;
					$pagelist=$maxnum;
					include (ROOT_PATH."/source/plugin/pages.php");
					 
		            ?> 
	    </div> 
	</div>   
	  <script>
	   
	  function put_del_user(perid,pername){
		  var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		  return winPop({title:'删除管理员帐号',form:'Form',width:'300',height:'120',url:thisPathUrl+'/?action=dialog_simple&active=deluser&uid='+perid+'&pername='+pername+'&nexts=reload'})
	  }
</script>
