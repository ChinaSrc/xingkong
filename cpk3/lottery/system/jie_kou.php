<?php

$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
;echo ' 
';$body_top_title="游戏管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");;echo ' 
 

<table> <tr>
        <th width="6%" align="center" bgcolor="#FFFFFF">选择</th>
          <th width="6%" align="center" bgcolor="#FFFFFF">方案ID</th>
          <th width="15%" align="center" bgcolor="#FFFFFF">游戏名称(省份)</th> 
          <th width="15%" align="center" bgcolor="#FFFFFF">期号</th>  
          <th width="40%" align="center" bgcolor="#FFFFFF">组合号码</th>
          <th width="10%" align="center" bgcolor="#FFFFFF">状态</th>
               <th width="8%" align="center" bgcolor="#FFFFFF">操作</th>
       </tr>
     <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
       <tr>
          <td colspan="7" bgcolor="#FFFFFF">&nbsp;
		  &nbsp;<input type="button" class=\'button\' onclick="winPop({title:\'\',width:\'600\',drag:\'true\',height:\'620\',url:\'';echo ROOT_URL."/".$AdminPath;;echo '/?controller=lottery&action=jie_kou_add&active=new\'})" value=\'添加新数据\'>&nbsp; 
		  </td>
       </tr> 
	   ';
$sql_id="select * from jie_kou order by id desc";
$result3=mysql_query($sql_id);
while($rows3=mysql_fetch_array($result3)){
if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
$inid=$rows3[id];
$query11=mysql_query("select * from game_type where `ckey`='{$rows3['sheng_fen']}'");
if($row=mysql_fetch_array($query11)){
	
	$sheng_fen=$row['fullname'];
}
else {
	
		$sheng_fen=$rows3['sheng_fen'];
	
}
echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
echo "<td>&nbsp;  <INPUT TYPE=\"checkbox\" NAME=\"quanxuan[]\" value='".$inid."'> </td>";
echo "<td>&nbsp;".$rows3['fn_id']."  <input name='id[]' type='hidden' value='".$inid."' /> </td>";
echo "<td>".$sheng_fen."</td>";
echo "<td>".$rows3[day].$rows3['start_qi']."</td>";
echo "<td>".str_replace("<br>", ",", $rows3['nr'])."</td>";

echo "<td>".$rows3['N_from']."</td>";
echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=jie_kou&id=".$rows3[id]."'})\">删除</a></div></td>";
}
;echo ' 
 
	  </form>
  </table>
      
        <br>
     </TD>
     <TD width=7  >&nbsp;</TD>
    </TR>
       <tr>
          <td colspan="7" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="checkbox" name="qx[]"  onClick="quan();"><font size="2">全选</font>

<input type="checkbox" name="fx[]" onClick="fanxuan();"><font size="2">反选</font>
<a href="javascript:agree()">批量删除</a>
';include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>

<script>
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
function fanxuan()
{ 
if(document.getElementsByName("fx[]")[0].checked==false)
{
for(var i=0;i<document.getElementsByName("quanxuan[]").length;i++)
{
document.getElementsByName("quanxuan[]")[i].checked=false;
}
}  
if(document.getElementsByName("fx[]")[0].checked)
{
for(var i=0;i<document.getElementsByName("quanxuan[]").length;i++)
{ if(document.getElementsByName("quanxuan[]")[i].checked)
document.getElementsByName("quanxuan[]")[i].checked=false;
else
	 document.getElementsByName("quanxuan[]")[i].checked=true;
}
}
}
//-->
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
var ss=confirm("确定批量删除?");
if(ss==true)
{
	 location.href="<?php echo ROOT_URL."/".$AdminPath?>/?action=dele_all&flag=yes&dbname=jie_kou&id="+a;
}
}
}

function deny()
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
var ss=confirm("确定批量删除?");
if(ss==true)
{
 location.href="<?php echo ROOT_URL."/".$AdminPath?>/?action=dele_all&flag=yes&dbname=jie_kou&id="+a;
}
}
}

</script>