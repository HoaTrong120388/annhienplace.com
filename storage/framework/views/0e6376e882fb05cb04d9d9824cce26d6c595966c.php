            <footer>
                <div class="container">
                    <?php echo $__env->make('frontend.partials.footer.footer-showroom', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('frontend.partials.footer.footer-social', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </footer>
        </div> <!--/wrapper-->
        <?php echo $__env->make('frontend.common.custom-code', ['type_include' => 3], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('frontend.partials.footer.footer-js', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>