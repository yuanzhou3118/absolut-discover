define(['jquery', 'wx'], function($, wx) {
	
	$(function() {
		var shareData = {
			title: '轰趴怎么玩？绝对由你！',
			desc: '我们有场地和酒，你有创意吗？用创意造一场轰趴！',
			link: 'http://absolut.pernod-ricard-china.com/sha-abs-houseparty/share.html?openid=' + gqs('openid') + '&nickname=' + gqs('nickname') + '&utm_source=' + gqs('utm_source') + '&utm_medium=' + gqs('utm_medium'),
			imgUrl: 'http://absolut.pernod-ricard-china.com/sha-abs-houseparty/assets/art/share.jpg'
		}
		
		$.ajax({
			url: 'http://www.digiwine.com/sha-abswechat/get_signature.php?signurl=' + encodeURIComponent(window.location.href),
			type: 'GET',
			success: function(data) {
				var jdata = $.parseJSON(data);
				if (jdata.appId) {
					var conObj = {
						// debug: true,
						appId : jdata.appId,
						timestamp : jdata.timestamp,
						nonceStr : jdata.nonceStr,
						signature : jdata.signature,
						jsApiList : ['onMenuShareTimeline','onMenuShareAppMessage']
					}
					wx.config(conObj);
				}
			}
		});
		
		wx.ready(function() {
			oMS(shareData);
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
	});
	
	function gqs(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"),
			r = window.location.search.substr(1).match(reg);
		if (r != null) return decodeURIComponent(r[2]);
		return null;
	}
});