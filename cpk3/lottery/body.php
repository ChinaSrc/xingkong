<?php
echo '<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="images/style.css" media="all" />
<link href="images/menu.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
<script type="text/javascript">
hs.graphicsDir = \'highslide/graphics/\';
hs.outlineType = \'rounded-white\';
hs.wrapperClassName = \'draggable-header\';
</script>
<SCRIPT language=javascript src="js/date/pop.js"></SCRIPT>
<SCRIPT language=javascript src="js/global.js"></SCRIPT>
<SCRIPT language=javascript>
		
function fnOnPageChanged(page) {
         var url = \'index.aspx?controller=project&action=index&page=\' + page;
         document.location.href = url;
}			

   // function  validate(){
   // if  (document.form1.username.value==""){
        //alert("用户名不能为空");
        //document.form1.username.focus();
        //return false ;}}
</Script>  
</head>
<BODY bgColor=#dfdfdf>


<SPAN id=ShowSound></SPAN>
<script language="javascript">
var SoundSecond = "swf/second.swf";//秒钟声音文件
var FlashSecond = "<object classid=\'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\' codebase=\'http://download.macromedia.com/source/plugin/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\' width=\'0\' height=\'0\' id=\'f_s\'><param name=\'movie\' value=\'"+SoundSecond+"\'><param name=\'quality\' value=\'high\'><param name=\'wmode\' value=\'transparent\'></object>"
function Sound(flag)
{
		if(flag==1)
		{
			if(document.all("ShowSound")!=null)
			{
				document.all("ShowSound").innerHTML = FlashSecond;
			}
		}
}
</script>
                   

                   

<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>搜索记录</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3><table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
 <form name="form1" id="form1" method="post" action="" > <tr>
    <td width="73" align="right">&nbsp;单号:</td>
    <td width="506">
      <input name="projectno"  class="input"  type="text" value="" size="20" maxlength="20" /></td>
 </tr>
  <tr>
    <td width="73" align="right">&nbsp;用户ID:</td>
    <td width="506">
      <input name="user_id"  class="input"  type="text" value="" size="20" maxlength="20" /></td>
 </tr>   
 <tr>
    <td width="73" align="right">&nbsp;用户名:</td>
    <td width="506">
      <input name="username"  class="input"  type="text" value="" size="20" maxlength="20" /></td>
 </tr>      <tr> 
              <td align="right" >&nbsp;起始日期:</td>
              <td> <input  class="input"   value="" name="starttime" type="text" id="starttime" onClick="popUpCalendar(this, form1.starttime, \'yyyy-mm-dd\')" size="10">
                - 
                <input  class="input"   value="" name="endtime" type="text" id="endtime" onClick="popUpCalendar(this, form1.endtime, \'yyyy-mm-dd\')" size="10">              </td>
            </tr> <tr>
    <td colspan="2" ><hr align="left" size="1" noshade /></td>
    </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit"  class="button" name="submit" value="提交" /></td>
  </tr></form>

<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE>






<br>




                   

<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      <TD width=14><IMG height=29 src="images/table_top_r1_c1.gif" width=14></TD>
      <TD background=images/table_top_r1_c2.gif><SPAN 
      class=mframe-t-text><STRONG>充值记录</STRONG></SPAN></TD>
      <TD width=16><IMG height=29 src="images/table_top_r1_c3.gif" 
  width=16></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      
      <TD  align="center" bgColor=#f3f3f3><table> <tr>
      <td colspan="9" bgcolor="#FFFFFF">
	  
	  <UL id=navlist >
	  
 
	  
 <LI id=active><A id=current   href="?controller=account&action=index&flag=add">充值记录</A>
  <LI ><A  href="?controller=account&action=index&flag=withdraw">提现记录</A>
  <LI ><A  href="?controller=account&action=index">银行账变</A>


 
   
