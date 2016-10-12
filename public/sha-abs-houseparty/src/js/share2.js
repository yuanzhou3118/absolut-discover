$(function() {
	
	var theme,
		openid,
		nickname,
		utm_source,
		utm_medium;
	
	if (gqs('openid')) {
		openid = gqs('openid');
	} else {
		openid = '';
	}
	if (gqs('nickname')) {
		nickname = gqs('nickname');
	} else {
		nickname = '';
	}
	if (gqs('utm_source')) {
		utm_source = gqs('utm_source');
	} else {
		utm_source = '';
	}
	if (gqs('utm_medium')) {
		utm_medium = gqs('utm_medium');
	} else {
		utm_medium = '';
	}
	
	$('.nickname').text(nickname);
	
	$('.go').attr('href', 'index.html?&utm_source=' + utm_source + '&utm_medium=' + utm_medium);
	
	$.ajax({
		url: '/house-party-theme',
		type: 'GET',
		dataType: 'json',
		data: {
			openid: openid
		},
	})
	.done(function(data) {
		theme = data.theme.split('-');
		show(theme);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	$('.detail').on('click', function() {
		$('.detail_float').show();
	});
	$('.d_close').on('click', function() {
		$('.detail_float').hide();
	});
	
	function show(theme) {
		$('.city').css('backgroundImage', 'url(assets/art/final/city' + theme[0] + '.png)');
		$('.scene').css('backgroundImage', 'url(assets/art/final/scene' + theme[1] + '.png)');
		$('.theme').css('backgroundImage', 'url(assets/art/final/theme' + theme[2] + '.png)');
		$('.drink').css('backgroundImage', 'url(assets/art/final/drink' + theme[3] + '.png)');
		$('.city').addClass('c');
		$('.scene').addClass('s');
		$('.theme').addClass('th');
		$('.drink').addClass('d');
	}
	
	function gqs(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"),
			r = window.location.search.substr(1).match(reg);
		if (r != null) return decodeURIComponent(r[2]);
		return null;
	}
	
});