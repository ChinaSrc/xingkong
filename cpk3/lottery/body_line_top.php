<?php echo header("content-type:text/html; charset=utf-8"); ?>


<?php

if($ps_nav!=1  and $_GET['from']!='parent'){

	?>

	<div  id="secondary_bar" >


	<?php
	$view=0;
	$admin_group=$_SESSION['admin_group'];

	$role=$db->exec("select * from `role` where id='{$admin_group}'");

$role_list=$role['content'];;
		$str="controller={$_GET[controller]}&action={$_GET['action']}";


		foreach ($arr_item as $key=>$value){

		foreach ($value as $value1) {

				if(strpos($value1[1], $str)!==false){

$group=explode(',', $value1[2]);

if(strpos($role_list, $value1[1])!==false){

	$view=1;
	break;
}


				}

		}

		}


	if(strpos($_SERVER['REQUEST_URI'], 'welcome')!==false) $view=1;

	if($view==0){
			echo "<script>alert('您无权限访问该页面');history.back();</script>";
		return  false;


	}
	$ps_nav=1;

	if($_GET['st1']){
?>



<?php if($_GET['st3']) echo "&gt;&gt;".$_GET['st2'];;?>

<?php }

else{
	$str="controller={$_GET[controller]}&action={$_GET['action']}";

	if($_GET[controller]=='system' and ($_GET['action']=='config' or $_GET['action']=='activelog' )){

		$str.="&type=".$_GET['type'];

	}
$nav=0;
	foreach ($arr_item as $key=>$value){

		foreach ($value as $value1) {
				if(strpos($value1[1], $str)!==false  and $nav==0){

		?>
                    <div class="breadcrumbs_container">
                        <article class="breadcrumbs"><a >当前位置：<strong>后台</strong></a>
                            <div class="breadcrumb_divider"></div> <span id="position"><a><?php echo $arr_menu[$key][0];?></a>

                                <div class="breadcrumb_divider"></div><a class="current"><?php echo $value1[0];?></a></span></article>
                    </div>

<div style="float: right;padding-right:10px;">

    <a href="javascript:location.replace(location.href);" title="刷新" class="button" style="color: #fff;"><img src="images/icon_refresh.png" > 刷新</a>

</div>

			<?php
			$nav=1;
			break;
		}

		}


	}


}
?>
</div>

<div style='display:block;height:40px;width:100%;clear:both;'></div>




<?php
}
else{
?>




<?php }?>


<script>

function   dialogtop(){
		var sTop=document.body.scrollTop+document.documentElement.scrollTop;
	var top =window.screen.height/2-document.getElementById('dialogBox').offsetHeight/2-20;


	 	document.getElementById('dialogBoxShadow').style.top=	document.getElementById('dialogBox').style.top='100px';

}
window.onscroll = function() {
dialogtop();
}


</script>