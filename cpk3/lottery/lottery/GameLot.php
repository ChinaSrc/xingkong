<?php



if($_GET['type']=='del'){
	
	$db->query("delete from game_lottery where id='$_GET[id]'");
	add_adminlog("删除开奖数据");

	echo "<script>alert('删除成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	
	
	
}



include(ROOT_PATH."/".$AdminPath."/body_line_top.php");


$channel=$_GET['gamekey'];
$search_input=$_GET['search_input'];
if($channel){$playkey=$channel;}
if($search_input){$search=$search_input;}
?>
 <form name="form" id="form1" method="get" action="" >
     <input type="hidden" name="controller" value="<?php echo $_GET['controller']?>">
     <input type="hidden" name="action" value="<?php echo $_GET['action']?>">
 <div   class="search_box">

彩种:
					  <select name="gamekey">
					    <option value="">所有彩种</option>

<?php echo  set_game_select('gamekey','get');?>
                      </select>
     <select name="yushe">
       <option value="">所有开奖</option>
         <option value="1" <?php if($_GET['yushe']==1) echo "selected";?>>预设开奖</option>

     </select>


 按关健字
   <input type='text' id='search_input' name='search_input' value='<?php echo $search_input;?>'size='30' class="input">

  <input type="submit"  class="button" name="submit" value="搜索" />
  		  <input type="button" class='button' onclick="winPop({title:'手动开奖',width:'600',drag:'true',height:'250',url:'?controller=lottery&action=lottery_add&active=new'})" value='手动开奖'>
  		  <input type="hidden" class='button' onclick="winPop({title:'全部派奖',width:'400',drag:'true',height:'200',url:'index.aspx?controller=lottery&action=fenpei_prize'})" value='全部派奖'>
    
 </div>
 </form>


 <br>

<table> <tr>
     
          <th  align="center" bgcolor="#FFFFFF">彩种</th>
          <th align="center" bgcolor="#FFFFFF">期号</th>  
  
          <th  align="center" bgcolor="#FFFFFF">开奖号码</th> 
                  <th  align="center" bgcolor="#FFFFFF">预计开奖时间</th>   
                          <th  align="center" bgcolor="#FFFFFF">入库时间</th>
        <th align="center" bgcolor="#FFFFFF">操作人</th>
         <th align="center" bgcolor="#FFFFFF">投注数量</th> 
          <th align="center" bgcolor="#FFFFFF">投注金额</th> 
           <th align="center" bgcolor="#FFFFFF">中奖金额</th> 
          <th align="center" bgcolor="#FFFFFF">状态</th>
          <th  align="center" bgcolor="#FFFFFF">操作</th> 
       </tr>

	<?php

$arr_status=array('-1'=>'未开奖','0'=>'已开奖','1'=>'<span style="color: #ff0000">已派奖</span>');
if(strlen($search)-10>=0){$search=substr($search,2,strlen($search));}
if($playkey!=""){$wheres=" and playKey='$playkey'";$thispath.="&playkey=".$playkey;}
if ($search!=""){$wheres=" and (period LIKE '%$search%' or Number LIKE '%$search%')";$thispath.="&search=".$search;}

if($_GET['yushe']==1) $wheres=' and admin is not null';
$sql3="select * from game_lottery where 1 $wheres  ";
if($playkey!='') $sql3.=" order by period desc";
else $sql3.=" order by id desc";

$page=new Page($sql3,20,$_GET['page']);
$sql3.=" limit {$page->from},20";
$result3=$db->query($sql3);

while($rows3=$db->fetch_array($result3)){

if(strtotime($rows3['LotTime'])<time()  and $row['status']=='-1') start_prize($rows3[playKey],$rows3[period]);
	$sql="select count(*) as num,sum(money) as money,sum(pri_money) as prize from game_buylist where `is_succeed`='yes' and `playkey`='{$rows3[playKey]}'  and period='{$rows3[period]}'";
	
$row=$db->fetch_first($sql);
$num=$row['num'];	
if(!$row['money']) $row['money']='0.00';
if(!$row['prize']) $row['prize']='0.00';
	$game=$db->fetch_first("select fullname from game_type where ckey='{$rows3[playKey]}'");
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>".$game['fullname']."({$rows3[playKey]})</td>";
echo "<td>".$rows3[period]."</td>";

echo "<td><a class='mouse_show link_01' onclick=\"winPop({title:'修改开奖数据',width:'600',drag:'true',height:'300',url:'".ROOT_URL."/".$AdminPath."/?controller=lottery&action=lottery_add&id=".$rows3[id]."'})\">"
     .$rows3[Number].
	 "</a></td>";
    echo "<td>".$rows3[LotTime]."</td>";
    echo "<td>".date('Y-m-d H:i:s',$rows3['addtime'])."</td>";
    echo "<td>".$rows3[admin]."</td>";
$url="index.aspx?controller=project&action=index&active=bet&type=total&time=no&playkey={$rows3[playKey]}&period={$rows3[period]}";
echo "<td><a href='$url'>".$num."</a></td>";
echo "<td><a href='$url'>".number_format($row['money'],3,'.','')."</a></td>";
echo "<td><a href='index.aspx?controller=project&action=index&active=prize&time=no&playkey={$rows3[playKey]}&period={$rows3[period]}'>".number_format($row['prize'],3,'.','')."</a></td>";
$do_s="";
    $status= $arr_status[$rows3['status']];
echo "<td>".$status."</td>";
echo "<td>";
if($rows3[status]-1<0  and $num>0)
 $pj="<a class='mouse_show link_01' onclick=\"location.href='{$url}';\" >查看投注</a>
            ";
else  $pj='';
echo "<span align='center'>
{$pj}
 <a class='mouse_show link_01' onclick=\"winPop({title:'修改开奖数据',width:'600',drag:'true',height:'300',url:'".ROOT_URL."/".$AdminPath."/?controller=lottery&action=lottery_add&id=".$rows3[id]."'})\">修改</a></span>&nbsp;
  <a class='mouse_show link_01' onclick=\"return del_data({$rows3[id]},'确定要删除{$game['fullname']}第$rows3[period]期开奖数据？');\">删除</a></span>&nbsp;";
echo $do_s;
echo "</td></tr>";
}
;echo ' 
	  </form>
  </table> 
 <script>
    function set_lot_back(uid,playKey,period){
		  var titles="确定将"+playKey+"的"+period+"设置为未开奖？";
		  var show_dilog= window.confirm(titles);
		  if (show_dilog) {
			  var b_items="back_"+playKey+"_"+period;
			  var s_items="status_"+playKey+"_"+period;
		      G(b_items).innerHTML="正在提交..";
			  var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
		      ajaxobj=new AJAXRequest;
		      ajaxobj.method="POST";
		      ajaxobj.content="item=status&value=0&dbname=game_lottery&uid="+uid;
		      ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=saveitem"; 
		      ajaxobj.callback=function(xmlobj){
				  //var response = xmlobj.responseText;
				  var response = Trim(xmlobj.responseText);
				  var items="#"+items
				  window.setTimeout("window.location.reload();",500);
			  }
		      ajaxobj.send()
		  }else{
			  return false;
		  } 
	  }
	  
	  function del_data(id,title){
	var ss=  confirm(title);
	  if(ss == true){
	  location.href="index.aspx?controller=lottery&action='.$_GET[action].'&type=del&id="+id;
	  }
	  else {
	  
	  return false;
	  }
	  
	  }
 </script>


 
';
?>
<div class="page">

    <?php echo $page->get_page();?>

</div>
</div>

<?php
include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>