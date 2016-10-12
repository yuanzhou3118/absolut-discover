<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no" />
    <title>absoult</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/share.css')}}">
</head>
<body>
<img src="{{URL::asset('assets/images/share.png')}}" alt="">
</body>
<script type="text/javascript" src="{{URL::asset('assets/javascript/rem.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/jquery-2.1.3.min.js')}}"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
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
					wx.hideOptionMenu();
				});

				wx.error(function(res) {
					//alert(res);
				});

			}

		}
	});
</script>
</html>