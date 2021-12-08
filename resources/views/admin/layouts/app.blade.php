<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TA') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/admin/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/admin/favicon.png') }}" type="image/x-icon">

@include('admin.partials.links')

<!-- latest jquery-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/config.js') }}"></script>
</head>
<body>

<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader"></div>
</div>
<!-- Loader ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
@include('admin.partials.header')
<!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start -->
    @include('admin.partials.sidebar')
    <!-- Page Sidebar Ends-->
        <div class="page-body">
            <!-- Container-fluid starts-->
            <!-- Container-fluid starts-->

        @yield('content')

        <!-- Container-fluid Ends-->
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('admin.partials.footer')
    </div>
</div>

@include('admin.partials.scripts')
</body>
</html>
