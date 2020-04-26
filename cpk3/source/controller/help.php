<?php


$cate='30';
$list=$db->fetch_all("select * from news where cate='{$cate}' order by sort asc, id asc ");


$tpl->assign('list',$list);

if($_GET['itemid']) $itemid=$_GET['itemid'];
else $itemid=$list[0]['id'];
$news=$db->exec("select * from news where id='{$itemid}'");
$tpl->assign('news',$news);



?>