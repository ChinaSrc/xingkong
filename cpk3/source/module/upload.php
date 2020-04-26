<?
$games = isset($_GET['games']) ? $_GET['games'] :  $_POST['games']; 
$playid = isset($_GET['playid']) ? $_GET['playid'] :  $_POST['playid']; 
$files = isset($_POST['files']) ? $_POST['files'] :  $_GET['files']; 
$show_title="请选择文件：";
$max_file_size=1024*1024*1024;  
$contents="";$is_do="";$last_do="yes";
$ts="请确保文本内号码格式正确，号码间必须以空格或逗号分隔!";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (!is_uploaded_file($_FILES["files"][tmp_name])){  
        $show_title= "<font color=red><b>请选择文件：</b></font>";  
     }else{ 
		 $file = $_FILES["files"]; 
		 if($max_file_size < $file["size"]){
		     $ts= "<font color='red'><b>文件太大！</b></font>"; $last_do="no";
		 } 
		 if($file["size"]==0){
		     $ts= "<font color='red'><b>空文件！</b></font>"; $last_do="no";
		 } 
		 if($file["type"]!='text/plain'){ 
		     $ts= "<font color='red'><b>只能导入文本文件！</b></font>"; $last_do="no";
		 }
		 if($last_do=="yes"){
		 	 $str = "ABCDEFGHIJKLMNOPQRSTUVWSYZ";
		 	 $finalStr = ""; 
		 	 for($j=0;$j<5;$j++){$finalStr.= substr($str,rand(0,25),1);}
		 	 $ran_num="D".$userid.$finalStr.time();

		 	 $upfile=SZS_ROOT_PATH."uploads/".$ran_num.".txt"; 
		 	 if (!move_uploaded_file($_FILES['files']['tmp_name'],$upfile)){ 
                 $ts= '导入失败，请重试';  
		 	 }else{
				 $show_infor="<div style='height:20px;padding:0px;10px;text-align:center;' id='show_title'>正在处理，请稍候..</div>";
			 	 $contents=file_get_contents($upfile);$is_do="yes"; 
		 	 }
		 }
		 
		 
     }
}
    $show_infor_s="<form action='".$do_this_url."&flag=yes&games=".$games."&playid=".$playid."' method='post' enctype='multipart/form-data'>";
	$show_infor_s.="<div style='height:20px;padding:0px;10px;text-align:center;color:red;'><b>提示</b>：".$ts."</div>"; 
    $show_infor_s.="<div style='height:30px;padding:5px;20px;text-align:center;' id='show_title'>".$show_title; 
    $show_infor_s.= "<input type='file' name='files' id='files' class='files'> ";
    $show_infor_s.=" </div>";
    $show_infor_s.=" <div style='height:30px;text-align:center;padding:10px 20px;border-top:1px solid #cdcdcd;'>";
    $show_infor_s.=" <input type='submit' name='submit' class='btn' value='导入'>&nbsp;<input type='button' name='button' class='btn' value='关闭' onclick='parent.pop.close();'>";
    $show_infor_s.="</div>";
    $show_infor_s.="</form>";
if($show_infor==""){
	$show_infor=$show_infor_s;
} 
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<style type="text/css">
body{ font-size:12px;}
input{ vertical-align:middle; margin:0; padding:0}
.file-box{width:100%;padding:10px 0px;}
.txt{ height:18px; border:1px solid #cdcdcd; width:100px;}
.btn{ background-color:#FFFBD2;color:#653809;border:1px solid #CDCDCD;height:26px;line-height:26px; width:70px;cursor:pointer;}
.btn:hover{ background-color:#222;color:#FFF;border:1px solid #CDCDCD;height:26px;line-height:26px; width:70px;cursor:pointer;}
.files{height:25px;border:1px solid #cdcdcd;line-height:25px;}
</style>
</head>
<body>
<script>//alert(parent.document.getElementById('lt_write_box').innerHTML)</script>
<div class="file-box" id='filebox'>
   <?echo $show_infor;?>
</div>
<?

if($is_do=="yes"){
	if($contents){
		if($playid==""){echo "<script>document.getElementById('filebox').innerHTML='".$show_infor_s."';</script>";exit;} 

		$contents=str_replace("\r\n",",",$contents);
		$contents=preg_replace("/\s+/", ",", $contents);
		if(strpos($contents,'，')){$contents=str_replace("，",",",$contents);}
		if(strpos($contents,';')){$contents=str_replace(";",",",$contents);;}
		if(strpos($contents,'；')){$contents=str_replace("；",",",$contents);}
		if(strpos($contents,'　')){$contents=str_replace("　",",",$contents);}

		if(strpos($games,'11-5')){
			$arr_s=explode(",",$contents);
		}else{
			if(strpos($contents,',')){$arr_s=explode(",",$contents);}else{$arr_s=explode(" ",$contents);}
		} 
		$arrs=array_filter($arr_s);
		$arrs=array_unique($arrs); $lis=implode(",", $arrs);
		$lostArrs_same=array_diff_assoc($arr_s,$arrs);
		$arrs=Core_Fun::inputds($arrs,$games,$playid);$lostinfo="";
		if(count($arrs[0])-1>=0){ //G("lt_sel_nums").innerHTML = listnum;Count_Money();
			$newArrs=implode(",", $arrs[0]);  
			$lostArrs=implode(",",array_merge($arrs[1],$lostArrs_same));
			if($lostArrs){$lostinfo="已过滤号码：".$lostArrs;}
			$reinfor="恭喜，导入成功！";
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='".count($arrs[0])."';</script>"; 
			echo "<script>parent.document.getElementById('lt_write_box').value='".$newArrs."';</script>";  
			echo "<script>parent.document.getElementById('lt_write_box_ok').value='".$newArrs."';</script>";   
			echo "<script>parent.document.getElementById('lt_sel_counts').click();;</script>";    
			if(strlen($lostArrs)-1<0){echo "<script>window.setTimeout('parent.pop.close();',500);</script>";}
			 
		}else{
			$reinfor="没有合格号码，请确认您号码是否符合要求"; 
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='';</script>"; 
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='0';parent.document.getElementById('lt_sel_money').innerHTML='0';</script>"; 
			echo "<script>window.setTimeout('parent.pop.close();',3000);</script>";
			
		}
		echo "<script>document.getElementById('show_title').innerHTML='".$reinfor."';</script>"; 
		echo "<div style='height:40px;padding:5px;20px;text-align:center;overflow:auto;'>".$lostinfo."</div>";  
		echo " <div style='height:30px;text-align:center;padding:5px 20px;border-top:1px solid #cdcdcd;'>";
		echo " <input type='button' name='button' class='btn' value='关闭' onclick='parent.pop.close();'>";
		echo "</div>"; 
		exit;
		
	}else{ 
		echo "<script>document.getElementById('filebox').innerHTML='".$show_infor_s."';</script>";
	}
} 
exit;
?>
</body>
</html> 