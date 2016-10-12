(function() {
	window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);

	if (is_weixin()) {
		document.addEventListener('touchmove', function(e) {
			e.preventDefault();
		});
	};
	var shareData = {
		title: '绝对发现',
		desc: '测出你的绝对STYLE，赢取YOHO现金券',
		link: 'http://absolut.pernod-ricard-china.com/qrcode',
		imgUrl: 'http://absolut.pernod-ricard-china.com/assets/images/share.jpg'
	}
	$.ajax({
		'url': 'http://www.digiwine.com/sha-abswechat/get_signature.php?signurl=' + encodeURIComponent(location.href),
		'type': 'GET',
		'success': function(data) {
			var jdata = $.parseJSON(data);
			//console.log(jdata);
			if (jdata.appId) {
				var conObj = {
					//debug : true,
					appId: jdata.appId,
					timestamp: jdata.timestamp,
					nonceStr: jdata.nonceStr,
					signature: jdata.signature,
					jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
				}

				wx.config(conObj);

				wx.ready(function() {
					//wx.hideOptionMenu();
					oMS(shareData);
				});

				wx.error(function(res) {
					//alert(res);
				});

			}

		}
	});
	function oMS(obj) {
		wx.onMenuShareTimeline({
			title: obj.desc,
			link: obj.link,
			imgUrl: obj.imgUrl,
			success: function() {
				
			}
		});
		wx.onMenuShareAppMessage({
			title: obj.title,
			desc: obj.desc,
			link: obj.link,
			imgUrl: obj.imgUrl,
			success: function() {
				
			}
		});
	}
}());
var imgArray = ["s1.jpg", "s2.jpg", "s3.jpg", "s4.jpg", "s5.jpg", "s6.jpg", "s7.jpg", "s8.jpg", "s9.jpg",
	"f1.jpg", "f2.jpg", "f3.jpg", "f4.jpg", "f5.jpg", "f6.jpg", "f7.jpg", "f8.jpg", "f9.jpg",
	"m1.jpg", "m2.jpg", "m3.jpg", "m4.jpg", "m5.jpg", "m6.jpg", "m7.jpg", "m8.jpg", "m9.jpg",
	"a1.jpg", "a2.jpg", "a3.jpg", "a4.jpg", "a5.jpg", "a6.jpg", "a7.jpg", "a8.jpg", "a9.jpg",
];
$(document).ready(function() {
	ABSgame.checkedEffectQ1();
	for (var i = 0; i < imgArray.length; i++) {
		var img = new Image();
		img.src = img_url + "/images/" + imgArray[i];
		// img.src = img_url + "images/" + imgArray[i];
	}
	$.ajax({
		url: window.url_5,
		type: 'POST'
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	/* --- created by Barry in 20160818 start --- */
	$('.pic1 .btn').on('click', function() {
		$('.float').show();
	});
	$('.float').on('click', function() {
		$(this).hide();
	});
	/* --- created by Barry in 20160818 end --- */
});

function is_weixin() {
	var ua = navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == "micromessenger") {
		return true;
	} else {
		return false;
	}
}
var style_type;
var style_name;
var ABSgame = {
	toPage: function(pageid) {
		$(".page").hide();
		$("#page" + pageid).show();
	},
	checkedEffectQ1: function() {
		var $label = $("#page3 label");
		$label.on('click', function(event) {
			ABSgame.checkRule1();
			var isChecked = $(this).children('input').is(':checked');
			if (isChecked) {
				$(this).addClass('checked');
			} else {
				$(this).removeClass('checked');
			}
		});
	},
	checkRule1: function() {
		var $label = $("#page3 label");
		var amount = $("#page3 label input:checked").length;
		if (amount == 3) {
			$("#page3 label input").not(':checked').attr('disabled', 'disabled');
		} else {
			$("#page3 label input").removeAttr('disabled');
		}
	},
	checkQ1: function() {
		var $label = $("#page3 label");
		var $checked = $("#page3 label.checked input");
		if ($checked.length == 0) {
			return;
		}
		var c = [];
		var q1data = [];
		for (var i = 0; i < $label.length; i++) {
			if ($label.eq(i).hasClass('checked')) {
				q1data[i] = 1;
			} else {
				q1data[i] = 0;
			}
		}
		console.log(q1data);
		for (var i = 0; i < $checked.length; i++) {
			c.push($checked[i].id.substr(0, 1));
		}
		style_type = c.join("");
		console.log(style_type);
		$.ajax({
				url: window.url_4,
				type: 'POST',
				dataType: 'json',
				data: {
					subject1: q1data[0],
					subject2: q1data[1],
					subject3: q1data[2],
					subject4: q1data[3]
				},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		ABSgame.appendImg(style_type);
		ABSgame.checkedEffectQ2();
		ABSgame.appendRes(style_type);
		ABSgame.toPage(4);
	},
	checkedEffectQ2: function() {
		var $mask = $("#page4 .mask");
		$mask.on('click', function(event) {
			$(this).toggleClass('checked');
			ABSgame.checkRule2();
		});
	},
	checkRule2: function() {
		var $checked = $("#page4 .mask.checked");
		var amount = $checked.length;
		if (amount == 5) {
			$("#page4 .mask").not('.checked').attr('disabled', 'disabled');
		} else {
			$("#page4 .mask").removeAttr('disabled');
		}
	},
	checkQ2: function() {
		var $checked = $("#page4 .mask.checked");
		var amount = $checked.length;
		if (amount < 3) {
			alert('必须选择3-5项！');
			return;
		} else {
			if (style_type.length == 2) {
				var $checked1 = $("#page4 .mask.checked." + style_type.substr(0, 1));
				var $checked2 = $("#page4 .mask.checked." + style_type.substr(1, 1));
				if ($checked2.length > $checked1.length) {
					style_type = style_type.substr(1, 1) + style_type.substr(0, 1);
				}
			}
		}
		console.log(style_type);
		$.ajax({
				url: window.url_1,
				type: 'POST',
				dataType: 'json',
				data: {
					style_type: style_type,
					style_name: style_name
				},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		ABSgame.toPage(5);
	},
	appendImg: function(q1) {
		var $td = $(".content td");
		var q = q1.split("");
		var arr;
		switch (q1.length) {
			case 1:
				arr = [q1, q1, q1, q1, q1, q1, q1, q1, q1];
				break;
			case 2:
				arr = q.concat(q, q, q, q);
				break;
			case 3:
				arr = q.concat(q, q);
				break;
			default:
				return;
		}
		var ran1 = _.sample(arr, 9);
		var ran2 = _.shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9]);
		for (var i = 0; i < 9; i++) {
			var id = ran1[i] + ran2[i];
			$td.eq(i).prepend('<img src="' + img_url + '/images/' + id + '.jpg">');
			// $td.eq(i).prepend('<img src="' + 'images/' + id + '.jpg">');
			$td.eq(i).append('<button class="mask ' + id.substr(0, 1) + '"></button>');
			//$td.eq(i).prepend('<img src={{URL::asset("assets/images/'+id+'.jpg")}}>');
		}
	},
	appendRes: function(q1) {
		var t = $("#page5 .t3");
		switch (q1) {
			case "f":
				t.text("原宿行者");
				break;
			case "m":
				t.text("电音狂人");
				break;
			case "s":
				t.text("街头斗士");
				break;
			case "a":
				t.text("绝对饮者");
				break;
			case "fm":
				t.text("嘻哈达人");
				break;
			case "fs":
				t.text("风尚舵主");
				break;
			case "fa":
				t.text("绝对潮范 ");
				break;
			case "ms":
				t.text("黑泡玩家");
				break;
			case "ma":
				t.text("绝对潮范");
				break;
			case "sa":
				t.text("绝对潮范");
				break;
			case "fms":
				t.text("潮人先锋");
				break;
			case "fma":
				t.text("绝对潮范");
				break;
			case "fsa":
				t.text("绝对潮范");
				break;
			case "msa":
				t.text("绝对潮范");
				break;
			default:
				t.text("绝对潮范");
		}
		style_name = t.text();

	},
	getCaptcha: function() {
		var tel = $("#page6 .block6 input").val();
		var $btn = $(".block7 button");
		var sec = 60;
		var n = 1;
		var reg = /^1[34578]\d{9}$/;
		if (reg.test(tel)) {
			$btn.attr('disabled', true);
			var t = window.setInterval(function(argument) {
				n++;
				sec--;
				$btn.html(sec + '秒后<br/>重新获取');
				if (n >= 60) {
					$btn.attr('disabled', false);
					$btn.html('点击获取<br/>验证码');
					window.clearInterval(t);
				}
			}, 1000);
			$.ajax({
					url: window.url_2,
					type: 'POST',
					dataType: 'json',
					data: {
						mobile: tel
					},
				})
				.done(function(data) {
					if (data == 0) {
						alert("获取失败，请重试");
					} else if (data == 1) {
						console.log('success');
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

		} else {
			alert("号码有误~");
		};
	},
	submitMsg: function() {
		var name = $("#page6 .block5 input").val();
		var tel = $("#page6 .block6 input").val();
		var captcha = $("#page6 .block8 input").val();
		var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
		var $coupon = $("#page7 .t2");
		if (name.length >= 1) {
			if (reg.test(tel)) {
				$.ajax({
						url: window.url_3,
						type: 'POST',
						dataType: 'json',
						data: {
							name: name,
							mobile: tel,
							captcha: captcha
						},
					})
					.done(function(data) {
						console.log("success");
						var result = data.result;
						var coupon = data.coupon;
						$coupon.text(coupon);
						if (result == 1 || result == 3) {
							$("#page7 .case1").show();
							ABSgame.toPage(7);
							$("#page7 .coupon").click(function(event) {
								$("#page7 .case1").hide();
								$("#page7 .step2").show();
							});
						} else if (result == 2) {
							ABSgame.toPage(7);
							$("#page7 .case2").show();
						} else if (result == 0) {
							alert(result);
						} else if (result == 4) {
							alert('验证码错误');
						} else {
							alert(result);
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});

			} else {
				alert("号码有误~");
			}
		} else {
			alert("请填写姓名")
		}

	}
};