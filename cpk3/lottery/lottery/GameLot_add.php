<?php

header("content-type:text/html; charset=utf-8");
$users=($_SESSION['userlist']);
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
$headpaths="../".$headpath."/admin_head.aspx";
$thispath="http://".$_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$add_file=$thispath."_add";
$playkey=$_GET['playkey'];
include($headpaths);
$itemkey=$_GET['itemkey'];$orders=$_GET['orders'];$search=$_GET['search'];$pages=$_GET[pages];
$curpath = dirname($_SERVER["REQUEST_URI"]);
$curpath=str_replace("/","",$headpath);
$code=$_GET['code'];if($code==""){$code="gp";}
$id=$_GET['id'];$ctitle="添加开奖数据";
if($code=="gp"){$show_title="高频游戏";}
if($code=="dp"){$show_title="低频游戏";}
mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$disc="";
if($id!=""){
$sqls="select * from game_Lottery where id='$id'";
$results=mysql_query($sqls);
$rowss=mysql_fetch_array($results);
$ctitle="修改开奖数据";
$SerialDate=$rowss[SerialDate];
$disc="disabled";
}
$show_title=$ctitle."-".$show_title;
;echo '  
  <table> <form method="POST" action="save_post.aspx?active=lottery_hand&id=';echo $id;;echo '" name="form1" id="form1">
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" /><br>
        <tr height=35 bgcolor="#FFFFFF">
				     <td width=\'15%\'>游戏类别：</td>
				     <td align=left valign=middle width=\'35%\'>&nbsp;
					     <select ';echo $disc;;echo ' name="code" id="code" style=\'width:80%\' onchange="gbcode(this)">
							 <option value=\'dp\'>低频</option>
						     <option value=\'gp\'>高频</option>
						 </select>
						<script> 
						selectSetItem(G(\'code\'),\'';echo $code;;echo '\') 
						function gbcode(Obj){
							var code=Obj.value;
							localurl("?controller=lottery&action=HigLot_add&code="+code)
						}
						function Get_period(Obj){
							var list_id=Obj.value;var listnext;
							var SerialDate=G(\'SerialDate\').value;
							if(SerialDate==""){alert(\'请输入开奖的日期！\');return false;}
							ajaxobj=new AJAXRequest;
							ajaxobj.method="POST";
							ajaxobj.content="list_id="+list_id+"&SerialDate="+SerialDate;
							ajaxobj.url="get_period_ajax.aspx";
							ajaxobj.callback=function(xmlobj){ 
								var response = xmlobj.responseText; 
								if(response){
								var lists=response.split("#");
								var selobj=G(\'period\');
								selobj.options.length=0
								if (lists[0]!=\'0\'){
									for (i=0;i<lists.length;i++ ){
										listnext=lists[i].split("|");
										selobj.options.add(new Option(listnext[1],listnext[0]));
									}
                                }else{
									creatSel(selName,selVal,sType,0);
								}
								}
							}
							ajaxobj.send()
						}
						</script>
					 </td>
				     <td width=\'15%\'>彩　　种：</td>
				     <td align=left valign=middle width=\'35%\'>&nbsp;
					     <select ';echo $disc;;echo ' name="list_id" id="list_id" onchange="Get_period(this)" style=\'width:80%\'>
						     <option value=\'\'>-请选择-</option>
					         ';
mysql_query("set names utf8;");
$sql5="select fullname,ckey from game_type where cate='$code'";
$result5=mysql_query($sql5);
$nums5=mysql_num_rows($result5);
if($nums5){
while($rows5=mysql_fetch_array($result5)){
echo "<option value='".$rows5[ckey]."'>".$rows5[fullname]."</option>";
}
}else{
echo "<option value=''>未找到数据,请先添加彩种</option>";
}
;echo ' 
                         </select>
						 <script>
						 function show_period_num(){
							 if(document.getElementById(\'period\').length-1>0){
								 selectSetItem(document.getElementById(\'period\'),\'';echo $rowss[SerialID];;echo '\')
							 }else{
								 setTimeout("show_period_num()",500);
							 } 
						 }

						 selectSetItem(document.getElementById(\'list_id\'),\'';echo $rowss[playKey];;echo '\');
						 Get_period(document.getElementById(\'list_id\')); 
						 //setTimeout("show_period_num()",500) 
						 function sleect_this(vthis){
							 //alert(vthis.value)
						 }
						 </script>
					 </td> 
			     </tr>
				 <tr height=35 bgcolor="#FFFFFF">
				     <td>期　　号：</td>
					 <td align=left valign=middle>
					      &nbsp;第&nbsp;<input type=\'text\' ';echo $disc;;echo ' id=\'SerialDate\' name=\'SerialDate\' value=\'';echo $SerialDate;;echo '\' style=\'width:65px;\'>&nbsp;
					      <select ';echo $disc;;echo ' name="period" id="period" onchange="sleect_this(this)" style=\'width:30%\'>
						       ';
if($rowss[SerialID]){echo "<option value='".$rowss[SerialID]."'>".$rowss[SerialID]."</option>";}
;echo '                          </select>&nbsp;期
						   
					 </td> 
				     <td>开奖号码：</td>
				     <td align=left valign=middle>&nbsp;
					 <input type=\'text\' id=\'lott_num\' name=\'lott_num\' value=\'';echo $rowss[Number];;echo '\' style=\'width:80%\'>  
					 &nbsp;
					 </td>
					 
			     </tr>
				 <tr height=35 bgcolor="#FFFFFF">
				      <td colspan=4> 
					  <input class=\'button\' type="submit" value="提交" type="submit"  id=\'submit\' name="submit">
					 </td>
				 </tr>
	  </form>
  </table> 
      

<script>
/*
if(G(\'search_input\').value==""){G(\'search_input\').value="支持模糊搜索期号、中奖号码";}

function search_url(thissle){
	if(G(\'search_input\').value=="支持模糊搜索期号、中奖号码"){G(\'search_input\').value="";}
	G(\'do_search\').href=G("thispath").value+"&search="+thissle.value;
}
function show_url(thissle){
	window.location.href=G("thispath").value+\'&itemkey=\'+thissle.value
}
selectSetItem(document.getElementById(\'channel\'),\'';echo $itemkey;;echo '\')
*/
</script>

</body> ';
?>