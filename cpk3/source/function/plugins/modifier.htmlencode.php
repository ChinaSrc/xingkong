<?php
/**
 * @CopyRight  (C)2006-2011 OE Development team Inc.
 * @WebSite    www.aspxcoo.com£¬www.oecms.cn
 * @Author     XiangFeng <phpzac@foxmail.com>
 * @Brief      OEcms v3.x
 * @Update     2011.09.23
**/
function smarty_modifier_htmlencode($str){
	$str = str_replace("<!--{","&lt;!--{",$str);
	$str = str_replace("}-->","}--&gt;",$str);
	$str = str_replace("<?","&lt;?",$str);
	$str = str_replace("?>","?&gt;",$str);
	$str = preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str);
	$str = preg_replace("/<(i?frame.*?)>(.*?)<(\/i?frame.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str);
	$str = preg_replace("/<\!--.*?-->/si","&lt;!--$1--&gt;",$str);
	$str = preg_replace("/<(\/?html.*?)>/si","$1",$str);
	$str = preg_replace("/<(\/?head.*?)>/si","$1",$str);
	$str = preg_replace("/<(\/?meta.*?)>/si","$1",$str);
	$str = preg_replace("/<(\/?body.*?)>/si","$1",$str);
	$str = preg_replace("/<(\/?link.*?)>/si","$1",$str);
	$str = preg_replace("/<(\/?form.*?)>/si","$1",$str);
	$str = preg_replace("/<(style.*?)>(.*?)<(\/style.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str);
	$str = preg_replace("/<(title.*?)>(.*?)<(\/title.*?)>/si","&lt;$1&gt;$2&lt;$3&gt;",$str);
	return $str;
}
?>