<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/2
 * Time: 10:46
 */
$cate='33';
$sql="select * from news where cate='{$cate}' order by sort asc, id desc ";
$page=new Page($sql,20,$_GET['page']);
$sql.=" limit {$page->from},20";

$list=$db->fetch_all($sql);


$tpl->assign('list',$list);

if($_GET['itemid']) {


    $itemid = $_GET['itemid'];

    $news = $db->exec("select * from news where id='{$itemid}'");
    $tpl->assign('news', $news);
    $tpl->assign('type', 'info');
}

$tpl->assign('navtitle','彩票资讯');