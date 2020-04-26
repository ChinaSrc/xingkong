<?php



if($_GET['type']=='prize_huanyuan'){
	
//mysql_query("update game_set set  where `ckey`='{}'")
		$i=0;
	$game_list=$db->fetch_all("select * from game_type where `status`='0'  ");
	
	foreach ($game_list as $value) {
		$game_code=explode("|", $value['code']);
		//$i++;
		$playKey=$value['ckey'];
		foreach ($game_code as $value1) {
			
			$code_list=$db->fetch_all("select * from game_code_list where `CodeKey`='$value1'");
			if($code_list){	
			foreach ($code_list as $value2) {
				
				$ssc=$db->fetch_first("select * from game_ssc_list where skey='{$value2['ListKey']}'  ");
				$prize=$ssc['prize'];
				if($prize){
				
				$row=$db->fetch_first("select * from game_set where `ckey`='{$value2['ListKey']}'  and playKey='$playKey'");
				if($row) {
				$sql="update game_set set `prize`='{$prize}' where `id`='{$row['id']}'";
	$db->query($sql);	
				//$i++;	
				}
				else{
					
				$sql="insert into game_set(ckey,playKey,prize) values ('{$value2['ListKey']}','$playKey','{$prize}')";
					
				}
				$db->query($sql);

			$i=$i+mysql_affected_rows();
				}
			}
			
		}
		
		}
	}
	
	
	
	
	//$ssc=$db->fetch_all("select * from game_ssc_list");
	//print_r($ssc);
	//$i=0;
//	foreach ($ssc as $value) {
//		
//		$skey=$value['skey'];
//		$prize=$value['prize'];
//		if($prize){
//$sql="update game_set set `prize`='{$prize}' where `ckey`='{$skey}'";
//		$db->query($sql);
//		//echo $sql."<br>";
//		$i=$i++;
//		
//		}
//	}
	
	
	
			add_adminlog( "还原所有彩种的玩法奖金");

echo "<script>alert('更新成功');window.location='?controller=game&action=ssc_list';</script>";

	
}


$playkey=$_GET['playkey'];
if($playkey==""){$playkey="3D";}
;echo ' 
';$body_top_title="玩法管理";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

?>
<style>
    td input[type='text']{width: 100px;}

</style>
 
    <form action="" method="GET" style="line-height:50px;height:50px;"  id='form22'> 
          <input name="controller" id="controller" type="text" value="<?php echo $_GET['controller']?>" style='display:none'> 
          <input name="action" id="action" type="text" value="ssc_list" style='display:none'> 

&nbsp;    玩法类型:<select name='type'  id='playkey'  onchange="	document.getElementById('form22').submit();"";>

    <?php foreach ($arr_game_code as $key=>$value) {
    	?>
    	
    	<option  value='<?php echo $key;?>' <?php if($key==$_GET['type']) echo "selected";?>><?php echo $value;?></option>
    	<?php 
    }?>
    </select>
 

<?php 

       	if(!$_GET['type']) $type='k3';
else $type=$_GET['type'];

?>

	   <input type="button" class='button' onclick="winPop({title:'添加新玩法',width:'700',drag:'true',height:'550',url:'?controller=game&action=ssc_list_add&type=<?php echo $type; ?>'})" value='添加新玩法'>&nbsp;

		   

</form>

     <form name="myform" id="myform" method="post" action="index.aspx?action=save_post&active=ssc_prize&flag=yes" > 
       <input name="flag" type="hidden" value="save" /> 
       <input name="playkey" type="hidden" value="<?php echo $playkey;?>" />
<table> <?php 
       


					  			$config=getsql::sys();	 
		 if($config['game_qw']==2)  $where=" and  ( ckey not like '%QW%' or type='11x5' or type='kl8')";
