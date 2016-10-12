window.onload = function() {
	// GA
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
	ga('create', 'UA-25338682-47', 'auto');
	ga('send', 'pageview');
	// tracking
	function tracker(action) {
		ga('send', 'event', 'HouseParty', action);
	}
	
	$('.no')[0].addEventListener('click', function() {
		tracker('Age-gate-No');
	}, false);
	
	$('.yes')[0].addEventListener('click', function() {
		tracker('Age-gate-Yes');
	}, false);
	
	$('.bj')[0].addEventListener('click', function() {
		tracker('City-Beijing');
	}, false);
	
	$('.sh')[0].addEventListener('click', function() {
		tracker('City-Shanghai');
	}, false);
	
	$('.cd')[0].addEventListener('click', function() {
		tracker('City-Chengdu');
	}, false);
	
	$('.more_cites')[0].addEventListener('click', function() {
		tracker('City-More');
	}, false);
	
	$('.go_scene')[0].addEventListener('click', function() {
		tracker('City-Submit');
	}, false);
	
	var curStep,
		back = $('.back');
	
	$('.scene1').on('click', function() {
		curStep = back.data('step')-1;
		switch (curStep) {
			case 1:
				tracker('House-A');
				break;
			case 2:
				tracker('Theme-A');
				break;
			case 3:
				tracker('Drink-A');
				break;
			default:
				break;
		}
	});
	
	$('.scene2').on('click', function() {
		curStep = back.data('step')-1;
		switch (curStep) {
			case 1:
				tracker('House-B');
				break;
			case 2:
				tracker('Theme-B');
				break;
			case 3:
				tracker('Drink-B');
				break;
			default:
				break;
		}
	});
	
	$('.scene3').on('click', function() {
		curStep = back.data('step')-1;
		switch (curStep) {
			case 1:
				tracker('House-C');
				break;
			case 2:
				tracker('Theme-C');
				break;
			case 3:
				tracker('Drink-C');
				break;
			default:
				break;
		}
	});
	
	$('.scene4').on('clcik', function() {
		curStep = back.data('step')-1;
		switch (curStep) {
			case 1:
				tracker('House-D');
				break;
			case 2:
				tracker('Theme-D');
				break;
			case 3:
				tracker('Drink-D');
				break;
			default:
				break;
		}
	});
	
	$('.sub_party')[0].addEventListener('click', function() {
		tracker('Party-Generate');
	}, false);
	
	$('.getCaptcha')[0].addEventListener('click', function() {
		tracker('SMS-Code');
	}, false);
	
	$('.apply')[0].addEventListener('click', function() {
		tracker('HouseParty-Apply');
	}, false);
	
	$('.invite')[0].addEventListener('click', function() {
		tracker('Sharing');
	}, false);
	
	$('.gotobuy')[0].addEventListener('click', function() {
		tracker('EC');
	}, false);
	
}