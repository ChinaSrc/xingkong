<?php

$action = isset($_GET[action]) ?$_GET[action] : $_POST[action];
$perid = isset($_GET[perid]) ?$_GET[perid] : $_POST[perid];
$flags="no";
if($action){
if($perid-1>=0 and $userid-$perid!=0){
$db->update(DB_PREFIX."user",array('reBonus'=>$action),"userid=".$perid."");
$flags="yes";
}
}
if($flags=="yes"){
echo "<div style='text-align:center;background:#FFFFFF;font-size:12px;padding:20px;'>操作成功!</div>";
echo "<script>setTimeout('parent.window.location.reload();',1000) </script>";
}else{
echo "<div style='text-align:center;background:#FFFFFF;font-size:12px;padding:20px;'>操作失败，刷新后重试!</div>";
echo "<script>setTimeout('parent.pop.close();',1000) </script>";
}
?>