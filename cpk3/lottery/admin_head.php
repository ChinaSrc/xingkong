<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理平台</title>
<link rel="Shortcut Icon" href="ico.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META http-equiv="Pragma" content="no-cache" />

<style type="text/css">
.link_01{
	color:#0000FF;text-decoration:underline;cursor: hand;
}
.link_02{
	color:#ffffff;text-decoration:underline;cursor: hand;
}
.input_G {
    border: solid #CD9B1D 1px solid;
    border-bottom: red 1px solid;
    border-left: red 2px solid;
    border-right: red 1px solid;
    border-top: red 2px solid;
    background-color: #EED2EE;
    cursor: hand;
	height:18px;size:30;
}
.mouse_show{
	cursor: pointer;
}
</style>

<?php
if($headpath==""){
$headpath = dirname($_SERVER["REQUEST_URI"]);
$headpath=str_replace("/","",$headpath);
}
if (!$pages or $pages==0){
$pages=1;
}
$pagesize=$maxnum=$con_system['admin_pagenum'];
$starnum=$pages*$maxnum-$maxnum;
$nowtime=date("Y-m-d H:i:s",time());
$nowdate=date("Y-m-d",time());
$nextdate=date('Y-m-d',strtotime("$d   +1   day"));
$lastdate=date('Y-m-d',strtotime("$d   -1   day"));
$Add_Time=" 06:00:00";


	if($_SESSION['admin_id'] ){


	    $linetime=date('Y-m-d H:i:s',time()-$con_system['OnLines']*60);
		$online=$db->fetch_first("select * from user_online where userid='{$_SESSION['admin_id']}' and uptime>'{$linetime}'");
		if($online){
			getsql::onlines();

		}else{
			$mod="login";

			$db->query("delete  from user_online where userid='{$_SESSION['admin_id']}'");
		}

	}
	else{
	echo "<script>top.location.href='admin_login.aspx';</script>";

	echo "<script>parent.window.location='admin_login.aspx';</script>";
echo "<script>window.location='admin_login.aspx';</script>";


	}

	?>


<script type='text/javascript' src='<?php echo ROOT_URL; ?>/static/js/common.js'></script>
<script type='text/javascript' src='<?php echo ROOT_URL."/".$AdminPath;?>/js/main.js'></script>
<script type='text/javascript' src='<?php echo ROOT_URL."/".$AdminPath;?>/js/global.js'></script>


<script language="javascript" type="text/javascript" src="<?php echo ROOT_URL; ?>/static/js/My97DatePicker/WdatePicker.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL."/".$AdminPath;?>/images/style.css" media="all" />
<link href="<?php echo ROOT_URL."/".$AdminPath;?>/images/menu.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../template/default/style/fontello.css" media="all" />
   <script type="text/javascript" src="../template/default/zdialog/zdrag.js"></script>
<script type="text/javascript" src="../template/default/zdialog/zdialog.js"></script>
<script language="javascript" type="text/javascript" src="../template/default/js/diags.js"></script>
<script language="javascript" type="text/javascript" src="../template/default/js/window.diags.js"></script>
</head>
<script> var ROOT_URL='<?php echo ROOT_URL; ?>';var ROOT_PATH='<?php echo ROOT_URL; ?>';var AdminPath='<?php echo $AdminPath;?>';var RootName='<?php echo $RootName;?>'; </script>



