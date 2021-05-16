<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>8-Tag</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="/css/persian-datepicker.min.css">

    <!-- template rtl version -->
    <link rel="stylesheet" href="/css/custom-style.css">

    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/adminlte.min.js"></script>


    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker.min.js"></script>
    <style>
        .wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            padding: 4% 0;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="col-md-4 col-sm-10 center">
        <!-- Horizontal Form -->
        <div class="card card-info">
            {{-- <div class="card-header">
                 <h3 class="card-title">ورود به سایت</h3>
             </div>--}}
            @include('user.partials.notifications')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-body">
                    <div class="border-bottom mb-3">
                        <p class="d-flex flex-column text-center">
                            <span class="text-muted">فرم زیر را تکمیل کنید و ورود بزنید</span>
                        </p>
                    </div>
                    @include('user.partials.errors')
                    <div class="form-group">
                        <label for="inputphone" class="col-sm-12 control-label">نام کاربری</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}"
                                   id="inputphone" autofocus required placeholder="شماره تلفن را وارد کنید">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-12 control-label">رمز عبور</label>

                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" required id="inputPassword3"
                                   autofocus placeholder="پسورد را وارد کنید">
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <button type="button" class="btn reload" id="reload">
                            <span class="fa fa-refresh"></span>
                        </button>
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                        </div>
                        <input id="captcha" type="text" class="form-control" placeholder="کد امنیتی" name="captcha">
                    </div>
                    <div class="form-group row border-bottom">
                        <div class="form-check mr-3">
                            <input type="checkbox" name="remember" checked class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">به خاطر سپاری</label>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3 mr-auto btn-flat mb-3">ورود</button>
                    </div>
                    <div class="mb-3">
                        <p class="d-flex flex-column text-center">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                   href="{{ route('password.request') }}">
                                    کلمه عبور خود را فراموش کرده ام
                                    <span class="fa fa-lock"></span></a>
                            @endif
                        </p>
                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
<style>
    .header {
        text-align: center;
        font-size: 20px;
        color: gray;
        padding: 20px
    }

    .reload {
        background-color: initial;
    }

    .control-label {
        color: gray;
    }

    .reload {
        position: absolute;
        right: 8px;
    }

    .fa-refresh {
        color: #17a2b8;
    }

    .captcha {
        position: absolute;
        left: 8px;
    }

    #captcha {
        padding-right: 43px;
    }
</style>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>
</html>



