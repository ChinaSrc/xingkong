<?php
echo ' 
<style type="text/css">
@charset "utf-8";
div{@charset "utf-8";} ul{list-style-type: none;}
body{font: 12px "courier new";background-color:#585858;}
.prize_top{background-image: url(../images/prize_top.png); background-repeat: no-repeat;cursor:pointer;}
    *{padding:0; margin:0;}
    #roll{height:50px;margin:5px 10px;margin-top:10px; width:760px;overflow:hidden;color:#CBCBCB;text-align:left;}
    #roll li{height:20px;}  
	.cls_container ul{list-style-type:none;margin:0;padding:0;margin-left:0px;margin-right:0px;t}
	.cls_container ul li{height:20px;width:50%;padding:0px 5px;float:left;display:inline;text-align:left;}
</style>  
<div class=\'prize_top\' style="height:70px;width:780px;">
     <ol id="roll">
	 ';
$myfile =ROOT_PATH."/".$AdminPath."/lottery/pri_top.txt";
$last_file = file_get_contents($myfile);
$arr = explode("\r\n",$last_file);
for($e=0;$e<count($arr);$e++){
$l_s=explode("|",$arr[$e]);
if($e==0 or $e%2==0){$re_inner.="<li class='cls_container'><ul id='end'>";}
if($arr[$e]!=""){
$re_inner.= "<li>恭喜【<font color='red'><b>".$l_s[0]."</b></font>】".$l_s[2]."<font color='#00FF00'>".$l_s[4]."</font>期,喜中<b style='color:#00FF00'>".$l_s[1]."</b>大奖</li>";
}
if(($e+1)%2==0){$re_inner.= "</ul></li>";}
}
echo $re_inner;
;echo '    </ol>
</div> 
<div id="bug"></div> 
 
<script>
	(function(A){
    function _ROLL(obj){
    this.ele = document.getElementById(obj);
    this.interval = false;
    this.currentNode = 0;
    this.passNode = 0;
    this.speed = 0;
    this.childs = _childs(this.ele);
    this.childHeight = parseInt(_style(this.childs[0])[\'height\']);
    addEvent(this.ele,\'mouseover\',function(){
    window._loveYR.pause();
    });
    addEvent(this.ele,\'mouseout\',function(){
    window._loveYR.start(_loveYR.speed);
    });
    }
    function _style(obj){
    return obj.currentStyle || document.defaultView.getComputedStyle(obj,null);
    }
    function _childs(obj){
    var childs = [];
    for(var i=0;i<obj.childNodes.length;i++){
    var _this = obj.childNodes[i];
    if(_this.nodeType===1){
    childs.push(_this);
    }
    }
    return childs;
    }
    function addEvent(elem,evt,func){
    if(-[1,]){
    elem.addEventListener(evt,func,false);
    }else{
    elem.attachEvent(\'on\'+evt,func);
    };
    }
    function innerest(elem){
    var c = elem;
    while(c.childNodes.item(0).nodeType==1){
    c = c.childNodes.item(0);
    }
    return c;
    }
    _ROLL.prototype = {
    start:function(s){
    var _this = this;
    _this.speed = s || 0;
    _this.interval = setInterval(function(){
    _this.ele.scrollTop += 1;
    _this.passNode++;
    if(_this.passNode%_this.childHeight==0){
    var o = _this.childs[_this.currentNode] || _this.childs[0];
    _this.currentNode<(_this.childs.length-1)?_this.currentNode++:_this.currentNode=0;
    _this.passNode = 0;
    _this.ele.scrollTop = 0;
    _this.ele.appendChild(o);
    }
    },_this.speed);
    },
    pause:function(){
    var _this = this;
    clearInterval(_this.interval);
    }
    }
    A.marqueen = function(obj){A._loveYR = new _ROLL(obj); return A._loveYR;}
    })(window);
    marqueen(\'roll\').start(100/*速度默认100*/);


</script>
';
?>