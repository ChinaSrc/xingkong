<?php
/**
 * @CopyRight  (C)2006-2011 OE Development team Inc.
 * @WebSite    www.aspxcoo.com£¬www.oecms.cn
 * @Author     Chency <phpzac@foxmail.com>
 * @Brief      OEcms v3.0
 * @Update     2011.09.01
**/
function smarty_modifier_replacebr($s_content){
	$s_content = str_replace("\n", "<br />", $s_content);
	return $s_content;
}
?>