else $where='';
       $sql="select * from game_code where type='{$type}'  {$where} order by sortnum asc, id asc";
       
       $code_list=$db->fetch_all($sql);
       
       foreach ($code_list as $value) {
       	
       $sql1="select s.* ,c.CodeTile,c.ShowTile from game_ssc_list s,game_code_list c where s.skey=c.ListKey and  c.CodeKey='{$value['ckey']}' order by c.OrderS	asc";

       
       $ssc_list=$db->fetch_all($sql1);
       
       if(count($ssc_list)>0){
       ?>
       

			<tr bgcolor='#FFFFFF'>
				<th colspan="10" style="text-align:left;font-weight:600;">
                	
					<span style="float:right; margin-right:20px">
			   <a  onclick="winPop({title:'修改分类',width:'600',drag:'true',height:'220',url:'?controller=game&action=code_edit&id=<?php echo $value['id']?>'})">修改</a>
&nbsp;&nbsp;<a onclick="winPop({title:'查看分类',width:'900',drag:'true',height:'600',url:'?controller=game&action=game_code_show&id=<?php echo $value['id']?>'})">查看</a>
                 &nbsp;
					<a onclick="winPop({title:'删除数据',width:'400',drag:'true',height:'130',url:'?action=dele_post&flag=yes&dbname=game_code&id=<?php echo $value['id']?>'})">删除</a>
					
					</span>
					&nbsp;  <?php echo $value['fullname']?>&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="spn1">[状态：<span class="state1"><?php if($value['status']=='0')echo "开启";else echo "关闭";?></span>]</span>
                    
				</th>
			</tr>
		<?php




		foreach ($ssc_list as $value1){
		   if($value1['skey']=='K3HZ'){

		       $list2=explode('|',$value1['show_key']);
		       $show_other=explode('|',$value1['show_other']);
               $maxrate=explode('|',$value1['maxrate']);
               $minrate=explode('|',$value1['minrate']);
               $prizemax=explode('|',$value1['prizemax']);
               $buymax=explode('|',$value1['buymax']);
               $buymin=explode('|',$value1['buymin']);
               $max_select=explode('|',$value1['max_select']);
               $status==explode('|',$value1['status']);
		       foreach ($list2 as $key2=>$value2){


		           ?>
                   <tr bgcolor='#FFFFFF'>
                       <td  >		<?php echo $value2;?>
                           <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][show_other]" value="<?php echo $show_other[$key2]?>" >
                         </td>
                       <td  >
                           最高<?php if($_GET['type']=='k3') echo "赔率";else  echo "奖金"; ?>：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][maxrate]" value="<?php echo $maxrate[$key2]?>" ></td>
                       <td  >
                           最低<?php if($_GET['type']=='k3') echo "赔率";else  echo "奖金"; ?>：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][minrate]" value="<?php echo $minrate[$key2]?>" ></td>


                       <td  >
                           中奖最高金额：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][prizemax]" value="<?php echo $prizemax[$key2]?>" ></td>
                       <td  >
                           最高注数：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][max_select]" value="<?php echo $max_select[$key2]?>" ></td>
                       <td  >
                           最低消费：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][buymin]" value="<?php echo $buymin[$key2]?>" ></td>
                       <td  >
                           最高消费：         <input type="text" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][buymax]" value="<?php echo $buymax[$key2]?>" ></td>
                       <td  >
                           <input type="button" value="描述" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;描述信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=content&id=<?php echo $value1['id'];?>'})">
                           <input type="button" value="帮助" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;帮助信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=help&id=<?php echo $value1['id'];?>'})">
                           <input type="button" value="示例" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;示例信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=example&id=<?php echo $value1['id'];?>'})">

                       </td>

                       <td align='center' > 启用<input type="checkbox" name="<?php echo $value1['skey'];?>[<?php echo $key2;?>][status]" value="0" <?php if($status[$key2]==0) echo "checked";?> ></span></td>

                       <td align='center'>

