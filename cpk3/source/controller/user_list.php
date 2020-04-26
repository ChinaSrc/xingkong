<?php



if($_GET['username']){
    $uu=$db->fetch_first("select * from user where username='{$_GET['username']}' and admin='0'");
    if(is_team($uu['userid'], $_SESSION['userid'])){
        if($_GET['st']==2)
            $sql="select * from user where higherid='{$uu['userid']}'and admin='0'";
            else
        $sql="select * from user where username='{$_GET['username']}'and admin='0'";



    }

    else     $sql="select * from user where 1=2 and admin='0'";
}
else{


    $sql="select * from user where higherid ='{$_SESSION['userid']}' and admin='0' ";


}
if($_GET['order']) $order=$_GET['order'];
else $order='userid desc';
$tpl->assign('order',$order);
$sql.=" order by {$order} ";

$page= new Page($sql,20,$_GET['page']);

$sql.=" limit {$page->from},20";
$tpl->assign('page',$page->get_page());


$user_list=$db->fetch_all($sql);
if(count($user_list)){
    foreach ($user_list as $key=>$value){
      
      $rebates=unserialize($value['rebates']);
      if($value['higherid']){
        $parent=   get_user_info($value['higherid']);
        $parent_rebates=unserialize($parent['rebates']);
      }
      
      	if($value['higherid']){
          $maxrebate=$parent_rebates['k3'];
          $minrebate=$maxrebate-$con_system['rebate_cha'];

        }
      else{

        $maxrebate=$con_system['rebates_k3'];
        $minrebate=$maxrebate-$con_system['rebate_cha'];
      }
      if($minrebate<0) $minrebate=0;
      
      $user_list[$key]['maxrebate'] = $maxrebate;
      $user_list[$key]['minrebate'] = $minrebate;
      
      $pids=get_user_pid($value['userid']);
      $str='';
      for($i=count($pids)-1;$i>=0;$i--){

        if($str=='')
          $str=$pids[$i]['username'];
        else  $str.="&gt;".$pids[$i]['username'];


      }
      	$user_list[$key]['gx'] = $str;
        $user_list[$key]['amount']=get_user_amount($value['userid']);
				$higherUser = $db->exec("select `username` from user where userid={$value['higherid']}");
				$user_list[$key]['higherUser']=$higherUser['username'];
        $row=$db->exec("select count(*) as num from user where higherid={$value['userid']}");
        $user_list[$key]['next_num']=$row['num'];

        $user_list[$key]['pre']=get_user_num($value['userid'],$_SESSION['userid']);

        $group=$db->exec("select title from user_group where id='{$value['groupid']}'");
        $user_list[$key]['group_title']=$group['title'];
        $user_list[$key]['rebates']=unserialize($value['rebates']);
    }

}


$tpl->assign("user_list",$user_list);

$tpl->assign("navtitle",'下级用户');
$tpl->assign("total",$total);

?>