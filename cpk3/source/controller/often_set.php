<?php




$user=$db->exec("select * from user where userid='{$_SESSION['userid']}'");
$often_list=unserialize($user['often_list']);
//print_r($often_list);
if($_GET['action']=='set'){
if($_GET['num']==1){
    $game=$db->exec("select * from game_type where ckey='{$_GET['key']}'");
  $often_list[]=array('id'=>$game['id'],'key'=>$_GET['key'],'title'=>$game['fullname']);

}else{
    if(count($often_list)>0){
        foreach ($often_list as $key=>$item){
        if($item['key']==$_GET['key']) unset($often_list[$key]);
        }
    }

}
$often_list=serialize($often_list);
$db->query("update user set often_list='{$often_list}' where userid='{$_SESSION['userid']}'");
exit();
}
if($_GET['action']=='getlist'){
    if(count($often_list)>0){
        foreach ($often_list as $key=>$item){
            $game=$db->exec("select * from game_type where id='{$item['id']}'");
?>

            <li <?php if($_GET['id']==$item['id']) echo 'class="gameactive"';?> >
            <a  href="game_<?php echo $item['id']?>.html" ><h2 ><?php echo $item['title']?></h2>
                <h4 id="often_timer_<?php echo $item['key']?>">00:00:00</h4>
            </a>
                <?php
            if($game['icon1']==1){
                echo '<em class="hot">H</em>';

            }
            ?>

            <input type="hidden" name="often_list" value="<?php echo $item['key']?>">
            </li>


<?php


        }

    }
?>


<?php


    exit();
}



$often=array();
if(count($often_list)>0){
    foreach ($often_list as $key=>$value){

       $often[$value['key']]=1;


    }

}

$tpl->assign("often",$often);
$tpl->assign("often_list",$often_list);

