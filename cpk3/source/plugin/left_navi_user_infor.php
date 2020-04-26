<?php
 
$users=($_SESSION['userlist']);
$LPATH = dirname($_SERVER["REQUEST_URI"]);
$nickname=$_SESSION['nickname'];
$username=$_SESSION['username'];
include("head.php");
if($nickname==""){$nickname=$username;}
$amount=$_SESSION['amount'];
if($LPATH=="/user"){
echo "<div class='menu'>";
echo "<div class='menu_01'>个人信息</div>";
echo " <div class='menu_02'> ";
echo "	  <ul> ";
echo "	    <li>昵称:".$username."&nbsp;&nbsp;<span id='userswitch' style='cursor:pointer;'>隐藏</span><img src='../images/new_passport/icon_04.jpg' width='9' height='11' /></li> ";
echo "     <li style='margin-top:10px;'>";
echo "          <table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td colspan='2'><hr /></td></tr>";
echo "              <tr><td>余额:<span id='leftusermoney'></span></td>";
echo "                   <td width='1'><img src='../images/new_passport/icon_03.jpg' id='refreshimg' style='cursor:pointer;' onclick=\"GetUserMoney()\"></td>";
echo "               </tr>";
echo "            </table>";
echo "       </li> ";
echo "       <li><span id='message'></span></li> ";
echo "       <li>可开户数额:".$users->proxynum."</li> ";
echo "      </ul>";
echo "   </div>";
echo "   <div style='text-align:center;'>";
echo "	   <span><img id='toggleImg' src='../images/blue/load.jpg' style='cursor:pointer;' onclick='parent.mainframe.window.location=\"safe_recharge.aspx\"'></span>";
echo "	   <span><img id='toggleImg' src='../images/blue/withdraw.jpg' style='cursor:pointer;' onclick='parent.mainframe.window.location=\"safe_platform.aspx\"'></span>";
echo "   </div>";
echo "   <div class='menu_06'></div>";
echo "</div> ";
}else{
if($LPATH=="/highgame"){$this_money=$hig_amount;}else if($LPATH=="/lowgame"or $LPATH=="/lowproxy"){$this_money=$low_amount;}
echo "<div class='menu'>";
echo "<div class='menu_01'>个人信息</div>";
echo "   <div class='menu_02' id='userswitchdiv'> ";
echo "      <ul style='list-style:none;'>";
echo "	    <li>昵称:".$users->nickname."&nbsp;&nbsp;<span id='userswitch' style='cursor:pointer'>展开</span>";
echo "		   <img src='../highgame/images/new_higame/icon_04a.jpg' width='9' height='11' />";
echo "		</li>";
echo "        <li  style='display:none;'><hr /></li>";
echo "        <li style='display:none;'>余额:<span id='leftusermoney'></span>　";
echo "		   <img src='../highgame/images/new_higame/icon_03.jpg' id='refreshimg' width='15' height='18' style='cursor:pointer;margin-top:2px;' onclick=\"GetUserMoney()\">";
echo "		</li>";
echo "      	<li style='display:none;'></li>";
echo "     </ul>";
echo "  </div>";
echo "<div class='menu_06'></div>";
echo "</div>";
}
echo "<input type=hidden id='this_money' value='".$LPATH."'>"
;echo '<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<script>   
   var UserMoney=getCookie("UserMoney"); 
   var hig_amount=getCookie("hig_amount");
   var low_amount=getCookie("low_amount");
   var this_money;var paths=G(\'this_money\').value;
   if(paths=="/highgame"){this_money=hig_amount;}else if((paths=="/lowgame")||(paths=="/lowproxy")){this_money=low_amount;}else{this_money=UserMoney;}
   G("leftusermoney").innerHTML=moneyFormat(this_money);
   GetUserMoney();
</script>


';
?>