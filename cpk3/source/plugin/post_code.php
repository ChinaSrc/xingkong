<?php

$value = $_POST['value'];
$sec="<img src='".ROOT_URL."/images/login/icon_02.gif'>";
$err="<img src='".ROOT_URL."/images/login/icon_03.gif'>";
if ($value==$_SESSION['validationcode']){
echo "1|".$sec;
}else{
echo "0|".$err;
}

?>