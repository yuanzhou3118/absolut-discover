<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="minimal-ui, width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Absolut</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/index.css')}}">
</head>
<body>
<div class="page" id="page0">
    <img src="{{URL::asset('assets/images/p0-logo.png')}}" alt="" class="logo">
    <div class="age">
        <img src="{{URL::asset('assets/images/p0-pic1.png')}}" alt="">
        <a class="reach" href="javascript:;" onclick="ABSgame.toPage(1)"></a>
    </div>
    <p class="t1">绝对伏特加提醒<br/>乐享美酒需理性</p>
</div>
<p class="notice">*绝对伏特加再次提醒您乐享美酒需理性</p>
<div class="page" id="page1">
    <div class="title">
        <p class="t1">
            绝对<sup>&#174;</sup>发现
        </p>
        <p class="t2">
            测出你的绝对<span>STYLE</span>
        </p>
        <img src="{{URL::asset('assets/images/p1-logo.png')}}" alt="">
    </div>
    <div class="pic1">
        <img src="{{URL::asset('assets/images/p1-pic1.png')}}" alt="">
    </div>
    <div class="coupon" onclick="ABSgame.toPage(2);ga('send', 'event','Discover','Join');">
        <p class="t3">
            即刻测试 赢取礼券
        </p>
        <img src="{{URL::asset('assets/images/p1-coupon.png')}}" alt="">
    </div>
</div>
<div class="page" id="page2">
    <div class="pic1">
        <img src="{{URL::asset('assets/images/p2-pic1.png')}}" alt="">
        <p class="t1">
            不跟随，绝对有态度！
            <br/>选择你的部落，热爱你的热爱，
            <br/>凭感觉选择所爱，
            <br/>发现你的绝对<span>STYLE</span>！
        </p>
        <div class="cta" onclick="ABSgame.toPage(3);ga('send', 'event','Discover','Testing');">
            <img src="{{URL::asset('assets/images/p2-cta.png')}}" alt="">
        </div>
        <p class="t2">
            参与测试，提交验证信息，
            <br/>即可参与赢取<span>YOHO</span>现金券！
        </p>
    </div>
</div>
<div class="page" id="page3">
    <div class="content">
        <div class="block1"></div>
        <div class="block2"></div>
        <div class="block3"></div>
        <p class="t1">
            你的兴趣你做主
        </p>
        <p class="t2">
            <span>Q:</span>你属哪一咖？
        </p>
        <p class="t3">
            （多面咖可多选）
        </p>
        <label for="fashion" class="fashion">
            <input type="checkbox" name='q1' id="fashion"> 日美街头潮牌咖
        </label>
        <label for="music" class="music">
            <input type="checkbox" name='q1' id="music"> 独立音乐夜店咖
        </label>
        <label for="sports" class="sports">
            <input type="checkbox" name='q1' id="sports"> 极限运动折腾咖
        </label>
        <label for="alcohol" class="alcohol">
            <input type="checkbox" name='q1' id="alcohol"> 绝对混调创意咖
        </label>
    </div>
    <div class="block4" onclick="ABSgame.checkQ1();">
        <p>下一步</p>
    </div>
    <div class="disc">
        <img src="{{URL::asset('assets/images/p3-disc.png')}}" alt="">
    </div>
</div>
<div class="page" id="page4">
    <div class="block1"></div>
    <div class="block2"></div>
    <div class="block3"></div>
    <p class="t1">
        <span>Q:</span>凭感觉
        <br/>选择你的热爱
    </p>
    <p class="t2">
        （从以下图片中快速选出你最带感的3-5项）
    </p>
    <p class="t3">
        *部分图片来源于网络
    </p>
    <div class="content">
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="block4"></div>
    <div class="block5" onclick="ABSgame.checkQ2();">
        <p>下一步</p>
    </div>
</div>
<div class="page" id="page5">
    <div class="pic1">
        <img src="{{URL::asset('assets/images/p5-photos.png')}}" alt="">
    </div>
    <div class="block1"></div>
    <div class="block2"></div>
    <div class="block3"></div>
    <div class="block5"></div>
    <p class="t1">
        发现你的绝对<span>STYLE</span>
    </p>
    <div class="block6"
         onclick="ABSgame.toPage(6);ga('send', 'event','Discover','QA-Result'+style_type.toUpperCase());">
        <p>即刻前往 赢取礼券</p>
    </div>
    <div class="block7">
        <p class="t2">
            你原来是
        </p>
        <p class="t3"></p>
    </div>
</div>
<div class="page" id="page6">
    <div class="block1"></div>
    <div class="block2"></div>
    <div class="block3"></div>
    <div class="block4"></div>
    <p class="t1">
        填写信息<br/>即刻前往 赢取礼券
    </p>
    <div class="block5">
        <input type="text" name="name" placeholder="姓名">
    </div>
    <div class="block6">
        <input type="text" name="tel" placeholder="电话号码" maxlength="11">
    </div>
    <div class="block7">
        <button onclick="ABSgame.getCaptcha();ga('send', 'event','Discover','SMS-Code');">点击获取<br/>验证码</button>
    </div>
    <div class="block8">
        <input type="text" name="captcha" placeholder="输入短信验证码" maxlength="11">
    </div>
    <div class="block9">
        <button onclick="ABSgame.submitMsg();ga('send', 'event','Discover','SMS-Submit');">确认<br/>提交</button>
    </div>
</div>
<div class="page" id="page7">
    <div class="pic1">
        <img src="{{URL::asset('assets/images/p7-pic1.png')}}" alt="">
        <div class="case1">
            <p class="t1">恭喜您获得</p>
            <div class="block1"></div>
            <div class="block2"></div>
            <div class="block3"></div>
            <img class="coupon" src="{{URL::asset('assets/images/p7-coupon.png')}}"
                 onclick="ga('send', 'event','Discover','Coupon-Get');" alt="">
        </div>
        <div class="step2">
            <p class="t2"></p>
            <p class="t3">复制券码，即可前往YOHO消费使用</p>
            <!-- add start -->
            <span class="btn">邀请好友</span>
            <!-- add end -->
        </div>
        <div class="case2">
            <p class="t4">很遗憾</p>
            <p class="t5">赢取失败，YOHO券和你擦肩而过了！</p>
            <!-- add start -->
            <span class="btn">邀请好友</span>
            <!-- add end -->
        </div>
    </div>
    <!-- add start -->
    <div class="float page">
        <img src="{{URL::asset('assets/images/share_float.png')}}" alt="share_float">
    </div>
    <!-- add end -->
</div>
</body>
<script type="text/javascript" src="{{URL::asset('assets/javascript/rem.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/fastclick.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/jquery-2.1.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/underscore-min.js')}}"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if($is_join)
        ABSgame.toPage(7);
        @if(mb_strlen($coupon) > 0)
        $("#page7 .step2").show();
        $('.step2 .t2').text('{{$coupon}}');
        @else
        $("#page7 .case2").show();
        @endif
        @endif
    });

    window.img_url = '{{URL::asset("assets/")}}';
    window.url_1 = '{{URL::route('user.style')}}';
    window.url_2 = '{{URL::route('user.mobile')}}';
    window.url_3 = '{{URL::route('user.coupon')}}';
    window.url_4 = '{{URL::route('user.subject')}}';
    window.url_5 = '{{URL::route('user.info')}}';
</script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/index.js')}}"></script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-25338682-36', 'auto');
    ga('send', 'pageview');

</script>


</html>