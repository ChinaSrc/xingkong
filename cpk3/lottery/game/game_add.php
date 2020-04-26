<?php

$playkey=$_GET['playkey'];
$cate=$_GET['cate'];if($cate==""){$cate="gp";}
$id=$_GET['id'];
mysql_query("set names utf8;");
$SerialDate=date("Ymd",time());
$btn="保存配置";$show_title="创建游戏配置";
if($id){
mysql_query("set names utf8;");
$sql2="select * from game_type where id='$id'";
$result2=mysql_query($sql2);
$rowsk=mysql_fetch_array($result2);

$selected[$rowsk['cate']]="selected";
$btn="保存配置";$show_title="修改游戏配置";
if($cate==""){$cate=$rowsk[cate];}
}



$show_title=$show_title;
mysql_query("set names utf8;");
$sql_time="select title,itemkey from game_time_code where status='0'";
$result_time=mysql_query($sql_time);
?>

<style>
.title1{text-align:right;padding-right:10px;}
</style>
<BODY bgColor=#fff style='margin:1px;padding:0px;'>


      	  <form method="POST" action="?action=save_post&flag=yes&active=game_type&id=<?php echo $id;?>"    enctype="multipart/form-data"  name="form" id="form">

	   <table class="table_add"> 
	   	<!-- <input type="hidden" name="code" value="'.$rowsk['code'].'" id="code" > -->
	   	<input type="hidden" name="code" value="2TH|2TH-dx|2BT|3TH|3TH-tx|3BT|3LH|3LH-ds|HZ-k3" id="code" >
         <tr height=30 bgcolor="#FFFFFF">
				     <td width='15%' class='title1'>类型：</td>
				     <td align=left valign=middle width='35%'>
					     <select name="skey" id="skey" style='width:80%'  onchange="get_code(this.value);" >
			<?php

	foreach ($arr_game_code as $key=> $value) {
		?>

		<option value='<?php echo $key;?>'  <?php if($rowsk['skey'] == $key ) echo "selected"; ?>><?php echo $value;?></option>


		<?php
	}



?>

						 </select>

					 </td>
					      <td class='title1'>是否启用：</td>
					 <td align=left valign=middle>
					      <input type='radio' name="status" id="status" value="0">启用
					      <input type='radio' name="status" id="status" value="1">关闭
                         维护中<input type="checkbox" value="1" name="show_nav2" <?php if($rowsk['show_nav2']==1) echo "checked"; ?>>
					     停售中<input type="checkbox" value="2" name="show_nav2" <?php if($rowsk['show_nav2']==2) echo "checked"; ?>> 		
                       <script>
					   //var obj=document.getElementsByName("status"); //("status")
					   chkradio(document.getElementsByName("status"),'<?php echo  $rowsk[status];?>')
					</script>
					 </td>


			     </tr>
				 <tr height=30 bgcolor="#FFFFFF">
				     <td width='13%' class='title1'>名称：</td>
				     <td align=left valign=middle width='35%'>
					     <input type='text' id='fullname' name='fullname' style='width:80%' value="<?php echo  $rowsk[fullname];?>">
					 </td>
				     <td class='title1' width='13%' >简称：</td>
					 <td align=left valign=middle>
					      <input type='text' id='ckey' name='ckey' style='width:80%' value="<?php echo  $rowsk[ckey];?>"  <?php if($rowsk['ckey']) echo "readonly";?>>
					 </td>

			     </tr>
				 <tr height=30 bgcolor="#FFFFFF" >


					   <td class='title1'>
					 		    <?php
					    if($rowsk['ico']){
					    ?>

			           <img src="../<?php echo $rowsk['ico'];?>" style="height:40px;">
			           <?php }
			           else{

					        echo "  图标：";
                       }

			           ?>
					 </td>
					 <td align=left valign=middle >
					    <input type='file' id='lot_ico' name='lot_ico'value="">


					 </td>



					   <td class='title1'>显示顺序：</td>
					 <td align=left valign=middle  >
					    <input type='text' id='sort' name='sort'  style='width:60px' value="<?php echo $rowsk[sort];?>">

					    (数值小的排名靠前)

					 </td>
			     </tr>

			 	 <tr height=30 bgcolor="#FFFFFF" >


					   <td class='title1'>是否自营：</td>
					 <td align=left valign=middle >
					     <input type='radio' name="self"  value="1" <?php if($rowsk['self']==1) echo "checked"; ?>>是
					     &nbsp;&nbsp;&nbsp;
					      <input type='radio' name="self"  value="0"  <?php if(!$rowsk['self']) echo "checked"; ?>>否



					 </td>

                     <td class='title1'>开奖方式：</td>
                     <td align=left valign=middle >

                         <input type="radio"  name="give_pre" value="0" <?php if($rowsk['give_pre']!=1) echo "checked";?> >随机&nbsp;


                         <input type="radio"  name="give_pre" value="1" <?php if($rowsk['give_pre']==1) echo "checked";?> >必赢

                         <span class="tips">（仅对自营彩种有效）</span>

                     </td>


			     </tr>
				 <tr height=60 bgcolor="#FFFFFF" style="display:none" >
				     <td class='title1'>玩法选择：<br>&nbsp;&nbsp;&nbsp;<input type="checkbox" value="1" onclick="click_all(this);">全选</td>
				     <td align=left valign=middle COLSPAN=3>
					 <ul   id="game_code_show"  style="width:90%;">

					   </ul>

					 </td>
			     </tr>
				 <tr height=30 bgcolor="#FFFFFF" >
				     <td class='title1'>默认玩法：</td>
					 <td align=left valign=middle >
					    <select name="firstcode" id="first_cate" >
				</select>

					 </td>

                     <td class='title1'>显示方式：</td>
                     <td align=left valign=middle >
                         <?php
                         if($rowsk['show_index']==1) $show_index='checked';else $show_index='';
                         if($rowsk['show_nav']==1) $show_nav='checked';else $show_nav='';

                         if($rowsk['icon1']==1) $icon1='checked';else $icon1='';

                         if($rowsk['icon2']==1) $icon2='checked';else $icon2='';
                         ?>


                         <input type="checkbox"  name="show_index" value="1" <?php echo $show_index;?> >首页&nbsp;&nbsp;
                         <input type="checkbox"  name="show_nav" value="1" <?php echo $show_nav;?>  style="display: none">&nbsp;&nbsp;&nbsp;

                         <input type="checkbox"  name="icon1" value="1" <?php echo $icon1;?> >推荐&nbsp;&nbsp;


                         <input type="checkbox"  name="icon2" value="1" <?php echo $icon2;?> style="display: none">

                     </td>


			     </tr>
			      <tr height=30 bgcolor="#FFFFFF" >
				     <td class='title1'>描述：</td>
					 <td align=left valign=middle colspan=3>
			     <input type='text' id='content' name='content' style='width:80%' value="<?php echo  $rowsk[content];?>" >
					 </td>
			     </tr>
   <tr height=30 bgcolor="#FFFFFF" style="display:none " >
				     <td class='title1'>期数设置：</td>
					 <td align=left valign=middle colspan=3>

    <input type='text' id='lottime' name='lottime'  style='width:60px' value="<?php echo $rowsk['lottime'];?>">

					    (1表示比预设期数快一期，-1表示比预设期数慢1期)

					 </td>


			     </tr>

				 <tr height=30 bgcolor="#FFFFFF" >
				    <td>&nbsp</td>
					<td colspan=3>
				    <input type="submit" class='button' value="确定" id='submit'></td>
				 </tr>

      </table>
      	</form>

 <script>

