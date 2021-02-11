            <footer>
                <div class="container">
                    @include('frontend.partials.footer.footer-showroom')
                    @include('frontend.partials.footer.footer-social')
                </div>
            </footer>
        </div> <!--/wrapper-->
        @include('frontend.common.custom-code', ['type_include' => 3])
        @include('frontend.partials.footer.footer-js')
    </body>
</html>