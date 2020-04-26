<?php


if($_GET['type']=='set_status'){
	$status=$_GET['status'];
		$ids=explode(',', $_GET['id']);

	foreach ($ids as $value) {



		mysql_query("update game_intface set status='{$status}' where id='{$value}' ");
	}

	if($status=='1')
	add_adminlog("批量停止开奖接口");
	else add_adminlog("批量启用开奖接口");
		update_kaijiang();
echo "<script>alert('操作成功');</script>";

echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
}


$add_file=$thispath."_add";

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");




?>
<table> <tr>
	       <td colspan="8" bgcolor="#FFFFFF" align="left">

	       <form action="index.aspx?controller=<?php echo $_GET['controller'];?>&action=<?php echo $_GET['action']?>" method="post"  id='form1'>

	       接口分类：<select name='links'  onchange="document.getElementById('form1').submit();">
	       <option value=''>全部</option>
	              <option value='caipiaokong'  <?php if($_POST[links]=='caipiaokong') echo "selected";?>>彩票控</option>
	       <option value='168'  <?php if($_POST[links]=='168') echo "selected";?>>168开奖网</option>
	    <option value='360.cn'  <?php if($_POST[links]=='360.cn') echo "selected";?>>360彩票网</option>
	    <option value='cailele'  <?php if($_POST[links]=='cailele') echo "selected";?>>彩乐乐</option>
	       </select>


状态：<select name='status'  onchange="document.getElementById('form1').submit();">
	       <option value='-1'  <?php if($_POST[links]=='-1') echo "selected";?>>全部</option>
	       <option value='0'  <?php if(!$_POST[links]) echo "selected";?>>启用</option>
	    <option value='1'  <?php if($_POST[links]=='1') echo "selected";?>>停用</option>

	       </select>
	    <input type="submit"  class="button" name="submit" value="搜索" />
	        &nbsp;&nbsp;&nbsp;
<input type="button"  class="button" name="submit" value="批量启用" onclick='return agree(0);'/>  &nbsp;&nbsp;&nbsp;
<input type="button"  class="button" name="submit" value="批量停止" onclick='return agree(1);'/>  &nbsp;&nbsp;&nbsp;
        <input type="button" class='button' onclick="winPop({title:'',width:'600',drag:'true',height:'230',url:'<?php echo $add_file."&active=new";?>'})" value='添加记录'>


	       </form>

		   </td>
       </tr>
       </table>


<?php
echo '


<table> <tr>
           <th  bgcolor="#FFFFFF"><input type="checkbox" name="qx[]" value="1"  onclick="quan();"></th>
           <th  bgcolor="#FFFFFF">彩种</th>
          <th bgcolor="#FFFFFF">开奖地址</th>


          <th  bgcolor="#FFFFFF">级别</th>

                 <th  bgcolor="#FFFFFF">状态</th>
          <th bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="index.aspx?action=save_post&flag=yes&active=game_IntFace" >
       <input name="flag" type="hidden" value="save" />
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />

	   ';

$str='';
if($_POST['links']) $str.=" and links like '%{$_POST[links]}%' ";




if(!$_POST['status']) $str.=" and `status`='0' ";

else{

	if($_POST['status']==1) $str.=" and `status`='1' ";

}
$sql_id="select * from game_intface where 1 {$str} order by status ASC,playkey desc";
//
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
	$game=$db->fetch_first("select * from game_type where ckey='{$rows3['playkey']}'");

if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td><input type='checkbox' name='quanxuan[]' value='{$rows3['id']}'></td>";
echo "<td>".$game[fullname]."</td>";
echo "<td><a href='$rows3[links]' target='_blank'>".$rows3[links]."</a></td>";

echo "<td>".$rows3[Level]."</td>";
if($rows3['status']=='0') $status="启用";else $status='停用';

echo "<td>".$status."</td>";

echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'修改彩种',width:'600',drag:'true',height:'200',url:'?controller=lottery&action=xml_add&id=".$rows3[id]."'})\">修改</a>";
echo "
|
<a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=game_IntFace&id=".$rows3[id]."'})\">删除</a></td></tr>";
}
;echo '

	  </form>
  </table>

        <br>
     </TD><TD width=7
  background="';echo ROOT_PATH."/".$AdminPath;;echo '/images/table_center_r1_c3.gif">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>





<script type="text/javascript">



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

function agree(status)
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

	if(status=='0')
var ss=confirm("确定批量启用么？");
	else
		var ss=confirm("确定批量停止么？");
if(ss==true)
{
  location.href="index.aspx?controller=lottery&action=xml&type=set_status&status="+status+"&id="+a;
}
}
}

</script>

