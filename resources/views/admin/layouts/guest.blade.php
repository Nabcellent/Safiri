<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
          content="admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities."/>
    <meta name="keywords" content="admin template, admin template, dashboard template, flat admin template, responsive admin template, web app"/>
    <meta name="author" content="pixelstrap"/>
    <title>{{ config('app.name', 'Safiri') }} - @yield('title')</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon"/>

    <!-- Plugins css start-->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap5/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap5/bootstrap-icons.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/icofont.css') }}"/>
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/themify.css') }}"/>
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/flag-icon.css') }}"/>
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/feather-icon.css') }}"/>
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}"/>
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/responsive.css') }}">

    <!-- Plugins css Ends-->

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap5/bootstrap.bundle.min.js') }}"></script>
</head>
<body>

<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
<!-- Loader ends-->

@yield('content')


<!-- SCRIPTS -->

<!-- Plugins JS start-->
<!-- feather icon js-->
<script src="{{ asset('vendor/viho/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('vendor/viho/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('vendor/viho/js/config.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('vendor/bootstrap5/bootstrap.bundle.min.js') }}"></script>


<!-- Theme js-->
<script src="{{ asset('vendor/viho/js/script.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Plugin used-->
<script>
    $(document).on('click', '.toggle-password', function() {
        const passwordField = $(this).closest('div').find('input');
        $( passwordField ).prop( "type", ( i, val ) => val === 'password' ? 'text' : 'password');
        $(this).toggleClass('bi-eye');
    });
</script>
<!-- -->

</body>
</html>