</UL></td>
</tr>
    <tr>
      <th width="6%" bgcolor="#FFFFFF">Id</th>
          <th width="15%" bgcolor="#FFFFFF">单号</th>   
          <th width="13%" bgcolor="#FFFFFF">类别</th>
		  <th width="11%" bgcolor="#FFFFFF">用户名 / ID</th>
         
          <th width="10%" bgcolor="#FFFFFF">金额</th>   
         
          <th width="10%" bgcolor="#FFFFFF">操作前</th>  
          <th width="10%" bgcolor="#FFFFFF">操作后</th>
          <th width="16%" bgcolor="#FFFFFF">操作时间</th>
          <th width="9%" bgcolor="#FFFFFF">说明</th>
    </tr>
        
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;730</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110929AKZEZFVLUB">20110929AKZEZFVLUB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=155"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">chen1397 / 155</a></td>
      
          <td bgcolor="#FFFFFF">
		  +10000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">10000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-29 14:02:11</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;727</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110929TBGAKQIDFB">20110929TBGAKQIDFB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +9500.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">9500.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-29 12:46:13</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;724</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110929LVNDRBFOFY">20110929LVNDRBFOFY</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=152"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang133 / 152</a></td>
      
          <td bgcolor="#FFFFFF">
		  +30000.0000		  </td>
          <td bgcolor="#FFFFFF">0.3920</td>
     
          <td bgcolor="#FFFFFF">30000.3920</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-29 12:37:35</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;720</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=HQH000000000001523007343">HQH000000000001523007343</a></td>   <td bgcolor="#FFFFFF"></td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=162"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">gang2022 / 162</a></td>
      
          <td bgcolor="#FFFFFF">
		  +500.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">500.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-29 10:25:35</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;700</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=HQH000000000001522742358">HQH000000000001522742358</a></td>   <td bgcolor="#FFFFFF"></td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">5000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-28 21:16:17</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;688</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110928DASZLECHSB">20110928DASZLECHSB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">5000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-28 15:15:02</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;682</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110928HSXBHDAZOB">20110928HSXBHDAZOB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">5000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-28 10:30:25</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;670</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927EXYSPTMHAB">20110927EXYSPTMHAB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +3000.0000		  </td>
          <td bgcolor="#FFFFFF">2000.0000</td>
     
          <td bgcolor="#FFFFFF">5000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 20:21:57</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;666</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927KMQFWAQNDB">20110927KMQFWAQNDB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=154"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang1019 / 154</a></td>
      
          <td bgcolor="#FFFFFF">
		  +10000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0550</td>
     
          <td bgcolor="#FFFFFF">10000.0550</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 20:20:00</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;655</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927FCJGHVTAPB">20110927FCJGHVTAPB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +10000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">10000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 16:43:56</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;653</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927ACGRESYTKB">20110927ACGRESYTKB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=157"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qiao9969 / 157</a></td>
      
          <td bgcolor="#FFFFFF">
		  +700.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">700.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 16:43:35</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;651</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927CVHKIVGZEB">20110927CVHKIVGZEB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=161"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">cjm666 / 161</a></td>
      
          <td bgcolor="#FFFFFF">
		  +3000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">3000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 16:43:05</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;649</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110927LWOSCEYTZM">20110927LWOSCEYTZM</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=152"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang133 / 152</a></td>
      
          <td bgcolor="#FFFFFF">
		  +30000.0000		  </td>
          <td bgcolor="#FFFFFF">0.3920</td>
     
          <td bgcolor="#FFFFFF">30000.3920</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-27 14:15:09</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;644</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110926RDZNEYJVGR">20110926RDZNEYJVGR</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +6900.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">6900.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 23:59:24</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;643</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110926BVTPVDGVJB">20110926BVTPVDGVJB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">5000.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 23:09:12</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;641</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110926QWJDJZPOQE">20110926QWJDJZPOQE</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=152"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang133 / 152</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.3920</td>
     
          <td bgcolor="#FFFFFF">5000.3920</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 22:48:20</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;639</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110926ZIIGNDJVUB">20110926ZIIGNDJVUB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=156"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qang123 / 156</a></td>
      
          <td bgcolor="#FFFFFF">
		  +1500.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">1500.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 19:35:49</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;635</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=20110926WGOTNLIIPB">20110926WGOTNLIIPB</a></td>   <td bgcolor="#FFFFFF">上级充值</td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=157"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">qiao9969 / 157</a></td>
      
          <td bgcolor="#FFFFFF">
		  +300.0000		  </td>
          <td bgcolor="#FFFFFF">0.0000</td>
     
          <td bgcolor="#FFFFFF">300.0000</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 19:26:55</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;629</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=HQH000000000001520820802">HQH000000000001520820802</a></td>   <td bgcolor="#FFFFFF"></td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=152"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang133 / 152</a></td>
      
          <td bgcolor="#FFFFFF">
		  +5000.0000		  </td>
          <td bgcolor="#FFFFFF">0.3921</td>
     
          <td bgcolor="#FFFFFF">5000.3920</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 19:08:33</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
                <tr>
          <td bgcolor="#FFFFFF">&nbsp;625</td>
          <td bgcolor="#FFFFFF">
           <a href="/adminxp/?controller=account&action=payment&projectno=HQH000000000001520473187">HQH000000000001520473187</a></td>   <td bgcolor="#FFFFFF"></td>   
          <td bgcolor="#FFFFFF"><a href="/adminxp/?controller=user&action=view&flag=edit&id=154"  onclick="return hs.htmlExpand(this, { objectType: \'iframe\' } )">wang1019 / 154</a></td>
      
          <td bgcolor="#FFFFFF">
		  +2000.0000		  </td>
          <td bgcolor="#FFFFFF">0.0551</td>
     
          <td bgcolor="#FFFFFF">2000.0550</td>
          <td align="center" bgcolor="#FFFFFF">2011-09-26 14:21:35</td>   
          <td align="center" bgcolor="#FFFFFF">已支付		  </td>
        </tr>
         <tr>
      <td colspan="9" bgcolor="#FFFFFF">	  
	    共有 100 记录 第 1 / 5 页  每页 20 记录  <span align=right>   <STRONG>1<STRONG>  <a href=\'index.aspx?controller=account&action=index&classid=&lotteryid=&starttime=&endtime=&projectno=&expect=&username=&flag=add&page=2\'>2</a>  <a href=\'index.aspx?controller=account&action=index&classid=&lotteryid=&starttime=&endtime=&projectno=&expect=&username=&flag=add&page=3\'>3</a>  <a href=\'index.aspx?controller=account&action=index&classid=&lotteryid=&starttime=&endtime=&projectno=&expect=&username=&flag=add&page=4\'>4</a>  <a href=\'index.aspx?controller=account&action=index&classid=&lotteryid=&starttime=&endtime=&projectno=&expect=&username=&flag=add&page=5\'>5</a>   &nbsp;&nbsp;</span><SELECT name=\'pageJumper\' size=\'1\' onchange=\'window.location=this.value\'>
