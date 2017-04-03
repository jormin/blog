<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_title or config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="/css/app.css" rel="stylesheet">
    <link href='https://cdn.webfont.youziku.com/webfonts/nomal/100344/45809/58d3e741f629d803ac74bbe1.css' rel='stylesheet' type='text/css' />

    @stack('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @include('common._header')
        @yield('content')
        @include("common._footer")
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>
