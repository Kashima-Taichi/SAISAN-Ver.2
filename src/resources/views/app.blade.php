<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SAISAN Ver.2') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('gold.ico') }}" type="image/vnd.microsoft.icon" />
    <link rel="icon" href="{{ asset('gold.ico') }}" type="image/vnd.microsoft.icon" />
</head>
<body>
<div id="app">
<header-component></header-component>
<router-view></router-view>
</div>
<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
