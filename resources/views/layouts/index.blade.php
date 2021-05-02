<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>8_Tag</title>

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
        <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <link rel="stylesheet" href="/css/custom-style.css">
        <link href="/css/jquery.dataTables.min.css" rel="stylesheet">

        <script src="/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/js/adminlte.min.js"></script>
        <script type="text/javascript" src="/js/moment.min.js"></script>
        <script src="/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/js/persian-date.min.js"></script>
        <script src="/js/persian-datepicker.min.js"></script>

        <script src="/js/jquery.validate.js"></script>
        <script src="/js/jquery.dataTables.min.js"></script>
        <style>
                .dataTables_wrapper{
                        width: 100%;
                        overflow: auto;
                        padding: 20px;
                }
        </style>
    </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('user/partials/header')

    @include('user/partials/sidebar')

    @yield('content')

    @include('user/partials/footer')
</div>

</body>
</html>
