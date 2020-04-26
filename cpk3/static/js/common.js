if(!Array.prototype.push){Array.prototype.push=function(){var startLength=this.length;for(var i=0;i<arguments.length;i++)this[startLength+i]=arguments[i];return this.length}};
function G(){
	var elements=new Array();
	for(var i=0;i<arguments.length;i++)
	{
		var element=arguments[i];
		if(typeof element=='string')element=document.getElementById(element);
		if(arguments.length==1)return element;elements.push(element)
	};
	return elements
 };
	Function.prototype.bind = function(object) {
    var __method = this;
    return function() {
        __method.apply(object, arguments)
    }
};
Function.prototype.bindAsEventListener = function(object) {
    var __method = this;
    return function(event) {
        __method.call(object, event || window.event)
    }
};
Object.extend = function(destination, source) {
    for (property in source) {
        destination[property] = source[property]
    };
    return destination
};
if (!window.Event) {
    var Event = new Object()
};
Object.extend(Event, {
    observers: false,
    element: function(event) {
        return event.target || event.srcElement
    },
    isLeftClick: function(event) {
        return (((event.which) && (event.which == 1)) || ((event.button) && (event.button == 1)))
    },
    pointerX: function(event) {
        return event.pageX || (event.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft))
    },
    pointerY: function(event) {
        return event.pageY || (event.clientY + (document.documentElement.scrollTop || document.body.scrollTop))
    },
    stop: function(event) {
        if (event.preventDefault) {
            event.preventDefault();
            event.stopPropagation()
        } else {
            event.returnValue = false;
            event.cancelBubble = true
        }
    },
    findElement: function(event, tagName) {
        var element = Event.element(event);
        while (element.parentNode && (!element.tagName || (element.tagName.toUpperCase() != tagName.toUpperCase()))) element = element.parentNode;
        return element
    },
    _observeAndCache: function(element, name, observer, useCapture) {
        if (!this.observers) this.observers = [];
        if (element.addEventListener) {
            this.observers.push([element, name, observer, useCapture]);
            element.addEventListener(name, observer, useCapture)
        } else if (element.attachEvent) {
            this.observers.push([element, name, observer, useCapture]);
            element.attachEvent('on' + name, observer)
        }
    },
    unloadCache: function() {
        if (!Event.observers) return;
        for (var i = 0; i < Event.observers.length; i++) {
            Event.stopObserving.apply(this, Event.observers[i]);
            Event.observers[i][0] = null
        };
        Event.observers = false
    },
    observe: function(element, name, observer, useCapture) {
        var element = G(element);
        useCapture = useCapture || false;
        if (name == 'keypress' && (navigator.appVersion.match(/Konqueror|Safari|KHTML/) || element.attachEvent)) name = 'keydown';
        this._observeAndCache(element, name, observer, useCapture)
    },
    stopObserving: function(element, name, observer, useCapture) {
        var element = G(element);
        useCapture = useCapture || false;
        if (name == 'keypress' && (navigator.appVersion.match(/Konqueror|Safari|KHTML/) || element.detachEvent)) name = 'keydown';
        if (element.removeEventListener) {
            element.removeEventListener(name, observer, useCapture)
        } else if (element.detachEvent) {
            element.detachEvent('on' + name, observer)
        }
    }
});
Event.observe(window, 'unload', Event.unloadCache, false);
function space(flag) {
    if (flag == "begin") {
        var ele = G("ft");
        if (typeof(ele) != "undefined" && ele != null) ele.id = "ft_popup";
        ele = G("usrbar");
        if (typeof(ele) != "undefined" && ele != null) ele.id = "usrbar_popup";
    } else if (flag == "end") {
        var ele = G("ft_popup");
        if (typeof(ele) != "undefined" && ele != null) ele.id = "ft";
        ele = G("usrbar_popup");
        if (typeof(ele) != "undefined" && ele != null) ele.id = "usrbar";
    };
};
var Class = function() {
    var _class = function() {
        this.initialize.apply(this, arguments)
    };
    for (i = 0; i < arguments.length; i++) {
        superClass = arguments[i];
        for (member in superClass.prototype) {
            _class.prototype[member] = superClass.prototype[member]
        }
    };
    _class.child = function() {
        return new Class(this)
    };
    _class.extend = function(f) {
        for (property in f) {
            _class.prototype[property] = f[property]
        }
    };
    return _class
};
var Popup = new Class();
Popup.prototype = {
    iframeIdName: 'ifr_popup',
    initialize: function(config) {
        this.config = Object.extend({
            contentType: 1,
            isHaveTitle: true,
            scrollType: 'yes',
            isBackgroundCanClick: false,
            isSupportDraging: true,
            isShowShadow: true,
            isHaveClose: true,
            isReloadOnClose: true,
            width: 400,
            height: 800
        },
        config || {});
        this.info = {
            shadowWidth: 4,
            title: "",
            contentUrl: "",
            contentHtml: "",
            callBack: null,
            parameter: null,
            confirmCon: "",
            alertCon: "",
            someHiddenTag: "object,embed",
            someDisabledBtn: "",
            someHiddenEle: "",
            overlay: 0,
            coverOpacity: 60
        };
        this.color = {
            cColor: "#555",
            bColor: "#ffffff",
            tColor: "#222531",
            aColor: "#d4d2cc",
            wColor: "#fff"
        };
        this.dropClass = null;
        this.someToHidden = [];
        this.someToDisabled = [];
        if (!this.config.isHaveTitle) this.config.isSupportDraging = false;
        this.iniBuild()
    },
    setContent: function(arrt, val) {
        if (val != '') {
            switch (arrt) {
            case 'width':
                this.config.width = val;
                break;
            case 'height':
                this.config.height = val;
                break;
                break;
            case 'title':
                this.info.title = val;
                break;
            case 'contentUrl':
                this.info.contentUrl = val;
                break;
            case 'contentHtml':
                this.info.contentHtml = val;
                break;
            case 'callBack':
                this.info.callBack = val;
                break;
            case 'parameter':
                this.info.parameter = val;
                break;
            case 'confirmCon':
                this.info.confirmCon = val;
                break;
            case 'alertCon':
                this.info.alertCon = val;
                break;
            case 'someHiddenTag':
                this.info.someHiddenTag = val;
                break;
            case 'someHiddenEle':
                this.info.someHiddenEle = val;
                break;
            case 'someDisabledBtn':
                this.info.someDisabledBtn = val;
                break;
            case 'overlay':
                this.info.overlay = val
            }
        }
    },
    iniBuild: function() {
        G('dialogCase') ? G('dialogCase').parentNode.removeChild(G('dialogCase')) : function() {};
        var oDiv = document.createElement('span');
        oDiv.id = 'dialogCase';
        document.body.appendChild(oDiv)
    },
    build: function() {
        var baseZIndex = 10001 + this.info.overlay * 10;
        var showZIndex = baseZIndex + 2;
        this.iframeIdName = 'ifr_popup' + this.info.overlay;
        var path = 'images/';
        if (this.config.isHaveClose) {
            var close = '<i class="icon-popup"  id="popmax" onclick="pop.max()" style="color: #fff;font-size: 22px;margin-right: 5px;vertical-align: middle;cursor: pointer;"></i><i class="icon-minus"  id="popmin" onclick="pop.min()" style="display:none;color: #fff;font-size: 22px;margin-right: 5px;vertical-align: middle;cursor: pointer;"></i><input  type="image" id="dialogBoxClose" src="/data/uploads/xx.gif" style="border:0px;padding:0px;margin:0px;" align="absmiddle" title="关闭"/>'
        } else {
            var close = ''
        };
        var cB = 'filter: alpha(opacity=' + this.info.coverOpacity + ');opacity:' + this.info.coverOpacity / 100 + ';';
        var cover = '<div id="dialogBoxBG" style="position:absolute;top:0px;left:0px;width:100%;height:100%;z-index:' + baseZIndex + ';' + cB + 'background-color:' + this.color.cColor + ';display:none; "></div>';
        var mainBox = '<div id="dialogBox" style="border:1px solid ' + this.color.aColor + ';display:none;z-index:' + showZIndex + ';position:relative;width:' + this.config.width + 'px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:' + this.color.bColor + '; overflow:scroll;">';
        if (this.config.isHaveTitle) {
            mainBox += '<tr height="32" style="background:' + this.color.tColor + '"><td><table style="height:32px;" width="100%" border="0" cellpadding="0" cellspacing="0" ><tr>' + '<td id="dialogBoxTitle" style="color:' + this.color.wColor + ';text-align:left;font-size:14px;font-weight:bold;">&nbsp;' + this.info.title + '</td>' + '<td id="dialogClose" width="60" align="right" valign="middle" height="24">' + close + '</td><td width="6"></td></tr></table></td></tr>'
        } else {
            mainBox += '<tr><td align="right" valign="top">' + close + '</td></tr>'
        };
        mainBox += '<tr valign="top"><td id="dialogBody" style="position:relative;"></td></tr></table></div>' + '<div id="dialogBoxShadow" style="display:none; overflow:scroll;z-index:' + baseZIndex + ';"></div>';
        if (!this.config.isBackgroundCanClick) {
            G('dialogCase').innerHTML = cover + mainBox;
            G('dialogBoxBG').style.height = document.documentElement.scrollHeight + "px"
        } else G('dialogCase').innerHTML = mainBox;
        if (this.config.isHaveClose) {
            Event.observe(G('dialogBoxClose'), "click", this.reset.bindAsEventListener(this), false);
        }
        if (this.config.isSupportDraging) {
            dropClass = new Dragdrop(this.config.width, this.config.height, this.info.shadowWidth, this.config.isSupportDraging, this.config.contentType);
            G("dialogBoxTitle").style.cursor = "move"
        };

        this.lastBuild()
    },
    lastBuild: function() {
        var confirm = '<div style="width:100%;height:100%;text-align:center;"><div style="margin:20px 20px 0 20px;font-size:14px;line-height:16px;color:#ffffff;">' + this.info.confirmCon + '</div><div style="margin:20px;"><input id="dialogOk" type="button" value="  确定  "/>&nbsp;<input id="dialogCancel" type="button" value="  取消  "/></div></div>';
        var alert = '<div style="width:100%;height:100%;text-align:center;"><div style="margin:20px 20px 0 20px;font-size:14px;line-height:16px;color:#ffffff;">' + this.info.alertCon + '</div><div style="margin:20px;"><input id="dialogYES" type="button" value="  确定  "/></div></div>';
        var baseZIndex = 1000000000000 + this.info.overlay * 10;
        var coverIfZIndex = baseZIndex + 4;
        if (this.config.contentType == 1) {
            var openIframe = "<iframe width='100%' style='height:" + this.config.height + "px' name='" + this.iframeIdName + "' id='" + this.iframeIdName + "' src='" + this.info.contentUrl + "' frameborder='0' scrolling='yes'></iframe>";
            var coverIframe = "<div id='iframeBG' style='position:absolute;top:0px;left:0px;width:1px;height:1px;z-index:" + coverIfZIndex + ";filter: alpha(opacity=00);opacity:0.00;background-color:#ffffff;'><div>";
            G("dialogBody").innerHTML = openIframe + coverIframe
           setTimeout(function () {
            var newheight= parseInt(document.getElementById('dialogBody').querySelector('iframe').contentDocument.body.offsetHeight);
              // console.log(newheight);
               document.getElementById('dialogBody').querySelector('iframe').style.height=newheight+'px';
           },1000);


        } else if (this.config.contentType == 2) {
            G("dialogBody").innerHTML = this.info.contentHtml
        } else if (this.config.contentType == 3) {
            G("dialogBody").innerHTML = confirm;
            Event.observe(G('dialogOk'), "click", this.forCallback.bindAsEventListener(this), false);
            Event.observe(G('dialogCancel'), "click", this.close.bindAsEventListener(this), false)
        } else if (this.config.contentType == 4) {
            G("dialogBody").innerHTML = alert;
            Event.observe(G('dialogYES'), "click", this.close.bindAsEventListener(this), false)
        }
    },
    reBuild: function() {
        G('dialogBody').height = G('dialogBody').clientHeight;
        this.lastBuild()
    },
    show: function() {
        this.hiddenSome();
        this.middle();
        if (this.config.isShowShadow) this.shadow()
    },
    forCallback: function() {
        return this.info.callBack(this.info.parameter)
    },
    shadow: function() {
        var oShadow = G('dialogBoxShadow');
        var oDialog = G('dialogBox');
        oShadow['style']['position'] = "fixed";
        oShadow['style']['background'] = "#000";
        oShadow['style']['display'] = "";
        oShadow['style']['opacity'] = "0.2";
        oShadow['style']['filter'] = "alpha(opacity=20)";
        oShadow['style']['top'] = oDialog.offsetTop + this.info.shadowWidth;
        oShadow['style']['left'] = oDialog.offsetLeft + this.info.shadowWidth;
        oShadow['style']['width'] = oDialog.offsetWidth;
        oShadow['style']['height'] = oDialog.offsetHeight
    },
    middle: function() {
        if (!this.config.isBackgroundCanClick) G('dialogBoxBG').style.display = '';
        var oDialog = G('dialogBox');
        oDialog['style']['position'] = "fixed";
        oDialog['style']['display'] = '';
        var sClientWidth = document.documentElement.clientWidth;
        var sClientHeight = document.documentElement.clientHeight;
        var sScrollTop = document.documentElement.scrollTop;
        if (Sys.chrome) {
            var sScrollTop = document.body.scrollTop
        };
        var sleft = (document.documentElement.clientWidth / 2) - (oDialog.offsetWidth / 2);
        var iTop = -80 + (sClientHeight / 2 + sScrollTop) - (oDialog.offsetHeight / 2);
        var sTop = iTop > 0 ? iTop: (sClientHeight / 2 + sScrollTop) - (oDialog.offsetHeight / 2);
        if (sTop < 1) sTop = "20";
        if (sleft < 1) sleft = "20";
        oDialog['style']['left'] = sleft + "px";
        oDialog['style']['top'] = sTop + "px"
    },
    reset: function() {
        if (this.config.isReloadOnClose) {
            top.location.reload()
        };
        this.close()
    },
    close: function() {
        G('dialogBox').style.display = 'none';
        if (!this.config.isBackgroundCanClick) G('dialogBoxBG').style.display = 'none';
        if (this.config.isShowShadow) G('dialogBoxShadow').style.display = 'none';
        G('dialogBody').innerHTML = '';
        this.showSome()
    },
    max:function () {
        var oShadow = G('dialogBox');

        popheight=oShadow['style']['height'];
        popwidth=oShadow['style']['width'];
        popleft=oShadow['style']['left'];
        poptop=oShadow['style']['top'];
        popifrheight=     document.getElementById('dialogBody').querySelector('iframe').style.height;
        oShadow['style']['top'] ='0px';
        oShadow['style']['left'] = '0px';
        oShadow['style']['width'] = '100%';
        oShadow['style']['height'] = '100%';
        oShadow['style']['bottom'] ='0px';

        var height=parseInt(document.getElementById('dialogBox').clientHeight)-50;
        document.getElementById('dialogBody').querySelector('iframe').style.height=height+'px';
        document.getElementById('popmin').style.display='inline-block';
        document.getElementById('popmax').style.display='none';

    },
    min:function () {
        var oShadow = G('dialogBox');
        oShadow['style']['top'] = poptop;
        oShadow['style']['left'] = popleft;
        oShadow['style']['width'] = popwidth;
        oShadow['style']['height'] = popheight;
        oShadow['style']['bottom'] ='';
      //  var newheight= parseInt(document.getElementById('dialogBody').querySelector('iframe').contentDocument.body.offsetHeight);
        // console.log(newheight);
        document.getElementById('dialogBody').querySelector('iframe').style.height=popifrheight;
        document.getElementById('popmin').style.display='none';
        document.getElementById('popmax').style.display='inline-block';

    },
    hiddenSome: function() {
        var tag = this.info.someHiddenTag.split(",");
        if (tag.length == 1 && tag[0] == "") tag.length = 0;
        for (var i = 0; i < tag.length; i++) {
            this.hiddenTag(tag[i])
        };
        var ids = this.info.someHiddenEle.split(",");
        if (ids.length == 1 && ids[0] == "") ids.length = 0;
        for (var i = 0; i < ids.length; i++) {
            this.hiddenEle(ids[i])
        };
        var ids = this.info.someDisabledBtn.split(",");
        if (ids.length == 1 && ids[0] == "") ids.length = 0;
        for (var i = 0; i < ids.length; i++) {
            this.disabledBtn(ids[i])
        };
        space("begin")
    },
    disabledBtn: function(id) {
        var ele = G(id);
        if (typeof(ele) != "undefined" && ele != null && ele.disabled == false) {
            ele.disabled = true;
            this.someToDisabled.push(ele)
        }
    },
    hiddenTag: function(tagName) {
        var ele = document.getElementsByTagName(tagName);
        if (ele != null) {
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].style.display != "none" && ele[i].style.visibility != 'hidden') {
                    ele[i].style.visibility = 'hidden';
                    this.someToHidden.push(ele[i])
                }
            }
        }
    },
    hiddenEle: function(id) {
        var ele = G(id);
        if (typeof(ele) != "undefined" && ele != null) {
            ele.style.visibility = 'hidden';
            this.someToHidden.push(ele)
        }
    },
    showSome: function() {
        for (var i = 0; i < this.someToHidden.length; i++) {
            this.someToHidden[i].style.visibility = 'visible'
        };
        for (var i = 0; i < this.someToDisabled.length; i++) {
            this.someToDisabled[i].disabled = false
        };
        space("end")
    }
};
var Dragdrop = new Class();
Dragdrop.prototype = {
    initialize: function(width, height, shadowWidth, showShadow, contentType) {
        this.dragData = null;
        this.dragDataIn = null;
        this.backData = null;
        this.width = width + "px";
        this.height = height + "px";
        this.shadowWidth = shadowWidth;
        this.showShadow = showShadow;
        this.contentType = contentType;
        this.IsDraging = false;
        this.oObj = G('dialogBox');
        Event.observe(G('dialogBoxTitle'), "mousedown", this.moveStart.bindAsEventListener(this), false)
    },
    moveStart: function(event) {
        this.IsDraging = true;
        if (this.contentType == 1) {
            G("iframeBG").style.display = "";
            G("iframeBG").style.width = this.width;
            G("iframeBG").style.height = this.height
        };
        Event.observe(document, "mousemove", this.mousemove.bindAsEventListener(this), false);
        Event.observe(document, "mouseup", this.mouseup.bindAsEventListener(this), false);
        Event.observe(document, "selectstart", this.returnFalse, false);
        this.dragData = {
            x: Event.pointerX(event),
            y: Event.pointerY(event)
        };
        this.backData = {
            x: parseInt(this.oObj.style.left),
            y: parseInt(this.oObj.style.top)
        }
    },
    mousemove: function(event) {
        if (!this.IsDraging) return;
        var iLeft = Event.pointerX(event) - this.dragData["x"] + parseInt(this.oObj.style.left);
        var iTop = Event.pointerY(event) - this.dragData["y"] + parseInt(this.oObj.style.top);
        if (this.dragData["y"] < parseInt(this.oObj.style.top)) iTop = iTop - 12;
        else if (this.dragData["y"] > parseInt(this.oObj.style.top) + 25) iTop = iTop + 12;
        this.oObj.style.left = iLeft + "px";
        this.oObj.style.top = iTop + "px";
        if (this.showShadow) {
            G('dialogBoxShadow').style.left = iLeft + this.shadowWidth + "px";
            G('dialogBoxShadow').style.top = iTop + this.shadowWidth + "px"
        };
        this.dragData = {
            x: Event.pointerX(event),
            y: Event.pointerY(event)
        };
        document.documentElement.style.cursor = "move"
    },
    mouseup: function(event) {
        if (!this.IsDraging) return;
        if (this.contentType == 1) G("iframeBG").style.display = "none";
        document.onmousemove = null;
        document.onmouseup = null;
        var mousX = Event.pointerX(event) - (document.documentElement.scrollLeft || document.documentElement.scrollLeft);
        var mousY = Event.pointerY(event) - (document.documentElement.scrollTop || document.documentElement.scrollTop);
        if (mousX < 1 || mousY < 1 || mousX > document.documentElement.clientWidth || mousY > document.documentElement.clientHeight) {
            this.oObj.style.left = this.backData["x"] + "px";
            this.oObj.style.top = this.backData["y"] + "px";
            if (this.showShadow) {
                G('dialogBoxShadow').style.left = this.backData.x + this.shadowWidth + "px";
                G('dialogBoxShadow').style.top = this.backData.y + this.shadowWidth + "px"
            }
        };
        this.IsDraging = false;
        document.documentElement.style.cursor = "";
        Event.stopObserving(document, "selectstart", this.returnFalse, false)
    },
    returnFalse: function() {
        return false
    }
}
var popheight='';
var popwidth='';
var poptop='';
var popleft='';
var popifrheight='';
// JavaScript Document
/*检查浏览器*/
var Sys= {};
var ua = navigator.userAgent.toLowerCase();
var s;var pop;
 var popSwitch=1;
