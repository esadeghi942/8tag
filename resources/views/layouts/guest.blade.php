<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/persian-datepicker.min.css">


        <!-- Theme style -->
        <link rel="stylesheet" href="/css/adminlte.css">
        <link rel="stylesheet" href="/css/custom-style.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/persian-date.min.js"></script>
        <script src="/js/persian-datepicker.min.js"></script>
        <script src="/js/adminlte.js"></script>
    <script>
        $(function () {
            $('.normal-example').persianDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                altField: '.observer-example-alt'
            });
        });
    </script>
    </body>
</html>
