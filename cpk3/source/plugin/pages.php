<?php
foreach ($_GET as $key=> $value) {
	if($key!='page' and !strpos($pageurl, $key))
	$pageurl.="&{$key}={$value}";
}
if($allnum>0){
if($allnum%$pagelist>0){$maxpage=(int)($allnum/$pagelist)+1;}else{$maxpage=$allnum/$pagelist;}
if($pages-1<=0){$lastpage=1;}else{$lastpage=$pages-1;}
if($pages+1>=$maxpage){$nextpage=$maxpage;}else{$nextpage=$pages+1;}
$minlist=$pages-2;
$maxlist=$pages+2;
if($maxlist>=$maxpage){$maxlist=$maxpage;if($maxpage-4>0){$minlist=$maxpage-4;}else{$minlist=1;}}
if($minlist<=0){$minlist=1;if($minlist+4<$maxpage){$maxlist=$minlist+4;}else{$maxlist=$maxpage;}}
?>
<div style='display: block;height:50px;line-height:50px;clear:both;width:100%'>
<div class='div_left'>页次：<?php echo $pages;?>/<?php echo $maxpage;?>页 &nbsp;<?php echo $pagelist;?>条/页  共：<?php echo $allnum;?> 条</div>


<div class='div_right'>
<?php if($maxpage>1){?>
<ul class='pages_ul'>
<?php 
if($pages>1){
?>
<li ><a href='<?php echo $pageurl;?>&pages=1#toppage'>首页</a></li>
<li><a href='<?php echo $pageurl;?>&pages=<?php echo $lastpage;?>#toppage'>上一页</a></li>
<?php }?>


<?php 
for ($i=$minlist;$i<=$maxlist;$i++){
if($pages-$i==0){$cur="cur";}else{$cur="";}
?>


<li id='<?php echo $cur;?>'><a href='<?php echo $pageurl;?>&pages=<?php echo $i;?>#toppage'><?php echo $i;?></a></li>
<?php }?>

<?php if($pages<$maxpage){?>
<li ><a href='<?php echo $pageurl;?>&pages=<?php echo $nextpage;?>#toppage'>下一页</a></li>
<li ><a href='<?php echo $pageurl;?>&pages=<?php echo $maxpage;?>#toppage'>尾页</a></li>

<?php }?>
<li>
<?php 
for ($i=1;$i<=$maxpage;$i++){
	if($i==$pages) $selected="selected";
	else $selected='';
$goto.="<option value='{$i}' {$selected} >{$i}</option>";
	
}


echo "&nbsp;转到<select style='margin-top:14px;'onchange=\"location.href='".$pageurl."&pages='+this.value\">{$goto}</select>页";
?>

</li>
</ul>
<?php }?>
</div><div style='clear:both;'></div>


</div>

<?php
}

?>


