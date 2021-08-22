<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Stock::Dashboard - @hasSection('title') @yield('title') @endif</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/img/bootstrap-icons-1.5.0/bootstrap-icons.css') }}" rel="stylesheet">
    {{--
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/favicons/safari-pinned-tab.svg') }}" color="#7952b3">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    --}}
    <link rel="shortcut icon" href="{{asset('assets/img/favicons/favicon.ico')}}" type="image/x-icon">
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

@include('dashboard._partials.navbar')


<div class="container-fluid">
    <div class="row">
        @include('dashboard._partials.sidebarMenu')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @hasSection('content')
                @yield('content')
            @endif
        </main>
    </div>
</div>

@hasSection('script')
    @yield('script')
@endif

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
{{--<script src="{{ asset('assets/js/Chart.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/dashboard.js') }}"></script>--}}
</body>
</html>
