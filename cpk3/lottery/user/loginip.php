<?php

include(ROOT_PATH."/".$AdminPath."/body_line_top.php");


    ?>

<style>
    .line {height:40px;line-height: 40px;border-bottom: 1px #ddd dotted;padding: 0 10px;font-size: 16px;}
   .line a{text-decoration: underline;color: #3388ff;}
</style>



<?php

$sql="select DISTINCT ip from userlog order by id desc";

$list=$db->fetch_all($sql);
foreach ($list as $value){

   $result= $db->fetch_all("select DISTINCT uid from userlog where ip='{$value['ip']}' order by id desc  ");
  if(count($result)>1){
$user=get_user_info($result[0]['uid']);

$row=$db->exec("select * from userlog where ip='{$value['ip']}' order by id desc limit 0,1")
  ?>
      <div class="line">
          IP:<a href="?controller=user&action=loginlist&ip=<?php echo $value['ip']?>"><?php echo $value['ip']?></a><span class="tips">(<?php echo $row['address']?>)</span>  ,
          会员：<a href="?controller=user&action=index&ip=<?php echo $value['ip']?>"><?php echo $user['username'] ?></a>(等),相同IP会员数量:<a href="?controller=user&action=index&ip=<?php echo $value['ip']?>"><?php echo count($result);?></a>

      </div>


      <?php

  }


}



?>
