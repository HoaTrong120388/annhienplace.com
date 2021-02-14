
        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <script src="{{ asset('public/backend/dist/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('public/backend/dist/plugins/fileuploads/js/dropify.min.js') }}"></script>
        <!-- END: JS Assets-->
        @yield('footerjs')
        {!! FCommon::minifyjs('backend_theme') !!}
        @include('flash::message')
    </body>
</html>