<option value="http://www.youjiukeji.com:1122/adminxp/?controller=account&action=index&flag=add&page=0" selected>第 1 页</option>
<option value="http://www.youjiukeji.com:1122/adminxp/?controller=account&action=index&flag=add&page=1">第 2 页</option>
<option value="http://www.youjiukeji.com:1122/adminxp/?controller=account&action=index&flag=add&page=2">第 3 页</option>
<option value="http://www.youjiukeji.com:1122/adminxp/?controller=account&action=index&flag=add&page=3">第 4 页</option>
<option value="http://www.youjiukeji.com:1122/adminxp/?controller=account&action=index&flag=add&page=4">第 5 页</option>
</select>
&nbsp;&nbsp;    </td>
          </tr>
  </table>
      
        <br>
<TABLE cellSpacing=0 cellPadding=0 width=900 align=center border=0>
  <TBODY>
    <TR> 
      <TD width=22><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c1.gif" width=22 border=0 
      name=table_center_r2_c1_r1_c1></TD>
      <TD background=images/table_center_r2_c1_r1_c2.gif height=10><IMG 
      height=10 src="images/table_center_r2_c1_r1_c2.gif" width=11></TD>
      <TD width=28><IMG height=10 alt="" 
      src="images/table_center_r2_c1_r1_c3.gif" width=28 border=0 
      name=table_center_r2_c1_r1_c3></TD>
    </TR>
  </TBODY>
</TABLE>





</body>
</html>


';
?>