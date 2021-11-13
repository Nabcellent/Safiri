<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Safiri - @yield('title')</title>

    @include('partials.links')

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap5/bootstrap.bundle.min.js') }}"></script>
</head>
<body>


<div class="container-fluid px-0">
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
</div>


<!-- SCRIPTS -->
@include('partials.scripts')
<!-- -->
</body>
</html>
