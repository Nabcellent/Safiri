
<!-- feather icon js-->
<script src="{{ asset('vendor/viho/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('vendor/viho/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('vendor/viho/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('vendor/viho/js/config.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('vendor/bootstrap5/bootstrap.bundle.min.js') }}"></script>
{{--    TOASTIFY    --}}
<script src="{{ asset('vendor/toastify/toastify.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.js') }}"></script>

<!-- Plugins JS start-->

@stack('scripts')

<script src="{{ asset('vendor/viho/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('vendor/viho/js/counter/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/viho/js/counter/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('vendor/viho/js/counter/counter-custom.js') }}"></script>
<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="{{ asset('vendor/viho/js/script.js') }}"></script>
<script src="{{ asset('vendor/viho/js/theme-customizer/customizer.js') }}"></script>
<script src="{{ asset('js/admin/theme.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>

@include('partials.javascript')
