//進維護畫面倒數
var _upupinit = true,$upup,$upupWin,_upupHeight;

function figLeaf(H){
	if(!top.upupMsg){
		return false;
	}
	if(_upupinit){
		$('body').append(H.html());
		$upup = $('#upupMessage'), $upupC = $('#upupMessage > #upupContent');
		$upupWin = $(window), _upupMoveSpeed = 100 ,_upupDiffY = 20 , _upupDiffX = 20;
		_upupHeight = $upup.height() , _upupWidth = $upup.width();
		
		    // 控制 #upupMessage 的移動
		$upupWin.bind('scroll resize', function(){
		    $upup.animate({
		        top: $upupWin.scrollTop() + $upupWin.height() - _upupHeight - _upupDiffY,
		        left: $upupWin.scrollLeft() + $upupWin.width() - _upupWidth - _upupDiffX
		    }, _upupMoveSpeed);
		});
		//關閉訊息
		$('#upupMessage .close_ad').click(function(){
		    $upup.hide();
		});
		_upupinit = false;
	}
	
	//距離維護開始倒數秒數
	if(top.upupMsg._UNDER['UNDER_MAINTAIN_SEQUENCE'] == true && top.upupMsg._UNDER['COUNTDOWN1'] > 0){
		var str = top.upupMsg.millisecondsStrToDate(top.upupMsg._UNDER['COUNTDOWN1']);
        if(str){
        	$upup.show();
        	$upupC.html(str);
        }
	}else{
		$upup.hide();
	}
	
	//廣播訊息
	if(top.upupMsg._UNDER['MARQUEE'] != "" && top.upupMsg._UNDER['MARQUEE'] != undefined){
		$upup.show();
    	$upupC.html(top.upupMsg._UNDER['MARQUEE']);
    	top.upupMsg._UNDER['MARQUEE'] = "";
	}else if(top.upupMsg._UNDER['MARQUEE'] == ""){//如果送空字串就隱藏訊息
		$upup.hide();
	}
}
function robotActive(html) {
	$('body').append(html);
    var _win = $(window),
        _content = $("#robotActive"),
        _conHeight = _content.height(),
        _conWidth = _content.width(),
        _close = $("#robotClose");
    
    //設定初始位置
    _content.css({
    	top: _win.scrollTop() + _win.height() - _conHeight + 170,
    	left: _win.scrollLeft() + _win.width() - _conWidth - 44
    });
    
    //彈出視窗效果
    _content.show().animate({top: _win.scrollTop() + _win.height() - _conHeight -76}, 800);
    
    //浮動效果
	_win.bind('scroll resize', function(){
	    _content.stop().animate({
	        top: _win.scrollTop() + _win.height() - _conHeight - 76,
	        left: _win.scrollLeft() + _win.width() - _conWidth - 44
	    }, 800);
	});
	
	//關閉視窗
	_close.click(function() {
		_content.hide();
	});
	
	//15秒自動關閉
	setTimeout(function() {
		$(_close).trigger('click');
	}, 15000);
}