<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>后台维护</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
</head>
<body style="padding: 100px;">
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">后台维护</div>
        <form action="{{URL::route('import.coupon')}}" method="post" class="form-horizontal"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <div class="col-sm-4">
                    <input class="form-control required" type="file" id="coupon_file" name="coupon_file">
                </div>
                <div class="col-sm-8">
                    <input type="submit" value="导入" class="btn btn-primary">
                </div>
            </div>
        </form>
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-1 control-label">总数</label>
                <div class="col-sm-11"><input placeholder="总数" type="text" name="id_card"
                                              class="form-control required" readonly="readonly" value="{{$coupon}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">已用数</label>
                <div class="col-sm-11"><input placeholder="已用数" type="text" name="id_card"
                                              class="form-control required" readonly="readonly" value="{{$use_coupon}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">剩余数</label>
                <div class="col-sm-11"><input placeholder="剩余数" type="text" name="id_card"
                                              class="form-control required" readonly="readonly"
                                              value="{{$not_use_coupon}}">
                </div>
            </div>
        </form>
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-1 control-label">coupon数据</label>
                <div class="col-sm-11"><a class="btn btn-primary" id="export" href="{{URL::route('export.coupon')}}">Export</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">领券数据</label>
                <div class="col-sm-11"><a class="btn btn-primary" id="export" href="{{URL::route('export.user.coupon')}}">Export</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">类型数据</label>
                <div class="col-sm-11"><a class="btn btn-primary" id="export" href="{{URL::route('export.user.style')}}">Export</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">主题数据</label>
                <div class="col-sm-11"><a class="btn btn-primary" id="export" href="{{URL::route('export.user.subject')}}">Export</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{URL::asset('assets/javascript/jquery-1.12.2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/javascript/bootstrap.min.js')}}"></script>
</body>
</html>