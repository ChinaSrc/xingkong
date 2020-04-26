<script type="text/javascript" src="<?echo SZS_ROOT_URL;?>js/common.js"></script> 
<script type="text/javascript" src="<?echo SZS_ROOT_URL;?>js/jquery.js"></script> 
<style type="text/css">
body{ font-size:12px;}
input{ vertical-align:middle; margin:0; padding:0}
.file-box{width:100%;padding:10px 0px;}
.txt{ height:18px; border:1px solid #cdcdcd; width:100px;}
.btn{ background-color:#F4A908;color:#653809;border:1px solid #CDCDCD;height:26px;line-height:26px; width:70px;cursor:pointer;}
.btn:hover{ background-color:#222;color:#FFF;border:1px solid #CDCDCD;height:26px;line-height:26px; width:70px;cursor:pointer;}
.files{height:25px;border:1px solid #cdcdcd;line-height:25px;}
</style>
<?php
$games = isset($_GET['games']) ? $_GET['games'] :  $_POST['games']; 
$playid = isset($_GET['playid']) ? $_GET['playid'] :  $_POST['playid']; 
$contents = isset($_GET['contents']) ? $_GET['contents'] :  $_POST['contents']; 
$posturl=$do_this_url."&flag=yes&games=".$games."&playid=".$playid;
$contents=htmlspecialchars($contents);

	if($contents){
		if($playid==""){echo "<script>window.setTimeout('pop.close();',3000);</script>";exit;}  
		$contents=str_replace("\r\n",",",$contents);
		if(strpos($contents,'，')){$contents=str_replace("，",",",$contents);}
		if(strpos($contents,';')){$contents=str_replace(";",",",$contents);;}
		if(strpos($contents,'；')){$contents=str_replace("；",",",$contents);}
		if(strpos($contents,'　')){$contents=str_replace("　",",",$contents);}
        
		if(strpos($games,'11-5')){
			$arr_s=explode(",",$contents);
		}else{ 
			$contents=preg_replace("/\s+/", ",", $contents);
			if(strpos($contents,',')){$arr_s=explode(",",$contents);}else{$arr_s=explode(" ",$contents);}
		}
		$arrs=array_filter($arr_s);
	
		if($playid!='RXDS_5z5') $arrs=array_unique($arrs); 
		$lis=implode(",", $arrs);
		
		$lostArrs_same=array_diff_assoc($arr_s,$arrs);
		if($_GET['wei_num']) $wei_num=$_GET['wei_num'];
		else $wei_num='';
if($_GET['bei_num']) $bei_num=$_GET['bei_num'];
		else $bei_num=1;
		
$arrs=Core_Fun::inputds($arrs,$games,$playid);
	$lostinfo="";
		if(count($arrs[0])-1>=0){ //G("lt_sel_nums").innerHTML = listnum;Count_Money();
		
//		foreach ($arrs[1] as $key=>$value) {
//					$arrs[0][]=$value;
//					
//					$arrs[1][$key]='';
//				}
//$arrs[0].=",".$arrs[1];
//$arrs[1]='';				
//			
			
			$newArrs=implode(",", $arrs[0]);
			$lostArrs=implode(",",array_merge($arrs[1],$lostArrs_same));
			if($lostArrs){$lostinfo="已过滤号码：".$lostArrs;}
			$reinfor="计算完毕！";
			
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='".count($arrs[0])*$bei_num."';</script>"; 
			echo "<script>parent.document.getElementById('lt_write_box').value='".$newArrs."';</script>"; 
			echo "<script>parent.document.getElementById('lt_write_box_ok').value='".$newArrs."';</script>";  
			echo "<script>parent.document.getElementById('lt_sel_counts').click();;</script>";  
			if(strlen($lostArrs)-1<0){echo "<script>window.setTimeout('parent.pop.close();',500);</script>";}
			 
		}else{
			$reinfor="没有合格号码，请确认您号码是否符合要求"; 
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='';</script>"; 
			echo "<script>parent.document.getElementById('lt_sel_nums').innerHTML='0';parent.document.getElementById('lt_sel_money').innerHTML='0';</script>"; 
			echo "<script>window.setTimeout('parent.pop.close();',2000);</script>";
			
		}
		echo "<div style='height:20px;padding:0px;10px;text-align:center;' id='show_title'>".$reinfor."</div>"; 
		echo "<div style='height:40px;padding:5px;20px;text-align:center;overflow:auto;'>".$lostinfo."</div>";  
		echo " <div style='height:30px;text-align:center;padding:5px 20px;border-top:1px solid #cdcdcd;'>";
		echo " <input type='button' name='button' class='btn' value='关闭' onclick='parent.pop.close();'>";
		echo "</div>"; 
		exit;
		
	}else{ 
		echo "<div id='fileshowbox' style='display:none'>";
		echo "   <div style='height:60px;line-height:50px;text-align:center;' id='show_title'>请输入号码</div>";
		echo "   <div style='height:40px;padding:10px;text-align:center;border-top:1px solid #cdcdcd;'>";
		echo "   <input type='button' name='button' class='btn' value='关闭' onclick='parent.pop.close();'>";
		echo "   </div>";
		echo "</div>";
		echo "<div id='filebox' style='display:none'>";
        echo "<form id='form' name='form' action='".$posturl."' method='post' enctype='multipart/form-data'>";
        echo "<textarea id='contents' name='contents' cols=80 style='height:92px;'></textarea>";
        echo "<input type='submit' name='submit' id='submit' class='btn' value='导入'> </div></form>";
		echo "<script>$('#contents').html($('#lt_write_box',window.parent.document).html());</script>";
		echo "<script>if(document.getElementById('contents').innerHTML==''){document.getElementById('fileshowbox').style.display='';}else{document.getElementById('submit').click();}</script>";
	}
 
exit;
?>
</body>
</html> 