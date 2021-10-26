<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vue</title>
        <link rel="stylesheet" href="{{ asset('lib/alertify/alertify.css') }}">
        <link rel="stylesheet" href="{{ asset('lib/alertify/semantic.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <articulo-component/>
        </div>
        <script src="{{ asset('lib/alertify/alertify.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>