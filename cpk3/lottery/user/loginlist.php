<?php

$t_url="?controller=user&action=adminlog";
$pername=$_GET['pername'];
if($pername!=""){$search.=" and name='$pername'";$t_url.="&pername=".$pername;}
$begindate=strtotime($_GET['begindate']);
$enddate=strtotime($_GET['enddate']);
$IPInfor=$_GET['ip'];
if($IPInfor){
    if(strpos($IPInfor,',')){
        $str=str_replace(",","','",$IPInfor);
        $search.=" and ip in '$str'";
    }else{
        $search.=" and ip='$IPInfor'";
    }
    $t_url.="&ip=".$IPInfor;
}
if($begindate!=""){$time=" time>'$begindate'";$t_url.="&begindate=".$_GET['begindate'];}
if($enddate!=""){$time=" time<'$enddate'";$t_url.="&enddate=".$_GET['enddate'];}
if($begindate!=""and $enddate!=""){$time="and user_login_log.creatdate between '$begindate' and '$enddate'";}
if($time!=""){$search.=$time;}

$begintime=$_GET['begintime'];
$endtime=$_GET['endtime'];

;echo '
';$body_top_title="搜索记录";include(ROOT_PATH."/".$AdminPath."/body_line_top.php");

if(!$_GET['userid']){
	echo '
    <form name="form1" id="form1" method="get" action="./?controller=user&action=loginlist">
        <input name="controller" type="hidden" value="user" />
        <input name="action" type="hidden" value="loginlist" />
        <div class="search_box">
            &nbsp;用户名:
            <input name="pername" id="pername" class="input"  type="text" value="';echo $pername;;echo '" size="15" maxlength="20" />
            &nbsp;IP地址:
            <input name="ip" id="ip" class="input"  type="text" value="';echo $_GET['ip'];;echo '" size="15" maxlength="60" />
            时间:
            <input type="text" name="begintime"  value="';echo $begintime;;echo '"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:';echo "'yyyy-MM-dd'"; echo ',alwaysUseStartDate:false})" />
            至
            <input type="text" name="endtime"  value="';echo $endtime;;echo '"  class="Wdate" type="text" onclick="WdatePicker({dateFmt:';echo "'yyyy-MM-dd'"; echo ',alwaysUseStartDate:false})" />&nbsp;
            
            <input type="submit"  class="button" name="submit" value="提交" />
            <a href="javascript:;" class="button openWindow"  style="color: #fff;display: none">重开窗口</a>
        </div>
    </form>
	';
}

else $search.=" and uid='{$_GET['userid']}'";
echo '

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0  style="margin-top:5px;">
  <TBODY>
    <TR>
      <TD  align="center" bgColor=#f3f3f3><table> <tr>
			<th bgcolor="#FFFFFF">用户名</th>
			<th bgcolor="#FFFFFF">地址</th>
			<th bgcolor="#FFFFFF">IP</th>
 			<th bgcolor="#FFFFFF">内容</th>
 			<th bgcolor="#FFFFFF">操作系统</th>
 			<th bgcolor="#FFFFFF">浏览器</th>
 			<th bgcolor="#FFFFFF">时间</th>
          <!-- <th bgcolor="#FFFFFF">操作</th> -->
       </tr>
       <form name="myform" id="myform" method="post" action="../';echo $headpath;;echo '/save_post.aspx?active=lotTime" >
       <input name="flag" type="hidden" value="save" />
       <input name="playkey" type="hidden" value="';echo $playkey;;echo '" />
	   ';

$sql_p="SELECT * FROM userlog where 1=1 $search ";
if($begintime) {
	$time=strtotime($_GET['begintime'].' 00:00:00');
	$sql_p.=" and time>='{$time}' ";
}else{
  	$date = date('Y-m-d', strtotime('-7 days'));
    $time=strtotime($date.' 00:00:00');
    $sql_p.=" and time>='{$time}' ";
}
if($endtime) {
	$time=strtotime($_GET['endtime'].' 23:59:59');
	$sql_p.=" and time<='{$time}' ";
}else{
  $time=strtotime(date('Y-m-d').' 23:59:59');
  $sql_p.=" and time<='{$time}' ";
}
$sql_p.="order by time desc ";
$page=new Page($sql_p,$pagesize,$_GET['page']);
$sql_p.="limit $page->from,$pagesize";

$result3=mysql_query($sql_p);
while($rows3=mysql_fetch_array($result3)){
    if($flowid%2==1){$bgcolor="#f0f0f9";}else{$bgcolor="#FFFFFF";}
    echo "<tr height='25' align='center' style='background:".$bgcolor.";'>";
    echo "<td>".$rows3[name]."</td>";
    echo "<td>".$rows3[address]."</td>";
    echo "<td>".$rows3[ip]."</td>";
    echo "<td>".$rows3['content']."</td>";
    echo "<td>".$rows3['system']."</td>";
    echo "<td>".$rows3['ie']."</td>";
    echo "<td>".date('Y-m-d H:i:s',$rows3['time'])."</td>";
    //echo "   <td> <div align='center'><a class='mouse_show link_01' onclick=\"winPop({title:'删除数据',width:'400',drag:'true',height:'120',url:'".ROOT_URL."/".$AdminPath."/?action=dele_post&flag=yes&dbname=userlog&id=".$rows3[id]."'})\">删除</a></div></td>";
}
;echo '
        </form>
	</table>
</div>
';
?>
<script src="style/mar-admin/js/jquery.min.js"></script>
<script>
  $('.openWindow').show().click(function() {
    var href = window.location.href + '&' + Date.parse(new  Date());
    $('.tags-view-content .tag', parent.document).removeClass('active');
    $('.tags-view-content', parent.document).append('<div class="tag active"> <span class="tag-dot-inner"></span>登陆日志<span class="tag-close">x</span></div>');
    $('#iframe-main .iframe', parent.document).removeClass('active');
    $('#iframe-main', parent.document).append('<div class="iframe active"><iframe src="'+ href +'" frameborder="0"></iframe></div>');
  });
</script>
    <div class="page">
        <?php
        echo $page->get_page();
        ?>
    </div>
<script src="WdatePicker.js" type="javascript"></script>
<?php
include(ROOT_PATH."/".$AdminPath."/body_line_bottom.php");
?>