<?php
$games = isset($_GET['games']) ? $_GET['games'] :  $_POST['games']; 
$playid = isset($_GET['playid']) ? $_GET['playid'] :  $_POST['playid']; 
$contents = isset($_GET['contents']) ? $_GET['contents'] :  $_POST['contents']; 
$posturl=$do_this_url."&flag=yes&games=".$games."&playid=".$playid;
$contents=trim(htmlspecialchars($contents));

	if($contents){
		if($playid==""){echo "<script>window.setTimeout('pop.close();',3000);</script>";exit;}  
		$contents=str_replace("\r\n",",",$contents);
		if(strpos($contents,'，')){$contents=str_replace("，",",",$contents);}
		if(strpos($contents,';')){$contents=str_replace(";",",",$contents);;}
		if(strpos($contents,'；')){$contents=str_replace("；",",",$contents);}
		if(strpos($contents,'　')){$contents=str_replace("　",",",$contents);}
        
		if(strpos($games,'11-5') or strpos($games,'PK10')){
		
			$arr_s=explode(",",$contents);
			
			foreach ($arr_s as $key=>$value){
				
				if(strpos($value, ' ')===false){
					$temp='';
				for($i=0;$i<strlen($value);$i=$i+2){
					
					if(!$temp) $temp=substr($value, $i,2);
					else $temp.=' '.substr($value, $i,2);
					
					
				}
				
				$arr_s[$key]=$temp;	
			}	
			
			}
			
		}else{ 
			$contents=preg_replace("/\s+/", ",", $contents);
			if(strpos($contents,',')){$arr_s=explode(",",$contents);}else{$arr_s=explode(" ",$contents);}
		}
		$arrs=array_filter($arr_s);
	
		$lis=implode(",", $arrs);
		$lostArrs_same=array_diff_assoc($arr_s,$arrs);
		if($_GET['wei_num']) $wei_num=$_GET['wei_num'];
		else $wei_num='';
if($_GET['bei_num']) $bei_num=$_GET['bei_num'];
		else $bei_num=1;
		
		$arrs=Core_Fun::inputds($arrs,$games,$playid);$lostinfo="";
	//	print_r($arrs);
		if(count($arrs[0])-1>=0){ //G("lt_sel_nums").innerHTML = listnum;Count_Money();
			$newArrs=implode(",", $arrs[0]);
			$lostArrs=implode(",",$arrs[1]);
			if($lostArrs){$lostinfo="已过滤：".count($arrs[1]).'注';}
			$reinfor="计算完毕!去除重复，共计".count($arrs[0])*$bei_num.'注';

			 
		}else{
			$reinfor="没有合格号码，请确认您号码是否符合要求"; 

			
		}
		
		
		echo $reinfor.'|'.count($arrs[0])*$bei_num."|".$newArrs.'|'.count($arrs[1]);

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