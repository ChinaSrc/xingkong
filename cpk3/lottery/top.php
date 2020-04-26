<?php
 
$usernames=$_SESSION['username'];

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

a{color:#000;}
a:link { color:#000;text-decoration:none}
a:hover {color:#000;}
a:visited {color:#000;text-decoration:none}
a {evt:expression(window.status=\'要显示的文字\')} 
td {FONT-SIZE: 9pt; FILTER: dropshadow(color=#FFFFFF,offx=1,offy=1); COLOR: #000; FONT-FAMILY: "宋体"}



a#blue {
		width:12px;
	height:12px;
	margin-left:5px;
	background-color:#1b56c6;
	font-size: 8px;
	color:#1b56c6;
	display:inline-block;
}
a#silver {
		width:12px;
	height:12px;margin-left:5px;
	background-color:#acaec0;
	font-size: 8px;
	color:#acaec0;
	display:inline-block;
}
a#classic {
	width:12px;
	height:12px;margin-left:5px;
	background-color:#0a246a;
	font-size: 8px;
	color:#0a246a;
	display:inline-block;
}
img {filter:Alpha(opacity:100); chroma(color=#FFFFFF)}
.title1{height:31px;line-height:31px;border-bottom:#bdd3f3  1px  solid;margin-left:-20px;
FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#ffffff,endColorStr=#e5effe); /*IE 6 7 8*/ 

background: -ms-linear-gradient(top, #ffffff,  #e5effe);        /* IE 10 */

background:-moz-linear-gradient(top,#ffffff,#e5effe);/*火狐*/ 

background:-webkit-gradient(linear, 0% 0%, 0% 100%,from(#ffffff), to(#e5effe));/*谷歌*/ 

background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#e5effe));      /* Safari 4-5, Chrome 1-9*/

background: -webkit-linear-gradient(top, #ffffff, #e5effe);   /*Safari5.1 Chrome 10+*/

background: -o-linear-gradient(top, #ffffff, #e5effe);  /*Opera 11.10+*/}




.navtop{width:100%;height:30px;line-height:30px;margin-top:2px;border-bottom:1px #c6c6c6 solid;text-align:left;color:#000;}
.navtop a{color:#000;}
.navtop  .cur{font-weight:800;color:#ff0000;}
.navtop  ul li{float:left;width:120px;padding-left:5px;margin-left:5px;background-color:#ededed;border-left:#c6c6c6  1px  solid;border-top:#c6c6c6  1px  solid;border-right:#c6c6c6  1px  solid;}
.navtop  ul li{font-size:14px;}

.navtop  .close{background:url('images/close1.jpg') no-repeat;width:15px;height:26px;float:right;}
.navtop  .close:hover{background:url('images/close2.jpg') no-repeat;}


</style>


<script>

function changeStyle(v)
{

	with(parent.window.frames[0])
	{
		TaskMenu.setStyle(v);
	}
} 	  
</script>


<script language='javascript' src='js/getactivemessage.js'></script>
<script src="js/common.js"></script>
<script src="js/global.js"></script>
</head>
 
<table height="100%" width="110%" border=0 cellpadding=0 cellspacing=0   class="title1">
      <tr valign=middle>
  
		<td  align="left"  style="padding-left:100px;">您好！<?php echo $_SESSION['admin_name'];?>
&nbsp;<a href="index.aspx?controller=default&action=logout" target="_parent">注销登陆</a>
  <a href="../index.aspx" target="_blank">浏览首页&nbsp;&nbsp;</a>
    <a onclick="winPop({title:'输入金额',width:'400',drag:'true',height:'300',url:'?action=edit_body&active=user_bank&items=hig_amount&itemtype=innerHTML'})" >快捷充值</a> &nbsp;
 
		</td>


        <td align="left">快捷菜单:
        <a onclick="openurl('index.aspx?controller=user&action=recharge','充值记录');" >充值管理(<span class="red" id="charge_num"><?php echo get_funds_num('recharge');?></span>)&nbsp;&nbsp;</a>
        
        <a  onclick="openurl('index.aspx?controller=user&action=platform','提现记录');">提现管理(<span class="red" id="platform_num"><?php echo get_funds_num('platform');?></span>)&nbsp;&nbsp;</a>
        <a   onclick="openurl('index.aspx?controller=project&action=index&active=bet','投注记录');">投注记录&nbsp;&nbsp;</a>
        <a   onclick="openurl('index.aspx?controller=project&action=bank&active=account','资金流水');">资金流水&nbsp;&nbsp;</a>
            <a  onclick="openurl('index.aspx?controller=project&action=yingkui','盈亏查询');" >盈亏查询&nbsp;&nbsp;</a>
        
            

        </td>
        <td align="right">&nbsp;<font face=arial>www.dxsjs.com</font>&nbsp;&nbsp;</td>
      </tr>
    </table>

    


</html>
<?php 
	$start =array("基本信息","welcome.php");
?>

    <div class="navtop">
    <ul id="navtop">
   </ul>
 
    </div>

    
   <script type="text/javascript">
   openurl("<?php echo $start[1];?>","<?php echo $start[0];?>")
   </script>
