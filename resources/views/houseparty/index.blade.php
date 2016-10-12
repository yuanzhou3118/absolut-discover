<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="Author" content="Funnychen38">
    <title>ABSOLUT Home Party</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('sha-abs-houseparty/src/css/main.css')}}">
    <script type="text/javascript" src="{{URL::asset('sha-abs-houseparty/assets/lib/rem.js')}}"></script>
</head>
<body>

<div class="ageConfirm full-size bg-common">
    <img class="logo center" src="{{URL::asset('sha-abs-houseparty/assets/art/logo.png')}}" alt="logo">
    <img class="p center" src="{{URL::asset('sha-abs-houseparty/assets/art/age/p.png')}}" alt="p">
    <form id="ageInput" class="clearfix center">
        <input class="year bg-common" type="tel" name="year" maxlength="4">
        <input class="month bg-common" type="tel" name="month" maxlength="2">
        <input class="day bg-common" type="tel" name="day" maxlength="2">
    </form>
    <span class="age_sub bg-common center"></span>
    <img class="warn center" src="assets/art/age/warn.png" alt="warn">
</div>

<div class="container full-size bg-common">

    <div id="p1" class="full-size">
        <img class="logo" src="assets/art/logo.png" alt="logo">
        <img class="t" src="assets/art/p1/t.png" alt="t">
        <img class="content" src="assets/art/p1/content.png" alt="content">
        <img class="construct" src="assets/art/p1/construct.png" alt="construct">
        <img class="arr" src="assets/art/p1/arr.png" alt="arr">
    </div>

    <div id="p2" class="full-size hidden">
        <img class="t" src="assets/art/p2/t.png" alt="t">
        <div class="cities">
            <img class="bj" src="assets/art/p2/beijing.png" alt="beijing">
            <img class="sh" src="assets/art/p2/shanghai.png" alt="shanghai">
            <img class="cd" src="assets/art/p2/chengdu.png" alt="chengdu">
        </div>
        <img class="mcs" src="assets/art/p2/more_cities.png" alt="more_cities">
    </div>

    <div id="p3" class="full-size hidden">
        <img class="t" src="assets/art/p3/t.png" alt="t">
        <ul class="scs center clearfix">
            <li class="scene1 bg-common"></li>
            <li class="scene2 bg-common"></li>
            <li class="scene3 bg-common"></li>
            <li class="scene4 bg-common"></li>
        </ul>
    </div>

    <div id="p4" class="full-size hidden">
        <!-- <canvas class="full-size" id="view" width="750" height="1208"></canvas> -->
        <div class="trigles center">
            <div class="choices_con">
                <span class="left cp-t bg-common"></span>
                <span class="left_text text">绝对轰趴，绝对伏特加</span>
                <span class="top cp-t bg-common"></span>
                <span class="top_text text">让音乐开始，让节奏不停</span>
                <span class="right cp-f bg-common"></span>
                <span class="right_text text">比基尼上线，爆破肾上腺</span>
            </div>
            <div class="scenes_con">
                <div class="all bg-common"></div>
                <span class="left cp-f"></span>
                <span class="right cp-t"></span>
            </div>
        </div>
        <img class="youlike center" src="assets/art/p4/youlike.png" alt="youlike">
        <div class="choices center">
            <ul class="list center clearfix">
                <li class="ele1 bg-common"></li>
                <li class="ele2 bg-common"></li>
                <li class="ele3 bg-common"></li>
                <li class="ele4 bg-common"></li>
            </ul>
            <ul class="menu center tc">
                <li class="subm1 bg-common"><span class="skew"></span></li>
                <li class="subm2 bg-common"><span class="skew"></span></li>
                <li class="subm3 bg-common"><span class="skew"></span></li>
            </ul>
        </div>
        <span class="create_party bg-common center"></span>
    </div>

    <div id="p5" class="tc full-size hidden">
        <img src="assets/art/p5/t.png" class="t center" alt="t">
        <form>
            <input type="text" name="name" class="name tc bg-common" data-name="name">
            <div class="mobile_con center clearfix">
                <input type="tel" name="mobile" maxlength="11" class="tl bg-common" data-name="mobile">
                <div class="bt getCaptcha"><span class="bg-common"></span></div>
            </div>
            <input type="tel" name="captcha" maxlength="4" class="captcha tl bg-common" data-name="captcha">
            <span class="apply center bg-common"></span>
        </form>
        <div class="msg full-size bg-common hidden">
            <img class="sm center" src="assets/art/p5/submit_msg.png" alt="submit_msg">
            <span class="invite center bg-common"></span>
        </div>
    </div>

    <div id="p6" class="tc full-size hidden">
        <img src="assets/art/p6/t.png" class="t center" alt="t">
        <form>
            <input type="text" name="city" class="city tc bg-common" data-name="city">
            <input type="text" name="name" class="name tc bg-common" data-name="name">
            <div class="mobile_con center clearfix">
                <input type="tel" name="mobile" maxlength="11" class="mobile tl bg-common" data-name="mobile">
                <div class="bt getCaptcha"><span class="bg-common"></span></div>
            </div>
            <input type="tel" name="captcha" maxlength="4" class="captcha tl bg-common" data-name="captcha">
            <span class="submit center bg-common"></span>
        </form>
        <div class="msg full-size bg-common hidden">
            <img class="am center" src="assets/art/p6/already_msg.png" alt="already_msg">
            <span class="invite center bg-common"></span>
        </div>
    </div>
    <span class="tip"><img src="assets/art/tip.png" alt=""></span>
</div>

<script type="text/javascript" data-main="src/js/main" src="assets/lib/require.min.js"></script>
</body>
</html>