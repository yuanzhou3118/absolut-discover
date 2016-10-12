<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登陆</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/login-style.css')}}">
</head>
<body>
<div class="main">
    <div class="logo">
        <span></span>
    </div>
    <form action="{{URL::route('admin.login.do')}}" method="post" class="form-login">
        {{csrf_field()}}
        <input type="text" name="account" id="username" placeholder="Username:" value="{{$backend_user->account}}">
        <input type="password" name="pwd" id="password" placeholder="Password:" value="{{$backend_user->pwd}}">
        <div class="result">
            <span>{{$result or ''}}</span>
        </div>
        <input type="submit" name="" id="button" value="GO">
    </form>
</div>
</body>
</html>