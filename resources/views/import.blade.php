<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <title>导入Coupon</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    导入Coupon
                </div>
                <div class="panel-body">
                    <a href="{{URL::route('backend.index')}}"
                       class="btn btn-success">返回</a>
                </div>
                <p class="text-center">{{$result or ''}}</p><br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>