<input type="button" class="button" value="保存" onclick='click_update("<?php echo $value1['skey'];?>","<?php echo $key2;?>")' >
                       </td>
                   </tr>



                   <?php
               }



           }else {




		?>

               <tr bgcolor='#FFFFFF'>
                   <td  >		<?php echo $value1['CodeTile'];?><input type="text" name="<?php echo $value1['skey'];?>[ShowTile]" value="<?php echo $value1['ShowTile'];?>" >
                   </td>
                   <td  >
                       最高<?php if($_GET['type']=='k3') echo "赔率";else  echo "奖金"; ?>：         <input type="text" name="<?php echo $value1['skey'];?>[maxrate]" value="<?php echo $value1['maxrate'];?>" ></td>
                   <td  >
                       最低<?php if($_GET['type']=='k3') echo "赔率";else  echo "奖金"; ?>：         <input type="text" name="<?php echo $value1['skey'];?>[minrate]" value="<?php echo  $value1['minrate'];?>" ></td>


                   <td  >
                       中奖最高金额：         <input type="text" name="<?php echo $value1['skey'];?>[prizemax]" value="<?php echo $value1['prizemax'];?>" ></td>
                   <td  >
                       最高注数：         <input type="text" name="<?php echo $value1['skey'];?>[max_select]" value="<?php echo $value1['max_select']?>" ></td>
                   <td  >
                       最低消费：         <input type="text" name="<?php echo $value1['skey'];?>[buymin]" value="<?php echo $value1['buymin']?>" ></td>
                   <td  >
                       最高消费：         <input type="text" name="<?php echo $value1['skey'];?>[buymax]" value="<?php echo $value1['buymax']?>" ></td>

                   <td  >
                       <input type="button" value="描述" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;描述信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=content&id=<?php echo $value1['id'];?>'})">
                       <input type="button" value="帮助" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;帮助信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=help&id=<?php echo $value1['id'];?>'})">
                       <input type="button" value="示例" onclick="winPop({title:'修改<?php echo $value1['CodeTile'];?>&nbsp;示例信息',width:'500',drag:'true',height:'260',url:'?controller=game&action=ssc_list_update&type=example&id=<?php echo $value1['id'];?>'})">

                   </td>
                   <td align='center' > 启用<input type="checkbox" name="<?php echo $value1['skey'];?>[status]" value="0" <?php if($value1['status']==0) echo "checked";?> ></span></td>

                   <td align='center'>

                       <input type="button" class="button" value="保存" onclick='click_update("<?php echo $value1['skey'];?>",0)' >
                   </td>
               </tr>


			
			<?php }
		} ?>
		
       
       
       <?php }
       }
       ?>
       
       
       
       </table>
       
       
       
        </form>
       
<?php 

      
    

include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>

<script type="text/javascript">
function huanyuan_prize(){
var ss=confirm('还原之后不可恢复，确定要还原吗? ');
if(ss == true){
	window.location='?controller=game&action=ssc_list&type=prize_huanyuan';
	
}else{

	return false;
	}
	
}

function  click_update(name,key) {

        var arr1=new Array('show_other','minrate','maxrate','prizemax','max_select','buymin','buymax','status');
   var str=''
       if(name=='K3HZ'){
         for(var i=0;i<arr1.length;i++){
             var arr=  document.getElementsByName(name+'['+key+']['+arr1[i]+']')  ;
            str+="&"+arr1[i]+"="+arr[0].value;

         }

       }
       else{

           for(var i=0;i<arr1.length;i++){
               if(arr1[i]=='show_other') arr1[i]='ShowTile';
               var arr=  document.getElementsByName(name+'['+arr1[i]+']')  ;
               str+="&"+arr1[i]+"="+arr[0].value;

           }
       }
        var url='?action=save_post&flag=yes&active=ssc_list_update&name='+name+'&key='+key;

        ajaxobj=new AJAXRequest;
        ajaxobj.method="POST";
        ajaxobj.content=str;
        ajaxobj.url=url;
        ajaxobj.callback=function(xmlobj){
            var response = xmlobj.responseText;
         add_tips(response,1);
        };
        ajaxobj.send()

}



function search(){
if(document.getElementById('keyword').value==''){

alert("请输入关键字");

	return false;
}
else{

window.location='?controller=game&action=ssc_list&keyword='+document.getElementById('keyword').value;
	
}


	
}


</script>