(s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
(s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
(s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
(s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
(s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
/*检查浏览器*/
String.prototype.trim = function(){return this.replace(/(^\s*)|(\s*$)/g, "");};
String.prototype.ByteCount=function(){var txt = this.replace(/(<.*?>)/ig,"");txt = txt.replace(/([\u0391-\uFFE5])/ig, "11");var count = txt.length;return count;}
String.prototype.ubbcode=function(){var str;str=this.replace(/\[img(.+?)\]/ig,"<img src=\"/images/chat/chat_$1.gif\" />");
/*str=str.replace(/\[b\]([^\[\]]*)\[\/b\]/ig, "<b>$1</b>");
str=str.replace(/\[strong\]([^\[\]]*)\[\/strong\]/ig, "<strong>$1</strong>");
str=str.replace(/\[i\]([^\[\]]*)\[\/i\]/ig, "<i>$1</i>");
str=str.replace(/\[u\]([^\[\]]*)\[\/u\]/ig, "<u>$1</u>");*/
return str;}
function G(){
	var elements=new Array();
	for(var i=0;i<arguments.length;i++)
	{
		var element=arguments[i];
		if(typeof element=='string')element=document.getElementById(element);
		if(arguments.length==1)return element;elements.push(element)
	};
	return elements
 };
String.prototype.getQuery = function(name)
{var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");var r = this.substr(this.indexOf("\?")+1).match(reg);if (r!=null) return unescape(r[2]); return null;}
function replaceUrl(LocUrl,paramName,paramVal){var re=eval('/('+ paramName+'=)([^&]*)/gi'); var mre=LocUrl.match(re);if (mre!=null){var nUrl = LocUrl.replace(re,paramName+'='+paramVal);}else{nUrl=LocUrl+'&'+paramName+'='+paramVal;}this.location = nUrl;}
function getCode() {G('getcode').value='';G('codeimg').innerHTML = '<img style="cursor: pointer;cursor: hand" src="/GetCode.aspx?t='+Math.random()+'" height="16px"  title="看不清！" onclick="getCode();" />';}
function chkCode(thisinput){var thisval=thisinput.value.trim();var fmname=thisinput.id;if(thisval!=''){var ajaxobj=new AJAXRequest;ajaxobj.method="POST";ajaxobj.url="/ajaxpost.aspx?action=getcode&getcode="+thisval+"";ajaxobj.callback=function(xmlobj) {var response=xmlobj.responseText;if(response!='1'){G('codetxt').className = "err";G('codetxt').innerHTML='验证码错误';}else{G('codetxt').className = "suc";G('codetxt').innerHTML='验证码正确';}};ajaxobj.send();}else{G('codetxt').className = "null";G('codetxt').innerHTML='请输入验证码';}}
function bookmarkit(){var myHerf=top.location.href;
var title=document.title;try{if ((typeof window.sidebar == 'object') && (typeof window.sidebar.addPanel == 'function')){window.sidebar.addPanel(title,myHerf,title);}else{window.external.AddFavorite(myHerf,title);}}catch(e){}return false;};function CopyCode(cpText){if(copy2Clipboard(cpText)!=false){alert("复制成功！你可以使用粘贴或(Ctrl+V)功能与其他好友一同分享！ ");}}copy2Clipboard=function(txt){if(window.clipboardData){window.clipboardData.clearData();window.clipboardData.setData("Text",txt);}else if(navigator.userAgent.indexOf("Opera")!=-1){window.location=txt;}else if(window.netscape){try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");}catch(e){alert("您的firefox安全限制限制您进行剪贴板操作，请打开’about:config’将signed.applets.codebase_principal_support’设置为true’之后重试，相对路径为firefox根目录/greprefs/all.js");return false;}var clip=Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);if(!clip)return;var trans=Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);if(!trans)return;trans.addDataFlavor('text/unicode');var str=new Object();var len=new Object();var str=Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);var copytext=txt;str.data=copytext;trans.setTransferData("text/unicode",str,copytext.length*2);var clipid=Components.interfaces.nsIClipboard;if(!clip)return false;clip.setData(trans,null,clipid.kGlobalClipboard);}}
function XmlHttpObj(){var XmlRequest=false;try{XmlRequest = new XMLHttpRequest();} catch (trymicrosoft){try{XmlRequest = new ActiveXObject("Msxml2.XMLHTTP");}catch (othermicrosoft){try{XmlRequest = new ActiveXObject("Microsoft.XMLHTTP");} catch (failed){XmlRequest = false;}}}if (!XmlRequest){alert("can't create XMLHttpRequest object.");}return XmlRequest;};
function AJAXRequest(){;var xmlObj = XmlHttpObj();if (!xmlObj) return false;var CBfunc,ObjSelf;ObjSelf=this;this.method="POST";this.url;this.async=true;this.callback=function(cbobj){return;};this.send=function(){if(!this.method||!this.url||!this.async) return false;xmlObj.open (this.method, this.url, this.async);if(this.method=="POST") xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded");xmlObj.onreadystatechange=function(){if(xmlObj.readyState==4) {if(xmlObj.status==200) {ObjSelf.callback(xmlObj);}}};if(this.method=="POST") xmlObj.send(this.content);else xmlObj.send(null);}}
function selCreate(selObj,TextVal,Value,selVal){Value=TextVal;var oOpt=document.createElement("option");var sText=document.createTextNode(TextVal);oOpt.setAttribute("value",Value);if (Value==selVal){oOpt.setAttribute("selected","selected");}oOpt.appendChild(sText);selObj.appendChild(oOpt);}
//select表单选取
function selectSetItem(Obj,Val){if (Obj){for (i=0;i<Obj.length;i++){if (Obj.options[i].value==Val||(","+Val+",").indexOf(","+Obj.options[i].value+",")!=-1){Obj.options[i].selected=true;};};};}
function getselectItem(Obj){
	if (Obj){
		for (i=0;i<Obj.length;i++){
			if (Obj.options[i].selected==true){
				return Obj.options[i].text;
			};
		};
	};
}
function getselectValue(Obj){
	if (Obj){
		for (i=0;i<Obj.length;i++){
			if (Obj.options[i].selected==true){
				return Obj.options[i].value;
			};
		};
	};
}
function getselectValue_more(Obj,Val){
	if (Obj){
		for (i=0;i<Obj.length;i++){
			if(Obj.options[i].value.indexOf(Val)>0){
				Obj.options[i].selected=true;
			}
		};
	};
}
//单选表单选取 Obj 表单名，VAL所选的值
function chkradio(Obj,Val){if (Obj){for (i=0;i<Obj.length;i++){if (Obj[i].value==Val){Obj[i].checked=true;break;};};};}
//多选表单选取 Obj 表单名，VAL所选的值
function chkcheckboxNew(ObjName,Val){var e=document.getElementsByName(ObjName);for(var i=0;i<e.length;i++){if(Val.indexOf(e[i].value)!=-1){e[i].checked=true;}else{e[i].checked=false;}}}
//多选表单选取 Obj 表单名，VAL所选的值
function chkcheckbox(Obj,Val){if (Obj){Val = ","+Val+",";if (Obj.length==null){if(Val.indexOf(","+Obj.value+",")!=-1){Obj.checked=true;};}for (i=0;i<Obj.length;i++){if(Val.indexOf(","+Obj[i].value+",")!=-1){Obj[i].checked=true;};};};}
//复选框事件
function CheckAll(form){for (var i=0;i<form.elements.length;i++){var e = form.elements[i];if (e.name != 'chkall' && e.type=='checkbox'){e.checked = form.chkall.checked;}}}
//复选框事件
function SelectAll(item){var e=document.getElementsByName(item);for (var i=0;i<e.length;i++){if (e[i].checked==true){e[i].checked = false;}else{e[i].checked = true;}}}
//身高年龄
function selage(selName,selVal,sex,sType){var vStr='--请选择--';if(sType==1){vStr='--不限--'};var frmobj=G(selName);frmobj.length=0;frmobj.options.add(new Option(vStr,"0"));for (i=18;i<=99;i++){selCreate(frmobj,i,i,selVal);}}
function getheight(selName,selVal,sex,sType){var vStr='--请选择--';if(sType==1){vStr='--不限--'};var frmobj=G(selName);frmobj.length=0;frmobj.options.add(new Option(vStr,"0"));for (i=130;i<=260;i++){selCreate(frmobj,i,i,selVal);}}
//登录表单默认值
function userlogin(thisinput) {var val = thisinput.value;if (val == '邮箱/会员名/ID/手机'){thisinput.value = '';}if (val == '' || val == null){thisinput.value = '邮箱/会员名/ID/手机';}}
function tabit(btn){var idname = new String(btn.id);var s = idname.indexOf("_");var e = idname.lastIndexOf("_")+1;var tabName = idname.substr(0, s);var id = parseInt(idname.substr(e, 1));var tabNumber = btn.parentNode.childNodes.length;for(i=0;i<tabNumber;i++){G(tabName+"_div_"+i).style.display = "none";G(tabName+"_btn_"+i).className = "";}G(tabName+"_div_"+id).style.display = "block";btn.className = "curr";};
function getCookie(name){var userVal=null;var str_tmp= readCookie(name);if(!str_tmp){return false;}var end = str_tmp.indexOf("&");if (end!='-1'){ userVal=str_tmp.substr(0,end);}else{userVal=str_tmp;};return userVal;}
function readCookie(name){var arr,reg=new RegExp("(^|)"+name+"=([^;]*)(;|$)");if(arr=document.cookie.match(reg)){return decodeURIComponent(arr[2]);}else{return null;}}
function writeCookie(name, value, days){var expires = "";if (days!=null) {date = new Date((new Date()).getTime() + days *24* 3600000);expires = "; expires="+date.toGMTString();};document.cookie = name+"="+value+expires+"; path=/";}
function frm_submit(frmObj){var form_obj = G(frmObj);form_obj.submit();}
function SucTxt(divid,txt){G(divid).className = "suc";G(divid).innerHTML = txt;}
function NullTxt(divid){G(divid).className = "null";G(divid).innerHTML = '请输入';}
function ErrTxt(divid,txt){G(divid).className = "err";G(divid).innerHTML = txt;}
function winPop(Obj){
	var cType=1;
if(Obj.type){cType=Obj.type;};
var isReload = false;
if (Obj.reload) {
    isReload = eval(Obj.reload);
};
var sContent = "contentUrl";
if (cType == '2') {
    sContent = "contentHtml"
};
if (cType == '4') {
    sContent = "alertCon"
};
var iUrl = "";
if (Obj.url) {
    iUrl = Obj.url;
};
var iScroll = 'no';
if (Obj.scroll) {
    iScroll = Obj.scroll;
};
var iShow = true;
if (Obj.ishow) {
    iShow = eval(Obj.ishow);
};
var iClose = true;
if (Obj.iclose) {
    iClose = eval(Obj.iclose);
};
var isDrag = false;
if (Obj.drag) {
    isDrag = eval(Obj.drag);
};
var iwidth = 380;
if (Obj.width) {
    iwidth = Obj.width
};
var iheight = 80;
if (Obj.height) {
    iheight = Obj.height
};
pop = new Popup({
    contentType: cType,
    isReloadOnClose: isReload,
    isSupportDraging: isDrag,
    width: iwidth,
    height: iheight,
    isHaveTitle: iShow,
    isHaveClose: iClose,
    scrollType: iScroll
});
pop.setContent("title", Obj.title);
pop.setContent(sContent, iUrl);
pop.build();
pop.show();
document.getElementById('dialogBoxShadow').style.top = document.getElementById('dialogBox').style.top = '100px';
if (Obj.form) {
    G(Obj.form).target = pop.iframeIdName;
}
if (Obj.next) {
    nextStep(Obj.next, Obj.goTo);
}
var sTop = document.body.scrollTop + document.documentElement.scrollTop;
var top = window.screen.height / 2 - document.getElementById('dialogBox').offsetHeight / 2 - 20;



};
function nextStep(sType, goTo) {
    var closeTime = 2500;
    switch (sType) {
    case 1:
        setTimeout(function() {
            pop.close()
        },
        closeTime);
        break;
    case 2:
        setTimeout("location.reload();", closeTime);
        break;
    case 3:
        setTimeout("location.href='" + goTo + "'", closeTime);
        break;
    default:
        break;
    }
}
var Ptimer, PopHeight, Si = 0;
function rPopSize(Size, M) {
    PopHeight = parseInt(G('ifr_popup0').style.height, 10);
    if (M == 0) {
        Si += 1
    } else {
        Si = Si - 1
    };
    G('ifr_popup0').style.height = PopHeight + Si + 'px';
    G('dialogBoxShadow').style.height = PopHeight + 26 + Si + 'px';
    if (M == 0) {
        if (PopHeight >= Size) {
            window.clearInterval(Ptimer);
        }
    } else {
        if (PopHeight <= Size) {
            window.clearInterval(Ptimer);
        };
    }
}
function popSize(Size) {
    if (Size > parseInt(G('ifr_popup0').style.height, 10)) {
        Ptimer = window.setInterval('rPopSize(' + Size + ',0)', 1);
    } else {
        Ptimer = window.setInterval('rPopSize(' + Size + ',1)', 1);
    }
} //动态改变弹出窗口高度
//function popSize(Size){G('ifr_popup0').style.height=Size+'px';G('dialogBoxShadow').style.height=Size+26+'px';}
function show_Hide(divid) {
    if (G(divid).style.display == 'none') {
        G(divid).style.display = 'block';
    } else {
        G(divid).style.display = 'none';
    }
}
/*鼠标显示层*/
function pop_show(event, divid, title, info) {
    xpos = 0;
    ypos = 0;
    var htmlStr = '';
    if (Sys.ie) {
        var Ypos;
        var Xpos;
        var Offwidth;
        var Offheight;
        var standardCompat = document.compatMode.toLowerCase();
        /*alert(standardCompat);*/
        if (standardCompat == "css1compat") {
            Ypos = document.documentElement.scrollTop;
        } else if (standardCompat == "backcompat" || standardCompat == "quirksmode") {
            Ypos = document.body.scrollTop;
        }
        var top_tmp = event.clientY + Ypos;
        var left_tmp = event.clientX;
    } else {
        var top_tmp = event.pageY;
        var left_tmp = event.pageX;
    }
    left_tmp=left_tmp-(document.body.clientWidth-1000)/2;
    top_tmp += ypos - 140;
    htmlStr = "";
    if (G(divid).innerHTML.indexOf(title) < 0) {
        htmlStr = '<strong>' + title + '</strong><br/>';
    };
    if (info == '') {
        info = G(divid).innerHTML;
    }
    htmlStr += '<div>' + info + '</div>';
    G(divid).innerHTML = htmlStr;
    G(divid).style.left = left_tmp  + 'px';
    G(divid).style.top = top_tmp + 'px';
    G(divid).style.display = '';
}
function chklogin() {
    if (getCookie("userid") == 0) {
        alert("对不起，请先登录！");
        location.href = '/login.aspx';
        return false;
    }
    return true;
}
/*功能按钮*/
function count(channelid, id) {
    var ajaxobj = new AJAXRequest;
    ajaxobj.method = 'POST';
    ajaxobj.url = '/count.aspx?action=count&channelid=' + channelid + '&id=' + id + '';
    ajaxobj.callback = function(xmlobj) {
        var response = xmlobj.responseText;
        updateCount(response);
    };
    ajaxobj.send();
}
function updateCount(str) {
    var strArray = str.split(',');
    var viewid = G("views");
    var markid = G("remark");
    var signup = G("join");
    if (viewid) {
        viewid.innerHTML = strArray[0];
    };
    if (markid) {
        markid.innerHTML = strArray[1];
    };
    if (signup) {
        signup.innerHTML = strArray[2];
    }
}
function setiFrame(iframename) {
    var pTar = null;
    if (document.getElementById) {
        pTar = G(iframename);
    } else {
        eval('pTar = ' + iframename + ';');
    }
    if (pTar && !window.opera) {
        pTar.style.display = "block";
        if (pTar.contentDocument && pTar.contentDocument.documentElement.scrollHeight) {
            pTar.height = 0;
            pTar.height = pTar.contentDocument.documentElement.scrollHeight;
        } else if (pTar.Document && pTar.Document.body.scrollHeight) {
            pTar.height = pTar.Document.body.scrollHeight;
        }
    }
}
function localurl(url) {
    window.location.href = url;
}
//function get_location(){if(getCookie("idlocation")==''){var ajaxobj=new AJAXRequest;ajaxobj.method='POST';ajaxobj.url='/ajaxpost.aspx?action=address';ajaxobj.callback=function(xmlobj) {var response = xmlobj.responseText;G('txt').innerHTML=response;};ajaxobj.send();}else{G('txt').innerHTML=getCookie("iplocation");}}
function show_zone(divid) {
    G(divid).style.display = 'block';
    G('cityqh').className = 'on';
    G('bj').style.display = 'block';
}
function close_zone(divid) {
    G(divid).style.display = 'none';
    G('cityqh').className = '';
    G('bj').style.display = 'none';
}
function notLogin(Url) {
    if (getCookie("userid") == 0) {
        winPop({
            title: '登录后查看',
            ishow: 'false',
            iclose: 'false',
            url: '/ajaxpost.aspx?action=popup&comefrom=' + escape(Url) + '',
            height: '140',
            width: '420'
        });
    }
}
function doZoom(size, obj) {
    G(obj).style.fontSize = size;
}
function creatSel(selName, selVal, sType, Txt) {
    var selobj = G(selName);
    var val = '-1';
    if (Txt == '1') {
        val = '不限';
    }
    selobj.options.length = 0;
    if (sType == 1) {
        var devalue = '--不限--';
        selobj.options.add(new Option(devalue, val));
    } else {
        selobj.options.add(new Option("--请选择--", ""));
    };
    if (sType == 3) {
        sType = 1
    };
    for (var i = sType; i <= selStr.length - 1; i++) {
        if (Txt == '0') {
            selCreate(selobj, selStr[i], i, selVal);
        } else {
            selCreate(selobj, selStr[i], selStr[i], selVal);
        }
    }
}
function check_code_input(thisinput)
{   var count = thisinput.value.trim().ByteCount();
    if(G("rootURL")){var rootURL=G("rootURL").value;}else{rootURL="..";}
	if (thisinput.value.trim() == "") {NullTxt('codetxt');}
	else if (count < 4 ){ErrTxt('codetxt',"<img src='images/login/icon_03.gif'>");G('logins').disabled=true;}
	else
	{var ajaxobj=new AJAXRequest;ajaxobj.method="POST";ajaxobj.content="value="+escape(thisinput.value);ajaxobj.url=rootURL+"/?comes=pub&gos=post_code";ajaxobj.callback=function(xmlobj) {var response = xmlobj.responseText.split("|");if (response[0]!='0'){SucTxt('codetxt',response[1]);G('logins').disabled=false;}else{ErrTxt('codetxt',response[1]);G('logins').disabled=true;}};ajaxobj.send();}
}
var _bool_IE = ( window.ActiveXObject ? true : false );//获取浏览器类型
function loadXMLDoc(dname){var xmlDoc; if( _bool_IE ){xmlDoc = new ActiveXObject("Microsoft.XMLDOM"); }else { xmlDoc = document.implementation.createDocument("","",null);}xmlDoc.async = false; try{xmlDoc.load( dname ); return (xmlDoc);} catch ( E ){return false; }}
function gotourl(url){var closeTime=8500;setTimeout(parent.location.href=url,closeTime)}
function newgdcode(obj,url) {
obj.src = url+ '?nowtime=' + new Date().getTime();
//后面传递一个随机参数，否则在IE7和火狐下，不刷新图片
}
function Addmore(keyvalue,pid,itemname,path){ajaxobj=new AJAXRequest;ajaxobj.method="POST";ajaxobj.content="dbs="+path+"&item=category&pid="+pid+"&value="+keyvalue;ajaxobj.url="/news/post_ajax.aspx";ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText.split("#");var lists;var bodys="";if (response[0]!='0'){for (i=0;i<response.length;i++ ){lists=response[i].split("|");bodys=bodys+"<li id='dot1'><a href='/"+path+"/read.aspx?id="+lists[0]+"' target='_blank'>"+lists[1].substring(0,18)+"</a></li>"}G(itemname).innerHTML = bodys;}else{bodys="<li id='dot1'>未找到</li>"}};ajaxobj.send()}
function _fresh(hddate,num,link){var n1 = new Date(hddate.replace(/-/g, "\/"));var nowtime = new Date();var leftsecond=parseInt((n1.getTime()-nowtime.getTime())/1000); __d=parseInt(leftsecond/3600/24); __h=parseInt((leftsecond/3600)%24);   __m=parseInt((leftsecond/60)%60);__s=parseInt(leftsecond%60);if(leftsecond<=0){document.getElementById("sj_"+num).innerHTML=("报名已结束");}else{document.getElementById("sj_"+num).innerHTML="报名还有 <font id='fonthz'>"+__d+"天 "+__h+"小时"+__m+"分</font>";if(document.getElementById("bm_"+num)){if(link){document.getElementById("bm_"+num).innerHTML="<a class='btngray' href='"+link+"' target='_blank'><font id='fontor'>我要报名</font></a>"}else{document.getElementById("showphoto").style.display="none"; document.getElementById("bm_"+num).innerHTML="<img src='/images/party/join.gif' onclick=\"joinparty("+partyid+")\" >";}}}}
function rightstr(value,str){
	var num=value.indexOf(str);
	if(num<0){return false;}
	var rightstr=value.substring(num+1,value.length);
	if(rightstr.indexOf(str)>0){
		var rightstr=rightstr.substring(rightstr.indexOf(str)+1,rightstr.length);
	}
	return rightstr;
}
function popclose(){parent.pop.close();}
function is_number(vthis){vthis.value=vthis.value.replace(/\D/g,"")}//过滤输入中的数字
function rightstrs(value,str){
	var num=value.indexOf(str);
	if(num<0){return false;}
	var rightstr=value.substring(num+1,value.length);

	return rightstr;
}
function leftstr(value,str){
	var num=value.indexOf(str);
	if(num<0){return false;}
	var leftstr=value.substring(0,num);
	return leftstr;
}
function replacestr(value,str){
    value_s=value.split(str);
	var newvalue=value;
	for (i=0;i<value_s.length;i++)
	{
		if (newvalue.indexOf(str)>0)
		{
			newvalue=newvalue.replace(str,"");
		}
	}

	return newvalue;
}
//过滤重复的数组  ####################################################################################################
function filterArray(arrs){
    var k=0,n=arrs.length;
	var arr = new Array();
    for(var i=0;i<n;i++)
    {
        for(var j=i+1;j<n;j++)
        {
            if(arrs[i]==arrs[j])
            {
                arrs[i]=null;
                break;
            }
        }
    }
    for(var i=0;i<n;i++)
    {
        if(arrs[i])
        {
            arr[k++]=arrs[i]; // arr.push(this[i]);
        }
    }
    return arr;
}
//过滤数组中的某一位 ####################################################################################################
function filterOne(arrs,str){
    var k=0,n=arrs.length;
	var arr = new Array();
    for(var i=0;i<n;i++)
    {
        if(arrs[i]!=str){
           arr.push(arrs[i]);
        }
    }
    return arr;
}
//过滤字符串中的某一位 ####################################################################################################
function filterStrOne(longstr,str){
    var k=0,n=longstr.length;
	var arr = "";var this_n;
    for(var i=0;i<n;i++)
    {
		this_n=longstr.substr(i,1);
		if(k-1>=0){
			arr=arr+""+this_n;
		}else{
			if(this_n==str){
               k=1;
			}else{
			   arr=arr+""+this_n;
			}
		}

    } //alert(arr)
    return arr;
}
//过滤数组中的某一位 ####################################################################################################
function filterNums(arrs,nums){
    var k=0,n=arrs.length;
	var arr = new Array();
    for(var i=0;i<n;i++)
    {
        if(i!=nums){
           arr.push(arrs[i]);
        }
    }
    return arr;
}
//两个数组，返回不包含在B数组中的A数组的数字
function Arrays(a,b){
	var c=new Array; var zt;
	for (i=0;i<a.length;i++)
	{   zt=0;
		for (j=0;j<b.length;j++)
		{
			if(a[i]-b[j]==0){
				zt=1;
			}
		}
		if(zt==0){
			c.push(a[i]);
		}
	}
	return c;
}
//两个数组，返回包含相同数字的个数
function Sames(a,b){
	var num=0;
	for (i=0;i<a.length;i++)
	{   var zt=0;
		for (j=0;j<b.length;j++)
		{
			if(a[i]-b[j]==0){
				zt=1;
			}
		}
		if(zt==1){
			num+=1;
		}
	}
	return num;
}
// 几个数字中，每两个不同的数字组成一组，共能组成多少组
function teamnum(num){
	var bnum=0;
	for (i=1;i<=num;i++)
	{
		bnum=bnum+num-i;
	}
	return bnum
}
//一组数字中，三个不同的组成一组。返回组成个数。
function teamnum3(list){
	var bnum=0;var c=0;var a;a=list.length;
	for (i=0;i<a;i++)
	{
		for (j=i+1;j<a;j++)
		{
			for (c=j+1;c<a;c++)
			{
				if(list[i]-list[j]!=0 && list[j]-list[c]!=0){
					bnum=bnum+1;
				}
			}
		}
	}
	return bnum
}
//过滤数组中空的字段。
function teamDelNull(list){
	var c=new Array;//c.push(a[i]);
	for (i=0;i<list.length;i++)
	{
		if(list[i]!=""){
			c.push(list[i]);
		}
	}
	return c;
}
function ShowPriod(){
	var list_lot=new Array;var list_time=new Array;var list_lot_show=new Array;var list_time_show=new Array;
	var this_lot;var this_lot_time;var this_lot_time_no;var this_lot_num;var Now_num=0;var show_lot_time;var show_lot_num
	var Now_lot_time="";var Now_lot_num="";var first_lot_time="";var first_lot_num="";var next_date_yes;var next_date_no;
	var Dw_lot_num=G("Dw_lot_num").value;
	var Dw_lot_date=G("Dw_lot_date").value;
	var now_date=G("now_date_yes").value;
	var now_time=G("now_time_yes").value;
	var now_time_no=G("now_time_no").value;
    var now_date_time=now_date+","+now_time;
	var playkey=G("playkey").value;
	var lot_time_list=G("lot_time_list").value;
	var lot_list_all=lot_time_list.split("|");var list_len=lot_list_all.length;
	for (i=0;i<list_len;i++)
	{
		if(lot_list_all[i]!=""){
			this_lot=lot_list_all[i].split("^");
			this_lot_num=this_lot[0];this_lot_time=this_lot[1];
			list_lot.push(this_lot_num);list_time.push(this_lot_time);//所有的期号//所有的截止时间

			if(first_lot_num==""){first_lot_num=this_lot_num;}//第一期期号
			if(first_lot_time==""){first_lot_time=this_lot_time;}//第一期止时间

			this_lot_time_no=ReplaceAll(this_lot_time,":","");
			if(this_lot_time_no-now_time_no>0){
				if(Now_lot_time==""){Now_lot_num=this_lot_num;Now_lot_time=this_lot_time;Now_num=i;}
			}
			if(list_len-i==1){
				var end_lot_num=this_lot_num;var end_lot_time=this_lot_time;
			}
		}
	}
	var end_lot_time_no=ReplaceAll(end_lot_time,":","");
	if((Now_num-list_len==0) || (now_time_no-end_lot_time_no>0)){
		Now_lot_num=first_lot_num;Now_lot_time=first_lot_time;
		var now_date_no=G("next_date_no").value;
		var now_date_yes=G("next_date_yes").value;
	}else{
		var now_date_no=G("now_date_no").value;
		var now_date_yes=G("now_date_yes").value;
	}

	next_date_yes=AddDay(now_date_yes,1);next_date_no=this_lot_time_no=ReplaceAll(next_date_yes,"-","");
	var new_lot_date_list=Date_differ(now_date_yes+","+now_time,now_date_yes+","+Now_lot_time);
	G("new_lot_date").value=Math.abs(new_lot_date_list[4]);
	ser_lot_time=parseInt(G('new_lot_date').value)-1;
	setTimeout("_get_ser_time(ser_lot_time)",1000)
	//当前玩法不同，期号也不相同 var show_lot_time;var show_lot_num
	if(playkey=="LJSSC" || playkey.indexOf("KL8")>0 || playkey=="3D" || playkey=="P5(P3)"){//龙江时时彩
		var Dw_lot_num=G("Dw_lot_num").value;
		var Dw_lot_date=G("Dw_lot_date").value;
		var lot_date=Dw_lot_date+",00:00:01";
		var now_date=now_date_yes+",00:00:01";
		var Date_s=Date_differ(lot_date,now_date);
		var is_yes_num=0;
		var MaxPeriodNum=1//玩法不同，一天共多少期
		var HeaderNum="";//生成显示的期号前需不需要加00;龙江需要
		if(pplaykey.indexOf("KL8")>0){MaxPeriodNum=84;HeaderNum="00"}
		//if(playkey=="BJKL8"){MaxPeriodNum=179;HeaderNum="00"}
		if(playkey=="3D" || playkey=="P5(P3)"){MaxPeriodNum=1;}
		if (Date_s[0]-1>=0){is_yes_num=MaxPeriodNum*Date_s[0];}
		var now_lot_num_all_s=parseInt(Dw_lot_num,10)+is_yes_num;

		for (j=Now_num;j<list_lot.length;j++)
		{   now_lot_num_all=now_lot_num_all_s+parseInt(list_lot[j],10);
			show_lot_num=HeaderNum+String(now_lot_num_all);show_lot_time=String(now_date_yes)+" "+String(list_time[j]);
			list_lot_show.push(show_lot_num);list_time_show.push(show_lot_time);
		}
		now_lot_num_all_s=now_lot_num_all_s+MaxPeriodNum
		for (j=0;j<Now_num;j++)
		{   now_lot_num_all=now_lot_num_all_s+parseInt(list_lot[j],10)
			show_lot_num=HeaderNum+String(now_lot_num_all);show_lot_time=String(next_date_yes)+" "+String(list_time[j]);
			list_lot_show.push(show_lot_num);list_time_show.push(show_lot_time);
		}
	}else{//重庆时时彩

	    for (j=Now_num;j<list_lot.length;j++)
		{
			list_lot_show.push(String(now_date_no)+String(list_lot[j]));list_time_show.push(String(now_date_yes)+" "+String(list_time[j]));

		}
		for (j=0;j<Now_num;j++)
		{
			list_lot_show.push(String(next_date_no)+String(list_lot[j]));list_time_show.push(String(next_date_yes)+" "+String(list_time[j]));
		}
	}

    //开始打印购买期号
	G("current_issue").innerHTML=list_lot_show[0];
	G("current_endtime").innerHTML=list_time_show[0];
    //所有可购买的期号//下拉框
	var select_lot = document.getElementById("list_lot_num");
	select_lot.options.length = 0;
	var option1=document.createElement("option");
    option1.value=list_lot_show[0];
    option1.text= list_lot_show[0]+"(当前期)";
    select_lot.options.add(option1);
    for(var i=1;i<list_lot_show.length;i++){
		var option1=document.createElement("option");
		option1.value=list_lot_show[i]
		option1.text=list_lot_show[i]
		select_lot.options.add(option1);
    }
   add_zuihao(list_lot_show,list_time_show);
}

function get_priod_time(){
	if(document.getElementById("lot_time_list").value!=""){ShowPriod();}else{setTimeout("get_priod_time()",1000)}
}
function clearLastData(){
	G("lt_cf_content").innerHTML="";
	G("lt_cf_nums").innerHTML="0";
	G("lt_cf_money").innerHTML="0";
}
function AddDay(dt, days){ //addday(指定日期, days=天数)
    dt = dt.replace('-', '/');//js不认2000-1-31,只认2000/1/31
    var t1 = new Date(new Date(dt).valueOf() + days*24*60*60*1000);// 日期加上指定的天数
	var t_m=t1.getMonth() + 1
	var t_d=t1.getDate()
	if(t_m-9<=0){n_t_m="0"+t_m}else{n_t_m=t_m}
	if(t_d-9<=0){n_t_d="0"+t_d}else{n_t_d=t_d}
    return t1.getFullYear() + "-" + n_t_m + "-" + n_t_d
}

function Date_differ(beginTime,endTime){
	var Z_beginTime=ReplaceAll(beginTime,"-","/");
	var Z_endTime=ReplaceAll(endTime,"-","/");
	var N_beginTime=new Date(Z_beginTime);
	var N_endTime=new Date(Z_endTime);
	var leftsecond=parseInt((N_endTime.getTime()-N_beginTime.getTime())/1000);
	__d=parseInt(leftsecond/3600/24);
	__h=parseInt((leftsecond/3600)%24);
	__m=parseInt((leftsecond/60)%60);
	__s=parseInt(leftsecond%60);
	var lost_time=new Array(__d,__h,__m,__s,leftsecond);//返回群组，天数，小时，分，秒
	return lost_time;
}

function ReplaceAll(str,sptr,sptr1)
{
    while(str.indexOf(sptr)>=0)
    {
      str=str.replace(sptr,sptr1);
    }
    return (str);
}

//格式化浮点数形式(只能输入正浮点数，且小数点后只能跟四位,总体数值不能大于999999999999999共15位:数值999兆)
function formatFloat( num )
{
	num = num.replace(/^[^\d]/g,'');
	num = num.replace(/[^\d.]/g,'');
	num = num.replace(/\.{2,}/g,'.');
	num = num.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	if( num.indexOf(".") != -1 )
	{
		var data = num.split('.');
		num = (data[0].substr(0,15))+'.'+(data[1].substr(0,4));
	}
	else
	{
		num = num.substr(0,15);
	}
	return num;
}

function moneyFormat(num)
{
	var sign = Number(num) < 0 ? "-" : "";
    num = num.toString();
	if( num.indexOf(".") == -1 )
	{
		num = "" + num + ".00";
	}
	var data = num.split('.');
	data[0] = data[0].toString().replace(/[^\d]/g,"").substr(0,15);
	data[0] = Number(data[0]).toString();
	var newnum = [];
	for( var i=data[0].length; i>0; i-=3 )
	{
		newnum.unshift(data[0].substring(i,i-3));
	}
	data[0] = newnum.join(",");
	data[1] = data[1].toString().substr(0,4);
	return sign+""+data[0] + "." + data[1];
}
function moneyFormatB(num)
{
	var sign = Number(num) < 0 ? "-" : "";
    num = num.toString();
	if( num.indexOf(".") == -1 )
	{
		num = "" + num + ".00";
	}
	var data = num.split('.');
	data[0] = data[0].toString().replace(/[^\d]/g,"").substr(0,15);
	data[0] = Number(data[0]).toString();
	var newnum = [];
	for( var i=data[0].length; i>0; i-=3 )
	{
		newnum.unshift(data[0].substring(i,i-3));
	}
	data[0] = newnum.join(",");
	data[1] = data[1].toString().substr(0,2);
	return sign+""+data[0] + "." + data[1];
}
//四舍五入到指定精度,支持到整数位,类似PHP的round函数
function JsRound( num, len, keep )
{
    len = parseInt(len,10);
    if( len < 0 )
	{
	    len = Math.abs(len);
	    return Math.round(Number(num)/Math.pow(10,len))*Math.pow(10,len);
	}
	else if( len == 0 )
	{
	    return Math.round(Number(num));
    }
    num = Math.round(Number(num)*Math.pow(10,len))/Math.pow(10,len);
    if( keep && keep == true )
    {
        var t = '',i=0;
        num = num.toString();
        if( num.indexOf(".") == -1 )
    	{
    	    num = "" + num + ".0";
    	}
    	data = num.split('.');
    	for( i=data[1].length; i<len; i++ )
    	{
    	    t += ''+'0';
    	}
    	return ''+num+''+t;
    }
    return num;
}

//onkeyup:根据用户输入的资金做检测并自动转换中文大写金额(用于充值和提现)
//obj:检测对象元素，chineseid:要显示中文大小写金额的ID，maxnum：最大能输入金额
function checkWithdraw( obj,chineseid)
{
	checkMoney(obj)
	//obj.value = formatFloat(obj.value);
	var maxnum=parseInt(G(chineseid).innerHTML);
	if( parseFloat(obj.value) > parseFloat(maxnum) )
	{
		alert("输入金额超出了可用余额");
		obj.value = obj.value.substr(0,obj.value.length-1);
	}
}
function checkMoney( obj )
{
	obj.value = formatFloat(obj.value);
}
//自动转换数字金额为大小写中文字符,返回大小写中文字符串，最大处理到999兆
function changeMoneyToChinese( money )
{
	var cnNums	= new Array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖");	//汉字的数字
	var cnIntRadice = new Array("","拾","佰","仟");	//基本单位
	var cnIntUnits = new Array("","万","亿","兆");	//对应整数部分扩展单位
	var cnDecUnits = new Array("角","分","厘","毫");	//对应小数部分单位
	var cnInteger = "整";	//整数金额时后面跟的字符
	var cnIntLast = "元";	//整型完以后的单位
	var maxNum = 999999999999999.9999;	//最大处理的数字

	var IntegerNum;		//金额整数部分
	var DecimalNum;		//金额小数部分
	var ChineseStr="";	//输出的中文金额字符串
	var parts;		//分离金额后用的数组，预定义
	var i,m;

	if( money == "" )
	{
		return "";
	}

	money = parseFloat(money);
	//alert(money);
	if( money >= maxNum )
	{
		alert('超出最大处理数字');
		return "";
	}
	if( money == 0 )
	{
		ChineseStr = cnNums[0]+cnIntLast+cnInteger;
		//document.getElementById("show").value=ChineseStr;
		return ChineseStr;
	}
	money = money.toString(); //转换为字符串
	if( money.indexOf(".") == -1 )
	{
		IntegerNum = money;
		DecimalNum = '';
	}
	else
	{
		parts = money.split(".");
		IntegerNum = parts[0];
		DecimalNum = parts[1].substr(0,4);
	}
	if( parseInt(IntegerNum,10) > 0 )
	{
	    //获取整型部分转换
		zeroCount = 0;
		IntLen = IntegerNum.length;
		for( i=0;i<IntLen;i++ )
		{
			n = IntegerNum.substr(i,1);
			p = IntLen - i - 1;
			q = p / 4;
            m = p % 4;
			if( n == "0" )
			{
				zeroCount++;
			}
			else
			{
				if( zeroCount > 0 )
				{
					ChineseStr += cnNums[0];
				}
				zeroCount = 0;	//归零
				ChineseStr += cnNums[parseInt(n)]+cnIntRadice[m];
			}
			if( m==0 && zeroCount<4 )
			{
				ChineseStr += cnIntUnits[q];
			}
		}
		ChineseStr += cnIntLast;
	//整型部分处理完毕
	}
	if( DecimalNum!= '' )
	{
	    //小数部分
		decLen = DecimalNum.length;
		for( i=0; i<decLen; i++ )
		{
			n = DecimalNum.substr(i,1);
			if( n != '0' )
			{
				ChineseStr += cnNums[Number(n)]+cnDecUnits[i];
			}
		}
	}
	if( ChineseStr == '' )
	{
		ChineseStr += cnNums[0]+cnIntLast+cnInteger;
	}
	else if( DecimalNum == '' )
	{
		ChineseStr += cnInteger;
	}
	return ChineseStr;

}
function show_Lower(perid){
	var pic_jia="../images/new_passport/menu_s01_plus.gif";
	var pic_jian="../images/new_passport/menu_s01_minus.gif";
	if(G("ul_"+perid).style.display=="none"){
		G("span_"+perid).className="cur_li";
		G("img_"+perid).src=pic_jian;
		G("ul_"+perid).style.display="";
		var ul_body=G("ul_"+perid).innerHTML;
   	    if(ul_body==""){
		    G("ul_"+perid).innerHTML="<font color='#777777'>正在刷新...</font>";
	     }
	     ajaxobj=new AJAXRequest;ajaxobj.method="POST";ajaxobj.content="uid="+perid;ajaxobj.url="../source/plugin/ajax_Lower_user.aspx";ajaxobj.callback=function(xmlobj){var response = xmlobj.responseText;show_Lower_ul(perid,response)};ajaxobj.send()
	}else{
		G("ul_"+perid).style.display="none"
		G("img_"+perid).src=pic_jia;
	}

}
function show_Lower_ul(uid,response){
	if(parseInt(response)-1==0){G("ul_"+uid).innerHTML="<font color='red'>未找到</font>";}
	var LowerUser = response.split('#');var ul_body="";
	for (i=0;i<LowerUser.length;i++ )
	{
		if(LowerUser[i]!=""){
		var ul_item="";
		var lists = LowerUser[i].split('|');
		var pic_jia="../images/new_passport/menu_s01_plus.gif";
		var pic_jian="../images/new_passport/menu_s01_minus.gif";
		if(parseInt(lists[2])-1>=0){
			ul_item="<li id='li_"+lists[0]+"'><img src='"+pic_jia+"' id='img_"+lists[0]+"' style='cursor: pointer;' alt='打开［"+lists[1]+"］的下级会员'  onclick=\"show_Lower('"+lists[0]+"')\">";
			ul_item+="&nbsp;&nbsp;<a href='user_list_body.aspx?uid="+lists[0]+"' target='userlist_content'><span id='span_"+lists[0]+"'  onclick=\"show_Lower('"+lists[0]+"')\">"+lists[1]+"</span></a>";
			ul_item+="<font color='#666666'>&nbsp;("+lists[2]+")</font></li><ul id='ul_"+lists[0]+"' style='display:none'></ul>";
			if(ul_body==""){ul_body=ul_item;}else{ul_body=ul_body+ul_item;}
		}else{
			ul_item="<li id='li_"+lists[0]+"'><img src='"+pic_jian+"' id='img_'>";
			ul_item+="&nbsp;&nbsp;<a href='user_list_body.aspx?uid="+lists[0]+"' target='userlist_content'>"+lists[1]+"</a></li>";
			if(ul_body==""){ul_body=ul_item;}else{ul_body=ul_body+ul_item;}
		}
		}
	}
	G("ul_"+uid).innerHTML=ul_body;
}

function Show_Money_Div(item){
	var Moneys=G(item).innerHTML;
	G(item).innerHTML=moneyFormat(Moneys);
}
function Trim(str) {
    return str.replace(/\s+$|^\s+/g,"");
}
function in_arrary(arrays,strs){
	flags="no"
	for (i=0;i<arrays.length;i++)
	{
		if(arrays[i]==strs){
			flags="yes";
		}
	}
	return flags;
}
function GetUserMoney(){
	var rooturl=document.getElementById('RootUrl').value;
	ajaxobj=new AJAXRequest;ajaxobj.method="POST";
	ajaxobj.url=rooturl+"/?comes=highgame&controller=&action=ajax_get_UserMoney&flag=yes";
	ajaxobj.callback=function(xmlobj){
		var response = Trim(xmlobj.responseText);//alert("|"+response+"|");//return false;
	    G("leftusermoney").innerHTML='正在刷新...';
		window.setTimeout("ShowUserMoney('"+response+"')",500);};ajaxobj.send()}
function ShowUserMoney(skey){ //alert(skey)
	   if(skey){
		   var this_money;var lists= new Array;
		   lists=skey.split("|");
		   var UserMoney=lists[0];
		   var hig_amount=lists[1];
		   var low_amount=lists[2];
		   if(G('this_money')){
			   var paths=G('this_money').value;
			   if(paths=="/highgame"){this_money=hig_amount;}else if((paths=="/lowgame")||(paths=="/lowproxy")){this_money=low_amount;}else{this_money=UserMoney;}
		   }else{
			   this_money=UserMoney;
		   }
           writeCookie("UserMoney",UserMoney);
		   writeCookie("hig_amount",hig_amount);
		   writeCookie("low_amount",low_amount);
		   G("leftusermoney").innerHTML=moneyFormat(this_money);
	   }else{
		   G("leftusermoney").innerHTML='0';
	   }
}
//获取当前操作系统版本
function detectOS() {
var sUserAgent = navigator.userAgent;
var isWin = (navigator.platform == "Win32") || (navigator.platform == "Windows");
var isMac = (navigator.platform == "Mac68K") || (navigator.platform == "MacPPC") || (navigator.platform == "Macintosh") || (navigator.platform == "MacIntel");
if (isMac) return "Mac";
var isUnix = (navigator.platform == "X11") && !isWin && !isMac;
if (isUnix) return "Unix";
var isLinux = (String(navigator.platform).indexOf("Linux") > -1);
if (isLinux) return "Linux";
if (isWin) {
var isWin2K = sUserAgent.indexOf("Windows NT 5.0") > -1 || sUserAgent.indexOf("Windows 2000") > -1;
if (isWin2K) return "Win2000";
var isWinXP = sUserAgent.indexOf("Windows NT 5.1") > -1 || sUserAgent.indexOf("Windows XP") > -1;
if (isWinXP) return "WinXP";
var isWin2003 = sUserAgent.indexOf("Windows NT 5.2") > -1 || sUserAgent.indexOf("Windows 2003") > -1;
if (isWin2003) return "Win2003";
var isWinVista= sUserAgent.indexOf("Windows NT 6.0") > -1 || sUserAgent.indexOf("Windows Vista") > -1;
if (isWinVista) return "WinVista";
var isWin7 = sUserAgent.indexOf("Windows NT 6.1") > -1 || sUserAgent.indexOf("Windows 7") > -1;
if (isWin7) return "Win7";
}
return "other";
}

//过滤空格
function rep_Space(str){
	str=str.replace(/\s/ig, " ");
	return str;
}
//JS判断输入是否为整数等的正则表达式
function Is_str_type(nums,types){
	var r;
	if(types=="1"){r = /^\+?[1-9][0-9]*$/;}           //正整数
	if(types=="2"){r = /^\\d+$/;}                     //非负整数（正整数 + 0）
	if(types=="3"){r = /^((-\\d+)|(0+))$/;}           //非正整数（负整数 + 0）
	if(types=="4"){r = /^-[0-9]*[1-9][0-9]*$/;}       //负整数
	if(types=="5"){r = /^-?\\d+$/;}                   //整数
	if(types=="6"){r = /^\\d+(\\.\\d+)?$/;}           //非负浮点数（正浮点数 + 0）
	if(types=="7"){r = /^(([0-9]+\\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;}                   //正浮点数
	if(types=="8"){r = /^((-\\d+(\\.\\d+)?)|(0+(\\.0+)?))$/;}                   //非正浮点数（负浮点数 + 0）
	if(types=="9"){r = /^(-(([0-9]+\\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\\.[0-9]+)|([0-9]*[1-9][0-9]*)))$/;}                //负浮点数
	if(types=="10"){r = /^(-?\\d+)(\\.\\d+)?$/;}       //浮点数
	return r.test(nums);
}
function show_moneys(nums,item){
	var maxnum=parseInt(nums);var itemvalue=0;
	for (i=0;i<maxnum;i++)
	{
		if(G(item+"_"+i).innerHTML!=""){itemvalue=G(item+"_"+i).innerHTML;}else{itemvalue=0};
		G(item+"_"+i).innerHTML=moneyFormatB(itemvalue);
	}
}
function back_lot(bianhao,moneys){
    ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content="active=backlot&uid="+bianhao+"&moneys="+moneys;//alert(ajaxobj.content)
	ajaxobj.url="game_buy_show.aspx";
	ajaxobj.callback=function(xmlobj){
		var response = xmlobj.responseText;
		if(response.indexOf("|")>0){
			var lists=response.split("|");
			if(parseFloat(lists[1])>0){
				var title_s=lists[1]+"元";
			}else{
				var title_s="免费";
			}
			var back_num=lists[0];
			alert("撤单成功，系统将 "+back_num+" 元打回您的高频帐户，其中手续费"+title_s)
		}else{
			alert("撤单未成功，请刷新重试或联系管理员")
		}
		parent.window.setTimeout("Ajax_get_buy()",500)
		window.top.frames['leftframe'].document.getElementById('refreshimg').onclick();
		parent.pop.close();
	}
	ajaxobj.send();
}
function end_pop(bianhao,moneys){
	var isSure = confirm("您确认要撤消这份投注单");
    if (isSure) {
        back_lot(bianhao,moneys);
    }else{
		return false;
    }
}

//判断1个时间是否已过了当前时间
function retimeDiff(aTime){
	var this_time=ReplaceAll(aTime,"-","/");
	this_time=ReplaceAll(this_time," ",",");
	var endtime=new Date(this_time);
	var nowtime = new Date();
	var leftsecond=parseInt((endtime.getTime()-nowtime.getTime()));
	return leftsecond;
}
//AJAX保存某个域
function SaveItemValue(dbname,uid,itemname,values,SucFun,FailFun){
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	var rootURL=G("rootURL").value;var pathName=G("pathName").value;var thisPathUrl=rootURL+"/"+pathName;
	ajaxobj.content="dbname="+dbname+"&id="+uid+"&item="+itemname+"&values="+values;
	//alert(ajaxobj.content);return false;
	ajaxobj.url=thisPathUrl+"/?action=save_post&flag=yes&active=ajaxSaveInfor";

	ajaxobj.callback=function(xmlobj){
		var response = Trim(xmlobj.responseText) ;
		if(response=="yes"){window.setTimeout(SucFun,500);}else{window.setTimeout(FailFun,500);}
	};
	ajaxobj.send()
}
function logout(){
	if(window.parent.parent.document.getElementById('logout_img')){window.parent.parent.document.getElementById('logout_img').onclick();}
	if(window.parent.document.getElementById('logout_img')){window.parent.document.getElementById('logout_img').onclick();}
	if(document.getElementById('logout_img')){document.getElementById('logout_img').onclick();}
}
function readyCloseOCSWin(){
	window.location.href="../logout.aspx";
}
function logout_par(){
	window.parent.parent.location.href="../logout.aspx";
}
function GetPlays(vthis,items){
	var itemkey;var titles;var lists=new Array();var this_s=new Array();
	   ajaxobj=new AJAXRequest;
	   ajaxobj.method="POST";
	   //alert(ajaxobj.content);return false;
	   ajaxobj.url="../highgame/save_post.aspx?active=GetPlays&playkey="+vthis.value;
	   ajaxobj.callback=function(xmlobj){
		   var response = Trim(xmlobj.responseText);
		   var select_lot = document.getElementById(items);//alert(select_lot.name)
		   select_lot.options.length = 0;
		   var option1=document.createElement("option");
		   option1.value="all";
		   option1.text="所有玩法";
		   select_lot.options.add(option1);
		   var lists=response.split("^");
		   for (i=1;i<lists.length;i++)
		   {
			   if(lists[i]!=""){
				   this_s=lists[i].split("|");
				   itemkey=this_s[0];
				   if(this_s[1]==""){titles=this_s[2];}else{titles=this_s[1]+"-"+this_s[2];}
				   var option1=document.createElement("option");
				   option1.value=itemkey;
				   option1.text=titles;
				   select_lot.options.add(option1);
			   }
		   }
	   }
	   ajaxobj.send()
}

function get_tpl_url(){
	var tpl_url="";
	if(document.getElementById("tpl_url")){
		var tpl_url=document.getElementById("tpl_url").value;
	}
	return tpl_url;
}
function getElementPos(elementId){
    var ua = navigator.userAgent.toLowerCase();
    var isOpera = (ua.indexOf('opera') != -1);
    var isIE = (ua.indexOf('msie') != -1 && !isOpera); // not opera spoof
    var el = document.getElementById(elementId);
    if (el.parentNode === null || el.style.display == 'none') {
        return false;
    }
    var parent = null;
    var pos = [];
    var box;
    if (el.getBoundingClientRect) //IE
    {
        box = el.getBoundingClientRect();
        var scrollTop = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        var scrollLeft = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
        return {
            x: box.left + scrollLeft,
            y: box.top + scrollTop
        };
    }
    else
        if (document.getBoxObjectFor) // gecko
        {
            box = document.getBoxObjectFor(el);
            var borderLeft = (el.style.borderLeftWidth) ? parseInt(el.style.borderLeftWidth) : 0;
            var borderTop = (el.style.borderTopWidth) ? parseInt(el.style.borderTopWidth) : 0;
            pos = [box.x - borderLeft, box.y - borderTop];
        }
        else // safari & opera
        {
            pos = [el.offsetLeft, el.offsetTop];
            parent = el.offsetParent;
            if (parent != el) {
                while (parent) {
                    pos[0] += parent.offsetLeft;
                    pos[1] += parent.offsetTop;
                    parent = parent.offsetParent;
                }
            }
            if (ua.indexOf('opera') != -1 || (ua.indexOf('safari') != -1 && el.style.position == 'absolute')) {
                pos[0] -= document.body.offsetLeft;
                pos[1] -= document.body.offsetTop;
            }
        }
    if (el.parentNode) {
        parent = el.parentNode;
    }
    else {
        parent = null;
    }
    while (parent && parent.tagName != 'BODY' && parent.tagName != 'HTML') { // account for any scrolled ancestors
        pos[0] -= parent.scrollLeft;
        pos[1] -= parent.scrollTop;
        if (parent.parentNode) {
            parent = parent.parentNode;
        }
        else {
            parent = null;
        }
    }
    return {
        x: pos[0],
        y: pos[1]
    };
}

function reinitIframe_height(){
	var iframes = document.getElementsByTagName("iframe");var num=0;
	for (i=0;i<iframes.length;i++)
	{
		var iframe=iframes[i];
			try{
		   		var bHeight = iframe.contentWindow.document.body.scrollHeight;
		   		var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;//alert(bHeight+"|"+dHeight)

				if(iframe.name=="leftframe"){
					var height = Math.max(bHeight, dHeight);
				}else{
					var height = bHeight;
				}
		   		iframe.height =  height;


			}catch (ex){}
	}
	window.setTimeout("reinitIframe_height()",1000);
	//document.cookie="reinitIframe_num="+reinitIframe_num+"";
	//if(reinitIframe_num-3<0){window.setTimeout("reinitIframe_height()",500);}else{document.cookie="reinitIframe_num=0";}
}
function re_prize_auto(basic_mode,basic_prize,this_mode){
	var new_prize=(parseFloat(basic_prize,10)/parseFloat(basic_mode,10))*parseFloat(this_mode,10);
	return new_prize.toFixed(2);
}
/*
var bHeight = iframe.contentWindow.document.body.scrollHeight;
var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
*/
function turnHeight(iframe)
{
   var frm = document.getElementById(iframe);
   var subWeb = document.frames ? document.frames[iframe].document : frm.contentDocument;
   if(frm != null && subWeb != null)
   { frm.height = subWeb.body.scrollHeight + 20;}
}

function ajax_post_date(perid,gurl,gconnet,funs,dialog){
	ajaxobj=new AJAXRequest;
	ajaxobj.method="POST";
	ajaxobj.content=gconnet;
	ajaxobj.url=gurl;
	ajaxobj.callback=function(xmlobj){
		var response = Trim(xmlobj.responseText);
		if(dialog=="yes"){
			if(response=="nouser"){DialogAlert("提交失败，未找到用户["+pername+"]");return false;}
			if(funs){window.setTimeout("funs('"+response+"')",1000);}
		}else{
			refunc(funs,perid,response)
		}
	};
	ajaxobj.send();
}
function RndNum(n){//随机
	var rnd="";
	for(var i=0;i<n;i++)
	rnd+=Math.floor(Math.random()*10);
	return rnd;
}
function Do_peie(){
	G("put_button").setAttribute('disabled',true);
	var max_list=0;
	var accordcount=G('accordcount').value;
	var e=document.getElementsByName('select_rows[]');//alert(e.length)
	for (i=0;i<e.length;i++)
	{
		 if(e[i].checked==true){
			 G('addcount_'+e[i].value).value=accordcount;
			 max_list+=1;
		 }
	}
	var thisnum=parseInt(G('now_acc').value,10);
	var lostnum=max_list*accordcount;
	if(thisnum-lostnum<0){open9("输入的配额大于您可用的配额数!");return false;}
	G('leftcount').innerHTML=thisnum-lostnum;
	G('accordcount').value="";
	G("put_button").removeAttribute('disabled');
}
function checksss(){
	var selectNum=0;var e=document.getElementsByName('select_rows[]');
	var uid_list="";var uid_num="";
	for (i=0;i<e.length;i++)
	{
		 if(e[i].checked==true){
			 selectNum+=1;
			 if(G('addcount_'+e[i].value).value==""){
				 open9("请对勾选的用户填写新增的配额数量!");
				 return false;
			 }else{
				 if(uid_list==""){
					 uid_list+=e[i].value;
					 uid_num+=G('addcount_'+e[i].value).value;
				 }else{
					 uid_list+="|"+e[i].value;
					 uid_num+="|"+G('addcount_'+e[i].value).value;
				 }


			 }
		 }
	}
	var this_url=G("do_this_url").value;//+"_post&perid=<?echo $perid;?>&userlist="+uid_list+"&numlist="+uid_num;
	if(selectNum-1<0){open9("请选择需要更改配额的用户!");return false;}
	var this_url=this_url+"&active=put&userlist="+uid_list+"&numlist="+uid_num;
	openReturn("更改配额",this_url)
}
function check_chinese_char(s){
        return (s.length != s.replace(/[^\x00-\xff]/g,"**").length);
}



function GetNewMoney(){

	   if(G("do_url")){
           if(mobile==1)
           {

           }
           else{

               document.getElementById('newmoney').innerHTML='...';

               document.getElementById('low_amount').innerHTML='...';


           }
		   var xmlHttp;

		   	if(window.ActiveXObject){
		   		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
		   	}
		   	else if(window.XMLHttpRequest){
		   		xmlHttp = new XMLHttpRequest();
		   	}

		//	parent.document.getElementById('newmoney').innerHTML='正在刷新';
 // $('#lostmoney').html("正在刷新..");
			xmlHttp.open('GET',G("do_url").value+"?mod=ajax&code=get&list=data&flag=yes&action=money",true);
			xmlHttp.onreadystatechange=function(){

				if(xmlHttp.readyState==4){
				var response=xmlHttp.responseText;

				 showlostmoney(response);
				}


			};
			xmlHttp.send(null);


	   }
	}
	function showlostmoney(items){

               items=JSON.parse(items)

              if(mobile==1)
                  document.getElementById('newmoney').innerHTML=items.hig_amount;
                  else{

                  document.getElementById('newmoney').innerHTML=items.hig_amount;

                  document.getElementById('low_amount').innerHTML=items.low_amount;
                 var moneydiv= document.querySelectorAll('.J-balance-show');
                  for(var i=0;i<moneydiv.length;i++){
                      moneydiv[i].innerHTML=items.hig_amount;

                  }

              }

			    // $('#lostmoney').html(items);
//			    $('#money_top').html(items);
			}



function showMony() {

     var star= document.querySelectorAll('.J-balance-star');

    var show= document.querySelectorAll('.J-balance-show');
    var refresh= document.querySelectorAll('.refresh');
    if(document.querySelector('#hideAmt1').style.display!='none'){
        document.querySelector('#hideAmt1').style.display='none'
        document.querySelector('#hideAmt2').style.display='inline-block'
        for(var i=0;i<star.length;i++){

            star[i].style.display='inline-block';
            show[i].style.display='none';
            refresh[i].style.display='none';
        }


    }
    else{
        document.querySelector('#hideAmt2').style.display='none'
        document.querySelector('#hideAmt1').style.display='inline-block'
        for(var i=0;i<star.length;i++){

            star[i].style.display='none';
            show[i].style.display='inline-block';
            refresh[i].style.display='inline-block';

        }


    }

}

function add_fangan(id,info) {

    //alert(gamekey);
    var url='index_fangan.html?type=add&gamekey='+gamekey+'&info='+info;
    DialogResetWindow('添加方案',url,'550','350');
}
function  fangan_buy(id) {

    var url='index_fangan.html?type=buy&id='+id;
    DialogResetWindow('执行方案',url,'550','350');

}


function fangan_remove(id) {
    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content="";
    // alert(gamekey);
    //DialogAlert(ajaxobj.content);return false;
    ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=fangan_remove&flag=yes&id="+id;//DialogAlert(ajaxobj.content);return false;

    ajaxobj.callback=function(xmlobj){
        ajax_fanganlist();
        parent.window.wxc.xcConfirm('方案删除成功',parent.window.wxc.xcConfirm.typeEnum.success);;
    };
    ajaxobj.send() ;
}


function ajax_fanganlist() {

    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content="";

    //DialogAlert(ajaxobj.content);return false;
    ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=fanganlist&flag=yes";//DialogAlert(ajaxobj.content);return false;

    ajaxobj.callback=function(xmlobj){
        var response = Trim(xmlobj.responseText);
        document.getElementById('fangan_list').innerHTML=response;
        fangan_num();
    };
    ajaxobj.send() ;




}

function fangan_num() {

    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content="";

    //DialogAlert(ajaxobj.content);return false;
    ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=fangan_num&flag=yes";//DialogAlert(ajaxobj.content);return false;

    ajaxobj.callback=function(xmlobj){
        var response = Trim(xmlobj.responseText);
        document.getElementById('my_fangan_num').innerHTML=response;

    };
    ajaxobj.send() ;

}
function fangan_show() {
    document.getElementById('BgDiv').style.display='block';
    document.getElementById('J-game-plan').style.display='block';
}
function set_vedio() {

    if(document.getElementById('toogle_bell').className=='bell_on'){

        document.getElementById('toogle_bell').className='bell_off';
        vedio=0;
    }
    else{

        document.getElementById('toogle_bell').className='bell_on';
        vedio=1;
    }
    ajaxobj=new AJAXRequest;
    ajaxobj.method="POST";
    ajaxobj.content="";

    //DialogAlert(ajaxobj.content);return false;
    ajaxobj.url="do.aspx?mod=ajax&code=get&list=data&action=uservedio&flag=yes&vedio="+vedio;//DialogAlert(ajaxobj.content);return false;

    ajaxobj.callback=function(xmlobj){
        var response = Trim(xmlobj.responseText);


    };
    ajaxobj.send() ;

}
function changeMoneyToChinese(money){
    var cnNums = new Array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"); //汉字的数字
    var cnIntRadice = new Array("","拾","佰","仟"); //基本单位
    var cnIntUnits = new Array("","万","亿","兆"); //对应整数部分扩展单位
    var cnDecUnits = new Array("角","分","毫","厘"); //对应小数部分单位
    //var cnInteger = "整"; //整数金额时后面跟的字符
    var cnIntLast = "元"; //整型完以后的单位
    var maxNum = 999999999999999.9999; //最大处理的数字

    var IntegerNum; //金额整数部分
    var DecimalNum; //金额小数部分
    var ChineseStr=""; //输出的中文金额字符串
    var parts; //分离金额后用的数组，预定义
    if( money == "" ){
        return "";
    }
    money = parseFloat(money);
    if( money >= maxNum ){
        $.alert('超出最大处理数字');
        return "";
    }
    if( money == 0 ){
        //ChineseStr = cnNums[0]+cnIntLast+cnInteger;
        ChineseStr = cnNums[0]+cnIntLast
        //document.getElementById("show").value=ChineseStr;
        return ChineseStr;
    }
    money = money.toString(); //转换为字符串
    if( money.indexOf(".") == -1 ){
        IntegerNum = money;
        DecimalNum = '';
    }else{
        parts = money.split(".");
        IntegerNum = parts[0];
        DecimalNum = parts[1].substr(0,4);
    }
    if( parseInt(IntegerNum,10) > 0 ){//获取整型部分转换
        zeroCount = 0;
        IntLen = IntegerNum.length;
        for( i=0;i<IntLen;i++ ){
            n = IntegerNum.substr(i,1);
            p = IntLen - i - 1;
            q = p / 4;
            m = p % 4;
            if( n == "0" ){
                zeroCount++;
            }else{
                if( zeroCount > 0 ){
                    ChineseStr += cnNums[0];
                }
                zeroCount = 0; //归零
                ChineseStr += cnNums[parseInt(n)]+cnIntRadice[m];
            }
            if( m==0 && zeroCount<4 ){
                ChineseStr += cnIntUnits[q];
            }
        }
        ChineseStr += cnIntLast;
        //整型部分处理完毕
    }
    if( DecimalNum!= '' ){//小数部分
        decLen = DecimalNum.length;
        for( i=0; i<decLen; i++ ){
            n = DecimalNum.substr(i,1);
            if( n != '0' ){
                ChineseStr += cnNums[Number(n)]+cnDecUnits[i];
            }
        }
    }
    if( ChineseStr == '' ){
        //ChineseStr += cnNums[0]+cnIntLast+cnInteger;
        ChineseStr += cnNums[0]+cnIntLast;
    }/* else if( DecimalNum == '' ){
                ChineseStr += cnInteger;
                ChineseStr += cnInteger;
            } */

    document.getElementById('money11').innerHTML=ChineseStr;
    return ChineseStr;
}
function set_username(value){

    if(value=='2'){
        document.getElementById('username').disabled=true;
        document.getElementById('username').value='';
    }
    else document.getElementById('username').disabled=false;
}

function change_time(begintime,endtime,num) {

    var time= document.getElementsByName('time');

    for(var i=0;i<time.length;i++){

        if(i==num) time[i].className='userSearch active';
        else time[i].className='userSearch';
    }
    document.getElementById('begintime').value=begintime;
    document.getElementById('endtime').value=endtime;
    document.getElementById('form1').submit();
}

function change_tabs(begintime,endtime,num) {

    var time= document.querySelector('.newTab').querySelectorAll('a');

    for(var i=0;i<time.length;i++){

        if(i==num) time[i].className='router-link-exact-active curr';
        else time[i].className='';
    }
    document.getElementById('begintime').value=begintime;
    document.getElementById('endtime').value=endtime;
    document.getElementById('form1').submit();
}


function  open_url(url) {
    var left=(document.body.clientWidth-1180)/2;
    var height=document.body.clientHeight-100;
    window.open(url,'','height='+height+',width=1180,top=0,left='+left+',toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');

}