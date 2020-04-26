<?php


if($_GET['type']=='backall'){
	

	$ids=explode(',', $_GET['id']);
		if($ids){
		
			
			
		foreach ($ids as $value1) {
			$tt=explode("|", $value1);
			$list=	$db->fetch_all("select * from game_buylist where playkey='{$tt[0]}' and period='{$tt[1]}'");

	if($list){
		
		foreach ($list as $value) {
			game_back($value['id']);
		}
		
		
	}
	
		}
		
		
	}
	add_adminlog("批量撤单");
echo "<script>alert('批量撤单成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	
	
}


$add_file=$thispath."_add";
$playkey=$_GET['playkey'];

$orders=$_GET['orders'];$search=$_GET['search'];$pages=$_GET[pages];
if($playkey) $str=" and `playkey`='{$playkey}' ";
else $str="";
$sql="select * from game_buylist where `status`='0' and `is_succeed`='yes'  $str order by prize_time asc";

$list=$db->fetch_all($sql);


$list_arr=array();

if($list){
foreach ($list as $key=>$value){
	
	$list_arr[$key]['playkey']=$value['playkey'];
	$list_arr[$key]['period']=$value['period'];
	
	
	
}
$list_arr=unique_arr($list_arr);
}
?>

<table> <tr>
	       <td colspan="8" bgcolor="#FFFFFF" align="left">
<form action="index.aspx" method="get" id="form22">
	       <input type="hidden" name="controller" value="<?php echo $_GET[controller];?>">
	       	       <input type="hidden" name="action" value="<?php echo $_GET[action];?>">

			  彩票种类：
			  <select name="playkey" onchange="	document.getElementById('form22').submit();">
			  <option value=''>--不限--</option>
<?php 
$sql_id="select * from game_type where status='0'";
$results_id=mysql_query($sql_id);
while($rows_id=mysql_fetch_array($results_id)){
if($playkey==$rows_id[ckey]){$cur_li="selected";}else{$cur_li="";}
echo "<option ".$cur_li."  value='".$rows_id[ckey]."'>".$rows_id[fullname]."</option>";
}

?>

</select>
           
              
<input type="button"  class="button" name="submit" value="全部撤单" onclick='return agree();'/>        
              
            </form>  
			  
		   </td>
       </tr>
       <tr>
              <th width="8%" bgcolor="#FFFFFF"><input type="checkbox" name="qx[]" value="1"  onclick="quan();"></th>
          <th width="10%" align="center" bgcolor="#FFFFFF">彩种</th>
        <th width="16%" align="center" bgcolor="#FFFFFF">期号</th>
          <th width="20%" align="center" bgcolor="#FFFFFF">投注数量</th>   
      
          <th width="14%" align="center" bgcolor="#FFFFFF">操作</th> 
       </tr>


<?php
if($list_arr){ 
foreach ($list_arr as  $key=> $value) {
	
if(!$db->fetch_first("select * from game_lottery where `playkey`='{$value[0]}'  and period='{$value[1]}'")){	
	
$sql="select count(*) as num from game_buylist where `status`='0' and `is_succeed`='yes' and `playkey`='{$value[0]}'  and period='{$value[1]}'";
	
$row=$db->fetch_first($sql);
$num=$row['num'];	
$game=$db->fetch_first("select fullname from game_type where ckey='{$value[0]}'");


	?>
	
	       <tr>
   <td align="center" bgcolor="#FFFFFF"><input type='checkbox' name='quanxuan[]' value='<?php echo $value['0'];?>|<?php echo $value['1'];?>'></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $game['fullname']?></td>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value[1]?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $num;?></td>   
      
          <td align="center" bgcolor="#FFFFFF">
    <a class='mouse_show link_01' onclick="location.href='index.aspx?controller=project&action=index&active=bet&time=no&playkey=<?php echo $value[0];?>&period=<?php echo $value[1];?>';" >查看投注</a>
            
    <a class='mouse_show link_01' onclick="winPop({title:'手工开奖',width:'600',drag:'true',height:'200',url:'<?php echo  ROOT_URL."/".$AdminPath;?>?controller=lottery&action=lottery_add&playKey=<?php echo $value[0]?>&period=<?php echo $value[1]?>'})">手动开奖</a>      
   
               
    <a class='mouse_show link_01' onclick="winPop({title:'手动撤单',width:'300',drag:'true',height:'80',url:'<?php echo  ROOT_URL."/".$AdminPath;?>?controller=lottery&action=lottery_back&playkey=<?php echo $value[0]?>&period=<?php echo $value[1]?>'})">手动撤单</a>      
 
   </td> 
       </tr>
	
	
	<?php 
	
}
}
}
?>


  </table>


<script type="text/javascript">

function set_error(id){


 	if(confirm('确定全部撤单么？ ')){



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
var ss=confirm("确定全部撤单么？");
if(ss==true)
{
  location.href="index.aspx?controller=lottery&action=Gamelot1&type=backall&id="+a;
}
}
}

</script>

