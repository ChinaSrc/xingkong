<?php

if(!defined('IN_PHPOE')) {
exit('Access Denied');
}
class Core_Command{
protected static $config = array();
protected static $obj = NULL;
public static function runlog($loguser="",$content,$type=1){
self::$obj = $GLOBALS['db'];
if(!Core_Fun::ischar($loguser)){
if($type==1){
$loguser = $GLOBALS['libadmin']->uc_adminname;
}else{
}
}
$logid = self::$obj->fetch_newid("SELECT MAX(logid) FROM ".DB_PREFIX."log",1);
$array = array(
'logid'=>$logid,
'username'=>$loguser,
'ip'=>Core_Fun::getip(),
'content'=>$content,
'logtype'=>$type,
'timeline'=>time(),
);
self::$obj->insert(DB_PREFIX."log",$array);
}
public static function command_savetag($channel,$tags){
self::$obj = $GLOBALS['db'];
if(Core_Fun::ischar($tags)){
$tagtp = explode(",",$tags);
for($ii=0;$ii<sizeof($tagtp);$ii++){
$tag = trim($tagtp[$ii]);
if(!(self::$obj->checkdata("SELECT tagid FROM ".DB_PREFIX."tag WHERE tag='".$tag."' AND channel='".$channel."'"))){
$tagid = self::$obj->fetch_newid("SELECT MAX(tagid) FROM ".DB_PREFIX."tag",1);
$array = array(
'tagid'=>$tagid,
'tag'=>$tag,
'channel'=>$channel,
'flag'=>1,
'timeline'=>time(),
);
self::$obj->insert(DB_PREFIX."tag",$array);
}
}
}
}
public static function command_replacetag($checktag=1,$channel="",$contenttag,$content){
$tag_content = $content;
if(!Core_Fun::ischar($content)){
}else{
self::$config  = $GLOBALS['config'];
self::$obj     = $GLOBALS['db'];
if($checktag==0){
$sql  = "SELECT tag,url,target,color,strong FROM ".DB_PREFIX."tag WHERE flag=1";
if(self::$config['tagrange']==1){
$sql .= " AND channel='".$channel."'";
}
$tags = self::$obj->getall($sql);
foreach($tags as $key=>$value){
$tagurl = "";
$tagurl = $value['tag'];
if($value['strong']==1){
$tagurl = "<strong>".$tagurl."</strong>";
}
if($value['color']!=""){
$tagurl = "<font color=".$value['color'].">".$tagurl."</font>";
}
if($value['url']!=""){
$tag_target = "";
if($value['target']==1){
$tag_target = "_blank";
}else{
$tag_target = "_self";
}
$tagurl = "<a href=\"".$value['url']."\" target=$tag_target>".$tagurl."</a>";
}
$tag_content =  str_replace($value['tag'],$tagurl,$tag_content);
}
}else{
if($contenttag!=""){
$explodetag = explode(",",$contenttag);
for($i=0;$i<sizeof($explodetag);$i++){
$splittag = $explodetag[$i];
if(self::$config['tagrange']==1){
$sql = "SELECT tag,url,target,color,strong FROM ".DB_PREFIX."tag WHERE flag=1 AND channel='".$channel."'";
}else{
$sql = "SELECT tag,url,target,color,strong FROM ".DB_PREFIX."tag WHERE flag=1";
}
$sql .= " AND tag='".$splittag."'";
$tag = self::$obj->fetch_first($sql);
if($tag){
$tagurl = "";
$tagurl = $tag['tag'];
if($tag['strong']==1){
$tagurl = "<strong>".$tagurl."</strong>";
}
if($tag['color']!=""){
$tagurl = "<font color=".$tag['color'].">".$tagurl."</font>";
}
if($tag['url']!=""){
$tag_target = "";
if($tag['target']==1){
$tag_target = "_blank";
}else{
$tag_target = "_self";
}
$tagurl = "<a href=\"".$tag['url']."\" target=$tag_target>".$tagurl."</a>";
}
$tag_content =  str_replace($splittag,$tagurl,$tag_content);
}
}
}
}
}
return $tag_content;
}
}

?>