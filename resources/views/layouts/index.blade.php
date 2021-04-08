<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>پنل مدیریت | شروع سریع</title>

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

    </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('users/partials/header')

    @include('users/partials/sidebar')

    @yield('content')

    @include('users/partials/footer')
</div>

</body>
</html>
