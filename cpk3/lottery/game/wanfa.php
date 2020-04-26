<?php




$id=$_GET['id'];
if($_POST){

	unset($_POST['submit']);
	$wanfa=serialize($_POST);
	
	$db->query("update game_type set wanfa='{$wanfa}' where id='{$_GET['id']}'");
$game=$db->exec("select * from game_type where id='{$_GET['id']}'");

add_adminlog( "设置{$game['fullname']}的玩法");
		echo "<div style='font-size:14px;text-align:center;background:#FFFFFF;'><font style='font-color:#ffffff;'>玩法设置成功</font></div>";
echo "<script>setTimeout(\"parent.window.location.reload()\",1000)</script>";
echo "<script>setTimeout(\"parent.pop.close()\",1000)</script>";exit();
	
}



$game=$db->exec("select * from game_type where id='{$_GET['id']}'");

$wanfa=unserialize($game['wanfa']);
if($game['skey']=='pk10' or $game['skey']=='kl8')
    $sql="select * from game_code where type='{$game['skey']}'  order by  sortnum asc,id asc";
else
    $sql="select * from game_code where type='{$game['skey']}' and ckey not like '%QW%' order by  sortnum asc,id asc";

$game_code=$db->fetch_all($sql);
//print_r($game);

?>
<style>
.show_list ,.show_list ul {clear:both;width:100%;display:block;}
.show_list span{float:left;width:180px;display:block;}
</style>

<form action='?controller=game&action=wanfa&id=<?php echo  $_GET['id'] ?>'method='post'>





<div style='width: 100%; margin: 0 auto;'>




				<?php 
				foreach ($game_code as $key=>$value) {
                    $sql1="select c.* ,s.fullname  from game_ssc_list s,game_code_list c where s.skey=c.ListKey and  c.CodeKey='{$value['ckey']}' order by c.OrderS	asc";
					$codelist=$db->fetch_all($sql1);
					$num=0;
					if(count($codelist)>0){
                        foreach ($codelist as $key1=> $value1) {

                            if (is_array($wanfa[$value['ckey']]) and in_array($value1['ListKey'], $wanfa[$value['ckey']])) {
                                $codelist[$key1]['check']="checked"  ;
                                $num++;

                            } else     $codelist[$key1]['check']=""  ;;


                        }
					?>
					
					<div style='line-height: 35px; border-bottom: 1px #ddd solid; width: 100%; padding-left: 5px;clear:both;display:block;'>
<div >

				
						<input type='checkbox' <?php if($num==count($codelist)) echo "checked";?> value='<?php echo $value['ckey'];?>' id='menu_<?php echo $value['ckey'];?>'   onclick='click_all("<?php echo $value['ckey'];?>");'   ><span style='font-weight: 800'><?php echo $value['fullname'];?></span>
					
					</div>
<div style='font-size: 12px;' class='show_list'>
	
					<?php 
					
					
					foreach ($codelist as $key1=> $value1) {
						
				$check=$value1['check'];
						?>
						
					<span><input type='checkbox' <?php echo $check; ?> value='<?php echo $value1['ListKey']?>'
		name='<?php echo $value['ckey']?>[]' onclick='click_all1("<?php echo $value['ckey'];?>");' ><?php echo $value1['CodeTile'].'-'.$value1['ShowTile'];?>
					</span>	
						<?php 
					}?>
				
</div>


</div>
					
					<?php 
					}
				}
				
				?>

					  	<div style='line-height: 35px; border-bottom: 1px #ddd solid; width: 100%; padding-left: 5px;clear:both;display:block;text-align:center;'>
					  	    <input type="submit" class=button value="保存" type="submit"
	id=submit name="submit">
	
	</div>
	</div>




</form>

<script type="text/javascript">


function click_all(id){
	var role=document.getElementsByName(id+'[]');
if(document.getElementById('menu_'+id).checked == true)
{

	

	for(var i=0;i<role.length;i++){

role[i].checked=true;
		
		}

	}

else{


	for(var i=0;i<role.length;i++){

		role[i].checked=false;
				
				}
	
}	
}


function click_all1(id){
	var role=document.getElementsByName(id+'[]');
var num=0;
	for(var i=0;i<role.length;i++){

		if(role[i].checked==true){
num++;
			}
				
				}

	if(num==role.length){

		document.getElementById('menu_'+id).checked = true;
		}
	else 
		document.getElementById('menu_'+id).checked = false
	
}

</script>
