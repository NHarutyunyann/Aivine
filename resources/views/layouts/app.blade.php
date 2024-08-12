<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') Dinnoli</title>
    <link rel="shortcut icon" href="{{ URL::asset('/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('fonts/googleapis/fonts.googleapis.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link href="{{ asset('dist/admin/css/main.css?v=' . config('app.release')) }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
@yield('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/admin.js?v=' . config('app.release')) }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
