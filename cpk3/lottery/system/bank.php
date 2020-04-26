<?
 
$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}
 

$curpath = dirname($_SERVER["REQUEST_URI"]);//路径 (../ 
$curpath=str_replace("/","",$headpath);

?> 
<?$body_top_title="平台银行帐户管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");?> 
 
 
<table> <tr align="left" height=40>
          <td colspan="15" bgcolor="#FFFFFF">
		  &nbsp;<input type="button" class='button' onclick="winPop({title:'',width:'600',drag:'true',height:'600',url:'<?echo ROOT_URL."/".$AdminPath;?>/?controller=system&action=bank_add&active=new'})" value='添加帐号'>
		  &nbsp;&nbsp;<span style='color:#888888'>说明：每种银行只能添加一个帐号！</span> 
		  </td>
       </tr> 
       <tr align="center" bgcolor="#FFFFFF">
	      <th >显示顺序</th>
          <th bgcolor="#FFFFFF">银行名称</th>
          <th  bgcolor="#FFFFFF">充值方式</th>
                  <th  bgcolor="#FFFFFF">收款账户名</th> 
          <th bgcolor="#FFFFFF">银行账号</th>   
     

          <th  bgcolor="#FFFFFF">付款二维码</th> 
          <th  bgcolor="#FFFFFF">最低金额</th>
           <th  bgcolor="#FFFFFF">最高金额</th>

           <th  bgcolor="#FFFFFF">状态</th>
          <th bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../<?echo $headpath;?>/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="<?echo $playkey;?>" /> 
	   <?  
	       $sql_id="select * from system_bank order  by sortnum asc";
		   $result3=mysql_query($sql_id); 
           while($rows3=mysql_fetch_array($result3)){
               if($rows3['logo']) $logo="<img src='../{$rows3['logo']}' height='20px'>";
               else $logo='';
			      echo "<tr id='del14' align='center' bgcolor='#FFFFFF'>";  
				  echo "<td>".$rows3[sortnum]."</td>";
				  echo "<td>".$rows3[bankname]."</td>";
				  echo "<td>".$logo.$rows3[bank_branch]."</td>";
				  	  echo "<td>".$rows3[realname]."</td>";
				  echo "<td>".$rows3[banknum]."</td>";

				  if($rows3['ico']) $ico="<a href='../{$rows3['ico']}' target='_blank'>查看</a>";
			      else $ico='未上传';
				  echo "<td>".$ico."</td>";
               echo "<td>".$rows3[min]."元</td>";
               echo "<td>".$rows3[max]."元</td>";

			      if($rows3['status']==1)$status="启用";else $status="关闭";
				  echo "<td>".$status."</td>";
				  echo "<td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'',width:'600',drag:'true',height:'600',url:'".ROOT_URL."/".$AdminPath."/?controller=system&action=bank_add&id=".$rows3[id]."'})\">修改</a>&nbsp;&nbsp;<a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=system_bank&id=".$rows3[id]."'})\">删除</a></div></td>";
				  echo "</tr>";
		   }  
	   ?> 
	  </form>

  </table>
        <br>
<? include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");?>