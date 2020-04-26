<?php

if(!defined('IN_PHPOE')) {
exit('Access Denied');
}
class Core_Page{
public static $config = array();
public static function adminpage($num,$perpage,$curr_page,$mpurl,$maxpage){
$multipage ='';
$mpurl .= strpos($mpurl,'?') ?'&amp;': '?';
if($num>$perpage){
$page    = $maxpage;
$offset  = floor($page * 0.5);
$pages   = ceil($num/$perpage);
$from    = $curr_page -$offset;
$to      = $curr_page +$page -$offset -1;
if($page >$pages){
$from = 1;
$to   = $pages;
}else{
if($from<1){
$to   = $curr_page +1 -$from;
$from =1;
if(($to -$from)<$page &&($to -$from) <$pages){
$to = $page;
}
}elseif($to>$pages){
$from = $curr_page -$pages +$to;
$to   = $pages;
if(($to -$from) <$page &&($to -$from) <$pages) {
$from = $pages -$page +1;
}
}
}
$multipage .="<td align='center' class='page_redirect' style='cursor:pointer' onmouseover=\"this.className='on_page_redirect';\" onmouseout=\"this.className='page_redirect';\" onclick=\"window.location.href='".$mpurl."page=1';\" title='首页'><img src='oecms/images/page_home.gif'></td>";
for($i=$from;$i<=$to;$i++){
if($i!=$curr_page){
$multipage.="<td align='center' class='page_number' style='cursor:pointer' onmouseover=\"this.className='on_page_number';\" onmouseout=\"this.className='page_number';\" onclick=\"window.location.href='".$mpurl."page=".$i."';\" title='第".$i."页'>".$i."</td>";
}else{
$multipage.="<td align='center' class='page_curpage' title='第".$i."页'>".$i."</td>";
}
}
$multipage.=$pages >$page ?"<td align='center' class='page_redirect' style='cursor:pointer' onmouseover=\"this.className='on_page_redirect';\" onmouseout=\"this.className='page_redirect';\" onclick=\"window.location.href='".$mpurl."page=".$pages."';\" title='尾页'><img src='oecms/images/page_end.gif'></td>":"<td align='center' class='page_redirect' style='cursor:pointer' onmouseover=\"this.className='on_page_redirect';\" onmouseout=\"this.className='page_redirect';\" onclick=\"window.location.href='".$mpurl."page=".$pages."';\" title='尾页'><img src='oecms/images/page_end.gif'></td>";
$multipage .="<td align='center'><input name='page' title='输入页码 按回车可跳转' type='text'  class='page_input' onkeypress=\"if(event.keyCode==13) window.location.href='".$mpurl."page='+value\" /></td>";
}
if(!$pages){
$recordnav = "<td align='center' class='page_total' title='总记录/每页".$perpage."个'>&nbsp;".$num."&nbsp;</td>";
}else{
$recordnav = "<td align='center' class='page_total' title='总记录/每页".$perpage."个'>&nbsp;".$num."&nbsp;</td>";
$recordnav.= "<td align='center' class='page_pages' title='当前页码/总页码'>&nbsp;".$curr_page."/".$pages."&nbsp;</td>";
}
$tabdiv.= "  <div style='float:center;'>";
$tabdiv.= "    <table border='0' cellpadding='0' cellspacing='1'>";
$tabdiv.= "      <tr>";
$tabdiv = $tabdiv.$recordnav;
$tabdiv = $tabdiv.$multipage;
$tabdiv.= "      </tr>";
$tabdiv.= "    </table>";
$tabdiv.= "  </div>";
return $tabdiv;
}
public static function volistpage($channel,$cid,$num,$perpage,$curr_page,$mpurl,$maxpage,$showphpurl=0){
self::$config = $GLOBALS['config'];
self::$config['htmltype']='php';
foreach ($_GET as $key=> $value) {
	if($key!='page' and !strpos($mpurl, $key))
	$mpurl.="&{$key}={$value}";
}
if(substr($mpurl, strlen($mpurl)-1,1)!='&') $mpurl.='&';


$multipage ='';
$pagepath = PATH_URL.$channel;
if($num>$perpage){
$page    = $maxpage;
$pages   = ceil($num/$perpage);
$offset  = floor($page * 0.5);
$from    = $curr_page -$offset;
$to      = $curr_page +$page -$offset -1;
if($page >$pages){
$from = 1;
$to   = $pages;
}else{
if($from<1){
$to   = $curr_page +1 -$from;
$from =1;
if(($to -$from)<$page &&($to -$from) <$pages){
$to = $page;
}
}elseif($to>$pages){
$from = $curr_page -$pages +$to;
$to   = $pages;
if(($to -$from) <$page &&($to -$from) <$pages) {
$from = $pages -$page +1;
}
}
}
if($curr_page>1){

$tippage = "<a href=\"".$mpurl."page=".($curr_page-1)."\">上一页</a>&nbsp;";

}
for($i=$from;$i<=$to;$i++){
if($i!=$curr_page){

$multipage .= "&nbsp;<a href=\"".$mpurl."page=".$i."\">".$i."</a>&nbsp;";

}else{

$multipage .= "&nbsp;[<a href=\"".$mpurl."page=".$i."\" class='currPage'><b>".$i."</b></a>]&nbsp;";

}
}
$tippage = $tippage.$multipage;
if($pages>1 &&$pages!=$curr_page){

$tippage .= "&nbsp;<a href=\"".$mpurl."page=".($curr_page+1)."\">下一页</a>";

}

$goto='';
for ($i=1;$i<=$pages;$i++){
	if($i==$curr_page) $selected="selected";
	else $selected='';
$goto.="<option value='{$i}' {$selected} >{$i}</option>";
	
}


$tippage.="&nbsp;转到<select style='margin-top:14px;'onchange=\"location.href='".$mpurl."page='+this.value\">{$goto}</select>页";
return $tippage;
}else{
return "";
}
}
}

?>