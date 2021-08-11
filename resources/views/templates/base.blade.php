<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicons/favicon.ico')}}" type="image/x-icon">
    <title>Stock - @hasSection('title') @yield('title') @endif</title>
</head>
<body class="d-flex flex-column min-vh-100">
@include('_partials.navbar')

@hasSection('content')
    @yield('content')
@endif

@include('_partials.footer')

@hasSection('script')
    @yield('script')
@endif
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
