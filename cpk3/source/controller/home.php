<?php



 include_once 'main.php';
//通知
$note_id=13;
$note=$db->fetch_all("select * from news where id>0 and (cate='{$note_id}' or cate in (select id from news_cate where pid='{$note_id}') ) order by `sort` asc,id desc  limit 0,10");

if(count($note)>0){
    foreach ($note as $key=>$value) {
        $row=	$db->fetch_first("select * from news_cate where id='{$value['cate']}'");
        $note[$key]['catename']=$row['title'];
        $note[$key]['date']=date('Y-m-d',$value['time']);

    }

}
$tpl->assign('note',$note);

if(!$_SESSION['note_show'] or $con_system['index_note']==1){
    $_SESSION['note_show']=1;
    $tpl->assign('note_show',1);
    $note=$db->fetch_all("select * from news where id>0  and note='1' order by `sort` asc,id desc  limit 0,10");

    if(count($note)>0){
        foreach ($note as $key=>$value) {
            $row=	$db->fetch_first("select * from news_cate where id='{$value['cate']}'");
            $note[$key]['catename']=$row['title'];
            $note[$key]['date']=date('Y-m-d',$value['time']);

        }

    }
    $tpl->assign('note1',$note);
}

$tpl->assign('nav_index',1);
$tpl->assign('fileUri', FILE_URI);
?>


