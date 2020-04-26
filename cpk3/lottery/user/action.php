<?php

$active=$_GET['active'];



if($active=='update'){

    $uid=$_GET['userid'];
  	if (!is_numeric($_GET['userid'])) {
		exit();
	}
    $db->query("update user set `{$_GET['key']}`='{$_GET['value']}' where userid='{$uid}'");
    echo "<script>window.location='".$_SERVER['HTTP_REFERER']."';</script>";
    exit();
}
?>