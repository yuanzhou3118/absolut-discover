require.config({
	baseUrl: '',
	paths: {
		fastclick: 'assets/lib/fastclick.min',
		cjs: 'assets/lib/createjs.min',
		wx: 'assets/lib/jweixin-1.0.0',
		jquery: 'assets/lib/jquery-1.7.2.min',
		md5: 'assets/lib/md5'
	}
});
// , 'src/js/fx'
require(['require', 'src/js/fn', 'src/js/share', 'src/js/fx'], function(require, F) {
	
	var ABS = new F.Fn(),
		ABS_GET = new F.Fn({type: 'GET', dateType: 'jsonp'}),
		ABS_GET_JSON = new F.Fn({type: 'GET', dateType: 'json'});
	
	var cookie = document.cookie.split('; ');
	
	var openid, utm_source, utm_medium;
	if (ABS.gqs('openid')) {
		openid = ABS.gqs('openid');
	} else {
		openid = '';
	}
	if (ABS.gqs('utm_source')) {
		utm_source = ABS.gqs('utm_source');
	} else {
		utm_source = '';
	}
	if (ABS.gqs('utm_medium')) {
		utm_medium = ABS.gqs('utm_medium');
	} else {
		utm_medium = '';
	}
	
	// add gdt & wechat
	if (utm_source == 'gdt' || utm_medium == 'wechat_wlg') {
		$('.sm').css({'margin-top': '0.4rem'});
		$('.gdt').show();
	}
	
	if (!ABS.gqs('openid')) {
		document.cookie = 'utm_source=' + utm_source;
		document.cookie = 'utm_medium=' + utm_medium;
	} else if (ABS.gqs('utm_source') && ABS.gqs('utm_medium')) {
		var openid = ABS.gqs('openid');
	}
	
	if(ABS.gqs('openid') === null) {
		// var time = new Date().getTime();
		// var unixtime = Math.floor(time/1000);
		// var key = 'gyp2016';
		// var a = '5spzSmcI0h';
		// var token = hex_md5(key+unixtime);
		// location.href = 'http://mnbq1pro.gypserver.com/wxAPI/?mark=getwxoauth&token=' + token + '&unixtime=' + unixtime + '&a=' + a + '&rurl=' + encodeURIComponent(location.origin+location.pathname) + '&scope=snsapi_userinfo';
		ABS_GET.ajax('/house-party-index', {
			openid: openid
		}, function(done) {
			console.log(done);
			var url = done.url;
			// if (result == 2) {
				window.location.href = url;
			// }
		});
	}
	
	var cookie = document.cookie.split('; ');
	
	var utm_source1, utm_medium1;
	
	var i = 0, len = cookie.length;
	for (; i < len; i++) {
		var source = cookie[i].split('=')[0],
			medium = cookie[i].split('=')[1];
		if (source == 'utm_source') {
			utm_source1 = medium;
		}
		if (source == 'utm_medium') {
			utm_medium1 = medium;
		}
	}
	
	// if (window.location.search) {
	// 	if (!ABS.gqs('utm_source') && !ABS.gqs('utm_medium')) {
	// 		window.location.href = window.location.href + '&utm_source=' + utm_source1 + '&utm_medium=' + utm_medium1;
	// 	}
	// }
	
	$(function() {
		var FastClick = require('fastclick');
		FastClick.attach(document.body);
		if (ABS.gqs('openid') && !ABS.gqs('utm_source') && !ABS.gqs('utm_medium')) {
			window.location.href = window.location.href + '&utm_source=' + utm_source1 + '&utm_medium=' + utm_medium1;
		}
	});
	
	var whichCity = '',
		whichScene = 1,
		whichTheme = 1,
		whichDrink = 1,
		recordStep = 1;
	
	// age confirm
	// var flag = true;
	$('.yes').on('click', function() {
		$('.ageConfirm').hide();
		// $('.container').show();
	});
	
	// p1
	// ABS.slideHidePage('.p1_inner', function() {
	// 	$('#p2').show();
	// 	ABS_GET_JSON.ajax('/house-party-user-info', {});
	// });
	
	$('.p1_inner').on('click', function() {
		$('#p1').hide();
		$('#p4').show();
		ABS_GET_JSON.ajax('/house-party-user-info', {
			openid: openid
		});
	});
	
	$('.detail').on('click', function() {
		$('.detail_float').show();
	});
	$('.d_close').on('click', function() {
		$('.detail_float').hide();
	});
	
	var show_step = $('.show_step'),
		back = $('.back'),
		step1 = $('.step1'),
		step_rest = $('.step_rest'),
		$scs = $('.scs li');
	
	var party = {
		scene: $('.letsParty .scene'),
		theme: $('.letsParty .theme'),
		city: $('.letsParty .city'),
		drink: $('.letsParty .drink')
	}
	
	var order = [];
	
	// p2
	$('.more_cites').on('click', function() {
		$('.your_city').show();
	});
	$('.g_close').on('click', function() {
		$('.your_city').hide();
	});
	$('.go_scene').on('click', function() {
		if ($('.your_city .city').val() == '') {
			whichCity = '';
			alert('请填写城市或者关闭并选择已有城市再进行下一步');
		} else {
			whichCity = $('.your_city .city').val();
			order[0] = 4;
			recordStep++;
			back.show();
			ABS.stepBg(show_step, recordStep);
			step1.hide();
			$('.your_city').hide();
			step_rest.show();
		}
	});
	var $cities = $('.step1').children('span');
	ABS.forYou($cities, 3, function(index) {
		whichCity = ABS.city(index + 1);
		order[0] = index + 1;
		console.info('city: ' + whichCity);
		recordStep++;
		back.show();
		step_rest.show();
		ABS.stepBg(show_step, recordStep);
		step1.hide();
	});
	
	var timer;
	// p3
	ABS.forYou($scs, 4, function(index) {
		switch(recordStep) {
			case 2:
				recordStep++;
				back.data('step', 3);
				ABS.fourBgs($scs, 'theme');
				ABS.stepBg(show_step, recordStep);
				whichScene = index + 1;
				order[1] = whichScene;
				console.info('scene: ' + whichScene);
				break;
			case 3:
				recordStep++;
				back.data('step', 4);
				ABS.fourBgs($scs, 'drink');
				ABS.stepBg(show_step, recordStep);
				whichTheme = index + 1;
				order[2] = whichTheme;
				console.info('theme: ' + whichTheme);
				break;
			case 4:
				step_rest.hide();
				show_step.hide();
				back.data('step', 5);
				$('.name_party').show();
				whichDrink = index + 1;
				order[3] = whichDrink;
				ABS.letsParty(party, order, function() {
					party.scene.addClass('s');
					party.theme.addClass('th');
					party.drink.addClass('d');
					party.city.addClass('c');
					timer = setInterval(function() {
						if ($('.underline').css('display') == 'block') {
							$('.underline').hide();
						} else {
							$('.underline').show();
						}
					}, 800);
				});
				console.info('drink: ' + whichDrink);
				console.info(order);
				break;
			case 5:
				
				break;
			default:
				break;
		}
	});
	
	// back
	back.on('click', function() {
		var step = $(this).data('step');
		switch(step) {
			case 2:
				ABS.stepBg(show_step, 1);
				recordStep = 1;
				back.hide();
				step1.show();
				step_rest.hide();
				break;
			case 3:
				ABS.stepBg(show_step, 2);
				recordStep = 2;
				back.data('step', 2);
				ABS.fourBgs($scs, 'scene');
				break;
			case 4:
				ABS.stepBg(show_step, 3);
				recordStep = 3;
				back.data('step', 3);
				ABS.fourBgs($scs, 'theme');
				break;
			case 5:
				ABS.stepBg(show_step, 4);
				recordStep = 4;
				back.data('step', 4);
				ABS.fourBgs($scs, 'drink');
				$('.name_party').hide();
				$('.show_step').show();
				$('.step_rest').show();
				break;
			default:
				break;
		}
	});
	
	// p4 && p5 && p6
	var phoneReg = /^1[34578]\d{9}$/,
		codeReg = /[0-9]{4}/;
	
	var elements = $('input.want'),
		len = elements.length;
		// console.log(len);
	for(var i = 0; i < len; i++) {
		elements[i].oninput = function() {
			if (this.value.length) {
				this.style.backgroundImage = 'none';
			} else {
				this.style.backgroundImage = 'url(assets/art/p5/' + this.getAttribute('data-name') + '.png)';
			}
		}
		elements[i].onfocus = function() {
			this.style.backgroundImage = 'none';
			clearInterval(timer);
			$('.underline').hide();
		}
		elements[i].onblur = function() {
			if (this.value == '') {
				this.style.backgroundImage = 'url(assets/art/p5/' + this.getAttribute('data-name') + '.png)';
				timer;
			}
		}
	}
	
	$('.sub_party').on('click', function() {
		if (elements[0].value != '') {
			$('#p4').hide();
			$('#p5').show();
			back.hide();
			clearInterval(timer);
		} else {
			alert('请命名你的轰趴_');
		}
	});
	
	// p5
	$('#p5 .getCaptcha').on('click', function() {
		if (phoneReg.test(elements[3].value)) {
			ABS.ajax('/house-party-captcha', {
				mobile: elements[3].value,
			}, function(done) {
				console.log(done);
				var result = done.result;
				if (result) alert('发送成功');
				else alert('发送失败');
			});
		} else {
			alert('请填写正确的手机号');
		}
	});
	// check birthday
	var birthday = '';
	function checkBirthday(y, m, d) {
		var year = parseInt(y.val()),
			month = parseInt(m.val()),
			date = parseInt(d.val());
		if (ABS.checkBirthday(year, month, date)) {
			// is leap year
			if (ABS.isLeapYear(year)) {
				if (month == 2 && date > 29) {
					return false;
				}
			// in not leap year
			} else {
				if (month == 2 && date > 28) {
					return false;
				}
			}
			// is 18
			// if (2016 - year >= 18) {
				year += '';
				if (month < 10) {
					month = '0' + month;
				} else {
					month += '';
				}
				if (date < 10) {
					date = '0' + date;
				} else {
					date += '';
				}
				birthday = year + month + date;
				console.log(birthday);
				return true;
			// } else {
			// 	return false;
			// }
		} else {
			return false;
		}
	}
	
	$('.apply').on('click', function() {
		if (!checkBirthday($('.year').eq(0), $('.month').eq(0), $('.day').eq(0))) {
			alert('请填写正确的日期');
		} else {
			if (codeReg.test(elements[3].value)) {
				$('.noClick').show();
				ABS.ajax('/house-party-send-user', {
					theme: order.join('-'),
					city: whichCity,
					birthday: birthday,
					utm_source: utm_source,
					utm_medium: utm_medium,
					party_name: elements[0].value,
					name: elements[2].value,
					mobile: elements[3].value,
					captcha: elements[4].value
				}, function(done) {
					console.log(done);
					var result = done.result;
					if (result == 1) {
						$('.noClick').hide();
						$('.msg').show();
					}
					else alert('提交失败');
				});
			} else {
				alert('请填写正确的验证码');
			}
		}
	});
	// p5 & p6
	$('.invite').on('click', function() {
		$('.float').show();
	});
	$('.float').on('click', function() {
		$(this).hide();
	})
});