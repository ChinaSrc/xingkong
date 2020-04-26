$(function(){
	reposition();
	$(window).resize(function(){
		reposition();
	})
});

function reposition() {
	var windowHeight = $(window).height();
	if(windowHeight >= 643) {
		$('#wrap').css('min-height', (windowHeight-'233')+'px');
		$('.register#wrap #login-area').css('bottom', '36%');
		$('.login#wrap #login-area').css('bottom', '39%');
	}
	if(windowHeight < 719) {
		//console.log(123);
		$('.register#wrap #login-area').css('bottom', 'auto');
	}
	if(windowHeight < 691) {
		$('.register#wrap').css('min-height', '461px!important');
		$('.register#wrap #login-area').css('bottom', 'auto');
	}
	if(windowHeight < 672) {
		$('#wrap #login-area').css('bottom', 'auto');
	}
	if(windowHeight < 643) {
		$('.login#wrap').css('min-height', '410px');
		$('.login#wrap #login-area').css('bottom', 'auto');
	}
}