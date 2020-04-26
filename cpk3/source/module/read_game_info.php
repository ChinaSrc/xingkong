<?php

include(SZS_ROOT_PATH."source/config/play/system.php");
$GetFee_Single=$con_system[GetFee_Single];
$GetFee_Single_Rate=$con_system[GetFee_Single_Rate];
$uid=$_GET[uid];
$flag="yes";
$game_info	= array();
$before=date("Y-m-d H:i:s", strtotime("-1 week"));
$game_info_sql = "select b.*,u.username,g.fullname as playname,g.skey,l.fullname as wanfa,l.cate as wancode,l.help from ".DB_PREFIX."game_buylist as b,".DB_PREFIX."user as u,".DB_PREFIX."game_type as g,".DB_PREFIX."game_ssc_list as l where b.creatdate > '$before' and (b.id='$uid' or b.buyid='$uid') and b.list_id=l.skey and g.ckey=b.playkey and u.userid=b.userid";

$game_info	= $db->fetch_first($game_info_sql);
if($game_info[id]==""){echo "'未找到此投注单!';<script>setTimeout('parentDialog.close();',1000);</script>";exit;}
$nowtime=date("Y-m-d H:i:s",time());
$player_item=$game_info['player_item'];
$prize_time=$game_info[prize_time];
if($game_info[status]!="0"){$flag="no";}
if($game_info[userid]-$userid!=0){$flag="no";}
if($prize_time==""){
$disabled="style='display:none'";
}else{
$T_date=date("Ymd",time());
$T_time=date("His",time());
$pri_date=date('Ymd',strtotime($prize_time));
$pri_time=date('His',strtotime($prize_time));
if($T_date-$pri_date!=0){
$disabled="style='display:none'";
}else{
if($T_time-$pri_time>=0){$disabled="style='display:none'";$flag="no";}
if($pri_time-$T_time<=30){$disabled="style='display:none'";$flag="no";}
}
}
$wanfa=get_game_mark($uid,1);

?>
<head>
<style type="text/css">
body{font-size:12px;}
div{font-size:12px;}
td{font-size:12px;height:40px;}
th{font-size:12px;height:40px;}
tr{font-size:12px;height:40px;}
#J-lottery-info-status{display: inline-block;padding-left: 10px;}
#J-lottery-info-status span {
    display: inline-block;
    font-size: 12px;
    padding:0px  5px;
    height:20px;line-height: 20px;
    margin:0px 3px;
    border-radius: 3px;
    background-color: #ff9726;
    color:#fff;
}

#J-lottery-info-status span:first-child{background-color: #00c77a}
#J-lottery-info-status span:last-child{background-color: #3388ff}
</style>
</head>

<table  width="100%" cellpadding="4" cellspacing="1" bgcolor="#dddddd">
<input id=nowtime value='<?php echo $nowtime;?> ' style=display:none>
<input id=pri_time value='<?php echo $pri_time;?> ' style=display:none>
<input id=pri_date value='<?php echo $pri_date;?> ' style=display:none>
<input id=pri_mode value='<?php echo $rowss[pri_mode];?>' style=display:none>


<tr height="30">
<td align="right" width='12%' bgcolor="#FFFFFF" class="narrow-label">游戏账户:</td>
<td align="left" width='21%' bgcolor="#FFFFFF"><?php echo $game_info[username]?></td>
<td  align="right" width='12%' bgcolor="#FFFFFF" class="narrow-label">彩种:</td>
<td  align="left" width='21%' bgcolor="#FFFFFF"><?php echo $game_info[playname]?></td>



</tr>
    <tr>



<td align="right" width='12%'  bgcolor="#FFFFFF" class="narrow-label">玩法:</td>
<td align="left" bgcolor="#FFFFFF"><?php echo $wanfa?>
<?php
if($rowss[is_zuih]=="yes"){
if($rowss[is_succeed]=="yes"){$l_uid=$game_info[z_number];}else{$l_uid=$game_info[id];}
$this_url=$do_url."?mod=read&code=game&list=task&flag=yes&uid=".$l_uid;
?>

<span>( <a href='<?php echo $this_url;?>'><font color='red'>追号单记录</font></a> )</span>

<?php }?></td>

