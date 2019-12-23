<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="/css/trix.css">
        <script type="text/javascript" src="/js/trix.js"></script>

        <title>{{ config('app.name', '') }}</title>

        <script src="https://kit.fontawesome.com/4610084635.js" crossorigin="anonymous"></script>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

        <script>
            window.Laravel = {!! json_encode([
                'csrf_token' => csrf_token(),
            ]) !!};
        </script>

    </head>

    <body class="white-skin">
        <div id="app">

            <div class="container-fluid">
                <div class="row pt-5 mb-5">

                    @yield('content')

                </div>
            </div>

            <div class="row fixed-bottom">
                <div class="col border-top bg-light" style="height:5rem;">

                    <back_channel></back_channel>

                </div>
            </div>

            <flash-message message="{{ session('status') }}"></flash-message>

        </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>
