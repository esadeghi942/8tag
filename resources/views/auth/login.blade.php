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
    <div class="col-md-6 center">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">ورود به سایت</h3>
            </div>
            @include('admin.partials.notifications')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-body">
                    @include('users.partials.errors')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">تلفن</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}"
                                   id="inputphone" autofocus required placeholder="شماره تلفن را وارد کنید">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" required id="inputPassword3"
                                   autofocus placeholder="پسورد را وارد کنید">
                        </div>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                ↻
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label" for="exampleCheck2">مرا به خاطر بسپار</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('password.request') }}">
                                Forgot password
                            </a>
                        @endif
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">ورود</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
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



