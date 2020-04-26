<?php

if($mod){$NaviShow[$mod]="1";}
$tpl->assign("navititle",$NaviTitle);
$tpl->assign("navilist",$NaviList);
$tpl->assign("NaviShowLeft",$NaviShowLeft);
$tpl->assign("navishow",$NaviShow);
$tpl->assign("game_arrs",$con_game_list);
$last_code="";$navi_list_s="";
for ($i=0;$i<count($game_arr);$i++){
if($last_code!=""and $last_code!=$game_arr[$i][skey]){$navi_list_s.="</ul>";}
if($last_code!=$game_arr[$i][skey]){
$navi_list_s.="<li class='sub'>
			<span class='exp' onmouseover=\"secondGradeMenu(true, this.parentNode);\" onmouseout=\"secondGradeMenu(false, this.parentNode);\"><a href=\"javascript:void(0)\">".$game_code[$game_arr[$i][skey]]."</a></span>
			   <ul class='pop' onmouseover=\"secondGradeMenu(true, this.parentNode);\" onmouseout=\"secondGradeMenu(false, this.parentNode);\" style='display:none'>";
}
$navi_list_s.="<li><a href='".SZS_ROOT_URL."?mod=game&play=".$game_arr[$i][ckey]."'>".$game_arr[$i][fullname]."</a></li>";
$last_code=$game_arr[$i][skey];
}
$tpl->assign("navi_list_s",$navi_list_s);
if($mod=="game"){
$tpl->assign("con_game_list",$con_game_list);
}
?>