function show_url(thissle){
	window.location.href=G("thispath").value+'&itemkey='+thissle.value
}
selectSetItem(document.getElementById('channel'),'<?php  echo $itemkey; ?>')
</script>

</body>





<script type="text/javascript">

function click_all(div){

	var modes=document.getElementsByName('modes[]');

	for(var i=0;i<modes.length;i++){

	if(div.checked==true){

modes[i].checked=true;


	}

	else modes[i].checked=false;
	}
	set_code();
}


function set_code(){
	var modes=document.getElementsByName('modes[]');
var str='';
for(var i=0;i<modes.length;i++){

if(modes[i].checked==true){

if(str=='')  str=modes[i].value;
else str+='|'+modes[i].value;

}


}

// document.getElementById('code').value=str;
document.getElementById('code').value="2TH|2TH-dx|2BT|3TH|3TH-tx|3BT|3LH|3LH-ds|HZ-k3";



}
function get_code(skey){


	   ajaxobj=new AJAXRequest;
       ajaxobj.method="GET";

       ajaxobj.url="action.aspx?active=game_code&ckey=<?php echo $rowsk['ckey'];?>&skey="+skey;
       ajaxobj.callback=function(xmlobj){
			var response = xmlobj.responseText;
			// document.getElementById('game_code_show').innerHTML=response;
			document.getElementById('game_code_show').innerHTML='<li><input type="checkbox" name="modes[]" value="2TH" checked="" onclick="set_code();">二同号复选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="2TH-dx" checked="" onclick="set_code();">二同号单选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="2BT" checked="" onclick="set_code();">二不同号&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="3TH" checked="" onclick="set_code();">三同号单选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="3TH-tx" checked="" onclick="set_code();">三同号通选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="3BT" checked="" onclick="set_code();">三不同号&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="3LH" checked="" onclick="set_code();">三连号通选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="3LH-ds" checked="" onclick="set_code();">三连号单选&nbsp;&nbsp;</li><li><input type="checkbox" name="modes[]" value="HZ-k3" checked="" onclick="set_code();">和值&nbsp;&nbsp;</li>';

		       set_code();
		}
       ajaxobj.send();


       ajaxobj=new AJAXRequest;
       ajaxobj.method="GET";

       ajaxobj.url="action.aspx?active=game_code1&ckey=<?php echo $rowsk['ckey'];?>&skey="+skey;
       ajaxobj.callback=function(xmlobj){
			var response = xmlobj.responseText;
			// document.getElementById('first_cate').innerHTML=response;
			document.getElementById('first_cate').innerHTML='<option value="HZ-k3" selected="">和值</option>';

		       set_code();
		}
       ajaxobj.send();

}


<?php
if($rowsk['skey']){
?>
get_code('<?php echo $rowsk['skey'] ;?>');
<?php } else {?>
get_code('ssc');
<?php }?>
</script>











