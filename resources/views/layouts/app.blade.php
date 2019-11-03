<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', '') }}</title>

        <script src="https://kit.fontawesome.com/4610084635.js" crossorigin="anonymous"></script>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    </head>

    <body class="white-skin">
        <div id="app">

            <div class="container-fluid">
                <div class="row pt-5">

                    @yield('content')

                </div>
            </div>

            <div class="row fixed-bottom">
                <div class="col border-top">

                    <iframe
                        src="{{ config('app.url') }}/dozzle/container/{{ Illuminate\Support\Str::limit($container['Id'], 12, '') }}"
                        class="border-0"
                        width="100%"
                        height="200"
                    >
                    </iframe>

                </div>
            </div>

        </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>
