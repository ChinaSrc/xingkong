<?php

$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
mysql_query("set names utf8;");
$sql1="select fullname,ckey from game_type where cate='gp' and status='0'";
$result1=mysql_query($sql1);
$numl=mysql_num_rows($result1);
$sqls="select * from prize_top";
$results=mysql_query($sqls);
$nums=mysql_num_rows($results);
$rowss=mysql_fetch_array($results);
;echo ' 
';$body_top_title="中奖排行";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 
<table> <form method="POST" action="';echo ROOT_URL."/".$AdminPath."/?action=save_post&active=prize_top&flag=yes";;echo '"  name="form" id="form"> 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />  
				 <tr bgcolor="#A4B6D7"> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>是否启用</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style=\'margin-left:5px;text-align:left\'>
					     <input type=radio name="status" id="status1" value="1">启用
					     <input type=radio name="status" id="status2" value="0">停用
						 &nbsp;&nbsp;<font color=\'#777777\'>提示：启用及关闭的功能已迁移至全局设置，请进入全局设置中进行配置。</font>
					   </div>
					</td>
					<script>var selGif=\'';echo $rowss[status];;echo '\';if(selGif==\'1\'){G(\'status1\').checked=true;}else{G(\'status2\').checked=true;} 
					</script>
				 </tr>
				 <tr bgcolor="#A4B6D7"> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>排行榜上榜数
					
					</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style=\'margin-left:5px;text-align:left\'>
					     <input name="top_max_num" id="top_max_num" type="text" size="15" value="';echo $rowss[top_max_num];;echo '"> 人（排行榜显示的数量，最多设置80人）
					   </div>
					</td>
				 </tr> 
				 <tr bgcolor="#A4B6D7"> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>上榜最低奖金额度</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style=\'margin-left:5px;text-align:left\'>
					     <input name="top_max_money" id="top_max_money" type="text" size="12" value="';echo $rowss[top_max_money];;echo '"> 元
					   </div>
					</td>
				 </tr> 
				 <tr bgcolor="#A4B6D7"> 
                    <td width="35%" bgcolor="#FFFFFF"><div style=\'height:30px;line-height:30px;text-align:right;margin-right:5px;\'>抽取开奖时间</div></td>
                    <td width="65%" bgcolor="#FFFFFF" align=left>
					    <div style=\'margin-left:5px;text-align:left\'>
					     <input name="top_limit_time" id="top_limit_time" type="text" size="12" value="';echo $rowss[top_limit_time];;echo '"> 分
						 &nbsp;&nbsp;<font color=\'#777777\'>提示：如设置“10”，表示抽取10分钟内开奖数据；设置为0，则抽取所有中奖数据。</font>
					   </div> 
					</td>
				 </tr>
				 <tr bgcolor="#A4B6D7"> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"><div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>不足上榜人数时</div></td>
                    <td width="65%" bgcolor="#FFFFFF">
					   <div style=\'margin-left:5px;text-align:left\'>
					     <input type=radio name="is_open_virtual" id="is_open_virtual1" value="1" onclick="cheaks(\'1\')">生成虚拟数据
					     <input type=radio name="is_open_virtual" id="is_open_virtual2" value="0" onclick="cheaks(\'0\')">追加历史数据
					   </div>
					    
					</td>
				 </tr>
				 <tr bgcolor="#A4B6D7" id=\'tr_1\'> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>虚拟数据奖金范围</div></td>
                    <td width="65%" bgcolor="#FFFFFF" align=left>
					   <div style=\'margin-left:5px;text-align:left\'>
					     <input name="top_vir_min" id="top_vir_min" type="text" size="10" value="';echo $rowss[top_vir_min];;echo '"> - <input name="top_vir_max" id="top_vir_max" type="text" size="10" value="';echo $rowss[top_vir_max];;echo '"> 元
					   </div>
					</td>
				 </tr>
				 <tr bgcolor="#A4B6D7" id=\'tr_2\'> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>虚拟数据彩种</div></td>
                    <td width="65%" bgcolor="#FFFFFF" align=left>
					   <div style=\'margin-left:5px;text-align:left;line-height:30px;\' onload=>
					     ';
$list_num=1;
if($numl){
while($rows1=mysql_fetch_array($result1)){
echo "<input type=checkbox name='top_vir_game[]' id='top_vir_game' value='".$rows1[ckey]."'>".$rows1[fullname];
if($list_num-4>=0  and $list_num%5==0){echo "<br>";}
$list_num+=1;
}
}
;echo ' 
					   </div> <br>&nbsp;&nbsp;<font color=\'#777777\'>提示：彩种请设置如“重庆时时彩”等每天固定奖号的彩种，勿设置如“龙江时时彩”等非固定奖号彩种。</font>
					</td>
					<script> 
					chkcheckboxNew("top_vir_game[]",\'';echo $rowss[top_vir_game];;echo '\')
					</script>
				 </tr>
				 <tr bgcolor="#A4B6D7" id=\'tr_3\'> 
                    <td width="35%" bgcolor="#FFFFFF" height="25"> <div style=\'height:20px;line-height:20px;text-align:right;margin-right:5px;\'>虚拟上榜会员昵称</div></td>
                    <td width="65%" bgcolor="#FFFFFF" align=left>
					   <div style=\'margin-left:5px;text-align:left\'>
					     <textarea name="top_vir_nick" id="top_vir_nick" cols="110" rows="12">';echo $rowss[top_vir_nick];;echo '</textarea>
						 
					   </div><br>&nbsp;&nbsp;<font color=\'#777777\'>提示：每个昵称必须以"|"分隔。</font>
					</td>
				 </tr>
				  
       <tr bgcolor="#FFFFFF"><td></td>
          <td align=left>&nbsp;
		  <input type="submit"  class="button" name="submit" value="保存配置" onclick="winPop({title:\'\',width:\'400\',drag:\'true\',height:\'100\',form:\'form\'})">
		  &nbsp;&nbsp;<font color=\'#777777\'>提示：以上所有选项为必填项。</font>
		  </td>
       </tr>
	  </form>
  </table>
  <script> 
       function cheaks(keys){
		   if(keys=="1"){
			   G("tr_1").style.display="";G("tr_2").style.display="";G("tr_3").style.display="";
		   }else{
			   G("tr_1").style.display="none";G("tr_2").style.display="none";G("tr_3").style.display="none";
		   }
	   }
	   var selGif=\'';echo $rowss[is_open_virtual];;echo '\';if(selGif==\'1\'){G(\'is_open_virtual1\').checked=true;}else{G(\'is_open_virtual2\').checked=true;} 
        cheaks(selGif);
  </script>    
        <br>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>