<?php



$add_file=$thispath."_add";
$active=$_GET['active'];
$playkey=$_GET['playkey'];


$t_url="?controller=project&action=hemai";


 $search=" hemai.uid=user.userid  ";


$pername=$_GET['pername'];
if($pername!=""){$search.=" and user.username='$pername'";$t_url.="&pername=".$pername;}
$period=$_GET['period'];
if($period!=""){$search.=" and hemai.period='$period'";$t_url.="&period=".$period;}

if($_GET['status']==='0' or $_GET['status']==='-1' or $_GET['status']>0){
	$status=$_GET['status'];


	$search.=" and hemai.status='{$status}' ";
	
	$t_url.="&status=".$status;
}

?>
<input id='tpl_url' name='tpl_url' value='<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>' style='display:none'>
<script type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>/zdialog/zdrag.js"></script>
<script type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>js/diags.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL."/".DEFAULT_TEMPLATE;?>js/window.diags.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL;?>/js/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript">
function back_gameall(){
 	var playkey=document.getElementById('playkey');
 	if(playkey.value==''){
alert('请选择彩种');
return  false;
 	 	}

	
 	var pername=document.getElementById('period');
 	if(pername.value==''){
alert('期号不能为空');
return  false;
 	 	}


 	
 	if(confirm('确定要把'+pername.value+'期撤单吗? ')){



 		location.href='index.aspx?controller=project&action=index&active=<?php echo $active;?>&type=gameback&period='+pername.value+'&playkey='+document.getElementById('playkey').value;
 		
 	 	}
    
	
}

</script>

<?php 
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");
hemai_list();

?>


    <form action="" method="GET" style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="project" style='display:none'> 
          <input name="action" id="action" type="text" value="hemai" style='display:none'> 

           <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">
	  <?php if($_GET['time']!='no'){?>
	 <?php }?>
    彩种:<select name='playkey'  id='playkey'>
    <option value=''>所有彩种</option>
    <?php echo  set_game_select('playkey','get'); ?>
    </select>

      &nbsp;期号:
      <input name="period" id="period"  class="input"  type="text" value="<?php echo $period;?>" size="18" maxlength="40" />

	       &nbsp;发起人:
      <input name="pername" id="pername"  class="input"  type="text" value="<?php echo $pername;?>" size="18" maxlength="20" >


      状态：<select name='status'>
    <option value=''>-不限-</option>
    
    <?php 
    foreach ($arr_hemai_status as $key =>$value){
    ?>
    <option value='<?php echo $key?>'  <?php if ($_GET['status']===$key) echo "selected";?>><?php echo $value;?></option>
    
    <?php }?>
 
    </select>
    

      
 

         

<input type="submit"  class="button" name="submit" value="提交" />




</td>

</tr>
</table>
</form>



      <table> <tr>

          <th  bgcolor="#FFFFFF">发起人</th>
    
           <th bgcolor="#FFFFFF">彩种</th> 
                  
          <th  bgcolor="#FFFFFF">期号</th>
          <th  bgcolor="#FFFFFF">金额</th>
               
                     <th  bgcolor="#FFFFFF">每份金额</th>
                              <th  bgcolor="#FFFFFF">剩余份数</th>            
       


          <th  bgcolor="#FFFFFF">中奖金额</th>       
          <th  bgcolor="#FFFFFF">状态</th>
  
            <th  bgcolor="#FFFFFF">发起时间</th>
          <th  bgcolor="#FFFFFF">操作</th>
       </tr>
       
       
       
     <form name="myform" id="myform" method="post" action="save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" />  
<?php

mysql_query("set names utf8;");
$sql3="select hemai.*,user.username from hemai,user where $search order by hemai.id desc limit $starnum,$maxnum";
//echo $sql3;
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);

if($nums3){
while($rows3=mysql_fetch_array($result3)){
	//$rows3['baodi']=number_format($value['baodi']*100/$rows3['sum'],2);
		$hm=$db->exec("select sum(num) as sum from hemai_list where hm_id='{$rows3['id']}'");
		if(!$hm['sum']) $hm['sum']=0;
		$rows3['mebuy']=number_format(($hm['sum'])*100/$rows3['sum'],2);;
				$rows3['sum1']=$rows3['sum']-$hm['sum'];

		$rows3['premoney']=number_format($rows3['premoney'],3);		

$game=$db->fetch_first("select fullname from game_type where ckey='{$rows3[playkey]}'");
echo "<tr height='25' align='center' style='background:#FFF'>";

echo "<td><a   onclick=\"javascript:winPop({title:'修改用户信息',form:'Form1',width:'600',height:'500',url:'?controller=user&action=index_add&id={$rows3['uid']}'});\" >{$rows3[username]}</a></td>";

echo "<td>".$game['fullname']."</td>";

echo "<td>".$rows3[period]."</td>";

echo "<td>".$rows3[money]."</td>";
echo "<td>".$rows3['mebuy']."%";

if ($rows3['baodi']>0) echo "+".$rows3['baodi']."%<span class='red'>(保)</span>";echo "</td>";
echo "<td>".$rows3[premoney]."</td>";

echo "<td>".$rows3[prize]."</td>";


echo "<td>".$arr_hemai_status[$rows3['status']]."</td>";
echo "<td>".date('Y-m-d H:i:s',$rows3['addtime'])."</td>";

echo "<td><a   onclick=\"javascript:winPop({title:'合买详情',form:'Form1',width:'600',height:'500',url:'../index_hemai_detail.html?admin=1&id={$rows3['id']}'});\" >详情</a></td>";
$listnum+=1;
}
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=14><font color='#999999'>未找到记录</font></td></tr>";
}
;echo ' 
	  </form>
	  <input id=\'listnums\' value=\'';echo $listnum;;echo '\' type=\'hidden\'>
	  
<script>show_moneys(G(\'listnums\').value,"mon")</script>
  </table>
      
        <div style=\'margin-left:10px;height:30px;line-height:30px;text-align:left\'>
	
	    <link href="../css/pages.css" type="text/css" rel="stylesheet"/>
	    <div class="showpage">
					';
$allnum=$rows9[0];;
$pageurl=$t_url;
$pagelist=$maxnum;
include ("../source/plugin/pages.php");

;
echo ' 
	    </div> 
	</div>   
 
';
?>