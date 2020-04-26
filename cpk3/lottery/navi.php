<?php

include('config.php');
echo "<script> var ROOT_URL='".ROOT_URL."';var ROOT_PATH='".ROOT_PATH."';var AdminPath='".$AdminPath."';var RootName='".$RootName."'; </script>";
;echo ' 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head> 

';
?>

<style>
.menu{border-bottom:#bdd3f3  1px  solid;}
.title1{height:30px;line-height:30px;
FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#ffffff,endColorStr=#e5effe); /*IE 6 7 8*/ 

background: -ms-linear-gradient(top, #ffffff,  #e5effe);        /* IE 10 */

background:-moz-linear-gradient(top,#ffffff,#e5effe);/*火狐*/ 

background:-webkit-gradient(linear, 0% 0%, 0% 100%,from(#ffffff), to(#e5effe));/*谷歌*/ 

background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#e5effe));      /* Safari 4-5, Chrome 1-9*/

background: -webkit-linear-gradient(top, #ffffff, #e5effe);   /*Safari5.1 Chrome 10+*/

background: -o-linear-gradient(top, #ffffff, #e5effe);  /*Opera 11.10+*/}
ul{margin-top:2px;padding-top:0;margin-bottom:5px;border-top:#bdd3f3  1px  solid;}
li{list-style-type:circle;font-size:13px;height:20px;line-height:20px;cursor:hand;}
td{color:#112b4f;font-size:15px;font-weight:800;}


</style>

<script type="text/javascript">
function show_ul(id,div){

var menu=document.getElementById('menu_'+id);

var pic=document.getElementById('pic_'+id);
if(menu.style.display=='block'){
	menu.style.display='none'
	pic.src="style/blue/jia.jpg";
}
else{

	menu.style.display='block';
	pic.src="style/blue/jian.jpg";
}	
}
</script>
<?php



$start='开奖设置';
?>

<script type="text/javascript"  src="js/global.js"></script>
<body  style='margin:0;'>

<div class='title1'  style='border-bottom:#bdd3f3  1px  solid;'>
<table  style='margin:0;padding:0;width:100%;'>
<tr style='line-height:25px;'  onclick="show_ul('<?php echo $key?>');">
<td  style='text-align:left;padding-left:5px;'>管理菜单</td>

<td style='text-align:right;float:right;padding-right:-25px;'>
<img src='style/blue/hide.jpg'   >
</td>
</tr>

</table>
</div>
<?php
$admin_group=$_SESSION['admin_group'];
foreach($arr_menu as $key=>$value){
foreach ($arr_item[$key] as $key1=>$value1){
	
	
$group=explode(',', $value1[2]);

if(in_array($admin_group, $group)){
	
	$arr_item1[$key][]=$value1;
	
	
}

if(count($arr_item1[$key])>0) $arr_menu1[$key]=$value;

	
}	
	
	
	
	
}


foreach($arr_menu1 as $key=>$value){
?>
<div class="menu" title="<?php echo $value[0]?>"   >
<div class='title1'>
<table  style='margin:0;padding:0;width:100%;'>
<tr style='line-height:25px;'  onclick="show_ul('<?php echo $key?>');">
<td  style='text-align:right;width:20px;'><img src='<?php echo $value[1];?>'  ></td>
<td style='text-align:left;'><?php echo $value[0]?></td>
<td style='text-align:right;float:right;padding-right:-25px;'><img src='style/blue/jia<?php if($key==1) echo 'n';?>.jpg' id='pic_<?php echo $key;?>'  ></td>
</tr>

</table>


</div>
<ul   id='menu_<?php echo $key?>' style='display:<?php  if($key==0) echo 'block';else echo "none";?>'>
<?php foreach ($arr_item1[$key] as $key1=>$value1) {
	
	$value1[1]=str_replace('controller=', "index.aspx?controller=", $value1[1]);
?>

<li  onclick="openurl('<?php echo $value1[1]?>','<?php echo $value1[0]?>');" title='<?php echo $value1[0]?>'><span><?php echo $value1[0]?></span></li>
<?php
if($value1[0]==$start){
?>	
	

	<?php 
}
}?>

</ul>


</div>


<?php }?>

</body>
