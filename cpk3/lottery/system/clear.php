<?php

$nowtime=date("Y-m-d",time());
$active=$_GET['active'];
if($active=="ql"){
$db_s = isset($_GET['db_s']) ?$_GET['db_s'] : $_POST['db_s'];
$counts=0;
if($db_s=="user_rebate"){
$sqls="select * from user_rebate where (userid,PlayKey,ItemKey,Modes) in (select userid,PlayKey,ItemKey,Modes from user_rebate group by userid,PlayKey,ItemKey,Modes having count(*) > 1)";
$results=mysql_query($sqls);
$last_u="";$last_p="";$last_i="";$last_m="";
while($rowslogs=mysql_fetch_array($results)){
$this_u=$rowslogs['userid'];$this_p=$rowslogs['PlayKey'];$this_i=$rowslogs['ItemKey'];$this_m=$rowslogs['Modes'];
$uid=$rowslogs['id'];
if($last_u==$this_u and $last_p==$this_p and $last_i==$this_i and $last_m==$this_m){
$strSql="delete from user_rebate where id='$uid'";
$db->query($strSql);
}else{
$last_u=$this_u;$last_p=$this_p;$last_i=$this_i;$last_m=$this_m;
}
$counts+=1;
}
}
if($db_s=="user_level"){
$sqls="select * from user_level where (userid,higherid) in (select userid,higherid from user_level group by userid,higherid having count(*) > 1)";
$results=mysql_query($sqls);
$last_u="";$last_h="";
while($rowslogs=mysql_fetch_array($results)){
$this_u=$rowslogs['userid'];$this_h=$rowslogs['higherid'];
$uid=$rowslogs['id'];
if($last_u==$this_u and $last_h==$this_h){
$strSql="delete from user_level where id='$uid'";
$db->query($strSql);
}else{
$last_u=$this_u;$last_h=$this_h;
}
$counts+=1;
}
}
if($counts-1>=0){
$re_infor="<font style='font-color:green;'>提示：整理完毕!</font>";
}else{
$re_infor="<font style='font-color:#666666;'>提示：没有发现需要整理的数据!</font>";
}
echo "<div style='font-size:12px;text-align:center;background:#FFFFFF;padding-top:10px;'>".$re_infor."</div>";
echo "<div style='font-size:12px;text-align:center;background:#FFFFFF;padding-top:10px;'><input type='button' value='关闭' onclick=\"parent.pop.close();\"></div>";
exit;
}
include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

$arr_table=array(
'game_buylist'=>'投注记录',
'user_funds?cate=recharge'=>'充值记录',
'user_funds?cate=platform'=>'提现记录',
'adminlog'=>'管理员日志',
'userlog'=>'用户日志',
'game_lottery'=>'开奖数据',
//'user_msg'=>'站内信息',
'user_bank_log'=>'资金明细',
'user_bank_log?cate=hig_rebate'=>'返点明细',
//'fenhong_log'=>'分红明细',
//'wage_log'=>'工资明细',
//'hemai'=>'合买记录',
);
?>





<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#DDDDDD" align="center" cellpadding="3" cellspacing="3" id='info_con_3'  >

<?php
$data=date("Y-m-d H:i:s",time()-30*24*3600);
$i=0;
foreach ($arr_table as $key=>$value) {
//	if($key=='game_lottery')
//$data=date("Y-m-d H:i:s",time()-3*24*3600);
//else
$data=date("Y-m-d H:i:s",time());
if($i%2==0) echo "<tr style='height:40px;line-height:40px;'>";

?>

    <td bgcolor="#FFFFFF"  width='220px'>
    <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;><?php echo $value?></div>

    </td>
                    <td  bgcolor="#FFFFFF">
					   <div style="width:220px;margin-left:5px;text-algin:left">
					   <input id="time_<?php echo $key;?>" class="Wdate"  style='width:200px;' type="text" value="<?php echo $data;?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:false})" >

					   </div>
					</td>

					<td bgcolor="#FFFFFF">
						   <div style="margin-left:5px;text-algin:left">
					 <input type="submit" class=button value=" 删除  " type="submit"  id=submit name="submit"
					 onclick="DelDate('<?php echo $key?>',document.getElementById('time_<?php echo $key;?>').value,'<?php echo $value?>');">
					 </div>
					</td>

<?php

if(($i+1)%2==0) echo "</tr>";
$i++;
}?>



			 <tr>
			  <td  bgcolor="#FFFFFF"> <div style=height:20px;line-height:20px;text-align:right;margin-right:5px;>删除说明</div></td>
     <td colspan="5" align="left" bgcolor="#FFFFFF">删除选定日期之前（包含选定日期）的全部数据</td>
   </tr>



                </table>


<div style='margin:0px auto;padding-top:30px;line-height:80px;height:300px;width:500px;text-align:center;' id='showinfors'>
   <div style='padding:10px;'>
      <img id='loadimg' src="images/loading.jpg" style='display:none' height='50px'>
   </div>
   <div id='titles'>
   </div>
</div>
   <script>
   function DelDate(table,deltime,name){


	   var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;

	   if(deltime==""){alert("填写日期,注意格式：2012-03-26 00:00:00");return false;}
	   var show_dilog= window.confirm("确定清理所选数据?");
	   if (show_dilog) {
		   G("loadimg").style.display="";
		   G("titles").innerHTML="<font color='blue'>正在处理，数据量大时需要一定的时间，很不要关闭，耐心等待！</font>"
		   ajaxobj=new AJAXRequest;
		   ajaxobj.method="POST";
		   ajaxobj.content="deltime="+deltime+"&dbnames="+encodeURI(table)+'&name='+name;
		   ajaxobj.url=thisPathUrl+"/?action=save_post&active=t_delete&flag=yes";//alert(ajaxobj.url);return false;
		   ajaxobj.callback=function(xmlobj){
	    	  var response = Trim(xmlobj.responseText);
	    	 // alert(response);
	    	  setTimeout("popnexts('"+response+"')",1000)
		   };
		   ajaxobj.send()
	   }else{
		   return false;
	   }
   }
   function popnexts(response){
	   if(response=="yes"){
		   G("loadimg").style.display="none";
		   G("titles").innerHTML="<font color='green'>恭喜，清除成功！</font>"
	   }else{
		   G("loadimg").style.display="none";
		   G("titles").innerHTML="<font color='green'>清除失败，请重试！</font>"
	   }
   }
   function showInfors(){
	   var deltime=G("deltime").value;var delkey=G("delkey").value;var dbnames=G("dbnames").value;var titles="提示：您选择了清除";
	   if(deltime!=""){
		   titles+="["+deltime+"]";
		   if(delkey=="before"){titles+="之前";}
		   if(delkey=="under"){titles+="之后";}

		   if(dbnames=="user_login_log"){titles+=" [用户登陆日志]的数据!"}
		   if(dbnames=="game_buylist"){titles+=" [用户投注单]的数据!"}
		   if(dbnames=="user_bank_log"){titles+=" [用户帐变记录]的数据!"}
		   G("show_infor").innerHTML=titles
	   }
   }
   function qldata(){
       var purl=ROOT_URL+"/"+AdminPath+"?controller=system&action=clear&active=ql&db_s="+G('db_name').value;
	   return winPop({title:'整理数据',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true',url:purl})
   }
   function leveldata(){
       var purl=ROOT_URL+"/"+AdminPath+"?controller=do&action=add_user_level&active=ql&db_s="+G('db_name').value;
	   return winPop({title:'整理数据',ishow:'true',drag:'true',width:'400',height:'100',iclose:'true',url:purl})
   }
   showInfors()
   </script>

