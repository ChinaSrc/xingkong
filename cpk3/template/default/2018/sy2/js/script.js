function topBarAnimation(total) {
	$('.topBar ul li').each(function (index) {
		$(this).delay(3000 * index).animate({
			top: 0
		}, function () {
			$(this).delay(2000).animate({
				top: '-48px'
			}, function () {
				$(this).css('top', '48px');
				if (index === total) {
					topBarAnimation(total);
				}
			});
		})
	});
}
$(function () {
	$(".sy-top-msg").slide({
		mainCell: "ul",
		autoPlay: true,
		effect: "topLoop"
	});
	$(".gongg").slide({
		mainCell: "ul",
		autoPlay: true,
		effect: "leftMarquee",
		interTime: 50,
		vis: 1
	});
	$(".program").slide({});
	$(".sy-m-banner").slide({
		titCell: ".banner-page",
		mainCell: ".pic",
		effect: "leftLoop",
		autoPage: "<li><a></a></li>",
		autoPlay: true,
		delayTime: 1000,
		interTime: 3000,
		prevCell: '.arrow-left',
		nextCell: '.arrow-right',
		pnLoop: true,
		trriger: 'click',
		vis: "auto"
	});

	$(".smallbanner").slide({
		mainCell: ".pic",
		effect: "left",
		pnLoop: false
	});

	var total = $('.topBar ul li').length - 1;
	topBarAnimation(total);
})