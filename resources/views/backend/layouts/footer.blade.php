        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <script src="{{ asset('public/all/plugin/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('public/all/plugin/jquery-confirm/jquery-confirm.min.js') }}"></script>
        <script src="{{ asset('public/backend/dist/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('public/backend/dist/plugins/fileuploads/js/dropify.min.js') }}"></script>
        <script src="{{ asset('public/backend/dist/plugins/jquery-tabledit/jquery.tabledit.min.js') }}"></script>
        <script src="{{ asset('public/backend/dist/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
        <!-- END: JS Assets-->
        {!! FCommon::minifyjs('backend_theme') !!}
        @yield('footerjs')
        @include('flash::message')
    </body>
</html>