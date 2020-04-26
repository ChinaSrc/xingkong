//主页面函数
(function(host, $, undefined){

	host.resizeHeight = function(){
		
		var $frameDom = $('#mainFrame'),
			parentWindow = window.parent,
			historyHeight = 0,
			height = $frameDom.contents().find('body').height();
			$frameDom.height(height);
	};

	
	//自动响应高度
	host.autoResizeHeight = function(height){
		var $frameDom = ($('#mainFrame').size() > 0) ? $('#mainFrame') : $('#mainFrame_menu');

		$frameDom.css({
			'height': height
		});
	};
	//切换到旧版贴在右边
	var stickOldLink = function(){
		$("#goToOld").css({
			left:($(window).width()-1000)/2 + 1010 + "px"
		});
	}
	$(function(){
		var curmidArr = {
			'56': '3773',
			'19': '2660',
			'18': '2594',
			'1': '50',
			'13': '2195',
			'6': '220',
			'57': '3861',
			'54': '3613',
			'20': '2726',
			'5': '174',
			'7': '256',
			'8': '302',
			'52': '2872',
			'11': '614',
			'12': '615'
		}
		stickOldLink();
		//自动投注
		$(document).on('click', '.J-plan-bet', function(){
			var url = $(this).attr('data-url'),
				id = $(this).attr('data-planid');

			LS && LS.setItem('planId', id);
			setTimeout(function(){
				window.location.href = url;
			}, 100)
		});
		$(document).on('click', '.plan-remove', function(){
			var me = $(this);
				id = me.attr('data-planid'),
				title = me.parents('li').find('span').text();
        	$.ajax({
        		url: 'newgame_play.shtml@tag=removemyplan',
        		type: 'get',
        		data: 'planid=' + id,
        		dataType: 'json',
        		success: function(res){
        			if(Number(res['isSuccess']) == 1){
        				var message = new Message('方案['+ title +']删除成功。');
        				message.show();
                        //更新方案信息
                        $.ajax({
                        	url:'newgame_play.shtml@tag=getmyplanlist',
                        	dataType: 'json',
			        		success: function(res){
			        			if(Number(res['isSuccess']) == 1){
			        				var totalPlan = Math.min(4, res['data']['planData'].length),
			        					newPlanData = '';
			        				for(var i=0; i<totalPlan; i++){
			        					currentPlan = res['data']['planData'][i];
			        					newPlanData+='<li>' +
			        					'<span>'+currentPlan.planname+'</span><div class="program-motion">' +
											'<i href="javascript:void(0);" title="执行方案" class="icon-play plan-title J-plan-bet" data-planid="'+currentPlan.planid+'" data-url="/newgame_play.shtml?curmid='+curmidArr[currentPlan.lotteryid]+'"></i>'+
											'<i href="javascript:void(0);" title="删除方案" class="icon-remove plan-remove" data-planid="'+currentPlan.planid+'"></i>'+
										'</div></li>';
			        				}
			        				$('#my-plan').html(newPlanData);
			        			}
			        		},
			        		error: function(){
			        			message.show({
			                    	type: 'normal',
			                		data: {
			                			tplData: {
			                				msg: '方案信息获取失败，请稍后重试。'
			                			}
			                		}
			                	});
			        		}
                        });
        			}else{
        				var message = new Message(res);
        				message.show();
        			}
        		},
        		error: function(){
        			var message = new Message('方案信息删除失败，请稍后重试。');
        			message.show();
        		}
        	});
		})
		//左侧栏位选择中样式
		$(".left-aside .row").click(function(){
			$(".left-aside .row").not($(this)).removeClass("active");
			$(this).addClass("active");
		})

		$('.J-fresh-balance').click(function(){

			//自动刷新
	        $.ajax({
	            url: 'newgame_play.shtml@tag=getuserbalance',
	            dataType: 'json',
	            method: 'GET',
	            success: function(r) {
	                if (Number(r['isSuccess']) == 1) {
	                   $('.J-balance-show').text('￥' + r['availablebalance']);
	                }
	            },
	            complete: function(){},
	            error: function(res){}
	        });
		});
		//当改变浏览器大小/卷动页面
		$(window).on({
			resize: function(){
				stickOldLink();
			},
			scroll: function(){
				stickOldLink();
			}
		})

	});
	function Message(title) {
		var template = '<div id="notice-mask">' +
			'<div class="j-ui-miniwindow pop w-9" style="z-index: 700; position: fixed; display: block; left: 50%; top: 50%;margin-top:-100px;margin-left:-236px;">' +
				'<div class="hd">' +
					'<i class="close closeBtn close-notice"></i>' +
					'<span class="title">温馨提示</span>' +
				'</div>' +
				'<div class="content_mid bd">' +
					'<div class="bd text-center">' +
						'<div class="pop-waring">' +
							'<h4 class="pop-text">' +
								'<i class="ico-waring"></i>' +
								'<h4 class="pop-text">'+title+'<br></h4>' +
							'</h4>' +
						'</div>' +
					'</div>' +
				'</div>' +
				'<button style="display: inline-block;" class="btn close-notice confirm">确 认<b class="btn-inner"></b></button>' +
			'</div>' +
		'</div>';
		this.show = function(){
			var me = this;
			$('body').css('overflow', 'hidden');
			$(template).appendTo('body');
			$('#notice-mask').css('height', $('#wrap').outerHeight(true)+'px');
			$('#notice-mask .close-notice').on('click', function(){
				me.hide();
			})
		}
		this.hide = function(){
			$('#notice-mask').remove();
			$('body').css('overflow', 'auto');
		}
	}

})(window, jQuery);
