//主页面函数
;(function(host, $, undefined){

	//自动响应高度
	var resizeHeight = function(){
		var $frameDom = ($('#mainFrame').size() > 0) ? $('#mainFrame') : $('#mainFrame_menu'),
			parentWindow = window.parent,
			historyHeight = 0,
			height = Number($('.ys-content').outerHeight()) + Number($('.content_mid').outerHeight());

		if(parentWindow.autoResizeHeight && (historyHeight != height)){
			parentWindow.autoResizeHeight(height);
			historyHeight = height;
		}
	};

	setInterval(function(){
		resizeHeight();
	}, 300);

	
	
})(window, jQuery);

$(function(){
	var _href = location.href.split('/').pop();
	var $rows = $(parent.document).find(".left-aside").children('.content').children('.row');
	$rows.removeClass('active');
	$rows.each(function(){
		var h = $(this).children('a').attr('href');
		if(h === _href)
		{
			$(this).addClass('active');
			return;
		}	
	});
	//$(parent.document).find("#mainFrame").height($(".content_mid").outerHeight(true));
});