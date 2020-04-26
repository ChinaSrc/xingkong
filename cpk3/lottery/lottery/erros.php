<?php


if($_GET['type']=='gameback'){

$list=	$db->fetch_all("select * from game_buylist where playkey='{$_GET[playkey]}' and period='{$_GET[period]}'");

	if($list){
		
		foreach ($list as $value) {
			game_back($value['id']);
		}
		
		
	}
	add_adminlog("手动撤单");
	echo "<script>alert('恭喜你撤单成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
exit();
	
}

if($_GET['type']=='set_error'){

	if(strpos($_GET['id'],',')!==false){
		
		$arr=explode(',', $_GET['id']);
		foreach ($arr as $value) {
			$db->query("update  game_buylist set error='-1' where id='$value' ");
		}
		
	}
	else
	
$db->query("update  game_buylist set error='-1' where id='{$_GET['id']}' ");


	add_adminlog("异常单设置为正常");
	echo "<script>alert('恭喜您操作成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
exit();
	
}


$nowtime=date("Y-m-d H:i:s",time()-24*3600*30);
$nowdate=date("Y-m-d 00:00:00",time()-24*3600*30);
$nextdate=date("Y-m-d H:i:s",time());


$begindate_get=$_GET['begindate'];
$enddate_get=$_GET['enddate'];
if($begindate_get==""){$begindate=$nowdate;}else{$begindate=$begindate_get;}
if($enddate_get==""){$enddate=$nextdate;}else{$enddate=$enddate_get;}
$t_url="?controller=lottery&action=erros";
$db_s="game_buylist";
$t_url.="&begindate=".$begindate."&enddate=".$enddate;
$begintime=$begindate;
$endtime=$enddate;

$search="  creatdate between '$begintime' and '$endtime'  ";
$search.="  and error>0 and (status=1 or status=2 or status=3) ";

$pername=$_GET['pername'];
if($pername!='') {$search.=" and userid in (select userid from user where username='{$pername}' )";}


if($_GET['error']){
	
	$search.=" and error='{$_GET['error']}'";
	
}


$error_list=array('1'=>'重复派奖','2'=>'奖金丢失','3'=>'盈亏负值','4'=>'异常盈利');
?>



<?php 
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");


?>


    <form action="" method="GET" style="display:inline;"> 
          <input name="controller" id="controller" type="text" value="<?php echo $_GET['controller'];?>" style='display:none'> 
          <input name="action" id="action" type="text" value="<?php echo $_GET['action'];?>" style='display:none'> 
  
           <table width="100%" border="0" style="border-bottom: 0px; " cellspacing="0" cellpadding="0" class="my_tbl">
                                <tr>
                                    <td align='left' style="padding-left: 10px;">

	    &nbsp;开始时间:
      <input type="text" name="begindate" id="begindate"  value="<?php echo $begindate;?>" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})"/>
           截止时间：<input type="text" name="enddate" id="enddate" value="<?php echo $enddate;?>" class="input_02" style="width:150px;"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})"/>
  

	       &nbsp;用户名:
      <input name="pername" id="pername"  class="input"  type="text" value="<?php echo $pername;?>" size="18" maxlength="20" >
&nbsp;类型:<select name='error'>
    <option value=''>不限</option>
    <?php foreach ($error_list as $key=> $value) {
    	?>
    	
    	<option  value='<?php echo $key;?>' <?php if($key==$_GET['error']) echo "selected";?>><?php echo $value?></option>
    	<?php 
    }?>
    </select>
 

         
     <input id='playkey' value='<?php echo $playkey;?>' style='display:none'>
<input type="submit"  class="button" name="submit" value="提交" />


<input type="button"  class="button" name="submit" value="设为正常" onclick='return agree();'/>


</td>

</tr>
</table>
</form>
<br> 
<?php
$body_top_title=$show_title;include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo '  

      <table> <tr>
       <th width="4%" bgcolor="#FFFFFF"><input type="checkbox" name="qx[]" value="1"  onclick="quan();"></th>
       
          <th width="8%" bgcolor="#FFFFFF">用户名</th>
 
           <th width="8%" bgcolor="#FFFFFF">游戏</th> 
          <th width="10%" bgcolor="#FFFFFF">期号</th>
            
       
          <th width="8%" bgcolor="#FFFFFF">投注金额</th>  
           <th width="10%" bgcolor="#FFFFFF">玩法</th>  
        <th width="10%" bgcolor="#FFFFFF">投注时间</th>
          
          <th width="8%" bgcolor="#FFFFFF">异常类型</th>
     <th gcolor="#FFFFFF">异常情况</th>
       
          <th  bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" />  
	   ';

