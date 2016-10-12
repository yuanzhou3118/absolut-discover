define(['jquery', 'fastclick', 'md5'], function($) {
	
	var isTouch = false,
		DY_VALUE = 80,
		DT_VALUE_MIN = 250,
		DT_VALUE_MAX = 500;
	
	var ABS = function(argus) {
		this._argus = $.extend({}, ABS.defaults, argus);
	}, p = ABS.prototype;
	
	ABS.defaults = {
		type: 'POST',
		dataType: 'json'
	}
	
	p.isLeapYear = function(year) {
		if (year % 4 == 0 && year % 100 != 0) {
			return true;
		}
		if (year % 400 == 0) {
			return true;
		}
		return false;
	}
	
	var yearReg = /^(19|20)[0-9]{2}$/,
		monthReg = /^(0?[1-9]|1[0-2])$/,
		dateReg = /^(0?[1-9]|[12][0-9]|3[01])$/;
	p.checkBirthday = function(year, month, date) {
		if (yearReg.test(year) &&
			monthReg.test(month) &&
			dateReg.test(date)) {
			return true;
		}
		return false;
	}
	
	var t, y, dy;
	p.slideHidePage = function(page, fn) {
		var _p = $(page)[0];
		
		_p.addEventListener('touchstart', function(event) {	
			isTouch = true;
			t = new Date();
			y = event.touches[0].pageY;
		}, false);
		
		_p.addEventListener('touchmove', function(event) {
			event.preventDefault();
			if (isTouch) {
				dy = y - event.touches[0].pageY;
			}
		}, false);
		
		_p.addEventListener('touchend', function(event) {
			isTouch = false;
			var dt = new Date() - t;
			if (dy >= DY_VALUE || dt <= DT_VALUE_MAX && dt >= DT_VALUE_MIN) {
				this.parentNode.style.display = 'none';
				fn && fn();
			}
		}, false);
	}
	
	p.gqs = function(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"),
			r = window.location.search.substr(1).match(reg);
		if (r != null) return decodeURIComponent(r[2]);
		return null;
	}
	
	p.ajax = function(url, datas, fn) {
		var _argus = this._argus;
		$.ajax({
			url: url,
			type: _argus.type,
			dataType: _argus.dataType,
			data: datas,
			success: function(done) {
				fn && fn(done);
			},
			error: function(fail) {
				console.log('Error');
			}
		});
	}
	
	p.city = function(id) {
		switch (id) {
			case 1:
				return '北京';
				break;
			case 2:
				return '上海';
				break;
			case 3:
				return '成都';
				break;
			default:
				break;
		}
	}
	
	p.stepBg = function(obj, step) {
		obj.css('backgroundImage', 'url(assets/art/step' + step + '.png)');
	}
	
	p.fourBgs = function(obj, which) {
		obj.eq(0).css('backgroundImage', 'url(assets/art/p4/' + which + '1.jpg)');
		obj.eq(1).css('backgroundImage', 'url(assets/art/p4/' + which + '2.jpg)');
		obj.eq(2).css('backgroundImage', 'url(assets/art/p4/' + which + '3.jpg)');
		obj.eq(3).css('backgroundImage', 'url(assets/art/p4/' + which + '4.jpg)');
	}
	
	p.letsParty = function(obj, order, fn) {
		obj.city.css('backgroundImage', 'url(assets/art/final/city' + order[0] + '.png)');
		obj.scene.css('backgroundImage', 'url(assets/art/final/scene' + order[1] + '.png)');
		obj.theme.css('backgroundImage', 'url(assets/art/final/theme' + order[2] + '.png)');
		obj.drink.css('backgroundImage', 'url(assets/art/final/drink' + order[3] + '.png)');
		fn && fn();
	}
	
	p.forYou = function(obj, n, fn) {
		var index;
		for (var i = 0; i < n; i++) {
			obj.eq(i).on('click', function() {
				if ($(this).hasClass('skew')) {
					index = $(this).parent().index();
					fn && fn($(this), index);
				} else {
					index = $(this).index();
					fn && fn(index);
				}
				// console.log(index);
				
			});
		}
	}
	
	p.uptownFunk = function(obj, light, scene) {
		var cloth = obj.menu[0][0],
			food = obj.menu[1][0],
			music = obj.menu[2][0],
			part1 = obj.part[0][0],
			part2 = obj.part[1][0];
		
		var duration = 4000;
		
		AE({
			targets: [cloth],
			translateY: 14,
			duration: duration,
			elasticity: 0,
			direction: 'alternate',
			loop: true
		});
		
		AE({
			targets: [food],
			translateY: -14,
			duration: duration,
			delay: 80,
			elasticity: 0,
			direction: 'alternate',
			loop: true
		});
		
		AE({
			targets: [music],
			translateY: 12,
			delay: 150,
			duration: duration,
			elasticity: 0,
			direction: 'alternate',
			loop: true
		});
		
		AE({
			targets: [part1],
			translateY: 16,
			delay: 200,
			duration: duration,
			elasticity: 0,
			direction: 'alternate',
			loop: true
		});
		
		AE({
			targets: [part2],
			translateY: -12,
			delay: 100,
			duration: duration,
			elasticity: 0,
			direction: 'alternate',
			loop: true
		});
		
	}
	
	return {
		Fn: ABS
	}
	
});