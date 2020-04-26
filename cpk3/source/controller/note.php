<?php
$note=$db->fetch_all("select * from news where id>0 and (cate='13' or cate in (select id from news_cate where pid='13') ) order by `sort` asc,id desc  ");

if(count($note)>0){
foreach ($note as $key=>$value) {
	  $row=	$db->fetch_first("select * from news_cate where id='{$value['cate']}'");
                             $note[$key]['catename']=$row['title'];

                             $note[$key]['date']=date('Y-m-d H:i:s',$value['time']);
                            $view=explode(',', $value['view']) ;
                            if(in_array($_SESSION['userid'], $view)) $note[$key]['is_view']=1;
                            else $note[$key]['is_view']=0;



}
}

$tpl->assign('note_list',$note);

if($_GET['id']) {$id=$_GET['id'];	$tpl->assign("navtitle",'系统公告');}
else {$id=$note[0]['id'];$tpl->assign("navtitle",'公告详情');}


$news=$db->exec("select * from news where id='{$id}'");
    $view=explode(',', $news['view']) ;
if(!in_array($_SESSION['userid'], $view)) {
if($news['view']) $str=$news['view'].','.$_SESSION['userid'];
else $str=$_SESSION['userid'];
$db->query("update news set view='{$str}' where id='{$id}'");


}
$tpl->assign('news',$news);