mysql_query("set names utf8;");

$sql3="select * from game_buylist where $search order by creatdate desc limit $starnum,$maxnum";
//echo $sql3;
$result3=mysql_query($sql3);$listnum=0;
$nums3=mysql_num_rows($result3);
$result9 = mysql_query("select count(id) from $db_s where $search") or die("未能读取，请刷新");
$rows9=mysql_fetch_row($result9);
if($nums3){
	$i=0;
while($rows3=mysql_fetch_array($result3)){
	$i++;
	$num=$i+$starnum;
	$user=$db->fetch_first("select * from user where userid='{$rows3[userid]}'");


$game=$db->fetch_first("select fullname from game_type where ckey='{$rows3[playkey]}'");
echo "<tr height='25' align='center' style='background:#FFF'>";
echo "<td><input type='checkbox' name='quanxuan[]' value='{$rows3[id]}'></td>";

echo "<td>{$user[username]}</td>";

echo "<td>".$game['fullname']."</td>";
echo "<td>".$rows3[period]."</td>";

echo "<td><span id='mon_".$listnum."'>".$rows3[money]."</span></td>";
echo "<td>".get_game_mark($rows3['id'],1)."</td>";





echo "<td>".$rows3[creatdate]."</td>";
echo "<td>".$error_list[$rows3['error']]."</td>";

if($rows3['error']==1){
	$status="奖金累计".$rows3['error_num'].'次';
}

if($rows3['error']==2){
	$status="奖金未派送";
}
if($rows3['error']==3){
	
	$status="盈亏值：".$rows3['error_num'];
}
if($rows3['error']==4){
	
	$status="盈利：".$rows3['error_num'];
}

echo "<td>{$status}</td>";
$this_url=ROOT_URL."/do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&uid=".$rows3['id'];
$Do_back="<input type='button' id='do_put_button' class='buttonnormal' value='设为正常' onclick=\"set_error('{$rows3['id']}');\">";

$Do_back.="&nbsp;&nbsp;";

$Do_back.="<input type='button' id='do_put_button' class='buttonnormal' title='撤单后，未开奖的单子，退还本金，取消返点，已开奖的单子还将取消中奖奖金' value='撤单' onclick=\"winPop({title:'撤单提示',width:'300',height:'100',url:'".$this_url."'})\">";

$Do_back.="&nbsp;";
$this_url=ROOT_URL."/do.aspx?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$rows3['id'];
echo "<td>".$Do_back."&nbsp;<input type='button' id='do_put_button' class='buttonnormal' value='详情' onclick=\"javascript:winPop({title:'查看投注单',form:'Form1',width:'600',height:'500',url:'".$this_url."'});\"  style='cursor:pointer;'></td>";
$listnum+=1;
}
}else{
echo "<tr height='25' align='center' style='background:#FFFFFF;'><td colspan=11><font color='#999999'>未找到记录</font></td></tr>";
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

<script type="text/javascript">

function set_error(id){


 	if(confirm('确定要设置为正常单么？此操作不可恢复 ')){



 		location.href='index.aspx?controller=lottery&action=erros&type=set_error&id='+id;
 		
 	 	}
    

	
}

function quan()
{ 
if(document.getElementsByName("qx[]")[0].checked==false)
{
  for(var i=0;i<document.getElementsByName("quanxuan[]").length;i++)
 {
   document.getElementsByName("quanxuan[]")[i].checked=false;
 }
}  
if(document.getElementsByName("qx[]")[0].checked)
{
 for(var i=0;i<document.getElementsByName("quanxuan[]").length;i++)
 { 
   document.getElementsByName("quanxuan[]")[i].checked=true;
 }
}
}

function agree()
{
  var a=new Array();
  var i;
  var c=0;
  for(i=0;i<document.getElementsByName("quanxuan[]").length;i++)
  {
  if(document.getElementsByName("quanxuan[]")[i].checked)
    {
     a[c]=document.getElementsByName("quanxuan[]")[i].value;
     c++;
     /*alert(a);*/
  }
  }
if(a.length==0)
{
  alert("请选择");
}
else
{
var ss=confirm("确定批量设为正常?设为正常后不恢复");
if(ss==true)
{
  location.href="index.aspx?controller=lottery&action=erros&type=set_error&id="+a;
}
}
}

</script>