<td align="right" bgcolor="#FFFFFF" class="narrow-label" style=overflow:hidden>注单编号:</td>
<td  align="left" bgcolor="#FFFFFF">
     <div style="word-wrap: break-word;word-break:break-all;"><?php echo $game_info[buyid]?></div>
</td>
    </tr>
    <tr>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">投注时间:</td>
<td align="left" bgcolor="#FFFFFF"><?php echo $game_info[creatdate]?></td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">投注期号:</td>
<td align="left" bgcolor="#FFFFFF"><?php echo $game_info[period]?>

<?php
	if($game_info['z_number'])$zz=$game_info['z_number'];
	else $zz=$game_info['id'];
	$list=$db->fetch_all("select * from game_buylist where (z_number='$zz' or id='$zz') order by period asc");
if($list){

$this_url=$do_url."?mod=read&code=game&list=task&flag=yes&active=lot_back&uid=".$zz;
?>

</td>
<?php }?>
</td>
</tr>
    <tr>
        <td align="right" bgcolor="#FFFFFF" class="narrow-label">返点模式:</td>
        <td align="left" bgcolor="#FFFFFF"><span style="line-break:break-all;"><?php echo $game_info[pri_mode].'%';?></span></td>



        <td align="right" bgcolor="#FFFFFF" class="narrow-label">投注类型:</td>
        <td align="left" bgcolor="#FFFFFF">
            <?php if($game_info['is_zuih']=='yes') echo "追号";
            else echo "正常投注";?>

        </td>
    </tr>
<tr height="30">
    <?php
    if($game_info['skey']=='k3'){
        ?>
        <td align="right" bgcolor="#FFFFFF" class="narrow-label">每注金额:</td>
        <td align="left" bgcolor="#FFFFFF"><?php echo $game_info['money']/$game_info['nums'];?>元</td>

    <?php
    }
    else{
        ?>
        <td align="right" bgcolor="#FFFFFF" class="narrow-label">模式/倍数:</td>
        <td align="left" bgcolor="#FFFFFF"><?php echo '2'.$game_info[modes]."/".$game_info[times].'倍';?></td>

    <?php
    }
    ?>

<td align="right" bgcolor="#FFFFFF" class="narrow-label">注数:</td>
<td align="left" bgcolor="#FFFFFF"><?php echo $game_info[nums]?></td>
</tr>

    <tr>

<td align="right" bgcolor="#FFFFFF" class="narrow-label">投注总额:</td>
<td align="left" bgcolor="#FFFFFF"><span id=all_money><?php echo $game_info[money]?>元</span></td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">状态:</td>
<td align="left" bgcolor="#FFFFFF">

<?php

echo show_buystatus($game_info);?>
</td>
</tr>

<tr height="30">
<td align="right" bgcolor="#FFFFFF" class="narrow-label">中奖金额:</td>
<td align="left" bgcolor="#FFFFFF"><span id=pri_money>


        <?php if($game_info['status']>0 and $game_info['status']<9)echo $game_info[pri_money];else echo '---'?></span></td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">开奖号码:</td>

<?php
if(strlen($game_info[pri_number])>10){

	$num=explode(',', $game_info[pri_number]);
	for ($i=0;$i<count($num);$i++){
		if($i!=count($num)-1)$pri_list.=$num[$i].',';
		else{

$pri_list.=$num[$i];

		}
		if($i==10) $pri_list.="<br>";

	}

}else{
$pri_list=$game_info[pri_number];

if($game_info['skey']=='k3' and $pri_list!=''){

    $num=explode(',', $game_info[pri_number]);
    $sum=0;
    foreach ($num as $value){
        $sum+=$value;
    }

    if($sum>10) $dx='大';else $dx='小';
    if($sum%2==1) $ds='单';else  $ds='双';
$pri_list.="<div id='J-lottery-info-status'><span>{$dx}</span> <span>{$ds}</span> <span>和值:{$sum}</span> </div>";
}

}
?>
<td align="left" bgcolor="#FFFFFF" style="width:100px;word-wrap:break-all;"><?php if($pri_list) echo $pri_list;else echo '-';?></td>
</tr>
    <tr>
        <td align="right" bgcolor="#FFFFFF" class="narrow-label">盈亏:</td>
        <td align="left" bgcolor="#FFFFFF" class="narrow-label">  <?php if($game_info['status']>0 and $game_info['status']<9)echo $game_info[pri_money]-$game_info['money'];else echo '---'?></span></td>
<td align="right" bgcolor="#FFFFFF" class="narrow-label">操作:</td>
<td align="left" bgcolor="#FFFFFF">
<?php
if($_SESSION['userid']==$game_info['userid'] and time()<$game_info['endtime'] and $game_info['status']=='0'){
		$this_url="do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&uid=".$game_info[id];
?>
<!--<a href='<?php echo $this_url;?>'>撤单</a>-->
<?php }else{?>
---
<?php }?>



</td>
</tr>



	<?php
if(count($list)>1 and $game_info['is_zuih']=='yes'){?>
	<tr>

<td align="left" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;line-height:30px;" valign='top' colspan="2">
投注内容<br>
<textarea rows="5" style='width:100%;height:150px;' readonly><?php echo $game_info[number]?></textarea>
</td>

<td align="left" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;line-height:30px;" colspan="3">
追号列表<br>
<div  style="text-align:center;border:1px #ccc solid;text-align:left;height:150px;overflow-y:scroll;" id="z_div">


<?php

foreach ($list as $value) {
$status=show_buystatus($value);
$this_url=$do_url."?mod=read&code=game&list=info&flag=yes&active=lot_back&uid=".$value[id];
$pri_list='';
if(strlen($value[pri_number])>10){

	$num=explode(',', $value[pri_number]);
	for ($i=0;$i<count($num);$i++){
		if($i!=count($num)-1)$pri_list.=$num[$i].',';
		else{

$pri_list.=$num[$i];

		}
		

	}

}else{
$pri_list=$value[pri_number];
}
?>
		
		<div  style='padding-left:10px;'><?php echo $value['period'];?>[<?php echo $value['times'];?>倍]<?php if($value[pri_money]) echo '开奖号码['.$pri_list.']奖金['.$value[pri_money].']';  ?> 
		 <?php echo $status;?>
		<?php


        if($value['status']!=9){
            if($_SESSION['admin_id']){
                $this_url="do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&uid=".$value[id];
                ?>
                <a href='<?php echo $this_url;?>'>撤单</a>
                <?php
            }
            else{

                if( time()<$value['endtime'] and $value['status']=='0'){

                    if($_SESSION['userid']==$value['userid']){
                        $this_url="do.aspx?mod=back&code=game&list=info&flag=yes&active=lot_back&user=1&uid=".$value[id];
                        ?>
                        <a href='<?php echo $this_url;?>'>撤单</a>
                        <?php
                    }

                }

            }


        }

           ?>





		</div>

		



			<?php

		}


		?>



	</div>


</td>
</tr>


<?php }
else{
?>
	<tr>

<td align="left" bgcolor="#FFFFFF" style="word-break:break-all;white-space:normal;overflow:hidden;word-wrap:break-word;" colspan="6">
投注内容<br>
<textarea rows="5" style='width:100%;' readonly><?php echo $game_info[number]?></textarea>
</td>
</tr>


<?php }?>
</table>


<script>
function show_div(div){

 if(document.getElementById(div).style.display=='none'){
	 document.getElementById(div).style.display='block'

	 }

 else{
	 document.getElementById(div).style.display='none'
	 }


}


</script>
